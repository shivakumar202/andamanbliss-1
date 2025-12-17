@extends('layouts.app')
@section('title','Activity Booing Offer')
@section('content')

<livewire:additional.upsale></livewire:additional.upsale>

@push('styles')
<link
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css"
      rel="stylesheet"
    />
<style>
    #footers {
        display: none;
    }
     :root {
        --primary-color: #ff6016;
        --primary-hover: #e5540c;
      }

      .btn-primary-custom {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
        color: white;
      }

      .btn-primary-custom:hover {
        background-color: var(--primary-hover);
        border-color: var(--primary-hover);
        color: white;
      }

      .activity-card {
        transition: transform 0.2s ease-in-out;
        border: 1px solid #e0e0e0;
        border-radius: 12px;
      }

      .activity-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      }

      .activity-image {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 12px;
      }

      .activity-counter {
        display: flex;
        align-items: center;
        gap: 0.25rem;
        background-color: #fff3e6;
        padding: 0.25rem 0.5rem;
        border-radius: 6px;
      }

      .activity-counter-btn {
        width: 25px;
        height: 25px;
        border: 1px solid var(--primary-color);
        background: white;
        color: var(--primary-color);
        border-radius: 4px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s;
        font-size: 0.8rem;
      }

      .activity-counter-btn:hover {
        background: var(--primary-color);
        color: white;
      }

      .activity-counter-display {
        min-width: 25px;
        text-align: center;
        font-weight: bold;
        font-size: 0.9rem;
      }

      .price-tag {
        background-color: var(--primary-color);
        color: white;
        padding: 0.25rem 0.5rem;
        border-radius: 0.25rem;
        font-weight: bold;
      }

      .upsale-section {
        display: block;
        animation: fadeInUp 0.6s ease-out;
        min-height: 100vh;
        padding-top: 0;
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

      .confirmation-section {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
      }

      .cart-summary {
        background: linear-gradient(135deg, #f8f9fa, #e9ecef);
        border-radius: 12px;
        border: 1px solid #dee2e6;
      }

      .btn-load-more {
        background-color: #20b2aa;
        border-color: #20b2aa;
        color: white;
        transition: all 0.3s ease;
      }

      .btn-load-more:hover {
        background-color: #1a9a92;
        border-color: #1a9a92;
        color: white;
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(32, 178, 170, 0.3);
      }

      .countdown-section {
        background: linear-gradient(
            135deg,
            rgba(255, 96, 22, 0.85),
            rgba(135, 206, 235, 0.85)
          ),
          url("https://images.unsplash.com/photo-1559827260-dc66d52bef19?w=1200&h=400&fit=crop&crop=center")
            center/cover;
        color: white;
        padding: 1rem;
        border-radius: 16px;
        text-align: center;
        margin: 2rem 0;
        box-shadow: 0 8px 25px rgba(255, 96, 22, 0.3);
        position: relative;
        overflow: hidden;
        min-height: 120px;
      }

      .countdown-section::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(
          45deg,
          transparent 30%,
          rgba(255, 255, 255, 0.1) 50%,
          transparent 70%
        );
        animation: shimmer 3s infinite;
      }

      @keyframes shimmer {
        0% {
          transform: translateX(-100%);
        }
        100% {
          transform: translateX(100%);
        }
      }

      .timer-container {
        display: flex;
        justify-content: center;
        gap: 0.75rem;
        margin-top: 1rem;
      }

      .timer-box {
        background: rgba(255, 255, 255, 0.25);
        border-radius: 12px;
        padding: 0.75rem;
        min-width: 60px;
        backdrop-filter: blur(15px);
        border: 1px solid rgba(255, 255, 255, 0.3);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
      }

      .timer-number {
        font-size: 1.5rem;
        font-weight: 700;
        display: block;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
      }

      .timer-label {
        font-size: 0.65rem;
        opacity: 0.95;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-top: 0.25rem;
      }

      .price-container {
        text-align: right;
      }

      .original-price {
        text-decoration: line-through;
        color: #6c757d;
        font-size: 0.9rem;
        margin-bottom: 0.25rem;
      }

      .offer-price {
        background-color: var(--primary-color);
        color: white;
        padding: 0.4rem 0.8rem;
        border-radius: 8px;
        font-weight: bold;
        font-size: 1.1rem;
        display: inline-block;
        box-shadow: 0 2px 8px rgba(255, 96, 22, 0.3);
      }

      .up-discount-badge {
        background: linear-gradient(135deg, #28a745, #20c997);
        color: white;
        padding: 0.25rem 0.5rem;
        border-radius: 12px;
        font-size: 0.75rem;
        font-weight: 600;
        margin-left: 0.5rem;
        animation: pulse 2s infinite;
      }

      @keyframes pulse {
        0% {
          transform: scale(1);
        }
        50% {
          transform: scale(1.05);
        }
        100% {
          transform: scale(1);
        }
      }

      /* Mobile Responsive Styles */
      @media (max-width: 767.98px) {
        .confirmation-section {
          padding: 1rem;
          min-height: 100vh;
        }

        .confirmation-section h2 {
          font-size: 1.5rem;
        }

        .confirmation-section .lead {
          font-size: 1rem;
        }

        .confirmation-section .d-flex {
          flex-direction: column;
          gap: 1rem !important;
        }

        .confirmation-section .btn-lg {
          width: 100%;
          padding: 0.75rem 1rem;
        }

        .upsale-section .container {
          padding: 0.75rem !important;
        }

        .activity-card {
          padding: 0 !important;
          margin-bottom: 1rem !important;
          overflow: hidden;
        }

        .activity-card .row {
          margin: 0;
        }

        .activity-card .col-md-2,
        .activity-card .col-md-5 {
          padding: 0;
          margin-bottom: 0;
        }

        .activity-image {
          width: 100%;
          height: 180px;
          border-radius: 0;
          border-top-left-radius: 12px;
          border-top-right-radius: 12px;
          object-fit: cover;
          object-position: center;
        }

        .activity-card .col-md-2 {
          margin-bottom: 0;
        }

        .activity-card .col-md-5:first-of-type {
          padding: 1rem;
          text-align: left;
        }

        .activity-card .col-md-5:last-of-type {
          padding: 1rem;
        }

        .price-container {
          text-align: left !important;
          margin-bottom: 0 !important;
          flex-shrink: 0;
        }

        .mobile-action-row {
          display: flex;
          align-items: center;
          justify-content: space-between;
          gap: 0.75rem;
          margin-top: 0.75rem;
        }

        .activity-card .d-flex.gap-3 {
          flex-direction: row;
          gap: 0.5rem !important;
          align-items: center !important;
          justify-content: flex-end !important;
          flex-shrink: 0;
        }

        .activity-counter {
          justify-content: center;
          flex-shrink: 0;
        }

        .btn-primary-custom {
          width: auto;
          flex-shrink: 0;
          padding: 0.5rem 0.75rem;
          font-size: 0.85rem;
          white-space: nowrap;
        }

        .countdown-section {
          padding: 1rem;
          margin: 1rem 0;
        }

        .countdown-section h4 {
          font-size: 1.1rem;
        }

        .countdown-section p {
          font-size: 0.9rem;
        }

        .timer-container {
          gap: 0.5rem;
          flex-wrap: wrap;
        }

        .timer-box {
          min-width: 45px;
          padding: 0.4rem;
        }

        .timer-number {
          font-size: 1.1rem;
        }

        .timer-label {
          font-size: 0.55rem;
        }

        .cart-summary {
          margin: 1rem 0;
          padding: 0.75rem !important;
        }

        .cart-summary .d-flex {
          flex-direction: column;
          gap: 0.5rem;
          text-align: center;
        }

        .cart-summary .d-flex.justify-content-between {
          flex-direction: row;
          justify-content: space-between;
        }

        .text-center .d-flex {
          flex-direction: column;
          gap: 0.75rem !important;
        }

        .text-center .btn-lg {
          width: 100%;
          max-width: 300px;
          margin: 0 auto;
          padding: 0.75rem;
        }

        .up-discount-badge {
          margin-left: 0 !important;
          margin-top: 0.25rem;
          display: inline-block;
        }

        .activity-card .d-flex.align-items-center.mb-1 {
          flex-direction: row;
          align-items: center !important;
          gap: 0.5rem;
          flex-wrap: wrap;
        }

        .offer-price {
          font-size: 1rem;
          padding: 0.3rem 0.6rem;
        }

        .original-price {
          font-size: 0.8rem;
        }

        .activity-card h5 {
          font-size: 1.1rem;
          margin-bottom: 0.25rem;
        }

        .activity-card p {
          font-size: 0.9rem;
          margin-bottom: 0.75rem;
        }
      }

      @media (max-width: 575.98px) {
        .confirmation-section .bi-check-circle-fill {
          font-size: 3rem !important;
        }

        .activity-image {
          width: 80px;
          height: 80px;
        }

        .countdown-section h4 {
          font-size: 1.1rem;
        }

        .countdown-section p {
          font-size: 0.9rem;
        }

        .timer-box {
          min-width: 45px;
          padding: 0.4rem;
        }

        .timer-number {
          font-size: 1.1rem;
        }

        .activity-counter-btn {
          width: 30px;
          height: 30px;
        }

        .activity-counter-display {
          min-width: 30px;
          font-size: 1rem;
        }
      }
</style>
@endpush
@endsection