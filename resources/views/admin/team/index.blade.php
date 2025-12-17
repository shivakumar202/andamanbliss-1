@extends('admin.layouts.app')

@section('title', __('Teams'))

@section('content')
<!-- Heading -->
<div class="breadcrumbs">
  <div class="breadcrumbs-inner">
    <div class="row">
      <div class="col-sm-4">
        <div class="page-header float-left">
          <div class="page-title">
            <h1>{{ __('Team') }}</h1>
          </div>
        </div>
      </div>

      <div class="col-sm-6">
        <div class="page-header float-right">
          <div class="page-title">
            <ol class="breadcrumb text-right">
              <li><a href="{{ url('admin/home') }}">{{ __('Dashboard') }}</a></li>
              <li class="active">{{ __('Team') }}</li>
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
              {{ __('Team') }}
            </strong>
          </div>

          <div class="card-body">


            <table id="dataTable" class="table table-striped table-hover w-100">
              <thead class="thead-dark">
                <tr>
                  <th>{{ __('ID') }}</th>
                  <th>{{ __('Photo') }}</th>
                  <th>{{ __('Name') }}</th>
                  <th>{{ __('Mobile') }}</th>
                  <th>{{ __('Email') }}</th>
                  <th>{{ __('DoB') }}</th>
                  <th>{{ __('Gender') }}</th>
                  <th>{{ __('Joining Date') }}</th>
                  <th>{{ __('Role') }}</th>
                  <th>{{ __('Support') }}</th>
                  <th>{{ __('Action') }}</th>
                </tr>
              </thead>

              <tbody>
                @foreach($teams as $team)
                <tr>
                  <td>{{ @$loop->iteration }}</td>
                  <td>
                    @if(@$team->photo)
                    <img src="{{ asset(@$team->photo->file) }}" alt="photo" class="img-fluid" width="50px">
                    @else
                    <img src="{{ asset('images/default.jpg') }}" alt="photo" class="img-fluid" width="50px">
                    @endif
                  </td>
                  <td>{{ ucwords(@$team->name) }}</td>
                  <td>{{ @$team->contact }}</td>
                  <td>{{ @$team->email }}</td>
                  <td>{{ @$team->dob }}</td>
                  <td>{{ ucwords(@$team->gender)  }}</td>
                  <td>{{ @$team->joining }}</td>
                  <td>{{ ucwords(@$team->role) }}</td>
                  <td>{{ @$team->isSupport == 1 ? 'Yes' : 'No' }}</td>
                 
                  <td>
                 
                    <a href="{{ url('admin/teams/' . @$team->id . '/edit') }}" title="Edit" class="btn btn-xs btn-outline-info py-0 mx-1">
                      <i class="fa fa-pencil-square-o"></i>
                    </a>
                    
                    <a onClick="if (confirm('Are you sure?')) return this.nextElementSibling.submit();" href="javascript:;" title="Delete" class="btn btn-xs btn-outline-danger py-0 mx-1">
                      <i class="fa fa-trash-o"></i>
                    </a>
                    <form action="{{ url('admin/teams/'. $team->id . '/destroy') }}" method="POST" class="d-none">
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
          visible: true,
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
          filename: 'Teams',
          className: 'btn btn-xs btn-dark py-1',
          exportOptions: {
            columns: ':visible:not(:last-child)'
          }
        },
        {
          extend: 'excel',
          text: 'Excel',
          filename: 'Teams',
          className: 'btn btn-xs btn-dark py-1',
          exportOptions: {
            columns: ':visible:not(:last-child)'
          }
        },
        {
          extend: 'pdf',
          text: 'PDF',
          filename: 'Teams',
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
      url: "{{ url('admin/teams/changeStatus') }}",
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