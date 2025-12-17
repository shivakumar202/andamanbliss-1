<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;

class GoogleReviewService
{
    protected $apiKey;
    protected $placeId;

    public function __construct()
    {
        $this->apiKey = env('GOOGLE_PLACES_API_KEY');  // your API key
        $this->placeId = env('GOOGLE_PLACE_ID');       // your business Place ID
    }

    public function getReviews()
    {
        $url = "https://maps.googleapis.com/maps/api/place/details/json?place_id={$this->placeId}&fields=reviews&key={$this->apiKey}";
        $response = Http::get($url);


        if ($response->successful()) {
            return $response->json('result.reviews', []);
        }

        return [];
    }
}
