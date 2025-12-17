@extends('admin.layouts.app')

@section('title', __('Boat Trip'))

@section('content')
    <!-- Heading -->
    <div class="breadcrumbs">
        <div class="breadcrumbs-inner">
            <div class="row">
                <div class="col-sm-4">
                    <div class="page-header float-left">
                        <div class="page-title">
                            <h1>{{ __('Boat Trip') }}</h1>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="page-header float-right">
                        <div class="page-title">
                            <ol class="breadcrumb text-right">
                                <li><a href="{{ url('admin/home') }}">{{ __('Dashboard') }}</a></li>
                                <li class="active">{{ __('Boat Trip') }}</li>
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
                        <div class="card-header d-flex justify-content-between">
                            <div class="font-weight-bold col-2">
                                {{ __('Boat Trip') }}
                            </div>
                            <div class="col-sm-2">
                                <a href="{{ url('admin/boat-trips/create') }}" class="btn btn-info float-right my-2 mx-3">
                                    <i class="fa fa-plus fa-lg"></i>&nbsp;
                                    {{ __('Create New') }}
                                </a>
                            </div>

                        </div>

                        <div class="card-body">
                            <form name="form" action="{{ url('admin/bikes') }}" method="GET" id="form"
                                class="" enctype="multipart/form-data" novalidate="novalidate" autocomplete="off">
                                <div class="row justify-content-center">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="location" class="control-label">
                                                {{ __('Location') }}
                                            </label>
                                            <select name="location" id="location" class="form-control">
                                                <option value="">{{ __('Select') }}</option>
                                                @foreach ($locations as $location)
                                                    <option value="{{ $location }}" @selected(request('location') == $location)>
                                                        {{ ucwords($location) }}</option>
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
                                                <option value="active" @selected(request('status') == 'active')>{{ __('Active') }}
                                                </option>
                                                <option value="inactive" @selected(request('status') == 'inactive')>{{ __('Inactive') }}
                                                </option>
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
                                        <a href="{{ url('admin/boat-trips') }}"
                                            class="btn btn-block btn-outline-info my-1">
                                            <i class="fa fa-refresh fa-lg"></i>&nbsp;
                                            <span>{{ __('Reset') }}</span>
                                        </a>
                                    </div>
                                </div>
                            </form>

                            <hr>
                            @if (isset($locationId))
                                @include('admin.boat-trips.navigations')
                                <hr>
                            @endif

                            <table id="dataTable" class="table table-striped table-hover w-100">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>{{ __('ID') }}</th>
                                        <th>{{ __('Name') }}</th>
                                        <th>{{ __('Location') }}</th>
                                        <th>{{ __('Adult Price') }}</th>
                                        <th>{{ __('Infant Price') }}</th>
                                        <th>{{ __('Service & Charges') }}</th>
                                        <th>{{ __('Start Time - End Time') }}</th>
                                        <th>{{ __('Slot Interval') }}</th>
                                        <th>{{ __('Status') }}</th>
                                        <th>{{ __('Action') }}</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($boatTrips as $trip)
                                        <tr>
                                            <td>{{ @$trip->id }}</td>
                                            <td>{{ ucwords(@$trip->name) }}</td>
                                            <td>{{ @$trip->location }}</td>
                                            <td>{{ $trip->adult_price }}</td>
                                            <td>{{ @$trip->infant_price }}</td>
                                            <td>{{ @$trip->service_tax }}</td>
                                            <td>{{ \Carbon\Carbon::parse(@$trip->start_time)->format('H:i A') . '-' . \Carbon\carbon::parse($trip->end_time)->format('H:i A') }}
                                            </td>
                                            <td>{{ @$trip->slot_interval }}</td>
                                            <td>{{ @$trip->status == 1 ? 'Active' : 'Inactive' }}</td>
                                            <td>

                                                <a href="{{ url('admin/boat-trips/' . @$trip->id . '/edit') }}"
                                                    title="Edit" class="btn btn-xs btn-outline-info py-0 mx-1">
                                                    <i class="fa fa-pencil-square-o"></i>
                                                </a>
                                                <a onClick="if (confirm('Are you sure?')) return this.nextElementSibling.submit();"
                                                    href="javascript:;" title="Delete"
                                                    class="btn btn-xs btn-outline-danger py-0 mx-1">
                                                    <i class="fa fa-trash-o"></i>
                                                </a>
                                                <form action="{{ url('admin/boat-trips/' . $trip->id) }}" method="POST"
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
                buttons: [{
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
