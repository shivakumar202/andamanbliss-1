<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\PassengerDetails;
use App\Models\RazorpayTransactions;
use App\Models\TempItinerary;
use Illuminate\Http\Request;

class TourPackageBooking extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $bookingsQuery = RazorpayTransactions::with(['packageBookings'])
        ->where('purpose', 'Package Booking')
        ->when(!empty($request->category_id), function ($query) use ($request) {
            $query->whereHas('packageBookings.tour', function ($q) use ($request) {
                $q->where('category_id', $request->category_id);
            });
        })
        ->when(!empty($request->start_at), function ($query) use ($request) {
            $query->whereHas('packageBookings', function ($q) use ($request) {
                $q->whereDate('start_date', '>=', date('Y-m-d', strtotime($request->start_at)));
            });
        })
        ->when(!empty($request->end_at), function ($query) use ($request) {
            $query->whereHas('packageBookings', function ($q) use ($request) {
                $q->whereDate('start_date', '<=', date('Y-m-d', strtotime($request->end_at)));
            });
        })
        ->when(!empty($request->booked_from), function ($query) use ($request) {
             $query->whereHas('packageBookings', function ($q) use ($request) {
                $q->whereDate('created_at', '<=', date('Y-m-d', strtotime($request->booked_from)));
            });
        })
        ->when(!empty($request->booked_to), function ($query) use ($request) {
              $query->whereHas('packageBookings', function ($q) use ($request) {
                $q->whereDate('created_at', '<=', date('Y-m-d', strtotime($request->booked_to)));
            });
        });

    $bookings = $bookingsQuery->get()
        ->groupBy('booking_id')
        ->map(fn($items) => $items->first())
        ->values();

    $categories = Category::where('type', 'tour')->get();

    return view('admin.bookings.tour-package.bookings', compact('bookings', 'categories'));
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
        $detail = TempItinerary::with(['TourPricing','ferries','accomodation','payments','tour.tourCategory','tour.TourItinerary','hotelbookings'])
            ->where('search_hash',$id)
            ->get();
            
        $guests = PassengerDetails::where('booking_id',$id)->where('purpose','Package booking')->get();
        $first = $detail->first();
        $pricing = $first->TourPricing->toArray();
        $payments = $first->payments->toArray();   
        $guest = $first->guest;
        $tour = $first->tour->toArray();
        $category = $first->category;
        $data = [
            'tour' => $tour,
            'pricing' => $pricing,
            'payments' => $payments,
            'guest' => $guest,
            'guest_detail' => $guests,
            'category' => $category,
            'itinerary' => $detail->toArray(),
        ];
        return view('admin.bookings.tour-package.details',compact('data'));
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
