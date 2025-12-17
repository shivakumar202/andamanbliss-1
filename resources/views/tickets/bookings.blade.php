@extends('layouts.app')

@section('title', 'Confirm Booking Details')

@section('content')

    <!-- Header Banner -->
    <section class="container text-center py-4">
        <h2 class="text-primary fw-bold">🎟️ Booking Details</h2>
    </section>

    <!-- Booking Details Section -->
    <div class="container">
        <div class="row justify-content-center">
            @foreach ($details as $trip)
                <div class="col-md-8 mb-4">
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            <h5 class="card-title text-primary fw-bold">Trip {{ $loop->iteration }} {{ $trip->from_location }} → {{ $trip->to_location }}</h5>
                            <hr>
                            <div class="row">
                                <!-- Trip Route -->
                                <div class="col-md-6">
                                    <p class="mb-1"><strong>Route:</strong></p>
                                    <p class="fw-bold">{{ $trip->from_location }} → {{ $trip->to_location }}</p>
                                </div>
                                <!-- Ferry Name -->
                                <div class="col-md-6">
                                    <p class="mb-1"><strong>Ferry:</strong></p>
                                    <p>{{ $trip->ferry }}</p>
                                </div>
                                <!-- Travel Date -->
                                <div class="col-md-6">
                                    <p class="mb-1"><strong>Travel Date:</strong></p>
                                    <p>{{ \Carbon\Carbon::parse($trip->travel_date)->format('d F Y') }}</p>
                                </div>
                                <!-- Departure Time -->
                                <div class="col-md-3">
                                    <p class="mb-1"><strong>Departure:</strong></p>
                                    <p>{{ \Carbon\Carbon::parse($trip->embarkation)->format('h:i A') }}</p>
                                </div>
                                <!-- Arrival Time -->
                                <div class="col-md-3">
                                    <p class="mb-1"><strong>Arrival:</strong></p>
                                    <p>{{ \Carbon\Carbon::parse($trip->disembarkation)->format('h:i A') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Action Buttons -->
        <div class="row justify-content-center">
            <div class="col-md-8 text-center">
                <!-- Download Ticket Button -->
                <a href="{{ route('ferry-ticket', ['token' => $details[0]['bookno']]) }}?head=false"
                   target="_blank" class="btn btn-warning btn-lg w-100 mb-3">
                    ⬇️ Download Ticket
                </a>

                <!-- Book Another Ferry Button -->
                <a href="{{ route('cruises') }}" class="btn btn-primary btn-lg w-100">
                    ➕ Book Another Ferry
                </a>
            </div>
        </div>
    </div>

@endsection
