@extends('layouts.app')
@section('title', 'Cruise Booking In Andaman')
@section('keywords', 'Port Blair to Havelock ferry, Port Blair to Neil Island ferry, Havelock to Port Blair ferry, Neil
to Port Blair ferry, Havelock to Neil Island ferry, Andaman ferry booking, ferry tickets Port Blair, ferry tickets
Havelock, ferry tickets Neil Island, Andaman cruises, Andaman ferry routes')
@section('description', 'Book Andaman ferry tickets easily. Enjoy fast bookings, top routes, and expert
support for your Andaman travel with Andaman Bliss')
@section('meta_schema')

@endsection
@section('og_title','')
@section('og_description', '')
@section('og_type', '')
@section('og_image', '')
@section('twitter_card', '')
@section('twitter_title', '')
@section('twitter_desc', '')
@section('twitter_image', '')


@section('content')


    <section class="cruise-banner position-relative">
        <div class="container-fluid p-0 overflow-hidden">
            <div class="row">
                <div class="col-12 text-center mt-5 banner-centre-contain">
                </div>
            </div>
        </div>
    </section>


    <section id="hotel-listing" class="mb-5">

        <livewire:ferry.ferry-operations-page></livewire:ferry.ferry-operations-page>
    </section>

    @push('styles')
<style type="text/css">
    /* page styles */
    #footers{
        display: none;
    }
    #expert-btn{
        display: none;
    }
</style>
@endpush
    
    @push('scripts')
        <script>
             
             document.addEventListener('DOMContentLoaded', function() {
    const steps = document.querySelectorAll('.booking-process-step');
    const images = document.querySelectorAll('.booking-process-image img');

    function changeStep(stepNumber) {
        // Convert stepNumber to string
        stepNumber = stepNumber.toString();

        // Remove active class from all steps
        steps.forEach(step => {
            step.classList.remove('active');
            if (step.getAttribute('data-step') === stepNumber) {
                step.classList.add('active');
            }
        });

        // Hide all images
        images.forEach(img => {
            img.style.display = 'none';
        });

        // Show the corresponding image
        const activeImage = document.querySelector(`.booking-process-image img[data-step="${stepNumber}"]`);
        if (activeImage) {
            activeImage.style.display = 'block';
        }
    }

    // Add click event to each step
    steps.forEach(step => {
        step.addEventListener('click', function() {
            const stepNumber = this.getAttribute('data-step');
            changeStep(stepNumber);
        });
    });

    // Activate first step by default
    changeStep('1');
}); 
   
        </script>
    @endpush

@endsection
