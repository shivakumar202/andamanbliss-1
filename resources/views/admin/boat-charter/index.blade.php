@extends('admin.layouts.app')

@section('title', __('Boat Charter & Game Fishing Packages'))

@section('content')
<div class="breadcrumbs">
  <div class="breadcrumbs-inner">
    <div class="row">
      <div class="col-sm-4">
        <div class="page-header float-left">
          <div class="page-title">
            <h1>{{ __('Boat Charter & Game Fishing Packages') }}</h1>
          </div>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="page-header float-right">
          <div class="page-title">
            <ol class="breadcrumb text-right">
              <li><a href="{{ url('admin/home') }}">{{ __('Dashboard') }}</a></li>
              <li class="active">{{ __('Boat Charter & Game Fishing Packages') }}</li>
            </ol>
          </div>
        </div>
      </div>
      <div class="col-sm-2">
        <a href="javascript:history.back();" class="btn btn-info float-right my-2 mx-3">
          <i class="fa fa-undo fa-lg"></i> 
          {{ __('Back') }}
        </a>
      </div>
    </div>
  </div>
</div>

<div class="content">
  <div class="animated fadeIn">
    @include('admin.layouts.alert')
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <strong class="card-title">
              {{ __('Boat Charter & Game Fishing Packages') }}
            </strong>
          </div>
          <div class="card-body">
            <form name="form" action="{{ url('admin/boat-charter') }}" method="GET" id="form" class="" enctype="multipart/form-data" novalidate="novalidate" autocomplete="off">
              <div class="row justify-content-center">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="package_type" class="control-label">
                      {{ __('Package Type') }}
                    </label>
                    <select name="package_type" id="package_type" class="form-control">
                      <option value="">{{ __('Select') }}</option>
                      <option value="fishing" @selected(request('package_type') == 'fishing')>{{ __('Game Fishing') }}</option>
                      <option value="charter" @selected(request('package_type') == 'charter')>{{ __('Boat Charter') }}</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label for="featured" class="control-label">
                      {{ __('Featured') }}
                    </label>
                    <div class="custom-control custom-switch">
                      <input type="checkbox" name="featured" value="1" id="featured" class="custom-control-input {{ $errors->has('featured') ? 'is-invalid' : '' }}" @checked(request('featured') == 1) />
                      <label class="custom-control-label" for="featured">{{ __('Yes') }}</label>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="status" class="control-label">
                      {{ __('Status') }}
                    </label>
                    <select name="status" id="status" class="form-control">
                      <option value="">{{ __('Select') }}</option>
                      <option value="1" @selected(request('status') == '1')>{{ __('Active') }}</option>
                      <option value="0" @selected(request('status') == '0')>{{ __('Inactive') }}</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row align-items-center justify-content-center">
                <div class="align-self-center col-md-2">
                  <button type="submit" id="submit" class="btn btn-block btn-info my-1">
                    <i class="fa fa-search fa-lg"></i> 
                    <span>{{ __('Search') }}</span>
                  </button>
                </div>
                <div class="align-self-center col-md-2">
                  <a href="{{ url('admin/boat-charter') }}" class="btn btn-block btn-outline-info my-1">
                    <i class="fa fa-refresh fa-lg"></i> 
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
                  <th>{{ __('Package Type') }}</th>
                  <th>{{ __('Places Covered') }}</th>
                  <th>{{ __('Base Price') }}</th>
                  <th>{{ __('Featured') }}</th>
                  <th>{{ __('Status') }}</th>
                  <th>{{ __('Action') }}</th>
                </tr>
              </thead>
              <tbody>
                @foreach($boatPackages as $key => $package)
                <tr>
                  <td>{{ @$package->id }}</td>
                  <td>{{ ucwords(@$package->name) }}</td>
                  <td>{{ ucwords(str_replace('_', ' ', @$package->package_type)) }}</td>
                  <td>{{ @$package->places_covered }}</td>
                  <td>₹{{ number_format(@$package->base_price, 2) }}</td>
                  <td>{{ @$package->featured == 1 ? 'Yes' : 'No' }}</td>
                  
                  <td>{{ @$package->status == '1' ? 'Active' : 'Inactive' }}</td>
                  <td>
                    <a href="{{ url('admin/boat-charter/' . @$package->id) }}" title="Details" class="btn btn-xs btn-dark py-0 mx-1">
                      <i class="fa fa-eye"></i>
                    </a>
                    <a href="{{ url('admin/boat-charter/' . @$package->id . '/edit') }}" title="Edit" class="btn btn-xs btn-outline-info py-0 mx-1">
                      <i class="fa fa-pencil-square-o"></i>
                    </a>
                    <a onClick="if (confirm('Are you sure?')) return this.nextElementSibling.submit();" href="javascript:;" title="Delete" class="btn btn-xs btn-outline-danger py-0 mx-1">
                      <i class="fa fa-trash-o"></i>
                    </a>
                    <form action="{{ url('admin/boat-charter/' . $package->id) }}" method="POST" class="d-none">
                      @method('DELETE')
                      @csrf
                    </form>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('css')
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
          targets: [0, 7], // ID and Action columns
          orderable: false,
        },
        {
          targets: [0, 7], // ID and Action columns
          searchable: false,
        },
        {
          targets: [0], // ID column
          visible: false,
        }
      ],
      dom: '<"row"<"col-sm-3"l><"col-sm-4"B><"col-sm-5"f>>' +
        '<"row"<"col-sm-12"tr>>' +
        '<"row"<"col-sm-5"i><"col-sm-7"p>>',
      buttons: [
        {
          extend: 'csv',
          text: 'CSV',
          filename: 'boat-packages',
          className: 'btn btn-xs btn-dark py-1',
          exportOptions: {
            columns: ':visible:not(:last-child)'
          }
        },
        {
          extend: 'excel',
          text: 'Excel',
          filename: 'boat-packages',
          className: 'btn btn-xs btn-dark py-1',
          exportOptions: {
            columns: ':visible:not(:last-child)'
          }
        },
        {
          extend: 'pdf',
          text: 'PDF',
          filename: 'boat-packages',
          className: 'btn btn-xs btn-dark py-1',
          exportOptions: {
            columns: ':visible:not(:last-child)'
          }
        }
      ]
    });
  });
</script>
@endsection