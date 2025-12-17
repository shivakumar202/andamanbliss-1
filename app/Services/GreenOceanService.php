<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

class GreenOceanService
{
    private $api_url;
    private $private_key;
    private $public_key;

    public function __construct()
    {
        $this->api_url = env('GREEN_OCEAN_API_URL');
        $this->private_key = env('GREEN_OCEAN_PRIVATE_KEY');
        $this->public_key = env('GREEN_OCEAN_PUBLIC_KEY');
    }

    protected function getHashKey($postData, $hash_sequence)
    {
        $hash_sequence_array = explode('|', $hash_sequence);
        $hash_parts = [];

        foreach ($hash_sequence_array as $key) {
            $value = array_key_exists($key, $postData) ? $postData[$key] : "";
            $hash_parts[] = is_array($value) ? implode(",", $value) : $value;
        }

        $hash_parts[] = $this->private_key;

        return strtolower(hash('sha512', implode('|', $hash_parts)));
    }


    protected function makeApiCall($endpoint, $data)
    {

        $json = json_encode($data);
        $ch = curl_init($this->api_url . $endpoint);

        curl_setopt_array($ch, [
            CURLOPT_POST => 1,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_POSTFIELDS => $json,
            CURLOPT_SSL_VERIFYPEER => FALSE,
            CURLOPT_SSL_VERIFYHOST => FALSE,
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
                'Content-Length: ' . strlen($json)
            ]
        ]);

        $response = curl_exec($ch);
        curl_close($ch);
         Log::info('green API raw response', ['endpoint' => $endpoint, 'response' => $response]);
        return json_decode($response, true);
    }


    public function getBalance()
    {
        $hash_sequence = "today_date|public_key";
        $today = date('d-m-Y');
        $data = [
            'today_date' => $today,
            'public_key' => $this->public_key,
        ];
        $data['hash_string'] = $this->getHashKey($data, $hash_sequence);
        return $this->makeApiCall('v1/wallet-balance', $data);
    }

    public function searchFerry($params)
    {

        $hash_sequence = "from_id|dest_to|number_of_adults|number_of_infants|travel_date|public_key";
        $data = [
            'from_id' => (int) $params['from_id'],
            'dest_to' => (int) $params['dest_to'],
            'number_of_adults' => (int) $params['number_of_adults'],
            'number_of_infants' => (int) $params['number_of_infants'],
            'travel_date' => $params['travel_date'],
            'public_key' => $this->public_key
        ];
        $data['hash_string'] = $this->getHashKey($data, $hash_sequence);

        return $this->makeApiCall('v1/route-details', $data);
    }

    public function getSeatLayout($params)
    {
        $hash_sequence = "from_id|dest_to|ship_id|route_id|class_id|travel_date|public_key";
        $data = [
            'ship_id' => (int) $params['ship_id'],
            'route_id' => (int) $params['route_id'],
            'from_id' => (int) $params['from_id'],
            'dest_to' => (int) $params['dest_to'],
            'class_id' => (int) $params['class_id'],
            'travel_date' => $params['travel_date'],
            'public_key' => $this->public_key,

        ];

        Log::info('Datas: ' . print_r($data, true));

        $data['hash_string'] = $this->getHashKey($data, $hash_sequence);

        return $this->makeApiCall('v1/seat-layout', $data);
    }

    public function temporaryBlockSeat($params)
    {
        $hash_sequence = "ferry_id|travel_date|seat_numbers|public_key";
        $data = [
            'ferry_id' => (int) $params['ferry_id'],
            'travel_date' => $params['travel_date'],
            'seat_numbers' => $params['seat_numbers'],
            'public_key' => $this->public_key
        ];
        $data['hash_string'] = $this->getHashKey($data, $hash_sequence);
        return $this->makeApiCall('v1/temporary-block-seat', $data);
    }

    public function bookTicket($params)
    {

        $data = [
            'ship_id' => (int) $params['ship_id'],
            'from_id' => (int) $params['from_id'],
            'dest_to' => (int) $params['dest_to'],
            'route_id' => (int) $params['route_id'],
            'class_id' => (int) $params['class_id'],
            'number_of_adults' => (int) $params['number_of_adults'],
            'number_of_infants' => (int) ($params['number_of_infants'] ?? 0),
            'passenger_prefix' => $params['passenger_prefix'] ?? ["Mr"],
            'passenger_name' => $params['passenger_name'] ?? [],
            'passenger_age' => $params['passenger_age'] ?? [],
            'gender' => $params['gender'] ?? [],
            'nationality' => $params['nationality'] ?? [],
            'passport_numb' => $params['passport_numb'] ?? [],
            'passport_expairy' => $params['passport_expairy'] ?? [],
            'country' => $params['country'] ?? [],
            'infant_prefix' => $params['infant_prefix'] ?? [],
            'infant_name' => $params['infant_name'] ?? [],
            'infant_age' => $params['infant_age'] ?? [],
            'infant_gender' => $params['infant_gender'] ?? [],
            'travel_date' => $params['travel_date'] ?? '',
            'seat_id' => array_map('intval', $params['seat_id'] ?? []),
            'public_key' => $this->public_key,
        ];

        $hash_sequence = "ship_id|from_id|dest_to|route_id|class_id|number_of_adults|number_of_infants|travel_date|seat_id|public_key";
        $data['hash_string'] = $this->getHashKey($data, $hash_sequence);
        $response = $this->makeApiCall('v1/book-ticket', $data);

        return $response;
    }



    public function getTicketDetails($params)
    {
        $hash_sequence = "pnr|public_key";
        $data = [
            'pnr' => $params,
            'public_key' => $this->public_key
        ];
        $data['hash_string'] = $this->getHashKey($data, $hash_sequence);
        return $this->makeApiCall('v1/ticket-passenger-details', $data);
    }

    public function cancelTicket($params)
    {
        $hash_sequence = "ticket_number|cancellation_reason|public_key";
        $data = [
            'ticket_number' => $params['ticket_number'],
            'cancellation_reason' => $params['cancellation_reason'],
            'public_key' => $this->public_key
        ];
        $data['hash_string'] = $this->getHashKey($data, $hash_sequence);

        return $this->makeApiCall('v1/cancel-ticket', $data);
    }

    public function getWalletBalance()
    {
        $hash_sequence = "public_key";
        $data = [
            'public_key' => $this->public_key
        ];
        $data['hash_string'] = $this->getHashKey($data, $hash_sequence);

        return $this->makeApiCall('v1/get-wallet-balance', $data);
    }
}
