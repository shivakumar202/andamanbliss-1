@extends('admin.layouts.app')

@section('title', __('Ferry Booking'))

@section('content')
<!-- Heading -->
<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>{{ __('Ferry Booking') }}</h1>
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="{{ url('admin/home') }}">{{ __('Dashboard') }}</a></li>
                            <li class="active">{{ __('Ferry Booking') }}</li>
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
                            {{ __('Ferry Booking') }}
                        </strong>
                    </div>

                    <div class="card-body">
                        <table id="dataTable" class="table table-striped table-hover w-100">
                            <thead class="thead-dark">
                                <tr>
                                    <th>{{ __('Trip ID') }}</th>
                                    <th>{{ __('PNR No') }}</th>
                                    <th>{{ __('Billing Details') }}</th>
                                    <th>{{ __('Ferry') }}</th>
                                    <th style="min-width: 200px;">{{ __('Travle Details') }}</th>
                                    <th>{{ __('Pax Details') }}</th>
                                    <th style="min-width: 150px;">{{ __('Payment Details') }}</th>
                                    <th>{{ __('Created At') }}</th>
                                    <th>{{ __('Status') }}</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($bookings as $booking)
                                <tr>
                                    <td>{{ $booking->trip_id ?? 'N/A' }}</td>
                                    <td>{{ $booking->pnr_no ?? 'N/A' }}</td>
                                    <td>{{ ucwords($booking->name ?? 'N/A') }}
                                        <br>
                                        {{ $booking->phone ?? 'N/A' }}
                                        <br>
                                        {{ $booking->email ?? 'N/A' }}
                                    </td>
                                    <td>{{ ucwords($booking->ferry ?? 'N/A') }}</td>

                                    <td>
                                        From : {{ ucwords($booking->from_location ?? 'N/A') }} - {{ \Carbon\carbon::parse($booking->embarkation)->format('h:i A') }}
                                        <br>
                                        To : {{ ucwords($booking->to_location ?? 'N/A') }} - {{ \Carbon\carbon::parse($booking->disembarkation)->format('h:i A') }}
                                        <br>
                                        Travel Date : {{ !empty($booking->travel_date) ? date('Y-m-d', strtotime($booking->travel_date)) : 'N/A' }}
                                    </td>
                                    <td>
                                        Adult's {{ $booking->Adult ?? 0 }} <br />
                                        Infant's {{ $booking->Infants ?? 0 }}
                                    </td>

                                    <td>
                                        Base Fare : {{ number_format($booking->baseFare ?? 0, 2) }} <br />
                                        Infant Fare : {{ number_format($booking->infantFare ?? 0, 2) }} <br />
                                        Pstf : {{ number_format($booking->psf ?? 0, 2) }} <br />
                                        Total Cost : {{ number_format($booking->totalCost ?? 0, 2) }}
                                    </td>
                                    <td>{{ $booking->created_at->format('d-M-y , h:i A') }}</td>
                                    <td>
                                        @if ($booking->booking_status == 1)
                                        <a href="{{ route('ferry-ticket', ['token' => $booking->pnr_no ?? $booking->id]) }}"
                                            class="btn btn-xs btn-success py-0 mx-1" title="View Ticket">
                                           View Ticket
                                        </a>
                                      
                                        @else
                                                                             <button onclick="alert('payment cancelled')"
                                            class="btn btn-xs btn-warning py-0 mx-1" title="View Ticket">
                                             Cancelled
                                        </button>

                                        @endif
                                        <button class="btn btn-sm btn-danger mt-1" onclick="deletefer(this)" data-url="{{ route('admin.delete.ferry-delete',$booking->id) }}" ><i class="fa fa-trash"></i> Delete</button>
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
        font-size: small;
        border: 1px solid #ddd;
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
                filename: 'Ferry Bookings',
                className: 'btn btn-xs btn-dark py-1',
                exportOptions: {
                    columns: ':visible:not(:last-child)'
                }
            }, {
                extend: 'excel',
                text: 'Excel',
                filename: 'Ferry Bookings',
                className: 'btn btn-xs btn-dark py-1',
                exportOptions: {
                    columns: ':visible:not(:last-child)'
                }
            }, {
                extend: 'pdf',
                text: 'PDF',
                filename: 'Ferry Bookings',
                className: 'btn btn-xs btn-dark py-1',
                exportOptions: {
                    columns: ':visible:not(:last-child)'
                }
            }]
        });
    });

    function deletefer(btn)
    {
        let url = btn.getAttribute('data-url');
        Swal.fire({
            title: "Are You Sure!",
            text: "You wont't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if(result.isConfirmed) {
                $.ajax({
                    url: url,
                    type: "POST",
                    data:{
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if(response.status === 200) {
                            Swal.fire("Deleted!","Ferry Enquiry Deleted","success").then(() => {
                                location.reload();
                            })
                        }
                    }
                })
            }
        })
    }
</script>
@endsection