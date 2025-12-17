@extends('admin.layouts.app')

@section('title', __('Hotel Booking'))

@section('content')
<!-- Heading -->
<div class="breadcrumbs">
  <div class="breadcrumbs-inner">
    <div class="row">
      <div class="col-sm-4">
        <div class="page-header float-left">
          <div class="page-title">
            <h1>{{ __('Hotel Booking') }}</h1>
          </div>
        </div>
      </div>

      <div class="col-sm-6">
        <div class="page-header float-right">
          <div class="page-title">
            <ol class="breadcrumb text-right">
              <li><a href="{{ url('admin/home') }}">{{ __('Dashboard') }}</a></li>
              <li class="active">{{ __('Hotel Booking') }}</li>
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
              {{ __('Hotel Booking') }}
            </strong>
          </div>

          <div class="card-body">
           
            <table id="dataTable" class="table table-striped table-hover w-100">
              <thead class="thead-dark">
                <tr>
                  <th>{{ __('ID') }}</th>
                  <th>{{ __('Booking ID') }}</th>
                  <th>{{ __('Billing Detail') }}</th>
                  <th>{{ __('Booking Detail') }}</th>
                  <th>{{ __('Hotel Details') }}</th>
                  <th>{{ __('Pricing') }}</th>
                  <th>{{ __('Booked On') }}</th>                 
                 <th>{{ __('Status') }}</th> 
                </tr>
              </thead>
              <tbody>
                @foreach($bookings as $booking)
                <tr>
                  <td>{{ @$booking->id }}</td>
                  <td>
                    #{{ (@$booking->BookingId ?? 'cancelled') }}
                  </td>
                  <td>
                    {{ ucwords(@$booking->paymentDetails[0]->name) }} 
                    <br>
                    {{ ucwords(@$booking->paymentDetails[0]->email) }} 
                    <br>
                    {{ ucwords(@$booking->paymentDetails[0]->phone) }}
                   
                  </td>
                  <td>
                   Check In : {{ @$booking->check_in }}
                    <br />
                   Check Out : {{ @$booking->check_out }}
                    <br />
                   Nights : {{ @$booking->nights }}
                  </td>
                  <td>
                   Hotel : {{ @$booking->hotel->hotel_name }}
                    <br />
                  Room : {{ @$booking->room_name }}
                  <br>
                  Rooms : {{ @$booking->rooms }}
                  </td>
                  <td>
                   Price : {{ number_format(@$booking->net_amt, 2) }}
                    <hr>
                   Paid : {{ number_format(@$booking->paymentDetails[0]->amount ,2) }}
                   </td>
                    <td>{{ \Carbon\carbon::parse($booking->created_at)->format('d M y, h:i A') }}</td>                                 
                   <td>
                    @if(@$booking->Status == 1)
                    <a href="{{ route('hotel.payment.voucher' , ['book_id' => $booking->id]) }}" target="_blank" title="Booking Voucher" class="btn btn-xs btn-success py-0 mx-1">
                      Voucher
                    </a>
                    @else
                    <span role="button"  onclick="alert('payment cancelled')" class="text-white bg-warning btn-sm " style="cursor:pointer;">Cancelled</span>
                    @endif
                  <button class="btn btn-sm btn-danger mt-1" onclick="deletehtl(this)" data-url="{{ route('admin.delete.hotel-delete',$booking->id) }}"><i class="fa fa-trash"></i> Delete</button>
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
  td{
    font-size: small;
    border: 1px solid #ddd;
  }
  hr{
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
      lengthMenu: [[10, 50, 100, -1], [10, 50, 100, 'All']],
      pageLength: 10,
      aaSorting: [0, 'DESC'],
      columnDefs: [
        {
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
        filename: 'Hotel Bookings',
        className: 'btn btn-xs btn-dark py-1',
        exportOptions: {
          columns: ':visible:not(:last-child)'
        }
      }, {
        extend: 'excel',
        text: 'Excel',
        filename: 'Hotel Bookings',
        className: 'btn btn-xs btn-dark py-1',
        exportOptions: {
          columns: ':visible:not(:last-child)'
        }
      }, {
        extend: 'pdf',
        text: 'PDF',
        filename: 'Hotel Bookings',
        className: 'btn btn-xs btn-dark py-1',
        exportOptions: {
          columns: ':visible:not(:last-child)'
        }
      }]
    });
  });

  function deletehtl(btn){
    let url = btn.getAttribute('data-url');
    Swal.fire({
      title: 'Are You Sure!',
      text: "You Won't be to revert this..",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, delete it!..",
    }).then((result) => {
      if(result.isConfirmed) {
        $.ajax({
          url : url,
          type: 'post',
          data : {
            _token : '{{ csrf_token() }}',
          },
          success: function(response) {
            if(response.status === 200) {
              Swal.fire('deleted!', 'Hotel Enquiry Deleleted','success').then(() => {
                setTimeout(location.reload(),6000);
              })
            }
          }, error: function(xhr) {
            Swal.fire("Error!","Must wash hands before delete 🖐🏻","error");
          }
        });
      }
    });
  }
  
</script>
@endsection