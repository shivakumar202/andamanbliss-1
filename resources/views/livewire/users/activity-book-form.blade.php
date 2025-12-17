<div class="border p-3 bg-light  shadow priceSummary">
    <form action="#" wire:submit.prevent="submit" enctype="multipart/form-data">

        <h2 class="fs-6">Pricing Summary</h2>
        <hr>
        <div class="d-flex justify-content-between price-innrer-title">
            <div><span>Type</span></div>
            <div><span>{{ ucwords(str_replace('-', ' ', @$activity->name)) }}</span></div>
        </div>
        <div class="mt-3 view_page_price CarpriceDetails">
            <div class="row d-flex align-items-center">
                <div class="col-md-6">
                    <h2>Rs.{{ number_format(@$totalCost, 2) }}<span class="person">/Person</span></h2>
                </div>
                <div class="col-md-6">
                    <p class="price-note"><span class="text-danger">Note:</span> The activity booking schedule is
                        subject to change depending on availability.</p>
                </div>
            </div>
        </div>
        <!-- <hr class="dashline"> -->
        <div class="mt-3 view_page_price CarpriceDetails">
            <div class="row align-items-center">
                <div class="room-collection_details col-6">
                    <span>Location</span>
                </div>
                
                @php 
                $location = Str::after($activity->address, ', ');
                @endphp
                <div class="col-6">
               <p> {{$location}}</p>
              
            </div>
        </div>
            
            <div class="d-flex justify-content-between my-3">
                <div class="room-collection_details">
                    <span>No of Guest(s)</span>
                </div>
                <div>
                    <span>
                        <div class="pCountall adult">
                            <div class="quantity">
                                <a href="#" class="quantity__minus"
                                    wire:click="decrement('guest')"><span>-</span></a>
                                <input type="text" name="quantity" wire:model="guest" id="adultCount"
                                    class="quantity__input" aria-label="Quantity" readonly>
                                <a href="#" class="quantity__plus"
                                    wire:click="increment('guest')"><span>+</span></a>
                            </div>
                        </div>
                    </span>
                </div>
            </div>
            <hr class="dashline">
                    <div class="position-relative">

            @if (!empty($activity->addon_names))
                <div>
                    <h2 class="fs-6"> Select Addons</h2>
                </div>
                <div class="addons-special d-flex gap-1 flex-wrap">
                    @foreach ($activity->addon_names as $addon)
                        <div class="p-2 text-center border addon-item {{ isset($addon_quantities[$addon->id]) ? 'bg-light' : 'bg-none' }}"
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

                            <span class="cake-selector-confirm btn btn-sm" onclick="closePopup()">Confirm</span>
                            <span class="cake-selector-cancel btn btn-sm" onclick="closePopup()">Cancel</span>
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
                        Submit.
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                    </span>
                </button>
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
                            <input type="text" wire:model="website" name="website" id="website" hidden>
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
                                wire:model="dateOfBooking" id="start_at" class="form-control date" >
                            @error('dateOfBooking')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-center custom-booking-modal-search mt-3">
                            <button 
                            type="button" 
                            class="btn ferry-inquiry-btn text-white" 
                            wire:click="done" 
                            wire:loading.attr="disabled"
                            wire:loading.class="opacity-50 cursor-not-allowed">
                            <span wire:loading.remove>Send Enquiry</span>
                            <span wire:loading>Processing...</span>
                        </button>
                        
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
                Livewire.on('success', function() {
                    $('#enquiryModal').modal('hide');
                });

                function openCakePopup(addonId) {
                    document.getElementById('cakePopup').style.display = 'block';
                }
            });
        });
    </script>
@endpush
