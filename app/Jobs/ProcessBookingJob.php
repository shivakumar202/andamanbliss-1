<?php

namespace App\Jobs;

use App\Http\Controllers\TourController;
use App\Models\FerryBookings;
use App\Models\HotelBookings;
use App\Models\PassengerDetails;
use App\Models\RazorpayTransactions;
use App\Models\TempItinerary;
use Illuminate\Bus\Queueable;
use App\Services\MakruzzApiService;
use App\Services\SealinkService;
use App\Services\TboHotelService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class ProcessBookingJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $bookingId;
    protected $sealinkService;
    protected $makruzzApiService;
    protected $tboHotelService;

    public function __construct(int $bookingId)
    {
        $this->bookingId = $bookingId;
    }

    public function handle(SealinkService $sealinkService, MakruzzApiService $makruzzApiService, TboHotelService $tboHotelService)
    {
        Log::info("ProcessBookingJob started", ['bookingId' => $this->bookingId]);

        $this->sealinkService = $sealinkService;
        $this->makruzzApiService = $makruzzApiService;
        $this->tboHotelService = $tboHotelService;

        $bookingId = $this->bookingId;
        $itinerary = TempItinerary::where('search_hash', $bookingId)->get();
        Log::info("Fetched TempItinerary", ['count' => $itinerary->count()]);

        $hotels = HotelBookings::whereIn('package_id', $itinerary->pluck('search_hash'))
            ->where('mode', 'package')
            ->where('Status', 0)
            ->get();
        Log::info("Fetched HotelBookings", ['count' => $hotels->count()]);

        $ferries = FerryBookings::whereIn('package_id', $itinerary->pluck('search_hash'))
            ->where('booking_mode', 'package')
            ->where('booking_status', 0)
            ->get();
        Log::info("Fetched FerryBookings", ['count' => $ferries->count()]);

        $passengers = PassengerDetails::where('booking_id', $bookingId)
            ->where('purpose', 'Package booking')
            ->get();
        Log::info("Fetched PassengerDetails", ['count' => $passengers->count()]);

        $paymentDetail = RazorpayTransactions::where('booking_id', $bookingId)
            ->where('purpose', 'Package booking')
            ->first();
        Log::info("Fetched RazorpayTransactions", ['exists' => !empty($paymentDetail)]);

        $hotelPayloads = [];
        foreach ($hotels as $hotelBooking) {
            Log::info("Processing HotelBooking", ['booking_code' => $hotelBooking->booking_code]);

            $validation = json_decode($hotelBooking->validation, true) ?? [];
            $grouped = $passengers->groupBy('group');
            $hotelRoomsDetails = [];

            foreach ($grouped as $room => $guests) {
                $roomPassengers = [];
                foreach ($guests as $index => $guest) {
                    $passenger = [
                        "Title" => $guest->prefix,
                        "FirstName" => $guest->name,
                        "MiddleName" => $guest->m_name,
                        "LastName" => $guest->last_name,
                        "Email" => $guest->email,
                        "PaxType" => $guest->type,
                        "LeadPassenger" => (bool) $guest->lead,
                        "Age" => $guest->type == 2 ? ($guest->age ?? 0) : 0,
                        "Phoneno" => $guest->phone,
                        "PaxId" => $index,
                    ];
                    if (!empty($validation['PanMandatory']))
                        $passenger['PAN'] = $guest->id_no ?? null;
                    if (!empty($validation['PassportMandatory'])) {
                        $passenger['PassportNo'] = $guest->pass_no ?? null;
                        $passenger['PassportIssueDate'] = $guest->pass_issue ?? null;
                        $passenger['PassportExpDate'] = $guest->pass_exp ?? null;
                    }
                    if (!empty($validation['GSTAllowed'])) {
                        $passenger['GSTNumber'] = $guest->gst ?? null;
                        $passenger['GSTCompanyAddress'] = $guest->gst_company_address ?? null;
                        $passenger['GSTCompanyContactNumber'] = $guest->gst_company_contact ?? null;
                        $passenger['GSTCompanyName'] = $guest->gst_company_name ?? null;
                        $passenger['GSTCompanyEmail'] = $guest->gst_company_email ?? null;
                    }
                    $roomPassengers[] = array_filter($passenger, fn($v) => !is_null($v));
                }
                $hotelRoomsDetails[] = ["HotelPassenger" => $roomPassengers];
            }
            $hotelPayloads[] = [
                "BookingCode" => $hotelBooking->booking_code,
                "IsVoucherBooking" => false,
                "GuestNationality" => 'IN',
                "EndUserIp" => request()->ip(),
                "TokenId" => Cache::get('tbo_token_id'),
                "RequestedBookingMode" => 5,
                "NetAmount" => $hotelBooking->net_amt,
                "HotelRoomsDetails" => $hotelRoomsDetails
            ];
        }

        foreach ($hotelPayloads as $payload) {
            $hotelBooking = HotelBookings::where('booking_code', $payload['BookingCode'])
                ->where('Status', 0)
                ->first();
            if (!$hotelBooking) {
                Log::warning("HotelBooking not found for payload", ['booking_code' => $payload['BookingCode']]);
                continue;
            }

            try {
                Log::info("Confirming hotel booking", ['booking_code' => $payload['BookingCode']]);
                $confirmBookResponse = $this->tboHotelService->confirmRoom($payload);
                $bookResult = $confirmBookResponse['BookResult'] ?? [];
                Log::info("Hotel booking response", ['booking_code' => $payload['BookingCode'], 'response' => $bookResult]);

                $hotelBooking->update([
                    'BookingId' => $bookResult['BookingId'] ?? null,
                    'TraceId' => $bookResult['TraceId'] ?? null,
                    'ConfirmationNo' => $bookResult['ConfirmationNo'] ?? null,
                    'HotelBookingStatus' => $bookResult['HotelBookingStatus'] ?? 'pending',
                    'Status' => isset($bookResult['BookingId']) ? 1 : 2,
                ]);
            } catch (\Exception $e) {
                $hotelBooking->update(['Status' => 2]);
                Log::error('Hotel booking failed', [
                    'booking_code' => $payload['BookingCode'],
                    'error' => $e->getMessage()
                ]);
            }
        }

        $nautikaFerries = ['Nautika Seaways', 'Nautika'];
        $makruzzFerries = ['Makruzz', 'Makruzz Gold', 'Makruzz Pearl'];

        foreach ($ferries as $ferryBooking) {
            if ($ferryBooking->booking_status != 0) continue;
            try {
                $ferryName = trim($ferryBooking->ferry);
                Log::info("Processing FerryBooking", ['ferry' => $ferryName, 'trip_id' => $ferryBooking->trip_id]);
                $result = null;

                if (in_array($ferryName, $nautikaFerries)) {
                    Log::info("Sending Nautika booking request", ['booking_id' => $ferryBooking->id]);
                    $result = $this->getFerryService('Nautika', []);
                }

                if (in_array($ferryName, $makruzzFerries)) {
                    Log::info("Sending Makruzz booking request", ['booking_id' => $ferryBooking->id]);
                    $result = $this->getFerryService('Makruzz', []);
                }

                if ($result && isset($result['pnr'])) {
                    Log::info("Ferry booking confirmed", ['pnr' => $result['pnr']]);
                    $ferryBooking->update([
                        'pnr_no' => $result['pnr'],
                        'base_code' => $result['pdf_base64'] ?? null,
                        'booking_status' => 1
                    ]);
                } else {
                    Log::warning("Ferry booking failed / no PNR", ['booking_id' => $ferryBooking->id, 'result' => $result]);
                    $ferryBooking->update(['booking_status' => 2]);
                }

            } catch (\Exception $e) {
                Log::error("Ferry booking exception", ['id' => $ferryBooking->id, 'error' => $e->getMessage()]);
                $ferryBooking->update(['booking_status' => 2]);
            }
        }

        Log::info("Sending confirmation email", ['bookingId' => $bookingId]);
        $controller = app(TourController::class);
        $controller->sendMailToGuest($bookingId);

        Log::info("ProcessBookingJob completed", ['bookingId' => $bookingId]);
    }

    public function getFerryService($ferry, $bookingData)
    {
        Log::info("getFerryService called", ['ferry' => $ferry]);

        if ($ferry === 'Nautika') {
            try {
                $bookSealink = $this->sealinkService->bookSeatsAuto($bookingData);
                Log::info("Nautika response", ['response' => $bookSealink]);
                if (isset($bookSealink[0]['seatStatus']) && $bookSealink[0]['seatStatus']) {
                    return [
                        'pnr' => $bookSealink[0]['pnr'],
                        'pdf_base64' => $bookSealink[0]['pdf_base64'] ?? null
                    ];
                }
                return false;
            } catch (\Exception $e) {
                Log::error("Nautika booking error", ['error' => $e->getMessage()]);
                return ['status' => 'error', 'ferry' => 'Nautika', 'message' => $e->getMessage()];
            }
        }

        if ($ferry === 'Makruzz') {
            try {
                $savePassenger = $this->makruzzApiService->savePassengers(['bookingData' => $bookingData]);
                Log::info("Makruzz savePassengers response", ['response' => $savePassenger]);
                $bookingId = $savePassenger['data']['booking_id'];
                $confirmBooking = $this->makruzzApiService->confirmBooking($bookingId);
                $confirmBookingData = $confirmBooking->getData(true);
                Log::info("Makruzz confirmBooking response", ['response' => $confirmBookingData]);

                if (!isset($confirmBookingData['data']['pnr'])) return false;
                $pnr = $confirmBookingData['data']['pnr'];
                $getTicketResponse = $this->makruzzApiService->downloadTicket($bookingId);
                if (!$getTicketResponse) return false;
                $pdfBase64 = $getTicketResponse->getContent();
                return ['pnr' => $pnr, 'booking_id' => $bookingId, 'pdf_base64' => $pdfBase64];
            } catch (\Exception $e) {
                Log::error("Makruzz booking error", ['error' => $e->getMessage()]);
                return ['status' => 'error', 'ferry' => 'Makruzz', 'message' => $e->getMessage()];
            }
        }

        Log::warning("Unsupported ferry service", ['ferry' => $ferry]);
        return ['status' => 'error', 'ferry' => $ferry, 'message' => 'Unsupported ferry service'];
    }
}
