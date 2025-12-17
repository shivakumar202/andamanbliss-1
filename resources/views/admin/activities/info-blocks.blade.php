@extends('admin.layouts.app')

@section('title', __(@$activity->name . ': Info Block'))

@section('content')
    <!-- Heading -->
    <div class="breadcrumbs">
        <div class="breadcrumbs-inner">
            <div class="row">
                <div class="col-sm-4">
                    <div class="page-header float-left">
                        <div class="page-title">
                            <h1>{{ __(@$activity->name) }}</h1>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="page-header float-right">
                        <div class="page-title">
                            <ol class="breadcrumb text-right">
                                <li><a href="{{ url('admin/home') }}">{{ __('Dashboard') }}</a></li>
                                <li><a href="{{ url('admin/activities') }}">{{ __('Activity') }}</a></li>
                                <li class="active">{{ __('Info Block') }}</li>
                            </ol>
                        </div>
                    </div>
                </div>

                <div class="col-sm-2">
                    <a href="{{ url('admin/activities/' . request('activityId')) }}"
                        class="btn btn-info float-right my-2 mx-3">
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
                                {{ __('Info Block') }}
                            </strong>
                        </div>

                        <div class="card-body">
                            <form name="form"
                                @if (@$infoBlock) action="{{ url('admin/activities/' . request('activityId') . '/info-blocks/' . @$infoBlock->id) }}"
            @else
            action="{{ url('admin/activities/' . request('activityId') . '/info-blocks') }}" @endif
                                method="POST" id="form" class="" enctype="multipart/form-data"
                                novalidate="novalidate" autocomplete="off">
                                @csrf

                                <div class="row justify-content-center">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="icon" class="control-label">
                                                {{ __('Icon') }}
                                                <span style="color:red;">*</span>
                                            </label>
                                            <input type="text" name="icon"
                                                placeholder="{{ __('<i class=" fa fa-pencil" aria-hidden="true"></i>') }}"
                                                value="{{ old('icon', @$infoBlock->icon) }}" id="icon"
                                                class="form-control rounded-0 {{ $errors->has('icon') ? 'is-invalid' : '' }}"
                                                autocomplete="off" autofocus />
                                            @if ($errors->has('icon'))
                                                <label class="error">{{ $errors->first('icon') }}</label>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="name" class="control-label">
                                                {{ __('Title') }}
                                                <span style="color:red;">*</span>
                                            </label>
                                            <input type="text" name="name" placeholder="{{ __('Title') }}"
                                                value="{{ old('name', @$infoBlock->name) }}" id="name"
                                                class="form-control rounded-0 {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                autocomplete="off" autofocus />
                                            @if ($errors->has('name'))
                                                <label class="error">{{ $errors->first('name') }}</label>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="description" class="control-label">
                                                {{ __('Description') }}
                                            </label>
                                            <textarea class="form-control rounded-0 {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description"
                                                id="description" placeholder="{{ __('Description') }}" cols="30" rows="3" autocomplete="off">{{ old('description', @$infoBlock->description) }}</textarea>
                                            @if ($errors->has('description'))
                                                <label class="error">{{ $errors->first('description') }}</label>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row align-items-center justify-content-center">
                                    <div class="align-self-center col-md-2">
                                        <button type="submit" name="submit" id="submit"
                                            class="btn btn-block btn-success my-1">
                                            <i class="fa fa-floppy-o fa-lg"></i>&nbsp;
                                            <span>{{ __('Save') }}</span>
                                        </button>
                                    </div>

                                    <div class="align-self-center col-md-2">
                                        <a href="{{ url('admin/activities/' . request('activityId') . '/info-blocks') }}"
                                            id="reset" class="btn btn-block btn-outline-danger my-1">
                                            <i class="fa fa-refresh fa-lg"></i>&nbsp;
                                            <span>{{ __('Reset') }}</span>
                                        </a>
                                    </div>
                                </div>
                            </form>
                            <hr>
                               <div class="row align-items-center justify-content-center">
                                    <div class="align-self-center col-md-2">
                                        <a href="{{ url('admin/activities/' . @$activity->id . '/images') }}"
                                            class="btn btn-block btn-outline-info my-1">
                                            <i class="fa fa-pencil-square-o fa-lg"></i>&nbsp;
                                            <span>{{ __('Images') }}</span>
                                        </a>
                                    </div>

                                    <div class="align-self-center col-md-2">
                                        <a href="{{ url('admin/activities/' . @$activity->id . '/facilities') }}"
                                            class="btn btn-block btn-outline-info my-1">
                                            <i class="fa fa-pencil-square-o fa-lg"></i>&nbsp;
                                            <span>{{ __('Facilities') }}</span>
                                        </a>
                                    </div>

                                    <div class="align-self-center col-md-2">
                                        <a href="{{ url('admin/activities/' . @$activity->id . '/highlights') }}"
                                            class="btn btn-block btn-outline-info my-1">
                                            <i class="fa fa-pencil-square-o fa-lg"></i>&nbsp;
                                            <span>{{ __('Highlights') }}</span>
                                        </a>
                                    </div>

                                    <div class="align-self-center col-md-2">
                                    <a href="{{ url('admin/activities/' . @$activity->id . '/slots') }}"
                                        class="btn btn-block btn-outline-info my-1">
                                        <i class="fa fa-clock-o fa-lg"></i>&nbsp;
                                        <span>{{ __('Timing Slots') }}</span>
                                    </a>
                                </div>

                                    <div class="align-self-center col-md-2">
                                        <a href="{{ url('admin/activities/' . @$activity->id . '/faqs') }}"
                                            class="btn btn-block btn-outline-info my-1">
                                            <i class="fa fa-pencil-square-o fa-lg"></i>&nbsp;
                                            <span>{{ __('Faqs') }}</span>
                                        </a>
                                    </div>

                                    <div class="align-self-center col-md-2">
                                        <a href="{{ url('admin/activities/' . @$activity->id . '/reviews') }}"
                                            class="btn btn-block btn-outline-info my-1">
                                            <i class="fa fa-pencil-square-o fa-lg"></i>&nbsp;
                                            <span>{{ __('Reviews') }}</span>
                                        </a>
                                    </div>
                                    <div class="align-self-center col-md-2">
                                        <a href="{{ url('admin/activities/' . @$activity->id . '/info-blocks') }}"
                                            class="btn btn-block btn-info my-1">
                                            <i class="fa fa-info fa-lg"></i>&nbsp;
                                            <span>{{ __('Info Blocks') }}</span>
                                        </a>
                                    </div>
                                    <div class="align-self-center col-md-2">
                                        <a href="{{ url('admin/activities/' . @$activity->id . '/meta-headings') }}"
                                            class="btn btn-block btn-outline-info my-1">
                                            <i class="fa fa-google fa-lg"></i>&nbsp;
                                            <span>{{ __('Meta Headings') }}</span>
                                        </a>
                                    </div>
                                    <div class="align-self-center col-md-2">
                                        <a href="{{ url('admin/activities/' . @$activity->id . '/content-blocks') }}"
                                            class="btn btn-block btn-outline-info my-1">
                                            <i class="fa fa-windows fa-lg"></i>&nbsp;
                                            <span>{{ __('Content Block') }}</span>
                                        </a>
                                    </div>
                                    <div class="align-self-center col-md-2">
                                        <a href="{{ url('admin/activities/' . @$activity->id . '/day-schedules') }}"
                                            class="btn btn-block btn-outline-info my-1">
                                            <i class="fa fa-calendar fa-lg"></i>&nbsp;
                                            <span>{{ __('Day Schedule') }}</span>
                                        </a>
                                    </div>
                                    <div class="align-self-center col-md-2">
                                        <a href="{{ url('admin/activities/' . @$activity->id . '/overview') }}"
                                            class="btn btn-block btn-outline-info my-1">
                                            <i class="fa fa-book fa-lg"></i>&nbsp;
                                            <span>{{ __('Overview') }}</span>
                                        </a>
                                    </div>
                                    <div class="align-self-center col-md-2">
                                        <a href="{{ url('admin/activities/' . @$activity->id . '/edit') }}"
                                            class="btn btn-block btn-outline-info my-1">
                                            <i class="fa fa-pencil-square-o fa-lg"></i>&nbsp;
                                            <span>{{ __('Edit') }}</span>
                                        </a>
                                    </div>
                                </div>
                            <hr>
                            <table id="dataTable" class="table table-striped table-hover w-100">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>{{ __('ID') }}</th>
                                        <th>{{ __('Icon') }}</th>
                                        <th>{{ __('Title') }}</th>
                                        <th>{{ __('Description') }}</th>
                                        <th>{{ __('Action') }}</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($infoBlocks as $key => $infoBlock)
                                        <tr>
                                            <td>{{ @$infoBlock->id }}</td>
                                            <td>{!! @$infoBlock->icon !!}</td>
                                            <td>{{ ucwords(@$infoBlock->name) }}</td>
                                            <td>{{ ucwords(@$infoBlock->description) }}</td>
                                            <td>
                                                <a href="{{ url('admin/activities/' . request('activityId') . '/info-blocks/' . @$infoBlock->id) }}"
                                                    title="Edit" class="btn btn-xs btn-outline-info py-0 mx-1">
                                                    <i class="fa fa-pencil-square-o"></i>
                                                </a>
                                                <a onClick="if (confirm('Are you sure?')) return this.nextElementSibling.submit();"
                                                    href="javascript:;" title="Delete"
                                                    class="btn btn-xs btn-outline-danger py-0 mx-1">
                                                    <i class="fa fa-trash-o"></i>
                                                </a>
                                                <form
                                                    action="{{ url('admin/activities/' . request('activityId') . '/info-blocks/' . @$infoBlock->id) }}"
                                                    method="POST" class="d-none">
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
                buttons: [{
                        extend: 'csv',
                        text: 'CSV',
                        filename: 'activity_facilities',
                        className: 'btn btn-xs btn-dark py-1',
                        exportOptions: {
                            columns: ':visible:not(:last-child)'
                        }
                    },
                    {
                        extend: 'excel',
                        text: 'Excel',
                        filename: 'activity_facilities',
                        className: 'btn btn-xs btn-dark py-1',
                        exportOptions: {
                            columns: ':visible:not(:last-child)'
                        }
                    },
                    {
                        extend: 'pdf',
                        text: 'PDF',
                        filename: 'activity_facilities',
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
