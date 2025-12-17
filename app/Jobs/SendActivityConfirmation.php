<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Booking;
use App\Http\Controllers\ActivityController;

class SendActivityConfirmation implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $bookingId;

    /**
     * Create a new job instance.
     */
     public function __construct($bookingId)
    {
        $this->bookingId = $bookingId;
    }

    /**
     * Execute the job.
     */
     public function handle()
    {
        $controller = new ActivityController;
        $controller->activityEnquiry($this->bookingId);
        $controller->sendActivityConfirmationToGuest($this->bookingId);
    }
}
