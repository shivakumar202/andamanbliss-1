<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
use App\Models\Review;

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
        $tours = Service::with('category')
            ->where('type', 'tour')
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
        $selectedAddons = [];

        return view('admin.tours.create')->with(compact('categories', 'addons', 'selectedAddons'));
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
                Rule::unique('services', 'name')
                    ->where('name', $request->name)
                    ->where('type', 'tour')
                    ->where('category_id', $request->category_id),
            ],
            'category_id' => 'required|numeric|integer',
            'adult_rate' => 'required|numeric|decimal:2',
            'adult_price' => 'required|numeric|decimal:2',
            'adult_fees' => 'required|numeric|decimal:2',
            'child_rate' => 'required|numeric|decimal:2',
            'child_price' => 'required|numeric|decimal:2',
            'child_fees' => 'required|numeric|decimal:2',
            'add_ons' => 'nullable|array',
            'title' => 'nullable|string|max:255',
            'address' => 'required|string|max:255',
            'gmap' => 'nullable|string|max:255|url:http,https',
            'ratings' => 'required|numeric|integer|between:1,5',
            'reviews_count' => 'required|numeric|integer',
            'meta_schema' => 'nullable|string',
            'status' => 'required|string|max:255|in:active,inactive',
            'og_title' => 'nullable|sometimes|string',
            'og_description' => 'nullable|sometimes|string',
            'og_type' => 'nullable|sometimes|string',
            'og_image' => 'nullable|sometimes|string',
            'og_site' => 'nullable|sometimes|string',
            'twitter_card' => 'nullable|sometimes|string',
            'twitter_title' => 'nullable|sometimes|string',
            'twitter_desc' => 'nullable|sometimes|string',
            'twitter_image' => 'nullable|sometimes|string',
        ]);

        if ($validator->fails()) {
            return back()
                ->withInput()
                ->withErrors($validator);
        }

        $tour = new Service;
        $tour->name = $request->name;
        $tour->slug = Str::slug($request->name);
        $tour->type = 'tour';
        $tour->title = $request->title;
        $tour->category_id = $request->category_id;
        $tour->adult_rate = $request->adult_rate;
        $tour->adult_price = $request->adult_price;
        $tour->adult_fees = $request->adult_fees;
        $tour->child_rate = $request->child_rate;
        $tour->child_price = $request->child_price;
        $tour->child_fees = $request->child_fees;
        $tour->address = $request->address;
        $tour->gmap = $request->gmap;
        $tour->featured = $request->featured;
        $tour->best_seller = $request->best_seller;
        $tour->ratings = $request->ratings;
        $tour->reviews_count = $request->reviews_count;
        $tour->description = $request->description;
        $tour->meta_title = $request->meta_title;
        $tour->addons = $request->add_ons ? implode(',', $request->add_ons) : null;
        $tour->meta_keywords = $request->meta_keywords;
        $tour->meta_schema = $request->meta_schema;
        $tour->meta_description = $request->meta_description;
        $tour->status = $request->status;
        $tour->og_title     = $request->og_title;
        $tour->og_description     = $request->og_description;
        $tour->og_type     = $request->og_type;
        $tour->og_image     = $request->og_image;
        $tour->twitter_card     = $request->twitter_card;
        $tour->twitter_title    = $request->twitter_title;
        $tour->twitter_desc     = $request->twitter_desc;
        $tour->twitter_image = $request->twitter_image;
        $tour->save();

        return back()
            ->with('success', __('Tour saved successfully.'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $tour = Service::with('category')->findOrFail($id);
        $addons = Addon::where('type', 'tour')->get();
        return view('admin.tours.show')->with(compact('tour', 'addons'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $tour = Service::with('addon')->findOrFail($id);
        $addons = Addon::where('type', 'tour')->get();
        $categories = Category::where('type', 'tour')->get();
        $selectedAddons = $tour->addons ? explode(',', $tour->addons) : [];
        return view('admin.tours.create')->with(compact('tour', 'categories', 'addons', 'selectedAddons'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('services', 'name')
                    ->where('name', $request->name)
                    ->where('type', 'tour')
                    ->where('category_id', $request->category_id)
                    ->ignore($id),
            ],
            'category_id' => 'required|numeric|integer',
            'adult_rate' => 'required|numeric|decimal:2',
            'adult_price' => 'required|numeric|decimal:2',
            'adult_fees' => 'required|numeric|decimal:2',
            'child_rate' => 'required|numeric|decimal:2',
            'add_ons' => 'nullable|array',
            'child_price' => 'required|numeric|decimal:2',
            'child_fees' => 'required|numeric|decimal:2',
            'address' => 'required|string|max:255',
            'title' => 'nullable|string|max:255',
            'gmap' => 'nullable|string|max:255|url:http,https',
            'ratings' => 'required|numeric|integer|between:1,5',
            'reviews_count' => 'required|numeric|integer',
            'meta_schema' => 'nullable|string',
            'status' => 'required|string|max:255|in:active,inactive',
            'og_title' => 'nullable|sometimes|string',
            'og_description' => 'nullable|sometimes|string',
            'og_type' => 'nullable|sometimes|string',
            'og_image' => 'nullable|sometimes|string',
            'og_site' => 'nullable|sometimes|string',
            'twitter_card' => 'nullable|sometimes|string',
            'twitter_title' => 'nullable|sometimes|string',
            'twitter_desc' => 'nullable|sometimes|string',
            'twitter_image' => 'nullable|sometimes|string',
        ]);
        if ($validator->fails()) {
            return back()
                ->withInput()
                ->withErrors($validator);
        }

        $tour = Service::find($id);
        $tour->name = $request->name;
        $tour->slug = Str::slug($request->name);
        $tour->type = 'tour';
        $tour->title = $request->title;
        $tour->category_id = $request->category_id;
        $tour->adult_rate = $request->adult_rate;
        $tour->addons = $request->add_ons ? implode(',', $request->add_ons) : null;
        $tour->adult_price = $request->adult_price;
        $tour->adult_fees = $request->adult_fees;
        $tour->child_rate = $request->child_rate;
        $tour->child_price = $request->child_price;
        $tour->child_fees = $request->child_fees;
        $tour->address = $request->address;
        $tour->gmap = $request->gmap;
        $tour->featured = $request->featured;
        $tour->best_seller = $request->best_seller;
        $tour->ratings = $request->ratings;
        $tour->reviews_count = $request->reviews_count;
        $tour->description = $request->description;
        $tour->meta_title = $request->meta_title;
        $tour->meta_keywords = $request->meta_keywords;
        $tour->meta_schema = $request->meta_schema;
        $tour->meta_description = $request->meta_description;
        $tour->status = $request->status;
        $tour->og_title = $request->og_title; 
            $tour->og_description = $request->og_description; 
            $tour->og_type = $request->og_type; 
            $tour->og_image = $request->og_image; 
            $tour->og_site = $request->og_site; 
            $tour->twitter_card = $request->twitter_card; 
            $tour->twitter_title = $request->twitter_title; 
            $tour->twitter_desc = $request->twitter_desc; 
            $tour->twitter_image = $request->twitter_image; 
        $tour->save();

        return back()
            ->with('success', __('Tour updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tour = Service::findOrFail($id);

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

        $tour = Service::findOrFail($tourId);

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

            return redirect('admin/tours/' . $tourId . '/facilities')
                ->with('success', __('Tour facility deleted successfully.'));
        }

        if ($request->isMethod('post')) {
            if ($id) {
                $rules['name'] = [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('facilities', 'name')
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
                    Rule::unique('facilities', 'name')
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

            $facility = Facility::findOrNew($id);
            $facility->table_id = $tourId;
            $facility->table_type = 'tour';
            $facility->name = $request->name;
            $facility->save();

            return redirect('admin/tours/' . $tourId . '/facilities')
                ->with('success', __('Tour facility ' . ($id ? 'updated' : 'saved') . ' successfully.'));
        }

        $tour = Service::findOrFail($tourId);

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

        $tour = Service::findOrFail($tourId);

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

            return redirect('admin/tours/' . $tourId . '/reviews')
                ->with('success', __('Tour review deleted successfully.'));
        }

        if ($request->isMethod('post')) {
            if ($id) {
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
            } else {
                $rules['name'] = [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('reviews', 'name')
                        ->where('name', $request->name)
                        ->where('table_id', $tourId)
                        ->where('table_type', 'tour'),
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
            $review->table_id = $tourId;
            $review->table_type = 'tour';
            $review->name = $request->name;
            $review->address = $request->address;
            $review->review = $request->review;
            $review->save();

            return redirect('admin/tours/' . $tourId . '/reviews')
                ->with('success', __('Tour review ' . ($id ? 'updated' : 'saved') . ' successfully.'));
        }

        $tour = Service::findOrFail($tourId);

        $review = Review::find($id);

        $reviews = Review::where('table_id', $tourId)
            ->where('table_type', 'tour')
            ->get();

        return view('admin.tours.reviews')->with(compact('tour', 'review', 'reviews'));
    }
}
