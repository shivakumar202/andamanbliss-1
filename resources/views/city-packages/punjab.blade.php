@extends('layouts.app')
@section('title', 'Andaman tour packages from Punjab')

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
                    <div class="hero-badge">HONEYMOON EXPERIENCE</div>
                    <h1 class="hero-title">
                        Andaman <span class="highlight">Honeymoon Packages</span><br>
                        – Best Romantic Getaways for Couples
                    </h1>
                    <p class="hero-subtitle">
                        Experience the best romantic getaways in the Andaman Islands with our expertly crafted honeymoon
                        packages—tailored to make your journey as a couple truly unforgettable.
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

<!-- Introduction Section -->
<section class="section-padding" style="background: #f8f9fa;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="intro-content"
                    style="background: white; padding: 30px 40px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
                    <h2
                        style="color: #333; font-size: 1.5rem; font-weight: 600; margin-bottom: 15px; line-height: 1.4;">
                        Andaman Honeymoon Packages | <span style="color: #fd7e14;">Unforgettable Romantic Escapes for
                            Couples</span>
                    </h2>
                    <p style="color: #666; font-size: 0.95rem; line-height: 1.6; margin-bottom: 15px;">
                        Thinking about a romantic honeymoon in the beautiful Andaman Islands? Andaman Bliss has got you
                        covered with different honeymoon packages. Prices start at ₹13,500 for a three-night, four-day
                        trip. If you're looking for something a bit longer, four-night, five-day packages are between
                        ₹19,000 and ₹25,000. These deals are great for couples wanting to make some amazing memories in
                        a lovely place.
                    </p>
                    <a href="#" id="readMoreToggle" class="read-more-toggle">Read More</a>

                    <div id="readMoreContent" class="read-more-content">
                        <h6 style="color: #17a2b8; font-weight: 600; margin-bottom: 15px;">Why Choose Andaman for Your
                            Honeymoon?</h6>
                        <p style="color: #666; line-height: 1.7; margin-bottom: 20px;">The Andaman Islands offer the
                            perfect blend of pristine beaches, crystal-clear waters, and romantic sunsets that create an
                            ideal setting for newlyweds. With over 500 islands, each offering unique experiences,
                            couples can enjoy both adventure and tranquility.</p>
                        <h6 style="color: #17a2b8; font-weight: 600; margin-bottom: 15px;">Package Inclusions:</h6>
                        <ul style="color: #666; line-height: 1.7; margin-bottom: 20px;">
                            <li>Round-trip flights from Chennai to Port Blair</li>
                            <li>Luxury beachfront accommodation with ocean views</li>
                            <li>All inter-island transfers by ferry and speedboat</li>
                            <li>Daily breakfast and select romantic dinners</li>
                            <li>Guided sightseeing tours to major attractions</li>
                            <li>Water sports activities and snorkeling equipment</li>
                            <li>24/7 customer support and local assistance</li>
                        </ul>
                        <h6 style="color: #17a2b8; font-weight: 600; margin-bottom: 15px;">Best Time to Visit:</h6>
                        <p style="color: #666; line-height: 1.7; margin-bottom: 20px;">October to May is the ideal time
                            for honeymoon trips to Andaman. The weather is pleasant with calm seas, perfect for water
                            activities and beach relaxation. Avoid monsoon season (June-September) for the best
                            experience.</p>
                        <h6 style="color: #17a2b8; font-weight: 600; margin-bottom: 15px;">Special Honeymoon
                            Experiences:</h6>
                        <ul style="color: #666; line-height: 1.7; margin-bottom: 0;">
                            <li>Private candlelight dinner on the beach</li>
                            <li>Sunset cruise with champagne service</li>
                            <li>Couple spa treatments with ocean sounds</li>
                            <li>Private photography sessions at scenic locations</li>
                            <li>Romantic beach picnics on secluded islands</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal removed: replaced with inline Read More content -->

<!-- Packages Section - converted to cards -->
<section id="packages" class="section-padding">
    <div class="container">
        <div class="text-center">
            <h2 class="section-title-h2 text-center">Andaman Honeymoon <span> Packages</span></h2>
            <p>Everything you need to know about planning your Ross and Smith Islands adventure</p>
        </div>
        <div class="activity-grid">
            <a class="activity-card" href="/andaman-3-night-honeymoon-package-from-chennai"
                style="background-image:url('https://andamanbliss.com/site/img/scuba-dive-in-india.jpg');">
                <div class="activity-topbar">
                    <div class="time-badge">3 Nights / 4 Days</div>
                    <span class="book-now-pill">Book Now</span>
                </div>
                <div class="activity-content">
                    <div class="activity-price">Starts from: <span>₹35,999</span> <small>/ per couple</small></div>
                    <div class="activity-title">Andaman Honeymoon</div>
                    <div class="activity-subtitle">Port Blair & Havelock</div>
                    <div class="inclusions">Inclusion: Stay, Breakfast, Transfers, Sightseeing</div>
                </div>
            </a>

            <a class="activity-card" href="/andaman-4-night-honeymoon-package-from-chennai"
                style="background-image:url('https://images.unsplash.com/photo-1507525428034-b723cf961d3e?q=80&w=1400&auto=format&fit=crop');">
                <div class="activity-topbar">
                    <div class="time-badge">4 Nights / 5 Days</div>
                    <span class="book-now-pill">Book Now</span>
                </div>
                <div class="activity-content">
                    <div class="activity-price">Starts from: <span>₹42,999</span> <small>/ per couple</small></div>
                    <div class="activity-title">Multi-Island Experience</div>
                    <div class="activity-subtitle">Port Blair + Havelock + Neil</div>
                    <div class="inclusions">Inclusion: Hotels, Breakfast, Ferries, Guided Tours</div>
                </div>
            </a>

            <a class="activity-card" href="/andaman-5-night-honeymoon-package-from-chennai"
                style="background-image:url('https://images.unsplash.com/photo-1526481280698-906943c9a8be?q=80&w=1400&auto=format&fit=crop');">
                <div class="activity-topbar">
                    <div class="time-badge">5 Nights / 6 Days</div>
                    <span class="book-now-pill">Book Now</span>
                </div>
                <div class="activity-content">
                    <div class="activity-price">Starts from: <span>₹52,999</span> <small>/ per couple</small></div>
                    <div class="activity-title">Complete Island Tour</div>
                    <div class="activity-subtitle">Comprehensive Experience</div>
                    <div class="inclusions">Inclusion: Ross, Baratang, Water Sports</div>
                </div>
            </a>

            <a class="activity-card" href="/andaman-6-night-honeymoon-package-from-chennai"
                style="background-image:url('https://images.unsplash.com/photo-1493558103817-58b2924bce98?q=80&w=1400&auto=format&fit=crop');">
                <div class="activity-topbar">
                    <div class="time-badge">6 Nights / 7 Days</div>
                    <span class="book-now-pill">Book Now</span>
                </div>
                <div class="activity-content">
                    <div class="activity-price">Starts from: <span>₹62,999</span> <small>/ per couple</small></div>
                    <div class="activity-title">Premium Adventure</div>
                    <div class="activity-subtitle">Luxury Island Experience</div>
                    <div class="inclusions">Inclusion: Private Cruise, Couple Spa, Sunset</div>
                </div>
            </a>

            <a class="activity-card" href="/andaman-7-night-honeymoon-package-from-chennai"
                style="background-image:url('https://images.unsplash.com/photo-1500375592092-40eb2168fd21?q=80&w=1400&auto=format&fit=crop');">
                <div class="activity-topbar">
                    <div class="time-badge">7 Nights / 8 Days</div>
                    <span class="book-now-pill">Book Now</span>
                </div>
                <div class="activity-content">
                    <div class="activity-price">Starts from: <span>₹75,999</span> <small>/ per couple</small></div>
                    <div class="activity-title">Ultimate Paradise</div>
                    <div class="activity-subtitle">Complete Andaman Exploration</div>
                    <div class="inclusions">Inclusion: All Major Islands, Activities, Transfers</div>
                </div>
            </a>
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