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
use App\Models\Policy;
use App\Models\Faq;
use App\Models\Review;

class CruiseController extends Controller
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
        $cruises = Service::with('category')
            ->where('type', 'cruise')
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

        $categories = Category::where('type', 'cruise')->get();

        return view('admin.cruises.index')->with(compact('cruises', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('type', 'cruise')->get();

        return view('admin.cruises.create')->with(compact('categories'));
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
                    ->where('type', 'cruise')
                    ->where('category_id', $request->category_id),
            ],
            'category_id' => 'required|numeric|integer',
            'adult_rate' => 'required|numeric|decimal:2',
            'adult_price' => 'required|numeric|decimal:2',
            'adult_fees' => 'required|numeric|decimal:2',
            'child_rate' => 'required|numeric|decimal:2',
            'child_price' => 'required|numeric|decimal:2',
            'child_fees' => 'required|numeric|decimal:2',
            'address' => 'required|string|max:255',
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

        $cruise = new Service;
        $cruise->name = $request->name;
        $cruise->slug = Str::slug($request->name);
        $cruise->type = 'cruise';
        $cruise->category_id = $request->category_id;
        $cruise->adult_rate = $request->adult_rate;
        $cruise->adult_price = $request->adult_price;
        $cruise->adult_fees = $request->adult_fees;
        $cruise->child_rate = $request->child_rate;
        $cruise->child_price = $request->child_price;
        $cruise->child_fees = $request->child_fees;
        $cruise->address = $request->address;
        $cruise->gmap = $request->gmap;
        $cruise->featured = $request->featured;
        $cruise->best_seller = $request->best_seller;
        $cruise->ratings = $request->ratings;
        $cruise->reviews_count = $request->reviews_count;
        $cruise->description = $request->description;
        $cruise->meta_title = $request->meta_title;
        $cruise->meta_keywords = $request->meta_keywords;
        $cruise->meta_description = $request->meta_description;
        $cruise->status = $request->status;
        $cruise->save();

        return back()
            ->with('success', __('Cruise saved successfully.'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $cruise = Service::with('category')->findOrFail($id);

        return view('admin.cruises.show')->with(compact('cruise'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $cruise = Service::findOrFail($id);

        $categories = Category::where('type', 'cruise')->get();

        return view('admin.cruises.create')->with(compact('cruise', 'categories'));
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
                    ->where('type', 'cruise')
                    ->where('category_id', $request->category_id)
                    ->ignore($id),
            ],
            'category_id' => 'required|numeric|integer',
            'adult_rate' => 'required|numeric|decimal:2',
            'adult_price' => 'required|numeric|decimal:2',
            'adult_fees' => 'required|numeric|decimal:2',
            'child_rate' => 'required|numeric|decimal:2',
            'child_price' => 'required|numeric|decimal:2',
            'child_fees' => 'required|numeric|decimal:2',
            'address' => 'required|string|max:255',
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

        $cruise = Service::find($id);
        $cruise->name = $request->name;
        $cruise->slug = Str::slug($request->name);
        $cruise->type = 'cruise';
        $cruise->category_id = $request->category_id;
        $cruise->adult_rate = $request->adult_rate;
        $cruise->adult_price = $request->adult_price;
        $cruise->adult_fees = $request->adult_fees;
        $cruise->child_rate = $request->child_rate;
        $cruise->child_price = $request->child_price;
        $cruise->child_fees = $request->child_fees;
        $cruise->address = $request->address;
        $cruise->gmap = $request->gmap;
        $cruise->featured = $request->featured;
        $cruise->best_seller = $request->best_seller;
        $cruise->ratings = $request->ratings;
        $cruise->reviews_count = $request->reviews_count;
        $cruise->description = $request->description;
        $cruise->meta_title = $request->meta_title;
        $cruise->meta_keywords = $request->meta_keywords;
        $cruise->meta_description = $request->meta_description;
        $cruise->status = $request->status;
        $cruise->save();

        return back()
            ->with('success', __('Cruise updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cruise = Service::findOrFail($id);

        Facility::where('table_id', $id)
            ->where('table_type', 'cruise')
            ->delete();

        Policy::where('table_id', $id)
            ->where('table_type', 'cruise')
            ->delete();

        Faq::where('table_id', $id)
            ->where('table_type', 'cruise')
            ->delete();

        Review::where('table_id', $id)
            ->where('table_type', 'cruise')
            ->delete();

        Drive::where('table_id', $id)
            ->where('table_type', 'cruise_photo')
            ->where('file_type', 'image')
            ->delete();

        $cruise->delete();

        return back()
            ->with('success', __('Cruise deleted successfully.'));
    }

    public function images(Request $request, $cruiseId, $id = null)
    {
        $path = 'cruise_photo';

        if ($request->isMethod('delete')) {
            $drive = Drive::findOrFail($id);
            $drive->delete();

            return redirect('admin/cruises/' . $cruiseId. '/images')
                ->with('success', __('Cruise image deleted successfully.'));
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
                // $path = 'cruise_photo';
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
                $drive->table_id = $cruiseId;
                $drive->table_type = $path;
                $drive->file_name = $fileName;
                $drive->file_type = 'image';
                $drive->save();
            }

            return redirect('admin/cruises/' . $cruiseId . '/images')
                ->with('success', __('Cruise image ' . ($id ? 'updated' : 'saved') . ' successfully.'));
        }

        $cruise = Service::findOrFail($cruiseId);

        $drive = Drive::find($id);

        $drives = Drive::where('table_id', $cruiseId)
            ->where('table_type', $path)
            ->where('file_type', 'image')
            ->get();

        return view('admin.cruises.images')->with(compact('cruise', 'drive', 'drives'));
    }

    public function facilities(Request $request, $cruiseId, $id = null)
    {
        if ($request->isMethod('delete')) {
            $facility = Facility::findOrFail($id);
            $facility->delete();

            return redirect('admin/cruises/' . $cruiseId . '/facilities')
                ->with('success', __('Cruise facility deleted successfully.'));
        }

        if ($request->isMethod('post')) {
            if ($id) {
                $rules['name'] = [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('facilities', 'name')
                        ->where('name', $request->name)
                        ->where('table_id', $cruiseId)
                        ->where('table_type', 'cruise')
                        ->ignore($id),
                ];
            } else {
                $rules['name'] = [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('facilities', 'name')
                        ->where('name', $request->name)
                        ->where('table_id', $cruiseId)
                        ->where('table_type', 'cruise'),
                ];
            }

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return back()
                    ->withInput()
                    ->withErrors($validator);
            }

            $facility = Facility::findOrNew($id);
            $facility->table_id = $cruiseId;
            $facility->table_type = 'cruise';
            $facility->name = $request->name;
            $facility->save();

            return redirect('admin/cruises/' . $cruiseId . '/facilities')
                ->with('success', __('Cruise facility ' . ($id ? 'updated' : 'saved') . ' successfully.'));
        }

        $cruise = Service::findOrFail($cruiseId);

        $facility = Facility::find($id);

        $facilities = Facility::where('table_id', $cruiseId)
            ->where('table_type', 'cruise')
            ->get();

        return view('admin.cruises.facilities')->with(compact('cruise', 'facility', 'facilities'));
    }

    public function policies(Request $request, $cruiseId, $id = null)
    {
        if ($request->isMethod('delete')) {
            $policy = Policy::findOrFail($id);
            $policy->delete();

            return redirect('admin/cruises/' . $cruiseId . '/policies')
                ->with('success', __('Cruise policy deleted successfully.'));
        }

        if ($request->isMethod('post')) {
            if ($id) {
                $rules['name'] = [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('policies', 'name')
                    ->where('name', $request->name)
                        ->where('table_id', $cruiseId)
                        ->where('table_type', 'cruise')
                        ->ignore($id),
                ];
            } else {
                $rules['name'] = [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('policies', 'name')
                    ->where('name', $request->name)
                        ->where('table_id', $cruiseId)
                        ->where('table_type', 'cruise'),
                ];
            }

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return back()
                    ->withInput()
                    ->withErrors($validator);
            }

            $policy = Policy::findOrNew($id);
            $policy->table_id = $cruiseId;
            $policy->table_type = 'cruise';
            $policy->name = $request->name;
            $policy->save();

            return redirect('admin/cruises/' . $cruiseId . '/policies')
                ->with('success', __('Cruise policy ' . ($id ? 'updated' : 'saved') . ' successfully.'));
        }

        $cruise = Service::findOrFail($cruiseId);

        $policy = Policy::find($id);

        $policies = Policy::where('table_id', $cruiseId)
            ->where('table_type', 'cruise')
            ->get();

        return view('admin.cruises.policies')->with(compact('cruise', 'policy', 'policies'));
    }

    public function faqs(Request $request, $cruiseId, $id = null)
    {
        if ($request->isMethod('delete')) {
            $faq = Faq::findOrFail($id);
            $faq->delete();

            return redirect('admin/cruises/' . $cruiseId . '/faqs')
                ->with('success', __('Cruise faq deleted successfully.'));
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
                        ->where('table_id', $cruiseId)
                        ->where('table_type', 'cruise')
                        ->ignore($id),
                ];
            } else {
                $rules['question'] = [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('faqs', 'question')
                    ->where('question', $request->question)
                        ->where('table_id', $cruiseId)
                        ->where('table_type', 'cruise'),
                ];
            }

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return back()
                    ->withInput()
                    ->withErrors($validator);
            }

            $faq = Faq::findOrNew($id);
            $faq->table_id = $cruiseId;
            $faq->table_type = 'cruise';
            $faq->question = $request->question;
            $faq->answer = $request->answer;
            $faq->save();

            return redirect('admin/cruises/' . $cruiseId . '/faqs')
                ->with('success', __('Cruise faq ' . ($id ? 'updated' : 'saved') . ' successfully.'));
        }

        $cruise = Service::findOrFail($cruiseId);

        $faq = Faq::find($id);

        $faqs = Faq::where('table_id', $cruiseId)
            ->where('table_type', 'cruise')
            ->get();

        return view('admin.cruises.faqs')->with(compact('cruise', 'faq', 'faqs'));
    }

    public function reviews(Request $request, $cruiseId, $id = null)
    {
        if ($request->isMethod('delete')) {
            $review = Review::findOrFail($id);
            $review->delete();

            return redirect('admin/cruises/' . $cruiseId . '/reviews')
                ->with('success', __('Cruise review deleted successfully.'));
        }

        if ($request->isMethod('post')) {
            if ($id) {
                $rules['name'] = [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('reviews', 'name')
                    ->where('name', $request->name)
                        ->where('table_id', $cruiseId)
                        ->where('table_type', 'cruise')
                        ->ignore($id),
                ];
            } else {
                $rules['name'] = [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('reviews', 'name')
                    ->where('name', $request->name)
                        ->where('table_id', $cruiseId)
                        ->where('table_type', 'cruise'),
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
            $review->table_id = $cruiseId;
            $review->table_type = 'cruise';
            $review->name = $request->name;
            $review->address = $request->address;
            $review->review = $request->review;
            $review->save();

            return redirect('admin/cruises/' . $cruiseId . '/reviews')
                ->with('success', __('Cruise review ' . ($id ? 'updated' : 'saved') . ' successfully.'));
        }

        $cruise = Service::findOrFail($cruiseId);

        $review = Review::find($id);

        $reviews = Review::where('table_id', $cruiseId)
            ->where('table_type', 'cruise')
            ->get();

        return view('admin.cruises.reviews')->with(compact('cruise', 'review', 'reviews'));
    }
}