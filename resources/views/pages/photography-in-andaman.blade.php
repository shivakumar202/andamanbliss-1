@extends('layouts.app')
@section('title', 'Professional Photography Services in Andaman | Wedding, Beach & Events')
@section('meta_description', 'Expert photography services in Andaman Islands. Specializing in wedding, beach, event, and
maternity photography. Capture your precious moments with our professional photographers.')

@push('styles')
<style>
/* Ultra-Modern Wedding Films Section Styles */
.wedding-films-section {
    background-color: #f9f9f9;
    position: relative;
    overflow: hidden;
}

.section-subtitle {
    display: block;
    font-size: 1rem;
    font-weight: 600;
    color: rgb(17, 157, 213);
    margin-bottom: 10px;
    text-transform: uppercase;
    letter-spacing: 2px;
}

.section-line {
    width: 80px;
    height: 3px;
    background-color: rgb(17, 157, 213);
    margin-bottom: 20px;
}

.main-video-card {
    height: 100%;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
}

.main-video-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
}

.video-card-inner {
    height: 100%;
    display: flex;
    flex-direction: column;
    background-color: #fff;
}

.video-wrapper {
    flex: 1;
    min-height: 350px;
}

.video-wedding {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.video-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.3);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: all 0.3s ease;
}

.video-wrapper:hover .video-overlay {
    opacity: 1;
}

.play-button {
    width: 80px;
    height: 80px;
    background-color: rgba(255, 255, 255, 0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 1.5rem;
    transition: all 0.3s ease;
    backdrop-filter: blur(5px);
    border: 2px solid rgba(255, 255, 255, 0.5);
}

.play-button:hover {
    transform: scale(1.1);
    background-color: #fd6e0f;
    border-color: #fd6e0f;
}

.video-info {
    background-color: #fff;
}

.video-title {
    font-size: 1.3rem;
    font-weight: 600;
    color: #333;
}

.video-duration {
    font-size: 0.9rem;
    color: #777;
    background-color: #f5f5f5;
    padding: 5px 10px;
    border-radius: 20px;
}

.video-meta {
    font-size: 0.9rem;
    color: #777;
}

.video-category,
.video-location {
    display: flex;
    align-items: center;
}

.films-content {
    height: 100%;
    padding: 30px;
    background-color: #fff;
    border-radius: 12px;
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
}

.films-title {
    font-size: 1.8rem;
    font-weight: 700;
    color: rgb(17, 157, 213);
    margin-bottom: 20px;
}

.films-description {
    font-size: 1.05rem;
    line-height: 1.7;
    color: #666;
}

.feature-icon {
    width: 50px;
    height: 50px;
    background-color: rgba(17, 157, 213, 0.1);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
    color: rgb(17, 157, 213);
    flex-shrink: 0;
    transition: all 0.3s ease;
}

.feature-item:hover .feature-icon {
    background-color: rgb(17, 157, 213);
    color: #fff;
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(17, 157, 213, 0.2);
}

.feature-title {
    font-size: 1.1rem;
    font-weight: 600;
    color: #333;
    margin-bottom: 5px;
}

.feature-text {
    font-size: 0.95rem;
    color: #666;
}

.btn-primary-action {
    display: inline-flex;
    align-items: center;
    padding: 12px 25px;
    background-color: #fd6e0f;
    color: #fff;
    font-size: 1rem;
    font-weight: 600;
    border-radius: 50px;
    transition: all 0.3s ease;
    text-decoration: none;
}

.btn-primary-action:hover {
    background-color: #e05d00;
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(253, 110, 15, 0.3);
    color: #fff;
}

.btn-secondary-action {
    display: inline-flex;
    align-items: center;
    padding: 12px 25px;
    background-color: transparent;
    color: rgb(17, 157, 213);
    font-size: 1rem;
    font-weight: 600;
    border-radius: 50px;
    border: 2px solid rgb(17, 157, 213);
    transition: all 0.3s ease;
    text-decoration: none;
}

.btn-secondary-action:hover {
    background-color: rgb(17, 157, 213);
    color: #fff;
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(17, 157, 213, 0.2);
}

.wedding-films-gallery {
    margin-top: 50px;
}

.gallery-item {
    height: 180px;
    transition: all 0.3s ease;
}

.gallery-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: all 0.5s ease;
}

.gallery-item:hover img {
    transform: scale(1.1);
}

.gallery-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: all 0.3s ease;
}

.gallery-item:hover .gallery-overlay {
    opacity: 1;
}

.gallery-icon {
    width: 50px;
    height: 50px;
    background-color: rgba(255, 255, 255, 0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 1rem;
    transition: all 0.3s ease;
}

.gallery-icon:hover {
    background-color: #fd6e0f;
    transform: scale(1.1);
}

/* Responsive Styles for Wedding Films */
@media (max-width: 991px) {
    .films-content {
        margin-top: 30px;
    }

    .video-wrapper {
        min-height: 300px;
    }
}

@media (max-width: 767px) {
    .play-button {
        width: 60px;
        height: 60px;
        font-size: 1.2rem;
    }

    .gallery-item {
        height: 150px;
    }
}

:root {
    --primary-color: rgb(17, 157, 213);
    --primary-light: rgba(17, 157, 213, 0.1);
    --primary-dark: rgb(12, 110, 149);
    --secondary-color: #fd6e0f;
    --secondary-light: rgba(253, 110, 15, 0.1);
    --secondary-dark: #d85a0a;
    --text-dark: #333;
    --text-light: #666;
    --white: #fff;
    --light-bg: #f8f9fa;
    --border-radius: 12px;
    --box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    --transition: all 0.3s ease;
}

/* Modern Hero Banner Section */
.hero-modern {
    position: relative;
    height: 100vh;
    overflow: hidden;
    background-color: #000;
}

.hero-slider {
    position: relative;
    height: 100%;
    width: 100%;
}

.hero-slide {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-size: cover;
    background-position: center;
    opacity: 0;
    transition: opacity 1s ease;
    z-index: 1;
}

.hero-slide.active {
    opacity: 1;
    z-index: 2;
}

.hero-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.4);
    z-index: 3;
}

.hero-content-photography {
    position: relative;
    z-index: 4;
    height: 100%;
    display: flex;
    align-items: center;
}

.hero-text {
    max-width: 700px;
    padding: 30px;
    background-color: rgba(0, 0, 0, 0.5);
    border-radius: var(--border-radius);
}

.hero-title {
    font-size: 2.5rem;
    font-weight: 800;
    line-height: 1.1;
    margin-bottom: 1.5rem;
    opacity: 0;
    transform: translateY(30px);
    animation: fadeInUp 1s forwards 0.5s;
}

.hero-subtitle {
    font-size: 1.5rem;
    margin-bottom: 2rem;
    opacity: 0;
    transform: translateY(30px);
    animation: fadeInUp 1s forwards 0.8s;
}

.hero-btn {
    opacity: 0;
    transform: translateY(30px);
    animation: fadeInUp 1s forwards 1.1s;
}

.btn-hero {
    background-color: var(--secondary-color);
    color: var(--white);
    border: none;
    padding: 1rem 2.5rem;
    font-size: 1.1rem;
    font-weight: 600;
    border-radius: 50px;
    text-transform: uppercase;
    letter-spacing: 1px;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
    z-index: 1;
}

.btn-hero:before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 0%;
    height: 100%;
    background-color: var(--primary-color);
    transition: all 0.4s ease;
    z-index: -1;
}

.btn-hero:hover:before {
    width: 100%;
}

.btn-hero:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
}

.scroll-down {
    position: absolute;
    bottom: 30px;
    left: 50%;
    transform: translateX(-50%);
    z-index: 5;
    opacity: 0;
    animation: fadeIn 1s forwards 1.5s;
}

.scroll-down a {
    color: var(--white);
    font-size: 1.2rem;
    display: flex;
    flex-direction: column;
    align-items: center;
    text-decoration: none;
}

.scroll-down i {
    font-size: 2rem;
    animation: bounce 2s infinite;
}

@keyframes fadeInUp {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes fadeIn {
    to {
        opacity: 1;
    }
}

@keyframes bounce {

    0%,
    20%,
    50%,
    80%,
    100% {
        transform: translateY(0);
    }

    40% {
        transform: translateY(-20px);
    }

    60% {
        transform: translateY(-10px);
    }
}

/* Hero Banner Section */
.hero-banner {
    position: relative;
    height: 85vh;
    overflow: hidden;
    margin-bottom: 0 !important;
}

.banner-slider {
    position: relative;
    width: 100%;
    height: 100%;
}

.slide {
    background-size: cover;
    background-position: center;
    position: relative;
}

.overlay {
    background: linear-gradient(135deg, rgba(17, 157, 213, 0.7) 0%, rgba(253, 110, 15, 0.7) 100%) !important;
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 1;
}

.hero-banner .container {
    position: relative;
    z-index: 2;
}

.animate-up {
    animation: fadeInUp 1s ease-out;
}

.animate-up-delay {
    animation: fadeInUp 1s ease-out 0.3s;
    animation-fill-mode: both;
}

.animate-up-delay-2 {
    animation: fadeInUp 1s ease-out 0.6s;
    animation-fill-mode: both;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Modern Services Section */
.services-section {
    padding: 100px 0;
    background-color: var(--white);
    position: relative;
    overflow: hidden;
}

.section-header {
    text-align: center;
    margin-bottom: 60px;
    position: relative;
    z-index: 1;
}

.section-subtitle {
    font-size: 1.1rem;
    font-weight: 600;
    color: var(--primary-color);
    text-transform: uppercase;
    letter-spacing: 3px;
    margin-bottom: 15px;
    display: block;
}

.section-title {
    font-size: 1.5rem;
    font-weight: 800;
    margin-bottom: 20px;
    color: var(--color-heading) !important;
    position: relative;
    display: inline-block;
}

.section-title .primary {
    color: var(--primary-color);
}

.section-title .secondary {
    color: var(--secondary-color);
}

.section-title::after {
    content: '';
    position: absolute;
    bottom: -15px;
    left: 50%;
    transform: translateX(-50%);
    width: 80px;
    height: 4px;
    background-color: var(--primary-color);
    border-radius: 2px;
}

.section-description {
    max-width: 700px;
    margin: 0 auto;
    color: var(--text-light);
    font-size: 1.1rem;
    line-height: 1.7;
}

/* New Service Card Design */
.service-card {
    background-color: var(--white);
    border-radius: var(--border-radius);
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    transition: all 0.4s ease;
    margin-bottom: 30px;
    position: relative;
    z-index: 1;
    height: 100%;
    border: 1px solid #f0f0f0;
}

.service-card:hover {
    transform: translateY(-15px);
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
    border-color: rgba(17, 157, 213, 0.2);
}

.service-icon {
    width: 70px;
    height: 70px;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: rgba(17, 157, 213, 0.1);
    color: var(--primary-color);
    font-size: 28px;
    border-radius: 50%;
    margin-bottom: 25px;
    transition: all 0.3s ease;
    z-index: 5;
}

.service-card:hover .service-icon {
    background-color: var(--primary-color);
    color: var(--white);
    transform: rotateY(180deg);
}

.service-img {
    position: relative;
    overflow: hidden;
    height: 220px;
}

.service-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: all 0.5s ease;
}

.service-card:hover .service-img img {
    transform: scale(1.1);
}

.service-badge {
    position: absolute;
    top: 20px;
    right: 20px;
    background-color: var(--primary-color);
    color: var(--white);
    font-size: 12px;
    font-weight: 600;
    padding: 5px 15px;
    border-radius: 30px;
    z-index: 2;
}

.service-content {
    padding: 25px;
    position: relative;
    background-color: var(--white);
}

.service-title {
    color: var(--text-dark);
    font-size: 1.5rem;
    font-weight: 700;
    margin-bottom: 15px;
    transition: all 0.3s ease;
}

.service-card:hover .service-title {
    color: var(--primary-color);
}

.service-description {
    color: var(--text-light);
    margin-bottom: 20px;
    line-height: 1.7;
}

.service-meta {
    display: flex;
    align-items: center;
    margin-bottom: 20px;
}

.service-meta-item {
    display: flex;
    align-items: center;
    margin-right: 20px;
    font-size: 14px;
    color: var(--text-light);
}

.service-meta-item i {
    color: var(--primary-color);
    margin-right: 5px;
    font-size: 16px;
}

.service-link {
    display: inline-flex;
    align-items: center;
    color: var(--primary-color);
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
    padding: 8px 0;
    border-bottom: 2px solid transparent;
}

.service-link:hover {
    color: var(--secondary-color);
    border-bottom-color: var(--secondary-color);
}

.service-link i {
    margin-left: 5px;
    transition: all 0.3s ease;
}

.service-link:hover i {
    transform: translateX(5px);
}

/* Wedding Film Section */
.wedding-film-section {
    position: relative;
    overflow: hidden;
    min-height: 75vh;
    padding: 80px 0;
}

.video-background {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 0;
}

.video-background video {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.video-background .overlay {
    background: rgba(0, 0, 0, 0.6);
}

.watch-btn {
    transition: var(--transition);
    border-width: 2px;
}

.watch-btn:hover {
    background-color: var(--white);
    color: var(--primary-color);
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
}

/* Wedding Look Section */
.wedding-look-section {
    padding: 80px 0;
    background: url('https://www.transparenttextures.com/patterns/diamond-upholstery.png') #f8f9fa;
}

/* Wedding Films Gallery Section */
.wedding-films {
    padding: 80px 0;
    background-color: #f9f9f9;
}

.video-card {
    border-radius: var(--border-radius);
    overflow: hidden;
    box-shadow: var(--box-shadow);
    transition: all 0.4s ease;
}

.video-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
}

.play-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.3);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: all 0.3s ease;
}

.video-wrapper:hover .play-overlay {
    opacity: 1;
}

.play-btn {
    width: 70px;
    height: 70px;
    background-color: rgba(255, 255, 255, 0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 1.5rem;
    transition: all 0.3s ease;
    backdrop-filter: blur(5px);
    border: 2px solid rgba(255, 255, 255, 0.5);
}

.play-btn:hover {
    transform: scale(1.1);
    background-color: var(--primary-color);
    border-color: var(--primary-color);
}

.video-info {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.video-duration {
    font-size: 0.9rem;
    color: #777;
    background-color: #f5f5f5;
    padding: 5px 10px;
    border-radius: 20px;
}

.feature-icon {
    width: 50px;
    height: 50px;
    background-color: var(--primary-light);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
    color: var(--primary-color);
    transition: all 0.3s ease;
}

.feature-item:hover .feature-icon {
    background-color: var(--primary-color);
    color: #fff;
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(17, 157, 213, 0.2);
}

.video-wrapper {
    border-radius: var(--border-radius);
    overflow: hidden;
    box-shadow: var(--box-shadow);
}

.video-wedding {
    width: 100%;
    height: 400px;
    object-fit: cover;
}

/* Team Section */
.team-section {
    padding: 80px 0;
    background-color: var(--light-bg);
}

.team-member {
    height: 400px;
    border-radius: var(--border-radius);
    overflow: hidden;
    box-shadow: var(--box-shadow);
    transition: var(--transition);
}

.team-member:hover {
    transform: translateY(-10px);
}

.about-content {
    height: 100%;
    padding: 2rem;
    background-color: var(--white);
    border-radius: var(--border-radius);
    box-shadow: var(--box-shadow);
}

.fas.fa-check-circle {
    color: var(--secondary-color) !important;
}

/* Booking Section */
.booking-section {
    position: relative;
    padding: 80px 0;
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
}

.booking-section .overlay {
    background: rgba(0, 0, 0, 0.7);
}

.booking-form {
    background-color: var(--white);
    border-radius: var(--border-radius);
    box-shadow: var(--box-shadow);
    padding: 2rem;
}

.booking-form .form-control,
.booking-form .form-select {
    border: 1px solid #dee2e6;
    padding: 0.75rem 1rem;
    border-radius: 50px;
    font-size: 1rem;
    transition: var(--transition);
}

.booking-form .form-control:focus,
.booking-form .form-select:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 0.25rem var(--primary-light);
}

.btn-primary {
    background-color: var(--secondary-color) !important;
    border-color: var(--secondary-color) !important;
    color: var(--white);
    transition: var(--transition);
}

.btn-primary:hover {
    background-color: var(--secondary-dark) !important;
    border-color: var(--secondary-dark) !important;
    transform: translateY(-3px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
}

/* Other Services Section */
.other-services {
    padding: 80px 0;
    background-color: var(--light-bg);
}

.service-card {
    transition: var(--transition);
    border-radius: var(--border-radius);
    overflow: hidden;
    box-shadow: var(--box-shadow);
    margin-bottom: 30px;
}

.service-card:hover {
    transform: translateY(-10px);
}

.other-services .service-content {
    background-color: rgba(17, 157, 213, 0.8);
    padding: 2rem;
    transition: var(--transition);
}

.other-services .service-card:hover .service-content {
    background-color: rgba(17, 157, 213, 0.9);
}

/* Modern Portfolio Section */
.portfolio-section {
    padding: 100px 0;
    background-color: var(--white);
    position: relative;
    overflow: hidden;
}



.portfolio-filter {
    display: flex;
    justify-content: center;
    margin-bottom: 40px;
    position: relative;
    z-index: 1;
}

.filter-btn {
    background: none;
    border: none;
    padding: 8px 20px;
    margin: 0 5px;
    font-size: 1rem;
    font-weight: 600;
    color: var(--text-light);
    border-radius: 30px;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.filter-btn::before {
    content: '';
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 0;
    height: 2px;
    background-color: var(--primary-color);
    transition: all 0.3s ease;
}

.filter-btn:hover,
.filter-btn.active {
    color: var(--primary-color);
}

.filter-btn:hover::before,
.filter-btn.active::before {
    width: 80%;
}

.filter-btn.active {
    background-color: var(--primary-light);
}

.portfolio-grid {
    position: relative;
    z-index: 1;
}

.portfolio-item {
    margin-bottom: 30px;
    position: relative;
    overflow: hidden;
    border-radius: var(--border-radius);
    box-shadow: var(--box-shadow);
    transition: all 0.4s ease;
    opacity: 1;
    transform: scale(1);
}

.portfolio-item:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
}

.portfolio-img {
    position: relative;
    overflow: hidden;
    height: 300px;
}

.portfolio-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: all 0.5s ease;
}

.portfolio-item:hover .portfolio-img img {
    transform: scale(1.1);
}

.portfolio-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(to bottom, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.8));
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
    padding: 20px;
    opacity: 0;
    transition: all 0.3s ease;
}

.portfolio-item:hover .portfolio-overlay {
    opacity: 1;
}

.portfolio-category {
    color: var(--white);
    font-size: 0.9rem;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 5px;
}

.portfolio-title {
    color: var(--white);
    font-size: 1.5rem;
    font-weight: 700;
    margin-bottom: 10px;
}

.portfolio-links {
    display: flex;
    gap: 10px;
}

.portfolio-link {
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: rgba(255, 255, 255, 0.2);
    color: var(--white);
    border-radius: 50%;
    transition: all 0.3s ease;
}

.portfolio-link:hover {
    background-color: var(--primary-color);
    color: var(--white);
    transform: translateY(-3px);
}

.portfolio-btn {
    text-align: center;
    margin-top: 40px;
}

.btn-view-more {
    background-color: transparent;
    color: var(--primary-color);
    border: 2px solid var(--primary-color);
    padding: 12px 30px;
    font-size: 1rem;
    font-weight: 600;
    border-radius: 50px;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
    z-index: 1;
}

.btn-view-more::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 0%;
    height: 100%;
    background-color: var(--primary-color);
    transition: all 0.4s ease;
    z-index: -1;
}

.btn-view-more:hover::before {
    width: 100%;
}

.btn-view-more:hover {
    color: var(--white);
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
}

/* Pricing Section */
.pricing-section {
    padding: 80px 0;
    background-color: var(--white);
}

.table {
    border-collapse: separate;
    border-spacing: 0;
    box-shadow: var(--box-shadow);
    border-radius: var(--border-radius);
    overflow: hidden;
}

.table th {
    border: none;
    background-color: var(--white);
    font-weight: 600;
    padding: 1.5rem;
}

.table td {
    border-top: 1px solid #dee2e6;
    padding: 1.2rem 1.5rem;
    vertical-align: middle;
}

.table tr:hover td:not(.border-bottom-0) {
    background-color: rgba(0, 0, 0, 0.02);
}

.price-text .display-6 {
    color: var(--secondary-color);
}

.badge {
    font-weight: 500;
    letter-spacing: 0.5px;
    background-color: var(--primary-color) !important;
}

.btn-outline-primary {
    color: var(--primary-color);
    border-color: var(--primary-color);
}

.btn-outline-primary:hover {
    background-color: var(--primary-color);
    border-color: var(--primary-color);
    color: var(--white);
    transform: translateY(-3px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
}

/* Contact Section */
.contact-section {
    padding: 80px 0;
    background-color: #333;
}

.contact-info i {
    font-size: 1.5rem;
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    background-color: rgba(255, 255, 255, 0.1);
}

.map-container {
    border-radius: var(--border-radius);
    overflow: hidden;
    box-shadow: var(--box-shadow);
}

/* Responsive Styles */
@media (max-width: 991px) {
    .hero-banner {
        height: 70vh;
    }

    .wedding-film-section,
    .booking-section {
        min-height: auto;
        padding: 60px 0;
    }

    .categories-section,
    .wedding-films,
    .team-section,
    .other-services,
    .gallery-section,
    .pricing-section,
    .contact-section {
        padding: 60px 0;
    }

    .video-wedding {
        height: 300px;
    }
}

@media (max-width: 767px) {
    .hero-banner {
        height: 60vh;
    }

    .hero-banner h1 {
        font-size: 2.5rem;
    }

    .hero-banner p {
        font-size: 1.2rem;
    }

    .categories-section,
    .wedding-films,
    .team-section,
    .booking-section,
    .other-services,
    .gallery-section,
    .pricing-section,
    .contact-section {
        padding: 40px 0;
    }

    .booking-form .row {
        flex-direction: column;
    }

    .booking-form .col {
        margin-bottom: 15px;
    }
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Hero Slider Functionality
    const slides = document.querySelectorAll('.hero-slide');
    let currentSlide = 0;

    function showSlide(index) {
        slides.forEach(slide => slide.classList.remove('active'));
        slides[index].classList.add('active');
    }

    function nextSlide() {
        currentSlide = (currentSlide + 1) % slides.length;
        showSlide(currentSlide);
    }

    // Change slide every 5 seconds
    setInterval(nextSlide, 5000);

    // Services Tabs Functionality
    const tabBtns = document.querySelectorAll('.tab-btn');
    const tabContents = document.querySelectorAll('.tab-content');

    tabBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const tabId = this.getAttribute('data-tab');

            // Remove active class from all buttons and contents
            tabBtns.forEach(btn => btn.classList.remove('active'));
            tabContents.forEach(content => content.classList.remove('active'));

            // Add active class to current button and content
            this.classList.add('active');
            document.querySelector(`.tab-content[data-tab="${tabId}"]`).classList.add('active');
        });
    });

    // Portfolio Filter Functionality
    const categoryBtns = document.querySelectorAll('.category-btn');
    const portfolioItems = document.querySelectorAll('.portfolio-item');

    categoryBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            // Remove active class from all buttons
            categoryBtns.forEach(btn => btn.classList.remove('active'));

            // Add active class to clicked button
            this.classList.add('active');

            // Get filter value
            const filterValue = this.getAttribute('data-filter');

            // Filter portfolio items with animation
            if (filterValue === 'all') {
                // Show all items
                portfolioItems.forEach(item => {
                    item.style.display = 'block';
                    setTimeout(() => {
                        item.style.opacity = '1';
                        item.style.transform = 'translateY(0)';
                    }, 50);
                });
            } else {
                // Filter items
                portfolioItems.forEach(item => {
                    if (item.getAttribute('data-category') === filterValue) {
                        item.style.display = 'block';
                        setTimeout(() => {
                            item.style.opacity = '1';
                            item.style.transform = 'translateY(0)';
                        }, 50);
                    } else {
                        item.style.opacity = '0';
                        item.style.transform = 'translateY(20px)';
                        setTimeout(() => {
                            item.style.display = 'none';
                        }, 300);
                    }
                });
            }
        });
    });

    // Initialize portfolio items for animation
    portfolioItems.forEach(item => {
        item.style.opacity = '1';
        item.style.transform = 'translateY(0)';
        item.style.transition = 'all 0.4s ease';
    });

    // Portfolio Lightbox Functionality
    const viewBtns = document.querySelectorAll('.view-btn');

    viewBtns.forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const portfolioCard = this.closest('.portfolio-card');
            const imgSrc = portfolioCard.querySelector('.portfolio-img img').getAttribute(
                'src');
            const title = portfolioCard.querySelector('.portfolio-title').textContent;
            const category = portfolioCard.querySelector('.portfolio-category').textContent;

            // Create lightbox elements
            const lightbox = document.createElement('div');
            lightbox.className = 'portfolio-lightbox';

            lightbox.innerHTML = `
                        <div class="lightbox-content">
                            <span class="lightbox-close">&times;</span>
                            <img src="${imgSrc}" alt="${title}">
                            <h3>${title}</h3>
                            <p>${category}</p>
                        </div>
                    `;

            // Add lightbox to body
            document.body.appendChild(lightbox);

            // Prevent body scrolling
            document.body.style.overflow = 'hidden';

            // Close lightbox on click
            lightbox.addEventListener('click', function() {
                this.remove();
                document.body.style.overflow = 'auto';
            });
        });
    });


});
</script>

<style>
/* Lightbox Styles */
.portfolio-lightbox {
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
    padding: 30px;
}

.lightbox-content {
    position: relative;
    max-width: 90%;
    max-height: 90%;
    text-align: center;
}

.lightbox-content img {
    max-width: 100%;
    max-height: 80vh;
    border: 5px solid rgba(255, 255, 255, 0.1);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
}

.lightbox-content h3 {
    color: #fff;
    margin-top: 20px;
    font-size: 1.5rem;
}

.lightbox-close {
    position: absolute;
    top: -40px;
    right: 0;
    color: #fff;
    font-size: 2rem;
    cursor: pointer;
    transition: all 0.3s ease;
}

.lightbox-close:hover {
    color: rgb(17, 157, 213);
    transform: rotate(90deg);
}
</style>
@endpush

@section('content')
<!-- Professional Hero Section -->
<section id="hero" class="hero-section">
    <div class="hero-slideshow">
        <div class="hero-slide active">
            <img src="{{asset('site/img/photoshoot-in-andaman/photoshoot_b3.JPG')}}"
                alt="Professional Photography">
        </div>
        <div class="hero-slide">
            <img src="{{asset('site/img/photoshoot-in-andaman/photoshoot_b2.JPG')}}"
                alt="Wedding Photography">
        </div>
        <div class="hero-slide">
            <img src="{{asset('site/img/photoshoot-in-andaman/photoshoot_b1.JPG')}}"
                alt="Beach Photography">
        </div>
    </div>

    <div class="hero-content-photography">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="hero-text">
                        <div class="hero-subtitle">Andaman Islands Premier Photography</div>
                        <h1 class="hero-title">Capturing <span class="highlight">Life's</span> Most Beautiful <span
                                class="highlight-secondary">Moments</span></h1>
                        <p class="hero-description">Professional photography services that transform ordinary moments
                            into extraordinary memories across the breathtaking Andaman Islands.</p>
                        <div class="hero-buttons">
                            <a href="#portfolio" class="btn btn-primary">View Portfolio</a>
                            <a href="#booking" class="btn btn-outline">Book a Session</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="hero-social">
        <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
        <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
        <a href="#" class="social-link"><i class="fab fa-pinterest-p"></i></a>
    </div>

    <div class="scroll-down">
        <a href="#services">
            <span>Explore</span>
            <i class="fas fa-chevron-down"></i>
        </a>
    </div>
</section>

@push('styles')
<style>
/* Hero Section Styles */
.hero-section {
    position: relative;
    height: 100vh;
    min-height: 700px;
    overflow: hidden;
    background-color: #000;
}

.hero-slideshow {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 1;
}

.hero-slide {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
    transition: opacity 1.5s ease;
    z-index: 1;
}

.hero-slide.active {
    opacity: 0.7;
    z-index: 2;
}

.hero-slide img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
}

.hero-content-photography {
    position: relative;
    z-index: 3;
    height: 100%;
    display: flex;
    align-items: center;
    color: #fff;
}

.hero-text {
    position: relative;
    max-width: 650px;
    animation: fadeInUp 1s ease-out;
}

.hero-subtitle {
    font-size: 1.2rem;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 3px;
    margin-bottom: 20px;
    color: rgb(17, 157, 213);
    position: relative;
    display: inline-block;
    padding-left: 60px;
}

.hero-subtitle:before {
    content: '';
    position: absolute;
    top: 50%;
    left: 0;
    width: 50px;
    height: 1px;
    background-color: rgb(17, 157, 213);
}

.hero-title {
    font-size: 2.5rem;
    font-weight: 800;
    line-height: 1.2;
    margin-bottom: 25px;
    color: #fff;
}

.hero-title .highlight {
    color: rgb(17, 157, 213);
    position: relative;
    display: inline-block;
}

.hero-title .highlight-secondary {
    color: #fd6e0f;
    position: relative;
    display: inline-block;
}

.hero-description {
    font-size: 1.1rem;
    line-height: 1.8;
    margin-bottom: 35px;
    color: rgba(255, 255, 255, 0.9);
}

.hero-buttons {
    display: flex;
    gap: 15px;
}

.btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 15px 35px;
    font-size: 1rem;
    font-weight: 600;
    border-radius: 50px;
    text-transform: uppercase;
    letter-spacing: 1px;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
    z-index: 1;
}

.btn:before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 0%;
    height: 100%;
    background-color: rgba(255, 255, 255, 0.1);
    transition: all 0.5s ease;
    z-index: -1;
}

.btn:hover:before {
    width: 100%;
}

.btn-primary {
    background-color: rgb(17, 157, 213);
    color: #fff;
    border: none;
}

.btn-primary:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 20px rgba(17, 157, 213, 0.3);
}

.btn-outline {
    background-color: transparent;
    color: #fff;
    border: 2px solid rgba(255, 255, 255, 0.3);
}

.btn-outline:hover {
    border-color: #fff;
    transform: translateY(-3px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
}

.hero-social {
    position: absolute;
    bottom: 50px;
    right: 50px;
    z-index: 3;
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.social-link {
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 1.2rem;
    border: 1px solid rgba(255, 255, 255, 0.3);
    border-radius: 50%;
    transition: all 0.3s ease;
}

.social-link:hover {
    background-color: rgb(17, 157, 213);
    border-color: rgb(17, 157, 213);
    transform: translateY(-3px);
}

.scroll-down {
    position: absolute;
    bottom: 30px;
    left: 50%;
    transform: translateX(-50%);
    z-index: 3;
    text-align: center;
    animation: bounce 2s infinite;
}

.scroll-down a {
    color: #fff;
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 2px;
    display: flex;
    flex-direction: column;
    align-items: center;
    transition: all 0.3s ease;
}

.scroll-down a:hover {
    color: rgb(17, 157, 213);
}

.scroll-down i {
    margin-top: 8px;
    font-size: 1.2rem;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
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
        transform: translateY(-20px) translateX(-50%);
    }

    60% {
        transform: translateY(-10px) translateX(-50%);
    }
}

/* Responsive Styles */
@media (max-width: 991px) {
    .hero-title {
        font-size: 3.5rem;
    }

    .hero-social {
        right: 30px;
        bottom: 30px;
    }
}

@media (max-width: 767px) {
    .hero-section {
        height: 90vh;
    }

    .hero-title {
        font-size: 2.5rem;
    }

    .hero-subtitle {
        font-size: 1rem;
    }

    .hero-description {
        font-size: 1rem;
    }

    .hero-buttons {
        flex-direction: column;
        gap: 10px;
    }

    .btn {
        width: 100%;
    }

    .hero-social {
        flex-direction: row;
        bottom: 100px;
        right: 50%;
        transform: translateX(50%);
    }
}
</style>
@endpush

<!-- Ultra-Modern Services Section -->
<section id="services" class="services-section">
    <div class="container-fluid px-lg-5">
        <div class="section-header">
            <div class="section-header-inner">
                <span class="section-subtitle">Our Expertise</span>
                <h2 class="section-title">Exceptional <span>Photography Services</span></h2>
                <div class="section-line"></div>
            </div>
            <p class="section-description">Discover our range of professional photography services tailored to capture
                your most precious moments in the stunning backdrop of Andaman Islands.</p>
        </div>

        <div class="services-wrapper">
            <div class="services-tabs">
                <div class="tab-buttons">
                    <button class="tab-btn active" data-tab="wedding">
                        <div class="tab-icon"><i class="fas fa-heart"></i></div>
                        <span>Beach Wedding</span>
                    </button>
                    <button class="tab-btn" data-tab="maternity">
                        <div class="tab-icon"><i class="fas fa-heart"></i></div>
                        <span>Pre-Wedding Shoots</span>
                    </button>
                    <button class="tab-btn" data-tab="beach">
                        <div class="tab-icon"><i class="fas fa-umbrella-beach"></i></div>
                        <span>Couple Stories</span>
                    </button>
                    <button class="tab-btn" data-tab="event">
                        <div class="tab-icon"><i class="fas fa-glass-cheers"></i></div>
                        <span>Honeymoon Moments</span>
                    </button>
                    
                    <button class="tab-btn" data-tab="fashion">
                        <div class="tab-icon"><i class="fas fa-tshirt"></i></div>
                        <span>Proposal Shoots</span>
                    </button>
                    <button class="tab-btn" data-tab="corporate">
                        <div class="tab-icon"><i class="fas fa-building"></i></div>
                        <span>Family & Friends</span>
                    </button>
                </div>

                <div class="tab-contents">
                    <div class="tab-content active" data-tab="wedding">
                        <div class="service-detail">
                            <div class="service-detail-content">
                                <div class="service-badge">Most Popular</div>
                                <h3>Wedding Photography</h3>
                                <p>Our wedding photography captures the essence of your special day with a perfect blend
                                    of candid moments and artistic portraits. We focus on telling your unique love story
                                    through our lens.</p>

                                <div class="service-highlights">
                                    <div class="highlight-item">
                                        <div class="highlight-icon"><i class="fas fa-clock"></i></div>
                                        <div class="highlight-text">
                                            <h4>Duration</h4>
                                            <p>8-12 Hours of Coverage</p>
                                        </div>
                                    </div>
                                    <div class="highlight-item">
                                        <div class="highlight-icon"><i class="fas fa-images"></i></div>
                                        <div class="highlight-text">
                                            <h4>Deliverables</h4>
                                            <p>300+ Edited Photos</p>
                                        </div>
                                    </div>
                                    <div class="highlight-item">
                                        <div class="highlight-icon"><i class="fas fa-film"></i></div>
                                        <div class="highlight-text">
                                            <h4>Bonus</h4>
                                            <p>Highlight Video Included</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="service-price">
                                    <div class="price">₹25,000</div>
                                    <div class="price-text">Starting Price</div>
                                </div>

                                <a href="#booking" class="service-cta">Book This Package</a>
                            </div>
                            <div class="service-detail-image">
                                <img src="{{ asset('site/img/photoshoot-in-andaman/honeymoon_photoshoot.webp') }}"
                                    alt="Wedding Photography">
                            </div>
                        </div>
                    </div>

                    <div class="tab-content" data-tab="Couple Stories">
                        <div class="service-detail">
                            <div class="service-detail-content">
                                <h3>Beach Photography</h3>
                                <p>Capture stunning moments against the backdrop of Andaman's pristine beaches,
                                    crystal-clear waters, and breathtaking sunsets. Perfect for couples, families, or
                                    solo travelers.</p>

                                <div class="service-highlights">
                                    <div class="highlight-item">
                                        <div class="highlight-icon"><i class="fas fa-clock"></i></div>
                                        <div class="highlight-text">
                                            <h4>Duration</h4>
                                            <p>2-4 Hours of Coverage</p>
                                        </div>
                                    </div>
                                    <div class="highlight-item">
                                        <div class="highlight-icon"><i class="fas fa-images"></i></div>
                                        <div class="highlight-text">
                                            <h4>Deliverables</h4>
                                            <p>100+ Edited Photos</p>
                                        </div>
                                    </div>
                                    <div class="highlight-item">
                                        <div class="highlight-icon"><i class="fas fa-map-marker-alt"></i></div>
                                        <div class="highlight-text">
                                            <h4>Locations</h4>
                                            <p>Multiple Beach Locations</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="service-price">
                                    <div class="price">₹12,000</div>
                                    <div class="price-text">Starting Price</div>
                                </div>

                                <a href="#booking" class="service-cta">Book This Package</a>
                            </div>
                            <div class="service-detail-image">
                                <img src="https://images.unsplash.com/photo-1506929562872-bb421503ef21?w=1600&auto=format&fit=crop&q=80"
                                    alt="Beach Photography">
                            </div>
                        </div>
                    </div>

                    <div class="tab-content" data-tab="event">
                        <div class="service-detail">
                            <div class="service-detail-content">
                                <h3>Honeymoon Photography</h3>
                                <p>From corporate gatherings to family celebrations, our event photography services
                                    ensure every important moment is beautifully preserved with attention to detail and
                                    candid emotions.</p>

                                <div class="service-highlights">
                                    <div class="highlight-item">
                                        <div class="highlight-icon"><i class="fas fa-clock"></i></div>
                                        <div class="highlight-text">
                                            <h4>Duration</h4>
                                            <p>4-8 Hours of Coverage</p>
                                        </div>
                                    </div>
                                    <div class="highlight-item">
                                        <div class="highlight-icon"><i class="fas fa-images"></i></div>
                                        <div class="highlight-text">
                                            <h4>Deliverables</h4>
                                            <p>200+ Edited Photos</p>
                                        </div>
                                    </div>
                                    <div class="highlight-item">
                                        <div class="highlight-icon"><i class="fas fa-users"></i></div>
                                        <div class="highlight-text">
                                            <h4>Included</h4>
                                            <p>Group Portraits & Candids</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="service-price">
                                    <div class="price">₹18,000</div>
                                    <div class="price-text">Starting Price</div>
                                </div>

                                <a href="#booking" class="service-cta">Book This Package</a>
                            </div>
                            <div class="service-detail-image">
                                <img src="{{asset('site/img/photoshoot-in-andaman/photoshoot_b2.JPG')}}"
                                    alt="Event Photography">
                            </div>
                        </div>
                    </div>

                    <div class="tab-content" data-tab="maternity">
                        <div class="service-detail">
                            <div class="service-detail-content">
                                <h3>Pre Wedding Photography</h3>
                                <p>Celebrate the magic of your love, before your big day with our stunning pre-wedding photography sessions in the breathtaking Andaman Islands. At Andaman Bliss™, we turn moments into lifelong memories with a blend of romance, love, and creativity that perfectly captures the chemistry that you hold together.</p>

                                <div class="service-highlights">
                                    <div class="highlight-item">
                                        <div class="highlight-icon"><i class="fas fa-clock"></i></div>
                                        <div class="highlight-text">
                                            <h4>Duration</h4>
                                            <p>1–2 Hours of Coverage</p>
                                        </div>
                                    </div>
                                    <div class="highlight-item">
                                        <div class="highlight-icon"><i class="fas fa-images"></i></div>
                                        <div class="highlight-text">
                                            <h4>Deliverables</h4>
                                            <p>50+ Professionally Edited Photos</p>
                                        </div>
                                    </div>
                                    <div class="highlight-item">
                                        <div class="highlight-icon"><i class="fas fa-tshirt"></i></div>
                                        <div class="highlight-text">
                                            <h4>Included</h4>
                                            <p>Multiple Outfit Changes</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="service-price">
                                    <div class="price">₹10,000</div>
                                    <div class="price-text">Starting Price</div>
                                </div>

                                <a href="#booking" class="service-cta">Book This Package</a>
                            </div>
                            <div class="service-detail-image">
                                <img src="{{asset('site/img/photoshoot-in-andaman/home_honeymoon1 (2).webp')}}"
                                    alt="Maternity Photography">
                            </div>
                        </div>
                    </div>

                    <div class="tab-content" data-tab="fashion">
                        <div class="service-detail">
                            <div class="service-detail-content">
                                <div class="service-badge">New Service</div>
                                <h3>Proposal Shoots</h3>
                                <p>Showcase your style with our professional fashion photography services, perfect for
                                    portfolios and brand campaigns. We bring creative direction and technical expertise
                                    to every shoot.</p>

                                <div class="service-highlights">
                                    <div class="highlight-item">
                                        <div class="highlight-icon"><i class="fas fa-clock"></i></div>
                                        <div class="highlight-text">
                                            <h4>Duration</h4>
                                            <p>3-5 Hours of Coverage</p>
                                        </div>
                                    </div>
                                    <div class="highlight-item">
                                        <div class="highlight-icon"><i class="fas fa-images"></i></div>
                                        <div class="highlight-text">
                                            <h4>Deliverables</h4>
                                            <p>100+ Edited Photos</p>
                                        </div>
                                    </div>
                                    <div class="highlight-item">
                                        <div class="highlight-icon"><i class="fas fa-lightbulb"></i></div>
                                        <div class="highlight-text">
                                            <h4>Included</h4>
                                            <p>Professional Lighting Setup</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="service-price">
                                    <div class="price">₹15,000</div>
                                    <div class="price-text">Starting Price</div>
                                </div>

                                <a href="#booking" class="service-cta">Book This Package</a>
                            </div>
                            <div class="service-detail-image">
                                <img src="{{asset('site/img/photoshoot-in-andaman/honeymoon_photoshoot.webp')}}"
                                    alt="Fashion Photography">
                            </div>
                        </div>
                    </div>

                    <div class="tab-content" data-tab="corporate">
                        <div class="service-detail">
                            <div class="service-detail-content">
                                <h3>Family Photography</h3>
                                <p>Professional photography for business needs, including corporate portraits, team
                                    photos, and workplace environment shots. We help you create a professional image for
                                    your brand.</p>

                                <div class="service-highlights">
                                    <div class="highlight-item">
                                        <div class="highlight-icon"><i class="fas fa-clock"></i></div>
                                        <div class="highlight-text">
                                            <h4>Duration</h4>
                                            <p>4-6 Hours of Coverage</p>
                                        </div>
                                    </div>
                                    <div class="highlight-item">
                                        <div class="highlight-icon"><i class="fas fa-images"></i></div>
                                        <div class="highlight-text">
                                            <h4>Deliverables</h4>
                                            <p>150+ Edited Photos</p>
                                        </div>
                                    </div>
                                    <div class="highlight-item">
                                        <div class="highlight-icon"><i class="fas fa-id-card"></i></div>
                                        <div class="highlight-text">
                                            <h4>Included</h4>
                                            <p>Professional Headshots</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="service-price">
                                    <div class="price">₹20,000</div>
                                    <div class="price-text">Starting Price</div>
                                </div>

                                <a href="#booking" class="service-cta">Book This Package</a>
                            </div>
                            <div class="service-detail-image">
                                <img src="{{asset ('site/img/photoshoot-in-andaman/home_family1.jpg')}}"
                                    alt="Corporate Photography">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@push('styles')
<style>
/* Ultra-Modern Services Section Styles */
.services-section {
    padding: 120px 0;
    background-color: #f9f9f9;
    position: relative;
    overflow: hidden;
}

.section-header {
    text-align: center;
    margin-bottom: 70px;
    position: relative;
}

.section-header-inner {
    display: inline-block;
    position: relative;
}

.section-subtitle {
    font-size: 1rem;
    font-weight: 600;
    color: rgb(17, 157, 213);
    text-transform: uppercase;
    letter-spacing: 3px;
    margin-bottom: 15px;
    display: block;
    position: relative;
}

.section-subtitle:before,
.section-subtitle:after {
    content: '';
    position: absolute;
    top: 50%;
    width: 30px;
    height: 1px;
    background-color: rgb(17, 157, 213);
    opacity: 0.5;
}

.section-subtitle:before {
    left: -40px;
}

.section-subtitle:after {
    right: -40px;
}

.section-title {
    font-size: 1.5rem;
    font-weight: 800;
    margin-bottom: 25px;
    color: #333;
    position: relative;
}

.section-title span {
    background: linear-gradient(to right, #f9925a, var(--color-secondary));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    color: var(--color-secondary);
    position: relative;
}

.section-line {
    width: 80px;
    height: 3px;
    background-color: rgb(17, 157, 213);
    margin: 0 auto;
    position: relative;
}

.section-line:before,
.section-line:after {
    content: '';
    position: absolute;
    top: 0;
    width: 10px;
    height: 3px;
    background-color: #fd6e0f;
}

.section-line:before {
    left: -15px;
}

.section-line:after {
    right: -15px;
}

.section-description {
    max-width: 700px;
    margin: 30px auto 0;
    color: #777;
    font-size: 1.1rem;
    line-height: 1.7;
}

/* Services Tabs */
.services-wrapper {
    position: relative;
    max-width: 1200px;
    margin: 0 auto;
}

.services-tabs {
    background-color: #fff;
    border-radius: 15px;
    box-shadow: 0 15px 50px rgba(0, 0, 0, 0.05);
    overflow: hidden;
}

.tab-buttons {
    display: flex;
    justify-content: space-between;
    background-color: #f5f9ff;
    padding: 15px;
    border-bottom: 1px solid rgba(17, 157, 213, 0.1);
}

.tab-btn {
    background: none;
    border: none;
    padding: 15px 20px;
    font-size: 0.8rem;
    font-weight: 600;
    color: #777;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 10px;
    transition: all 0.3s ease;
    position: relative;
    cursor: pointer;
    flex: 1;
}

.tab-btn:after {
    content: '';
    position: absolute;
    bottom: -15px;
    left: 50%;
    transform: translateX(-50%);
    width: 0;
    height: 3px;
    background-color: rgb(17, 157, 213);
    transition: all 0.3s ease;
}

.tab-btn.active {
    color: rgb(17, 157, 213);
}

.tab-btn.active:after {
    width: 100%;
}

.tab-icon {
    width: 60px;
    height: 60px;
    background-color: #fff;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    color: #777;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
}

.tab-btn.active .tab-icon {
    background-color: rgb(17, 157, 213);
    color: #fff;
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(17, 157, 213, 0.2);
}

.tab-btn:hover .tab-icon {
    transform: translateY(-5px);
}

.tab-contents {
    position: relative;
    padding: 40px;
}

.tab-content {
    display: none;
    animation: fadeIn 0.5s ease forwards;
}

.tab-content.active {
    display: block;
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

.service-detail {
    display: flex;
    align-items: center;
    gap: 50px;
}

.service-detail-content {
    flex: 1;
    position: relative;
}

.service-badge {
    display: inline-block;
    background-color: #fd6e0f;
    color: #fff;
    font-size: 0.8rem;
    font-weight: 600;
    padding: 5px 15px;
    border-radius: 30px;
    margin-bottom: 20px;
}

.service-detail-content h3 {
    font-size: 1.5rem;
    font-weight: 700;
    margin-bottom: 20px;
    color: #333;
    position: relative;
}

.service-detail-content p {
    color: #777;
    font-size: 1.1rem;
    line-height: 1.7;
    margin-bottom: 30px;
}

.service-highlights {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
    margin-bottom: 30px;
}

.highlight-item {
    display: flex;
    align-items: flex-start;
    gap: 15px;
}

.highlight-icon {
    width: 50px;
    height: 50px;
    background-color: rgba(17, 157, 213, 0.1);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
    color: rgb(17, 157, 213);
    flex-shrink: 0;
}

.highlight-text h4 {
    font-size: 1rem;
    font-weight: 600;
    color: #333;
    margin-bottom: 5px;
}

.highlight-text p {
    font-size: 0.95rem;
    color: #777;
    margin-bottom: 0;
}

.service-price {
    display: flex;
    align-items: baseline;
    gap: 10px;
    margin-bottom: 30px;
}

.price {
    font-size: 1.5rem;
    font-weight: 800;
    color: rgb(17, 157, 213);
}

.price-text {
    font-size: 1.5rem;
    color: #777;
}

.service-cta {
    display: inline-block;
    padding: 15px 40px;
    background-color: rgb(17, 157, 213);
    color: #fff;
    font-size: 1rem;
    font-weight: 600;
    border-radius: 50px;
    text-transform: uppercase;
    letter-spacing: 1px;
    transition: all 0.3s ease;
    border: none;
    position: relative;
    overflow: hidden;
    z-index: 1;
}

.service-cta:before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 0%;
    height: 100%;
    background-color: #fd6e0f;
    transition: all 0.3s ease;
    z-index: -1;
}

.service-cta:hover {
    color: #fff;
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(17, 157, 213, 0.2);
}

.service-cta:hover:before {
    width: 100%;
}

.service-detail-image {
    flex: 1;
    position: relative;
    height: 500px;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
}

.service-detail-image:before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(to bottom, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.3));
    z-index: 1;
}

.service-detail-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: all 0.5s ease;
}

.service-detail:hover .service-detail-image img {
    transform: scale(1.05);
}

/* Responsive Styles */
@media (max-width: 1199px) {
    .service-detail {
        flex-direction: column-reverse;
        gap: 30px;
    }

    .service-detail-image {
        width: 100%;
        height: 400px;
    }

    .service-highlights {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 991px) {
    .tab-buttons {
        flex-wrap: wrap;
        justify-content: center;
    }

    .tab-btn {
        flex: 0 0 33.33%;
        margin-bottom: 20px;
    }

    .tab-contents {
        padding: 30px 20px;
    }
}

@media (max-width: 767px) {
    .services-section {
        padding: 80px 0;
    }

    .section-title {
        font-size: 1.5rem;
    }

    .tab-btn {
        flex: 0 0 50%;
    }

    .service-highlights {
        grid-template-columns: 1fr;
    }

    .service-detail-content h3 {
        font-size: 1.8rem;
    }

    .service-detail-image {
        height: 300px;
    }

    .price {
        font-size: 1.5rem;
    }
}

@media (max-width: 575px) {
    .tab-btn {
        flex: 0 0 100%;
    }
}
</style>
@endpush

<!-- Wedding Film Section -->
<section class="wedding-film-section position-relative py-5 mb-5">
    <div class="video-background">
        <video autoplay muted loop playsinline>
            <source
                src="https://videocdn.cdnpk.net/videos/7df965e3-f016-42bd-8a20-053619db1a19/horizontal/previews/clear/large.mp4?token=exp=1741171572~hmac=3512361059a62314a206701003ea859499f721948babfe3c2d81c81f29871558"
                type="video/mp4">
            Your browser does not support the video tag.
        </video>
        <div class="overlay"></div>
    </div>
    <div class="container position-relative">
        <div class="row justify-content-center text-center min-vh-75 align-items-center">
            <div class="col-lg-8 text-white">
                <h2 class="fs-4 fw-bold mb-4 text-white">Wedding Films</h2>
                <p class="lead mb-5 text-white">Let us transform your special moments into timeless memories through our
                    artistic
                    lens</p>
                <a href="https://www.youtube.com/@andamanbliss"
                    class="btn btn-outline-light btn-lg rounded-pill px-5 py-3 watch-btn" target="_blank">
                    <i class="fas fa-play me-2"></i> Watch Our Films
                </a>
            </div>
        </div>
    </div>
</section>


<style>
.wedding-film-section {
    position: relative;
    overflow: hidden;
    min-height: 75vh;
}

.wedding-films {
    background: linear-gradient(to right, pink, blue);
    padding: 20px;
}

.video-background {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 0;
}

.video-background video {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.video-background .overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.6);
}

.container.position-relative {
    position: relative;
    z-index: 1;
}

.video-wedding {
    width: 100%;
    height: 350px;
}

.watch-btn {
    transition: all 0.3s ease;
    border-width: 2px;
}

.watch-btn:hover {
    background-color: #fff;
    color: #000;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
}
</style>

<style>
.video-background {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    overflow: hidden;
}

.video-background video {
    min-width: 100%;
    min-height: 100%;
    width: auto;
    height: auto;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    object-fit: cover;
}

.min-vh-75 {
    min-height: 75vh;
}
</style>

<!-- Modern Wedding Look Section -->
<section id="wedding-look" class="wedding-look-section">
    <div class="wedding-look-container">
        <div class="wedding-look-content">
            <div class="wedding-look-text">
                <span class="wedding-look-subtitle">Elevate Your Special Day</span>
                <h2 class="wedding-look-title">Make Your Wedding <span class="highlight-text">Extraordinary</span></h2>
                <div class="wedding-look-features">
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fas fa-gem"></i>
                        </div>
                        <div class="feature-text">Grand</div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fas fa-paint-brush"></i>
                        </div>
                        <div class="feature-text">Creative</div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fas fa-star"></i>
                        </div>
                        <div class="feature-text">Unique</div>
                    </div>
                </div>
                <p class="wedding-look-description">Premium wedding photography that fits your budget. We capture the
                    magic of your special day with artistic excellence and attention to detail.</p>
                <div class="wedding-look-cta">
                    <a href="#booking" class="btn-wedding-book">Book Your Session</a>
                    <a href="#portfolio" class="btn-wedding-explore">Explore Portfolio</a>
                </div>
            </div>
            <div class="wedding-look-image">
                <img src="{{asset('site/img/photoshoot-in-andaman/home_honeymoon3.webp')}}"
                    alt="Wedding Photography">
                <div class="image-badge">Premium Quality</div>
            </div>
        </div>
    </div>
</section>

@push('styles')
<style>
/* Modern Wedding Look Section Styles */
.wedding-look-section {
    padding: 120px 0;
    background-color: #f9f9f9;
    position: relative;
    overflow: hidden;
}

.wedding-look-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 15px;
}

.wedding-look-content {
    display: flex;
    align-items: center;
    gap: 50px;
}

.wedding-look-text {
    flex: 1;
}

.wedding-look-subtitle {
    display: inline-block;
    font-size: 1rem;
    font-weight: 600;
    color: rgb(17, 157, 213);
    text-transform: uppercase;
    letter-spacing: 2px;
    margin-bottom: 15px;
    position: relative;
    padding-left: 40px;
}

.wedding-look-subtitle:before {
    content: '';
    position: absolute;
    top: 50%;
    left: 0;
    width: 30px;
    height: 2px;
    background-color: rgb(17, 157, 213);
    transform: translateY(-50%);
}

.wedding-look-title {
    font-size: 1.5rem;
    font-weight: 800;
    margin-bottom: 30px;
    color: #333;
    line-height: 1.2;
}

.highlight-text {
    color: rgb(17, 157, 213);
    position: relative;
    display: inline-block;
}

.highlight-text:after {
    content: '';
    position: absolute;
    bottom: 5px;
    left: 0;
    width: 100%;
    height: 8px;
    background-color: rgba(17, 157, 213, 0.1);
    z-index: -1;
}

.wedding-look-features {
    display: flex;
    gap: 30px;
    margin-bottom: 30px;
}

.feature-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 10px;
}

.feature-icon {
    width: 60px;
    height: 60px;
    background-color: #fff;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    color: #fd6e0f;
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
}

.feature-item:hover .feature-icon {
    transform: translateY(-5px);
    background-color: #fd6e0f;
    color: #fff;
}

.feature-text {
    font-size: 1.1rem;
    font-weight: 600;
    color: #333;
}

.wedding-look-description {
    font-size: 1.1rem;
    line-height: 1.7;
    color: #666;
    margin-bottom: 30px;
}

.wedding-look-cta {
    display: flex;
    gap: 20px;
}

.btn-wedding-book {
    display: inline-block;
    padding: 15px 30px;
    background-color: rgb(17, 157, 213);
    color: #fff;
    font-size: 1rem;
    font-weight: 600;
    border-radius: 50px;
    text-transform: uppercase;
    letter-spacing: 1px;
    transition: all 0.3s ease;
    border: none;
    position: relative;
    overflow: hidden;
    z-index: 1;
}

.btn-wedding-book:before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 0%;
    height: 100%;
    background-color: #fd6e0f;
    transition: all 0.3s ease;
    z-index: -1;
}

.btn-wedding-book:hover {
    color: #fff;
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(17, 157, 213, 0.2);
}

.btn-wedding-book:hover:before {
    width: 100%;
}

.btn-wedding-explore {
    display: inline-block;
    padding: 15px 30px;
    background-color: transparent;
    color: #333;
    font-size: 1rem;
    font-weight: 600;
    border-radius: 50px;
    text-transform: uppercase;
    letter-spacing: 1px;
    transition: all 0.3s ease;
    border: 2px solid #ddd;
}

.btn-wedding-explore:hover {
    border-color: rgb(17, 157, 213);
    color: rgb(17, 157, 213);
    transform: translateY(-5px);
}

.wedding-look-image {
    flex: 1;
    position: relative;
    height: 500px;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
}

.wedding-look-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: all 0.5s ease;
}

.wedding-look-content:hover .wedding-look-image img {
    transform: scale(1.05);
}

.image-badge {
    position: absolute;
    top: 20px;
    right: 20px;
    background-color: #fd6e0f;
    color: #fff;
    font-size: 0.8rem;
    font-weight: 600;
    padding: 8px 15px;
    border-radius: 30px;
    z-index: 2;
    box-shadow: 0 5px 15px rgba(253, 110, 15, 0.3);
}

/* Responsive Styles */
@media (max-width: 1199px) {
    .wedding-look-content {
        flex-direction: column;
    }

    .wedding-look-text {
        text-align: center;
        margin-bottom: 40px;
    }

    .wedding-look-subtitle {
        padding-left: 0;
    }

    .wedding-look-subtitle:before {
        display: none;
    }

    .wedding-look-features {
        justify-content: center;
    }

    .wedding-look-cta {
        justify-content: center;
    }

    .wedding-look-image {
        width: 100%;
        height: 400px;
    }
}

@media (max-width: 767px) {
    .wedding-look-section {
        padding: 80px 0;
    }

    .wedding-look-title {
        font-size: 2.2rem;
    }

    .wedding-look-features {
        flex-wrap: wrap;
        gap: 20px;
    }

    .feature-item {
        flex: 0 0 calc(33.33% - 20px);
    }

    .wedding-look-cta {
        flex-direction: column;
        gap: 15px;
    }

    .btn-wedding-book,
    .btn-wedding-explore {
        width: 100%;
        text-align: center;
    }

    .wedding-look-image {
        height: 300px;
    }
}
</style>
@endpush

<!-- Ultra-Modern Wedding Films Section -->
<section id="wedding-films" class="wedding-films-section py-5 mb-5">
    <div class="container">
        <div class="section-header text-center mb-5">
            <span class="section-subtitle">Cinematic Excellence</span>
            <h2 class="section-title">Wedding <span>Films</span></h2>
            <div class="section-line mx-auto"></div>
            <p class="section-description mt-4">Capturing your special moments with artistic vision and cinematic
                storytelling</p>
        </div>

        <div class="wedding-films-showcase">
            <div class="row g-4">
                <div class="col-lg-7">
                    <div class="main-video-card">
                        <div class="video-card-inner">
                            <div class="video-wrapper position-relative rounded-4 overflow-hidden">
                                <video autoplay muted loop class="video-wedding">
                                    <source
                                        src="https://videocdn.cdnpk.net/videos/f41de7f8-860e-46d0-b86a-100618bc13bb/horizontal/previews/clear/large.mp4?token=exp=1741171811~hmac=0106a5f616ae7b8ffd53cee0a4b4780360b8b4c67153281f421f9ecc8450d4d3"
                                        type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                                <div class="video-overlay">
                                    <a href="https://www.youtube.com/@andamanbliss" class="play-button"
                                        target="_blank">
                                        <i class="fas fa-play"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="video-info p-4">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h3 class="video-title mb-0">Beachside Wedding Film</h3>
                                    <span class="video-duration">4:32</span>
                                </div>
                                <div class="video-meta d-flex align-items-center">
                                    <span class="video-category me-3"><i class="fas fa-film me-2"></i>Wedding</span>
                                    <span class="video-location"><i class="fas fa-map-marker-alt me-2"></i>Andaman
                                        Islands</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="films-content">
                        <h2 class="films-title mb-4">Cinematic Wedding Stories</h2>
                        <p class="films-description mb-4">
                            Who doesn't want that iconic cinematic vibe in their wedding video? Our wedding films are
                            crafted with artistic vision to capture the essence of your special day.
                        </p>
                        <div class="films-features">
                            Who else doesn't want that iconic cinematic vibe in their wedding video? Wedding films and
                            videos
                            are the most precious asset of everyone's life. With the cuts and callouts, we collage all
                            those
                            memorable moments that you didn’t want to miss in our every wedding film. More importantly,
                            we
                            take
                            pleasure to document your wedding that is a perfect accompaniment to our style of
                            photography.
                            We
                            are top wedding photographers in kolkata.
                            </p>
                            <div class="films-actions mt-5 d-flex flex-wrap gap-3">
                                <a href="https://www.youtube.com/@andamanbliss" class="btn-primary-action"
                                    target="_blank">
                                    <i class="fas fa-play me-2"></i> Watch Sample Films
                                </a>
                                <a href="#booking" class="btn-secondary-action">
                                    <i class="fas fa-calendar-check me-2"></i> Book Your Film
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="wedding-films-gallery mt-5">
                <div class="row g-3">
                    <div class="col-6 col-md-3">
                        <div class="gallery-item position-relative rounded-3 overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1511285560929-80b456fea0bc?w=800&auto=format&fit=crop&q=80"
                                alt="Wedding Film" class="img-fluid">
                            <div class="gallery-overlay">
                                <a href="#" class="gallery-icon"><i class="fas fa-play"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="gallery-item position-relative rounded-3 overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1519741497674-611481863552?w=800&auto=format&fit=crop&q=80"
                                alt="Wedding Film" class="img-fluid">
                            <div class="gallery-overlay">
                                <a href="#" class="gallery-icon"><i class="fas fa-play"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="gallery-item position-relative rounded-3 overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1537633552985-df8429e8048b?w=800&auto=format&fit=crop&q=80"
                                alt="Wedding Film" class="img-fluid">
                            <div class="gallery-overlay">
                                <a href="#" class="gallery-icon"><i class="fas fa-play"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="gallery-item position-relative rounded-3 overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1583939003579-730e3918a45a?w=800&auto=format&fit=crop&q=80"
                                alt="Wedding Film" class="img-fluid">
                            <div class="gallery-overlay">
                                <a href="#" class="gallery-icon"><i class="fas fa-play"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>

<!-- Modern About Us Section -->
<section id="about-us" class="about-section py-5 mb-5">
    <div class="container">
        <div class="section-header text-center mb-5">
            <span class="section-subtitle">Who We Are</span>
            <h2 class="section-title">About <span>Andaman Bliss™</span></h2>
            <div class="section-line mx-auto"></div>
            <p class="section-description mt-4">Capturing your precious moments with artistic vision and professional
                excellence</p>
        </div>

        <div class="about-content-wrapper">
            <div class="row g-4 align-items-center">
                <div class="col-lg-6">
                    <div class="about-image-container">
                        <div class="about-main-image">
                            <img src="{{asset('site/img/video2.jpg')}}"
                                alt="Lead Photographer" class="img-fluid rounded-4">
                            <div class="experience-badge">
                                <span class="exp-number">10+</span>
                                <span class="exp-text">Years Experience</span>
                            </div>
                        </div>
                        <!-- <div class="about-floating-image about-floating-1">
                            <img src="https://images.unsplash.com/photo-1519741497674-611481863552?w=800&auto=format&fit=crop&q=80"
                                alt="Wedding Photography" class="img-fluid rounded-3">
                        </div>
                        <div class="about-floating-image about-floating-2">
                            <img src="https://images.unsplash.com/photo-1537633552985-df8429e8048b?w=800&auto=format&fit=crop&q=80"
                                alt="Beach Photography" class="img-fluid rounded-3">
                        </div> -->
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="about-text-content">
                        <h3 class="about-title">Capturing Timeless Moments in Paradise</h3>
                        <p class="about-description">Choosing the right photographer for your wedding and related events
                            is crucial. At Andaman Bliss™, we go beyond professionalism to capture the true
                            emotions of your once-in-a-lifetime moments.</p>

                        <p class="about-description">From pre-wedding to post-wedding events, we are dedicated to making
                            you look classy & royal, keeping your theme in mind. Just share your vision for your wedding
                            photo story, then relax and enjoy with your family.</p>

                        <div class="about-features">
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="about-feature-item">
                                        <div class="feature-icon">
                                            <i class="fas fa-gem"></i>
                                        </div>
                                        <h4 class="feature-title">Premium Quality</h4>
                                        <p class="feature-text">Award-winning photography with unmatched expertise</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="about-feature-item">
                                        <div class="feature-icon">
                                            <i class="fas fa-heart"></i>
                                        </div>
                                        <h4 class="feature-title">Passionate Team</h4>
                                        <p class="feature-text">Dedicated professionals who love what they do</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="about-feature-item">
                                        <div class="feature-icon">
                                            <i class="fas fa-wallet"></i>
                                        </div>
                                        <h4 class="feature-title">Value for Money</h4>
                                        <p class="feature-text">Budget-friendly services without compromising quality
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="about-feature-item">
                                        <div class="feature-icon">
                                            <i class="fas fa-medal"></i>
                                        </div>
                                        <h4 class="feature-title">Award Winner</h4>
                                        <p class="feature-text">Recognized for excellence in photography</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="about-cta mt-4">
                            <a href="#booking" class="btn-about-action">
                                <i class="fas fa-calendar-check me-2"></i> Book a Session
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<style>
.photography-booking {
    min-height: 100vh;
    display: flex;
    align-items: center;
}

.booking-form .form-control,
.booking-form .form-select {
    border: 1px solid #dee2e6;
    padding: 0.75rem 1rem;
    font-size: 1rem;
    transition: all 0.3s ease;
}

.booking-form .form-control:focus,
.booking-form .form-select:focus {
    border-color: #0d6efd;
    box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
}

.booking-form .form-floating label {
    padding: 0.75rem 1rem;
}

.booking-form .form-floating>.form-control:focus~label,
.booking-form .form-floating>.form-control:not(:placeholder-shown)~label,
.booking-form .form-floating>.form-select~label {
    transform: scale(0.85) translateY(-0.75rem) translateX(0.15rem);
    background-color: white;
    padding: 0 0.5rem;
    height: auto;
}

.btn-primary {
    transition: all 0.3s ease;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
}
</style>

<!-- Booking Section with Parallax -->
<section class="booking-section parallax-section py-5 mb-5 " id="booking"
    style="background-image: url('https://plus.unsplash.com/premium_photo-1682092597591-81f59c80d9ec?q=80&w=1740&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');">
    <div class="overlay"></div>
    <div class="container position-relative">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center text-white mb-5">
                <h2 class="fs-3 fw-bold mb-4 text-white">Let's Plan Your Photography</h2>
                <p class="lead text-white">We offer a range of photography with different price segments. Let us know
                    your
                    requirements and budget and discuss everything to get you the Best!</p>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <form class="booking-form  p-4 rounded-4 " method="post" action="{{ route('photo-enq') }}" >
                    @csrf
                    <div class="row align-items-center gx-3">
                        <div class="col">
                            <select class="form-select form-select-lg rounded-pill" name="type" required>
                                <option selected>Select Type of Shoot</option>
                                <option>Wedding Photography</option>
                                <option>Pre-wedding Shoot</option>
                                <option>Event Photography</option>
                            </select>
                            @error('type')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col">
                            <input type="date" class="form-control form-control-lg rounded-pill"
                                placeholder="Select Date" name="date" required>
                                 @error('date')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col">
                            <input type="text" class="form-control form-control-lg rounded-pill"
                                placeholder="Enter Name" name="name" required>
                                 @error('name')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col">
                            <input type="tel" class="form-control form-control-lg rounded-pill"
                                placeholder="Phone Number" name="contact" required>
                                 @error('contact')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <input type="text" hidden name="website" id="website">
                        <div class="col-auto">
                            <button type="submit" class="btn btn-lg rounded-pill px-4"
                                style="background-color: #fd6e0f; color:#fff;">Send Enquiry</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Modern Services Section -->
<section id="services" class="services-section py-5 mb-5">
    <div class="container">
        <div class="section-header text-center mb-5">
            <span class="section-subtitle">What We Offer</span>
            <h2 class="section-title">Our <span>Photography Services</span></h2>
            <div class="section-line mx-auto"></div>
            <p class="section-description mt-4">Discover our specialized photography services for every occasion and
                celebration</p>
        </div>

        <div class="services-container">
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="service-card">
                        <div class="service-image">
                            <img src="{{asset('site/img/photoshoot-in-andaman/home_honeymoon5.webp')}}"
                                alt="Maternity Photography" class="img-fluid">
                            <div class="service-tag">Popular</div>
                        </div>
                        <div class="service-body">
                            <div class="service-icon">
                                <i class="fas fa-baby"></i>
                            </div>
                            <h3 class="service-title">Beach Wedding</h3>
                            <p class="service-description">Capture the beautiful journey of motherhood with our
                                professional maternity photoshoots.</p>
                            <ul class="service-features">
                                <li><i class="fas fa-check"></i> Indoor & outdoor sessions</li>
                                <li><i class="fas fa-check"></i> Professional styling</li>
                                <li><i class="fas fa-check"></i> Family inclusion options</li>
                            </ul>
                            <div class="service-action">
                                <a href="#booking" class="btn-service">Book Now</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="service-card">
                        <div class="service-image">
                            <img src="{{asset('site/img/photoshoot-in-andaman/photoshoot_b4.webp')}}"
                                alt="Corporate Events" class="img-fluid">
                            <div class="service-tag service-tag-blue">Business</div>
                        </div>
                        <div class="service-body">
                            <div class="service-icon">
                                <i class="fas fa-briefcase"></i>
                            </div>
                            <h3 class="service-title">Pre-Wedding Shoots</h3>
                            <p class="service-description">Professional photography coverage for all your business
                                events and corporate functions.</p>
                            <ul class="service-features">
                                <li><i class="fas fa-check"></i> Conference coverage</li>
                                <li><i class="fas fa-check"></i> Team building events</li>
                                <li><i class="fas fa-check"></i> Product launches</li>
                            </ul>
                            <div class="service-action">
                                <a href="#booking" class="btn-service">Book Now</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="service-card">
                        <div class="service-image">
                            <img src="{{asset('site/img/photoshoot-in-andaman/honeymoon_photoshoot.webp')}}"
                                alt="Fashion Photography" class="img-fluid">
                            <div class="service-tag service-tag-orange">Creative</div>
                        </div>
                        <div class="service-body">
                            <div class="service-icon">
                                <i class="fas fa-tshirt"></i>
                            </div>
                            <h3 class="service-title">Couple Shoots</h3>
                            <p class="service-description">Showcase your style with professional fashion photography for
                                portfolios and brands.</p>
                            <ul class="service-features">
                                <li><i class="fas fa-check"></i> Studio sessions</li>
                                <li><i class="fas fa-check"></i> Location shoots</li>
                                <li><i class="fas fa-check"></i> Portfolio development</li>
                            </ul>
                            <div class="service-action">
                                <a href="#booking" class="btn-service">Book Now</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="service-card">
                        <div class="service-image">
                            <img src="{{asset('site/img/photoshoot-in-andaman/photoshoot_b2.JPG')}}"
                                alt="Pre-wedding Photography" class="img-fluid">
                            <div class="service-tag">Popular</div>
                        </div>
                        <div class="service-body">
                            <div class="service-icon">
                                <i class="fas fa-heart"></i>
                            </div>
                            <h3 class="service-title">Honeymoon Moments</h3>
                            <p class="service-description">Capture your love story with stunning pre-wedding photography
                                in beautiful locations.</p>
                            <ul class="service-features">
                                <li><i class="fas fa-check"></i> Beach locations</li>
                                <li><i class="fas fa-check"></i> Romantic settings</li>
                                <li><i class="fas fa-check"></i> Customized themes</li>
                            </ul>
                            <div class="service-action">
                                <a href="#booking" class="btn-service">Book Now</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="service-card">
                        <div class="service-image">
                            <img src="{{asset('site/img/photoshoot-in-andaman/photoshoot_b5.webp')}}"
                                alt="Beach Photography" class="img-fluid">
                            <div class="service-tag service-tag-blue">Outdoor</div>
                        </div>
                        <div class="service-body">
                            <div class="service-icon">
                                <i class="fas fa-umbrella-beach"></i>
                            </div>
                            <h3 class="service-title">Proposal Shoots</h3>
                            <p class="service-description">Stunning beach photography sessions capturing the beauty of
                                Andaman's pristine shores.</p>
                            <ul class="service-features">
                                <li><i class="fas fa-check"></i> Sunset sessions</li>
                                <li><i class="fas fa-check"></i> Family beach portraits</li>
                                <li><i class="fas fa-check"></i> Couple photoshoots</li>
                            </ul>
                            <div class="service-action">
                                <a href="#booking" class="btn-service">Book Now</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="service-card">
                        <div class="service-image">
                            <img src="{{asset('site/img/photoshoot-in-andaman/photoshoot_b1.JPG')}}"
                                alt="Event Photography" class="img-fluid">
                            <div class="service-tag service-tag-orange">Events</div>
                        </div>
                        <div class="service-body">
                            <div class="service-icon">
                                <i class="fas fa-glass-cheers"></i>
                            </div>
                            <h3 class="service-title">Family & Friends</h3>
                            <p class="service-description">Professional photography for birthdays, anniversaries, and
                                all your special celebrations.</p>
                            <ul class="service-features">
                                <li><i class="fas fa-check"></i> Birthday parties</li>
                                <li><i class="fas fa-check"></i> Anniversary celebrations</li>
                                <li><i class="fas fa-check"></i> Family gatherings</li>
                            </ul>
                            <div class="service-action">
                                <a href="#booking" class="btn-service">Book Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="services-cta text-center mt-5">
                <p class="cta-text">Looking for a custom photography package?</p>
                <a href="#contact" class="btn-services-contact">
                    <i class="fas fa-envelope me-2"></i> Contact Us for Custom Packages
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Simple Portfolio Gallery Section -->
<section id="portfolio" class="portfolio-section">
    <div class="portfolio-bg-shape"></div>
    <div class="portfolio-bg-shape-2"></div>

    <div class="container">
        <div class="section-header text-center mb-5">
            <span class="section-subtitle">Our Work</span>
            <h2 class="section-title">Creative <span>Portfolio</span></h2>
            <div class="section-line mx-auto"></div>
            <p class="section-description mt-4">Explore our collection of stunning photographs captured across the
                beautiful Andaman Islands</p>
        </div>

        <!-- Simple Tab Filter System -->
        <div class="portfolio-filter-wrap">
            <div class="portfolio-filter">
                <button class="filter-btn active" data-filter="all">
                    <i class="fas fa-th"></i> All Work
                </button>
                <button class="filter-btn" data-filter="wedding">
                    <i class="fas fa-heart"></i> Wedding
                </button>
                <button class="filter-btn" data-filter="beach wedding">
                    <i class="fas fa-umbrella-beach"></i> Beach Wedding
                </button>
                <button class="filter-btn" data-filter="family & friends">
                    <i class="fas fa-glass-cheers"></i> Family & Friends 
                </button>
                <button class="filter-btn" data-filter="proposal shoots">
                    <i class="fas fa-user"></i> Proposal Shoots
                </button>
            </div>
        </div>
    </div>

    <!-- Simple Portfolio Grid -->
    <div class="container mt-5">
        <div class="portfolio-grid">
            <!-- Item 1 -->
            <div class="portfolio-item" data-category="wedding">
                <div class="portfolio-card">
                    <a href="{{asset('site/img/photoshoot-in-andaman/wedding_photoshoot.JPG')}}"
                        class="portfolio-link" data-title="Pre-wedding Romance" data-category="Wedding">
                        <div class="portfolio-image">
                            <img src="{{asset('site/img/photoshoot-in-andaman/wedding_photoshoot.JPG')}}"
                                alt="Pre-wedding Shoot">
                            <div class="portfolio-overlay">
                                <div class="portfolio-info">
                                    <div class="portfolio-category">Wedding</div>
                                    <h3 class="portfolio-title">Wedding Romance</h3>
                                    <div class="portfolio-zoom">
                                        <i class="fas fa-search-plus"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Item 2 -->
            <div class="portfolio-item" data-category="wedding">
                <div class="portfolio-card">
                    <a href="{{asset('site/img/photoshoot-in-andaman/home_honeymoon1 (2).webp')}}"
                        class="portfolio-link" data-title="Beachside Ceremony" data-category="Wedding">
                        <div class="portfolio-image">
                            <img src="{{asset('site/img/photoshoot-in-andaman/home_honeymoon1 (2).webp')}}"
                                alt="Wedding Photography">
                            <div class="portfolio-overlay">
                                <div class="portfolio-info">
                                    <div class="portfolio-category">Wedding</div>
                                    <h3 class="portfolio-title">Beachside Ceremony</h3>
                                    <div class="portfolio-zoom">
                                        <i class="fas fa-search-plus"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Item 3 -->
            <div class="portfolio-item" data-category="beach wedding">
                <div class="portfolio-card">
                    <a href="{{asset('site/img/photoshoot-in-andaman/photoshoot_b1.JPG')}}"
                        class="portfolio-link" data-title="Sunset Paradise" data-category="Beach">
                        <div class="portfolio-image">
                            <img src="{{asset('site/img/photoshoot-in-andaman/photoshoot_b1.JPG')}}"
                                alt="Beach Photography">
                            <div class="portfolio-overlay">
                                <div class="portfolio-info">
                                    <div class="portfolio-category">Beach Wedding</div>
                                    <h3 class="portfolio-title">Beach Wedding</h3>
                                    <div class="portfolio-zoom">
                                        <i class="fas fa-search-plus"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Item 4 -->
            <div class="portfolio-item" data-category="family & friends">
                <div class="portfolio-card">
                    <a href="{{asset('site/img/photoshoot-in-andaman/photoshoot_b2.JPG')}}"
                        class="portfolio-link" data-title="Corporate Gathering" data-category="Events">
                        <div class="portfolio-image">
                            <img src="{{asset('site/img/photoshoot-in-andaman/photoshoot_b2.JPG')}}"
                                alt="Corporate Events">
                            <div class="portfolio-overlay">
                                <div class="portfolio-info">
                                    <div class="portfolio-category">Family & Friends</div>
                                    <h3 class="portfolio-title">Family Moments</h3>
                                    <div class="portfolio-zoom">
                                        <i class="fas fa-search-plus"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Item 5 -->
            <div class="portfolio-item" data-category="proposal shoots">
                <div class="portfolio-card">
                    <a href="{{asset('site/img/photoshoot-in-andaman/photoshoot_b4.webp')}}"
                        class="portfolio-link" data-title="Fashion Portrait" data-category="Portrait">
                        <div class="portfolio-image">
                            <img src="{{asset('site/img/photoshoot-in-andaman/photoshoot_b4.webp')}}"
                                alt="Fashion Photography">
                            <div class="portfolio-overlay">
                                <div class="portfolio-info">
                                    <div class="portfolio-category">Proposal Shoots</div>
                                    <h3 class="portfolio-title">Moment of Love</h3>
                                    <div class="portfolio-zoom">
                                        <i class="fas fa-search-plus"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Item 6 -->
            <div class="portfolio-item" data-category="beach wedding">
                <div class="portfolio-card">
                    <a href="{{asset('site/img/photoshoot-in-andaman/photoshoot_b5.webp')}}"
                        class="portfolio-link" data-title="Maternity Moments" data-category="Portrait">
                        <div class="portfolio-image">
                            <img src="{{asset('site/img/photoshoot-in-andaman/photoshoot_b5.webp')}}"
                                alt="Maternity Photography">
                            <div class="portfolio-overlay">
                                <div class="portfolio-info">
                                    <div class="portfolio-category">Beach Wedding</div>
                                    <h3 class="portfolio-title">Romatic Couples</h3>
                                    <div class="portfolio-zoom">
                                        <i class="fas fa-search-plus"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Item 7 -->
            <div class="portfolio-item" data-category="beach wedding">
                <div class="portfolio-card">
                    <a href="{{asset('site/img/photoshoot-in-andaman/home_honeymoon5.webp')}}"
                        class="portfolio-link" data-title="Golden Hour" data-category="Beach">
                        <div class="portfolio-image">
                            <img src="{{asset('site/img/photoshoot-in-andaman/home_honeymoon5.webp')}}"
                                alt="Beach Sunset">
                            <div class="portfolio-overlay">
                                <div class="portfolio-info">
                                    <div class="portfolio-category">Beach Wedding</div>
                                    <h3 class="portfolio-title">Love Moments</h3>
                                    <div class="portfolio-zoom">
                                        <i class="fas fa-search-plus"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Item 8 -->
            <div class="portfolio-item" data-category="proposal shoots">
                <div class="portfolio-card">
                    <a href="{{asset('site/img/photoshoot-in-andaman/wedding_photoshoot2.JPG')}}"
                        class="portfolio-link" data-title="Celebration Moments" data-category="Events">
                        <div class="portfolio-image">
                            <img src="{{asset('site/img/photoshoot-in-andaman/wedding_photoshoot2.JPG')}}"
                                alt="Event Photography">
                            <div class="portfolio-overlay">
                                <div class="portfolio-info">
                                    <div class="portfolio-category">Proposal Shoots</div>
                                    <h3 class="portfolio-title">Celebration Moments</h3>
                                    <div class="portfolio-zoom">
                                        <i class="fas fa-search-plus"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <!-- Portfolio CTA -->
        <div class="portfolio-cta text-center mt-5">
            <a href="#" class="btn-portfolio">
                <span>View Complete Gallery</span>
                <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>
    </div>

    <!-- Lightbox Container -->
    <div class="portfolio-lightbox" id="portfolioLightbox">
        <div class="lightbox-container">
            <div class="lightbox-content">
                <img src="" alt="Lightbox Image" id="lightboxImage">
                <div class="lightbox-caption">
                    <h3 id="lightboxTitle"></h3>
                    <p id="lightboxCategory"></p>
                </div>
            </div>
            <button class="lightbox-close" id="lightboxClose">
                <i class="fas fa-times"></i>
            </button>
            <button class="lightbox-nav lightbox-prev" id="lightboxPrev">
                <i class="fas fa-chevron-left"></i>
            </button>
            <button class="lightbox-nav lightbox-next" id="lightboxNext">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>
    </div>
</section>

@push('styles')
<style>
/* Services Section Styles */
.services-section {
    position: relative;
    background-color: #fff;
}

.services-section .section-title span {
    background: linear-gradient(to right, #f9925a, var(--color-secondary));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    color: var(--color-secondary);
}

.services-section .section-line {
    width: 80px;
    height: 4px;
    margin: 15px auto 0;
    border-radius: 2px;
}

.services-container {
    position: relative;
    z-index: 1;
}

.service-card {
    background-color: #fff;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    height: 100%;
    transition: all 0.3s ease;
    display: flex;
    flex-direction: column;
}

.service-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
}

.service-image {
    position: relative;
    height: 220px;
    overflow: hidden;
}

.service-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.service-card:hover .service-image img {
    transform: scale(1.1);
}

.service-tag {
    position: absolute;
    top: 15px;
    right: 15px;
    background-color: #fd6e0f;
    color: white;
    padding: 5px 12px;
    border-radius: 30px;
    font-size: 0.8rem;
    font-weight: 600;
    box-shadow: 0 3px 10px rgba(253, 110, 15, 0.3);
}

.service-tag-blue {
    background-color: rgb(17, 157, 213);
    box-shadow: 0 3px 10px rgba(17, 157, 213, 0.3);
}

.service-tag-orange {
    background-color: #fd6e0f;
    box-shadow: 0 3px 10px rgba(253, 110, 15, 0.3);
}

.service-body {
    padding: 25px;
    flex: 1;
    display: flex;
    flex-direction: column;
}

.service-icon {
    width: 60px;
    height: 60px;
    background: rgba(17, 157, 213, 0.1);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 20px;
    margin-top: -50px;
    border: 5px solid white;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
}

.service-icon i {
    font-size: 1.5rem;
    color: rgb(17, 157, 213);
    transition: all 0.3s ease;
}

.service-card:hover .service-icon {
    background: rgb(17, 157, 213);
}

.service-card:hover .service-icon i {
    color: white;
}

.service-title {
    font-size: 1rem;
    font-weight: 700;
    color: #333;
    margin-bottom: 15px;
}

.service-description {
    color: #666;
    font-size: 1rem;
    line-height: 1.6;
    margin-bottom: 20px;
}

.service-features {
    list-style: none;
    padding: 0;
    margin: 0 0 20px 0;
    flex: 1;
}

.service-features li {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
    color: #555;
    font-size: 0.95rem;
}

.service-features li i {
    color: #fd6e0f;
    margin-right: 10px;
    font-size: 0.8rem;
}

.service-action {
    margin-top: auto;
}

.btn-service {
    display: inline-block;
    background-color: rgb(17, 157, 213);
    color: white;
    padding: 10px 25px;
    border-radius: 50px;
    text-decoration: none;
    font-weight: 600;
    font-size: 0.95rem;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
}

.btn-service:hover {
    background-color: #0e8bc0;
    color: white;
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(17, 157, 213, 0.3);
}

.services-cta {
    margin-top: 50px;
    padding: 30px;
    background: linear-gradient(to right, rgba(17, 157, 213, 0.05), rgba(253, 110, 15, 0.05));
    border-radius: 16px;
}

.cta-text {
    font-size: 1.2rem;
    color: #555;
    margin-bottom: 15px;
}

.btn-services-contact {
    display: inline-block;
    background-color: #fd6e0f;
    color: white;
    padding: 12px 30px;
    border-radius: 50px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-services-contact:hover {
    background-color: #e05d00;
    color: white;
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(253, 110, 15, 0.3);
}

@media (max-width: 991px) {
    .service-card {
        margin-bottom: 30px;
    }
}

@media (max-width: 767px) {
    .service-image {
        height: 180px;
    }

    .service-title {
        font-size: 1rem;
    }

    .service-description {
        font-size: 0.95rem;
    }
}

/* About Section Styles */
.about-section {
    position: relative;
    background-color: #f9f9f9;
    overflow: hidden;
}

.about-section .section-title span {
    background: linear-gradient(to right, #f9925a, var(--color-secondary));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    color: var(--color-secondary);
}

.about-section .section-line {
    width: 80px;
    height: 4px;
    margin: 15px auto 0;
    border-radius: 2px;
}

.about-content-wrapper {
    position: relative;
    z-index: 1;
}

.about-image-container {
    position: relative;
    height: 100%;
    padding: 20px;
}

.about-main-image {
    position: relative;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
}

.about-main-image img {
    width: 100%;
    height: 450px;
    object-fit: cover;
}

.experience-badge {
    position: absolute;
    bottom: -25px;
    right: -25px;
    width: 120px;
    height: 120px;
    background: rgb(17, 157, 213);
    border-radius: 50%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    color: white;
    box-shadow: 0 10px 20px rgba(17, 157, 213, 0.3);
}

.exp-number {
    font-size: 2.5rem;
    font-weight: 700;
    line-height: 1;
}

.exp-text {
    font-size: 0.9rem;
    text-align: center;
    max-width: 80px;
}

.about-floating-image {
    position: absolute;
    width: 180px;
    height: 180px;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
    border: 5px solid white;
}

.about-floating-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.about-floating-1 {
    top: 0;
    right: 0;
    transform: translateY(-30%) rotate(10deg);
}

.about-floating-2 {
    bottom: 0;
    left: 0;
    transform: translateY(30%) rotate(-5deg);
}

.about-text-content {
    padding: 20px;
}

.about-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: #333;
    margin-bottom: 1.5rem;
    position: relative;
    padding-bottom: 15px;
}

.about-title:after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 80px;
    height: 4px;
    border-radius: 2px;
}

.about-description {
    color: #555;
    font-size: 1.1rem;
    line-height: 1.7;
    margin-bottom: 1.5rem;
}

.about-features {
    margin-top: 2.5rem;
}

.about-feature-item {
    background-color: white;
    border-radius: 12px;
    padding: 20px;
    height: 100%;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
}

.about-feature-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
}

.about-feature-item .feature-icon {
    width: 50px;
    height: 50px;
    background: rgba(17, 157, 213, 0.1);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: rgb(17, 157, 213);
    font-size: 1.25rem;
    margin-bottom: 15px;
}

.about-feature-item .feature-title {
    font-size: 1.1rem;
    font-weight: 600;
    color: #333;
    margin-bottom: 8px;
}

.about-feature-item .feature-text {
    color: #666;
    font-size: 0.95rem;
    line-height: 1.5;
}

.btn-about-action {
    background-color: #fd6e0f;
    color: white;
    padding: 12px 24px;
    border-radius: 50px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
}

.btn-about-action:hover {
    background-color: #e05d00;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(253, 110, 15, 0.3);
}

@media (max-width: 991px) {
    .about-image-container {
        margin-bottom: 40px;
    }

    .about-main-image img {
        height: 350px;
    }

    .about-floating-image {
        width: 150px;
        height: 150px;
    }
}

@media (max-width: 767px) {
    .about-title {
        font-size: 1.8rem;
    }

    .about-description {
        font-size: 1rem;
    }

    .experience-badge {
        width: 100px;
        height: 100px;
    }

    .exp-number {
        font-size: 2rem;
    }

    .exp-text {
        font-size: 0.8rem;
    }
}

/* Additional Wedding Films Section Styles */
.feature-item {
    background-color: #fff;
    border-radius: 12px;
    padding: 20px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
}

.feature-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
}

.feature-icon i {
    font-size: 1.5rem;
    color: rgb(17, 157, 213);
}

.feature-title {
    font-size: 1.2rem;
    font-weight: 600;
    color: #333;
    margin-bottom: 8px;
}

.feature-text {
    color: #666;
    font-size: 0.95rem;
    line-height: 1.5;
}

/* Wedding Films Section Styles */
.wedding-films-section {
    position: relative;
    overflow: hidden;
}

.main-video-card {
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    height: 100%;
}

.video-card-inner {
    height: 100%;
    display: flex;
    flex-direction: column;
}

.video-wrapper {
    position: relative;
    overflow: hidden;
    flex: 1;
}

.video-wedding {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.video-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.3);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.video-wrapper:hover .video-overlay {
    opacity: 1;
}

.play-button {
    width: 70px;
    height: 70px;
    background: rgba(255, 255, 255, 0.9);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fd6e0f;
    font-size: 24px;
    transition: all 0.3s ease;
    transform: scale(0.8);
}

.video-wrapper:hover .play-button {
    transform: scale(1);
}

.video-info {
    background: #fff;
}

.video-title {
    color: #333;
    font-weight: 600;
    font-size: 1.25rem;
}

.video-duration {
    background: rgba(17, 157, 213, 0.1);
    color: rgb(17, 157, 213);
    padding: 4px 10px;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 500;
}

.video-meta {
    color: #777;
    font-size: 0.9rem;
}

.films-content {
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    padding: 20px;
}

.films-title {
    color: rgb(17, 157, 213);
    font-size: 1.5rem;
    font-weight: 700;
    margin-bottom: 1.5rem;
}

.films-description {
    color: #555;
    font-size: 1.1rem;
    line-height: 1.6;
}

.films-features {
    margin-top: 2rem;
}

.feature-icon {
    width: 50px;
    height: 50px;
    background: rgba(17, 157, 213, 0.1);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: rgb(17, 157, 213);
    font-size: 1.25rem;
}

.feature-title {
    color: #333;
    font-weight: 600;
    font-size: 1.1rem;
    margin-bottom: 0.5rem;
}

.feature-text {
    color: #666;
    font-size: 0.95rem;
}

.btn-primary-action {
    background-color: #fd6e0f;
    color: white;
    padding: 12px 24px;
    border-radius: 50px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
}

.btn-primary-action:hover {
    background-color: #e05d00;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(253, 110, 15, 0.3);
}

.btn-secondary-action {
    background-color: rgba(17, 157, 213, 0.1);
    color: rgb(17, 157, 213);
    padding: 12px 24px;
    border-radius: 50px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
}

.btn-secondary-action:hover {
    background-color: rgba(17, 157, 213, 0.2);
    color: rgb(17, 157, 213);
    transform: translateY(-2px);
}

.wedding-films-gallery {
    margin-top: 4rem;
}

.gallery-item {
    position: relative;
    border-radius: 12px;
    overflow: hidden;
    transition: all 0.3s ease;
}

.gallery-item img {
    width: 100%;
    height: 200px;
    object-fit: cover;
    transition: all 0.5s ease;
}

.gallery-item:hover img {
    transform: scale(1.05);
}

.gallery-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.4);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.gallery-item:hover .gallery-overlay {
    opacity: 1;
}

.gallery-icon {
    width: 50px;
    height: 50px;
    background: rgba(255, 255, 255, 0.9);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fd6e0f;
    font-size: 18px;
    transition: all 0.3s ease;
    transform: scale(0.8);
}

.gallery-item:hover .gallery-icon {
    transform: scale(1);
}

/* Creative Portfolio Section Styles */
.portfolio-section {
    padding: 100px 0;
    background-color: #fff;
    position: relative;
    overflow: hidden;
}

.portfolio-section .section-title span {
    background: linear-gradient(to right, #f9925a, var(--color-secondary));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    color: var(--color-secondary);
}

.portfolio-section .section-line {
    width: 80px;
    height: 4px;
    margin: 15px auto 0;
    border-radius: 2px;
}

.portfolio-bg-shape {
    position: absolute;
    top: -150px;
    right: -150px;
    width: 600px;
    height: 600px;
    background: linear-gradient(135deg, rgba(17, 157, 213, 0.05), rgba(17, 157, 213, 0.01));
    border-radius: 50%;
    z-index: 0;
}

.portfolio-bg-shape-2 {
    position: absolute;
    bottom: -100px;
    left: -100px;
    width: 400px;
    height: 400px;
    background: linear-gradient(135deg, rgba(253, 110, 15, 0.05), rgba(253, 110, 15, 0.01));
    border-radius: 50%;
    z-index: 0;
}

/* Simple Filter System */
.portfolio-filter-wrap {
    position: relative;
    z-index: 1;
    margin-top: 30px;
}

.portfolio-filter {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 12px;
    background-color: #f8f9fa;
    padding: 15px 20px;
    border-radius: 50px;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
    max-width: 1000px;
    margin: 0 auto;
    border: 1px solid rgba(0, 0, 0, 0.03);
}

.filter-btn {
    background: #f8f9fa;
    border: none;
    padding: 12px 20px;
    font-size: 0.95rem;
    font-weight: 600;
    color: #666;
    border-radius: 30px;
    transition: all 0.3s ease;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 8px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
}

.filter-btn.active {
    background-color: rgb(17, 157, 213);
    color: white;
    box-shadow: 0 5px 15px rgba(17, 157, 213, 0.2);
}

.filter-btn:hover:not(.active) {
    color: rgb(17, 157, 213);
    background-color: rgba(17, 157, 213, 0.05);
}

.filter-btn i {
    font-size: 1rem;
}

/* Simple Portfolio Grid Layout */
.portfolio-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 25px;
    position: relative;
    z-index: 1;
    margin-bottom: 40px;
}

.portfolio-item {
    position: relative;
    transition: all 0.4s ease;
    opacity: 1;
    transform: translateY(0);
    width: 100%;
    display: block;
}

.portfolio-card {
    position: relative;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.06);
    background-color: white;
    height: 100%;
    transition: all 0.4s ease;
    margin-bottom: 0;
    border: 1px solid rgba(0, 0, 0, 0.05);
    width: 100%;
}

.portfolio-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
}

.portfolio-link {
    display: block;
    height: 100%;
    width: 100%;
    text-decoration: none;
}

.portfolio-image {
    position: relative;
    overflow: hidden;
    height: 280px;
    width: 100%;
    border-radius: 8px;
    background-color: #f5f5f5;
    display: block;
}

.portfolio-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.6s ease;
    display: block;
    max-width: 100%;
}

.portfolio-card:hover .portfolio-image img {
    transform: scale(1.08);
}

.portfolio-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(to top, rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.2));
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: all 0.4s ease;
}

.portfolio-card:hover .portfolio-overlay {
    opacity: 1;
}

.portfolio-info {
    text-align: center;
    color: white;
    padding: 20px;
    transform: translateY(20px);
    transition: all 0.4s ease;
}

.portfolio-card:hover .portfolio-info {
    transform: translateY(0);
}

.portfolio-category {
    display: inline-block;
    background-color: rgba(17, 157, 213, 0.8);
    color: white;
    padding: 5px 15px;
    border-radius: 30px;
    font-size: 0.8rem;
    font-weight: 600;
    margin-bottom: 15px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
}

.portfolio-title {
    font-size: 1.5rem;
    font-weight: 700;
    margin-bottom: 20px;
    color: white;
}

.portfolio-zoom {
    width: 50px;
    height: 50px;
    background-color: rgba(255, 255, 255, 0.15);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.2rem;
    margin: 0 auto;
    transition: all 0.3s ease;
    border: 2px solid rgba(255, 255, 255, 0.3);
}

.portfolio-card:hover .portfolio-zoom {
    background-color: rgb(17, 157, 213);
    transform: scale(1.1);
    border-color: transparent;
}

.portfolio-cta {
    margin-top: 60px;
}

.btn-portfolio {
    display: inline-flex;
    align-items: center;
    background-color: rgb(17, 157, 213);
    color: white;
    padding: 15px 35px;
    border-radius: 50px;
    font-size: 1.1rem;
    font-weight: 600;
    transition: all 0.3s ease;
    box-shadow: 0 5px 15px rgba(17, 157, 213, 0.2);
    text-decoration: none;
}

.btn-portfolio:hover {
    background-color: #0e8bc0;
    color: white;
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(17, 157, 213, 0.3);
}

.btn-portfolio i {
    transition: all 0.3s ease;
}

.btn-portfolio:hover i {
    transform: translateX(5px);
}

/* Portfolio Lightbox Styles */
.portfolio-lightbox {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.95);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 9999;
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease;
}

.portfolio-lightbox.active {
    opacity: 1;
    visibility: visible;
}

.lightbox-container {
    position: relative;
    width: 100%;
    max-width: 1200px;
    padding: 0 60px;
}

.lightbox-content {
    position: relative;
    width: 100%;
    text-align: center;
    transform: scale(0.95);
    transition: all 0.4s ease;
}

.portfolio-lightbox.active .lightbox-content {
    transform: scale(1);
}

.lightbox-content img {
    max-width: 100%;
    max-height: 80vh;
    border-radius: 8px;
    box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5);
}

.lightbox-caption {
    margin-top: 20px;
    color: white;
    text-align: center;
}

.lightbox-caption h3 {
    font-size: 1.5rem;
    font-weight: 700;
    margin-bottom: 5px;
}

.lightbox-caption p {
    font-size: 1rem;
    color: rgba(255, 255, 255, 0.7);
}

.lightbox-close {
    position: absolute;
    top: 20px;
    right: 20px;
    width: 50px;
    height: 50px;
    background-color: rgba(255, 255, 255, 0.1);
    border: none;
    border-radius: 50%;
    color: white;
    font-size: 1.5rem;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
    z-index: 10;
}

.lightbox-close:hover {
    background-color: rgb(17, 157, 213);
    transform: rotate(90deg);
}

.lightbox-nav {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    width: 50px;
    height: 50px;
    background-color: rgba(255, 255, 255, 0.1);
    border: none;
    border-radius: 50%;
    color: white;
    font-size: 1.2rem;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
    z-index: 10;
}

.lightbox-prev {
    left: 20px;
}

.lightbox-next {
    right: 20px;
}

.lightbox-nav:hover {
    background-color: rgb(17, 157, 213);
}

/* Responsive Styles */
@media (max-width: 1199px) {
    .portfolio-grid {
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
    }

    .filter-btn {
        padding: 10px 15px;
        font-size: 0.9rem;
    }

    .portfolio-image {
        height: 250px;
    }
}

@media (max-width: 991px) {
    .portfolio-section {
        padding: 80px 0;
    }

    .portfolio-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }

    .portfolio-filter {
        padding: 10px 15px;
    }

    .filter-btn {
        padding: 8px 15px;
    }

    .portfolio-image {
        height: 220px;
    }

    .lightbox-container {
        padding: 0 40px;
    }
}

@media (max-width: 767px) {
    .portfolio-section {
        padding: 60px 0;
    }

    .portfolio-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 15px;
    }

    .portfolio-image {
        height: 180px;
    }

    .portfolio-filter {
        overflow-x: auto;
        justify-content: flex-start;
        padding: 10px 15px;
    }

    .filter-btn {
        padding: 8px 12px;
        font-size: 0.85rem;
        white-space: nowrap;
        flex-shrink: 0;
    }

    .portfolio-title {
        font-size: 1.3rem;
    }

    .btn-portfolio {
        padding: 12px 25px;
        font-size: 1rem;
    }

    .lightbox-container {
        padding: 0 20px;
    }

    .lightbox-nav {
        width: 40px;
        height: 40px;
        font-size: 1rem;
    }

    .lightbox-close {
        width: 40px;
        height: 40px;
        font-size: 1.2rem;
    }
}

@media (max-width: 575px) {
    .portfolio-grid {
        grid-template-columns: 1fr;
        gap: 20px;
    }

    .portfolio-image {
        height: 250px;
    }

    .portfolio-card {
        margin-bottom: 0;
    }

    .portfolio-filter {
        padding: 10px;
    }

    .filter-btn {
        padding: 8px 12px;
        font-size: 0.8rem;
    }
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Portfolio filter functionality
    const filterButtons = document.querySelectorAll('.filter-btn');
    const portfolioItems = document.querySelectorAll('.portfolio-item');
    const lightbox = document.getElementById('portfolioLightbox');
    const lightboxImage = document.getElementById('lightboxImage');
    const lightboxTitle = document.getElementById('lightboxTitle');
    const lightboxCategory = document.getElementById('lightboxCategory');
    const lightboxClose = document.getElementById('lightboxClose');
    const lightboxPrev = document.getElementById('lightboxPrev');
    const lightboxNext = document.getElementById('lightboxNext');
    const portfolioLinks = document.querySelectorAll('.portfolio-link');

    let currentIndex = 0;
    let filteredItems = [];

    // Initialize - show all items
    portfolioItems.forEach(item => {
        item.style.display = 'block';
        item.style.opacity = '1';
    });

    // Filter functionality
    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Remove active class from all buttons
            filterButtons.forEach(btn => btn.classList.remove('active'));

            // Add active class to clicked button
            this.classList.add('active');

            // Get filter value
            const filterValue = this.getAttribute('data-filter');

            // Filter items with animation
            portfolioItems.forEach(item => {
                // Reset transform and set initial opacity
                item.style.transform = 'translateY(20px)';
                item.style.opacity = '0';

                // Determine if item should be shown
                const shouldShow = filterValue === 'all' || item.getAttribute(
                    'data-category') === filterValue;

                // Apply filter with staggered animation
                setTimeout(() => {
                    if (shouldShow) {
                        item.style.display = 'block';
                        setTimeout(() => {
                            item.style.opacity = '1';
                            item.style.transform = 'translateY(0)';
                        }, 50);
                    } else {
                        setTimeout(() => {
                            item.style.display = 'none';
                        }, 300);
                    }
                }, Math.random() * 150); // Staggered timing for natural effect
            });

            // Update filtered items array for lightbox navigation
            updateFilteredItems();
        });
    });

    // Update filtered items array based on current filter
    function updateFilteredItems() {
        const activeFilter = document.querySelector('.filter-btn.active').getAttribute('data-filter');
        filteredItems = Array.from(portfolioItems).filter(item => {
            return activeFilter === 'all' || item.getAttribute('data-category') === activeFilter;
        });
    }

    // Initialize filtered items
    updateFilteredItems();

    // Lightbox functionality
    portfolioLinks.forEach((link, index) => {
        link.addEventListener('click', function(e) {
            e.preventDefault();

            const imgSrc = this.getAttribute('href');
            const title = this.getAttribute('data-title');
            const category = this.getAttribute('data-category');

            // Find index in filtered items
            const itemElement = this.closest('.portfolio-item');
            currentIndex = filteredItems.indexOf(itemElement);

            // Open lightbox with image
            openLightbox(imgSrc, title, category);
        });
    });

    // Open lightbox function
    function openLightbox(src, title, category) {
        lightboxImage.src = src;
        lightboxTitle.textContent = title;
        lightboxCategory.textContent = category;

        // Show lightbox with animation
        lightbox.classList.add('active');
        document.body.style.overflow = 'hidden'; // Prevent scrolling
    }

    // Close lightbox function
    function closeLightbox() {
        lightbox.classList.remove('active');

        // Reset image source after animation completes
        setTimeout(() => {
            lightboxImage.src = '';
            document.body.style.overflow = ''; // Restore scrolling
        }, 300);
    }

    // Navigate to previous image
    function prevImage() {
        if (filteredItems.length <= 1) return;

        currentIndex = (currentIndex - 1 + filteredItems.length) % filteredItems.length;
        const prevItem = filteredItems[currentIndex];
        const prevLink = prevItem.querySelector('.portfolio-link');

        const imgSrc = prevLink.getAttribute('href');
        const title = prevLink.getAttribute('data-title');
        const category = prevLink.getAttribute('data-category');

        // Fade out current image
        lightboxImage.style.opacity = '0';

        // Change image and fade in
        setTimeout(() => {
            lightboxImage.src = imgSrc;
            lightboxTitle.textContent = title;
            lightboxCategory.textContent = category;
            lightboxImage.style.opacity = '1';
        }, 200);
    }

    // Navigate to next image
    function nextImage() {
        if (filteredItems.length <= 1) return;

        currentIndex = (currentIndex + 1) % filteredItems.length;
        const nextItem = filteredItems[currentIndex];
        const nextLink = nextItem.querySelector('.portfolio-link');

        const imgSrc = nextLink.getAttribute('href');
        const title = nextLink.getAttribute('data-title');
        const category = nextLink.getAttribute('data-category');

        // Fade out current image
        lightboxImage.style.opacity = '0';

        // Change image and fade in
        setTimeout(() => {
            lightboxImage.src = imgSrc;
            lightboxTitle.textContent = title;
            lightboxCategory.textContent = category;
            lightboxImage.style.opacity = '1';
        }, 200);
    }

    // Event listeners for lightbox controls
    lightboxClose.addEventListener('click', closeLightbox);
    lightboxPrev.addEventListener('click', prevImage);
    lightboxNext.addEventListener('click', nextImage);

    // Close lightbox with escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeLightbox();
        } else if (e.key === 'ArrowLeft') {
            prevImage();
        } else if (e.key === 'ArrowRight') {
            nextImage();
        }
    });

    // Close lightbox when clicking outside the content
    lightbox.addEventListener('click', function(e) {
        if (e.target === lightbox) {
            closeLightbox();
        }
    });
});
</script>
@endpush
<!-- Modern Pricing Section -->
<section class="pricing-section py-5">
    <div class="container">
        <div class="section-header text-center mb-5">
            <span class="section-subtitle">Photography Packages</span>
            <h2 class="section-title">Our <span>Packages</span></h2>
            <div class="section-line mx-auto"></div>
            <p class="section-description mt-4">Choose the perfect photography package for your special moments</p>
        </div>

        <div class="row pricing-cards">
            <!-- Basic Package -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="pricing-card">
                    <div class="pricing-header">
                        <div class="pricing-icon">
                            <i class="fas fa-camera"></i>
                        </div>
                        <h3 class="pricing-title">Basic Package</h3>
                        <div class="pricing-price">
                            <span class="price-value">₹15,999</span>
                            <span class="price-duration">/session</span>
                        </div>
                    </div>
                    <div class="pricing-features">
                        <ul>
                            <li><span class="feature-name">Photography Session</span><span class="feature-value">4
                                    Hours</span></li>
                            <li><span class="feature-name">Edited Digital Photos</span><span class="feature-value">100
                                    Photos</span></li>
                            <li><span class="feature-name">Online Gallery Access</span><span class="feature-value"><i
                                        class="fas fa-check"></i></span></li>
                            <li><span class="feature-name">Photo Retouching</span><span
                                    class="feature-value">Basic</span></li>
                            <li><span class="feature-name">Printed Photos</span><span class="feature-value">-</span>
                            </li>
                            <li><span class="feature-name">Digital Download</span><span class="feature-value"><i
                                        class="fas fa-check"></i></span></li>
                            <li><span class="feature-name">Same Day Preview</span><span class="feature-value">-</span>
                            </li>
                            <li><span class="feature-name">Drone Shots</span><span class="feature-value">-</span></li>
                            <li><span class="feature-name">Handcrafted Photo Album</span><span
                                    class="feature-value">-</span></li>
                        </ul>
                    </div>
                    <div class="pricing-action">
                        <a href="#booking" class="btn-pricing outline">Book Now</a>
                    </div>
                </div>
            </div>

            <!-- Premium Package -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="pricing-card featured">
                    <div class="pricing-badge">POPULAR</div>
                    <div class="pricing-header">
                        <div class="pricing-icon">
                            <i class="fas fa-camera-retro"></i>
                        </div>
                        <h3 class="pricing-title">Premium Package</h3>
                        <div class="pricing-price">
                            <span class="price-value">₹25,999</span>
                            <span class="price-duration">/session</span>
                        </div>
                    </div>
                    <div class="pricing-features">
                        <ul>
                            <li><span class="feature-name">Photography Session</span><span class="feature-value">8
                                    Hours</span></li>
                            <li><span class="feature-name">Edited Digital Photos</span><span class="feature-value">200
                                    Photos</span></li>
                            <li><span class="feature-name">Online Gallery Access</span><span class="feature-value"><i
                                        class="fas fa-check"></i></span></li>
                            <li><span class="feature-name">Photo Retouching</span><span
                                    class="feature-value">Advanced</span></li>
                            <li><span class="feature-name">Printed Photos</span><span class="feature-value">20
                                    (8x10)</span></li>
                            <li><span class="feature-name">Digital Download</span><span class="feature-value"><i
                                        class="fas fa-check"></i></span></li>
                            <li><span class="feature-name">Same Day Preview</span><span class="feature-value"><i
                                        class="fas fa-check"></i></span></li>
                            <li><span class="feature-name">Drone Shots</span><span class="feature-value">-</span></li>
                            <li><span class="feature-name">Handcrafted Photo Album</span><span
                                    class="feature-value">-</span></li>
                        </ul>
                    </div>
                    <div class="pricing-action">
                        <a href="#booking" class="btn-pricing">Book Now</a>
                    </div>
                </div>
            </div>

            <!-- Luxury Package -->
            <div class="col-lg-4 col-md-6 mb-4 mx-auto">
                <div class="pricing-card">
                    <div class="pricing-header">
                        <div class="pricing-icon">
                            <i class="fas fa-crown"></i>
                        </div>
                        <h3 class="pricing-title">Luxury Package</h3>
                        <div class="pricing-price">
                            <span class="price-value">₹35,999</span>
                            <span class="price-duration">/session</span>
                        </div>
                    </div>
                    <div class="pricing-features">
                        <ul>
                            <li><span class="feature-name">Photography Session</span><span class="feature-value">Full
                                    Day</span></li>
                            <li><span class="feature-name">Edited Digital Photos</span><span class="feature-value">300
                                    Photos</span></li>
                            <li><span class="feature-name">Online Gallery Access</span><span class="feature-value"><i
                                        class="fas fa-check"></i></span></li>
                            <li><span class="feature-name">Photo Retouching</span><span
                                    class="feature-value">Premium</span></li>
                            <li><span class="feature-name">Printed Photos</span><span class="feature-value">30
                                    (8x10)</span></li>
                            <li><span class="feature-name">Digital Download</span><span class="feature-value"><i
                                        class="fas fa-check"></i></span></li>
                            <li><span class="feature-name">Same Day Preview</span><span class="feature-value"><i
                                        class="fas fa-check"></i></span></li>
                            <li><span class="feature-name">Drone Shots</span><span class="feature-value"><i
                                        class="fas fa-check"></i></span></li>
                            <li><span class="feature-name">Handcrafted Photo Album</span><span class="feature-value"><i
                                        class="fas fa-check"></i></span></li>
                        </ul>
                    </div>
                    <div class="pricing-action">
                        <a href="#booking" class="btn-pricing outline">Book Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Modern Contact Section -->
<section class="contact-section">
    <div class="contact-shape-top"></div>
    <div class="container">
        <div class="section-header text-center mb-5">
            <span class="section-subtitle">Contact Us</span>
            <h2 class="section-title">Get in <span>Touch</span></h2>
            <div class="section-line mx-auto"></div>
            <p class="section-description mt-4">We are passionate about creating incredible photo & video stories that
                capture your special moments</p>
        </div>

        <div class="row">
            <div class="col-lg-5 mb-4 mb-lg-0">
                <div class="contact-info-card">
                    <div class="contact-info-header">
                        <h3 class="text-white">Let's Connect</h3>
                        <p>Contact us and let's together discuss & plan your iconic cinematic wedding or event
                            photography.</p>
                    </div>

                    <div class="contact-info-body">
                        <div class="contact-info-item">
                            <div class="contact-icon">
                                <i class="fas fa-phone-alt"></i>
                            </div>
                            <div class="contact-details">
                                <h5>Phone</h5>
                                <p>+91 1234567890</p>
                            </div>
                        </div>

                        <div class="contact-info-item">
                            <div class="contact-icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="contact-details">
                                <h5>Email</h5>
                                <p>info@Andaman Bliss™.com</p>
                            </div>
                        </div>

                        <div class="contact-info-item">
                            <div class="contact-icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="contact-details">
                                <h5>Location</h5>
                                <p>Port Blair, Andaman and Nicobar Islands</p>
                            </div>
                        </div>
                    </div>

                    <div class="contact-info-footer">
                        <div class="social-links">
                            <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                            <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="social-link"><i class="fab fa-whatsapp"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-7">
                <div class="contact-map-card">
                    <div class="map-container">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d252084.18937138247!2d92.58223242800156!3d11.623585237591866!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3088949c1d7cf63d%3A0x875f1a0994a6a708!2sPort%20Blair%2C%20Andaman%20and%20Nicobar%20Islands!5e0!3m2!1sen!2sin!4v1708450161811!5m2!1sen!2sin"
                            width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                    <div class="map-overlay">
                        <div class="map-card">
                            <h4>Visit Our Studio</h4>
                            <p>We're located in the heart of Port Blair. Drop by our studio to discuss your photography
                                needs in person.</p>
                            <a href="https://goo.gl/maps/JKQCkNFGqXm1TGWT6" target="_blank" class="btn-directions">
                                <i class="fas fa-directions me-2"></i> Get Directions
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="contact-shape-bottom"></div>
</section>
<style>
/* Modern Pricing Section Styles */
.pricing-section {
    position: relative;
    background-color: #f9f9f9;
    padding: 80px 0;
    overflow: hidden;
}

.pricing-section .section-title span {
    background: linear-gradient(to right, #f9925a, var(--color-secondary));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    color: var(--color-secondary);
}

.pricing-section .section-line {
    width: 80px;
    height: 4px;

    margin: 15px auto 0;
    border-radius: 2px;
}

.pricing-cards {
    position: relative;
    z-index: 1;
}

.pricing-card {
    position: relative;
    background-color: white !important;
    border-radius: 16px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    overflow: hidden;
    transition: all 0.4s ease;
    height: 100%;
    background: #fff !important;
    border: 1px solid rgba(0, 0, 0, 0.05);
}

.pricing-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.12);
}

.pricing-card.featured {
    border: 2px solid rgb(17, 157, 213);
    transform: scale(1.02);
    z-index: 2;
}

.pricing-card.featured:hover {
    transform: scale(1.02) translateY(-10px);
}

.pricing-badge {
    position: absolute;
    top: 15px;
    right: 15px;
    background-color: rgb(17, 157, 213);
    color: white;
    padding: 5px 12px;
    border-radius: 30px;
    font-size: 0.8rem;
    font-weight: 600;
    box-shadow: 0 3px 10px rgba(17, 157, 213, 0.3);
}

.pricing-header {
    padding: 30px 25px;
    text-align: center;
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    display: block !important;
}

.pricing-icon {
    width: 70px;
    height: 70px;
    background-color: rgba(17, 157, 213, 0.1);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 20px;
    transition: all 0.3s ease;
}

.pricing-icon i {
    font-size: 1.8rem;
    color: rgb(17, 157, 213);
    transition: all 0.3s ease;
}

.pricing-card:hover .pricing-icon {
    background-color: rgb(17, 157, 213);
}

.pricing-card:hover .pricing-icon i {
    color: white;
}

.pricing-title {
    font-size: 1.2rem;
    font-weight: 700;
    color: #333;
    display: block !important;
    margin-bottom: 15px;
}

.pricing-price {
    margin-bottom: 10px;
}

.price-value {
    font-size: 1.5rem;
    font-weight: 700;
    color: #fd6e0f;
}

.price-duration {
    font-size: 1.5rem;
    color: #777;
}

.pricing-features {
    padding: 25px;
}

.pricing-features ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.pricing-features li {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px 0;
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
}

.pricing-features li:last-child {
    border-bottom: none;
}

.feature-name {
    color: #555;
    font-weight: 500;
}

.feature-value {
    font-weight: 600;
    color: #333;
}

.feature-value i {
    color: #fd6e0f;
}

.pricing-action {
    padding: 0 25px 30px;
    text-align: center;
}

.btn-pricing {
    display: inline-block;
    background-color: rgb(17, 157, 213);
    color: white;
    padding: 12px 30px;
    border-radius: 50px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
    border: 2px solid rgb(17, 157, 213);
    width: 100%;
}

.btn-pricing:hover {
    background-color: #0e8bc0;
    color: white;
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(17, 157, 213, 0.3);
}

.btn-pricing.outline {
    background-color: transparent;
    color: rgb(17, 157, 213);
}

.btn-pricing.outline:hover {
    background-color: rgb(17, 157, 213);
    color: white;
}

/* Responsive Styles */
@media (max-width: 991px) {
    .pricing-card {
        margin-bottom: 30px;
    }

    .pricing-card.featured {
        transform: scale(1);
    }

    .pricing-card.featured:hover {
        transform: translateY(-10px);
    }
}

@media (max-width: 767px) {
    .pricing-section {
        padding: 60px 0;
    }

    .pricing-header {
        padding: 25px 20px;
    }

    .pricing-features {
        padding: 20px;
    }

    .pricing-title {
        font-size: 1.2rem;
    }

    .price-value {
        font-size: 1.5rem;
    }
}

/* Modern Contact Section Styles */
.contact-section {
    position: relative;
    padding: 80px 0;
    background-color: #fff;
    overflow: hidden;
}

.contact-shape-top {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100px;
    background-color: #f9f9f9;
    clip-path: polygon(0 0, 100% 0, 100% 100%, 0 0);
    z-index: 0;
}

.contact-shape-bottom {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 100px;
    background-color: #f9f9f9;
    clip-path: polygon(0 100%, 100% 0, 100% 100%, 0 100%);
    z-index: 0;
}

.contact-section .section-title span {
    background: linear-gradient(to right, #f9925a, var(--color-secondary));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    color: var(--color-secondary);
}

.contact-section .section-line {
    width: 80px;
    height: 4px;
    margin: 15px auto 0;
    border-radius: 2px;
}

.contact-info-card {
    position: relative;
    background-color: white;
    border-radius: 16px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    overflow: hidden;
    height: 100%;
    transition: all 0.4s ease;
    border: 1px solid rgba(0, 0, 0, 0.05);
    display: flex;
    flex-direction: column;
}

.contact-info-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.12);
}

.contact-info-header {
    padding: 30px;
    background: linear-gradient(135deg, rgb(17, 157, 213), #0e8bc0);
    color: white;
}

.contact-info-header h3 {
    font-size: 1.8rem;
    font-weight: 700;
    margin-bottom: 15px;
}

.contact-info-header p {
    opacity: 0.9;
    font-size: 1rem;
    line-height: 1.6;
}

.contact-info-body {
    padding: 30px;
    flex: 1;
}

.contact-info-item {
    display: flex;
    align-items: flex-start;
    margin-bottom: 25px;
}

.contact-info-item:last-child {
    margin-bottom: 0;
}

.contact-icon {
    width: 50px;
    height: 50px;
    background-color: rgba(17, 157, 213, 0.1);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 20px;
    flex-shrink: 0;
    transition: all 0.3s ease;
}

.contact-icon i {
    font-size: 1.2rem;
    color: rgb(17, 157, 213);
    transition: all 0.3s ease;
}

.contact-info-item:hover .contact-icon {
    background-color: rgb(17, 157, 213);
}

.contact-info-item:hover .contact-icon i {
    color: white;
}

.contact-details h5 {
    font-size: 1.1rem;
    font-weight: 600;
    color: #333;
    margin-bottom: 5px;
}

.contact-details p {
    color: #666;
    font-size: 1rem;
    line-height: 1.5;
    margin-bottom: 0;
}

.contact-info-footer {
    padding: 20px 30px;
    border-top: 1px solid rgba(0, 0, 0, 0.05);
    background-color: #f9f9f9;
}

.social-links {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 15px;
}

.social-link {
    width: 40px;
    height: 40px;
    background-color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #666;
    font-size: 1rem;
    transition: all 0.3s ease;
    box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
    border: 1px solid rgba(0, 0, 0, 0.05);
}

.social-link:hover {
    background-color: rgb(17, 157, 213);
    color: white;
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(17, 157, 213, 0.2);
}

.contact-map-card {
    position: relative;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    height: 100%;
    min-height: 450px;
    transition: all 0.4s ease;
    border: 1px solid rgba(0, 0, 0, 0.05);
}

.contact-map-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.12);
}

.map-container {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 1;
}

.map-overlay {
    position: absolute;
    bottom: 30px;
    left: 30px;
    z-index: 2;
    max-width: 300px;
}

.map-card {
    background-color: white;
    border-radius: 12px;
    padding: 20px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
}

.map-card h4 {
    font-size: 1.3rem;
    font-weight: 700;
    color: #333;
    margin-bottom: 10px;
}

.map-card p {
    color: #666;
    font-size: 0.95rem;
    line-height: 1.5;
    margin-bottom: 15px;
}

.btn-directions {
    display: inline-flex;
    align-items: center;
    background-color: #fd6e0f;
    color: white;
    padding: 8px 15px;
    border-radius: 30px;
    text-decoration: none;
    font-size: 0.9rem;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-directions:hover {
    background-color: #e05d00;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(253, 110, 15, 0.3);
}

/* Responsive Styles */
@media (max-width: 991px) {
    .contact-section {
        padding: 60px 0;
    }

    .contact-info-card,
    .contact-map-card {
        margin-bottom: 30px;
    }

    .map-overlay {
        bottom: 20px;
        left: 20px;
        max-width: 250px;
    }
}

@media (max-width: 767px) {
    .contact-info-header {
        padding: 25px 20px;
    }

    .contact-info-body {
        padding: 25px 20px;
    }

    .contact-info-footer {
        padding: 15px 20px;
    }

    .contact-info-header h3 {
        font-size: 1.5rem;
    }

    .map-overlay {
        bottom: 15px;
        left: 15px;
        max-width: 220px;
    }

    .map-card {
        padding: 15px;
    }

    .map-card h4 {
        font-size: 1.1rem;
    }

    .map-card p {
        font-size: 0.9rem;
        margin-bottom: 10px;
    }

    .btn-directions {
        padding: 6px 12px;
        font-size: 0.8rem;
    }
}

@media (max-width: 575px) {
    .contact-map-card {
        min-height: 350px;
    }

    .map-overlay {
        max-width: 200px;
    }
}
</style>
@endsection