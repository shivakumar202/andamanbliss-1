<?php

namespace App\Http\Controllers;

use App\Models\GoogleReview;
use App\Models\GoogleReviewMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class GoogleReviewController extends Controller
{
    private $clientId;
    private $clientSecret;
    private $redirectUri;

    public function __construct()
    {
        $this->clientId = config('services.google.client_id');
        $this->clientSecret = config('services.google.client_secret');
        $this->redirectUri = route('google.callback');
    }

    // 1️⃣ Redirect user to Google OAuth screen
    public function redirectToGoogle()
    {
        $params = [
            'scope' => 'https://www.googleapis.com/auth/business.manage',
            'access_type' => 'offline',
            'include_granted_scopes' => 'true',
            'response_type' => 'code',
            'redirect_uri' => $this->redirectUri,
            'client_id' => $this->clientId,
            'prompt' => 'consent',
        ];

        return redirect('https://accounts.google.com/o/oauth2/v2/auth?' . http_build_query($params));
    }


    // 2️⃣ Handle OAuth callback and store tokens
    public function handleCallback(Request $request)
    {
        $code = $request->get('code');

        $response = Http::asForm()->post('https://oauth2.googleapis.com/token', [
            'code' => $code,
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
            'redirect_uri' => $this->redirectUri,
            'grant_type' => 'authorization_code',
        ]);

        $data = $response->json();

        // Store tokens in cache (or DB)
        Cache::put('google_access_token', $data['access_token'], now()->addSeconds($data['expires_in']));
        if (isset($data['refresh_token'])) {
            Cache::put('google_refresh_token', $data['refresh_token']);
        }

        return redirect()->route('google.reviews');
    }


    // 3️⃣ Refresh token automatically
    private function getAccessToken()
    {
        $token = Cache::get('google_access_token');
        if (!$token) {
            $refreshToken = Cache::get('google_refresh_token');

            if (!$refreshToken) {
                return null;
            }

            $response = Http::asForm()->post('https://oauth2.googleapis.com/token', [
                'client_id' => $this->clientId,
                'client_secret' => $this->clientSecret,
                'refresh_token' => $refreshToken,
                'grant_type' => 'refresh_token',
            ]);

            $data = $response->json();
            if (!isset($data['access_token'])) {
                return null;
            }

            $token = $data['access_token'];
            Cache::put('google_access_token', $token, now()->addSeconds($data['expires_in']));
        }

        return $token;
    }

    // 4️⃣ Fetch all reviews (with review images)
    public function fetchReviews()
    {
        $accessToken = $this->getAccessToken();
        if (!$accessToken) {
            return redirect()->route('google.auth');
        }

        $accountId = '116250521220525771882';
        $locationId = '11177057272970848123';

        $url = "https://mybusiness.googleapis.com/v4/accounts/{$accountId}/locations/{$locationId}/reviews";

        $response = Http::withToken($accessToken)->get($url);
        $data = $response->json();

        if ($response->failed()) {
            return response()->json([
                'error' => 'Failed to fetch reviews',
                'status' => $response->status(),
                'details' => $data
            ]);
        }

        return response()->json($data);
    }


    public function fetchPlacesReviews()
    {
        $apiKey = env('GOOGLE_PLACES_API_KEY');
        $placeId = env('GOOGLE_PLACE_ID');

        $url = "https://maps.googleapis.com/maps/api/place/details/json?place_id={$placeId}&fields=reviews&key={$apiKey}";

        $response = Http::get($url)->json();

        $reviews = $response['result']['reviews'] ?? [];

        return response()->json([
            'success' => true,
            'total_reviews' => count($reviews),
            'reviews' => $reviews
        ]);
    }




    // ✅ Fetch all Google Business Accounts linked to the authenticated user
    public function listAccounts()
    {
        $accessToken = $this->getAccessToken();

        if (!$accessToken) {
            return redirect()->route('google.auth');
        }

        $response = Http::withToken($accessToken)
            ->get('https://mybusinessaccountmanagement.googleapis.com/v1/accounts');

        $data = $response->json(); // moved above return

        if ($response->failed()) {
            return response()->json([
                'error' => 'Failed to fetch accounts',
                'details' => $data
            ]);
        }

        // Optional: return as JSON for API use
        // return response()->json($data);

        // Or display in a view
        return view('google.accounts', [
            'accounts' => $data['accounts'] ?? []
        ]);
    }


    // ✅ Fetch all locations for a given account
    public function listLocations($accountId)
    {
        $accessToken = $this->getAccessToken();
        if (!$accessToken) {
            return redirect()->route('google.auth');
        }

        // ✅ Use the new endpoint
        $url = "https://mybusinessbusinessinformation.googleapis.com/v1/accounts/{$accountId}/locations";

        // ✅ Add the required readMask
        $params = [
            'readMask' => 'name,title,storeCode,metadata,phoneNumbers,websiteUri'
        ];

        $response = Http::withToken($accessToken)->get($url, $params);
        $data = $response->json();

        if ($response->failed()) {
            return response()->json([
                'error' => 'Failed to fetch locations',
                'details' => $data
            ]);
        }

        return view('google.locations', [
            'locations' => $data['locations'] ?? []
        ]);
    }


   public function fetchNewReviews(): array
{
    if (!Auth::check()) {
        return ['success' => false, 'message' => 'Unauthorized'];
    }

    $mail = Auth::user()->email;

    if ($mail !== 'info@andamanbliss.com') {
        return ['success' => false, 'message' => 'Not allowed', 'status' => '300'];
    }

    $accessToken = $this->getAccessToken();
    if (!$accessToken) {
        Log::info("No access token available for fetching reviews.");
        return ['success' => false, 'message' => 'No access token available'];
    }

    $accountId = '116250521220525771882';
    $locationId = '11177057272970848123';
    $url = "https://mybusiness.googleapis.com/v4/accounts/{$accountId}/locations/{$locationId}/reviews";

    $allReviews = [];
    $pageToken = null;

    do {
        $params = [
            'pageSize' => 100,
            'orderBy' => 'updateTime desc',
        ];

        if ($pageToken) {
            $params['pageToken'] = $pageToken;
        }

        $response = Http::withToken($accessToken)->get($url, $params);
        $data = $response->json();

        if ($response->failed()) {
            Log::error('Failed to fetch reviews', ['response' => $data]);
            return ['success' => false, 'message' => 'Failed to fetch reviews', 'details' => $data];
        }

        $reviews = $data['reviews'] ?? [];
        Log::info('Fetched ' . count($reviews) . ' reviews from API.');

        foreach ($reviews as $review) {
            $allReviews[] = $review;
        }

        $pageToken = $data['nextPageToken'] ?? null;

    } while ($pageToken);

    foreach ($allReviews as $review) {
        GoogleReview::updateOrCreate(
            ['review_id' => $review['reviewId']],
            [
                'reviewer_name' => $review['reviewer']['displayName'] ?? null,
                'reviewer_profile_photo_url' => $review['reviewer']['profilePhotoUrl'] ?? null,
                'rating' => $this->convertStarRatingToInt($review['starRating']) ?? null,
                'comment' => $review['comment'] ?? null,
                'reply' => $review['reviewReply']['comment'] ?? null,
                'media' => collect($review['reviewPhotos'] ?? [])->pluck('url')->toArray(),
                'review_date' => $review['updateTime'] ?? $review['createTime'] ?? null,
                'account_id' => $accountId,
                'location_id' => $locationId,
            ]
        );
        Log::debug('Stored review ID: ' . $review['reviewId']);
    }

    Log::info('Google reviews fetch completed.');

    return ['success' => true, 'message' => count($allReviews), 'status' => 200];
}





    /**
     * Convert Google starRating (e.g., 'FIVE') or numeric string to integer 1-5
     */
    protected function convertStarRatingToInt($starRating)
    {
        if (is_numeric($starRating)) {
            return (int)$starRating;
        }

        $map = [
            'ONE' => 1,
            'TWO' => 2,
            'THREE' => 3,
            'FOUR' => 4,
            'FIVE' => 5,
        ];

        return $map[strtoupper((string)$starRating)] ?? null;
    }
}
