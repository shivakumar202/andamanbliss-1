<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CabPricing;
use App\Models\CabPricings;
use App\Models\Cabs;
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

class CabController extends Controller
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
        $cabs = Cabs::when(!empty($request->category), function ($query) use ($request) {
            $query->where('category', $request->category);
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

        $categories = Cabs::distinct('category')->pluck('category');
        return view('admin.cabs.index')->with(compact('cabs', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('type', 'cab')->get();

        return view('admin.cabs.create')->with(compact('categories'));
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
                Rule::unique('cabs', 'name')
                    ->where('name', $request->name)
            ],
            'category' => 'required|string',
            'start_price' => 'required|numeric',
            'service_locations' => 'required|array',
            'description' => 'nullable|string|max:1055',
            'status' => 'required|integer|in:1,0',
            'fuel_type' => 'required|string',
            'luggae' => 'required'
        ]);

        if ($validator->fails()) {
            return back()
                ->withInput()
                ->withErrors($validator);
        }

        $cab = new Cabs();
        $cab->name = $request->name;
        $cab->category = $request->category;
        $cab->start_price = $request->start_price;
        $cab->fuel_type = $request->fuel_type;
        $cab->sitting_capacity = $request->sitting_capacity;
        $cab->service_locations = $request->service_locations;
        $cab->description = $request->description;
        $cab->luggage = $request->luggage;
        $cab->featured = $request->featured ?? 0;
        $cab->best_seller = $request->best_seller ?? 0;
        $cab->status = $request->status;
        $cab->save();
        return back()
            ->with('success', __('Cab saved successfully.'));
    }



    public function pricing(Request $request, $cabId, $id = null)
    {
        if ($request->isMethod('delete')) {
            $pricing = Pricing::find($id);
            $pricing->delete();

            return redirect('admin/cabs/' . $cabId . '/pricing')->with('success', __('Cab Pricing deleted successfull'));
        }
        if ($request->isMethod('post')) {
            $request->validate([
                'file' => 'required|mimes:csv',
            ]);

            $file = $request->file('file');
            $handle = fopen($file->getRealPath(), 'r');
            fgetcsv($handle);
            $errors = [];
            $pricings = [];
            $rowIndex = 1;

            while (($row = fgetcsv($handle, 1000, ',')) !== FALSE) {
                $rowIndex++;
                if (empty(array_filter($row))) continue;
                $data = [
                    'id' => $row[0],
                    'location' => $row[1] ?? null,
                    'name' => $row[2] ?? null,
                    'category' => $row[3] ?? null,
                    'base_price' => $row[4] ?? 0,
                    'price_type' => $row[5] ?? null,
                    'seat_type' => $row[6] ?? 0,
                    'distance_covered' => floatval($row[7]) ?? 0.0,
                    'extra_fare' => floatval($row[8]) ?? 0.0,
                ];

                if (empty($data['name']) || !in_array($data['category'], ['local', 'airport', 'jetty', 'outstation'])) {
                    $errors[$rowIndex] = ['Invalid name or category'];
                } else {
                    $pricings[] = $data;
                }
            }
            if (!empty($errors)) {
                dd($errors);
            }

            foreach ($pricings as $data) {
                CabPricing::updateOrCreate(
                    $data
                );
            }

            return redirect()->route('admin.cab-package.pricing')
                ->with('success', 'Cab Prices uploaded successfully.');
        }

        $pricing = CabPricings::all();

        return view('admin.cabs.pricing')->with(compact( 'pricing'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $cab = Service::with('category')->findOrFail($id);

        return view('admin.cabs.show')->with(compact('cab'));
    }

    /**
     * Show the form for editing the specified resource.
     */


    public function edit(string $id)
    {
        $cab = Cabs::findOrFail($id);

        return view('admin.cabs.create')->with(compact('cab',));
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
                Rule::unique('cabs', 'name')
                    ->where('name', $request->name)
                    ->ignore($id),
            ],
            'category' => 'required|string',
            'start_price' => 'required|numeric',
            'service_locations' => 'required|array',
            'description' => 'nullable|string|max:1055',
            'status' => 'required|integer|in:1,0',
            'fuel_type' => 'required|string',
            'luggage' => 'required'
        ]);
        if ($validator->fails()) {
            return back()
                ->withInput()
                ->withErrors($validator);
        }
        $cab = Cabs::find($id);
        $cab->name = $request->name;
        $cab->category = $request->category;
        $cab->start_price = $request->start_price;
        $cab->fuel_type = $request->fuel_type;
        $cab->sitting_capacity = $request->sitting_capacity;
        $cab->service_locations = $request->service_locations;
        $cab->description = $request->description;
        $cab->luggage = $request->luggage;
        $cab->featured = $request->featured ?? 0;
        $cab->best_seller = $request->best_seller ?? 0;
        $cab->status = $request->status;
        $cab->save();

        return back()
            ->with('success', __('Cab updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cab = Cabs::findOrFail($id);

        Drive::where('table_id', $id)
            ->where('table_type', 'cab_photo')
            ->where('file_type', 'image')
            ->delete();

        $cab->delete();

        return back()
            ->with('success', __('Cab deleted successfully.'));
    }

    public function images(Request $request, $cabId, $id = null)
    {
        $path = 'cab_photo';

        if ($request->isMethod('delete')) {
            $drive = Drive::findOrFail($id);
            $drive->delete();

            return redirect('admin/cabs/' . $cabId . '/images')
                ->with('success', __('Cab image deleted successfully.'));
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
                $drive->table_id = $cabId;
                $drive->table_type = $path;
                $drive->file_name = $fileName;
                $drive->file_type = 'image';
                $drive->save();
            }

            return redirect('admin/cabs/' . $cabId . '/images')
                ->with('success', __('Cab image ' . ($id ? 'updated' : 'saved') . ' successfully.'));
        }

        $cab = Cabs::findOrFail($cabId);

        $drive = Drive::find($id);

        $drives = Drive::where('table_id', $cabId)
            ->where('table_type', $path)
            ->where('file_type', 'image')
            ->get();

        return view('admin.cabs.images')->with(compact('cab', 'drive', 'drives'));
    }

    public function facilities(Request $request, $cabId, $id = null)
    {
        if ($request->isMethod('delete')) {
            $facility = Facility::findOrFail($id);
            $facility->delete();

            return redirect('admin/cabs/' . $cabId . '/facilities')
                ->with('success', __('Cab facility deleted successfully.'));
        }

        if ($request->isMethod('post')) {
            if ($id) {
                $rules['name'] = [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('facilities', 'name')
                        ->where('name', $request->name)
                        ->where('table_id', $cabId)
                        ->where('table_type', 'cab')
                        ->ignore($id),
                ];
            } else {
                $rules['name'] = [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('facilities', 'name')
                        ->where('name', $request->name)
                        ->where('table_id', $cabId)
                        ->where('table_type', 'cab'),
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
            $facility->table_id = $cabId;
            $facility->table_type = 'cab';
            $facility->name = $request->name;
            $facility->value = $request->value;
            $facility->save();

            return redirect('admin/cabs/' . $cabId . '/facilities')
                ->with('success', __('Cab facility ' . ($id ? 'updated' : 'saved') . ' successfully.'));
        }

        $cab = Service::findOrFail($cabId);

        $facility = Facility::find($id);

        $facilities = Facility::where('table_id', $cabId)
            ->where('table_type', 'cab')
            ->get();

        return view('admin.cabs.facilities')->with(compact('cab', 'facility', 'facilities'));
    }

    public function policies(Request $request, $cabId, $id = null)
    {
        if ($request->isMethod('delete')) {
            $policy = Policy::findOrFail($id);
            $policy->delete();

            return redirect('admin/cabs/' . $cabId . '/policies')
                ->with('success', __('Cab policy deleted successfully.'));
        }

        if ($request->isMethod('post')) {
            if ($id) {
                $rules['name'] = [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('policies', 'name')
                        ->where('name', $request->name)
                        ->where('table_id', $cabId)
                        ->where('table_type', 'cab')
                        ->ignore($id),
                ];
            } else {
                $rules['name'] = [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('policies', 'name')
                        ->where('name', $request->name)
                        ->where('table_id', $cabId)
                        ->where('table_type', 'cab'),
                ];
            }

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return back()
                    ->withInput()
                    ->withErrors($validator);
            }

            $policy = Policy::findOrNew($id);
            $policy->table_id = $cabId;
            $policy->table_type = 'cab';
            $policy->name = $request->name;
            $policy->save();

            return redirect('admin/cabs/' . $cabId . '/policies')
                ->with('success', __('Cab policy ' . ($id ? 'updated' : 'saved') . ' successfully.'));
        }

        $cab = Service::findOrFail($cabId);

        $policy = Policy::find($id);

        $policies = Policy::where('table_id', $cabId)
            ->where('table_type', 'cab')
            ->get();

        return view('admin.cabs.policies')->with(compact('cab', 'policy', 'policies'));
    }

    public function faqs(Request $request, $cabId, $id = null)
    {
        if ($request->isMethod('delete')) {
            $faq = Faq::findOrFail($id);
            $faq->delete();

            return redirect('admin/cabs/' . $cabId . '/faqs')
                ->with('success', __('Cab faq deleted successfully.'));
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
                        ->where('table_id', $cabId)
                        ->where('table_type', 'cab')
                        ->ignore($id),
                ];
            } else {
                $rules['question'] = [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('faqs', 'question')
                        ->where('question', $request->question)
                        ->where('table_id', $cabId)
                        ->where('table_type', 'cab'),
                ];
            }

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return back()
                    ->withInput()
                    ->withErrors($validator);
            }

            $faq = Faq::findOrNew($id);
            $faq->table_id = $cabId;
            $faq->table_type = 'cab';
            $faq->question = $request->question;
            $faq->answer = $request->answer;
            $faq->save();

            return redirect('admin/cabs/' . $cabId . '/faqs')
                ->with('success', __('Cab faq ' . ($id ? 'updated' : 'saved') . ' successfully.'));
        }

        $cab = Service::findOrFail($cabId);

        $faq = Faq::find($id);

        $faqs = Faq::where('table_id', $cabId)
            ->where('table_type', 'cab')
            ->get();

        return view('admin.cabs.faqs')->with(compact('cab', 'faq', 'faqs'));
    }

    public function reviews(Request $request, $cabId, $id = null)
    {
        if ($request->isMethod('delete')) {
            $review = Review::findOrFail($id);
            $review->delete();

            return redirect('admin/cabs/' . $cabId . '/reviews')
                ->with('success', __('Cab review deleted successfully.'));
        }

        if ($request->isMethod('post')) {
            if ($id) {
                $rules['name'] = [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('reviews', 'name')
                        ->where('name', $request->name)
                        ->where('table_id', $cabId)
                        ->where('table_type', 'cab')
                        ->ignore($id),
                ];
            } else {
                $rules['name'] = [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('reviews', 'name')
                        ->where('name', $request->name)
                        ->where('table_id', $cabId)
                        ->where('table_type', 'cab'),
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
            $review->table_id = $cabId;
            $review->table_type = 'cab';
            $review->name = $request->name;
            $review->address = $request->address;
            $review->review = $request->review;
            $review->save();

            return redirect('admin/cabs/' . $cabId . '/reviews')
                ->with('success', __('Cab review ' . ($id ? 'updated' : 'saved') . ' successfully.'));
        }

        $cab = Service::findOrFail($cabId);

        $review = Review::find($id);

        $reviews = Review::where('table_id', $cabId)
            ->where('table_type', 'cab')
            ->get();

        return view('admin.cabs.reviews')->with(compact('cab', 'review', 'reviews'));
    }
}
