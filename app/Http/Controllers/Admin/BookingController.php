<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FerryTickets;
use App\Models\BoatTripBookings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Booking;
use App\Models\CabBookings;
use App\Models\CabPricings;
use App\Models\FerryBookings;
use App\Models\HotelBookings;
use App\Models\RentalBookings;

class BookingController extends Controller
{
    protected $tableTypes;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->tableTypes = [
            'services',
            'addons'
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
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
        $booking = Booking::findOrFail($id);
        $booking->delete();

        return back()
            ->with('success', __('Enquiry deleted successfully.'));
    }


    public function deleteBooking($id)
    {
        $booking = RentalBookings::with('payment')->find($id);

        if (!$booking) {
            return redirect()->back()->with('error', 'Booking not found.');
        }

        if ($booking->payment) {
            $booking->payment->delete();
        }

        $booking->delete();

        return redirect()->back()->with('success', 'Booking deleted successfully.');
    }


    public function tours(Request $request)
    {
        $bookings = Booking::with(['service', 'service.category', 'addon'])
            ->where('type', 'tour')
            ->when(!empty($request->category_id), function ($query) use ($request) {
                $query->whereHas('tour', function ($q) use ($request) {
                    $q->where('category_id', $request->category_id);
                });
            })
            ->when(!empty($request->table_type), function ($query) use ($request) {
                $query->where('table_type', $request->table_type);
            })
            ->when(!empty($request->start_at), function ($query) use ($request) {
                $query->whereDate('start_at', '>=', date('Y-m-d', strtotime($request->start_at)));
            })
            ->when(!empty($request->end_at), function ($query) use ($request) {
                $query->whereDate('end_at', '<=', date('Y-m-d', strtotime($request->end_at)));
            })
            ->when(!empty($request->booked_from), function ($query) use ($request) {
                $query->whereDate('created_at', '>=', date('Y-m-d', strtotime($request->booked_from)));
            })
            ->when(!empty($request->booked_to), function ($query) use ($request) {
                $query->whereDate('created_at', '<=', date('Y-m-d', strtotime($request->booked_to)));
            })
            ->get();

        $categories = Category::where('type', 'tour')->get();

        $tableTypes = $this->tableTypes;

        return view('admin.bookings.tours')->with(compact('bookings', 'categories', 'tableTypes'));
    }

    public function hotels(Request $request)
    {
        $bookings = HotelBookings::with(['paymentDetails', 'hotel'])->where('mode', 'hotel')->orderBy('id', 'DESC')->get();

        $tableTypes = $this->tableTypes;

        return view('admin.bookings.hotels')->with(compact('bookings', 'tableTypes'));
    }

    public function activities(Request $request)
    {
        $bookings = Booking::with(['activity', 'activityBook'])
            ->where('type', 'activity')
            ->when(!empty($request->category_id), function ($query) use ($request) {
                $query->whereHas('activity', function ($q) use ($request) {
                    $q->where('category_id', $request->category_id);
                });
            })
            ->when(!empty($request->table_type), function ($query) use ($request) {
                $query->where('table_type', $request->table_type);
            })
            ->when(!empty($request->start_at), function ($query) use ($request) {
                $query->whereDate('start_at', '>=', date('Y-m-d', strtotime($request->start_at)));
            })
            ->when(!empty($request->end_at), function ($query) use ($request) {
                $query->whereDate('end_at', '<=', date('Y-m-d', strtotime($request->end_at)));
            })
            ->when(!empty($request->booked_from), function ($query) use ($request) {
                $query->whereDate('created_at', '>=', date('Y-m-d', strtotime($request->booked_from)));
            })
            ->when(!empty($request->booked_to), function ($query) use ($request) {
                $query->whereDate('created_at', '<=', date('Y-m-d', strtotime($request->booked_to)));
            })
            ->get();

        foreach ($bookings as $booking) {
            $lastTwoDigits = substr($booking->mobile, -2);
            $bdate = \Carbon\Carbon::parse($booking->start_date)->format('dm');

            $ticketcode = "AB{$bdate}{$lastTwoDigits}{$booking->id}";
            $booking['ticket_code'] = $ticketcode;
        }

        $categories = Category::where('type', 'activity')->get();


        $tableTypes = $this->tableTypes;

        return view('admin.bookings.activities')->with(compact('bookings', 'categories', 'tableTypes'));
    }

    public function cruises(Request $request)
    {
        $bookings = Booking::with(['service', 'service.category', 'addon'])
            ->where('type', 'cruise')
            ->when(!empty($request->category_id), function ($query) use ($request) {
                $query->whereHas('cruise', function ($q) use ($request) {
                    $q->where('category_id', $request->category_id);
                });
            })
            ->when(!empty($request->table_type), function ($query) use ($request) {
                $query->where('table_type', $request->table_type);
            })
            ->when(!empty($request->start_at), function ($query) use ($request) {
                $query->whereDate('start_at', '>=', date('Y-m-d', strtotime($request->start_at)));
            })
            ->when(!empty($request->end_at), function ($query) use ($request) {
                $query->whereDate('end_at', '<=', date('Y-m-d', strtotime($request->end_at)));
            })
            ->when(!empty($request->booked_from), function ($query) use ($request) {
                $query->whereDate('created_at', '>=', date('Y-m-d', strtotime($request->booked_from)));
            })
            ->when(!empty($request->booked_to), function ($query) use ($request) {
                $query->whereDate('created_at', '<=', date('Y-m-d', strtotime($request->booked_to)));
            })
            ->get();

        $categories = Category::where('type', 'cruise')->get();

        $tableTypes = $this->tableTypes;

        return view('admin.bookings.cruises')->with(compact('bookings', 'categories', 'tableTypes'));
    }

    public function cabs(Request $request)
    {
        $bookings = CabBookings::with(['payment'])->get();
        $categories = CabPricings::pluck('category')->unique()->values();
        if($request->has('dump')) {
            dd($bookings);
        }
        $tableTypes = $this->tableTypes;
        return view('admin.bookings.cabs')->with(compact('bookings', 'categories', 'tableTypes'));
    }

    public function bikes(Request $request)
    {
        $bookings = RentalBookings::with('bikes', 'payment')->where('category', 'Bike Rent')
            ->when(!empty($request->location), function ($query) use ($request) {
                $query->where('to_location', $request->location);
            })
            ->when(!empty($request->pickup_type), function ($query) use ($request) {
                $query->where('pickup', $request->pickup_type);
            })
            ->when(!empty($request->start_at), function ($query) use ($request) {
                $query->whereDate('pickup_date', '>=', date('Y-m-d', strtotime($request->start_at)));
            })
            ->when(!empty($request->end_at), function ($query) use ($request) {
                $query->whereDate('return_date', '<=', date('Y-m-d', strtotime($request->end_at)));
            })
            ->when(!empty($request->booked_from), function ($query) use ($request) {
                $query->whereDate('created_at', '>=', date('Y-m-d', strtotime($request->booked_from)));
            })
            ->when(!empty($request->booked_to), function ($query) use ($request) {
                $query->whereDate('created_at', '<=', date('Y-m-d', strtotime($request->booked_to)));
            })
            ->get();

        $locations = RentalBookings::where('category', 'Bike Rent')->pluck('to_location')->filter()->unique()->values();
        $types = RentalBookings::where('category', 'Bike Rent')->pluck('pickup')->filter()->unique()->values();
        return view('admin.bookings.bikes')->with(compact('bookings', 'locations', 'types'));
    }

    public function cruiseBookings(Request $request)
    {
        $bookings = FerryBookings::with(['passengerDetails'])->where('booking_mode', '!=', 'package')
            ->when(!empty($request->start_at), function ($query) use ($request) {
                $query->whereDate('start_at', '>=', date('Y-m-d', strtotime($request->start_at)));
            })
            ->when(!empty($request->end_at), function ($query) use ($request) {
                $query->whereDate('end_at', '<=', date('Y-m-d', strtotime($request->end_at)));
            })
            ->when(!empty($request->booked_from), function ($query) use ($request) {
                $query->whereDate('created_at', '>=', date('Y-m-d', strtotime($request->booked_from)));
            })
            ->when(!empty($request->booked_to), function ($query) use ($request) {
                $query->whereDate('created_at', '<=', date('Y-m-d', strtotime($request->booked_to)));
            })
            ->when(!empty($request->table_type), function ($query) use ($request) {
                $query->where('table_type', $request->table_type);
            })
            ->when(!empty($request->booking_status), function ($query) use ($request) {
                $query->where('booking_status', $request->booking_status);
            })
            ->when(!empty($request->payment_status), function ($query) use ($request) {
                $query->where('payment_status', $request->payment_status);
            })
            ->when(!empty($request->from_location), function ($query) use ($request) {
                $query->where('from_location', $request->from_location);
            })
            ->when(!empty($request->to_location), function ($query) use ($request) {
                $query->where('to_location', $request->to_location);
            })
            ->get();

        $tableTypes = $this->tableTypes;

        $fromLocations = FerryBookings::whereNotNull('from_location')
            ->distinct()
            ->pluck('from_location')
            ->filter()
            ->sort()
            ->values()
            ->toArray();

        $toLocations = FerryBookings::whereNotNull('to_location')
            ->distinct()
            ->pluck('to_location')
            ->filter()
            ->sort()
            ->values()
            ->toArray();

        return view('admin.bookings.cruise-bookings')->with(compact('bookings', 'tableTypes', 'fromLocations', 'toLocations'));
    }


    public function boatTrips(Request $request)
    {
        $bookings = BoatTripBookings::with('payment')->get();
        if($request->has('dump')) {
        dd($bookings->toArray());
        }
        return view('admin.bookings.boat-trips')->with(compact('bookings'));
    }


    public function deleteBoatTrip($id)
    {
        $trip = BoatTripBookings::find($id);
        return response()->json(['response' => $trip]);
    }
}


