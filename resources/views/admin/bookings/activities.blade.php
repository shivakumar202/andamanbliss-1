@extends('admin.layouts.app')

@section('title', __('Activity Booking'))

@section('content')
<!-- Heading -->
<div class="breadcrumbs">
  <div class="breadcrumbs-inner">
    <div class="row">
      <div class="col-sm-4">
        <div class="page-header float-left">
          <div class="page-title">
            <h1>{{ __('Activity Booking') }}</h1>
          </div>
        </div>
      </div>

      <div class="col-sm-6">
        <div class="page-header float-right">
          <div class="page-title">
            <ol class="breadcrumb text-right">
              <li><a href="{{ url('admin/home') }}">{{ __('Dashboard') }}</a></li>
              <li class="active">{{ __('Activity Booking') }}</li>
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
              {{ __('Activity Booking') }}
            </strong>
          </div>

          <div class="card-body">
            <form name="form" action="{{ url('admin/bookings/activities') }}" method="GET" id="form" class="" enctype="multipart/form-data" novalidate="novalidate" autocomplete="off">
              <div class="row justify-content-center">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="start_at" class="control-label">
                      {{ __('Booking Form') }}
                    </label>
                    <input type="date" pattern="\d{4}-\d{2}-\d{2}" max="{{ date('Y-m-d') }}" name="start_at" placeholder="{{ __('yyyy-mm-dd') }}" value="{{ request('start_at') }}" id="start_at" class="form-control" autocomplete="off" />
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label for="end_at" class="control-label">
                      {{ __('Booking To') }}
                    </label>
                    <input type="date" pattern="\d{4}-\d{2}-\d{2}" max="{{ date('Y-m-d') }}" name="end_at" placeholder="{{ __('yyyy-mm-dd') }}" value="{{ request('end_at') }}" id="end_at" class="form-control" autocomplete="off" />
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
                      <option value="{{ $category->id }}" @selected(request('category_id')==$category->id)>{{ ucwords($category->name) }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label for="booked_from" class="control-label">
                      {{ __('Booked From') }}
                    </label>
                    <input type="date" pattern="\d{4}-\d{2}-\d{2}" max="{{ date('Y-m-d') }}" name="booked_from" placeholder="{{ __('yyyy-mm-dd') }}" value="{{ request('booked_from') }}" id="booked_from" class="form-control" autocomplete="off" />
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label for="booked_to" class="control-label">
                      {{ __('Booked To') }}
                    </label>
                    <input type="date" pattern="\d{4}-\d{2}-\d{2}" max="{{ date('Y-m-d') }}" name="booked_to" placeholder="{{ __('yyyy-mm-dd') }}" value="{{ request('booked_to') }}" id="booked_to" class="form-control" autocomplete="off" />
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label for="table_type" class="control-label">
                      {{ __('Type') }}
                    </label>
                    <select name="table_type" id="table_type" class="form-control">
                      <option value="">{{ __('Select') }}</option>
                      @foreach ($tableTypes as $tableType)
                      <option value="{{ $tableType }}" @selected(request('table_type')==$tableType)>{{ ucwords($tableType) }}</option>
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
                  <a href="{{ url('admin/bookings/activities') }}" class="btn btn-block btn-outline-info my-1">
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
                  <th>{{ __('Name') }}</th>
                  <th>{{ __('Contact') }}</th>
                  <th>{{ __('Activity') }}</th>
                  <th>{{ __('Participants') }}</th>
                  <th>{{ __('Price') }}</th>
                  <th>{{ __('Total Cost') }}</th>
                  <th>{{ __('Booked On') }}</th>
                  <th>{{ __('Status') }}</th>
                </tr>
              </thead>

              <tbody>
                @foreach($bookings as $booking)
                <tr>
                  <td>{{ @$booking->id }}</td>
                  <td>
                    #{{ (@$booking['ticket_code']) ?? 'cancelled' }}
                  </td>
                  <td>
                    {{ ucwords(@$booking->name) }} {{ ucwords(@$booking->surname) }}
                    @if (@$booking->table_type == 'services')
                    <br />
                    + {{ @$booking->adult - 1 }} Adult
                    <br />
                    & {{ @$booking->child }} Child
                    @endif
                  </td>
                  <td>
                    {{ @$booking->mobile }}
                    <br />
                    {{ @$booking->email }}
                    <br />
                    {{ ucwords(@$booking->address) }}
                  </td>
                  <td>
                    {{ $booking['activity']->service_name ?? '' }}
                    <br />
                    <hr>
                    Acitivity Date : {{ \Carbon\carbon::parse(@$booking->start_at)->format('d-m-Y') }}
                  </td>
                  <td>
                    Adult: {{ @$booking->adult }}
                    <br />
                    Child: {{ @$booking->child }}
                  </td>
                  <td>{{ number_format(@$booking->rate, 2) }}</td>
                  <td>{{ number_format(@$booking->price, 2 ?? 0) }}</td>
                  <td>
                    {{ \Carbon\carbon::parse(@$booking->created_at)->format('d-M-Y H:i A') }}
                  </td>
                  <td>
                    @if($booking->status == 'active')
                    <a href="{{ route('activity.payment.voucher',['book_id' => $booking['ticket_code']]) }}" target="_blank" title="Details" class="btn btn-xs btn-info py-0 mx-1">
                      Pass
                    </a>
                    <a href="{{ route('activity.package.voucher' , ['ticket_no' => $booking['ticket_code']]) }}" target="_blank" title="Details" class="btn btn-xs btn-success py-0 mx-1 mt-2"> Vocuher</a>
                    @else
                    <button class="btn btn-sm btn-text btn-warning">{{ __('Cancelled') }}</button>
                    @endif
                    <button class="btn btn-sm btn-danger mt-1" onclick="deleteact(this)" data-url="{{ route('admin.delete.activity-delete',$booking->id) }}"><i class="fa fa-trash"></i> Deletes</button>
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
        filename: 'Activity Bookings',
        className: 'btn btn-xs btn-dark py-1',
        exportOptions: {
          columns: ':visible:not(:last-child)'
        }
      }, {
        extend: 'excel',
        text: 'Excel',
        filename: 'Activity Bookings',
        className: 'btn btn-xs btn-dark py-1',
        exportOptions: {
          columns: ':visible:not(:last-child)'
        }
      }, {
        extend: 'pdf',
        text: 'PDF',
        filename: 'Activity Bookings',
        className: 'btn btn-xs btn-dark py-1',
        exportOptions: {
          columns: ':visible:not(:last-child)'
        }
      }]
    });
  });

  function deleteact(btn) {
    let url = btn.getAttribute('data-url');
    Swal.fire({
      title: 'Are You Sure!',
      text: "You won't be revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, delete it!.."
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
              Swal.fire("deleted!", "Activity Enquiry Deleted", "success").then(() => {
                setTimeout(location.reload(), 5000);
              })
            }
          }, error: function(xhr) {
            Swal.fire("Error!","Must wash hands before delete 🫷🏻","error");
          }
        });
      }
    })
  }
</script>
@endsection