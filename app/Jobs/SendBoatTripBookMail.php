<?php

namespace App\Jobs;

use App\Models\BoatTripBookings;
use App\Models\BoatTrips;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendBoatTripBookMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $bookingId;
    /**
     * Create a new job instance.
     */
    public function __construct(int $bookingId)
    {
        $this->bookingId = $bookingId;
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::info('Sending boat trip confirmation email...');

        try {
            $billingDetails = BoatTripBookings::with(['payment', 'pax'])->find($this->bookingId);

            if (!$billingDetails) {
                Log::warning("Booking not found for ID {$this->bookingId}");
                return;
            }

            $trip = BoatTrips::find($billingDetails->boat_trip_id);

            try {
                $pdf = Pdf::loadView('boat-trips.booking.bill', compact('billingDetails', 'trip'))
                    ->setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);
            } catch (\Exception $e) {
                Log::error("PDF generation failed: {$e->getMessage()}");
                return;
            }

            Mail::send('emails.boat_confirm', [
                'billingDetails' => $billingDetails,
            ], function ($message) use ($billingDetails, $pdf) {
                $message->from(env('MAIL_FROM_ADDRESS', 'info@andamanbliss.com'), env('MAIL_FROM_NAME', 'Andaman Bliss'))
                    ->to($billingDetails->payment->email)
                    ->subject('🎉 Booking Confirmed - Your Boat Trip Details')
                    ->attachData($pdf->output(), 'Andaman Bliss Boat Trip Booking.pdf');
            });

            Log::info("Boat trip confirmation email sent successfully to {$billingDetails->payment->email}");
        } catch (\Exception $e) {
            Log::error("Boat trip confirmation job failed: {$e->getMessage()}");
            throw $e;
        }
    }
}
