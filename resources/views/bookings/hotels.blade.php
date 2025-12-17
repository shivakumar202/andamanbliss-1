@extends('layouts.app')
@section('title', 'My Hotel Bookings')

@section('content')
<section id="dashboard_main_arae" class="section_padding">
    <div class="container">
        <div class="row mt-5">
            @include('layouts.profile')

            <div class="col-lg-9">
                <div class="dashboard_common_table">
                    <h3>My Hotel Bookings</h3>
                    <div class="table-responsive-lg table_common_area">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>{{ __('Booking ID') }}</th>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Contact') }}</th>
                                    <th>{{ __('Booking From') }}</th>
                                    <th>{{ __('Package') }}</th>
                                    <th>{{ __('Rooms') }}</th>
                                    <th>{{ __('Total') }}</th>
                                    <th>{{ __('Action')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($bookings as $booking)
                                <tr>
                                    <td>
                                        #{{ str_pad(@$booking->booking_id, 11, '0', STR_PAD_LEFT) }}
                                    </td>
                                    <td>
                                        {{ ucwords(@$booking->paymentDetails[0]->name) }}
                                        @if (@$booking->table_type == 'services')
                                        <br />
                                        + {{ @$booking->adult - 1 }} Adult
                                        <br />
                                        & {{ @$booking->child }} Child
                                        @endif
                                    </td>
                                    <td>
                                        {{ @$booking->paymentDetails[0]->phone }}
                                        <br />
                                        {{ @$booking->paymentDetails[0]->email }}
                                    </td>
                                    <td>
                                        <strong>Checkin :</strong> {{ !empty(@$booking->check_in) ? date('Y-m-d', strtotime(@$booking->check_in)) : '' }}
                                        <br />to<br />
                                        <strong>Checkout :</strong> {{ !empty(@$booking->check_out) ? date('Y-m-d', strtotime(@$booking->check_out)) : '' }} 
                                        <br>
                                        <strong>Nights :</strong> {{$booking->nights}}
                                    </td>
                                    <td>
                                      
                                        <strong>Hotel Name :</strong> {{ ucwords(@$booking->hotel->hotel_name) }}: {{ ucwords(@$booking->service->name) }}
                                        <br />
                                        <strong>Room :</strong> {{ ucwords(@$booking->room_name) }}: {{ ucwords(@$booking->food_choice) }}
                                       
                                    </td>
                                    <td>{{ @$booking->rooms }}</td>
                                    <td>{{ number_format(@$booking->total_cost, 2) }}</td>
                                    <td>
                                        @if($booking->HotelBookingStatus == 'Confirmed')
                                        <a href="{{route('hotel.package.voucher',['book_id' => $booking->id])}}" target="blank" class="btn btn-sm btn-success rounded-0">view</a>
                                        @else
                                        <a href="" role="button" onclick="alert('booking cancelled')" class="btn btn-sm btn-warning rounded-0">cancelled</a>
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

    tr th{
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