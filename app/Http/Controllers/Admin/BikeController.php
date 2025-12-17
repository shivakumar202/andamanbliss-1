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
use App\Models\Pricing;
use App\Models\Review;

class BikeController extends Controller
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
        $bikes = Service::with('category')
            ->where('type', 'bike')
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
            foreach ($bikes as $bike) {
                if ($bike->addons) {
                    $addonIds = explode(',', $bike->addons); 
                    $bike->addon_names = Addon::whereIn('id', $addonIds)->pluck('name')->toArray();
                }
            }
        $categories = Category::where('type', 'bike')->get();

        return view('admin.bikes.index')->with(compact('bikes', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('type', 'bike')->get();
        $addons = Addon::where('type', 'bike')->get();
        $selectedAddons = [];
        return view('admin.bikes.create')->with(compact('categories','addons','selectedAddons'));
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
                    ->where('type', 'bike')
                    ->where('category_id', $request->category_id),
            ],
            'category_id' => 'required|numeric|integer',
            'adult_rate' => 'required|numeric|decimal:2',
            'adult_price' => 'required|numeric|decimal:2',
            'adult_fees' => 'required|numeric|decimal:2',
            'address' => 'required|string|max:255',
            'add_ons' => 'nullable|array',
            'gmap' => 'nullable|string|max:255|url:http,https',
            'ratings' => 'required|numeric|integer|between:1,5',
            'reviews_count' => 'required|numeric|integer',
            'status' => 'required|string|max:255|in:active,inactive',
        ]);

        if ($validator->fails()) {
            return back()
                ->withInput()
                ->withErrors($validator);
        }

        $bike = new Service;
        $bike->name = $request->name;
        $bike->slug = Str::slug($request->name);
        $bike->type = 'bike';
        $bike->category_id = $request->category_id;
        $bike->adult_rate = $request->adult_rate;
        $bike->adult_price = $request->adult_price;
        $bike->adult_fees = $request->adult_fees;
        $bike->address = $request->address;
        $bike->gmap = $request->gmap;
        $bike->featured = $request->featured;
        $bike->best_seller = $request->best_seller;
        $bike->ratings = $request->ratings;
        $bike->reviews_count = $request->reviews_count;
        $bike->description = $request->description;
        $bike->meta_title = $request->meta_title;
        $bike->addons = $request->add_ons ? implode(',', $request->add_ons) : null;
        $bike->meta_keywords = $request->meta_keywords;
        $bike->meta_description = $request->meta_description;
        $bike->status = $request->status;
        $bike->save();

        return back()
            ->with('success', __('Bike saved successfully.'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $bike = Service::with('category')->findOrFail($id);

        return view('admin.bikes.show')->with(compact('bike'));
    }



    public function pricing(Request $request, $bikeId, $id = null)
{
    if($request->isMethod('delete')) {
        $pricing = Pricing::find($id);
        $pricing->delete();

        return redirect('admin/bikes/'.$bikeId.'/pricing')->with('success', __('Bikes Pricing deleted successfull'));
    }
    if ($request->isMethod('post')) {
        $validator = Validator::make($request->all(), [
            'location' => 'required|string',
            'rate' => 'required|numeric',
            'price' => 'required|numeric',
            'fees' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

        Pricing::updateOrCreate(
            [
                'table_id' => $bikeId,
                'location' => $request->location,
            ],
            [
                'table_type' => 'bike',
                'rate' => $request->rate,
                'price' => $request->price,
                'fees' => $request->fees,
            ]
        );
        

        return redirect('admin/bikes/' . $bikeId . '/pricing')
            ->with('success', __('Bike Price ' . ($id ? 'updated' : 'saved') . ' successfully.'));
    }

    $bike = Service::findOrFail($bikeId);
    $pricing = Pricing::where('table_id', $bikeId)->where('table_type', 'bike')->get();

    return view('admin.bikes.pricing')->with(compact('bike', 'pricing'));
}


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $bike = Service::findOrFail($id);

        $categories = Category::where('type', 'bike')->get();
        $addons = Addon::where('type', 'bike')->get();
        $selectedAddons = $bike->addons ? explode(',', $bike->addons) : [];
        return view('admin.bikes.create')->with(compact('bike', 'categories','addons','selectedAddons'));
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
                    ->where('type', 'bike')
                    ->where('category_id', $request->category_id)
                    ->ignore($id),
            ],
            'category_id' => 'required|numeric|integer',
            'adult_rate' => 'required|numeric|decimal:2',
            'adult_price' => 'required|numeric|decimal:2',
            'adult_fees' => 'required|numeric|decimal:2',
            'address' => 'required|string|max:255',
            'add_ons' => 'nullable|array',
            'gmap' => 'nullable|string|max:255|url:http,https',
            'ratings' => 'required|numeric|integer|between:1,5',
            'reviews_count' => 'required|numeric|integer',
            'status' => 'required|string|max:255|in:active,inactive',
        ]);

        if ($validator->fails()) {
            return back()
                ->withInput()
                ->withErrors($validator);
        }

        $bike = Service::find($id);
        $bike->name = $request->name;
        $bike->slug = Str::slug($request->name);
        $bike->type = 'bike';
        $bike->category_id = $request->category_id;
        $bike->adult_rate = $request->adult_rate;
        $bike->adult_price = $request->adult_price;
        $bike->adult_fees = $request->adult_fees;
        $bike->address = $request->address;
        $bike->gmap = $request->gmap;
        $bike->featured = $request->featured;
        $bike->addons = $request->add_ons ? implode(',', $request->add_ons) : null;
        $bike->best_seller = $request->best_seller;
        $bike->ratings = $request->ratings;
        $bike->reviews_count = $request->reviews_count;
        $bike->description = $request->description;
        $bike->meta_title = $request->meta_title;
        $bike->meta_keywords = $request->meta_keywords;
        $bike->meta_description = $request->meta_description;
        $bike->status = $request->status;
        $bike->save();

        return back()
            ->with('success', __('Bike updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $bike = Service::findOrFail($id);

        Facility::where('table_id', $id)
            ->where('table_type', 'bike')
            ->delete();

        Policy::where('table_id', $id)
            ->where('table_type', 'bike')
            ->delete();

        Faq::where('table_id', $id)
            ->where('table_type', 'bike')
            ->delete();

        Review::where('table_id', $id)
            ->where('table_type', 'bike')
            ->delete();

        Drive::where('table_id', $id)
            ->where('table_type', 'bike_photo')
            ->where('file_type', 'image')
            ->delete();

        $bike->delete();

        return back()
            ->with('success', __('Bike deleted successfully.'));
    }

    public function images(Request $request, $bikeId, $id = null)
    {
        $path = 'bike_photo';

        if ($request->isMethod('delete')) {
            $drive = Drive::findOrFail($id);
            $drive->delete();

            return redirect('admin/bikes/' . $bikeId. '/images')
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
                $drive->table_id = $bikeId;
                $drive->table_type = $path;
                $drive->file_name = $fileName;
                $drive->file_type = 'image';
                $drive->save();
            }

            return redirect('admin/bikes/' . $bikeId . '/images')
                ->with('success', __('Bike image ' . ($id ? 'updated' : 'saved') . ' successfully.'));
        }

        $bike = Service::findOrFail($bikeId);

        $drive = Drive::find($id);

        $drives = Drive::where('table_id', $bikeId)
            ->where('table_type', $path)
            ->where('file_type', 'image')
            ->get();

        return view('admin.bikes.images')->with(compact('bike', 'drive', 'drives'));
    }

    public function facilities(Request $request, $bikeId, $id = null)
    {
        if ($request->isMethod('delete')) {
            $facility = Facility::findOrFail($id);
            $facility->delete();

            return redirect('admin/bikes/' . $bikeId . '/facilities')
                ->with('success', __('Bike facility deleted successfully.'));
        }

        if ($request->isMethod('post')) {
            if ($id) {
                $rules['name'] = [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('facilities', 'name')
                        ->where('name', $request->name)
                        ->where('table_id', $bikeId)
                        ->where('table_type', 'bike')
                        ->ignore($id),
                ];
            } else {
                $rules['name'] = [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('facilities', 'name')
                        ->where('name', $request->name)
                        ->where('table_id', $bikeId)
                        ->where('table_type', 'bike'),
                ];
            }
            $rules['value'] = 'required|string';

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return back()
                    ->withInput()
                    ->withErrors($validator);
            }

            $facility = Facility::findOrNew($id);
            $facility->table_id = $bikeId;
            $facility->table_type = 'bike';
            $facility->name = $request->name;
            $facility->value = $request->value;
            $facility->save();

            return redirect('admin/bikes/' . $bikeId . '/facilities')
                ->with('success', __('Bike facility ' . ($id ? 'updated' : 'saved') . ' successfully.'));
        }

        $bike = Service::findOrFail($bikeId);

        $facility = Facility::find($id);

        $facilities = Facility::where('table_id', $bikeId)
            ->where('table_type', 'bike')
            ->get();

        return view('admin.bikes.facilities')->with(compact('bike', 'facility', 'facilities'));
    }

    public function policies(Request $request, $bikeId, $id = null)
    {
        if ($request->isMethod('delete')) {
            $policy = Policy::findOrFail($id);
            $policy->delete();

            return redirect('admin/bikes/' . $bikeId . '/policies')
                ->with('success', __('Bike policy deleted successfully.'));
        }

        if ($request->isMethod('post')) {
            if ($id) {
                $rules['name'] = [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('policies', 'name')
                    ->where('name', $request->name)
                        ->where('table_id', $bikeId)
                        ->where('table_type', 'bike')
                        ->ignore($id),
                ];
            } else {
                $rules['name'] = [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('policies', 'name')
                    ->where('name', $request->name)
                        ->where('table_id', $bikeId)
                        ->where('table_type', 'bike'),
                ];
            }

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return back()
                    ->withInput()
                    ->withErrors($validator);
            }

            $policy = Policy::findOrNew($id);
            $policy->table_id = $bikeId;
            $policy->table_type = 'bike';
            $policy->name = $request->name;
            $policy->save();

            return redirect('admin/bikes/' . $bikeId . '/policies')
                ->with('success', __('Bike policy ' . ($id ? 'updated' : 'saved') . ' successfully.'));
        }

        $bike = Service::findOrFail($bikeId);

        $policy = Policy::find($id);

        $policies = Policy::where('table_id', $bikeId)
            ->where('table_type', 'bike')
            ->get();

        return view('admin.bikes.policies')->with(compact('bike', 'policy', 'policies'));
    }

    public function faqs(Request $request, $bikeId, $id = null)
    {
        if ($request->isMethod('delete')) {
            $faq = Faq::findOrFail($id);
            $faq->delete();

            return redirect('admin/bikes/' . $bikeId . '/faqs')
                ->with('success', __('Bike faq deleted successfully.'));
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
                        ->where('table_id', $bikeId)
                        ->where('table_type', 'bike')
                        ->ignore($id),
                ];
            } else {
                $rules['question'] = [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('faqs', 'question')
                    ->where('question', $request->question)
                        ->where('table_id', $bikeId)
                        ->where('table_type', 'bike'),
                ];
            }

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return back()
                    ->withInput()
                    ->withErrors($validator);
            }

            $faq = Faq::findOrNew($id);
            $faq->table_id = $bikeId;
            $faq->table_type = 'bike';
            $faq->question = $request->question;
            $faq->answer = $request->answer;
            $faq->save();

            return redirect('admin/bikes/' . $bikeId . '/faqs')
                ->with('success', __('Bike faq ' . ($id ? 'updated' : 'saved') . ' successfully.'));
        }

        $bike = Service::findOrFail($bikeId);

        $faq = Faq::find($id);

        $faqs = Faq::where('table_id', $bikeId)
            ->where('table_type', 'bike')
            ->get();

        return view('admin.bikes.faqs')->with(compact('bike', 'faq', 'faqs'));
    }

    public function reviews(Request $request, $bikeId, $id = null)
    {
        if ($request->isMethod('delete')) {
            $review = Review::findOrFail($id);
            $review->delete();

            return redirect('admin/bikes/' . $bikeId . '/reviews')
                ->with('success', __('Bike review deleted successfully.'));
        }

        if ($request->isMethod('post')) {
            if ($id) {
                $rules['name'] = [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('reviews', 'name')
                    ->where('name', $request->name)
                        ->where('table_id', $bikeId)
                        ->where('table_type', 'bike')
                        ->ignore($id),
                ];
            } else {
                $rules['name'] = [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('reviews', 'name')
                    ->where('name', $request->name)
                        ->where('table_id', $bikeId)
                        ->where('table_type', 'bike'),
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
            $review->table_id = $bikeId;
            $review->table_type = 'bike';
            $review->name = $request->name;
            $review->address = $request->address;
            $review->review = $request->review;
            $review->save();

            return redirect('admin/bikes/' . $bikeId . '/reviews')
                ->with('success', __('Bike review ' . ($id ? 'updated' : 'saved') . ' successfully.'));
        }

        $bike = Service::findOrFail($bikeId);

        $review = Review::find($id);

        $reviews = Review::where('table_id', $bikeId)
            ->where('table_type', 'bike')
            ->get();

        return view('admin.bikes.reviews')->with(compact('bike', 'review', 'reviews'));
    }
}