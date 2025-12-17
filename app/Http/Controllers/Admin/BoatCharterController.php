<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BoatItinerary;
use App\Models\BoatPackage;
use App\Models\Drive;
use App\Models\FishesFound;
use App\Models\Inclusion;
use App\Models\SeasonalPrice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Constraint;
use Intervention\Image\Facades\Image;

class BoatCharterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = BoatPackage::query();

        if ($request->has('package_type') && $request->package_type != '') {
            $query->where('package_type', $request->package_type);
        }

        if ($request->has('featured') && $request->featured == 1) {
            $query->where('featured', 1);
        }

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        $boatPackages = $query->get();

        return view('admin.boat-charter.index', compact('boatPackages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.boat-charter.create');
    }

    public function seasonalPrice($id)
    {
        $package = BoatPackage::findOrFail($id);
        $seasonalPrices = SeasonalPrice::where('boat_package_id', $id)->get();
        return view('admin.boat-charter.seasonal_price', compact('package', 'seasonalPrices'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'days' => 'required|integer|min:1',
            'duration' => 'required|string|max:255',
            'package_type' => 'required|in:Boat Charter,Game Fishing,Sunset Tours',
            'pax' => 'required|integer|min:1',
            'boat_type' => 'required|string|max:255',
            'places_covered' => 'required|string|max:255',
            'description' => 'required|string',
            'base_price' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0|max:100',
            'permit_charges' => 'nullable|in:0,1',
            'local_permit' => 'nullable|numeric|min:0',
            'non_local_permit' => 'nullable|numeric|min:0',
            'featured' => 'nullable|in:0,1',
            'status' => 'required|in:0,1',
        ]);

        BoatPackage::create($validated);

        return redirect()->route('admin.boat-charter.index')->with('success', 'Package saved successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $package = BoatPackage::findOrFail($id);
        return view('admin.boat-charter.show', compact('package'));
    }

    public function storeSeasonalPrice(Request $request, $id)
    {
        $package = BoatPackage::findOrFail($id);

        $validated = $request->validate([
            'boat_package_id' => 'required|exists:boat_packages,id',
            'season' => 'required|in:off_season,peak_season,festive',
            'price' => 'required|numeric|min:0',
            'start_date' => [
                'required',
                'date',
                function ($attribute, $value, $fail) use ($request) {
                    $existing = SeasonalPrice::where('boat_package_id', $request->boat_package_id)
                        ->where(function ($query) use ($request) {
                            $query->where('start_date', '<=', $request->end_date)
                                ->where('end_date', '>=', $request->start_date);
                        })
                        ->exists();

                    if ($existing) {
                        $fail('The selected date range overlaps with an existing seasonal price.');
                    }
                },
            ],
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        SeasonalPrice::create($validated);

        return redirect()->route('admin.boat-charter.seasonal-prices.create', $package->id)->with('success', 'Seasonal price saved successfully');
    }

    public function updateSeasonalPrice(Request $request, $id, $price_id)
    {
        $package = BoatPackage::findOrFail($id);
        $seasonalPrice = SeasonalPrice::findOrFail($price_id);

        $validated = $request->validate([
            'boat_package_id' => 'required|exists:boat_packages,id',
            'season' => 'required|in:off_season,peak_season,festive',
            'price' => 'required|numeric|min:0',
            'start_date' => [
                'required',
                'date',
                function ($attribute, $value, $fail) use ($request, $price_id) {
                    $existing = SeasonalPrice::where('boat_package_id', $request->boat_package_id)
                        ->where('id', '!=', $price_id)
                        ->where(function ($query) use ($request) {
                            $query->where('start_date', '<=', $request->end_date)
                                ->where('end_date', '>=', $request->start_date);
                        })
                        ->exists();

                    if ($existing) {
                        $fail('The selected date range overlaps with an existing seasonal price.');
                    }
                },
            ],
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $seasonalPrice->update($validated);

        return redirect()->route('admin.boat-charter.seasonal-prices.create', $package->id)->with('success', 'Seasonal price updated successfully');
    }

    public function destroySeasonalPrice($id, $price_id)
    {
        $package = BoatPackage::findOrFail($id);
        $seasonalPrice = SeasonalPrice::findOrFail($price_id);
        $seasonalPrice->delete();
        return redirect()->route('admin.boat-charter.seasonal-prices.create', $package->id)->with('success', 'Seasonal price deleted successfully');
    }




    public function inclusionExclusions($id)
    {
        $package = BoatPackage::findOrFail($id);
        $inclusionExclusions = $package->inclusions()->latest()->paginate(10);
        $editItem = request()->query('edit') ? Inclusion::findOrFail(request()->query('edit')) : null;

        return view('admin.boat-charter.inclusion-exclusions', compact('package', 'inclusionExclusions', 'editItem'));
    }

    public function createInclusionExclusion($id)
    {
        $package = BoatPackage::findOrFail($id);
        $inclusionExclusions = $package->inclusions()->latest()->get();
        $editItem = request()->query('edit') ? Inclusion::findOrFail(request()->query('edit')) : null;
        return view('admin.boat-charter.inclusion-exclusions', compact('package', 'inclusionExclusions', 'editItem'));
    }

   public function storeInclusionExclusion(Request $request, $id)
{
    $package = BoatPackage::findOrFail($id);

    $validated = $request->validate([
        'boat_package_id' => 'required|exists:boat_packages,id',
        'type' => 'required|in:inclusion,exclusion',
        'description' => 'required|string|max:255',
    ]);

    $validated['table_name'] = 'boat-charter';

    Inclusion::create($validated);

    return redirect()
        ->route('admin.boat-charter.inclusion-exclusions.create', $package->id)
        ->with('success', 'Inclusion/Exclusion saved successfully');
}


    public function updateInclusionExclusion(Request $request, $id, $item_id)
    {
        $package = BoatPackage::findOrFail($id);
        $inclusionExclusion = Inclusion::findOrFail($item_id);

        $validated = $request->validate([
            'boat_package_id' => 'required|exists:boat_packages,id',
            'type' => 'required|in:inclusion,exclusion',
            'description' => 'required|string|max:255',
        ]);

        $inclusionExclusion->update($validated);

        return redirect()->route('admin.boat-charter.inclusion-exclusions.create', $package->id)->with('success', 'Inclusion/Exclusion updated successfully');
    }

    public function destroyInclusionExclusion($id, $item_id)
    {
        $package = BoatPackage::findOrFail($id);
        $inclusionExclusion = Inclusion::findOrFail($item_id);
        $inclusionExclusion->delete();
        return redirect()->route('admin.boat-charter.inclusion-exclusions.create', $package->id)->with('success', 'Inclusion/Exclusion deleted successfully');
    }


    public function fishesFound($id)
    {
        $package = BoatPackage::findOrFail($id);
        $fishesFound = $package->fishesFounds()->latest()->paginate(10);
        $editFish = request()->query('edit') ? FishesFound::findOrFail(request()->query('edit')) : null;
        return view('admin.boat-charter.fishes-found', compact('package', 'fishesFound', 'editFish'));
    }

    public function createFishesFound($id)
    {
        $package = BoatPackage::findOrFail($id);
        $fishesFound = $package->fishesFounds()->latest()->get();
        $editFish = request()->query('edit') ? FishesFound::findOrFail(request()->query('edit')) : null;
        return view('admin.boat-charter.fishes-found', compact('package', 'fishesFound', 'editFish'));
    }

    public function storeFishesFound(Request $request, $id)
    {
        $package = BoatPackage::findOrFail($id);

        $validated = $request->validate([
            'boat_package_id' => 'required|exists:boat_packages,id',
            'name' => 'required|string|max:255',
            'scientific_name' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'description' => 'nullable|string',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('fishes', 'public');
        }

        FishesFound::create($validated);

        return redirect()->route('admin.boat-charter.fishes-found', $package->id)->with('success', 'Fish Found saved successfully');
    }

    public function updateFishesFound(Request $request, $id, $fish_id)
    {
        $package = BoatPackage::findOrFail($id);
        $fish = FishesFound::findOrFail($fish_id);

        $validated = $request->validate([
            'boat_package_id' => 'required|exists:boat_packages,id',
            'name' => 'required|string|max:255',
            'scientific_name' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'description' => 'nullable|string',
        ]);

        if ($request->hasFile('image')) {
            if ($fish->image) {
                Storage::disk('public')->delete($fish->image);
            }
            $validated['image'] = $request->file('image')->store('fishes', 'public');
        } else {
            $validated['image'] = $fish->image;
        }

        $fish->update($validated);

        return redirect()->route('admin.boat-charter.fishes-found', $package->id)->with('success', 'Fish Found updated successfully');
    }

    public function destroyFishesFound($id, $fish_id)
    {
        $package = BoatPackage::findOrFail($id);
        $fish = FishesFound::findOrFail($fish_id);

        if ($fish->image) {
            Storage::disk('public')->delete($fish->image);
        }

        $fish->delete();

        return redirect()->route('admin.boat-charter.fishes-found', $package->id)->with('success', 'Fish Found deleted successfully');
    }


    public function boatItineraries($id)
    {
        $package = BoatPackage::findOrFail($id);
        $boatItineraries = $package->boatItineraries()->latest()->paginate(10);
        return view('admin.boat-charter.boat-itineraries', compact('package', 'boatItineraries'));
    }

    public function createBoatItinerary($id)
    {
        $package = BoatPackage::findOrFail($id);
        $boatItineraries = $package->boatItineraries()->latest()->get();
        $editItinerary = request()->query('edit') ? BoatItinerary::findOrFail(request()->query('edit')) : null;
        return view('admin.boat-charter.boat-itineraries-create', compact('package', 'boatItineraries', 'editItinerary'));
    }
    public function storeBoatItinerary(Request $request, $id)
    {
        $package = BoatPackage::findOrFail($id);

        $validated = $request->validate([
            'boat_package_id' => 'required|exists:boat_packages,id',
            'itineraries' => 'required|array|min:1',
            'itineraries.*.day' => [
                'required',
                'integer',
                'min:1',
                function ($attribute, $value, $fail) use ($request) {
                    $day = $value;
                    $existing = BoatItinerary::where('boat_package_id', $request->boat_package_id)
                        ->where('day', $day)
                        ->exists();
                    if ($existing) {
                        $fail("The day $day has already been taken for this package.");
                    }
                },
            ],
            'itineraries.*.title' => 'required|string|max:255',
            'itineraries.*.description' => 'nullable|string',
        ]);

        foreach ($validated['itineraries'] as $itineraryData) {
            BoatItinerary::updateOrCreate(
                [
                    'boat_package_id' => $validated['boat_package_id'],
                    'day' => $itineraryData['day'],
                ],
                [
                    'title' => $itineraryData['title'],
                    'description' => $itineraryData['description'],
                ]
            );
        }

        return redirect()->route('admin.boat-charter.boat-itineraries.create', $package->id)->with('success', 'Itineraries saved successfully');
    }

    public function updateBoatItinerary(Request $request, $id)
{
    try {
        $package = BoatPackage::findOrFail($id);

        $validated = $request->validate([
            'boat_package_id' => 'required|exists:boat_packages,id',
            'itineraries' => 'required|array|min:1',
            'itineraries.*.day' => 'required|integer|min:1',
            'itineraries.*.title' => 'required|string|max:255',
            'itineraries.*.description' => 'nullable|string',
        ]);

        foreach ($validated['itineraries'] as $itineraryData) {
            BoatItinerary::updateOrCreate(
                [
                    'boat_package_id' => $validated['boat_package_id'],
                    'day' => $itineraryData['day'],
                ],
                [
                    'title' => $itineraryData['title'],
                    'description' => $itineraryData['description'],
                ]
            );
        }

        return redirect()
            ->route('admin.boat-charter.boat-itineraries.create', $package->id)
            ->with('success', 'Itineraries updated successfully');
    } catch (\Illuminate\Validation\ValidationException $e) {
        return back()
            ->withErrors($e->validator)
            ->withInput();
    } catch (\Exception $e) {
        return back()
            ->with('error', 'Something went wrong: ' . $e->getMessage())
            ->withInput();
    }
}


    public function destroyBoatItinerary($id, $itinerary_id)
    {
        $package = BoatPackage::findOrFail($id);
        $itinerary = BoatItinerary::findOrFail($itinerary_id);
        $itinerary->delete();
        return redirect()->route('admin.boat-charter.boat-itineraries.create', $package->id)->with('success', 'Itinerary deleted successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $package = BoatPackage::findOrFail($id);
        return view('admin.boat-charter.edit', compact('package'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $package = BoatPackage::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'days' => 'required|integer|min:1',
            'duration' => 'required|string|max:255',
            'package_type' => 'required|in:Game Fishing,Boat Charter',
            'Sunset Tours',
            'pax' => 'required|integer|min:1',
            'boat_type' => 'required|string|max:255',
            'places_covered' => 'required|string|max:255',
            'description' => 'required|string',
            'base_price' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0|max:100',
            'permit_charges' => 'nullable|in:0,1',
            'local_permit' => 'nullable|numeric|min:0',
            'non_local_permit' => 'nullable|numeric|min:0',
            'featured' => 'nullable|in:0,1',
            'status' => 'required|in:1,0',
        ]);

        $package->update($validated);

        return redirect()->route('admin.boat-charter.index')->with('success', 'Package updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $package = BoatPackage::findOrFail($id);
        Inclusion::where('boat_package_id', $id)->delete();
        FishesFound::where('boat_package_id', $id)->delete();
        BoatItinerary::where('boat_package_id', $id)->delete();
        $package->delete();
        return redirect()->route('admin.boat-charter.index')->with('success', 'Package deleted successfully');
    }





    // Boat Charter Images all Images//

    public function ShowImages($id)
    {
        $package = BoatPackage::with('boatImages')->findOrFail($id);
        $images = $package->boatImages()->latest()->paginate(10);
        $editItem = request()->query('edit') ? Inclusion::findOrFail(request()->query('edit')) : null;
        return view('admin.boat-charter.add-images', compact('package', 'images', 'editItem'));
    }

    public function StoreImages(Request $request, $id)
    {
        $package = BoatPackage::findOrFail($id);
        $path = 'boat_activity';

        if ($request->isMethod('post')) {
            $rules = [
                'image' => 'required|file|image|mimes:jpeg,jpg,png|max:2048',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return back()
                    ->withInput()
                    ->withErrors($validator);
            }

            if ($request->hasFile('image')) {
                if (!Storage::disk('public')->exists($path)) {
                    Storage::disk('public')->makeDirectory($path, 0777, true, true);
                }

                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $fileName = 'photo-' . date('Ymd-His') . '-' . abs(crc32(uniqid())) . '.' . $extension;
                $fullPath = $path . '/' . $fileName;

                $image = Image::make($file->getRealPath())
                    ->resize(720, 480, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    })
                    ->encode($extension);

                Storage::disk('public')->put($fullPath, $image);

                $drive = new Drive();
                $drive->table_id = $id;
                $drive->table_type = $path;
                $drive->file_name = $fullPath;
                $drive->file_type = 'image';
                $drive->save();
            }
            return redirect()
                ->route('admin.boat-charter.images', $package->id)
                ->with('success', 'Image saved successfully');
        }
    }

    public function updateImages(Request $request, $id)
    {
        $package = BoatPackage::findOrFail($id);
        $path = 'boat_activity';

        $rules = [
            'image' => 'required|file|image|mimes:jpeg,jpg,png|max:2048',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

        if ($request->hasFile('image')) {
            $existingImage = Drive::where('table_id', $id)
                ->where('table_type', $path)
                ->where('file_type', 'image')
                ->first();

            if ($existingImage && $existingImage->file_name && Storage::disk('public')->exists($existingImage->file_name)) {
                Storage::disk('public')->delete($existingImage->file_name);
                $existingImage->delete();
            }

            if (!Storage::disk('public')->exists($path)) {
                Storage::disk('public')->makeDirectory($path, 0777, true, true);
            }

            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $fileName = 'photo-' . date('Ymd-His') . '-' . abs(crc32(uniqid())) . '.' . $extension;
            $fullPath = $path . '/' . $fileName;

            $image = Image::make($file->getRealPath())
                ->resize(720, 480, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })
                ->encode($extension);

            Storage::disk('public')->put($fullPath, $image);

            $drive = new Drive();
            $drive->table_id = $id;
            $drive->table_type = $path;
            $drive->file_name = $fullPath;
            $drive->file_type = 'image';
            $drive->save();
        }

        return redirect()
            ->route('admin.boat-charter.images', $package->id)
            ->with('success', 'Image updated successfully');
    }


    public function destroyImage($id, $image_id)
    {
        $package = BoatPackage::findOrFail($id);
        $image = Drive::findOrFail($image_id);

        if ($image->file_name) {
            Storage::disk('public')->delete($image->file_name);
        }

        $image->delete();

        return redirect()->route('admin.boat-charter.images', $package->id)->with('success', 'Image deleted successfully');
    }

    public function destroyImages($id, $image_id)
    {
        $package = BoatPackage::findOrFail($id);
        $image = Drive::findOrFail($image_id);

        if ($image->file_name && Storage::disk('public')->exists($image->file_name)) {
            Storage::disk('public')->delete($image->file_name);
        }

        $image->delete();

        return redirect()->route('admin.boat-charter.images', $package->id)->with('success', 'Image deleted successfully');
    }
}
