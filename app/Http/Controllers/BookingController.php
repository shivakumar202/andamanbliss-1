<?php

namespace App\Http\Controllers;

use App\Models\BoatTripBookings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Constraint;
use Intervention\Image\Facades\Image;
use App\Models\Drive;
use App\Models\User;
use App\Models\Category;
use App\Models\Booking;
use App\Models\CabBookings;
use App\Models\FerryBookings;
use App\Models\HotelBookings;
use App\Models\PassengerDetails;
use App\Models\RazorpayTransactions;
use App\Models\RentalBookings;
use App\Models\TempItinerary;

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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('bookings.index');
    }

    public function tours(Request $request)
    {
        $creds = [
            'id' => auth()->user()->id,
            'name' => auth()->user()->name,
            'phone' => auth()->user()->mobile,
            'email' => auth()->user()->email,
        ];

        $bookings = RazorpayTransactions::whereHas('packageBookings', function ($q) use ($creds) {
            $q->where('user_id', $creds['id']);
        })->where('purpose', 'Package Booking')
            ->where('email', $creds['email'])
            ->where('phone', $creds['phone'])
            ->orderBy('id', 'DESC')
            ->paginate(10);

        foreach ($bookings as $book) {
            $book->itinerary = TempItinerary::where('search_hash', $book->booking_id)->get();
        }

        // Debug single record


        return view('bookings.tours', compact('bookings'));
    }


    public function hotels(Request $request)
    {
        $creds = [
            'id' => auth()->user()->id,
            'name' => auth()->user()->name,
            'phone' => auth()->user()->mobile,
            'email' => auth()->user()->email,
        ];
        $bookings = HotelBookings::with('paymentDetails', 'hotel')->where('user_id',$creds['id'])->where('mode', 'hotel')->paginate(10);



        return view('bookings.hotels')->with(compact('bookings'));
    }

    public function activities(Request $request)
    {
        $creds = [
            'id' => auth()->user()->id,
            'name' => auth()->user()->name,
            'phone' => auth()->user()->mobile,
            'email' => auth()->user()->email,
        ];

        $bookings = Booking::with(['activityBook', 'activity'])->where('user_id',$creds['id'])->where('type', 'activity')->paginate(10);
        return view('bookings.activities', compact('bookings'));
    }


    public function cruises(Request $request)
    {
        $creds = [
            'id' => auth()->user()->id,
            'name' => auth()->user()->name,
            'phone' => auth()->user()->mobile,
            'email' => auth()->user()->email,
        ];
        $bookings = FerryBookings::where('user_id',$creds['id'])->where('booking_mode', 'online')->orderBy('id', 'DESC')->paginate(10);



        return view('bookings.cruises')->with(compact('bookings'));
    }

    public function cabs(Request $request)
    {
        $creds = [
            'id' => auth()->user()->id,
            'name' => auth()->user()->name,
            'phone' => auth()->user()->mobile,
            'email' => auth()->user()->email,
        ];
        $bookings = CabBookings::with(['cabs'])->where('user_id',$creds['id'])->paginate(10);

        return view('bookings.cabs')->with(compact('bookings'));
    }

    public function bikes(Request $request)
    {


        $creds = [
            'id' => auth()->user()->id,
            'name' => auth()->user()->name,
            'phone' => auth()->user()->mobile,
            'email' => auth()->user()->email,
        ];

        $bookings = RentalBookings::with('bikes')->where('user_id',$creds['id'])->orderBy('id', 'DESC')->paginate(10);

        // ->paginate(10); // Paginate with 10 items per page

        return view('bookings.bikes')->with(compact('bookings'));
    }

    public function tourDetails($tourId)
    {
        $detail = TempItinerary::with(['TourPricing', 'ferries', 'accomodation', 'payments', 'tour.tourCategory', 'tour.TourItinerary', 'hotelbookings'])
            ->where('search_hash', $tourId)
            ->get();

        $guests = PassengerDetails::where('booking_id', $tourId)->where('purpose', 'Package booking')->get();
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
        return view('bookings.tour-details', compact('data'));
    }

    public function boatTrips(Request $request)
    {
         $creds = [
            'id' => auth()->user()->id,
            'name' => auth()->user()->name,
            'phone' => auth()->user()->mobile,
            'email' => auth()->user()->email,
        ];
        $bookings = BoatTripBookings::with(['payment'])->where('user_id',$creds['id'])->orderBy('id', 'DESC')->paginate(10);

        return view('bookings.boat-trips')->with(compact('bookings'));
    }
}
