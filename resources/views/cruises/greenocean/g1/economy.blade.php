<div class="container">
    <div class="theatre">
        <div class="container p-0 m-0">
            <div class="row border-start border-end border-bottom justify-content-center">
                {{-- top-section --}}
                <div class="row justify-content-center">
                    {{-- Left col-3 (Seats 1-8) --}}
                    <div class="col-3 px-1">
                        <div class="row flex-wrap mb-4">

                        </div>
                        @for ($row = 1; $row <= 4; $row++)
                            @php $currentSeat = ($row - 1) * 2 + 1; @endphp
                            <div class="row flex-wrap mt-1">
                                @foreach (array_slice($sittingLayout['layout'], $currentSeat - 1, 2) as $seat)
                                    <div class="seat green col-6 px-1">
                                        <input type="checkbox" id="E{{ $seat['seat_no'] }}" class="seat-checkbox"
                                            {{ $seat['status'] != 'available' ? 'disabled' : '' }}>
                                        <label for="E{{ $seat['seat_no'] }}"
                                            class="{{ $seat['status'] != 'available' ? 'disabled' : (collect($selectedSeats)->contains(fn($s) => $s['seatno'] === 'E' . $seat['seat_no']) ? 'selected' : 'unselect') }}"
                                            @if ($seat['status'] == 'available') wire:click="selectSeat('E{{ $seat['seat_no'] }}', '{{ $seat['seat_no'] ?? '' }}')" @endif>
                                            {{ $seat['seat_numbering'] }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        @endfor

                    </div>

                    {{-- Middle col-6 (Seats 27-50) --}}
                    <div class="col-6 px-1">
                        @php
                            $startMiddle = 27;
                            $rowsMiddle = [5, 5, 5, 5, 4];
                        @endphp
                        @foreach ($rowsMiddle as $key => $count)
                            <div class="row flex-wrap justify-content-center">
                                @php $currentStart = $startMiddle + ($key * 5); @endphp
                                @for ($i = 0; $i < $count; $i++)
                                    @php $seat = $sittingLayout['layout'][$currentStart + $i - 1] ?? null; @endphp
                                    @if ($seat)
                                        <div class="seat green col-3 px-1">
                                            <input type="checkbox" id="E{{ $seat['seat_no'] }}" class="seat-checkbox"
                                                {{ $seat['status'] != 'available' ? 'disabled' : '' }}>
                                            <label for="E{{ $seat['seat_no'] }}"
                                                class="{{ $seat['status'] != 'available' ? 'disabled' : (collect($selectedSeats)->contains(fn($s) => $s['seatno'] === 'E' . $seat['seat_no']) ? 'selected' : 'unselect') }}"
                                                @if ($seat['status'] == 'available') wire:click="selectSeat('E{{ $seat['seat_no'] }}', '{{ $seat['seat_no'] ?? '' }}')" @endif>
                                                {{ $seat['seat_numbering'] }}
                                            </label>
                                        </div>
                                    @endif
                                @endfor
                            </div>
                        @endforeach
                    </div>


                    {{-- Right col-3 (Seats 51-60) --}}
                    <div class="col-3 px-1">
                        @for ($row = 1; $row <= 5; $row++)
                            @php $currentSeat = 51 + ($row - 1) * 2; @endphp
                            <div class="row flex-wrap justify-content-end">
                                @php $seatLeft = $sittingLayout['layout'][$currentSeat - 1] ?? null; @endphp
                                @php $seatRight = $sittingLayout['layout'][$currentSeat] ?? null; @endphp

                                @if ($seatLeft)
                                    <div class="seat green col-6 px-1">
                                        <input type="checkbox" id="E{{ $seatLeft['seat_no'] }}" class="seat-checkbox"
                                            {{ $seatLeft['status'] == 'available' ? '' : 'disabled' }}>
                                        <label for="E{{ $seatLeft['seat_no'] }}"
                                            class="{{ $seatLeft['status'] != 'available' ? 'disabled' : (collect($selectedSeats)->contains(fn($seat) => $seat['seatno'] === 'E' . $seatLeft['seat_no']) ? 'selected' : 'unselect') }}"
                                            @if ($seatLeft['status'] == 'available') wire:click="selectSeat('E{{ $seatLeft['seat_no'] }}', '{{ $seatLeft['seat_no'] ?? '' }}')" @endif>
                                            {{ $seatLeft['seat_numbering'] }}
                                        </label>

                                    </div>
                                @endif

                                @if ($seatRight)
                                    <div class="seat green col-6 px-1">
                                        <input type="checkbox" id="E{{ $seatRight['seat_no'] }}" class="seat-checkbox"
                                            {{ $seatRight['status'] != 'available' ? 'disabled' : '' }}>
                                        <label for="E{{ $seatRight['seat_no'] }}"
                                            class="{{ $seatRight['status'] != 'available' ? 'disabled' : (collect($selectedSeats)->contains(fn($s) => $s['seatno'] === 'E' . $seatRight['seat_no']) ? 'selected' : 'unselect') }}"
                                            @if ($seatRight['status'] == 'available') wire:click="selectSeat('E{{ $seatRight['seat_no'] }}', '{{ $seatRight['seat_no'] ?? '' }}')" @endif>
                                            {{ $seatRight['seat_numbering'] }}
                                        </label>
                                    </div>
                                @endif

                            </div>
                        @endfor
                    </div>
                </div>


                {{-- center-section --}}
                <div class="row justify-content-center">
                    <div class="col-6 px-1">
                        @for ($row = 1; $row <= 1; $row++)
                            @php $currentSeat = 9 + ($row - 1) * 2; @endphp
                            <div class="row flex-wrap">
                                <div class="seat green col-6 px-1">
                                    <input type="checkbox" id="E{{ $currentSeat }}" class="seat-checkbox"
                                        {{ $sittingLayout['layout'][$currentSeat - 1]['status'] != 'available' ? 'disabled' : '' }}>
                                    <label for="E{{ $currentSeat }}"
                                        class="{{ $sittingLayout['layout'][$currentSeat - 1]['status'] != 'available' ? 'disabled' : (collect($selectedSeats)->contains(fn($seat) => $seat['seatno'] === 'E' . $currentSeat) ? 'selected' : 'unselect') }}"
                                        @if ($sittingLayout['layout'][$currentSeat - 1]['status'] == 'available') wire:click="selectSeat('E{{ $currentSeat }}', '{{ $sittingLayout['layout'][$currentSeat - 1]['seat_no'] ?? '' }}')" @endif>
                                        {{ $currentSeat }}
                                    </label>
                                </div>
                                <div class="seat green col-6 px-1">
                                    <input type="checkbox" id="E{{ $currentSeat + 1 }}" class="seat-checkbox"
                                        {{ $sittingLayout['layout'][$currentSeat] && $sittingLayout['layout'][$currentSeat]['status'] != 'available' ? 'disabled' : '' }}>
                                    <label for="E{{ $currentSeat + 1 }}"
                                        class="{{ $sittingLayout['layout'][$currentSeat] && $sittingLayout['layout'][$currentSeat]['status'] != 'available' ? 'disabled' : (collect($selectedSeats)->contains(fn($seat) => $seat['seatno'] === 'E' . ($currentSeat + 1)) ? 'selected' : 'unselect') }}"
                                        @if ($sittingLayout['layout'][$currentSeat] && $sittingLayout['layout'][$currentSeat]['status'] == 'available') wire:click="selectSeat('E{{ $currentSeat + 1 }}', '{{ $sittingLayout['layout'][$currentSeat]['seat_no'] ?? '' }}')" @endif>
                                        {{ $currentSeat + 1 }}
                                    </label>
                                </div>
                                <div class="seat green col-6 px-1">
                                    <input type="checkbox" id="E{{ $currentSeat + 2 }}" class="seat-checkbox"
                                        {{ $sittingLayout['layout'][$currentSeat + 1] && $sittingLayout['layout'][$currentSeat + 1]['status'] != 'available' ? 'disabled' : '' }}>
                                    <label for="E{{ $currentSeat + 2 }}"
                                        class="{{ $sittingLayout['layout'][$currentSeat + 1] && $sittingLayout['layout'][$currentSeat + 1]['status'] != 'available' ? 'disabled' : (collect($selectedSeats)->contains(fn($seat) => $seat['seatno'] === 'E' . ($currentSeat + 2)) ? 'selected' : 'unselect') }}"
                                        @if ($sittingLayout['layout'][$currentSeat + 1] && $sittingLayout['layout'][$currentSeat + 1]['status'] == 'available') wire:click="selectSeat('E{{ $currentSeat + 2 }}', '{{ $sittingLayout['layout'][$currentSeat + 1]['seat_no'] ?? '' }}')" @endif>
                                        {{ $currentSeat + 2 }}
                                    </label>
                                </div>
                            </div>
                        @endfor
                    </div>

                    <div class="col-6 px-1">
                        @for ($row = 1; $row <= 1; $row++)
                            @php $currentSeat = 61 + ($row - 1) * 2; @endphp
                            <div class="row flex-wrap justify-content-end">
                                <div class="seat green col-6 px-1">
                                    <input type="checkbox" id="E{{ $currentSeat }}" class="seat-checkbox"
                                        {{ $sittingLayout['layout'][$currentSeat - 1]['status'] != 'available' ? 'disabled' : '' }}>
                                    <label for="E{{ $currentSeat }}"
                                        class="{{ $sittingLayout['layout'][$currentSeat - 1]['status'] != 'available' ? 'disabled' : (collect($selectedSeats)->contains(fn($seat) => $seat['seatno'] === 'E' . $currentSeat) ? 'selected' : 'unselect') }}"
                                        @if ($sittingLayout['layout'][$currentSeat - 1]['status'] == 'available') wire:click="selectSeat('E{{ $currentSeat }}', '{{ $sittingLayout['layout'][$currentSeat - 1]['seat_no'] ?? '' }}')" @endif>
                                        {{ $currentSeat }}
                                    </label>
                                </div>
                                <div class="seat green col-6 px-1">
                                    <input type="checkbox" id="E{{ $currentSeat + 1 }}" class="seat-checkbox"
                                        {{ $sittingLayout['layout'][$currentSeat] && $sittingLayout['layout'][$currentSeat]['status'] != 'available' ? 'disabled' : '' }}>
                                    <label for="E{{ $currentSeat + 1 }}"
                                        class="{{ $sittingLayout['layout'][$currentSeat] && $sittingLayout['layout'][$currentSeat]['status'] != 'available' ? 'disabled' : (collect($selectedSeats)->contains(fn($seat) => $seat['seatno'] === 'E' . ($currentSeat + 1)) ? 'selected' : 'unselect') }}"
                                        @if ($sittingLayout['layout'][$currentSeat] && $sittingLayout['layout'][$currentSeat]['status'] == 'available') wire:click="selectSeat('E{{ $currentSeat + 1 }}', '{{ $sittingLayout['layout'][$currentSeat]['seat_no'] ?? '' }}')" @endif>
                                        {{ $currentSeat + 1 }}
                                    </label>
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>




                <div class="row justify-content-center">
                    <div class="col-4 px-1">
                        @for ($row = 1; $row <= 1; $row++)
                            @php $currentSeat = 12 + ($row - 1) * 2; @endphp
                            <div class="row flex-wrap">
                                <div class="seat green col-6 px-1">
                                    <input type="checkbox" id="E{{ $currentSeat }}" class="seat-checkbox"
                                        {{ isset($sittingLayout['layout'][$currentSeat - 1]) && $sittingLayout['layout'][$currentSeat - 1]['status'] != 'available' ? 'disabled' : '' }}
                                        @if (isset($sittingLayout['layout'][$currentSeat - 1]) &&
                                                $sittingLayout['layout'][$currentSeat - 1]['status'] == 'available') wire:click="selectSeat('E{{ $currentSeat }}', '{{ $sittingLayout['layout'][$currentSeat - 1]['seat_no'] ?? '' }}')" @endif>
                                    <label for="E{{ $currentSeat }}"
                                        class="{{ isset($sittingLayout['layout'][$currentSeat - 1]) && $sittingLayout['layout'][$currentSeat - 1]['status'] != 'available' ? 'disabled' : (collect($selectedSeats)->contains(fn($seat) => $seat['seatno'] === 'E' . $currentSeat) ? 'selected' : 'unselect') }}">
                                        {{ $currentSeat }}
                                    </label>
                                </div>
                                <div class="seat green col-6 px-1">
                                    <input type="checkbox" id="E{{ $currentSeat + 1 }}" class="seat-checkbox"
                                        {{ isset($sittingLayout['layout'][$currentSeat]) && $sittingLayout['layout'][$currentSeat]['status'] != 'available' ? 'disabled' : '' }}
                                        @if (isset($sittingLayout['layout'][$currentSeat]) && $sittingLayout['layout'][$currentSeat]['status'] == 'available') wire:click="selectSeat('E{{ $currentSeat + 1 }}', '{{ $sittingLayout['layout'][$currentSeat]['seat_no'] ?? '' }}')" @endif>
                                    <label for="E{{ $currentSeat + 1 }}"
                                        class="{{ isset($sittingLayout['layout'][$currentSeat]) && $sittingLayout['layout'][$currentSeat]['status'] != 'available' ? 'disabled' : (collect($selectedSeats)->contains(fn($seat) => $seat['seatno'] === 'E' . ($currentSeat + 1)) ? 'selected' : 'unselect') }}">
                                        {{ $currentSeat + 1 }}
                                    </label>
                                </div>
                            </div>
                        @endfor
                    </div>


                    <div class="col-2 px-1">
                        @for ($row = 1; $row <= 1; $row++)
                            @php $currentSeat = 14 + ($row - 1) * 2; @endphp
                            <div class="row flex-wrap">
                                <div class="seat green col-6 px-1">
                                    <input type="checkbox" id="E{{ $currentSeat }}" class="seat-checkbox"
                                        {{ isset($sittingLayout['layout'][$currentSeat - 1]) && $sittingLayout['layout'][$currentSeat - 1]['status'] != 'available' ? 'disabled' : '' }}
                                        @if (isset($sittingLayout['layout'][$currentSeat - 1]) &&
                                                $sittingLayout['layout'][$currentSeat - 1]['status'] == 'available') wire:click="selectSeat('E{{ $currentSeat }}', '{{ $sittingLayout['layout'][$currentSeat - 1]['seat_no'] ?? '' }}')" @endif>
                                    <label for="E{{ $currentSeat }}"
                                        class="{{ isset($sittingLayout['layout'][$currentSeat - 1]) && $sittingLayout['layout'][$currentSeat - 1]['status'] != 'available' ? 'disabled' : (collect($selectedSeats)->contains(fn($seat) => $seat['seatno'] === 'E' . $currentSeat) ? 'selected' : 'unselect') }}">
                                        {{ $currentSeat }}
                                    </label>
                                </div>
                                <div class="seat green col-6 px-1">
                                    <input type="checkbox" id="E{{ $currentSeat + 1 }}" class="seat-checkbox"
                                        {{ isset($sittingLayout['layout'][$currentSeat]) && $sittingLayout['layout'][$currentSeat]['status'] != 'available' ? 'disabled' : '' }}
                                        @if (isset($sittingLayout['layout'][$currentSeat]) && $sittingLayout['layout'][$currentSeat]['status'] == 'available') wire:click="selectSeat('E{{ $currentSeat + 1 }}', '{{ $sittingLayout['layout'][$currentSeat]['seat_no'] ?? '' }}')" @endif>
                                    <label for="E{{ $currentSeat + 1 }}"
                                        class="{{ isset($sittingLayout['layout'][$currentSeat]) && $sittingLayout['layout'][$currentSeat]['status'] != 'available' ? 'disabled' : (collect($selectedSeats)->contains(fn($seat) => $seat['seatno'] === 'E' . ($currentSeat + 1)) ? 'selected' : 'unselect') }}">
                                        {{ $currentSeat + 1 }}
                                    </label>
                                </div>
                            </div>
                        @endfor
                    </div>




                    <div class="col-6 px-1">
                        @for ($row = 1; $row <= 1; $row++)
                            @php $currentSeat = 63 + ($row - 1) * 2; @endphp
                            <div class="row flex-wrap justify-content-end">
                                <div class="seat green col-6 px-1">
                                    <input type="checkbox" id="E{{ $currentSeat }}" class="seat-checkbox"
                                        {{ isset($sittingLayout['layout'][$currentSeat - 1]) && $sittingLayout['layout'][$currentSeat - 1]['status'] != 'available' ? 'disabled' : '' }}
                                        @if (isset($sittingLayout['layout'][$currentSeat - 1]) &&
                                                $sittingLayout['layout'][$currentSeat - 1]['status'] == 'available') wire:click="selectSeat('E{{ $currentSeat }}', '{{ $sittingLayout['layout'][$currentSeat - 1]['seat_no'] ?? '' }}')" @endif>
                                    <label for="E{{ $currentSeat }}"
                                        class="{{ isset($sittingLayout['layout'][$currentSeat - 1]) && $sittingLayout['layout'][$currentSeat - 1]['status'] != 'available' ? 'disabled' : (collect($selectedSeats)->contains(fn($seat) => $seat['seatno'] === 'E' . $currentSeat) ? 'selected' : 'unselect') }}">
                                        {{ $currentSeat }}
                                    </label>
                                </div>
                                <div class="seat green col-6 px-1">
                                    <input type="checkbox" id="E{{ $currentSeat + 1 }}" class="seat-checkbox"
                                        {{ isset($sittingLayout['layout'][$currentSeat]) && $sittingLayout['layout'][$currentSeat]['status'] != 'available' ? 'disabled' : '' }}
                                        @if (isset($sittingLayout['layout'][$currentSeat]) && $sittingLayout['layout'][$currentSeat]['status'] == 'available') wire:click="selectSeat('E{{ $currentSeat + 1 }}', '{{ $sittingLayout['layout'][$currentSeat]['seat_no'] ?? '' }}')" @endif>
                                    <label for="E{{ $currentSeat + 1 }}"
                                        class="{{ isset($sittingLayout['layout'][$currentSeat]) && $sittingLayout['layout'][$currentSeat]['status'] != 'available' ? 'disabled' : (collect($selectedSeats)->contains(fn($seat) => $seat['seatno'] === 'E' . ($currentSeat + 1)) ? 'selected' : 'unselect') }}">
                                        {{ $currentSeat + 1 }}
                                    </label>
                                </div>
                                <div class="seat green col-6 px-1">
                                    <input type="checkbox" id="E{{ $currentSeat + 2 }}" class="seat-checkbox"
                                        {{ isset($sittingLayout['layout'][$currentSeat + 1]) && $sittingLayout['layout'][$currentSeat + 1]['status'] != 'available' ? 'disabled' : '' }}
                                        @if (isset($sittingLayout['layout'][$currentSeat + 1]) &&
                                                $sittingLayout['layout'][$currentSeat + 1]['status'] == 'available') wire:click="selectSeat('E{{ $currentSeat + 2 }}', '{{ $sittingLayout['layout'][$currentSeat + 1]['seat_no'] ?? '' }}')" @endif>
                                    <label for="E{{ $currentSeat + 2 }}"
                                        class="{{ isset($sittingLayout['layout'][$currentSeat + 1]) && $sittingLayout['layout'][$currentSeat + 1]['status'] != 'available' ? 'disabled' : (collect($selectedSeats)->contains(fn($seat) => $seat['seatno'] === 'E' . ($currentSeat + 2)) ? 'selected' : 'unselect') }}">
                                        {{ $currentSeat + 2 }}
                                    </label>
                                </div>
                                <div class="seat green col-6 px-1">
                                    <input type="checkbox" id="E{{ $currentSeat + 3 }}" class="seat-checkbox"
                                        {{ isset($sittingLayout['layout'][$currentSeat + 2]) && $sittingLayout['layout'][$currentSeat + 2]['status'] != 'available' ? 'disabled' : '' }}
                                        @if (isset($sittingLayout['layout'][$currentSeat + 2]) &&
                                                $sittingLayout['layout'][$currentSeat + 2]['status'] == 'available') wire:click="selectSeat('E{{ $currentSeat + 3 }}', '{{ $sittingLayout['layout'][$currentSeat + 2]['seat_no'] ?? '' }}')" @endif>
                                    <label for="E{{ $currentSeat + 3 }}"
                                        class="{{ isset($sittingLayout['layout'][$currentSeat + 2]) && $sittingLayout['layout'][$currentSeat + 2]['status'] != 'available' ? 'disabled' : (collect($selectedSeats)->contains(fn($seat) => $seat['seatno'] === 'E' . ($currentSeat + 3)) ? 'selected' : 'unselect') }}">
                                        {{ $currentSeat + 3 }}
                                    </label>
                                </div>
                                <div class="seat green col-6 px-1">
                                    <input type="checkbox" id="E{{ $currentSeat + 4 }}" class="seat-checkbox"
                                        {{ isset($sittingLayout['layout'][$currentSeat + 3]) && $sittingLayout['layout'][$currentSeat + 3]['status'] != 'available' ? 'disabled' : '' }}
                                        @if (isset($sittingLayout['layout'][$currentSeat + 3]) &&
                                                $sittingLayout['layout'][$currentSeat + 3]['status'] == 'available') wire:click="selectSeat('E{{ $currentSeat + 4 }}', '{{ $sittingLayout['layout'][$currentSeat + 3]['seat_no'] ?? '' }}')" @endif>
                                    <label for="E{{ $currentSeat + 4 }}"
                                        class="{{ isset($sittingLayout['layout'][$currentSeat + 3]) && $sittingLayout['layout'][$currentSeat + 3]['status'] != 'available' ? 'disabled' : (collect($selectedSeats)->contains(fn($seat) => $seat['seatno'] === 'E' . ($currentSeat + 4)) ? 'selected' : 'unselect') }}">
                                        {{ $currentSeat + 4 }}
                                    </label>
                                </div>
                            </div>
                        @endfor
                    </div>



                </div>


                <div class="row justify-content-center">
                    <div class="col-4 px-1">
                        @for ($row = 1; $row <= 1; $row++)
                            @php $currentSeat = 16 + ($row - 1) * 2; @endphp
                            <div class="row flex-wrap">
                                <div class="seat green col-6 px-1">
                                    <input type="checkbox" id="E{{ $currentSeat }}" class="seat-checkbox"
                                        {{ isset($sittingLayout['layout'][$currentSeat - 1]) && $sittingLayout['layout'][$currentSeat - 1]['status'] != 'available' ? 'disabled' : '' }}
                                        @if (isset($sittingLayout['layout'][$currentSeat - 1]) &&
                                                $sittingLayout['layout'][$currentSeat - 1]['status'] == 'available') wire:click="selectSeat('E{{ $currentSeat }}', '{{ $sittingLayout['layout'][$currentSeat - 1]['seat_no'] ?? '' }}')" @endif>
                                    <label for="E{{ $currentSeat }}"
                                        class="{{ isset($sittingLayout['layout'][$currentSeat - 1]) && $sittingLayout['layout'][$currentSeat - 1]['status'] != 'available' ? 'disabled' : (collect($selectedSeats)->contains(fn($seat) => $seat['seatno'] === 'E' . $currentSeat) ? 'selected' : 'unselect') }}">
                                        {{ $currentSeat }}
                                    </label>
                                </div>
                                <div class="seat green col-6 px-1">
                                    <input type="checkbox" id="E{{ $currentSeat + 1 }}" class="seat-checkbox"
                                        {{ isset($sittingLayout['layout'][$currentSeat]) && $sittingLayout['layout'][$currentSeat]['status'] != 'available' ? 'disabled' : '' }}
                                        @if (isset($sittingLayout['layout'][$currentSeat]) && $sittingLayout['layout'][$currentSeat]['status'] == 'available') wire:click="selectSeat('E{{ $currentSeat + 1 }}', '{{ $sittingLayout['layout'][$currentSeat]['seat_no'] ?? '' }}')" @endif>
                                    <label for="E{{ $currentSeat + 1 }}"
                                        class="{{ isset($sittingLayout['layout'][$currentSeat]) && $sittingLayout['layout'][$currentSeat]['status'] != 'available' ? 'disabled' : (collect($selectedSeats)->contains(fn($seat) => $seat['seatno'] === 'E' . ($currentSeat + 1)) ? 'selected' : 'unselect') }}">
                                        {{ $currentSeat + 1 }}
                                    </label>
                                </div>
                                <div class="seat green col-6 px-1">
                                    <input type="checkbox" id="E{{ $currentSeat + 2 }}" class="seat-checkbox"
                                        {{ isset($sittingLayout['layout'][$currentSeat + 1]) && $sittingLayout['layout'][$currentSeat + 1]['status'] != 'available' ? 'disabled' : '' }}
                                        @if (isset($sittingLayout['layout'][$currentSeat + 1]) &&
                                                $sittingLayout['layout'][$currentSeat + 1]['status'] == 'available') wire:click="selectSeat('E{{ $currentSeat + 2 }}', '{{ $sittingLayout['layout'][$currentSeat + 1]['seat_no'] ?? '' }}')" @endif>
                                    <label for="E{{ $currentSeat + 2 }}"
                                        class="{{ isset($sittingLayout['layout'][$currentSeat + 1]) && $sittingLayout['layout'][$currentSeat + 1]['status'] != 'available' ? 'disabled' : (collect($selectedSeats)->contains(fn($seat) => $seat['seatno'] === 'E' . ($currentSeat + 2)) ? 'selected' : 'unselect') }}">
                                        {{ $currentSeat + 2 }}
                                    </label>
                                </div>
                            </div>
                        @endfor
                    </div>



                    <div class="col-2 px-1">
                        @for ($row = 1; $row <= 1; $row++)
                            @php $currentSeat = 19 + ($row - 1) * 2; @endphp
                            <div class="row flex-wrap">
                                <div class="seat green col-6 px-1">
                                    <input type="checkbox" id="E{{ $currentSeat }}" class="seat-checkbox"
                                        {{ isset($sittingLayout['layout'][$currentSeat - 1]) && $sittingLayout['layout'][$currentSeat - 1]['status'] != 'available' ? 'disabled' : '' }}
                                        @if (isset($sittingLayout['layout'][$currentSeat - 1]) &&
                                                $sittingLayout['layout'][$currentSeat - 1]['status'] == 'available') wire:click="selectSeat('E{{ $currentSeat }}', '{{ $sittingLayout['layout'][$currentSeat - 1]['seat_no'] ?? '' }}')" @endif>
                                    <label for="E{{ $currentSeat }}"
                                        class="{{ isset($sittingLayout['layout'][$currentSeat - 1]) && $sittingLayout['layout'][$currentSeat - 1]['status'] != 'available' ? 'disabled' : (collect($selectedSeats)->contains(fn($seat) => $seat['seatno'] === 'E' . $currentSeat) ? 'selected' : 'unselect') }}">
                                        {{ $currentSeat }}
                                    </label>
                                </div>
                                <div class="seat green col-6 px-1">
                                    <input type="checkbox" id="E{{ $currentSeat + 1 }}" class="seat-checkbox"
                                        {{ isset($sittingLayout['layout'][$currentSeat]) && $sittingLayout['layout'][$currentSeat]['status'] != 'available' ? 'disabled' : '' }}
                                        @if (isset($sittingLayout['layout'][$currentSeat]) && $sittingLayout['layout'][$currentSeat]['status'] == 'available') wire:click="selectSeat('E{{ $currentSeat + 1 }}', '{{ $sittingLayout['layout'][$currentSeat]['seat_no'] ?? '' }}')" @endif>
                                    <label for="E{{ $currentSeat + 1 }}"
                                        class="{{ isset($sittingLayout['layout'][$currentSeat]) && $sittingLayout['layout'][$currentSeat]['status'] != 'available' ? 'disabled' : (collect($selectedSeats)->contains(fn($seat) => $seat['seatno'] === 'E' . ($currentSeat + 1)) ? 'selected' : 'unselect') }}">
                                        {{ $currentSeat + 1 }}
                                    </label>
                                </div>
                            </div>
                        @endfor
                    </div>



                    <div class="col-6 px-1">
                        @for ($row = 1; $row <= 1; $row++)
                            @php $currentSeat = 68 + ($row - 1) * 2; @endphp
                            <div class="row flex-wrap justify-content-end">
                                <div class="seat green col-6 px-1">
                                    <input type="checkbox" id="E{{ $currentSeat }}" class="seat-checkbox"
                                        {{ isset($sittingLayout['layout'][$currentSeat - 1]) && $sittingLayout['layout'][$currentSeat - 1]['status'] != 'available' ? 'disabled' : '' }}
                                        @if (isset($sittingLayout['layout'][$currentSeat - 1]) &&
                                                $sittingLayout['layout'][$currentSeat - 1]['status'] == 'available') wire:click="selectSeat('E{{ $currentSeat }}', '{{ $sittingLayout['layout'][$currentSeat - 1]['seat_no'] ?? '' }}')" @endif>
                                    <label for="E{{ $currentSeat }}"
                                        class="{{ isset($sittingLayout['layout'][$currentSeat - 1]) && $sittingLayout['layout'][$currentSeat - 1]['status'] != 'available' ? 'disabled' : (collect($selectedSeats)->contains(fn($seat) => $seat['seatno'] === 'E' . $currentSeat) ? 'selected' : 'unselect') }}">
                                        {{ $currentSeat }}
                                    </label>
                                </div>
                                <div class="seat green col-6 px-1">
                                    <input type="checkbox" id="E{{ $currentSeat + 1 }}" class="seat-checkbox"
                                        {{ isset($sittingLayout['layout'][$currentSeat]) && $sittingLayout['layout'][$currentSeat]['status'] != 'available' ? 'disabled' : '' }}
                                        @if (isset($sittingLayout['layout'][$currentSeat]) && $sittingLayout['layout'][$currentSeat]['status'] == 'available') wire:click="selectSeat('E{{ $currentSeat + 1 }}', '{{ $sittingLayout['layout'][$currentSeat]['seat_no'] ?? '' }}')" @endif>
                                    <label for="E{{ $currentSeat + 1 }}"
                                        class="{{ isset($sittingLayout['layout'][$currentSeat]) && $sittingLayout['layout'][$currentSeat]['status'] != 'available' ? 'disabled' : (collect($selectedSeats)->contains(fn($seat) => $seat['seatno'] === 'E' . ($currentSeat + 1)) ? 'selected' : 'unselect') }}">
                                        {{ $currentSeat + 1 }}
                                    </label>
                                </div>
                                <div class="seat green col-6 px-1">
                                    <input type="checkbox" id="E{{ $currentSeat + 2 }}" class="seat-checkbox"
                                        {{ isset($sittingLayout['layout'][$currentSeat + 1]) && $sittingLayout['layout'][$currentSeat + 1]['status'] != 'available' ? 'disabled' : '' }}
                                        @if (isset($sittingLayout['layout'][$currentSeat + 1]) &&
                                                $sittingLayout['layout'][$currentSeat + 1]['status'] == 'available') wire:click="selectSeat('E{{ $currentSeat + 2 }}', '{{ $sittingLayout['layout'][$currentSeat + 1]['seat_no'] ?? '' }}')" @endif>
                                    <label for="E{{ $currentSeat + 2 }}"
                                        class="{{ isset($sittingLayout['layout'][$currentSeat + 1]) && $sittingLayout['layout'][$currentSeat + 1]['status'] != 'available' ? 'disabled' : (collect($selectedSeats)->contains(fn($seat) => $seat['seatno'] === 'E' . ($currentSeat + 2)) ? 'selected' : 'unselect') }}">
                                        {{ $currentSeat + 2 }}
                                    </label>
                                </div>
                                <div class="seat green col-6 px-1">
                                    <input type="checkbox" id="E{{ $currentSeat + 3 }}" class="seat-checkbox"
                                        {{ isset($sittingLayout['layout'][$currentSeat + 2]) && $sittingLayout['layout'][$currentSeat + 2]['status'] != 'available' ? 'disabled' : '' }}
                                        @if (isset($sittingLayout['layout'][$currentSeat + 2]) &&
                                                $sittingLayout['layout'][$currentSeat + 2]['status'] == 'available') wire:click="selectSeat('E{{ $currentSeat + 3 }}', '{{ $sittingLayout['layout'][$currentSeat + 2]['seat_no'] ?? '' }}')" @endif>
                                    <label for="E{{ $currentSeat + 3 }}"
                                        class="{{ isset($sittingLayout['layout'][$currentSeat + 2]) && $sittingLayout['layout'][$currentSeat + 2]['status'] != 'available' ? 'disabled' : (collect($selectedSeats)->contains(fn($seat) => $seat['seatno'] === 'E' . ($currentSeat + 3)) ? 'selected' : 'unselect') }}">
                                        {{ $currentSeat + 3 }}
                                    </label>
                                </div>
                                <div class="seat green col-6 px-1">
                                    <input type="checkbox" id="E{{ $currentSeat + 4 }}" class="seat-checkbox"
                                        {{ isset($sittingLayout['layout'][$currentSeat + 3]) && $sittingLayout['layout'][$currentSeat + 3]['status'] != 'available' ? 'disabled' : '' }}
                                        @if (isset($sittingLayout['layout'][$currentSeat + 3]) &&
                                                $sittingLayout['layout'][$currentSeat + 3]['status'] == 'available') wire:click="selectSeat('E{{ $currentSeat + 4 }}', '{{ $sittingLayout['layout'][$currentSeat + 3]['seat_no'] ?? '' }}')" @endif>
                                    <label for="E{{ $currentSeat + 4 }}"
                                        class="{{ isset($sittingLayout['layout'][$currentSeat + 3]) && $sittingLayout['layout'][$currentSeat + 3]['status'] != 'available' ? 'disabled' : (collect($selectedSeats)->contains(fn($seat) => $seat['seatno'] === 'E' . ($currentSeat + 4)) ? 'selected' : 'unselect') }}">
                                        {{ $currentSeat + 4 }}
                                    </label>
                                </div>
                            </div>
                        @endfor
                    </div>

                </div>

                <div class="row justify-content-center">
                    <div class="col-4 px-1">
                        @for ($row = 1; $row <= 1; $row++)
                            @php $currentSeat = 21 + ($row - 1) * 2; @endphp
                            <div class="row flex-wrap">
                                @foreach (range(0, 3) as $offset)
                                    <div class="seat green col-6 px-1">
                                        <input type="checkbox" id="E{{ $currentSeat + $offset }}"
                                            class="seat-checkbox"
                                            {{ isset($sittingLayout['layout'][$currentSeat - 1 + $offset]) && $sittingLayout['layout'][$currentSeat - 1 + $offset]['status'] != 'available' ? 'disabled' : '' }}
                                            @if (isset($sittingLayout['layout'][$currentSeat - 1 + $offset]) &&
                                                    $sittingLayout['layout'][$currentSeat - 1 + $offset]['status'] == 'available') wire:click="selectSeat('E{{ $currentSeat + $offset }}', '{{ $sittingLayout['layout'][$currentSeat - 1 + $offset]['seat_no'] ?? '' }}')" @endif>
                                        <label for="E{{ $currentSeat + $offset }}"
                                            class="{{ isset($sittingLayout['layout'][$currentSeat - 1 + $offset]) && $sittingLayout['layout'][$currentSeat - 1 + $offset]['status'] != 'available' ? 'disabled' : (collect($selectedSeats)->contains(fn($seat) => $seat['seatno'] === 'E' . ($currentSeat + $offset)) ? 'selected' : 'unselect') }}">
                                            {{ $currentSeat + $offset }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        @endfor
                    </div>

                    <div class="col-2 px-1">
                        @for ($row = 1; $row <= 1; $row++)
                            @php $currentSeat = 25 + ($row - 1) * 2; @endphp
                            <div class="row flex-wrap">
                                @foreach (range(0, 1) as $offset)
                                    <div class="seat green col-6 px-1">
                                        <input type="checkbox" id="E{{ $currentSeat + $offset }}"
                                            class="seat-checkbox"
                                            {{ isset($sittingLayout['layout'][$currentSeat - 1 + $offset]) && $sittingLayout['layout'][$currentSeat - 1 + $offset]['status'] != 'available' ? 'disabled' : '' }}
                                            @if (isset($sittingLayout['layout'][$currentSeat - 1 + $offset]) &&
                                                    $sittingLayout['layout'][$currentSeat - 1 + $offset]['status'] == 'available') wire:click="selectSeat('E{{ $currentSeat + $offset }}', '{{ $sittingLayout['layout'][$currentSeat - 1 + $offset]['seat_no'] ?? '' }}')" @endif>
                                        <label for="E{{ $currentSeat + $offset }}"
                                            class="{{ isset($sittingLayout['layout'][$currentSeat - 1 + $offset]) && $sittingLayout['layout'][$currentSeat - 1 + $offset]['status'] != 'available' ? 'disabled' : (collect($selectedSeats)->contains(fn($seat) => $seat['seatno'] === 'E' . ($currentSeat + $offset)) ? 'selected' : 'unselect') }}">
                                            {{ $currentSeat + $offset }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        @endfor
                    </div>



                    <div class="col-6 px-1">
                        @for ($row = 1; $row <= 1; $row++)
                            @php $currentSeat = 73 + ($row - 1) * 2; @endphp
                            <div class="row flex-wrap justify-content-end">
                                @foreach (range(0, 4) as $offset)
                                    <div class="seat green col-6 px-1">
                                        <input type="checkbox" id="E{{ $currentSeat + $offset }}"
                                            class="seat-checkbox"
                                            {{ isset($sittingLayout['layout'][$currentSeat - 1 + $offset]) && $sittingLayout['layout'][$currentSeat - 1 + $offset]['status'] != 'available' ? 'disabled' : '' }}
                                            @if (isset($sittingLayout['layout'][$currentSeat - 1 + $offset]) &&
                                                    $sittingLayout['layout'][$currentSeat - 1 + $offset]['status'] == 'available') wire:click="selectSeat('E{{ $currentSeat + $offset }}', '{{ $sittingLayout['layout'][$currentSeat - 1 + $offset]['seat_no'] ?? '' }}')" @endif>
                                        <label for="E{{ $currentSeat + $offset }}"
                                            class="{{ isset($sittingLayout['layout'][$currentSeat - 1 + $offset]) && $sittingLayout['layout'][$currentSeat - 1 + $offset]['status'] != 'available' ? 'disabled' : (collect($selectedSeats)->contains(fn($seat) => $seat['seatno'] === 'E' . ($currentSeat + $offset)) ? 'selected' : 'unselect') }}">
                                            {{ $currentSeat + $offset }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        @endfor
                    </div>

                </div>


                <hr class="my-2">

                {{-- mid-section --}}
                <div class="row justify-content-center">
                    {{-- Left col-4 (Seats 78-101) --}}
                    <div class="col-4 px-1">
                        @for ($row = 0; $row < 9; $row++) {{-- Adjusted to 9 rows to cover 78-113 --}}
                            @php $currentStart = 78 + ($row * 4); @endphp
                            <div class="row flex-wrap">
                                @for ($i = 0; $i < 4; $i++)
                                    @php $seatNumber = $currentStart + $i; @endphp
                                    @if ($seatNumber <= 113)
                                        {{-- Ensure seats do not exceed 113 --}}
                                        <div class="seat green col-3 px-1">
                                            <input type="checkbox" id="E{{ $seatNumber }}" class="seat-checkbox"
                                                {{ isset($sittingLayout['layout'][$seatNumber - 1]) && $sittingLayout['layout'][$seatNumber - 1]['status'] != 'available' ? 'disabled' : '' }}
                                                @if (isset($sittingLayout['layout'][$seatNumber - 1]) &&
                                                        $sittingLayout['layout'][$seatNumber - 1]['status'] == 'available') wire:click="selectSeat('E{{ $seatNumber }}', '{{ $sittingLayout['layout'][$seatNumber - 1]['seat_no'] ?? '' }}')" @endif>
                                            <label for="E{{ $seatNumber }}"
                                                class="{{ isset($sittingLayout['layout'][$seatNumber - 1]) && $sittingLayout['layout'][$seatNumber - 1]['status'] != 'available' ? 'disabled' : (collect($selectedSeats)->contains(fn($seat) => $seat['seatno'] === 'E' . $seatNumber) ? 'selected' : 'unselect') }}">
                                                {{ $seatNumber }}
                                            </label>
                                        </div>
                                    @endif
                                @endfor
                            </div>
                        @endfor
                    </div>

                    {{-- Middle col-4 (Seats 116-123) --}}
                    <div class="col-4 px-1">
                        @for ($row = 0; $row < 2; $row++)
                            @php $currentStart = 116 + ($row * 4); @endphp
                            <div class="row flex-wrap">
                                @for ($i = 0; $i < 4; $i++)
                                    @php $seatNumber = $currentStart + $i; @endphp
                                    <div class="seat green col-3 px-1">
                                        <input type="checkbox" id="E{{ $seatNumber }}" class="seat-checkbox"
                                            {{ isset($sittingLayout['layout'][$seatNumber - 1]) && $sittingLayout['layout'][$seatNumber - 1]['status'] != 'available' ? 'disabled' : '' }}
                                            @if (isset($sittingLayout['layout'][$seatNumber - 1]) &&
                                                    $sittingLayout['layout'][$seatNumber - 1]['status'] == 'available') wire:click="selectSeat('E{{ $seatNumber }}', '{{ $seatNumber ?? '' }}')" @endif>
                                        <label for="E{{ $seatNumber }}"
                                            class="{{ isset($sittingLayout['layout'][$seatNumber - 1]) && $sittingLayout['layout'][$seatNumber - 1]['status'] != 'available' ? 'disabled' : (collect($selectedSeats)->contains(fn($seat) => $seat['seatno'] === 'E' . $seatNumber) ? 'selected' : 'unselect') }}">
                                            {{ $seatNumber }}
                                        </label>
                                    </div>
                                @endfor
                            </div>
                        @endfor
                    </div>


                    {{-- Right col-4 (Seats 124-147) --}}
                    <div class="col-4 px-1">
                        @for ($row = 0; $row < 10; $row++)
                            @php $currentStart = 124 + ($row * 4); @endphp
                            <div class="row flex-wrap">
                                @for ($i = 0; $i < 4; $i++)
                                    @php $seatNumber = $currentStart + $i; @endphp
                                    @if ($seatNumber <= 160)
                                        <div class="seat green col-3 px-1">
                                            <input type="checkbox" id="E{{ $seatNumber }}" class="seat-checkbox"
                                                {{ isset($sittingLayout['layout'][$seatNumber - 124]) && $sittingLayout['layout'][$seatNumber - 124]['status'] != 'available' ? 'disabled' : '' }}
                                                @if (isset($sittingLayout['layout'][$seatNumber - 124]) &&
                                                        $sittingLayout['layout'][$seatNumber - 124]['status'] == 'available') wire:click="selectSeat('E{{ $seatNumber }}', '{{ $seatNumber ?? '' }}')" @endif>
                                            <label for="E{{ $seatNumber }}"
                                                class="{{ isset($sittingLayout['layout'][$seatNumber - 124]) && $sittingLayout['layout'][$seatNumber - 124]['status'] != 'available' ? 'disabled' : (collect($selectedSeats)->contains(fn($seat) => $seat['seatno'] === 'E' . $seatNumber) ? 'selected' : 'unselect') }}">
                                                {{ $seatNumber }}
                                            </label>
                                        </div>
                                    @endif
                                @endfor
                            </div>
                        @endfor





                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
