<div class="theatre">
    <!-- Nautika Icon -->
 


    <div class="d-flex justify-content-center">
        <img src="{{ asset('site/img/nautika-wheels.png') }}" alt="nautika-icon" class="img-fluid">
    </div>
    <div class="container  p-0 m-0">
        <div class="row border-start border-end border-bottom">
            <div class="col-md-3 col-3 px-1">
                <div class="row px-1">
                    @foreach (['A', 'B'] as $group)
                        <div class="col-6 px-1">
                            @php
                                $groupedSeats = array_filter(
                                    $TravelData['SelectedFerry']['seats']['bClass'],
                                    fn($key) => str_ends_with($key, $group),
                                    ARRAY_FILTER_USE_KEY,
                                );
                            @endphp
                            @foreach ($groupedSeats as $seatKey => $aRow)
                                <div class="seat">
                                    <input type="checkbox" id="{{ $seatKey }}" class="seat-checkbox"
                                    {{ $aRow['isBooked'] || $aRow['isBlocked'] ? 'disabled' : '' }}>
                                    <label for="{{ $seatKey }}" class="{{ $aRow['isBooked'] || $aRow['isBlocked'] ? 'disabled' : (collect($selectedSeats)->contains(fn($seat) => $seat['seatno'] === $seatKey && $seat['tier'] === $aRow['tier']) ? 'selected' : 'unselect') }}" @if($aRow['isBooked'] || $aRow['isBlocked']) onclick="return false;" @else wire:click="selectSeat('{{ $seatKey }}', '{{ $aRow['tier'] }}')" @endif >
                                    {{ $seatKey }}
                                </label>
                                </div>
                            @endforeach
                        </div>
                    @endforeach

                </div>
            </div>

            <div class="col-md-6 col-6 mt-5 px-1">
                <div class="row px-1">
                    @foreach (['C', 'D', 'E', 'F', 'G', 'H'] as $group)
                        <div class="col-2 px-1">
                            @php
                                $groupedSeats = array_filter(
                                    $TravelData['SelectedFerry']['seats']['bClass'],
                                    fn($key) => str_ends_with($key, $group),
                                    ARRAY_FILTER_USE_KEY,
                                );
                            @endphp
                            @foreach ($groupedSeats as $seatKey => $aRow)
                                <div class="seat mid-seat">
                                    <input type="checkbox" id="{{ $seatKey }}" class="seat-checkbox"
                                    {{ $aRow['isBooked'] || $aRow['isBlocked'] ? 'disabled' : '' }}>
                                    <label for="{{ $seatKey }}" class="{{ $aRow['isBooked'] || $aRow['isBlocked'] ? 'disabled' : (collect($selectedSeats)->contains(fn($seat) => $seat['seatno'] === $seatKey && $seat['tier'] === $aRow['tier']) ? 'selected' : 'unselect') }}" @if($aRow['isBooked'] || $aRow['isBlocked']) onclick="return false;" @else wire:click="selectSeat('{{ $seatKey }}', '{{ $aRow['tier'] }}')" @endif >
                                    {{ $seatKey }}
                                </label>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
                <div class="row mt-3 text-center">
                    <div>
                        <img src="{{ asset('site/img/rear-nautika-royal.png') }}" alt="nautika-icon" class="img-fluid">
                    </div>
                    <p class="fs-6 mt-2 fw-bolder">Upper Deck</p>
                </div>
            </div>

            <div class="col-md-3 col-3 px-1">
                <div class="row px-1">
                    @foreach (['I', 'J', 'K'] as $group)
                        <div class="col-4 px-1">
                            @php
                                $groupedSeats = array_filter(
                                    $TravelData['SelectedFerry']['seats']['bClass'],
                                    fn($key) => str_ends_with($key, $group),
                                    ARRAY_FILTER_USE_KEY,
                                );
                            @endphp
                            @foreach ($groupedSeats as $seatKey => $aRow)
                                <div class="seat">
                                    <input type="checkbox" id="{{ $seatKey }}" class="seat-checkbox"
                                        {{ $aRow['isBooked'] || $aRow['isBlocked'] ? 'disabled' : '' }}>
                                        <label for="{{ $seatKey }}" class="{{ $aRow['isBooked'] || $aRow['isBlocked'] ? 'disabled' : (collect($selectedSeats)->contains(fn($seat) => $seat['seatno'] === $seatKey && $seat['tier'] === $aRow['tier']) ? 'selected' : 'unselect') }}" @if($aRow['isBooked'] || $aRow['isBlocked']) onclick="return false;" @else wire:click="selectSeat('{{ $seatKey }}', '{{ $aRow['tier'] }}')" @endif >
                                        {{ $seatKey }}
                                    </label>
                                    
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
