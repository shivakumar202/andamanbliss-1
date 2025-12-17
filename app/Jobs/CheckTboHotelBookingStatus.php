<?php

namespace App\Jobs;

use App\Http\Controllers\HotelController;
use App\Models\HotelBookings;
use App\Services\TboHotelService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;


class CheckTboHotelBookingStatus implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    const MAX_ATTEMPTS = 2;
    const STATUS_CONFIRMED = 'confirmed';
    const STATUS_FAILED = 'failed';

    public $bookingId;
    public $attempt;

    public function __construct($bookingId, $attempt = 1)
    {
        $this->bookingId = $bookingId;
        $this->attempt = $attempt;
    }

    public function handle()
    {
        Log::info("CheckTboHotelBookingStatus started", [
            'bookingId' => $this->bookingId,
            'attempt' => $this->attempt
        ]);

        $booking = HotelBookings::find($this->bookingId);

        if (!$booking) {
            Log::warning("Booking not found", ['bookingId' => $this->bookingId]);
            return;
        }

        if ($booking->status === self::STATUS_CONFIRMED) {
            Log::info("Booking already confirmed", ['bookingId' => $this->bookingId]);
            return;
        }

        try {
            // First try with BookingId (normal success case)
            $response = null;
            if ($booking->BookingId) {
                $response = app(TboHotelService::class)->getBookingStatus($booking->BookingId);
                Log::info("TBO response received with BookingId", ['response' => $response]);
            }

            if (!$response || !isset($response['GetBookingDetailResult'])) {
                $token = Cache::get('tbo_token_id');
                if ($booking->TraceId && $token) {
                    Log::info("Trying fallback TBO response with TraceId and TokenId", [
                        'traceId' => $booking->TraceId,
                        'token' => $token,
                    ]);
                    $response = app(TboHotelService::class)->getBookingStatusByTraceId($booking->TraceId, $token);
                    Log::info("TBO fallback response received", ['response' => $response]);
                }
            }

            $bookingData = $response['GetBookingDetailResult'] ?? [];

            if (
                ($bookingData['HotelBookingStatus'] ?? '') === 'Confirmed' &&
                ($bookingData['Status'] ?? 0) == 1
            ) {
                $booking->update([
                    'ConfirmationNo' => $bookingData['HotelConfirmationNo'] ?? null,
                    'InvoiceNumber' => $bookingData['InvoiceNo'] ?? null,
                    'BookingRefNo' => $bookingData['BookingRefNo'] ?? null,
                    'status' => self::STATUS_CONFIRMED,  // Also update status here
                ]);

                Log::info("Booking confirmed", ['bookingId' => $booking->id]);

                if ($booking->mode != 'package') {
                    $controller = app(HotelController::class);
                    $mailSent = $controller->sendMailToGuest($booking->id);

                    if ($mailSent) {
                        Log::info("Mail sent successfully", ['bookingId' => $booking->id]);
                    } else {
                        Log::warning("Mail sending failed, but booking is confirmed", ['bookingId' => $booking->id]);
                    }
                }
                return;

            }

        } catch (\Exception $e) {
            Log::error("Error while checking booking status", [
                'bookingId' => $this->bookingId,
                'error' => $e->getMessage()
            ]);
        }

        if ($this->attempt < self::MAX_ATTEMPTS) {
            Log::notice("Retrying booking status check", [
                'bookingId' => $this->bookingId,
                'next_attempt' => $this->attempt + 1
            ]);

            self::dispatch($this->bookingId, $this->attempt + 1)->delay(now()->addMinutes(1));
        } else {
            $booking->update(['status' => self::STATUS_FAILED]);
            Log::critical("Max retries reached. Booking marked as failed.", ['bookingId' => $this->bookingId]);
        }
    }

}


