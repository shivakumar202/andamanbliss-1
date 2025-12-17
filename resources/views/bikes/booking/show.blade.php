@extends('layouts.app')
@section('title', 'Bikes')

@section('content')
<style>
    .card {
        border: none;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
    }

    .btn-orange {
        background-color: #ff6200;
        border-color: #ff6200;
        color: white;
        font-weight: 500;
    }

    .btn-orange:hover {
        background-color: #e55a00;
        border-color: #e55a00;
    }

    .text-blue {
        color: #005566;
    }

    .text-orange {
        color: #ff6200;
    }

    .info-section,
    .payment-section {
        background-color: #e9ecef;
        padding: 20px;
        border-radius: 8px;
        margin-bottom: 20px;
    }

    .form-label {
        color: #005566;
        font-weight: 500;
    }

    .form-control:focus {
        border-color: #ff6200;
        box-shadow: 0 0 5px rgba(255, 98, 0, 0.5);
    }

    #pickupLocationField {
        display: none;
    }

    .mobile-sticky-footer {
        display: block;
    }

    @media (max-width: 768px) {
        .mobile-sticky-footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            z-index: 1050;
            background-color: #fff;
            border-top: 1px solid #ddd;
            padding: 0.75rem 1rem;
            box-shadow: 0 -2px 6px rgba(0, 0, 0, 0.08);
        }


    }
    .text-primary {
        color: rgb(17, 157, 213) !important;
    }
</style>



<!-- Main Content -->
<div class="container-main my-4">
    <livewire:bike-booking :params="$params" />
</div>

@endsection