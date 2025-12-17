<div class="container">
    <div class="theatre">
        <div class="container p-0 m-0">
            <div class="row col-12 border-start border-end border-bottom justify-content-center">
                {{-- top-section --}}
                <div class="row justify-content-center">
                    <div class="col-6 px-1">
                        @php
                            $group = 'A';
                            $groupedSeats = array_filter(
                                $sittingLayout['layout'],
                                fn($seat) => str_starts_with($seat['seat_numbering'], $group) &&
                                    (int) filter_var($seat['seat_numbering'], FILTER_SANITIZE_NUMBER_INT) <= 2,
                            );
                        @endphp
                        <div class="row flex-wrap  ">

                            @foreach ($groupedSeats as $seat)
                                <div class="seat green col-1 px-1">

                                    <input type="checkbox" id="{{ $seat['seat_numbering'] }}" class="seat-checkbox"
                                        {{ $seat['status'] !== 'available' ? 'disabled' : '' }}>
                                    <label for="{{ $seat['seat_numbering'] }}"
                                        class="{{ $seat['status'] !== 'available' ? 'disabled' : (collect($selectedSeats)->contains(fn($s) => $s['seatno'] === $seat['seat_numbering']) ? 'selected' : 'unselect') }}"
                                        @if ($seat['status'] === 'available') wire:click="selectSeat('{{ $seat['seat_numbering'] }}', '{{ $seat['seat_no'] ?? '' }}')" @endif>
                                        {{ $seat['seat_numbering'] }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-6 px-1">
                        @php
                            $group = 'A';
                            $groupedSeats = array_filter(
                                $sittingLayout['layout'],
                                fn($seat) => str_starts_with($seat['seat_numbering'], $group) &&
                                    (int) filter_var($seat['seat_numbering'], FILTER_SANITIZE_NUMBER_INT) >= 3 &&
                                    (int) filter_var($seat['seat_numbering'], FILTER_SANITIZE_NUMBER_INT) <= 5,
                            );
                        @endphp
                        <div class="row flex-wrap  justify-content-end">

                            @foreach ($groupedSeats as $seat)
                                <div class="seat green col-1 px-1">

                                    <input type="checkbox" id="{{ $seat['seat_numbering'] }}" class="seat-checkbox"
                                        {{ $seat['status'] !== 'available' ? 'disabled' : '' }}>
                                    <label for="{{ $seat['seat_numbering'] }}"
                                        class="{{ $seat['status'] !== 'available' ? 'disabled' : (collect($selectedSeats)->contains(fn($s) => $s['seatno'] === $seat['seat_numbering']) ? 'selected' : 'unselect') }}"
                                        @if ($seat['status'] === 'available') wire:click="selectSeat('{{ $seat['seat_numbering'] }}', '{{ $seat['seat_no'] ?? '' }}')" @endif>
                                        {{ $seat['seat_numbering'] }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-6 px-1">
                        @php
                            $group = 'B';
                            $groupedSeats = array_filter(
                                $sittingLayout['layout'],
                                fn($seat) => str_starts_with($seat['seat_numbering'], $group) &&
                                    (int) filter_var($seat['seat_numbering'], FILTER_SANITIZE_NUMBER_INT) <= 3,
                            );
                        @endphp
                        <div class="row flex-wrap  ">

                            @foreach ($groupedSeats as $seat)
                                <div class="seat green col-1 px-1">

                                    <input type="checkbox" id="{{ $seat['seat_numbering'] }}" class="seat-checkbox"
                                        {{ $seat['status'] !== 'available' ? 'disabled' : '' }}>
                                    <label for="{{ $seat['seat_numbering'] }}"
                                        class="{{ $seat['status'] !== 'available' ? 'disabled' : (collect($selectedSeats)->contains(fn($s) => $s['seatno'] === $seat['seat_numbering']) ? 'selected' : 'unselect') }}"
                                        @if ($seat['status'] === 'available') wire:click="selectSeat('{{ $seat['seat_numbering'] }}', '{{ $seat['seat_no'] ?? '' }}')" @endif>
                                        {{ $seat['seat_numbering'] }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-6 px-1">
                        @php
                            $group = 'B';
                            $groupedSeats = array_filter(
                                $sittingLayout['layout'],
                                fn($seat) => str_starts_with($seat['seat_numbering'], $group) &&
                                    (int) filter_var($seat['seat_numbering'], FILTER_SANITIZE_NUMBER_INT) >= 4 &&
                                    (int) filter_var($seat['seat_numbering'], FILTER_SANITIZE_NUMBER_INT) <= 6,
                            );
                        @endphp
                        <div class="row flex-wrap  justify-content-end">

                            @foreach ($groupedSeats as $seat)
                                <div class="seat green col-1 px-1">

                                    <input type="checkbox" id="{{ $seat['seat_numbering'] }}" class="seat-checkbox"
                                        {{ $seat['status'] !== 'available' ? 'disabled' : '' }}>
                                    <label for="{{ $seat['seat_numbering'] }}"
                                        class="{{ $seat['status'] !== 'available' ? 'disabled' : (collect($selectedSeats)->contains(fn($s) => $s['seatno'] === $seat['seat_numbering']) ? 'selected' : 'unselect') }}"
                                        @if ($seat['status'] === 'available') wire:click="selectSeat('{{ $seat['seat_numbering'] }}', '{{ $seat['seat_no'] ?? '' }}')" @endif>
                                        {{ $seat['seat_numbering'] }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-6 px-1">
                        @php
                            $group = 'C';
                            $groupedSeats = array_filter(
                                $sittingLayout['layout'],
                                fn($seat) => str_starts_with($seat['seat_numbering'], $group) &&
                                    (int) filter_var($seat['seat_numbering'], FILTER_SANITIZE_NUMBER_INT) <= 3,
                            );
                        @endphp
                        <div class="row flex-wrap  ">

                            @foreach ($groupedSeats as $seat)
                                <div class="seat green col-1 px-1">

                                    <input type="checkbox" id="{{ $seat['seat_numbering'] }}" class="seat-checkbox"
                                        {{ $seat['status'] !== 'available' ? 'disabled' : '' }}>
                                    <label for="{{ $seat['seat_numbering'] }}"
                                        class="{{ $seat['status'] !== 'available' ? 'disabled' : (collect($selectedSeats)->contains(fn($s) => $s['seatno'] === $seat['seat_numbering']) ? 'selected' : 'unselect') }}"
                                        @if ($seat['status'] === 'available') wire:click="selectSeat('{{ $seat['seat_numbering'] }}', '{{ $seat['seat_no'] ?? '' }}')" @endif>
                                        {{ $seat['seat_numbering'] }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-6 px-1">
                        @php
                            $group = 'C';
                            $groupedSeats = array_filter(
                                $sittingLayout['layout'],
                                fn($seat) => str_starts_with($seat['seat_numbering'], $group) &&
                                    (int) filter_var($seat['seat_numbering'], FILTER_SANITIZE_NUMBER_INT) >= 4 &&
                                    (int) filter_var($seat['seat_numbering'], FILTER_SANITIZE_NUMBER_INT) <= 6,
                            );
                        @endphp
                        <div class="row flex-wrap  justify-content-end">

                            @foreach ($groupedSeats as $seat)
                                <div class="seat green col-1 px-1">

                                    <input type="checkbox" id="{{ $seat['seat_numbering'] }}" class="seat-checkbox"
                                        {{ $seat['status'] !== 'available' ? 'disabled' : '' }}>
                                    <label for="{{ $seat['seat_numbering'] }}"
                                        class="{{ $seat['status'] !== 'available' ? 'disabled' : (collect($selectedSeats)->contains(fn($s) => $s['seatno'] === $seat['seat_numbering']) ? 'selected' : 'unselect') }}"
                                        @if ($seat['status'] === 'available') wire:click="selectSeat('{{ $seat['seat_numbering'] }}', '{{ $seat['seat_no'] ?? '' }}')" @endif>
                                        {{ $seat['seat_numbering'] }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-6 px-1">
                        @php
                            $group = 'D';
                            $groupedSeats = array_filter(
                                $sittingLayout['layout'],
                                fn($seat) => str_starts_with($seat['seat_numbering'], $group) &&
                                    (int) filter_var($seat['seat_numbering'], FILTER_SANITIZE_NUMBER_INT) <= 3,
                            );
                        @endphp
                        <div class="row flex-wrap  ">

                            @foreach ($groupedSeats as $seat)
                                <div class="seat green col-1 px-1">

                                    <input type="checkbox" id="{{ $seat['seat_numbering'] }}" class="seat-checkbox"
                                        {{ $seat['status'] !== 'available' ? 'disabled' : '' }}>
                                    <label for="{{ $seat['seat_numbering'] }}"
                                        class="{{ $seat['status'] !== 'available' ? 'disabled' : (collect($selectedSeats)->contains(fn($s) => $s['seatno'] === $seat['seat_numbering']) ? 'selected' : 'unselect') }}"
                                        @if ($seat['status'] === 'available') wire:click="selectSeat('{{ $seat['seat_numbering'] }}', '{{ $seat['seat_no'] ?? '' }}')" @endif>
                                        {{ $seat['seat_numbering'] }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-6 px-1">
                        @php
                            $group = 'D';
                            $groupedSeats = array_filter(
                                $sittingLayout['layout'],
                                fn($seat) => str_starts_with($seat['seat_numbering'], $group) &&
                                    (int) filter_var($seat['seat_numbering'], FILTER_SANITIZE_NUMBER_INT) >= 4 &&
                                    (int) filter_var($seat['seat_numbering'], FILTER_SANITIZE_NUMBER_INT) <= 6,
                            );
                        @endphp
                        <div class="row flex-wrap justify-content-end ">

                            @foreach ($groupedSeats as $seat)
                                <div class="seat green col-1 px-1">

                                    <input type="checkbox" id="{{ $seat['seat_numbering'] }}" class="seat-checkbox"
                                        {{ $seat['status'] !== 'available' ? 'disabled' : '' }}>
                                    <label for="{{ $seat['seat_numbering'] }}"
                                        class="{{ $seat['status'] !== 'available' ? 'disabled' : (collect($selectedSeats)->contains(fn($s) => $s['seatno'] === $seat['seat_numbering']) ? 'selected' : 'unselect') }}"
                                        @if ($seat['status'] === 'available') wire:click="selectSeat('{{ $seat['seat_numbering'] }}', '{{ $seat['seat_no'] ?? '' }}')" @endif>
                                        {{ $seat['seat_numbering'] }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-6 px-1">
                        @php
                            $group = 'E';
                            $groupedSeats = array_filter(
                                $sittingLayout['layout'],
                                fn($seat) => str_starts_with($seat['seat_numbering'], $group) &&
                                    (int) filter_var($seat['seat_numbering'], FILTER_SANITIZE_NUMBER_INT) <= 3,
                            );
                        @endphp
                        <div class="row flex-wrap  ">

                            @foreach ($groupedSeats as $seat)
                                <div class="seat green col-1 px-1">

                                    <input type="checkbox" id="{{ $seat['seat_numbering'] }}" class="seat-checkbox"
                                        {{ $seat['status'] !== 'available' ? 'disabled' : '' }}>
                                    <label for="{{ $seat['seat_numbering'] }}"
                                        class="{{ $seat['status'] !== 'available' ? 'disabled' : (collect($selectedSeats)->contains(fn($s) => $s['seatno'] === $seat['seat_numbering']) ? 'selected' : 'unselect') }}"
                                        @if ($seat['status'] === 'available') wire:click="selectSeat('{{ $seat['seat_numbering'] }}', '{{ $seat['seat_no'] ?? '' }}')" @endif>
                                        {{ $seat['seat_numbering'] }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-6 px-1">
                        @php
                            $group = 'E';
                            $groupedSeats = array_filter(
                                $sittingLayout['layout'],
                                fn($seat) => str_starts_with($seat['seat_numbering'], $group) &&
                                    (int) filter_var($seat['seat_numbering'], FILTER_SANITIZE_NUMBER_INT) >= 4 &&
                                    (int) filter_var($seat['seat_numbering'], FILTER_SANITIZE_NUMBER_INT) <= 5,
                            );
                        @endphp
                        <div class="row flex-wrap justify-content-end ">

                            @foreach ($groupedSeats as $seat)
                                <div class="seat green col-1 px-1">

                                    <input type="checkbox" id="{{ $seat['seat_numbering'] }}" class="seat-checkbox"
                                        {{ $seat['status'] !== 'available' ? 'disabled' : '' }}>
                                    <label for="{{ $seat['seat_numbering'] }}"
                                        class="{{ $seat['status'] !== 'available' ? 'disabled' : (collect($selectedSeats)->contains(fn($s) => $s['seatno'] === $seat['seat_numbering']) ? 'selected' : 'unselect') }}"
                                        @if ($seat['status'] === 'available') wire:click="selectSeat('{{ $seat['seat_numbering'] }}', '{{ $seat['seat_no'] ?? '' }}')" @endif>
                                        {{ $seat['seat_numbering'] }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
