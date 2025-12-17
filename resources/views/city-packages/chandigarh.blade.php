@extends('layouts.app')
@section('title', 'Andaman Tour Packages from Chhattisgarh | Chhattisgarh to Andaman Nicobar Trips')
@section('keywords', 'Andaman tour package from Chandigarh, Andaman Honeymoon Package from Chandigarh, Andaman Family Package from Chandigarh, Andaman Budget Package from Chandigarh.')
@section('description', 'Book Andaman Tour Packages from Chhattisgarh with flights, stays, island tours and adventure activities. Explore Port Blair, Havelock and Neil at the best prices.')
<!-- Chennai specific CSS -->
<!-- <link rel="stylesheet" href="{{ asset('site/css/chennai.css') }}"> -->
 @push('scripts')
<style>
/* Andaman Honeymoon Packages Styles */
.chennai-hero {
    background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), /* overlay */ url('../site/img/city-packages/sea-view1.jpg'); /* image */
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
                    <div class="hero-badge">Budget Package</div>
                    <h1 class="hero-title">
                        Andaman Family Tour Package from Chandigarh<span class="highlight">| A Budget Friendly Travel</span>                     
                    </h1>
                    <p class="hero-subtitle">
                      Enjoy an unforgettable vacation with Andaman Bliss. Our budget friendly Andaman tour package from Chandigarh offers beach relaxation, adventure and cultural sites for all age groups. Book your dream vacation now!
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
            <h2 class="section-title-h2 text-center">Andaman Tour <span> Packages from Chandigarh</span></h2>
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
                        Affordable Andaman Tour <span style="color: #fd7e14;">Package from Chandigarh</span> 
                    </h2>
                    <div>
                        <h2 class="fw-bold fs-6">Summary</h2>
                        <p style="color: #666; font-size: 0.95rem; line-height: 1.6; margin-bottom: 15px; text-align:justify">
                      If you are planning an <strong>Andaman tour package from Chandigarh</strong> then here is a quick guide that will help you. Since there are no direct flights, the easiest and the fastest way to reach Andaman island is to take a connecting flight from Delhi, Kolkata or Chennai. The perfect time to visit Andaman island is between <em>October and May</em>. Some of the attractions include <a href="https://andamanbliss.com/islands/port-blair/cellular-jail" target="_blank">Cellular jail</a>, <a href="https://andamanbliss.com/islands/port-blair/ross-island" target="_blank">Ross island</a>, <a href="https://andamanbliss.com/islands/havelock-swaraj-dweep" target="_blank">Radhanagar Beach</a> and <a href="https://andamanbliss.com/islands/havelock-swaraj-dweep/elephant-beach" target="_blank">Elephant beach</a>, Neil island and <a href="https://andamanbliss.com/islands/baratang/lime-stone-caves" target="_blank">Limestone cave</a> in Baratang. On this trip, you can even enjoy a variety of water sports activities like <a href="https://andamanbliss.com/activities/scuba-diving" target="_blank">scuba diving</a>,<a href="https://andamanbliss.com/activities/snorkeling" target="_blank">snorkeling</a> and island hopping as well. With Andaman Bliss, you will get a smooth transfer, comfortable stays, hassle free ferry booking and itineraries that are tailored to your needs and preferences. This package is suitable for every type of traveler, whether it is a honeymooner, families, group, budget seekers and luxury lovers. While flights are not included, we can assist you with the booking process. 
                    </p>
                    </div>
                    <a href="#" id="readMoreToggle" class="read-more-toggle">Read More</a>
                    <div id="readMoreContent" class="read-more-content">
                        <h3 class="fs-6 mt-3 fw-bold">Andaman Tour Package from Chandigarh - A Perfect Escape
                        </h3>
                        <p style="color: #666; font-size: 0.95rem; line-height: 1.6; margin-bottom: 15px; text-align:justify">If you are living in Chandigarh and want to have a  vacation that is filled with crystal clear water, white sandy beaches and exciting adventure activities, then an <strong>Andaman tour package from Chandigarh</strong> is just a perfect destination for you. The Andaman Island is a paradise where you can relax, explore and you can even create memories that will last for a lifetime. Whether you are a couple looking for a romantic escape, a family who want to spend quality time or a group of friends who want to get adventure experiences, then Andaman Island has something for everyone.</p>

                        <h3 class="fs-6 fw-bold mt-2">Why Choose Andaman Bliss?</h3>
                        <ul class="packages-list-style mb-3">
                            <li>Customized Itineraries</li>
                            <li>Handpicked Hotels & Resorts</li>
                            <li>GExperienced Guides and 24x7 Assistance</li>
                            <li>Affordable Pricing with No Hidden Cost</li>
                            <li>Seamless Transfers & Transportation</li>
                            <li>Water Sports & Adventure Activities.</li>
                        </ul>
                       
                        <h3 class="fs-6 fw-bold">How to Reach Andaman Island from Chandigarh</h3>
                        <p>As of now, there are no direct flights, so you can take a connecting flight from Delhi, Kolkata or Chennai to reach Andaman island from Chandigarh.</p>
                        <ul class="packages-list-style">
                           <li><strong>Chandigarh - Delhi - Port Blair</strong></li>
                            <p>This route is most preferable as Delhi operates multiple daily flights to Andaman island.</p>
                        </ul>

                        <ul class="packages-list-style">
                           <li><strong>Chandigarh - Kolkata - Port Blair</strong></li>
                            <p>It is one of the best options as it takes less time to reach Port Blair.</p>
                        </ul>

                        <ul class="packages-list-style">
                           <li><strong>Chandigarh - Chennai - Port Blair</strong></li>
                            <p>It is also one of the convenient option to reach Andaman Island</p>
                        
                         <p>Travel Tips: We recommend you to check Chandigarh to Andaman Nicobar flight price well in advance to get better deals and best airfares.</p>
                        </ul>
                        
                        <h3 class="fs-6 fw-bold mt-3">Best Time To Visit Andaman Island</h3>
                        <ul class="packages-list-style">
                            <li>The best time to visit Andaman & Nicobar Island is between <em>October and May</em>. During these months, the weather is pleasant with calm seas. This time is perfect for sightseeing and water sports activities.</li>
                            <li>AThe monsoon month that starts from <em>June to September</em> is not recommended as it causes heavy rainfall and might affect ferry schedules and water activities. </li>
                        </ul>

                        <h3 class="fs-6 fw-bold mt-3">Best Places to Explore in Andaman Islands</h3>
                        
                       <ul class="packages-list-style">
                             <li><strong><a href="https://andamanbliss.com/islands/port-blair" target="_blank" rel="noopener noreferrer">Port Blair:</a></strong> Cellular Jail, Corbyn’s Cove Beach, Light and Sound Show</li>
                            <li><strong><a href="https://andamanbliss.com/islands/havelock-swaraj-dweep" target="_blank" rel="noopener noreferrer">Havelock</a></strong> Radhanagar Beach, Elephant Beach, Kalapathar Beach</li>
                            <li><strong><a href="https://andamanbliss.com/islands/neil-shaheed-dweep" target="_blank" rel="noopener noreferrer">Neil Island:</a></strong> Laxmanpur Beach, Natural Rock Formation, Bharatpur Beach</li>
                            <li><strong><a href="https://andamanbliss.com/islands/baratang" target="_blank" rel="noopener noreferrer">Baratang Island:</a></strong> Limestone Cave, Mud Volcano, Parrot Island</li>
                            <li><strong><a href="https://andamanbliss.com/islands/port-blair/ross-island" target="_blank" rel="noopener noreferrer">North Bay & Ross Island:</a></strong> Colonial ruins at Ross Island, Water sports at North Bay Island</li>
                        </ul>
 
                        <h3 class="fs-6 fw-bold mt-3">Andaman Tour Package from Chandigarh Price</h3>
                        
                            <ul class="packages-list-style">
                                <li><strong>Budget Packages:</strong> A budget package may cost you around INR 18,000 to INR 25,000 per person.</li>
                                <li><strong>Standard Packages:</strong> It will cost you around INR 28,000 to INR 40,000 per person.</li>
                                <li><strong>Luxury Packages:</strong> It may vary between INR 50,000 to INR 80,000 or even more.</li>
                            
                                <p>Please note that the prices that I have mentioned above are the cost of only ground arrangements like hotel, ferry transfers and sightseeing, as flight tickets are not included in our packages.</p>
                            </ul>
 
                            <h3 class="fs-6 fw-bold mt-3">Sample 6 Nights 7 Days Tour Itinerary </h3>
                        <ul>
                            <li><strong>Day 1:</strong> Arrive in Port Blair and visit the historical site like <a href="https://andamanbliss.com/islands/port-blair/cellular-jail" target="_blank">Cellular Jail</a> and witness the Light & sound show in the evening.</li>
                            <li><strong>Day 2:</strong> Take a ferry ride to <a href="https://andamanbliss.com/islands/havelock-swaraj-dweep"target="_blank">Havelock island</a> and enjoy the world famous <a href="https://andamanbliss.com/islands/havelock-swaraj-dweep/radhanagar-beach"target="_blank">Radhanagar beach</a>. In the evening, explore Kalapathar beach where you can relax and unwind.</li>
                            <li><strong>Day 3:</strong> On the next day, take a short boat ride to <a href="https://andamanbliss.com/islands/havelock-swaraj-dweep/elephant-beach"target="_blank">Elephant beach</a> and enjoy a variety of water sports activities like scuba diving, snorkeling and glass bottom boat rides.</li>
                            <li><strong>Day 4:</strong> Take a boat ride to <a href="https://andamanbliss.com/islands/neil-shaheed-dweep"target="_blank">Neil island</a> and visit Laxmanpur beach and <a href="https://andamanbliss.com/islands/neil-shaheed-dweep/natural-rock"target="_blank">Natural Bridge</a>. On the same day, visit Bharatpur beach and take part in a variety of water activities.</li>
                            <li><strong>Day 5:</strong> On the fifth day, get back to Port Blair and visit Ross and <a href="https://andamanbliss.com/islands/port-blair/north-bay-island"target="_blank">North bay island</a>. In the evening, visit Chidiyatapu beach and enjoy birdwatching.</li>
                            <li><strong>Day 6:</strong> Visit <a href="https://andamanbliss.com/islands/baratang"target="_blank">Baratang island</a> and explore <a href="https://andamanbliss.com/islands/baratang/lime-stone-caves"target="_blank">Limestone cave</a> and <a href="https://andamanbliss.com/islands/baratang/mud-volcano"target="_blank">Mud volcano</a>.</li>
                            <li><strong>Day 7:</strong> Departure</li>
                        </ul>

                        
                        <h3 class="fs-6 fw-bold mt-3">How Many Days Are Sufficient for an Andaman Tour Package</h3>
                        <ul class="packages-list-style">
                            <li><strong>5 - 7 Days:</strong> Explore Port Blair, Havelock, and Neil Island</li>
                            <li><strong>7 - 10 Days:</strong> Add Baratang, Rangat, and Long Island to your itinerary</li>
                        </ul>


                        <h3 class="fs-6 fw-bold mt-3">Things To Do in Your Andaman Trip</h3>
                        <ul class="packages-list-style">
                            <li>Scuba diving and snorkeling in <a href="https://andamanbliss.com/islands/havelock-swaraj-dweep/elephant-beach" target="_blank">Elephant beach.</a></li>
                            <li>A romantic walk at <a href="https://andamanbliss.com/islands/havelock-swaraj-dweep/radhanagar-beach" target="_blank">Radhanagar Beach.</a></li>
                            <li>Thrilling <a href="https://andamanbliss.com/activities/" target="_blank">water activities</a> like jet skiing, sea walking and banana boat rides.</li>
                            <li>Island hopping to Havelock, Neil and Ross island.</li>
                            <li>Enjoy stunning sunsets and relax on quiet beaches of Andaman.</li>
                        </ul>

                        <h3 class="fs-6 fw-bold mt-3">Andaman Tour Package from Chandigarh</h3>
                        <p>The Andaman and Nicobar islands is considered as one of the loved destinations for travelers from Chandigarh. And the best part about these is that this Andaman tour package is suitable for all types of travelers.</p>
                        <ul class="packages-list-style">
                                    <li><strong>Andaman Honeymoon Package from Chandigarh</strong></p>
                                    <p>For newly wed couples, our Andaman honeymoon package from Chandigarh offers both romance and relaxation.</p>

                                    <li><strong>Andaman Family Package from Chandigarh</strong></li>
                                    <p>Our Andaman family tour package from Chandigarh includes comfortable hotels, sightseeing tours and many activities that you can enjoy with your family and kids without any fear.</p>

                                    <li><strong>Andaman Group Package from Chandigarh</strong></li>
                                    <p>Our Andaman group package from Chandigarh is designed for fun and togetherness. These packages usually come with special group discounts on hotels, flights and ferry booking.This package is a perfect choice for student groups, corporate teams or friends who want to experience the Andaman together.</p>

                                    <li><strong>Andaman Budget Package from Chandigarh</strong></li>
                                    <p>If you want to explore Andaman island under budget, then this package will be a good choice. These packages will cover all the famous destinations like Port Blair, Havelock and Neil island without spending too much.</p>

                                    <li><strong>Andaman Luxury Package from Chandigarh</strong></li>
                                    <p>For those travelers who want comfort and luxury, then this package ensures to offer the finest experiences that you will never forget. You will get the chance to stay at a luxury 4 star beach resort, private transfers and sightseeing tours.</p>
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
                    <p class="faq-subtitle">Everything you need to know about planning your trip to Andaman Islands From Chandigarh</p>
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
                        <h3>Can you suggest what is the best time to book our Andaman trip from Chandigarh?</h3>
                        <div class="faq-toggle">
                            <i class="fas fa-plus"></i>
                            <i class="fas fa-minus"></i>
                        </div>
                    </div>
                    <div class="faq-answer collapse show" id="faqAnswer1" style="">
                        <p>The best time to visit the Andaman and Nicobar Islands is between October to May, as during this season the weather is pleasant with low humidity and calm seas. This season is perfect to explore a variety of water activities like snorkeling and scuba diving. We will suggest you to book your Andaman tour package at least 3 to 4 months well in advance to secure your preferred hotels and ferry services as the prices are high during peak season. We suggest you not to plan your trip in the monsoon season that starts from June to September as this is less ideal due to choppy seas and ferry cancellations.</p>
                    </div>
                </div>
                <div class="faq-item" id="faq2">
                    <div class="faq-question" data-bs-toggle="collapse" data-bs-target="#faqAnswer2"
                        aria-expanded="false">
                        <div class="faq-icon">
                            <i class="fas fa-map-marked-alt"></i>
                        </div>
                        <h3>How can I reach Andaman Island from Chandigarh?</h3>
                        <div class="faq-toggle">
                            <i class="fas fa-plus"></i>
                            <i class="fas fa-minus"></i>
                        </div>
                    </div>
                    <div class="collapse faq-answer" id="faqAnswer2">
                        <p>As I have already mentioned it before, there are no direct flights from Chandigarh to the Andaman islands. Travelers generally fly from Chandigarh to Port Blair by taking a connecting flight from major cities like Delhi, Mumbai or Chennai. The total travel time including the layovers may range from 6 to 10 hours depending on the route and airlines you choose. Whereas, you can opt for a sea journey from Kolkata, Chennai or Visakhapatnam to Port Blair which usually takes around 3 to 4 days to reach Andaman islands.</p>
                    </div>
                </div>
                <div class="faq-item" id="faq3">
                    <div class="faq-question" data-bs-toggle="collapse" data-bs-target="#faqAnswer3"
                        aria-expanded="false">
                        <div class="faq-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <h3>What is the average cost of an Andaman tour package from Chandigarh?</h3>
                        <div class="faq-toggle">
                            <i class="fas fa-plus"></i>
                            <i class="fas fa-minus"></i>
                        </div>
                    </div>
                    <div class="collapse faq-answer" id="faqAnswer3">
                        <p>The cost of an Andaman tour package from Chandigarh totally depends on the duration of your trip, the accommodation you choose  and extra inclusions. On an average, the budget package will cost you around INR 18,000 to INR 25,000 per person for a 5 Night 6 Days Andaman tour package. Whereas, a luxury package will cost you around INR 28,000 to INR 40,000 and above per person. You can even customize your package according to your preferences and budget.</p>
                    </div>
                </div>
                <div class="faq-item" id="faq5">
                    <div class="faq-question" data-bs-toggle="collapse" data-bs-target="#faqAnswer5"
                        aria-expanded="false">
                        <div class="faq-icon">
                            <i class="fas fa-mobile-alt"></i>
                        </div>
                        <h3>What are the must visit places included in our Andaman tour package?</h3>
                        <div class="faq-toggle">
                            <i class="fas fa-plus"></i>
                            <i class="fas fa-minus"></i>
                        </div>
                    </div>
                    <div class="collapse faq-answer" id="faqAnswer5">
                        <p>Our Chandigarh to Andaman tour package usually covers all the major destinations like Port Blair, Havelock and Neil island, where you can explore many tourist places like Cellular Jail, Ross island, Radhanagar beach and Elephant beach, Laxmapur and Natural Rock bridge. If you want an extended package, then you will be exploring places like Baratang for Limestone cave and Mud volcano and DIglipur for Ross & Smith island.</p>
                    </div>
                </div>
                <div class="faq-item" id="faq6">
                    <div class="faq-question" data-bs-toggle="collapse" data-bs-target="#faqAnswer6"
                        aria-expanded="false">
                        <div class="faq-icon">
                            <i class="fas fa-hotel"></i>
                        </div>
                        <h3>What are the activities included in our Andaman tour package from Chandigarh?</h3>
                        <div class="faq-toggle">
                            <i class="fas fa-plus"></i>
                            <i class="fas fa-minus"></i>
                        </div>
                    </div>
                    <div class="collapse faq-answer" id="faqAnswer6">
                        <p>Our Andaman tour package from Chandigarh generally includes a mix of  sightseeing and adventure activities. The common attractions that are included in our package are Cellular Jail and Ross islands for historical site, Radhanagar beach and Laxmanpur beach for beach visit and water activities like snorkeling and scuba diving at Elephant beach or North Bay island. Activities and destinations can be customized as per your preferences and budget.</p>
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
                        <h3>Are flight tickets included in our Andaman tour package from Chandigarh?</h3>
                        <div class="faq-toggle">
                            <i class="fas fa-plus"></i>
                            <i class="fas fa-minus"></i>
                        </div>
                    </div>
                    <div class="collapse faq-answer" id="faqAnswer4">
                        <p>Our Andaman trip from Chandigarh does not include flight tickets, as we fully focus on ground arrangements like accommodations, inter island ferry transfers, airport pick up and drop services and sightseeing tours as well. Our Andaman Bliss will help you in the flight booking process so you do not have to worry about anything.</p>
                    </div>
                </div>
                <div class="faq-item" id="faq7">
                    <div class="faq-question" data-bs-toggle="collapse" data-bs-target="#faqAnswer7"
                        aria-expanded="false">
                        <div class="faq-icon">
                            <i class="fas fa-hotel"></i>
                        </div>
                        <h3>Do I need a permit to visit Andaman island from Chandigarh?</h3>
                        <div class="faq-toggle">
                            <i class="fas fa-plus"></i>
                            <i class="fas fa-minus"></i>
                        </div>
                    </div>
                    <div class="collapse faq-answer" id="faqAnswer7">
                        <p>Indian citizens do not require any special permit to visit the Andaman & Nicobar island. But a traveler must carry a government issued ID card like Aadhaar Card or Driving License card as it may be needed at the time of airport and hotel check in and also at the time of sightseeing as well.</p>
                    </div>
                </div>
                <div class="faq-item" id="faq8">
                    <div class="faq-question" data-bs-toggle="collapse" data-bs-target="#faqAnswer8"
                        aria-expanded="false">
                        <div class="faq-icon">
                            <i class="fas fa-hotel"></i>
                        </div>
                        <h3>Can I customize my Andaman tour package?</h3>
                        <div class="faq-toggle">
                            <i class="fas fa-plus"></i>
                            <i class="fas fa-minus"></i>
                        </div>
                    </div>
                    <div class="collapse faq-answer" id="faqAnswer8">
                        <p>Yes, you can customize your Andaman tour package from Chandigarh according to your preferences, budget and durations. You can select the number of days, accommodation type and activities like snorkeling, scuba diving or historical tours as per your choice.</p>
                    </div>
                </div>
                <div class="faq-item" id="faq9">
                    <div class="faq-question" data-bs-toggle="collapse" data-bs-target="#faqAnswer9"
                        aria-expanded="false">
                        <div class="faq-icon">
                            <i class="fas fa-hotel"></i>
                        </div>
                        <h3>Is it safe to travel to the Andaman island from Chandigarh?</h3>
                        <div class="faq-toggle">
                            <i class="fas fa-plus"></i>
                            <i class="fas fa-minus"></i>
                        </div>
                    </div>
                    <div class="collapse faq-answer" id="faqAnswer9">
                        <p>The Andaman island is considered as one of the safest destinations with friendly locals. All the water activities that are operating in Andaman island are done under safety measures by giving life jackets, oxygen tanks and safety instructions. The Andaman islands are very well developed for tourism with reliable transportations like cabs and ferries. However, we advise you to follow all the safety guidelines before participating in water sports activities and avoid restricted tribal areas.</p>
                    </div>
                </div>
                <div class="faq-item" id="faq10">
                    <div class="faq-question" data-bs-toggle="collapse" data-bs-target="#faqAnswer10"
                        aria-expanded="false">
                        <div class="faq-icon">
                            <i class="fas fa-hotel"></i>
                        </div>
                        <h3>How well in advance should I book my Andaman tour package from Chandigarh?</h3>
                        <div class="faq-toggle">
                            <i class="fas fa-plus"></i>
                            <i class="fas fa-minus"></i>
                        </div>
                    </div>
                    <div class="collapse faq-answer" id="faqAnswer10">
                        <p>We recommend you to book your Andaman tour package from Chandigarh at least 3 to 4 months well in advance especially during peak season that starts from October to March. Early booking will also help get the best deals under budget.</p>
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