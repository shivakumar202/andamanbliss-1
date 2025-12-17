<?php

namespace App\Jobs;

use App\Models\CabBookings;
use App\Models\Cabs;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendCabBookingMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $bookingId;
    /**
     * Create a new job instance.
     */
    public function __construct(int $bookingId)
    {
        $this->bookingId = $bookingId;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::info("Send Cab Confirmation mail for Booking Id : {$this->bookingId}");

        try{
            $billingDetails = CabBookings::with(['payment'])->find($this->bookingId);

            $cab = Cabs::where('id', $billingDetails->cab_id)->first();

            if(!$billingDetails)
            {
                Log::warning("Booking not Found");
                return;
            }

            $pdf = Pdf::loadView('cabs.bookings.bill',compact('billingDetails','cab'))->setOptions(['isHtml5ParserEnabled' => true,'isRemoteEnabled' => true ]);

            Mail::send('emails.cab_confirm',[
                'billingDetails' => $billingDetails,
            ], function($message) use ($billingDetails,$pdf) {
                $message->from(env('MAIL_FROM_ADDRESS','info@andamanbliss.com'), env('MAIL_FROM_NAME','Andaman Bliss'))->to($billingDetails->payment->email)->subject('🎉Booking Confirmed - Your Cab Booking Details')->attachData($pdf->output(),'Andaman Bliss Cab Booking.pdf');
            });

            Log::info('Email Confrimation Sent');

        } catch (\Exception $e) {
            Log::error("Cab Rental confrimation Mail Failed BookingID:{$this->bookingId}");
            throw $e;
        }
    }
}
