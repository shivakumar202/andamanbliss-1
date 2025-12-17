@extends('admin.layouts.app')

@section('title', __('Tour Booking'))

@section('content')
<!-- Heading -->
<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>{{ __('Tour Booking') }}</h1>
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="{{ url('admin/home') }}">{{ __('Dashboard') }}</a></li>
                            <li class="active">{{ __('Tour Booking') }}</li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="col-sm-2">
                <a href="javascript:history.back();" class="btn btn-info float-right my-2 mx-3">
                    <i class="fa fa-undo fa-lg"></i>&nbsp;
                    {{ __('Back') }}
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Content -->
<div class="content">
    <!-- Animated -->
    <div class="animated fadeIn">

        @include('admin.layouts.alert')

        <!-- Form -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">
                            {{ __('Tour Booking') }}
                        </strong>
                    </div>

                    <div class="card-body">
                        <form name="form" action="{{ url('admin/bookings/tour-packages') }}" method="GET" id="form"
                            class="" enctype="multipart/form-data" novalidate="novalidate" autocomplete="off">
                            <div class="row justify-content-center">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="start_at" class="control-label">
                                            {{ __('Booking Form') }}
                                        </label>
                                        <input type="date" pattern="\d{4}-\d{2}-\d{2}" max="{{ date('Y-m-d') }}"
                                            name="start_at" placeholder="{{ __('yyyy-mm-dd') }}"
                                            value="{{ request('start_at') }}" id="start_at" class="form-control"
                                            autocomplete="off" />
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="end_at" class="control-label">
                                            {{ __('Booking To') }}
                                        </label>
                                        <input type="date" pattern="\d{4}-\d{2}-\d{2}" max="{{ date('Y-m-d') }}"
                                            name="end_at" placeholder="{{ __('yyyy-mm-dd') }}"
                                            value="{{ request('end_at') }}" id="end_at" class="form-control"
                                            autocomplete="off" />
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="category_id" class="control-label">
                                            {{ __('Category') }}
                                        </label>
                                        <select name="category_id" id="category_id" class="form-control">
                                            <option value="">{{ __('Select') }}</option>
                                            @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" @selected(request('category_id')==$category->id)>
                                                {{ ucwords($category->name) }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="booked_from" class="control-label">
                                            {{ __('Booked From') }}
                                        </label>
                                        <input type="date" pattern="\d{4}-\d{2}-\d{2}" max="{{ date('Y-m-d') }}"
                                            name="booked_from" placeholder="{{ __('yyyy-mm-dd') }}"
                                            value="{{ request('booked_from') }}" id="booked_from" class="form-control"
                                            autocomplete="off" />
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="booked_to" class="control-label">
                                            {{ __('Booked To') }}
                                        </label>
                                        <input type="date" pattern="\d{4}-\d{2}-\d{2}" max="{{ date('Y-m-d') }}"
                                            name="booked_to" placeholder="{{ __('yyyy-mm-dd') }}"
                                            value="{{ request('booked_to') }}" id="booked_to" class="form-control"
                                            autocomplete="off" />
                                    </div>
                                </div>


                            </div>

                            <div class="row align-items-center justify-content-center">
                                <div class="align-self-center col-md-2">
                                    <button type="submit" id="submit" class="btn btn-block btn-info my-1">
                                        <i class="fa fa-search fa-lg"></i>&nbsp;
                                        <span>{{ __('Search') }}</span>
                                    </button>
                                </div>

                                <div class="align-self-center col-md-2">
                                    <a href="{{ url('admin/bookings/tour-packages') }}"
                                        class="btn btn-block btn-outline-info my-1">
                                        <i class="fa fa-refresh fa-lg"></i>&nbsp;
                                        <span>{{ __('Reset') }}</span>
                                    </a>
                                </div>
                            </div>

                        </form>

                        <table id="dataTable" class="table table-striped table-hover w-100">
                            <thead class="thead-dark">
                                <tr>
                                    <th>{{ __('ID') }}</th>
                                    <th>{{ __('Package ID') }}</th>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Contact') }}</th>
                                    <th>{{ __('Package') }}</th>
                                    <th>{{ __('Guest')}}</th>
                                    <th>{{ __('Arrival Date') }}</th>
                                    <th style="width: 400px;">{{ __('Package Costing') }}</th>
                                    <th>{{ __('Payment ') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bookings as $booking)
                                <tr>
                                    <td>{{ @$booking->id }}</td>
                                    <td>
                                        #{{ $booking->booking_id }}
                                    </td>
                                    <td>
                                        {{ ucwords(@$booking->name) }}
                                    </td>
                                    <td style="font-size: 12px">
                                        {{ @$booking->phone }}
                                        <br />
                                        {{ @$booking->email }}
                                    </td>
                                    <td style="font-size: 10px;">
                                        {{ $booking->packageBookings->tour->package_name }}
                                        <br>
                                        {{ $booking->packageBookings->category }}
                                        <br>
                                        {{ $booking->packageBookings->tour->tourCategory->name }} Tour Package

                                    </td>
                                    <td>{{ implode(', ', array_map(fn($g) => "Adults: {$g['Adults']}, Children: {$g['Children']}", json_decode($booking->packageBookings->guest, true))) }}</td>

                                    <td style="font-size: 12px;">
                                        {{ $booking->packageBookings->start_date }}

                                    </td>
                                    <td style="font-size: 10px">

                                        @if ($booking->packageBookings->TourPricing)
                                        Base Price: {{ $booking->packageBookings->TourPricing->base_total ?? 0 }}
                                        <br>
                                        Markup: {{ $booking->packageBookings->TourPricing->markup ?? 0 }}
                                        <br>
                                        Total With Markup: {{ $booking->packageBookings->TourPricing->total_with_markup ?? 0 }}
                                        <br>
                                        <span class="text-danger p-0 m-0"> Discount: {{ $booking->packageBookings->TourPricing->discount ?? 0 }} %</span>
                                        <br>
                                        Total With Discount: {{ $booking->packageBookings->TourPricing->total_with_discount ?? 0 }}
                                        <br>
                                        Taxes + Fee: {{ $booking->packageBookings->TourPricing->gst_amount ?? 0 }}
                                        <br>
                                        <p class="p-0 fs-4 font-weight-bold text-info"> Grand Total: {{ $booking->packageBookings->TourPricing->grand_total ?? 0 }} </p>
                                        @else
                                        0.00
                                        @endif
                                    </td>
                                    <td>{{ number_format(@$booking->amount,2) }}</td>
                                    <td> @if ($booking->status != 'cancelled')
                                        <span class="text-success font-weight-bold h6">Success</span>
                                        @else
                                        <span class="text-danger font-weight-bold h6">Cancelled</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{route('admin.bookings.tour-package-show',['id' => $booking->booking_id])}}" class="btn btn-xs btn-outline-primary py-0 mx-1 " data-toggle="tooltip" data-placement="left" title="Tour Details">
                                            <i class="fa fa-qrcode"></i>
                                            <a href="https://wa.me/{{$booking->phone}}/?text=Hello From Andaman Bliss" class="btn btn-xs btn-outline-success py-0 mx-1 mt-2" data-toggle="tooltip" data-placement="left" title="Baatein karein">
                                                <i class="fa fa-whatsapp"></i></a>
                                            <button role="button" onclick="deleteTour(this)" data-url="{{ route('admin.delete.tour-delete',$booking->booking_id) }}" class="btn btn-sm btn-danger text-white mt-1">Delete <i class="fa fa-trash"> </i></button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div><!-- .card -->
            </div><!--/.col-->
        </div>
    </div>
    <!-- .animated -->
</div>
<!-- /.content -->
@endsection

@section('css')
<style type="text/css">
    td {
        font-size: 10px;
    }
</style>
@endsection

@section('script')
<script type="text/javascript">
    var datatable;

    $(document).ready(function() {
        datatable = $('#dataTable').DataTable({
            responsive: true,
            lengthMenu: [
                [10, 50, 100, -1],
                [10, 50, 100, 'All']
            ],
            pageLength: 10,
            aaSorting: [0, 'DESC'],
            columnDefs: [{
                    targets: [0], // column index
                    orderable: false,
                },
                {
                    targets: [0], // column index
                    searchable: false,
                },
                {
                    targets: [0], // column index
                    visible: false,
                }
            ],
            // dom: 'lBfrtip',
            dom: '<"row"<"col-sm-3"l><"col-sm-4"B><"col-sm-5"f>>' +
                '<"row"<"col-sm-12"tr>>' +
                '<"row"<"col-sm-5"i><"col-sm-7"p>>',
            buttons: [{
                extend: 'csv',
                text: 'CSV',
                filename: 'Tour Bookings',
                className: 'btn btn-xs btn-dark py-1',
                exportOptions: {
                    columns: ':visible:not(:last-child)'
                }
            }, {
                extend: 'excel',
                text: 'Excel',
                filename: 'Tour Bookings',
                className: 'btn btn-xs btn-dark py-1',
                exportOptions: {
                    columns: ':visible:not(:last-child)'
                }
            }, {
                extend: 'pdf',
                text: 'PDF',
                filename: 'Tour Bookings',
                className: 'btn btn-xs btn-dark py-1',
                exportOptions: {
                    columns: ':visible:not(:last-child)'
                }
            }]
        });
    });


    function deleteTour(btn) {
        let url = btn.getAttribute('data-url');
        Swal.fire({
            title: 'Are You sure!',
            text: "This can't be restore",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!..."
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: url,
                    type: 'post',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.status === 200) {
                            Swal.fire("deleted!", "Tour Enquiry Deleted", "success").then(() => {
                                setTimeout(location.reload(), 5000);
                            })
                        } else {
                            Swal.fire("Error!", "Must wash hands before deleting....", 'error');
                        }
                    },
                    error: function(xhr) {
                        Swal.fire("Error!", "Must wash hands before delete 🖐🏻", 'error');
                    }
                });
            }
        });
    }
</script>
@endsection