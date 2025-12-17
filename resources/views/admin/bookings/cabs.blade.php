@extends('admin.layouts.app')

@section('title', __('Cab Booking'))

@section('content')
<!-- Heading -->
<div class="breadcrumbs">
  <div class="breadcrumbs-inner">
    <div class="row">
      <div class="col-sm-4">
        <div class="page-header float-left">
          <div class="page-title">
            <h1>{{ __('Cab Booking') }}</h1>
          </div>
        </div>
      </div>

      <div class="col-sm-6">
        <div class="page-header float-right">
          <div class="page-title">
            <ol class="breadcrumb text-right">
              <li><a href="{{ url('admin/home') }}">{{ __('Dashboard') }}</a></li>
              <li class="active">{{ __('Cab Booking') }}</li>
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
              {{ __('Cab Booking') }}
            </strong>
          </div>

          <div class="card-body">
            <form name="form" action="{{ url('admin/bookings/cabs') }}" method="GET" id="form" class="" enctype="multipart/form-data" novalidate="novalidate" autocomplete="off">
              <div class="row justify-content-center">

                <div class="col-md-4">
                  <div class="form-group">
                    <label for="category_id" class="control-label">
                      {{ __('Category') }}
                    </label>
                    <select name="category_id" id="category_id" class="form-control">
                      <option value="">{{ __('Select') }}</option>
                      @foreach ($categories as $category)
                      <option value="{{ $category }}" @selected(request('category')==$category)>{{ ucwords($category) }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>

                <div class="col-md-4 d-none">
                  <div class="form-group">
                    <label for="status" class="control-label">
                      {{ __('Status') }}
                    </label>
                    <select name="status" id="status" class="form-control">
                      <option value="">{{ __('Select') }}</option>
                      <option value="active" @selected(request('status')=='active' )>{{ __('Active') }}</option>
                      <option value="inactive" @selected(request('status')=='inactive' )>{{ __('Inactive') }}</option>
                    </select>
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
                  <a href="{{ url('admin/bookings/cabs') }}" class="btn btn-block btn-outline-info my-1">
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
                  <th>{{ __('Booking ID') }}</th>
                  <th>{{ __('Billing Details') }}</th>
                  <th>{{ __('Cab Detail') }}</th>
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
                    {{ ucwords(@$booking->name) }}
                    <br>
                    {{ @$booking->phone }}
                    <br>
                    {{ @$booking->email }}
                  </td>
                  <td>
                    Trip Type: {{ ucwords(@$booking->trip_type) }}
                    <br>
                    Cab : {{ ucwords(@$booking->cab) }}
                  </td>
                  <td>
                    Trip Type: {{ ucwords(@$booking->trip_type) }}
                    <hr />
                    Pickup : {{ ucwords(@$booking->pickup_location) }} - {{ \Carbon\carbon::parse(@$booking->pickup_datetime)->format('d-M-y , H:i A') }}
                    <hr>
                    Drop : {{ ucwords(@$booking->drop_location) }}
                  </td>
                  <td>
                    Base Cost: {{ number_format(@$booking->base_amt, 2) }}/-
                    <hr />
                    Tax : {{ number_format(@$booking->tax, 2) }}/-
                    <hr>
                    Total Amount : {{ number_format(@$booking->total_amt, 2) }}/-
                  </td>
                  <td>
                    @if(@$booking->payment->status != 0)
                    Total Paid : {{ @$booking->payment->amount }}
                    <hr />
                    Balance : {{ @$booking->total_amt - @$booking->payment->amount }}
                    @else
                    Total Paid : 0
                    <hr>
                    Balance : {{ number_format(@$booking->total_amt,2) }}
                    @endif
                  </td>
                  <td>{{ $booking->created_at->format('d-M-y , h:i A') }}</td>
                  <td>
                    @if(@$booking->payment->status == 'success')
                    <a href="{{ route('cab.voucher',['bookingId' => $booking->id]) }}" target="_blank" title="View Voucher" class="btn btn-xs btn-success py-0 mx-1">
                      View Voucher
                    </a>
                    @else

                    <button onclick="alert('payment cancelled')" class="bg-warning btn btn-sm text-white">Cancelled</button>

                    @endif

                    <button class="btn btn-danger btn-sm text-white mt-1" onclick="deletecab(this)" data-url="{{ route('admin.delete.cab-delete', $booking->id) }}"><i class="fa fa-trash"></i> Delete</button>

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

  function deletecab(btn) {
    let url = btn.getAttribute('data-url');
    Swal.fire({
      title: "Are You sure",
      text: "You won't be able to revert this!",
      icon: "warning",
      showCancelButton: true,
      confirmButtoncolor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, delete it!"

    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: url,
          type: "POST",
          data: {
            _token: '{{ csrf_token() }}'
          },
          success: function(response) {
            if (response.status === 200) {
              Swal.fire("Deleted!", "Cab Query Deleted", 'success').then(() => {
                location.reload();
              })
            }
          }
        })
      }
    });
  }
</script>
@endsection