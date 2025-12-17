@extends('layouts.app')
@section('title', 'Best Game Fishing in Andaman & Sport Fishing In Andaman Islands')
@section('keywords', 'Game Fishing In Andaman Islands, Deep Sea Fishing In Andaman Islands, Sport Fishing In Andaman, Fishing Charter, Fishing Trip In Andaman,
Sailfish, Tuna, Marlin, Sports Fishing In Andaman')
@section('description', 'Experience world-class game fishing sport in Andaman Islands. Catch prized species like Sailfish, Tuna and Marlin with our expert guides and premium equipment.')

@push('styles')
<style>
/* Hero Section Styles */
.boat-charter-hero {
    min-height: 90vh;
    display: flex;
    align-items: center;
    position: relative;
}

.min-vh-75 {
    min-height: 75vh;
}

.hero-bg {
    overflow: hidden;
}

.hero-bg img {
    object-position: center;
    transition: transform 15s ease;
    transform: scale(1.05);
}

.boat-charter-hero:hover .hero-bg img {
    transform: scale(1);
}

/* Floating Elements */
.floating-elements {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 2;
    pointer-events: none;
}

.floating-bubble {
    position: absolute;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.25);
    backdrop-filter: blur(5px);
    animation: float 8s infinite ease-in-out;
}

.bubble-1 {
    width: 80px;
    height: 80px;
    top: 15%;
    left: 10%;
    animation-delay: 0s;
}

.bubble-2 {
    width: 40px;
    height: 40px;
    top: 20%;
    right: 20%;
    animation-delay: 2s;
}

.bubble-3 {
    width: 60px;
    height: 60px;
    bottom: 30%;
    right: 10%;
    animation-delay: 4s;
}

@keyframes float {

    0%,
    100% {
        transform: translateY(0);
    }

    50% {
        transform: translateY(-20px);
    }
}

/* Hero Content Styles */
.hero-content {
    color: #fff;
    position: relative;
    z-index: 3;
}

.hero-badge {
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(10px);
    border-radius: 50px;
    padding: 8px 16px;
    font-size: 0.85rem;
    font-weight: 600;
    color: #fff;
    display: inline-flex;
    align-items: center;
    transition: all 0.3s ease;
}

.hero-badge:hover {
    background: rgba(255, 255, 255, 0.25);
    transform: translateY(-3px);
}

.hero-title {
    font-size: 3.5rem;
    font-weight: 800;
    line-height: 1.2;
    color: #fff;
}

.gradient-text {
    color: rgb(17, 157, 213);
    display: inline-block;
    padding: 0 5px;
    position: relative;
    text-shadow: none;
}

.gradient-text::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 4px;
    background: rgb(17, 157, 213);
    border-radius: 2px;
}

.hero-subtitle {
    font-size: 1.2rem;
    opacity: 0.9;
    max-width: 600px;
    text-shadow: 0 1px 5px rgba(0, 0, 0, 0.2);
}

.btn-hero-primary {
    background: linear-gradient(135deg, rgb(17, 157, 213) 0%, rgb(0, 198, 255) 100%);
    color: #fff;
    border: none;
    border-radius: 50px;
    padding: 14px 28px;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    transition: all 0.3s ease;
    text-decoration: none;
    box-shadow: 0 5px 15px rgba(17, 157, 213, 0.3);
}

.btn-hero-primary:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(17, 157, 213, 0.4);
    color: #fff;
}

.btn-hero-secondary {
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(10px);
    color: #fff;
    border: 1px solid rgba(255, 255, 255, 0.3);
    border-radius: 50px;
    padding: 14px 28px;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    transition: all 0.3s ease;
    text-decoration: none;
    position: relative;
    overflow: hidden;
    z-index: 1;
}

.btn-hero-secondary::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(17, 157, 213, 0.1);
    z-index: -1;
    transform: scale(0);
    transition: all 0.5s ease;
    border-radius: 50px;
}

.btn-hero-secondary:hover {
    background: #fff;
    transform: translateY(-3px);
    color: rgb(17, 157, 213);
    box-shadow: 0 0 25px rgba(255, 255, 255, 0.7);
    border-color: rgba(17, 157, 213, 0.5);
    animation: pulse 1.5s infinite;
}

@keyframes pulse {
    0% {
        box-shadow: 0 0 15px rgba(255, 255, 255, 0.5);
    }

    50% {
        box-shadow: 0 0 25px rgba(255, 255, 255, 0.8);
    }

    100% {
        box-shadow: 0 0 15px rgba(255, 255, 255, 0.5);
    }
}

.btn-hero-secondary:hover::before {
    transform: scale(1.5);
    opacity: 0;
}

.btn-hero-secondary:hover i {
    color: rgb(17, 157, 213);
    transform: scale(1.2);
    transition: all 0.3s ease;
}

/* Wave Separator */
.wave-separator {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    line-height: 0;
    z-index: 2;
}

.wave-separator svg {
    width: 100%;
    height: 120px;
    filter: drop-shadow(0 -5px 5px rgba(0, 0, 0, 0.05));
}

/* Inquiry Form Styles */
.inquiry-card {
    background: #ffffff;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    transition: all 0.3s ease;
    max-width: 380px;
    margin: 0 auto;
    position: relative;
    z-index: 10;
    border: 1px solid rgba(0, 0, 0, 0.08);
}

.inquiry-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
}

.inquiry-card-header {
    background: rgb(17, 157, 213);
    padding: 20px;
    text-align: center;
    position: relative;
    border-radius: 16px 16px 0 0;
}

.inquiry-title {
    color: #ffffff;
    font-size: 1.5rem;
    font-weight: 700;
    margin-bottom: 5px;
}

.inquiry-subtitle {
    color: rgba(255, 255, 255, 0.9);
    font-size: 0.9rem;
    margin-bottom: 0;
}

.inquiry-form {
    padding: 20px;
}

.inquiry-input-wrapper {
    position: relative;
    margin-bottom: 0;
}

.inquiry-input,
.inquiry-select {
    width: 100%;
    height: 50px;
    padding: 10px 15px 10px 40px;
    border: 1px solid rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    background-color: #fff;
    font-size: 0.95rem;
    color: #333;
    transition: all 0.3s ease;
}

.inquiry-input:focus,
.inquiry-select:focus {
    border-color: rgb(17, 157, 213);
    box-shadow: 0 0 0 3px rgba(17, 157, 213, 0.15);
    outline: none;
}

.input-icon {
    position: absolute;
    left: 15px;
    top: 50%;
    transform: translateY(-50%);
    color: #6c757d;
    font-size: 0.9rem;
    z-index: 1;
}

.inquiry-select {
    appearance: none;
    padding-right: 30px;
    background-color: #fff;
    cursor: pointer;
    background-image: none;
}

.select-arrow {
    position: absolute;
    right: 12px;
    top: 50%;
    transform: translateY(-50%);
    color: rgb(17, 157, 213);
    pointer-events: none;
    font-size: 0.8rem;
}

.btn-inquiry-submit {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    background: rgb(17, 157, 213);
    color: #ffffff;
    font-weight: 600;
    font-size: 1rem;
    padding: 12px 20px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s ease;
    margin-bottom: 15px;
    text-align: center;
    box-shadow: 0 4px 10px rgba(17, 157, 213, 0.3);
}

.btn-inquiry-submit:hover {
    background: #0e8bc0;
}

.btn-inquiry-submit:active {
    transform: translateY(1px);
}

.inquiry-features {
    display: flex;
    justify-content: center;
    gap: 10px;
    margin-top: 5px;
}

.feature-badge {
    display: flex;
    align-items: center;
    background-color: rgba(32, 169, 224, 0.08);
    border-radius: 50px;
    padding: 5px 10px;
    font-size: 0.75rem;
    color: #555;
}

.feature-badge i {
    margin-right: 5px;
    font-size: 0.8rem;
}

.feature-badge:nth-child(1) i {
    color: #f39c12;
}

.feature-badge:nth-child(2) i {
    color: #20a9e0;
}

.feature-badge:nth-child(3) i {
    color: #2ecc71;
}

/* Responsive Styles */
@media (max-width: 1200px) {
    .hero-title {
        font-size: 3rem;
    }
}

@media (max-width: 992px) {
    .boat-charter-hero {
        min-height: auto;
    }

    .min-vh-75 {
        min-height: auto;
    }

    .hero-title {
        font-size: 2.5rem;
    }

    .hero-subtitle {
        font-size: 1.1rem;
    }
}

@media (max-width: 768px) {
    .hero-title {
        font-size: 2.2rem;
    }

    .btn-hero-primary,
    .btn-hero-secondary {
        width: 100%;
        justify-content: center;
        margin-bottom: 10px;
    }
}

@media (max-width: 576px) {
    .hero-title {
        font-size: 1.8rem;
    }

    .hero-badge {
        font-size: 0.75rem;
        padding: 6px 12px;
    }

    .hero-subtitle {
        font-size: 1rem;
    }

    .boat-charter-hero .container {
        padding-top: 30px;
        padding-bottom: 30px;
    }
}

/* Animations */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.hero-content h1,
.hero-content p,
.hero-content .d-flex {
    animation: fadeInUp 0.8s ease-out forwards;
}

.hero-content .d-flex:first-child {
    animation-delay: 0.2s;
}

.hero-content h1 {
    animation-delay: 0.4s;
}

.hero-content p {
    animation-delay: 0.6s;
}

.hero-content .d-flex:last-child {
    animation-delay: 0.8s;
}

.inquiry-card {
    animation: fadeInUp 1s ease-out forwards;
    animation-delay: 1s;
}

/* Fishing Locations Section Styles */
.fishing-locations-section {
    background-color: #f8f9fa;
    position: relative;
}

.location-card {
    background: #fff;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
    transition: all 0.3s ease;
    height: 100%;
    display: flex;
    flex-direction: column;
}

.location-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
}

.location-image {
    position: relative;
    height: 200px;
    overflow: hidden;
}

.location-image img {
    width: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.location-card:hover .location-image img {
    transform: scale(1.05);
}

.location-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(to bottom, rgba(0, 0, 0, 0.1), rgba(0, 0, 0, 0.4));
    display: flex;
    justify-content: flex-end;
    align-items: flex-start;
    padding: 15px;
}

.location-tag {
    background: rgb(17, 157, 213);
    color: white;
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
}

.location-content {
    margin-top: 2px;
    padding: 3px;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
}

.location-title {
    font-size: 1.25rem;
    font-weight: 700;
    margin-bottom: 12px;
    color: #333;
}

.location-details {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    margin-bottom: 15px;
}

.detail-item {
    background-color: rgba(17, 157, 213, 0.08);
    border-radius: 20px;
    padding: 5px 10px;
    font-size: 0.8rem;
    color: #555;
    display: flex;
    align-items: center;
}

.charter-specs {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-bottom: 15px;
    padding-bottom: 15px;
    border-bottom: 1px solid #f0f0f0;
}

.spec-item {
    background-color: rgba(17, 157, 213, 0.05);
    padding: 5px 10px;
    border-radius: 20px;
    font-size: 0.85rem;
    color: #555;
    display: flex;
    align-items: center;
}

.spec-item i {
    color: rgb(17, 157, 213);
    margin-right: 5px;
    font-size: 0.9rem;
}

.detail-item i {
    color: rgb(17, 157, 213);
    margin-right: 5px;
    font-size: 0.9rem;
}

.location-description {
    font-size: 0.9rem;
    color: #666;
    margin-bottom: 0;
    flex-grow: 1;
}

.location-pricing {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-bottom: 15px;
    justify-content: space-between;
    align-items: center;
}

.price-option {
    flex: 1;
    min-width: 120px;
}

.price-label {
    font-size: 1.02rem;
    color: #666;
    margin-bottom: 3px;
}

.price-amount {
    font-size: 1.1rem;
    font-weight: 700;
    color: #333;
}

.price-period {
    font-size: 0.85rem;
    font-weight: 400;
    color: #666;
}

.btn-book-now {
    background: rgb(17, 157, 213);
    color: white;
    border: none;
    border-radius: 8px;
    padding: 10px 15px;
    font-weight: 600;
    font-size: 0.9rem;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    margin-top: auto;
}

.btn-book-now:hover {
    background: #0e8bc0;
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(17, 157, 213, 0.3);
}

/* Modal Styles */
.modal-content {
    border-radius: 12px;
    overflow: hidden;
    border: none;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
}

.modal-header {
    border-bottom: none;
    padding: 20px;
    background-color: rgb(17, 157, 213);

}

.modal-header h5 {
    color: #fff;
    font-size: 1.5rem;
    font-weight: 700;
}

.modal-body {
    padding: 20px;
}

.modal-footer {
    border-top: none;
    padding: 15px 20px 20px;
}

.form-label {
    font-weight: 500;
    font-size: 0.9rem;
    color: #555;
}

.form-control,
.form-select {
    border-radius: 8px;
    border: 1px solid rgba(0, 0, 0, 0.1);
    padding: 10px 35px;
    font-size: 0.95rem;
}

.btn-close:focus {
    box-shadow: none !important;
}

.form-control:focus,
.form-select:focus {
    border-color: rgb(17, 157, 213);
    box-shadow: 0 0 0 3px rgba(17, 157, 213, 0.15);
}

@media (max-width: 768px) {
    .location-pricing {
        flex-direction: row;
        gap: 1px;
    }

    .price-option {
        display: flex;
        justify-content: flex-end;
        align-items: center;
    }

    .location-details {
        flex-direction: column;
        gap: 5px;
    }
}

/* Boat Details Section Styles */
.boat-details-section {
    background-color: #fff;
    position: relative;
}

.boat-image-slider {
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
}

.carousel-inner {
    height: 400px;
}

.carousel-inner img {
    height: 100%;
    object-fit: cover;
}

.carousel-indicators {
    margin-bottom: 1rem;
}

.carousel-indicators button {
    width: 10px;
    height: 10px;
    border-radius: 50%;
    background-color: rgba(255, 255, 255, 0.5);
    border: none;
    margin: 0 5px;
}

.carousel-indicators button.active {
    background-color: rgb(17, 157, 213);
}

.boat-details-content {
    padding: 20px;
    height: 100%;
    display: flex;
    flex-direction: column;
}

.boat-name-badge {
    display: inline-block;
    background-color: rgba(17, 157, 213, 0.1);
    color: rgb(17, 157, 213);
    font-weight: 600;
    font-size: 0.85rem;
    padding: 5px 15px;
    border-radius: 20px;
    margin-bottom: 15px;
}

.boat-name {
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 15px;
    color: #333;
}

.boat-description {
    font-size: 1rem;
    color: #666;
    margin-bottom: 20px;
    line-height: 1.6;
}

.boat-features {
    display: flex;
    flex-direction: column;
    gap: 20px;
    margin-bottom: 25px;
}

.feature-group h4 {
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 10px;
    color: #333;
    position: relative;
    padding-left: 15px;
}

.feature-group h4::before {
    content: '';
    position: absolute;
    left: 0;
    top: 50%;
    transform: translateY(-50%);
    width: 5px;
    height: 20px;
    background: rgb(17, 157, 213);
    border-radius: 3px;
}

.feature-list {
    list-style: none;
    padding: 0;
    margin: 0;
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 10px;
}

.feature-list li {
    font-size: 0.95rem;
    color: #555;
    display: flex;
    align-items: center;
}

.feature-list li i {
    color: rgb(17, 157, 213);
    margin-right: 8px;
    font-size: 1rem;
    width: 20px;
    text-align: center;
}

.boat-cta {
    margin-top: auto;
}

.btn-view-packages {
    display: inline-flex;
    align-items: center;
    background: rgb(17, 157, 213);
    color: white;
    border: none;
    border-radius: 8px;
    padding: 12px 25px;
    font-weight: 600;
    font-size: 1rem;
    cursor: pointer;
    transition: all 0.3s ease;
    text-decoration: none;
}

.btn-view-packages:hover {
    background: #0e8bc0;
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(17, 157, 213, 0.3);
    color: white;
}

@media (max-width: 992px) {
    .carousel-inner {
        height: 350px;
    }

    .feature-list {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 768px) {
    .carousel-inner {
        height: 300px;
    }

    .boat-details-content {
        padding: 20px 0;
    }

    .boat-name {
        font-size: 1.75rem;
    }
}

/* Itinerary Section Styles */
.itinerary-section {
    position: relative;
}

.package-card {
    background: #fff;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
    transition: all 0.3s ease;
    height: 100%;
    display: flex;
    flex-direction: column;
}

.package-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
}

.package-header {
    background: rgb(17, 157, 213);
    color: white;
    padding: 15px 20px;
    position: relative;
}

.package-tag {
    position: absolute;
    top: 0;
    right: 20px;
    background: #f9680f;
    color: white;
    font-size: 0.75rem;
    font-weight: 600;
    padding: 5px 12px;
    border-radius: 0 0 8px 8px;
}

.package-title {
    font-size: 1.25rem;
    font-weight: 700;
    margin-bottom: 5px;
}

.package-duration {
    font-size: 0.9rem;
    opacity: 0.9;
    display: flex;
    align-items: center;
}

.package-duration i {
    margin-right: 5px;
}

.package-body {
    padding: 0;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
}

.package-image {
    height: 180px;
    overflow: hidden;
}

.package-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.package-card:hover .package-image img {
    transform: scale(1.05);
}

.package-highlights {
    padding: 15px 20px 0;
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.highlight-item {
    display: flex;
    align-items: center;
    font-size: 0.9rem;
    color: #555;
}

.highlight-item i {
    color: rgb(17, 157, 213);
    margin-right: 8px;
    width: 16px;
    text-align: center;
}

.package-description {
    padding: 15px 20px;
    font-size: 0.9rem;
    color: #666;
    margin-bottom: 0;
    flex-grow: 1;
}

.package-price {
    padding: 0 20px;
    margin-bottom: 15px;
}

.price {
    font-size: 1.5rem;
    font-weight: 700;
    color: #333;
    display: block;
}

.per-person {
    font-size: 0.85rem;
    color: #666;
}

.btn-view-details {
    margin: 0 20px 20px;
    background: rgb(17, 157, 213);
    color: white;
    border: none;
    border-radius: 8px;
    padding: 10px 15px;
    font-weight: 600;
    font-size: 0.9rem;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
}

.btn-view-details:hover {
    background: #0e8bc0;
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(17, 157, 213, 0.3);
}

/* Itinerary Timeline Styles */
.itinerary-timeline {
    position: relative;
    padding-left: 30px;
}

.itinerary-timeline:before {
    content: '';
    position: absolute;
    top: 0;
    bottom: 0;
    left: 15px;
    width: 2px;
    background: rgba(17, 157, 213, 0.2);
}

.timeline-item {
    position: relative;
    padding-bottom: 30px;
}

.timeline-item:last-child {
    padding-bottom: 0;
}

.timeline-dot {
    position: absolute;
    left: -30px;
    width: 30px;
    height: 30px;
    background: #fff;
    border: 2px solid rgb(17, 157, 213);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: rgb(17, 157, 213);
    font-size: 0.9rem;
    z-index: 1;
}

.timeline-content {
    background: #fff;
    border-radius: 10px;
    padding: 15px;
    box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
}

.timeline-time {
    font-weight: 600;
    color: rgb(17, 157, 213);
    margin-bottom: 5px;
    font-size: 0.9rem;
}

.timeline-title {
    font-weight: 600;
    margin-bottom: 8px;
    font-size: 1.1rem;
    color: #333;
}

.timeline-description {
    color: #666;
    font-size: 0.9rem;
    margin-bottom: 0;
}

/* Day Header Styles */
.day-header {
    margin-bottom: 15px;
}

.day-header h4 {
    font-size: 1.2rem;
    font-weight: 700;
    color: #333;
    padding-bottom: 8px;
    border-bottom: 2px solid rgba(17, 157, 213, 0.2);
}

.day-description {
    font-size: 0.95rem;
    color: #555;
    margin-bottom: 20px;
}

.expedition-intro {
    font-size: 0.95rem;
    color: #555;
    margin-bottom: 20px;
    padding: 15px;
    background-color: rgba(17, 157, 213, 0.05);
    border-radius: 8px;
    border-left: 4px solid rgb(17, 157, 213);
}

/* Package Details Styles */
.package-details h4 {
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 10px;
    color: #333;
}

.package-includes {
    list-style: none;
    padding: 0;
    margin: 0 0 20px;
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 10px;
}

.package-includes li {
    font-size: 0.9rem;
    color: #555;
    display: flex;
    align-items: center;
}

.package-includes li i {
    color: #2ecc71;
    margin-right: 8px;
    font-size: 0.9rem;
}

.price-details {
    background-color: rgba(17, 157, 213, 0.05);
    border-radius: 8px;
    padding: 15px;
}

.price-item {
    display: flex;
    justify-content: space-between;
    margin-bottom: 8px;
    font-size: 0.9rem;
}

.price-item:last-child {
    margin-bottom: 0;
}

.price-label {
    color: #555;
}

.price-value {
    font-weight: 600;
    color: #333;
}

.expedition-note {
    font-size: 0.85rem;
    color: #666;
    padding: 10px 15px;
    background-color: rgba(249, 104, 15, 0.05);
    border-radius: 8px;
    border-left: 4px solid #f9680f;
}

@media (max-width: 992px) {
    .package-includes {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 768px) {
    .package-price {
        text-align: center;
    }

    .price-item {
        flex-direction: column;
        text-align: center;
        margin-bottom: 15px;
    }

    .price-value {
        margin-top: 5px;
    }
}

/* Gallery Section Styles */
.gallery-section {
    background-color: #f8f9fa;
    position: relative;
}

.gallery-filter {
    position: relative;
}

.filter-buttons {
    position: relative;
    z-index: 2;
}

.filter-btn {
    background: #fff;
    border: 1px solid rgba(0, 0, 0, 0.1);
    border-radius: 30px;
    padding: 8px 20px;
    font-size: 0.9rem;
    font-weight: 500;
    color: #555;
    cursor: pointer;
    transition: all 0.3s ease;
}

.filter-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
}

.filter-btn.active {
    background: rgb(17, 157, 213);
    color: #fff;
    border-color: rgb(17, 157, 213);
    box-shadow: 0 5px 15px rgba(17, 157, 213, 0.2);
}

.gallery-container {
    position: relative;
}

.gallery-item {
    transition: all 0.5s ease;
}

.gallery-card {
    position: relative;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
    transition: all 0.3s ease;
    height: 250px;
}

.gallery-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
}

.gallery-card img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.gallery-card:hover img {
    transform: scale(1.05);
}

.gallery-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(to top, rgba(0, 0, 0, 0.8) 0%, rgba(0, 0, 0, 0.2) 60%, rgba(0, 0, 0, 0.1) 100%);
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
    padding: 20px;
    opacity: 0;
    transition: all 0.3s ease;
}

.gallery-card:hover .gallery-overlay {
    opacity: 1;
}

.gallery-info {
    transform: translateY(20px);
    transition: all 0.3s ease;
    transition-delay: 0.1s;
}

.gallery-card:hover .gallery-info {
    transform: translateY(0);
}

.gallery-info h4 {
    color: #fff;
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 5px;
}

.gallery-info p {
    color: rgba(255, 255, 255, 0.8);
    font-size: 0.85rem;
    margin-bottom: 0;
}

.gallery-actions {
    display: flex;
    gap: 10px;
    margin-top: 15px;
    transform: translateY(20px);
    opacity: 0;
    transition: all 0.3s ease;
    transition-delay: 0.2s;
}

.gallery-card:hover .gallery-actions {
    transform: translateY(0);
    opacity: 1;
}

.gallery-zoom {
    width: 40px;
    height: 40px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 0.9rem;
    transition: all 0.3s ease;
    text-decoration: none;
}

.gallery-zoom:hover {
    background: rgba(255, 255, 255, 0.3);
    transform: translateY(-3px);
    color: #fff;
}

.btn-view-more {
    display: inline-flex;
    align-items: center;
    background: rgb(17, 157, 213);
    color: white;
    border: none;
    border-radius: 8px;
    padding: 12px 25px;
    font-weight: 600;
    font-size: 1rem;
    cursor: pointer;
    transition: all 0.3s ease;
    text-decoration: none;
    margin-top: 20px;
}

.btn-view-more:hover {
    background: #0e8bc0;
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(17, 157, 213, 0.3);
    color: white;
}

/* Lightbox Styles */
.lightbox {
    display: none;
    position: fixed;
    z-index: 9999;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.9);
    justify-content: center;
    align-items: center;
    flex-direction: column;
    padding: 20px;
}

.lightbox.active {
    display: flex;
}

.lightbox-content {
    position: relative;
    max-width: 90%;
    max-height: 80vh;
    margin: 0 auto;
}

.lightbox-image {
    max-width: 100%;
    max-height: 80vh;
    object-fit: contain;
    border-radius: 5px;
    box-shadow: 0 5px 30px rgba(0, 0, 0, 0.3);
}

.lightbox-caption {
    color: white;
    text-align: center;
    margin-top: 15px;
    font-size: 1.2rem;
    font-weight: 500;
}

.lightbox-close {
    position: absolute;
    top: 20px;
    right: 20px;
    color: white;
    font-size: 30px;
    cursor: pointer;
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: rgba(0, 0, 0, 0.5);
    border-radius: 50%;
    transition: all 0.3s ease;
}

.lightbox-close:hover {
    background-color: rgba(255, 255, 255, 0.2);
    transform: rotate(90deg);
}

.lightbox-nav {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    color: white;
    font-size: 24px;
    cursor: pointer;
    width: 50px;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: rgba(0, 0, 0, 0.5);
    border-radius: 50%;
    transition: all 0.3s ease;
}

.lightbox-nav:hover {
    background-color: rgba(255, 255, 255, 0.2);
}

.lightbox-prev {
    left: 20px;
}

.lightbox-next {
    right: 20px;
}

@media (max-width: 992px) {
    .gallery-card {
        height: 220px;
    }
}

@media (max-width: 768px) {
    .gallery-card {
        height: 200px;
    }

    .filter-btn {
        font-size: 0.8rem;
        padding: 6px 15px;
    }

    .lightbox-nav {
        width: 40px;
        height: 40px;
        font-size: 20px;
    }
}

/* Reviews Section Styles */
.reviews-section {
    background-color: #fff;
    position: relative;
}

.testimonial-card {
    background: #fff;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
    transition: all 0.3s ease;
    height: 100%;
}

.testimonial-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
}

.testimonial-card .card-body {
    padding: 25px;
    position: relative;
}

.testimonial-card .quote-icon {
    position: absolute;
    top: 15px;
    right: 15px;
    font-size: 3rem;
    opacity: 0.1;
    color: rgb(17, 157, 213);
}

.testimonial-card .rating {
    color: #ffc107;
}

.testimonial-card .testimonial-text {
    font-size: 0.95rem;
    color: #555;
    line-height: 1.6;
    margin-bottom: 0;
}

.testimonial-card .avatar {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid #fff;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
}

.testimonial-card .name {
    font-weight: 600;
    margin-bottom: 0;
    font-size: 1.1rem;
    color: #333;
}

.testimonial-card .location {
    font-size: 0.85rem;
    color: #6c757d;
}

.btn-view-all-reviews {
    display: inline-flex;
    align-items: center;
    background: rgb(17, 157, 213);
    color: white;
    border: none;
    border-radius: 8px;
    padding: 12px 25px;
    font-weight: 600;
    font-size: 1rem;
    cursor: pointer;
    transition: all 0.3s ease;
    text-decoration: none;
}

.btn-view-all-reviews:hover {
    background: #0e8bc0;
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(17, 157, 213, 0.3);
    color: white;
}

/* FAQ Section Styles */
.faq-section {
    position: relative;
}

.faq-item {
    border: 1px solid rgba(0, 0, 0, 0.1);
    border-radius: 10px;
    overflow: hidden;
    transition: all 0.3s ease;
    background-color: #fff;
}

.faq-item:hover {
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
}

.faq-question {
    padding: 15px 20px;
    cursor: pointer;
    font-weight: 600;
    display: flex;
    justify-content: space-between;
    align-items: center;
    color: #333;
    transition: all 0.3s ease;
}

.faq-question:after {
    content: '\f107';
    font-family: 'Font Awesome 5 Free';
    font-weight: 900;
    transition: all 0.3s ease;
    color: rgb(17, 157, 213);
}

.faq-question.collapsed:after {
    transform: rotate(-90deg);
}

.faq-answer {
    padding: 0 20px 15px;
}

.faq-answer p {
    color: #666;
    font-size: 0.95rem;
    line-height: 1.6;
    margin-bottom: 0;
}

/* CTA Section Styles */
.cta-section {
    position: relative;
    background: url('https://images.unsplash.com/photo-1564349683136-77e08dba1ef3?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1172&q=80') center/cover no-repeat;
}

.cta-container {
    background: radial-gradient(circle at center, rgb(21 159 241 / 66%) 0%, rgb(17 157 213) 100%);
    border-radius: 16px;
    padding: 50px 30px;
    color: #fff;
    position: relative;
    z-index: 2;
}

.cta-title {
    font-size: 1.8rem;
    font-weight: 700;
    margin-bottom: 15px;
    color: #fff;
}

.cta-text {
    font-size: 1.2rem;
    opacity: 0.9;
    max-width: 700px;
    margin: 0 auto;
}

.btn-cta-primary {
    background: rgb(17, 157, 213);
    color: white;
    border: none;
    border-radius: 50px;
    padding: 14px 28px;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    transition: all 0.3s ease;
    text-decoration: none;
    box-shadow: 0 5px 15px rgba(17, 157, 213, 0.3);
}

.btn-cta-primary:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(17, 157, 213, 0.4);
    color: #fff;
}

.btn-cta-secondary {
    background: transparent;
    color: #fff;
    border: 2px solid #fff;
    border-radius: 50px;
    padding: 12px 26px;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    transition: all 0.3s ease;
    text-decoration: none;
}

.btn-cta-secondary:hover {
    background: #fff;
    color: rgb(17, 157, 213);
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(255, 255, 255, 0.3);
}

/* Book Fishing Section Styles */
.book-fishing-section {
    position: relative;
}

.booking-content h2 {
    font-size: 2.2rem;
    font-weight: 700;
    margin-bottom: 15px;
}

.booking-features {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.feature-row {
    display: flex;
    gap: 20px;
}

.feature-item {
    display: flex;
    align-items: center;
    font-size: 1rem;
    color: #555;
}

.feature-item i {
    color: #f9680f;
    margin-right: 0px;
    font-size: 1.1rem;
}

.contact-info {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.contact-item {
    display: flex;
    align-items: center;
    font-size: 1rem;
    color: #555;
}

.contact-item i {
    color: rgb(17, 157, 213);
    margin-right: 10px;
    width: 20px;
    text-align: center;
}

.booking-form-container {
    background: #fff;
    border-radius: 16px;
    padding: 30px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
}

.form-title {
    font-size: 1.5rem;
    font-weight: 600;
    margin-bottom: 20px;
    color: #333;
    text-align: center;
}

.form-control,
.form-select {
    border-radius: 8px;
    border: 1px solid rgba(0, 0, 0, 0.1);
    padding: 12px 35px;
    font-size: 0.95rem;
}

.form-control:focus,
.form-select:focus {
    border-color: rgb(17, 157, 213);
    box-shadow: 0 0 0 3px rgba(17, 157, 213, 0.15);
}

.btn-submit-inquiry {
    width: 100%;
    background: rgb(17, 157, 213);
    color: white;
    border: none;
    border-radius: 8px;
    padding: 12px 20px;
    font-weight: 600;
    font-size: 1rem;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
}

.btn-submit-inquiry:hover {
    background: #0e8bc0;
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(17, 157, 213, 0.3);
}

@media (max-width: 992px) {
    .feature-row {
        flex-direction: column;
        gap: 10px;
    }

    .cta-title {
        font-size: 2rem;
    }

    .cta-text {
        font-size: 1.1rem;
    }
}

@media (max-width: 768px) {
    .testimonial-card {
        margin-bottom: 20px;
    }

    .btn-cta-primary,
    .btn-cta-secondary {
        width: 100%;
        justify-content: center;
        margin-bottom: 10px;
    }

    .booking-content h2 {
        font-size: 1.8rem;
    }

    .booking-form-container {
        padding: 20px;
    }
}

.fish-card {
    width: 100%;
    max-width: 100%;
    height: 80% !important;
    overflow: hidden;
    scrollbar-width: none;
    /* Firefox */
    -ms-overflow-style: none;
    /* Internet Explorer 10+ */
}

.fish-card::-webkit-scrollbar {
    display: none;
    /* Chrome, Safari and Opera */
}

.fish-card img {
    width: 100%;
    height: 50%;
    object-fit: cover;
    border-radius: 10px;
}

.card-text.text-truncate-multiline {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    /* max 3 lines */
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
}

.card-title.text-truncate {
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
}

.read-more {
    color: black;
    font-weight: 600;
}

#activity-description p {
    color: #555;
    font-size: 0.9rem;
    line-height: 1.6;
}

.charter-option-input:checked+.charter-option-label {
    border: 2px solid rgb(17, 157, 213);
    background-color: rgb(17 157 213 / 18%);
    box-shadow: 0 0 0 3px rgba(17, 157, 213, 0.2);
}

.badge {
    background-color: #f9680f;
    color: #ffffff;
    font-weight: 700;
    padding: 5px 45px;
    position: absolute;
    top: 35px;
    left: -35px;
    transform: rotate(-45deg);
}
</style>
@endpush

@section('content')
<!-- Hero Section -->
<section class="boat-charter-hero position-relative overflow-hidden">
    <!-- Modern high-quality game fishing image -->
    <div class="hero-bg position-absolute w-100 h-100">
        <img src="{{ asset('site/img/water-activity/game/game-fish-banner.jpg') }}"
            alt="Game Fishing in Andaman Islands" class="w-100 h-100 object-fit-cover">
        <!-- Improved overlay for better text visibility -->
        <div class="overlay-dark position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0,0,0,0.5);">
        </div>
    </div>

    <!-- Floating Elements for Visual Interest -->
    <div class="floating-elements d-none d-md-block">
        <div class="floating-bubble bubble-1"></div>
        <div class="floating-bubble bubble-2"></div>
        <div class="floating-bubble bubble-3"></div>
    </div>

    <div class="container position-relative py-5" style="z-index: 2;">
        <div class="row min-vh-75 align-items-center py-5">
            <div class="col-lg-8">
                <div class="hero-content">
                    <!-- Enhanced badges with better visibility -->
                    <div class="d-flex flex-wrap gap-2 mb-4">
                        <span class="hero-badge"><i class="fas fa-fish me-2"></i> World-Class Fishing</span>
                        <span class="hero-badge"><i class="fas fa-shield-alt me-2"></i> Expert Guides</span>
                        <span class="hero-badge"><i class="fas fa-star me-2"></i> 5-Star Rated</span>
                    </div>

                    <!-- Enhanced heading with better visibility and modern typography -->
                    <h1 class="hero-title mb-4">Ultimate <span>Game Fishing</span> Adventures in
                        Andaman</h1>

                    <p class="hero-subtitle mb-4 text-white">Experience the thrill of catching Sailfish, Tuna, Marlin,
                        and other prized game fish in the pristine waters of the Andaman Islands.</p>

                    <div class="d-flex flex-wrap gap-3">
                        <a href="#fishing-locations" class="btn-hero-primary">
                            <span>Explore Fishing Spots</span>
                            <i class="fas fa-map-marker-alt ms-2"></i>
                        </a>
                        <a href="#booking-form" class="btn-hero-secondary">
                            <i class="fas fa-calendar-check me-2"></i>
                            <span>Book Your Trip</span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 mt-5 mt-lg-0">
                <!-- Compact modern booking card -->
                <!-- Game Fishing Inquiry Form -->
                <div class="inquiry-card">
                    <div class="inquiry-card-header">
                        <h2 class="inquiry-title">Book Your Fishing Trip</h2>
                        <p class="inquiry-subtitle">Get a personalized fishing adventure</p>
                    </div>

                    <form id="booking-form" method="POST" action="{{ url('boat-activity/contact') }}"
                        class="inquiry-form">
                        @csrf

                        <div class="mb-3">
                            <div class="inquiry-input-wrapper">
                                <i class="fas fa-fish input-icon"></i>
                                <select name="fishingPackage" class="form-select inquiry-select" id="fishingPackage"
                                    required>
                                    <option value="" selected disabled>Select Fishing Package</option>
                                    @foreach($gamefishing as $game)
                                    <option value="{{$game->name}}">{{$game->name}}</option>
                                    @endforeach
                                </select>
                                <i class="fas fa-chevron-down select-arrow"></i>
                            </div>
                        </div>
                        <input type="text" name="website" id="website" style="display:none;" tabindex="-1"
                            autocomplete="off">

                        <div class="row g-3 mb-3">
                            <div class="col-6">
                                <div class="inquiry-input-wrapper">
                                    <i class="fas fa-calendar-alt input-icon"></i>
                                    <input name="fishingDate" type="text" onfocus="(this.type='date')"
                                        onblur="if(!this.value) this.type='text'" class="form-control inquiry-input"
                                        id="fishingDate" placeholder="Select Date" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="inquiry-input-wrapper">
                                    <i class="fas fa-users input-icon"></i>
                                    <select name="anglerCount" class="form-select inquiry-select" id="anglerCount"
                                        required>
                                        <option value="" selected disabled>Anglers</option>
                                        <option value="1-2">1-2 Anglers</option>
                                        <option value="3-4">3-4 Anglers</option>
                                        <option value="5-6">5-6 Anglers</option>
                                        <option value="7-8">7-8 Anglers</option>
                                        <option value="9-10">9-10 Anglers</option>
                                    </select>
                                    <i class="fas fa-chevron-down select-arrow"></i>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="inquiry-input-wrapper">
                                <i class="fas fa-map-marker-alt input-icon"></i>
                                <select name="fishingLocation" class="form-select inquiry-select" id="fishingLocation"
                                    required>
                                    <option value="" selected disabled>Preferred Fishing Location</option>
                                    <option value="rutland-cinque">Rutland & Cinque Island</option>
                                    <option value="sister-passage">Sister & Passage Island</option>
                                    <option value="north-passage">North Passage & Guitar Island</option>
                                    <option value="neil-havelock">Neil & Havelock Islands</option>
                                    <option value="south-sentinel">South Sentinel</option>
                                    <option value="any">Any Location (Guide's Choice)</option>
                                </select>
                                <i class="fas fa-chevron-down select-arrow"></i>
                            </div>
                        </div>
                        <div class="row g-3 mb-4">
                            <div class="col-12">
                                <div class="inquiry-input-wrapper">
                                    <i class="fas fa-phone-alt input-icon"></i>
                                    <input name="phoneNumber" type="tel" class="form-control inquiry-input"
                                        id="phoneNumber" placeholder="Phone" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="inquiry-input-wrapper">
                                    <i class="fas fa-envelope input-icon"></i>
                                    <input name="emailAddress" type="email" class="form-control inquiry-input"
                                        id="emailAddress" placeholder="Email" required>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn-inquiry-submit">
                            <span>Send Enquiry</span>
                            <i class="fas fa-fishing-rod ms-2"></i>
                        </button>

                        <div class="inquiry-features">
                            <div class="feature-badge">
                                <i class="fas fa-bolt"></i>
                                <span>Instant Confirmation</span>
                            </div>
                            <div class="feature-badge">
                                <i class="fas fa-lock"></i>
                                <span>Secure Booking</span>
                            </div>
                            <div class="feature-badge">
                                <i class="fas fa-calendar-alt"></i>
                                <span>Free Cancellation</span>
                            </div>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>

    <!-- Wave Separator -->
    <div class="wave-separator">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 120" preserveAspectRatio="none">
            <path fill="#ffffff" fill-opacity="1"
                d="M0,64L80,69.3C160,75,320,85,480,80C640,75,800,53,960,48C1120,43,1280,53,1360,58.7L1440,64L1440,120L1360,120C1280,120,1120,120,960,120C800,120,640,120,480,120C320,120,160,120,80,120L0,120Z">
            </path>
        </svg>
    </div>
</section>

<!-- Fishing Locations Section -->
<section id="fishing-locations" class="fishing-locations-section py-5">
    <div class="container">
        <div class="section-header text-center mb-5">
            <h2 class="fw-bold mb-3" style="color: rgb(17, 157, 213);">Premier Fishing <span
                    style="color: #f9680f;">Destinations</span></h2>
            <p class="lead">Choose from our top fishing spots in the Andaman Islands</p>
        </div>

        <div class="row g-4 justify-content-center">
            @foreach ($gamefishing as $fishing)
            <div class="col-lg-4 col-md-6">
                <div class="location-card h-100">
                    <div class="location-image">
                        <img src="{{ asset('storage/'.@$fishing->boatImages[0]->file_name)}}"
                            alt="Rutland & Cinque Island" class="img-fluid">
                        <div class="badge">
                            <span>{{ $fishing->package_type }}</span>
                        </div>
                        <div class="location-overlay">
                            <div class="location-tag">Most Popular</div>
                        </div>

                    </div>
                    <div class="location-content">
                        <h3 class="location-title">{{ucwords($fishing->name)}}</h3>
                        <div class="location-details">


                            <div class="charter-specs">
                                <div class="spec-item"><i class="fas fa-users"></i> 6 Passengers</div>
                                <div class="spec-item"><i class="fas fa-ruler"></i> 38 ft</div>
                                <div class="spec-item"><i class="fas fa-glass-cheers"></i> Luxury</div>
                            </div>
                        </div>
                        <p class="location-description" style="text-align: justify;">
                            {!! Str::words(strip_tags($fishing->description), 20, '...') !!}
                            <a href="#" role="button" type="button" data-id="{{ $fishing->id }}" data-bs-toggle="modal"
                                data-bs-target="#itineraryModal1" class="read-more show-itineraries">read more</a>
                        </p>
                        <div class="location-pricing">
                            <div class="price-option text-start">
                                <div class="price-label text-start fw-bolder ">{{ ucwords($fishing->duration)}}</div>
                            </div>
                            <div class="price-option text-end">
                                @php
                                $minPrice = $fishing->seasonalPrices->min('price');
                                $finalPrice = $minPrice ?? $fishing->base_price;
                                @endphp

                                <div class="price-amount text-end fs-3">
                                    ₹{{ number_format($finalPrice, 2) }} <span class="price-period">/trip</span>
                                </div>

                            </div>
                        </div>
                        <div class="row g-1">
                            <div class="col-6">
                                <button class="btn-book-now w-100" data-id="{{ $fishing->id }}"
                                    data-name="{{ $fishing->name }}" data-pax="{{ $fishing->pax }}"
                                    data-bs-toggle="modal" data-bs-target="#bookingModal">
                                    <i class="fas fa-calendar-check me-2"></i> Book Now
                                </button>

                            </div>
                            <div class="col-6">
                                <button class="btn-view-details show-itineraries w-100 m-0" data-id="{{ $fishing->id }}"
                                    data-bs-toggle="modal" data-bs-target="#itineraryModal1">
                                    <i class="fas fa-list-ul me-2"></i> View Itinerary
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<div class="modal fade" id="itineraryModal1" tabindex="-1" aria-labelledby="itineraryModal1Label" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header text-white">
                <h5 class="modal-title" id="itineraryModal1Label">Package - Detailed Itinerary</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="activity-description" class="mb-3"></div>

                <div id="itinerary-timeline" class="itinerary-timeline mb-4"></div>

                <div class="row">
                    <div class="col-md-6">
                        <h5>Inclusions:</h5>
                        <ul id="inclusions-list" class="list-unstyled"></ul>
                    </div>
                    <div class="col-md-6">
                        <h5>Exclusions:</h5>
                        <ul id="exclusions-list" class="list-unstyled"></ul>
                    </div>
                </div>

                <hr class="my-4">

                <div>
                    <h5>Fishes Found During Trip:</h5>
                    <div class="row" id="fishes-gallery"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal" data-bs-toggle="modal"
                    data-bs-target="#">
                    <i class="fas fa-calendar-check me-2"></i> Book This Package
                </button>

            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="background: rgb(17, 157, 213); color: white;">
                <h5 class="modal-title" id="bookingModalLabel">Book Your Fishing Trip</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="modal-booking-form" method="POST" action="{{ url('boat-activity/contact') }}">
                    @csrf

                    <div class="mb-3">
                        <input type="text" class="form-control @error('fishingPackage') is-invalid @enderror"
                            id="package-name-modal" name="fishingPackage" required readonly>
                        @error('fishingPackage')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="trip-date" class="form-label">Date</label>
                            <input type="date" class="form-control @error('fishingDate') is-invalid @enderror"
                                id="trip-date" name="fishingDate" required>
                            @error('fishingDate')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="anglers" class="form-label">Number of Guests</label>
                            <select class="form-select @error('anglerCount') is-invalid @enderror" id="anglers"
                                name="anglerCount" required>
                                <option value="" selected disabled>Select</option>

                            </select>
                            @error('anglerCount')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="customer-name" class="form-label">Your Name</label>
                            <input type="text" class="form-control @error('customer_name') is-invalid @enderror"
                                id="customer-name" name="customer_name" required>
                            @error('customer_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="customer-phone" class="form-label">Phone Number</label>
                            <input type="tel" class="form-control @error('phoneNumber') is-invalid @enderror"
                                id="customer-phone" name="phoneNumber" required>
                            @error('phoneNumber')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="customer-email" class="form-label">Email Address</label>
                        <input type="email" class="form-control @error('emailAddress') is-invalid @enderror"
                            id="customer-email" name="emailAddress" required>
                        @error('emailAddress')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="special-requests" class="form-label">Special Requests (Optional)</label>
                        <textarea class="form-control @error('special_requests') is-invalid @enderror"
                            id="special-requests" name="special_requests" rows="3"></textarea>
                        @error('special_requests')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="modal-footer p-0 pt-3">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary"
                            style="background: rgb(17, 157, 213); border-color: rgb(17, 157, 213);">
                            <i class="fas fa-check me-2"></i> Confirm Booking
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<!-- Itinerary Modal 1 -->

<!-- Boat Details Section -->
<section id="boat-details" class="boat-details-section py-5">
    <div class="container">
        <div class="section-header text-center mb-4">
            <div class="section-tag mb-2 d-inline-block py-1 px-3"
                style="background-color: rgba(17, 157, 213, 0.1); border-radius: 30px;">
                <span class="small fw-semibold" style="color: rgb(17, 157, 213);"><i class="fas fa-ship me-2"></i>OUR
                    FLEET</span>
            </div>
            <h2 class="fw-bold mb-3" style="color: rgb(17, 157, 213);">Our Fishing <span
                    style="color: #f9680f;">Fleet</span></h2>
            <p class="lead">Explore our premium boats equipped for the ultimate game fishing experience</p>
        </div>

        <div class="row g-4 align-items-center">
            <!-- Boat 1 -->
            <div class="col-lg-6">
                <div class="boat-image-slider">
                    <div id="boatCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#boatCarousel" data-bs-slide-to="0" class="active"
                                aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#boatCarousel" data-bs-slide-to="1"
                                aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#boatCarousel" data-bs-slide-to="2"
                                aria-label="Slide 3"></button>
                            <button type="button" data-bs-target="#boatCarousel" data-bs-slide-to="3"
                                aria-label="Slide 4"></button>
                        </div>
                        <div class="carousel-inner rounded-4 shadow-sm">
                            <div class="carousel-item active">
                                <img src="{{asset('site/img/water-activity/boat-charter/fleet_1.JPG')}}"
                                    class="d-block w-100" load="lazy" alt="Fishing Boat Exterior">
                            </div>
                            <div class="carousel-item">
                                <img src="{{asset('site/img/water-activity/boat-charter/GOPR0200.JPG')}}"
                                    class="d-block w-100" load="lazy" alt="Fishing Boat Interior">
                            </div>
                            <div class="carousel-item">
                                <img src="{{asset('site/img/water-activity/boat-charter/GOPR0191.JPG')}}"
                                    class="d-block w-100" load="lazy" alt="Fishing Equipment">
                            </div>
                            <div class="carousel-item">
                                <img src="/site/img/gamefish-gallary-6.jpeg"
                                    class="d-block w-100" alt="Fishing Equipment">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#boatCarousel"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#boatCarousel"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="boat-details-content p-4 rounded-4 h-100"
                    style="background-color: white; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);">
                    <div class="d-flex align-items-center mb-3">
                        <div class="boat-name-badge me-3 py-1 px-3 rounded-pill"
                            style="background-color: rgb(17, 157, 213); color: white; font-size: 0.8rem; font-weight: 600;">
                            <i class="fas fa-award me-1"></i> Premium Fleet
                        </div>
                        <h3 class="boat-name h4 fw-bold mb-0">Andaman Angler 38'</h3>
                    </div>

                    <p class="boat-description mb-3">
                        Our flagship fishing vessel designed specifically for game fishing in Andaman waters. Equipped
                        with state-of-the-art navigation systems, fish finders, and premium fishing gear.
                    </p>

                    <div class="boat-specs-container mb-3">
                        <div class="row g-2">
                            <div class="col-6 col-md-3">
                                <div class="spec-card p-2 text-center rounded-3"
                                    style="background-color: rgba(17, 157, 213, 0.05);">
                                    <i class="fas fa-ruler-horizontal mb-1" style="color: rgb(17, 157, 213);"></i>
                                    <p class="spec-value mb-0 fw-bold">38 feet</p>
                                    <p class="spec-label small text-muted mb-0">Length</p>
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="spec-card p-2 text-center rounded-3"
                                    style="background-color: rgba(17, 157, 213, 0.05);">
                                    <i class="fas fa-users mb-1" style="color: rgb(17, 157, 213);"></i>
                                    <p class="spec-value mb-0 fw-bold">10+ anglers</p>
                                    <p class="spec-label small text-muted mb-0">Capacity</p>
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="spec-card p-2 text-center rounded-3"
                                    style="background-color: rgba(17, 157, 213, 0.05);">
                                    <i class="fas fa-tachometer-alt mb-1" style="color: rgb(17, 157, 213);"></i>
                                    <p class="spec-value mb-0 fw-bold">25 knots</p>
                                    <p class="spec-label small text-muted mb-0">Speed</p>
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="spec-card p-2 text-center rounded-3"
                                    style="background-color: rgba(17, 157, 213, 0.05);">
                                    <i class="fas fa-gas-pump mb-1" style="color: rgb(17, 157, 213);"></i>
                                    <p class="spec-value mb-0 fw-bold">200 nm</p>
                                    <p class="spec-label small text-muted mb-0">Range</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="boat-features mb-4">
                        <h4 class="h6 mb-3 fw-bold" style="color: rgb(17, 157, 213);">Key Features</h4>
                        <div class="row g-2">
                            <div class="col-md-6">
                                <div class="feature-item d-flex align-items-center p-2 rounded-3 mb-2"
                                    style="background-color: rgba(17, 157, 213, 0.03); transition: all 0.3s ease;">
                                    <div class="feature-icon me-2 d-flex align-items-center justify-content-center rounded-circle"
                                        style="width: 28px; height: 28px; background-color: rgba(249, 104, 15, 0.1);">
                                        <i class="fas fa-chair" style="color: #f9680f; font-size: 12px;"></i>
                                    </div>
                                    <span class="small">Professional fighting chairs</span>
                                </div>
                                <div class="feature-item d-flex align-items-center p-2 rounded-3 mb-2"
                                    style="background-color: rgba(17, 157, 213, 0.03); transition: all 0.3s ease;">
                                    <div class="feature-icon me-2 d-flex align-items-center justify-content-center rounded-circle"
                                        style="width: 28px; height: 28px; background-color: rgba(249, 104, 15, 0.1);">
                                        <i class="fas fa-fish" style="color: #f9680f; font-size: 12px;"></i>
                                    </div>
                                    <span class="small">Premium fishing equipment</span>
                                </div>
                                <div class="feature-item d-flex align-items-center p-2 rounded-3 mb-2"
                                    style="background-color: rgba(17, 157, 213, 0.03); transition: all 0.3s ease;">
                                    <div class="feature-icon me-2 d-flex align-items-center justify-content-center rounded-circle"
                                        style="width: 28px; height: 28px; background-color: rgba(249, 104, 15, 0.1);">
                                        <i class="fas fa-search" style="color: #f9680f; font-size: 12px;"></i>
                                    </div>
                                    <span class="small">Advanced fish finders</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="feature-item d-flex align-items-center p-2 rounded-3 mb-2"
                                    style="background-color: rgba(17, 157, 213, 0.03); transition: all 0.3s ease;">
                                    <div class="feature-icon me-2 d-flex align-items-center justify-content-center rounded-circle"
                                        style="width: 28px; height: 28px; background-color: rgba(249, 104, 15, 0.1);">
                                        <i class="fas fa-umbrella-beach" style="color: #f9680f; font-size: 12px;"></i>
                                    </div>
                                    <span class="small">Shaded seating area</span>
                                </div>
                                <div class="feature-item d-flex align-items-center p-2 rounded-3 mb-2"
                                    style="background-color: rgba(17, 157, 213, 0.03); transition: all 0.3s ease;">
                                    <div class="feature-icon me-2 d-flex align-items-center justify-content-center rounded-circle"
                                        style="width: 28px; height: 28px; background-color: rgba(249, 104, 15, 0.1);">
                                        <i class="fas fa-cocktail" style="color: #f9680f; font-size: 12px;"></i>
                                    </div>
                                    <span class="small">Onboard refreshments</span>
                                </div>
                                <div class="feature-item d-flex align-items-center p-2 rounded-3 mb-2"
                                    style="background-color: rgba(17, 157, 213, 0.03); transition: all 0.3s ease;">
                                    <div class="feature-icon me-2 d-flex align-items-center justify-content-center rounded-circle"
                                        style="width: 28px; height: 28px; background-color: rgba(249, 104, 15, 0.1);">
                                        <i class="fas fa-life-ring" style="color: #f9680f; font-size: 12px;"></i>
                                    </div>
                                    <span class="small">Safety equipment</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center">
                        <div class="price-info">
                            <span class="price-label text-muted">Starting from</span>
                            <div class="price-amount h4 mb-0 fw-bold" style="color: rgb(17, 157, 213);">₹15,000 <span
                                    class="price-period small fw-normal">/half day</span></div>
                        </div>
                        <a href="#fishing-locations" class="btn-view-packages px-4 py-2 rounded-pill"
                            style="background: rgb(17, 157, 213); color: white; text-decoration: none; font-weight: 600; box-shadow: 0 4px 10px rgba(17, 157, 213, 0.3); transition: all 0.3s ease;">
                            <i class="fas fa-tag me-2"></i> View Packages
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Booking Modal -->
<!-- Gallery Section -->
<section id="gallery" class="gallery-section py-5">
    <div class="container">
        <div class="section-header text-center mb-5">
            <h2 class="fw-bold mb-3" style="color: rgb(17, 157, 213);">Fishing <span
                    style="color: #f9680f;">Gallery</span></h2>
            <p class="lead">Explore our fishing adventures through stunning images</p>
        </div>

        <div class="gallery-filter mb-4">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="filter-buttons d-flex flex-wrap justify-content-center gap-2">
                        <button class="filter-btn active" data-filter="all">All Photos</button>
                        <button class="filter-btn" data-filter="catches">Trophy Catches</button>
                        <button class="filter-btn" data-filter="boats">Our Boats</button>
                        <button class="filter-btn" data-filter="locations">Fishing Spots</button>
                        <button class="filter-btn" data-filter="anglers">Happy Anglers</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4 gallery-container">
            <!-- Gallery Item 1 -->
            <div class="col-lg-4 col-md-6 gallery-item" data-category="catches">
                <div class="gallery-card">
                    <img src="/site/img/gamefish-gallary-1.avif"
                        alt="Trophy Sailfish" class="img-fluid">
                    <div class="gallery-overlay">
                        <div class="gallery-info">
                            <h4>Trophy Sailfish</h4>
                            <p>Caught near Rutland Island</p>
                        </div>
                        <div class="gallery-actions">
                            <a href="/site/img/gamefish-gallary-1.avif"
                                class="gallery-zoom" data-caption="Trophy Sailfish caught near Rutland Island">
                                <i class="fas fa-search-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Gallery Item 2 -->
            <div class="col-lg-4 col-md-6 gallery-item" data-category="boats">
                <div class="gallery-card">
                    <img src="{{asset('site/img/water-activity/boat-charter/fleet_1.JPG')}}" alt="Fishing Boat1"
                        class="img-fluid">
                    <div class="gallery-overlay">
                        <div class="gallery-info">
                            <h4>Andaman Big Sport</h4>
                            <p>Our premium fishing vessel</p>
                        </div>
                        <div class="gallery-actions">
                            <a href="{{asset('site/img/water-activity/boat-charter/fleet_1.JPG')}}" class="gallery-zoom"
                                data-caption="Andaman Big Sport - Our premium fishing vessel">
                                <i class="fas fa-search-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 gallery-item" data-category="boats">
                <div class="gallery-card">
                    <img src="/site/img/gamefish-gallary-2.avif" alt="Fishing Boat2"
                        class="img-fluid">
                    <div class="gallery-overlay">
                        <div class="gallery-info">
                            <h4>MFV Caiman fishing boat</h4>
                            <p>Our premium fishing vessel</p>
                        </div>
                        <div class="gallery-actions">
                            <a href="/site/img/gamefish-gallary-2.avif" class="gallery-zoom"
                                data-caption="Andaman Big Sport - Our premium fishing vessel">
                                <i class="fas fa-search-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Gallery Item 3 -->
            <div class="col-lg-4 col-md-6 gallery-item" data-category="locations">
                <div class="gallery-card">
                    <img src="/site/img/cinque-island.webp"
                        alt="Fishing Location" class="img-fluid">
                    <div class="gallery-overlay">
                        <div class="gallery-info">
                            <h4>Cinque Island</h4>
                            <p>Prime fishing grounds</p>
                        </div>
                        <div class="gallery-actions">
                            <a href="/site/img/cinque-island.webp"
                                class="gallery-zoom"
                                data-caption="Cinque Island - Prime fishing grounds in the Andaman Islands">
                                <i class="fas fa-search-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 gallery-item" data-category="locations">
                <div class="gallery-card">
                    <img src="/site/img/rutland-game-fishing.webp"
                        alt="Fishing Location" class="img-fluid">
                    <div class="gallery-overlay">
                        <div class="gallery-info">
                            <h4>Rutland</h4>
                            <p>Prime fishing grounds</p>
                        </div>
                        <div class="gallery-actions">
                            <a href="/site/img/rutland-game-fishing.webp"
                                class="gallery-zoom"
                                data-caption="Rutland - A place to catch all the rare fish species">
                                <i class="fas fa-search-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>  

            <div class="col-lg-4 col-md-6 gallery-item" data-category="locations">
                <div class="gallery-card">
                    <img src="/site/img/neil-island-game-fishing.jpeg"
                        alt="Fishing Location" class="img-fluid">
                    <div class="gallery-overlay">
                        <div class="gallery-info">
                            <h4>Neil Island</h4>
                            <p>Prime fishing grounds</p>
                        </div>
                        <div class="gallery-actions">
                            <a href="/site/img/neil-island-game-fishing.jpeg"
                                class="gallery-zoom"
                                data-caption="Neil Island - A pristine place in Andaman to participate in game fishing">
                                <i class="fas fa-search-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>  

            <!-- Gallery Item 4 -->
            <div class="col-lg-4 col-md-6 gallery-item" data-category="anglers">
                <div class="gallery-card">
                    <img src="/site/img/gamefish-gallary-4.avif"
                        alt="Happy Angler" class="img-fluid">
                    <div class="gallery-overlay">
                        <div class="gallery-info">
                            <h4>Successful Catch</h4>
                            <p>Happy angler with a Yellowfin Tuna</p>
                        </div>
                        <div class="gallery-actions">
                            <a href="/site/img/gamefish-gallary-4.avif" class="gallery-zoom"
                                data-caption="Happy angler with a Yellowfin Tuna caught during a full-day expedition">
                                <i class="fas fa-search-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-lg-4 col-md-6 gallery-item" data-category="anglers">
                <div class="gallery-card">
                    <img src="{{asset('site/img/water-activity/boat-charter/GOPR0126.JPG')}}" alt="Happy Angler"
                        class="img-fluid">
                    <div class="gallery-overlay">
                        <div class="gallery-info">
                            <h4>Successful Catch</h4>
                            <p>Happy angler with a Yellowfin Tuna</p>
                        </div>
                        <div class="gallery-actions">
                            <a href="{{asset('site/img/water-activity/boat-charter/GOPR0126.JPG')}}"
                                class="gallery-zoom"
                                data-caption="Happy angler with a Yellowfin Tuna caught during a full-day expedition">
                                <i class="fas fa-search-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-lg-4 col-md-6 gallery-item" data-category="anglers">
                <div class="gallery-card">
                    <img src="{{asset('site/img/water-activity/boat-charter/GOPR0191.JPG')}}" alt="Happy Angler"
                        class="img-fluid">
                    <div class="gallery-overlay">
                        <div class="gallery-info">
                            <h4>Successful Catch</h4>
                            <p>Happy angler with a Yellowfin Tuna</p>
                        </div>
                        <div class="gallery-actions">
                            <a href="{{asset('site/img/water-activity/boat-charter/GOPR0191.JPG')}}"
                                class="gallery-zoom"
                                data-caption="Happy angler with a Yellowfin Tuna caught during a full-day expedition">
                                <i class="fas fa-search-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Gallery Item 5 -->
            <div class="col-lg-4 col-md-6 gallery-item" data-category="catches">
                <div class="gallery-card">
                    <img src="{{asset('site/img/water-activity/boat-charter/GOPR0200.JPG')}}" alt="big-sport"
                        class="img-fluid">
                    <div class="gallery-overlay">
                        <div class="gallery-info">
                            <h4>Andaman Big Sport</h4>
                            <p>Caught during a deep sea expedition</p>
                        </div>
                        <div class="gallery-actions">
                            <a href="{{asset('site/img/water-activity/boat-charter/GOPR0200.JPG')}}"
                                class="gallery-zoom"
                                data-caption="Blue Marlin caught during a deep sea expedition near South Sentinel">
                                <i class="fas fa-search-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Gallery Item 6 -->
            <div class="col-lg-4 col-md-6 gallery-item" data-category="locations">
                <div class="gallery-card">
                    <img src="/site/img/gamefish-gallary-5.avif"
                        alt="Barren Island" class="img-fluid">
                    <div class="gallery-overlay">
                        <div class="gallery-info">
                            <h4>Barren Island</h4>
                            <p>Fishing in the shadow of an active volcano</p>
                        </div>
                        <div class="gallery-actions">
                            <a href="/site/img/gamefish-gallary-4.avif"
                                class="gallery-zoom"
                                data-caption="Barren Island - Fishing in the shadow of an active volcano">
                                <i class="fas fa-search-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Gallery Item 7-->
            <div class="col-lg-4 col-md-6 gallery-item" data-category="anglers">
                <div class="gallery-card">
                    <img src="/site/img/gamefish-gallary-6.jpeg"
                        alt="Happy Angler" class="img-fluid">
                    <div class="gallery-overlay">
                        <div class="gallery-info">
                            <h4>Successful Catch</h4>
                            <p>Happy angler with a Yellowfin Tuna</p>
                        </div>
                        <div class="gallery-actions">
                            <a href="/site/img/gamefish-gallary-6.jpeg" class="gallery-zoom"
                                data-caption="Happy angler with a Yellowfin Tuna caught during a full-day expedition">
                                <i class="fas fa-search-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-lg-4 col-md-6 gallery-item" data-category="anglers">
                <div class="gallery-card">
                    <img src="/site/img/gamefish-gallary-7.jpeg"
                        alt="Happy Angler" class="img-fluid">
                    <div class="gallery-overlay">
                        <div class="gallery-info">
                            <h4>Successful Catch</h4>
                            <p>Happy angler with a Yellowfin Tuna</p>
                        </div>
                        <div class="gallery-actions">
                            <a href="/site/img/gamefish-gallary-7.jpeg" class="gallery-zoom"
                                data-caption="Happy angler with a Yellowfin Tuna caught during a full-day expedition">
                                <i class="fas fa-search-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-lg-4 col-md-6 gallery-item" data-category="anglers">
                <div class="gallery-card">
                    <img src="/site/img/gamefish-gallary-8.jpg"
                        alt="Happy Angler" class="img-fluid">
                    <div class="gallery-overlay">
                        <div class="gallery-info">
                            <h4>Successful Catch</h4>
                            <p>Happy angler with a Yellowfin Tuna</p>
                        </div>
                        <div class="gallery-actions">
                            <a href="/site/img/gamefish-gallary-8.jpg" class="gallery-zoom"
                                data-caption="Happy angler with a Yellowfin Tuna caught during a full-day expedition">
                                <i class="fas fa-search-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mt-4">
            <a href="#" class="btn-view-more">
                <i class="fas fa-images me-2"></i> View More Photos
            </a>
        </div>
    </div>
</section>

<!-- Lightbox -->
<div class="lightbox" id="gallery-lightbox">
    <div class="lightbox-content">
        <img src="" alt="" class="lightbox-image">
    </div>
    <div class="lightbox-caption"></div>
    <div class="lightbox-close">
        <i class="fas fa-times"></i>
    </div>
    <div class="lightbox-nav lightbox-prev">
        <i class="fas fa-chevron-left"></i>
    </div>
    <div class="lightbox-nav lightbox-next">
        <i class="fas fa-chevron-right"></i>
    </div>
</div>

<!-- Testimonials Section -->
<section class="testimonials-section py-5 position-relative">
    <div class="testimonial-bg-shape position-absolute top-0 end-0 d-none d-lg-block"
        style="width: 35%; height: 100%; background-color: rgba(17, 157, 213, 0.05); border-radius: 0 0 0 100px; z-index: 0;">
    </div>

    <div class="container position-relative" style="z-index: 1;">
        <div class="row align-items-center mb-5">
            <div class="col-lg-6">
                <div class="section-header-left">
                    <div class="section-tag mb-3 d-inline-block py-1 px-3"
                        style="background-color: rgba(17, 157, 213, 0.1); border-radius: 30px;">
                        <span class="small fw-semibold" style="color: rgb(17, 157, 213);"><i
                                class="fas fa-comment-dots me-2"></i>TESTIMONIALS</span>
                    </div>
                    <h2 class="fw-bold mb-3" style="color: rgb(17, 157, 213);">Customer <span
                            style="color: #f9680f;">Reviews</span></h2>
                    <p class="lead">See what our customers have to say about their private boat charter experiences.</p>
                </div>
            </div>
            <div class="col-lg-6 text-lg-end mt-4 mt-lg-0">
                <div class="testimonial-stats d-inline-flex align-items-center gap-4 p-3"
                    style="background-color: white; border-radius: 15px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);">
                    <div class="stat-item text-center">
                        <div class="d-flex align-items-center justify-content-center mb-2">
                            <span class="display-6 fw-bold me-1" style="color: rgb(17, 157, 213);">4.9</span>
                            <i class="fas fa-star ms-1" style="color: #f9680f;"></i>
                        </div>
                        <p class="small text-muted mb-0">Average Rating</p>
                    </div>
                    <div class="stat-divider" style="width: 1px; height: 40px; background-color: #e0e0e0;"></div>
                    <div class="stat-item text-center">
                        <div class="fw-bold display-6 mb-2" style="color: rgb(17, 157, 213);">200+</div>
                        <p class="small text-muted mb-0">Happy Customers</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="testimonial-slider position-relative owl-carousel owl-theme">

            <!-- Slide 1 -->
            @foreach($testimonials as $testimonial)
            <div class="item">
                <div class="testimonial-card h-100 p-4 rounded-4 position-relative overflow-hidden"
                    style="background-color: white; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05); border: 1px solid rgba(17, 157, 213, 0.1); transition: all 0.3s ease;">
                    <div class="testimonial-pattern position-absolute"
                        style="top: 0; right: 0; width: 80px; height: 80px; opacity: 0.05; z-index: 0;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 24 24"
                            fill="rgb(17, 157, 213)">
                            <path
                                d="M11.3,6.2H8.7c-0.2,0-0.3-0.1-0.3-0.3V3.3c0-0.2,0.1-0.3,0.3-0.3h2.6c0.2,0,0.3,0.1,0.3,0.3v2.6C11.6,6.1,11.5,6.2,11.3,6.2z M16.4,6.2h-2.6c-0.2,0-0.3-0.1-0.3-0.3V3.3c0-0.2,0.1-0.3,0.3-0.3h2.6c0.2,0,0.3,0.1,0.3,0.3v2.6C16.7,6.1,16.6,6.2,16.4,6.2z M11.3,11.3H8.7c-0.2,0-0.3-0.1-0.3-0.3V8.4c0-0.2,0.1-0.3,0.3-0.3h2.6c0.2,0,0.3,0.1,0.3,0.3v2.6C11.6,11.2,11.5,11.3,11.3,11.3z M16.4,11.3h-2.6c-0.2,0-0.3-0.1-0.3-0.3V8.4c0-0.2,0.1-0.3,0.3-0.3h2.6c0.2,0,0.3,0.1,0.3,0.3v2.6C16.7,11.2,16.6,11.3,16.4,11.3z">
                            </path>
                        </svg>
                    </div>
                    <div class="testimonial-content position-relative" style="z-index: 1;">
                        <div class="testimonial-rating mb-3 d-flex align-items-center">
                            <div class="stars me-2">
                                <i class="fas fa-star" style="color: #f9680f;"></i>
                                <i class="fas fa-star" style="color: #f9680f;"></i>
                                <i class="fas fa-star" style="color: #f9680f;"></i>
                                <i class="fas fa-star" style="color: #f9680f;"></i>
                                <i class="fas fa-star" style="color: #f9680f;"></i>
                            </div>
                            <span class="small fw-semibold" style="color: #333;">5.0</span>
                        </div>
                        <div class="testimonial-quote mb-3" style="color: rgb(17, 157, 213);">
                            <i class="fas fa-quote-left fa-2x opacity-25"></i>
                        </div>
                        <p class="testimonial-text mb-4" style="font-size: 1rem; line-height: 1.6;">
                            "{{$testimonial['text']}}"</p>

                        <!-- <div class="testimonial-author d-flex align-items-center">
                            <div class="author-avatar me-3 position-relative">
                                <img src="{{$testimonial['avatar']}}" alt="Rahul Sharma" class="rounded-circle"
                                    width="60" height="60" style="border: 3px solid rgba(17, 157, 213, 0.2);">
                                <div class="verification-badge position-absolute"
                                    style="bottom: 0; right: 0; background-color: #f9680f; color: white; width: 20px; height: 20px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 10px; border: 2px solid white;">
                                    <i class="fas fa-check"></i>
                                </div>
                            </div>
                            <div>
                                <h4 class="h6 fw-bold mb-0">{{ ucwords($testimonial['name']) }}</h4>
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-map-marker-alt me-1 small" style="color: #f9680f;"></i>
                                    <p class="small mb-0">{{ ucwords($testimonial['location']) }}</p>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
            @endforeach
            <!-- Add other testimonial items in same structure inside <div class="item">...</div> -->

        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="faq-section py-5 position-relative">
    <!-- Background Elements -->
    <div class="faq-bg-shape position-absolute bottom-0 start-0 d-none d-lg-block"
        style="width: 25%; height: 70%; background-color: rgba(17, 157, 213, 0.03); border-radius: 0 100px 0 0; z-index: 0;">
    </div>
    <div class="faq-bg-dots position-absolute top-0 end-0 d-none d-lg-block"
        style="width: 180px; height: 180px; z-index: 0; opacity: 0.4;">
        <svg width="100%" height="100%" viewBox="0 0 100 100">
            <pattern id="pattern-circles" x="0" y="0" width="14" height="14" patternUnits="userSpaceOnUse"
                patternContentUnits="userSpaceOnUse">
                <circle id="pattern-circle" cx="7" cy="7" r="2" fill="#f9680f"></circle>
            </pattern>
            <rect x="0" y="0" width="100%" height="100%" fill="url(#pattern-circles)"></rect>
        </svg>
    </div>

    <div class="container position-relative" style="z-index: 1;">
        <div class="row align-items-center mb-5">
            <div class="col-lg-6">
                <div class="section-header-left">
                    <div class="section-tag mb-3 d-inline-block py-1 px-3"
                        style="background-color: rgba(17, 157, 213, 0.1); border-radius: 30px;">
                        <span class="small fw-semibold" style="color: rgb(17, 157, 213);"><i
                                class="fas fa-question-circle me-2"></i>SUPPORT</span>
                    </div>
                    <h2 class="fw-bold mb-3" style="color: rgb(17, 157, 213);">Frequently Asked <span
                            style="color: #f9680f;">Questions</span></h2>
                    <p class="lead">Find answers to common questions about our private boat charter services.</p>
                </div>
            </div>
            <div class="col-lg-6 text-lg-end mt-4 mt-lg-0">
                <div class="faq-contact-card d-inline-flex align-items-center p-3"
                    style="background-color: white; border-radius: 15px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);">
                    <div class="faq-contact-icon me-3 p-3 rounded-circle"
                        style="background-color: rgba(17, 157, 213, 0.1);">
                        <i class="fas fa-headset fa-2x" style="color: rgb(17, 157, 213);"></i>
                    </div>
                    <div class="faq-contact-info text-start">
                        <p class="small mb-0" style="color: #f9680f; font-weight: 600;">Still have questions?</p>
                        <h4 class="mb-0">Call us at <a href="tel:+918900909900"
                                style="color: rgb(17, 157, 213); text-decoration: none;">+91 8900909900</a></h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="faq-accordion-container p-4"
                    style="background-color: white; border-radius: 20px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);">
                    <div class="accordion" id="faqAccordion">
                        <!-- FAQ Item 1 -->
                        <div class="accordion-item border-0 mb-3">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed p-3" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq1"
                                    style="background-color: rgba(17, 157, 213, 0.03); border-radius: 10px; font-weight: 600; color: #333;">
                                    <i class="fas fa-question-circle me-2" style="color: rgb(17, 157, 213);"></i>
                                    What is game fishing and why is it popular in Andaman island?</button>
                            </h3>
                            <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body p-3">
                                    <div class="faq-answer p-3"
                                        style="background-color: rgba(17, 157, 213, 0.02); border-radius: 10px; border-left: 3px solid rgb(17, 157, 213);">
                                        <p class="mb-0">Game fishing is a thrilling and adventurous sport where you can catch large, powerful fish in deep water. The Andaman islands are a paradise for it and all thanks to the untouched marine ecosystem, rich biodiversity and the vast expansion of open oceans. It is not just fishing, you will get thrilling adventures with a mix of nature and raw beauty.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- FAQ Item 2 -->
                        <div class="accordion-item border-0 mb-3">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed p-3" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq2"
                                    style="background-color: rgba(17, 157, 213, 0.03); border-radius: 10px; font-weight: 600; color: #333;">
                                    <i class="fas fa-question-circle me-2" style="color: rgb(17, 157, 213);"></i>
                                    Is game fishing safe on Andaman island?
                                </button>
                            </h3>
                            <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body p-3">
                                    <div class="faq-answer p-3"
                                        style="background-color: rgba(17, 157, 213, 0.02); border-radius: 10px; border-left: 3px solid rgb(17, 157, 213);">
                                        <p class="mb-0">Yes, game fishing in the Andaman island is absolutely safe as long as you go with licensed and reputable operators. These operators are well experienced and follow strict safety standards and are equipped with everything needed for a secure trip that includes life jackets, first aid kits, GPS system, radio and satellite phone. They will brief you through all the safety protocols before the trip so you can relax and focus on enjoying the experience.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- FAQ Item 3 -->
                        <div class="accordion-item border-0 mb-3">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed p-3" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq3"
                                    style="background-color: rgba(17, 157, 213, 0.03); border-radius: 10px; font-weight: 600; color: #333;">
                                    <i class="fas fa-question-circle me-2" style="color: rgb(17, 157, 213);"></i>
                                    What is the best time for game fishing in the Andaman island?
                                </button>
                            </h3>
                            <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body p-3">
                                    <div class="faq-answer p-3"
                                        style="background-color: rgba(17, 157, 213, 0.02); border-radius: 10px; border-left: 3px solid rgb(17, 157, 213);">
                                        <p class="mb-0">The ideal season for game fishing in the Andaman island is from October to April. During these months, the sea is calm, the skies are clear and the weather is perfect, not too hot, not too humid. Most importantly, in this month the fish activity reaches its peak and gives you the best chance to catch some of the oceans most powerful and elusive creatures.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- FAQ Item 4 -->
                        <div class="accordion-item border-0 mb-3">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed p-3" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq4"
                                    style="background-color: rgba(17, 157, 213, 0.03); border-radius: 10px; font-weight: 600; color: #333;">
                                    <i class="fas fa-question-circle me-2" style="color: rgb(17, 157, 213);"></i>
                                    How long does a typical game fishing trip last?
                                </button>
                            </h3>
                            <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body p-3">
                                    <div class="faq-answer p-3"
                                        style="background-color: rgba(17, 157, 213, 0.02); border-radius: 10px; border-left: 3px solid rgb(17, 157, 213);">
                                        <p class="mb-0">Game fishing in the Andaman island usually comes in three exciting options. You can go for a half day trip that lasts for around 4-6 hours, this duration is perfect for beginners. If you are looking to go deeper and want to catch a big fish, you can take a full day trip around 8-10 hours that gives you enough time to explore rich fishing and can enjoy a full experience out on the open sea.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- FAQ Item 5 -->
                        <div class="accordion-item border-0">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed p-3" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq5"
                                    style="background-color: rgba(17, 157, 213, 0.03); border-radius: 10px; font-weight: 600; color: #333;">
                                    <i class="fas fa-question-circle me-2" style="color: rgb(17, 157, 213);"></i>
                                    Why should I try game fishing at least once while on Andaman island?
                                </button>
                            </h3>
                            <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body p-3">
                                    <div class="faq-answer p-3"
                                        style="background-color: rgba(17, 157, 213, 0.02); border-radius: 10px; border-left: 3px solid rgb(17, 157, 213);">
                                        <p class="mb-0">Because game fishing is more than just a sport, it's pure magic and raw emotions rolled into one unforgettable experience. Imagine you are on a boat, surrounded by the vast and clear blue water of the Andaman sea. Whether you catch a Giant Trevally or a speed barracuda, you will get the most thrilling experience. And honestly, game fishing is worth to try. It is a memory you will cherish forever. so, if you are visiting Andaman island I will surely recommend you to give game fishing a try!</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-lg-6">
                <div class="faq-accordion-container p-4"
                    style="background-color: white; border-radius: 20px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);">
                    <div class="accordion" id="faqAccordion">
                        <!-- FAQ Item 6 -->
                        <div class="accordion-item border-0 mb-3">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed p-3" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq6"
                                    style="background-color: rgba(17, 157, 213, 0.03); border-radius: 10px; font-weight: 600; color: #333;">
                                    <i class="fas fa-question-circle me-2" style="color: rgb(17, 157, 213);"></i>
                                    What is game fishing and where can I experience it in Andaman Islands?</button>
                            </h3>
                            <div id="faq6" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body p-3">
                                    <div class="faq-answer p-3"
                                        style="background-color: rgba(17, 157, 213, 0.02); border-radius: 10px; border-left: 3px solid rgb(17, 157, 213);">
                                        <p class="mb-0">Game fishing In Andaman Islands is a exciting and thrilling offshore adventure where participants catch large fish species like tuna, barracuda, giant trevally (GT), marlin, and mahi-mahi. Few top locations in Andaman Islands for game fishing include Havelock Island, Neil Island, Long Island and Port Blair. These unexplored waters are a paradise and a gem for both amateur anglers and professionals because of rich marine biodiversity and minimal commercial fishing activity.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- FAQ Item 7 -->
                        <div class="accordion-item border-0 mb-3">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed p-3" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq7"
                                    style="background-color: rgba(17, 157, 213, 0.03); border-radius: 10px; font-weight: 600; color: #333;">
                                    <i class="fas fa-question-circle me-2" style="color: rgb(17, 157, 213);"></i>
                                    Do I need to have any prior experience or a fishing experience?</button>
                            </h3>
                            <div id="faq7" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body p-3">
                                    <div class="faq-answer p-3"
                                        style="background-color: rgba(17, 157, 213, 0.02); border-radius: 10px; border-left: 3px solid rgb(17, 157, 213);">
                                        <p class="mb-0">Nope not at all you do not have to have any kind of experience, Game fishing trips in Andaman are really beginner-friendly and no you do not have to have any special license. A certified captain and crew will guide you throughout the trip, offering equipment, training, and safety briefings. Whether you are new to fishing or a passionate angler, you will enjoy a well-guided and secure experience with all essentials provided.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- FAQ Item 3 -->
                        <div class="accordion-item border-0 mb-3">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed p-3" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq8"
                                    style="background-color: rgba(17, 157, 213, 0.03); border-radius: 10px; font-weight: 600; color: #333;">
                                    <i class="fas fa-question-circle me-2" style="color: rgb(17, 157, 213);"></i>
                                    How much does game fishing cost in the Andaman island?
                                </button>
                            </h3>
                            <div id="faq8" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body p-3">
                                    <div class="faq-answer p-3"
                                        style="background-color: rgba(17, 157, 213, 0.02); border-radius: 10px; border-left: 3px solid rgb(17, 157, 213);">
                                        <p class="mb-0">The cost of the game fishing in Andaman island totally depends on the duration and what kind of boat or experience you choose. On average, the cost of game fishing starts from INR 15,000 to INR 30,000 or even more. A half day trip may cost you less, while a full day or luxury charter with high end gear and experienced crew may cost more.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- FAQ Item 4 -->
                        <div class="accordion-item border-0 mb-3">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed p-3" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq9"
                                    style="background-color: rgba(17, 157, 213, 0.03); border-radius: 10px; font-weight: 600; color: #333;">
                                    <i class="fas fa-question-circle me-2" style="color: rgb(17, 157, 213);"></i>
                                    Do I need any permit or license for game fishing in the Andaman island?
                                </button>
                            </h3>
                            <div id="faq9" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body p-3">
                                    <div class="faq-answer p-3"
                                        style="background-color: rgba(17, 157, 213, 0.02); border-radius: 10px; border-left: 3px solid rgb(17, 157, 213);">
                                        <p class="mb-0">If you are going with a registered or certified operator, all necessary permits and licenses are usually taken care of by them. Local permission is only required if you are going on an independent fishing or shore fishing. But most of the tourists prefer guided trips.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- FAQ Item 5 -->
                        <div class="accordion-item border-0">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed p-3" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq10"
                                    style="background-color: rgba(17, 157, 213, 0.03); border-radius: 10px; font-weight: 600; color: #333;">
                                    <i class="fas fa-question-circle me-2" style="color: rgb(17, 157, 213);"></i>
                                    Will I be guided on how to fish if I am a beginner?
                                </button>
                            </h3>
                            <div id="faq10" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body p-3">
                                    <div class="faq-answer p-3"
                                        style="background-color: rgba(17, 157, 213, 0.02); border-radius: 10px; border-left: 3px solid rgb(17, 157, 213);">
                                        <p class="mb-0">Absolutely, you do not need any prior experience to enjoy game fishing in the Andamans. Friendly and professional crew members are there to guide you every step of the way, from handling the fishing rod to casting the line and even they will teach you how to reel in your first big catch.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
            <div class="faq-more-help text-center mt-4">
                <p class="small text-muted mb-2">Can't find what you're looking for?</p>
                <a href="/contact" class="btn btn-sm px-4 py-2"
                    style="background-color: rgb(17, 157, 213); color: white; border-radius: 50px; font-weight: 600;">
                    <i class="fas fa-envelope me-2"></i> Contact Support
                </a>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section id="cta" class="cta-section py-5">
    <div class="container">
        <div class="cta-container text-center py-5">
            <h2 class="cta-title">Ready for the Ultimate Fishing Adventure?</h2>
            <p class="cta-text">Experience world-class game fishing in the pristine waters of the Andaman Islands</p>
            <div class="cta-buttons mt-4">
                <a href="#fishing-locations" class="btn-cta-primary me-3">
                    <i class="fas fa-fish me-2"></i> Explore Packages
                </a>
                <a href="#booking-form" class="btn-cta-secondary">
                    <i class="fas fa-calendar-check me-2"></i> Book Now
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Full Booking Form Section -->
<section id="booking-form" class="booking-section py-5 position-relative">
    <!-- Background Elements -->
    <div class="booking-bg-shape position-absolute top-0 end-0 d-none d-lg-block"
        style="width: 30%; height: 70%; background-color: rgba(17, 157, 213, 0.03); border-radius: 0 0 0 100px; z-index: 0;">
    </div>
    <div class="booking-bg-waves position-absolute bottom-0 start-0 d-none d-lg-block"
        style="width: 200px; height: 200px; z-index: 0; opacity: 0.2;">
        <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
            <path fill="rgb(17, 157, 213)"
                d="M37.9,-65.5C46.1,-55.2,48.4,-39.5,55.3,-26.2C62.2,-12.9,73.8,-2.1,74.9,9.5C76,21.1,66.6,33.5,55.8,42.4C45,51.3,32.8,56.7,20.4,60.2C8,63.7,-4.7,65.3,-18.1,63.5C-31.5,61.7,-45.6,56.5,-54.6,46.6C-63.6,36.7,-67.5,22.1,-70.3,6.8C-73.1,-8.5,-74.8,-24.5,-68.2,-36.1C-61.6,-47.7,-46.7,-54.9,-32.9,-62.8C-19.1,-70.7,-6.3,-79.3,5.2,-78.1C16.7,-76.9,29.7,-75.8,37.9,-65.5Z"
                transform="translate(100 100)" />
        </svg>
    </div>

    <div class="container position-relative" style="z-index: 1;">
        <div class="row align-items-center mb-5">
            <div class="col-lg-6">
                <div class="section-header-left">
                    <div class="section-tag mb-3 d-inline-block py-1 px-3"
                        style="background-color: rgba(17, 157, 213, 0.1); border-radius: 30px;">
                        <span class="small fw-semibold" style="color: rgb(17, 157, 213);"><i
                                class="fas fa-calendar-check me-2"></i>RESERVATION</span>
                    </div>
                    <h2 class="fw-bold mb-3" style="color: rgb(17, 157, 213);">Book Your <span
                            style="color: #f9680f;">Fishing Day</span></h2>
                    <p class="lead">Fill out the form to book your private boat charter or request more information.</p>
                </div>
            </div>
            <div class="col-lg-6 text-lg-end mt-4 mt-lg-0">
                <div class="booking-benefits d-inline-flex flex-column p-4"
                    style="background-color: white; border-radius: 15px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);">
                    <div class="benefit-header mb-3">
                        <h4 class="h5 mb-0" style="color: rgb(17, 157, 213);">Why Book With Us?</h4>
                    </div>
                    <div class="benefit-list">
                        <div class="benefit-item d-flex align-items-center mb-2">
                            <div class="benefit-icon me-2" style="color: #f9680f;">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <p class="small mb-0">Instant confirmation</p>
                        </div>
                        <div class="benefit-item d-flex align-items-center mb-2">
                            <div class="benefit-icon me-2" style="color: #f9680f;">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <p class="small mb-0">Free cancellation up to 7 days before</p>
                        </div>
                        <div class="benefit-item d-flex align-items-center">
                            <div class="benefit-icon me-2" style="color: #f9680f;">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <p class="small mb-0">Secure payment options</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8 mb-4 mb-lg-0">
                <div class="booking-form-container p-4"
                    style="background-color: white; border-radius: 20px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);">
                    <form method="POST" action="{{ url('boat-activity/contact') }}" class="booking-form">
                        @csrf
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="fullName" name="customer_name"
                                        placeholder="Your Full Name"
                                        style="border-radius: 10px; border: 1px solid rgba(17, 157, 213, 0.2);">
                                    <label for="fullName" style="color: #666;">Full Name</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="email" name="emailAddress" class="form-control" id="emailAddress"
                                        placeholder="Your Email Address"
                                        style="border-radius: 10px; border: 1px solid rgba(17, 157, 213, 0.2);">
                                    <label for="emailAddress" style="color: #666;">Email Address</label>
                                </div>
                            </div>
                            <input type="text" name="website" id="website" style="display:none;" tabindex="-1"
                                autocomplete="off">

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="tel" class="form-control" name="phoneNumber" id="phoneNumber"
                                        placeholder="Your Phone Number"
                                        style="border-radius: 10px; border: 1px solid rgba(17, 157, 213, 0.2);">
                                    <label for="phoneNumber" style="color: #666;">Phone Number</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="date" name="fishingDate" class="form-control" id="preferredDate"
                                        style="border-radius: 10px; border: 1px solid rgba(17, 157, 213, 0.2);">
                                    <label for="preferredDate" style="color: #666;">Preferred Date</label>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="charter-options mb-4">
                                    <label class="form-label mb-3"
                                        style="color: rgb(17, 157, 213); font-weight: 600;">Select Fishing
                                        Destination</label>
                                    <div class="row g-3">
                                        @foreach($gamefishing as $fishing)
                                        <div class="col-md-6 col-lg-3">
                                            <div class="charter-option-card">
                                                <input type="radio" name="fishingPackage" id="speedboat{{$loop->index}}"
                                                    class="charter-option-input" hidden>
                                                <label for="speedboat{{$loop->index}}"
                                                    class="charter-option-label d-flex flex-column align-items-center p-3"
                                                    style="border: 1px solid rgba(17, 157, 213, 0.2); border-radius: 10px; cursor: pointer; transition: all 0.3s ease;">
                                                    <div class="charter-icon mb-2"
                                                        style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; background-color: rgba(17, 157, 213, 0.1); border-radius: 50%;">
                                                        <i class="fas fa-ship" style="color: rgb(17, 157, 213);"></i>
                                                    </div>
                                                    <h6 class="charter-name mb-1 text-center">
                                                        {{ $fishing->places_covered }}
                                                    </h6>
                                                    </h6>
                                                    @php
                                                    $minPrice = $fishing->seasonalPrices->min('price');
                                                    $finalPrice = $minPrice ?? $fishing->base_price;
                                                    @endphp
                                                    <p class="charter-price small mb-0"
                                                        style="color: #f9680f; text-align:center">₹{{ $finalPrice .'/' .
                                                        $fishing->duration }}</p>
                                                </label>
                                            </div>
                                        </div>
                                        @endforeach

                                        <div class="col-md-6 col-lg-3">
                                            <div class="charter-option-card">
                                                <input type="radio" name="fishingPackage" id="custom"
                                                    class="charter-option-input" hidden>
                                                <label for="custom"
                                                    class="charter-option-label d-flex flex-column align-items-center p-3"
                                                    style="border: 1px solid rgba(17, 157, 213, 0.2); border-radius: 10px; cursor: pointer; transition: all 0.3s ease;">
                                                    <div class="charter-icon mb-2"
                                                        style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; background-color: rgba(17, 157, 213, 0.1); border-radius: 50%;">
                                                        <i class="fas fa-sliders-h"
                                                            style="color: rgb(17, 157, 213);"></i>
                                                    </div>
                                                    <h6 class="charter-name mb-1">Custom</h6>
                                                    <p class="charter-price small mb-0" style="color: #f9680f;">Contact
                                                        us</p>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select class="form-select" name="anglerCount" id="guestCount"
                                        style="border-radius: 10px; border: 1px solid rgba(17, 157, 213, 0.2);">
                                        <option selected disabled value="">Select an option</option>
                                        <option>1-2 Anglers</option>
                                        <option>3-4 Anglers</option>
                                        <option>5-8 Anglers</option>

                                    </select>
                                    <label for="guestCount" style="color: #666;">Number of Guests</label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select class="form-select" name="fishing_duration" id="tripDuration"
                                        style="border-radius: 10px; border: 1px solid rgba(17, 157, 213, 0.2);">
                                        <option selected disabled value="">Select an option</option>
                                        <option>2 Hours</option>
                                        <option>Half Day (4 Hours)</option>
                                        <option>Full Day (8 Hours)</option>
                                        <option>Custom Duration</option>
                                    </select>
                                    <label for="tripDuration" style="color: #666;">Trip Duration</label>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control" name="special_requests" id="specialRequests"
                                        style="height: 120px; border-radius: 10px; border: 1px solid rgba(17, 157, 213, 0.2);"
                                        placeholder="Any special requests or questions?"></textarea>
                                    <label for="specialRequests" style="color: #666;">Special Requests</label>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-check d-flex align-items-center">
                                    <input class="form-check-input me-2" type="checkbox" id="termsCheck"
                                        style="width: 20px; height: 20px; border: 1px solid rgba(17, 157, 213, 0.3); border-radius: 4px;"
                                        required>
                                    <label class="form-check-label" for="termsCheck">
                                        I agree to the <a href="#"
                                            style="color: rgb(17, 157, 213); text-decoration: none; border-bottom: 1px dotted rgb(17, 157, 213);">terms
                                            and conditions</a>
                                    </label>
                                </div>
                            </div>

                            <div class="col-12 mt-4">
                                <button type="submit" class="btn w-100 py-3"
                                    style="background: linear-gradient(135deg, rgb(17, 157, 213) 0%, rgb(0, 198, 255) 100%); color: white; border-radius: 10px; font-weight: 600; box-shadow: 0 10px 20px rgba(17, 157, 213, 0.2);">
                                    <i class="fas fa-paper-plane me-2"></i> Submit Booking Request
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="booking-sidebar">
                    <div class="booking-summary p-4 mb-4"
                        style="background-color: white; border-radius: 20px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);">
                        <h4 class="h5 mb-3" style="color: rgb(17, 157, 213);">What to Expect</h4>
                        <div class="summary-item d-flex align-items-start mb-3">
                            <div class="summary-icon me-3 mt-1" style="color: #f9680f;">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div class="summary-text">
                                <p class="small mb-0">Professional crew and captain with extensive local knowledge</p>
                            </div>
                        </div>
                        <div class="summary-item d-flex align-items-start mb-3">
                            <div class="summary-icon me-3 mt-1" style="color: #f9680f;">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div class="summary-text">
                                <p class="small mb-0">All safety equipment and life jackets provided</p>
                            </div>
                        </div>
                        <div class="summary-item d-flex align-items-start mb-3">
                            <div class="summary-icon me-3 mt-1" style="color: #f9680f;">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div class="summary-text">
                                <p class="small mb-0">Complimentary bottled water and refreshments</p>
                            </div>
                        </div>
                        <div class="summary-item d-flex align-items-start">
                            <div class="summary-icon me-3 mt-1" style="color: #f9680f;">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div class="summary-text">
                                <p class="small mb-0">Customizable itinerary based on your preferences</p>
                            </div>
                        </div>
                    </div>

                    <div class="booking-contact p-4"
                        style="background: linear-gradient(135deg, rgba(17, 157, 213, 0.1) 0%, rgba(0, 198, 255, 0.1) 100%); border-radius: 20px; border-left: 4px solid rgb(17, 157, 213);">
                        <h4 class="h5 mb-3" style="color: rgb(17, 157, 213);">Need Help?</h4>
                        <p class="small mb-3">Our charter specialists are available to assist you with any questions that arise while booking.
                        </p>
                        <div class="contact-item d-flex align-items-center mb-2">
                            <div class="contact-icon me-2" style="color: #f9680f;">
                                <i class="fas fa-phone-alt"></i>
                            </div>
                            <a href="tel:+918900909900" style="color: #333; text-decoration: none;">+91 89009 09900</a>
                        </div>
                        <div class="contact-item d-flex align-items-center mb-2">
                            <div class="contact-icon me-2" style="color: #f9680f;">
                                <i class="fas fa-phone-alt"></i>
                            </div>
                            <a href="tel:+919933202248" style="color: #333; text-decoration: none;">+91 99332 02248</a>
                        </div>
                        <div class="contact-item d-flex align-items-center">
                            <div class="contact-icon me-2" style="color: #f9680f;">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <a href="mailto:info@andamanbliss.com"
                                style="color: #333; text-decoration: none;">info@andamanbliss.com</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<!-- Owl Carousel Init -->
<script>
$(document).ready(function() {
    $('.testimonial-slider').owlCarousel({
        loop: true,
        margin: 30,
        nav: true,
        dots: true,
        autoplay: true,
        autoplayTimeout: 5000,
        responsive: {
            0: {
                items: 1
            },
            768: {
                items: 2
            },
            992: {
                items: 3
            }
        }
    });
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const bookingModal = new bootstrap.Modal(document.getElementById('bookingModal'));
    const itineraryModal = new bootstrap.Modal(document.getElementById('itineraryModal1'));
    const fishImagePath = "{{ asset('storage') }}/";

    document.querySelectorAll('.show-itineraries').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            fetch(`/get-itinerary/${id}`)
                .then(response => response.json())
                .then(data => {
                    if (!Array.isArray(data) || data.length === 0) return;

                    const first = data[0];

                    document.getElementById('itineraryModal1Label').textContent = first
                        .boat_package_name + ' - Detailed Itinerary';

                    const activityDescriptionEl = document.getElementById(
                        'activity-description');
                    if (activityDescriptionEl) {
                        activityDescriptionEl.innerHTML =
                            `<p class="text-muted">${first.activity_description}</p>`;
                    }

                    const itineraryContainer = document.getElementById(
                        'itinerary-timeline');
                    itineraryContainer.innerHTML = '';
                    data.forEach(item => {
                        const div = document.createElement('div');
                        div.className = 'timeline-item mb-3';
                        div.innerHTML = `
                                <div class="timeline-dot"><i class="fas fa-anchor"></i></div>
                                <div class="timeline-content">
                                    <h6 class="timeline-title mb-1">${item.title}</h6>
                                    <small class="text-muted">Day ${item.day}</small>
                                    <p class="timeline-description">${item.description}</p>
                                </div>
                            `;
                        itineraryContainer.appendChild(div);
                    });

                    const inclusionsList = document.getElementById('inclusions-list');
                    inclusionsList.innerHTML = '';
                    first.inclusions.forEach(title => {
                        const li = document.createElement('li');
                        li.innerHTML =
                            `<i class="fas fa-check-circle text-success me-2"></i> ${title}`;
                        inclusionsList.appendChild(li);
                    });

                    const exclusionsList = document.getElementById('exclusions-list');
                    exclusionsList.innerHTML = '';
                    first.exclusions.forEach(title => {
                        const li = document.createElement('li');
                        li.innerHTML =
                            `<i class="fas fa-times-circle text-danger me-2"></i> ${title}`;
                        exclusionsList.appendChild(li);
                    });

                    const fishesGallery = document.getElementById('fishes-gallery');
                    fishesGallery.innerHTML = '';
                    first.fishes_found.forEach(fish => {
                        const col = document.createElement('div');
                        col.className = 'col-6 col-md-4 col-lg-3 mb-3';
                        col.innerHTML = `
                                <div class="card fish-card h-100 shadow-sm">
                                    <img src="${fishImagePath + fish.image}" class="card-img-top" alt="${fish.name}">
                                    <div class="card-body p-2">
                                        <h6 class="card-title mb-1">${fish.name}</h6>
                                        <p class="card-text small text-muted">${fish.description}</p>
                                    </div>
                                </div>
                            `;
                        fishesGallery.appendChild(col);
                    });

                    itineraryModal.show();
                });
        });
    });

    document.querySelectorAll('.btn-book-now').forEach(button => {
        button.addEventListener('click', function() {
            const packageName = this.getAttribute('data-name');
            const pax = parseInt(this.getAttribute('data-pax'), 10);

            document.getElementById('package-name-modal').value = packageName;

            const anglersSelect = document.getElementById('anglers');
            anglersSelect.innerHTML = '<option value="" disabled>Select</option>';

            for (let i = 1; i <= pax; i++) {
                const label = i + (i === 1 ? ' Guest' : ' Guests');
                const selected = (i === pax) ? 'selected' : '';
                anglersSelect.innerHTML += `<option value="${i}" ${selected}>${label}</option>`;
            }
        });
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const formInputs = document.querySelectorAll('.inquiry-input, .inquiry-select');
    formInputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.classList.add('focused');
            const icon = this.parentElement.querySelector('.input-icon');
            if (icon) icon.style.color = 'rgb(17, 157, 213)';
        });

        input.addEventListener('blur', function() {
            this.parentElement.classList.remove('focused');
            const icon = this.parentElement.querySelector('.input-icon');
            if (icon) icon.style.color = '#6c757d';
        });

        if (input.type === 'date' || (input.type === 'text' && input.id === 'fishingDate')) {
            input.addEventListener('change', function() {
                this.classList.toggle('has-value', !!this.value);
            });
            if (input.value) input.classList.add('has-value');
        }
    });

    const filterButtons = document.querySelectorAll('.filter-btn');
    const galleryItems = document.querySelectorAll('.gallery-item');

    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            filterButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');

            const filterValue = this.getAttribute('data-filter');
            galleryItems.forEach(item => {
                if (filterValue === 'all' || item.getAttribute('data-category') ===
                    filterValue) {
                    item.style.display = 'block';
                    setTimeout(() => {
                        item.style.opacity = '1';
                        item.style.transform = 'scale(1)';
                    }, 50);
                } else {
                    item.style.opacity = '0';
                    item.style.transform = 'scale(0.8)';
                    setTimeout(() => {
                        item.style.display = 'none';
                    }, 300);
                }
            });
        });
    });

    const lightbox = document.getElementById('gallery-lightbox');
    const lightboxImage = lightbox.querySelector('.lightbox-image');
    const lightboxCaption = lightbox.querySelector('.lightbox-caption');
    const lightboxClose = lightbox.querySelector('.lightbox-close');
    const lightboxPrev = lightbox.querySelector('.lightbox-prev');
    const lightboxNext = lightbox.querySelector('.lightbox-next');
    const galleryLinks = document.querySelectorAll('.gallery-zoom');

    let currentIndex = 0;
    const galleryImages = [];

    galleryLinks.forEach((link, index) => {
        galleryImages.push({
            src: link.getAttribute('href'),
            caption: link.getAttribute('data-caption')
        });
        link.addEventListener('click', function(e) {
            e.preventDefault();
            openLightbox(index);
        });
    });

    function openLightbox(index) {
        currentIndex = index;
        updateLightboxContent();
        lightbox.classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeLightbox() {
        lightbox.classList.remove('active');
        document.body.style.overflow = '';
    }

    function updateLightboxContent() {
        const image = galleryImages[currentIndex];
        lightboxImage.src = image.src;
        lightboxCaption.textContent = image.caption || '';
        lightboxPrev.style.display = galleryImages.length <= 1 ? 'none' : 'flex';
        lightboxNext.style.display = galleryImages.length <= 1 ? 'none' : 'flex';
    }

    function prevImage() {
        currentIndex = (currentIndex - 1 + galleryImages.length) % galleryImages.length;
        updateLightboxContent();
    }

    function nextImage() {
        currentIndex = (currentIndex + 1) % galleryImages.length;
        updateLightboxContent();
    }

    lightboxClose.addEventListener('click', closeLightbox);
    lightboxPrev.addEventListener('click', prevImage);
    lightboxNext.addEventListener('click', nextImage);

    lightbox.addEventListener('click', function(e) {
        if (e.target === lightbox) closeLightbox();
    });

    document.addEventListener('keydown', function(e) {
        if (!lightbox.classList.contains('active')) return;
        if (e.key === 'Escape') closeLightbox();
        else if (e.key === 'ArrowLeft') prevImage();
        else if (e.key === 'ArrowRight') nextImage();
    });



    const viewAllReviewsBtn = document.querySelector('.btn-view-all-reviews');
    if (viewAllReviewsBtn) {
        viewAllReviewsBtn.addEventListener('click', function(e) {
            e.preventDefault();
            alert('All customer reviews will be displayed in the production version.');
        });
    }

    const faqQuestions = document.querySelectorAll('.faq-question');
    faqQuestions.forEach(question => {
        question.addEventListener('click', function() {
            this.classList.toggle('active');
        });
    });

});
</script>
@endpush

@endsection