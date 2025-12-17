<?php
namespace App\Services;

use App\Models\Hotel;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Helpers\TboHotelHelper;
use GuzzleHttp\Pool;
use GuzzleHttp\Psr7\Request as GuzzleRequest;
use RankMath\Google\Request;
class TboHotelService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function getHotels($params)
    {
        try {
            $url = config('services.tbo.hotel_details_api_url_live') . 'TBOHotelCodeList';
            $response = Http::withBasicAuth(
                config('services.tbo.static_username_live'),
                config('services.tbo.static_password_live')
            )->withHeaders([
                        'Content-Type' => 'application/json'
                    ])->post($url, $params);

            if ($response->successful()) {
                return $response->json();
            } else {
                Log::error('TBO Hotel Code List Error', [
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);
                return [
                    'error' => 'Failed to fetch hotel code list.',
                    'status' => $response->status(),
                    'body' => $response->body()
                ];
            }
        } catch (\Exception $e) {
            Log::error('TBO Hotel Code List Exception: ' . $e->getMessage());
            return ['error' => 'Request failed.'];
        }
    }

    public function getCountry(Request $request)
    {
        try {
            $url = config('services.tbo.hotel_details_api_url') . '/TBOHotelCodeList';

            $response = Http::withBasicAuth(
                config('services.tbo.static_username_live'),
                config('services.tbo.static_password_live')
            )->withHeaders([
                        'Content-Type' => 'application/json'
                    ])->get($url);

            if ($response->successful()) {
                return $response->json();
            } else {
                Log::error('TBO Hotel Code List Error', [
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);
                return [
                    'error' => 'Failed to fetch hotel code list.',
                    'status' => $response->status(),
                    'body' => $response->body()
                ];
            }
        } catch (\Exception $e) {
            Log::error('TBO Hotel Code List Exception: ' . $e->getMessage());
            return ['error' => 'Request failed.'];
        }
    }

    public function searchHotels($params)
    {

        try {
            $url = config('services.tbo.hotel_booking_url_live') . 'Search';

            $username = config('services.tbo.username_live');
            $password = config('services.tbo.password_live');



            if (!$username || !$password) {
                Log::error('TBO Hotel Search: Missing API credentials', [
                    'username' => $username,
                    'password' => $password
                ]);
                return ['error' => 'Missing API credentials.'];
            }

            $auth = $this->authenticate();

            $response = Http::withBasicAuth($username, $password)
                ->withOptions([
                    'verify' => false
                ])
                ->withHeaders([
                    'Content-Type' => 'application/json'
                ])
                ->post($url, $params);



            if ($response->successful()) {
                $data = $response->json();
                Log::info('TBO Hotel Search: Success', ['response_snippet' => array_slice($data, 0, 3)]);
                return $data;
            } else {
                Log::error('TBO Hotel Search: API call failed', [
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);
                return [
                    'error' => 'Failed to search hotels.',
                    'status' => $response->status(),
                    'body' => $response->body()
                ];
            }

        } catch (\Exception $e) {
            Log::error('TBO Hotel Search: Exception thrown', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return ['error' => 'Request failed due to exception.'];
        }
    }

    public function searchHotelsParallel(array $hotelCodes, array $basePayload)
    {
        $url = config('services.tbo.hotel_booking_url_live') . '/Search';
        $username = config('services.tbo.username_live');
        $password = config('services.tbo.password_live');

        if (!$username || !$password) {
            Log::error('TBO Hotel Search: Missing API credentials');
            return ['error' => 'Missing API credentials.'];
        }

        // Build payload for this chunk
        $payload = $basePayload;
        $payload['HotelCodes'] = implode(',', $hotelCodes);

        // Send request
        $response = Http::asJson()
            ->withBasicAuth($username, $password)
            ->withHeaders(['Content-Type' => 'application/json'])
            ->withOptions(['verify' => false])
            ->post($url, $payload);

        // Log request and response for debugging
        $timestamp = now()->format('Y-m-d_H-i-s');
        // Storage::put(
        //     "hotel-responses/service_request_response_{$timestamp}.json",
        //     json_encode([
        //         'request' => $payload,
        //         'response' => json_decode($response->body(), true)
        //     ], JSON_PRETTY_PRINT)
        // );

        // Return the response in a clean format
        if ($response->successful()) {
            return json_decode($response->body(), true);
        }

        Log::error('TBO Hotel Search: Chunk request failed', [
            'status' => $response->status(),
            'body' => $response->body(),
        ]);

        return [
            'Status' => [
                'Code' => $response->status(),
                'Description' => 'Failed'
            ],
            'HotelResult' => []
        ];
    }


    public function searchMultipleChunksParallel(array $chunks, array $basePayload)
    {
        $url = config('services.tbo.hotel_booking_url_live') . 'Search';
        $username = config('services.tbo.username_live');
        $password = config('services.tbo.password_live');


        $token = Cache::get('tbo_token_id');
        Log::info('TBO Wallet: Retrieved token from cache', ['token' => $token]);

        if (!$token) {
            Log::info('TBO Wallet: Token not found, calling authenticate()');
            $auth = $this->authenticate();

            if (!is_array($auth) || !isset($auth['TokenId'])) {
                Log::error('TBO Wallet: Authentication failed', ['auth_response' => $auth]);
                return response()->json(['error' => 'Authentication failed'], 500);
            }

            $token = $auth['TokenId'];
            Log::info('TBO Wallet: Token acquired via authenticate()', ['token' => $token]);
        }


        $client = new Client([
            'auth' => [$username, $password],
            'verify' => false,
            'headers' => ['Content-Type' => 'application/json'],
        ]);

        $requests = function () use ($chunks, $basePayload, $url) {
            foreach ($chunks as $index => $chunk) {
                $payload = $basePayload;
                $payload['HotelCodes'] = implode(',', $chunk);

                // Log the exact time we are QUEUING this request
                $requestTime = now()->format('Y-m-d H:i:s.u');
                Log::info("Preparing chunk {$index} request at {$requestTime}", [
                    'HotelCodes' => $payload['HotelCodes']
                ]);

                yield new GuzzleRequest('POST', $url, [], json_encode($payload));
            }
        };

        $responses = [];
        $pool = new Pool($client, $requests(), [
            'concurrency' => count($chunks), // all at once
            'fulfilled' => function ($response, $index) use (&$responses, $chunks) {
                $decoded = json_decode((string) $response->getBody(), true);

                $responseTime = now()->format('Y-m-d H:i:s.u');
                Log::info("Received chunk {$index} response at {$responseTime}");

                $responses[$index] = $decoded;

                // log per request/response
                $timestamp = now()->format('Y-m-d_H-i-s-u');
                // Storage::put(
                //     "api-responses/request_response_{$timestamp}_chunk{$index}.json",
                //     json_encode([
                //         'request' => ['HotelCodes' => implode(',', $chunks[$index])],
                //         'response' => $decoded
                //     ], JSON_PRETTY_PRINT)
                // );
            },
            'rejected' => function ($reason, $index) use (&$responses) {
                $errorTime = now()->format('Y-m-d H:i:s.u');
                Log::error("Parallel chunk {$index} failed at {$errorTime}", ['reason' => $reason]);

                $responses[$index] = [
                    'Status' => [
                        'Code' => 500,
                        'Description' => 'Failed'
                    ],
                    'HotelResult' => []
                ];
            }
        ]);

        // Fire them all and wait
        $pool->promise()->wait();

        return $responses;
    }



    public function confirmRoom($params)
    {
        try {
            Log::info('TBO Hotel Confirm: Request Payload', $params);

            $url = config('services.tbo.hotel_confirm_url_live') . 'book';
            $username = config('services.tbo.username_live');
            $password = config('services.tbo.password_live');

            Log::info('TBO Hotel Confirm API Request', [
                'url' => $url,
                'username' => $username,
                'password' => $password,
            ]);
            if (!$username || !$password) {
                Log::error('TBO Hotel Confirm: Missing API credentials', [
                    'username' => $username,
                    'password' => $password
                ]);
                return ['error' => 'Missing API credentials.'];
            }

            $token = Cache::get('tbo_token_id');
            Log::info('TBO Wallet: Retrieved token from cache', ['token' => $token]);

            if (!$token) {
                Log::info('TBO Wallet: Token not found, calling authenticate()');
                $auth = $this->authenticate();

                if (!is_array($auth) || !isset($auth['TokenId'])) {
                    Log::error('TBO Wallet: Authentication failed', ['auth_response' => $auth]);
                    return response()->json(['error' => 'Authentication failed'], 500);
                }

                $token = $auth['TokenId'];
                Log::info('TBO Wallet: Token acquired via authenticate()', ['token' => $token]);
            }


            $response = Http::withBasicAuth($username, $password)
                ->withOptions([
                    'verify' => false // ⛔ Use only in development
                ])
                ->withHeaders([
                    'Content-Type' => 'application/json'
                ])
                ->post($url, $params);

            // ✅ Log full response (always)
            Log::info('TBO Hotel Confirm: Raw Response', [
                'status' => $response->status(),
                'body' => $response->body()
            ]);

            if ($response->successful()) {
                $data = $response->json();
                Log::info('TBO Hotel Confirm: Parsed Success Response', $data);
                return $data;
            } else {
                Log::error('TBO Hotel Confirm: API call failed', [
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);
                return [
                    'error' => 'Failed to confirm hotel.',
                    'status' => $response->status(),
                    'body' => $response->body()
                ];
            }

        } catch (\Exception $e) {
            Log::error('TBO Hotel Confirm: Exception', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return ['error' => 'Request failed due to exception.'];
        }
    }


    public function getBookingStatus($bookingId)
    {
        try {
            Log::info('getBookingStatus initiated', ['bookingId' => $bookingId]);

            $url = rtrim(config('services.tbo.hotel_confirm_url_live'), '/') . '/Getbookingdetail';
            $token = Cache::get('tbo_token_id');
            $ip = request()->ip();

            Log::info('Constructed URL and gathered token/IP', [
                'url' => $url,
                'token' => $token,
                'ip' => $ip
            ]);

            if (!$token) {
                Log::info('TBO Status: Token not found, calling authenticate()');
                $auth = $this->authenticate();

                if (!is_array($auth) || !isset($auth['TokenId'])) {
                    Log::error('TBO Status: Authentication failed', ['auth_response' => $auth]);
                    return response()->json(['error' => 'Authentication failed'], 500);
                }

                $token = $auth['TokenId'];
                Log::info('TBO Status: Token acquired via authenticate()', ['token' => $token]);
            }

            $body = [
                "BookingId" => $bookingId,
                "EndUserIp" => $ip,
                "TokenId" => $token
            ];

            Log::info('Payload for TBO GetBookingDetail', ['body' => $body]);

            $response = Http::withHeaders([
                'Content-Type' => 'application/json'
            ])->post($url, $body);

            Log::info('Response received from TBO', [
                'status' => $response->status(),
                'body_raw' => $response->body()
            ]);

            if ($response->successful()) {
                $jsonResponse = $response->json();
                Log::info('TBO GetBookingDetail successful', ['response' => $jsonResponse]);
                return $jsonResponse;
            }

            Log::error('TBO GetBookingDetail failed', [
                'status' => $response->status(),
                'body' => $response->body()
            ]);

            return null;
        } catch (\Exception $e) {
            Log::error('TBO GetBookingDetail exception', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return null;
        }


    }


    public function getBookingStatusByTraceId($traceId, $token)
    {
        $url = rtrim(config('services.tbo.hotel_confirm_url_live'), '/') . '/Getbookingdetail';
        $ip = request()->ip();

        $body = [
            "TraceId" => $traceId,
            "TokenId" => $token,
            "EndUserIp" => $ip
        ];

        $response = Http::withHeaders([
            'Content-Type' => 'application/json'
        ])->post($url, $body);

        if ($response->successful()) {
            return $response->json();
        }

        return null;
    }









    public function preBook($params)
    {
        try {
            $url = config('services.tbo.hotel_booking_url_live') . 'PreBook';

            $response = Http::withOptions(['verify' => false])
                ->withBasicAuth(
                    config('services.tbo.username_live'),
                    config('services.tbo.password_live')
                )->withHeaders([
                        'Content-Type' => 'application/json'
                    ])->post($url, $params);
            Log::info('TBO Pre Book Request', ['request' => $params]);
            Log::info('TBO Pre Book URL', ['url' => $url]);
            Log::info('response', ['response' => $response]);
            Log::info('TBO Pre Book Response', [
                'status' => $response->status(),
                'body' => $response->body()
            ]);
            if ($response->successful()) {
                $timestamp = now()->format('Y-m-d_H-i-s');
                // Storage::put("hotel-responses/request_prebok_response_{$timestamp}.json", json_encode([
                //     'request' => $params,
                //     'response' => $response
                // ], JSON_PRETTY_PRINT));
                return $response->json();

            } else {
                Log::error('TBO Hotel Pre Book Failed', [
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);
                return [
                    'error' => 'Failed to pre book.',
                    'status' => $response->status(),
                    'body' => $response->body()
                ];
            }
        } catch (\Exception $e) {
            Log::error('TBO Hotel Pre Book Exception: ' . $e->getMessage());
            return ['error' => 'Request failed.'];
        }
    }


    public function authenticate()
    {
        try {
            $url = 'https://api.travelboutiqueonline.com/SharedAPI/SharedData.svc/rest/Authenticate';
            Log::info('TBO Authenticate: URL', ['url' => $url]);

            $payload = [
                "ClientId" => "tboprod",
                "UserName" => config('services.tbo.username_live'), // IXZA598
                "Password" => config('services.tbo.password_live'), // Bli$$-59@pi#
                "EndUserIp" => $this->getClientIPv4(),
            ];
            Log::info('TBO Authenticate: Payload', $payload);

            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->post($url, $payload);

            Log::info('TBO Authenticate: Raw Response', [
                'status' => $response->status(),
                'body' => $response->body()
            ]);

            if (!$response->successful()) {
                return [
                    'error' => 'Authentication failed',
                    'status' => $response->status(),
                    'body' => $response->body()
                ];
            }

            $data = $response->json();
            Log::info('TBO Authenticate: Parsed JSON', $data);

            if (($data['Status'] ?? 0) != 1 || empty($data['TokenId'])) {
                return [
                    'error' => 'Invalid credentials or auth failed',
                    'body' => $data
                ];
            }

            Cache::forever('tbo_agency_id', $data['Member']['AgencyId'] ?? null);
            Cache::forever('tbo_member_id', $data['Member']['MemberId'] ?? null);
            Cache::put('tbo_token_id', $data['TokenId'], now()->endOfDay());

            Log::info('TBO Authenticate: Token cached successfully', [
                'token' => $data['TokenId']
            ]);

            return $data;

        } catch (\Exception $e) {
            Log::error('TBO Authenticate: Exception', ['message' => $e->getMessage()]);
            return ['error' => $e->getMessage()];
        }
    }


    private function getClientIPv4()
    {
        $ip = request()->ip();

        if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
            $ipv4 = request()->server('HTTP_X_FORWARDED_FOR')
                ?? request()->server('HTTP_CF_CONNECTING_IP')
                ?? request()->server('REMOTE_ADDR');

            if ($ipv4 && filter_var($ipv4, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
                return $ipv4;
            }

            return '127.0.0.1';
        }

        return $ip;
    }



    public function getWalletBalance()
{
    try {
        $url = 'https://api.travelboutiqueonline.com/SharedAPI/SharedData.svc/rest/GetAgencyBalance';

        $token = Cache::get('tbo_token_id');
        if (!$token) {
            $auth = $this->authenticate();
            if (!is_array($auth) || !isset($auth['TokenId'])) {
                return 0;
            }
            $token = $auth['TokenId'];
        }

        $agencyId = Cache::get('tbo_agency_id');
        $memberId = Cache::get('tbo_member_id');
        if (!$agencyId || !$memberId) {
            return 0;
        }

        $payload = [
            'ClientId' => config('services.tbo.client_id_live'),
            'EndUserIp' => request()->ip(),
            'TokenAgencyId' => $agencyId,
            'TokenMemberId' => $memberId,
            'TokenId' => $token,
        ];

        $response = Http::post($url, $payload);

        if ($response->successful()) {
            $data = $response->json();
            return $data['CashBalance'] ?? 0;
        } else {
            return 0;
        }
    } catch (\Exception $e) {
        return 0;
    }
}





    public function getHotelDetails($hotelCode)
    {
        $params = [
            "HotelCodes" => $hotelCode,
        ];
        try {
            $url = config('services.tbo.hotel_details_api_url_live') . 'Hoteldetails';
            $response = Http::withBasicAuth(
                config('services.tbo.static_username_live'),
                config('services.tbo.static_password_live')
            )->withHeaders([
                        'Content-Type' => 'application/json'
                    ])->post($url, $params);

            if ($response->successful()) {
                return $response->json();
            } else {
                Log::error('TBO Hotel Detail', [
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);
                return [
                    'error' => 'Failed to fetch hotel Detail.',
                    'status' => $response->status(),
                    'body' => $response->body()
                ];
            }
        } catch (\Exception $e) {
            Log::error('TBO Hotel Detail Exception: ' . $e->getMessage());
            return ['error' => 'Request failed.'];
        }
    }

    public function cacheHotelData($hotelData)
    {
        Cache::put('hotel_' . $hotelData['hotel_code'], $hotelData, now()->addHours(24));
    }

    public function getCachedHotelData($hotelCode)
    {
        return Cache::get('hotel_' . $hotelCode);
    }
}
