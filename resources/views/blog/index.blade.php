@extends('layouts.app')
@section('title', 'Travel Blog - Tips, Guides & Inspiration for Andaman Islands')
@section('keywords', 'Andaman travel blogs, Andaman tour guides, Andaman travel tips, Andaman honeymoon blogs, Andaman family trip blogs, best time to visit Andaman, Andaman adventure blogs')
@section('description', 'Explore Andaman travel blogs with expert tips, tour guides, and personal experiences on family trips, honeymoons, and adventures with Andaman Bliss.')

@section('canonical')
<link rel="canonical" href="{{ url('blog') }}" />
@endsection

@section('structured_data')
<script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Blog",
        "headline": "Andaman Islands Travel Blog - Tips, Guides & Inspiration",
        "description": "Discover travel tips, guides, and inspiration for your Andaman Islands adventure. Read our expert advice on beaches, activities, accommodations, and more.",
        "keywords": "Andaman blog, Andaman travel tips, Andaman Islands guide, Andaman beaches, Andaman activities, Andaman travel blog, Havelock Island, Neil Island, Port Blair",
        "author": {
            "@type": "Organization",
            "name": "{{ config('app.name') }}",
            "url": "{{ url('/') }}"
        },
        "publisher": {
            "@type": "Organization",
            "name": "{{ config('app.name') }}",
            "logo": {
                "@type": "ImageObject",
                "url": "{{ asset('images/logo.png') }}"
            }
        },
        "mainEntityOfPage": {
            "@type": "WebPage",
            "@id": "{{ url('blog') }}"
        },
        "datePublished": "2025-01-01T08:00:00+00:00",
        "dateModified": "{{ date('Y-m-d') }}T08:00:00+00:00",
        "image": "https://images.unsplash.com/photo-1586500036706-41963de24d8b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1920&q=80"
    }
</script>
<script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "BreadcrumbList",
        "itemListElement": [{
                "@type": "ListItem",
                "position": 1,
                "name": "Home",
                "item": "{{ url('/') }}"
            },
            {
                "@type": "ListItem",
                "position": 2,
                "name": "Blog",
                "item": "{{ url('blog') }}"
            }
        ]
    }
</script>
@endsection

@section('content')
@push('styles')
<style>
    :root {
        --primary-color: #2aa0c3;
        /* Blue */
        --primary-light: #dbeafe;
        --primary-dark: #1d4ed8;
        --orange-color: #ff6600;
        /* Orange */
        --orange-dark: #cc5200;
        --text-dark: #1f2937;
        --text-medium: #4b5563;
        --text-light: #f9fafb;
        --bg-light: #f9fafb;
        --bg-medium: #f3f4f6;
        --border-color: #e5e7eb;
        --card-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        --card-radius: 12px;
    }

    /* Blog Hero Section */
    .blog-hero {
        background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://images.unsplash.com/photo-1518509562904-e7ef99cdcc86?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1920&q=80');
        background-size: cover;
        background-position: center;
        color: #ffffff;
        padding: 100px 0;
    }

    .section-label {
        font-size: 1rem;
        font-weight: 500;
        color: rgba(255, 255, 255, 0.9);
        margin-bottom: 0.5rem;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .blog-hero-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: #ffffff;
        margin-bottom: 1rem;
    }

    .blog-hero-subtitle {
        font-size: 1.1rem;
        color: rgba(255, 255, 255, 0.9);
        margin-bottom: 2rem;
        max-width: 700px;
        margin-left: auto;
        margin-right: auto;
    }

    .blog-search-container {
        max-width: 500px;
        margin: 0 auto;
    }

    .blog-search-input {
        border-radius: 8px;
        padding: 0.75rem 1rem;
        border: 1px solid var(--border-color);
        box-shadow: none;
    }

    .blog-search-button {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
        border-radius: 8px;
        padding: 0.75rem 1.5rem;
        font-weight: 500;
    }

    .blog-search-button:hover {
        background-color: var(--primary-dark);
        border-color: var(--primary-dark);
    }

    /* Section Title */
    .section-title {
        font-size: 1.75rem;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 1.5rem;
    }

    /* Blog Cards */
    .blog-card {
        position: relative;
        border-radius: var(--card-radius);
        overflow: hidden;
        box-shadow: var(--card-shadow);
        height: 380px;
        /* Fixed height for all cards */
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        display: flex;
        flex-direction: column;
    }

    .blog-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }

    .blog-card-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .blog-card-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(to bottom, rgba(0, 0, 0, 0.2) 0%, rgba(0, 0, 0, 0.8) 70%);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        padding: 15px 20px 25px;
    }

    .blog-card-category {
        align-self: flex-start;
        background-color: white;
        color: var(--text-dark);
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 500;
        margin-bottom: auto;
    }

    .blog-card-content {
        color: white;
        margin-top: auto;
    }

    .blog-card-content h3 {
        font-size: 1.1rem;
        font-weight: 700;
        color: white;
        margin-bottom: 0.5rem;
        line-height: 1.3;
        height: 2.8rem;
        /* Fixed height for title - approximately 2 lines */
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
    }

    .blog-card-content p {
        color: rgba(255, 255, 255, 0.9);
        font-size: 0.85rem;
        line-height: 1.5;
        margin-bottom: 0;
        height: 3.8rem;
        /* Fixed height for description - approximately 3 lines */
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    /* Pagination */
    .blog-pagination {
        margin-top: 2rem;
    }

    .pagination .page-item .page-link {
        color: var(--text-dark);
        border: none;
        padding: 10px 15px;
        margin: 0 5px;
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .pagination .page-item.active .page-link {
        background-color: var(--primary-color);
        color: var(--text-light);
    }

    .pagination .page-item .page-link:hover {
        background-color: var(--primary-light);
        color: var(--primary-color);
    }

    .pagination .page-item.disabled .page-link {
        color: #ccc;
    }

    /* Sidebar */
    .blog-sidebar {
        position: sticky;
        top: 20px;
    }

    .sidebar-widget {
        background-color: white;
        border-radius: var(--card-radius);
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        box-shadow: var(--card-shadow);
    }

    .widget-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 1.25rem;
        position: relative;
    }

    /* Search Widget */
    .search-widget .blog-search-input {
        border-radius: 8px 0 0 8px;
        padding: 0.75rem 1rem;
        border: 1px solid var(--border-color);
        box-shadow: none;
    }

    .search-widget .blog-search-button {
        border-radius: 0 8px 8px 0;
        padding: 0.75rem 1rem;
        background-color: var(--orange-color);
        border-color: var(--orange-color);
    }

    .search-widget .blog-search-button:hover {
        background-color: var(--orange-dark);
        border-color: var(--orange-dark);
    }

    /* Featured Posts Widget */
    .featured-post-item,
    .latest-post-item {
        display: flex;
        margin-bottom: 1.25rem;
        align-items: flex-start;
    }

    .featured-post-item:last-child,
    .latest-post-item:last-child {
        margin-bottom: 0;
    }

    .featured-post-img,
    .latest-post-img {
        flex: 0 0 70px;
        margin-right: 15px;
    }

    .featured-post-img img,
    .latest-post-img img {
        width: 70px;
        height: 70px;
        object-fit: cover;
        border-radius: 8px;
    }

    .featured-post-info h4,
    .latest-post-info h4 {
        font-size: 0.95rem;
        font-weight: 600;
        margin-bottom: 0;
        line-height: 1.4;
    }

    .featured-post-info h4 a,
    .latest-post-info h4 a {
        color: var(--text-dark);
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .featured-post-info h4 a:hover,
    .latest-post-info h4 a:hover {
        color: var(--primary-color);
    }

    .post-date {
        display: block;
        font-size: 0.8rem;
        color: var(--text-medium);
        margin-bottom: 0.25rem;
    }

    /* Categories Widget */
    .categories-widget ul li {
        border-bottom: 1px solid var(--border-color);
        padding: 8px 0;
    }

    .categories-widget ul li:last-child {
        border-bottom: none;
    }

    .categories-widget ul li a {
        color: var(--text-dark);
        text-decoration: none;
        display: flex;
        justify-content: flex-start;
        align-items: center;
        transition: color 0.3s ease;
    }

    .categories-widget ul li a:hover {
        color: var(--orange-color);
    }

    .categories-widget ul li a i {
        margin-right: 8px;
        font-size: 0.8rem;
        color: var(--orange-color);
    }

    .categories-widget ul li a .badge {
        margin-left: auto;
        background-color: var(--orange-color);
        color: white;
    }

    /* Newsletter Widget */
    .newsletter-widget p {
        margin-bottom: 1rem;
        font-size: 0.95rem;
        color: var(--text-medium);
    }

    .newsletter-form .btn-primary {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
    }

    .newsletter-form .btn-primary:hover {
        background-color: var(--primary-dark);
        border-color: var(--primary-dark);
    }

    /* CTA Section */
    .cta-section {
        background-color: var(--bg-light);
    }

    .cta-content h2 {
        font-size: 1.8rem;
        color: var(--text-dark);
        margin-bottom: 15px;
        font-weight: 600;
    }

    .cta-content p {
        font-size: 1rem;
        color: var(--text-medium);
        margin-bottom: 20px;
    }

    .cta-features {
        list-style: none;
        padding: 0;
        margin-bottom: 25px;
    }

    .cta-features li {
        margin-bottom: 10px;
        font-size: 0.95rem;
        color: var(--text-medium);
        display: flex;
        align-items: center;
    }

    .cta-features li i {
        margin-right: 10px;
        color: var(--orange-color);
    }

    .cta-buttons {
        display: flex;
        gap: 15px;
    }

    /* Orange Button */
    .btn-orange {
        background-color: var(--orange-color);
        border-color: var(--orange-color);
        color: white;
    }

    .btn-orange:hover {
        background-color: var(--orange-dark);
        border-color: var(--orange-dark);
        color: white;
    }

    /* Breadcrumb Styles */
    .breadcrumb-section {
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        position: relative;
        z-index: 10;
        border-bottom: 1px solid var(--border-color);
    }

    .breadcrumb-nav {
        padding: 0.5rem 0;
    }

    .breadcrumb-item a {
        color: var(--primary-color);
        text-decoration: none;
        font-weight: 500;
    }

    .breadcrumb-item a:hover {
        color: var(--orange-color);
    }

    .breadcrumb-item.active {
        color: var(--orange-color);
        font-weight: 500;
    }

    .breadcrumb-item+.breadcrumb-item::before {
        content: "›";
        color: var(--text-medium);
        font-weight: bold;
    }

    /* Responsive Styles */
    @media (max-width: 991px) {
        .blog-sidebar {
            margin-top: 2rem;
            position: static;
        }
    }

    @media (max-width: 767px) {
        .blog-hero-title {
            font-size: 2rem;
        }

        .blog-hero-subtitle {
            font-size: 1rem;
        }

        .section-title {
            font-size: 1.5rem;
        }
    }
</style>
@endpush
<!-- Breadcrumb -->
<div class="container mt-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Blog</li>
        </ol>
    </nav>
</div>

<!-- Blog Hero Section -->
<section class="blog-hero">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8">
                <div class="blog-hero-content">
                    <p class="section-label">Andaman Islands Travel Blog</p>
                    <h1 class="blog-hero-title">Travel Tips, Guides & Inspiration</h1>
                    <p class="blog-hero-subtitle">Discover the hidden gems of Andaman Islands through our expert travel
                        guides, insider tips, and inspiring stories to help you plan your perfect island getaway.</p>

                    <div class="hero-buttons">
                        <a href="#blog-posts" class="btn btn-orange">Explore Articles</a>
                        <a href="{{ url('/contact') }}" class="btn btn-outline-light">Plan Your Trip</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Breadcrumb Section -->
<section class="breadcrumb-section py-3 bg-light">
    <div class="container">
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/promotions') }}">Promotions</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/andaman') }}">Andaman</a></li>
                <li class="breadcrumb-item active" aria-current="page">Best Places to Visit</li>
            </ol>
        </nav>
    </div>
</section>

<!-- Main Blog Section -->
<section id="blog-posts" class="main-blog py-5">
    <div class="container">
        <div class="row">
            <!-- Blog Posts -->
            <div class="col-lg-9">
                <h2 class="section-title mb-4">Latest Travel Articles & Guides</h2>

                <div class="row">
                    <!-- Blog Post 1 -->
                    @foreach ($blogs as $blog)

                    <div class="col-md-4 mb-4">
                        <a href="{{ route('blogs.show',['blog' => $blog->slug]) }}" class="text-decoration-none">
                            <div class="blog-card">
                                <img src="{{ $blog->photo->file }}" alt="{{$blog->title}}" class="blog-card-img">
                                <div class="blog-card-overlay">
                                    <div class="blog-card-category">{{ $blog->category }}</div>
                                    <div class="blog-card-content">
                                        <h3>{{$blog->title}}</h3>
                                        <p>{!! Str::words(strip_tags($blog->content), 20, '...') !!}</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    @endforeach


                </div>

                <!-- Pagination -->
                <div class="blog-pagination mt-4">
                    {{ $blogs->links('vendor.pagination.custom-view') }}
                </div>
                <div class="cta-content mt-5">
                    <h2>Ready to Explore Andaman Islands?</h2>
                    <p>Let us help you plan the perfect trip to this tropical paradise. Our travel experts will create a
                        customized itinerary based on your preferences and budget.</p>
                    <ul class="cta-features">
                        <li><i class="fas fa-check-circle"></i> Personalized travel planning</li>
                        <li><i class="fas fa-check-circle"></i> Best deals on accommodations and activities</li>
                        <li><i class="fas fa-check-circle"></i> 24/7 support during your trip</li>
                    </ul>
                    <div class="cta-buttons">
                        <a href="{{ url('/contact') }}" class="btn btn-orange">Contact Us</a>
                        <a href="" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop"
                            class="btn btn-outline-primary">Plan Your Trip</a>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-3">
                <div class="blog-sidebar">
                    <!-- Search Widget -->
                    <div class="sidebar-widget search-widget mt-5">
                        <h3 class="widget-title">Search</h3>
                        <div class="widget-content">
                            <form action="{{ route('blogs.index') }}" method="GET" class="blog-search-form">
                                @csrf
                                <div class="input-group">
                                    <input type="text" name="keyword" value="{{ request('keyword') }}"
                                        placeholder="Search for travel tips, destinations, guides..."
                                        class="form-control blog-search-input">
                                    <button type="submit" class="btn btn-orange blog-search-button">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </form>

                        </div>
                    </div>

                    <!-- Featured Posts Widget -->
                    <div class="sidebar-widget featured-posts-widget">
                        <h3 class="widget-title">Featured</h3>
                        <div class="widget-content">
                            <!-- Featured Post 1 -->
                            @foreach ($blogs->where('featured',1) as $featured)

                            <div class="featured-post-item">
                                <div class="featured-post-img">
                                    <a href="{{ route('blogs.show',['blog' => $featured->slug]) }}">
                                        <img src="{{ $featured->photo->file }}" alt="{{$featured->title}}"
                                            class="img-fluid">
                                    </a>
                                </div>
                                <div class="featured-post-info">
                                    <span class="post-date">{{ \Carbon\Carbon::parse($featured->publish_date ?? $featured->created_at)->format('M d, Y') }}</span>
                                    <h4 class="fw-bolder"><a
                                            href="{{ route('blogs.show',['blog' => $featured->slug]) }}">{{
                                            $featured->title }}</a></h4>
                                </div>
                            </div>

                            @endforeach

                        </div>
                    </div>

                    <!-- Latest Posts Widget -->
                    <div class="sidebar-widget latest-posts-widget">
                        <h3 class="widget-title">Latest</h3>
                        <div class="widget-content">
                            <!-- Latest Post  -->
                            @foreach ($blogs->sortBy('id')->take(3) as $latestBlog)
                            <div class="latest-post-item">
                                <div class="latest-post-img">
                                    <a href="{{ route('blogs.show',['blog' => $latestBlog->slug]) }}">
                                        <img src="{{ $latestBlog->photo->file }}" alt="{{ $latestBlog->title }}"
                                            class="img-fluid">
                                    </a>
                                </div>
                                <div class="latest-post-info">
                                    <span class="post-date">{{ \Carbon\Carbon::parse($latestBlog->publish_date ?? $latestBlog->created_at)->format('M d, Y') }}</span>
                                    <h4><a href="{{ route('blogs.show',['blog' => $latestBlog->slug]) }}">{{
                                            $latestBlog->title }}</a></h4>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Categories Widget -->
                    <div class="sidebar-widget categories-widget">
                        <h3 class="widget-title">Categories</h3>
                        <div class="widget-content">
                            <ul class="list-unstyled">
                                @foreach($blogs->groupBy('category') as $category => $group)
                                <li>
                                    <a href="{{ route('blogs.index', ['keyword' => $category]) }}">
                                        <i class="fas fa-angle-right"></i> {{ $category }}
                                        <span class="badge">{{ $group->count() }}</span>
                                    </a>
                                </li>
                                @endforeach


                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>


@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Blog card hover effects
        $('.blog-card').hover(
            function() {
                $(this).css('transform', 'translateY(-5px)');
                $(this).css('box-shadow',
                    '0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05)');
            },
            function() {
                $(this).css('transform', 'translateY(0)');
                $(this).css('box-shadow',
                    '0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06)');
            }
        );

        // Search form functionality
        $('.blog-search-form').on('submit', function(e) {
            e.preventDefault();
            var searchTerm = $('.blog-search-input').val().toLowerCase();

            if (searchTerm.length > 2) {
                // Hide all blog cards
                $('.blog-card').parent().parent().hide();

                // Show only cards that match the search term
                $('.blog-card').each(function() {
                    var cardTitle = $(this).find('h3').text().toLowerCase();
                    var cardContent = $(this).find('p').text().toLowerCase();
                    var cardCategory = $(this).find('.blog-card-category').text().toLowerCase();

                    if (cardTitle.includes(searchTerm) || cardContent.includes(searchTerm) ||
                        cardCategory.includes(searchTerm)) {
                        $(this).parent().parent().show();
                    }
                });

                // Show message if no results found
                if ($('.blog-card:visible').length === 0) {
                    if ($('.no-results-message').length === 0) {
                        $('.blog-pagination').before(
                            '<div class="no-results-message alert alert-info text-center my-4">No results found for "' +
                            searchTerm + '". Please try a different search term.</div>');
                    }
                } else {
                    $('.no-results-message').remove();
                }
            } else {
                // If search term is too short, show all cards and remove message
                $('.blog-card').parent().parent().show();
                $('.no-results-message').remove();
            }
        });

        // Clear search when input is cleared
        $('.blog-search-input').on('input', function() {
            if ($(this).val() === '') {
                $('.blog-card').parent().parent().show();
                $('.no-results-message').remove();
            }
        });

        // Animate elements on scroll
        function animateOnScroll() {
            $('.blog-card, .sidebar-widget').each(function() {
                var elementPosition = $(this).offset().top;
                var scrollPosition = $(window).scrollTop();
                var windowHeight = $(window).height();

                if (scrollPosition + windowHeight - 100 > elementPosition) {
                    $(this).addClass('visible');
                }
            });
        }

        // Add animation styles dynamically
        $('<style>')
            .text(`
                .blog-card, .sidebar-widget {
                    opacity: 1;
                    transform: translateY(20px);
                    transition: opacity 0.5s ease, transform 0.5s ease;
                }

                .blog-card.visible, .sidebar-widget.visible {
                    opacity: 1;
                    transform: translateY(0);
                }
            `)
            .appendTo('head');

        // Run animation on page load and scroll
        $(window).on('scroll', animateOnScroll);
        animateOnScroll();
    });
</script>
@endpush