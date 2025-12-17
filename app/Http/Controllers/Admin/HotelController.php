<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Addon;
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
use App\Models\Policy;
use App\Models\Faq;
use App\Models\Review;
use App\Models\HotelRoomType;

class HotelController extends Controller
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
        $hotels = Service::with('category')
            ->where('type', 'hotel')
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

        $categories = Category::where('type', 'hotel')->get();

        return view('admin.hotels.index')->with(compact('hotels', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('type', 'hotel')->get();
        $addons = Addon::where('type', 'hotel')->get();
        $selectedAddons = [];
        return view('admin.hotels.create')->with(compact('categories','addons','selectedAddons'));
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
                    ->where('type', 'hotel')
                    ->where('category_id', $request->category_id),
            ],
            'category_id' => 'required|numeric|integer',
            'address' => 'required|string|max:255',
            'gmap' => 'required|string|max:255|url:http,https',
            'ratings' => 'required|numeric|integer|between:1,5',
            'add_ons' => 'nullable|array',
            'reviews_count' => 'required|numeric|integer',
            'status' => 'required|string|max:255|in:active,inactive',
        ]);

        if ($validator->fails()) {
            return back()
                ->withInput()
                ->withErrors($validator);
        }

        $hotel = new Service;
        $hotel->name = $request->name;
        $hotel->slug = Str::slug($request->name);
        $hotel->type = 'hotel';
        $hotel->category_id = $request->category_id;
        $hotel->address = $request->address;
        $hotel->gmap = $request->gmap;
        $hotel->featured = $request->featured;
        $hotel->best_seller = $request->best_seller;
        $hotel->ratings = $request->ratings;
        $hotel->reviews_count = $request->reviews_count;
        $hotel->description = $request->description;
        $hotel->addons = $request->add_ons ? implode(',', $request->add_ons) : null;
        $hotel->meta_title = $request->meta_title;
        $hotel->meta_keywords = $request->meta_keywords;
        $hotel->meta_description = $request->meta_description;
        $hotel->status = $request->status;
        $hotel->save();

        return back()
            ->with('success', __('Hotel saved successfully.'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $hotel = Service::with('category')->findOrFail($id);

        return view('admin.hotels.show')->with(compact('hotel'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $hotel = Service::findOrFail($id);
        $addons = Addon::where('type', 'hotel')->get();
        $categories = Category::where('type', 'hotel')->get();
        $selectedAddons = $hotel->addons ? explode(',', $hotel->addons) : [];
        return view('admin.hotels.create')->with(compact('hotel', 'categories','selectedAddons','addons'));
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
                    ->where('type', 'hotel')
                    ->where('category_id', $request->category_id)
                    ->ignore($id),
            ],
            'category_id' => 'required|numeric|integer',
            'address' => 'required|string|max:255',
            'gmap' => 'required|string|max:255|url:http,https',
            'add_ons' => 'nullable|array',
            'ratings' => 'required|numeric|integer|between:1,5',
            'reviews_count' => 'required|numeric|integer',
            'status' => 'required|string|max:255|in:active,inactive',
        ]);

        if ($validator->fails()) {
            return back()
                ->withInput()
                ->withErrors($validator);
        }

        $hotel = Service::find($id);
        $hotel->name = $request->name;
        $hotel->slug = Str::slug($request->name);
        $hotel->type = 'hotel';
        $hotel->category_id = $request->category_id;
        $hotel->address = $request->address;
        $hotel->gmap = $request->gmap;
        $hotel->featured = $request->featured;
        $hotel->best_seller = $request->best_seller;
        $hotel->ratings = $request->ratings;
        $hotel->addons = $request->add_ons ? implode(',', $request->add_ons) : null;
        $hotel->reviews_count = $request->reviews_count;
        $hotel->description = $request->description;
        $hotel->meta_title = $request->meta_title;
        $hotel->meta_keywords = $request->meta_keywords;
        $hotel->meta_description = $request->meta_description;
        $hotel->status = $request->status;
        $hotel->save();

        return back()
            ->with('success', __('Hotel updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $hotel = Service::findOrFail($id);

        HotelRoomType::where('hotel_id', $id)->delete();

        Facility::where('table_id', $id)
            ->where('table_type', 'hotel')
            ->delete();

        Policy::where('table_id', $id)
            ->where('table_type', 'hotel')
            ->delete();

        Faq::where('table_id', $id)
            ->where('table_type', 'hotel')
            ->delete();

        Review::where('table_id', $id)
            ->where('table_type', 'hotel')
            ->delete();

        Drive::where('table_id', $id)
            ->where('table_type', 'hotel_photo')
            ->where('file_type', 'image')
            ->delete();

        $hotel->delete();

        return back()
            ->with('success', __('Hotel deleted successfully.'));
    }

    public function images(Request $request, $hotelId, $id = null)
    {
        $path = 'hotel_photo';

        if ($request->isMethod('delete')) {
            $drive = Drive::findOrFail($id);
            $drive->delete();

            return redirect('admin/hotels/' . $hotelId. '/images')
                ->with('success', __('Hotel image deleted successfully.'));
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
                // $path = 'hotel_photo';
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
                $drive->table_id = $hotelId;
                $drive->table_type = $path;
                $drive->file_name = $fileName;
                $drive->file_type = 'image';
                $drive->save();
            }

            return redirect('admin/hotels/' . $hotelId . '/images')
                ->with('success', __('Hotel image ' . ($id ? 'updated' : 'saved') . ' successfully.'));
        }

        $hotel = Service::findOrFail($hotelId);

        $drive = Drive::find($id);

        $drives = Drive::where('table_id', $hotelId)
            ->where('table_type', $path)
            ->where('file_type', 'image')
            ->get();

        return view('admin.hotels.images')->with(compact('hotel', 'drive', 'drives'));
    }

    public function roomtypes(Request $request, $hotelId, $id = null)
    {
        if ($request->isMethod('delete')) {
            $roomType = HotelRoomType::findOrFail($id);
            $roomType->delete();

            return redirect('admin/hotels/' . $hotelId . '/roomtypes')
                ->with('success', __('Hotel roomtype deleted successfully.'));
        }

        if ($request->isMethod('post')) {
            if ($id) {
                $rules['name'] = [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('hotel_room_types', 'name')
                        ->where('name', $request->name)
                        ->where('hotel_id', $hotelId)
                        ->ignore($id),
                ];
            } else {
                $rules['name'] = [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('hotel_room_types', 'name')
                        ->where('name', $request->name)
                        ->where('hotel_id', $hotelId),
                ];
            }
            $rules['breakfast_rate'] = 'required|numeric|decimal:2';
            $rules['breakfast_price'] = 'required|numeric|decimal:2';
            $rules['breakfast_fees'] = 'required|numeric|decimal:2';
            $rules['dinner_rate'] = 'required|numeric|decimal:2';
            $rules['dinner_price'] = 'required|numeric|decimal:2';
            $rules['dinner_fees'] = 'required|numeric|decimal:2';
            $rules['lunch_rate'] = 'required|numeric|decimal:2';
            $rules['lunch_price'] = 'required|numeric|decimal:2';
            $rules['lunch_fees'] = 'required|numeric|decimal:2';

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return back()
                    ->withInput()
                    ->withErrors($validator);
            }

            $roomType = HotelRoomType::findOrNew($id);
            $roomType->hotel_id = $hotelId;
            $roomType->name = $request->name;
            $roomType->breakfast_rate = $request->breakfast_rate;
            $roomType->breakfast_price = $request->breakfast_price;
            $roomType->breakfast_fees = $request->breakfast_fees;
            $roomType->dinner_rate = $request->dinner_rate;
            $roomType->dinner_price = $request->dinner_price;
            $roomType->dinner_fees = $request->dinner_fees;
            $roomType->lunch_rate = $request->lunch_rate;
            $roomType->lunch_price = $request->lunch_price;
            $roomType->lunch_fees = $request->lunch_fees;
            $roomType->save();

            return redirect('admin/hotels/' . $hotelId . '/roomtypes')
                ->with('success', __('Hotel roomtype ' . ($id ? 'updated' : 'saved') . ' successfully.'));
        }

        $hotel = Service::findOrFail($hotelId);

        $roomType = HotelRoomType::find($id);

        $roomTypes = HotelRoomType::where('hotel_id', $hotelId)->get();

        return view('admin.hotels.roomtypes')->with(compact('hotel', 'roomType', 'roomTypes'));
    }

    public function facilities(Request $request, $hotelId, $id = null)
    {
        if ($request->isMethod('delete')) {
            $facility = Facility::findOrFail($id);
            $facility->delete();

            return redirect('admin/hotels/' . $hotelId . '/facilities')
                ->with('success', __('Hotel facility deleted successfully.'));
        }

        if ($request->isMethod('post')) {
            if ($id) {
                $rules['name'] = [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('facilities', 'name')
                    ->where('name', $request->name)
                        ->where('table_id', $hotelId)
                        ->where('table_type', 'hotel')
                        ->ignore($id),
                ];
            } else {
                $rules['name'] = [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('facilities', 'name')
                    ->where('name', $request->name)
                        ->where('table_id', $hotelId)
                        ->where('table_type', 'hotel'),
                ];
            }

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return back()
                    ->withInput()
                    ->withErrors($validator);
            }

            $facility = Facility::findOrNew($id);
            $facility->table_id = $hotelId;
            $facility->table_type = 'hotel';
            $facility->name = $request->name;
            $facility->save();

            return redirect('admin/hotels/' . $hotelId . '/facilities')
                ->with('success', __('Hotel facility ' . ($id ? 'updated' : 'saved') . ' successfully.'));
        }

        $hotel = Service::findOrFail($hotelId);

        $facility = Facility::find($id);

        $facilities = Facility::where('table_id', $hotelId)
            ->where('table_type', 'hotel')
            ->get();

        return view('admin.hotels.facilities')->with(compact('hotel', 'facility', 'facilities'));
    }

    public function policies(Request $request, $hotelId, $id = null)
    {
        if ($request->isMethod('delete')) {
            $policy = Policy::findOrFail($id);
            $policy->delete();

            return redirect('admin/hotels/' . $hotelId . '/policies')
                ->with('success', __('Hotel policy deleted successfully.'));
        }

        if ($request->isMethod('post')) {
            if ($id) {
                $rules['name'] = [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('policies', 'name')
                    ->where('name', $request->name)
                        ->where('table_id', $hotelId)
                        ->where('table_type', 'hotel')
                        ->ignore($id),
                ];
            } else {
                $rules['name'] = [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('policies', 'name')
                    ->where('name', $request->name)
                        ->where('table_id', $hotelId)
                        ->where('table_type', 'hotel'),
                ];
            }

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return back()
                    ->withInput()
                    ->withErrors($validator);
            }

            $policy = Policy::findOrNew($id);
            $policy->table_id = $hotelId;
            $policy->table_type = 'hotel';
            $policy->name = $request->name;
            $policy->save();

            return redirect('admin/hotels/' . $hotelId . '/policies')
                ->with('success', __('Hotel policy ' . ($id ? 'updated' : 'saved') . ' successfully.'));
        }

        $hotel = Service::findOrFail($hotelId);

        $policy = Policy::find($id);

        $policies = Policy::where('table_id', $hotelId)
            ->where('table_type', 'hotel')
            ->get();

        return view('admin.hotels.policies')->with(compact('hotel', 'policy', 'policies'));
    }

    public function faqs(Request $request, $hotelId, $id = null)
    {
        if ($request->isMethod('delete')) {
            $faq = Faq::findOrFail($id);
            $faq->delete();

            return redirect('admin/hotels/' . $hotelId . '/faqs')
                ->with('success', __('Hotel faq deleted successfully.'));
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
                        ->where('table_id', $hotelId)
                        ->where('table_type', 'hotel')
                        ->ignore($id),
                ];
            } else {
                $rules['question'] = [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('faqs', 'question')
                    ->where('question', $request->question)
                        ->where('table_id', $hotelId)
                        ->where('table_type', 'hotel'),
                ];
            }

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return back()
                    ->withInput()
                    ->withErrors($validator);
            }

            $faq = Faq::findOrNew($id);
            $faq->table_id = $hotelId;
            $faq->table_type = 'hotel';
            $faq->question = $request->question;
            $faq->answer = $request->answer;
            $faq->save();

            return redirect('admin/hotels/' . $hotelId . '/faqs')
                ->with('success', __('Hotel faq ' . ($id ? 'updated' : 'saved') . ' successfully.'));
        }

        $hotel = Service::findOrFail($hotelId);

        $faq = Faq::find($id);

        $faqs = Faq::where('table_id', $hotelId)
            ->where('table_type', 'hotel')
            ->get();

        return view('admin.hotels.faqs')->with(compact('hotel', 'faq', 'faqs'));
    }

    public function reviews(Request $request, $hotelId, $id = null)
    {
        if ($request->isMethod('delete')) {
            $review = Review::findOrFail($id);
            $review->delete();

            return redirect('admin/hotels/' . $hotelId . '/reviews')
                ->with('success', __('Hotel review deleted successfully.'));
        }

        if ($request->isMethod('post')) {
            if ($id) {
                $rules['name'] = [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('reviews', 'name')
                    ->where('name', $request->name)
                        ->where('table_id', $hotelId)
                        ->where('table_type', 'hotel')
                        ->ignore($id),
                ];
            } else {
                $rules['name'] = [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('reviews', 'name')
                    ->where('name', $request->name)
                        ->where('table_id', $hotelId)
                        ->where('table_type', 'hotel'),
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
            $review->table_id = $hotelId;
            $review->table_type = 'hotel';
            $review->name = $request->name;
            $review->address = $request->address;
            $review->review = $request->review;
            $review->save();

            return redirect('admin/hotels/' . $hotelId . '/reviews')
                ->with('success', __('Hotel review ' . ($id ? 'updated' : 'saved') . ' successfully.'));
        }

        $hotel = Service::findOrFail($hotelId);

        $review = Review::find($id);

        $reviews = Review::where('table_id', $hotelId)
            ->where('table_type', 'hotel')
            ->get();

        return view('admin.hotels.reviews')->with(compact('hotel', 'review', 'reviews'));
    }
}