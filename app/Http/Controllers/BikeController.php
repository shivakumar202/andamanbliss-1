<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Service;
use App\Models\Addon;
use App\Models\BikePickLocation;
use App\Models\Booking;
use App\Models\GoogleReview;
use App\Models\RentalBookings;
use App\Models\ReviewImage;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class BikeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) {}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function bookBike(Request $request)
    {
        $bikes = null;

        if ($request->has('location')) {
            $location = $request->input('location');
            $locationSearch = str_replace('Port Blair', 'Portblair', $location);

            $bikes = Service::where('type', 'bike')
                ->with(['bikePhotos', 'pricing'])
                ->where('address', 'LIKE', '%' . $locationSearch . '%')
                ->get();


            $result = $bikes->map(function ($bike) use ($locationSearch, $location) {
                $photo = $bike->bikePhotos[0]->file ?? null;
                $price = optional(
                    $bike->pricing->firstWhere('location', $locationSearch)
                )->price ?? $bike->adult_price;
                return [
                    'id' => $bike->id,
                    'name' => $bike->name,
                    'description' => Str::words($bike->description, 20, '...'),
                    'first_photo' => $photo,
                    'price' => $price,
                    'address' => $location
                ];
            });


            $bikes = $result;
        }
        
        $reviews = GoogleReview::orderBy('review_date','DESC')->where('comment','!=',null)->where('rating',5)->take(10)->get();
        $review_images = ReviewImage::all();

        $review = GoogleReview::all();
        $rating = [
            'total_reviews' => $review->count(),
            'average_rating' => $review->avg('rating'),
            '5' => $review->where('rating', 5)->count(),
            '4' => $review->where('rating', 4)->count(),
            '3' => $review->where('rating', 3)->count(),
            '2' => $review->where('rating', 2)->count(),
            '1' => $review->where('rating', 1)->count(),
        ];
        
        return view('bikes.booking.index', compact('bikes','reviews','review_images','rating'));
    }

    public function search(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'location' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => 'Validation failed',
                'messages' => $validator->errors()
            ], 422);
        }

        try {
            $location = $request->input('location');
            $locationSearch = str_replace('Port Blair', 'Portblair', $location);

            $bikes = Service::where('type', 'bike')
                ->with(['bikePhotos', 'pricing'])
                ->where('address', 'LIKE', '%' . $locationSearch . '%')
                ->get();

            $result = $bikes->map(function ($bike) use ($locationSearch, $location) {
                $photo = $bike->bikePhotos[0]->file ?? null;

                $price = optional(
                    $bike->pricing->firstWhere('location', $locationSearch)
                )->price ?? $bike->adult_price;
                return [
                    'id' => $bike->id,
                    'name' => $bike->name,
                    'first_photo' => $photo,
                    'price' => $price,
                    'address' => $location
                ];
            });

            return response()->json($result, 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'An error occurred while searching for bikes',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    public function bookingReview(Request $request)
    {
        $params = $request->params;
        $param = json_decode($request->params,true);

        $bikeId = $param['bikeId'];
        $location = $param['location'];
        $pickupDate = $param['pickupdate'];
        $dropoffDate = $param['dropoffdate'];
        $dropoffTime = $request->query('dropofftime');

       
        return view('bikes.booking.show', compact('bikeId', 'location',  'pickupDate',  'dropoffDate' ,'params' ));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        return view('bikes.show');
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



    public function booking(Request $request)
    {
        $statusCode = 404;
        if ($request->ajax()) {
            $latestBooking = Booking::max('booking_id') ?? 0;
            $formattedBookingId = str_pad($latestBooking + 1, 20, '0', STR_PAD_LEFT);

            $service = Service::find($request->id);

            $booking = new Booking;
            $booking->booking_id = $formattedBookingId;
            $booking->table_id = $request->id;
            $booking->table_type = 'services';
            $booking->type = 'bike';
            $booking->room_id = null;
            $booking->food_choice = null;
            $booking->user_id = auth()->user()->id ?? null;
            $booking->name = $request->name;
            $booking->surname = null;
            $booking->mobile = $request->mobile;
            $booking->email = $request->email;
            $booking->address = null;
            $booking->rate = $rate = $service?->adult_price ?? 0.00;
            $booking->quantity = $quantity = $request->adultCount;
            $booking->price = $rate * $quantity;
            $booking->adult = $request->adultCount;
            $booking->child = 0;
            $booking->start_at = date('Y-m-d', strtotime($request->start_at));
            $booking->end_at = null;
            $booking->location = $request->location;
            $booking->destination = null;
            $booking->note = null;
            $booking->status = 'active';
            $booking->save();

            if (!empty($request->addons)) {
                foreach ($request->addons as $key => $value) {
                    $addon = Addon::find($value);

                    $booking = new Booking;
                    $booking->booking_id = $formattedBookingId;
                    $booking->table_id = $value;
                    $booking->table_type = 'addons';
                    $booking->type = 'bike';
                    $booking->room_id = null;
                    $booking->food_choice = null;
                    $booking->user_id = auth()->user()->id ?? null;
                    $booking->name = $request->name;
                    $booking->surname = null;
                    $booking->mobile = $request->mobile;
                    $booking->email = $request->email;
                    $booking->address = null;
                    $booking->rate = $rate = $addon->price ?? 0.00;
                    $booking->quantity = $quantity = 1;
                    $booking->price = $rate * $quantity;
                    $booking->adult = 0;
                    $booking->child = 0;
                    $booking->start_at = date('Y-m-d', strtotime($request->start_at));
                    $booking->end_at = null;
                    $booking->location = $request->location;
                    $booking->destination = null;
                    $booking->note = null;
                    $booking->status = 'active';
                    $booking->save();
                }
            }

            $statusCode = 200;
            return response()->json([
                'status' => $statusCode,
                'message' => __('Booking enquiry form submitted successfully!'),
                'data' => Booking::where('booking_id', $formattedBookingId)->get(),
            ], $statusCode);
        }
    }

    public function voucher($bookingId)
    {
        $billingDetails = RentalBookings::with(['cabPackages.cabPricing', 'payment'])->find($bookingId);

        if (!$billingDetails) {
            return;
        }
        $cab = Service::whereIn('type', ['bike'])->where('id', $billingDetails->vehicle_id)->first();
        $location = BikePickLocation::where('name', $billingDetails->from_location)->first();
        $pdf = Pdf::loadView('pages.bill', compact('billingDetails', 'cab', 'location'))->setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);

        return $pdf->stream('bike rental voucher');
    }
}
