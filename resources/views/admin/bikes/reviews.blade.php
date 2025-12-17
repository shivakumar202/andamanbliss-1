@extends('admin.layouts.app')

@section('title', __(@$bike->name . ': Review'))

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
                            <li class="active">{{ __('Review') }}</li>
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
                            {{ __('Review') }}
                        </strong>
                    </div>

                    <div class="card-body">
                        <form name="form"
                        @if (@$review)
                        action="{{ url('admin/bikes/' . request('bikeId') . '/reviews/' . @$review->id) }}"
                        @else
                        action="{{ url('admin/bikes/' . request('bikeId') . '/reviews') }}"
                        @endif
                        method="POST" id="form" class="" enctype="multipart/form-data" novalidate="novalidate" autocomplete="off">
                            @csrf

                            <div class="row justify-content-center">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name" class="control-label">
                                            {{ __('Name') }}
                                            <span style="color:red;">*</span>
                                        </label>
                                        <input type="text" name="name" placeholder="{{ __('Name') }}" value="{{ old('name', @$review->name) }}" id="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" autocomplete="off" autofocus />
                                        @if ($errors->has('name'))
                                        <label class="error">{{ $errors->first('name') }}</label>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="address" class="control-label">
                                            {{ __('Address') }}
                                            <span style="color:red;">*</span>
                                        </label>
                                        <input type="text" name="address" placeholder="{{ __('Address') }}" value="{{ old('address', @$review->address) }}" id="address" class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" autocomplete="off" autofocus />
                                        @if ($errors->has('address'))
                                        <label class="error">{{ $errors->first('address') }}</label>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="review" class="control-label">
                                            {{ __('Review') }}
                                            <span style="color:red;">*</span>
                                        </label>
                                        <textarea name="review" placeholder="{{ __('Review') }}" id="review" class="form-control {{ $errors->has('review') ? 'is-invalid' : '' }}" autocomplete="off" autofocus>{!! old('review', @$review->review) !!}</textarea>
                                        @if ($errors->has('review'))
                                        <label class="error">{{ $errors->first('review') }}</label>
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
                                    <a href="{{ url('admin/bikes/' . request('bikeId') . '/reviews') }}" id="reset" class="btn btn-block btn-outline-info my-1">
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
                                    <th>{{ __('Address') }}</th>
                                    <th>{{ __('Review') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($reviews as $key => $review)
                                <tr>
                                    <td>{{ @$review->id }}</td>
                                    <td>{{ ucwords(@$review->name) }}</td>
                                    <td>{{ ucwords(@$review->address) }}</td>
                                    <td>{!! @$review->review !!}</td>
                                    <td>
                                        <a href="{{ url('admin/bikes/' . request('bikeId') . '/reviews/' . @$review->id) }}" title="Edit" class="btn btn-xs btn-outline-info py-0 mx-1">
                                            <i class="fa fa-pencil-square-o"></i>
                                        </a>
                                        <a onClick="if (confirm('Are you sure?')) return this.nextElementSibling.submit();" href="javascript:;" title="Delete" class="btn btn-xs btn-outline-danger py-0 mx-1">
                                            <i class="fa fa-trash-o"></i>
                                        </a>
                                        <form action="{{ url('admin/bikes/' . request('bikeId') . '/reviews/' . @$review->id) }}" method="POST" class="d-none">
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
            lengthMenu: [
                [10, 50, 100, -1],
                [10, 50, 100, 'All']
            ],
            pageLength: 10,
            aaSorting: [0, 'DESC'],
            columnDefs: [{
                    targets: [0, 4], // column index
                    orderable: false,
                },
                {
                    targets: [0, 4], // column index
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
                    filename: 'bike_reviews',
                    className: 'btn btn-xs btn-dark py-1',
                    exportOptions: {
                        columns: ':visible:not(:last-child)'
                    }
                },
                {
                    extend: 'excel',
                    text: 'Excel',
                    filename: 'bike_reviews',
                    className: 'btn btn-xs btn-dark py-1',
                    exportOptions: {
                        columns: ':visible:not(:last-child)'
                    }
                },
                {
                    extend: 'pdf',
                    text: 'PDF',
                    filename: 'bike_reviews',
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