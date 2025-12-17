<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activities;
use App\Models\ContentBlocks;
use App\Models\Ferries;
use App\Models\Highlights;
use App\Models\Hotel;
use App\Models\itinerary_accommodations;
use App\Models\itinerary_activities;
use App\Models\itinerary_transfers;
use App\Models\MetaHeadings;
use App\Models\subCategories;
use App\Models\tour_itineraries;
use App\Models\TourActivities;
use App\Models\PaymentBreakups;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Constraint;
use Intervention\Image\Facades\Image;
use App\Models\Drive;
use App\Models\Category;
use App\Models\Service;
use App\Models\Facility;
use App\Models\Addon;
use App\Models\Policy;
use App\Models\Faq;
use App\Models\Inclusion;
use App\Models\Locations;
use App\Models\Review;
use App\Models\TourCategories;
use App\Models\TourItineraries;
use App\Models\TourPackages;
use App\Models\TourServices;
use Illuminate\Support\Facades\DB;
use Log;
use Maatwebsite\Excel\Facades\Excel;

class TourController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tours = TourPackages::with('tourCategory')
            ->when(!empty($request->category_id), function ($query) use ($request) {
                $query->where('category_id', $request->category_id);
            })
            ->when(!empty($request->status), function ($query) use ($request) {
                $query->where('status', $request->status);
            })
            ->when($request->featured == 1, function ($query) use ($request) {
                $query->where('featured', 1);
            })
            ->when($request->best_seller == 1, function ($query) use ($request) {
                $query->where('best_seller', 1);
            })
            ->get();
        foreach ($tours as $tour) {
            if ($tour->addons) {
                $addonIds = explode(',', $tour->addons);
                $tour->addon_names = Addon::whereIn('id', $addonIds)->pluck('name')->toArray();
            }
        }
        $categories = Category::where('type', 'tour')->get();
        return view('admin.tours.index')->with(compact('tours', 'categories'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('type', 'tour')->get();
        $addons = Addon::where('type', 'tour')->get();
        $locations = Locations::where('status', 1)->get();
        $subCategory = subCategories::where('status', 1)->get();
        $selectedAddons = [];
        $tour = null;

        return view('admin.tours.create')->with(compact('categories', 'locations', 'addons', 'selectedAddons', 'tour', 'subCategory'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'package_name' => 'required|string',
            'category_id' => 'required|integer|exists:categories,id',
            'page_heading' => 'nullable|string|max:255',
            'content' => 'required|string',
            'nights' => 'required|numeric|min:1',
            'url' => 'required|string',
            'cta_title' => 'required|string',
            'cta_description' => 'required|string',
            'days' => 'required|numeric|min:1',
            'best_seller' => 'required|in:0,1',
            'featured' => 'required|in:0,1',
            'islands_covered' => 'required|array',
            'sub_category' => 'required|array',
            'reviews' => 'required|numeric|integer',
            'status' => 'required|in:0,1',
        ]);

        if ($validator->fails()) {
            return back()
                ->withInput()
                ->withErrors($validator);
        }

        $category = Category::find($request->category_id);

        $tour = new TourPackages;
        $tour->package_name = $request->package_name;
        $tour->slug = Str::slug($request->package_name);
        $tour->page_heading = $request->page_heading;
        $tour->nights = $request->nights;
        $tour->url = $request->url;
        $tour->days = $request->days;
        $tour->cta_title = $request->cta_title;
        $tour->cta_description = $request->cta_description;
        $tour->category_id = $request->category_id;
        $tour->sub_category_id = implode(',', $request->sub_category);
        $tour->islands_covered = implode(',', $request->islands_covered);
        $tour->featured = $request->featured;
        $tour->best_seller = $request->best_seller;
        $tour->reviews = $request->reviews;
        $tour->description = $request->content;
        $tour->status = $request->status;
        $tour->save();

        foreach ($request->sub_category as $subCat) {
            $tour->subCategories()->attach($subCat, [
                'markup' => 0,
                'discount' => 0,
                'discount_above' => null,
                'starts_from' => null
            ]);
        }

        for ($i = 1; $i <= $tour->days; $i++) {
            TourItineraries::create([
                'tour_id' => $tour->id,
                'day' => $i,
                'status' => 0
            ]);
        }

        return back()->with('success', __('Tour saved successfully.'));
    }

    /**
     * Display the specified resource.
     */

    public function show(string $id)
    {
        $tour = TourPackages::with('tourCategory')->findOrFail($id);
        $addons = Addon::where('type', 'tour')->get();
        $locations = Locations::where('status', 1)->get();
        $subCategory = subCategories::all();
        return view('admin.tours.show')->with(compact('tour', 'addons', 'locations', 'subCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $tour = TourPackages::with('tourCategory')->findOrFail($id);
        $addons = Addon::where('type', 'tour')->get();
        $categories = Category::where('type', 'tour')->get();
        $locations = Locations::where('status', 1)->get();
        $selectedAddons = $tour->addons ? explode(',', $tour->addons) : [];
        $subCategory = subCategories::where('status', 1)->get();
        return view('admin.tours.create')->with(compact('tour', 'categories', 'addons', 'selectedAddons', 'locations', 'subCategory'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'package_name' => 'required|string',
            'category_id' => 'required|integer|exists:categories,id',
            'page_heading' => 'nullable|string|max:255',
            'content' => 'required|string',
            'url' => 'required|string',
            'cta_title' => 'required|string',
            'cta_description' => 'required|string',
            'nights' => 'required|numeric|min:1',
            'days' => 'required|numeric|min:1',
            'best_seller' => 'required|in:0,1',
            'featured' => 'required|in:0,1',
            'sub_category' => 'required|array',
            'islands_covered' => 'required|array',
            'reviews' => 'required|numeric|integer',
            'status' => 'required|in:0,1',
        ]);

        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }
        
        $tour = TourPackages::find($id);
        $tour->package_name = $request->package_name;
        $tour->slug = Str::slug($request->package_name);
        $tour->page_heading = $request->page_heading;
        $tour->nights = $request->nights;
        $tour->url = $request->url;
        $tour->days = $request->days;
        $tour->category_id = $request->category_id;
        $tour->cta_title = $request->cta_title;
        $tour->cta_description = $request->cta_description;
        $tour->sub_category_id = implode(',', $request->sub_category);
        $tour->islands_covered = $request->islands_covered;
        $tour->featured = $request->featured;
        $tour->best_seller = $request->best_seller;
        $tour->reviews = $request->reviews;
        $tour->description = $request->content;
        $tour->status = $request->status;
        $tour->save();

        $syncData = [];

        foreach ($request->sub_category ?? [] as $subCatId) {
            $existingPivot = $tour->subCategories()->find($subCatId);

            $syncData[$subCatId] = [
                'markup' => $existingPivot ? $existingPivot->pivot->markup : 0,
                'discount' => $existingPivot ? $existingPivot->pivot->discount : 0,
                'discount_above' => $existingPivot ? $existingPivot->pivot->discount_above : null,
                'starts_from' => $existingPivot ? $existingPivot->pivot->starts_from : null
            ];
        }

        $tour->subCategories()->sync($syncData);


        return back()->with('success', __('Tour updated successfully.'));
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tour = TourPackages::findOrFail($id);

        Facility::where('table_id', $id)
            ->where('table_type', 'tour')
            ->delete();

        Policy::where('table_id', $id)
            ->where('table_type', 'tour')
            ->delete();

        Faq::where('table_id', $id)
            ->where('table_type', 'tour')
            ->delete();

        Review::where('table_id', $id)
            ->where('table_type', 'tour')
            ->delete();

        Drive::where('table_id', $id)
            ->where('table_type', 'tour_photo')
            ->where('file_type', 'image')
            ->delete();

        $tour->delete();

        return back()
            ->with('success', __('Tour deleted successfully.'));
    }

    public function images(Request $request, $tourId, $id = null)
    {
        $path = 'tour_photo';

        if ($request->isMethod('delete')) {
            $drive = Drive::findOrFail($id);
            $drive->delete();

            return redirect('admin/tours/' . $tourId . '/images')
                ->with('success', __('Tour image deleted successfully.'));
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
                // $path = 'tour_photo';
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
                $drive->table_id = $tourId;
                $drive->table_type = $path;
                $drive->file_name = $fileName;
                $drive->file_type = 'image';
                $drive->save();
            }

            return redirect('admin/tours/' . $tourId . '/images')
                ->with('success', __('Tour image ' . ($id ? 'updated' : 'saved') . ' successfully.'));
        }

        $tour = TourPackages::findOrFail($tourId);

        $drive = Drive::find($id);

        $drives = Drive::where('table_id', $tourId)
            ->where('table_type', $path)
            ->where('file_type', 'image')
            ->get();

        return view('admin.tours.images')->with(compact('tour', 'drive', 'drives'));
    }

    public function facilities(Request $request, $tourId, $id = null)
    {
        if ($request->isMethod('delete')) {
            $facility = Facility::findOrFail($id);
            $facility->delete();

            return redirect('admin/tours/' . $tourId . '/why-us')
                ->with('success', __('Tour Why Us deleted successfully.'));
        }

        if ($request->isMethod('post')) {
            if ($id) {
                $rules = [
                    'name' => [
                        'required',
                        'string',
                        'max:255',
                        Rule::unique('facilities', 'name')
                            ->where('name', $request->name)
                            ->where('table_id', $tourId)
                            ->where('table_type', 'tour')
                            ->ignore($id),
                    ],
                    'description' => 'nullable|string',
                    'icon' => 'required|string',
                ];
            } else {
                $rules = [
                    'name' => [
                        'required',
                        'string',
                        'max:255',
                        Rule::unique('facilities', 'name')
                            ->where('name', $request->name)
                            ->where('table_id', $tourId)
                            ->where('table_type', 'tour'),
                    ],
                    'description' => 'nullable|string',
                    'icon' => 'required|string',
                ];
            }

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return back()
                    ->withInput()
                    ->withErrors($validator);
            }

            $facility = Facility::findOrNew($id);
            $facility->table_id = $tourId;
            $facility->table_type = 'tour';
            $facility->title = $request->title;
            $facility->name = $request->name;
            $facility->description = $request->description;
            $facility->icon = $request->icon;
            $facility->save();

            Facility::where('table_id', $tourId)
                ->where('table_type', 'tour')
                ->update(['title' => $request->title]);

            return redirect('admin/tours/' . $tourId . '/why-us')
                ->with('success', __('Tour why us ' . ($id ? 'updated' : 'saved') . ' successfully.'));
        }

        $tour = TourPackages::findOrFail($tourId);

        $facility = Facility::find($id);

        $facilities = Facility::where('table_id', $tourId)
            ->where('table_type', 'tour')
            ->get();

        return view('admin.tours.facilities')->with(compact('tour', 'facility', 'facilities'));
    }


    public function policies(Request $request, $tourId, $id = null)
    {
        if ($request->isMethod('delete')) {
            $policy = Policy::findOrFail($id);
            $policy->delete();

            return redirect('admin/tours/' . $tourId . '/policies')
                ->with('success', __('Tour policy deleted successfully.'));
        }

        if ($request->isMethod('post')) {
            if ($id) {
                $rules['name'] = [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('policies', 'name')
                        ->where('name', $request->name)
                        ->where('table_id', $tourId)
                        ->where('table_type', 'tour')
                        ->ignore($id),
                ];
            } else {
                $rules['name'] = [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('policies', 'name')
                        ->where('name', $request->name)
                        ->where('table_id', $tourId)
                        ->where('table_type', 'tour'),
                ];
            }

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return back()
                    ->withInput()
                    ->withErrors($validator);
            }

            $policy = Policy::findOrNew($id);
            $policy->table_id = $tourId;
            $policy->table_type = 'tour';
            $policy->name = $request->name;
            $policy->save();

            return redirect('admin/tours/' . $tourId . '/policies')
                ->with('success', __('Tour policy ' . ($id ? 'updated' : 'saved') . ' successfully.'));
        }

        $tour = Service::findOrFail($tourId);

        $policy = Policy::find($id);

        $policies = Policy::where('table_id', $tourId)
            ->where('table_type', 'tour')
            ->get();

        return view('admin.tours.policies')->with(compact('tour', 'policy', 'policies'));
    }

    public function faqs(Request $request, $tourId, $id = null)
    {
        if ($request->isMethod('delete')) {
            $faq = Faq::findOrFail($id);
            $faq->delete();

            return redirect('admin/tours/' . $tourId . '/faqs')
                ->with('success', __('Tour faq deleted successfully.'));
        }

        if ($request->isMethod('post')) {
            $rules['answer'] = 'required|string';
            if ($id) {
                $rules['question'] = [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('faqs', 'question')
                        ->where('question', $request->question)
                        ->where('table_id', $tourId)
                        ->where('table_type', 'tour')
                        ->ignore($id),
                ];
            } else {
                $rules['question'] = [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('faqs', 'question')
                        ->where('question', $request->question)
                        ->where('table_id', $tourId)
                        ->where('table_type', 'tour'),
                ];
            }

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return back()
                    ->withInput()
                    ->withErrors($validator);
            }

            $faq = Faq::findOrNew($id);
            $faq->table_id = $tourId;
            $faq->table_type = 'tour';
            $faq->question = $request->question;
            $faq->answer = $request->answer;
            $faq->save();

            return redirect('admin/tours/' . $tourId . '/faqs')
                ->with('success', __('Tour faq ' . ($id ? 'updated' : 'saved') . ' successfully.'));
        }

        $tour = TourPackages::findOrFail($tourId);

        $faq = Faq::find($id);

        $faqs = Faq::where('table_id', $tourId)
            ->where('table_type', 'tour')
            ->get();

        return view('admin.tours.faqs')->with(compact('tour', 'faq', 'faqs'));
    }

    public function reviews(Request $request, $tourId, $id = null)
    {
        if ($request->isMethod('delete')) {
            $review = Review::findOrFail($id);
            $review->delete();
            return redirect('admin/tours/' . $tourId . '/reviews')->with('success', __('Tour review deleted successfully.'));
        }

        if ($request->isMethod('post')) {
            $rules['name'] = [
                'required',
                'string',
                'max:255',
                Rule::unique('reviews', 'name')
                    ->where('name', $request->name)
                    ->where('table_id', $tourId)
                    ->where('table_type', 'tour')
                    ->ignore($id),
            ];
            $rules += [
                'address' => 'required|string|max:255',
                'review' => 'required|string',
                'media' => 'nullable|file|max:20000|mimetypes:image/jpeg,image/jpg,image/png,image/webp,image/avif,image/gif',
                'review_date' => 'required|date|before_or_equal:today',
                'rating' => 'required|integer|min:1|max:5',
                'status' => 'required|in:0,1',
                'review_link' => 'nullable|sometimes|url',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return back()->withInput()->withErrors($validator);
            }

            $review = Review::findOrNew($id);
            $review->table_id = $tourId;
            $review->table_type = 'tour';
            $review->name = $request->name;
            $review->address = $request->address;
            $review->review = $request->review;
            $review->review_date = $request->review_date;
            $review->rating = $request->rating;
            $review->status = $request->status;
            $review->review_link = $request->review_link;
            $review->save();

            $path = 'tour-review';
            $fileName = null;

            if ($request->hasFile('media')) {
                if (!Storage::disk('public')->exists($path)) {
                    Storage::disk('public')->makeDirectory($path, 0777, true, true);
                }

                $file = $request->file('media');
                $realPath = $file->getRealPath();
                $extension = strtolower($file->getClientOriginalExtension());
                $fileName = 'tour-review' . date('Ymd-His') . '-' . abs(crc32(uniqid())) . '.' . $extension;
                $fullPath = $path . '/' . $fileName;

                if (Storage::disk('public')->exists($fullPath)) {
                    Storage::disk('public')->delete($fullPath);
                }

                if (in_array($extension, ['jpg', 'jpeg', 'png', 'webp', 'avif'])) {
                    $image = Image::make($realPath)
                        ->resize(720, 480, function (Constraint $constraint) {
                            $constraint->aspectRatio();
                            $constraint->upsize();
                        })
                        ->encode($extension);
                    Storage::disk('public')->put($fullPath, $image, 'public');
                } elseif ($extension === 'gif') {
                    Storage::disk('public')->putFileAs($path, $file, $fileName);
                }

                $drive = new Drive();
                $drive->table_id = $review->id;
                $drive->table_type = $path;
                $drive->file_name = $fileName;
                $drive->file_type = 'image';
                $drive->save();
            }

            return redirect('admin/tours/' . $tourId . '/reviews')->with('success', __('Tour review ' . ($id ? 'updated' : 'saved') . ' successfully.'));
        }

        $tour = TourPackages::findOrFail($tourId);
        $review = Review::find($id);
        $reviews = Review::where('table_id', $tourId)->where('table_type', 'tour')->with('ToureviewPhotos')->get();
        return view('admin.tours.reviews')->with(compact('tour', 'review', 'reviews'));
    }



    public function inclusionExclusions(Request $request, $tourId, $id = null)
    {
        $tour = TourPackages::findOrFail($tourId);

        if ($request->isMethod('delete')) {
            $inclusion = Inclusion::findOrFail($id);
            $inclusion->delete();


            return redirect('admin/tours/' . $tourId . '/inclusion-exclusions')->with('success', __('Tour inclusion deleted successfully.'));
        }

        if ($request->isMethod('post')) {
            $rules = [
                'type' => 'required|in:inclusion,exclusion',
                'description' => 'required|string|max:1000',
                'icon' => 'required',
            ];

            $validated = $request->validate($rules);

            if ($id) {
                $inclusion = Inclusion::findOrFail($id);
                $inclusion->update($validated);
                $message = __('Tour inclusion updated successfully.');
            } else {
                $inclusion = new Inclusion($validated);
                $inclusion->table_name = 'tour';
                $inclusion->table_id = $tourId;
                $inclusion->save();
                $message = __('Tour inclusion saved successfully.');
            }

            return redirect('admin/tours/' . $tourId . '/inclusion-exclusions')->with('success', __('Tour Inclusions ' . ($id ? 'updated' : 'saved') . ' successfully.'));
        }

        $inclusion = $id ? Inclusion::findOrFail($id) : null;
        $inclusions = Inclusion::where('table_name', 'tour')
            ->where('table_id', $tourId)
            ->orderByDesc('id')
            ->get();

        return view('admin.tours.inclusion-exclusions', compact('tour', 'inclusion', 'inclusions'));
    }



    public function metaTags(Request $request, $tourId)
    {
        $tour = TourPackages::findOrFail($tourId);

        $meta = MetaHeadings::where('table_type', 'tour-package')
            ->where('table_id', $tourId)
            ->first();

        if ($request->isMethod('post')) {
            $rules = [
                'meta_keywords' => 'nullable|string|max:255',
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
                $meta->table_type = 'tour-package';
                $meta->table_id = $tourId;
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

            return redirect('admin/tours/' . $tourId . '/meta-headings')
                ->with('success', __('Tour meta information saved successfully.'));
        }

        return view('admin.tours.meta-headings', compact('tour', 'meta'));
    }

    public function packageItinerary(Request $request, $tourId, $category = null)
    {
        $tour = TourPackages::with('subCategories')->findOrFail($tourId);

        if ($tour->subCategories->isEmpty()) {
            return redirect()->back()->with('error', 'Add SubCategories Before');
        }

        if ($request->isMethod('post') || $request->isMethod('put')) {


            // Validate input data
            $request->validate([
                'itinerary' => 'required|json',
                'num_guests' => 'required|integer|min:1',
                'final_total' => 'required|numeric|min:0',
            ]);
            // Decode JSON itinerary
            $itinerary = json_decode($request->input('itinerary'), true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                return redirect()->back()->withErrors(['itinerary' => 'Invalid itinerary data format.']);
            }

            // Validate itinerary structure
            if (!is_array($itinerary) || empty($itinerary)) {
                return redirect()->back()->withErrors(['itinerary' => 'Itinerary must be a non-empty array.']);
            }

            $existingItineraryIds = [];

            // Process itinerary entries
            foreach ($itinerary as $index => $dayData) {
                $dayNumber = $index + 1;


                // Validate required fields for each day
                if (empty($dayData['title']) || empty($dayData['service']) || empty($dayData['service_location']) || empty($dayData['activity_service_location'])) {
                    continue; // Skip incomplete entries
                }

                // Update or create itinerary entry
                $itineraryEntry = TourItineraries::updateOrCreate(
                    [
                        'tour_id' => $tourId,
                        'day' => $dayNumber,
                    ],
                    [
                        'title' => $dayData['title'],
                        'description' => $dayData['description'] ?? '',
                        'service' => $dayData['service'],
                        'accommodation' => $dayData['accomodation'],
                        'accomodation_name' => json_encode($dayData['accomodation_name']) ?? null,
                        'service_location' => $dayData['service_location'],
                        'activity_location' => $dayData['activity_service_location'],
                    ]
                );

                $existingItineraryIds[] = $itineraryEntry->id;

                // Sync activities
                $activityIds = [];
                if (isset($dayData['activities']) && is_array($dayData['activities'])) {
                    foreach ($dayData['activities'] as $activity) {
                        if (!empty($activity['name']) && isset($activity['price']) && is_numeric($activity['price']) && $activity['price'] >= 0) {
                            $activityModel = itinerary_activities::updateOrCreate(
                                [
                                    'itinerary_id' => $itineraryEntry->id,
                                    'activity_id' => $activity['name'],
                                ],
                                [
                                    'price' => (float) $activity['price'],
                                ]
                            );
                            $activityIds[] = $activityModel->id;
                        }
                    }
                    itinerary_activities::where('itinerary_id', $itineraryEntry->id)
                        ->whereNotIn('id', $activityIds)
                        ->delete();
                }

                // Sync transfers
                $transferIds = [];
                if (isset($dayData['transfers']) && is_array($dayData['transfers'])) {
                    foreach ($dayData['transfers'] as $transfer) {
                        if (!empty($transfer['from']) && !empty($transfer['to']) && !empty($transfer['ferry']) && isset($transfer['price']) && is_numeric($transfer['price']) && $transfer['price'] >= 0) {
                            $transferModel = itinerary_transfers::updateOrCreate(
                                [
                                    'itinerary_id' => $itineraryEntry->id,
                                    'from' => $transfer['from'],
                                    'to' => $transfer['to'],
                                    'time' => $transfer['time'],
                                    'ferry_id' => $transfer['ferry'],
                                ],
                                [
                                    'price' => (float) $transfer['price'],
                                ]
                            );
                            $transferIds[] = $transferModel->id;
                        }
                    }
                    itinerary_transfers::where('itinerary_id', $itineraryEntry->id)
                        ->whereNotIn('id', $transferIds)
                        ->delete();
                }
            }

            // Remove orphaned itinerary entries
            TourItineraries::where('tour_id', $tourId)
                ->whereNotIn('id', $existingItineraryIds)
                ->delete();

            // Update tour package
            $tour = TourPackages::findOrFail($tourId);
            $tour->update([
                'num_guests' => $request->input('num_guests'),
                'final_total' => $request->input('final_total'),
            ]);

            return redirect()->back()->with('success', 'Itinerary updated successfully.');
        }

        $locations = TourServices::where('status', 1)->select('service_location')->distinct()->orderBy('service_location', 'DESC')->pluck('service_location');
        $activityLocation = TourActivities::select('location')->distinct('location', 'ASC')->pluck('location');
        $rawLocations = TourServices::where('status', 1)
            ->select('service_location', 'transfer')
            ->get();

        $Servicelocations = $rawLocations->map(function ($item) {
            $location = trim($item->service_location);
            $transfer = trim($item->transfer);
            return ($transfer && $transfer !== '-' && strtolower($transfer) !== 'null')
                ? "$location - to - $transfer"
                : $location;
        })->unique()->values();

        $services = TourServices::where('status', 1)->orderBy('id', 'ASC')->get();
        $activities = TourActivities::where('status', 1)->orderBy('id', 'ASC')->get();
        $accomodation = Hotel::orderBy('city_name', 'ASC')->get();
        $ferries = Ferries::all();
        $fromLocations = Ferries::pluck('from_location')->unique()->filter()->values();
        $toLocations = Ferries::pluck('to_location')->unique()->filter()->values();
        $touritinerary = tour_itineraries::with(['activities', 'transfers', 'accommodationForDay'])
            ->where('tour_id', $tourId)
            ->get();


        return view('admin.tours.tour-itinerary', compact(
            'tour',
            'locations',
            'services',
            'accomodation',
            'activities',
            'ferries',
            'fromLocations',
            'toLocations',
            'touritinerary',
            'Servicelocations',
            'activityLocation'
        ));
    }

    public function tourServices(Request $request)
    {
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'file' => 'required|mimes:csv,xlsx,xls,txt',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->with('error', 'Invalid file format. Please upload a .csv or .xlsx file.');
            }

            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            $rows = [];
            $headers = [];

            if ($extension === 'csv') {
                $handle = fopen($file->getRealPath(), 'r');
                $headers = fgetcsv($handle);

                if (!$headers || count($headers) < 2) {
                    return redirect()->back()->with('error', 'CSV file headers are missing or invalid.');
                }

                $headers = array_map(fn($h) => strtolower(trim($h)), $headers);

                while (($row = fgetcsv($handle)) !== false) {
                    if (count(array_filter($row)) === 0) continue;
                    if (count($row) !== count($headers)) continue;
                    $row = array_map(fn($v) => mb_convert_encoding(trim($v), 'UTF-8', 'auto'), $row);
                    $rows[] = array_combine($headers, $row);
                }

                fclose($handle);
            } else {
                $data = Excel::toArray([], $file);
                if (empty($data) || count($data[0]) < 2) {
                    return redirect()->back()->with('error', 'Excel file is empty or invalid.');
                }

                $rawRows = $data[0];
                $headers = array_map(fn($h) => strtolower(trim($h)), $rawRows[0]);
                unset($rawRows[0]);

                foreach ($rawRows as $row) {
                    if (count(array_filter($row)) === 0) continue;
                    if (count($row) !== count($headers)) continue;
                    $row = array_map(fn($v) => trim((string) $v), $row);
                    $rows[] = array_combine($headers, $row);
                }
            }

            $lastServiceLocation = null;

            foreach ($rows as $data) {
                if (!empty($data['service_location'])) {
                    $lastServiceLocation = $data['service_location'];
                } else {
                    $data['service_location'] = $lastServiceLocation;
                }

                TourServices::updateOrCreate(
                    [
                        'service_location' => $data['service_location'] ?? '',
                        'service' => $data['service'] ?? '',
                    ],
                    [
                        'transfer' => $data['transfer'] ?? '',
                        'distance' => $data['distance'] ?? '',
                        'duration' => $data['duration'] ?? '',
                        'start_time' => $data['start_time'] ?? '',
                        'day_schedule' => $data['day_schedule'] ?? '',
                        'six_seater_xylo_ertiga' => isset($data['six_seater_xylo_ertiga']) && is_numeric($data['six_seater_xylo_ertiga']) ? (int) $data['six_seater_xylo_ertiga'] : null,
                        'four_seater_sedan' => isset($data['four_seater_sedan']) && is_numeric($data['four_seater_sedan']) ? (int) $data['four_seater_sedan'] : null,
                        'seven_seater_innova_hexa_marazzo' => isset($data['seven_seater_innova_hexa_marazzo']) && is_numeric($data['seven_seater_innova_hexa_marazzo']) ? (int) $data['seven_seater_innova_hexa_marazzo'] : null,
                        'twelve_seater_winger' => isset($data['twelve_seater_winger']) && is_numeric($data['twelve_seater_winger']) ? (int) $data['twelve_seater_winger'] : null,
                        'seventeen_seater_tempo' => isset($data['seventeen_seater_tempo']) && is_numeric($data['seventeen_seater_tempo']) ? (int) $data['seventeen_seater_tempo'] : null,
                        'twenty_six_seater_tempo_traveller' => isset($data['twenty_six_seater_tempo_traveller']) && is_numeric($data['twenty_six_seater_tempo_traveller']) ? (int) $data['twenty_six_seater_tempo_traveller'] : null,
                    ]
                );
            }

            return redirect()->back()->with('success', 'Tour services imported successfully.');
        }

        $services = TourServices::orderBy('id', 'ASC')->get();
        return view('admin.tours.services.index', compact('services'));
    }



    public function activityServices(Request $request)
    {
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'file' => 'required|mimes:csv,xlsx,xls,txt',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->with('error', 'Invalid file format. Please upload a .csv or .xlsx file.');
            }

            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            $rows = [];
            $headers = [];

            if ($extension === 'csv') {
                $handle = fopen($file->getRealPath(), 'r');
                $headers = fgetcsv($handle);

                if (!$headers || count($headers) < 2) {
                    return redirect()->back()->with('error', 'CSV file headers are missing or invalid.');
                }

                $headers = array_map(fn($h) => strtolower(trim($h)), $headers);

                while (($row = fgetcsv($handle)) !== false) {
                    if (count(array_filter($row)) === 0) continue;
                    if (count($row) !== count($headers)) continue;
                    $row = array_map(fn($v) => mb_convert_encoding(trim($v), 'UTF-8', 'auto'), $row);
                    $rows[] = array_combine($headers, $row);
                }

                fclose($handle);
            } else {
                $data = Excel::toArray([], $file);
                if (empty($data) || count($data[0]) < 2) {
                    return redirect()->back()->with('error', 'Excel file is empty or invalid.');
                }

                $rawRows = $data[0];
                $headers = array_map(fn($h) => strtolower(trim($h)), $rawRows[0]);
                unset($rawRows[0]);

                foreach ($rawRows as $row) {
                    if (count(array_filter($row)) === 0) continue;
                    if (count($row) !== count($headers)) continue;
                    $row = array_map(fn($v) => trim((string) $v), $row);
                    $rows[] = array_combine($headers, $row);
                }
            }

            $lastLocation = null;

            foreach ($rows as $row) {
                if (!empty($row['location'])) {
                    $lastLocation = $row['location'];
                } else {
                    $row['location'] = $lastLocation;
                }

                TourActivities::updateOrCreate(
                    [
                        'location' => $row['location'] ?? null,
                        'service_name' => $row['service_name'] ?? null,
                    ],
                    [
                        'age_limit' => $row['age_limit'] ?? null,
                        'description' => $row['description'] ?? null,
                        'duration' => $row['duration'] ?? null,
                        'slots' => $row['slots'] ?? null,
                        'adult_cost' => $row['adult_cost'] !== '' ? (int) $row['adult_cost'] : null,
                        'child_cost' => $row['child_cost'] !== '' ? (int) $row['child_cost'] : null,
                        'infant_cost' => $row['infant_cost'] !== '' ? (int) $row['infant_cost'] : null,
                    ]
                );
            }

            return redirect()->back()->with('success', 'Tour Activities imported successfully.');
        }

        $activities = TourActivities::orderBy('created_at', 'desc')->get();
        return view('admin.tours.services.activities', compact('activities'));
    }


    public function ferryServices(Request $request)
    {
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'file' => 'required|mimes:csv,xlsx,xls,txt',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->with('error', 'Invalid file format. Please upload a .csv or .xlsx file.');
            }

            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            $rows = [];
            $headers = [];

            if ($extension === 'csv') {
                $handle = fopen($file->getRealPath(), 'r');
                $headers = fgetcsv($handle);

                if (!$headers || count($headers) < 2) {
                    return redirect()->back()->with('error', 'CSV file headers are missing or invalid.');
                }

                $headers = array_map(function ($h) {
                    return strtolower(preg_replace('/[^a-z0-9_]/', '_', trim($h)));
                }, $headers);

                while (($row = fgetcsv($handle)) !== false) {
                    if (count(array_filter($row)) === 0) continue;
                    if (count($row) !== count($headers)) continue;
                    $row = array_map(fn($v) => mb_convert_encoding(trim($v), 'UTF-8', 'auto'), $row);
                    $rows[] = array_combine($headers, $row);
                }

                fclose($handle);
            } else {
                $data = Excel::toArray([], $file);
                if (empty($data) || count($data[0]) < 2) {
                    return redirect()->back()->with('error', 'Excel file is empty or invalid.');
                }

                $rawRows = $data[0];
                $headers = array_map(function ($h) {
                    return strtolower(preg_replace('/[^a-z0-9_]/', '_', trim($h)));
                }, $rawRows[0]);
                unset($rawRows[0]);

                foreach ($rawRows as $row) {
                    if (count(array_filter($row)) === 0) continue;
                    if (count($row) !== count($headers)) continue;
                    $row = array_map(fn($v) => trim((string) $v), $row);
                    $rows[] = array_combine($headers, $row);
                }
            }

            foreach ($rows as $row) {
                $row = array_change_key_case($row, CASE_LOWER);

                Ferries::updateOrCreate(
                    [
                        'ferry_name' => $row['ferry_name'] ?? null,
                        'class_name' => $row['class_name'] ?? null,
                        'from_location' => $row['from_location'] ?? null,
                        'to_location' => $row['to_location'] ?? null,
                    ],
                    [
                        'adult_fare' => $row['adult_fare'] ?? null,
                        'child_fare' => $row['child_fare'] ?? null,
                        'adult_psf' => $row['adult_psf'] ?? null,
                        'child_psf' => $row['child_psf'] ?? null,
                    ]
                );
            }

            return redirect()->back()->with('success', 'Tour Ferries imported successfully.');
        }

        $ferries = Ferries::orderBy('created_at', 'desc')->get();
        return view('admin.tours.services.ferries', compact('ferries'));
    }


    public function experiences(Request $request, $tourId)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'layout' => 'required|string',
                'title' => 'required|string',
                'desc' => 'nullable|string',
                'columns_data' => 'required|array',
            ]);

            $columnsData = $request->columns_data;

            foreach ($columnsData as &$column) {
                $list = [];
                foreach ($column as $key => $value) {
                    if (Str::startsWith($key, 'list')) {
                        $list[] = $value;
                        unset($column[$key]);
                    }
                }
                $column['list'] = $list;
            }

            $sectionBlock = ['columns_data' => $columnsData];

            $block = ContentBlocks::where('activity_id', $tourId)->where('type', 'tour')->first();

            if ($block) {
                $block->update([
                    'layout' => $request->layout,
                    'title' => $request->title,
                    'type' => 'tour',
                    'description' => $request->desc,
                    'column' => count($columnsData),
                    'section_blocks' => [$sectionBlock],
                ]);
            } else {
                ContentBlocks::create([
                    'activity_id' => $tourId,
                    'layout' => $request->layout,
                    'title' => $request->title,
                    'type' => 'tour',
                    'description' => $request->desc,
                    'column' => count($columnsData),
                    'section_blocks' => [$sectionBlock],
                ]);
            }

            return redirect("admin/tours/$tourId/experiences/")->with('success', 'Content block saved successfully!');
        }

        $tour = TourPackages::findOrFail($tourId);
        $block = ContentBlocks::where('activity_id', $tourId)->where('type', 'tour')->first();
        $blocks = $block ? collect([$block]) : collect();

        return view('admin.tours.experiences', compact('tour', 'block', 'blocks'));
    }


    public function pricing(Request $request, string $id)
    {
        // Fetch tour with subcategories and pivot data
        $tour = TourPackages::with('subCategories')->findOrFail($id);

        // Check if form is submitted (POST)
        if ($request->isMethod('post')) {

            // Validate pivot fields (example)
            $request->validate([
                'sub_category' => 'required|array',
                'markup' => 'array',
                'discount' => 'array',
                'discount_above' => 'array',
                'starts_from' => 'array',
            ]);

            $syncData = [];
            foreach ($request->sub_category as $subCatId) {
                $syncData[$subCatId] = [
                    'markup' => $request->markup[$subCatId] ?? 0,
                    'discount' => $request->discount[$subCatId] ?? 0,
                    'discount_above' => $request->discount_above[$subCatId] ?? null,
                    'starts_from' => $request->starts_from[$subCatId] ?? null,
                ];
            }

            // Sync pivot table
            $tour->subCategories()->sync($syncData);

            return back()->with('success', 'Pricing updated successfully.');
        }

        // GET request -> show view
        return view('admin.tours.pricing', compact('tour'));
    }


    public function priceBreakup(Request $request, string $id = null)
    {
        $payments = PaymentBreakups::get();

        if ($request->isMethod('post')) {

            $rules = [
                'days' => 'required|integer',
                'percentage' => 'required|integer',
            ];

            if ($id) {
                $rules['days'] .= '|unique:payment_breakups,days,' . $id;
            } else {
                $rules['days'] .= '|unique:payment_breakups,days';
            }

            $request->validate($rules);

            $data = [
                'days' => $request->days,
                'percent' => $request->percentage,
            ];

            if ($id == 1 && $data['days'] != 0) {
                $message = 'Update Not Allowed For This ';
                return redirect()->route('admin.tours.pricingBreakup')->with('error', $message);
            }

            if ($id) {
                PaymentBreakups::updateOrCreate(['id' => $id], $data);
                $message = 'Payment breakup updated successfully.';
            } else {
                PaymentBreakups::create($data);
                $message = 'Payment breakup created successfully.';
            }

            return redirect()->route('admin.tours.pricingBreakup')->with('success', $message);
        };


        if ($request->isMethod('delete')) {
            if ($id == 1) {
                $message = 'Default Payment Percenteage	is not allowed to delete';
                return redirect()->route('admin.tours.pricingBreakup')->with('error', $message);
            } else {
                $pricing = PaymentBreakups::find($id);
                $pricing->delete();
                $message = 'Payment Breakup Has Been Deleted';
                return redirect()->route('admin.tours.pricingBreakup')->with('success',$message);
            }
        }

        $payment = PaymentBreakups::find($id);

        return view('admin.tours.services.payment_breakup', compact('payments', 'payment'));
    }
}
