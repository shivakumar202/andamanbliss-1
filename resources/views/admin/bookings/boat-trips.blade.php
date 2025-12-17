@extends('admin.layouts.app')

@section('title', __('Boat Trip Booking'))

@section('content')
<!-- Heading -->
<div class="breadcrumbs">
  <div class="breadcrumbs-inner">
    <div class="row">
      <div class="col-sm-4">
        <div class="page-header float-left">
          <div class="page-title">
            <h1>{{ __('Boat Trip Booking') }}</h1>
          </div>
        </div>
      </div>

      <div class="col-sm-6">
        <div class="page-header float-right">
          <div class="page-title">
            <ol class="breadcrumb text-right">
              <li><a href="{{ url('admin/home') }}">{{ __('Dashboard') }}</a></li>
              <li class="active">{{ __('Boat Trip Booking') }}</li>
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
              {{ __('Boat Trip Booking') }}
            </strong>
          </div>

          <div class="card-body">

            <table id="dataTable" class="table table-striped table-hover w-100">
              <thead class="thead-dark">
                <tr>
                  <th>{{ __('ID') }}</th>
                  <th>{{ __('Booking ID') }}</th>
                  <th>{{ __('Billing Details') }}</th>
                  <th>{{ __('Trip Details') }}</th>
                  <th>{{ __('Pricing') }}</th>
                  <th>{{ __('Payment') }}</th>
                  <th>{{ __('Created At') }}</th>
                  <th>{{ __('Action') }}</th>
                </tr>
              </thead>

              <tbody>
                @foreach($bookings as $booking)
                <tr>
                  <td>{{ @$booking->id }}</td>
                  <td>
                    #{{ str_pad(@$booking->id, 3, '0', STR_PAD_LEFT) }}
                  </td>
                  <td>
                    {{ ucwords(@$booking->payment->name) }}
                    <br>
                    {{ @$booking->payment->phone }}
                    <br>
                    {{ @$booking->payment->email }}
                  </td>

                  <td>
                    Trip : {{ ucwords(@$booking->trip_name) }}
                    <hr />
                    Slot : {{ \Carbon\carbon::parse(@$booking->trip_date)->format('d-M-Y') }} - {{ \Carbon\carbon::parse(@$booking->slot_time)->format('H:i A') }}

                  </td>
                  <td>
                    Base Cost: {{ number_format(@$booking->base_cost, 2) }}/-
                    <hr />
                    Tax : {{ number_format(@$booking->tax, 2) }}/-
                    <hr>
                    Total Amount : {{ number_format(@$booking->total_amt, 2) }}/-
                  </td>
                  <td>
                    @if(@$booking->payment->status == 'completed')
                    Total Paid : {{ @$booking->payment->amount }}
                    <hr />
                    Balance : {{ @$booking->total_amt - @$booking->payment->amount }}
                    @else
                    Total Paid : 0
                    <hr>
                    Balance : {{ number_format(@$booking->total_amt,2) }}
                    @endif
                  </td>
                  <td>
                    {{@$booking->created_at->format('d-M-y, h:i A')}}
                  </td>
                  <td>
                    @if(@$booking->payment->status == 'completed')
                    <a href="{{ route('boat-trip-voucher',['bookingId' => $booking->id]) }}" target="_blank" title="View Voucher" class="btn btn-xs btn-success py-0 mx-1 mb-1">
                      <i class="fa fa-download"></i> Voucher
                    </a>
                    @else

                    <button onclick="alert('payment cancelled')" class="bg-warning btn btn-sm text-white">Cancelled</button>

                    @endif
                    <button onclick="deletetbook(this)"
                      data-url="{{ route('admin.delete.boat-trip', $booking->id) }}"
                      class="btn btn-danger btn-sm">
                      Delete
                    </button>


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

  td:hover {
    border: 1px solid #000000ff;
    cursor: pointer;
  }

  hr {
    margin: 0.2rem 0;
    border-top: 1px dashed #000000;
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
        filename: 'Cab Bookings',
        className: 'btn btn-xs btn-dark py-1',
        exportOptions: {
          columns: ':visible:not(:last-child)'
        }
      }, {
        extend: 'excel',
        text: 'Excel',
        filename: 'Cab Bookings',
        className: 'btn btn-xs btn-dark py-1',
        exportOptions: {
          columns: ':visible:not(:last-child)'
        }
      }, {
        extend: 'pdf',
        text: 'PDF',
        filename: 'Cab Bookings',
        className: 'btn btn-xs btn-dark py-1',
        exportOptions: {
          columns: ':visible:not(:last-child)'
        }
      }]
    });

  });

  function deletetbook(btn) {

    let url = btn.getAttribute("data-url"); // now btn works

    Swal.fire({
      title: "Are you sure?",
      text: "You won't be able to revert this!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, delete it!"
    }).then((result) => {

      if (result.isConfirmed) {
        $.ajax({
          url: url,
          type: "POST",
          data: {
            _token: "{{ csrf_token() }}"
          },
          success: function(response) {
            if (response.status === 200) {
              Swal.fire("Deleted!", "Boat Trip Deleted", "success").then(() => {
                location.reload();
              });
            }
          },
          error: function(xhr) {
            Swal.fire("Error!", "Something went wrong. Call the developer 🤙.", "error");
          }
        });
      }

    });

  }
</script>
@endsection