@extends('admin.layouts.app')

@section('title', __('Lead'))

@section('content')
<!-- Heading -->
<div class="breadcrumbs">
  <div class="breadcrumbs-inner">
    <div class="row">
      <div class="col-sm-4">
        <div class="page-header float-left">
          <div class="page-title">
            <h1>{{ __('Lead') }}</h1>
          </div>
        </div>
      </div>

      <div class="col-sm-6">
        <div class="page-header float-right">
          <div class="page-title">
            <ol class="breadcrumb text-right">
              <li><a href="{{ url('admin/home') }}">{{ __('Dashboard') }}</a></li>
              <li class="active">{{ __('Lead') }}</li>
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
              {{ __('Lead') }}
            </strong>
          </div>

          <div class="card-body">
            <form name="form" action="{{ url('admin/leads') }}" method="GET" id="form" class="" enctype="multipart/form-data" novalidate="novalidate" autocomplete="off">
              <div class="row justify-content-center">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="travel_from" class="control-label">
                      {{ __('Travel From') }}
                    </label>
                    <input type="date" pattern="\d{4}-\d{2}-\d{2}" min="{{ date('Y-m-d') }}" name="travel_from" placeholder="{{ __('yyyy-mm-dd') }}" value="{{ request('travel_from') }}" id="travel_from" class="form-control" autocomplete="off" />
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label for="travel_to" class="control-label">
                      {{ __('Travel To') }}
                    </label>
                    <input type="date" pattern="\d{4}-\d{2}-\d{2}" min="{{ date('Y-m-d') }}" name="travel_to" placeholder="{{ __('yyyy-mm-dd') }}" value="{{ request('travel_to') }}" id="travel_to" class="form-control" autocomplete="off" />
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label for="package_type" class="control-label">
                      {{ __('Package Type') }}
                    </label>
                    <select name="package_type" id="package_type" class="form-control">
                      <option value="">{{ __('Select') }}</option>
                      @foreach ($packageTypes as $packageType)
                      <option value="{{ $packageType->slug }}" @selected(request('package_type') == $packageType->slug)>{{ ucwords($packageType->name) }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label for="lead_from" class="control-label">
                      {{ __('Lead From') }}
                    </label>
                    <input type="date" pattern="\d{4}-\d{2}-\d{2}" min="{{ date('Y-m-d') }}" name="lead_from" placeholder="{{ __('yyyy-mm-dd') }}" value="{{ request('lead_from') }}" id="lead_from" class="form-control" autocomplete="off" />
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label for="lead_to" class="control-label">
                      {{ __('Lead To') }}
                    </label>
                    <input type="date" pattern="\d{4}-\d{2}-\d{2}" min="{{ date('Y-m-d') }}" name="lead_to" placeholder="{{ __('yyyy-mm-dd') }}" value="{{ request('lead_to') }}" id="lead_to" class="form-control" autocomplete="off" />
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label for="lead_source" class="control-label">
                      {{ __('Lead Source') }}
                    </label>
                    <select name="lead_source" id="lead_source" class="form-control">
                      <option value="">{{ __('Select') }}</option>
                      @foreach ($leadSources as $leadSource)
                      <option value="{{ $leadSource }}" @selected(request('lead_source') == $leadSource)>{{ ucwords($leadSource) }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label for="hotel_type" class="control-label">
                      {{ __('Hotel Type') }}
                    </label>
                    <select name="hotel_type" id="hotel_type" class="form-control">
                      <option value="">{{ __('Select') }}</option>
                      @foreach ($hotelTypes as $hotelType)
                      <option value="{{ $hotelType->slug }}" @selected(request('hotel_type') == $hotelType->slug)>{{ ucwords($hotelType->name) }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label for="flight_ticket" class="control-label">
                      {{ __('Flight Ticket') }}
                    </label>
                    <select name="flight_ticket" id="flight_ticket" class="form-control">
                      <option value="">{{ __('Select') }}</option>
                      @foreach ($flightTickets as $flightTicket)
                      <option value="{{ $flightTicket }}" @selected(request('flight_ticket') == $flightTicket)>{{ ucwords($flightTicket) }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>

                <div class="col-md-4">
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
                  <a href="{{ url('admin/leads') }}" class="btn btn-block btn-outline-info my-1">
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
                  <th>{{ __('Name') }}</th>
                  <th>{{ __('Contact') }}</th>
                  <th>{{ __('Travel Date') }}</th>
                  <th>{{ __('Package Type') }}</th>
                  <th>{{ __('Lead Source') }}</th>
                  <th>{{ __('Status') }}</th>
                  <th>{{ __('Action') }}</th>
                </tr>
              </thead>

              <tbody>
                @foreach($leads as $lead)
                <tr>
                  <td>{{ @$lead->id }}</td>
                  <td>
                    {{ ucwords(@$lead->name) }}
                    <br />
                    + {{ @$lead->adult - 1 + @$lead->child }}
                  </td>
                  <td>
                    {{ @$lead->mobile }}
                    <br />
                    {{ @$lead->email }}
                    <br />
                    {{ ucwords(@$lead->city) }}
                  </td>
                  <td>
                    {{ !empty(@$lead->travel_start) ? date('Y-m-d', strtotime(@$lead->travel_start)) : '' }}
                    <br />to<br />
                    {{ !empty(@$lead->travel_end) ? date('Y-m-d', strtotime(@$lead->travel_end)) : (!empty(@$lead->duration) ? @$lead->duration . ' Days' : '') }}
                  </td>
                  <td>
                    {{ ucwords(@$lead->package_type) }}<br />
                    {{ ucwords(@$lead->hotel_type) }}<br />
                    {{ ucwords(@$lead->flight_ticket) }} Flight Ticket
                  </td>
                  <td>
                    {{ ucwords(@$lead->lead_source) }}<br />
                    {{ @$lead->price_min }} - {{ @$lead->price_max }}
                  </td>
                  <td>
                    <div class="custom-control custom-switch">
                      <input onchange="changeStatus(this)" type="checkbox" name="status-{{ @$lead->id }}" value="active" data-id="{{ @$lead->id }}" data-status="{{ @$lead->status == 'active' ? 'inactive' : 'active' }}" id="status-{{ @$lead->id }}" class="custom-control-input" @checked(@$lead->status == 'active') />
                      <label class="custom-control-label" for="status-{{ @$lead->id }}">{{ ucwords(@$lead->status) }}</label>
                    </div>
                  </td>
                  <td>
                    <a href="{{ url('admin/leads/' . @$lead->id) }}" title="Details" class="btn btn-xs btn-dark py-0 mx-1">
                      <i class="fa fa-eye"></i>
                    </a>
                    <a href="{{ url('admin/leads/' . @$lead->id . '/edit') }}" title="Edit" class="btn btn-xs btn-outline-info py-0 mx-1">
                      <i class="fa fa-pencil-square-o"></i>
                    </a>
                    <a onClick="if (confirm('Are you sure?')) return this.nextElementSibling.submit();" href="javascript:;" title="Delete" class="btn btn-xs btn-outline-danger py-0 mx-1">
                      <i class="fa fa-trash-o"></i>
                    </a>
                    <form action="{{ url('admin/leads/'  . $lead->id. 'destroy') }}" method="POST"
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
          targets: [0, 7], // column index
          orderable: false,
        },
        {
          targets: [0, 7], // column index
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
      buttons: [
        {
          extend: 'csv',
          text: 'CSV',
          filename: 'Leads',
          className: 'btn btn-xs btn-dark py-1',
          exportOptions: {
            columns: ':visible:not(:last-child)'
          }
        },
        {
          extend: 'excel',
          text: 'Excel',
          filename: 'Leads',
          className: 'btn btn-xs btn-dark py-1',
          exportOptions: {
            columns: ':visible:not(:last-child)'
          }
        },
        {
          extend: 'pdf',
          text: 'PDF',
          filename: 'Leads',
          className: 'btn btn-xs btn-dark py-1',
          exportOptions: {
            columns: ':visible:not(:last-child)'
          }
        }
      ]
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
      url: "{{ url('admin/leads/changeStatus') }}",
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