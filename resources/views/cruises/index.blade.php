@extends('layouts.app')
@section('title', 'Cruises')
@extends('layouts.app')
@section('keywords', 'Port Blair to Havelock ferry, Port Blair to Neil Island ferry, Havelock to Port Blair ferry, Neil
to Port Blair ferry, Havelock to Neil Island ferry, Andaman ferry booking, ferry tickets Port Blair, ferry tickets
Havelock, ferry tickets Neil Island, Andaman cruises, Andaman ferry routes')
@section('description', 'Book Andaman ferry tickets easily. Enjoy fast bookings, top routes, and expert
support for your Andaman travel with Andaman Bliss')
@section('meta_schema')

@endsection
@section('og_title','')
@section('og_description', '')
@section('og_type', '')
@section('og_image', '')
@section('twitter_card', '')
@section('twitter_title', '')
@section('twitter_desc', '')
@section('twitter_image', '')


@section('content')
<section class="cruise-banner position-relative">
    <div class="container-fluid p-0 overflow-hidden">
        <div class="row">
            <div class="col-12 text-center mt-5 banner-centre-contain">
                <h1 class="text-white fs-1 text-center">Let's book your Cruise for a Seamless Ocean Ride!</h1>
            </div>
        </div>
    </div>
</section>

@include('common.ferry-search')

<section id="hotel-listing" class="mb-5">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    <h2 class="mt-5 text-center mb-5 activityPageheading position-relative">Best Cruises for You</h2>

                    <section>
                        <div class="container">
                            @forelse ($cruises as $key => $cruise)
                            <div class="row bg-white border py-3 px-2 ferry-listing-main mt-3">
                                <div class="col-md-8 col-8 col-xl-8 ferry-full-details">
                                    <div class="row">
                                        <div class="d-flex  cruise-list-heading ">
                                            <h4 class="fw-bold">{{ __(@$cruise->name) }}</h4>
                                            <p>Operated by {{ __(@$cruise->name) }} Seaways</p>
                                        </div>
                                        <div class="d-flex  cruise-list-sub-heading">
                                            <span>Air Conditioned</span>
                                            <span>Hi-speed Ferry</span>
                                        </div>
                                        <div class="d-flex mt-3 cruise-list-timing">
                                            <div>
                                                <p class="cruise-time">5:30am</p>
                                                <span>Portblair</span>
                                            </div>
                                            <div class="ferry-duration-time">
                                                <img src="{{ asset('site/img/ferry-icon.png') }}" alt="ferry"
                                                    loading="lazy">
                                                <div class="text-center">3h</div>
                                            </div>
                                            <div>
                                                <p class="cruise-time">3:30pm</p>
                                                <span>Havelock</span>
                                            </div>
                                        </div>
                                        <div class="insta-booking2 mt-3 py-2">
                                            <p><i class="fa-solid fa-hourglass-start"></i> Get tickets in 3-5 business
                                                hours.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-4 col-xl-4">
                                    <div class="row">
                                        <div class="d-flex justify-content-center align-content-center">
                                            <div class="ferry-review-rating">
                                                @if (@$cruise->ratings > 0)
                                                @foreach (range(1, @$cruise->ratings) as $key => $rating)
                                                <i class="fas fa-star star"></i>
                                                @endforeach
                                                @endif
                                                @if (@$cruise->ratings < 5) @foreach (range(1, (5 - @$cruise->ratings))
                                                    as $key => $rating)
                                                    <i class="fas fa-star star2"></i>
                                                    @endforeach
                                                    @endif
                                            </div>
                                            <span class="review-count-ferry">({{ @$cruise->reviews_count }})</span>
                                        </div>
                                        <div class="d-flex justify-content-center mt-2">
                                            <div><span class="cruise-price-per-person">₹
                                                    {{ number_format(@$cruise->adult_price, 2) }}</span></div>
                                        </div>
                                        <div class="d-flex justify-content-center align-content-center">
                                            Per Ticket
                                        </div>
                                        <a href="{{ url('cruise/' . @$cruise->category->slug . '/' . @$cruise->slug) }}"
                                            class="d-flex justify-content-center mt-3">
                                            <button type="button" class="select-ferry-btn enquiryBtn-price"
                                                data-bs-toggle="modal" data-bs-target="#enquiryModal-price">Select
                                                Ferry</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <div>
                                <p>No result(s) found.</p>
                            </div>
                            @endforelse
                        </div>
                    </section>
                </div>
            </div>

            <div class="col-md-4">
                <div class="row mt-3">
                    <div class="border p-3 bg-white py-5">
                        <h2><span class=" fw-bold">Ferry Booking</span></h2>
                        <p>Please select a ferry to proceed with booking.</p>
                        <img src="{{ asset('site/img/trip-illustration.webp') }}" alt="ferry" loading="lazy">
                    </div>
                </div>
                <div class="row border p-3 bg-white pt-5 pb-2 ">
                    <div class="col-md-12 col-6">
                        <div class="row ferry-side-bar">
                            <div class="col-md-3 col-12">
                                <img src="{{ asset('site/img/image-338.svg') }}" alt=" price-icon">
                            </div>
                            <div class="col-md-9 col-12 pb-5">
                                <p class="title">Lowest Price Guarantee</p>
                                <p class="description mt-2">Finding cheaper rates elsewhere? We’ll refund the
                                    difference.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-6">
                        <div class="row py-2">
                            <div class="col-md-3 col-12">
                                <img src="{{ asset('site/img/image-339.webp') }}" alt=" price-icon">
                            </div>
                            <div class="col-md-9 col-12 pb-5">
                                <p class="title">No Hidden Charges</p>
                                <p class="description mt-2">Pay what you see. No sneaky processing fees.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-6">
                        <div class="row py-2 ferry-side-bar">
                            <div class="col-md-3 col-12">
                                <img src="{{ asset('site/img/image-340.webp') }}" alt=" price-icon">
                            </div>
                            <div class="col-md-9 col-12 pb-5">
                                <p class="title">Secure Payments</p>
                                <p class="description mt-2">All payments secured by Razorpay and Stripe.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-6">
                        <div class="row py-2 ">
                            <div class="col-md-3 col-12">
                                <img src="{{ asset('site/img/trusted-element-4.webp') }}" alt=" price-icon">
                            </div>
                            <div class="col-md-9 col-12 pb-5">
                                <p class="title">Friendly Support</p>
                                <p class="description mt-2">Reach out to us between 7AM-11PM IST at
                                    info@andamanbliss.com
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal" id="enquiryModal-price">
    <div class="modal-dialog modal-dialog-centered modal-lg ">
        <div class="modal-content carEnquirymodal">
            <div class="modal-body p-3 ">
                <div class="d-flex justify-content-end">
                    <span class="text-white text-end" data-bs-dismiss="modal"><i
                            class="fa-solid fa-circle-xmark"></i></span>
                </div>
                <div class="container-fluid mt-2">
                    <div class="card pb-5">
                        <div class="card-body card-body-ferry py-2">
                            <div class="row ">
                                <div class="col-md-8 col-7">
                                    <div class="ferry-price-modal-heading">
                                        <div>
                                            <h3 class="ferry-modal-name-operator">Makruzz Pearl</h3>
                                        </div>
                                        <div>
                                            <h4 class="ferry-modal-operator">Operated by MAK Logistics</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-5">
                                    <div class="d-flex justify-content-center align-content-center">
                                        <div class="ferry-review-rating">
                                            <i class="fas fa-star star"></i>
                                            <i class="fas fa-star star"></i>
                                            <i class="fas fa-star star"></i>
                                            <i class="fas fa-star star"></i>
                                            <i class="fas fa-star star"></i>
                                        </div>
                                        <span class="review-count-ferry">(1255)</span>
                                    </div>
                                </div>
                            </div>
                            <div id="ferryCarouselControls" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="{{ asset('site/img/makruzzSlide1.webp') }}" alt=" mak Slider">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="{{ asset('site/img/makruzzgold.jpg') }}" alt=" mak Slider">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="{{ asset('site/img/makruzzSlide2.webp') }}" alt=" mak Slider">
                                    </div>
                                </div>
                                <button class="carousel-control-prev" type="button"
                                    data-bs-target="#ferryCarouselControls" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button"
                                    data-bs-target="#ferryCarouselControls" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        </div>
                        <div class="row px-3 modal-ferry-price-col">
                            <div class="col-md-4 mb-3 ">
                                <div class="ferry-card-custom position-relative">
                                    <input type="radio" name="classSelection" id="premium" class="form-check-input">
                                    <label for="premium" class="form-check-label">Premium Class</label>
                                    <div class="modal-ferry-include">
                                        <p>Includes</p>
                                        <div class="modal-ferry-dis-show">
                                            <ul class="list-unstyled modal-ferry-price">
                                                <li><i class="fa-solid fa-check"></i> Premium Seating</li>
                                                <li><i class="fa-solid fa-check"></i> Air Conditioned</li>
                                                <li><i class="fa-solid fa-check"></i> High-Speed Ferry</li>
                                            </ul>
                                            <div class="ferry-price">₹1000</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3 ">
                                <div class="ferry-card-custom position-relative">
                                    <input type="radio" name="classSelection" id="deluxe" class="form-check-input">
                                    <label for="deluxe" class="form-check-label">Deluxe Class</label>
                                    <div class="modal-ferry-include">
                                        <p>Includes</p>
                                        <div class="modal-ferry-dis-show">
                                            <ul class="list-unstyled modal-ferry-price">
                                                <li><i class="fa-solid fa-check"></i> Deluxe Seating</li>
                                                <li><i class="fa-solid fa-check"></i> Air Conditioned</li>
                                                <li><i class="fa-solid fa-check"></i> High-Speed Ferry</li>
                                            </ul>
                                            <div class="ferry-price">₹2000</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3 ">
                                <div class="ferry-card-custom position-relative">
                                    <input type="radio" name="classSelection" id="royal" class="form-check-input">
                                    <label for="royal" class="form-check-label">Royal Class</label>
                                    <div class="modal-ferry-include">
                                        <p>Includes</p>
                                        <div class="modal-ferry-dis-show">
                                            <ul class="list-unstyled modal-ferry-price">
                                                <li><i class="fa-solid fa-check"></i> Royal Seating</li>
                                                <li><i class="fa-solid fa-check"></i> Air Conditioned</li>
                                                <li><i class="fa-solid fa-check"></i> High-Speed Ferry</li>
                                            </ul>
                                            <div class="ferry-price">₹3000</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center mt-3 gap-3">
                            <button class="select-ferry-btn ferry-modal-close" data-bs-dismiss="modal">Back</button>
                            <button class="select-ferry-btn ">Proceed</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
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
</script>
@endpush