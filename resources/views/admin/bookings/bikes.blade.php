@extends('admin.layouts.app')

@section('title', __('Bike Booking'))

@section('content')
<!-- Heading -->
<div class="breadcrumbs">
  <div class="breadcrumbs-inner">
    <div class="row">
      <div class="col-sm-4">
        <div class="page-header float-left">
          <div class="page-title">
            <h1>{{ __('Bike Booking') }}</h1>
          </div>
        </div>
      </div>

      <div class="col-sm-6">
        <div class="page-header float-right">
          <div class="page-title">
            <ol class="breadcrumb text-right">
              <li><a href="{{ url('admin/home') }}">{{ __('Dashboard') }}</a></li>
              <li class="active">{{ __('Bike Booking') }}</li>
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
              {{ __('Bike Booking') }}
            </strong>
          </div>

          <div class="card-body">

            <table id="dataTable" class="table table-striped table-hover w-100">
              <thead class="thead-dark">
                <tr>
                  <th>{{ __('ID') }}</th>
                  <th>{{ __('Booking ID') }}</th>
                  <th>{{ __('Name') }}</th>
                  <th>{{ __('Contact') }}</th>
                  <th>{{ __('Rental Location') }}</th>
                  <th>{{ __('Rental Dates')}}</th>
                  <th>{{ __('Bike Nos.')}}</th>
                  <th>{{ __('Pickup ') }}</th>
                  <th>{{ __('Total Cost') }}</th>
                  <th>{{ __('Paid') }}</th>
                  <th>Created At</th>
                  <th>{{ __('Status') }}</th>
                </tr>
              </thead>
              <tbody>
                @foreach($bookings as $booking)
                <tr>
                  <td>{{ @$booking->id }}</td>
                  <td>
                    #{{ @$booking->id }}
                  </td>
                  <td>
                    {{ ucwords(@$booking->name) }}

                  </td>
                  <td>
                    {{ @$booking->payment->phone }}
                    <br />
                    {{ @$booking->email }}

                  </td>
                  <td>
                    {{$booking->to_location }}
                  </td>
                  <td>
                    Pickup : {{$booking->pickup_date .' - ' . $booking->pickup_time}}
                    <hr class="py-0 my-0">
                    Drop : {{$booking->return_date}}
                  </td>
                  <td>{{$booking->cab_quantity}}</td>
                  <td style="font-size: 12px;">
                    {{$booking->pickup}}
                    @if($booking->pickup_location)
                    <br>
                    <strong>Pickup Location : {{$booking->pickup_location}}</strong>
                    @endif
                  </td>
                  <td>{{ number_format(@$booking->total_fare, 2) }}</td>
                  <td>{{ @$booking->payment->amount }}</td>
                  <td>{{ @$booking->created_at->format('d-M-y, h:i A') }}</td>
                  <td>
                    @if($booking->status == 'confirmed')

                    <a href="{{ route('bike.voucher',['bookingId' => $booking->id]) }}" target="_blank" title="Details" class="btn btn-sm btn-success py-0 mx-1">
                      View Voucher
                    </a>
                    @else
                    <button class="btn btn-sm btn-warning" onclick="alert('Payment Cancelled')">Cancelled</button>
                    @endif
                    <button class="btn btn-danger btn-sm" data-url="{{ route('admin.delete.bike-rent',$booking->id) }}" onclick="deletebook(this)"><i class="fa fa-trash"></i> Delete</button>
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
    font-size: 11px;
  }

  th {
    font-size: 12px;
  }

  td {
    border: 1px solid #ddd;
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
        filename: 'Bike Bookings',
        className: 'btn btn-xs btn-dark py-1',
        exportOptions: {
          columns: ':visible:not(:last-child)'
        }
      }, {
        extend: 'excel',
        text: 'Excel',
        filename: 'Bike Bookings',
        className: 'btn btn-xs btn-dark py-1',
        exportOptions: {
          columns: ':visible:not(:last-child)'
        }
      }, {
        extend: 'pdf',
        text: 'PDF',
        filename: 'Bike Bookings',
        className: 'btn btn-xs btn-dark py-1',
        exportOptions: {
          columns: ':visible:not(:last-child)'
        }
      }]
    });
  });

  function deletebook(btn) {
    let url = btn.getAttribute('data-url');
    Swal.fire({
      title: "Are you sure?",
      text: "You won't be able to revet this!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, delete it!"
    }).then((result) => {

      if (result.isConfirmed) {
         $.ajax({
          url : url,
          type: "POST",
          data: {
            _token: "{{ csrf_token() }}"
          },
          success: function(response) {
            if(response.status === 200) {
              Swal.fire("Deleted!","Bike Booking Delete","success").then(() => {
                location.reload();
              })
            }
          },
          error: function(xhr) {
            Swal.fire("Error!","Yahan kuch toh gadbad hai..🤙","error");
          }
         });
      }
    });
  }
</script>
@endsection