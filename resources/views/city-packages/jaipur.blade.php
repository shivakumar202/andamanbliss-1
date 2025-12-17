@extends('layouts.app')
@section('title', 'Andaman Tour Package from Jaipur | Andaman Bliss')
@section('keywords', 'Andaman Tour Package from Jaipur, Best Travel Agencies in Andaman, How to Reach Andaman Islands from Jaipur, Andaman Honeymoon Package from Jaipur, Andaman Tour Package Cost from Jaipur.')
@section('description', 'Explore the best Andaman tour package from Jaipur with details on itinerary, cost, flights, top islands, water sports, honeymoon options, and travel tips. Plan your perfect Jaipur to Andaman holiday with ease.')
<!-- Chennai specific CSS -->
<!-- <link rel="stylesheet" href="{{ asset('site/css/chennai.css') }}"> -->
@push('styles')
<style>
    /* Andaman Honeymoon Packages Styles */
    .chennai-hero {
        background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),
            /* overlay */
            url('../site/img/city-packages/sunset4.jpg');
        /* image */
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

    .packages-list-style {
        padding: 5px 20px;
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
                        Andaman Tour Package from Jaipur<span class="highlight">| Affordable Andaman Nicobar Trip 
<span>
                    </h1>
                    <p class="hero-subtitle">
                        Explore the best Andaman tour package from Jaipur with hotel, ferries and guided sightseeing. Budget, family & honeymoon packages with top rated local support.</p>
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


<!-- Modal removed: replaced with inline Read More content -->

<!-- Packages Section - converted to cards -->
<section id="packages" class="section-padding">
    <div class="container">
        <div class="text-center">
            <h2 class="section-title-h2 text-center">Andaman Tour <span> Packages From Jaipur</span></h2>
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

<section class="section-padding" style="background: #f8f9fa;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="intro-content"
                    style="background: white; padding: 30px 40px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
                    <h2
                        style="color: #333; font-size: 1.5rem; font-weight: 600; margin-bottom: 15px; line-height: 1.4;">
                        Andaman Tour Packages from Jaipur<span style="color: #fd7e14;"> | Complete Travel Guide, Itinerary & Cost</span>
                    </h2>
                    <div>
                        <h2 class="fw-bold fs-6">Summary</h2>
                        <p style="  font-size: 0.95rem; line-height: 1.6; margin-bottom: 15px; text-align:justify">
                            The Andaman Island is a perfect holiday destination because it offers peaceful beaches, blue water, adventure water sports activities and calm surroundings. This island is perfect for couples, families, groups and budget travelers. Andaman Islands is known for its clean beaches like Radhanagar and Bharatpur beach and offers many exciting water activities like scuba diving, snorkeling, kayaking and sea walking. It is very simple and convenient to reach Andaman Islands from Jaipur, just take a one stop connecting flight from major cities like Delhi, Kolkata, Chennai or Bengaluru. The journey usually takes around six to nine hours. Visit all the top attractions like Cellular Jail, Corbyn cove beach, Ross & North Bay Island, Radhanagar Beach, Elephant Beach, Natural Rock Bridge, Laxmanpur Beach and Baratang. <strong>Andaman Bliss</strong> offers customized packages for all types of travelers from budget to luxury travelers. Packages usually start from INR 12,500 for budget and goes INR 65,000 and above for luxury packages. <strong>Andaman tour package from Jaipur</strong> is perfect for honeymooner and families because Andaman Islands promise to provide peaceful, scenic and unforgettable beach vacation for every Jaipur traveler.
                        </p>
                    </div>
                    <a href="#" id="readMoreToggle" class="read-more-toggle">Read More</a>
                    <div id="readMoreContent" class="read-more-content">

                    <h3 class="fs-6 mt-3 fw-bold">Andaman Tour Package from Jaipur – Your Complete Island Vacation Guide
                        </h3>
                        <p style="color: #666; font-size: 0.95rem; line-height: 1.6; margin-bottom: 15px; text-align:justify">Are you looking for a peaceful holiday away from Jaipur heat and city rush. An <strong>Andaman Tour Package from Jaipur</strong> provide you the perfect mix of scenic beauty, adventure, peace and beautiful beaches. Whether you are looking for a romantic honeymoon vacation, a family holiday, a group tour with your friends or a budget friendly holiday, the Andaman Islands promise to provide you an unforgettable experience that you will cherish forever.</p>

                        <p style="color: #666; font-size: 0.95rem; line-height: 1.6; margin-bottom: 15px; text-align:justify">Andaman Bliss, which is one of the <strong><a href="https://andamanbliss.com/" target="_blank">Best Travel Agencies in Andaman</a></strong> has helped thousands of travelers from Jaipur in designing a hassle free and unforgettable experience through our customized packages.</p>

                        <h3 class="fs-6 fw-bold mt-3">Why Choose Andaman Tour Package from Jaipur?</h3>
                            <p>Andaman Island is one of the most popular and preferred beach destinations in India. That is why Jaipur travelers love visiting the Andaman Islands:</p>

                            <ul class="packages-list-style">
                                <li><strong>Known for Peaceful Beaches & Clear Blue Water:</strong> The islands are home to famous and stunning beaches like Radhanagar and Bharatpur. Perfect for swimming, relaxing, and capturing amazing photographs.</li>

                                <li><strong>Best for Honeymoon Couples:</strong> Couples looking for privacy, romantic beachside resorts, candlelight dinners, and serene beach experiences can choose our Andaman honeymoon package from Jaipur for an unforgettable trip.</li>

                                <li><strong>Safe and Family-Friendly Destination:</strong> Andaman Islands are among the safest destinations in India, making them ideal for children, senior citizens, and family groups.</li>

                                <li><strong>Perfect for All Types of Travelers:</strong> Whether you prefer budget-friendly stays or luxurious beachside resorts, Andaman Islands offer a variety of accommodation options for every traveler.</li>

                                <li><strong>Best Water Sports Activities:</strong> Enjoy thrilling water sports like scuba diving, snorkeling, sea walking, kayaking, and parasailing at popular spots such as Elephant Beach and North Bay Island.</li>

                                <li><strong>Calm, Less Crowded, and Peaceful:</strong> If you are looking for a tranquil, pollution-free, and peaceful destination in India, the Andaman Islands are the perfect choice.</li>
                            </ul>


                        <h3 class="fs-6 fw-bold mt-3">How to Reach Andaman Islands from Jaipur?</h3>
                                <p>Reaching the Andaman Islands from Jaipur is easy and convenient. While there are no direct flights from Jaipur, you can take one-stop connecting flights via major cities such as:</p>

                                <ul class="packages-list-style">
                                    <li>Delhi</li>
                                    <li>Kolkata</li>
                                    <li>Chennai</li>
                                    <li>Bengaluru</li>
                                </ul>

                                <p>These cities offer multiple connecting flights to Port Blair, the capital of Andaman Islands, making your journey smooth and flexible. The total travel time from Jaipur usually ranges between 6 to 9 hours. With a variety of flights available throughout the day, travelers can plan their Andaman holiday comfortably without any hassle.</p>

                            <h3 class="fs-6 fw-bold mt-3">Best Time to Visit Andaman from Lucknow</h3>
                                <ul class="packages-list-style">
                                    <li><strong>October to May:</strong> Perfect season for beach visits, sightseeing, and enjoying all water activities.</li>
                                </ul>

                                <ul class="packages-list-style">
                                    <li><strong>December to January:</strong> Peak season with ideal climate conditions.</li>
                                </ul>

                                <ul class="packages-list-style">
                                    <li><strong>June to September:</strong> Monsoon season with the lowest package prices, perfect for budget travelers.</li>
                                </ul>

                        <h3 class="fs-6 fw-bold mt-3">Top Destinations to Explore in Andaman Nicobar Tour Packages from Jaipur</h3>

                                <p><a href="https://andamanbliss.com/islands/port-blair/" target="_blank">Port Blair</a></p>
                                <ul class="packages-list-style">
                                    <li><strong>Cellular Jail:</strong> Visit the historic <a href="https://andamanbliss.com/islands/port-blair/cellular-jail/" target="_blank">Cellular Jail</a>, a symbol of India’s freedom struggle.</li>
                                    <li><strong>Light & Sound Show:</strong> Experience the fascinating history of Cellular Jail through the evening light and sound show.</li>
                                    <li><strong>Corbyn Cove Beach:</strong> Relax at this serene beach with soft sand and clear waters.</li>
                                    <li><strong>North Bay Island:</strong> Enjoy snorkeling, scuba diving, and coral reef exploration.</li>
                                    <li><strong>Ross Island:</strong> Explore the ruins of British-era buildings amidst lush greenery.</li>
                                    <li><strong>Chidiya Tapu Beach:</strong> Perfect for sunset views, bird watching, and nature walks.</li>
                                </ul>

                                <p><a href="https://andamanbliss.com/islands/havelock-swaraj-dweep/" target="_blank">Havelock Island</a></p>
                                <ul class="packages-list-style">
                                    <li><strong>Radhanagar Beach:</strong> One of Asia’s most beautiful beaches, ideal for swimming and photography.</li>
                                    <li><strong>Elephant Beach:</strong> Famous for thrilling water sports like snorkeling, scuba diving, and sea walking.</li>
                                </ul>

                                <p><a href="https://andamanbliss.com/islands/neil-shaheed-dweep/" target="_blank">Neil Island</a></p>
                                <ul class="packages-list-style">
                                    <li><strong>Natural Rock Bridge:</strong> A stunning natural rock formation perfect for photography.</li>
                                    <li><strong>Bharatpur Beach:</strong> Known for crystal-clear waters and water sports activities.</li>
                                    <li><strong>Laxmanpur Beach:</strong> Famous for mesmerizing sunsets and calm surroundings.</li>
                                </ul>

                                <p><a href="https://andamanbliss.com/islands/baratang/" target="_blank">Baratang Island</a></p>
                                <ul class="packages-list-style">
                                    <li><strong>Mangrove Boat Ride:</strong> Explore the dense mangroves on a scenic boat ride.</li>
                                    <li><strong>Limestone Cave:</strong> Discover the fascinating limestone formations inside the caves.</li>
                                    <li><strong>Mud Volcano:</strong> Witness the rare natural phenomenon of mud volcanoes.</li>
                                </ul>

                                <p><a href="https://andamanbliss.com/islands/port-blair/north-bay-island/" target="_blank">North Andaman</a></p>
                                <ul class="packages-list-style">
                                    <li><strong>Diglipur:</strong> A peaceful town surrounded by pristine beaches and natural beauty.</li>
                                    <li><strong>Ross & Smith Island:</strong> A unique twin-island connected by a sandbar, perfect for a day trip.</li>
                                    <li><strong>Kalipur Beach:</strong> A tranquil beach ideal for relaxation and nature walks.</li>
                                </ul>

                            <h3 class="fs-6 fw-bold mt-3">Andaman Honeymoon Package from Jaipur</h3>
                              <p>Andaman Islands are the perfect destination for couples looking for a romantic and memorable getaway. Our <strong>honeymoon packages from Jaipur</strong> offer everything you need for an unforgettable experience, including:</p>
                                <ul class="packages-list-style">
                                    <li><strong>Beachfront Resorts:</strong> Stay in luxurious resorts right on the beach for stunning sunrise and sunset views.</li>
                                    <li><strong>Candlelight Dinners:</strong> Enjoy intimate dinners under the stars by the seaside.</li>
                                    <li><strong>Flower Bed Decoration:</strong> Make your stay extra special with romantic floral arrangements in your room.</li>
                                    <li><strong>Private Sightseeing:</strong> Explore the islands’ beautiful attractions in a private, comfortable setting.</li>
                                    <li><strong>Romantic Experiences:</strong> Enjoy serene walks on the beach, couples’ spa sessions, and quiet moments together.</li>
                                    <li><strong>Couple Photoshoot:</strong> Capture your special moments with professional photography amidst the scenic backdrop of Andaman.</li>
                                </ul>

                                <p>Choose our <strong>Andaman honeymoon package from Jaipur</strong> for a blend of adventure, relaxation, and romance that you and your partner will cherish forever.</p>


                        <h3 class="fs-6 fw-bold mt-3">Types of Tour Packages Available</h3>
                            <p><strong>Budget Packages:</strong></p>
                            <ul class="packages-list-style">
                                <li>Comfortable stays</li>
                                <li>Standard transportation</li>
                                <li>Sightseeing tours</li>
                                <li>Complimentary breakfast</li>
                                <li>Ferry transfers</li>
                            </ul>

                            <p><strong>Standard / Premium Packages:</strong></p>
                            <ul class="packages-list-style">
                                <li>3 star / 4 star accommodation</li>
                                <li>Private cab transfers.</li>
                                <li>Premium Ferry Transfers</li>
                                <li>Customized activities</li>
                                <li>Complimentary breakfast</li>
                            </ul>

                            <p><strong>Honeymoon Packages:</strong></p>
                            <ul class="packages-list-style">
                                <li>Special decoration</li>
                                <li>Candlelight dinner</li>
                                <li>Seaside dinner</li>
                                <li>Luxury beachside resorts</li>
                                <li>Complimentary breakfast</li>
                            </ul>

                            <p><strong>Group Packages:</strong></p>
                            <ul class="packages-list-style">
                                <li>Perfect for corporate groups</li>
                                <li>Budget friendly travelers</li>
                                <li>Custom activities</li>
                            </ul>


                        <h3 class="fs-6 fw-bold mt-3">Approximate Andaman Tour Package Cost from Jaipur</h3>
                            <p><strong>Budget Packages (Without Flights)</strong></p>
                            <ul class="packages-list-style mb-3">
                                <li>The package usually starts from INR 12,500 per person</li>
                                <li>This includes hotels, breakfast, ferries and sightseeing</li>
                            </ul>

                            <p><strong>Standard Packages</strong></p>
                            <ul class="packages-list-style mb-3">
                                <li>The package usually starts from INR 26,000 to ₹37,000 per person</li>
                                <li>This includes 3 star category hotels, breakfast, ferry tickets and private cab</li>
                            </ul>

                            <p><strong>Premium or Luxury Packages</strong></p>
                            <ul class="packages-list-style mb-3">
                                <li>Package starts from INR 40,000 to INR 65,000 per person</li>
                                <li>This package includes 4 star category resorts, premium ferry transfers and beachside resorts</li>
                            </ul>

                            <p><strong>Honeymoon Packages</strong></p>
                            <ul class="packages-list-style mb-3">
                                <li>This package usually starts from INR 32,000 per couple</li>
                                <li>This package includes decorations, candlelight dinner and upgraded rooms</li>
                            </ul>

                            <p><strong>Cost of the Flights from Jaipur to Port Blair</strong></p>
                            <ul class="packages-list-style mb-3">
                                <li>The cost of the flight varies from INR 9,000 to INR 18,000 for one way.</li>
                            </ul>

                            <p><strong>Group Packages</strong></p>
                            <ul class="packages-list-style mb-3">
                                <li>Pricing depends on group size and customization of your package</li>
                                <li>More affordable option for Jaipur travelers.</li>
                            </ul>

                        <h3 class="fs-6 fw-bold mt-3">Suggested 5 Nights 6 Days Itinerary for Jaipur Travelers</h3>

                            <p><strong>Day 1 – Arrival at Port Blair</strong></p>
                            <ul class="packages-list-style mb-3">
                                <li>Cellular Jail</li>
                                <li>Corbyn Cove Beach</li>
                                <li>Light & Sound Show</li>
                            </ul>

                            <p><strong>Day 2 – Transfer to Havelock</strong></p>
                            <ul class="packages-list-style mb-3">
                                <li>Ferry ride</li>
                                <li>Radhanagar Beach</li>
                            </ul>

                            <p><strong>Day 3 – Havelock</strong></p>
                            <ul class="packages-list-style mb-3">
                                <li>Elephant Beach</li>
                                <li>Snorkeling</li>
                                <li>Water sports</li>
                            </ul>

                            <p><strong>Day 4 – Havelock to Neil Island</strong></p>
                            <ul class="packages-list-style mb-3">
                                <li>Bharatpur Beach</li>
                                <li>Natural Rock Bridge</li>
                            </ul>

                            <p><strong>Day 5 – Neil to Port Blair</strong></p>
                            <ul class="packages-list-style mb-3">
                                <li>City tour</li>
                                <li>Shopping</li>
                                <li>Marina Park</li>
                            </ul>

                            <p><strong>Day 6 – Departure</strong></p>
                            <ul class="packages-list-style mb-3">
                                <li>End of your journey</li>
                            </ul>

                        <h3 class="fs-6 fw-bold mt-3">Travel Tips for Andaman Tour from Jaipur</h3>

                            <ol class="packages-list-style mb-3">
                                <li><strong>Book Flights Early:</strong> Jaipur to Port Blair fares rise quickly, especially during peak season (Dec–Feb).</li>

                                <li><strong>Carry Enough Cash:</strong> Network issues sometimes affect card payments on islands like Neil.</li>

                                <li><strong>Pre-book Ferries:</strong> Private ferries (Makruzz, Nautika) get sold out fast.</li>

                                <li><strong>Respect Local Rules:</strong> Swimming is restricted after sunset due to safety reasons.</li>

                                <li><strong>Pack Light but Necessary Items:</strong>
                                    <ul class="packages-list-style">
                                        <li>Sunscreen</li>
                                        <li>Hats & sunglasses</li>
                                        <li>Flip-flops</li>
                                        <li>Light cotton clothes</li>
                                        <li>Waterproof bags</li>
                                    </ul>
                                </li>

                                <li><strong>Mobile Network:</strong> Airtel & BSNL work best across islands. Jio works fine in main areas.</li>

                                <li><strong>Avoid Plastic:</strong> Andaman follows strict eco-friendly policies.</li>

                                <li><strong>Don’t Miss Water Sports:</strong> If you are a beginner, Havelock is the best place for scuba diving.</li>
                            </ol>

                        <h3 class="fs-6 fw-bold mt-3">Why Choose Andaman Bliss?</h3>
                            <p>As one of the <strong>Best Travel Agencies in Andaman</strong>, we ensure:</p>
                            <ul class="packages-list-style">
                                <li>Personalized itineraries</li>
                                <li>Budget-friendly to premium options</li>
                                <li>Private AC cab for all transfers</li>
                                <li>Best hotel & ferry deals</li>
                                <li>Expert local guidance</li>
                                <li>Zero hidden charges</li>
                                <li>24×7 customer support</li>
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
                    <p class="faq-subtitle">Everything you need to know about planning your trip to Andaman Islands From Jaipur</p>
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
                        <h3>How can I travel from Jaipur to Andaman?</h3>
                        <div class="faq-toggle">
                            <i class="fas fa-plus"></i>
                            <i class="fas fa-minus"></i>
                        </div>
                    </div>
                    <div class="faq-answer collapse show" id="faqAnswer1" style="">
                        <p>It is very easy and convenient to reach Andaman Island from Jaipur. Currently there are no direct flights from Jaipur to Port Blair, hence you can take a one stop connecting flights from major cities like Delhi, Kolkata, Chennai or Bengaluru. It takes around six to nine hours to reach Andaman Islands. Once you land at Port Blair, all the major sightseeing and ferry transfers will be handled by our Andaman Bliss Team.</p>
                    </div>
                </div>
                <div class="faq-item" id="faq2">
                    <div class="faq-question" data-bs-toggle="collapse" data-bs-target="#faqAnswer2"
                        aria-expanded="false">
                        <div class="faq-icon">
                            <i class="fas fa-map-marked-alt"></i>
                        </div>
                        <h3>What is the cost of an Andaman tour package from Jaipur?</h3>
                        <div class="faq-toggle">
                            <i class="fas fa-plus"></i>
                            <i class="fas fa-minus"></i>
                        </div>
                    </div>
                    <div class="collapse faq-answer" id="faqAnswer2">
                        <p>The cost of an Andaman tour package varies based on the type of accommodation you choose, travel season and number of days you are planning to stay. The budget friendly package usually starts from INR 18,500 per person, whereas standard and premium packages goes upto INR 26,000 to 60,000 and above. Flight tickets are not included in any of our packages.</p>
                    </div>
                </div>
                <div class="faq-item" id="faq3">
                    <div class="faq-question" data-bs-toggle="collapse" data-bs-target="#faqAnswer3"
                        aria-expanded="false">
                        <div class="faq-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <h3>What is the best time to visit Andaman from Jaipur?</h3>
                        <div class="faq-toggle">
                            <i class="fas fa-plus"></i>
                            <i class="fas fa-minus"></i>
                        </div>
                    </div>
                    <div class="collapse faq-answer" id="faqAnswer3">
                        <p>The most perfect time to visit Andaman islands from Jaipur is from October to May. During this month, the weather is clear, seas are calm and perfect for sightseeing and water activities. We recommend you to avoid the monsoon month that starts from June to September.</p>
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
                        <h3>How many days are enough for an Andaman trip from Jaipur?</h3>
                        <div class="faq-toggle">
                            <i class="fas fa-plus"></i>
                            <i class="fas fa-minus"></i>
                        </div>
                    </div>
                    <div class="collapse faq-answer" id="faqAnswer4">
                        <p>A basic trip to Andaman from Jaipur usually lasts between five to six days, which is enough to cover all the major attractions like Port Blair, Havelock and Neil Island. However, if you want to include Baratang and Diglipur or North Andaman, a seven to eight days itinerary is recommended for a more relaxed and complete experience.</p>
                    </div>
                </div>
                <div class="faq-item" id="faq5">
                    <div class="faq-question" data-bs-toggle="collapse" data-bs-target="#faqAnswer5"
                        aria-expanded="false">
                        <div class="faq-icon">
                            <i class="fas fa-mobile-alt"></i>
                        </div>
                        <h3>Is Andaman a good honeymoon destination for couples from Jaipur?</h3>
                        <div class="faq-toggle">
                            <i class="fas fa-plus"></i>
                            <i class="fas fa-minus"></i>
                        </div>
                    </div>
                    <div class="collapse faq-answer" id="faqAnswer5">
                        <p>Yes, Andaman island is one of the most popular and beautiful honeymoon destinations for Jaipur travelers. The Andaman Islands offers a peaceful and romantic atmosphere with stunning beaches, crystal clear water, candlelight dinner, beachside resorts and privacy. Honeymoon packages also include special arrangements like floral decorations, romantic dinners and private sightseeing tours.</p>
                    </div>
                </div>
                <div class="faq-item" id="faq6">
                    <div class="faq-question" data-bs-toggle="collapse" data-bs-target="#faqAnswer6"
                        aria-expanded="false">
                        <div class="faq-icon">
                            <i class="fas fa-hotel"></i>
                        </div>
                        <h3>HDo I need a passport or visa to visit the Andaman Islands?</h3>
                        <div class="faq-toggle">
                            <i class="fas fa-plus"></i>
                            <i class="fas fa-minus"></i>
                        </div>
                    </div>
                    <div class="collapse faq-answer" id="faqAnswer6">
                        <p>No, passports or visas are not required for Indian citizens for traveling to Andaman, as the islands are part of India. Only restricted tribal areas require special permits. For all regular tourist attractions, no special documentation is needed other than your government ID proof.</p>
                    </div>

                </div>
                <!-- <div class="faq-item" id="faq7">
                    <div class="faq-question" data-bs-toggle="collapse" data-bs-target="#faqAnswer7"
                        aria-expanded="false">
                        <div class="faq-icon">
                            <i class="fas fa-hotel"></i>
                        </div>
                        <h3>Are boat rides and water activities safe for children and elderly members?</h3>
                        <div class="faq-toggle">
                            <i class="fas fa-plus"></i>
                            <i class="fas fa-minus"></i>
                        </div>
                    </div>
                    <div class="collapse faq-answer" id="faqAnswer7">
                        <p>Yes, certified operators provide life jackets, safety briefings and short sessions are given by trained instructors that makes every activity easy even for beginners. For elders, staff at jetties and boats help with boarding, seating and balance,so the whole family can enjoy without stress.</p>
                    </div>
                </div>
                <div class="faq-item" id="faq8">
                    <div class="faq-question" data-bs-toggle="collapse" data-bs-target="#faqAnswer8"
                        aria-expanded="false">
                        <div class="faq-icon">
                            <i class="fas fa-hotel"></i>
                        </div>
                        <h3>Do Andaman tour packages include historical and educational visits?</h3>
                        <div class="faq-toggle">
                            <i class="fas fa-plus"></i>
                            <i class="fas fa-minus"></i>
                        </div>
                    </div>
                    <div class="collapse faq-answer" id="faqAnswer8">
                        <p>Most family packages include destinations like Cellular Jail, the Anthropological Museum and local craft centres. If you are hiring a tour guide, it basically makes it easy to understand the islands’ history, culture and indigenous communities—adding depth to your holiday.</p>
                    </div>
                </div>
                <div class="faq-item" id="faq9">
                    <div class="faq-question" data-bs-toggle="collapse" data-bs-target="#faqAnswer9"
                        aria-expanded="false">
                        <div class="faq-icon">
                            <i class="fas fa-hotel"></i>
                        </div>
                        <h3>Can Lucknow families enjoy affordable resort stays during this trip?</h3>
                        <div class="faq-toggle">
                            <i class="fas fa-plus"></i>
                            <i class="fas fa-minus"></i>
                        </div>
                    </div>
                    <div class="collapse faq-answer" id="faqAnswer9">
                        <p>Yes, variety of family-friendly resorts offer comfortable stays with meals and transfers included. You can choose from budget, mid-range or luxury whatever suits your style. Most properties also have open spaces, beach access or small play areas that are perfect for kids.</p>
                    </div>
                </div>
                <div class="faq-item" id="faq10">
                    <div class="faq-question" data-bs-toggle="collapse" data-bs-target="#faqAnswer10"
                        aria-expanded="false">
                        <div class="faq-icon">
                            <i class="fas fa-hotel"></i>
                        </div>
                        <h3>How many days are required for a complete Andaman tour from Lucknow?</h3>
                        <div class="faq-toggle">
                            <i class="fas fa-plus"></i>
                            <i class="fas fa-minus"></i>
                        </div>
                    </div>
                    <div class="collapse faq-answer" id="faqAnswer10">
                        <p>A 7-day trip works beautifully. It gives you enough time to explore Port Blair, Havelock, and Neil Island at a relaxed pace. If your family enjoys nature trails or caves, you can add places like Baratang or North Bay Island for extra fun and learning.</p>
                    </div>
                </div> -->
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