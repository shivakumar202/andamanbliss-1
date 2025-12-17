@extends('layouts.app')
@section('title', 'My Cab Bookings')

@section('content')
<section id="dashboard_main_arae" class="section_padding">
    <div class="container">
        <div class="row mt-5">
            @include('layouts.profile')

            <div class="col-lg-9">
                <div class="dashboard_common_table">
                    <h3>My Cab Bookings</h3>
                    <div class="table-responsive-lg table_common_area">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>{{ __('Booking ID') }}</th>
                                    <th>{{ __('Contact Detail') }}</th>
                                    <th>{{ __('Cab') }}</th>
                                    <th style="width: 200px;">{{ __('Trip Detail') }}</th>
                                    <th>{{ __('Total Cost') }}</th>
                                    <th>{{ __('Status') }}</th>

                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($bookings as $booking)
                                <tr>
                                    <td>
                                        #{{ str_pad(@$booking->id, 2, '0', STR_PAD_LEFT) }}
                                    </td>
                                    <td>
                                        {{ ucwords(@$booking->name) }}
                                        <br />
                                        {{ @$booking->phone }}
                                        <br />
                                        {{ @$booking->email }}
                                    </td>
                                    <td>

                                        <br />
                                        <strong>Cab : </strong>{{ ucwords(@$booking->cab) }}
                                        <br>
                                        <strong>Seating : </strong>{{$booking->cabs->sitting_capacity}}
                                        <br>
                                        <strong>Category : </strong>{{$booking->cabs->category}}
                                    </td>
                                    <td>
                                        <strong>Trip : </strong> {{$booking->trip_type}}
                                        <br>
                                        <strong>Trip Date : </strong> {{\Carbon\carbon::parse($booking->pickup_date)->format('d-m-y H:i A')}}
                                        <br>
                                        <strong>Pickup Location : </strong>{{$booking->pickup_location}}
                                        <br>
                                        <strong>Drop Location : </strong>{{$booking->drop_location}}
                                    </td>

                                    <td>{{ number_format(@$booking->total_amt, 2) }}</td>
                                    <td>
                                        @if($booking->status == 'success')
                                        <a href="{{ route('cab.voucher',['bookingId' => $booking->id]) }}" target="_blank" class="btn btn-sm btn-success rounded-0">view</a>
                                        @else
                                        <a href="" onclick="alert('Booking Cancelled')" role="button" class="btn btn-sm btn-warning rounded-0">cancelled</a>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8">No booking found.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    @if ($bookings->hasPages())
                    <div class="d-flex justify-content-center mt-4">
                        <ul class="pagination custom-pagination mb-0">
                            {{-- Previous Page --}}
                            @if ($bookings->onFirstPage())
                            <li class="page-item disabled">
                                <span class="page-link">&laquo;</span>
                            </li>
                            @else
                            <li class="page-item">
                                <a href="{{ $bookings->previousPageUrl() }}" class="page-link" rel="prev">&laquo;</a>
                            </li>
                            @endif

                            @foreach ($bookings->links()->elements[0] ?? [] as $page => $url)
                            @if ($page == $bookings->currentPage())
                            <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                            @else
                            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                            @endif
                            @endforeach

                            @if ($bookings->hasMorePages())
                            <li class="page-item">
                                <a href="{{ $bookings->nextPageUrl() }}" class="page-link" rel="next">&raquo;</a>
                            </li>
                            @else
                            <li class="page-item disabled">
                                <span class="page-link">&raquo;</span>
                            </li>
                            @endif
                        </ul>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style type="text/css">
    /* page styles */
    .custom-pagination {
        gap: 6px;
    }

    .custom-pagination .page-item .page-link {
        border: 1px solid #ddd;
        color: #007bff;
        border-radius: 8px;
        padding: 6px 14px;
        transition: 0.2s ease-in-out;
        font-weight: 500;
    }

    .custom-pagination .page-item.active .page-link {
        background-color: #007bff;
        border-color: #007bff;
        color: #fff;
    }

    .custom-pagination .page-item .page-link:hover {
        background-color: #f1f1f1;
        text-decoration: none;
    }

    .custom-pagination .page-item.disabled .page-link {
        background-color: #f8f9fa;
        color: #bbb;
        pointer-events: none;
    }

    td {
        font-size: 10px;
        border: 1px solid #bbb;
    }

    tr th {
        font-size: 12px;
        border: 1px solid #1f1f1fff;
        background: red;

    }
</style>
@endpush

@push('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        // page scripts
    });
</script>
@endpush