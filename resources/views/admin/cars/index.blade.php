@extends('admin.layouts.app')

@section('title', __('Car'))

@section('content')
<!-- Heading -->
<div class="breadcrumbs">
  <div class="breadcrumbs-inner">
    <div class="row">
      <div class="col-sm-4">
        <div class="page-header float-left">
          <div class="page-title">
            <h1>{{ __('Car') }}</h1>
          </div>
        </div>
      </div>

      <div class="col-sm-6">
        <div class="page-header float-right">
          <div class="page-title">
            <ol class="breadcrumb text-right">
              <li><a href="{{ url('admin/home') }}">{{ __('Dashboard') }}</a></li>
              <li class="active">{{ __('Car') }}</li>
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
              {{ __('Car') }}
            </strong>
          </div>

          <div class="card-body">
            <form name="form" action="{{ url('admin/cars') }}" method="GET" id="form" class="" enctype="multipart/form-data" novalidate="novalidate" autocomplete="off">
              <div class="row justify-content-center">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="from_date" class="control-label">
                      {{ __('From') }}
                    </label>
                    <input type="date" pattern="\d{4}-\d{2}-\d{2}" max="{{ date('Y-m-d') }}" name="from_date" placeholder="{{ __('yyyy-mm-dd') }}" value="{{ request('from_date') }}" id="from_date" class="form-control" autocomplete="off" />
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label for="to_date" class="control-label">
                      {{ __('From') }}
                    </label>
                    <input type="date" pattern="\d{4}-\d{2}-\d{2}" max="{{ date('Y-m-d') }}" name="to_date" placeholder="{{ __('yyyy-mm-dd') }}" value="{{ request('to_date') }}" id="to_date" class="form-control" autocomplete="off" />
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
                  <a href="{{ url('admin/cars') }}" class="btn btn-block btn-outline-info my-1">
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
                  <th>{{ __('Reg. Number') }}</th>
                  <th>{{ __('Reg. Date') }}</th>
                  <th>{{ __('Fuel Type') }}</th>
                  <th>{{ __('Engine CC') }}</th>
                  <th>{{ __('Seat') }}</th>
                  <th>{{ __('AC Type') }}</th>
                  <th>{{ __('Status') }}</th>
                  <th>{{ __('Action') }}</th>
                </tr>
              </thead>

              <tbody>
                @foreach($cars as $car)
                <tr>
                  <td>{{ @$car->id }}</td>
                  <td>{{ ucwords(@$car->name) }}</td>
                  <td>{{ strtoupper(@$car->reg_no) }}</td>
                  <td>{{ !empty(@$car->reg_date) ? date('Y-m-d', strtotime(@$car->reg_date)) : '' }}</td>
                  <td>{{ ucwords(@$car->fuel) }}</td>
                  <td>{{ @$car->cc }}</td>
                  <td>{{ @$car->seat }}</td>
                  <td>{{ @$car->ac == 'yes' ? 'AC' : 'Non-AC' }}</td>
                  <td>
                    <div class="custom-control custom-switch">
                      <input onchange="changeStatus(this)" type="checkbox" name="status-{{ @$car->id }}" value="active" data-id="{{ @$car->id }}" data-status="{{ @$car->status == 'active' ? 'inactive' : 'active' }}" id="status-{{ @$car->id }}" class="custom-control-input" @checked(@$car->status == 'active') />
                      <label class="custom-control-label" for="status-{{ @$car->id }}">{{ ucwords(@$car->status) }}</label>
                    </div>
                  </td>
                  <td>
                    <a href="{{ url('admin/cars/' . @$car->id) }}" title="Details" class="btn btn-xs btn-dark py-0 mx-1">
                      <i class="fa fa-eye"></i>
                    </a>
                    <a href="{{ url('admin/cars/' . @$car->id . '/edit') }}" title="Edit" class="btn btn-xs btn-outline-info py-0 mx-1">
                      <i class="fa fa-pencil-square-o"></i>
                    </a>
                    <a onClick="if (confirm('Are you sure?')) return this.nextElementSibling.submit();" href="javascript:;" title="Delete" class="btn btn-xs btn-outline-danger py-0 mx-1">
                      <i class="fa fa-trash-o"></i>
                    </a>
                    <form action="{{ url('admin/cars/destroy/' . $car->id) }}" method="POST"
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
          targets: [0, 9], // column index
          orderable: false,
        },
        {
          targets: [0, 9], // column index
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
          filename: 'Cars',
          className: 'btn btn-xs btn-dark py-1',
          exportOptions: {
            columns: ':visible:not(:last-child)'
          }
        },
        {
          extend: 'excel',
          text: 'Excel',
          filename: 'Cars',
          className: 'btn btn-xs btn-dark py-1',
          exportOptions: {
            columns: ':visible:not(:last-child)'
          }
        },
        {
          extend: 'pdf',
          text: 'PDF',
          filename: 'Cars',
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
      url: "{{ url('admin/cars/changeStatus') }}",
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