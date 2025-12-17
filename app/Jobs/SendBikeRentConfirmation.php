<?php

namespace App\Jobs;

use App\Models\RentalBookings;
use App\Models\Service;
use App\Models\BikePickLocation;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendBikeRentConfirmation implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $bookingId;

    public function __construct(int $bookingId)
    {
        $this->bookingId = $bookingId;
    }


    public function handle(): void
    {
        Log::info("SendBikeRentConfirmation started for bookingId: {$this->bookingId}");

        try {
            $billingDetails = RentalBookings::with(['cabPackages.cabPricing', 'payment'])
                ->find($this->bookingId);

            if (!$billingDetails) {
                Log::warning("Booking not found for bookingId: {$this->bookingId}");
                return;
            }

            $cab = Service::whereIn('type', ['cab', 'bike'])
                ->where('id', $billingDetails->vehicle_id)->first();
            $location = BikePickLocation::where('name', $billingDetails->from_location)->first();

            Log::info("BillingDetails, Cab, Location loaded for bookingId: {$this->bookingId}");

            $pdf = Pdf::loadView('pages.bill', compact('billingDetails', 'cab', 'location'))
                ->setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);

            Log::info("PDF generated for bookingId: {$this->bookingId}");

            Mail::send('emails.bike_confirm', [
                'billingDetails' => $billingDetails,
                'cab' => $cab,
                'location' => $location
            ], function ($message) use ($billingDetails, $pdf) {
                $message->from(env('MAIL_FROM_ADDRESS', 'info@andamanbliss.com'), env('MAIL_FROM_NAME', 'Andaman Bliss'))
                    ->to($billingDetails->payment->email)
                    ->subject('🎉Booking Confirmed - Your Bike Rental Details')
                    ->attachData($pdf->output(), 'Andaman_Bliss_Bike_Rental.pdf');
            });

            Log::info("Email sent successfully for bookingId: {$this->bookingId}");
        } catch (\Exception $e) {
            Log::error("SendBikeRentConfirmation failed for bookingId {$this->bookingId}: " . $e->getMessage());
            throw $e; // ensures job retries or fails visibly
        }
    }
}
