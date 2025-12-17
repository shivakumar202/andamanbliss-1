@extends('admin.layouts.app')

@section('title', __('Bike'))

@section('content')
<!-- Heading -->
<div class="breadcrumbs">
  <div class="breadcrumbs-inner">
    <div class="row">
      <div class="col-sm-4">
        <div class="page-header float-left">
          <div class="page-title">
            <h1>{{ __('Bike') }}</h1>
          </div>
        </div>
      </div>

      <div class="col-sm-6">
        <div class="page-header float-right">
          <div class="page-title">
            <ol class="breadcrumb text-right">
              <li><a href="{{ url('admin/home') }}">{{ __('Dashboard') }}</a></li>
              <li class="active">{{ __('Bike') }}</li>
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
              {{ __('Bike') }}
            </strong>
          </div>

          <div class="card-body">
            <form name="form" action="{{ url('admin/bikes') }}" method="GET" id="form" class=""
              enctype="multipart/form-data" novalidate="novalidate" autocomplete="off">
              <div class="row justify-content-center">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="category_id" class="control-label">
                      {{ __('Category') }}
                    </label>
                    <select name="category_id" id="category_id" class="form-control">
                      <option value="">{{ __('Select') }}</option>
                      @foreach ($categories as $category)
                      <option value="{{ $category->id }}" @selected(request('category_id') == $category->id)>{{
                        ucwords($category->name) }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>

                <div class="col-md-2">
                  <div class="form-group">
                    <label for="featured" class="control-label">
                      {{ __('Featured') }}
                      <span style="color:red;"></span>
                    </label>
                    <div class="custom-control custom-switch">
                      <input type="checkbox" name="featured" value="1" id="featured" class="custom-control-input {{ $errors->has('featured') ? 'is-invalid' : '' }}" @checked(request('featured') == 1) />
                      <label class="custom-control-label" for="featured">{{ __('Yes') }}</label>
                    </div>
                  </div>
                </div>

                <div class="col-md-2">
                  <div class="form-group">
                    <label for="best_seller" class="control-label">
                      {{ __('Best Seller') }}
                      <span style="color:red;"></span>
                    </label>
                    <div class="custom-control custom-switch">
                      <input type="checkbox" name="best_seller" value="1" id="best_seller" class="custom-control-input {{ $errors->has('best_seller') ? 'is-invalid' : '' }}" @checked(request('best_seller') == 1) />
                      <label class="custom-control-label" for="best_seller">{{ __('Yes') }}</label>
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
                  <a href="{{ url('admin/bikes') }}" class="btn btn-block btn-outline-info my-1">
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
                  <th>{{ __('Category') }}</th>
                  <th>{{ __('Addons') }}</th>
                  <th>{{ __('Address') }}</th>
                  <th>{{ __('Featured') }}</th>
                  <th>{{ __('Best Seller') }}</th>
                  <th>{{ __('Ratings') }}</th>
                  <th>{{ __('Status') }}</th>
                  <th>{{ __('Action') }}</th>
                </tr>
              </thead>

              <tbody>
                @foreach($bikes as $key=>$bike)
                <tr>
                  <td>{{ @$bike->id }}</td>
                  <td>{{ ucwords(@$bike->name) }}</td>
                  <td>{{ @$bike->category->name }}</td>
                  <td>
                    @if(@$bike->addon_names && !empty(@$bike->addon_names))
                        @foreach ($bike->addon_names as $addonName)
                            <span>{{ $addonName .'|' }}</span>
                        @endforeach
                    @else
                        <span>No addons available</span>
                    @endif
                </td>
                  <td>{{ @$bike->address }}</td>
                  <td>{{ @$bike->featured == 1 ? 'Yes' : 'No' }}</td>
                  <td>{{ @$bike->best_seller == 1 ? 'Yes' : 'No' }}</td>
                  <td>{{ @$bike->ratings }} Star ({{ $bike->reviews_count }})</td>
                  <td>{{ @$bike->status == 'active' ? 'Active' : 'Inactive'}}</td>
                  <td>
                    <a href="{{ url('admin/bikes/' . @$bike->id) }}" title="Details"
                      class="btn btn-xs btn-dark py-0 mx-1">
                      <i class="fa fa-eye"></i>
                    </a>
                    <a href="{{ url('admin/bikes/' . @$bike->id . '/edit') }}" title="Edit"
                      class="btn btn-xs btn-outline-info py-0 mx-1">
                      <i class="fa fa-pencil-square-o"></i>
                    </a>
                    <a onClick="if (confirm('Are you sure?')) return this.nextElementSibling.submit();"
                      href="javascript:;" title="Delete" class="btn btn-xs btn-outline-danger py-0 mx-1">
                      <i class="fa fa-trash-o"></i>
                    </a>
                    <form action="{{ url('admin/bikes/' . $bike->id) }}" method="POST" class="d-none">
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
      </div>
      <!--/.col-->
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
          targets: [0, 8], // column index
          orderable: false,
        },
        {
          targets: [0, 8], // column index
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
          filename: 'bikes',
          className: 'btn btn-xs btn-dark py-1',
          exportOptions: {
            columns: ':visible:not(:last-child)'
          }
        },
        {
          extend: 'excel',
          text: 'Excel',
          filename: 'bikes',
          className: 'btn btn-xs btn-dark py-1',
          exportOptions: {
            columns: ':visible:not(:last-child)'
          }
        },
        {
          extend: 'pdf',
          text: 'PDF',
          filename: 'bikes',
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