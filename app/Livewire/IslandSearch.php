<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class IslandSearch extends Component
{
    public $locationName = '';
    public $place = '';
    public $distance = '';
    public $duration = '';
    public $deliveryOption = 'selfpickup';

    public function updatedLocationName($value)
    {
        if (empty($value)) {
            return;
        }

        // Geocode the location
        $response = Http::get('https://maps.googleapis.com/maps/api/geocode/json', [
            'address' => $value,
            'key' => 'AIzaSyAai7unx7nXZnFcC4tVv3AGzJVjjUr4-bg'
        ]);

        $data = $response->json();

        if ($data['status'] !== 'OK' || empty($data['results'])) {
            $this->addError('locationName', 'Invalid location');
            return;
        }

        $location = $data['results'][0]['geometry']['location'];
        $this->emit('initAutocomplete', [
            'locationName' => $value,
            'lat' => $location['lat'],
            'lng' => $location['lng']
        ]);
    }

    public function updatedDeliveryOption($value)
    {
        if ($value === 'selfpickup') {
            $this->place = '';
            $this->distance = '';
            $this->duration = '';
        }
    }

    public function updateDistance($data)
    {
        $this->place = $data['place'];
        $this->distance = $data['distance'];
        $this->duration = $data['duration'];
    }

    public function render()
    {
        return view('livewire.island-search');
    }
}
?>