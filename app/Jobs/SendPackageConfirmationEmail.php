<?php

namespace App\Jobs;

use App\Models\HotelBookings;
use App\Models\TempItinerary;
use App\Models\FerryBookings;
use App\Models\PackagePricing;
use App\Models\RazorpayTransactions;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendPackageConfirmationEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $packageId;
    public $email;

    public function __construct($packageId, $email)
    {
        $this->packageId = $packageId;
        $this->email = $email;
    }

    public function handle()
    {
        $debugPath = storage_path('app/test');
        if (!is_dir($debugPath))
            mkdir($debugPath, 0775, true);

        $tempItinerary = TempItinerary::with('tour')->where('search_hash', $this->packageId)->first();
        $lastItinerary = TempItinerary::where('search_hash', $this->packageId)->latest('id')->first();

        $lastStartDate = $lastItinerary?->start_date;

        $itinerary = TempItinerary::with([
            'tour.tourCategory',
            'ferries',
            'accomodation',
            'tour.TourItinerary.activities.activity',
            'tour.TourItinerary.services',
            'tour.inclusions'
        ])
            ->where('search_hash', $this->packageId)
            ->get();
        $guest = RazorpayTransactions::where('booking_id', $this->packageId)->first();

        $hotelBookings = HotelBookings::with(['passengerDetailPackage', 'hotel', 'PackagepaymentDetails'])
            ->where('package_id', $this->packageId)
            ->get();

        \Log::info('Hotel Bookings:', $hotelBookings->toArray());

        $hotelPdfs = [];
        foreach ($hotelBookings as $booking) {
            $pdf = Pdf::loadView('hotels.static.package_voucher', ['bookingDetail' => $booking]);
            $pdfData = $pdf->output();
            $code = $booking->booking_code ?: 'unknown';
            $safeCode = preg_replace('/[^A-Za-z0-9\-_]/', '_', $code);
            $fileName = 'Hotel-Voucher-' . $safeCode . '.pdf';
            file_put_contents($debugPath . '/' . $fileName, $pdfData);
            $hotelPdfs[] = ['data' => $pdfData, 'name' => $fileName, 'path' => $debugPath . '/' . $fileName];
        }

        $ferryBookings = FerryBookings::where('package_id', $this->packageId)
            ->whereIn('booking_status', ['1', '2'])
            ->get();

        $ferryPdfs = [];
        foreach ($ferryBookings as $booking) {
            if (!empty($booking->base_code)) {
                $pdfData = base64_decode($booking->base_code);
                $code = $booking->pnr_no ?: 'ferry';
                $safeCode = preg_replace('/[^A-Za-z0-9\-_]/', '_', $code);
                $fileName = 'Ferry-Voucher-' . $safeCode . '.pdf';
                file_put_contents($debugPath . '/' . $fileName, $pdfData);
                $ferryPdfs[] = ['data' => $pdfData, 'name' => $fileName, 'path' => $debugPath . '/' . $fileName];
            }
        }
        $pricing = PackagePricing::where('search_hash', $this->packageId)->first();
        $itineraryPdf = Pdf::loadView('tours.itinerary', compact('itinerary', 'pricing'))
            ->setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);
        $itineraryPdfData = $itineraryPdf->output();
        $itineraryFileName = 'Itinerary-' . ($guest->booking_id ?? 'unknown') . '.pdf';
        file_put_contents($debugPath . '/' . $itineraryFileName, $itineraryPdfData);
        $itineraryPdfArr = ['data' => $itineraryPdfData, 'name' => $itineraryFileName, 'path' => $debugPath . '/' . $itineraryFileName];

        $roomGuests = json_decode($tempItinerary->guest, true) ?? [];
        $totalAdults = 0;
        $totalChildren = 0;
        $totalRooms = count($roomGuests);
        foreach ($roomGuests as $room) {
            $totalAdults += (int) ($room['Adults'] ?? 0);
            $totalChildren += (int) ($room['Children'] ?? 0);
        }


        $body = view('emails.package_tickets', [
            'packageId' => $this->packageId,
            'guestName' => $guest->name ?? 'Customer',
            'packageName' => $tempItinerary->tour->package_name ?? 'Your Package',
            'itinerary' => $tempItinerary,
            'totalAdults' => $totalAdults,
            'totalChildren' => $totalChildren,
            'totalRooms' => $totalRooms,
            'tour' => $itinerary[0]->tour,
            'hotelBookings' => $hotelBookings,
            'ferryBookings' => $ferryBookings,
            'endDate' => $lastStartDate,
            'activities' => optional($itinerary[0]->tour)->TourItinerary ?? collect(),
        ])->render();
        $guestName = $guest->name ?? 'Guest';
        try {
            Mail::send([], [], function ($message) use ($body, $guest, $hotelPdfs, $ferryPdfs, $itineraryPdfArr, $guestName) {
                $message->from('booking@andamanbliss.com', 'Andaman Bliss')
                    ->to($guest->email)
                    ->cc('info@andamanbliss.com')
                    ->subject('🎉 Congratulation Dear ' . $guestName . ', Your Andaman Trip Booking is Confirmed!')
                    ->html($body);

                foreach (array_merge($hotelPdfs, $ferryPdfs, [$itineraryPdfArr]) as $pdf) {
                    if (!empty($pdf['data']))
                        $message->attachData($pdf['data'], $pdf['name'], ['mime' => 'application/pdf']);
                }
            });

            foreach (array_merge($hotelPdfs, $ferryPdfs, [$itineraryPdfArr]) as $pdf) {
                if (file_exists($pdf['path']))
                    unlink($pdf['path']);
            }

            Log::info("Package confirmation email sent successfully", ['packageId' => $this->packageId]);
        } catch (\Exception $e) {
            Log::error("Failed to send package confirmation email", [
                'packageId' => $this->packageId,
                'error' => $e->getMessage()
            ]);
        }
    }
}
