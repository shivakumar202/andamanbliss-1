@extends('layouts.app')
@section('title', 'Hotels')

@section('content')
<section class="hotel-banner position-relative">
    <div class="container-fluid p-0 overflow-hidden">
        <div class="row">
            <div class="col-12 text-center mt-5 banner-centre-contain">
                <h1 class="text-white fs-1 text-center">Let's discover your perfect Stay and Capture Happy Moments!</h1>
            </div>
        </div>
    </div>
</section>

@include('common.search2')

<section id="hotel-listing" class="mb-5">
    <h2 class="mt-5 text-center mb-5"><span class="border-bottom border-custom ">Best Hotels for You</span></h2>

    <div class="container">
        
        <div class="row">
            <div class="col-md-12">
                   <div class="row  mt-5">
                    @forelse ($hotels->sortByDesc('star_count') as $key => $hotel)
                    <div class="col-md-3">
                        <div class="hotel border">
                            <div class="hotel-listing bg-warning">
                                <img src="{{ $hotel['hotelPhotos'][0]['file'] ?? asset('images/default-hotel.jpg') }}"
                                    alt="{{ $hotel['hotel_name'] ?? '' }}">
                            </div>
                            <div class="hotel-listing-detais d-flex flex-column">
                                <p class="px-3 mt-3 fw-bold">{{ $hotel['hotel_name'] ?? '' }}</p>

                                <div class="d-flex hotel-rating justify-content-start mt-1">
                                    <div class="hotel-star px-3">
                                        @if (!empty($hotel['star_count']))
                                        @for ($i = 1; $i <= $hotel['star_count']; $i++) <i class="fas fa-star star"></i>
                                            @endfor
                                            @for ($i = 1; $i <= (5 - $hotel['star_count']); $i++) <i
                                                class="fas fa-star star2"></i>
                                                @endfor
                                                @endif
                                    </div>
                                    <div class="hotel-review">{{ $hotel['hotel_rating'] ?? '' }} Reviews</div>
                                </div>

                                <ul class="hotel-priceDtls px-3 d-flex gap-2 pt-2">
                                    <li class="fw-bold">
                                        <i class="fa-solid fa-location-dot me-1"></i>
                                        {{ \Illuminate\Support\Str::limit($hotel['address'] ?? '', 30) }}, {{
                                        $hotel['city_name'] ?? '' }}
                                    </li>
                                </ul>
                                <hr>
                                <div class="d-flex justify-content-between align-items-center px-3 mb-2">
                                    <p class="fs-5   text-muted small">From:</p>
                                    <h5 class=" fw-bold text-success p-0 m-0">
                                        ₹{{ number_format($hotel['total_fare'] ?? 0, 2) }} <span
                                            class="fs-6 text-muted"> + ₹{{ number_format($hotel['total_tax'] ?? 0, 2) }}
                                            tax</span>
                                    </h5>
                                </div>
                                <div class="d-flex justify-content-between px-3">
                                    <div>
                                        <a href="tel:+91 8900909900" data-bs-toggle="offcanvas"
                                            data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"
                                            rel="nofollow">
                                            <p><i class="fa-solid fa-phone-volume"></i> Quick Call<span
                                                    class="px-3"></span></p>
                                        </a>
                                    </div>
                                    <div>
                                        <a href="{{ route('hotel.static', ['slug' => $hotel['slug'], 'BookingCode' => $hotel['booking_code']]) }}"
                                            onclick="event.preventDefault(); document.getElementById('hotel-form-{{ $hotel['hotel_code'] }}').submit();"
                                            class="btn btn-sm btn-primary">
                                            Book Now
                                        </a>

                                        <form id="hotel-form-{{ $hotel['hotel_code'] }}" method="POST"
                                            action="{{ route('hotel.static', ['slug' => $hotel['slug'], 'BookingCode' => $hotel['booking_code']]) }}"
                                            style="display: none;">
                                            @csrf
                                            <input type="hidden" name="other_rooms"
                                                value="{{ base64_encode(json_encode($hotel['other_rooms'])) }}">
                                        </form>

                                    </div>
                                </div>
                            </div>

                            <div class="ab-discount">
                                @if (!empty($hotel['featured']))
                                <span>AB Prefered</span>
                                @endif
                                @if (!empty($hotel['best_seller']))
                                <span>Best Seller</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-md-12">
                        <p>No result(s) found.</p>
                    </div>
                    @endforelse
                </div>

                <div class="text-center d-none">
                    <button class="btn loading mt-3">
                        <i class="fa-solid fa-spinner"></i>
                        Load more...
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style type="text/css">
    /* page styles */
</style>
@endpush

@push('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        // page scripts
    });

    function setCallNowHref() {
        var callNowButtons = document.querySelectorAll('.callNowButton');
        callNowButtons.forEach(function (button) {
            if (window.innerWidth <= 768) {
                button.href = 'tel:+918900909900';
                button.removeAttribute('data-bs-toggle');
                button.removeAttribute('data-bs-target');
                button.removeAttribute('aria-controls');
            } else {
                button.href = 'javascript:;';
                button.addEventListener('click', openOffcanvas);
            }
        });
    }

    function openOffcanvas() {
        console.log('Opening offcanvas for desktop');
    }

    document.addEventListener('DOMContentLoaded', setCallNowHref);
    window.addEventListener('resize', setCallNowHref);
</script>
@endpush