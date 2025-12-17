<section id="hotel-listing" class="mb-5">
    <form  class="form" action="#" wire:submit="submit" enctype="multipart/form-data">
        @if ($step == 1)
            @if (!empty($selectedClass))
                <div class="row flex-wrap">
                    <div class="col-md-4 col-lg-4 mb-4">
                        @if ($selectedClass === 'P')
                            @include('cruises.nautika.luxury')
                        @elseif ($selectedClass === 'B')
                            @include('cruises.nautika.royal')
                        @endif
                    </div>

                    <div class="col-md-12 col-lg-8 ">
                        <div class="bg-white rounded-3 shadow-sm p-4 sticks">
                            <h4 class=""><span class="fw-bold">Trip Details</span></h4>
                            <hr>

                            <h6 class="fw-bold">
                                Trip 1
                                <span class="text-warning mx-2">
                                    {{ __($TravelData['SelectedFerry']['from']) }}
                                    <i class="fa fa-arrow-right"></i>
                                    {{ __($TravelData['SelectedFerry']['to']) }}
                                </span>
                            </h6>
                            <hr>

                            <!-- Ferry Details -->
                            <div class="row">
                                <div class="col-6 ">
                                    <h6 class="fw-bolder"><i class="fa-solid fa-ferry"></i> Nautika</h6>
                                    <h6 class="fw-bolder">
                                        <i class="fa-regular fa-clock"></i>
                                        {{ \Carbon\Carbon::createFromTime($TravelData['SelectedFerry']['dTime']['hour'], $TravelData['SelectedFerry']['dTime']['minute'])->format('h:i A') }}
                                    </h6>
                                </div>
                                <div class="col-6 ">
                                    <h6 class="fw-bolder"><i class="fa-regular fa-circle-check"></i> Royal Class</h6>
                                    <h6 class="fw-bolder">
                                        <i class="fa-regular fa-clock"></i>
                                        {{ \Carbon\Carbon::createFromTime($TravelData['SelectedFerry']['aTime']['hour'], $TravelData['SelectedFerry']['dTime']['minute'])->format('h:i A') }}
                                    </h6>
                                </div>
                            </div>
                            <hr>
                            <!-- Price Per Adult -->
                            <div class="row">
                                @if (!empty($child))
                                    <div class="col-6">
                                        <p class="fw-semibold">Fare Per Infant </p>
                                    </div>
                                    <div class="col-6">
                                        <p class="fw-semibold">₹{{ number_format($childFares, 2) }} </p>
                                    </div>
                                @endif
                                <div class="col-6">
                                    <p class="fw-bold">Fare Per Adult</p>
                                </div>
                                <div class="col-6">
                                    <p class="fw-bolder">
                                        ₹{{ number_format($TravelData['SelectedFerry']['fares'][strtolower($selectedClass) . 'BaseFare'], 2) }}/-
                                    </p>
                                </div>
                                <div class="col-6">
                                    <p class="fw-bold">Port Service Fee</p>
                                </div>
                                <div class="col-6">
                                    <p class="fw-bolder">
                                        ₹{{ number_format($portFee, 2) }}/-
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <h6 class="fw-bolder">Total Cost</h6>
                                </div>
                                <div class="col-6">
                                    <h6 class="fw-bolder">
                                        ₹{{ number_format($totalCost, 2) }}/-
                                    </h6>
                                </div>
                            </div>
                            <hr>
                            @if (!empty($child))
                                <h6 class="fw-bold">Infant Details:</h6>
                                <div class="table-responsive">
                                    <div class="table-responsive passanger-data-table">

                                        <table class="table table-bordered text-center">
                                            <thead class="table-light fonts">
                                                <tr>
                                                    <th>SL.No</th>
                                                    <th>Name</th>
                                                    <th>Gender</th>
                                                    <th>Date of Birth</th>

                                                </tr>
                                            </thead>
                                            <tbody class="psngrdata">
                                                @for ($i = 1; $i <= $child; $i++)
                                                    <tr>
                                                        <td>{{ $i }}</td>
                                                        <td>
                                                            <input type="text" id="Infant-name-{{ $i }}"
                                                                class="form-control psgr-form-ctrl"
                                                                placeholder="Infant Name"
                                                                wire:model="InfantDetails.{{ $i }}.name"
                                                                required>
                                                            @error('InfantDetails.' . $i . '.name')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror

                                                        </td>
                                                        <td>
                                                            <select name="gender"
                                                                id="Infant-gender-{{ $i }}"
                                                                class="psgr-data-select"
                                                                wire:model="InfantDetails.{{ $i }}.gender">
                                                                <option value="" selected>Select</option>
                                                                <option value="Male">Male</option>
                                                                <option value="Female">Female</option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <input type="date" id="Infant-dob-{{ $i }}"
                                                                class="form-control psgr-form-ctrl"
                                                                wire:model="InfantDetails.{{ $i }}.dob"
                                                                required>
                                                        </td>
                                                    </tr>
                                                @endfor

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endif

                            <!-- Selected Seats -->
                            <div class="mb-3">
                                @if (!empty($selectedSeats))
                                    <h6 class="fw-bold">Selected Seats:</h6>
                                    <div class="table-responsive">
                                        <div class="table-responsive passanger-data-table">

                                            <table class="table table-bordered text-center">
                                                <thead class="table-light fonts">
                                                    <tr>
                                                        <th>SL.No</th>
                                                        <th>Class</th>
                                                        <th>Seat</th>
                                                        <th>Passenger Name</th>
                                                        <th>Gender</th>
                                                        <th>Age</th>
                                                        <th>Nationality</th>
                                                        <th>ID Number</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($selectedSeats as $index => $seat)
                                                        <tr class="psngrdata">
                                                            <td>{{ $index + 1 }}</td>
                                                            <td>{{ $selectedClass == 'B' ? 'Royal Class' : 'Luxury Class' }}
                                                            </td>
                                                            <td>{{ $seat['seatno'] }}</td>
                                                            <td>
                                                                <input type="text"
                                                                    id="passenger-name-{{ $index }}"
                                                                    class="form-control psgr-form-ctrl"
                                                                    placeholder="Passenger Name"
                                                                    wire:model="passengerDetails.{{ $index }}.name"
                                                                    required>
                                                            </td>
                                                            <td>
                                                                <select name="gender"
                                                                    id="passenger-gender-{{ $index }}"
                                                                    class=" psgr-data-select"
                                                                    wire:model="passengerDetails.{{ $index }}.gender">
                                                                    <option value="" selected>Select</option>
                                                                    <option value="Male">Male</option>
                                                                    <option value="Female">Female</option>
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <input type="number" name="age"
                                                                    class="form-control psgr-form-ctrl"
                                                                    placeholder="Age"
                                                                    id="passenger-age-{{ $index }}"
                                                                    min="1"
                                                                    wire:model="passengerDetails.{{ $index }}.age"
                                                                    required>
                                                            </td>
                                                            <td>
                                                                <select name="nationality"
                                                                    class="form-select psgr-data-select"
                                                                    id="passenger-nationality-{{ $index }}"
                                                                    placeholder=""
                                                                    wire:model="passengerDetails.{{ $index }}.nationality"
                                                                    required>
                                                                    <option value="" selected>Nationality</option>

                                                                    @foreach ($countries as $country)
                                                                        <option value="{{ $country }}">
                                                                            {{ $country }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <input type="text"
                                                                    class="form-control psgr-form-ctrl"
                                                                    id="passenger-idNumber-{{ $index }}"
                                                                    name="id_no" placeholder="Id Number"
                                                                    wire:model="passengerDetails.{{ $index }}.idNumber"
                                                                    required>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>



                                @endif
                                <hr>
                                {{-- Billing Detail --}}
                                <h6 class="fw-bold">Billing Details:</h6>
                                <div class="table-responsive">
                                    <div class="table-responsive passanger-data-table">

                                        <table class="table table-bordered text-center">
                                            <thead class="table-light fonts">
                                                <tr>
                                                    <th>SL.No</th>
                                                    <th>Billing Name</th>
                                                    <th>Email Address</th>
                                                    <th>Mobile Number</th>
                                                    <th>GSTIN</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="psngrdata">
                                                    <td>1</td>
                                                    <td>
                                                        <input type="text" class="form-control psgr-form-ctrl"
                                                            id="billing-name" name="billing-name"
                                                            placeholder="Billing Name" wire:model="billingName"
                                                            required>

                                                        @error('billingName')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </td>
                                                    <td>
                                                        <input type="email" class="form-control psgr-form-ctrl"
                                                            id="billing-email" name="billing-email"
                                                            placeholder="Billing Email" wire:model="billingEmail"
                                                            required>

                                                        @error('billingEmail')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control psgr-form-ctrl"
                                                            id="billing-mobile" name="billing-name"
                                                            placeholder="Billing Mobile" wire:model="billingMobile"
                                                            required>
                                                        @error('billingMobile')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control psgr-form-ctrl"
                                                            id="billing-gst" name="billing-gst" placeholder="GSTIN"
                                                            wire:model="billingGst">
                                                        @error('billingGst')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="d-flex justify-content-center">
                                    <div class="col-6 text-end mx-1">
                                        <a class="btn btn-sm btn-danger rounded-0 " href="{{route('cruises')}}">Discard</a>
                                    </div>
                                    <div class="col-6">
                                        <span class="btn btn-sm btn-primary rounded-0 "
                                            wire:click="next">Next</span>
                                    </div>


                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            @endif
        @endif
        @if ($step == 2)
            <div class="row flex-wrap">
                <div class="col-lg-8 col-md-12 col-sm-12">
                    <div class="row">
                        <div class="col-12 d-flex justify-content-between align-items-center">
                            <h1 class="text-start">Travel Details</h1>
                            <span class="btn btn-sm btn-warning  border rounded-0" wire:click="previous">
                                <i class="fa-regular fa-pen-to-square"></i> Modify Details
                            </span>
                        </div>
                    </div>
                    <hr>

                    @if (!empty($child))
                        <h6 class="fw-bold">Infant Details:</h6>
                        <div class="table-responsive">
                            <div class="table-responsive passanger-data-table">

                                <table class="table table-bordered text-center">
                                    <thead class="table-light fonts">
                                        <tr>
                                            <th>SL.No</th>
                                            <th>Name</th>
                                            <th>Gender</th>
                                            <th>Date of Birth</th>

                                        </tr>
                                    </thead>
                                    <tbody class="psngrdata">
                                        @for ($i = 1; $i <= $child; $i++)
                                            <tr>
                                                <td>{{ $i }}</td>
                                                <td>
                                                    <input type="text" id="Infant-name-{{ $i }}"
                                                        class="form-control psgr-form-ctrl" placeholder="Infant Name"
                                                        wire:model="InfantDetails.{{ $i }}.name" required
                                                        readonly>
                                                    @error('InfantDetails.' . $i . '.name')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror

                                                </td>
                                                <td>
                                                    <select name="gender" id="Infant-gender-{{ $i }}"
                                                        class="psgr-data-select"
                                                        wire:model="InfantDetails.{{ $i }}.gender"
                                                        disabled>
                                                        <option value="" selected>Select</option>
                                                        <option value="Male">Male</option>
                                                        <option value="Female">Female</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="date" id="Infant-dob-{{ $i }}"
                                                        class="form-control psgr-form-ctrl"
                                                        wire:model="InfantDetails.{{ $i }}.dob" required
                                                        readonly>
                                                </td>
                                            </tr>
                                        @endfor

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif

                    <!-- Selected Seats -->
                    <div class="mb-3">
                        @if (!empty($selectedSeats))
                            <h6 class="fw-bold">Passenger Details:</h6>
                            <div class="table-responsive">
                                <div class="table-responsive passanger-data-table">

                                    <table class="table table-bordered text-center">
                                        <thead class="table-light fonts">
                                            <tr>
                                                <th>SL.No</th>
                                                <th>Class</th>
                                                <th>Seat</th>
                                                <th>Passenger Name</th>
                                                <th>Gender</th>
                                                <th>Age</th>
                                                <th>Nationality</th>
                                                <th>ID Number</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($selectedSeats as $index => $seat)
                                                <tr class="psngrdata">
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $selectedClass == 'B' ? 'Royal Class' : 'Luxury Class' }}
                                                    </td>
                                                    <td>{{ $seat['seatno'] }}</td>
                                                    <td>
                                                        <input type="text" id="passenger-name-{{ $index }}"
                                                            class="form-control psgr-form-ctrl"
                                                            placeholder="Passenger Name"
                                                            wire:model="passengerDetails.{{ $index }}.name"
                                                            required readonly>
                                                    </td>
                                                    <td>
                                                        <select name="gender"
                                                            id="passenger-gender-{{ $index }}"
                                                            class=" psgr-data-select"
                                                            wire:model="passengerDetails.{{ $index }}.gender"
                                                            disabled>
                                                            <option value="" selected>Select</option>
                                                            <option value="Male">Male</option>
                                                            <option value="Female">Female</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input type="number" name="age"
                                                            class="form-control psgr-form-ctrl" placeholder="Age"
                                                            id="passenger-age-{{ $index }}" min="1"
                                                            wire:model="passengerDetails.{{ $index }}.age"
                                                            required readonly>
                                                    </td>
                                                    <td>
                                                        <select name="nationality"
                                                            class="form-select psgr-data-select"
                                                            id="passenger-nationality-{{ $index }}"
                                                            placeholder=""
                                                            wire:model="passengerDetails.{{ $index }}.nationality"
                                                            required disabled>
                                                            <option value="" selected>Nationality</option>

                                                            @foreach ($countries as $country)
                                                                <option value="{{ $country }}">
                                                                    {{ $country }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control psgr-form-ctrl"
                                                            id="passenger-idNumber-{{ $index }}"
                                                            name="id_no" placeholder="Id Number"
                                                            wire:model="passengerDetails.{{ $index }}.idNumber"
                                                            required readonly>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>



                        @endif
                        <hr>
                        {{-- Billing Detail --}}
                        <h6 class="fw-bold">Billing Details:</h6>
                        <div class="table-responsive">
                            <div class="table-responsive passanger-data-table">

                                <table class="table table-bordered text-center">
                                    <thead class="table-light fonts">
                                        <tr>
                                            <th>SL.No</th>
                                            <th>Billing Name</th>
                                            <th>Email Address</th>
                                            <th>Mobile Number</th>
                                            <th>GSTIN</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="psngrdata">
                                            <td>1</td>
                                            <td>
                                                <input type="text" class="form-control psgr-form-ctrl"
                                                    id="billing-name" name="billing-name" placeholder="Billing Name"
                                                    wire:model="billingName" required readonly>

                                                @error('billingName')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </td>
                                            <td>
                                                <input type="email" class="form-control psgr-form-ctrl"
                                                    id="billing-email" name="billing-email"
                                                    placeholder="Billing Email" wire:model="billingEmail" required
                                                    readonly>

                                                @error('billingEmail')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </td>
                                            <td>
                                                <input type="text" class="form-control psgr-form-ctrl"
                                                    id="billing-mobile" name="billing-name"
                                                    placeholder="Billing Mobile" wire:model="billingMobile" required
                                                    readonly>
                                                @error('billingMobile')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </td>
                                            <td>
                                                <input type="text" class="form-control psgr-form-ctrl"
                                                    id="billing-gst" name="billing-gst" placeholder="GSTIN"
                                                    wire:model="billingGst" readonly>
                                                @error('billingGst')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12">

                    <div class="bg-white rounded-3 shadow-sm p-4 sticks">
                        <h4 class=""><span class="fw-bold">Trip Details</span></h4>
                        <hr>

                        <h6 class="fw-bold">
                            Trip 1
                            <span class="text-info mx-2">
                                {{ __($TravelData['SelectedFerry']['from']) }}
                                <i class="fa fa-arrow-right"></i>
                                {{ __($TravelData['SelectedFerry']['to']) }}
                            </span>
                        </h6>
                        <hr>

                        <!-- Ferry Details -->
                        <div class="row">
                            <div class="col-6 ">
                                <h6 class="fw-bolder"><i class="fa-solid fa-ferry"></i> Nautika</h6>
                                <h6 class="fw-bolder">
                                    <i class="fa-regular fa-clock"></i>
                                    {{ \Carbon\Carbon::createFromTime($TravelData['SelectedFerry']['dTime']['hour'], $TravelData['SelectedFerry']['dTime']['minute'])->format('h:i A') }}
                                </h6>
                            </div>
                            <div class="col-6 ">
                                <h6 class="fw-bolder"><i class="fa-regular fa-circle-check"></i> Royal Class</h6>
                                <h6 class="fw-bolder">
                                    <i class="fa-regular fa-clock"></i>
                                    {{ \Carbon\Carbon::createFromTime($TravelData['SelectedFerry']['aTime']['hour'], $TravelData['SelectedFerry']['dTime']['minute'])->format('h:i A') }}
                                </h6>
                            </div>
                        </div>
                        <hr>
                        <!-- Price Per Adult -->
                        <div class="row">
                            @if (!empty($child))
                                <div class="col-6">
                                    <p class="fw-semibold">Fare of {{ $child }} Infant </p>
                                </div>
                                <div class="col-6">
                                    <p class="fw-semibold">₹{{ number_format($childFares * $child, 2) }}/- </p>
                                </div>
                            @endif

                            <div class="col-6">
                                <p class="fw-bold">Fare of {{ count($selectedSeats) }} Adult</p>
                            </div>
                            <div class="col-6">
                                <p class="fw-bolder">
                                    ₹{{ number_format($TravelData['SelectedFerry']['fares'][strtolower($selectedClass) . 'BaseFare'] * count($selectedSeats), 2) }}/-

                                </p>
                            </div>
                            <div class="col-6">
                                <p class="fw-bold">Port Service Fee</p>
                            </div>
                            <div class="col-6">
                                <p class="fw-bolder">
                                    ₹{{ number_format($portFee, 2) }}/-

                                </p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-6">
                                <h6 class="fw-bolder">Total Cost</h6>
                            </div>
                            <div class="col-6">
                                <h6 class="fw-bolder">
                                    ₹{{ number_format($totalCost, 2) }}/-
                                </h6>
                            </div>
                        </div>


                        <div class="row">
                            <button type="submit" class="btn btn-warning" >
                                <span class="indicator-label text-white fw-bolder" wire:loading.remove >Proceed to
                                    Pay</span>
                                <span class="indicator-progress text-white fw-bolder" wire:loading wire:target="submit">
                                    Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                </span>
                            </button>
                            

                        </div>

                    </div>

                </div>
            </div>
        @endif
    </form>
</section>
