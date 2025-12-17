@extends('layouts.app')
@section('title', 'Andaman Tour Package from Pune for Family, Honeymoon & Group')
@section('keywords', 'Andaman trip from Pune, Andaman tour packages, Best Andaman tour packages from Pune, Andaman Family Package from Pune, Andaman Honeymoon Package from Pune.')
@section('description', 'Find the perfect Andaman and Nicobar Islands tour package from Pune with up to 20% off. Andaman Bliss offers customized itineraries for couples, families & groups.')
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
                        Affordable Andaman Tour Package from Pune<span class="highlight">| Best Deals & Offers</span>                     
                    </h1>
                    <p class="hero-subtitle">
                      Discover one of the unforgettable vacation with Andaman Bliss. Our affordable Andaman tour package from Pune offers a perfect mix of relaxation, adventure and historical sites that are suitable for all age groups. Book your dream holiday now!</p>
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
            <h2 class="section-title-h2 text-center">Andaman Tour <span> Packages from Pune</span></h2>
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
                       Best Andaman Tour Packages from Pune<span style="color: #fd7e14;"> | Beaches, Adventure & Seamless Travel</span> 
                    </h2>
                    <div>
                        <h2 class="fw-bold fs-6">Summary</h2>
                        <p style="color: #666; font-size: 0.95rem; line-height: 1.6; margin-bottom: 15px; text-align:justify">
                      If you are planning for an <strong>Andaman trip from Pune</strong>, with <strong>Andaman Bliss</strong> it becomes easier and effortless because we offer customized <strong><a href="https://andamanbliss.com/andaman-tour-packages" target="_blank">Andaman tour packages</a></strong> that are suitable for families, couples, groups and adventure lovers. We provide beachside accommodation, sightseeing tour, smooth ferry transfers, 24x7 customer support so that your vacation becomes completely hassle free. If you are choosing our <strong>Andaman tour package</strong>,you will get the chance to explore all the top attractions like cellular Jail, Radhanagar Beach, Elephant Beach, Neil Island and Ross & North Bay Island and you can enjoy many water sports activities, sunsets and nature experience. The cost of an <strong>Andaman tour package from Pune</strong> starts around INR 18,000 to 25,000 for budget travelers, INR 28,000 to 40,000 for standard package and INR 50,000 and above for luxury packages. Whether you are planning for a honeymoon vacation, family fun or adventure trip, then <strong>Andaman Bliss</strong> will make sure to make your vacation an unforgettable one.
                    </p>
                    </div>
                    <a href="#" id="readMoreToggle" class="read-more-toggle">Read More</a>
                    <div id="readMoreContent" class="read-more-content">
                        <h3 class="fs-6 mt-3 fw-bold">Best Andaman Tour Package from Pune | Beaches, Adventure & Sightseeing
                        </h3>
                        <p style="color: #666; font-size: 0.95rem; line-height: 1.6; margin-bottom: 15px; text-align:justify">The two things that will make your Andaman vacation from Pune truly unforgettable are the breathtaking natural beauty of the islands and the rich history and cultural heritage they hold. Plan your next Andaman vacation with <strong>Andaman Bliss</strong>, which is one of the top leading travel agencies in the Andaman Islands and get exciting deals and offers. Book the <strong>Best Andaman tour packages from Pune</strong> online and indulge yourself in the charming beauty of the <strong>Andaman and Nicobar Islands</strong>. Imagine crystal clear water with soft white sandy beaches, which is a sight that turns every travelers dreams into reality.</p>
                        
                        <p>Our <strong>tour package from Pune to Andaman</strong> is designed to give you an unforgettable and hassle free experience. You will be enjoying comfortable stays at top hotels, seamless airport transfers,  meals as per your package and 24x7 customer support with <strong>Andaman Bliss</strong>. You can explore, relax and make memories that will last for a lifetime.</p>

                        <h3 class="fs-6 fw-bold mt-2">Why Choose Andaman Bliss for your Next Vacation?</h3>
                        <ul class="packages-list-style mb-3">
                            <li><strong>We offer well planned itinerary:</strong></li>
                            <p>We completely understand that every travelers wants are different from each other. That is why, our Andaman tour package includes a perfect mix of relaxation, adventure and sightseeing, so that you can enjoy your trip.</p>
                            <li><strong>Local Expertise & Personal Service:</strong></li>
                            <p>Our Andaman Bliss team will take care of everything like airport pickup, hotel booking, ferry transfers, sightseeing tours and water activities.</p>
                            <li><strong>Packages for Everyone:</strong></li>
                            <p>Our Andaman tour package is perfect for every type of traveler like couples, families and group tours. We customize your Andaman tour package as your requirement.</p>
                            <li><strong>Clear Pricing:</strong></li>
                            <p>Your Andaman tour package will include hotel booking, airport transfers, inter island tours, sightseeing tours and complimentary breakfast and snorkeling. For more details, you can visit our go through the inclusion section. Flight tickets are not included in our package.</p>
                            <li><strong>24x7 Customer Support:</strong></li>
                            <p>Our team will always be available to guide you throughout your entire Andaman tour.</p>
                        </ul>
                       
                        <h3 class="fs-6 fw-bold">How to Reach Andaman from Pune</h3>
                        <p>There are no direct flights from Pune to Port Blair, traveling is very easy with connecting flights through major cities like Chennai, Bangalore, Hyderabad or Kolkata. Depending on your layover, the total journey usually takes around 6 to 8 hours. The popular flight routes include:</p>
                        <ul class="packages-list-style">
                           <p>Pune - Chennai - Port Blair</p>
                           <p>Pune - Bangalore - Port Blair</p>
                           <vr>
                            <p>While flight tickets are not included in our packages, we will provide you complete guidance to help you choose the best options. Once you land in Port Blair, we will take care of everything, right from airport pickup to inter island transfers, comfortable accommodation and major sightseeing tour that will ensure a smooth and stress free beginning of your Andaman journey.</p>
                        </ul>
                        
                        <h3 class="fs-6 fw-bold mt-3">Best Time to Visit Andaman from Pune</h3>
                        <p>It is very important to choose the best time to visit the Andaman Islands. Here are the guidance of the best time you can travel to Andaman Islands from Pune:</p>
                        <ul class="packages-list-style">
                            <p><strong>October to February - Peak Season</strong></p>
                            <ul class="styled_li">
                                <li>Weather: Cool, dry and refreshing</li>
                                <li>Ideal for: This season is ideal for sightseeing tours, beach walks, snorkeling and honeymoon trips.</li>
                                <li>Highlights: Radhanagar Beach, Cellular Jail and Elephant Beach.</li>
                            </ul>
                        </ul>
                        <ul class="packages-list-style">
                            <p><strong>March to May - Warm & Great for Water Sports</strong></p>
                            <ul class="styled_li">
                                <li>Weather: The weather is sunny with calm seas.</li>
                                <li>Ideal for: Scuba diving, jet skiing and island hopping.</li>
                                <li>Highlights: Glass bottom boat rides, snorkeling and adventures water activities.</li>
                            </ul>
                        </ul>

                        <ul class="packages-list-style">
                            <p><strong>June to September - Monsoon Season</strong></p>
                            <ul class="styled_li">
                                <li>Weather: Heavy rain, high humidity and rough sea.</li>
                                <li>Best for: This season is best for offbeat travelers who are looking for some discounted rated and indoor relaxation.</li>
                            </ul>
                        </ul>

                        <h3 class="fs-6 fw-bold mt-3">Best Places to Visit in Andaman Tour Package</h3>
                        
                       <ul class="packages-list-style">
                        <p><strong>Port Blair:</strong></p>
                        <li><a href="https://andamanbliss.com/islands/port-blair/cellular-jail" target="_blank">Cellular Jail</a>: Explore the historic Cellular Jail and learn about Indias freedom struggle. Enjoy the famous Light & Sound Show in the evening.</li>
                        <li><a href="https://andamanbliss.com/islands/port-blair/corbyns-cove" target="_blank">Corbyn Cove Beach</a>: This beach is one of the best spots for having a relaxing walk, beach views and beautiful sunsets.</li>
                        <li><a href="https://andamanbliss.com/islands/port-blair/ross-island" target="_blank">Ross Island</a>: Explore the old british building, greenery islands and friendly deers.</li>
                        <li><a href="https://andamanbliss.com/islands/port-blair/north-bay-island" target="_blank">North Bay Island</a>: One of the perfect locations for water sports activities like snorkeling, scuba diving and glass bottom boat rides.</li>
                        </ul>

                        <ul class="packages-list-style">
                        <p><strong>Havelock Island:</strong></p>
                        <li><a href="https://andamanbliss.com/islands/havelock-swaraj-dweep/radhanagar-beach" target="_blank">Radhanagar Beach</a>: This is one of the best beaches in Asia and its known for its romantic sunsets and peaceful walks.</li>
                        <li><a href="https://andamanbliss.com/islands/havelock-swaraj-dweep/elephant-beach" target="_blank">Elephant Beach</a>: This beach is best for water sports activities like snorkeling, scuba diving, jet skiing and banana boat rides.</li>
                        <li><a href="https://andamanbliss.com/islands/havelock-swaraj-dweep/kalapathar-beach" target="_blank">Kalapathar Beach</a>: Perfect for watching sunrise.</li>
                        </ul>

                        <ul class="packages-list-style">
                        <p><strong>Neil Island:</strong></p>
                        <li><a href="https://andamanbliss.com/islands/neil-shaheed-dweep/laxmanpur-beach" target="_blank">Laxmanpur Beach</a>: This beach is calm, clean and less crowded which is great for relaxing.</li>
                        <li><a href="https://andamanbliss.com/islands/neil-shaheed-dweep/natural-rock" target="_blank">Natural Bridge</a>: A unique rock structure that is created naturally over millions of years.</li>
                        <li><a href="https://andamanbliss.com/islands/neil-shaheed-dweep/bharatpur-beach" target="_blank">Bharatpur Beach</a>: This beach offers shallow and clear water that are perfect for swimming.</li>
                        </ul>

                        <ul class="packages-list-style">
                        <p><strong>Baratang Island:</strong></p>
                        <li><a href="https://andamanbliss.com/islands/baratang/lime-stone-caves" target="_blank">Limestone Caves</a> & <a href="https://andamanbliss.com/islands/baratang/mud-volcano" target="_blank">Mud Volcano</a>: You can reach this spot by taking a beautiful mangrove boat ride.</li>
                        <li><a href="https://andamanbliss.com/islands/baratang/parrot-island" target="_blank">Parrot Island</a>: You will get the chance to watch thousands of parrots flying at sunset.</li>
                        </ul>

                        <ul class="packages-list-style">
                        <p><strong>Long Island & Diglipur:</strong></p>
                        <li><a href="https://andamanbliss.com/islands/long-island" target="_blank">Long Island</a>: You can enjoy nature walks, camping and explore the untouched beaches.</li>
                        <li><a href="https://andamanbliss.com/islands/diglipur/saddle-peak" target="_blank">Saddle Peak</a> & <a hrf="https://andamanbliss.com/islands/diglipur/ross-and-smith-island" target="_blank">Ross & Smith Islands</a>: Explore the stunning views from the saddle peak and explore the unique beach which is connected by a natural sandbar.</li>
                        </ul>
 
                        <h3 class="fs-6 fw-bold mt-3">Andaman Trip Cost from Pune</h3>
                        
                            <ul class="packages-list-style">
                                <li><strong>Budget Packages:</strong> A budget package may cost you around INR 18,000 to INR 25,000 per person.</li>
                                <li><strong>Standard Packages:</strong> It will cost you around INR 28,000 to INR 40,000 per person.</li>
                                <li><strong>Luxury Packages:</strong> It may vary between INR 50,000 to INR 80,000 or even more.</li>
                            
                                <p>Please note that the prices that I have mentioned above are the cost of only ground arrangements like hotel, ferry transfers and sightseeing, as flight tickets are not included in our packages.</p>
                            </ul>
 
                            <h3 class="fs-6 fw-bold mt-3">Itinerary for Pune to Andaman Tour Package</h3>
                        <ul>
                            <li><strong>Day 1:</strong> Arrive in Port Blair and visit the historical site like <a href="https://andamanbliss.com/islands/port-blair/cellular-jail" target="_blank">Cellular Jail</a> and witness the Light & sound show in the evening.</li>
                            <li><strong>Day 2:</strong> Take a ferry ride to <a href="https://andamanbliss.com/islands/havelock-swaraj-dweep"target="_blank">Havelock island</a> and enjoy the world famous <a href="https://andamanbliss.com/islands/havelock-swaraj-dweep/radhanagar-beach"target="_blank">Radhanagar beach</a>. In the evening, explore Kalapathar beach where you can relax and unwind.</li>
                            <li><strong>Day 3:</strong> On the next day, take a short boat ride to <a href="https://andamanbliss.com/islands/havelock-swaraj-dweep/elephant-beach"target="_blank">Elephant beach</a> and enjoy a variety of water sports activities like scuba diving, snorkeling and glass bottom boat rides.</li>
                            <li><strong>Day 4:</strong> Take a boat ride to <a href="https://andamanbliss.com/islands/neil-shaheed-dweep"target="_blank">Neil island</a> and visit Laxmanpur beach and <a href="https://andamanbliss.com/islands/neil-shaheed-dweep/natural-rock"target="_blank">Natural Bridge</a>. On the same day, visit Bharatpur beach and take part in a variety of water activities.</li>
                            <li><strong>Day 5:</strong> On the fifth day, get back to Port Blair and visit Ross and <a href="https://andamanbliss.com/islands/port-blair/north-bay-island"target="_blank">North bay island</a>. In the evening, visit Chidiyatapu beach and enjoy birdwatching.</li>
                            <li><strong>Day 6:</strong> Visit <a href="https://andamanbliss.com/islands/baratang"target="_blank">Baratang island</a> and explore <a href="https://andamanbliss.com/islands/baratang/lime-stone-caves"target="_blank">Limestone cave</a> and <a href="https://andamanbliss.com/islands/baratang/mud-volcano"target="_blank">Mud volcano</a>.</li>
                            <li><strong>Day 7:</strong> Departure</li>
                        </ul>

                        
                        <h3 class="fs-6 fw-bold mt-3">How Many Days are Sufficient to Explore Andaman Islands</h3>
                        <ul class="packages-list-style">
                            <p><strong>Short Trip (4 - 5 Days)</strong></p>
                            <li>Port Blair: Cellular Jail, Corbyn Cove and water activities.</li>
                            <li>Havelock: Radhanagar Beach and Elephant Beach.</li>
                            <li>Neil Island: Bharatpur Beach, Laxmanpur Beach and Natural Bridge.</li>
                        </ul>

                        <ul class="packages-list-style">
                            <p><strong>Extended Trip (7-10 Days)</strong></p>
                            <p>You can also add on other destinations as well, like:</p>
                            <li>Baratang Island</li>
                            <li>Ross Island</li>
                            <li>North Bay Island</li>
                            <li>Jolly Buoy Island</li>
                            <li>Long Island</li>
                            <li>Diglipur</li>
                        </ul>


                        <h3 class="fs-6 fw-bold mt-3">Top Things to Do in Your Andaman Tour Package</h3>
                        <ul class="packages-list-style">
                            <li><strong>Scuba Diving & Snorkeling</strong>: Explore the colorful corals and fishes up close.</a></li>
                            <li><strong>Island Hopping</strong>: You can visit popular islands like Havelock, Neil, Ross & North Bay Island.</li>
                            <li><strong>Glass Bottom Boat Ride</strong>: This activity is fun and an easy way to enjoy underwater life. This activity is great for families and senior citizens.</li>
                            <li><strong>Sunset Watching</strong>: If you want to watch the sunset then do visit Laxmanpur Beach and Chidiyatapu.</li>
                            <li><strong>Wildlife & Dolphin Watching</strong>: Enjoy nature tours in Baratang, Long Island and Parrot Island.</li>
                            <li><strong>Beach Camping & Trekking</strong>: This activity is perfect for adventure lovers who want to get some unique experience.</li>
                        </ul>

                        <h3 class="fs-6 fw-bold mt-3">Best Andaman Packages for Families, Couples, Group & Adventure Lovers</h3>
                        <p>Are you looking to plan an Andaman trip from Pune but not really sure which type of package will suit you. At Andaman Bliss, we offer a wide range of Andaman tour packages that are suitable for families, honeymoon couples, group tours and adventure seekers. We offer holiday packages that include comfortable stays, guided tours and many exciting <a href="https://andamanbliss.com/activities/" target="_blank">water activities</a> that  will make your Andaman experience more memorable.</p>
                            <p><strong><a href="https://andamanbliss.com/andaman-family-packages" target="_blank">Andaman Family Package from Pune</a></strong></p>
                            <p>Our Andaman family package is specially designed for parents and kids who are looking for a safe and comfortable holiday.</p>
                            <ul class="packages-list-style">
                                <li>Safe and comfortable hotels.</li>
                                <li>Beach activities that are suitable for childrens.</li>
                                <li>Private cab transfers.</li>
                                <li>You can visit top attractions like Cellular Jail, Radhanagar Beach and Ross Island.</li>
                                <li>Water activities that are suitable for all age groups.</li>
                            </ul>
                        </ul>
                            <p><strong><a href="https://andamanbliss.com/andaman-honeymoon-packages" target="_blank">Andaman Honeymoon Package from Pune</a></strong></p>
                            <p>Our Andaman honeymoon packages offer a perfect mix of romance, luxury and privacy. This packages includes:</p>
                            <ul class="packages-list-style">
                                <li>Candlelight dinner.</li>
                                <li>Flower bed decoration.</li>
                                <li>Private beachside stays.</li>
                                <li>Complimentary photoshoot.</li>
                                <li>Visit the most romantic spots like Radhanagar Beach & Laxmanpur Beach for sunset views.</li>
                            </ul>
                        </ul>

                            <p><strong><a href="https://andamanbliss.com/andaman-adventure-packages" target="_blank">Andaman Adventure Packages from Pune</a></strong></p>
                            <p>If you are looking for some thrill and adventure, our Andaman adventure package is perfect for you. The top adventure activities includes:</p>
                            <ul class="packages-list-style">
                                <li>Scuba Diving</li>
                                <li>Snorkeling</li>
                                <li>Jet skiing</li>
                                <li>Sea Walking</li>
                                <li>Parasailing</li>
                                <li>Night Kayaking</li>
                                <li>Banana Boat Rides</li>
                            </ul>

                            <p><strong><a href="https://andamanbliss.com/andaman-group-packages" target="_blank">Andaman Group Packages from Pune</a></strong></p>
                            <p>If you want to travel with your friends, office team or large family groups, our Andaman group packages make sure you have a fun and budget friendly trip. This package includes:</p>
                            <ul class="packages-list-style">
                                <li>Group discount</li>
                                <li>Private AC buses or tempo travellers</li>
                                <li>Customized itineraries</li>
                                <li>Beach games & team activities</li>
                            </ul>

                            <p><strong>Why Choose These Special Andaman Packages?</strong></p>
                            <ul class="packages-list-style">
                                <li>Fully customizable according to the traveler type.</li>
                                <li>Handpicked and comfortable stays.</li>
                                <li>Expert local guidance.</li>
                                <li>Smooth transfers & zero hassle planning.</li>
                                <li>24x7 customer support.</li>
                            
                            <p>Whether you are planning a holiday as a honeymoon, family vacation, group trip or thrilling adventure, then <strong>Andaman Bliss</strong> offers a  perfect package just for you.</p>
                            </ul>
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
                    <p class="faq-subtitle">Everything you need to know about planning your trip to Andaman Islands From Pune</p>
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
                        <h3>How do I travel from Pune to the Andaman Islands?</h3>
                        <div class="faq-toggle">
                            <i class="fas fa-plus"></i>
                            <i class="fas fa-minus"></i>
                        </div>
                    </div>
                    <div class="faq-answer collapse show" id="faqAnswer1" style="">
                        <p>There are no direct flights from Pune to Port Blair. Most travelers connect through major cities like Chennai, Bangalore, Hyderabad or Kolkata. Once you reach any of these destinations, you can fly directly to Port Blair, which is the entry point to Andaman island. We will help guide you on the best flight routes even though flights are not included in the package.</p>
                    </div>
                </div>
                <div class="faq-item" id="faq2">
                    <div class="faq-question" data-bs-toggle="collapse" data-bs-target="#faqAnswer2"
                        aria-expanded="false">
                        <div class="faq-icon">
                            <i class="fas fa-map-marked-alt"></i>
                        </div>
                        <h3>Is Andaman a good destination for a family vacation from Pune?</h3>
                        <div class="faq-toggle">
                            <i class="fas fa-plus"></i>
                            <i class="fas fa-minus"></i>
                        </div>
                    </div>
                    <div class="collapse faq-answer" id="faqAnswer2">
                        <p>Absolutely. The Andaman Islands are perfect for families and friends. There are clean beaches, calm waters, historical sites and a variety of fun activities for all age groups. From visiting the Cellular Jail to snorkeling at North Bay, there is something for everyone. Our Andaman tour package from Pune for family is thoughtfully planned that gives safe and enjoyable experiences with family friendly accommodations.</p>
                    </div>
                </div>
                <div class="faq-item" id="faq3">
                    <div class="faq-question" data-bs-toggle="collapse" data-bs-target="#faqAnswer3"
                        aria-expanded="false">
                        <div class="faq-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <h3>Is this package suitable for couples or honeymooners?</h3>
                        <div class="faq-toggle">
                            <i class="fas fa-plus"></i>
                            <i class="fas fa-minus"></i>
                        </div>
                    </div>
                    <div class="collapse faq-answer" id="faqAnswer3">
                        <p>Yes, Andaman island is one of the most romantic destinations in India and our Andaman tour package from Pune for couples includes everything that will make your trip memorable. From scenic beach stays and romantic dinners to private time on beautiful islands like Havelock and Neil. Whether it is your honeymoon or a family vacation, we will help you craft the perfect Andaman vacation.</p>
                    </div>
                </div>
                <div class="faq-item" id="faq5">
                    <div class="faq-question" data-bs-toggle="collapse" data-bs-target="#faqAnswer5"
                        aria-expanded="false">
                        <div class="faq-icon">
                            <i class="fas fa-mobile-alt"></i>
                        </div>
                        <h3>Are flights included in the Andaman tour package?</h3>
                        <div class="faq-toggle">
                            <i class="fas fa-plus"></i>
                            <i class="fas fa-minus"></i>
                        </div>
                    </div>
                    <div class="collapse faq-answer" id="faqAnswer5">
                        <p>No, our Andaman tour package does not include flights from Pune to Port Blair. However, we are happy to assist you in finding the best connecting flights based on your budget and travel dates. Once you arrive in Andaman, everything from airport pickup to inter island transfers and accommodations is handled by our Andaman Bliss team.</p>
                    </div>
                </div>
                <div class="faq-item" id="faq6">
                    <div class="faq-question" data-bs-toggle="collapse" data-bs-target="#faqAnswer6"
                        aria-expanded="false">
                        <div class="faq-icon">
                            <i class="fas fa-hotel"></i>
                        </div>
                        <h3>What places will I visit in the Andaman tour package?</h3>
                        <div class="faq-toggle">
                            <i class="fas fa-plus"></i>
                            <i class="fas fa-minus"></i>
                        </div>
                    </div>
                    <div class="collapse faq-answer" id="faqAnswer6">
                        <p>Our Andaman trip package from Pune offers some of the most spectacular destinations in the islands. You will have historical landmarks to visit in Port Blair, enjoy the pristine beaches such as Radhanagar Beach at Havelock, explore natural wonders at Neil Island, and enjoy adventure tours like snorkeling and sea walking. If you do have the luxury of choosing a longer trip we can take you to destinations like Baratang's limestone caves and Ross Islands.</p>
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
                        <h3>How many days should I plan for a good Andaman trip?</h3>
                        <div class="faq-toggle">
                            <i class="fas fa-plus"></i>
                            <i class="fas fa-minus"></i>
                        </div>
                    </div>
                    <div class="collapse faq-answer" id="faqAnswer4">
                        <p>If you are short on time, 4 to 5 day trip is enough to explore the major destinations like Port Blair, Havelock and Neil island. but if you want a more relaxed trip to see the offbeat places like Baratang or Diglipur, then a 7 to 10 days Andaman trip is perfect. We offer different itineraries based on your preferences, budget and availability.</p>
                    </div>
                </div>
                <div class="faq-item" id="faq7">
                    <div class="faq-question" data-bs-toggle="collapse" data-bs-target="#faqAnswer7"
                        aria-expanded="false">
                        <div class="faq-icon">
                            <i class="fas fa-hotel"></i>
                        </div>
                        <h3>What kind of places can I explore in Andaman Islands?</h3>
                        <div class="faq-toggle">
                            <i class="fas fa-plus"></i>
                            <i class="fas fa-minus"></i>
                        </div>
                    </div>
                    <div class="collapse faq-answer" id="faqAnswer7">
                        <p>Our Andaman trip package from pune includes some of the most stunning locations in the islands. You will get to visit Port Blair historical sites, relax at radhanagar beach in havelock, witness the natural wonders in neil island and enjoy adventure like snorkeling and sea walking. If you choose a longer trip, we can also take you to places like Baratang limestone cave and Ross island.</p>
                    </div>
                </div>
                <div class="faq-item" id="faq8">
                    <div class="faq-question" data-bs-toggle="collapse" data-bs-target="#faqAnswer8"
                        aria-expanded="false">
                        <div class="faq-icon">
                            <i class="fas fa-hotel"></i>
                        </div>
                        <h3>Can I book this trip if I am a solo traveler from Pune?</h3>
                        <div class="faq-toggle">
                            <i class="fas fa-plus"></i>
                            <i class="fas fa-minus"></i>
                        </div>
                    </div>
                    <div class="collapse faq-answer" id="faqAnswer8">
                        <p>Yes. We love solo travelers and aim to make your journey safe, smooth and fun. Andaman is a calm and secure destination. Our commitment to you is providing a hassle-free tour like we handle all the hotel reservations and sightseeing arrangements so that you can enjoy exploring. If you are interested in group tours, you can meet and travel with other travelers.</p>
                    </div>
                </div>
                <div class="faq-item" id="faq9">
                    <div class="faq-question" data-bs-toggle="collapse" data-bs-target="#faqAnswer9"
                        aria-expanded="false">
                        <div class="faq-icon">
                            <i class="fas fa-hotel"></i>
                        </div>
                        <h3>Can I customize the Andaman tour package?</h3>
                        <div class="faq-toggle">
                            <i class="fas fa-plus"></i>
                            <i class="fas fa-minus"></i>
                        </div>
                    </div>
                    <div class="collapse faq-answer" id="faqAnswer9">
                        <p>Absolutely. Each traveler is unique, and we know that. You may want more time on the beach, or more adventure activities or you may want to customize for more down-time, we will customize your itinerary based on your travel style. Just let us know your preference and we will customize.</p>
                    </div>
                </div>
                <div class="faq-item" id="faq10">
                    <div class="faq-question" data-bs-toggle="collapse" data-bs-target="#faqAnswer10"
                        aria-expanded="false">
                        <div class="faq-icon">
                            <i class="fas fa-hotel"></i>
                        </div>
                        <h3>What are the best things to do on this Andaman trip?</h3>
                        <div class="faq-toggle">
                            <i class="fas fa-plus"></i>
                            <i class="fas fa-minus"></i>
                        </div>
                    </div>
                    <div class="collapse faq-answer" id="faqAnswer10">
                        <p>There are plenty of experiences to enjoy like relaxing on breathtaking beaches watching great sunsets, diving, snorkeling, boating to nearby islands. If you have a keen sense of history, the Cellular Jail is worth visiting. Nature lovers will be amazed by the untouched beauty of Baratang or Jolly Buoy Island.</p>
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