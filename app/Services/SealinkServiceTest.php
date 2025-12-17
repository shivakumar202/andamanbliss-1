<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class SealinkServiceTest
{
    protected $baseUrl;
    protected $username;
    protected $token;



    public function __construct()
    {
        $this->baseUrl = env('TEST_SEALINK_API_BASE_URL');
        $this->username = env('TEST_SEALINK_API_USERNAME');
        $this->token;
    }

    /**
     * Fetch Token from Storage (e.g., session or database)
     */
    public function getToken()
    {
        $this->token = config('services.sealink.test_token');
        return env('TEST_SEALINK_API_TOKEN');
    }
    /**
     * Perform login and retrieve token
     */
    public function login()
    {
        $response = Http::post("{$this->baseUrl}login", [
            'data' => [
                'username' => $this->username,
                'token' => 'U2FsdGVkX18wFH8L127Sgd0wBwCSQMhE3y2kxDFXgc5zItPTXXqvjfTLuSAeD1ySsGVF5lj9i5LUoR/JhwJvSQ==',
            ],
        ]);

        if ($response->failed()) {
            throw new \Exception("Login failed: " . $response->body());
        }

        $data = $response->json();
        Log::info($data);

        if (isset($data['data']['token'])) {
            $this->token = $data['data']['token']; // Store the token for future use
            Session::put('sealink_token', $this->token); // Save token to session
            return $this->token;
        } else {
            throw new \Exception("Invalid login response: " . $response->body());
        }
    }

    /**
     * Check if the token is valid and refresh if necessary
     */
    private function checkToken()
    {
        // Logic to validate the token (e.g., check expiration)
        if (!$this->token || $this->isTokenExpired()) {
            $this->login(); // Trigger login if token is invalid or expired
        }
    }

    /**
     * Simulate token expiration check (can be enhanced)
     */
    private function isTokenExpired()
    {
        // Example logic to check if token is expired (you can replace with actual logic)
        return false;  // Implement logic if you store expiry time or use JWT
    }

    /**
     * Fetch Trip Data
     */
    public function getTripData($data)
    {
        try {
            $token = $this->getToken();

            if (!$token) {
                Log::warning('Token missing for Sealink API.');
                return response()->json([
                    'msg' => 'Token missing. Please log in again.',
                    'code' => 400,
                ]);
            }

            $formattedData = [
                'date' => $data['date'],
                'from' => $data['from'],
                'to' => $data['to'],
                'userName' => env('TEST_SEALINK_API_USERNAME'),
                'token' => env('TEST_SEALINK_API_TOKEN'),
            ];

            $url = rtrim(env('TEST_SEALINK_API_BASE_URL'), '/') . '/getTripData';

            Log::info('Sending Sealink Trip Data Request:', ['url' => $url, 'payload' => $formattedData]);

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . env('TEST_SEALINK_API_TOKEN'),
            ])->post($url, $formattedData);

            if ($response->failed()) {
                $error = $response->body();
                Log::error('Error response from Sealink API:', ['error' => $error]);
                throw new \Exception("Error fetching trip data: " . $error);
            }

            $responseData = $response->json();
            Log::info('Received Sealink Trip Data Response:', $responseData);

            return $responseData;
        } catch (\Exception $e) {
            Log::error('Error in Sealink getTripData method:', ['error' => $e->getMessage()]);
            return response()->json([
                'msg' => 'Error while fetching trip data.',
                'code' => 500,
                'details' => $e->getMessage(),
            ]);
        }
    }


    /**
     * Book Seats
     */
    public function bookSeats($bookingData)
    {
        try {
            $token = $this->getToken();

            if (!$token) {
                Log::warning('Token missing for Sealink API.');
                return response()->json([
                    'msg' => 'Token missing. Please log in again.',
                    'code' => 400,
                ]);
            }

            $url = rtrim(env('TEST_SEALINK_API_BASE_URL'), '/') . '/bookSeats';

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . env('TEST_SEALINK_API_TOKEN'),
            ])->post($url, $bookingData);

            if ($response->failed()) {
                $error = $response->body();
                Log::error('Error response from Sealink API:', ['error' => $error]);
                throw new \Exception("Error fetching trip data: " . $error);
            }
            $responseData = $response->json();

            return $responseData;
        } catch (\Exception $e) {
            Log::error('Error in Sealink getTripData method:', ['error' => $e->getMessage()]);
            return response()->json([
                'msg' => 'Error while fetching trip data.',
                'code' => 500,
                'details' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Auto Booking
     */
    public function bookSeatsAuto(array $autoBookingData)
    {
        try {
            Log::info('Payload Api side ',[$autoBookingData]);
            $token = $this->getToken();

            if (!$token) {
                Log::warning('Token missing for Sealink API.');
                return response()->json([
                    'msg' => 'Token missing. Please log in again.',
                    'code' => 400,
                ]);
            }

            $url = rtrim(env('TEST_SEALINK_API_BASE_URL'), '/') . '/bookSeatsAuto';

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . env('TEST_SEALINK_API_TOKEN'),
            ])->post($url, $autoBookingData);

            if ($response->failed()) {
                $error = $response->body();
                Log::error('Error response from Sealink API:', ['error' => $error]);
                throw new \Exception("Error fetching trip data: " . $error);
            }
            $responseData = $response->json();
            return $responseData;
        } catch (\Exception $e) {
            Log::error('Error in Sealink bookSeatsAuto method.', [
                'exception' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            return response()->json([
                'msg' => 'Error while booking seats.',
                'code' => 500,
                'details' => $e->getMessage(),
            ]);
        }
    }



    public function getBalance()
    {
        try {
            $token = $this->getToken();
            if (!$token) {
                Log::warning('Token missing for Sealink API.');
                return response()->json([
                    'msg' => 'Token missing. Please log in again.',
                    'code' => 400,
                ]);
            }
            $data = [
                'userName' => $this->username,
                'token' => $token,
            ];

            $url = rtrim(env('TEST_SEALINK_API_BASE_URL'), '/') . '/getProfile';

            $response = Http::withHeaders([
                'Authorization' => 'Bearer' . env('TEST_SEALINK_API_TOKEN'),
            ])->post($url, $data);

            if ($response->failed()) {
                $error = $response->body();
                Log::error('Error response from Sealink API:', ['error' => $error]);
                throw new \Exception("Error fetching Wallet: " . $error);
            }

            $responseData = $response->json();
            Log::info($response);
            return $responseData['data']['walletBalance'];
        } catch (\Exception $e) {
            Log::error('Error in Sealink getTripData method:', ['error' => $e->getMessage()]);
            return response()->json([
                'msg' => 'Error while fetching profile.',
                'code' => 500,
                'details' => $e->getMessage(),
            ]);
        }
    }
}
