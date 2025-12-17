<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\GoogleReviewPhotoService;

class FetchReviewPhotos extends Command
{
    protected $signature = 'google:fetch-review-photos';
    protected $description = 'Fetch all Google review images and store them';

    public function handle()
    {
        $service = new GoogleReviewPhotoService();
        $result = $service->fetchAndStorePhotos();

        if ($result['success']) {
            $this->info("Saved {$result['saved']} new photos (Total: {$result['total']})");
        } else {
            $this->error("Failed: " . $result['message']);
        }
    }
}
