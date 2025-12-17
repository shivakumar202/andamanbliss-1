<?php

namespace App\Http\Controllers;

use App\Models\CabPackages;
use App\Models\CabPricing;
use App\Models\Category;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CabPackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $locations = [
            "Port Blair",
            "Havelock Island",
            "Neil Island",
            "North & Middle Andaman"
        ];

        $query = CabPackages::with('cabPricing');

        if ($request->filled('location')) {
            $query->where('location', $request->input('location'));
        }

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        if ($request->filled('price_type')) {
            $query->where('price_type', $request->input('price_type'));
        }

        $cabPackages = $query->get();

        return view('admin.cabs.package.index')->with(compact('cabPackages', 'locations'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('type', 'cab')->get();

        $cabs = Service::where('type', 'cab')->where('status', 'active')->whereHas('pricing', function ($query) {
            $query->whereHas('CabPricing');
        })->with('pricing.CabPricing')->get();
        $packages = CabPricing::select('name', DB::raw('MIN(id) as id'))
            ->groupBy('name')
            ->orderBy('name')
            ->get();

        return view('admin.cabs.package.create')->with(compact('cabs', 'categories', 'packages'));
    }

    public function pricing()
    {
        $pricings = CabPricing::all();
        return view('admin.cabs.package.pricing', compact('pricings'));
    }

    public function pricingEdit($id)
    {
        $pricing = CabPricing::find($id);
        return view('admin.cabs.package.price_edit', compact('pricing'));
    }

    public function pricingCreate()
    {
        return view('admin.cabs.package.price_create');
    }

    public function pricingStore(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'base_price' => 'required|numeric|min:0',
            'price_type' => 'required|in:per_person,per_cab',
            'seat_type' => 'nullable|string|max:255',
            'distance_covered' => 'nullable|numeric|min:0',
            'extra_fare' => 'nullable|numeric|min:0',
        ]);

        CabPricing::create($validated);

        return redirect()->route('admin.cab-package.pricing')
            ->with('success', 'Cab pricing added successfully!');
    }

    public function pricingDestroy(int $id)
    {
        $pricing = CabPricing::findOrFail($id);
        $pricing->delete();

        return redirect()->route('admin.cab-package.pricing')
            ->with('success', 'Cab pricing deleted successfully!');
    }



    public function pricingUpdate(Request $request, $id)
    {
        $request->validate([
            'location' => 'required|string',
            'name' => 'required|string',
            'base_price' => 'required|numeric',
            'price_type' => 'required|string',
            'seat_type' => 'required|string',
            'distance_covered' => 'nullable|numeric',
            'extra_fare' => 'nullable|numeric',
        ]);

        $pricing = CabPricing::findOrFail($id);

        $pricing->update([
            'location' => $request->location,
            'name' => $request->name,
            'base_price' => $request->base_price,
            'price_type' => $request->price_type,
            'seat_type' => $request->seat_type,
            'distance_covered' => $request->distance_covered,
            'extra_fare' => $request->extra_fare,
        ]);

        return redirect()->route('admin.cab-package.pricing')->with('success', 'Pricing updated successfully!');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'fare_pp' => 'required|numeric',
            'location' => 'required|string',
            'location.*' => 'string',
            'cab_ids' => 'required|array',
            'price_type' => 'required|in:per_cab,per_person',
            'distance_limit' => 'required|integer',
            'status' => 'required|in:1,0',
            'extra_fare' => 'required|integer',
            'from_location' => 'required|string',
            'to_location' => 'required|string',
            'package_type' => 'required|string',
        ]);

        $cabPackage = new CabPackages([
            'name' => $request->input('name'),
            'fare_pp' => $request->input('fare_pp'),
            'location' => $request->input('location'),
            'cab_ids' => json_encode($request->input('cab_ids')),
            'price_type' => $request->input('price_type'),
            'distance_limit' => $request->input('distance_limit'),
            'extra_fare' => $request->input('extra_fare'),
            'status' => $request->input('status'),
            'from_location' => $request->input('from_location'),
            'to_location' => $request->input('to_location'),
            'package_type' => $request->input('package_type'),
        ]);

        $cabPackage->save();

        $locations = [
            "Port Blair",
            "Havelock Island",
            "Neil Island",
            "North & Middle Andaman"
        ];

        $query = CabPackages::with('cabPricing');

        

        $cabPackages = $query->get();

                return view('admin.cabs.package.index')->with(compact('cabPackages', 'locations'));

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
    public function edit($id)
    {
        $cabs = Service::where('type', 'cab')->where('status', 'active')->whereHas('pricing', function ($query) {
            $query->whereHas('CabPricing');
        })->with('pricing.CabPricing')->get();
        $locations = [
            "Port Blair",
            "Havelock Island",
            "Neil Island",
            "North & Middle Andaman"
        ];
        $cabdet = CabPackages::find($id);
        $packages = CabPricing::select('name', DB::raw('MIN(id) as id'))
            ->groupBy('name')
            ->orderBy('name')
            ->get();



        return view('admin.cabs.package.create', compact('cabs', 'cabdet', 'locations', 'packages'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'fare_pp' => 'required|numeric',
            'location' => 'required|string',
            'cab_ids' => 'required|array',
            'price_type' => 'required|in:per_cab,per_person',
            'distance_limit' => 'required|integer',
            'status' => 'required|in:1,0',
            'extra_fare' => 'required|integer',
            'from_location' => 'required|string',
            'to_location' => 'required|string',
            'package_type' => 'required|string',
        ]);

        $cabPackage = CabPackages::findOrFail($id);

        $cabPackage->name = $request->input('name');
        $cabPackage->fare_pp = $request->input('fare_pp');
        $cabPackage->location = $request->input('location');
        $cabPackage->cab_ids = json_encode($request->input('cab_ids'));
        $cabPackage->price_type = $request->input('price_type');
        $cabPackage->distance_limit = $request->input('distance_limit');
        $cabPackage->extra_fare = $request->input('extra_fare');
        $cabPackage->status = $request->input('status');
        $cabPackage->from_location = $request->input('from_location');
        $cabPackage->to_location = $request->input('to_location');
        $cabPackage->package_type = $request->input('package_type');

        $cabPackage->save();

        return redirect()->route('admin.cab-package.index')->with('success', 'Cab package updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cabPackage = CabPackages::find($id);

        if (!$cabPackage) {
            return redirect()->route('admin.cab-package.index')->with('error', 'Cab package not found!');
        }

        $cabPackage->delete();
        return redirect()->route('admin.cab-package.index')->with('success', 'Cab package deleted successfully!');
    }
}
