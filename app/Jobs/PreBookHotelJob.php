<?php

namespace App\Jobs;

use Illuminate\Foundation\Bus\Dispatchable;
use App\Models\temp_itineraries;
use App\Services\TboHotelService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Bus\Batchable; // ← add this

use Throwable;

class PreBookHotelJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, Batchable; // ← added Batchable here

    protected $payload;

    public function __construct(array $payload)
    {
        $this->payload = $payload;
    }

    public function handle(TboHotelService $tboHotelService)
    {
        try {
            $response = $tboHotelService->preBook($this->payload);

            \Log::info('PreBook success', [
                'batch_id' => $this->batchId, // now you can access the batch ID
                'payload' => $this->payload,
                'response' => $response
            ]);
        } catch (Throwable $e) {
            \Log::error('PreBook failed', [
                'batch_id' => $this->batchId,
                'payload' => $this->payload,
                'error' => $e->getMessage()
            ]);
        }
    }
}