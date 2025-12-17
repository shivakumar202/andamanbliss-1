<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BoatTripLocations;
use App\Models\BoatTrips;
use App\Models\CategorySections;
use App\Models\ContentBlocks;
use App\Models\Drive;
use App\Models\Faq;
use App\Models\MetaHeadings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Intervention\Image\Constraint;
use Intervention\Image\Facades\Image;
use Validator;

class BoatTripsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($location = null)
    {
        $locationId = null;

        $location = Str::replace('-', ' ', $location);
        $boatTrips = Cache::remember('boatTrips', now()->addMinutes(60), function () {
            return BoatTrips::all();
        });

        if ($location) {
            $boatTrips = $boatTrips->filter(function ($trip) use ($location) {
                return Str::lower($trip->location) === Str::lower($location);
            });
            $locationId = BoatTripLocations::whereRaw('LOWER(name) = ?', [Str::lower($location)])->first();
        }

        $locations = $boatTrips->pluck('location')->unique()->values();

        return view('admin.boat-trips.index', compact('boatTrips', 'locations', 'locationId'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $locations = BoatTripLocations::get()->pluck('name');

        return view('admin.boat-trips.create', compact('locations'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|max:225',
            'location' => 'required|string',
            'adult_price' => 'required|numeric|min:1',
            'infant_price' => 'required|min:0',
            'service_tax' => 'required|numeric|min:0',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|after:start_time',
            'slot_interval' => 'required|numeric|min:0|max:60',
            'status' => 'required|in:0,1'
        ], [
            'name.required' => 'Please Enter Valid Name',
            'name.max' => 'Name Is Too Lengthy Make It Shorter',
            'location.in' => 'Proper Location Is Not Selected',
            'end_time.after' => 'End time must be after start time 😅',
        ]);

        if ($validate->fails()) {
            return back()->withInput()->withErrors($validate);
        }

        $boatTrips = BoatTrips::create($request->all());
        Cache::forget('boatTrips');

        return back()->with('success', __('Boat Trip Added successfully.'));
    }

    public function locations(Request $request, $id = null)
    {
        if ($request->isMethod('delete')) {
            $boatLocation = BoatTripLocations::findOrFail($id);
            $boatLocation->delete();
            return back()->with('success', __('Location Unlikend ✅'));
        }

        if ($request->isMethod('post')) {
            $rules = [
                'page_url' => 'required|string',
                'status' => 'required|in:0,1',
                'name' => $id
                    ? 'required|string'
                    : 'required|string|unique:boat_trip_locations,name',
                'page_title' => 'required|string',
                'page_desc' => 'required|string',
            ];
            $validate = Validator::make($request->all(), $rules);
            if ($validate->fails()) {
                return back()->withErrors($validate)->withInput();
            }
            $boatLocation = BoatTripLocations::findOrNew($id);
            $boatLocation->fill([
                'name' => $request->name,
                'page_url' => $request->page_url ?: Str::slug($request->name),
                'page_title' => $request->page_title,
                'page_desc' => $request->page_desc,
                'status' => $request->status,
            ])->save();

            return redirect()->route('admin.trip-locations')->with('success', __($id ? 'Location Upgraded ⬆️' : 'New Location Unlocked 🔓'));
        }

        $locations = BoatTripLocations::all();
        $location = $locations->find($id);

        return view('admin.boat-trips.locations', compact('locations', 'location'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $boatTrip = BoatTrips::cachedFind($id);

        $locations = BoatTripLocations::get()->pluck('name');

        $locationId = BoatTripLocations::whereRaw('LOWER(name) = ?', [Str::lower($boatTrip->location)])->first();


        return view('admin.boat-trips.create', compact('boatTrip', 'locations', 'locationId'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->merge([
            'start_time' => substr($request->start_time, 0, 5),
            'end_time' => substr($request->end_time, 0, 5),
        ]);



        $validate = Validator::make($request->all(), [
            'name' => 'required|max:225',
            'location' => 'required|string',
            'adult_price' => 'required|numeric|min:1',
            'infant_price' => 'required|numeric|min:0',
            'service_tax' => 'required|numeric|min:0',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'slot_interval' => 'required|numeric|min:0|max:60',
            'status' => 'required|in:0,1'
        ], [
            'name.required' => 'Please enter a valid name',
            'name.max' => 'Name is too lengthy, make it shorter',
            'location.required' => 'Please select a valid location',
            'end_time.after' => 'End time must be after start time 😅',
        ]);

        if ($validate->fails()) {
            return back()->withInput()->withErrors($validate);
        }

        $boatTrip = BoatTrips::findOrFail($id);
        $boatTrip->update($request->all());
        Cache::forget("boatTrip_{$id}");


        return back()->with('success', __('Boat Trip Added successfully.'));
    }


    public function faqs(Request $request, $tripId, $id = null)
    {
        if ($request->isMethod('delete')) {
            $faq = Faq::findOrFail($id);
            $faq->delete();

            Cache::forget("boatfaq_{$tripId}");


            return redirect()->route('admin.boat-trips.faqs', ['tripId' => $tripId])
                ->with('success', __('Cab faq deleted successfully.'));
        }
        if ($request->isMethod('post')) {
            $rules['answer'] = 'required|string';
            if ($id) {
                $rules['question'] = [
                    'required',
                    'string',
                    'max:225',
                    Rule::unique('faqs', 'question')->where('question', $request->question)->where('table_id', $tripId)->where('table_type', 'boat_trip')->ignore($id),
                ];
            } else {
                $rules['question'] = [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('faqs', 'question')
                        ->where('question', $request->question)
                        ->where('table_id', $tripId)
                        ->where('table_type', 'boat_trip'),
                ];
            }

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return back()->withInput()->withErrors($validator);
            }


            $faq = Faq::findOrNew($id);
            $faq->table_id = $tripId;
            $faq->table_type = 'boat_trip';
            $faq->question = $request->question;
            $faq->answer = $request->answer;
            $faq->save();

            Cache::forget("boatfaq_{$tripId}");

            return redirect()->route('admin.boat-trips.faqs', ['tripId' => $tripId])
                ->with('success', __('Boat Trip ' . ($id ? 'updated' : 'saved') . ' successfully'));
        }


        $faqs = Cache::rememberForever("boatfaq_{$tripId}", function () use ($tripId) {
            return Faq::where('table_id', $tripId)->where('table_type', 'boat_trip')->get();
        });

        $faq = Faq::find($id);

        $locationId = BoatTripLocations::find($tripId);

        return view('admin.boat-trips.faq', compact('faqs', 'locationId', 'faq'));
    }


    public function contentBlock(Request $request, $tripId, $id = null)
    {
        if ($request->isMethod('delete')) {
            $deleteId = $request->route('id') ?? $request->input('delete_id');
            $contentBlock = ContentBlocks::where('activity_id', $tripId)->where('id', $deleteId)->first();

            if ($contentBlock) {
                $contentBlock->delete();
                return redirect("admin/boat-trips/$tripId/content-blocks/")->with('success', 'Content block deleted successfully!');
            }

            return redirect("admin/boat-trips/$tripId/content-blocks/")->with('error', 'Content block not found.');
        }
        //POST
        if ($request->isMethod('post')) {
            $request->validate([
                'layout' => 'required|string',
                'title' => 'required|string',
                'desc' => 'nullable|string',
                'columns_data' => 'required|array'
            ]);


            $block = [
                'columns_data' => $request->columns_data
            ];

            foreach ($block['columns_data'] as &$column) {
                $list = [];
                foreach ($column as $key => $value) {
                    if (Str::startsWith($key, 'list')) {
                        $list[] = $value;
                        unset($column[$key]);
                    }
                }
                $column['list'] = $list;
            }

            if ($id) {
                $contentBlock = ContentBlocks::where('activity_id', $tripId)->where('id', $id)->first();
                if ($contentBlock) {
                    $contentBlock->update([
                        'type' => 'boat_trip',
                        'layout' => $request->layout,
                        'title' => $request->title,
                        'description' => $request->desc,
                        'column' => count($request->columns_data),
                        'section_blocks' => [$block],
                    ]);
                }
            } else {
                ContentBlocks::create([
                    'type' => 'boat_trip',
                    'activity_id' => $tripId,
                    'layout' => $request->layout,
                    'title' => $request->title,
                    'description' => $request->desc,
                    'column' => count($request->columns_data),
                    'section_blocks' => [$block],
                ]);
            }

            return redirect("admin/boat-trips/$tripId/content-blocks/")->with('success', 'Content block saved successfully!');
        }

        $block = null;
        if ($id) {
            $block = ContentBlocks::where('activity_id', $tripId)->where('id', $id)->first();
        }


        $blocks = ContentBlocks::where('activity_id', $tripId)->where('type', 'boat_trip')->get();

        $locationId = BoatTripLocations::find($tripId);

        return view('admin.boat-trips.content_block', [
            'blocks' => $blocks,
            'block' => $block,
            'tripId' => $tripId,
            'locationId' => $locationId,
        ]);
    }


    public function metaTags(Request $request, $tripId)
    {
        $locationId = BoatTripLocations::with('meta')->findOrFail($tripId);

        $meta = $locationId->meta;


        if ($request->isMethod('post')) {
            $rules = [
                'meta_keywords' => 'nullable|string',
                'meta_title' => 'nullable|string|max:255',
                'meta_schema' => 'nullable|string',
                'meta_description' => 'nullable|string|max:1000',
                'og_title' => 'nullable|string|max:255',
                'og_description' => 'nullable|string|max:1000',
                'og_image' => 'nullable|string|max:1024',
                'twitter_card' => ['nullable', Rule::in(['summary', 'summary_large_image', 'app', 'player'])],
                'twitter_title' => 'nullable|string|max:255',
                'twitter_desc' => 'nullable|string|max:1000',
                'twitter_image' => 'nullable|string|max:1024',
            ];

            $validated = $request->validate($rules);

            if (!$meta) {
                $meta = new MetaHeadings();
                $meta->table_type = 'boat_trip';
                $meta->table_id = $tripId;
            }

            $meta->meta_title = $validated['meta_title'] ?? null;
            $meta->meta_keywords = $validated['meta_keywords'] ?? null;
            $meta->meta_schema = $validated['meta_schema'] ?? null;
            $meta->meta_description = $validated['meta_description'] ?? null;
            $meta->og_title = $validated['og_title'] ?? null;
            $meta->og_description = $validated['og_description'] ?? null;
            $meta->og_image = $validated['og_image'] ?? null;
            $meta->twitter_image = $validated['twitter_image'] ?? null;
            $meta->twitter_card = $validated['twitter_card'] ?? null;
            $meta->twitter_title = $validated['twitter_title'] ?? null;
            $meta->twitter_desc = $validated['twitter_desc'] ?? null;

            $meta->save();

            return redirect('admin/boat-trips/' . $tripId . '/meta-headings')
                ->with('success', __('Boat Trip meta information saved successfully.'));
        }
        return view('admin.boat-trips.meta-headings', compact('locationId', 'meta'));
    }







    public function images(Request $request, $tripId, $id = null)
    {
        $path = 'boat_trip_photo';

        if ($request->isMethod('delete')) {
            $drive = Drive::findOrFail($id);
            $drive->delete();

            return redirect('admin/boat-trips/' . $tripId . '/images')
                ->with('success', __('Bike image deleted successfully.'));
        }

        if ($request->isMethod('post')) {
            $rules['photo'] = 'required|file|image|mimes:jpeg,jpg,png|max:2048';

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return back()
                    ->withInput()
                    ->withErrors($validator);
            }

            if ($request->hasFile('photo')) {
                // $path = 'bike_photo';
                if ($id) {
                    $drive = Drive::find($id);
                    if ($drive) {
                        if (Storage::disk('public')->exists($drive->file_name)) {
                            Storage::disk('public')->delete($drive->file_name);
                        }
                        $drive->delete();
                    }
                }

                if (!Storage::disk('public')->exists($path)) {
                    Storage::makeDirectory($path, 0777, true, true);
                }

                $file = $request->file('photo');
                $realPath = $file->getRealPath();
                $extension = $file->getClientOriginalExtension();
                $fileName = 'photo-' . date('Ymd-His') . '-' . abs(crc32(uniqid())) . '.' . $extension;
                $fullPath = $path . '/' . $fileName;
                if (Storage::disk('public')->exists($fullPath)) {
                    Storage::disk('public')->delete($fullPath);
                }

                $resize_width = 720;
                $resize_height = 480;
                $image = Image::make($realPath)
                    ->resize($resize_width, $resize_height, function (Constraint $constraint) {
                        $constraint->aspectRatio(); // auto height
                        $constraint->upsize(); // prevent possible upsizing
                    })
                    ->encode($extension); // encode image format
                Storage::disk('public')->put($fullPath, $image, 'public');

                $drive = new Drive;
                $drive->table_id = $tripId;
                $drive->table_type = $path;
                $drive->file_name = $fileName;
                $drive->file_type = 'image';
                $drive->save();
            }

            return redirect('admin/boat-trips/' . $tripId . '/images')
                ->with('success', __('Boat image ' . ($id ? 'updated' : 'saved') . ' successfully.'));
        }

        $locationId = BoatTripLocations::findOrFail($tripId);

        $drive = Drive::find($id);

        $drives = Drive::where('table_id', $tripId)
            ->where('table_type', $path)
            ->where('file_type', 'image')
            ->get();

        return view('admin.boat-trips.images')->with(compact('locationId', 'drive', 'drives'));
    }

    public function readMoreContent(Request $request, string $tripId)
    {
        $locationId = BoatTripLocations::findOrFail($tripId);
        $section = CategorySections::where('category_id', $tripId)->where('type', 'boat_trip')->first();
        if ($request->isMethod('post')) {
            $validated = $request->validate([
                'title' => 'required|string',
                'modal_title' => 'required|string',
                'display_block' => 'nullable|string',
                'modal_content' => 'nullable|string',
                'blocks_section_1' => 'array',
                'blocks_section_2' => 'array',
                'cta_title' => 'nullable|string',
                'cta_desc' => 'nullable|string',
            ]);

            CategorySections::updateOrCreate(
                [
                    'category_id' => $tripId,
                    'type' => 'boat_trip'
                ],
                [
                    'title' => $validated['title'],
                    'modal_title' => $validated['modal_title'],
                    'display_block' => $validated['display_block'],
                    'modal_content' => $validated['modal_content'],
                    'blocks_section' => '',
                    'cta_title' => '',
                    'cta_desc' => '',

                ]
            );

            return redirect('admin/boat-trips/' . $tripId . '/read-more-content')->with('success', __('Boat Trip Read More Content Updated successfully.'));
        }
        return view('admin.boat-trips.read_more_content', compact('locationId', 'section'));
    }


    /**
     * Remove the specified resource from storage.
     */

    public function destroy(string $id)
    {
        $boatTrip = BoatTrips::find($id);
        $boatTrip->delete();
        Cache::forget('boatTrips');
        return back()->with('succcess', __('Trip Deleted Successfully'));
    }
}
