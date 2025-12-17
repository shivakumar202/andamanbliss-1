<?php

namespace App\Http\Controllers;

use App\Models\BikePickLocation;
use App\Models\CabPackages;
use App\Models\RentalBookings;
use App\Models\Service;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        $validated = $request->validate([
            'carId' => 'required|exists:services,id',
            'packageId' => 'required|exists:cab_packages,id',
            'pickup' => 'nullable|string',
            'from_location' => 'nullable|string',
            'to_location' => 'nullable|string',
            'pickupdate' => 'required|date_format:d-m-Y',
            'pickuptime' => 'required|string',
            'trip_type' => 'nullable|in:One Way,Round Trip',
            'return_date' => 'nullable|date_format:d-m-Y|after_or_equal:pickupdate',
            'return_time' => 'nullable|string',
            'pickup_location' => 'nullable|string',
            'travellers' => 'nullable|integer|min:1',
            'cab_quantity' => 'nullable|integer|min:1|max:5',
            'package_type' => 'nullable|in:Local,OutStanding',
        ]);

        $car = Service::with('cabPhotos')->findOrFail($request->carId);
        $selectedPackage = CabPackages::findOrFail($request->packageId);
        $cabPrice = (int) floatval(str_replace([',', '₹'], '', $request->carPrice));
        $fareMultiplier = ($request->trip_type === 'Round Trip') ? 2 : 1;
        $cabQuantity = $request->cab_quantity ?? 1;
        $baseFare = $cabPrice * $fareMultiplier * $cabQuantity;
        $gst = $baseFare * 0.05;
        $totalFare = $baseFare + $gst;

        $formattedData = [
            'carName' => $car->name,
            'carPrice' => '₹' . number_format($cabPrice, 2),
            'carImage' => $car->cabPhotos->first()->file ?? asset('site/img/cab/default.jpg'),
            'carSeats' => $car->seats,
            'fuelType' => $car->fuel_type ?? 'Diesel',
            'smallBags' => $car->small_bags ?? '2 Small Bags',
            'Package' => $selectedPackage->name ?? 'Not Available',
            'inclusions' => ['Fuel Charges', 'Driver Allowance', 'Base Fare for 150 km', '24/7 Customer Support'],
            'exclusions' => ['Toll Taxes', 'Parking Charges', 'Extra Km (₹14.3/km)', 'Night Charges (if applicable)'],
            'pickup' => $request->pickup ?? 'Not Available',
            'from_location' => $request->from_location ?? 'Not Available',
            'to_location' => $request->to_location ?? 'Not Available',
            'pickupdate' => $request->pickupdate,
            'pickuptime' => $request->pickuptime,
            'trip_type' => $request->trip_type ?? 'One Way',
            'return_date' => $request->return_date ?? '',
            'return_time' => $request->return_time ?? '',
            'pickup_location' => $request->pickup_location ?? 'City Center',
            'travellers' => $request->travellers ?? 1,
            'cab_quantity' => $cabQuantity,
            'package_type' => $request->package_type ?? 'Local',
            'fare' => $baseFare,
            'gst' => $gst,
            'totalFare' => $totalFare,
            'details' => [
                'Extra km fare - ₹' . $selectedPackage->extra_fare . '/km after ' . $selectedPackage->distance_limit . ' kms',
                'Fuel Type - CNG with refill breaks',
                'Cancellation - Free till 1 hour of departure',
            ],
        ];
        return view('pages.payment_review', compact('formattedData'));
    }


    public function bill($bookId)
    {
        $billingDetails = RentalBookings::with('cabPackages.cabPricing','payment')->find($bookId);
        $cab = Service::whereIn('type', ['cab', 'bike'])->where('id', $billingDetails->vehicle_id)->first();
        $locations = BikePickLocation::where('name',$billingDetails->from_location)->first();
        return view('bikes.confirm_page', compact('billingDetails', 'cab'));
    

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
