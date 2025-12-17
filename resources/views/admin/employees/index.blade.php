@extends('admin.layouts.app')

@section('title', __('Employee'))

@section('content')
<!-- Heading -->
<div class="breadcrumbs">
  <div class="breadcrumbs-inner">
    <div class="row">
      <div class="col-sm-4">
        <div class="page-header float-left">
          <div class="page-title">
            <h1>{{ __('Employee') }}</h1>
          </div>
        </div>
      </div>

      <div class="col-sm-6">
        <div class="page-header float-right">
          <div class="page-title">
            <ol class="breadcrumb text-right">
              <li><a href="{{ url('admin/home') }}">{{ __('Dashboard') }}</a></li>
              <li class="active">{{ __('Employee') }}</li>
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
              {{ __('Employee') }}
            </strong>
          </div>

          <div class="card-body">
            <form name="form" action="{{ url('admin/employees') }}" method="GET" id="form" class="" enctype="multipart/form-data" novalidate="novalidate" autocomplete="off">
              <div class="row justify-content-center">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="dob" class="control-label">
                      {{ __('DoB') }}
                    </label>
                    <input type="date" pattern="\d{4}-\d{2}-\d{2}" min="{{ date('Y-m-d', strtotime('-60 year')) }}" max="{{ date('Y-m-d', strtotime('-18 year')) }}" name="dob" placeholder="{{ __('yyyy-mm-dd') }}" value="{{ request('dob') }}" id="dob" class="form-control" autocomplete="off" />
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label for="role" class="control-label">
                      {{ __('Role') }}
                    </label>
                    <select name="role" id="role" class="form-control">
                      <option value="">{{ __('Select') }}</option>
                      @foreach ($roles as $key => $role)
                      <option value="{{ $role->name }}" @selected(request('role') == $role->name)>{{ ucwords($role->name) }}</option>
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
                      <option value="block" @selected(request('status') == 'block')>{{ __('Block') }}</option>
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
                  <a href="{{ url('admin/employees') }}" class="btn btn-block btn-outline-info my-1">
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
                  <th>{{ __('Mobile') }}</th>
                  <th>{{ __('Email') }}</th>
                  <th>{{ __('Username') }}</th>
                  <th>{{ __('DoB') }}</th>
                  <th>{{ __('Sex') }}</th>
                  <th>{{ __('Role') }}</th>
                  <th>{{ __('Status') }}</th>
                  <th>{{ __('Action') }}</th>
                </tr>
              </thead>

              <tbody>
                @foreach($admins as $admin)
                <tr>
                  <td>{{ @$admin->id }}</td>
                  <td>{{ ucwords(@$admin->fullname) }}</td>
                  <td>{{ @$admin->mobile }}</td>
                  <td>{{ @$admin->email }}</td>
                  <td>{{ @$admin->username }}</td>
                  <td>{{ !empty(@$admin->dob) ? date('Y-m-d', strtotime(@$admin->dob)) : '' }}</td>
                  <td>{{ ucwords(@$admin->sex) }}</td>
                  <td>{{ ucwords(@$admin->roles->pluck('name')->implode(',')) }}</td>
                  <td>
                    <div class="custom-control custom-switch">
                      <input onchange="changeStatus(this)" type="checkbox" name="status-{{ @$admin->id }}" value="active" data-id="{{ @$admin->id }}" data-status="{{ @$admin->status == 'active' ? 'inactive' : 'active' }}" id="status-{{ @$admin->id }}" class="custom-control-input" @checked(@$admin->status == 'active') />
                      <label class="custom-control-label" for="status-{{ @$admin->id }}">{{ ucwords(@$admin->status) }}</label>
                    </div>
                  </td>
                  <td>
                    <a href="{{ url('admin/employees/' . @$admin->id) }}" title="Details" class="btn btn-xs btn-dark py-0 mx-1">
                      <i class="fa fa-eye"></i>
                    </a>
                    <a href="{{ url('admin/employees/' . @$admin->id . '/edit') }}" title="Edit" class="btn btn-xs btn-outline-info py-0 mx-1">
                      <i class="fa fa-pencil-square-o"></i>
                    </a>
                    <a href="{{ url('admin/employees/' . @$admin->id . '/resendMail') }}" title="Resend Mail" class="btn btn-xs btn-outline-info py-0 mx-1">
                      <i class="fa fa-envelope-o"></i>
                    </a>
                    <a onClick="if (confirm('Are you sure?')) return this.nextElementSibling.submit();" href="javascript:;" title="Delete" class="btn btn-xs btn-outline-danger py-0 mx-1">
                      <i class="fa fa-trash-o"></i>
                    </a>
                    <form action="{{ url('admin/employees/'. $admin->id . '/destroy') }}" method="POST" class="d-none">
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
          filename: 'Employees',
          className: 'btn btn-xs btn-dark py-1',
          exportOptions: {
            columns: ':visible:not(:last-child)'
          }
        },
        {
          extend: 'excel',
          text: 'Excel',
          filename: 'Employees',
          className: 'btn btn-xs btn-dark py-1',
          exportOptions: {
            columns: ':visible:not(:last-child)'
          }
        },
        {
          extend: 'pdf',
          text: 'PDF',
          filename: 'Employees',
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
      url: "{{ url('admin/employees/changeStatus') }}",
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