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
            <form name="form" action="{{ url('admin/bookings/tours') }}" method="GET" id="form" class="" enctype="multipart/form-data" novalidate="novalidate" autocomplete="off">
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
                      <option value="{{ $category->id }}" @selected(request('category_id') == $category->id)>{{ ucwords($category->name) }}</option>
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
                      <option value="{{ $tableType }}" @selected(request('table_type') == $tableType)>{{ ucwords($tableType) }}</option>
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
                      <option value="active" @selected(request('status') == 'active')>{{ __('Active') }}</option>
                      <option value="inactive" @selected(request('status') == 'inactive')>{{ __('Inactive') }}</option>
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
                  <a href="{{ url('admin/bookings/tours') }}" class="btn btn-block btn-outline-info my-1">
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
                  <th>{{ __('Booking From') }}</th>
                  <th>{{ __('Package') }}</th>
                  <th>{{ __('Rate') }}</th>
                  <th>{{ __('Quantity') }}</th>
                  <th>{{ __('Price') }}</th>
                  <th>{{ __('Created') }}</th>
                  {{-- <th>{{ __('Status') }}</th> --}}
                  <th>{{ __('Action') }}</th>
                </tr>
              </thead>

              <tbody>
                @foreach($bookings as $booking)
                <tr>
                  <td>{{ @$booking->id }}</td>
                  <td>
                    #{{ str_pad(@$booking->booking_id, 2, '0', STR_PAD_LEFT) }}
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
                    {{ !empty(@$booking->start_at) ? date('Y-m-d', strtotime(@$booking->start_at)) : '' }}
                    {{-- <br />to<br />
                    {{ !empty(@$booking->end_at) ? date('Y-m-d', strtotime(@$booking->end_at)) : '' }} --}}
                  </td>
                  <td>
                    @if (@$booking->table_type == 'addons')
                    {{ ucwords(@$booking->table_type) }}: {{ @$booking->addon->name }}
                    @else
                    {{ ucwords(@$booking->service->category->name) }}: {{ ucwords(@$booking->service->name) }}
                    @endif
                  </td>
                  <td>{{ number_format(@$booking->rate, 2) }}</td>
                  <td>{{ @$booking->quantity }}</td>
                  <td>{{ number_format(@$booking->price, 2) }}</td>
                  <td>{{ (@$booking->created_at) }}</td>

                  {{-- <td>
                    <div class="custom-control custom-switch">
                      <input onchange="changeStatus(this)" type="checkbox" name="status-{{ @$booking->id }}" value="active" data-id="{{ @$booking->id }}" data-status="{{ @$booking->status == 'active' ? 'inactive' : 'active' }}" id="status-{{ @$booking->id }}" class="custom-control-input" @checked(@$booking->status == 'active') />
                      <label class="custom-control-label" for="status-{{ @$booking->id }}">{{ ucwords(@$booking->status) }}</label>
                    </div>
                  </td> --}}
                  {{-- <td>
                    <a href="{{ url('admin/bookings/tours/' . @$booking->id) }}" title="Details" class="btn btn-xs btn-dark py-0 mx-1">
                      <i class="fa fa-eye"></i>
                    </a>
                    <a href="{{ url('admin/bookings/tours/' . @$booking->id . '/edit') }}" title="Edit" class="btn btn-xs btn-outline-info py-0 mx-1">
                      <i class="fa fa-pencil-square-o"></i>
                    </a> --}}
                     <td> <a onClick="if (confirm('Are you sure?')) return this.nextElementSibling.submit();" href="javascript:;" title="Delete" class="btn btn-xs btn-outline-danger py-0 mx-1">
                      <i class="fa fa-trash-o"></i>
                    </a>
                    <form action="{{ url('admin/bookings/enquiry/'.@$booking->id.'/destroy') }}" method="POST"
                      class="d-none">
                      @method('DELETE')
                      @csrf
                    </form>
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

  function changeStatus(selector) {
    let id = $(selector).data('id');
    // let status = $(selector).data('status');
    let status = 'inactive';
    if ($(selector).is(':checked')) {
      status = 'active';
    }
    // console.log({status});

    $.ajax({
      method: 'POST',
      url: "{{ url('admin/bookings/tours/changeStatus') }}",
      data: {
        id: id,
        status: status
      },
      dataType: 'json'
    })
    .done(function(data) {
      console.log('success', data);
    })
    .fail(function(data) {
      console.log('error', data);
    })
    .always(function(data) {
      console.log('complete', data);
      datatable.draw(); // Refilter the table
      // location.reload();
    });
  }
</script>
@endsection