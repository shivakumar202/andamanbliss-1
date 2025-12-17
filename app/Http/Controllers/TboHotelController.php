<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Services\TboHotelService;
use Cache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TboHotelController extends Controller
{
    public function showHotel(TboHotelService $tbohotelservice)
    {
        $params = [
            "CityCode" => "133556",
            "IsDetailedResponse" => true
        ];

        $response = $tbohotelservice->getHotels($params);

        $timestamp = now()->format('Y-m-d_H-i-s');
        Storage::put("hotel-responses/response_{$timestamp}.json", json_encode($response, JSON_PRETTY_PRINT));
        if (isset($response['Hotels']) && is_array($response['Hotels'])) {
            foreach ($response['Hotels'] as $hotel) {


               $hotelDetail =  $tbohotelservice->getHotelDetails($hotel['HotelCode']);
                Hotel::updateOrCreate(
                    ['hotel_code' => $hotel['HotelCode']],
                    [
                        'hotel_name' => $hotel['HotelName'] ?? '',
                        'slug' => Str::slug($hotel['HotelName'] ?? '', '-'),
                        'hotel_rating' => $hotel['HotelRating'] ?? '',
                        'address' => $hotel['Address'] ?? '',
                        'hotel_image' => $hotelDetail['HotelDetails'][0]['Image'] ?? '',
                        'hotel_gallery' => ($hotelDetail['HotelDetails'][0]['Images'] ?? []),
                        'attractions' => json_encode($hotel['Attractions'] ?? []),
                        'country_name' => $hotel['CountryName'] ?? '',
                        'country_code' => $hotel['CountryCode'] ?? '',
                        'description' => $hotelDetail['HotelDetails'][0]['Description'] ?? '',
                        'fax_number' => $hotel['FaxNumber'] ?? '',
                        'hotel_facilities' => json_encode($hotel['HotelFacilities'] ?? []),
                        'map' => $hotel['Map'] ?? '',
                        'phone_number' => $hotel['PhoneNumber'] ?? '',
                        'pin_code' => $hotel['PinCode'] ?? '',
                        'hotel_website_url' => $hotel['HotelWebsiteUrl'] ?? '',
                        'city_name' => $hotel['CityName'] ?? '',
                    ]
                );
            }

            return response()->json(['message' => 'Hotels synced successfully']);
        }

        return response()->json(['message' => 'No hotels found in response.'], 204);
    }







}
