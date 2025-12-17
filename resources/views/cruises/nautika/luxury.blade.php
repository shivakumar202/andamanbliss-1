<div class="container">
    <div class="theatre">
        <div class="d-flex justify-content-center">
            <img src="{{ asset('site/img/luxury-class.png') }}" alt="nautika-icon" width="340px" height="462px" class="pb-3">
        </div>
        <div class="container p-0 m-0">
            <div class="row border-start border-end border-bottom justify-content-center">
                <div class="row ">
                    <div class="col-md-3 col-3 px-1">
                        <div class="row">
                            @foreach (['A', 'B', 'C'] as $group)
                                <div class="col-3 px-1">
                                    @php
                                        $groupedSeats = array_filter(
                                            $TravelData['SelectedFerry']['seats']['pClass'],
                                            fn($key) => str_ends_with($key, $group) &&
                                                (int) filter_var($key, FILTER_SANITIZE_NUMBER_INT) <= 6,
                                            ARRAY_FILTER_USE_KEY,
                                        );
                                    @endphp
                                    @foreach ($groupedSeats as $seatKey => $aRow)
                                        <div class="seat ">
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
                    <div class="col-md-6 col-6 px-1">
                        <div class="row align-items-end">
                            @foreach (['D', 'E', 'F', 'G', 'H', 'I'] as $group)
                                <div class="col-2 px-1">
                                    @php
                                        $groupedSeats = array_filter(
                                            $TravelData['SelectedFerry']['seats']['pClass'],
                                            fn($key) => str_ends_with($key, $group) &&
                                                (int) filter_var($key, FILTER_SANITIZE_NUMBER_INT) <= 7,
                                            ARRAY_FILTER_USE_KEY,
                                        );
                                    @endphp
                                    @foreach ($groupedSeats as $seatKey => $aRow)
                                        <div class="seat ">
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
                    <div class="col-md-3 col-3 px-1 ">
                        <div class="row justify-content-end">
                            @foreach (['J', 'K', 'L'] as $group)
                                <div class="col-3 px-1">
                                    @php
                                        $groupedSeats = array_filter(
                                            $TravelData['SelectedFerry']['seats']['pClass'],
                                            fn($key) => str_ends_with($key, $group) &&
                                                (int) filter_var($key, FILTER_SANITIZE_NUMBER_INT) <= 6,
                                            ARRAY_FILTER_USE_KEY,
                                        );
                                    @endphp
                                    @foreach ($groupedSeats as $seatKey => $aRow)
                                        <div class="seat ">
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


                <div class="d-flex justify-content-center">
                    <img src="{{ asset('site/img/ferry-counter.png') }}" alt="nautika-icon" width="200px"
                        height="202px">
                </div>

                <div class="row">
                    <div class="col-md-3 col-3 px-1 ">
                        <div class="row">
                            @foreach (['A', 'B', 'C'] as $group)
                                <div class="col-3 px-1">
                                    @php
                                        $groupedSeats = array_filter(
                                            $TravelData['SelectedFerry']['seats']['pClass'],
                                            fn($key) => str_ends_with($key, $group) &&
                                                (int) filter_var($key, FILTER_SANITIZE_NUMBER_INT) >= 7,
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
                    <div class="col-md-6 col-6 px-1">
                        <div class="row">
                            @foreach (['D', 'E', 'F', 'G', 'H', 'I'] as $group)
                                <div class="col-2 px-1">
                                    @php
                                        $groupedSeats = array_filter(
                                            $TravelData['SelectedFerry']['seats']['pClass'],
                                            fn($key) => str_ends_with($key, $group) &&
                                                (int) filter_var($key, FILTER_SANITIZE_NUMBER_INT) >= 8,
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
                    <div class="col-md-3 col-3 px-1 ">
                        <div class="row justify-content-end">
                            @foreach (['J', 'K', 'L'] as $group)
                                <div class="col-3 px-1">
                                    @php
                                        $groupedSeats = array_filter(
                                            $TravelData['SelectedFerry']['seats']['pClass'],
                                            fn($key) => str_ends_with($key, $group) &&
                                                (int) filter_var($key, FILTER_SANITIZE_NUMBER_INT) >= 7,
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

                    <div class="row mb-3 justify-content-center">
                        <div>
                            <img src="{{ asset('site/img/Rear.png') }}" alt="nautika-icon">
                        </div>
                        <p class="fs-6 text-center border shadow pt-3">Rescue Boat </p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
