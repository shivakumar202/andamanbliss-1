@extends('layouts.app')
@section('title', 'Activity Booking')

@section('content')
    <section class="singleviewTop my-5">
        <div class="container">
            <div class="row">
            </div>
        </div>
    </section>

    <section class="container">
        <livewire:users.activity.activity-process :data="$data" />
    </section>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const btn = document.getElementById('expert-btn');
        if (btn) {
            btn.style.display = 'none';
        }
        if (typeof Tawk_API !== 'undefined') {
            Tawk_API.hide();
        }
    });
</script>
@endpush
