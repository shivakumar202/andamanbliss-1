@extends('layouts.app')
@section('title', @$trip->meta->meta_title ?? @$trip->package_name)
@section('keywords', @$trip->meta->meta_keywords)
@section('description', @$trip->meta->meta_description)
@section('meta_schema')
{!! $trip->meta->meta_schema ?? '' !!}
@endsection
@section('og_title', @$trip->meta->og_title)
@section('og_description', @$trip->meta->og_description)
@section('og_type', @$trip->meta->og_type)
@section('og_image', @$trip->meta->og_image)
@section('twitter_card', @$trip->meta->twitter_card)
@section('twitter_title', @$trip->meta->twitter_title)
@section('twitter_desc', @$trip->meta->twitter_desc)
@section('twitter_image', @$trip->meta->twitter_image)


@section('content')

 <section class="boat-banner" style="background-image: url('{{ @$trip->tripPhotos[0]->file }}');">
        <div class="container-fluid p-0 overflow-hidden">
            <div class="row">
                <div class="col-12 text-center mt-5  boat-trip-conten banner-centre-contain  ">
                               <h1 class="rn-hero-title">{{$trip->page_title ?? ''}}</h1>
                <p class="rn-hero-subtitle">{{$trip->page_desc ?? ''}}</p>
                </div>
            </div>
        </div>
    </section>
                @include('common.cruise-search')
@if($readMoreSection)
                <section>
    <div class="container">
        <div class="tour-andamanbliss-section mt-3 bg-white">
            @php
            $parts = explode('|', $readMoreSection->title, 2);
            @endphp

            <h2 class="tour-andamanbliss-title">
                {{ $parts[0] }}<span>| {{ $parts[1] ?? '' }}</span>
            </h2>

            <p class="tour-andamanbliss-text">
                {!!$readMoreSection->display_block!!}
                <a href="#" class="tour-andamanbliss-read-more" data-bs-toggle="modal"
                    data-bs-target="#andamanblissModal">Read More</a>
            </p>
        </div>
    </div>

    <!-- Read More Modal -->
    <div class="modal fade" id="andamanblissModal" tabindex="-1" aria-labelledby="andamanblissModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable tour-andamanbliss-modal modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="andamanblissModalLabel">{{$readMoreSection->modal_title}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0">
                   

                    <div class="tour-andamanbliss-description px-3 mt-3">
                        {!! $readMoreSection->modal_content !!}

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    
                </div>
            </div>
        </div>
    </div>
</section>
@endif

<section class="rn-page mt-5" aria-label="{{$trip->page_title}}">

<!-- How It Works Section -->
    <section class="rn-how-it-works" aria-label="How It Works">
        <div class="container">
            <div class="rn-section-header">
                <h2 class="rn-section-title">{{ $how['title'] }}</h2>
                <p class="rn-section-subtitle">{{ $how['desc'] }}</p>
            </div>
            <div class="rn-steps-grid">
                @foreach ($how['items'] as $item)
                <div class="rn-step-card">
                    <div class="rn-step-number">{{ $loop->iteration }}</div>
                    <h3>{{ $item['title'] }}</h3>
                    <p>{{ $item['desc'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Why Choose Us Section -->
    <section class="rn-why-choose" aria-label="Why Choose Us">
        <div class="container">
            <div class="rn-why-layout">
                <div class="rn-why-image">
                    <img src="https://andamanbliss.com/site/img/andamanbliss-boat.jpg" alt="Ross Island and North Bay"
                        loading="lazy">
                </div>
                <div class="rn-why-content">
                    <h2 class="rn-why-title">{{ $whyUs['title'] }}</h2>
                    <p class="rn-why-subtitle">{{ $whyUs['desc'] }}</p>
                    <ul class="rn-why-list">
                        @foreach ($whyUs['items'] as $item)
                        <li>
                            {!! $item['icon'] !!}
                            <div>
                                <strong>{{ $item['title'] }}</strong>
                                <span>{{ $item['desc'] }}</span>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </section>

   

    <!-- Island Information Section -->
     @if (!empty($trip?->contentBlock['section_blocks']))
    <section class="rn-info" aria-label="About Ross and North Bay">
        <div class="container">
            <div class="rn-section-header">
                <h2 class="rn-section-title">{{ $trip->contentBlock['title'] }}</h2>
                <p class="rn-section-subtitle">{{ $trip->contentBlock['description'] }}</p>
            </div>


            @foreach ($trip->contentBlock['section_blocks'][0]['columns_data'] as $block)

            <div class="rn-info-content">
                <!-- Ross Island -->
                <div class="rn-info-block">
                    <div class="rn-info-header">
                        <span class="rn-info-badge">{{ $block['badge'] ?? '' }}</span>
                        <h3>{{ $block['title'] ?? '' }}</h3>
                    </div>
                    <p class="rn-info-text">{{ $block['desc'] ?? '' }}</p>
                    @if (!empty($block['list']) && is_array($block['list']))
                    <div class="rn-info-highlights">
                        @foreach ($block['list'] as $li)
                        <span>{!! $li['icon'] !!} {!! $li['text'] !!}</span>
                        @endforeach

                    </div>
                    @endif
                </div>
                @endforeach


            </div>
        </div>
    </section>
@endif
    

    <!-- FAQ Section -->
    <section class="rn-faq" aria-label="Frequently Asked Questions">
        <div class="container">
            <div class="rn-section-header">
                <h2 class="rn-section-title">Frequently Asked Questions</h2>
                <p class="rn-section-subtitle">Everything you need to know about booking</p>
            </div>
            <div class="rn-faq-grid">
                @foreach ($trip->faq as $faqs)
                <div class="rn-faq-item">
                    <h4>{{ $faqs->question }}</h4>
                    <p>{{ $faqs->answer }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>
</section>

<section class="container review-section" aria-label="Customer Reviews">

            
     <h2 class="rn-section-title  text-center ">What Our Customers Says</h2>
                <p class="rn-section-subtitle  text-center ">Everything you need to know about us</p>
      <div class="rev-container mt-3">
        
    <div class="rev-rating-box flex-wrap">
        <div class="col-lg-6 col-12">
            <div class="rev-stars">
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
            </div>
            <h1 class="rev-rating-value">{{ number_format($rating['average_rating'],1) }}</h1>
            <p class="rev-rating-sub">From 70+ countries</p>
        </div>
        <div class="col-lg-6 col-12">
            <div class="rev-rating-row">
                <span>5 ★</span>
                <div class="rev-bar"><div style="width:95%"></div></div>
                <span>{{ $rating[5] }}</span>
            </div>

            <div class="rev-rating-row">
                <span>4 ★</span>
                <div class="rev-bar"><div style="width:30%"></div></div>
                <span>{{ $rating[4] }}</span>
            </div>

            <div class="rev-rating-row">
                <span>3 ★</span>
                <div class="rev-bar"><div style="width:3%"></div></div>
                <span>{{ $rating[3] }}</span>
            </div>

            <div class="rev-rating-row">
                <span>2 ★</span>
                <div class="rev-bar"><div style="width:2%"></div></div>
                <span>{{ $rating[2] }}</span>
            </div>

            <div class="rev-rating-row">
                <span>1 ★</span>
                <div class="rev-bar"><div style="width:4%"></div></div>
                <span>{{ $rating[1] }}</span>
            </div>
          

        </div>
    </div>

    <h3 class="rev-gallery-title fs-5">Traveller Image Gallery</h3>
<div class="rev-gallery-grid">

    @php $first = $review_images->first(); @endphp

    @if($first)

        {{-- BIG IMAGE --}}
        <a href="{{ $first->image_url }}" data-lightbox="gallery" class="rev-big-wrap">
            <img src="{{ $first->image_url }}" class="rev-big-img">
            <span class="rev-view-all"><i class="fa fa-camera"></i> View All ({{ $review_images->count() }})</span>
        </a>

        @foreach($review_images->skip(1)->take(6) as $img)
            <a href="{{ $img->image_url }}" data-lightbox="gallery">
                <img src="{{ $img->image_url }}" class="rev-small-img">
            </a>
        @endforeach

    @endif

    {{-- HIDDEN: ALL IMAGES FOR LIGHTBOX --}}
    <div style="display:none;">
        @foreach($review_images as $img)
            <a href="{{ $img->image_url }}" data-lightbox="gallery"></a>
        @endforeach
    </div>

</div>



  @foreach($reviews as $review)
<div class="rev-review-card   mt-2 flex-wrap">
    <img src="{{ $review['reviewer_profile_photo_url'] }}" class="rev-avatar">

    <div class="rev-review-content col-10">
        <h4 class="rev-name">{{ $review['reviewer_name'] }}</h4>
        <p class="rev-date">Reviewed: {{ \Carbon\Carbon::parse($review['review_date'])->format('M Y') }}</p>
        <p class="mt-1" style="text-align: justify;">{{ $review['comment'] }}</p>
        </div>

    <div class="rev-rating-badge">
        ⭐ {{ number_format($review['rating'],1) }}
    </div>
</div>

@endforeach
</div>  

</section>


@endsection

@push('styles')
<style>
    /* ===== RN Scoped Styles (unique class prefix: rn-) ===== */
    .rn-page {
        --rn-orange: #FD6E0F;
        --rn-orange-600: #e7640e;
        --rn-blue-900: #0d5c97;
        --rn-blue-700: #1a8ec2;
        --rn-blue-500: #7fd6f3;
        --rn-text: #0f172a;
        --rn-muted: #64748b;
        --rn-border: #e2e8f0;
    }

    /* Utility */
    .rn-hidden {
        display: none !important
    }

    /* Banner - 50vh height, solid background */
    .rn-hero {
        position: relative;
        min-height: 50vh;
        display: flex;
        align-items: center;
        color: #fff;
        background: linear-gradient(135deg, var(--rn-blue-900) 0%, var(--rn-blue-700) 100%);
        padding: 40px 0
    }

    .rn-hero-overlay {
        position: absolute;
        inset: 0;
        pointer-events: none;
        background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><defs><pattern id="grid" width="40" height="40" patternUnits="userSpaceOnUse"><path d="M 40 0 L 0 0 0 40" fill="none" stroke="rgba(255,255,255,0.05)" stroke-width="1"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
        opacity: .4
    }

    .rn-hero .container {
        position: relative;
        z-index: 2
    }

    .rn-hero-content {
        max-width: 1100px;
        margin: 0 auto
    }

    .tour-andamanbliss-read-more {
        color: rgb(17, 157, 213);
        font-weight: 600;
        text-decoration: none;
        cursor: pointer;
    }

    .tour-andamanbliss-read-more:hover {
        color: #f9680f;
        text-decoration: underline;
    }

    .rn-hero-title {
        margin: 0 0 8px 0;
        font-weight: 800;
        line-height: 1.15;
        letter-spacing: .3px;
        font-size: clamp(28px, 4vw, 28px);
        text-align: center;
        color: #fff
    }

    .rn-hero-subtitle {
        margin: 0 0 30px 0;
        text-align: center;
        font-size: clamp(16px, 2vw, 20px);
        color: rgba(255, 255, 255, .9);
        font-weight: 400
    }

    /* Search card - solid white background */
    .rn-search-card {
        background: #fff;
        border: none;
        border-radius: 16px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, .25);
        max-width: 1100px;
        margin: 0 auto
    }

    .rn-form-grid {
        display: grid;
        gap: 14px;
        padding: 20px;
        align-items: flex-end
    }

    /* Responsive grid */
    @media (min-width: 576px) {
        .rn-form-grid {
            grid-template-columns: repeat(2, 1fr)
        }
    }

    @media (min-width: 768px) {
        .rn-form-grid {
            grid-template-columns: repeat(3, 1fr)
        }
    }

    @media (min-width: 992px) {
        .rn-form-grid {
            grid-template-columns: 3fr 2.2fr 1.8fr 1.8fr 2fr;
            padding: 24px
        }
    }

    /* Form elements */
    .rn-form-item {
        display: flex;
        flex-direction: column;
        gap: 6px
    }

    .rn-label {
        font-weight: 700;
        color: var(--rn-text);
        font-size: .92rem
    }

    .rn-input,
    .rn-select,
    .rn-stepper-input {
        height: 48px;
        border-radius: 8px;
        border: 1px solid var(--rn-border);
        background: #fff;
        outline: 0;
        transition: box-shadow .15s ease, border-color .15s ease;
        padding: 0 12px
    }

    .rn-input:focus,
    .rn-select:focus,
    .rn-stepper-input:focus {
        border-color: var(--rn-orange);
        box-shadow: 0 0 0 4px rgba(253, 110, 15, .15)
    }

    /* Input with icon */
    .rn-input-icon {
        position: relative
    }

    .rn-input-icon .rn-icon {
        position: absolute;
        right: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: #6b7280;
        font-size: 16px;
        cursor: pointer;
        pointer-events: auto;
        transition: color .2s ease;
        z-index: 1
    }

    .rn-input-icon .rn-icon:hover {
        color: var(--rn-orange)
    }

    .rn-input-icon .rn-input {
        padding-right: 42px
    }

    /* Hide default date picker icon */
    .rn-input-icon input[type="date"]::-webkit-calendar-picker-indicator {
        opacity: 0;
        cursor: pointer;
        position: absolute;
        right: 0;
        width: 48px;
        height: 100%
    }

    .rn-input-icon input[type="date"]::-webkit-inner-spin-button,
    .rn-input-icon input[type="date"]::-webkit-clear-button {
        display: none
    }

    /* Stepper */
    .rn-stepper {
        display: flex;
        align-items: center;
        border-radius: 8px;
        background: #fff;
        border: 1px solid var(--rn-border);
        height: 48px
    }

    .rn-stepper-btn {
        width: 44px;
        height: 46px;
        margin: 1px;
        background: transparent;
        border: 0;
        border-radius: 6px;
        color: #111827;
        font-weight: 800;
        font-size: 22px;
        line-height: 1;
        cursor: pointer
    }

    .rn-stepper-btn:hover {
        background: #f3f4f6
    }

    .rn-stepper-input {
        width: 64px;
        text-align: center;
        border: 0;
        height: 100%;
        outline: 0;
        background: transparent
    }

    /* Submit button */
    .rn-action {
        display: block;
        align-self: end
    }

    .rn-submit {
        width: 100%;
        height: 48px;
        min-height: 48px;
        border: none;
        border-radius: 30px;
        background: linear-gradient(90deg, var(--rn-orange), var(--rn-orange-600));
        color: #fff;
        font-weight: 800;
        letter-spacing: .25px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        box-shadow: 0 8px 20px rgba(253, 110, 15, .35);
        transition: transform .08s ease, box-shadow .2s ease;
        cursor: pointer
    }

    .rn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 28px rgba(253, 110, 15, .45)
    }

    .rn-submit:active {
        transform: translateY(0)
    }

    .rn-submit-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 32px;
        height: 32px;
        border-radius: 6px;
        background: rgba(255, 255, 255, .2)
    }

    /* Section Header */
    .rn-section-header {
        text-align: center;
        margin-bottom: 40px
    }

    .rn-section-title {
        margin: 0 0 10px 0;
        font-weight: 800;
        color: var(--rn-text);
        font-size: clamp(24px, 3vw, 26px)
    }

    .rn-section-subtitle {
        margin: 0;
        color: var(--rn-muted);
        font-size: clamp(14px, 2vw, 18px)
    }

    /* Why Choose Us Section - Two Column Layout */
    .rn-why-choose {
        padding: 60px 0;
        background: #fff
    }

    .rn-why-layout {
        display: grid;
        gap: 40px;
        align-items: center
    }

    @media (min-width: 992px) {
        .rn-why-layout {
            grid-template-columns: 45% 55%;
            gap: 60px
        }
    }

    /* Image */
    .rn-why-image {
        position: relative;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 12px 40px rgba(0, 0, 0, .15)
    }

    .rn-why-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        min-height: 400px
    }

    /* Content */
    .rn-why-content {
        padding: 0
    }

    .rn-why-title {
        margin: 0 0 10px 0;
        font-weight: 800;
        color: var(--rn-text);
        font-size: clamp(24px, 3vw, 26px)
    }

    .rn-why-subtitle {
        margin: 0 0 30px 0;
        color: var(--rn-muted);
        font-size: clamp(14px, 2vw, 18px);
        line-height: 1.5
    }

    /* List */
    .rn-why-list {
        list-style: none;
        margin: 0;
        padding: 0
    }

    .rn-why-list li {
        display: flex;
        gap: 16px;
        margin-bottom: 24px;
        align-items: flex-start
    }

    .rn-why-list li:last-child {
        margin-bottom: 0
    }

    .rn-why-list i {
        font-size: 24px;
        color: var(--rn-orange);
        flex-shrink: 0;
        margin-top: 2px
    }

    .rn-why-list div {
        flex: 1
    }

    .rn-why-list strong {
        display: block;
        margin-bottom: 4px;
        font-weight: 600;
        color: var(--rn-text);
        font-size: 0.9rem
    }

    .rn-why-list span {
        display: block;
        color: var(--rn-muted);
        line-height: 1.6;
        font-size: .95rem
    }

    /* Responsive */
    @media (max-width: 991px) {
        .rn-why-image img {
            min-height: 300px
        }
    }

    /* Info section - Simple & Informative */
    .rn-info {
        padding: 60px 0;
        background: #f8fafc
    }

    .rn-info-content {
        max-width: 900px;
        margin: 0 auto
    }

    /* Info Block */
    .rn-info-block {
        margin-bottom: 40px;
        padding-bottom: 40px;
        border-bottom: 1px solid var(--rn-border)
    }

    .rn-info-block:last-child {
        margin-bottom: 0;
        padding-bottom: 0;
        border-bottom: none
    }

    /* Header */
    .rn-info-header {
        margin-bottom: 16px
    }

    .rn-info-badge {
        display: inline-block;
        padding: 6px 16px;
        border-radius: 20px;
        background: var(--rn-orange);
        color: #fff;
        font-size: .85rem;
        font-weight: 700;
        margin-bottom: 12px
    }

    .rn-badge-blue {
        background: var(--rn-blue-700)
    }

    .rn-badge-green {
        background: #10b981
    }

    .rn-info-header h3 {
        margin: 0;
        font-weight: 700;
        color: var(--rn-text);
        font-size: 1.4rem;
        line-height: 1.3
    }

    /* Text */
    .rn-info-text {
        margin: 0 0 20px 0;
        color: var(--rn-muted);
        line-height: 1.7;
        font-size: 1rem
    }

    /* Highlights */
    .rn-info-highlights {
        display: flex;
        flex-wrap: wrap;
        gap: 12px
    }

    .rn-info-highlights span {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 14px;
        background: #fff;
        border: 1px solid var(--rn-border);
        border-radius: 6px;
        font-size: .9rem;
        color: var(--rn-text)
    }

    .rn-info-highlights i {
        color: var(--rn-orange);
        font-size: .85rem
    }

    /* Responsive */
    @media (max-width: 768px) {
        .rn-info-header h3 {
            font-size: 1.2rem
        }

        .rn-info-highlights {
            flex-direction: column
        }

        .rn-info-highlights span {
            width: 100%
        }
    }

    /* How It Works Section */
    .rn-how-it-works {
        padding: 60px 0;
        background: #fff
    }

    .rn-steps-grid {
        display: grid;
        gap: 24px
    }

    @media (min-width: 768px) {
        .rn-steps-grid {
            grid-template-columns: repeat(3, 1fr)
        }

        
    }
    

    .rn-step-card {
        background: #fff;
        border: 2px solid var(--rn-border);
        border-radius: 12px;
        padding: 32px 24px;
        text-align: center;
        position: relative;
        transition: border-color .2s ease
    }

    .rn-step-card:hover {
        border-color: var(--rn-orange)
    }

    .rn-step-number {
        width: 56px;
        height: 56px;
        margin: 0 auto 16px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--rn-orange), var(--rn-orange-600));
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        font-weight: 800
    }

    .rn-step-card h3 {
        margin: 0 0 10px 0;
        font-weight: 700;
        color: var(--rn-text);
        font-size: 1.15rem
    }

    .rn-step-card p {
        margin: 0;
        color: var(--rn-muted);
        line-height: 1.6
    }

    /* FAQ Section */
    .rn-faq {
        padding: 60px 0 80px;
        background: #f8fafc
    }

    .rn-faq-grid {
        display: grid;
        gap: 20px;
        margin: 0 auto
    }

    @media (min-width: 768px) {
        .rn-faq-grid {
            grid-template-columns: repeat(2, 1fr)
        }
    }

    .rn-faq-item {
        background: #fff;
        border-left: 4px solid var(--rn-orange);
        border-radius: 8px;
        padding: 20px 24px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, .05)
    }

    .rn-faq-item h4 {
        margin: 0 0 8px 0;
        font-weight: 700;
        color: var(--rn-text);
        font-size: 1.05rem
    }

    .rn-faq-item p {
        margin: 0;
        color: var(--rn-muted);
        line-height: 1.6;
        font-size: .95rem
    }

    /* Passengers (Results) - EXACT match to image */
    .rn-passengers {
        padding: 40px 0 60px;
        background: #f5f5f5
    }

    /* Back button - highlighted */
    .rn-back-btn {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        margin: 0 0 24px;
        padding: 10px 20px;
        border-radius: 8px;
        border: 2px solid var(--rn-orange);
        background: var(--rn-orange);
        color: #fff;
        text-decoration: none;
        font-weight: 700;
        font-size: .95rem;
        transition: all .2s ease;
        box-shadow: 0 4px 12px rgba(253, 110, 15, .3)
    }

    .rn-back-btn:hover {
        background: #fff;
        color: var(--rn-orange);
        box-shadow: 0 6px 16px rgba(253, 110, 15, .4);
        transform: translateX(-4px)
    }

    .rn-back-btn i {
        font-size: 16px
    }

    /* Title */
    .rn-passengers-title {
        margin: 0 0 40px 0;
        text-align: center;
        font-weight: 600;
        color: #1a1a1a;
        font-size: 1.85rem
    }

    /* Card */
    .rn-passengers-card {
        max-width: 1200px;
        margin: 0 auto;
        background: transparent
    }

    /* Form rows - inline label and input */
    .rn-form-row {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
        max-width: 800px;
        margin-left: auto;
        margin-right: auto
    }

    .rn-form-label {
        width: 180px;
        font-weight: 400;
        color: #333;
        font-size: .95rem;
        line-height: 1.4;
        flex-shrink: 0
    }

    .rn-form-input-wrap {
        flex: 1
    }

    .rn-form-input {
        width: 100%;
        height: 42px;
        border: 1px solid #d1d5db;
        border-radius: 4px;
        padding: 0 12px;
        font-size: .95rem;
        outline: 0;
        background: #fff;
        transition: border-color .15s ease
    }

    .rn-form-input:focus {
        border-color: var(--rn-orange);
        box-shadow: 0 0 0 3px rgba(253, 110, 15, .08)
    }

    .rn-form-input::placeholder {
        color: #9ca3af
    }

    /* Table container */
    .rn-table-container {
        margin: 40px 0 30px;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch
    }

    .rn-data-table {
        width: 100%;
        min-width: 800px;
        border-collapse: collapse;
        background: #fff;
        border: 1px solid #d1d5db
    }

    .rn-data-table th,
    .rn-data-table td {
        padding: 14px 10px;
        border: 1px solid #d1d5db;
        text-align: center;
        font-size: .9rem;
        color: #1a1a1a;
        white-space: nowrap
    }

    .rn-data-table thead th {
        font-weight: 700;
        background: #f9fafb;
        color: #1a1a1a;
        position: sticky;
        top: 0;
        z-index: 1
    }

    .rn-data-table tbody td {
        background: #fff
    }

    /* Table inputs and selects */
    .rn-cell-input,
    .rn-cell-select {
        width: 100%;
        min-width: 100px;
        height: 34px;
        border: 1px solid #d1d5db;
        border-radius: 3px;
        padding: 0 8px;
        font-size: .88rem;
        outline: 0;
        background: #fff
    }


    .tour-andamanbliss-text {
        color: #666;
        margin-bottom: 0;
        display: block;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .rn-cell-input:focus,
    .rn-cell-select:focus {
        border-color: var(--rn-orange);
        box-shadow: 0 0 0 2px rgba(253, 110, 15, .08)
    }

    .rn-cell-input::placeholder {
        color: #9ca3af
    }

    /* Mobile - Vertical Card Layout */
    @media (max-width: 768px) {
        .rn-table-container {
            margin: 30px 0 20px;
            overflow: visible
        }

        .rn-data-table {
            min-width: 100%;
            border: none
        }

        .rn-data-table thead {
            display: none
        }

        .rn-data-table tbody {
            display: block
        }

        .rn-data-table tbody tr {
            display: block;
            background: #fff;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            margin-bottom: 16px;
            padding: 16px
        }

        .rn-data-table tbody td {
            display: grid;
            grid-template-columns: 120px 1fr;
            gap: 10px;
            align-items: center;
            padding: 10px 0;
            border: none;
            text-align: left;
            border-bottom: 1px solid #f0f0f0
        }

        .rn-data-table tbody td:last-child {
            border-bottom: none
        }

        .rn-data-table tbody td::before {
            content: attr(data-label);
            font-weight: 700;
            color: #333;
            font-size: .9rem
        }

        .rn-cell-input,
        .rn-cell-select {
            min-width: 100%;
            height: 38px;
            font-size: .9rem
        }
    }

    /* Submit button */
    .rn-submit-wrap {
        display: flex;
        justify-content: center;
        padding: 30px 0 0
    }

    .rn-submit-button {
        width: 410px;
        max-width: 90%;
        height: 50px;
        border: none;
        border-radius: 5px;
        background: #FD6E0F;
        color: #fff;
        font-weight: 600;
        font-size: 1.05rem;
        cursor: pointer;
        transition: background .2s ease
    }

    .rn-submit-button:hover {
        background: #e7640e
    }

    /* Responsive - Tablet */
    @media (max-width: 991px) {
        .rn-passengers {
            padding: 30px 0 50px
        }

        .rn-passengers-title {
            font-size: 1.5rem;
            margin-bottom: 30px
        }

        .rn-form-row {
            max-width: 100%;
            padding: 0 10px
        }
    }

    /* Responsive - Mobile */
    @media (max-width: 768px) {
        .rn-form-row {
            flex-direction: column;
            align-items: flex-start;
            padding: 0
        }

        .rn-form-label {
            width: 100%;
            margin-bottom: 6px
        }

        .rn-form-input-wrap {
            width: 100%
        }

        .rn-form-input {
            width: 100%;
            height: 44px
        }

        .rn-passengers-title {
            font-size: 1.3rem
        }

        .rn-back-btn {
            font-size: .9rem;
            padding: 8px 16px
        }

        .rn-submit-button {
            width: 100%;
            font-size: 1rem
        }
    }

    /* Responsive - Small Mobile */
    @media (max-width: 575px) {
        .rn-passengers {
            padding: 20px 0 40px
        }

        .rn-passengers-title {
            font-size: 1.2rem;
            margin-bottom: 20px
        }

        .rn-form-row {
            margin-bottom: 16px
        }

        .rn-submit-wrap {
            padding: 20px 0 0
        }

        .rn-submit-button {
            height: 46px
        }
    }

    /* Compact on small screens */
    @media (max-width: 575.98px) {
        .rn-hero {
            min-height: auto;
            padding: 30px 0
        }

        .rn-hero-title {
            font-size: 24px
        }

        .rn-hero-subtitle {
            font-size: 16px;
            margin-bottom: 20px
        }

        .rn-search-card {
            margin: 0 10px
        }

        .rn-form-grid {
            padding: 16px
        }

        .rn-why-choose,
        .rn-info,
        .rn-how-it-works,
        .rn-faq {
            padding: 40px 0
        }

        .rn-section-header {
            margin-bottom: 30px
        }
    }
</style>
@endpush

@push('scripts')
<script>
    (function() {
        const root = document.querySelector('.rn-page');
        if (!root) return;

        const hero = root.querySelector('.rn-hero');
        const whyChoose = root.querySelector('.rn-why-choose');
        const info = root.querySelector('.rn-info');
        const howItWorks = root.querySelector('.rn-how-it-works');
        const faq = root.querySelector('.rn-faq');
        const results = root.querySelector('.rn-passengers');

        // Default date = today, min = today
        const dateEl = root.querySelector('#rnDate');
        if (dateEl) {
            const tzOffset = new Date().getTimezoneOffset() * 60000;
            const todayISO = new Date(Date.now() - tzOffset).toISOString().slice(0, 10);
            if (!dateEl.value) dateEl.value = todayISO;
            dateEl.min = todayISO;
        }

        // Make calendar icon clickable to open date picker
        const calendarIcon = root.querySelector('.rn-input-icon .rn-icon');
        if (calendarIcon && dateEl) {
            calendarIcon.style.cursor = 'pointer';
            calendarIcon.addEventListener('click', function() {
                dateEl.showPicker ? dateEl.showPicker() : dateEl.focus();
            });
        }

        // Stepper increment/decrement (adults)
        root.querySelectorAll('.rn-stepper').forEach(stepper => {
            const input = stepper.querySelector('.rn-stepper-input');
            const [dec, inc] = stepper.querySelectorAll('.rn-stepper-btn');
            const min = Number(input.min || 0);
            dec.addEventListener('click', () => {
                const next = Math.max(min, (parseInt(input.value || '0', 10) || 0) - 1);
                input.value = next;
                input.dispatchEvent(new Event('change'));
            });
            inc.addEventListener('click', () => {
                const next = (parseInt(input.value || '0', 10) || 0) + 1;
                input.value = next;
                input.dispatchEvent(new Event('change'));
            });
        });

        // Show results on search, hide other sections
        const form = root.querySelector('#rnSearchForm');
        form && form.addEventListener('submit', function(e) {
            e.preventDefault();
            // simple validation
            const adults = root.querySelector('#rnAdults');
            const dateVal = dateEl ? dateEl.value : '';
            if (!dateVal || (adults && parseInt(adults.value || '0', 10) < 1)) return;

            hero && hero.classList.add('rn-hidden');
            whyChoose && whyChoose.classList.add('rn-hidden');
            info && info.classList.add('rn-hidden');
            howItWorks && howItWorks.classList.add('rn-hidden');
            faq && faq.classList.add('rn-hidden');
            results && results.classList.remove('rn-hidden');
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        // Back to search
        const back = root.querySelector('#rnBack');
        back && back.addEventListener('click', function(e) {
            e.preventDefault();
            results && results.classList.add('rn-hidden');
            hero && hero.classList.remove('rn-hidden');
            whyChoose && whyChoose.classList.remove('rn-hidden');
            info && info.classList.remove('rn-hidden');
            howItWorks && howItWorks.classList.remove('rn-hidden');
            faq && faq.classList.remove('rn-hidden');
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    })();
</script>
@endpush