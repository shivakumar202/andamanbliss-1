@extends('layouts.app')
@section('title', $blogContent->meta_title )
@section('meta_description', $blogContent->meta_description)
@section('meta_keywords', $blogContent->meta_keywords)

@section('canonical')
<link rel="canonical" href="{{ url('blog/travel-bucket-list') }}" />
@endsection

@section('structured_data')
<script type="application/ld+json">
    {{$blogContent->meta_keywords}}
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

    article img {
        width: 795px !important;
        height: 439px !important;
    }

    /* Blog Hero Banner */
    .blog-hero-banner {
        background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),
        url({{$blogContent->photo->file}});
        background-size: cover;
        background-position: center;
        color: white;
        padding: 100px 0 50px;
        position: relative;
    }

    .blog-hero-banner .container {
        position: relative;
        z-index: 2;
    }

    .blog-category-label {
        display: inline-block;
        background-color: var(--orange-color);
        color: white;
        padding: 5px 15px;
        border-radius: 20px;
        font-size: 0.9rem;
        font-weight: 500;
        margin-bottom: 15px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .blog-hero-title {
        font-size: 2.8rem;
        font-weight: 700;
        margin-bottom: 15px;
        line-height: 1.3;
    }

    .blog-hero-meta {
        display: flex;
        gap: 20px;
        color: rgba(255, 255, 255, 0.9);
        font-size: 0.95rem;
        margin-bottom: 0;
    }

    .blog-hero-meta span {
        display: flex;
        align-items: center;
    }

    .blog-hero-meta i {
        margin-right: 5px;
        color: var(--orange-color);
    }

    /* Breadcrumb */
    .blog-breadcrumb {
        background-color: var(--bg-light);
        border-bottom: 1px solid var(--border-color);
    }

    .breadcrumb {
        background-color: transparent;
        padding: 0;
        margin-bottom: 0;
    }

    .breadcrumb-item a {
        color: var(--primary-color);
        text-decoration: none;
    }

    .breadcrumb-item a:hover {
        color: var(--primary-dark);
    }

    .breadcrumb-item.active {
        color: var(--orange-color);
    }

    .breadcrumb-item+.breadcrumb-item::before {
        content: "›";
        color: var(--text-medium);
    }

    /* Blog Content */
    .blog-post-content {
        background-color: white;
        border-radius: var(--card-radius);
        padding: 2rem;
        box-shadow: var(--card-shadow);
    }

    .blog-post-category {
        display: inline-block;
        background-color: white;
        color: var(--text-dark);
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 500;
        border: 1px solid var(--border-color);
    }

    .blog-post-title {
        font-size: 2.25rem;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 1rem;
        line-height: 1.3;
    }

    .blog-post-meta {
        display: flex;
        gap: 20px;
        color: var(--text-medium);
        font-size: 0.9rem;
    }

    .blog-post-meta span {
        display: flex;
        align-items: center;
    }

    .blog-post-meta i {
        margin-right: 5px;
        color: var(--primary-color);
    }

    .blog-post-img img {
        width: 100%;
        border-radius: 8px;
    }

    .blog-post-content .lead {
        font-size: 1.2rem;
        color: var(--text-dark);
        line-height: 1.6;
        margin-bottom: 1.5rem;
        font-weight: 500;
    }

    .blog-post-content p {
        color: var(--text-medium);
        line-height: 1.8;
        margin-bottom: 1.5rem;
        font-size: 1.05rem;
    }

    .blog-post-content h2 {
        font-size: 1.8rem;
        font-weight: 700;
        color: var(--text-dark);
        margin: 2rem 0 1rem;
        position: relative;
    }

    .blog-post-content h3 {
        font-size: 1.4rem;
        font-weight: 600;
        color: var(--text-dark);
        margin: 1.5rem 0 1rem;
    }

    .blog-post-content ul,
    .blog-post-content ol {
        color: var(--text-medium);
        margin-bottom: 1.5rem;
        padding-left: 1.5rem;
    }

    .blog-post-content li {
        margin-bottom: 0.5rem;
        line-height: 1.6;
    }

    .blog-gallery img {
        width: 100%;
        height: 200px;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .blog-gallery img:hover {
        transform: scale(1.03);
        cursor: pointer;
    }

    .blog-quote {
        background-color: var(--bg-light);
        border-left: 4px solid var(--primary-color);
        padding: 20px;
        margin: 2rem 0;
        border-radius: 5px;
    }

    .blog-quote p {
        font-size: 1.2rem;
        font-style: italic;
        color: var(--text-dark);
        margin-bottom: 0.5rem;
    }

    .blog-quote cite {
        font-size: 0.9rem;
        color: var(--text-medium);
        font-weight: 600;
    }

    /* Blog Tags and Share */
    .blog-post-tags {
        margin: 2rem 0 1rem;
        padding-top: 1.5rem;
        border-top: 1px solid var(--border-color);
    }

    .blog-post-tags span {
        font-weight: 600;
        color: var(--text-dark);
        margin-right: 10px;
    }

    .blog-post-tags a {
        display: inline-block;
        background-color: var(--bg-light);
        color: var(--text-medium);
        padding: 5px 15px;
        border-radius: 20px;
        margin-right: 5px;
        margin-bottom: 5px;
        text-decoration: none;
        font-size: 0.9rem;
        transition: all 0.3s ease;
    }

    .blog-post-tags a:hover {
        background-color: var(--primary-light);
        color: var(--primary-color);
    }

    .blog-post-share {
        display: flex;
        align-items: center;
    }

    .blog-post-share span {
        font-weight: 600;
        color: var(--text-dark);
        margin-right: 15px;
    }

    .blog-post-share a {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 35px;
        height: 35px;
        border-radius: 50%;
        margin-right: 10px;
        color: var(--text-light);
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .blog-post-share a.facebook {
        background-color: #3b5998;
    }

    .blog-post-share a.twitter {
        background-color: #1da1f2;
    }

    .blog-post-share a.pinterest {
        background-color: #bd081c;
    }

    .blog-post-share a.whatsapp {
        background-color: #25d366;
    }

    .blog-post-share a:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
    }

    /* Author Box */
    .blog-author-box {
        display: flex;
        background-color: var(--bg-light);
        border-radius: var(--card-radius);
        padding: 1.5rem;
        margin: 2rem 0;
    }

    .author-img {
        flex: 0 0 80px;
        margin-right: 20px;
    }

    .author-img img {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 50%;
        border: 3px solid white;
        box-shadow: var(--card-shadow);
    }

    .author-info h4 {
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 10px;
    }

    .author-info p {
        font-size: 0.95rem;
        color: var(--text-medium);
        margin-bottom: 15px;
        line-height: 1.6;
    }

    .author-social a {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background-color: white;
        color: var(--text-medium);
        margin-right: 10px;
        text-decoration: none;
        transition: all 0.3s ease;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
    }

    .author-social a:hover {
        background-color: var(--primary-color);
        color: var(--text-light);
        transform: translateY(-2px);
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
    }

    /* Related Posts */
    .blog-related-posts {
        margin: 3rem 0;
    }

    .blog-related-posts h3 {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 1.5rem;
        position: relative;
    }

    .related-post-card img {
        width: 100%;
        height: 200px;
        object-fit: cover;
        border-radius: 8px;
        margin-bottom: 15px;
        transition: transform 0.3s ease;
    }

    .related-post-card:hover img {
        transform: scale(1.03);
    }

    .related-post-card h4 {
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 5px;
        line-height: 1.4;
    }

    .related-post-card h4 a {
        color: var(--text-dark);
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .related-post-card h4 a:hover {
        color: var(--primary-color);
    }

    .related-post-card .post-meta {
        font-size: 0.8rem;
        color: var(--text-medium);
    }

    .related-post-card .post-meta i {
        color: var(--primary-color);
        margin-right: 5px;
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

    /* Tags Widget */
    .tags-cloud {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }

    .tag {
        display: inline-block;
        background-color: var(--bg-light);
        color: var(--text-medium);
        padding: 5px 15px;
        border-radius: 20px;
        text-decoration: none;
        font-size: 0.9rem;
        transition: all 0.3s ease;
    }

    .tag:hover {
        background-color: var(--primary-light);
        color: var(--primary-color);
    }

    /* Responsive Styles */
    @media (max-width: 991px) {
        .blog-sidebar {
            margin-top: 2rem;
            position: static;
        }
    }

    /* Comments Section */
    .blog-comments {
        margin-top: 3rem;
    }

    .blog-comments h3 {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 1.5rem;
        position: relative;
    }

    .comment-form {
        background-color: var(--bg-light);
        border-radius: var(--card-radius);
        padding: 1.5rem;
        margin-bottom: 2rem;
    }

    .comment-form .form-control {
        border: 1px solid var(--border-color);
        border-radius: 8px;
        padding: 0.75rem;
    }

    .comment-form .form-control:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.2rem rgba(59, 130, 246, 0.25);
    }

    .comment-form textarea.form-control {
        min-height: 120px;
    }

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

    .comment-list {
        margin-top: 2rem;
    }

    .comment-item {
        display: flex;
        margin-bottom: 1.5rem;
        padding-bottom: 1.5rem;
        border-bottom: 1px solid var(--border-color);
    }

    .comment-item:last-child {
        border-bottom: none;
        padding-bottom: 0;
    }

    .comment-avatar {
        flex: 0 0 60px;
        margin-right: 15px;
    }

    .comment-avatar img {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        object-fit: cover;
    }

    .comment-content {
        flex: 1;
    }

    .comment-meta {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
    }

    .comment-author {
        font-weight: 600;
        color: var(--text-dark);
    }

    .comment-date {
        font-size: 0.85rem;
        color: var(--text-medium);
    }

    .comment-text {
        color: var(--text-medium);
        line-height: 1.6;
        margin-bottom: 10px;
    }

    .comment-reply {
        font-size: 0.9rem;
        color: var(--primary-color);
        font-weight: 500;
        cursor: pointer;
    }

    .comment-reply:hover {
        text-decoration: underline;
    }

    .comment-replies {
        margin-left: 75px;
        margin-top: 1.5rem;
    }

    @media (max-width: 767px) {
        .blog-hero-title {
            font-size: 2rem;
        }

        .blog-hero-meta {
            flex-wrap: wrap;
        }

        .blog-post-title {
            font-size: 1.8rem;
        }

        .blog-post-meta {
            flex-wrap: wrap;
        }

        .blog-post-content {
            padding: 1.5rem;
        }

        .blog-post-content h2 {
            font-size: 1.5rem;
        }

        .blog-post-content h3 {
            font-size: 1.3rem;
        }

        .blog-author-box {
            flex-direction: column;
            text-align: center;
        }

        .author-img {
            margin: 0 auto 15px;
        }

        .comment-replies {
            margin-left: 30px;
        }
    }
</style>
@endpush
<!-- Blog Hero Banner -->
<section class="blog-hero-banner">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 text-center">
                <div class="blog-category-label">{{ ucwords($blogContent->category) }}</div>
                <h1 class="blog-hero-title text-white">{{ $blogContent->title }}</h1>
                <div class="blog-hero-meta">
                    <span><i class="far fa-calendar-alt"></i>{{ \Carbon\Carbon::parse($blogContent->publish_date)->format('d F, Y ') }}</span>
                    <span><i class="far fa-user"></i> By {{ $blogContent->author }}</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Breadcrumb -->
<div class="blog-breadcrumb py-3">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/blogs') }}">Blog</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $blogContent->title }}</li>
            </ol>
        </nav>
    </div>
</div>

<!-- Blog Content Section -->
<section class="blog-content py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <article class="blog-post-content">
                    {!! $blogContent->content !!}
                    <div class="blog-post-tags mt-5">
                        <span>Tags:</span>
                        @php
                        $tags = explode(',',$blogContent->tags);
                        @endphp
                        @foreach ($tags as $tag)
                        <a href="#">{{ $tag }}</a>
                        @endforeach

                    </div>

                    <div class="blog-post-share mt-3">
                        <span>Share:</span>
                        <a href="#" class="facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="twitter"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="pinterest"><i class="fab fa-pinterest-p"></i></a>
                        <a href="#" class="whatsapp"><i class="fab fa-whatsapp"></i></a>
                    </div>





                    <!-- Comments Section -->

                </article>
                <div class="blog-related-posts mt-5">
                    <h3>Related Posts</h3>
                    <div class="row">
                        @foreach ($Listblogs->random(2) as $relatedBlog)

                        <div class="col-md-6 mb-4">
                            <div class="related-post-card">
                                <a href="{{ route('blogs.show',['blog' => $relatedBlog->slug]) }}">
                                    <img src="{{ $relatedBlog->photo->file }}" alt="{{ $relatedBlog->title }}"
                                        class="img-fluid rounded">
                                </a>
                                <h4 class="fw-bolder"><a
                                        href="{{ route('blogs.show',['blog' => $relatedBlog->slug]) }}">{{
                                        $relatedBlog->title }}</a></h4>
                                <div class="post-meta">
                                    <span><i class="far fa-calendar-alt"></i>{{ \Carbon\Carbon::parse($relatedBlog->publish_date)->format('F Y') }}</span>
                                </div>
                            </div>
                        </div>

                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="blog-sidebar">
                    <!-- Featured Posts Widget -->
                    <div class="sidebar-widget featured-posts-widget">
                        <h3 class="widget-title">Featured</h3>
                        <div class="widget-content">
                            <!-- Featured Post 1 -->

                            @foreach ($Listblogs->where('featured',1)->take(3) as $featuredBlog)
                            <div class="featured-post-item">
                                <div class="featured-post-img">
                                    <a href="{{ route('blogs.show' , ['blog' => $featuredBlog->slug]) }}">
                                        <img src="{{ $featuredBlog->photo->file }}" alt="{{ $featuredBlog->name }}"
                                            class="img-fluid">
                                    </a>
                                </div>
                                <div class="featured-post-info">
                                    <span class="post-date">{{ \Carbon\Carbon::parse($featuredBlog->publish_date)->format('F d, Y') }}</span>
                                    <h4><a href="{{ route('blogs.show' , ['blog' => $featuredBlog->slug]) }}">{{
                                            $featuredBlog->title }}</a></h4>
                                </div>
                            </div>
                            @endforeach




                        </div>
                    </div>

                    <!-- Latest Posts Widget -->
                    <div class="sidebar-widget latest-posts-widget">
                        <h3 class="widget-title">Latest</h3>
                        <div class="widget-content">
                            <!-- Latest Post 1 -->
                            @foreach($Listblogs->sortBy('publish_date')->take(3) as $latest)
                            <div class="latest-post-item">
                                <div class="latest-post-img">
                                    <a href="{{ route('blogs.show',['blog' => $latest->slug]) }}">
                                        <img src="{{ $latest->photo->file }}" alt="{{ $latest->title }}"
                                            class="img-fluid">
                                    </a>
                                </div>
                                <div class="latest-post-info">
                                    <span class="post-date">{{ \Carbon\Carbon::parse($latest->publish_date)->format('F d, Y') }}</span>
                                    <h4><a href="{{ route('blogs.show',['blog' => $latest->slug]) }}">{{ $latest->title
                                            }}</a></h4>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Tags Widget -->
                    <div class="sidebar-widget tags-widget">
                        <h3 class="widget-title">Popular Tags</h3>
                        <div class="widget-content">
                            @php
                            $allTags = [];

                            foreach ($Listblogs as $blog) {
                            if (!empty($blog->tags)) {
                            $blogTags = explode(',', $blog->tags); 
                            $allTags = array_merge($allTags, array_map('trim', $blogTags)); 
                            }
                            }

                            $tags = collect($allTags)->unique()->sort();
                            @endphp

                            <div class="tags-cloud">
                                @foreach ($tags as $tag)
                                <a href="{{ route('blogs.index', ['keyword' => $tag]) }}" class="tag">{{ $tag }}</a>
                                @endforeach
                            </div>

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
    // Image lightbox effect
    $('.blog-post-img img, .blog-gallery img').on('click', function() {
        var imgSrc = $(this).attr('src');
        $('body').append('<div class="img-lightbox"><img src="' + imgSrc +
            '"><span class="close-lightbox">&times;</span></div>');
        $('.img-lightbox').fadeIn(300);

        // Close lightbox on click
        $('.close-lightbox, .img-lightbox').on('click', function() {
            $('.img-lightbox').fadeOut(300, function() {
                $(this).remove();
            });
        });
    });

    // Prevent closing when clicking on the image itself
    $(document).on('click', '.img-lightbox img', function(e) {
        e.stopPropagation();
    });

    // Add lightbox styles dynamically
    $('<style>')
        .text(`
                .img-lightbox {
                    position: fixed;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    background-color: rgba(0, 0, 0, 0.9);
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    z-index: 9999;
                    cursor: pointer;
                }
                .img-lightbox img {
                    max-width: 90%;
                    max-height: 90%;
                    object-fit: contain;
                    cursor: default;
                }
                .close-lightbox {
                    position: absolute;
                    top: 20px;
                    right: 20px;
                    color: white;
                    font-size: 30px;
                    cursor: pointer;
                }
            `)
        .appendTo('head');

    // Share buttons functionality
    $('.blog-post-share a').on('click', function(e) {
        e.preventDefault();

        var url = window.location.href;
        var title = document.title;
        var shareUrl;

        if ($(this).hasClass('facebook')) {
            shareUrl = 'https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(url);
        } else if ($(this).hasClass('twitter')) {
            shareUrl = 'https://twitter.com/intent/tweet?url=' + encodeURIComponent(url) + '&text=' +
                encodeURIComponent(title);
        } else if ($(this).hasClass('pinterest')) {
            var img = $('.blog-post-img img').first().attr('src');
            shareUrl = 'https://pinterest.com/pin/create/button/?url=' + encodeURIComponent(url) +
                '&media=' + encodeURIComponent(img) + '&description=' + encodeURIComponent(title);
        } else if ($(this).hasClass('whatsapp')) {
            shareUrl = 'https://api.whatsapp.com/send?text=' + encodeURIComponent(title + ' ' + url);
        }

        window.open(shareUrl, '_blank', 'width=600,height=400');
    });

    // Animate elements on scroll
    function animateOnScroll() {
        $('.blog-post-content, .blog-sidebar, .related-post-card').each(function() {
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
                .blog-post-content, .blog-sidebar, .related-post-card {
                    opacity: 1;
                    transform: translateY(20px);
                    transition: opacity 0.5s ease, transform 0.5s ease;
                }

                .blog-post-content.visible, .blog-sidebar.visible, .related-post-card.visible {
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