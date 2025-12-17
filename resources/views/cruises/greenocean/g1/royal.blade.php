<div class="conatiner">
    <div class="theatre">
        <div class="container p-0 m-0">
            <div class="row border-start border-end border-bottom justify-content-center">
                {{-- top-section --}}
                <div class="row justify-content-center">
                    {{-- Left col-3 (Seats 1-8) --}}
                    <div class="col-2 px-1">

                        @for ($row = 1; $row <= 3; $row++)
                            @php $seat = $sittingLayout['layout'][$row - 1] ?? null; @endphp
                            @if ($seat)
                                <div class="row flex-wrap mt-1 ">
                                    <div class="seat green col-12 px-1">
                                        <input type="checkbox" id="{{ $seat['seat_numbering'] }}" class="seat-checkbox"
                                            {{ $seat['status'] != 'available' ? 'disabled' : '' }}>
                                        <label for="{{ $seat['seat_numbering'] }}"
                                            class="{{ $seat['status'] != 'available' ? 'disabled' : (collect($selectedSeats)->contains(fn($s) => $s['seatno'] === $seat['seat_numbering']) ? 'selected' : 'unselect') }}"
                                            @if ($seat['status'] == 'available') wire:click="selectSeat('{{ $seat['seat_numbering'] }}', '{{ $seat['seat_no'] }}')" @endif>
                                            {{ $seat['seat_numbering'] }}
                                        </label>
                                    </div>
                                </div>
                            @endif
                        @endfor
                    </div>

                    <div class="col-8 px-1">
                        @for ($row = 1; $row <= 1; $row++)
                            @php $currentSeat=4 + ($row - 1) * 2; @endphp
                            <div class="row flex-wrap justify-content-center mt-1">
                                @for ($i = 0; $i < 4; $i++)
                                    @php
                                        $seat = $sittingLayout['layout'][$currentSeat + $i - 1] ?? null;
                                    @endphp
                                    @if ($seat)
                                        <div class="seat green col-6 px-1">
                                            <input type="checkbox" id="{{ $seat['seat_numbering'] }}"
                                                class="seat-checkbox"
                                                {{ $seat['status'] != 'available' ? 'disabled' : '' }}>
                                            <label for="{{ $seat['seat_numbering'] }}"
                                                class="{{ $seat['status'] != 'available' ? 'disabled' : (collect($selectedSeats)->contains(fn($s) => $s['seatno'] === $seat['seat_numbering']) ? 'selected' : 'unselect') }}"
                                                @if ($seat['status'] == 'available') wire:click="selectSeat('{{ $seat['seat_numbering'] }}', '{{ $seat['seat_no'] ?? '' }}')" @endif>
                                                {{ $seat['seat_numbering'] }}
                                            </label>
                                        </div>
                                    @endif
                                @endfor
                            </div>
                        @endfor
                        <div class="col-11 d-flex flex-wrap justify-content-center">
                            <div class="col-6 px-1">
                                @php
                                $startMiddle = 8; // Start from seat 9
                                $rowsMiddle = [2, 3]; // First row with 2 seats, second row with 3 seats
                            @endphp
                            
                            @foreach ($rowsMiddle as $key => $count)
                                <div class="row flex-wrap justify-content-end mt-1">
                                    @for ($i = 0; $i < $count; $i++)
                                        @php
                                            $seatIndex = $startMiddle - 1;
                                            $seat = $sittingLayout['layout'][$seatIndex] ?? null;
                                            $startMiddle++; // Increment for the next seat
                                        @endphp
                                        @if ($seat)
                                            <div class="seat green col-3 px-1">
                                                <input type="checkbox" id="{{ $seat['seat_numbering'] }}" class="seat-checkbox"
                                                    {{ $seat['status'] != 'available' ? 'disabled' : '' }}>
                                                <label for="{{ $seat['seat_numbering'] }}"
                                                    class="{{ $seat['status'] != 'available' ? 'disabled' : (collect($selectedSeats)->contains(fn($s) => $s['seatno'] === $seat['seat_numbering']) ? 'selected' : 'unselect') }}"
                                                    @if ($seat['status'] == 'available') wire:click="selectSeat('{{ $seat['seat_numbering'] }}', '{{ $seat['seat_no'] ?? '' }}')" @endif>
                                                    {{ $seat['seat_numbering'] }}
                                                </label>
                                            </div>
                                        @endif
                                    @endfor
                                </div>
                            @endforeach
                            
                            </div>

                            <div class="col-6 px-1 ">
                                @php
                                $startMiddle = 13; // Start from seat 14
                                $rowsMiddle = [2, 3]; // First row with 2 seats, second row with 3 seats
                            @endphp
                            
                            @foreach ($rowsMiddle as $key => $count)
                                <div class="row flex-wrap {{ $key === 0 ? 'justify-content-center' : 'flex-row-reverse' }} mt-1">
                                    @for ($i = 0; $i < $count; $i++)
                                        @php
                                            $seatIndex = $startMiddle - 1;
                                            $seat = $sittingLayout['layout'][$seatIndex] ?? null;
                                            $startMiddle++; // Increment for the next seat
                                        @endphp
                                        @if ($seat)
                                            <div class="seat green col-3 px-1">
                                                <input type="checkbox" id="{{ $seat['seat_numbering'] }}" class="seat-checkbox"
                                                    {{ $seat['status'] != 'available' ? 'disabled' : '' }}>
                                                <label for="{{ $seat['seat_numbering'] }}"
                                                    class="{{ $seat['status'] != 'available' ? 'disabled' : (collect($selectedSeats)->contains(fn($s) => $s['seatno'] === $seat['seat_numbering']) ? 'selected' : 'unselect') }}"
                                                    @if ($seat['status'] == 'available') wire:click="selectSeat('{{ $seat['seat_numbering'] }}', '{{ $seat['seat_no'] ?? '' }}')" @endif>
                                                    {{ $seat['seat_numbering'] }}
                                                </label>
                                            </div>
                                        @endif
                                    @endfor
                                </div>
                            @endforeach
                            
                            </div>
                        </div>
                    </div>

                    <div class="col-2 px-1">
                        @for ($row = 1; $row <= 3; $row++)
                            @php
                                $currentSeat = 18 + ($row - 1) * 1;
                                $seat = $sittingLayout['layout'][$currentSeat - 1] ?? null;
                            @endphp
                            @if ($seat)
                                <div class="row flex-wrap justify-content-end mt-1">
                                    <div class="seat green col-6 px-1">
                                        <input type="checkbox" id="{{ $seat['seat_numbering'] }}" class="seat-checkbox"
                                            {{ $seat['status'] != 'available' ? 'disabled' : '' }}>
                                        <label for="{{ $seat['seat_numbering'] }}"
                                            class="{{ $seat['status'] != 'available' ? 'disabled' : (collect($selectedSeats)->contains(fn($s) => $s['seatno'] === $seat['seat_numbering']) ? 'selected' : 'unselect') }}"
                                            @if ($seat['status'] == 'available') wire:click="selectSeat('{{ $seat['seat_numbering'] }}', '{{ $seat['seat_no'] ?? '' }}')" @endif>
                                            {{ $seat['seat_numbering'] }}
                                        </label>
                                    </div>
                                </div>
                            @endif
                        @endfor

                    </div>
                </div>
<div class="row my-2"></div>
                <div class="row justify-content-center">
                    <div class="col-6 px-1">
                        @php
                        $startMiddle = 21;
                        $seatIndex = $startMiddle; // Maintain a continuous seat index
                        $rowsMiddle = [2, 3, 3, 3, 3];
                    @endphp
                    
                    @foreach ($rowsMiddle as $key => $count)
                        <div class="row flex-wrap justify-content-start mt-1">
                            @for ($i = 0; $i < $count; $i++)
                                @php
                                    $seat = $sittingLayout['layout'][$seatIndex - 1] ?? null;
                                    $seatIndex++; // Move to the next seat
                                @endphp
                                @if ($seat)
                                    <div class="seat green col-3 px-1">
                                        <input type="checkbox" id="{{ $seat['seat_numbering'] }}" class="seat-checkbox"
                                            {{ $seat['status'] != 'available' ? 'disabled' : '' }}>
                                        <label for="{{ $seat['seat_numbering'] }}"
                                            class="{{ $seat['status'] != 'available' ? 'disabled' : (collect($selectedSeats)->contains(fn($s) => $s['seatno'] === $seat['seat_numbering']) ? 'selected' : 'unselect') }}"
                                            @if ($seat['status'] == 'available') wire:click="selectSeat('{{ $seat['seat_numbering'] }}', '{{ $seat['seat_no'] ?? '' }}')" @endif>
                                            {{ $seat['seat_numbering'] }}
                                        </label>
                                    </div>
                                @endif
                            @endfor
                        </div>
                    @endforeach
                    
                    
                    </div>

                    <div class="col-6 px-1">
                        @php
                        $startMiddle = 35;
                        $seatIndex = $startMiddle; // Maintain a continuous seat index
                        $rowsMiddle = [2, 3, 3, 3, 3];
                    @endphp
                    
                    @foreach ($rowsMiddle as $key => $count)
                        <div class="row flex-wrap justify-content-end mt-1">
                            @for ($i = 0; $i < $count; $i++)
                                @php
                                    $seat = $sittingLayout['layout'][$seatIndex - 1] ?? null;
                                    $seatIndex++; // Move to the next seat
                                @endphp
                                @if ($seat)
                                    <div class="seat green col-3 px-1">
                                        <input type="checkbox" id="{{ $seat['seat_numbering'] }}" class="seat-checkbox"
                                            {{ $seat['status'] != 'available' ? 'disabled' : '' }}>
                                        <label for="{{ $seat['seat_numbering'] }}"
                                            class="{{ $seat['status'] != 'available' ? 'disabled' : (collect($selectedSeats)->contains(fn($s) => $s['seatno'] === $seat['seat_numbering']) ? 'selected' : 'unselect') }}"
                                            @if ($seat['status'] == 'available') wire:click="selectSeat('{{ $seat['seat_numbering'] }}', '{{ $seat['seat_no'] ?? '' }}')" @endif>
                                            {{ $seat['seat_numbering'] }}
                                        </label>
                                    </div>
                                @endif
                            @endfor
                        </div>
                    @endforeach
                    
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
