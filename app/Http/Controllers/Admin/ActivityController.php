<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activities;
use App\Models\activityDaySchedule;
use App\Models\ActivitySlots;
use App\Models\Addon;
use App\Models\ContentBlocks;
use App\Models\daySchedules;
use App\Models\Highlights;
use App\Models\InfoBlocks;
use App\Models\MetaHeadings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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
use App\Models\Policy;
use App\Models\Faq;
use App\Models\Review;

class ActivityController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $activities = Activities::with('category')
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
        foreach ($activities as $activity) {
            if ($activity->addons) {
                $addonIds = explode(',', $activity->addons);
                $activity->addon_names = Addon::whereIn('id', $addonIds)->pluck('name')->toArray();
            }
        }
        $categories = Category::where('type', 'activity')->get();

        return view('admin.activities.index')->with(compact('activities', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('type', 'activity')->get();
        $addons = Addon::where('type', 'activity')->get();
        $selectedAddons = [];
        $activity = null;
        return view('admin.activities.create')->with(compact('categories','activity', 'addons', 'selectedAddons'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('activities', 'service_name')
                    ->where('service_name', $request->name)->where('category_id', $request->category_id),
            ],
            'category_id' => 'required|numeric|integer',
            'adult_cost' => 'required|numeric',
            'child_cost' => 'required|numeric',
            'discount' => 'nullable|numeric',
            'add_ons' => 'nullable|array',
            'location' => 'required|string|max:255',
            'duration' => 'required|string',
            'has_medical_verification' => 'required|in:0,1',
            'title' => 'required|string',

            'description' => 'required|string',
            'ctc_desc' => 'required|string',
            'ctc_title' => 'required|string',
            'video_url' => 'nullable|string',
            'ratings' => 'required|numeric|integer|between:1,5',
            'status' => 'required|string|max:255|in:0,1',

        ]);

        if ($validator->fails()) {
            return back()
                ->withInput()
                ->withErrors($validator);
        }

        $activity = new Activities;

        $activity->service_name = $request->name;
        $activity->slug = Str::slug($request->name);
        $activity->category_id = $request->category_id;
        $activity->url = $request->url;
        $activity->title = $request->title;
        $activity->adult_cost = $request->adult_cost;
        $activity->child_cost = $request->child_cost;
        $activity->discount = $request->discount;
        $activity->addons = $request->add_ons ? implode(',', $request->add_ons) : null;
        $activity->location = $request->location;
        $activity->featured = $request->featured;
        $activity->best_seller = $request->best_seller ?? 0;
        $activity->has_medical_verification = $request->has_medical_verification;
        $activity->duration = $request->duration;
        $activity->ctc_desc = $request->ctc_desc;
        $activity->ctc_title = $request->ctc_title;
        $activity->video_url = $request->video_url;
        $activity->featured = $request->featured ?? 1;
        $activity->slots = $request->slots;
        $activity->rating = $request->ratings;
        $activity->description = $request->description;
        $activity->status = $request->status;
        $activity->save();

        return back()
            ->with('success', __('Activity saved successfully.'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $activity = Activities::with('category')->findOrFail($id);
        $addons = Addon::get();

        return view('admin.activities.show')->with(compact('activity', 'addons'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $activity = Activities::findOrFail($id);
        $addons = Addon::where('type', 'activity')->get();
        $categories = Category::where('type', 'activity')->get();
        $selectedAddons = $activity->addons ? explode(',', $activity->addons) : [];
        return view('admin.activities.create')->with(compact('activity', 'categories', 'addons', 'selectedAddons'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'category_id' => 'required|numeric|integer',
            'adult_cost' => 'required|numeric',
            'child_cost' => 'required|numeric',
            'discount' => 'nullable|numeric',
            'add_ons' => 'nullable|array',
            'location' => 'required|string|max:255',
            'duration' => 'required|string',
            'has_medical_verification' => 'required|in:0,1',
            'title' => 'required|string',
            'description' => 'required|string',
            'ctc_desc' => 'required|string',
            'ctc_title' => 'required|string',
            'video_url' => 'nullable|string',
            'ratings' => 'required|numeric|integer|between:1,5',
            'status' => 'required|string|max:255|in:0,1',
        ]);

        if ($validator->fails()) {
            return back()
                ->withInput()
                ->withErrors($validator);
        }

        $activity = Activities::find($id);
        $activity->service_name = $request->name;
        $activity->slug = Str::slug($request->name);
        $activity->category_id = $request->category_id;
        $activity->url = $request->url;
        $activity->title = $request->title;
        $activity->adult_cost = $request->adult_cost;
        $activity->child_cost = $request->child_cost;
        $activity->discount = $request->discount;
        $activity->addons = $request->add_ons ? implode(',', $request->add_ons) : null;
        $activity->location = $request->location;
        $activity->featured = $request->featured;
        $activity->best_seller = $request->best_seller ?? 0;
        $activity->has_medical_verification = $request->has_medical_verification;
        $activity->duration = $request->duration;
        $activity->video_url = $request->video_url;
        $activity->ctc_desc = $request->ctc_desc;
        $activity->ctc_title = $request->ctc_title;
        $activity->slots = $request->slots;
        $activity->rating = $request->ratings;
        $activity->description = $request->description;
        $activity->status = $request->status;
        $activity->save();

        return back()
            ->with('success', __('Activity updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $activity = Activities::findOrFail($id);

        Facility::where('table_id', $id)
            ->where('table_type', 'activity')
            ->delete();

        Policy::where('table_id', $id)
            ->where('table_type', 'activity')
            ->delete();

        Faq::where('table_id', $id)
            ->where('table_type', 'activity')
            ->delete();

        Review::where('table_id', $id)
            ->where('table_type', 'activity')
            ->delete();

        Drive::where('table_id', $id)
            ->where('table_type', 'activity_photo')
            ->where('file_type', 'image')
            ->delete();

        $activity->delete();

        return back()
            ->with('success', __('Activity deleted successfully.'));
    }

    public function images(Request $request, $activityId, $id = null)
    {
        $path = 'activity_photo';

        if ($request->isMethod('delete')) {
            $drive = Drive::findOrFail($id);
            $drive->delete();

            return redirect('admin/activities/' . $activityId . '/images')
                ->with('success', __('Activity image deleted successfully.'));
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
                // $path = 'activity_photo';
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
                $drive->table_id = $activityId;
                $drive->table_type = $path;
                $drive->file_name = $fileName;
                $drive->file_type = 'image';
                $drive->save();
            }


            return redirect('admin/activities/' . $activityId . '/images')
                ->with('success', __('Activity image ' . ($id ? 'updated' : 'saved') . ' successfully.'));
        }

        $activity = Activities::findOrFail($activityId);

        $drive = Drive::find($id);

        $drives = Drive::where('table_id', $activityId)
            ->where('table_type', $path)
            ->where('file_type', 'image')
            ->get();



        return view('admin.activities.images')->with(compact('activity', 'drive', 'drives'));
    }

    public function facilities(Request $request, $activityId, $id = null)
    {
        if ($request->isMethod('delete')) {
            $facility = Facility::findOrFail($id);
            $facility->delete();

            return redirect('admin/activities/' . $activityId . '/facilities')
                ->with('success', __('Activity facility deleted successfully.'));
        }

        if ($request->isMethod('post')) {
            if ($id) {
                $rules['name'] = [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('facilities', 'name')
                        ->where('name', $request->name)
                        ->where('table_id', $activityId)
                        ->where('table_type', 'activity')
                        ->ignore($id),
                ];
            } else {
                $rules['name'] = [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('facilities', 'name')
                        ->where('name', $request->name)
                        ->where('table_id', $activityId)
                        ->where('table_type', 'activity'),
                ];
            }

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return back()
                    ->withInput()
                    ->withErrors($validator);
            }

            $facility = Facility::findOrNew($id);
            $facility->table_id = $activityId;
            $facility->table_type = 'activity';
            $facility->name = $request->name;
            $facility->title = $request->title;
            $facility->sub_title = $request->sub_title;
            $facility->bottom_title = $request->bottom_title;
            $facility->save();

            Facility::where('table_id', $activityId)
                ->where('table_type', 'activity')
                ->update([
                    'title' => $facility->title,
                    'sub_title' => $facility->sub_title,
                    'bottom_title' => $facility->bottom_title,
                ]);

            return redirect('admin/activities/' . $activityId . '/facilities')
                ->with('success', __('Activity facility ' . ($id ? 'updated' : 'saved') . ' successfully.'));
        }

        $activity = Activities::findOrFail($activityId);
        $facility = Facility::find($id);

        $facilities = Facility::where('table_id', $activityId)
            ->where('table_type', 'activity')
            ->get();

        return view('admin.activities.facilities')->with(compact('activity', 'facility', 'facilities'));
    }



    public function quickBlocks(Request $request, $activityId, $id = null)
    {
        if ($request->isMethod('delete')) {
            $infoBlock = InfoBlocks::findOrFail($id);
            $infoBlock->delete();

            return redirect('admin/activities/' . $activityId . '/info-blocks')
                ->with('success', __('Activity info deleted successfully.'));
        }

        if ($request->isMethod('post')) {
            if ($id) {
                $rules['name'] = [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('info_blocks', 'name')
                        ->where('name', $request->name)
                        ->where('table_id', $activityId)
                        ->where('table_type', 'activity')
                        ->ignore($id),
                ];
            } else {
                $rules['name'] = [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('info_blocks', 'name')
                        ->where('name', $request->name)
                        ->where('table_id', $activityId)
                        ->where('table_type', 'activity'),
                ];
            }

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return back()
                    ->withInput()
                    ->withErrors($validator);
            }

            $infoBlock = InfoBlocks::findOrNew($id);
            $infoBlock->table_id = $activityId;
            $infoBlock->table_type = 'activity';
            $infoBlock->name = $request->name;
            $infoBlock->description = $request->description;
            $infoBlock->icon = $request->icon;
            $infoBlock->save();

            return redirect('admin/activities/' . $activityId . '/info-blocks')
                ->with('success', __('Activity Info ' . ($id ? 'updated' : 'saved') . ' successfully.'));
        }

        $activity = Activities::findOrFail($activityId);

        $infoBlock = InfoBlocks::find($id);

        $infoBlocks = InfoBlocks::where('table_id', $activityId)
            ->where('table_type', 'activity')
            ->get();

        return view('admin.activities.info-blocks')->with(compact('activity', 'infoBlock', 'infoBlocks'));
    }

    public function highlights(Request $request, $activityId, $id = null)
    {
        if ($request->isMethod('delete')) {
            $highlight = Highlights::findOrFail($id);
            $highlight->delete();

            return redirect('admin/activities/' . $activityId . '/highlights')
                ->with('success', __('Activity Highlight deleted successfully.'));
        }

        if ($request->isMethod('post')) {
            if ($id) {
                $rules['description'] = [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('highlights', 'description')
                        ->where('table_id', $activityId)
                        ->where('table_name', 'activity')
                        ->ignore($id),
                ];
            } else {
                $rules['description'] = [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('highlights', 'description')
                        ->where('table_id', $activityId)
                        ->where('table_name', 'activity'),
                ];
            }

            $rules['icon'] = 'nullable|string|max:255';
            $rules['title'] = 'nullable|string|max:255';
            $rules['sub_title'] = 'nullable|string|max:255';
            $rules['bottom_title'] = 'nullable|string|max:255';

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return back()
                    ->withInput()
                    ->withErrors($validator);
            }

            Highlights::where('table_id', $activityId)
                ->where('table_name', 'activity')
                ->update([
                    'title' => $request->title,
                    'sub_title' => $request->sub_title,
                    'bottom_title' => $request->bottom_title
                ]);

            $highlight = Highlights::findOrNew($id);
            $highlight->table_id = $activityId;
            $highlight->table_name = 'activity';
            $highlight->description = $request->description;
            $highlight->icon = $request->icon;
            $highlight->title = $request->title;
            $highlight->sub_title = $request->sub_title;
            $highlight->bottom_title = $request->bottom_title;
            $highlight->save();

            return redirect('admin/activities/' . $activityId . '/highlights')
                ->with('success', __('Activity highlight ' . ($id ? 'updated' : 'saved') . ' successfully.'));
        }

        $activity = Activities::findOrFail($activityId);
        $highlight = Highlights::find($id);
        $highlights = Highlights::where('table_id', $activityId)
            ->where('table_name', 'activity')
            ->get();

        return view('admin.activities.highlights')->with(compact('activity', 'highlight', 'highlights'));
    }


    public function faqs(Request $request, $activityId, $id = null)
    {
        if ($request->isMethod('delete')) {
            $faq = Faq::findOrFail($id);
            $faq->delete();

            return redirect('admin/activities/' . $activityId . '/faqs')
                ->with('success', __('Activity faq deleted successfully.'));
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
                        ->where('table_id', $activityId)
                        ->where('table_type', 'activity')
                        ->ignore($id),
                ];
            } else {
                $rules['question'] = [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('faqs', 'question')
                        ->where('question', $request->question)
                        ->where('table_id', $activityId)
                        ->where('table_type', 'activity'),
                ];
            }

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return back()
                    ->withInput()
                    ->withErrors($validator);
            }

            $faq = Faq::findOrNew($id);
            $faq->table_id = $activityId;
            $faq->table_type = 'activity';
            $faq->question = $request->question;
            $faq->answer = $request->answer;
            $faq->save();
            return redirect('admin/activities/' . $activityId . '/faqs')
                ->with('success', __('Activity faq ' . ($id ? 'updated' : 'saved') . ' successfully.'));
        }

        $activity = Activities::findOrFail($activityId);

        $faq = Faq::find($id);


        $faqs = Faq::where('table_id', $activityId)
            ->where('table_type', 'activity')
            ->get();

        return view('admin.activities.faqs')->with(compact('activity', 'faq', 'faqs'));
    }

    public function reviews(Request $request, $activityId, $id = null)
    {
        if ($request->isMethod('delete')) {
            $review = Review::findOrFail($id);
            $review->delete();

            return redirect('admin/activities/' . $activityId . '/reviews')
                ->with('success', __('Activity review deleted successfully.'));
        }

        if ($request->isMethod('post')) {
            if ($id) {
                $rules['name'] = [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('reviews', 'name')
                        ->where('name', $request->name)
                        ->where('table_id', $activityId)
                        ->where('table_type', 'activity')
                        ->ignore($id),
                ];
            } else {
                $rules['name'] = [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('reviews', 'name')
                        ->where('name', $request->name)
                        ->where('table_id', $activityId)
                        ->where('table_type', 'activity'),
                ];
            }
            $rules['address'] = 'required|string|max:255';
            $rules['review'] = 'required|string';

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return back()
                    ->withInput()
                    ->withErrors($validator);
            }

            $review = Review::findOrNew($id);
            $review->table_id = $activityId;
            $review->table_type = 'activity';
            $review->name = $request->name;
            $review->address = $request->address;
            $review->review = $request->review;
            $review->save();

            return redirect('admin/activities/' . $activityId . '/reviews')
                ->with('success', __('Activity review ' . ($id ? 'updated' : 'saved') . ' successfully.'));
        }

        $activity = Activities::findOrFail($activityId);

        $review = Review::find($id);

        $reviews = Review::where('table_id', $activityId)
            ->where('table_type', 'activity')
            ->get();

        return view('admin.activities.reviews')->with(compact('activity', 'review', 'reviews'));
    }

    public function overview(Request $request, $id)
    {
        $activity = Activities::findOrFail($id);

        if ($request->isMethod('put')) {
            $request->validate([
                'content' => 'required|string',
            ]);

            $activity->overview = $request->input('content');
            $activity->save();

            return redirect()->back()->with('success', 'Overview updated successfully.');
        }

        return view('admin.activities.overview', compact('activity'));
    }

    public function contentBlock(Request $request, $activityId, $id = null)
    {
        // Handle DELETE
        if ($request->isMethod('delete')) {
            $deleteId = $request->route('id') ?? $request->input('delete_id');
            $contentBlock = ContentBlocks::where('activity_id', $activityId)->where('id', $deleteId)->first();

            if ($contentBlock) {
                $contentBlock->delete();
                Log::info('Deleted content block', ['activity_id' => $activityId, 'id' => $deleteId]);
                return redirect("admin/activities/$activityId/content-blocks/")->with('success', 'Content block deleted successfully!');
            }

            Log::warning('Content block not found for deletion', ['activity_id' => $activityId, 'id' => $deleteId]);
            return redirect("admin/activities/$activityId/content-blocks/")->with('error', 'Content block not found.');
        }

        // Handle POST (create or update)
        if ($request->isMethod('post')) {
            $request->validate([
                'layout' => 'required|string',
                'title' => 'required|string',
                'desc' => 'nullable|string',
                'columns_data' => 'required|array'
            ]);

            Log::info('Form input received', $request->all());

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

            Log::info('Prepared content block for saving', $block);

            if ($id) {
                $contentBlock = ContentBlocks::where('activity_id', $activityId)->where('id', $id)->first();
                if ($contentBlock) {
                    $contentBlock->update([
                        'type' => 'activity',
                        'layout' => $request->layout,
                        'title' => $request->title,
                        'description' => $request->desc,
                        'column' => count($request->columns_data),
                        'section_blocks' => [$block],
                    ]);
                    Log::info('Updated existing content block', ['id' => $id]);
                }
            } else {
                ContentBlocks::create([
                    'type' => 'activity',
                    'activity_id' => $activityId,
                    'layout' => $request->layout,
                    'title' => $request->title,
                    'description' => $request->desc,
                    'column' => count($request->columns_data),
                    'section_blocks' => [$block],
                ]);
                Log::info('Created new content block', ['activity_id' => $activityId]);
            }

            return redirect("admin/activities/$activityId/content-blocks/")->with('success', 'Content block saved successfully!');
        }

        // Handle GET (edit/view)
        $block = null;
        if ($id) {
            $block = ContentBlocks::where('activity_id', $activityId)->where('id', $id)->first();
            Log::info('Fetching single content block', ['activity_id' => $activityId, 'id' => $id]);
        }


        $blocks = ContentBlocks::where('activity_id', $activityId)->get();
        Log::info('Fetched all content blocks for activity', ['activity_id' => $activityId]);
        $activity = Activities::find($activityId);
        return view('admin.activities.content-blocks', [
            'blocks' => $blocks,
            'block' => $block,
            'activityId' => $activityId,
            'activity' => $activity,
        ]);
    }





    public function daySchedule(Request $request, $activityId, $id = null)
    {
        if ($request->isMethod('delete')) {
            $daySchedule = activityDaySchedule::findOrFail($id);
            $daySchedule->delete();

            return redirect('admin/activities/' . $activityId . '/day-schedules')
                ->with('success', __('Activity schedule deleted successfully.'));
        }

        if ($request->isMethod('post')) {
            $rules = [
                'heading' => 'required|string|max:255',
                'time_slot' => 'required|string|max:255',
                'title' => 'required|string|max:255',
                'description' => 'required|string',
            ];

            if ($id) {
                $rules['time_slot'] = [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('activity_day_schedules', 'time_slot')
                        ->where('activity_id', $activityId)
                        ->ignore($id),
                ];
            } else {
                $rules['time_slot'] = [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('activity_day_schedules', 'time_slot')
                        ->where('activity_id', $activityId),
                ];
            }

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return back()
                    ->withInput()
                    ->withErrors($validator);
            }

            activityDaySchedule::where('activity_id', $activityId)->update([
                'heading' => $request->heading
            ]);

            $daySchedule = activityDaySchedule::findOrNew($id);
            $daySchedule->activity_id = $activityId;
            $daySchedule->heading = $request->heading;
            $daySchedule->time_slot = $request->time_slot;
            $daySchedule->title = $request->title;
            $daySchedule->description = $request->description;
            $daySchedule->save();

            return redirect('admin/activities/' . $activityId . '/day-schedules')
                ->with('success', __('Activity Schedule ' . ($id ? 'updated' : 'saved') . ' successfully.'));
        }

        $activity = Activities::findOrFail($activityId);
        $daySchedule = activityDaySchedule::find($id);
        $daySchedules = activityDaySchedule::where('activity_id', $activityId)->get();

        return view('admin.activities.day-schedule')->with(compact('activity', 'daySchedule', 'daySchedules'));
    }


    public function metaTags(Request $request, $activityId)
    {
        $activity = Activities::with('meta')->findOrFail($activityId);

        $meta = $activity->meta;


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
                $meta->table_type = 'activity';
                $meta->table_id = $activityId;
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

            return redirect('admin/activities/' . $activityId . '/meta-headings')
                ->with('success', __('Category meta information saved successfully.'));
        }
        return view('admin.activities.meta-headings', compact('activity', 'meta'));
    }
    public function Slots(Request $request, $activityId, $id = null)
    {
        if ($request->isMethod('post')) {
            $validated = $request->validate([
                'slot_start' => 'required|date_format:H:i',
                'slot_end' => 'required|date_format:H:i|after:slot_start',
                'duration' => 'required|numeric|min:1',
            ]);

            // Allow only ONE slot per activity (create or update existing)
            $slot = ActivitySlots::where('activityid', $activityId)->first();

            if ($id) {
                $slot = ActivitySlots::findOrFail($id);
            }

            if (!$slot) {
                $slot = new ActivitySlots;
            }

            $slot->activityid = $activityId;
            $slot->slot_start = $validated['slot_start'];
            $slot->slot_end = $validated['slot_end'];
            $slot->duration = $validated['duration'];
            $slot->status = 1;
            $slot->save();

            return redirect()->back()->with('success', $id ? 'Slot updated.' : 'Slot created.');
        }

        if ($request->isMethod('delete')) {
            ActivitySlots::where('id', $id)->delete();
            return redirect()->back()->with('success', 'Slot deleted.');
        }

        // Fetch only one slot per activity
        $slot = ActivitySlots::where('activityid', $activityId)->first();
        $slots = $slot ? [$slot] : [];
        $activity = Activities::find($activityId);

        return view('admin.activities.slots', compact('slots', 'slot', 'activityId', 'activity'));
    }

    public function changeStatus($id)
    {
        $activity = Activities::findorfail($id);
        $currentStatus = $activity->live_booking;
        $newStatus = $currentStatus == 1 ? 0 : 1;
        $activity->update(['live_booking' => $newStatus]);
        return response()->json($newStatus);
    }
}