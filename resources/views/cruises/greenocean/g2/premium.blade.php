<div class="container">
    <div class="theatre">

        <div class="container p-0 m-0">
            <div class="row border-start border-end border-bottom justify-content-center">
                <div class="row justify-content-center ">
                    <div class=" col-6 px-1">
                        <div class="row ">
                            @php
                                $group = 'A';
                                $groupedSeats = array_filter(
                                    $sittingLayout['layout'],
                                    fn($seat) => str_starts_with($seat['seat_numbering'], $group) &&
                                        (int) filter_var($seat['seat_numbering'], FILTER_SANITIZE_NUMBER_INT) <= 4,
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
                    </div>

                    <div class=" col-6 px-1">
                        <div class="row">
                            @php
                                $group = 'A';
                                $groupedSeats = array_filter(
                                    $sittingLayout['layout'],
                                    fn($seat) => str_starts_with($seat['seat_numbering'], $group) &&
                                        (int) filter_var($seat['seat_numbering'], FILTER_SANITIZE_NUMBER_INT) >= 5,
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
                    </div>
                </div>
                <div class="row justify-content-center ">
                    <div class=" col-6 px-1">
                        <div class="row ">
                            @php
                                $group = 'B';
                                $groupedSeats = array_filter(
                                    $sittingLayout['layout'],
                                    fn($seat) => str_starts_with($seat['seat_numbering'], $group) &&
                                        (int) filter_var($seat['seat_numbering'], FILTER_SANITIZE_NUMBER_INT) <= 4,
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
                    </div>

                    <div class=" col-6 px-1">
                        <div class="row">
                            @php
                                $group = 'B';
                                $groupedSeats = array_filter(
                                    $sittingLayout['layout'],
                                    fn($seat) => str_starts_with($seat['seat_numbering'], $group) &&
                                        (int) filter_var($seat['seat_numbering'], FILTER_SANITIZE_NUMBER_INT) >= 5,
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
                    </div>
                </div>

                <div class="row justify-content-center ">
                    <div class=" col-6 px-1">
                        <div class="row ">
                            @php
                                $group = 'C';
                                $groupedSeats = array_filter(
                                    $sittingLayout['layout'],
                                    fn($seat) => str_starts_with($seat['seat_numbering'], $group) &&
                                        (int) filter_var($seat['seat_numbering'], FILTER_SANITIZE_NUMBER_INT) <= 4,
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
                    </div>

                    <div class=" col-6 px-1">
                        <div class="row">
                            @php
                                $group = 'C';
                                $groupedSeats = array_filter(
                                    $sittingLayout['layout'],
                                    fn($seat) => str_starts_with($seat['seat_numbering'], $group) &&
                                        (int) filter_var($seat['seat_numbering'], FILTER_SANITIZE_NUMBER_INT) >= 5,
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
                    </div>
                </div>


                <div class="row justify-content-center ">
                    <div class=" col-6 px-1">
                        <div class="row ">
                            @php
                                $group = 'D';
                                $groupedSeats = array_filter(
                                    $sittingLayout['layout'],
                                    fn($seat) => str_starts_with($seat['seat_numbering'], $group) &&
                                        (int) filter_var($seat['seat_numbering'], FILTER_SANITIZE_NUMBER_INT) <= 4,
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
                    </div>

                    <div class=" col-6 px-1">
                        <div class="row">
                            @php
                                $group = 'D';
                                $groupedSeats = array_filter(
                                    $sittingLayout['layout'],
                                    fn($seat) => str_starts_with($seat['seat_numbering'], $group) &&
                                        (int) filter_var($seat['seat_numbering'], FILTER_SANITIZE_NUMBER_INT) >= 5,
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
                    </div>
                </div>


                <div class="row justify-content-center ">
                    <div class=" col-6 px-1">
                        <div class="row ">
                            @php
                                $group = 'E';
                                $groupedSeats = array_filter(
                                    $sittingLayout['layout'],
                                    fn($seat) => str_starts_with($seat['seat_numbering'], $group) &&
                                        (int) filter_var($seat['seat_numbering'], FILTER_SANITIZE_NUMBER_INT) <= 4,
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
                    </div>

                    <div class=" col-6 px-1">
                        <div class="row">
                            @php
                                $group = 'E';
                                $groupedSeats = array_filter(
                                    $sittingLayout['layout'],
                                    fn($seat) => str_starts_with($seat['seat_numbering'], $group) &&
                                        (int) filter_var($seat['seat_numbering'], FILTER_SANITIZE_NUMBER_INT) >= 5,
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
                    </div>
                </div>



                <div class="row justify-content-center ">
                    <div class=" col-6 px-1">
                        <div class="row ">
                            @php
                                $group = 'F';
                                $groupedSeats = array_filter(
                                    $sittingLayout['layout'],
                                    fn($seat) => str_starts_with($seat['seat_numbering'], $group) &&
                                        (int) filter_var($seat['seat_numbering'], FILTER_SANITIZE_NUMBER_INT) <= 4,
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
                    </div>

                    <div class=" col-6 px-1">
                        <div class="row">
                            @php
                                $group = 'F';
                                $groupedSeats = array_filter(
                                    $sittingLayout['layout'],
                                    fn($seat) => str_starts_with($seat['seat_numbering'], $group) &&
                                        (int) filter_var($seat['seat_numbering'], FILTER_SANITIZE_NUMBER_INT) >= 5,
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
                    </div>
                </div>


                <div class="row justify-content-center ">
                    <div class=" col-6 px-1">
                        <div class="row ">
                            @php
                                $group = 'G';
                                $groupedSeats = array_filter(
                                    $sittingLayout['layout'],
                                    fn($seat) => str_starts_with($seat['seat_numbering'], $group) &&
                                        (int) filter_var($seat['seat_numbering'], FILTER_SANITIZE_NUMBER_INT) <= 4,
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
                    </div>

                    <div class=" col-6 px-1">
                        <div class="row">
                            @php
                                $group = 'G';
                                $groupedSeats = array_filter(
                                    $sittingLayout['layout'],
                                    fn($seat) => str_starts_with($seat['seat_numbering'], $group) &&
                                        (int) filter_var($seat['seat_numbering'], FILTER_SANITIZE_NUMBER_INT) >= 5,
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
                    </div>
                </div>



                <div class="row justify-content-center ">
                    <div class=" col-6 px-1">
                        <div class="row ">
                            @php
                                $group = 'H';
                                $groupedSeats = array_filter(
                                    $sittingLayout['layout'],
                                    fn($seat) => str_starts_with($seat['seat_numbering'], $group) &&
                                        (int) filter_var($seat['seat_numbering'], FILTER_SANITIZE_NUMBER_INT) <= 4,
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
                    </div>

                    <div class=" col-6 px-1">
                        <div class="row">
                            @php
                                $group = 'H';
                                $groupedSeats = array_filter(
                                    $sittingLayout['layout'],
                                    fn($seat) => str_starts_with($seat['seat_numbering'], $group) &&
                                        (int) filter_var($seat['seat_numbering'], FILTER_SANITIZE_NUMBER_INT) >= 5,
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
                    </div>
                </div>

                <div class="row justify-content-center ">
                    <div class=" col-6 px-1">
                        <div class="row ">
                            @php
                                $group = 'I';
                                $groupedSeats = array_filter(
                                    $sittingLayout['layout'],
                                    fn($seat) => str_starts_with($seat['seat_numbering'], $group) &&
                                        (int) filter_var($seat['seat_numbering'], FILTER_SANITIZE_NUMBER_INT) <= 4,
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
                    </div>

                    <div class=" col-6 px-1">
                        <div class="row">
                            @php
                                $group = 'I';
                                $groupedSeats = array_filter(
                                    $sittingLayout['layout'],
                                    fn($seat) => str_starts_with($seat['seat_numbering'], $group) &&
                                        (int) filter_var($seat['seat_numbering'], FILTER_SANITIZE_NUMBER_INT) >= 5,
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
                    </div>
                </div>

                <div class="row justify-content-center ">
                    <div class=" col-6 px-1">
                        <div class="row ">
                            @php
                                $group = 'J';
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
                    </div>

                    <div class=" col-6 px-1">
                        <div class="row justify-content-end">
                            @php
                                $group = 'J';
                                $groupedSeats = array_filter(
                                    $sittingLayout['layout'],
                                    fn($seat) => str_starts_with($seat['seat_numbering'], $group) &&
                                        (int) filter_var($seat['seat_numbering'], FILTER_SANITIZE_NUMBER_INT) >= 4,
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
                    </div>
                </div>


            <div class="row mt-2"></div>



                <div class="row justify-content-center ">
                    <div class=" col-6 px-1">
                        <div class="row ">
                            @php
                                $group = 'K';
                                $groupedSeats = array_filter(
                                    $sittingLayout['layout'],
                                    fn($seat) => str_starts_with($seat['seat_numbering'], $group) &&
                                        (int) filter_var($seat['seat_numbering'], FILTER_SANITIZE_NUMBER_INT) <= 3,
                                );
                            @endphp
                            <div class="row flex-wrap justify-content-end">

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

                    <div class=" col-6 px-1">
                        <div class="row">
                            @php
                                $group = 'K';
                                $groupedSeats = array_filter(
                                    $sittingLayout['layout'],
                                    fn($seat) => str_starts_with($seat['seat_numbering'], $group) &&
                                        (int) filter_var($seat['seat_numbering'], FILTER_SANITIZE_NUMBER_INT) >= 4,
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
                    </div>
                </div>


                <div class="row justify-content-center mt-2">
                    <div class=" col-6 px-1">
                        <div class="row ">
                            @php
                                $group = 'L';
                                $groupedSeats = array_filter(
                                    $sittingLayout['layout'],
                                    fn($seat) => str_starts_with($seat['seat_numbering'], $group) &&
                                        (int) filter_var($seat['seat_numbering'], FILTER_SANITIZE_NUMBER_INT) <= 3,
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

                    
                    <div class=" col-6 px-1">
                        <div class="row">
                            @php
                                $group = 'L';
                                $groupedSeats = array_filter(
                                    $sittingLayout['layout'],
                                    fn($seat) => str_starts_with($seat['seat_numbering'], $group) &&
                                        (int) filter_var($seat['seat_numbering'], FILTER_SANITIZE_NUMBER_INT) >= 4,
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
                    </div>
                </div>

                <div class="row justify-content-center ">
                    <div class=" col-6 px-1">
                        <div class="row ">
                            @php
                                $group = 'M';
                                $groupedSeats = array_filter(
                                    $sittingLayout['layout'],
                                    fn($seat) => str_starts_with($seat['seat_numbering'], $group) &&
                                        (int) filter_var($seat['seat_numbering'], FILTER_SANITIZE_NUMBER_INT) <= 3,
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

                    <div class=" col-6 px-1">
                        <div class="row">
                            @php
                                $group = 'M';
                                $groupedSeats = array_filter(
                                    $sittingLayout['layout'],
                                    fn($seat) => str_starts_with($seat['seat_numbering'], $group) &&
                                        (int) filter_var($seat['seat_numbering'], FILTER_SANITIZE_NUMBER_INT) >= 4,
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
                    </div>
                </div>

                <div class="row justify-content-center mt-2">
                    <div class=" col-6 px-1">
                        <div class="row ">
                            @php
                                $group = 'N';
                                $groupedSeats = array_filter(
                                    $sittingLayout['layout'],
                                    fn($seat) => str_starts_with($seat['seat_numbering'], $group) &&
                                        (int) filter_var($seat['seat_numbering'], FILTER_SANITIZE_NUMBER_INT) <= 3,
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

                    <div class=" col-6 px-1">
                        <div class="row">
                            @php
                                $group = 'N';
                                $groupedSeats = array_filter(
                                    $sittingLayout['layout'],
                                    fn($seat) => str_starts_with($seat['seat_numbering'], $group) &&
                                        (int) filter_var($seat['seat_numbering'], FILTER_SANITIZE_NUMBER_INT) >= 4,
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
                    </div>
                </div>
                <div class="row justify-content-center ">
                    <div class=" col-6 px-1">
                        <div class="row ">
                            @php
                                $group = 'O';
                                $groupedSeats = array_filter(
                                    $sittingLayout['layout'],
                                    fn($seat) => str_starts_with($seat['seat_numbering'], $group) &&
                                        (int) filter_var($seat['seat_numbering'], FILTER_SANITIZE_NUMBER_INT) <= 3,
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

                    <div class=" col-6 px-1">
                        <div class="row">
                            @php
                                $group = 'O';
                                $groupedSeats = array_filter(
                                    $sittingLayout['layout'],
                                    fn($seat) => str_starts_with($seat['seat_numbering'], $group) &&
                                        (int) filter_var($seat['seat_numbering'], FILTER_SANITIZE_NUMBER_INT) >= 4,
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
                    </div>
                </div>

                <div class="row justify-content-center mt-2">
                    <div class=" col-6 px-1">
                        <div class="row ">
                            @php
                                $group = 'P';
                                $groupedSeats = array_filter(
                                    $sittingLayout['layout'],
                                    fn($seat) => str_starts_with($seat['seat_numbering'], $group) &&
                                        (int) filter_var($seat['seat_numbering'], FILTER_SANITIZE_NUMBER_INT) <= 3,
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

                    <div class=" col-6 px-1">
                        <div class="row">
                            @php
                                $group = 'P';
                                $groupedSeats = array_filter(
                                    $sittingLayout['layout'],
                                    fn($seat) => str_starts_with($seat['seat_numbering'], $group) &&
                                        (int) filter_var($seat['seat_numbering'], FILTER_SANITIZE_NUMBER_INT) >= 4,
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
                    </div>
                </div>
                <div class="row justify-content-center ">
                    <div class=" col-6 px-1">
                        <div class="row ">
                            @php
                                $group = 'Q';
                                $groupedSeats = array_filter(
                                    $sittingLayout['layout'],
                                    fn($seat) => str_starts_with($seat['seat_numbering'], $group) &&
                                        (int) filter_var($seat['seat_numbering'], FILTER_SANITIZE_NUMBER_INT) <= 3,
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

                    <div class=" col-6 px-1">
                        <div class="row">
                            @php
                                $group = 'Q';
                                $groupedSeats = array_filter(
                                    $sittingLayout['layout'],
                                    fn($seat) => str_starts_with($seat['seat_numbering'], $group) &&
                                        (int) filter_var($seat['seat_numbering'], FILTER_SANITIZE_NUMBER_INT) >= 4,
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
                    </div>
                </div>


                <div class="row justify-content-center mt-2">
                    <div class=" col-6 px-1">
                        <div class="row ">
                            @php
                                $group = 'R';
                                $groupedSeats = array_filter(
                                    $sittingLayout['layout'],
                                    fn($seat) => str_starts_with($seat['seat_numbering'], $group) &&
                                        (int) filter_var($seat['seat_numbering'], FILTER_SANITIZE_NUMBER_INT) <= 3,
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

                    <div class=" col-6 px-1">
                        <div class="row">
                            @php
                                $group = 'R';
                                $groupedSeats = array_filter(
                                    $sittingLayout['layout'],
                                    fn($seat) => str_starts_with($seat['seat_numbering'], $group) &&
                                        (int) filter_var($seat['seat_numbering'], FILTER_SANITIZE_NUMBER_INT) >= 4,
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
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class=" col-6 px-1">
                        <div class="row ">
                            @php
                                $group = 'S';
                                $groupedSeats = array_filter(
                                    $sittingLayout['layout'],
                                    fn($seat) => str_starts_with($seat['seat_numbering'], $group) &&
                                        (int) filter_var($seat['seat_numbering'], FILTER_SANITIZE_NUMBER_INT) <= 3,
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

                    <div class=" col-6 px-1">
                        <div class="row">
                            @php
                                $group = 'S';
                                $groupedSeats = array_filter(
                                    $sittingLayout['layout'],
                                    fn($seat) => str_starts_with($seat['seat_numbering'], $group) &&
                                        (int) filter_var($seat['seat_numbering'], FILTER_SANITIZE_NUMBER_INT) >= 4,
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
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class=" col-6 px-1">
                        <div class="row ">
                            @php
                                $group = 'T';
                                $groupedSeats = array_filter(
                                    $sittingLayout['layout'],
                                    fn($seat) => str_starts_with($seat['seat_numbering'], $group) &&
                                        (int) filter_var($seat['seat_numbering'], FILTER_SANITIZE_NUMBER_INT) <= 3,
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

                    <div class=" col-6 px-1">
                        <div class="row">
                            @php
                                $group = 'T';
                                $groupedSeats = array_filter(
                                    $sittingLayout['layout'],
                                    fn($seat) => str_starts_with($seat['seat_numbering'], $group) &&
                                        (int) filter_var($seat['seat_numbering'], FILTER_SANITIZE_NUMBER_INT) >= 4,
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
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class=" col-6 px-1">
                        <div class="row ">
                            @php
                                $group = 'U';
                                $groupedSeats = array_filter(
                                    $sittingLayout['layout'],
                                    fn($seat) => str_starts_with($seat['seat_numbering'], $group) &&
                                        (int) filter_var($seat['seat_numbering'], FILTER_SANITIZE_NUMBER_INT) <= 3,
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

                    <div class=" col-6 px-1">
                        <div class="row">
                            @php
                                $group = 'U';
                                $groupedSeats = array_filter(
                                    $sittingLayout['layout'],
                                    fn($seat) => str_starts_with($seat['seat_numbering'], $group) &&
                                        (int) filter_var($seat['seat_numbering'], FILTER_SANITIZE_NUMBER_INT) >= 4,
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
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class=" col-6 px-1">
                        <div class="row ">
                            @php
                                $group = 'V';
                                $groupedSeats = array_filter(
                                    $sittingLayout['layout'],
                                    fn($seat) => str_starts_with($seat['seat_numbering'], $group) &&
                                        (int) filter_var($seat['seat_numbering'], FILTER_SANITIZE_NUMBER_INT) <= 3,
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

                    <div class=" col-6 px-1">
                        <div class="row">
                            @php
                                $group = 'V';
                                $groupedSeats = array_filter(
                                    $sittingLayout['layout'],
                                    fn($seat) => str_starts_with($seat['seat_numbering'], $group) &&
                                        (int) filter_var($seat['seat_numbering'], FILTER_SANITIZE_NUMBER_INT) >= 4,
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
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class=" col-6 px-1">
                        <div class="row ">
                            @php
                                $group = 'W';
                                $groupedSeats = array_filter(
                                    $sittingLayout['layout'],
                                    fn($seat) => str_starts_with($seat['seat_numbering'], $group) &&
                                        (int) filter_var($seat['seat_numbering'], FILTER_SANITIZE_NUMBER_INT) <= 3,
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

                    <div class=" col-6 px-1">
                        <div class="row">
                            @php
                                $group = 'W';
                                $groupedSeats = array_filter(
                                    $sittingLayout['layout'],
                                    fn($seat) => str_starts_with($seat['seat_numbering'], $group) &&
                                        (int) filter_var($seat['seat_numbering'], FILTER_SANITIZE_NUMBER_INT) >= 4,
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
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class=" col-6 px-1">
                        <div class="row ">
                            @php
                                $group = 'X';
                                $groupedSeats = array_filter(
                                    $sittingLayout['layout'],
                                    fn($seat) => str_starts_with($seat['seat_numbering'], $group) &&
                                        (int) filter_var($seat['seat_numbering'], FILTER_SANITIZE_NUMBER_INT) <= 3,
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

                    <div class=" col-6 px-1">
                        <div class="row">
                            @php
                                $group = 'X';
                                $groupedSeats = array_filter(
                                    $sittingLayout['layout'],
                                    fn($seat) => str_starts_with($seat['seat_numbering'], $group) &&
                                        (int) filter_var($seat['seat_numbering'], FILTER_SANITIZE_NUMBER_INT) >= 4,
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
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
