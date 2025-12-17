@extends('layouts.app')
@section('title', 'Reviews')

@section('content')
<section class="my-3">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="h4 mb-0">Review Your Booking</h1>
            </div>
        </div>
    </div>
</section>
<div class="container py-5">
   <livewire:cab-review/>
</div>

@push('styles')
<style>
    .pay-bg { background: linear-gradient(180deg, rgba(0,0,0,0.1), rgba(0,0,0,0.05)); padding: 2rem 0; }
    .card { border: none; border-radius: 10px; }
    .shadow-sm { box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
    .form-control-sm { font-size: 0.875rem; }
    .btn-primary { background-color: #007bff; border-color: #007bff; }
    .btn-primary:hover { background-color: #0056b3; border-color: #004085; }
    .position-sticky { z-index: 1000; background: #fff; padding: 0.5rem 0; }
    @media (max-width: 575.98px) {
        .container { padding-left: 1rem; padding-right: 1rem; }
        .card { padding: 1rem !important; }
        .row.g-3 { gap: 1rem; }
    }
</style>
@endpush

@push('scripts')
<script>
$(document).ready(function() {
    const maxSeats = {{ $formattedData['carSeats'] }};
    const $travellersInput = $('input[name="travellers"]');
    const $cabQuantityInput = $('input[name="cab_quantity"]');

    function updateFare() {
        const travellers = parseInt($travellersInput.val()) || 1;
        const cabs = parseInt($cabQuantityInput.val()) || 1;
        const baseFarePerCab = {{ $formattedData['fare'] / ($formattedData['cab_quantity'] ?? 1) }};
        const newBaseFare = baseFarePerCab * cabs;
        const newGst = newBaseFare * 0.05;
        const newTotalFare = newBaseFare + newGst;

        $('.fare-details .base-fare').text('₹' + newBaseFare.toFixed(2));
        $('.fare-details .gst').text('₹' + newGst.toFixed(2));
        $('.fare-details .total-fare').text('₹' + newTotalFare.toFixed(2));
    }

    $travellersInput.on('input', function() {
        const travellers = parseInt($(this).val()) || 1;
        const requiredCabs = Math.ceil(travellers / maxSeats);
        $cabQuantityInput.val(requiredCabs);
        if (travellers > maxSeats * 5) {
            $(this).val(maxSeats * 5);
            $cabQuantityInput.val(5);
            alert('Maximum travellers exceeded. Please contact support for larger groups.');
        }
        updateFare();
    });

    $cabQuantityInput.on('input', function() {
        const cabs = parseInt($(this).val()) || 1;
        const maxTravellers = cabs * maxSeats;
        if ($travellersInput.val() > maxTravellers) {
            $travellersInput.val(maxTravellers);
        }
        updateFare();
    });
});
</script>
@endpush
@endsection