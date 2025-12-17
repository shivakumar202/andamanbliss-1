<?php

namespace App\Services;

use App\Models\ReviewImage;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GoogleReviewPhotoService
{


    public function fetchAndStorePhotos()
    {
        $apiKey  = env('GOOGLE_PLACES_API_KEY');
        $placeId = env('GOOGLE_PLACE_ID');

        Log::info('Google Places photo fetch started', [
            'place_id' => $placeId
        ]);

        try {
            $url = "https://maps.googleapis.com/maps/api/place/details/json";

            $response = Http::get($url, [
                'place_id' => $placeId,
                'fields'   => 'photos',
                'key'      => $apiKey
            ]);

            if (!$response->successful()) {
                Log::error('Google Places API HTTP failure', [
                    'status' => $response->status(),
                    'body'   => $response->body(),
                ]);

                return [
                    'success' => false,
                    'message' => 'Google API request failed',
                ];
            }

            $data = $response->json();

            if (($data['status'] ?? '') !== 'OK') {
                Log::error('Google Places API error response', [
                    'status'  => $data['status'] ?? null,
                    'message' => $data['error_message'] ?? null,
                ]);

                return [
                    'success' => false,
                    'message' => $data['error_message'] ?? 'Google API error',
                ];
            }

            $photos = $data['result']['photos'] ?? [];

            if (empty($photos)) {
                Log::warning('No photos found for Google Place', [
                    'place_id' => $placeId
                ]);
            }

            $saved = 0;

            foreach ($photos as $index => $photo) {

                if (!isset($photo['photo_reference'])) {
                    Log::warning('Photo reference missing', [
                        'photo_index' => $index,
                        'photo'       => $photo,
                    ]);
                    continue;
                }

                $photoRef = $photo['photo_reference'];

                $imageUrl = "https://maps.googleapis.com/maps/api/place/photo?" . http_build_query([
                    'maxwidth'        => 1600,
                    'photo_reference' => $photoRef,
                    'key'             => $apiKey,
                ]);

                ReviewImage::updateOrCreate(
                    [
                        'place_id'    => $placeId,
                        'photo_index' => $index,
                    ],
                    [
                        'google_photo_reference' => $photoRef,
                        'image_url'              => $imageUrl,
                    ]
                );

                $saved++;
            }

            Log::info('Google Places photos stored successfully', [
                'place_id' => $placeId,
                'saved'    => $saved,
                'total'    => count($photos),
            ]);

            return [
                'success' => true,
                'saved'   => $saved,
                'total'   => count($photos),
            ];
        } catch (\Throwable $e) {
            Log::critical('Exception while fetching Google Place photos', [
                'place_id' => $placeId,
                'error'    => $e->getMessage(),
                'trace'    => $e->getTraceAsString(),
            ]);

            return [
                'success' => false,
                'message' => 'Unexpected error occurred',
            ];
        }
    }
}
