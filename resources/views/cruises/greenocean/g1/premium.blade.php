<div class="conatiner">
    <div class="theatre">
        <div class="container p-0 m-0">
            <div class="row border-start border-end border-bottom justify-content-center">
                {{-- top-section --}}
                <div class="row justify-content-center">
                    {{-- Left col-3 (Seats 1-8) --}}
                    <div class="col-3 px-1">
                        <div class="row flex-wrap mb-4">
                        </div>
                        @for ($row = 1; $row <= 8; $row++)
                            @php $currentSeat=($row - 1) * 2 + 1; @endphp
                            <div class="row flex-wrap mt-1">
                            @foreach (array_slice($sittingLayout['layout'], $currentSeat - 1, 2) as $seat)
                            <div class="seat green col-6 px-1">
                                <input type="checkbox" id="{{ $seat['seat_numbering'] }}" class="seat-checkbox"
                                    {{ $seat['status'] != 'available' ? 'disabled' : '' }}>
                                <label for="{{ $seat['seat_numbering'] }}"
                                    class="{{ $seat['status'] != 'available' ? 'disabled' : (collect($selectedSeats)->contains(fn($s) => $s['seatno'] === $seat['seat_numbering']) ? 'selected' : 'unselect') }}"
                                    @if ($seat['status']=='available' ) wire:click="selectSeat('{{  $seat['seat_numbering']  }}', '{{ $seat['seat_no'] ?? '' }}')" @endif>
                                    {{ $seat['seat_numbering'] }}
                                </label>
                            </div>
                            @endforeach
                    </div>
                    @endfor

                </div>

                <div class="col-6 px-1">
                    @php
                    $startMiddle = 17;
                    $totalSeats = 44;
                    $rowsMiddle = [4, 4, 4, 4, 4, 4, 4];
                    @endphp

                    @foreach ($rowsMiddle as $key => $count)
                    <div class="row flex-wrap justify-content-center mt-1">
                        @php $currentStart = $startMiddle + ($key * 4); @endphp
                        @for ($i = 0; $i < $count; $i++)
                            @php
                            $seatIndex=$currentStart + $i - 1;
                            $seat=$sittingLayout['layout'][$seatIndex] ?? null;
                            @endphp
                            @if ($seat)
                            <div class="seat green col-3 px-1">
                            <input type="checkbox" id="{{ $seat['seat_numbering'] }}" class="seat-checkbox"
                                {{ $seat['status'] != 'available' ? 'disabled' : '' }}>
                            <label for="{{ $seat['seat_numbering'] }}"
                                class="{{ $seat['status'] != 'available' ? 'disabled' : (collect($selectedSeats)->contains(fn($s) => $s['seatno'] === $seat['seat_numbering']) ? 'selected' : 'unselect') }}"
                                @if ($seat['status']=='available' ) wire:click="selectSeat('{{ $seat['seat_numbering'] }}', '{{ $seat['seat_no'] ?? '' }}')" @endif>
                                {{ $seat['seat_numbering'] }}
                            </label>
                    </div>
                    @endif
                    @endfor
                </div>
                @endforeach


                <div class="row flex-wrap justify-content-around mt-4">
                    <div class="col-6">
                        @php
                        $seats = ['P45', 'P46'];
                        @endphp
                        @foreach ($seats as $seatNumber)
                        @php
                        $seat = collect($sittingLayout['layout'])->firstWhere('seat_numbering', $seatNumber);
                        @endphp
                        @if ($seat)
                        <div class="seat green col-3 px-1">
                            <input type="checkbox" id="{{ $seat['seat_numbering'] }}" class="seat-checkbox"
                                {{ $seat['status'] != 'available' ? 'disabled' : '' }}>
                            <label for="{{ $seat['seat_numbering'] }}"
                                class="{{ $seat['status'] != 'available' ? 'disabled' : (collect($selectedSeats)->contains(fn($s) => $s['seatno'] === $seat['seat_numbering']) ? 'selected' : 'unselect') }}"
                                @if ($seat['status']=='available' )
                                wire:click="selectSeat('{{ $seat['seat_numbering'] }}', '{{ $seat['seat_no'] ?? '' }}')"
                                @endif>
                                {{ $seat['seat_numbering'] }}
                            </label>
                        </div>
                        @endif
                        @endforeach
                        <div class="seat green col-3 px-1">
                            <input type="checkbox" id="P82" class="seat-checkbox"
                                {{ collect($selectedSeats)->contains(fn($s) => $s['seatno'] === 'P82') ? 'checked' : '' }}
                                wire:click="selectSeat('P82', '243')">
                            <label for="P82"
                                class="{{ collect($selectedSeats)->contains(fn($s) => $s['seatno'] === 'P82') ? 'selected' : 'unselect' }}">
                                P82
                            </label>
                        </div>
                    </div>

                    <div class="col-6">
                        @php
                        $seats = ['P47', 'P48', ];
                        @endphp
                        @foreach ($seats as $seatNumber)
                        @php
                        $seat = collect($sittingLayout['layout'])->firstWhere('seat_numbering', $seatNumber);
                        @endphp
                        @if ($seat)
                        <div class="seat green col-3 px-1">
                            <input type="checkbox" id="{{ $seat['seat_numbering'] }}" class="seat-checkbox"
                                {{ $seat['status'] != 'available' ? 'disabled' : '' }}>
                            <label for="{{ $seat['seat_numbering'] }}"
                                class="{{ $seat['status'] != 'available' ? 'disabled' : (collect($selectedSeats)->contains(fn($s) => $s['seatno'] === $seat['seat_numbering']) ? 'selected' : 'unselect') }}"
                                @if ($seat['status']=='available' )
                                wire:click="selectSeat('{{ $seat['seat_numbering'] }}', '{{ $seat['seat_no'] ?? '' }}')"
                                @endif>
                                {{ $seat['seat_numbering'] }}
                            </label>
                        </div>
                        @endif
                        @endforeach
                        <div class="seat green col-3 px-1">
                            <input type="checkbox" id="P85" class="seat-checkbox"
                                {{ collect($selectedSeats)->contains(fn($s) => $s['seatno'] === 'P85') ? 'checked' : '' }}
                                wire:click="selectSeat('P85', '246')">
                            <label for="P85"
                                class="{{ collect($selectedSeats)->contains(fn($s) => $s['seatno'] === 'P85') ? 'selected' : 'unselect' }}">
                                P85
                            </label>
                        </div>
                    </div>

                    <div class="col-12 d-flex flex-wrap justify-content-center">
                        @for ($row = 20; $row < 21; $row++) {{-- Only row 20 to cover P87 to P90 --}}
                            @php $currentStart=87 + ($row * 0); @endphp
                            <div class="row flex-wrap">
                            @for ($i = 0; $i < 4; $i++) {{-- 4 seats for P87 to P90 --}}
                                @php
                                $seatNumber='P' . ($currentStart + $i);
                                $seat=collect($sittingLayout['layout'])->firstWhere('seat_numbering', $seatNumber);
                                @endphp
                                @if ($seat)
                                <div class="seat green col-3 px-1">
                                    <input type="checkbox" id="{{ $seat['seat_numbering'] }}" class="seat-checkbox"
                                        {{ $seat['status'] != 'available' ? 'disabled' : '' }}>
                                    <label for="{{ $seat['seat_numbering'] }}"
                                        class="{{ $seat['status'] != 'available' ? 'disabled' : (collect($selectedSeats)->contains(fn($s) => $s['seatno'] === $seat['seat_numbering']) ? 'selected' : 'unselect') }}"
                                        @if ($seat['status']=='available' )
                                        wire:click="selectSeat('{{ $seat['seat_numbering'] }}', '{{ $seat['seat_no'] ?? '' }}')"
                                        @endif>
                                        {{ $seat['seat_numbering'] }}
                                    </label>
                                </div>
                                @endif
                                @endfor
                    </div>
                    @endfor


                </div>
                <div class="col-6">
                    @php
                    $seatNumber = 'P91';
                    $seat = collect($sittingLayout['layout'])->firstWhere('seat_numbering', $seatNumber);
                    @endphp
                    @if ($seat)
                    <div class="seat green col-3 px-1">
                        <input type="checkbox" id="{{ $seat['seat_numbering'] }}" class="seat-checkbox"
                            {{ $seat['status'] != 'available' ? 'disabled' : '' }}>
                        <label for="{{ $seat['seat_numbering'] }}"
                            class="{{ $seat['status'] != 'available' ? 'disabled' : (collect($selectedSeats)->contains(fn($s) => $s['seatno'] === $seat['seat_numbering']) ? 'selected' : 'unselect') }}"
                            @if ($seat['status']=='available' )
                            wire:click="selectSeat('{{ $seat['seat_numbering'] }}', '{{ $seat['seat_no'] ?? '' }}')"
                            @endif>
                            {{ $seat['seat_numbering'] }}
                        </label>
                    </div>
                    @endif
                </div>


                <div class="col-6">

                </div>
            </div>

        </div>

        {{-- Right col-3 (Seats 49-60) --}}
        <div class="col-3 px-1">
            @for ($row = 1; $row <= 10; $row++)
                @php $currentSeat=49 + ($row - 1) * 2; @endphp
                <div class="row flex-wrap justify-content-end mt-1">
                @for ($i = 0; $i < 2; $i++)
                    @php
                    $seat=$sittingLayout['layout'][$currentSeat + $i - 1] ?? null;
                    @endphp
                    @if ($seat)
                    <div class="seat green col-6 px-1">
                    <input type="checkbox" id="{{ $seat['seat_numbering'] }}" class="seat-checkbox"
                        {{ $seat['status'] != 'available' ? 'disabled' : '' }}>
                    <label for="{{ $seat['seat_numbering'] }}"
                        class="{{ $seat['status'] != 'available' ? 'disabled' : (collect($selectedSeats)->contains(fn($s) => $s['seatno'] === $seat['seat_numbering']) ? 'selected' : 'unselect') }}"
                        @if ($seat['status']=='available' ) wire:click="selectSeat('{{ $seat['seat_numbering'] }}', '{{ $seat['seat_no'] ?? '' }}')" @endif>
                        {{ $seat['seat_numbering'] }}
                    </label>
        </div>
        @endif
        @endfor
    </div>
    @endfor

</div>
</div>
{{-- center-section --}}


<div class="row justify-content-center">
    {{-- Left col-4 (Seats 78-101) --}}
    <div class="col-4 px-1">
        @for ($row = 0; $row < 2; $row++) {{-- Adjusted to 9 rows to cover 69-74 --}}
            @php $currentStart=69 + ($row * 3); @endphp
            <div class="row flex-wrap mt-1">
            @for ($i = 0; $i < 3; $i++)
                @php
                $seatNumber=$currentStart + $i;
                $seat=$sittingLayout['layout'][$seatNumber - 1] ?? null;
                @endphp
                @if ($seatNumber <=74 && $seat) {{-- Ensure seats do not exceed 74 --}}
                <div class="seat green col-3 px-1">
                <input type="checkbox" id="{{ $seat['seat_numbering'] }}" class="seat-checkbox"
                    {{ $seat['status'] != 'available' ? 'disabled' : '' }}>
                <label for="{{ $seat['seat_numbering'] }}"
                    class="{{ $seat['status'] != 'available' ? 'disabled' : (collect($selectedSeats)->contains(fn($s) => $s['seatno'] ===  $seat['seat_numbering']) ? 'selected' : 'unselect') }}"
                    @if ($seat['status']=='available' ) wire:click="selectSeat('{{ $seat['seat_numbering'] }}', '{{ $seat['seat_no'] ?? '' }}')" @endif>
                    {{ $seat['seat_numbering'] }}
                </label>
    </div>
    @endif
    @endfor
</div>
@endfor

@for ($row = 0; $row < 2; $row++)
    @php $currentStart=75 + ($row * 2); @endphp
    <div class="row mt-1">
    @for ($i = 0; $i < 2; $i++)
        @php
        $seatNumber=$currentStart + $i;
        $seat=$sittingLayout['layout'][$seatNumber - 1] ?? null;
        @endphp
        @if ($seatNumber <=79 && $seat)
        <div class="seat green col-3 px-1">
        <input type="checkbox" id="{{ $seat['seat_numbering'] }}" class="seat-checkbox"
            {{ $seat['status'] != 'available' ? 'disabled' : '' }}>
        <label for="{{ $seat['seat_numbering'] }}"
            class="{{ $seat['status'] != 'available' ? 'disabled' : (collect($selectedSeats)->contains(fn($s) => $s['seatno'] ===  $seat['seat_numbering']) ? 'selected' : 'unselect') }}"
            @if ($seat['status']=='available' ) wire:click="selectSeat('{{ $seat['seat_numbering'] }}', '{{ $seat['seat_no'] ?? '' }}')" @endif>
            {{ $seat['seat_numbering'] }}
        </label>
        </div>
        @endif
        @endfor
        </div>
        @endfor

        </div>



        {{-- Middle col-4 (Seats 116-123) --}}
        <div class="col-4 px-1">
            @php $currentStart = 92; @endphp
            <div class="row flex-wrap justify-content-center mt-1">
                @for ($i = 0; $i < 4; $i++)
                    @php
                    $seatNumber='P' . ($currentStart + $i); // Use 'P' prefix for seat numbering
                    $seat=collect($sittingLayout['layout'])->firstWhere('seat_numbering', $seatNumber); // Find seat with 'P92', 'P93', etc.
                    @endphp
                    @if ($seat)
                    <div class="seat green col-3 px-1">
                        <input type="checkbox" id="{{ $seat['seat_numbering'] }}" class="seat-checkbox"
                            {{ $seat['status'] != 'available' ? 'disabled' : '' }}>
                        <label for="{{ $seat['seat_numbering'] }}"
                            class="{{ $seat['status'] != 'available' ? 'disabled' : (collect($selectedSeats)->contains(fn($s) => $s['seatno'] === $seat['seat_numbering']) ? 'selected' : 'unselect') }}"
                            @if ($seat['status']=='available' )
                            wire:click="selectSeat('{{ $seat['seat_numbering'] }}', '{{ $seat['seat_no'] ?? '' }}')"
                            @endif>
                            {{ $seat['seat_numbering'] }}
                        </label>
                    </div>
                    @endif
                    @endfor
            </div>



        </div>

        {{-- Right col-4 (Seats 124-147) --}}
        <div class="col-4 px-1">
            @for ($row = 0; $row < 3; $row++) {{-- 3 rows to cover seats from P96 to P104 --}}
                @php $currentStart=96 + ($row * 3); @endphp
                <div class="row flex-wrap justify-content-end">
                @for ($i = 0; $i < 3; $i++)
                    @php
                    $seatNumber='P' . ($currentStart + $i);
                    $seat=collect($sittingLayout['layout'])->firstWhere('seat_numbering', $seatNumber);
                    @endphp
                    @if ($seat)
                    <div class="seat green col-3 px-1">
                        <input type="checkbox" id="{{ $seat['seat_numbering'] }}" class="seat-checkbox"
                            {{ $seat['status'] != 'available' ? 'disabled' : '' }}>
                        <label for="{{ $seat['seat_numbering'] }}"
                            class="{{ $seat['status'] != 'available' ? 'disabled' : (collect($selectedSeats)->contains(fn($s) => $s['seatno'] === $seat['seat_numbering']) ? 'selected' : 'unselect') }}"
                            @if ($seat['status']=='available' )
                            wire:click="selectSeat('{{ $seat['seat_numbering'] }}', '{{ $seat['seat_no'] ?? '' }}')"
                            @endif>
                            {{ $seat['seat_numbering'] }}
                        </label>
                    </div>
                    @endif
                    @endfor
        </div>
        @endfor










        @for ($row = 0; $row < 1; $row++)
            @php $currentStart=105 + ($row * 2); @endphp
            <div class="row flex-wrap justify-content-end">
            @for ($i = 0; $i < 2; $i++)
                @php
                $seatNumber=$currentStart + $i;
                $seat=collect($sittingLayout['layout'])->firstWhere('seat_numbering', 'P' . $seatNumber);
                @endphp
                @if ($seat)
                <div class="seat green col-3 px-1">
                    <input type="checkbox" id="{{ $seat['seat_numbering'] }}" class="seat-checkbox"
                        {{ $seat['status'] != 'available' ? 'disabled' : '' }}>
                    <label for="{{ $seat['seat_numbering'] }}"
                        class="{{ $seat['status'] != 'available' ? 'disabled' : (collect($selectedSeats)->contains(fn($s) => $s['seatno'] === $seat['seat_numbering']) ? 'selected' : 'unselect') }}"
                        @if ($seat['status']=='available' )
                        wire:click="selectSeat('{{ $seat['seat_numbering'] }}', '{{ $seat['seat_no'] ?? '' }}')"
                        @endif>
                        {{ $seat['seat_numbering'] }}
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