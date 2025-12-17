@extends('layouts.app')
@section('title', 'Students Educational Trip To Andaman Islands')
@section('keywords', 'Students Trip To Andaman Islands, students tour to Andaman, School Trip To Andaman, College Trip To Andaman, School Group Tour To Andaman, Historical Trip To Andaman, Educational Trip on A Budget, School Trip On A Budget, Student Educational Trip To Andaman')
@section('description', 'Book a Students Educational Trip To Andaman Islands get to experince history in real time, get mesmerised by the colonial ruins & history of Andaman')
@push('styles')
<!-- Chennai specific CSS -->
<!-- <link rel="stylesheet" href="{{ asset('site/css/chennai.css') }}"> -->
<style>
/* Andaman Honeymoon Packages Styles */
.chennai-hero {
    background: radial-gradient(circle at center, rgb(25, 133, 197) 0%, rgb(17, 157, 213) 100%);
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
    padding: 18px 20px;
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

/* Gallery Styles */
.gallery-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
    margin-bottom: 40px;
}

.gallery-item {
    position: relative;
    overflow: hidden;
    border-radius: 15px;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
    height: 280px;
}

.gallery-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
}

.gallery-image-container {
    position: relative;
    width: 100%;
    height: 100%;
    overflow: hidden;
}

.gallery-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.gallery-item:hover .gallery-image {
    transform: scale(1.1);
}

.gallery-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(45deg, rgba(23, 162, 184, 0.9), rgba(253, 126, 20, 0.9));
    opacity: 0;
    transition: opacity 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
}

.gallery-item:hover .gallery-overlay {
    opacity: 1;
}

.gallery-content {
    text-align: center;
    color: white;
    padding: 20px;
}

.gallery-content h4 {
    font-size: 1.5rem;
    font-weight: 700;
    margin-bottom: 10px;
    color: white;
}

.gallery-content p {
    font-size: 1rem;
    margin-bottom: 20px;
    opacity: 0.9;
}

.gallery-lightbox {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 50px;
    height: 50px;
    background: rgba(255, 255, 255, 0.2);
    color: white;
    border-radius: 50%;
    font-size: 1.5rem;
    text-decoration: none;
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
    border: 2px solid rgba(255, 255, 255, 0.3);
}

.gallery-lightbox:hover {
    background: rgba(255, 255, 255, 0.3);
    color: white;
    transform: scale(1.1);
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
    background: rgba(0, 0, 0, 0.9);
    justify-content: center;
    align-items: center;
}

.lightbox.active {
    display: flex;
}

.lightbox-content {
    position: relative;
    max-width: 90%;
    max-height: 90%;
    animation: lightboxZoom 0.3s ease;
}

.lightbox-image {
    width: 100%;
    height: auto;
    max-height: 80vh;
    object-fit: contain;
    border-radius: 10px;
}

.lightbox-close {
    position: absolute;
    top: -40px;
    right: 0;
    color: white;
    font-size: 2rem;
    cursor: pointer;
    transition: color 0.3s ease;
}

.lightbox-close:hover {
    color: #fd7e14;
}

.lightbox-nav {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    color: white;
    font-size: 2rem;
    cursor: pointer;
    transition: color 0.3s ease;
    background: rgba(0, 0, 0, 0.5);
    padding: 10px 15px;
    border-radius: 50%;
}

.lightbox-nav:hover {
    color: #fd7e14;
    background: rgba(0, 0, 0, 0.7);
}

.lightbox-prev {
    left: -60px;
}

.lightbox-next {
    right: -60px;
}

.lightbox-caption {
    position: absolute;
    bottom: -50px;
    left: 0;
    right: 0;
    color: white;
    text-align: center;
    font-size: 1rem;
    background: rgba(0, 0, 0, 0.7);
    padding: 10px;
    border-radius: 5px;
}

@keyframes lightboxZoom {
    from {
        transform: scale(0.8);
        opacity: 0;
    }
    to {
        transform: scale(1);
        opacity: 1;
    }
}

/* Responsive Gallery */
@media (max-width: 768px) {
    .gallery-grid {
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 15px;
    }

    .gallery-item {
        height: 220px;
    }

    .gallery-content h4 {
        font-size: 1.2rem;
    }

    .gallery-content p {
        font-size: 0.9rem;
    }

    .lightbox-nav {
        font-size: 1.5rem;
        padding: 8px 12px;
    }

    .lightbox-prev {
        left: -50px;
    }

    .lightbox-next {
        right: -50px;
    }
}

@media (max-width: 576px) {
    .gallery-grid {
        grid-template-columns: 1fr;
    }

    .gallery-item {
        height: 200px;
    }

    .lightbox-nav {
        position: fixed;
        top: 50%;
    }

    .lightbox-prev {
        left: 20px;
    }

    .lightbox-next {
        right: 20px;
    }

    .lightbox-close {
        top: 20px;
        right: 20px;
        position: fixed;
    }

    .lightbox-caption {
        position: fixed;
        bottom: 20px;
        left: 20px;
        right: 20px;
    }
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

    // Lightbox Functionality
    var currentImageIndex = 0;
    var images = [];
    
    // Create lightbox HTML if it doesn't exist
    if ($('#lightbox').length === 0) {
        $('body').append(`
            <div id="lightbox" class="lightbox">
                <div class="lightbox-content">
                    <span class="lightbox-close">&times;</span>
                    <span class="lightbox-nav lightbox-prev">&#10094;</span>
                    <span class="lightbox-nav lightbox-next">&#10095;</span>
                    <img class="lightbox-image" src="" alt="">
                    <div class="lightbox-caption"></div>
                </div>
            </div>
        `);
    }
    
    // Collect all gallery images
    function updateImagesList() {
        images = [];
        $('.gallery-item:visible .gallery-lightbox').each(function(index) {
            images.push({
                src: $(this).attr('href'),
                title: $(this).data('title') || '',
                index: index
            });
        });
    }
    
    // Open lightbox
    $('.gallery-lightbox').on('click', function(e) {
        e.preventDefault();
        updateImagesList();
        
        var clickedSrc = $(this).attr('href');
        currentImageIndex = images.findIndex(img => img.src === clickedSrc);
        
        if (currentImageIndex === -1) currentImageIndex = 0;
        
        showLightboxImage();
        $('#lightbox').addClass('active');
        $('body').css('overflow', 'hidden');
    });
    
    // Show image in lightbox
    function showLightboxImage() {
        if (images.length > 0 && images[currentImageIndex]) {
            $('#lightbox .lightbox-image').attr('src', images[currentImageIndex].src);
            $('#lightbox .lightbox-caption').text(images[currentImageIndex].title);
        }
    }
    
    // Close lightbox
    $('#lightbox .lightbox-close, #lightbox').on('click', function(e) {
        if (e.target === this) {
            $('#lightbox').removeClass('active');
            $('body').css('overflow', 'auto');
        }
    });
    
    // Prevent closing when clicking on image or navigation
    $('#lightbox .lightbox-content').on('click', function(e) {
        e.stopPropagation();
    });
    
    // Next image
    $('#lightbox .lightbox-next').on('click', function() {
        currentImageIndex = (currentImageIndex + 1) % images.length;
        showLightboxImage();
    });
    
    // Previous image
    $('#lightbox .lightbox-prev').on('click', function() {
        currentImageIndex = (currentImageIndex - 1 + images.length) % images.length;
        showLightboxImage();
    });
    
    // Keyboard navigation
    $(document).on('keydown', function(e) {
        if ($('#lightbox').hasClass('active')) {
            if (e.key === 'ArrowRight') {
                $('#lightbox .lightbox-next').click();
            } else if (e.key === 'ArrowLeft') {
                $('#lightbox .lightbox-prev').click();
            } else if (e.key === 'Escape') {
                $('#lightbox .lightbox-close').click();
            }
        }
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
                    <div class="hero-badge">Educational Tour</div>
                    <h1 class="hero-title">
                         <span class="highlight">Explore Andaman</span> With A Students Educational Trip To Andaman<br>
                       
                    </h1>
                    <p class="hero-subtitle">
                    Get to experience the horrific past of the Andaman Islands with a Students Educational Trip To Andaman Islands, Travel to the past by experiencing the history in first handget to experince history in real time.</p>
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

<!-- Introduction Section -->
<section class="section-padding" style="background: #f8f9fa;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="intro-content"
                    style="background: white; padding: 30px 40px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
                    <h2
                        style="color: #333; font-size: 1.5rem; font-weight: 600; margin-bottom: 15px; line-height: 1.4;">
                       Educational Trip To Andaman | <span style="color: #fd7e14;">Travel To The Past</span>
                    </h2>
                    <p style="color: #666; font-size: 0.95rem; line-height: 1.6; margin-bottom: 15px; text-align:justify">
                    The beautiful Andaman and Nicobar Islands is not just a normal place this island is filled with undiscovered beautiful beaches, bluish waters and thick green forests, The Andaman Islands are just a living classroom filled with lessons like history, culture, diversity and many more. It is a real world learning opportunity waiting for students to learn something new. A <strong>Student Tour To Andaman</strong> is not just any normal vacation, it opens up a world of vast learning opportunities.
                    </p>
                    <a href="#" id="readMoreToggle" class="read-more-toggle">Read More</a>

                    <div id="readMoreContent" class="read-more-content">
                        <p style="color: #666; font-size: 0.95rem; line-height: 1.6; margin-bottom: 15px; text-align:justify">At Andaman Bliss, know that students are the bright future who are just blooming to serve our New India, keeping that in mind we have designed this trip in such a way that every young mind that visits Andaman will be curious, inspired and motivated, this trip provides students with a knowledge about things they would not learn inside four walls of a classroom.</p>
                        <p style="color: #666; font-size: 0.95rem; line-height: 1.6; margin-bottom: 15px; text-align:justify">An <strong>Educational Trip To Andaman Islands</strong> lets the students connect to the things that they read in their school books, this trip makes that into a reality and gives students a real-life experience. Visit the iconic <a href="/islands/port-blair/cellular-jail">Cellular Jail</a> and learn about the struggles and tough times faced by the freedom fighters and also travel back to the past with the amazing Light and Sound Show, this show literally tells you stories about the past and struggle with just the use of <a href="/activities/light-sound-show">lights and sound</a>, The <strong>Cellular Jail</strong> stands tall as the background for this show.</p>

                        <p style="color: #666; font-size: 0.95rem; line-height: 1.6; margin-bottom: 15px; text-align:justify">This <strong>Educational Trip To Andaman</strong> also gives the students an opportunity to visit the <a href="/islands/port-blair/museums">Anthropological Museum</a> that displaces all indigenous tribes of the Andaman Islands, every site that you visit adds a deeper meaning to their understanding of history, society and culture, all this visit lets to get closer and have a deeper connection. For students who are interested in science, they get the chance to explore the vibrant and beautiful coral reefs and the marine life at Samudrika Naval Marine Museum also get the chance to visit the nature’s geological marvel such as <a href="/islands/baratang/lime-stone-caves">Limestone Cave</a> and <a href="/islands/baratang/mud-volcano">Mud Volcanoes</a> at <a href="/islands/baratang">Baratang</a>, which becomes an invaluable hands on learning experience.</p>
                        <p style="color: #666; font-size: 0.95rem; line-height: 1.6; margin-bottom: 15px; text-align:justify">A <strong>Students Educational Trip To Andaman Islands</strong> is an important aspect in every student's life as it served as a colonial hub during the British era. They will get to see the ruins, a historical cellular jail and get to experience the struggle and horror faced by the freedom fighters. This <strong>Educational Tour To Andaman Islands</strong> brings on critical thinking, a strong teamwork, extreme cultural awareness and environmental responsibility. Whether it is a <strong>School Trip To Andaman</strong> or a <strong>College Trip To Andaman</strong>, such trips give students an opportunity to understand and observe the concepts of history, ecology and sociology in its pure form.</p>

                        <h6 style="color: #17a2b8; font-weight: 600; margin-bottom: 15px;">About Educational Trip To Andaman:</h6>
                        <p style="color: #666; line-height: 1.7; margin-bottom: 20px; text-align:justify">An <strong>Educational Trip To Andaman</strong> is more than just an ordinary journey, it is a complete mix of history, culture and explores the beautiful nature and environment of the Andaman Islands. This tour is carefully designed for students as this lets them step out of the four walls of the classroom and indulge themselves in real world experiences.The Andaman Islands is a unique destination where textbooks come alive through monuments, ruins, museums and natural wonders.</p>

                        <p style="color: #666; line-height: 1.7; margin-bottom: 20px; text-align:justify">A <strong>School Trip To Andaman Islands</strong> is the opportunity to explore the infamous <strong>Cellular Jail</strong>, a monument that tells the story of India’s freedom fighters and their sacrifices. This iconic site transforms mere history lessons into a real life experience with the past, which makes it a highlight of any <strong>Historical Trip To Andaman</strong>. In the same way you get to visit <strong>Ross Island</strong> which was renamed to <strong>(Netaji Subhash Chandra Bose Island)</strong>, this island gives you a glimpse of colonial era ruins and the lavish lifestyle of the British administrators who were posted there.</p>

                        <p style="color: #666; line-height: 1.7; margin-bottom: 20px; text-align:justify">Other than history, the Andaman Islands offers a fascinating journey into nature and science. A visit to <strong>Samudrika Naval Marine Museum</strong> or the <strong>Science Centre</strong> in Port Blair keeps the students engaged with marine biodiversity, oceanography, astronomy and environmental conservation. Trips to Baratang Islands lime stone caves and a fascinating mangrove creeks allows students to experience knowledge first hand, A short stop at Chidiyatapu introduces students to a new perspective to take in the nature and environment you can participate in trekking and also <strong>Bird Watching</strong>.</p>

                        <p style="color: #666; line-height: 1.7; margin-bottom: 20px; text-align:justify">What really makes a <strong>Students Education Trip To Andaman</strong> special is the balance between education and enjoyment. Alongside visiting historic and cultural sites, students do get time to participate in water activities, group activities and a memorable day out on the beautiful beaches of Andaman Islands. This makes sure that a <strong>School Trip To Andaman</strong> is not only completely educational but also enjoyable and also memorable.</p>

                        <p style="color: #666; line-height: 1.7; margin-bottom: 20px; text-align:justify">Now this is where Andaman Bliss comes in, we are your trusted travel partner, we do specialize in creating a safe and well planned budget-friendly educational trip. For organizations looking for <strong>School Trip On A Budget</strong> or a <strong>College Trip To Andaman</strong>.</p>

                        <ul style="color: #666; line-height: 1.7; margin-bottom: 20px;">
                            <li><strong>A Complete Planning:</strong> We handle everything from ferry tickets, accommodation, transportation and all entry tickets.</li>
                            <li><strong>Customized Educational Itineraries:</strong> We provide you a customizable schedule that balances everything from museum tours, historical site visits and also water activities.</li>
                            <li><strong>Experienced Guides:</strong> Bright and knowledgeable local guides who can explain all the cultural, historical and scientific importance of each site.</li>
                            <li><strong>Safety & Coordination Of Groups:</strong> Dedicated tour coordinators and 24/7 customer support that make sure that each and every student during the trip are safe and sound.</li>
                            <li><strong>A Budget Friendly Packages:</strong> Special offer without compromising on quality for organizations looking for an <strong>Educational Trip On A Budget.</strong></li>
                            <li><strong>Interactive Learning:</strong> A coordinated session, group activities, visit to the historical sites and museums to make the experience more engaging.</li>
                        </ul>
                        <p style="color: #666; line-height: 1.7; margin-bottom: 20px; text-align:justify">Colleges also find value in organizing a <strong>College Trip To Andaman</strong> as we provide students with an opportunity to dive deeper into sociology, anthropology and political and shocking history of Andaman Islands. With Andaman Bliss maintaining the logistics, the institution can completely focus on the educational value of the trip. Andaman Bliss will make sure that all the students will be safe and secure and also enjoy to the fullest on their <strong>Educational Trip To Andaman Islands.</strong></p>

                        <h6 style="color: #17a2b8; font-weight: 600; margin-bottom: 15px;">Inclusions:</h6>
                        <ul style="color: #666; line-height: 1.7; margin-bottom: 20px;">
                            <li>Accommodations will be taken care of according to the preferences.</li>
                            <li>Complementary breakfast will be provided till you stay</li>
                            <li>All transportation will be taken care off.</li>
                            <li>A guided trip at the Cellular Jail.</li>
                            <li>A complete guided trek.</li>
                            <li>Ferry Tickets will be provided.</li>
                            <li>Pick-up & Drop from all locations including Airport.</li>
                            <li>All entry tickets, ferry tickets and permits will be taken care off.</li>
                        </ul>

                        <h6 style="color: #17a2b8; font-weight: 600; margin-bottom: 15px;">Exclusion:</h6>
                        <ul style="color: #666; line-height: 1.7; margin-bottom: 20px;">
                            <li>Airfare / flight tickets will not be included.</li>
                            <li>Any sort of personal expenses will not be included.</li>
                            <li>Travel insurance or any other kind of insurance</li>
                            <li>Meals that are not included in the package.</li>
                            <li>Any kind of alcohol or beverages.</li>
                            <li>Extra days will not be included in the package, extra days will be charged.</li>
                            <li>Costs that might occur due to some reasons that are beyond our control.</li>
                            <li>Medical expenses if occurred will not be covered.</li>
                        </ul>
                        <h6 style="color: #17a2b8; font-weight: 600; margin-bottom: 15px;">Best Time to Visit:</h6>
                        <p style="color: #666; line-height: 1.7; margin-bottom: 20px; text-align:justify">Planning a right season is really important to have a successful <strong>Students Educational Trip To Andaman Islands</strong>. The island has a tropical climate, which literally means that the weather conditions can vary time to time across the year. The best time to visit for students to have a best <strong>Educational Trip To Andaman</strong> is from October to May, when the climate is really pleasant and the seas are calm and this is the time when students can take part in educational and adventure activities as well.</p>

                        <p style="color: #666; line-height: 1.7; margin-bottom: 20px; text-align:justify">Seasons in Andaman Islands can be described as:</p>

                        <p style="color: #666; line-height: 1.7; margin-bottom: 0; text-align:justify"><strong>October to February:</strong> This season is considered to be cool and pleasant weather.</p>
                        <ul style="color: #666; line-height: 1.7; margin-bottom: 20px; text-align:justify">
                            <li>This season is perfect for sightseeing, have geological learning sessions and also students can take part in water activities and other activities as well.</li>
                            <li>Around this time the Andaman Islands experiences comfortable temperatures (which is under 28 deg celsius), which makes it perfect for a school trip or a <strong>college trip to Andaman Islands.</strong></li>
                            <li>Museums, Cellular Jail and other historical marvels can be explored without any kind of discomfort of heat.</li>
                            <li>This is the best time for institutions to plan a <strong>School Group Trip To Andaman</strong> or a <strong>Historical Trip To Andaman.</strong></li>
                        </ul>

                        <p style="color: #666; line-height: 1.7; margin-bottom: 0; text-align:justify"><strong>March to May:</strong> This season is considered to be warm and pleasant, and many people visit Andaman Islands during this period.</p>
                        <ul style="color: #666; line-height: 1.7; margin-bottom: 20px; text-align:justify">
                            <li>Warm and sunny days are perfect for marine exploration and also to participate in water activities and other activities like island hopping, museum exploration and trekking.</li>
                            <li>This season is perfect for combining education with adventure, which makes it suitable for both a <strong>Students Educational Trip To Andaman</strong> or if you are an institution planning a <strong>School Trip On A Budget</strong> this would be a perfect time for that.</li>
                            <li>At this period of time you will get to explore the marine kingdom which will be well suitable for students who are eager to study about biology and marine environment.</li>
                        </ul>

                        <p style="color: #666; line-height: 1.7; margin-bottom: 0; text-align:justify"><strong>June to September:</strong> This season is considered to be a monsoon season and it is not advised to take a trip to the islands during these months.</p>
                        <ul style="color: #666; line-height: 1.7; margin-bottom: 20px; text-align:justify">
                            <li>During these months the Andaman Islands experiences heavy rainfall and choppy seas and bad weather conditions that can stop you from exploring the Andaman Islands to the fullest extent.</li>
                            <li>These months are not ideal for a <strong>School Trip To Andaman</strong> as some of the activities may get cancelled and students might lose the opportunity to learn.</li>
                            <li>However, during this season you would get a huge discount if you are an institution planning an <strong>Educational Trip On A Budget.</strong></li>
                        </ul>
                        <h6 style="color: #17a2b8; font-weight: 600; margin-bottom: 15px;">Few Memorable Moments:</h6>
                        <p style="color: #666; line-height: 1.7; margin-bottom: 15px; text-align:justify">An Educational Trip To Andaman is not just only about learning about history and culture, it is also about creating lifelong memories through a unique experience. Students here can engage in activities that can strengthen their friendship, stronger connection and also lets them explore the natural wonders of this beautiful island. Some of the most memorable moments that students can experience at this trip includes:</p>
                        
                        <p style="color: #666; line-height: 1.7; margin-bottom: 0; text-align:justify"><strong>Beach Clean-Up Activities:</strong></p>
                        <ul style="color: #666; line-height: 1.7; margin-bottom: 20px; text-align:justify">
                            <li>Students can participate in an eco-friendly activity like cleaning beaches as it might increase bonding between the students.</li>
                            <li>This helps them to understand the importance of responsibility for the environment, team work and also sustainability.</li>
                            <li>This is a perfect combination of fun, productivity and bonding between students in a <strong>Educational Trip To Andaman</strong></li>
                        </ul>
                        <p style="color: #666; line-height: 1.7; margin-bottom: 0; text-align:justify"><strong>Explore The Mangrove Forests:</strong></p>
                        <ul style="color: #666; line-height: 1.7; margin-bottom: 20px; text-align:justify">
                            <li>A boat ride through the dense mangrove creeks at the Baratang Islands does offer students an amazing experience.</li>
                            <li>Students learn about the ecological role of the mangroves in protecting the coastlines and supporting the biodiversity of the islands.</li>
                            <li>An unforgettable and a natural classroom experience a student can have at their <strong>Educational Trip To Andaman.</strong></li>
                        </ul>
                        <p style="color: #666; line-height: 1.7; margin-bottom: 0; text-align:justify"><strong>Encounter Marine Environment With Snorkeling & Scuba Diving:</strong></p>
                        <ul style="color: #666; line-height: 1.7; margin-bottom: 20px; text-align:justify">
                            <li>Getting a close look of the magnificent coral reefs, exotic fishes and other underwater creatures is definitely an amazing and wonderful experience.</li>
                            <li>This is perfect for students who are biology majors, as it gives them practical insights into the marine kingdom.</li>
                            <li>Even beginners and people who cannot swim can take part in guided snorkeling and scuba diving sessions.</li>
                        </ul>

                        <p style="color: #666; line-height: 1.7; margin-bottom: 0; text-align:justify"><strong>Trekking Through The Jungle Of Andaman:</strong></p>
                        <ul style="color: #666; line-height: 1.7; margin-bottom: 20px; text-align:justify">
                            <li>Students can trek through the tropical jungle of the Andaman Islands and they even get to learn about flora, fauna and also learn about survival skills.</li>
                            <li>Can participate in activities like trekking at Mount Harriet or a trek to the Limestone caves at Baratang also encourage physical fitness and team spirit.</li>
                            <li>This will be a perfect and thrilling memory for students who come on an <strong>Educational Trip To Andaman.</strong></li>
                        </ul>

                        <p style="color: #666; line-height: 1.7; margin-bottom: 0; text-align:justify"><strong>Participate In Water Sports Activities:</strong></p>
                        <ul style="color: #666; line-height: 1.7; margin-bottom: 20px; text-align:justify">
                            <li>The Andaman Islands are famous for various water based activities like <a href="/activities/jet-ski">Jet Ski</a>, <a href="/activities/parasailing">Parasailing</a>, <a href="/activities/kayaking">Kayaking</a>, <a href="/activities/sea-walk">Sea Walking</a>, Banana Boat Rides and many other <a href="https://andamanbliss.com/activities/">water activities</a>.</li>
                            <li>These water sports activities add excitement and thrill to the trip and also creates a bonding between students.</li>
                            <li>A balance of education and adventure does make a <strong>School Trip To Andaman Islands</strong> a truly enjoyable and memorable experience.</li>
                        </ul>

                        <p style="color: #666; line-height: 1.7; margin-bottom: 0; text-align:justify"><strong>Get To Witness Turtle Hatching (Seasonal):</strong></p>
                        <ul style="color: #666; line-height: 1.7; margin-bottom: 20px; text-align:justify">
                            <li>With proper planning, students can witness olive ridley turtles nesting and hatching on certain beaches like Diglipur.</li>
                            <li>This rare sight connects the students directly with the natural environment of the Andaman Islands.</li>
                            <li>This is a once in a lifetime experience for a Historical Trip To Andaman combined with ecological learning.</li>
                        </ul>

                        <p style="color: #666; line-height: 1.7; margin-bottom: 0; text-align:justify"><strong>Witness The Geological Marvel: </strong></p>
                        <p style="color: #666; line-height: 1.7; margin-bottom: 0; text-align:justify">Get To witness the beautiful and magnificent Limestone Caves and Mud Volcano</p>
                        <ul style="color: #666; line-height: 1.7; margin-bottom: 20px; text-align:justify">
                            <li>Explore the majestic and natural marvel of Baratang Islands, the Limestone Caves and Mud Volcanoes are the highlights of an <strong>Educational Trip To The Andaman Islands</strong>.</li>
                            <li>Students get to observe the geological processes that they usually only get to read it about in the textbooks.</li>
                            <li>This adds hands-on experience to their science education during a <strong>School Trip On A Budget</strong>.</li>
                        </ul>

                        <h6 style="color: #17a2b8; font-weight: 600; margin-bottom: 15px;">Few Places To See In Andaman Islands:</h6>
                        <p style="color: #666; line-height: 1.7; margin-bottom: 0; text-align:justify">A <strong>Historical Trip To Andaman</strong> is packed with iconic landmarks and natural wonders that combines both learning and adventure. Each of these destinations adds a unique experience to an <strong>Educational Trip To Andaman</strong>, this makes the entire trip both memorable and educational.</p>
                        <p style="color: #666; line-height: 1.7; margin-bottom: 15px; text-align:justify">Here are list of few places that students must visit:</p>
                        <p style="color: #666; line-height: 1.7; margin-bottom: 5px; text-align:justify"><strong>Cellular Jail:</strong></p> 
                        
                        <p style="color: #666; line-height: 1.7; margin-bottom: 5px; text-align:justify">Cellular Jail is also known as Kala Pani, this prison which is now a historical monument which was once used by the British to exile our <strong>Freedom Fighters</strong>. Students can witness the hardships faced by revolutionaries, this brings a historical session to life. Cellular Jail also conducts a Light & Sound Show that takes you to the past with just the use of light and sound, showing you the struggle and horrors faced by our freedom fighters. Cellular Jail is a centrepiece and major attraction of any Students Educational Trip To Andaman and it is a must visit for a <strong>School Trip To Andaman</strong>.</p>
                        <p style="color: #666; line-height: 1.7; margin-bottom: 5px; text-align:justify"><strong>Ross Island:</strong></p>
                        <p style="color: #666; line-height: 1.7; margin-bottom: 5px; text-align:justify">Ross Islands which was recently renamed to <strong>Netaji Subhash Chandra Bose Island</strong> once served as a British Administrative Headquarters, which is now a fascinating open museum of colonial ruins. All the buildings in the Ross Islands are overgrown with trees and the decaying colonial buildings tell the story of British life in the Andaman Islands.</p>
                        <p style="color: #666; line-height: 1.7; margin-bottom: 5px; text-align:justify">This is perfect for institutions looking for a Historical Trip To Andaman, giving students a chance to study about colonial history in real time.</p>

                        <p style="color: #666; line-height: 1.7; margin-bottom: 5px; text-align:justify"><strong>North Bay Island:</strong></p>
                        <p style="color: #666; line-height: 1.7; margin-bottom: 5px; text-align:justify">North Bay Island is a hub for water sports activity, this beautiful island located in Port Blair <strong>(Sri Vijaya Puram)</strong> is known for its beautiful beach and vibrant and colorful coral reefs and a perfect setting to admire the marine life underwater. This place is perfect for introducing students to marine life through activities like Snorkeling, Glass Bottom Boat Ride and Scuba Diving. A visit to this island is a perfect mix of both fun and learning during a <strong>School Group Trip To Andaman</strong>.</p>

                        <p style="color: #666; line-height: 1.7; margin-bottom: 5px; text-align:justify"><strong>Chidiyatapu Beach:</strong></p>
                        <p style="color: #666; line-height: 1.7; margin-bottom: 5px; text-align:justify">This beach is a perfect place to watch the beautiful sunset at the Andaman Islands. <strong>Chidiyatapu Beach</strong> also known as bird island which is a home for various species of birds and plantation, this is perfect for bird watching. Students can learn a lot about the biodiversity and locality of this beautiful island. The sunset view here is astonishing, it adds a highlight to a <strong>School Trip To Andaman</strong>.</p>

                        <p style="color: #666; line-height: 1.7; margin-bottom: 5px; text-align:justify"><strong>Baratang Island:</strong></p>
                        <p style="color: #666; line-height: 1.7; margin-bottom: 5px; text-align:justify"></strong>Baratang Island is known for its limestone caves, Mangrove Creeks and Mud Volcanoes, all these nature marvels are known world wide. A visit to this island is a free natural science lesson for students visiting this wonderful island. A visit to this island makes a <strong>College Trip To Andaman</strong> or a <strong>School Trip To Andaman</strong> both adventurous and educational.</p>

                        <p style="color: #666; line-height: 1.7; margin-bottom: 5px; text-align:justify"><strong>Anthropological Museum:</strong></p>
                        <p style="color: #666; line-height: 1.7; margin-bottom: 5px; text-align:justify">This place is an option for students to visit on their <strong>Educational Trip To The Andaman Islands</strong>. This place offers insights into the lives and culture of the indigenous tribes of the Andaman Islands.  This is a perfect stop for sociology and anthropology students when they visit the Andaman Islands on a Student Trip.</p>

                        <p style="color: #666; line-height: 1.7; margin-bottom: 5px; text-align:justify"><strong>Samudrika Navel Marine Museum:</strong></p>
                        <p style="color: #666; line-height: 1.7; margin-bottom: 15px; text-align:justify">Like Anthropological Museum this place is also an optional place for you to visit on your <strong>Educational Trip To Andaman Islands</strong>. This museum is run by the Indian Navy, it showcases marine ecosystem, shells, corals and the proper geography of the Andaman Islands. This is a must for students who are interested in marine biology and ecology. This museum adds vast knowledge for students visiting for <strong>Educational Trip To Andaman Islands</strong>.</p>

                        <h6 style="color: #17a2b8; font-weight: 600; margin-bottom: 15px;">Museums and their History:</h6>
                        <p style="color: #666; line-height: 1.7; margin-bottom: 10px; text-align:justify">Museums do play an important role when students visit the Andaman Islands for an Educational Trip. The museums in Andaman Islands are not just for display but a living classroom that narrates the history and bone chilling of the Andaman Islands. A visit to this museum gives students a chance to step into the past and explore the unique environment and ecology of the islands, it also helps the students to connect to the roots of the islands. Here are few list of museums that makes every <strong>students Group Trip To Andaman Islands</strong> a highly meaningful one:</p>
                        
                        <p style="color: #666; line-height: 1.7; margin-bottom: 5px; text-align:justify"><strong>Anthropological Museum:</strong></p>
                        <p style="color: #666; line-height: 1.7; margin-bottom: 5px; text-align:justify">This museum is located in Port Blair, which is established to preserve and showcase the life, culture, traditions and history of the indigenous tribes of the Andaman Islands. Students get a visual representation of rare tribal artifacts, weapons used by them, clothes they wear and sculpture models showcasing everyday life of tribes such as the Jarwa, Sentinelese, Nicobarese and Great Andamanese. These museums reflect on the importance of preserving the tribes traditional and heritage while respecting the privacy and culture of the tribes.</p>

                        <p style="color: #666; line-height: 1.7; margin-bottom: 5px; text-align:justify"><strong>Samudrika Naval Marine Museum (Port Blair):</strong></p>
                        <p style="color: #666; line-height: 1.7; margin-bottom: 5px; text-align:justify">This museum is also located in Port Blair (Sri Vijaya Puram) which is maintained by the Indian Navy, this is a complete treasure for students who are interested in marine life and oceanography. It features a vast collection of corals, seashells, rare fishes and marine organisms along with proper showcasing of geographical formation of the islands. This is perfect for <strong>Students Educational Trip To Andaman</strong>, as it gives real insight into the fragile marine ecosystem and the importance of saving it.</p>

                        <p style="color: #666; line-height: 1.7; margin-bottom: 5px; text-align:justify"><strong>Zoological Survey Museum:</strong></p>
                        <p style="color: #666; line-height: 1.7; margin-bottom: 5px; text-align:justify">This museum is located in Port Blair which is completely dedicated to showcasing the flora and fauna of the beautiful Andaman Islands. Students can explore the preserved specimens of the rare species, insects, reptiles and various rare marine organisms and animals. This museum helps the students to understand the biodiversity and beauty of the Andaman Islands in depth. A visit to this museum adds a great value to a <strong>School Trip To Andaman</strong>, specially for students who are interested in biology and environmental science.</p>

                        <p style="color: #666; line-height: 1.7; margin-bottom: 5px; text-align:justify"><strong>Science Centre:</strong></p>
                        <p style="color: #666; line-height: 1.7; margin-bottom: 5px; text-align:justify">The Science Centre is a fun place for students to go when they visit the Andaman Islands. This is a hub of interactive learning, this place focuses on themes like oceanology, physics and astronomy. This features a fun yet educational exhibit which includes 3D shows, science demonstrations and hands on models. This place is particularly engaging for younger students on a <strong>School Trip On A Budget</strong>, as it combines science, learning filled with entertainment.</p>

                        <p style="color: #666; line-height: 1.7; margin-bottom: 5px; text-align:justify"><strong>Cellular Jail Museum:</strong></p>
                        <p style="color: #666; line-height: 1.7; margin-bottom: 5px; text-align:justify">A Central and a highlight of a <strong>Historical Trip To Andaman</strong>, this museum is located within the infamous Cellular Jail, also known as Kala Pani, which is located in Port Blair. It preserves records, photographs, letters and multiple artifacts that lets the students admire and get more information about the history and get motivated by our freedom fighters and the struggles faced by them.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal removed: replaced with inline Read More content -->

<!-- Image Gallery Section with Lightbox -->
<section id="packages" class="section-padding package-card-inner">
    <div class="container">
        <div class="text-center">
            <h2 class="section-title-h2 text-center">Andaman Honeymoon <span> Gallery</span></h2>
            <p>Explore the beautiful destinations and experiences awaiting you</p>
        </div>
        <div class="gallery-grid">
            <div class="gallery-item" data-category="beaches">
                <div class="gallery-image-container">
                    <img src="https://andamanbliss.com/site/img/scuba-dive-in-india.jpg" alt="Scuba Diving in Andaman" class="gallery-image">
                    <div class="gallery-overlay">
                        <div class="gallery-content">
                            <h4>Scuba Diving Adventure</h4>
                            <p>Explore the underwater world</p>
                            <a href="https://andamanbliss.com/site/img/scuba-dive-in-india.jpg" class="gallery-lightbox" data-lightbox="andaman-gallery" data-title="Scuba Diving Adventure - Explore the underwater world of Andaman">
                                <i class="fas fa-search-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="gallery-item" data-category="beaches">
                <div class="gallery-image-container">
                    <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?q=80&w=1400&auto=format&fit=crop" alt="Pristine Beach" class="gallery-image">
                    <div class="gallery-overlay">
                        <div class="gallery-content">
                            <h4>Pristine Beaches</h4>
                            <p>Crystal clear waters</p>
                            <a href="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?q=80&w=1400&auto=format&fit=crop" class="gallery-lightbox" data-lightbox="andaman-gallery" data-title="Pristine Beaches - Crystal clear waters and white sand">
                                <i class="fas fa-search-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="gallery-item" data-category="islands">
                <div class="gallery-image-container">
                    <img src="https://images.unsplash.com/photo-1559827260-dc66d52bef19?q=80&w=1400&auto=format&fit=crop" alt="Island Paradise" class="gallery-image">
                    <div class="gallery-overlay">
                        <div class="gallery-content">
                            <h4>Island Paradise</h4>
                            <p>Tropical getaway destination</p>
                            <a href="https://images.unsplash.com/photo-1559827260-dc66d52bef19?q=80&w=1400&auto=format&fit=crop" class="gallery-lightbox" data-lightbox="andaman-gallery" data-title="Island Paradise - Your tropical getaway destination">
                                <i class="fas fa-search-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="gallery-item" data-category="sunset">
                <div class="gallery-image-container">
                    <img src="https://images.unsplash.com/photo-1493558103817-58b2924bce98?q=80&w=1400&auto=format&fit=crop" alt="Romantic Sunset" class="gallery-image">
                    <div class="gallery-overlay">
                        <div class="gallery-content">
                            <h4>Romantic Sunset</h4>
                            <p>Perfect honeymoon moments</p>
                            <a href="https://images.unsplash.com/photo-1493558103817-58b2924bce98?q=80&w=1400&auto=format&fit=crop" class="gallery-lightbox" data-lightbox="andaman-gallery" data-title="Romantic Sunset - Perfect honeymoon moments">
                                <i class="fas fa-search-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="gallery-item" data-category="activities">
                <div class="gallery-image-container">
                    <img src="https://images.unsplash.com/photo-1500375592092-40eb2168fd21?q=80&w=1400&auto=format&fit=crop" alt="Water Activities" class="gallery-image">
                    <div class="gallery-overlay">
                        <div class="gallery-content">
                            <h4>Water Adventures</h4>
                            <p>Exciting water sports</p>
                            <a href="https://images.unsplash.com/photo-1500375592092-40eb2168fd21?q=80&w=1400&auto=format&fit=crop" class="gallery-lightbox" data-lightbox="andaman-gallery" data-title="Water Adventures - Exciting water sports and activities">
                                <i class="fas fa-search-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="gallery-item" data-category="beaches">
                <div class="gallery-image-container">
                    <img src="https://images.unsplash.com/photo-1544551763-46a013bb70d5?q=80&w=1400&auto=format&fit=crop" alt="Havelock Beach" class="gallery-image">
                    <div class="gallery-overlay">
                        <div class="gallery-content">
                            <h4>Havelock Beach</h4>
                            <p>Most beautiful beach</p>
                            <a href="https://images.unsplash.com/photo-1544551763-46a013bb70d5?q=80&w=1400&auto=format&fit=crop" class="gallery-lightbox" data-lightbox="andaman-gallery" data-title="Havelock Beach - One of the most beautiful beaches in Asia">
                                <i class="fas fa-search-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="gallery-item" data-category="islands">
                <div class="gallery-image-container">
                    <img src="https://images.unsplash.com/photo-1559827260-dc66d52bef19?q=80&w=1400&auto=format&fit=crop" alt="Neil Island" class="gallery-image">
                    <div class="gallery-overlay">
                        <div class="gallery-content">
                            <h4>Neil Island</h4>
                            <p>Serene island experience</p>
                            <a href="https://images.unsplash.com/photo-1559827260-dc66d52bef19?q=80&w=1400&auto=format&fit=crop" class="gallery-lightbox" data-lightbox="andaman-gallery" data-title="Neil Island - Serene and peaceful island experience">
                                <i class="fas fa-search-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="gallery-item" data-category="activities">
                <div class="gallery-image-container">
                    <img src="https://images.unsplash.com/photo-1583212292454-1fe6229603b7?q=80&w=1400&auto=format&fit=crop" alt="Snorkeling" class="gallery-image">
                    <div class="gallery-overlay">
                        <div class="gallery-content">
                            <h4>Snorkeling</h4>
                            <p>Underwater exploration</p>
                            <a href="https://images.unsplash.com/photo-1583212292454-1fe6229603b7?q=80&w=1400&auto=format&fit=crop" class="gallery-lightbox" data-lightbox="andaman-gallery" data-title="Snorkeling - Discover the underwater marine life">
                                <i class="fas fa-search-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section (redesigned) -->
<section class="faq-section section-padding">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <div class="faq-header mb-5">
                    <h2 class="section-title-h2">Frequently Asked <span>Questions</span></h2>
                    <p class="faq-subtitle">Everything you need to know about planning your Ross and Smith Islands
                        adventure
                    </p>
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
                        <h3>How can I go from Port Blair to thе Ross And Smith In Diglipur?</h3>
                        <div class="faq-toggle">
                            <i class="fas fa-plus"></i>
                            <i class="fas fa-minus"></i>
                        </div>
                    </div>
                    <div class="faq-answer collapse show" id="faqAnswer1" style="">
                        <p>To gеt from Port Blair to thе Ross And Smith Island In Diglipur you havе to travеl by road to
                            Diglipur and thеn a boat ridе from Aеrial Bay Jеtty In Diglipur.</p>
                    </div>
                </div>
                <div class="faq-item" id="faq2">
                    <div class="faq-question" data-bs-toggle="collapse" data-bs-target="#faqAnswer2"
                        aria-expanded="false">
                        <div class="faq-icon">
                            <i class="fas fa-map-marked-alt"></i>
                        </div>
                        <h3>Is it possible for me to spend a night at Ross And Smith Island?</h3>
                        <div class="faq-toggle">
                            <i class="fas fa-plus"></i>
                            <i class="fas fa-minus"></i>
                        </div>
                    </div>
                    <div class="collapse faq-answer" id="faqAnswer2">
                        <p>No, lodging cannot bе providеd on thе twin islands of Ross And Smith Island. Thе majority of
                            tourists spеnd thе night in Diglipur and visit thе islands during thе day.</p>
                    </div>
                </div>
                <div class="faq-item" id="faq3">
                    <div class="faq-question" data-bs-toggle="collapse" data-bs-target="#faqAnswer3"
                        aria-expanded="false">
                        <div class="faq-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <h3>What kinds of things can I do at thе Ross And Smith Island?</h3>
                        <div class="faq-toggle">
                            <i class="fas fa-plus"></i>
                            <i class="fas fa-minus"></i>
                        </div>
                    </div>
                    <div class="collapse faq-answer" id="faqAnswer3">
                        <p>As a tourist you arе ablе to participate in a wide range of activitiеs likе bird watching,
                            swimming, snorkеling and Ross And Smith Beach еxploration.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="faq-item" id="faq5">
                    <div class="faq-question" data-bs-toggle="collapse" data-bs-target="#faqAnswer5"
                        aria-expanded="false">
                        <div class="faq-icon">
                            <i class="fas fa-car"></i>
                        </div>
                        <h3>Is camping pеrmittеd on thе Ross And Smith Island?</h3>
                        <div class="faq-toggle">
                            <i class="fas fa-plus"></i>
                            <i class="fas fa-minus"></i>
                        </div>
                    </div>
                    <div class="collapse faq-answer" id="faqAnswer5">
                        <p>In an attempt for thе prеsеrvation of thе natural еnvironmеnt that includеs Ross And Smith
                            Island and camping is usually not allowеd. It is rеcommеndеd that visitors take day visits
                            and rеturn back to thе accommodation that you takе in Diglipur instеad of staying thе night
                            at thе twin Island.</p>
                    </div>
                </div>
                <div class="faq-item" id="faq6">
                    <div class="faq-question" data-bs-toggle="collapse" data-bs-target="#faqAnswer6"
                        aria-expanded="false">
                        <div class="faq-icon">
                            <i class="fas fa-mobile-alt"></i>
                        </div>
                        <h3>Аrе thеrе specific regulations regarding photography on the Ross And Smith Island?</h3>
                        <div class="faq-toggle">
                            <i class="fas fa-plus"></i>
                            <i class="fas fa-minus"></i>
                        </div>
                    </div>
                    <div class="collapse faq-answer" id="faqAnswer6">
                        <p>Whilе thеrе arеn't any specific regulations rеgarding photography and tourists arе encouraged
                            to usе sensitivity when shooting pictures and particularly in dеlicatе locations.
                            Furthermore, it is also imperative that you adhere to еvеry singlе instructions furnished by
                            local authoritiеs or tour opеrators.</p>
                    </div>
                </div>
                <div class="faq-item" id="faq7">
                    <div class="faq-question" data-bs-toggle="collapse" data-bs-target="#faqAnswer7"
                        aria-expanded="false">
                        <div class="faq-icon">
                            <i class="fas fa-hotel"></i>
                        </div>
                        <h3>Is it possiblе for mе to travеl to Ross And Smith Island and rеturn to Port Blair in thе
                            samе day?</h3>
                        <div class="faq-toggle">
                            <i class="fas fa-plus"></i>
                            <i class="fas fa-minus"></i>
                        </div>
                    </div>
                    <div class="collapse faq-answer" id="faqAnswer7">
                        <p>Although it is fеasiblе to go from Port Blair to Ross And Smith Island In Diglipur in a samе
                            day and it еntails a lеngthy road and boat trip. To completely explore and takе in thе
                            bеauty and charms of thе islands and it is advisеd to book a stay of at lеast a fеw days in
                            Diglipur.</p>
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
            <div class="t-card">
                <div class="t-row">
                    <div class="stars">★★★★★</div>
                    <div class="verified-pill"><i class="fas fa-check-circle"></i> Verified</div>
                </div>
                <div class="t-title">Very Good and experience</div>
                <div class="t-excerpt">Very Good and experience</div>
                <div class="t-meta"><span>customer,</span><span>June 12</span></div>
            </div>
            <div class="t-card">
                <div class="t-row">
                    <div class="stars">★★★★★</div>
                    <div class="verified-pill"><i class="fas fa-check-circle"></i> Verified</div>
                </div>
                <div class="t-title">Big Deals on AirTickets</div>
                <div class="t-excerpt">Very good offers on air tickets on last minute bookings</div>
                <div class="t-meta"><span>Saktha Krishnaan,</span><span>June 12</span></div>
            </div>
            <div class="t-card">
                <div class="t-row">
                    <div class="stars">★★★★★</div>
                    <div class="verified-pill"><i class="fas fa-check-circle"></i> Verified</div>
                </div>
                <div class="t-title">Amazing Support</div>
                <div class="t-excerpt">Found a great deal and super fast confirmation. Highly recommended!</div>
                <div class="t-meta"><span>Rajesh Kumar,</span><span>June 10</span></div>
            </div>
            <div class="t-card">
                <div class="t-row">
                    <div class="stars">★★★★★</div>
                    <div class="verified-pill"><i class="fas fa-check-circle"></i> Verified</div>
                </div>
                <div class="t-title">Smooth Booking</div>
                <div class="t-excerpt">Quick booking flow and friendly assistance throughout the trip.</div>
                <div class="t-meta"><span>Anita D.,</span><span>June 8</span></div>
            </div>
        </div>
    </div>
</section>

<!-- CTA removed to keep testimonials as the last section -->


@endsection