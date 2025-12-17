<div>
    <div class="border p-3 bg-light shadow priceSummary">
        <form action="#" wire:submit.prevent="submit" enctype="multipart/form-data">

            <h2 class="fs-6">Pricing Summary</h2>
            <hr>
            <div class="d-flex justify-content-between price-innrer-title">
                <div><span>Tour Type</span></div>
                <div><span class="fw-bolder fs-5">{{ ucwords(__(@$tour->category->name)) }}</span></div>
            </div>
            <div class="mt-3 view_page_price CarpriceDetails">
                <div class="row d-flex align-items-center">
                    <div class="col-md-8">
                        <h2>Rs.{{ number_format(@$totalCost, 2) }}<span class="person">/Person</span></h2>
                    </div>
                    <div class="col-md-4">
                        <p class="price-note"><span class="text-danger">Note:</span> Child more the 12+ years count as a
                            adult.</p>
                    </div>
                </div>
                <div>
                    <div class="d-flex justify-content-between mt-3">
                        <div class="room-collection_details">
                            <span>No of Guest(s)</span>
                        </div>
                        <div>
                            <span>
                                <div class="pCountall adult">
                                    <div class="quantity">
                                        <a href="javascript:;" class="quantity__minus"
                                            wire:click="decrement('guest')"><span>-</span></a>
                                        <input type="text" name="quantity" wire:model="guest" id="adultCount"
                                            class="quantity__input" aria-label="Quantity" readonly>
                                        <a href="javascript:;" class="quantity__plus"
                                            wire:click="increment('guest')"><span>+</span></a>
                                    </div>
                                </div>
                            </span>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between mt-2">
                        <div class="room-collection_details">
                            <span>No of Child</span>
                        </div>
                        <div>
                            <span>
                                <div class="pCountall child">
                                    <div class="quantity">
                                        <a href="javascript:;" class="quantity__minus"
                                            wire:click="decrement('child')"><span>-</span></a>
                                        <input type="text" name="quantity" wire:model="child" id="childCount"
                                            class="quantity__input" aria-label="Quantity" readonly>
                                        <a href="javascript:;" class="quantity__plus"
                                            wire:click="increment('child')"><span>+</span></a>
                                    </div>
                                </div>
                            </span>
                        </div>
                    </div>
                    <div>
                        <div class="d-flex justify-content-between mt-2 align-items-center">
                            <div class="room-collection_details position-relative">
                                <span>Arrival Date:</span>
                            </div>
                            <div>
                                <span class="btn summary-date-picker" id="datepickerButton" wire:ignore>
                                    <img id="calendarIcon" src="{{ asset('site/img/calendar.png') }}" alt="banner"
                                        class="img-fluid rounded-3" />
                                    <input type="hidden" name="arrival" wire:model="arrival">

                                    <span id="selectedDate" class="d-none"></span> <!-- Hidden span for date -->
                                </span>

                            </div>

                        </div>
                        @error('arrival')
                            <p class="text-danger fw-semibold">{{ $message }}</p>
                        @enderror
                    </div>
                    <hr class="dashline">
                    <div class="position-relative">
                        @if (!empty($tour->addon_names))
                            <div>
                                <h2 class="fs-6">Select Addons</h2>
                            </div>
                            <div class="addons-special d-flex gap-1 flex-wrap">
                                @foreach ($tour->addon_names as $addon)
                                    <div class="p-1 text-center border addon-item {{ isset($addon_quantities[$addon->id]) ? 'bg-light' : 'bg-none' }}"
                                        @if (isset($addon->name) && $addon->name == 'Cake on Arrival') onclick="openCakePopup({{ $addon->id }})" 
                                @else 
                                    wire:click="toggleAddon({{ $addon->id }})" @endif>
                                        @if ($addon->addonPhotos)
                                            <img src="{{ $addon->addonPhotos->file }}" class="img-fluid mt-2"
                                                alt="{{ $addon->name }}" loading="lazy">
                                        @else
                                            <h4>{{ substr($addon->name, 0, 1) }}</h4>
                                        @endif
                                        <p class="fw-bold pt-2">₹{{ number_format($addon->price,0) }}/{{$addon->duration}} </p>

                                        <!-- Display addon quantity badge -->
                                        @if (isset($addon_quantities[$addon->id]) && $addon_quantities[$addon->id] > 0)
                                            <div class="cake-count-indicator">{{ $addon_quantities[$addon->id] }}</div>
                                        @else
                                            <div class="cake-count-indicator">+</div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>

                            <div>
                                <div id="cakePopup" class="popup-overlay" style="display: none;" wire:ignore.self>
                                    <div class="popup-content">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h3 class="fs-5">Cakes On Arrival</h3>
                                            <hr class="dashline">
                                        </div>

                                        <div class="cake-count py-2">
                                            <span class="cake-count-popup btn btn-sm"
                                                wire:click="decrementCakeCount({{ $cakeAddonId }})">-</span>
                                            <span class="px-2">{{ $addon_quantities[$cakeAddonId] ?? 0 }}</span>
                                            <span class="cake-count-popup btn btn-sm"
                                                wire:click="incrementCakeCount({{ $cakeAddonId }})">+</span>
                                        </div>

                                        <span class="cake-selector-confirm btn btn-sm"
                                            onclick="closePopup()">Confirm</span>
                                        <span class="cake-selector-cancel btn btn-sm"
                                            onclick="closePopup()">Cancel</span>
                                    </div>
                                </div>
                            </div>

                        @endif
                    </div>

                    <div class="d-grid gap-2 mt-3 pb-3">
                        <button type="submit" class="ct-btn border-0 py-2 text-white">
                            <span class="indicator-label" wire:loading.remove wire:target="submit">
                                Submit
                            </span>
                            <span class="indicator-label" wire:loading wire:target="submit">
                                Submit..
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>

        </form>
        <div class="modal" id="enquiryModal" wire:ignore.self>
            <div class="modal-dialog modal-dialog-centered ">
                <div class="modal-content carEnquirymodal">
                    <div class="modal-body p-3">
                        <div class="d-flex justify-content-end">
                            <span class="text-white text-end" data-bs-dismiss="modal"><i
                                    class="fa-solid fa-circle-xmark"></i></span>
                        </div>
                        <div class="container-fluid bg-light p-4 carform">
                            <div class="col-md-12 mb-3">
                                <input type="text" wire:model="website" id="website" name="website" hidden>
                              
                                <label for="name" class="form-label text-start required">Name</label>
                                <input type="text" name="name" placeholder="Your Name" wire:model="name"
                                    id="name" class="form-control " required>
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="email" class="form-label text-start">Email ID</label>
                                <input type="text" name="email" placeholder="Your Email" id="email"
                                    wire:model="email" class="form-control email ">
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="mobile" class="form-label text-start">Mobile No.</label>
                                <input type="number" name="mobile" placeholder="Your Mobile" id="mobile"
                                    wire:model="mobile" class="form-control ">
                                @error('mobile')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="start_at" class="form-label text-start">Date Of Booking</label>
                                <input type="date" name="start_at" placeholder="Date of Booking"
                                    wire:model="dateOfBooking" id="start_at" class="form-control date " >
                                @error('dateOfBooking')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="d-flex justify-content-center custom-booking-modal-search mt-3">
                                <button type="submit" class="btn ferry-inquiry-btn text-white"
                                    wire:click="done">Send
                                    Enquery</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@push('scripts')
    <script>
        document.addEventListener('livewire:init', function() {
            $(document).ready(function() {
                Livewire.on('getUserDetail', () => {
                    $('#enquiryModal').modal('show');
                })
                Livewire.on('success', function () {
                    $('#enquiryModal').modal('hide');
                });
                const today = new Date();
                const formattedDate = today.getFullYear() + '-' + ('0' + (today.getMonth() + 1)).slice(-2) +
                    '-' + ('0' + today.getDate()).slice(-2);
                const $datepicker = $('<div style="z-index:999;"></div>')
                    .datepicker({
                        format: 'd M yyyy',
                        autoclose: true,
                        todayHighlight: true,
                        beforeShowDay: function(date) {
                            // Disable dates before today
                            const dateString = date.getFullYear() + '-' + ('0' + (date.getMonth() +
                                1)).slice(-2) + '-' + ('0' + date.getDate()).slice(-2);
                            return {
                                enabled: dateString >= formattedDate
                            };
                        }
                    })
                    .on('changeDate', function(e) {
                        const newDate = ('0' + e.date.getDate()).slice(-2) + '-' + ('0' + (e.date
                            .getMonth() + 1)).slice(-2) + '-' + e.date.getFullYear();

                        console.log('Formatted Date:', newDate);

                        @this.set('arrival', newDate);

                        $('input[name="selectedDate"]').val(newDate);

                        $('#calendarIcon').hide();
                        $('#selectedDate').removeClass('d-none').text(newDate);
                    })

                    .appendTo('body')
                    .hide();

                // Open the datepicker when the button is clicked
                $('#datepickerButton').on('click', function() {
                    const offset = $(this).offset();
                    $datepicker.css({
                        position: 'absolute',
                        top: offset.top + $(this).outerHeight(),
                        left: offset.left
                    }).show();
                });

                // Hide the datepicker when clicking outside
                $(document).on('mousedown', function(e) {
                    if (!$(e.target).closest($datepicker).length && !$(e.target).closest(
                            '#datepickerButton').length) {
                        $datepicker.hide();
                    }
                });
            });

        });

        function openCakePopup(addonId) {
            document.getElementById('cakePopup').style.display = 'block';
        }
    </script>
@endpush
