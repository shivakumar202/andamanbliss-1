<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BoatTripBookings;
use App\Models\Booking;
use App\Models\CabBookings;
use App\Models\FerryBookings;
use App\Models\HotelBookings;
use App\Models\RazorpayTransactions;
use App\Models\RentalBookings;
use App\Models\TempItinerary;
use App\Models\TourPackageBook;
use Illuminate\Http\Request;

use function Laravel\Prompts\error;

class DeleteController extends Controller
{

    public function deleteBtrip($id)
    {
        $trip = BoatTripBookings::findOrFail($id);

        $trip->payment()->delete();
        $trip->pax()->delete();
        $trip->delete();

        return response()->json(['status' => 200]);
    }


    public function deleteBikeR($id)
    {
        $bike = RentalBookings::with('payment')->findorfail($id);
        $bike->payment()->delete();
        $bike->delete();
        return response()->json(['status' => 200]);
    }

    public function deleteCab($id)
    {
        $cabBook = CabBookings::with('payment')->findorfail($id);
        $cabBook->payment()->delete();
        $cabBook->delete();
        return response()->json(['status' => 200]);
    }

    public function deleteFerry($id)
    {
        $ferry = FerryBookings::findOrFail($id);
        $ferries = FerryBookings::where('bookno', $ferry->bookno)->get();
        if ($ferries->count() > 1) {
            $ferry->delete();
        } else {
            $ferry->delete();
            RazorpayTransactions::where('purpose', 'Ferry Booking')->where('booking_id', $ferry->bookno)->delete();
        }
        return response()->json(['status' => 200]);
    }

    public function deleteActivity($id)
    {
        $ab = Booking::with('activityBook')->find($id);
        $ab->activityBook()->delete();
        $ab->delete();
        return response()->json(['status' => 200]);
    }

    public function deleteHotel($id)
    {
        $htl = HotelBookings::with(['passengerDetails', 'paymentDetails'])->find($id);
        $htl->passengerDetails()->delete();
        $htl->paymentDetails()->delete();
        $htl->delete();
        return response()->json(['status' => 200]);
    }

    public function deleteTour($id)
    {
        $tour = TempItinerary::with(['ferries', 'payments', 'TourPricing', 'bookedHotels', 'paxangers'])
            ->where('search_hash', $id)
            ->first();

        if (!$tour) {
            return response()->json(['status' => 404, 'message' => 'Tour not found']);
        }

        $tour->ferries()->delete();
        $tour->bookedHotels()->delete();
        $tour->paxangers()->delete();
        $tour->payments()->delete();
        $tour->TourPricing()->delete();

        TempItinerary::where('search_hash', $id)->delete();

        return response()->json(['status' => 200]);
    }
}
