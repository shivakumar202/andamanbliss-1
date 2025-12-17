<?php

namespace App\Console\Commands;

use App\Http\Controllers\TourController;
use App\Models\RazorpayTransactions;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CancelReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'booking:cancel-remainder';
    protected $description = 'Send booking cancel reminder emails';

    /**
     * The console command description.
     *
     * @var string
     */

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $cutoffTime = Carbon::now()->subMinutes(15);
        $limit = Carbon::now()->subMinutes(5);

        $payments = RazorpayTransactions::where('purpose', 'Package Booking')
            ->whereNotIn('status', ['completed', 'cancelled'])
            ->where('created_at', '<=', $limit)
            ->get();


        $controller = app(\App\Http\Controllers\TourController::class);

        foreach ($payments as $payment) {
            if ($payment->created_at <= $cutoffTime) {
                if ($payment->status != 'cancelled') {
                    $payment->update(['status' => 'cancelled']);
                    $controller->CancelAlert($payment->booking_id);
                    $payment->update(['reminder_sent' => 1]);
                }
            } else {
                if (!$payment->reminder_sent) {
                    $controller->Cancelremainder($payment->booking_id);
                    $payment->update(['reminder_sent' => 1]);
                }
            }
        }

        $this->info('Booking reminder email processed successfully!');
    }
}
