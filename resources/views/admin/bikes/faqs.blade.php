@extends('admin.layouts.app')

@section('title', __(@$bike->name . ': Faq'))

@section('content')
<!-- Heading -->
<div class="breadcrumbs">
  <div class="breadcrumbs-inner">
    <div class="row">
      <div class="col-sm-4">
        <div class="page-header float-left">
          <div class="page-title">
            <h1>{{ __(@$bike->name) }}</h1>
          </div>
        </div>
      </div>

      <div class="col-sm-6">
        <div class="page-header float-right">
          <div class="page-title">
            <ol class="breadcrumb text-right">
              <li><a href="{{ url('admin/home') }}">{{ __('Dashboard') }}</a></li>
              <li><a href="{{ url('admin/bikes') }}">{{ __('Bike') }}</a></li>
              <li class="active">{{ __('Faq') }}</li>
            </ol>
          </div>
        </div>
      </div>

      <div class="col-sm-2">
        <a href="{{ url('admin/bikes/' . request('bikeId')) }}" class="btn btn-info float-right my-2 mx-3">
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
              {{ __('Faq') }}
            </strong>
          </div>

          <div class="card-body">
            <form name="form"
            @if (@$faq)
            action="{{ url('admin/bikes/' . request('bikeId') . '/faqs/' . @$faq->id) }}"
            @else
            action="{{ url('admin/bikes/' . request('bikeId') . '/faqs') }}"
            @endif
            method="POST" id="form" class="" enctype="multipart/form-data" novalidate="novalidate" autocomplete="off">
              @csrf

              <div class="row justify-content-center">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="question" class="control-label">
                      {{ __('Question') }}
                      <span style="color:red;">*</span>
                    </label>
                    <input type="text" name="question" placeholder="{{ __('Question') }}" value="{{ old('question', @$faq->question) }}" id="question" class="form-control {{ $errors->has('question') ? 'is-invalid' : '' }}" autocomplete="off" autofocus />
                    @if ($errors->has('question'))
                    <label class="error">{{ $errors->first('question') }}</label>
                    @endif
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="form-group">
                    <label for="answer" class="control-label">
                      {{ __('Answer') }}
                      <span style="color:red;">*</span>
                    </label>
                    <textarea name="answer" placeholder="{{ __('Answer') }}" id="answer" class="form-control {{ $errors->has('answer') ? 'is-invalid' : '' }}" required autocomplete="off" autofocus>{!! old('answer', @$faq->answer) !!}</textarea>
                    @if ($errors->has('answer'))
                    <label class="error">{{ $errors->first('answer') }}</label>
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
                  <a href="{{ url('admin/bikes/' . request('bikeId') . '/faqs') }}" id="reset" class="btn btn-block btn-outline-info my-1">
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
                  <th>{{ __('Question') }}</th>
                  <th>{{ __('Answer') }}</th>
                  <th>{{ __('Action') }}</th>
                </tr>
              </thead>

              <tbody>
                @foreach($faqs as $key => $faq)
                <tr>
                  <td>{{ @$faq->id }}</td>
                  <td>{{ ucwords(@$faq->question) }}</td>
                  <td>{!! $faq->answer !!}</td>
                  <td>
                    <a href="{{ url('admin/bikes/' . request('bikeId') . '/faqs/' . @$faq->id) }}" title="Edit"
                      class="btn btn-xs btn-outline-info py-0 mx-1">
                      <i class="fa fa-pencil-square-o"></i>
                    </a>
                    <a onClick="if (confirm('Are you sure?')) return this.nextElementSibling.submit();"
                      href="javascript:;" title="Delete" class="btn btn-xs btn-outline-danger py-0 mx-1">
                      <i class="fa fa-trash-o"></i>
                    </a>
                    <form action="{{ url('admin/bikes/' . request('bikeId') . '/faqs/' . @$faq->id) }}" method="POST" class="d-none">
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
          targets: [0, 3], // column index
          orderable: false,
        },
        {
          targets: [0, 3], // column index
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
          filename: 'bike_faqs',
          className: 'btn btn-xs btn-dark py-1',
          exportOptions: {
            columns: ':visible:not(:last-child)'
          }
        },
        {
          extend: 'excel',
          text: 'Excel',
          filename: 'bike_faqs',
          className: 'btn btn-xs btn-dark py-1',
          exportOptions: {
            columns: ':visible:not(:last-child)'
          }
        },
        {
          extend: 'pdf',
          text: 'PDF',
          filename: 'bike_faqs',
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