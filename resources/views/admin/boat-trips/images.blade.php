@extends('admin.layouts.app')

@section('title', __(@$boatTrip->name . ': Image'))

@section('content')
<!-- Heading -->
<div class="breadcrumbs">
  <div class="breadcrumbs-inner">
    <div class="row">
      <div class="col-sm-4">
        <div class="page-header float-left">
          <div class="page-title">
            <h1>{{ __(@$boatTrip->name) }}</h1>
          </div>
        </div>
      </div>

      <div class="col-sm-6">
        <div class="page-header float-right">
          <div class="page-title">
            <ol class="breadcrumb text-right">
              <li><a href="{{ url('admin/home') }}">{{ __('Dashboard') }}</a></li>
              <li><a href="{{ url('admin/boat-trips') }}">{{ __('Boat Trip') }}</a></li>
              <li class="active">{{ __('Image') }}</li>
            </ol>
          </div>
        </div>
      </div>

      <div class="col-sm-2">
        <a href="{{ url('admin/boat-trips/' . request('tripId')) }}" class="btn btn-info float-right my-2 mx-3">
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
              {{ __('Image') }}
            </strong>
          </div>

          <div class="card-body">
            <form name="form"
            @if (@$drive)
            action="{{ url('admin/boat-trips/' . request('tripId') . '/images/' . @$drive->id) }}"
            @else
            action="{{ url('admin/boat-trips/' . request('tripId') . '/images') }}"
            @endif
            method="POST" id="form" class="" enctype="multipart/form-data" novalidate="novalidate" autocomplete="off">
              @csrf

              <div class="row align-items-center justify-content-center">
                <div class="align-self-center col-md-4">
                  <div class="form-group">
                    <img onError="this.onerror=null;this.src='{{ asset('images/default.jpg') }}'"
                    @if (@$drive)
                    src="{{ @$drive->file }}"
                    @else
                    src="{{ asset('images/default.jpg') }}"
                    @endif
                    class="img img-fluid w-100 m-auto d-block" alt="" />
                    <div class="custom-file">
                      <input type="file" accept="image/x-png,image/jpeg" onchange="readURL(this);" name="photo" class="custom-file-input {{ $errors->has('photo') ? 'is-invalid' : '' }}" id="customFileLangHTML" />
                      <label class="custom-file-label" for="customFileLangHTML" data-browse="{{ __('Browse') }}">{{ __('Choose file...') }}</label>
                    </div>
                    @if ($errors->has('photo'))
                    <label class="error">{{ $errors->first('photo') }}</label>
                    @endif
                  </div>
                </div>
              </div>

              <div class="row align-items-center justify-content-center">
                <div class="align-self-center col-md-2">
                  <button type="submit" name="submit" id="submit" class="btn btn-block btn-info my-1">
                    <i class="fa fa-floppy-o fa-lg"></i>&nbsp;
                    <span>{{ __('Save') }}</span>
                  </button>
                </div>

                <div class="align-self-center col-md-2">
                  <a href="{{ url('admin/boat-trips/' . request('tripId') . '/images') }}" id="reset" class="btn btn-block btn-outline-info my-1">
                    <i class="fa fa-refresh fa-lg"></i>&nbsp;
                    <span>{{ __('Reset') }}</span>
                  </a>
                </div>
              </div>
            </form>

            <hr>
              @include('admin.boat-trips.navigations')
            <hr>

            <table id="dataTable" class="table table-striped table-hover w-100">
              <thead class="thead-dark">
                <tr>
                  <th>{{ __('ID') }}</th>
                  <th>{{ __('Image') }}</th>
                  <th>{{ __('Action') }}</th>
                </tr>
              </thead>

              <tbody>
                @foreach($drives as $key => $drive)
                <tr>
                  <td>{{ @$drive->id }}</td>
                  <td>
                    <img onError="this.onerror=null;this.src='{{ asset('images/default.jpg') }}'" src="{{ @$drive->file }}" class="img-fluid w-25 m-auto d-block" alt="" />
                  </td>
                  <td>
                    <a href="{{ url('admin/boat-trips/' . request('tripId') . '/images/' . @$drive->id) }}" title="Edit"
                      class="btn btn-xs btn-outline-info py-0 mx-1">
                      <i class="fa fa-pencil-square-o"></i>
                    </a>
                    <a onClick="if (confirm('Are you sure?')) return this.nextElementSibling.submit();"
                      href="javascript:;" title="Delete" class="btn btn-xs btn-outline-danger py-0 mx-1">
                      <i class="fa fa-trash-o"></i>
                    </a>
                    <form action="{{ url('admin/boat-trips/' . request('tripId') . '/images/' . @$drive->id) }}" method="POST" class="d-none">
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
          targets: [0, 2], // column index
          orderable: false,
        },
        {
          targets: [0, 2], // column index
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
          filename: 'boat_images',
          className: 'btn btn-xs btn-dark py-1',
          exportOptions: {
            columns: ':visible:not(:last-child)'
          }
        },
        {
          extend: 'excel',
          text: 'Excel',
          filename: 'boat_images',
          className: 'btn btn-xs btn-dark py-1',
          exportOptions: {
            columns: ':visible:not(:last-child)'
          }
        },
        {
          extend: 'pdf',
          text: 'PDF',
          filename: 'boat_images',
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