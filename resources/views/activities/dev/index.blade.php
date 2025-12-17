@extends('layouts.app')
@section('title', $category['metaHeadings'][0]['meta_title'] ?? '')
@section('keywords', $category['metaHeadings'][0]['meta_keywords'] ?? '')
@section('description', $category['metaHeadings'][0]['meta_description'] ?? '')

@section('meta')
<!-- Additional Meta Tags for SEO -->
<meta property="og:title" content="{{ $category['metaHeadings'][0]['og_title'] ?? '' }}">
<meta property="og:description" content="{{ $category['metaHeadings'][0]['og_description'] ?? '' }}">
<meta property="og:image" content="{{ $category['metaHeadings'][0]['og_image'] ?? '' }}">
<meta property="og:type" content="website">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $category['metaHeadings'][0]['twitter_title'] ?? '' }}">
<meta name="twitter:description" content="{{ $category['metaHeadings'][0]['twitter_description'] ?? '' }}">
<meta name="twitter:image" content="{{ $category['metaHeadings'][0]['twitter_image'] ?? '' }}">
<link rel="canonical" href="{{ url()->current() }}">

<!-- AOS Animation Library -->
<link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>

<!-- Schema.org markup for Google -->
<script type="application/ld+json">
        {!!$category['metaHeadings'][0]['meta_schema'] ?? ''!!}
</script>

@endsection
@section('content')
<!-- Hero Section with Modern Design -->
<section class="hero-section position-relative overflow-hidden" id="lead-in-form">
    <div class="hero-background"></div>
    <div class="hero-overlay"></div>
    <div class="container position-relative z-2">
        <div class="row min-vh-75 align-items-center">
            <div class="col-12 d-block d-lg-none text-center mb-4">
                @php
                $titleParts = explode('|', $category->title);
                @endphp
                <h3 class="hero-title fs-1">
                    {{ $titleParts[0] ?? '' }} <span class="text-gradient">{{ $titleParts[1] ?? '' }}</span><br>
                    {{ $titleParts[2] ?? '' }}
                </h3>
            </div>
            <div class="col-lg-8 d-none d-lg-block hero-content">
                <div class="animate-fade-in">
                    <div class="badge-wrapper">
                        <span class="hero-badge">{{ $category->name }} Experience</span>
                    </div>
                    @php
                    $titleParts = explode('|', $category->title);
                    @endphp
                    <h1 class="hero-title">
                        {{ $titleParts[0] ?? '' }}<br>
                        <span class="text-gradient">{{ $titleParts[1] ?? '' }}</span><br>
                        {{ $titleParts[2] ?? '' }}
                    </h1>
                    <p class="hero-description">{!! $category->description !!}</p>

                    <div class="hero-cta justify-content-center">
                        <a href="#package-options" class="btn btn-primary btn-lg">Explore Packages</a>
                        <a href="#lead-in-form" class="btn btn-outline btn-lg text-white border">Contact Us</a>
                    </div>

                    <div class="hero-stats justify-content-center">
                        <div class="stat-item">
                            <div class="stat-icon">
                                <i class="fas fa-star"></i>
                            </div>
                            <div class="stat-text">
                                <span class="stat-value">{{ $category->rating }}/5</span>
                                <span class="stat-label">Customer Rating</span>
                            </div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="stat-text">
                                <span class="stat-value">2000+</span>
                                <span class="stat-label">Happy Travelers</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4">
                <div class="p-3 rounded-2 bg-white z-2">
                    <h5 class="fw-semibold text-gradient text-center">Get the Best Holiday Deals</h5>
                    <hr>
                    @include('common.lead-form')
                </div>
            </div>
        </div>
    </div>
    <div class="hero-shape-1"></div>
    <div class="hero-shape-2"></div>
    <a href="#package-options" class="scroll-indicator">
        <div class="mouse">
            <div class="wheel"></div>
        </div>
        <div>
            <span class="scroll-text">Scroll Down</span>
        </div>
    </a>
    </div>
</section>

<!--modal content-->
<section>
    <div class="container">
        <div class="tour-andamanbliss-section mt-3">
            @php
            $titleParts = explode('|', $category['categorySection'][0]['title'] ?? '');
            @endphp

            <h2 class="tour-andamanbliss-title">
                {{ trim($titleParts[0]) }}
                @if (!empty($titleParts[1]))
                | <span>{{ trim($titleParts[1]) }}</span>
                @endif
            </h2>

            <p class="tour-andamanbliss-text">
                {!! $category['categorySection'][0]['display_block'] ?? ''!!}
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
                    <h5 class="modal-title" id="andamanblissModalLabel">{!!
                        $category['categorySection'][0]['modal_title'] ?? '' !!}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0">
                    <div class="tour-andamanbliss-packages m-0">
                        @if($activities)
                        @foreach ($activities->sortBy('id') as $activity)
                        <div class="tour-andamanbliss-package-item">
                            <div class="tour-andamanbliss-package-name">
                                <a
                                    href="{{ route('activity.view', ['url' => $activity->url ?? $activity->slug]) }}">{{ ucwords($activity->service_name) }}</a>
                            </div>
                            <div class="tour-andamanbliss-package-duration">
                                {{ $activity->duration }}
                            </div>
                            <div class="tour-andamanbliss-package-inclusion">Pickup & Drop, Sightseeing</div>
                            <div class="tour-andamanbliss-package-price">INR
                                {{ number_format($activity['adult_cost']) }} ~PP</div>
                        </div>
                        @endforeach
@endif
                        <div class="tour-andamanbliss-package-item">
                            <span class="text-danger" style="font-size:10px;">Note: These prices might vary according
                                to your preferences.</span>
                        </div>
                    </div>

                    <div class="tour-andamanbliss-description px-3 mt-3">
                        {!! $category['categorySection'][0]['modal_content'] ?? '' !!}

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary"><a class="text-white"
                            href="#">View All Packages</a></button>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- End Read More Section -->
@php
$section = $category['categorySection'][0] ?? [];
$blocks = isset($section['blocks_section']) ? json_decode($section['blocks_section'], true) : [];
$block1 = $blocks['section_1'] ?? [];
$block2 = $blocks['section_2'] ?? [];
@endphp
<section id="package-options" class="packages-section">
    <div class="container">

        <div class="section-header text-center mb-5">
            @if (!empty($block1['badge']))
            <span class="section-subtitle">{!! $block1['badge'] !!}</span>
            @endif

            @if (!empty($block1['heading']))
            <h2 class="section-title">
                {!! str_replace('|', '<span class="text-gradient">', $block1['heading']) !!}
                    @if (str_contains($block1['heading'], '|'))
                </span>
                @endif
            </h2>
            @endif

            @if (!empty($block1['description']))
            <p class="section-description">{!! $block1['description'] !!}</p>
            @endif
        </div>


        <div class="packages-grid">
            <!-- 3 Nights 4 Days Package -->
            @if ($activities)
            @foreach ($activities->where('best_seller', 1)->take(3) as $aactivity)
            <div class="package-card" data-aos="fade-up" data-aos-delay="100">
                <div class="package-image">
                    <img src="{{ $aactivity->activityPhotos[0]->file ?? '' }}" alt="{{$aactivity->service_name}}">
                    <div class="package-tag">Most Popular</div>
                </div>
                <div class="package-content">
                    <h3 class="package-title">{{ ucwords($aactivity->service_name) }} </h3>
                    <div class="package-price-honeymoon">
                        <span class="price">₹ {{ number_format($aactivity->adult_cost - ($aactivity->adult_cost *
                            ($aactivity->discount / 100)), 2) }}
                            @if($aactivity->discount)
                            <span class="text-decoration-line-through fs-6 text-muted">{{
                                number_format($aactivity->adult_cost, 2) }}</span>
                            @endif
                        </span>
                        <span class="per-person">per person</span>
                    </div>
                    <p class="package-description">{{ ucfirst($aactivity->description) }}</p>
                    <ul class="package-features">
                        <li><i class="fas fa-check-circle"></i>{{$aactivity->location}}</li>
                        <li><i class="fas fa-check-circle"></i>Key Attractions</li>
                        <li><i class="fas fa-check-circle"></i>Essential Activities</li>
                    </ul>
                    <div class="package-footer">
                        <a href="{{ route('activity.view', ['url' => $aactivity->url ?? $aactivity->slug]) }}" class="btn btn-primary">View
                            Details</a>
                    </div>
                </div>
                <div class="package-shape"></div>
            </div>
            @endforeach
            @endif


        </div>

        <!-- CTA Section -->
        <div class="cta-wrapper" data-aos="fade-up">
            <div class="cta-box">
                <div class="cta-content">
                    <h2 class="cta-title">{!! $category['categorySection'][0]['cta_title'] ?? '' !!}</h2>
                    <p class="cta-description">{!! $category['categorySection'][0]['cta_desc'] ?? '' !!}</p>
                    <div class="cta-buttons">
                        <a href="#lead-in-form" class="btn btn-light btn-lg">Contact Us</a>
                        <a href="tel:+919876543210" class="btn btn-outline-light btn-lg"><i
                                class="fas fa-phone-alt me-2"></i>Call Now</a>
                    </div>
                </div>
                <div class="cta-image">
                    <img src="{{ asset('site/img/innerhoneymoon2.jpg') }}" alt="Andaman Beach">
                </div>
                <div class="cta-shape-1"></div>
                <div class="cta-shape-2"></div>
            </div>
        </div>


        <section class="duration-section" id="duration-comparison">
            <div class="section-header text-center mb-5">
                @if (!empty($block2['badge']))
                <span class="section-subtitle">{!! $block2['badge'] !!}</span>
                @endif

                @if (!empty($block2['heading']))
                <h2 class="section-title">
                    {!! str_replace('|', '<span class="text-gradient">', $block2['heading']) !!}
                        @if (str_contains($block2['heading'], '|'))
                    </span>
                    @endif
                </h2>
                @endif

                @if (!empty($block2['description']))
                <p class="section-description">{!! $block2['description'] !!}</p>
                @endif
            </div>
            @php
            $groupedActivities = $activities->groupBy('location');
            @endphp


            <div class="duration-tabs">
                @foreach ($groupedActivities as $location => $items)
                <button type="button" class="duration-tab {{ $loop->first ? 'active' : '' }}"
                    data-duration="{{ Str::slug($location) }}">
                    {{ $location }}
                </button>
                @endforeach
            </div>



            <div class="duration-content">
                @foreach ($groupedActivities as $location => $items)
                @foreach ($items as $activity)
                <div class="duration-card" data-duration="{{ Str::slug($location) }}" data-aos="fade-up"
                    data-aos-delay="100">
                    <div class="duration-image">
                        <img src="{{ $activity->activityPhotos[0]->file ?? '' }}" alt="{{ $activity->service_name }}">
                        <div class="duration-badge">Most Popular</div>
                    </div>
                    <div class="duration-details">
                        <div class="duration-header">
                            <h3 class="duration-title">{{ ucwords($activity->service_name) }}</h3>
                            <div class="duration-price">
                                ₹{{ number_format($activity->adult_cost - ($activity->adult_cost * ($activity->discount
                                / 100)), 2) }}
                                @if($activity->discount)
                                <span class="text-decoration-line-through fs-6 text-muted">{{
                                    number_format($activity->adult_cost, 2) }}</span>
                                @endif
                                <small>per person</small>
                            </div>
                        </div>
                        <div class="duration-features">
                            @foreach($activity['facilities']->take(4) as $afacility)
                            <div class="duration-feature"><i class="fas fa-check"></i> <span>{!!$afacility->name!!}</span></div>
                            @endforeach
                           
                        </div>
                        <div class="duration-footer">
                            <div class="duration-rating">
                                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                                <i class="fas fa-star"></i><i class="fas fa-star"></i>
                                <span>4.9 (120+ reviews)</span>
                            </div>
                            <a href="{{ route('activity.view', ['url' => $activity->url ?? $activity->slug]) }}"
                                class="duration-cta">
                                View Details
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
                @endforeach
            </div>


            <div class="duration-shape-1"></div>
            <div class="duration-shape-2"></div>
        </section>
    </div>
</section>

<!-- Features Section -->
<!-- @if (isset($category['facilities']) && !empty($category['facilities']))
<section class="features-section" id="features">
    <div class="container">
        <div class="section-header text-center">
            <span class="section-subtitle">{{ $category['facilities'][0]['title'] ?? '' }}</span>

            @php
            $subTitleParts = explode('|', $category['facilities'][0]['sub_title'] ?? '');
            @endphp

            <h2 class="section-title">
                {{ $subTitleParts[0] ?? '' }} <span class="text-gradient">{{ $subTitleParts[1] ?? '' }}</span>
            </h2>

            <p class="section-description">{{ $category['facilities'][0]['bottom_title'] ?? '' }}</p>
        </div>

        <div class="features-grid">
            @foreach ($category['facilities'] as $facility)
            <div class="feature-card" data-aos="fade-up" data-aos-delay="100">
                <div class="feature-icon">
                    {!! $facility['icon'] !!}
                </div>
                <div class="feature-content">
                    <h3 class="feature-title">{!! $facility['name'] !!}</h3>
                    <p class="feature-description">{!! $facility['value'] !!}</p>
                </div>
                <div class="feature-bg"></div>
            </div>
            @endforeach
        </div>
    </div>

    <div class="section-shape-1"></div>
    <div class="section-shape-2"></div>
</section>
@endif -->

<!-- Testimonials Section -->
<section class="testimonials-section pt-0" id="testimonials">
    <div class="container">
        <div class="section-header text-center">
            <span class="section-subtitle">What Our Travelers Say</span>
            <h2 class="section-title">Real <span class="text-gradient">Experiences</span> from Real Travelers</h2>
            <p class="section-description">Discover why thousands of travelers choose our Andaman packages for their
                dream vacation</p>
        </div>
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

<!-- FAQ Section -->
<section class="faq-section" id="faq">
    <div class="container">
        <div class="section-header text-center">
            <span class="section-subtitle">Frequently Asked Questions</span>
            <h2 class="section-title">Everything You <span class="text-gradient">Need to Know</span></h2>
            <p class="section-description">Find answers to common questions about our {{ucwords($category->name) }}
                Activity</p>
        </div>
        <div class="faq-container">
            <div class="faq-accordion" id="faqAccordion">
                @php
                $faqs = collect($category['faqs'] ?? []);
                $chunks = $faqs->isNotEmpty() ? $faqs->chunk(ceil($faqs->count() / 2)) : collect([]);
                @endphp
                @if ($chunks->isNotEmpty())
                <div class="row">
                    @foreach ($chunks as $chunk)
                    <div class="col-md-6">
                        @foreach ($chunk as $index => $faq)
                        <div class="faq-item" data-aos="fade-up" data-aos-delay="{{ 100 + $index * 100 }}">
                            <div class="faq-header" id="heading{{ $loop->parent->index }}{{ $index }}">
                                <button class="faq-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq{{ $loop->parent->index }}{{ $index }}">
                                    <span class="faq-title">{!! $faq->question !!}?</span>
                                    <span class="faq-icon"><i class="fas fa-plus"></i><i
                                            class="fas fa-minus"></i></span>
                                </button>
                            </div>
                            <div id="faq{{ $loop->parent->index }}{{ $index }}" class="collapse"
                                data-bs-parent="#faqAccordion">
                                <div class="faq-body">
                                    <p>{!! $faq->answer !!}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endforeach
                </div>
                @endif

            </div>
        </div>
    </div>
    <div class="section-shape-4"></div>
</section>


@endsection

@push('styles')
<style type="text/css">
    .honey-list-cont li {
        font-size: 14px;
        color: #002246;
    }

    .honey-sub-heading {
        font-size: 14px;
    }

    .honey-sub-heading a {
        font-size: 14px;
        font-weight: bold !important;
    }

    .tour-andamanbliss-section {
        background-color: #f8f9fa;
        padding: 1.5rem;
        border-radius: 8px;
        margin-bottom: 2rem;
        border: 1px solid #e0e0e0;
    }

    .tour-andamanbliss-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #333;
        margin-bottom: 0.5rem;
    }

    .tour-andamanbliss-title span {
        color: #f9680f;
    }

    .tour-andamanbliss-text {
        color: #666;
        margin-bottom: 0;
        display: block;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
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

    /* Andamanbliss Modal */
    .tour-andamanbliss-modal {
        max-width: 1200px;
    }

    .tour-andamanbliss-modal .modal-header {
        border-bottom: 1px solid #eee;
        padding: 1rem 1.5rem;
        background-color: #fff;
    }

    .tour-andamanbliss-modal .modal-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #333;
    }

    .tour-andamanbliss-modal .modal-body {
        padding: 0;
        max-height: 70vh;
        overflow-y: auto;
    }

    .tour-andamanbliss-modal .modal-footer {
        border-top: 1px solid #eee;
        padding: 1rem 1.5rem;
        background-color: #fff;
    }

    .tour-andamanbliss-packages {
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        overflow: hidden;
        margin-bottom: 1.5rem;
    }

    .tour-andamanbliss-packages-header {
        display: flex;
        justify-content: space-between;
        background-color: #f8f9fa;
        padding: 0.75rem 1.5rem;
        border-bottom: 1px solid #e0e0e0;
    }

    .tour-andamanbliss-packages-header h3 {
        font-size: 1.1rem;
        font-weight: 600;
        color: #333;
        margin: 0;
    }

    .tour-andamanbliss-packages-header .duration-price {
        display: flex;
        gap: 14rem;
    }

    .tour-andamanbliss-packages-header .col {
        font-size: 1rem;
        font-weight: 600;
        color: #666;
        text-align: center;
    }

    .tour-andamanbliss-package-item {
        display: flex;
        align-items: center;
        padding: 0rem 1.5rem;
        transition: all 0.3s ease;
    }

    .tour-andamanbliss-package-item:last-child {
        border-bottom: none;
    }

    .tour-andamanbliss-package-item:hover {
        background-color: rgba(249, 104, 15, 0.05);
    }

    .tour-andamanbliss-package-name {
        flex: 1;
    }

    .tour-andamanbliss-package-name a {
        color: #f9680f;
        font-weight: 600;
        text-decoration: none;
        font-size: 12px;
    }

    .tour-andamanbliss-package-name a:hover {
        color: rgb(17, 157, 213);
        text-decoration: underline;
    }

    .tour-andamanbliss-package-duration,
    .tour-andamanbliss-package-price,
    .tour-andamanbliss-package-inclusion {
        width: 270px;
        text-align: right;
        font-weight: 500;
        font-size: 12px;
    }

    .tour-andamanbliss-package-duration {
        color: #666;
    }

    .tour-andamanbliss-package-price,
    .tour-andamanbliss-package-inclusion {
        color: #666;
    }

    .tour-andamanbliss-description,
    {
    padding: 1.5rem;
    color: #666;
    line-height: 1.6;
    }

    .tour-andamanbliss-description p {
        margin-bottom: 1rem;
        font-size: 14px;
    }

    .tour-andamanbliss-description a {
        color: rgb(17, 157, 213);
        font-weight: 600;
        text-decoration: none;
    }

    .tour-andamanbliss-description a:hover {
        color: #f9680f;
        text-decoration: underline;
    }

    .tour-andamanbliss-modal .btn-primary {
        background-color: rgb(17, 157, 213);
        border-color: rgb(17, 157, 213);
    }

    .tour-andamanbliss-modal .btn-primary:hover {
        background-color: #0e8bc0;
        border-color: #0e8bc0;
    }

    .tour-andamanbliss-modal .btn-secondary {
        background-color: #6c757d;
        border-color: #6c757d;
    }

    .tour-andamanbliss-modal .close {
        font-size: 1.5rem;
        color: #000;
        opacity: 0.5;
    }

    .hero-section {
        min-height: 80vh;
        background: linear-gradient(135deg, #1a1a1a 0%, #363636 100%);
        position: relative;
        overflow: hidden;
        padding: 120px 0 80px;
    }

    .hero-background {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: var(--color-primary-gradient);
        z-index: 1;
    }

    .hero-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxMDAlIiBoZWlnaHQ9IjEwMCUiPjxkZWZzPjxwYXR0ZXJuIGlkPSJwYXR0ZXJuIiB3aWR0aD0iNDAiIGhlaWdodD0iNDAiIHZpZXdCb3g9IjAgMCA0MCA0MCIgcGF0dGVyblVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgcGF0dGVyblRyYW5zZm9ybT0icm90YXRlKDQ1KSI+PHJlY3QgaWQ9InBhdHRlcm4tYmciIHdpZHRoPSI0MDAiIGhlaWdodD0iNDAwIiBmaWxsPSJyZ2JhKDI1NSwgMjU1LCAyNTUsIDAuMDMpIj48L3JlY3Q+PHBhdGggZmlsbD0icmdiYSgyNTUsIDI1NSwgMjU1LCAwLjA1KSIgZD0iTTAgMGg0MHY0MEgweiI+PC9wYXRoPjwvcGF0dGVybj48L2RlZnM+PHJlY3QgZmlsbD0idXJsKCNwYXR0ZXJuKSIgaGVpZ2h0PSIxMDAlIiB3aWR0aD0iMTAwJSI+PC9yZWN0Pjwvc3ZnPg==');
        opacity: 0.4;
        z-index: 1;
    }

    .hero-content {
        position: relative;
        z-index: 2;
        color: white;
    }

    .animate-fade-in {
        animation: fadeIn 1s ease-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .hero-badge {
        display: inline-block;
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(10px);
        padding: 10px 20px;
        border-radius: 30px;
        font-size: 14px;
        font-weight: 600;
        letter-spacing: 1px;
        text-transform: uppercase;
        margin-bottom: 25px;
        border-left: 3px solid var(--color-secondary);
    }

    .hero-title {
        font-size: 3.5rem;
        font-weight: 800;
        line-height: 1.2;
        margin-bottom: 25px;
        letter-spacing: -0.5px;
        color: white;
    }

   .text-gradient {
    background: linear-gradient(to right, #fff, var(--color-secondary));
    -webkit-background-clip: text;
    -webkit-text-fill-color: #ff5722ba;
   }

    .hero-description {
        font-size: 1.2rem;
        line-height: 1.6;
        margin-bottom: 35px;
        opacity: 0.9;
        max-width: 90%;
        color: white;
        font-weight: bold !important;
    }

    .hero-cta {
        display: flex;
        gap: 15px;
        margin-bottom: 40px;
    }

    .hero-stats {
        display: flex;
        gap: 30px;
    }

    .stat-item {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .stat-icon {
        width: 45px;
        height: 45px;
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(5px);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .stat-icon i {
        color: var(--color-secondary);
        font-size: 18px;
    }

    .stat-text {
        display: flex;
        flex-direction: column;
    }

    .stat-value {
        font-size: 1.2rem;
        font-weight: 700;
    }

    .stat-label {
        font-size: 0.85rem;
        opacity: 0.8;
    }

    .hero-gallery {
        position: relative;
        height: 500px;
    }

    .animate-slide-up {
        animation: slideUp 1.2s ease-out;
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(40px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .gallery-img {
        position: absolute;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 20px 30px rgba(0, 0, 0, 0.2);
        transition: all 0.5s ease;
    }

    .gallery-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .gallery-img-1 {
        width: 70%;
        height: 300px;
        top: 0;
        left: 0;
        z-index: 3;
    }

    .gallery-img-2 {
        width: 60%;
        height: 250px;
        top: 100px;
        right: 0;
        z-index: 2;
    }

    .gallery-img-3 {
        width: 50%;
        height: 200px;
        bottom: 0;
        left: 25%;
        z-index: 1;
    }

    .hero-gallery:hover .gallery-img-1 {
        transform: translateY(-10px) rotate(-2deg);
    }

    .hero-gallery:hover .gallery-img-2 {
        transform: translateY(10px) rotate(2deg);
    }

    .hero-gallery:hover .gallery-img-3 {
        transform: translateX(10px) rotate(-1deg);
    }

    .gallery-shape-1,
    .gallery-shape-2,
    .hero-shape-1,
    .hero-shape-2 {
        position: absolute;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.05);
        z-index: 0;
    }

    .gallery-shape-1 {
        width: 200px;
        height: 200px;
        top: -50px;
        right: -50px;
    }

    .gallery-shape-2 {
        width: 150px;
        height: 150px;
        bottom: 50px;
        left: -30px;
    }

    .hero-shape-1 {
        width: 300px;
        height: 300px;
        top: -100px;
        left: -100px;
    }

    .hero-shape-2 {
        width: 250px;
        height: 250px;
        bottom: -50px;
        right: -50px;
    }

    .scroll-indicator {
        position: absolute;
        bottom: 30px;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        flex-direction: column;
        align-items: center;
        color: white;
        opacity: 0.7;
        z-index: 2;
        animation: bounce 2s infinite;
    }

    @keyframes bounce {

        0%,
        20%,
        50%,
        80%,
        100% {
            transform: translateY(0) translateX(-50%);
        }

        40% {
            transform: translateY(-10px) translateX(-50%);
        }

        60% {
            transform: translateY(-5px) translateX(-50%);
        }
    }

    .mouse {
        width: 26px;
        height: 40px;
        border: 2px solid white;
        border-radius: 20px;
        position: relative;
        margin-bottom: 8px;
    }

    .wheel {
        width: 4px;
        height: 8px;
        background: white;
        position: absolute;
        top: 7px;
        left: 50%;
        transform: translateX(-50%);
        border-radius: 4px;
        animation: scroll 1.5s infinite;
    }

    @keyframes scroll {
        0% {
            opacity: 1;
            transform: translateX(-50%) translateY(0);
        }

        100% {
            opacity: 0;
            transform: translateX(-50%) translateY(15px);
        }
    }

    .scroll-text {
        font-size: 12px;
        letter-spacing: 1px;
        margin-top: 5px;
    }

    /* Features Section Styles */
    .features-section {
        padding: 35px 0;
        position: relative;
        background-color: var(--color-bg-light);
        overflow: hidden;
    }

    .section-header {
        margin-bottom: 60px;
        position: relative;
        z-index: 2;
    }

    .section-subtitle {
        display: inline-block;
        background: rgba(17, 157, 213, 0.1);
        color: var(--color-primary);
        padding: 8px 16px;
        border-radius: 30px;
        font-size: 14px;
        font-weight: 600;
        letter-spacing: 1px;
        text-transform: uppercase;
        margin-bottom: 15px;
    }

    .section-title {
        font-size: 2.5rem;
        font-weight: 800;
        margin-bottom: 20px;
        color: var(--color-heading);
        position: relative;
        display: block;
    }

    .section-description {
        font-size: 1.1rem;
        color: var(--color-text-light);
        max-width: 700px;
        margin: 0 auto;
    }

    .features-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 30px;
        position: relative;
        z-index: 2;
    }

    .feature-card {
        background: white;
        border-radius: 15px;
        padding: 40px 30px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        position: relative;
        overflow: hidden;
        transition: all 0.4s ease;
        z-index: 1;
        height: 100%;
    }

    .feature-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 40px rgba(17, 157, 213, 0.1);
    }

    .feature-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 0;
        background: var(--color-primary-gradient);
        transition: all 0.4s ease;
    }

    .feature-card:hover::before {
        height: 100%;
    }

    .feature-icon {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        background: var(--color-primary-gradient);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 25px;
        position: relative;
        z-index: 2;
        transition: all 0.4s ease;
    }

    .feature-card:hover .feature-icon {
        transform: scale(1.1) rotate(5deg);
    }

    .feature-icon i {
        font-size: 28px;
        color: white;
    }

    .feature-title {
        font-size: 1.3rem;
        font-weight: 700;
        margin-bottom: 15px;
        color: var(--color-text);
        position: relative;
        z-index: 2;
    }

    .feature-description {
        color: var(--color-text-light);
        line-height: 1.6;
        position: relative;
        z-index: 2;
    }

    .feature-bg {
        position: absolute;
        top: -50px;
        right: -50px;
        width: 150px;
        height: 150px;
        border-radius: 50%;
        background: rgba(17, 157, 213, 0.03);
        z-index: 0;
    }

    .section-shape-1,
    .section-shape-2 {
        position: absolute;
        border-radius: 50%;
        background: rgba(17, 157, 213, 0.03);
        z-index: 1;
    }

    .section-shape-1 {
        width: 400px;
        height: 400px;
        top: -200px;
        left: -200px;
    }

    .section-shape-2 {
        width: 300px;
        height: 300px;
        bottom: -100px;
        right: -100px;
    }

    @media (max-width: 992px) {
        .features-section {
            padding: 80px 0;
        }

        .section-title {
            font-size: 2.2rem;
        }

        .features-grid {
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        }
    }

    @media (max-width: 768px) {
        .features-section {
            padding: 60px 0;
        }

        .section-title {
            font-size: 1.8rem;
        }

        .section-description {
            font-size: 1rem;
        }

        .feature-card {
            padding: 30px 20px;
        }

        .feature-icon {
            width: 60px;
            height: 60px;
        }

        .feature-icon i {
            font-size: 24px;
        }
    }

    /* Testimonials Section Styles */
    .testimonials-section {
        padding: 35px 0;
        position: relative;
        background-color: white;
        overflow: hidden;
    }

    .testimonial-slider-container {
        position: relative;
        overflow: hidden;
        margin-bottom: 5px;
        z-index: 2;
        width: 100%;
    }

    .testimonial-slider {
        display: flex;
        transition: transform 0.5s ease;
        width: 100%;
    }

    .testimonial-card {
        background: white;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        position: relative;
        overflow: hidden;
        transition: all 0.4s ease;
        height: 100%;
        flex: 0 0 calc(33.333% - 20px);
        margin: 0 10px;
        max-width: calc(33.333% - 20px);
    }

    .testimonial-card-inner {
        padding: 30px 25px;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .testimonial-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 40px rgba(17, 157, 213, 0.1);
    }

    .testimonial-card.active-card {
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(17, 157, 213, 0.15);
        border-bottom: 3px solid #119dd5;
    }

    .testimonial-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 20px;
    }

    .testimonial-quote {
        font-size: 36px;
        color: rgba(17, 157, 213, 0.2);
    }

    .testimonial-content {
        flex: 1;
        margin-bottom: 20px;
    }

    .testimonial-rating {
        display: flex;
        align-items: center;
        margin-left: auto;
    }

    .testimonial-rating i {
        color: #FFD700;
        margin-right: 3px;
    }

    .testimonial-rating span {
        margin-left: 8px;
        font-weight: 600;
        color: var(--color-text-light);
    }

    .testimonial-text {
        font-size: 1.05rem;
        line-height: 1.7;
        color: var(--color-text);
        font-style: italic;
        margin: 0;
        position: relative;
        z-index: 2;
    }

    .testimonial-author {
        display: flex;
        align-items: center;
        margin-top: auto;
    }

    .author-image {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        overflow: hidden;
        margin-right: 15px;
        border: 3px solid rgba(17, 157, 213, 0.1);
    }

    .author-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .author-name {
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--color-text);
        margin-bottom: 5px;
    }

    .author-trip {
        font-size: 0.9rem;
        color: var(--color-text-light);
        margin: 0;
    }

    .testimonial-controls {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 20px;
        margin-top: 20px;
    }

    .control-prev,
    .control-next {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: white;
        border: none;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .control-prev:hover,
    .control-next:hover {
        background: var(--color-primary-gradient);
        transform: translateY(-3px);
    }

    .control-prev:hover i,
    .control-next:hover i {
        color: white;
    }

    .control-prev i,
    .control-next i {
        color: var(--color-primary);
        font-size: 14px;
    }

    .control-dots {
        display: flex;
        gap: 8px;
    }

    .dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background: rgba(17, 157, 213, 0.2);
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .dot.active {
        background: var(--color-primary);
        transform: scale(1.2);
    }

    .section-shape-3 {
        position: absolute;
        width: 350px;
        height: 350px;
        border-radius: 50%;
        background: rgba(17, 157, 213, 0.03);
        bottom: -150px;
        left: -150px;
        z-index: 1;
    }

    @media (max-width: 992px) {
        .testimonials-section {
            padding: 80px 0;
        }

        .testimonial-card {
            flex: 0 0 calc(50% - 20px);
            max-width: calc(50% - 20px);
        }
    }

    @media (max-width: 768px) {
        .testimonials-section {
            padding: 60px 0;
        }

        .testimonial-slider-container {
            padding: 0 15px;
        }

        .testimonial-card {
            flex: 0 0 calc(100% - 30px);
            max-width: calc(100% - 30px);
            margin: 0 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
        }

        .testimonial-card-inner {
            padding: 25px 20px;
        }

        .testimonial-text {
            font-size: 0.95rem;
            line-height: 1.6;
        }

        .testimonial-quote {
            font-size: 30px;
            top: 15px;
            right: 15px;
        }

        .testimonial-rating {
            margin-bottom: 15px;
        }

        .author-image {
            width: 50px;
            height: 50px;
        }

        .author-name {
            font-size: 1rem;
        }

        .author-trip {
            font-size: 0.8rem;
        }

        .testimonial-controls {
            margin-top: 25px;
        }

        .control-prev,
        .control-next {
            width: 36px;
            height: 36px;
        }

        /* Special styling for active card on mobile */
        .testimonial-card.active-card {
            transform: translateY(-8px);
            box-shadow: 0 15px 30px rgba(17, 157, 213, 0.2);
            border-bottom: 3px solid #119dd5;
        }

        .testimonial-card.active-card .testimonial-card-inner {
            background: linear-gradient(to bottom, white, rgba(17, 157, 213, 0.03));
        }

        /* Add pagination indicator for mobile */
        .testimonial-pagination-indicator {
            display: flex;
            justify-content: center;
            margin-top: 15px;
            font-size: 12px;
            color: #666;
        }
    }

    /* FAQ Section Styles */
    .faq-section {
        padding: 35px 0;
        position: relative;
        background-color: var(--color-bg-light);
        overflow: hidden;
    }

    .faq-container {
        max-width: 100%;
        margin: 0 auto;
        position: relative;
        z-index: 2;
    }

    .faq-item {
        margin-bottom: 20px;
        border-radius: 15px;
        background: white;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        overflow: hidden;
        transition: all 0.4s ease;
    }

    .faq-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(17, 157, 213, 0.1);
    }

    .faq-header {
        position: relative;
    }

    .faq-button {
        width: 100%;
        padding: 25px 30px;
        text-align: left;
        background: white;
        border: none;
        display: flex;
        align-items: center;
        justify-content: space-between;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .faq-button:hover {
        background: rgba(17, 157, 213, 0.03);
    }

    .faq-button:not(.collapsed) {
        background: rgba(17, 157, 213, 0.05);
    }

    .faq-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--color-text);
        flex: 1;
        padding-right: 20px;
    }

    .faq-button:not(.collapsed) .faq-title {
        color: var(--color-primary);
    }

    .faq-icon {
        width: 24px;
        height: 24px;
        position: relative;
        flex-shrink: 0;
    }

    .faq-icon i {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        transition: all 0.3s ease;
        color: var(--color-primary);
    }

    .faq-icon .fa-plus {
        opacity: 1;
    }

    .faq-icon .fa-minus {
        opacity: 0;
    }

    .faq-button:not(.collapsed) .faq-icon .fa-plus {
        opacity: 0;
    }

    .faq-button:not(.collapsed) .faq-icon .fa-minus {
        opacity: 1;
    }

    .faq-body {
        padding: 0 30px 25px;
    }

    .faq-body p {
        color: var(--color-text-light);
        line-height: 1.7;
        margin-bottom: 0;
    }

    .section-shape-4 {
        position: absolute;
        width: 400px;
        height: 400px;
        border-radius: 50%;
        background: rgba(17, 157, 213, 0.03);
        top: -200px;
        right: -200px;
        z-index: 1;
    }

    @media (max-width: 992px) {
        .faq-section {
            padding: 80px 0;
        }

        .faq-button {
            padding: 20px 25px;
        }

        .faq-title {
            font-size: 1rem;
        }

        .faq-body {
            padding: 0 25px 20px;
        }
    }

    @media (max-width: 768px) {
        .faq-section {
            padding: 60px 0;
        }

        .faq-button {
            padding: 15px 20px;
        }

        .faq-body {
            padding: 0 20px 15px;
        }
    }

    /* Packages Section Styles */
    .packages-section {
        padding: 35px 0;
        position: relative;
        background-color: white;
        overflow: hidden;
    }

    .packages-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        gap: 30px;
        position: relative;
        z-index: 2;
    }

    .package-card {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        position: relative;
        transition: all 0.4s ease;
        height: 100%;
    }

    .package-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(17, 157, 213, 0.1);
    }

    .package-image {
        position: relative;
        height: 220px;
        overflow: hidden;
    }

    .package-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: all 0.5s ease;
    }

    .package-card:hover .package-image img {
        transform: scale(1.1);
    }

    .package-tag {
        position: absolute;
        top: 20px;
        right: 20px;
        background: var(--color-secondary-gradient);
        color: white;
        padding: 8px 15px;
        border-radius: 30px;
        font-size: 0.8rem;
        font-weight: 600;
        box-shadow: 0 5px 15px rgba(249, 104, 15, 0.3);
        z-index: 2;
    }

    .package-content {
        padding: 30px;
        position: relative;
    }

    .package-title {
        font-size: 1.4rem;
        font-weight: 700;
        color: var(--color-text);
        margin-bottom: 15px;
    }

    .package-price {
        display: flex;
        align-items: baseline;
        margin-bottom: 15px;
    }

    .price {
        font-size: 1.8rem;
        font-weight: 800;
        color: var(--color-primary);
    }

    .per-person {
        font-size: 0.9rem;
        color: var(--color-text-light);
        margin-left: 8px;
    }

    .package-description {
        color: var(--color-text-light);
        margin-bottom: 20px;
        line-height: 1.6;
    }

    .package-features {
        list-style: none;
        padding: 0;
        margin-bottom: 25px;
    }

    .package-features li {
        display: flex;
        align-items: center;
        margin-bottom: 12px;
        color: var(--color-text);
    }

    .package-features li i {
        color: var(--color-primary);
        margin-right: 10px;
        font-size: 1rem;
    }

    .package-footer {
        margin-top: auto;
    }

    .package-shape {
        position: absolute;
        bottom: -30px;
        right: -30px;
        width: 100px;
        height: 100px;
        border-radius: 50%;
        background: rgba(17, 157, 213, 0.03);
        z-index: 0;
    }

    @media (max-width: 1200px) {
        .packages-grid {
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        }
    }

    @media (max-width: 992px) {
        .packages-section {
            padding: 80px 0;
        }

        .packages-grid {
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        }

        .package-image {
            height: 200px;
        }

        .package-content {
            padding: 25px;
        }

        .package-title {
            font-size: 1.3rem;
        }

        .price {
            font-size: 1.6rem;
        }
    }

    @media (max-width: 768px) {
        .packages-section {
            padding: 60px 0;
        }

        .packages-grid {
            grid-template-columns: 1fr;
            max-width: 450px;
            margin: 0 auto;
        }

        .package-content {
            padding: 20px;
        }

        .package-title {
            font-size: 1.2rem;
        }

        .price {
            font-size: 1.5rem;
        }
    }

    /* CTA Section Styles */
    .cta-wrapper {
        margin: 80px 0;
        position: relative;
        z-index: 2;
    }

    .cta-box {
        background: var(--color-primary-gradient);
        border-radius: 20px;
        overflow: hidden;
        position: relative;
        display: flex;
        min-height: 350px;
        box-shadow: 0 20px 40px rgba(17, 157, 213, 0.15);
    }

    .cta-content {
        padding: 60px;
        flex: 1;
        color: white;
        position: relative;
        z-index: 2;
    }

    .cta-title {
        font-size: 2.2rem;
        font-weight: 800;
        margin-bottom: 20px;
        line-height: 1.3;
        color: #fff;
    }

    .cta-description {
        font-size: 1.1rem;
        margin-bottom: 30px;
        opacity: 0.9;
        max-width: 500px;
    }

    .cta-buttons {
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
    }

    .cta-image {
        width: 40%;
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .cta-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: all 0.5s ease;
    }

    .cta-box:hover .cta-image img {
        transform: scale(1.1);
    }

    .cta-shape-1,
    .cta-shape-2 {
        position: absolute;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.1);
        z-index: 1;
    }

    .cta-shape-1 {
        width: 200px;
        height: 200px;
        top: -100px;
        left: -50px;
    }

    .cta-shape-2 {
        width: 150px;
        height: 150px;
        bottom: -50px;
        right: 40%;
    }

    @media (max-width: 992px) {
        .cta-wrapper {
            margin: 60px 0;
        }

        .cta-box {
            flex-direction: column;
        }

        .cta-content {
            padding: 40px;
            width: 100%;
        }

        .cta-title {
            font-size: 1.8rem;
        }

        .cta-description {
            font-size: 1rem;
        }

        .cta-image {
            width: 100%;
            height: 250px;
            order: -1;
        }
    }

    @media (max-width: 768px) {
        .cta-wrapper {
            margin: 40px 0;
        }

        .cta-content {
            padding: 30px;
        }

        .cta-title {
            font-size: 1.5rem;
        }

        .cta-image {
            height: 200px;
        }

        .cta-buttons {
            flex-direction: column;
            gap: 10px;
        }
    }

    .z-2 {
        z-index: 2;
        position: relative;
    }

    /* Duration Comparison Section Styles */
    .duration-section {
        padding: 35px 0;
        position: relative;
        background-color: var(--color-bg-light);
        overflow: hidden;
    }

    .duration-tabs {
        display: flex;
        justify-content: center;
        margin-bottom: 40px;
        position: relative;
        z-index: 2;
    }

    .duration-tab {
        padding: 12px 25px;
        background: white;
        border: none;
        border-radius: 30px;
        margin: 0 10px;
        font-weight: 600;
        color: var(--color-text);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .duration-tab::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: var(--color-primary-gradient);
        opacity: 0;
        transition: opacity 0.3s ease;
        z-index: -1;
    }

    .duration-tab:hover::before,
    .duration-tab.active::before {
        opacity: 1;
    }

    .duration-tab:hover,
    .duration-tab.active {
        color: white;
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(17, 157, 213, 0.2);
    }

    .duration-content {
        max-width: 1000px;
        margin: 0 auto;
        position: relative;
        z-index: 2;
    }

    .duration-card {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.05);
        margin-bottom: 30px;
        display: flex;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        border: 3px solid transparent;
    }

    .duration-card:hover,
    .duration-card.highlighted {
        transform: translateY(-10px);
        box-shadow: 0 20px 50px rgba(17, 157, 213, 0.1);
    }

    .duration-card.highlighted {
        border: 3px solid var(--color-primary);
        transform: translateY(-15px) scale(1.02);
        box-shadow: 0 25px 60px rgba(17, 157, 213, 0.15);
        position: relative;
        z-index: 5;
    }

    .duration-image {
        width: 30%;
        position: relative;
        overflow: hidden;
    }

    .duration-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: all 0.5s ease;
    }

    .duration-card:hover .duration-image img {
        transform: scale(1.1);
    }

    .duration-details {
        width: 70%;
        padding: 30px;
        display: flex;
        flex-direction: column;
    }

    .duration-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .duration-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--color-text);
        margin: 0;
    }

    .duration-price {
        background: rgba(17, 157, 213, 0.1);
        padding: 8px 15px;
        border-radius: 30px;
        color: var(--color-primary);
        font-weight: 700;
        font-size: 1.1rem;
    }

    .duration-features {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 15px;
        margin-bottom: 25px;
    }

    .duration-feature {
        display: flex;
        align-items: center;
    }

    .duration-feature i {
        width: 28px;
        height: 28px;
        background: var(--color-secondary-gradient);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        margin-right: 10px;
        font-size: 0.8rem;
    }

    .duration-feature span {
        color: var(--color-text);
        font-size: 0.95rem;
    }

    .duration-footer {
        margin-top: auto;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .duration-rating {
        display: flex;
        align-items: center;
    }

    .duration-rating i {
        color: #FFD700;
        margin-right: 2px;
    }

    .duration-rating span {
        margin-left: 5px;
        font-weight: 600;
        color: var(--color-text-light);
    }

    .duration-cta {
        background: var(--color-secondary-gradient);
        color: white;
        border: none;
        padding: 10px 25px;
        border-radius: 30px;
        font-weight: 600;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
    }

    .duration-cta:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(249, 104, 15, 0.3);
        color: white;
    }

    .duration-badge {
        position: absolute;
        top: 15px;
        left: 15px;
        background: var(--color-secondary-gradient);
        color: white;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        z-index: 2;
    }

    .duration-shape-1,
    .duration-shape-2 {
        position: absolute;
        border-radius: 50%;
        background: rgba(17, 157, 213, 0.03);
        z-index: 1;
    }

    .duration-shape-1 {
        width: 400px;
        height: 400px;
        top: -200px;
        right: -200px;
    }

    .duration-shape-2 {
        width: 300px;
        height: 300px;
        bottom: -100px;
        left: -100px;
    }

    @media (max-width: 992px) {
        .duration-card {
            flex-direction: column;
        }

        .duration-image {
            width: 100%;
            height: 200px;
        }

        .duration-details {
            width: 100%;
        }

        .duration-features {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 768px) {
        .duration-tabs {
            flex-wrap: wrap;
            gap: 10px;
        }

        .duration-tab {
            margin: 5px;
        }

        .duration-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .duration-price {
            margin-top: 10px;
        }

        .duration-footer {
            flex-direction: column;
            align-items: flex-start;
            gap: 15px;
        }
    }

    .cta-section {
        background: var(--color-primary-gradient);
    }

    .hero-image-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
        position: relative;
    }

    .hero-image-grid img {
        width: 100%;
        height: 300px;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .hero-image-grid .img-1 {
        grid-column: 1 / -1;
        transform: translateY(-20px);
    }

    .hero-image-grid .img-2 {
        transform: translateX(-20px);
    }

    .hero-image-grid .img-3 {
        transform: translateX(20px);
    }

    .hero-image-grid img:hover {
        transform: scale(1.05);
    }

    .package-gallery {
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .thumbnail-item {
        cursor: pointer;
        transition: transform 0.3s ease;
    }

    .thumbnail-item:hover {
        transform: scale(1.05);
    }

    .carousel-item img {
        height: 500px;
        object-fit: cover;
    }

    .thumbnail-item img {
        height: 150px;
        object-fit: cover;
    }

    .rating .fas.fa-star {
        font-size: 1.2rem;
    }

    .badge {
        font-size: 0.9rem;
        font-weight: 500;
        letter-spacing: 0.5px;
        background: var(--color-secondary-gradient);
        color: white;
    }

    .breadcrumb-item a {
        color: #0d6efd;
        transition: color 0.3s ease;
        text-decoration: none;
    }

    .breadcrumb-item a:hover {
        color: #0a58ca;
    }

    .btn-primary {
        background: var(--color-secondary-gradient);
        border: none;
        transition: var(--transition-fast);
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(13, 110, 253, 0.2);
        color: #ffffff;
    }

    .btn-outline-light {
        transition: transform 0.3s ease;
    }

    .btn-outline-light:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(255, 255, 255, 0.1);
    }
</style>
@endpush


@push('scripts')
<script type="text/javascript">
    $(document).ready(function () {
        // Infinite testimonial slider with 6 cards
        const slider = $('#testimonialSlider');
        const cards = slider.find('.testimonial-card');
        const dotsContainer = $('#testimonialDots');
        const prevBtn = $('#testimonialPrev');
        const nextBtn = $('#testimonialNext');

        // Clone cards for infinite scrolling
        cards.each(function () {
            $(this).clone().appendTo(slider);
        });

        // Get updated cards after cloning
        const allCards = slider.find('.testimonial-card');

        // Variables
        let currentIndex = 0;
        const originalCardsCount = cards.length;
        let cardWidth, containerWidth, visibleCards, maxIndex;
        let isAnimating = false;

        // Calculate dimensions and limits
        function calculateDimensions() {
            // Reset any inline styles first
            slider.find('.testimonial-card').removeAttr('style');
            slider.find('.testimonial-card').css('display', 'flex');

            // Get container width first
            containerWidth = slider.parent().width();

            // Determine how many cards are visible based on screen size
            if (window.innerWidth <= 768) {
                visibleCards = 1;
                // Mobile view - single card with proper spacing
                slider.find('.testimonial-card').css({
                    'flex': '0 0 calc(100% - 30px)',
                    'max-width': 'calc(100% - 30px)',
                    'margin': '0 15px'
                });
            } else if (window.innerWidth <= 992) {
                visibleCards = 2;
                // Tablet view - two cards
                slider.find('.testimonial-card').css({
                    'flex': '0 0 calc(50% - 20px)',
                    'max-width': 'calc(50% - 20px)',
                    'margin': '0 10px'
                });
            } else {
                visibleCards = 3;
                // Desktop view - three cards
                slider.find('.testimonial-card').css({
                    'flex': '0 0 calc(33.333% - 20px)',
                    'max-width': 'calc(33.333% - 20px)',
                    'margin': '0 10px'
                });
            }

            // Now get the actual card width after CSS adjustments
            cardWidth = allCards.first().outerWidth(true);

            // Calculate maximum index (original cards count)
            maxIndex = originalCardsCount;

            console.log('Screen width:', window.innerWidth);
            console.log('Container width:', containerWidth);
            console.log('Card width:', cardWidth);
            console.log('Visible cards:', visibleCards);
        }

        // Create dots based on original cards count
        function createDots() {
            dotsContainer.empty();

            for (let i = 0; i < originalCardsCount; i++) {
                dotsContainer.append(
                    `<div class="dot ${i === currentIndex % originalCardsCount ? 'active' : ''}" data-index="${i}"></div>`
                );
            }
        }

        // Update slider position with smooth transition
        function updateSlider(withAnimation = true) {
            if (isAnimating) return;

            // Recalculate dimensions to ensure proper sizing
            if (!withAnimation) {
                calculateDimensions();
            }

            // Update active dot
            dotsContainer.find('.dot').removeClass('active');
            dotsContainer.find(`.dot[data-index="${currentIndex % originalCardsCount}"]`).addClass('active');

            // Calculate the translation value based on current card width
            const translateValue = -currentIndex * cardWidth;

            // Add a class to the current active card for mobile styling
            slider.find('.testimonial-card').removeClass('active-card');
            slider.find('.testimonial-card').eq(currentIndex).addClass('active-card');

            // Update pagination indicator for mobile
            $('#currentSlideIndicator').text((currentIndex % originalCardsCount) + 1);
            $('#totalSlidesIndicator').text(originalCardsCount);

            if (withAnimation) {
                isAnimating = true;
                slider.css('transition', 'transform 0.5s ease-out');
                slider.css('transform', `translateX(${translateValue}px)`);

                // After animation completes
                setTimeout(function () {
                    isAnimating = false;

                    // If we've scrolled past the original set, reset to the clone
                    if (currentIndex >= originalCardsCount) {
                        slider.css('transition', 'none');
                        currentIndex = currentIndex % originalCardsCount;
                        slider.css('transform', `translateX(${-currentIndex * cardWidth}px)`);

                        // Update active card after reset
                        slider.find('.testimonial-card').removeClass('active-card');
                        slider.find('.testimonial-card').eq(currentIndex).addClass('active-card');

                        // Update pagination indicator after reset
                        $('#currentSlideIndicator').text(currentIndex + 1);
                    }

                    // If we've scrolled to the beginning of the clone set, reset to the original
                    if (currentIndex < 0) {
                        slider.css('transition', 'none');
                        currentIndex = originalCardsCount - Math.abs(currentIndex % originalCardsCount);
                        slider.css('transform', `translateX(${-currentIndex * cardWidth}px)`);

                        // Update active card after reset
                        slider.find('.testimonial-card').removeClass('active-card');
                        slider.find('.testimonial-card').eq(currentIndex).addClass('active-card');

                        // Update pagination indicator after reset
                        $('#currentSlideIndicator').text(currentIndex + 1);
                    }
                }, 500);
            } else {
                slider.css('transition', 'none');
                slider.css('transform', `translateX(${translateValue}px)`);
            }
        }

        // Next slide with infinite scrolling
        function nextSlide() {
            if (isAnimating) return;
            currentIndex++;
            updateSlider();
        }

        // Previous slide with infinite scrolling
        function prevSlide() {
            if (isAnimating) return;
            currentIndex--;
            updateSlider();
        }

        // Initialize slider
        calculateDimensions();
        createDots();
        updateSlider(false);

        // Event listeners
        nextBtn.on('click', function () {
            clearInterval(autoSlideInterval);
            nextSlide();
            startAutoSlide();
        });

        prevBtn.on('click', function () {
            clearInterval(autoSlideInterval);
            prevSlide();
            startAutoSlide();
        });

        dotsContainer.on('click', '.dot', function () {
            if (isAnimating) return;
            clearInterval(autoSlideInterval);

            const dotIndex = parseInt($(this).data('index'));
            currentIndex = dotIndex;
            updateSlider();
            startAutoSlide();
        });

        // Handle window resize with debounce for better performance
        let resizeTimer;
        $(window).on('resize', function () {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(function () {
                // Store current index before recalculating
                const currentActiveIndex = currentIndex % originalCardsCount;

                // Reset to the active slide's position
                currentIndex = currentActiveIndex;

                // Recalculate everything
                calculateDimensions();
                createDots();
                updateSlider(false);
            }, 250);
        });

        // Auto-slide functionality
        let autoSlideInterval;

        function startAutoSlide() {
            autoSlideInterval = setInterval(function () {
                nextSlide();
            }, 5000);
        }

        // Start auto-sliding
        startAutoSlide();

        // Pause auto-sliding when user interacts
        $('.testimonial-slider-container').on('mouseenter', function () {
            clearInterval(autoSlideInterval);
        }).on('mouseleave', function () {
            startAutoSlide();
        });

        // Touch swipe functionality
        let touchStartX = 0;
        let touchEndX = 0;

        slider.on('touchstart', function (e) {
            touchStartX = e.originalEvent.touches[0].clientX;
            clearInterval(autoSlideInterval);
        });

        slider.on('touchend', function (e) {
            touchEndX = e.originalEvent.changedTouches[0].clientX;

            // Determine swipe direction
            if (touchStartX - touchEndX > 50) { // Swipe left
                nextSlide();
            } else if (touchEndX - touchStartX > 50) { // Swipe right
                prevSlide();
            }

            // Restart auto-slide
            startAutoSlide();
        });

        // Initialize AOS animation library
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true
        });
    });

    // SIMPLE DIRECT APPROACH FOR DURATION TABS
    // This code is placed outside document.ready to ensure it's not nested
    document.addEventListener('DOMContentLoaded', function () {
        // Get all tab buttons and cards
        var tabs = document.querySelectorAll('.duration-tab');
        var cards = document.querySelectorAll('.duration-card');

        // Add click event to each tab
        tabs.forEach(function (tab) {
            tab.addEventListener('click', function () {
                var duration = this.getAttribute('data-duration');
                console.log('Tab clicked:', duration);

                // Remove active class from all tabs
                tabs.forEach(function (t) {
                    t.classList.remove('active');
                });

                // Add active class to clicked tab
                this.classList.add('active');

                // Remove highlighted class from all cards
                cards.forEach(function (card) {
                    card.classList.remove('highlighted');
                });

                // Find the matching card and highlight it
                var selectedCard = document.querySelector('.duration-card[data-duration="' +
                    duration + '"]');
                if (selectedCard) {
                    selectedCard.classList.add('highlighted');

                    // On mobile, show only the selected card
                    if (window.innerWidth < 992) {
                        cards.forEach(function (card) {
                            card.style.display = 'none';
                        });
                        selectedCard.style.display = 'flex';
                    } else {
                        // On desktop, show all cards
                        cards.forEach(function (card) {
                            card.style.display = 'flex';
                        });
                    }
                }
            });
        });

        // Handle initial state
        function handleResponsiveDisplay() {
            var activeTab = document.querySelector('.duration-tab.active');
            var activeDuration = activeTab ? activeTab.getAttribute('data-duration') : '3';

            if (window.innerWidth < 992) {
                cards.forEach(function (card) {
                    card.style.display = 'none';
                });
                var activeCard = document.querySelector('.duration-card[data-duration="' + activeDuration +
                    '"]');
                if (activeCard) {
                    activeCard.style.display = 'flex';
                }
            } else {
                cards.forEach(function (card) {
                    card.style.display = 'flex';
                });
            }
        }

        // Initial setup
        handleResponsiveDisplay();

        // Handle window resize
        window.addEventListener('resize', handleResponsiveDisplay);
    });

    document.addEventListener("DOMContentLoaded", function () {
        const tabs = document.querySelectorAll(".duration-tab");
        const contentContainer = document.querySelector(".duration-content");

        tabs.forEach(tab => {
            tab.addEventListener("click", function () {
                // Remove active class from all tabs
                tabs.forEach(t => t.classList.remove("active"));
                this.classList.add("active");

                const selectedDuration = this.getAttribute("data-duration");

                // Get all duration cards
                const cards = Array.from(contentContainer.querySelectorAll(".duration-card"));

                // Sort cards: matching duration goes first
                cards.sort((a, b) => {
                    const aMatch = a.getAttribute("data-duration") ===
                        selectedDuration ?
                        0 : 1;
                    const bMatch = b.getAttribute("data-duration") ===
                        selectedDuration ?
                        0 : 1;
                    return aMatch - bMatch;
                });

                // Clear and re-append cards
                contentContainer.innerHTML = "";
                cards.forEach(card => contentContainer.appendChild(card));
            });
        });
    });

    document.addEventListener('DOMContentLoaded', function () {
        var andamanblissModal = document.getElementById('andamanblissModal');
        if (andamanblissModal) {
            andamanblissModal.addEventListener('shown.bs.modal', function () {
                console.log('Andamanbliss modal opened');
            });
        }
    });
</script>
@endpush