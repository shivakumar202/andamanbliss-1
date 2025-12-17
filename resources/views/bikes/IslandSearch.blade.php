<!DOCTYPE html>
<html>
<head>
    <title>Dynamic Island Place Search</title>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAai7unx7nXZnFcC4tVv3AGzJVjjUr4-bg&libraries=places"></script>
</head>
<body>
    <livewire:island-search></livewire:island-search>

    @push('scripts')
    <script>
        document.addEventListener('livewire:load', function () {
            Livewire.on('initAutocomplete', ({ locationName, lat, lng }) => {
                const placeInput = document.getElementById('placeInput');
                const airportCoords = { lat: 11.837163977960355, lng: 93.0311169452423 };
                let autocomplete;

                // Create bounds around the island (approx 5km radius)
                const islandBounds = new google.maps.LatLngBounds(
                    new google.maps.LatLng(lat - 0.045, lng - 0.045),
                    new google.maps.LatLng(lat + 0.045, lng + 0.045)
                );

                // Initialize autocomplete
                autocomplete = new google.maps.places.Autocomplete(placeInput, {
                    bounds: islandBounds,
                    strictBounds: true,
                    types: []
                });

                autocomplete.addListener('place_changed', () => {
                    const place = autocomplete.getPlace();
                    if (!place.geometry) {
                        console.log("No details available for input:", place.name);
                        return;
                    }

                    const selectedCoords = {
                        lat: place.geometry.location.lat(),
                        lng: place.geometry.location.lng()
                    };

                    // Calculate road distance
                    const directionsService = new google.maps.DirectionsService();
                    const request = {
                        origin: airportCoords,
                        destination: selectedCoords,
                        travelMode: google.maps.TravelMode.DRIVING
                    };

                    directionsService.route(request, (result, status) => {
                        if (status === google.maps.DirectionsStatus.OK) {
                            const distanceText = result.routes[0].legs[0].distance.text;
                            const durationText = result.routes[0].legs[0].duration.text;
                            Livewire.emit('updateDistance', {
                                place: place.name,
                                distance: distanceText,
                                duration: durationText
                            });
                        } else {
                            console.error("Directions request failed:", status);
                        }
                    });
                });

                console.log(`Autocomplete restricted to: ${locationName}`);
            });
        });
    </script>
@endpush
</body>
</html>