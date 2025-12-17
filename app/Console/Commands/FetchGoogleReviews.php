<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\GoogleReviewController;
use Illuminate\Support\Facades\Log;

class FetchGoogleReviews extends Command
{
    protected $signature = 'google:fetch-reviews';
    protected $description = 'Fetch and store new Google Business reviews';

    public function handle()
    {
        try {
            $controller = new GoogleReviewController();

            $response = $controller->fetchNewReviews();

            if ($response['success'] ?? false) {
                $message = "Fetched {$response['new_reviews']} new reviews.";
                $this->info($message);
            } else {
                $message = "Failed to fetch reviews: " . ($response['message'] ?? 'Unknown error');
                $this->error($message);
            }

            Log::channel('google_reviews')->info($message);

            Log::channel('google_reviews')->debug('Full fetch response: ' . json_encode($response, JSON_PRETTY_PRINT));

        } catch (\Exception $e) {
            $errorMessage = "Exception while fetching Google reviews: " . $e->getMessage();
            $this->error($errorMessage);
            Log::channel('google_reviews')->error($errorMessage);
        }
    }
}
