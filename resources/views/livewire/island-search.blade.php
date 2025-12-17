<div>
    <h2>Select Delivery Option</h2>
    <select wire:model="deliveryOption">
        <option value="selfpickup">Self Pickup</option>
        <option value="delivery">Delivery</option>
    </select>

    <h2>Enter an island or location (e.g., Port Blair, Havelock, Neil)</h2>
    <input wire:model.debounce.500ms="locationName" id="locationNameInput" type="text" placeholder="Type island/city..." style="width: 300px; padding:5px;" />
    @error('locationName') <span class="error">{{ $message }}</span> @enderror

    @if($deliveryOption === 'delivery')
        <h2>Search places in that island</h2>
        <input id="placeInput" type="text" placeholder="Search place..." style="width: 300px; padding:5px;" />
    @endif

    @if($place && $deliveryOption === 'delivery')
        <div>
            <p>Place: {{ $place }}</p>
            <p>Distance from airport: {{ $distance }}</p>
            <p>Duration: {{ $duration }}</p>
        </div>
    @endif
</div>