@extends('admin.layouts.app')

@section('title', __(@$hotel->name . ': RoomType'))

@section('content')
<!-- Heading -->
<div class="breadcrumbs">
  <div class="breadcrumbs-inner">
    <div class="row">
      <div class="col-sm-4">
        <div class="page-header float-left">
          <div class="page-title">
            <h1>{{ __(@$hotel->name) }}</h1>
          </div>
        </div>
      </div>

      <div class="col-sm-6">
        <div class="page-header float-right">
          <div class="page-title">
            <ol class="breadcrumb text-right">
              <li><a href="{{ url('admin/home') }}">{{ __('Dashboard') }}</a></li>
              <li><a href="{{ url('admin/hotels') }}">{{ __('Hotel') }}</a></li>
              <li class="active">{{ __('RoomType') }}</li>
            </ol>
          </div>
        </div>
      </div>

      <div class="col-sm-2">
        <a href="{{ url('admin/hotels/' . request('hotelId')) }}" class="btn btn-info float-right my-2 mx-3">
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
              {{ __('RoomType') }}
            </strong>
          </div>

          <div class="card-body">
            <form name="form"
            @if (@$roomType)
            action="{{ url('admin/hotels/' . request('hotelId') . '/roomtypes/' . @$roomType->id) }}"
            @else
            action="{{ url('admin/hotels/' . request('hotelId') . '/roomtypes') }}"
            @endif
            method="POST" id="form" class="" enctype="multipart/form-data" novalidate="novalidate" autocomplete="off">
              @csrf

              <div class="row justify-content-center">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="name" class="control-label">
                      {{ __('Name') }}
                      <span style="color:red;">*</span>
                    </label>
                    <input type="text" name="name" placeholder="{{ __('Name') }}" value="{{ old('name', @$roomType->name) }}" id="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" autocomplete="off" autofocus />
                    @if ($errors->has('name'))
                    <label class="error">{{ $errors->first('name') }}</label>
                    @endif
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label for="breakfast_rate" class="control-label">
                      {{ __('Breakfast Rate') }}
                      <span style="color:red;">*</span>
                    </label>
                    <input type="number" step="0.01" min="0" max="999999.99" name="breakfast_rate" placeholder="{{ __('Breakfast Rate') }}" value="{{ old('breakfast_rate', @$roomType->breakfast_rate) }}" id="breakfast_rate" class="form-control {{ $errors->has('breakfast_rate') ? 'is-invalid' : '' }}" required autocomplete="off" autofocus />
                    @if ($errors->has('breakfast_rate'))
                    <label class="error">{{ $errors->first('breakfast_rate') }}</label>
                    @endif
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label for="breakfast_price" class="control-label">
                      {{ __('Breakfast Price') }}
                      <span style="color:red;">*</span>
                    </label>
                    <input type="number" step="0.01" min="0" max="999999.99" name="breakfast_price" placeholder="{{ __('Breakfast Price') }}" value="{{ old('breakfast_price', @$roomType->breakfast_price) }}" id="breakfast_price" class="form-control {{ $errors->has('breakfast_price') ? 'is-invalid' : '' }}" required autocomplete="off" autofocus />
                    @if ($errors->has('breakfast_price'))
                    <label class="error">{{ $errors->first('breakfast_price') }}</label>
                    @endif
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label for="breakfast_fees" class="control-label">
                      {{ __('Breakfast Fees') }}
                      <span style="color:red;">*</span>
                    </label>
                    <input type="number" step="0.01" min="0" max="999999.99" name="breakfast_fees" placeholder="{{ __('Breakfast Fees') }}" value="{{ old('breakfast_fees', @$roomType->breakfast_fees) }}" id="breakfast_fees" class="form-control {{ $errors->has('breakfast_fees') ? 'is-invalid' : '' }}" required autocomplete="off" autofocus />
                    @if ($errors->has('breakfast_fees'))
                    <label class="error">{{ $errors->first('breakfast_fees') }}</label>
                    @endif
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label for="dinner_rate" class="control-label">
                      {{ __('Dinner Rate') }}
                      <span style="color:red;">*</span>
                    </label>
                    <input type="number" step="0.01" min="0" max="999999.99" name="dinner_rate" placeholder="{{ __('Dinner Rate') }}" value="{{ old('dinner_rate', @$roomType->dinner_rate) }}" id="dinner_rate" class="form-control {{ $errors->has('dinner_rate') ? 'is-invalid' : '' }}" required autocomplete="off" autofocus />
                    @if ($errors->has('dinner_rate'))
                    <label class="error">{{ $errors->first('dinner_rate') }}</label>
                    @endif
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label for="dinner_price" class="control-label">
                      {{ __('Dinner Price') }}
                      <span style="color:red;">*</span>
                    </label>
                    <input type="number" step="0.01" min="0" max="999999.99" name="dinner_price" placeholder="{{ __('Dinner Price') }}" value="{{ old('dinner_price', @$roomType->dinner_price) }}" id="dinner_price" class="form-control {{ $errors->has('dinner_price') ? 'is-invalid' : '' }}" required autocomplete="off" autofocus />
                    @if ($errors->has('dinner_price'))
                    <label class="error">{{ $errors->first('dinner_price') }}</label>
                    @endif
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label for="dinner_fees" class="control-label">
                      {{ __('Dinner Fees') }}
                      <span style="color:red;">*</span>
                    </label>
                    <input type="number" step="0.01" min="0" max="999999.99" name="dinner_fees" placeholder="{{ __('Dinner Fees') }}" value="{{ old('dinner_fees', @$roomType->dinner_fees) }}" id="dinner_fees" class="form-control {{ $errors->has('dinner_fees') ? 'is-invalid' : '' }}" required autocomplete="off" autofocus />
                    @if ($errors->has('dinner_fees'))
                    <label class="error">{{ $errors->first('dinner_fees') }}</label>
                    @endif
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label for="lunch_rate" class="control-label">
                      {{ __('Lunch Rate') }}
                      <span style="color:red;">*</span>
                    </label>
                    <input type="number" step="0.01" min="0" max="999999.99" name="lunch_rate" placeholder="{{ __('Lunch Rate') }}" value="{{ old('lunch_rate', @$roomType->lunch_rate) }}" id="lunch_rate" class="form-control {{ $errors->has('lunch_rate') ? 'is-invalid' : '' }}" required autocomplete="off" autofocus />
                    @if ($errors->has('lunch_rate'))
                    <label class="error">{{ $errors->first('lunch_rate') }}</label>
                    @endif
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label for="lunch_price" class="control-label">
                      {{ __('Lunch Price') }}
                      <span style="color:red;">*</span>
                    </label>
                    <input type="number" step="0.01" min="0" max="999999.99" name="lunch_price" placeholder="{{ __('Lunch Price') }}" value="{{ old('lunch_price', @$roomType->lunch_price) }}" id="lunch_price" class="form-control {{ $errors->has('lunch_price') ? 'is-invalid' : '' }}" required autocomplete="off" autofocus />
                    @if ($errors->has('lunch_price'))
                    <label class="error">{{ $errors->first('lunch_price') }}</label>
                    @endif
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label for="lunch_fees" class="control-label">
                      {{ __('Lunch Fees') }}
                      <span style="color:red;">*</span>
                    </label>
                    <input type="number" step="0.01" min="0" max="999999.99" name="lunch_fees" placeholder="{{ __('Lunch Fees') }}" value="{{ old('lunch_fees', @$roomType->lunch_fees) }}" id="lunch_fees" class="form-control {{ $errors->has('lunch_fees') ? 'is-invalid' : '' }}" required autocomplete="off" autofocus />
                    @if ($errors->has('lunch_fees'))
                    <label class="error">{{ $errors->first('lunch_fees') }}</label>
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
                  <a href="{{ url('admin/hotels/' . request('hotelId') . '/roomtypes') }}" id="reset" class="btn btn-block btn-outline-info my-1">
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
                  <th>{{ __('Breakfast Rate') }}</th>
                  <th>{{ __('Breakfast Price') }}</th>
                  <th>{{ __('Breakfast Fees') }}</th>
                  <th>{{ __('Dinner Rate') }}</th>
                  <th>{{ __('Dinner Price') }}</th>
                  <th>{{ __('Dinner Fees') }}</th>
                  <th>{{ __('Lunch Rate') }}</th>
                  <th>{{ __('Lunch Price') }}</th>
                  <th>{{ __('Lunch Fees') }}</th>
                  <th>{{ __('Action') }}</th>
                </tr>
              </thead>

              <tbody>
                @foreach($roomTypes as $key => $roomType)
                <tr>
                  <td>{{ @$roomType->id }}</td>
                  <td>{{ ucwords(@$roomType->name) }}</td>
                  <td>{{ number_format($roomType->breakfast_rate, 2) }}</td>
                  <td>{{ number_format($roomType->breakfast_price, 2) }}</td>
                  <td>{{ number_format($roomType->breakfast_fees, 2) }}</td>
                  <td>{{ number_format($roomType->dinner_rate, 2) }}</td>
                  <td>{{ number_format($roomType->dinner_price, 2) }}</td>
                  <td>{{ number_format($roomType->dinner_fees, 2) }}</td>
                  <td>{{ number_format($roomType->lunch_rate, 2) }}</td>
                  <td>{{ number_format($roomType->lunch_price, 2) }}</td>
                  <td>{{ number_format($roomType->lunch_fees, 2) }}</td>
                  <td>
                    <a href="{{ url('admin/hotels/' . request('hotelId') . '/roomtypes/' . @$roomType->id) }}" title="Edit"
                      class="btn btn-xs btn-outline-info py-0 mx-1">
                      <i class="fa fa-pencil-square-o"></i>
                    </a>
                    <a onClick="if (confirm('Are you sure?')) return this.nextElementSibling.submit();"
                      href="javascript:;" title="Delete" class="btn btn-xs btn-outline-danger py-0 mx-1">
                      <i class="fa fa-trash-o"></i>
                    </a>
                    <form action="{{ url('admin/hotels/' . request('hotelId') . '/roomtypes/' . @$roomType->id) }}" method="POST" class="d-none">
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
          targets: [0, 11], // column index
          orderable: false,
        },
        {
          targets: [0, 11], // column index
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
          filename: 'hotel_roomtypes',
          className: 'btn btn-xs btn-dark py-1',
          exportOptions: {
            columns: ':visible:not(:last-child)'
          }
        },
        {
          extend: 'excel',
          text: 'Excel',
          filename: 'hotel_roomtypes',
          className: 'btn btn-xs btn-dark py-1',
          exportOptions: {
            columns: ':visible:not(:last-child)'
          }
        },
        {
          extend: 'pdf',
          text: 'PDF',
          filename: 'hotel_roomtypes',
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