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
        $this->sealinkService = $sealinkService;
        $this->makruzzApiService = $makruzzApiService;
        $this->tboHotelService = $tboHotelService;

        Log::info('ProcessBookingJob started for bookingId: ' . $this->bookingId);

        $bookingId = $this->bookingId;

        $itinerary = TempItinerary::where('search_hash', $bookingId)->get();

        $hotels = HotelBookings::whereIn('package_id', $itinerary->pluck('search_hash'))
            ->where('mode', 'package')
            ->where('Status', 0)
            ->get();

        $ferries = FerryBookings::whereIn('package_id', $itinerary->pluck('search_hash'))
            ->where('booking_mode', 'package')
            ->where('booking_status', 0)
            ->get();

        $passengers = PassengerDetails::where('booking_id', $bookingId)
            ->where('purpose', 'Package booking')
            ->get();

        $paymentDetail = RazorpayTransactions::where('booking_id', $bookingId)
            ->where('purpose', 'Package booking')
            ->first();

        $hotelPayloads = [];
        foreach ($hotels as $hotelBooking) {
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
            if (!$hotelBooking)
                continue;

            try {
                $confirmBookResponse = $this->tboHotelService->confirmRoom($payload);
                $bookResult = $confirmBookResponse['BookResult'] ?? [];
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

        foreach ($ferries as $ferryBooking) {
            if ($ferryBooking->booking_status != 0)
                continue;

            try {
                $result = null;
                if (strtolower($ferryBooking->ferry) === 'nautika') {
                    $paxList = [];
                    foreach ($passengers as $index => $guest) {
                        $paxList[] = [
                            "id" => $index + 1,
                            "name" => trim($guest->name . ' ' . $guest->last_name),
                            "age" => (string) ($guest->age ?? 0),
                            "gender" => match (strtolower($guest->gender ?? '')) {
                                'male', 'm' => 'M',
                                'female', 'f' => 'F',
                                default => '',
                            },
                            "nationality" => $guest->nationality ?? 'India',
                            "passport" => $guest->pass_no ?? '',
                            "tier" => $guest->tier ?? '',
                            "seat" => $guest->seat_no ?? '',
                            "isCancelled" => 0,
                        ];
                    }
                    $nautikaPayload = [
                        "bookingData" => [
                            [
                                "bookingTS" => time(),
                                "id" => $ferryBooking->trip_no,
                                "tripId" => $ferryBooking->trip_id,
                                "vesselID" => $ferryBooking->vesselId,
                                "from" => $ferryBooking->from_location,
                                "to" => $ferryBooking->to_location,
                                "paxDetail" => [
                                    "email" => $paymentDetail?->email ?? '',
                                    "phone" => $paymentDetail?->phone ?? '',
                                    "gstin" => $paymentDetail?->gst ?? '',
                                    "pax" => $paxList,
                                    "infantPax" => [],
                                    "bClassSeats" => [],
                                    "pClassSeats" => []
                                ],
                                "userData" => [
                                    "apiUser" => [
                                        "userName" => env('SEALINK_API_USERNAME'),
                                        "agency" => '',
                                        "token" => config('services.sealink.token'),
                                        "walletBalance" => 0,
                                    ]
                                ],
                                "paymentData" => [
                                    "gstin" => $paymentDetail?->gst ?? ''
                                ]
                            ]
                        ],
                        "userName" => env('SEALINK_API_USERNAME'),
                        "token" => config('services.sealink.token'),
                    ];
                    $result = $this->getFerryService('Nautika', $nautikaPayload);
                }

                if (strtolower($ferryBooking->ferry) === 'makruzz') {
                    $passengerData = [];
                    $index = 1;
                    foreach ($passengers as $guest) {
                        $passengerData[$index++] = [
                            "title" => strtoupper($guest->prefix ?? 'MR'),
                            "name" => trim($guest->name . ' ' . $guest->last_name),
                            "age" => (string) ($guest->age ?? '0'),
                            "sex" => strtoupper($guest->gender ?? 'male'),
                            "nationality" => strtoupper($guest->nationality ?? 'indian'),
                            "fcountry" => strtoupper($guest->nationality ?? 'indian'),
                            "fpassport" => $guest->id_no ?? '',
                            "fexpdate" => ""
                        ];
                    }
                    $preparedBookingData = [
                        "ferry" => "Makruzz",
                        "passenger" => $passengerData,
                        "c_name" => $paymentDetail?->name ?? 'Default Name',
                        "c_mobile" => $paymentDetail?->phone ?? '0000000000',
                        "c_email" => $paymentDetail?->email ?? 'info@example.com',
                        "p_contact" => $paymentDetail?->phone ?? '0000000000',
                        "c_remark" => "live",
                        "no_of_passenger" => (string) count($passengerData),
                        "schedule_id" => $ferryBooking->trip_id,
                        "travel_date" => isset($ferryBooking->travel_date) ? date('Y-m-d', strtotime($ferryBooking->travel_date)) : date('Y-m-d'),
                        "class_id" => $ferryBooking->class_id,
                        "fare" => $ferryBooking->base_fare,
                        "tc_check" => true
                    ];
                    $result = $this->getFerryService('Makruzz', $preparedBookingData);

                    if ($result && isset($result['pnr'])) {
                        $ferryBooking->update([
                            'pnr' => $result['pnr'],
                            'pdf_base64' => $result['pdf_base64'] ?? null,
                            'booking_status' => 1,
                        ]);
                    } else {
                        $ferryBooking->update(['booking_status' => 2]);
                    }
                }


            } catch (\Exception $e) {
                $ferryBooking->update(['booking_status' => 2]);
                Log::error('Ferry booking failed', [
                    'booking_id' => $ferryBooking->id,
                    'error' => $e->getMessage()
                ]);
            }
        }

        $controller = app(TourController::class);
        $controller->sendMailToGuest($bookingId);
    }

    public function getFerryService($ferry, $bookingData)
    {
        if ($ferry === 'Nautikaa') {
            try {
                $bookSealink = $this->sealinkService->bookSeatsAuto($bookingData);
                if (isset($bookSealink[0]['seatStatus']) && $bookSealink[0]['seatStatus']) {
                    return [
                        'pnr' => $bookSealink[0]['pnr'],
                        'pdf_base64' => $bookSealink[0]['pdf_base64'] ?? null
                    ];
                }
                return false;
            } catch (\Exception $e) {
                return ['status' => 'error', 'ferry' => 'Nautika', 'message' => $e->getMessage()];
            }
        }

        if ($ferry === 'Makruzz') {
            try {
                $savePassenger = $this->makruzzApiService->savePassengers(['bookingData' => $bookingData]);
                $bookingId = $savePassenger['data']['booking_id'];
                $confirmBooking = $this->makruzzApiService->confirmBooking($bookingId);


                $confirmBookingData = $confirmBooking->getData(true); // returns array already
                Log::info('Makruzz confirmBooking response', [
                    'bookingId' => $bookingId,
                    'response' => is_array($confirmBookingData) ? $confirmBookingData : json_decode($confirmBookingData, true)
                ]);

                if (!isset($confirmBookingData['data']['pnr']))
                    return false;
                $pnr = $confirmBookingData['data']['pnr'];
                $getTicketResponse = $this->makruzzApiService->downloadTicket($bookingId);
                if (!$getTicketResponse)
                    return false;
                $pdfBase64 = $getTicketResponse->getContent();
                return ['pnr' => $pnr, 'booking_id' => $bookingId, 'pdf_base64' => $pdfBase64];
            } catch (\Exception $e) {
                return ['status' => 'error', 'ferry' => 'Makruzz', 'message' => $e->getMessage()];
            }
        }

        return ['status' => 'error', 'ferry' => $ferry, 'message' => 'Unsupported ferry service'];
    }
}
