@extends('layouts.app')
@section('title', 'Tour Booking Detials')

@section('content')

<div id="dashboard_main_arae" class="container pt-5 d-flex flex-wrap">
    @include('layouts.profile')
    <!-- Modern Header -->
    <div class="col-8 ms-3">
        <div class="header-box mb-4">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <div>
                    <h2 class="fw-bold mb-1">Tour Booking Details</h2>
                    <p class="text-muted mb-0">Booking ID: <strong>#{{$data['itinerary'][0]['search_hash']}}</strong></p>
                </div>
                <div class="text-end mt-3 mt-md-0">
                    <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2">Confirmed</span>
                    <p class="mb-0 mt-2 text-muted">Booked on :{{ \Carbon\carbon::parse($data['itinerary'][0]['created_at'])->format('d-m-y, H:i A')}}</p>
                </div>
            </div>
            <div class="text-end mt-3 mt-md-0">
                <a href="{{ route('travel-itinerary', ['trip_code' => $data['itinerary'][0]['search_hash']]) }}"
                    id="download-itinerary" class="btn btn-outline-primary btn-sm">
                    <i class="fa fa-download me-2"></i>Download Itinerary
                </a>
            </div>
        </div>

        <!-- Summary Cards -->
        <div class="row g-4 mb-4">
            <div class="col-md-6 col-lg-3">
                <div class="summary-card p-4">
                    <div class="icon-wrapper bg-primary-light">
                        <i class="fas fa-calendar-days"></i>
                    </div>
                    <div class="stat-number">{{ $data['tour']['days'] }}</div>
                    <div class="stat-label">Total Days</div>
                </div>
            </div>
            @php
            $hotelCount = collect($data['itinerary'])->filter(fn($i) => !empty($i['hotelbookings']))->count();
            $ferryCount = collect($data['itinerary'])
            ->flatMap(fn($i) => $i['ferries'] ?? [])
            ->filter(fn($f) => !empty($f['pnr_no']))
            ->unique('pnr_no')
            ->count();

            @endphp


            <div class="col-md-6 col-lg-3">
                <div class="summary-card p-4">
                    <div class="icon-wrapper bg-success-light">
                        <i class="fas fa-hotel"></i>
                    </div>
                    <div class="stat-number">{{ $hotelCount }}</div>
                    <div class="stat-label">Hotels Booked</div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="summary-card p-4">
                    <div class="icon-wrapper bg-warning-light">
                        <i class="fas fa-ship"></i>
                    </div>
                    <div class="stat-number">{{ $ferryCount }}</div>
                    <div class="stat-label">Ferry Rides</div>
                </div>
            </div>

            @php
            $guestData = json_decode($data['guest'], true);
            $travellersCount = collect($guestData)->sum(function ($g) {
            return (int)$g['Adults'] + (int)$g['Children'];
            });
            @endphp

            <div class="col-md-6 col-lg-3">
                <div class="summary-card p-4">
                    <div class="icon-wrapper bg-info-light">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-number">{{ $travellersCount }}</div>
                    <div class="stat-label">Travelers</div>
                </div>
            </div>

        </div>

        <!-- Accordion Start -->
        <div class="accordion" id="tourDays">

            <!-- DAY 1 -->
            @foreach ($data['itinerary'] as $iti)
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#day{{ $loop->index + 1 }}">
                        <i class="fas fa-sun me-2 text-warning"></i>
                        Day {{ $loop->index + 1 }} – {{ \Carbon\Carbon::parse($iti['start_date'])->format('d-m-Y') }}
                    </button>
                </h2>

                <div id="day{{ $loop->index + 1 }}" class="accordion-collapse collapse" data-bs-parent="#tourDays">
                    <div class="accordion-body">
                        <p class="mb-4">
                            Arrival at Port Blair, hotel check-in, and evening visit to Cellular Jail + Light & Sound Show.
                        </p>

                        <div class="row g-4">
                            <!-- Hotel -->
                            @if($iti['hotelbookings'] !== null)
                            <div class="col-md-6">
                                <div class="card details-card">
                                    <div class="card-body d-flex">
                                        <div class="card-content">
                                            <h5 class="section-title">
                                                <span class="feature-icon bg-primary bg-opacity-10 text-primary">
                                                    <i class="fas fa-hotel"></i>
                                                </span>
                                                {{ $iti['accomodation']['hotel_name'] }}
                                            </h5>
                                            <p class="mb-1"><strong>Room :</strong>{{ Str::replace('"', '',$iti['room_name']) }} - {{ $iti['hotelbookings']['rooms']}}</p>
                                            <p class="mb-1"><strong>Check-in:</strong> {{ \Carbon\Carbon::parse($iti['start_date'])->format('d-m-Y') }}</p>
                                            <p><strong>Check-out:</strong> {{ \Carbon\Carbon::parse($iti['start_date'])->addDay()->format('d-m-Y') }}</p>

                                            <a href="{{ route('hotel.package.voucher', ['book_id' => $iti['hotelbookings']['id']]) }} " class="btn btn-primary download-btn">
                                                <i class="fas fa-download"></i>
                                                Download Hotel Voucher</a>
                                        </div>
                                        <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=200&q=80" alt="Seashell Hotel" class="card-image">
                                    </div>
                                </div>
                            </div>
                            @endif

                            <!-- Ferry -->
                            @if (!empty($iti['ferries'][$loop->index]))
                            @php
                            $ferry = $iti['ferries'][$loop->index];
                            @endphp
                            <div class="col-md-6">
                                <div class="card details-card">
                                    <div class="card-body d-flex">
                                        <div class="card-content">
                                            <h5 class="section-title">
                                                <span class="feature-icon bg-success bg-opacity-10 text-success">
                                                    <i class="fas fa-ship"></i>
                                                </span>
                                                {{ $ferry['ferry'] ?? '' }}
                                            </h5>
                                            <p class="mb-1"><strong>Class :</strong> ({{ $ferry['class'] ?? '' }})</p>
                                            <p class="mb-1"><strong>Pnr :</strong> {{ $ferry['pnr_no'] ?? '' }}</p>
                                            <p class="mb-1"><strong>Departure:</strong>{{ $ferry['from_location'] ?? '' }} - {{ \Carbon\Carbon::parse($ferry['embarkation'])->format('H:i A') }}</p>
                                            <p><strong>Arrival:</strong> {{ $ferry['to_location'] ?? '' }} - {{ \Carbon\carbon::parse($ferry['disembarkation'])->format('H:i A') }}</p>

                                            <a href="{{ route('ferry-ticket', ['token' => $ferry['pnr_no'] ?? 'not book']) }}" class="btn btn-success download-btn">
                                                <i class="fas fa-download"></i>
                                                Download Ferry Ticket </a>
                                        </div>
                                        <img src="https://www.go2andaman.com/wp-content/uploads/2024/02/Makruzz_Oct19_Lowres_031-1701x931.jpg" alt="Makruzz Ferry" class="card-image">
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>

</div>
@endsection
@push('styles')

<style>
    :root {
        --primary: #4361ee;
        --secondary: #3f37c9;
        --accent: #4cc9f0;
        --light: #f8f9fa;
        --dark: #212529;
        --success: #4ade80;
        --info: #38bdf8;
        --warning: #fbbf24;
        --danger: #f87171;
        --gray-100: #f1f5f9;
        --gray-200: #e2e8f0;
        --gray-300: #cbd5e1;
        --gray-800: #1e293b;
    }

    body {
        background: linear-gradient(135deg, #f5f7fb 0%, #e4edf5 100%);
        font-family: "Inter", sans-serif;
        min-height: 100vh;
        padding-bottom: 2rem;
    }

    /* HEADER */
    .header-box {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        padding: 25px 35px;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
        border: 1px solid rgba(255, 255, 255, 0.7);
        margin-bottom: 1.5rem;
        position: relative;
        overflow: hidden;
    }

    .header-box::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(67, 97, 238, 0.1) 0%, transparent 70%);
        z-index: 0;
    }

    .header-box>* {
        position: relative;
        z-index: 1;
    }

    /* SUMMARY CARDS */
    .summary-card {
        border-radius: 16px;
        background: white;
        border: none;
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.06);
        transition: all 0.3s ease;
        height: 100%;
        border-top: 4px solid var(--primary);
    }

    .summary-card:nth-child(2) {
        border-top-color: var(--success);
    }

    .summary-card:nth-child(3) {
        border-top-color: var(--warning);
    }

    .summary-card:nth-child(4) {
        border-top-color: var(--info);
    }

    .summary-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 25px rgba(0, 0, 0, 0.1);
    }

    .summary-card .icon-wrapper {
        width: 60px;
        height: 60px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        margin-bottom: 1rem;
    }

    .bg-primary-light {
        background-color: rgba(67, 97, 238, 0.1);
        color: var(--primary);
    }

    .bg-success-light {
        background-color: rgba(74, 222, 128, 0.1);
        color: var(--success);
    }

    .bg-warning-light {
        background-color: rgba(251, 191, 36, 0.1);
        color: var(--warning);
    }

    .bg-info-light {
        background-color: rgba(56, 189, 248, 0.1);
        color: var(--info);
    }

    /* ACCORDION Modern Style */
    .accordion-button {
        border-radius: 16px !important;
        font-weight: 600;
        background: #ffffff;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        transition: 0.3s ease;
        padding: 1.25rem 1.5rem;
        font-size: 1.1rem;
        color: var(--gray-800);
    }

    .accordion-button:not(.collapsed) {
        color: var(--primary);
        background: rgba(67, 97, 238, 0.05);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
    }

    .accordion-button:focus {
        box-shadow: 0 0 0 0.25rem rgba(67, 97, 238, 0.15);
    }

    .accordion-button::after {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%234361ee'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
        width: 1.5rem;
        height: 1.5rem;
    }

    .accordion-item {
        border: none;
        margin-bottom: 20px;
        background: transparent;
        box-shadow: none;
    }

    .accordion-body {
        background: #fff;
        border-radius: 16px;
        margin-top: 10px;
        padding: 25px;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.06);
    }

    /* Cards */
    .details-card {
        border-radius: 16px;
        background: #ffffff;
        border: none;
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.06);
        transition: all 0.3s ease;
        height: 100%;
        border-left: 4px solid var(--primary);
    }

    .details-card:nth-child(2) {
        border-left-color: var(--success);
    }

    .details-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 25px rgba(0, 0, 0, 0.1);
    }

    /* Image styles */
    .detail-image {
        border-radius: 12px;
        width: 100%;
        height: 120px;
        object-fit: cover;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    /* Content and image layout */
    .card-content {
        flex: 1;
    }

    .card-image {
        width: 120px;
        height: 120px;
        border-radius: 12px;
        object-fit: cover;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin-left: 15px;
    }

    /* Titles */
    .section-title {
        font-weight: 700;
        font-size: 18px;
        color: var(--gray-800);
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    /* Modern Buttons */
    .download-btn {
        width: 100%;
        padding: 12px 0;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }

    .download-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
    }

    .btn-primary {
        background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
        border: none;
    }

    .btn-success {
        background: linear-gradient(135deg, var(--success) 0%, #22c55e 100%);
        border: none;
    }

    .btn-outline-secondary {
        border-radius: 12px;
    }

    /* Stats */
    .stat-number {
        font-size: 1.8rem;
        font-weight: 700;
        margin-bottom: 0.25rem;
    }

    .stat-label {
        font-size: 0.9rem;
        color: var(--gray-300);
        font-weight: 500;
    }

    /* Icons */
    .feature-icon {
        font-size: 1.2rem;
        width: 40px;
        height: 40px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .header-box {
            padding: 20px;
        }

        .accordion-button {
            padding: 1rem 1.25rem;
            font-size: 1rem;
        }

        .accordion-body {
            padding: 20px;
        }
    }
</style>

@endpush