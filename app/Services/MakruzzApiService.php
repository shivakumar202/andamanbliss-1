<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class MakruzzApiService
{
    protected $client;
    protected $token;

    public function __construct()
    {
        $this->client = new Client();
        $this->token = $this->getToken(); // Load token from session when the service is instantiated
    }

    public function getToken()
    {
        return session('makruzz_token');
    }

    public function setToken($token)
    {
        session(['makruzz_token' => $token]);
        $this->token = $token; // Set it in the class property as well
    }

    public function login()
    {
        // If token is already set, return it instead of logging in again
        if ($this->token) {
            return response()->json([
                'msg' => 'Already logged in',
                'code' => 200,
                'token' => $this->token
            ]);
        }

        try {
            $response = $this->client->post(env('MAKRUZZ_API_URL') . 'login', [
                'json' => [
                    'data' => [
                        'username' => env('MAKRUZZ_USERNAME'),
                        'password' => env('MAKRUZZ_PASSWORD'),
                    ]
                ],
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                ]
            ]);

            $data = json_decode($response->getBody(), true);

            if ((int)$data['code'] === 200 && isset($data['data']['token'])) {
                $this->setToken($data['data']['token']);

                return response()->json([
                    'msg' => 'Successfully logged in',
                    'code' => 200,
                    'token' => $this->token
                ]);
            } else {
                return response()->json([
                    'msg' => 'Login failed',
                    'code' => 400,
                    'details' => $data
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'msg' => 'Login request failed',
                'code' => 500,
                'details' => $e->getMessage()
            ]);
        }
    }

    public function getCruises()
    {
        try {
            if (!$this->token) {
                return $this->login();
            }

            $response = $this->client->get(env('MAKRUZZ_API_URL') . 'cruises', [
                'headers' => [
                    'Mak_Authorization' => $this->token,
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                ]
            ]);

            $data = json_decode($response->getBody(), true);

            if (isset($data['data'])) {
                return response()->json([
                    'msg' => 'Cruises fetched successfully',
                    'code' => 200,
                    'data' => $data['data']
                ]);
            }

            return response()->json([
                'msg' => 'No cruise data available',
                'code' => 204
            ]);
        } catch (\Exception $e) {
            Log::error('Makruzz API Request Error (Cruises):', ['error' => $e->getMessage()]);
            return response()->json([
                'msg' => 'Error fetching cruise data',
                'code' => 500,
                'details' => $e->getMessage()
            ]);
        }
    }

    public function getSectors()
    {
        try {
            if (!$this->token) {
                return $this->login();
            }

            $response = $this->client->get(env('MAKRUZZ_API_URL') . 'get_sectors', [
                'headers' => [
                    'Mak_Authorization' => $this->token,
                ]
            ]);

            $responseBody = $response->getBody()->getContents();
            Log::debug('Makruzz API Response Body:', ['response_body' => $responseBody]);

            if (empty($responseBody)) {
                return response()->json([
                    'msg' => 'The response body is empty.',
                    'code' => 500,
                    'details' => 'No data received from the API.'
                ]);
            }

            $data = json_decode($responseBody, true);
            if (is_null($data)) {
                return response()->json([
                    'msg' => 'Failed to parse the response. Please try again later.',
                    'code' => 500,
                    'details' => 'Response body is not valid JSON'
                ]);
            }

            return response()->json([
                'msg' => 'Sectors fetched successfully',
                'code' => 200,
                'data' => $data['data'] ?? []
            ]);
        } catch (\Exception $e) {
            Log::error('Makruzz getSectors Request Error:', ['error' => $e->getMessage()]);
            return response()->json([
                'msg' => 'Failed to fetch sectors. Please try again later.',
                'code' => 500,
                'details' => $e->getMessage()
            ]);
        }
    }

    public function searchSchedule($data)
    {
        try {
            if (!$this->token) {
                $loginResponse = $this->login();
                if ($loginResponse->getStatusCode() !== 200) {
                    return [
                        'msg' => 'Login failed. Cannot proceed with schedule search.',
                        'code' => 400
                    ];
                }
            }

            $requestData = [
                'data' => [
                    'trip_type' => $data['trip_type'],
                    'from_location' => $data['from_location'],
                    'to_location' => $data['to_location'],
                    'travel_date' => $data['travel_date'],
                    'no_of_passenger' => (int) $data['no_of_passenger']
                ]
            ];

            $response = $this->client->post(env('MAKRUZZ_API_URL') . 'schedule_search', [
                'json' => $requestData,
                'headers' => [
                    'Mak_Authorization' => $this->token,
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                ]
            ]);
            
            $responseData = json_decode($response->getBody(), true);

            if ((int)$responseData['code'] === 200 && isset($responseData['data'])) {
                return [
                    'msg' => 'Schedules Successfully Fetched',
                    'code' => 200,
                    'data' => $responseData['data']
                ];
            }

            return [
                'msg' => 'No schedules found',
                'code' => 204,
                'response' => $responseData
            ];
        } catch (\Exception $e) {
            Log::error('Makruzz schedule_search Request Error:', [
                'request_data' => $requestData,
                'error' => $e->getMessage(),
            ]);

            return [
                'msg' => 'Error while searching schedules',
                'code' => 500,
                'details' => $e->getMessage(),
            ];
        }
    }

    public function savePassengers($params)
    {
        

        try {

            if (!$this->token) {
                $loginResponse = $this->login();
                if ($loginResponse->getStatusCode() !== 200) {
                    return [
                        'msg' => 'Login failed. Cannot proceed with schedule search.',
                        'code' => 400
                    ];
                }
            }

            $requestData = [
                'data' => $params['bookingData'],
            ];

            $headers = [
                'Mak_Authorization' => $this->token,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ];

            Log::info('Makruzz API: Sending request to savePassengers', [
                'url' => env('MAKRUZZ_API_URL') . 'savePassengers',
                'requestData' => $requestData
            ]);

            $response = $this->client->post(env('MAKRUZZ_API_URL') . 'savePassengers', [
                'json' => $requestData,
                'headers' => $headers
            ]);

            $responseBody = json_decode($response->getBody()->getContents(), true);
            Log::info('Makruzz API: Response from savePassengers', [
                'response' => $responseBody
            ]);

            return $responseBody;
        } catch (\Exception $e) {
            Log::error('Makruzz API: Error in savePassengers', [
                'message' => $e->getMessage(),
                'params' => $params,
                'headers' => $headers
            ]);

            return [
                'error' => true,
                'message' => $e->getMessage(),
            ];
        }
    }




    public function confirmBooking($bookingId)
    {
        try {

            if (!$this->token) {
                $loginResponse = $this->login();
                if ($loginResponse->getStatusCode() !== 200) {
                    return response()->json([
                        'msg' => 'Login failed. Cannot proceed with booking confirmation.',
                        'code' => 400
                    ]);
                }
            }

            $requestData = ['data' => ['booking_id' => (string) $bookingId]];
            $headers = [
                'Mak_Authorization' => $this->token,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ];



            $response = $this->client->post(env('MAKRUZZ_API_URL') . 'confirm_booking', [
                'json' => $requestData,
                'headers' => $headers
            ]);

            $responseData = json_decode($response->getBody(), true);

            if (isset($responseData['data'])) {
                return response()->json([
                    'msg' => 'Booking confirmed successfully',
                    'code' => 200,
                    'data' => $responseData['data']
                ]);
            } else {
                Log::error('Makruzz API: confirmBooking failed', ['response' => $responseData]);
                return response()->json([
                    'msg' => 'Error while confirming booking',
                    'code' => 500,
                    'details' => $responseData['msg'] ?? 'Unknown error'
                ]);
            }
        } catch (\Exception $e) {
            Log::error('Makruzz API: confirmBooking Request Error', [
                'error' => $e->getMessage(),
                'booking_id' => $bookingId
            ]);

            return response()->json([
                'msg' => 'Error while confirming booking',
                'code' => 500,
                'details' => $e->getMessage()
            ]);
        }
    }



    public function downloadTicket($bookingId)
    {
        try {

            if (!$this->token) {
                $loginResponse = $this->login();

                if ($loginResponse->getStatusCode() !== 200) {
                    Log::error('Makruzz API: Login failed before downloading ticket');
                    return response('Login failed. Cannot proceed with ticket download.', 400)
                        ->header('Content-Type', 'text/plain');
                }
            }

            $requestData = ['data' => ['booking_id' => (string) $bookingId]];
            $headers = [
                'Mak_Authorization' => $this->token,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ];



            $response = $this->client->post(env('MAKRUZZ_API_URL') . 'download_ticket_pdf', [
                'json' => $requestData,
                'headers' => $headers
            ]);

            $responseData = trim($response->getBody()->getContents());


            return response()->make($responseData, 200, ['Content-Type' => 'text/plain']);
        } catch (\Exception $e) {
            Log::error('Makruzz API: downloadTicket Request Error', [
                'error' => $e->getMessage(),
                'booking_id' => $bookingId
            ]);

            return response('Error while downloading ticket: ' . $e->getMessage(), 500)
                ->header('Content-Type', 'text/plain');
        }
    }

    public function getPassengersId($pnr_no)
    {
        try {
            if (!$this->token) {
                $loginResponse = $this->login();
                if ($loginResponse->getStatusCode() !== 200) {
                    return [
                        'msg' => 'Login failed. Cannot proceed with schedule search.',
                        'code' => 400
                    ];
                }
            }
            $requestData = [
                'data' => [
                    'pnr' => $pnr_no
                ]
            ];

            $headers = [
                'Mak_Authorization' => $this->token,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ];



            $response = $this->client->post(env('MAKRUZZ_API_URL') . 'booking_cancel', [
                'json' => $requestData,
                'headers' => $headers
            ]);

            $responseBody = json_decode($response->getBody()->getContents(), true);
            return $responseBody;
        } catch (\Exception $e) {
            Log::error('Makruzz API: Error in booking_cancel', [
                'message' => $e->getMessage(),
                'params' => $pnr_no,
                'headers' => $headers
            ]);

            return [
                'error' => true,
                'message' => $e->getMessage(),
            ];
        }
    }


    public function cancelTicketCnfrm($mparam)
    {
        try {

            if (!$this->token) {
                $loginResponse = $this->login();

                if ($loginResponse->getStatusCode() !== 200) {
                    Log::error('Login failed', ['status_code' => $loginResponse->getStatusCode()]);
                    return [
                        'msg' => 'Login failed. Cannot proceed with schedule search.',
                        'code' => 400
                    ];
                }
            }

            $requestData = [
                'data' =>
                $mparam
            ];

            $headers = [
                'Mak_Authorization' => $this->token,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ];

            $response = $this->client->post(env('MAKRUZZ_API_URL') . 'booking_cancel_confirm', [
                'json' => $requestData,
                'headers' => $headers
            ]);


            $responseBody = json_decode($response->getBody()->getContents(), true);

            return $responseBody;
        } catch (\Exception $e) {
            Log::error('Makruzz API: Error in booking_cancel', [
                'message' => $e->getMessage(),
                'params' => $mparam,
                'headers' => $headers ?? []
            ]);

            return [
                'error' => true,
                'message' => $e->getMessage(),
            ];
        }
    }


    public function getMakCancelTransaction()
    {
        try {
            if (!$this->token) {
                Log::info("Token is missing or expired. Logging in again...");
                $loginResponse = $this->login();
                if ($loginResponse->getStatusCode() !== 200) {
                    Log::error("Login failed", ['response' => $loginResponse->getBody()->getContents()]);
                    return [
                        'msg' => 'Login failed. Cannot proceed with schedule search.',
                        'code' => 400
                    ];
                }
            }

            $currentDate = now()->format('Y-m-d');

            $headers = [
                'Mak_Authorization' => $this->token,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ];

            $requestData = [
                'data' => [
                    'from_date' => $currentDate,
                    'to_date' => $currentDate,
                ]
            ];

            $response = $this->client->post(env('MAKRUZZ_API_URL') . 'transaction_report', [
                'json' => $requestData,
                'headers' => $headers
            ]);

            if ($response->getStatusCode() !== 200) {
                Log::error("Makruzz API Error", ['status' => $response->getStatusCode(), 'body' => $response->getBody()]);
                return ['error' => true, 'message' => 'Failed to fetch transactions'];
            }

            $responseBody = json_decode($response->getBody()->getContents(), true);
            Log::info("Makruzz API Response", ['response' => $responseBody]);

            return $responseBody;
        } catch (\Exception $e) {
            Log::error('Error fetching Makruzz cancellation transaction', [
                'message' => $e->getMessage(),
            ]);

            return [
                'error' => true,
                'message' => $e->getMessage(),
            ];
        }
    }

    public function getBalance()
    {
        try {
            if (!$this->token) {
                $loginResponse = $this->login();
                if ($loginResponse->getStatusCode() !== 200) {
                    return [
                        'msg' => 'Login failed. Cannot proceed with schedule search.',
                        'code' => 400
                    ];
                }
            }

            $response = $this->client->get(env('MAKRUZZ_API_URL') . 'wallet_balance', [
                'headers' => [
                    'Mak_Authorization' => $this->token,
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                ]
            ]);
            $responseBody = $response->getBody()->getContents();

            if (empty($responseBody)) {
                return response()->json([
                    'msg' => 'The response body is empty.',
                    'code' => 500,
                    'details' => 'No data received from the API.'
                ]);
            }
            $data = json_decode($responseBody, true);
            if (is_null($data)) {
                return response()->json([
                    'msg' => 'Failed to parse the response. Please try again later.',
                    'code' => 500,
                    'details' => 'Response body is not valid JSON'
                ]);
            }
            return (int)$data['data']['amount'];
        } catch (\Exception $e) {
            Log::error('Makruzz API Request Error (Cruises):', ['error' => $e->getMessage()]);
            return null;
        }
    }
}
