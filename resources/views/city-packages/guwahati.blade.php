@extends('layouts.app')
@section('title', 'Andaman Tour Packages from Guwahati | Andaman Bliss')
@section('keywords', 'Andaman tour package from Guwahati, Andaman holiday packages from Guwahati, Andaman Honeymoon Packages from Guwahati, Andaman Budget Packages from Guwahati, How to Reach Andaman Islands from Guwahati, Best Places to Visit in Andaman Islands, Andaman tour packages.')
@section('description', 'Book Andaman holiday packages from Guwahati with Andaman Bliss. Customized tour, beaches, water sports, island sightseeing & 24/7 local support.')
@push('styles')
<!-- Chennai specific CSS -->
<!-- <link rel="stylesheet" href="{{ asset('site/css/chennai.css') }}"> -->
<style>
/* Andaman Honeymoon Packages Styles */
.chennai-hero {
    background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), /* overlay */ url('../site/img/city-packages/sea-view1.jpg'); 
   background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    min-height: 80vh;
    display: flex;
    align-items: center;
    position: relative;
    overflow: hidden;
}

.hero-content {
    text-align: center;
    color: white;
    z-index: 2;
    position: relative;
}

.hero-badge {
    background: rgba(255, 255, 255, 0.2);
    color: white;
    padding: 6px 16px;
    border-radius: 25px;
    font-size: 0.8rem;
    font-weight: 500;
    margin-bottom: 1.5rem;
    display: inline-block;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.3);
}

.hero-title {
    font-size: 2.8rem;
    font-weight: 700;
    margin-bottom: 1rem;
    line-height: 1.1;
    color: white;
}

.hero-title .highlight {
    color: #fd7e14;
}

.hero-subtitle {
    font-size: 1.1rem;
    margin-bottom: 2rem;
    opacity: 0.95;
    max-width: 550px;
    margin-left: auto;
    margin-right: auto;
    line-height: 1.4;
}

.hero-buttons {
    display: flex;
    gap: 15px;
    justify-content: center;
    flex-wrap: wrap;
    margin-bottom: 2.5rem;
}

.hero-cta {
    padding: 12px 28px;
    border-radius: 50px;
    font-size: 1rem;
    font-weight: 600;
    transition: all 0.3s ease;
    text-decoration: none;
    display: inline-block;
    border: 2px solid transparent;
}

.hero-cta.primary {
    background: #fd7e14;
    color: white;
}

.hero-cta.primary:hover {
    background: #e8920a;
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(253, 126, 20, 0.3);
    color: white;
}

.hero-cta.secondary {
    background: transparent;
    color: white;
    border: 2px solid rgba(255, 255, 255, 0.5);
}

.hero-cta.secondary:hover {
    background: rgba(255, 255, 255, 0.1);
    border-color: white;
    color: white;
}

.hero-stats {
    display: flex;
    justify-content: center;
    gap: 40px;
    flex-wrap: wrap;
}

.hero-stat {
    text-align: center;
    color: white;
}

.hero-stat-number {
    font-size: 1.6rem;
    font-weight: 700;
    color: #fd7e14;
    display: block;
    margin-bottom: 3px;
}

.hero-stat-label {
    font-size: 0.8rem;
    opacity: 0.9;
}

.scroll-indicator {
    position: absolute;
    bottom: 20px;
    left: 50%;
    transform: translateX(-50%);
    color: white;
    text-align: center;
    opacity: 0.8;
}

.scroll-indicator i {
    font-size: 1.2rem;
    animation: bounce 2s infinite;
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
        transform: translateY(-10px);
    }

    60% {
        transform: translateY(-5px);
    }
}

.section-padding {
    padding: 20px 0;
}

/* Mobile Responsive Styles */
@media (max-width: 991px) {
    .section-padding {
        padding: 60px 0;
    }

    .container {
        padding-left: 20px;
        padding-right: 20px;
    }
}

.section-title {
    color: #334E6B;
    font-size: 2.5rem;
    font-weight: 700;
    text-align: center;
    margin-bottom: 3rem;
    position: relative;
}

.section-title::after {
    content: '';
    position: absolute;
    bottom: -10px;
    left: 50%;
    transform: translateX(-50%);
    width: 80px;
    height: 4px;
    background: #ffa207;
    border-radius: 2px;
}

.package-card {
    background: white;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    transition: all 0.3s ease;
    margin-bottom: 30px;
}

.package-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
}

.package-image {
    height: 250px;
    background-size: cover;
    background-position: center;
    position: relative;
}

.package-price {
    position: absolute;
    top: 20px;
    right: 20px;
    background: #ffa207;
    color: white;
    padding: 10px 20px;
    border-radius: 25px;
    font-weight: 600;
}

.package-content {
    padding: 30px;
}

.package-title {
    color: #334E6B;
    font-size: 1.5rem;
    font-weight: 600;
    margin-bottom: 15px;
}

.package-features {
    list-style: none;
    padding: 0;
    margin: 20px 0;
}

.package-features li {
    padding: 8px 0;
    color: #666;
    position: relative;
    padding-left: 25px;
}

.package-features li::before {
    content: '✓';
    position: absolute;
    left: 0;
    color: #ffa207;
    font-weight: bold;
}

.itinerary-section {
    background: #f8f9fa;
}



.itinerary-day {
    background: white;
    border-radius: 12px;
    padding: 20px 25px;
    margin-bottom: 15px;
    position: relative;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
    transition: all 0.3s ease;
    border: 1px solid #e9ecef;
}

.itinerary-day:hover {
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
}

.itinerary-day-header {
    display: flex;
    align-items: center;
    cursor: pointer;
    user-select: none;
}

.day-number {
    background: linear-gradient(135deg, #00BCD4 0%, #2196F3 100%);
    color: white;
    width: 45px;
    height: 45px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    font-size: 1.1rem;
    margin-right: 15px;
    flex-shrink: 0;
    box-shadow: 0 3px 10px rgba(23, 162, 184, 0.3);
}

.itinerary-day-title {
    color: #17a2b8;
    font-size: 1.2rem;
    font-weight: 600;
    margin: 0;
    flex-grow: 1;
}

.toggle-icon {
    color: #fd7e14;
    font-size: 1.2rem;
    transition: transform 0.3s ease;
    margin-left: 10px;
}

.toggle-icon.expanded {
    transform: rotate(180deg);
}

.itinerary-activities {
    margin-top: 15px;
    display: none;
    animation: slideDown 0.3s ease;
}

.itinerary-activities.show {
    display: block;
}

@keyframes slideDown {
    from {
        opacity: 0;
        max-height: 0;
    }

    to {
        opacity: 1;
        max-height: 500px;
    }
}

.activity-item {
    background: #f8f9fa;
    padding: 12px 15px;
    border-radius: 8px;
    margin-bottom: 10px;
    border-left: 3px solid #fd7e14;
    transition: all 0.3s ease;
}

.activity-item:hover {
    background: #e9ecef;
    transform: translateX(2px);
}

.activity-item:last-child {
    margin-bottom: 0;
}

.activity-name {
    color: #17a2b8;
    font-weight: 600;
    margin-bottom: 4px;
    font-size: 0.95rem;
}

.activity-desc {
    color: #666;
    font-size: 0.9rem;
    line-height: 1.4;
    margin: 0;
}

.itinerary-summary {
    color: #666;
    font-size: 0.9rem;
    margin-top: 5px;
    font-style: italic;
}

.attractions-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 30px;
    margin-top: 50px;
}

.attraction-card {
    background: white;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
}

.attraction-card:hover {
    transform: translateY(-5px);
}

.attraction-image {
    height: 200px;
    background-size: cover;
    background-position: center;
}

.attraction-content {
    padding: 25px;
}

.testimonial-card {
    background: white;
    border-radius: 15px;
    padding: 40px;
    text-align: center;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    margin: 20px;
}

.testimonial-text {
    font-style: italic;
    font-size: 1.1rem;
    color: #666;
    margin-bottom: 25px;
    line-height: 1.8;
}

.testimonial-author {
    color: #334E6B;
    font-weight: 600;
}

.cta-section {
    background: linear-gradient(135deg, #03A9F4 0%, #00BCD4 100%);
    color: white;
    text-align: center;
}

.cta-title {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 1rem;
    color: #fff;
}

.cta-subtitle {
    font-size: 1.2rem;
    margin-bottom: 2rem;
    opacity: 0.9;
}

.cta-button {
    background: white;
    color: #334E6B;
    padding: 18px 50px;
    border: none;
    border-radius: 50px;
    font-size: 1.3rem;
    font-weight: 600;
    transition: all 0.3s ease;
    text-decoration: none;
    display: inline-block;
    margin: 10px;
}

.cta-button:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    color: #334E6B;
}



/* Modern Table Styles */
.packages-table-container {
    background: white;
    border-radius: 20px;
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    margin-top: 50px;
    border: 1px solid #f0f0f0;
}

.packages-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
}

.packages-table thead {
    background: linear-gradient(135deg, #17a2b8 0%, #fd7e14 100%);
    color: white;
}

.packages-table th {
    padding: 25px 20px;
    text-align: left;
    font-weight: 600;
    font-size: 1.1rem;
    border: none;
    position: relative;
}

.packages-table th:first-child {
    border-top-left-radius: 20px;
}

.packages-table th:last-child {
    border-top-right-radius: 20px;
}

.packages-table tbody tr {
    border-bottom: 1px solid #f0f0f0;
}

.packages-table tbody tr:last-child {
    border-bottom: none;
}

.packages-table td {
    padding: 25px 20px;
    border: none;
    vertical-align: top;
}

.package-name-cell {
    position: relative;
}

.package-nights-badge {
    background: linear-gradient(135deg, #FF9800, #fd7e14);
    color: white;
    padding: 4px 12px;
    border-radius: 15px;
    font-size: 0.75rem;
    font-weight: 600;
    display: inline-block;
    margin-bottom: 8px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.package-name {
    color: #17a2b8;
    font-weight: 700;
    font-size: 1.2rem;
    margin-bottom: 5px;
    line-height: 1.3;
}

.package-subtitle {
    color: #666;
    font-size: 0.9rem;
    font-style: italic;
}

.duration-cell {
    text-align: center;
}

.duration-main {
    font-weight: 700;
    color: #17a2b8;
    font-size: 1.1rem;
    margin-bottom: 5px;
}

.duration-sub {
    color: #666;
    font-size: 0.85rem;
    background: #f8f9fa;
    padding: 4px 8px;
    border-radius: 12px;
    display: inline-block;
}

.price-cell {
    text-align: center;
}

.package-price {
    color: #fd7e14;
    font-weight: 700;
    font-size: 1.5rem;
    margin-bottom: 3px;
}

.price-label {
    color: #666;
    font-size: 0.8rem;
    background: #fff3e0;
    padding: 2px 8px;
    border-radius: 10px;
    display: inline-block;
}

.highlights-cell {
    max-width: 300px;
}

.package-highlights {
    display: flex;
    flex-direction: column;
    gap: 6px;
}

.highlight-item {
    display: flex;
    align-items: center;
    color: #666;
    font-size: 0.9rem;
    line-height: 1.4;
}

.highlight-item::before {
    content: '✓';
    color: #fd7e14;
    font-weight: bold;
    margin-right: 8px;
    font-size: 0.9rem;
    width: 16px;
    text-align: center;
}

.action-cell {
    text-align: center;
}

.view-package-btn {
    background: linear-gradient(135deg, #17a2b8, #20c997);
    color: white;
    padding: 12px 24px;
    border: none;
    border-radius: 25px;
    font-size: 0.9rem;
    font-weight: 600;
    transition: all 0.3s ease;
    text-decoration: none;
    display: inline-block;
    box-shadow: 0 4px 15px rgba(23, 162, 184, 0.3);
}

.view-package-btn:hover {
    background: linear-gradient(135deg, #fd7e14, #ff8c42);
    color: white;
    text-decoration: none;
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(253, 126, 20, 0.4);
}
.packages-list-style{
    padding:5px 20px;
}
.packages-list-style li {
    list-style-type: disc;
}

/* Responsive Table */
@media (max-width: 1200px) {
    .packages-table-container {
        overflow-x: auto;
    }

    .packages-table {
        min-width: 900px;
    }
}

@media (max-width: 768px) {

    .packages-table th,
    .packages-table td {
        padding: 15px 12px;
        font-size: 0.9rem;
    }

    .package-name {
        font-size: 1rem;
    }

    .package-price {
        font-size: 1.3rem;
    }

    .view-package-btn {
        padding: 10px 20px;
        font-size: 0.8rem;
    }
}

@media (max-width: 768px) {
    .section-padding {
        padding: 50px 0;
    }

    .container {
        padding-left: 15px;
        padding-right: 15px;
    }

    /* Hero Section Mobile */
    .chennai-hero {
        min-height: 85vh;
        padding: 30px 0;
    }

    .hero-content {
        padding: 0 10px;
    }

    .hero-badge {
        padding: 5px 12px;
        font-size: 0.75rem;
        margin-bottom: 1rem;
    }

    .hero-title {
        font-size: 2rem;
        line-height: 1.1;
        margin-bottom: 1rem;
    }

    .hero-subtitle {
        font-size: 0.95rem;
        margin-bottom: 1.5rem;
        padding: 0 10px;
    }

    .hero-buttons {
        margin-bottom: 2rem;
        gap: 10px;
        flex-direction: column;
        align-items: center;
    }

    .hero-cta {
        padding: 12px 30px;
        font-size: 0.9rem;
        min-width: 200px;
    }

    .hero-stats {
        gap: 25px;
        margin-bottom: 1rem;
    }

    .hero-stat-number {
        font-size: 1.3rem;
    }

    .hero-stat-label {
        font-size: 0.75rem;
    }

    /* Introduction Section Mobile */
    .intro-content {
        margin: 0 10px;
        padding: 25px 20px !important;
    }

    .intro-content h2 {
        font-size: 1.3rem !important;
        line-height: 1.3 !important;
        margin-bottom: 15px !important;
    }

    .intro-content p {
        font-size: 0.9rem !important;
        line-height: 1.5 !important;
        margin-bottom: 15px !important;
    }

    /* Section Titles Mobile */
    .section-title {
        font-size: 1.8rem;
        margin-bottom: 2rem;
        padding: 0 15px;
        text-align: center;
    }

    /* Packages Table Mobile */
    .packages-table-container {
        margin: 0 10px;
        border-radius: 15px;
    }

    .packages-table th,
    .packages-table td {
        padding: 15px 8px;
        font-size: 0.85rem;
    }

    .package-nights-badge {
        padding: 3px 8px;
        font-size: 0.7rem;
        margin-bottom: 5px;
    }

    .package-name {
        font-size: 1rem;
        margin-bottom: 3px;
    }

    .package-subtitle {
        font-size: 0.8rem;
    }

    .duration-main {
        font-size: 1rem;
    }

    .duration-sub {
        font-size: 0.75rem;
        padding: 2px 6px;
    }

    .package-price {
        font-size: 1.2rem;
    }

    .price-label {
        font-size: 0.7rem;
        padding: 1px 6px;
    }

    .highlight-item {
        font-size: 0.8rem;
        margin-bottom: 3px;
    }

    .view-package-btn {
        padding: 8px 16px;
        font-size: 0.8rem;
    }

    /* Itinerary Section Mobile */
    .itinerary-day {
        margin: 0 10px 15px;
        padding: 20px;
    }

    .day-number {
        width: 40px;
        height: 40px;
        font-size: 1.1rem;
        margin-right: 12px;
    }

    .itinerary-day-title {
        font-size: 1.1rem;
    }

    .itinerary-summary {
        font-size: 0.85rem;
        margin-top: 8px;
    }

    .activity-item {
        padding: 10px 15px;
        margin-bottom: 8px;
    }

    .activity-name {
        font-size: 0.9rem;
    }

    .activity-desc {
        font-size: 0.85rem;
    }

    /* Attractions Grid Mobile */
    .attractions-grid {
        grid-template-columns: 1fr;
        gap: 20px;
        margin: 0 10px;
    }

    .attraction-card {
        border-radius: 12px;
    }

    .attraction-image {
        height: 180px;
    }

    .attraction-content {
        padding: 20px;
    }

    .attraction-content h4 {
        font-size: 1.1rem;
        margin-bottom: 10px;
    }

    .attraction-content p {
        font-size: 0.9rem;
        line-height: 1.4;
    }

    /* Testimonials Mobile */
    .testimonial-card {
        margin: 10px;
        padding: 25px 20px;
    }

    .testimonial-text {
        font-size: 1rem;
        line-height: 1.6;
        margin-bottom: 20px;
    }

    .testimonial-author {
        font-size: 0.9rem;
    }

    /* CTA Section Mobile */
    .cta-title {
        font-size: 2rem;
        margin-bottom: 1rem;
        padding: 0 15px;
    }

    .cta-subtitle {
        font-size: 1.1rem;
        margin-bottom: 2rem;
        padding: 0 15px;
    }

    .cta-button {
        padding: 15px 35px;
        font-size: 1.1rem;
        margin: 8px;
        display: block;
        width: calc(100% - 30px);
        max-width: 300px;
        margin-left: auto;
        margin-right: auto;
    }

    /* Modal Mobile */
    .modal-dialog {
        margin: 10px;
    }

    .modal-body {
        padding: 20px !important;
    }

    .modal-body h6 {
        font-size: 1rem;
        margin-bottom: 12px;
    }

    .modal-body p,
    .modal-body li {
        font-size: 0.9rem;
        line-height: 1.5;
    }
}

@media (max-width: 576px) {
    .section-padding {
        padding: 40px 0;
    }

    .container {
        padding-left: 10px;
        padding-right: 10px;
    }

    /* Hero Section Extra Small */
    .hero-title {
        font-size: 1.8rem;
        padding: 0 5px;
    }

    .hero-subtitle {
        font-size: 0.9rem;
        padding: 0 5px;
    }

    .hero-cta {
        padding: 10px 25px;
        font-size: 0.85rem;
        min-width: 180px;
    }

    .hero-stats {
        gap: 20px;
    }

    /* Introduction Section Extra Small */
    .intro-content {
        margin: 0 5px;
        padding: 20px 15px !important;
    }

    .intro-content h2 {
        font-size: 1.2rem !important;
    }

    .intro-content p {
        font-size: 0.85rem !important;
    }

    /* Section Titles Extra Small */
    .section-title {
        font-size: 1.6rem;
        padding: 0 10px;
    }

    /* Packages Table Extra Small */
    .packages-table-container {
        margin: 0 5px;
        overflow-x: auto;
    }

    .packages-table {
        min-width: 550px;
    }

    .packages-table th,
    .packages-table td {
        padding: 12px 6px;
        font-size: 0.8rem;
    }

    .package-name {
        font-size: 0.9rem;
    }

    .package-price {
        font-size: 1.1rem;
    }

    .view-package-btn {
        padding: 6px 12px;
        font-size: 0.75rem;
    }

    /* Itinerary Extra Small */
    .itinerary-day {
        margin: 0 5px 12px;
        padding: 15px;
    }

    .day-number {
        width: 35px;
        height: 35px;
        font-size: 1rem;
        margin-right: 10px;
    }

    .itinerary-day-title {
        font-size: 1rem;
    }

    .toggle-icon {
        font-size: 1rem;
    }

    /* Attractions Extra Small */
    .attractions-grid {
        margin: 0 5px;
        gap: 15px;
    }

    .attraction-image {
        height: 160px;
    }

    .attraction-content {
        padding: 15px;
    }

    /* Testimonials Extra Small */
    .testimonial-card {
        margin: 5px;
        padding: 20px 15px;
    }

    .testimonial-text {
        font-size: 0.95rem;
    }

    /* CTA Section Extra Small */
    .cta-title {
        font-size: 1.8rem;
        padding: 0 10px;
    }

    .cta-subtitle {
        font-size: 1rem;
        padding: 0 10px;
    }

    .cta-button {
        padding: 12px 30px;
        font-size: 1rem;
        width: calc(100% - 20px);
    }

    /* Modal Extra Small */
    .modal-dialog {
        margin: 5px;
    }

    .modal-body {
        padding: 15px !important;
    }

    .modal-body h6 {
        font-size: 0.95rem;
    }

    .modal-body p,
    .modal-body li {
        font-size: 0.85rem;
    }
}

/* Inline Read More toggle */
.read-more-toggle {
    color: #fd7e14;
    text-decoration: none;
    font-weight: 500;
    font-size: 0.9rem;
}

.read-more-content {
    display: none;
    margin-top: 18px;
    border-top: 1px dashed #ffd7b0;
    padding-top: 15px;
}

/* Card grid similar to reference image */
.activity-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 24px;
    margin-top: 20px;
}

.activity-card {
    position: relative;
    border-radius: 16px;
    overflow: hidden;
    min-height: 260px;
    background-size: cover;
    background-position: center;
    box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
    display: block;
}

.activity-card::after {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(180deg, rgba(0, 0, 0, 0.15) 0%, rgba(0, 0, 0, 0.55) 70%);
}

.activity-topbar {
    position: absolute;
    top: 14px;
    left: 14px;
    right: 14px;
    z-index: 2;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.time-badge {
    background: rgba(255, 255, 255, 0.9);
    color: #333;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
}

.book-now-pill {
    background: #fd7e14;
    color: #fff;
    padding: 6px 14px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 700;
    text-decoration: none;
}

.activity-content {
    position: absolute;
    left: 16px;
    right: 16px;
    bottom: 16px;
    z-index: 2;
    color: #fff;
}

.activity-price {
    font-size: 0.95rem;
    opacity: 0.95;
    margin-bottom: 6px;
}

.activity-price span {
    font-weight: 800;
}

.activity-title {
    font-size: 1.25rem;
    font-weight: 800;
    margin: 2px 0 6px;
}

.activity-subtitle {
    font-size: 0.9rem;
    opacity: 0.95;
    margin-bottom: 10px;
}

.inclusions {
    font-size: 0.85rem;
    opacity: 0.95;
}

/* FAQ */
.faq-section {
    background: #f8f9fa;
}

.faq-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px 30px;
}

.faq-item {
    background: #fff;
    border: 1px solid #e9ecef;
    border-radius: 12px;
    box-shadow: 0 6px 16px rgba(0, 0, 0, 0.06);
}

.faq-item summary {
    cursor: pointer;
    list-style: none;
    font-weight: 600;
    color: #17a2b8;
}

.faq-item summary::-webkit-details-marker {
    display: none;
}

.faq-item[open] summary {
    color: #fd7e14;
}

.faq-content {
    color: #666;
    margin-top: 10px;
    line-height: 1.6;
}

/* FAQ chevron icon */
.faq-icon {
    float: right;
    color: #9aa6b2;
    transition: transform .25s ease;
}

.faq-item[open] .faq-icon {
    transform: rotate(180deg);
    color: #fd7e14;
}

/* Testimonials (new style) */
.testi-header {
    text-align: center;
    margin-bottom: 26px;
}

.testi-title {
    font-weight: 800;
    font-size: 2rem;
    background: linear-gradient(90deg, #0090d0 0%, #ff6a00 100%);
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent;
    margin-bottom: 6px;
}

.testi-subtitle {
    color: #7a8a9a;
}

.testimonials-carousel .slick-slide {
    padding: 0 10px;
}

.testimonials-carousel .slick-list {
    margin: 0 -10px;
}

.t-card {
    background: #fff;
    border-radius: 12px;
    border: 1px solid #eef2f6;
    box-shadow: 0 6px 18px rgba(16, 24, 40, 0.06);
    padding: 18px 18px 14px;
}

.t-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 10px;
}

.stars {
    color: #00c853;
    font-size: 0.95rem;
    letter-spacing: 2px;
}

.verified-pill {
    color: #35b26f;
    font-weight: 600;
    font-size: 0.85rem;
    display: inline-flex;
    align-items: center;
    gap: 6px;
}

.verified-pill i {
    color: #35b26f;
}

.t-title {
    font-weight: 700;
    color: #1f2a37;
    margin-bottom: 6px;
}

.t-excerpt {
    color: #65758b;
    margin-bottom: 14px;
}

.t-meta {
    color: #8b98a9;
    font-size: 0.85rem;
    display: flex;
    justify-content: space-between;
}

.testimonials-carousel .slick-prev,
.testimonials-carousel .slick-next {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: #fff;
    box-shadow: 0 6px 18px rgba(16, 24, 40, 0.12);
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    z-index: 3;
}

.testimonials-carousel .slick-prev:before,
.testimonials-carousel .slick-next:before {
    color: #334e6b !important;
    font-size: 20px;
}

.testimonials-carousel .slick-prev {
    left: -14px;
}

.testimonials-carousel .slick-next {
    right: -14px;
}

@media (max-width: 1024px) {
    .activity-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 768px) {
    .activity-grid {
        grid-template-columns: 1fr;
        gap: 18px;
    }

    .faq-grid {
        grid-template-columns: 1fr;
    }
}

/* New FAQ accordion styles */
.faq-accordion {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px 30px;
}

/* If someone wraps columns inside .row, prevent unintended grid grouping */
.faq-accordion.row {
    display: block;
}

.faq-column .faq-card {
    margin-bottom: 16px;
}

.faq-card {
    background: #fff;
    border: 1px solid #e9ecef;
    border-radius: 12px;
    box-shadow: 0 6px 16px rgba(0, 0, 0, 0.06);
    overflow: hidden;
}

.city-city-city-faq-toggle {
    width: 100%;
    background: transparent;
    border: 0;
    text-align: left;
    padding: 16px 18px;
    font-weight: 600;
    color: #17a2b8;
    position: relative;
}

.faq-arrow {
    position: absolute;
    right: 16px;
    top: 50%;
    transform: translateY(-50%) rotate(0deg);
    transition: transform .25s ease;
    color: #9aa6b2;
}

.faq-card.active .city-city-city-faq-toggle {
    color: #fd7e14;
}

/* New accessible toggle states */
.city-city-city-faq-toggle[aria-expanded="true"] {
    color: #fd7e14;
}

.city-city-city-faq-toggle[aria-expanded="true"] .faq-arrow {
    transform: translateY(-50%) rotate(180deg);
    color: #fd7e14;
}

.faq-panel {
    padding: 0 18px 16px;
    color: #666;
    line-height: 1.6;
}

.faq-panel[hidden] {
    display: none !important;
}

@media (max-width: 768px) {
    .faq-accordion {
        grid-template-columns: 1fr;
    }
}
</style>
@endpush

@push('scripts')
<!-- Chennai specific JavaScript -->
<script src="{{ asset('site/js/chennai.js') }}"></script>
<script>
$(document).ready(function() {
    // Initialize package carousel
    $('.package-carousel').slick({
        dots: true,
        infinite: true,
        speed: 500,
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 4000,
        responsive: [{
                breakpoint: 992,
                settings: {
                    slidesToShow: 2
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1
                }
            }
        ]
    });

    // Initialize testimonials carousel (card look, 3 on desktop, 2 tablet, 1 mobile)
    var $testi = $('.testimonials-carousel');
    if ($testi.hasClass('slick-initialized')) {
        $testi.slick('unslick');
    }
    $testi.slick({
        dots: true,
        infinite: true,
        speed: 450,
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 5000,
        responsive: [{
                breakpoint: 992,
                settings: {
                    slidesToShow: 2
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 1
                }
            }
        ]
    });

    // Smooth scrolling for anchor links
    $('a[href^="#"]').on('click', function(event) {
        var target = $(this.getAttribute('href'));
        if (target.length) {
            event.preventDefault();
            $('html, body').stop().animate({
                scrollTop: target.offset().top - 80
            }, 1000);
        }
    });

    // Inline Read More toggle (robust)
    $(document).on('click', '#readMoreToggle', function(e) {
        e.preventDefault();
        var content = $('#readMoreContent');
        var willShow = !content.is(':visible');
        content.stop(true, true).slideToggle(250);
        $(this).text(willShow ? 'Read Less' : 'Read More');
    });

    // FAQ accordion with ARIA + one-open-at-a-time
    (function initFaq() {
        var $accordion = $('#faqAccordion');
        $accordion.on('click keydown', '.city-city-city-faq-toggle', function(evt) {
            if (evt.type === 'keydown' && evt.key !== 'Enter' && evt.key !== ' ') return;
            evt.preventDefault();
            var $btn = $(this);
            var controls = $btn.attr('aria-controls');
            var $panel = $('#' + controls);

            var willExpand = $btn.attr('aria-expanded') !== 'true';

            // close all in this accordion only
            $accordion.find('.city-city-city-faq-toggle[aria-expanded="true"]').attr(
                'aria-expanded', 'false');
            $accordion.find('.faq-panel').attr('hidden', true);

            if (willExpand) {
                $btn.attr('aria-expanded', 'true');
                $panel.removeAttr('hidden');
            }
        });
    })();

});

// Itinerary toggle function
function toggleItinerary(dayNumber) {
    var activities = document.getElementById('activities-' + dayNumber);
    var icon = document.getElementById('icon-' + dayNumber);

    if (activities.classList.contains('show')) {
        activities.classList.remove('show');
        icon.classList.remove('expanded');
    } else {
        activities.classList.add('show');
        icon.classList.add('expanded');
    }
}
</script>
@endpush

@section('content')
<!-- Hero Section -->
<section class="chennai-hero">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="hero-content">
                    <div class="hero-badge">Experience Comfort</div>
                    <h1 class="hero-title">
                        Andaman Holiday Packages from Guwahati<span class="highlight"> | Andaman Bliss Tours</span>                     
                    </h1>
                    <p class="hero-subtitle">
                      Plan your Guwahati to Andaman trip with Andaman Bliss. Enjoy Havelock, Neil Island, water sports, hotels and seamless island transfers. 
                    </p>
                    <div class="hero-buttons">
                        <a href="#packages" class="hero-cta primary">Explore Packages</a>
                        <a href="#booking" class="hero-cta secondary">Contact Us</a>
                    </div>
                    <div class="hero-stats">
                        <div class="hero-stat">
                            <span class="hero-stat-number">4.9/5</span>
                            <div class="hero-stat-label">Customer Rating</div>
                        </div>
                        <div class="hero-stat">
                            <span class="hero-stat-number">2000+</span>
                            <div class="hero-stat-label">Happy Travelers</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="scroll-indicator">
        <div style="font-size: 0.8rem; margin-bottom: 10px;">Scroll Down</div>
        <i class="fas fa-chevron-down"></i>
    </div>
</section>



<!-- Modal removed: replaced with inline Read More content -->

<!-- Packages Section - converted to cards -->
<section id="packages" class="section-padding">
    <div class="container">
        <div class="text-center">
            <h2 class="section-title-h2 text-center">Andaman Tour <span> Packages from Guwahati</span></h2>
            <p>Everything you need to know about planning your trip to the Andaman Islands</p>
        </div>
        <div class="activity-grid">
            @foreach($tours as $tour)
            <a class="activity-card" href="{{ route('tour.static' ,['slug' => $tour['tourCategory']->slug, 'subslug' => $tour->slug]) }}"
                style="background-image:url('{{ $tour->tourPhotos[0]->file }}');">
                <div class="activity-topbar">
                    <div class="time-badge">{{$tour->nights}} Nights / {{$tour->days}} Days</div>
                    <span class="book-now-pill">Book Now</span>
                </div>
                <div class="activity-content">
                    <div class="activity-price">Starts from: <span>₹{{ $tour->start_price }}</span> <small>/ per person</small></div>
                    <div class="activity-title">Andaman {{ $tour->tourCategory->name }}</div>
                    <div class="activity-subtitle">{{ implode(' & ', $tour->islands_covered ?? []) }}</div>
                    <div class="inclusions">Inclusion: Stay, Breakfast, Transfers, Sightseeing</div>
                </div>
            </a>
            @endforeach

         
        </div>
    </div>
</section>

<!-- Introduction Section -->
<section class="section-padding" style="background: #f8f9fa;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="intro-content"
                    style="background: white; padding: 30px 40px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
                    <h2
                        style="color: #333; font-size: 1.5rem; font-weight: 600; margin-bottom: 15px; line-height: 1.4;">
                        Andaman Holiday Packages from Guwahati <span style="color: #fd7e14;"> | Andaman Bliss</span> 
                    </h2>
                    <div>
                        <h2 class="fw-bold fs-6">Summary</h2>
                        <p style="color: #666; font-size: 0.95rem; line-height: 1.6; margin-bottom: 15px; text-align:justify">
                     Looking for a perfect vacation and that too under budget, Andaman Bliss offers the best Andaman holiday packages from Guwahati that are perfect for every type of traveler. Whether it is a romantic trip, a family on vacation, trips of groups of friends or an adventurous thrilling vacation. Our Andaman tour packages are specially designed to make your Andaman trip smooth, exciting and full of memories. And also, you can even customize your packages to match your travel needs and preferences.</p>
                    
                     <p style="color: #666; font-size: 0.95rem; line-height: 1.6; margin-bottom: 15px; text-align:justify">
                     The moment you book your <strong>Andaman tour package from Guwahati</strong> with <strong>Andaman Bliss</strong>, we take care of everything. From comfortable hotels, easy island transfers, delicious meals, guided sightseeing tours  to experienced local guides and cab drivers, we make sure that your Andaman holiday is completely hassle-free. And if you need any help related to your tour, our Andaman Bliss team is available 24x7 to help you throughout your Andaman trip. You can explore beautiful beaches, clean blue water and even take part in many adventurous activities like <strong>scuba diving</strong>, <strong>snorkeling</strong>, <strong>sea walking</strong> and <strong>glass bottom boat rides</strong>. The top attractions includes <strong>Radhanagar Beach</strong>, <strong>Elephant Beach</strong>, <strong>Neil Islands</strong>, <strong>Mahatma Gandhi Marine National Park</strong>, <strong>Corbyn Cove Beach</strong> and <strong>Cellular Jail</strong>.</p>

                     <p style="color: #666; font-size: 0.95rem; line-height: 1.6; margin-bottom: 15px; text-align:justify">If you want to have a relaxing vacation, Andaman Islands is just perfect for you. You can just enjoy and spend time with your family and partner on the crystal clear water, stunning sunsets and enjoy the peaceful island vacation.</p>
                        
                    <p style="color: #666; font-size: 0.95rem; line-height: 1.6; margin-bottom: 15px; text-align:justify">At Andaman Bliss, we have created thousands of <strong>Andaman holiday packages from Guwahati</strong> at best and affordable rates without compromising on the quality. You can also enjoy many special deals, seasonal discounts and even personalized services to evaluate your Andaman trip into memorable and unforgettable.</p>
                        
                    <p style="color: #666; font-size: 0.95rem; line-height: 1.6; margin-bottom: 15px; text-align:justify">Plan your holiday to Andaman island with Andaman Bliss and experience the magic of the Andaman Islands like never before.</p>

                    </div>
                    <a href="#" id="readMoreToggle" class="read-more-toggle">Read More</a>
                    <div id="readMoreContent" class="read-more-content">

                        <h3 class="fs-6 fw-bold mt-3">Why Choose Andaman Bliss for Andaman Holiday Packages from Guwahati</h3>
                        <p>Choosing <strong>Andaman Bliss</strong> means planning your holiday with a team that truly understands the beauty and rhythm of the Andaman Islands. As a locally based travel company, we curate <strong>Andaman holiday packages from Guwahati</strong> with genuine destination expertise and a personal touch.
                        </p>
                        <p>We focus completely on <strong>comfort, transparency, and unforgettable experiences</strong>. From the moment you contact us until the last day of your journey, our Andaman Bliss team stays connected with you. 
                            Every itinerary is thoughtfully designed to offer the perfect balance of sightseeing, relaxation, and adventure.</p>

                        <h4 class="fs-6 fw-bold mt-2">Why travelers trust Andaman Bliss:</h4>
                        <ul class="packages-list-style">
                            <li>Customizable itineraries designed at your pace</li>
                            <li>Handpicked hotels for comfort and prime locations</li>
                            <li>Smooth ferry arrangements and local transfers</li>
                            <li>Experienced local coordinators on ground</li>
                            <li>24/7 assistance throughout your trip</li>
                            <li>Clear and honest pricing with no hidden charges</li>
                        </ul>
                        <p>With <strong>Andaman Bliss</strong>, your vacation is not just a trip — it becomes a beautiful island memory you’ll cherish forever.</p>

                       
                        <h3 class="fs-6 fw-bold mt-3">How to Reach Andaman Islands from Guwahati</h3>
                            <p>Reaching the <strong>Andaman Islands from Guwahati</strong> is convenient, with good connectivity via major Indian cities.
                            </p>

                            <p><strong>By Flight:</strong></p>
                            <ul class="packages-list-style">
                                <li>No airline operates direct flights from Guwahati to Port Blair.</li>
                                <li>You can take a connecting flight via Kolkata, Chennai, Bengaluru, or Delhi.</li>
                                <li>The total flight duration is approximately 7 to 9 hours.</li>
                            </ul>

                            <p>
                                <strong>Note:</strong> Flight tickets are not included in our Andaman tour packages. However, the 
                                <strong>Andaman Bliss</strong> team can assist you with the flight booking process.
                            </p>

                        <h3 class="fs-6 fw-bold mt-3">Best Time To Visit Andaman Island</h3>
                        <ul class="packages-list-style">
                            <li>The best time to visit Andaman & Nicobar Island is between <em>October and May</em>. During these months, the weather is pleasant with calm seas. This time is perfect for sightseeing and water sports activities.</li>
                            <li>AThe monsoon month that starts from <em>June to September</em> is not recommended as it causes heavy rainfall and might affect ferry schedules and water activities. </li>
                        </ul>

                        <h3 class="fs-6 fw-bold mt-3">Best Places to Visit in Andaman Islands</h3>

                            <p>The <strong>Andaman Islands</strong> are filled with stunning destinations, and each place offers its own mix of natural beauty, history, and adventure. Let’s explore some of the best places to visit in the Andaman Islands:</p>
                            <ul class="packages-list-style">
                            <li><strong><a href="https://andamanbliss.com/islands/port-blair/" target="_blank">Port Blair</a></strong></li>
                            <p>Port Blair is the capital city of the Andaman Islands and is famous for attractions like the 
                                <strong>Cellular Jail, Corbyn Cove Beach,</strong> and the <strong>Naval Museum</strong>.
                            </p>

                            <li><strong><a href="https://andamanbliss.com/islands/havelock-swaraj-dweep/" target="_blank">Havelock Island (Swaraj Dweep)</a></strong></li>
                            <p>Havelock Island is well known for the world-famous <strong>Radhanagar Beach</strong> and a wide range of exciting 
                                <strong>water sports activities</strong>.
                            </p>

                            <li><strong><a href="https://andamanbliss.com/islands/neil-shaheed-dweep/" target="_blank">Neil Island (Shaheed Dweep)</a></strong></li>
                            <p>Neil Island is loved for its peaceful beaches, stunning natural rock formations, and calm surroundings, making it perfect for relaxation.
                            </p>

                            <li><strong><a href="https://andamanbliss.com/islands/baratang/" target="_blank">Baratang Island</a></strong></li>
                            <p>Baratang Island is popular for its unique attractions such as <strong>Limestone Caves, Mud Volcanoes,</strong> and scenic 
                                <strong>Mangrove boat rides</strong>.
                            </p>

                            <li><strong><a href="https://andamanbliss.com/islands/port-blair/north-bay-island/" target="_blank">North Bay Island</a></strong></li>
                            <p>North Bay Island is one of the best spots in Andaman for enjoying thrilling <strong>water sports activities</strong>.
                            </p>

                            <p>Together, these destinations offer a complete and unforgettable <strong>Andaman Island experience</strong>.</p>

                            <h3 class="fs-6 fw-bold mt-3">Types of Andaman Holiday Packages from Guwahati</h3>
                            <p>At <strong>Andaman Bliss</strong>, we understand that every traveler is unique. That’s why we offer a wide range of <strong>Andaman tour packages from Guwahati</strong>, thoughtfully designed to suit different travel styles and budgets.</p>

                        <ul class="packages-list-style">
                            <li><strong>Andaman Honeymoon Packages from Guwahati:</strong></li>
                            <p>Enjoy romantic and private beach stays, candlelight dinners, and beautiful moments designed especially for couples.</p>
                            
                            <li><strong>Andaman Family Packages from Guwahati:</strong></li>
                            <p>Perfect for families, friends, office trips, and large groups, offering comfort, sightseeing, and fun-filled experiences.</p>
                            
                            <li><strong>Adventure Packages from Guwahati:</strong></li>
                            <p>Ideal for adventure seekers, including thrilling activities like scuba diving, snorkeling, sea walking, and more.</p>
                            
                            <li><strong>Andaman Budget Packages from Guwahati:</strong></li>
                            <p>Flexible and affordable packages designed to suit your budget without compromising on experiences.</p>
                            
                            <li><strong>Andaman Luxury Packages from Guwahati:</strong></li>
                            <p>Experience premium resorts, smooth transfers, and exclusive island experiences for a truly luxurious holiday.</p>
                        </ul>

                        <p>Every Andaman Bliss package can be customized to match your travel duration, interests, and travel preferences.</p>

 
                        <h3 class="fs-6 fw-bold mt-3">Water Sports Activities in Andaman Islands</h3>
                             <p>The <strong>Andaman Islands</strong> are among the top travel destinations in India, known for being safe, fun, and full of unforgettable experiences. Apart from crystal-clear blue waters, colorful corals, marine life, and historic sightseeing spots, the Andaman Islands are also famous for exciting <strong>water sports activities</strong> suitable for children, adults, and senior citizens.
                            </p>

                            <ul class="packages-list-style mb-3">
                                <li>
                                    <strong><a href="https://andamanbliss.com/activities/scuba-diving/" target="_blank">Scuba Diving:</a></strong>
                                    Scuba diving in Andaman offers a once-in-a-lifetime opportunity to explore vibrant coral reefs and exotic marine life.
                                    Havelock Island, North Bay, and Neil Island are popular spots for this activity.
                                </li>
                                <li>
                                    <strong><a href="https://andamanbliss.com/activities/snorkeling/" target="_blank">Snorkeling:</a></strong>
                                    One of the safest and most enjoyable water activities, snorkeling lets you float near the shore with a mask and enjoy colorful fishes and corals.
                                    Ideal for beginners, kids, and families.
                                </li>
                                <li>
                                    <strong><a href="https://andamanbliss.com/activities/sea-walk/" target="_blank">Sea Walking:</a></strong>
                                    Walk on the ocean floor by wearing a special helmet. This activity is perfect for non-swimmers and senior citizens.
                                </li>
                                <li>
                                    <strong><a href="https://andamanbliss.com/activities/jet-ski/" target="_blank">Jet Ski Ride:</a></strong>
                                    A thrilling activity for speed lovers, jet skiing is conducted under professional supervision to ensure complete safety.
                                </li>
                                <li>
                                    <strong><a href="https://andamanbliss.com/activities/parasailing/" target="_blank">Parasailing:</a></strong>
                                    Parasailing in Andaman gives you breathtaking aerial views of the sea and nearby islands while being safely harnessed to a speed boat.
                                </li>
                                <li>
                                    <strong><a href="https://andamanbliss.com/activities/banana-boat-ride-in-andaman/" target="_blank">Banana Boat Ride:</a></strong>
                                    A fun-filled group activity where you ride a banana-shaped inflatable boat pulled by a speed boat.
                                    Perfect for families, friends, and group travelers.
                                </li>
                                <li>
                                    <strong><a href="https://andamanbliss.com/activities/glass-bottom-boat-ride/" target="_blank">Glass Bottom Boat Ride:</a></strong>
                                    Ideal for travelers who want to explore marine life without getting wet.
                                    Enjoy clear views of corals and fishes through the transparent glass bottom.
                                </li>
                            </ul>

                            <h4 class="fs-6 fw-bold mt-3">Safety & Supervision</h4>
                            <p>
                                All water sports activities in the Andaman Islands are conducted by trained professionals and certified guides using proper safety equipment.
                                Life jackets, helmets, and clear safety instructions are provided to ensure a secure experience.
                                At <strong>Andaman Bliss</strong>, we make sure every activity included in our packages is safe, well-managed, and comfortable.
                            </p>

                            <h4 class="fs-6 fw-bold mt-3">Explore the Underwater World with Andaman Bliss</h4>
                            <p>
                                From calm underwater walks to high-adrenaline speed rides, water sports in the Andaman Islands add excitement and unforgettable memories to your holiday.
                                With <strong>Andaman Bliss</strong>, enjoy these activities safely and hassle-free as part of your Andaman tour packages.
                            </p>

 
                            <h3 class="fs-6 fw-bold mt-3">Sample Andaman Itinerary of 5 Nights 6 Days for Guwahati Travelers</h3>
                            <ul class="packages-list-style">
                            <p><strong>Day 1: Arrive in Port Blair | Cellular Jail & Light & Sound Show</strong></p>
                                <li>Arrive at Port Blair Airport, where our <strong>Andaman Bliss</strong> representative will welcome you and assist with a comfortable transfer to your hotel.</li>
                                <li>After check-in and some rest, begin your Andaman journey with a visit to the historic <a href="https://andamanbliss.com/islands/port-blair/cellular-jail" target="_blank">Cellular Jail</a>.</li>
                                <li>In the evening, attend the famous Light & Sound Show.</li>
                                <li>Overnight stay in Port Blair.</li>
                                </ul>

                                <ul class="packages-list-style">
                                <p><strong>Day 2: Port Blair | Ross Island & North Bay Island</strong></p>
                                <li>After breakfast, transfer to Aberdeen Jetty to board a boat to <a href="https://andamanbliss.com/islands/port-blair/ross-island" target="_blank">Ross Island</a>.</li>
                                <li>Explore the colonial ruins and spot friendly deer and peacocks.</li>
                                <li>Later, visit <a href="https://andamanbliss.com/islands/port-blair/north-bay-island" target="_blank">North Bay Island</a>,
                                famous for coral reefs and exciting water sports activities.</li>
                                <li>Overnight stay in Port Blair.</li>
                                </ul>

                                <ul class="packages-list-style">
                                <p><strong>Day 3: Port Blair to Havelock Island | Radhanagar Beach</strong></p>
                                <li>After breakfast, take a private ferry to <a href="https://andamanbliss.com/islands/havelock-swaraj-dweep" target="_blank">Havelock Island</a>.</li>
                                <li>On arrival, check in to your hotel and relax.</li>
                                <li>In the afternoon, visit the world-famous <a href="https://andamanbliss.com/islands/havelock-swaraj-dweep/radhanagar-beach" target="_blank">Radhanagar Beach</a>, known for its white sands and breathtaking sunset views.</li>
                                <li>Overnight stay in Havelock Island.</li>
                                </ul>

                                <ul class="packages-list-style">
                                <p><strong>Day 4: Havelock Island | Elephant Beach & Water Sports</strong></p>
                                <li>Enjoy breakfast and head to <a href="https://andamanbliss.com/islands/havelock-swaraj-dweep/elephant-beach" target="_blank">Elephant Beach</a>, one of the best spots for water sports activities like scuba diving, snorkeling, and glass bottom boat rides.</li>
                                <li>These activities are safe and beginner-friendly.</li>
                                <li>Overnight stay in Havelock Island.</li>
                                </ul>

                                <ul class="packages-list-style">
                                <p><strong>Day 5: Havelock to Port Blair | Kalapathar Beach</strong></p>
                                <li>Wake up early to enjoy a peaceful sunrise and stunning coastal views.</li>
                                <li>Later, board a ferry back to Port Blair.</li>
                                <li>On arrival, check in to your hotel and enjoy the evening at leisure, ideal for shopping and relaxation.</li>
                                <li>Overnight stay in Port Blair.</li>
                                </ul>

                                <ul class="packages-list-style">
                                <p><strong>Day 6: Departure from Port Blair</strong></p>
                                <li>After breakfast, check out from your hotel and transfer to Port Blair Airport.</li>
                                <li>Depart with beautiful and unforgettable memories of the Andaman Islands.</li>
                                </ul>
                        
                            <h3 class="fs-6 fw-bold mt-3">How Many Days Are Sufficient for an Andaman Tour Package</h3>
                            <ul class="packages-list-style">
                                <li><strong>5 - 7 Days:</strong> Explore Port Blair, Havelock, and Neil Island</li>
                                <li><strong>7 - 10 Days:</strong> Add Baratang, Rangat, and Long Island to your itinerary</li>
                            </ul>

                        <div class="row mt-3">
                            <div class="col-md-6">
                                <h3 class="fs-6 fw-bold">Inclusion:</h3>
                                <ul class="packages-list-style">
                                    <li>Luxury accommodation in beachside resorts</li>
                                    <li>Complimentary breakfast with local delicacies</li>
                                    <li>Air-conditioned transportation for all transfers</li>
                                    <li>Guided tour to major attractions</li>
                                    <li>Airport pick-up & drop</li>
                                    <li>All inter-island ferry transfers</li>
                                    <li>Complimentary adventure activities</li>
                                </ul>

                            </div>
                            <div class="col-md-6">
                                <h3 class="fs-6 fw-bold">Exclusion:</h3>
                                <ul class="packages-list-style">
                                    <li>Airfare to / from Port Blair</li>
                                    <li>Any kind of personal expenses</li>
                                    <li>Travel insurance or any other kind of insurance</li>
                                    <li>Alcoholic beverages</li>
                                    <li>Activities not mentioned in the package</li>
                                    <li>Meals other than those specified in the package</li>
                                </ul>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section  -->
<section class="faq-section section-padding">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <div class="faq-header mb-5">
                    <h2 class="section-title-h2 text-center">Frequently Asked <span> Questions</span></h2>
                    <p class="faq-subtitle">Everything you need to know about planning your trip to Andaman Islands From Guwahati</p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="faq-item" id="faq1">
                    <div class="faq-question" data-bs-toggle="collapse" data-bs-target="#faqAnswer1"
                        aria-expanded="false">
                        <div class="faq-icon">
                            <i class="fas fa-route"></i>
                        </div>
                        <h3>Which is the best island to visit Andaman from Guwahati?</h3>
                        <div class="faq-toggle">
                            <i class="fas fa-plus"></i>
                            <i class="fas fa-minus"></i>
                        </div>
                    </div>
                    <div class="faq-answer collapse show" id="faqAnswer1" style="">
                        <p>Havelock Island is considered as one of the best choices for most of the travelers from Guwahati. Havelock Island is famous for its beautiful beaches, clean blue water and green forest. You can also take part in many water sports activities and swimming, snorkeling and beach walks are very popular here. But if you prefer a more quiet and peaceful place, Neil Island is just perfect for you. It offers more peaceful beaches, rock formations and shallow water that makes it ideal for families and senior travelers.</p>
                    </div>
                </div>
                <div class="faq-item" id="faq2">
                    <div class="faq-question" data-bs-toggle="collapse" data-bs-target="#faqAnswer2"
                        aria-expanded="false">
                        <div class="faq-icon">
                            <i class="fas fa-map-marked-alt"></i>
                        </div>
                        <h3>Do I need to carry a passport to visit Andaman from Guwahati?</h3>
                        <div class="faq-toggle">
                            <i class="fas fa-plus"></i>
                            <i class="fas fa-minus"></i>
                        </div>
                    </div>
                    <div class="collapse faq-answer" id="faqAnswer2">
                        <p>No, Indian travelers are not required to carry a passport to visit the Andaman Islands from Guwahati. You are only required to carry a valid government issued ID card such as Aadhaar card, PAN card or Voter ID card as it may be needed at the time of hotel and airport check ins.</p>
                    </div>
                </div>
                <div class="faq-item" id="faq3">
                    <div class="faq-question" data-bs-toggle="collapse" data-bs-target="#faqAnswer3"
                        aria-expanded="false">
                        <div class="faq-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <h3>What is the best time to plan a trip from Guwahati to Andaman?</h3>
                        <div class="faq-toggle">
                            <i class="fas fa-plus"></i>
                            <i class="fas fa-minus"></i>
                        </div>
                    </div>
                    <div class="collapse faq-answer" id="faqAnswer3">
                        <p>The best time to visit Andaman Islands from Guwahati is from October to May. During these months, the weather is very pleasant, calm sea conditions and ferry services run very smoothly. This duration is perfect for sightseeing, beach activities and water sports activities.</p>
                    </div>
                </div>
                <div class="faq-item" id="faq5">
                    <div class="faq-question" data-bs-toggle="collapse" data-bs-target="#faqAnswer5"
                        aria-expanded="false">
                        <div class="faq-icon">
                            <i class="fas fa-mobile-alt"></i>
                        </div>
                        <h3>Are there any cultural differences between Assam and Andaman?</h3>
                        <div class="faq-toggle">
                            <i class="fas fa-plus"></i>
                            <i class="fas fa-minus"></i>
                        </div>
                    </div>
                    <div class="collapse faq-answer" id="faqAnswer5">
                        <p>Yes, there are few cultural differences that are quite interesting. Assam has a river based culture whereas Andaman Islands is closely connected to seas and oceans. Fishing, seafood based food and coastal traditions are quite common in Andaman.</p>
                    </div>
                </div>
                <div class="faq-item" id="faq6">
                    <div class="faq-question" data-bs-toggle="collapse" data-bs-target="#faqAnswer6"
                        aria-expanded="false">
                        <div class="faq-icon">
                            <i class="fas fa-hotel"></i>
                        </div>
                        <h3>Which islands are usually included in Andaman tour packages from Guwahati?</h3>
                        <div class="faq-toggle">
                            <i class="fas fa-plus"></i>
                            <i class="fas fa-minus"></i>
                        </div>
                    </div>
                    <div class="collapse faq-answer" id="faqAnswer6">
                        <p>Most of our Andaman Bliss tour packages from Guwahati include places like Port Blair, Havelock Island, Neil Islands, North Bay Island and Ross Island. These are the islands that together offer a complete Andaman experience.</p>
                    </div>
                    
                </div>
            </div>
            <div class="col-lg-6">
                <div class="faq-item" id="faq4">
                    <div class="faq-question" data-bs-toggle="collapse" data-bs-target="#faqAnswer4"
                        aria-expanded="false">
                        <div class="faq-icon">
                            <i class="fas fa-car"></i>
                        </div>
                        <h3>Can I visit historical places during the Andaman tour?</h3>
                        <div class="faq-toggle">
                            <i class="fas fa-plus"></i>
                            <i class="fas fa-minus"></i>
                        </div>
                    </div>
                    <div class="collapse faq-answer" id="faqAnswer4">
                        <p>Yes, Andaman Islands has few historical attractions. The most common and famous historical attraction is the Cellular Jail in Port Blair, where you can explore the museums, galleries and can learn more about the India freedom struggles. Ross Island on the other hand is another historical site with old British buildings, churches and friendly deers and peacocks.</p>
                    </div>
                </div>
                <div class="faq-item" id="faq7">
                    <div class="faq-question" data-bs-toggle="collapse" data-bs-target="#faqAnswer7"
                        aria-expanded="false">
                        <div class="faq-icon">
                            <i class="fas fa-hotel"></i>
                        </div>
                        <h3>Is vegetarian food available in the Andaman Islands?</h3>
                        <div class="faq-toggle">
                            <i class="fas fa-plus"></i>
                            <i class="fas fa-minus"></i>
                        </div>
                    </div>
                    <div class="collapse faq-answer" id="faqAnswer7">
                        <p>Yes, vegetarian foods are easily available in the Andaman Islands. Hotels and restaurants in Port Blair, Havelock Island and Neil Island offer a variety of vegetarian meals.</p>
                    </div>
                </div>
                <div class="faq-item" id="faq8">
                    <div class="faq-question" data-bs-toggle="collapse" data-bs-target="#faqAnswer8"
                        aria-expanded="false">
                        <div class="faq-icon">
                            <i class="fas fa-hotel"></i>
                        </div>
                        <h3>Is this Andaman trip suitable for children from Guwahati?</h3>
                        <div class="faq-toggle">
                            <i class="fas fa-plus"></i>
                            <i class="fas fa-minus"></i>
                        </div>
                    </div>
                    <div class="collapse faq-answer" id="faqAnswer8">
                        <p>Yes, Andaman Islands offer a great learning experience for children. You can take your children to marine park, glass bottom boat ride and learn more about coral reefs and sea life. Nature walks, beach activities and museums make the Andaman trip both fun and educational for kids.</p>
                    </div>
                </div>
                <div class="faq-item" id="faq9">
                    <div class="faq-question" data-bs-toggle="collapse" data-bs-target="#faqAnswer9"
                        aria-expanded="false">
                        <div class="faq-icon">
                            <i class="fas fa-hotel"></i>
                        </div>
                        <h3>Are Andaman packages suitable for senior travelers from Guwahati?</h3>
                        <div class="faq-toggle">
                            <i class="fas fa-plus"></i>
                            <i class="fas fa-minus"></i>
                        </div>
                    </div>
                    <div class="collapse faq-answer" id="faqAnswer9">
                        <p>Yes, Andaman Bliss design packages that are comfortable for senior citizens. We provide comfortable hotels with safe and easy ferry transfers. We customize the package as per your preferences and travel style.</p>
                    </div>
                </div>
                <div class="faq-item" id="faq10">
                    <div class="faq-question" data-bs-toggle="collapse" data-bs-target="#faqAnswer10"
                        aria-expanded="false">
                        <div class="faq-icon">
                            <i class="fas fa-hotel"></i>
                        </div>
                        <h3>How many days are enough for a Guwahati to Andaman trip?</h3>
                        <div class="faq-toggle">
                            <i class="fas fa-plus"></i>
                            <i class="fas fa-minus"></i>
                        </div>
                    </div>
                    <div class="collapse faq-answer" id="faqAnswer10">
                        <p>A 6 to 7 day trip is best to explore the Andaman Islands comfortably. This duration allows you to explore Port Blair, Havelock Island and Neil Island with ease and without any hurry. If you want a more extended tour, then you can add more destinations like Baratang Islands, Jolly Buoy Island or museums.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Attractions section removed as requested -->

<!-- Testimonials Section -->
<section class="section-padding" style="background: #f8f9fa;">
    <div class="container">
        <div class="testi-header">
            <div class="section-title-h2">What Our <span>Customers Say</span></div>
            <div class="testi-subtitle">Real experiences from real travelers</div>
        </div>
        <div class="testimonials-carousel">
            @foreach($reviews as $review)
        <div class="t-card p-3">
                <div class="t-row">
                    <div class="stars">
                    @for ($i = 0; $i < 5; $i++)
                        @if ($i < $review->rating)
                            <i class="fas fa-star filled-star"></i>
                        @else
                            <i class="fas fa-star empty-star"></i>
                        @endif  
                    @endfor  
                    </div>
                    <div class="verified-pill"><i class="fas fa-check-circle"></i> Google</div>
                </div>
                <div class="t-excerpt">{{ Str::limit($review['comment'],150) }}</div>
                <div class="t-meta"><span>{{$review['reviewer_name']}},</span><span>{{ \Carbon\carbon::parse($review['review_date'])->format('M Y') }}</span></div>
            </div>
           @endforeach
        </div>
    </div>
</section>

<!-- CTA removed to keep testimonials as the last section -->


@endsection