@extends('layouts.app')
@section('title', @$activity->meta->meta_title ?? @$activity->service_name)
@section('keywords', @$activity->meta->meta_keywords)
@section('description', @$activity->meta->meta_description)
@section('meta_schema')
{!! $activity->meta->meta_schema ?? '' !!}
@endsection
@section('og_title', @$activity->meta->og_title)
@section('og_description', @$activity->meta->og_description)
@section('og_type', @$activity->meta->og_type)
@section('og_image', @$activity->meta->og_image)
@section('twitter_card', @$activity->meta->twitter_card)
@section('twitter_title', @$activity->meta->twitter_title)
@section('twitter_desc', @$activity->meta->twitter_desc)
@section('twitter_image', @$activity->meta->twitter_image)



@section('content')
<!-- Hero Section -->
<div class="hero-banner position-relative">
    <!-- Background Image with Overlay -->
    <div class="banner-bg-container position-absolute w-100 h-100">
        <div class="banner-overlay position-absolute w-100 h-100"></div>
        <div class="banner-image position-absolute w-100 h-100"
            style="background: url('{{ $activity['activityPhotos'][0]['file'] ?? '' }}') no-repeat center/cover;">
        </div>
    </div>


    <!-- Floating Elements -->
    <div class="floating-elements">
        <div class="floating-bubble bubble-1"></div>
        <div class="floating-bubble bubble-2"></div>
        <div class="floating-bubble bubble-3"></div>
        <div class="floating-fish fish-1"></div>
        <div class="floating-fish fish-2"></div>
    </div>

    <!-- Main Content -->
    <div class="container position-relative" style="z-index: 5;">
        <!-- Top Navigation Bar -->
        <div class="banner-nav-container py-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent p-0 mb-0">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-white">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('/activities') }}" class="text-white">Activities</a>
                    </li>
                </ol>
            </nav>
        </div>

        <!-- Banner Content -->
        <div class="row align-items-center pb-5 mt-1">
            <div class="col-lg-7">
                <!-- Banner Content Left -->
                <div class="banner-content">
                    <!-- Badges -->
                    <div class="banner-badges d-flex flex-wrap gap-2 mb-3">
                        <div class="banner-badge">
                            <i class="fas fa-award"></i>
                            <span>Top Rated</span>
                        </div>
                        <div class="banner-badge">
                            <i class="fas fa-bolt"></i>
                            <span>Instant Confirmation</span>
                        </div>
                        <div class="banner-badge">
                            <i class="fas fa-shield-alt"></i>
                            <span>Safety Assured</span>
                        </div>
                    </div>

                    <!-- Title -->
                    @php
                    $word = explode(' ', @$activity->title ?? @$activity->name);
                    $highlight = implode(' ', array_slice($word, 0, -2));
                    $title = implode(' ', array_slice($word, -2));
                    @endphp
                    <h1 class="banner-title mb-3">{{ @$highlight }} <span class="highlight">{{ $title }}</span>
                    </h1>

                    <!-- Description -->
                    <p class="banner-description mb-4">
                        {{ Str::words(@$activity->description) ??
                                'Experience the
                                                                                                                                                                                                                                                                                                                                                                        thrill of scuba diving in the crystal-clear waters of Neil Island. Our expert instructors will
                                                                                                                                                                                                                                                                                                                                                                        guide you through an unforgettable underwater adventure, showcasing vibrant coral reefs and
                                                                                                                                                                                                                                                                                                                                                                        diverse marine life. Book your spot now!' }}
                    </p>

                    <!-- Meta Info -->
                    <div class="banner-meta d-flex flex-wrap gap-4 mb-4" style="min-height: 80px;">
                        <div class="meta-item d-flex align-items-center gap-1 align-content-center">
                            <div class="meta-icon">
                                <i class="fa-solid fa-location-dot"></i>
                            </div>
                            <div class="meta-text">
                                <span class="meta-label">Location</span>
                                <span class="meta-value">{{ ucwords($activity->location) }}</span>
                            </div>
                        </div>

                        <div class="meta-item d-flex align-items-center gap-1 align-content-center">
                            <div class="meta-icon">
                                <i class="fa-regular fa-clock"></i>
                            </div>
                            <div class="meta-text">
                                <span class="meta-label">Duration</span>
                                <span class="meta-value">{{ $activity->duration ?? '2 - 3 Hours' }}</span>
                            </div>
                        </div>

                        <div class="meta-item d-flex align-items-center gap-1 align-content-center">
                            <div class="meta-icon">
                                <i class="fas fa-star"></i>
                            </div>
                            <div class="meta-text">
                                <span class="meta-label">Rating</span>
                                <span class="meta-value">{{ $activity->rating }} +</span>
                            </div>
                        </div>
                    </div>


                    <!-- CTA Buttons -->
                    <div class="banner-cta d-flex flex-wrap gap-3">
                        <a href="#booking" class="btn-primary-action">
                            <i class="fas fa-calendar-check"></i>
                            <span>Book Now</span>
                        </a>
                        <a href="#" class="btn-secondary-action" id="openGalleryBtn">
                            <div class="gallery-btn-thumbnail">
                                <div class="thumbnail-icon">
                                    <img src="https://img.freepik.com/free-photo/man-snorkeling-clear-blue-sea-water_335224-431.jpg"
                                        alt="Gallery">
                                </div>
                                <span>View Gallery</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Banner Content Right - Price Card -->
            <div class="col-lg-5">
                <div class="banner-price-card">
                    <div class="price-card-header">
                        <div class="price-title">{{ $activity->facilities[0]['title'] ?? 'Special Offer' }}</div>
                        <div class="price-subtitle">{!! $activity->facilities[0]['sub_title'] ?? 'Limited Time Deal' !!}
                        </div>
                    </div>

                    <div class="price-card-body">
                        <div class="price-tag-container">
                            <div class="banner-price-row">
                                <div class="banner-price-left">
                                    <span class="currency">₹</span>
                                    <span class="amount">
                                        {{ number_format($activity->adult_cost - $activity->adult_cost * ($activity->discount / 100), 2) }}
                                    </span>
                                    <span class="unit">per person</span>
                                </div>

                                @if ($activity->discount)
                                <div class="banner-discount-badge">{{ $activity->discount }}% OFF</div>
                                @endif
                            </div>

                            @if ($activity->discount)
                            <div class="original-price">
                                <span class="label">Regular Price:</span>
                                <span class="value">₹{{ number_format($activity->adult_cost, 2) }}</span>
                            </div>
                            @endif
                        </div>


                        <div class="price-features">
                            @foreach ($activity->facilities as $facility)
                            <div class="feature-item">
                                <i class="fas fa-check-circle"></i>
                                <span>{{ ucfirst($facility->name) }}</span>
                            </div>
                            @endforeach

                        </div>

                        <a href="#booking" class="price-card-cta">
                            <span>Book This Experience</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>

                    <div class="price-card-footer">
                        <div class="timer-container">
                            <span>{!! $activity->facilities[0]['bottom_title'] ?? 'Offer ends in: <strong>2 days 14
                                    hours</strong>' !!}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Wave Separator -->
    <div class="banner-wave-bottom">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" preserveAspectRatio="none"
            style="width: 100%; height: 200px;">
            <path fill="#ffffff" fill-opacity="1"
                d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,149.3C960,160,1056,160,1152,138.7C1248,117,1344,75,1392,53.3L1440,32L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z">
            </path>
        </svg>
    </div>
</div>

<!-- Main Content -->
<div class="main-content py-3 " style="margin-top: -50px; ">
    <div class="container">
        <!-- Quick Info Cards -->


        <div class="row">
            <!-- Left Content -->
            <div class="quick-info-section mb-3">
                <div class="row g-4">
                    @if ($activity['infoBlocks'])
                    @foreach ($activity['infoBlocks'] as $info)
                    <div class="col-md-3 col-6">
                        <div class="quick-info-card">
                            <div class="info-icon">
                                {!! $info->icon !!}
                            </div>
                            <div class="info-content">
                                <h3>{{ ucwords($info->name) }}</h3>
                                <p>{{ $info->description }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach

                    @endif

                </div>
            </div>
            <div class="col-lg-8">
                <!-- Overview Section -->
                <section class="overview-section mb-3" id="overview">
                    <div class="section-header d-flex align-items-center mb-4">
                        <div class="section-icon">
                            <i class="fas fa-info-circle"></i>
                        </div>
                        <h2 class="section-title mb-0">Overview</h2>
                    </div>

                    <div>
                        <div class="read-more-container">
                            <div class="overview-descriptions" id="overviewContent" style="text-align:justify">
                                @php
                                    $overview = $activity->overview;
                                    if (preg_match('/<p\b[^>]*>.*?<\/p>/is', $overview, $match)) {
                                        $first = $match[0];
                                        $rest = trim(str_replace($first, '', $overview));
                                    } else {
                                        $split = preg_split('/(\. )/', $overview, 2, PREG_SPLIT_DELIM_CAPTURE);
                                        $first = ($split[0] ?? '') . ($split[1] ?? '');
                                        $rest = $split[2] ?? '';
                                    }
                                @endphp

                                {!! $first !!}
                                @if (!empty($rest))
                                    <div class="more-text">
                                        {!! $rest !!}
                                    </div>
                                @endif
                            </div>
                            <button id="toggleBtn" class="mt-2 p-0">Read more</button>
                        </div>

                        <div class="overview-video-container mb-4">
    @php
        $videoUrl = $activity['video_url'] ?? null;
        $poster = asset($activity->activityPhotos[0]->file ?? 'default.jpg');
    @endphp

    @if (!$videoUrl)
        <div class="position-relative" style="width: 100%; padding-top: 56.25%;">
            <img src="{{ $poster }}"
                class="position-absolute top-0 start-0 w-100 h-100 rounded-4"
                style="object-fit: cover;" alt="{{ $activity->slug }}" />
        </div>
    @elseif(Str::contains($videoUrl, 'youtu.be') || Str::contains($videoUrl, 'youtube.com'))
        @php
            preg_match('/(?:youtu\.be\/|v=)([^\?&]+)/', $videoUrl, $ytMatches);
            $ytId = $ytMatches[1] ?? null;
        @endphp

        @if ($ytId)
            <div class="position-relative video-wrapper" style="width: 100%; padding-top: 40%;">
              <iframe class="lazy-video position-absolute top-0 start-0 w-100 h-100 rounded-4"
    data-src="https://www.youtube.com/embed/{{ $ytId }}?autoplay=1&mute=1&loop=1&playlist={{ $ytId }}&controls=0&disablekb=1"
    frameborder="0" allow="autoplay; encrypted-media" allowfullscreen>
</iframe>


            </div>
        @endif
    @elseif(Str::contains($videoUrl, 'drive.google.com'))
        @php
            preg_match('/\/d\/(.*?)\//', $videoUrl, $driveMatches);
            $googleFileId = $driveMatches[1] ?? null;
        @endphp

        @if ($googleFileId)
            <div class="position-relative video-wrapper" style="width: 100%; padding-top: 40.25%;">
              <iframe
    src="https://drive.google.com/file/d/{{ $googleFileId }}/preview"
    frameborder="0"
    allow="autoplay"
    allowfullscreen
    loading="lazy"
    class="position-absolute top-0 start-0 w-100 h-100 rounded-4">
</iframe>

            </div>
        @endif
    @else
        <div class="position-relative video-wrapper" style="width: 100%; padding-top: 56.25%;">
         <video class="lazy-video position-absolute top-0 start-0 w-100 h-100 rounded-4"
    muted playsinline autoplay loop style="object-fit: cover;" preload="none"
    data-src="{{ $videoUrl }}">
</video>

        </div>
    @endif
</div>




                        @if ($activity['highlights'])
                        @php
                        $highlights = collect($activity['highlights']);
                        $firstHighlight = $highlights->first();
                        @endphp
                        @if (!empty($firstHighlight['title']))
                        <div class="highlights mb-4">
                            <h3 class="section-title h3 mb-2">{!! ucwords($firstHighlight['title']) !!}</h3>
                            <div class="row g-3">
                                @foreach ($highlights->chunk(ceil($highlights->count() / 2)) as $chunk)
                                <div class="col-md-6">
                                    <ul class="feature-list">
                                        @foreach ($chunk as $highlight)
                                        <li>
                                            <div class="feature-icon">
                                                {!!$highlight['icon']!!}
                                            </div>
                                            <span>{{ $highlight['description'] ?? '' }}</span>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif
                        @endif



                        @if (!empty($activity['daySchedule']) && isset($activity['daySchedule'][0]['heading']))
                        <div class="schedule">
                            <h3 class="section-title h3 mb-2">{{ $activity['daySchedule'][0]['heading'] }}</h3>
                            <div class="timeline">
                                @foreach ($activity['daySchedule'] as $schedule)
                                <div class="timeline-item">
                                    <div class="timeline-point"></div>
                                    <div class="">
                                        <!-- <div class="time-badge">{{ $schedule->time_slot }}</div> -->
                                        <div class="timeline-card">
                                            <h4>{!! $schedule->title !!}</h4>
                                            <p>{!! $schedule->description !!}</p>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif

                    </div>
                </section>

                <!-- Requirements Section -->
               @if ($activity['contentBlock'])
                        @if (!empty($activity['contentBlock']) && is_iterable($activity['contentBlock']))
                            @foreach ($activity['contentBlock'] as $contentBlock)
                                @php
                                    $sectionBlocks = $contentBlock->section_blocks;
                                @endphp

                                @if ($contentBlock->layout === 'dualCard' && !empty($sectionBlocks[0]['columns_data']))
                                    <section class="requirements-section mb-3">
                                        @php
                                            $words = explode(' ', trim($contentBlock->title));
                                            $wordCount = count($words);

                                            if ($wordCount === 1) {
                                                $firstPart = $words[0];
                                                $secondPart = '';
                                            } elseif ($wordCount <= 3) {
                                                $firstPart = $words[0];
                                                $secondPart = implode(' ', array_slice($words, 1));
                                            } else {
                                                $firstPart = implode(' ', array_slice($words, 0, 2));
                                                $secondPart = implode(' ', array_slice($words, 2));
                                            }
                                        @endphp

                                        <h2 class="section-title h3 mb-2">
                                            {{ $firstPart }}
                                            @if ($secondPart)
                                                <span class="text-gradient">{{ $secondPart }}</span>
                                            @endif
                                        </h2>

                                        <div class="row g-4">
                                            <p>{{ $contentBlock['description'] }}</p>
                                            @foreach ($sectionBlocks[0]['columns_data'] as $column)
                                                <div class="col-md-6">
                                                    <div class="card h-100 border-0 shadow-sm">
                                                        <div class="card-body">
                                                            <h3 class="h6 mb-3">{{ $column['title'] ?? '' }}</h3>
                                                            <ul class="list-unstyled mb-0">
                                                                @foreach ($column['list'] ?? [] as $item)
                                                                    <li class="mb-2">
                                                                        {!! $item['icon'] !!}{{ $item['text'] }}</li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </section>
                                @elseif ($contentBlock->layout === 'multiColumnList' && !empty($sectionBlocks[0]['columns_data']))
                                    @php
                                        $columns = $sectionBlocks[0]['columns_data'];
                                        $count = count($columns);
                                        $colClass = match ($count) {
                                            1 => 'col-lg-12',
                                            2 => 'col-6 col-lg-6 ',
                                            3 => 'col-6 col-lg-4 ',
                                            4 => 'col-6 col-lg-3 ',
                                            default => 'col-lg-6', // fallback
                                        };
                                    @endphp

                                    <section class="dive-sites-section ">
                                        @php
                                            $words = explode(' ', trim($contentBlock->title));
                                            $wordCount = count($words);

                                            if ($wordCount === 1) {
                                                $firstPart = $words[0];
                                                $secondPart = '';
                                            } elseif ($wordCount <= 3) {
                                                $firstPart = $words[0];
                                                $secondPart = implode(' ', array_slice($words, 1));
                                            } else {
                                                $firstPart = implode(' ', array_slice($words, 0, 2));
                                                $secondPart = implode(' ', array_slice($words, 2));
                                            }
                                        @endphp

                                        <h2 class="section-title h3 mb-3">
                                            {{ $firstPart }}
                                            @if ($secondPart)
                                                <span class="text-gradient">{{ $secondPart }}</span>
                                            @endif
                                        </h2>

                                        <div class="card border-0 shadow-sm mt-4 mb-3">
                                            <div class="card-body">

                                                <div class="row g-4">
                                            <p>{{ $contentBlock['description'] }}</p>

                                                    @foreach ($columns as $column)
                                                        <div class="{{ $colClass }}">
                                                                <h3 class="h6 mb-3">{{ $column['title'] ?? '' }}</h3>
                                                                @if (!empty($column['desc']))
                                                                    <p class="mb-3">{{ $column['desc'] }}</p>
                                                                @endif
                                                                <ul class="list-unstyled">
                                                                    @foreach ($column['list'] ?? [] as $item)
                                                                        <li class="mb-2">
                                                                            {!! $item['icon'] !!}{{ $item['text'] }}</li>
                                                                    @endforeach
                                                                </ul>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                @elseif ($contentBlock->layout === 'singleCard')
                                    @php
                                        $column = $sectionBlocks[0]['columns_data'][0];

                                    @endphp
                                    
                                    <section class="requirements-section mb-3">
                                        @php
                                            $words = explode(' ', trim($contentBlock->title));
                                            $wordCount = count($words);

                                            if ($wordCount === 1) {
                                                $firstPart = $words[0];
                                                $secondPart = '';
                                            } elseif ($wordCount <= 3) {
                                                $firstPart = $words[0];
                                                $secondPart = implode(' ', array_slice($words, 1));
                                            } else {
                                                $firstPart = implode(' ', array_slice($words, 0, 2));
                                                $secondPart = implode(' ', array_slice($words, 2));
                                            }
                                        @endphp

                                        <h2 class="section-title h3 mb-2">
                                            {{ $firstPart }}
                                            @if ($secondPart)
                                                <span class="text-gradient">{{ $secondPart }}</span>
                                            @endif
                                        </h2>

                                        <div class="row g-4">
                                            
                                            <div class="col-md-12">
                                                <div class="card h-100 border-0 shadow-sm">
                                                    <div class="card-body">
                                            <p>{{ $contentBlock['description'] }}</p>

                                                        <h3 class="6 mb-3">{{ $column['title'] ?? '' }}</h3>
                                                        <ul class="list-unstyled mb-0">
                                                            @foreach ($column['list'] ?? [] as $item)
                                                                <li class="mb-0">
                                                                    {!! $item['icon'] !!}{{ $item['text'] }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                @endif
                            @endforeach
                        @endif


                    @endif



<!-- FAQ Section -->
@if ($activity->ctc_title)
<section>
    <div class="container">
        <div class="row mt-3">
            <div class="cta-section text-center text-white rounded-4 p-5">
                <h2 class="h3 mb-1 text-white">{!! $activity->ctc_title !!}</h2>
                <p class=" mb-4 text-dark">{!! $activity->ctc_desc !!}</p>
                <div class="d-flex justify-content-center gap-3">
                    <a href="#booking" class="btn btn-light btn-lg rounded-pill">Book Now</a>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#staticBackdrop" class="btn btn-outline-light btn-lg rounded-pill">Contact
                        Us</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

</div>

@include('common.login-modal')

<!-- Right Column - Booking Section -->
<div class="col-lg-4">
    <div class="sticky-top" style="">
        <livewire:activity.activity-booking-modal :activity="$activity" />
    </div>
</div>

</div>
@if ($activity->faqs->count() > 0)
<section class="custom-faq-section">
    <div class="container">
        <div class="custom-faq-container">
            <div class="row mb-5">
                <div class="col-lg-8 mx-auto text-center">
                    <h2 class="section-title fw-bolder">Frequently Asked <span class="text-gradient">Questions</span>
                    </h2>
                    <p>Find answers to common questions about our payment process and options.</p>
                </div>
            </div>

            <div class="row">
                @foreach ($activity->faqs as $index => $faq)
                <div class="col-lg-6">
                    <div class="custom-faq-item">
                        <div class="custom-faq-question" data-faq-target="faq{{ $index }}">
                            <div class="question-text">
                                <span class="question-number">{{ $index + 1 }}</span>
                                <h3>{{ ucfirst($faq['question']) }} ?</h3>
                            </div>
                            <div class="question-icon"><i class="fas fa-plus"></i></div>
                        </div>
                        <div class="custom-faq-answer" id="faq{{ $index }}">
                            <div class="answer-content">
                                <p>{{ ucfirst($faq['answer']) }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>


        </div>
    </div>
</section>

@endif
</div>
</div>

<!-- Lightbox Gallery -->
<div class="lightbox-gallery" id="lightboxGallery">
    <div class="lightbox-overlay"></div>

    <button class="lightbox-close" id="lightboxClose">
        <i class="fas fa-times"></i>
    </button>
    <div class="lightbox-container">
        <div class="lightbox-slider">
            @foreach ($activity->activityPhotos as  $photo)
            <div class="lightbox-slide active">
                <img src="{{ @$photo->file }}" alt="Image">
                <div class="slide-caption">{{ $activity->name }}</div>
            </div>
            @endforeach
        </div>

        <div class="lightbox-controls">
            <button class="lightbox-control prev" id="lightboxPrev">
                <i class="fas fa-chevron-left"></i>
            </button>
            <button class="lightbox-control next" id="lightboxNext">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>

        <div class="lightbox-counter" id="lightboxCounter">1/5</div>
    </div>
</div>

<a role="button" href="#booking"  id="activity-btn" class="stick-bottom position-fixed bottom-0 start-0 end-0 bg-info border-top py-2 d-md-none text-center" style="z-index: 9999;">
            <p class="w-100 text-white fw-bolder">Book Now</p>
</a>

<section class="container">
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
            <img src="{{ $first->image_url }}" class="rev-big-img" alt="review-image">
            <span class="rev-view-all"><i class="fa fa-camera"></i> View All ({{ $review_images->count() }})</span>
        </a>

        @foreach($review_images->skip(1)->take(6) as $img)
            <a href="{{ $img->image_url }}" data-lightbox="gallery">
                <img src="{{ $img->image_url }}" class="rev-small-img" alt="review-img">
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
    <img src="{{ $review['reviewer_profile_photo_url'] }}" class="rev-avatar" alt="{{ Str::slug($review['reviewer_name']) }}">

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
    .overview-descriptions a {
        color: #ffa207;
    }
.under-wtr-itm li {
    list-style-type: disc !important;
}

.banner-meta {
    min-height: 80px;
}

#expert-btn{
    display:none;
}

.meta-icon {
    width: 24px;
    height: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.fixed-position-acti {
    position: sticky !important;
    top: 0 !important;
}

.meta-icon i {
    font-size: 20px;
    width: 20px;
    height: 20px;
    display: inline-block;
}

.actvi-form-label-adult {
    display: none;
    font-size: 12px;
}

.actvi-form-label-child {
    display: none;
    font-size: 12px;
}

.meta-value {
    display: inline-block;
    max-width: 200px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.custom-faq-section {
    padding-top:30px;
    padding-bottom:0px;
    background-color: var(--color-background-light);
}

.custom-faq-container {
    max-width: 1000px;
    margin: 0 auto;
}

.custom-faq-item {
    background-color: white;
    border-radius: var(--border-radius);
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.05);
    margin-bottom: 1.5rem;
    overflow: hidden;
    border-left: 4px solid transparent;
    transition: all 0.3s ease;
}

.custom-faq-item:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
    border-left: 4px solid var(--color-primary);
}

.custom-faq-question {
    padding: 1.5rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
    cursor: pointer;
    background-color: var(--color-white);
    transition: all 0.3s ease;
    position: relative;
}

.custom-faq-question:hover {
    background-color: rgba(26, 115, 232, 0.03);
}

.custom-faq-question h3 {
    margin: 0;
    font-size: 0.8rem;
    font-weight: 600;
    color: var(--color-text-dark);
    transition: color 0.3s ease;
}

.custom-faq-item.active .custom-faq-question h3 {
    color: var(--color-primary);
}

.question-text {
    display: flex;
    align-items: center;
    gap: 15px;
}

.question-number {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 30px;
    height: 30px;
    color: #3BA6D7;
    border-radius: 50%;
    font-size: 1.4rem;
    font-weight: 800;
    flex-shrink: 0;
    opacity: 0.8;
    transition: all 0.3s ease;
}

.custom-faq-item.active .question-number,
.custom-faq-item:hover .question-number {
    opacity: 1;
    transform: scale(1.1);
}

.question-icon i {
    font-size: 1rem;
    color: var(--color-primary);
    transition: all 0.3s ease;
}

.custom-faq-item.active .question-icon i {
    transform: rotate(45deg);
}

.custom-faq-answer {
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.5s ease, padding 0.3s ease;
}

.custom-faq-item.active .custom-faq-answer {
    max-height: 500px;
}

.answer-content {
    padding: 0 1.5rem 1.5rem 4.5rem;
    color: var(--color-text-light);
    line-height: 1.6;
    font-size: 0.95rem;
}

.custom-faq-contact-info {
    margin-top: 3rem;
    padding: 2rem;
    background: linear-gradient(135deg, rgba(26, 115, 232, 0.05) 0%, rgba(52, 168, 83, 0.05) 100%);
    border-radius: var(--border-radius);
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.03);
}

.custom-contact-heading {
    font-size: 1rem;
    margin-bottom: 1.5rem;
    color: var(--color-text-dark);
}

.custom-contact-buttons {
    display: flex;
    justify-content: center;
    gap: 20px;
}

.custom-contact-button {
    display: inline-flex;
    align-items: center;
    padding: 12px 25px;
    border-radius: 50px;
    text-decoration: none;
    font-weight: 500;
    transition: all 0.3s ease;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    color: #fff;
}

.custom-contact-button i {
    margin-right: 10px;
    font-size: 1.1rem;
    color: #fff !important;
}

.custom-contact-button.custom-email {
    background-color: var(--color-primary);
}

.custom-contact-button.custom-phone {
    background-color: var(--color-secondary);
}

.custom-contact-button:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
}


@media (max-width: 768px) {
    .answer-content {
        padding: 0 1.5rem 1.5rem 1.5rem;
    }
     .cta-section{
    display: none;
    }

    .question-text {
        gap: 10px;
    }

    .contact-buttons {
        flex-direction: column;
        gap: 15px;
    }

    .custom-contact-buttons {
        flex-direction: column;
        gap: 15px;
    }

    .actvi-form-label-adult {
        display: block;
    }

    .actvi-form-label-child {
        display: block;
    }
    .slick-slide{
        margin-top:75px;
    }
}

.btn_theme {
    color: #fff;
    background: var(--color-primary) !important;
    transition: 0.4s all ease-in-out;
    box-shadow: none;
    overflow: hidden;
    white-space: nowrap;
    position: relative;
    z-index: 0;
    border: none;
    font-size: 16px;
    letter-spacing: 1px;
    font-weight: 500;
}

.btn_theme:hover {
    background: var(--color-primary-gradient) !important;
    color: white;
}

.heading_theme {
    border-bottom: 1px solid var(--color-primary);
    padding-bottom: 10px;
    display: inline-block;
    font-weight: 500;
    margin-bottom: 20px;
}
</style>
@endpush

@push('scripts')
<script>
    window.addEventListener('load', () => {
    const lazyVideos = document.querySelectorAll('.lazy-video');

    lazyVideos.forEach(el => {
        const src = el.getAttribute('data-src');
        if (!src) return;

        if (el.tagName === 'IFRAME') {
            el.setAttribute('src', src);
        } else if (el.tagName === 'VIDEO') {
            const source = document.createElement('source');
            source.src = src;
            source.type = 'video/mp4';
            el.appendChild(source);
            el.load();
        }
    });
});
document.addEventListener('DOMContentLoaded', function() {


  const videos = document.querySelectorAll('video');
const iframes = document.querySelectorAll('iframe');

const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
        const el = entry.target;
        const wrapper = el.closest('.video-wrapper') || el.parentElement;

        if (!entry.isIntersecting) {
            if (el.tagName === 'VIDEO') {
                el.pause();
            } else if (el.tagName === 'IFRAME') {
                const src = el.src;
                el.src = '';
                el.src = src;
            }
        }
    });
}, {
    threshold: 0.25
});

videos.forEach(video => observer.observe(video));
iframes.forEach(iframe => observer.observe(iframe));

document.addEventListener('visibilitychange', function() {
    if (document.hidden) {
        videos.forEach(video => video.pause());
        iframes.forEach(iframe => {
            const src = iframe.src;
            iframe.src = '';
            iframe.src = src;
        });
    }
});


    // your counter logic
    const minusBtn = document.querySelector('.counter-btn.minus');
    const plusBtn = document.querySelector('.counter-btn.plus');
    const counterInput = document.querySelector('.counter-input');

    if (minusBtn && plusBtn && counterInput) {
        function updateCounterState() {
            const value = parseInt(counterInput.value);
            const min = parseInt(counterInput.getAttribute('min'));
            const max = parseInt(counterInput.getAttribute('max'));

            minusBtn.disabled = value <= min;
            plusBtn.disabled = value >= max;

            minusBtn.style.opacity = value <= min ? '0.5' : '1';
            minusBtn.style.cursor = value <= min ? 'not-allowed' : 'pointer';
            plusBtn.style.opacity = value >= max ? '0.5' : '1';
            plusBtn.style.cursor = value >= max ? 'not-allowed' : 'pointer';
        }

        updateCounterState();

        minusBtn.addEventListener('click', function() {
            const value = parseInt(counterInput.value);
            const min = parseInt(counterInput.getAttribute('min'));
            if (value > min) {
                counterInput.value = value - 1;
                updateCounterState();
            }
        });

        plusBtn.addEventListener('click', function() {
            const value = parseInt(counterInput.value);
            const max = parseInt(counterInput.getAttribute('max'));
            if (value < max) {
                counterInput.value = value + 1;
                updateCounterState();
            }
        });
    }

    // Lightbox & FAQ logic (untouched)
    const lightboxGallery = document.getElementById('lightboxGallery');
    const lightboxSlides = document.querySelectorAll('.lightbox-slide');
    const lightboxPrev = document.getElementById('lightboxPrev');
    const lightboxNext = document.getElementById('lightboxNext');
    const lightboxClose = document.getElementById('lightboxClose');
    const lightboxCounter = document.getElementById('lightboxCounter');
    const openGalleryBtn = document.getElementById('openGalleryBtn');
    let currentSlide = 0;
    const totalSlides = lightboxSlides.length;

    function updateCounter() {
        if (lightboxCounter) {
            lightboxCounter.textContent = `${currentSlide + 1}/${totalSlides}`;
        }
    }

    function showSlide(index) {
        lightboxSlides.forEach(slide => {
            slide.classList.remove('active');
        });
        lightboxSlides[index].classList.add('active');
        currentSlide = index;
        updateCounter();
    }

    if (openGalleryBtn) {
        openGalleryBtn.addEventListener('click', function(e) {
            e.preventDefault();
            lightboxGallery.classList.add('active');
            document.body.style.overflow = 'hidden';
            showSlide(0);
        });
    }

    if (lightboxClose) {
        lightboxClose.addEventListener('click', function() {
            lightboxGallery.classList.remove('active');
            document.body.style.overflow = '';
        });
    }

    if (lightboxGallery) {
        lightboxGallery.addEventListener('click', function(e) {
            if (e.target === lightboxGallery || e.target.classList.contains('lightbox-overlay')) {
                lightboxGallery.classList.remove('active');
                document.body.style.overflow = '';
            }
        });
    }

    if (lightboxPrev) {
        lightboxPrev.addEventListener('click', function() {
            let newIndex = currentSlide - 1;
            if (newIndex < 0) {
                newIndex = totalSlides - 1;
            }
            showSlide(newIndex);
        });
    }

    if (lightboxNext) {
        lightboxNext.addEventListener('click', function() {
            let newIndex = currentSlide + 1;
            if (newIndex >= totalSlides) {
                newIndex = 0;
            }
            showSlide(newIndex);
        });
    }

    document.addEventListener('keydown', function(e) {
        if (lightboxGallery.classList.contains('active')) {
            if (e.key === 'ArrowLeft') {
                lightboxPrev.click();
            } else if (e.key === 'ArrowRight') {
                lightboxNext.click();
            } else if (e.key === 'Escape') {
                lightboxClose.click();
            }
        }
    });

    const faqItems = document.querySelectorAll('.custom-faq-question');
    faqItems.forEach(item => {
        item.addEventListener('click', () => {
            const parent = item.closest('.custom-faq-item');
            const targetId = item.getAttribute('data-faq-target');
            const answer = document.getElementById(targetId);
            document.querySelectorAll('.custom-faq-item.active').forEach(openItem => {
                if (openItem !== parent) {
                    openItem.classList.remove('active');
                }
            });
            parent.classList.toggle('active');
        });
    });
});

$('.multiple-items').slick({
    dots: false,
    arrows: true,
    infinite: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    centerMode: true,
    variableWidth: true,
    prevArrow: '<button type="button" class="slick-prev slick-arrow"><i class="fa fa-chevron-left"></i></button>',
    nextArrow: '<button type="button" class="slick-next slick-arrow"><i class="fa fa-chevron-right"></i></button>'
});
</script>

@endpush