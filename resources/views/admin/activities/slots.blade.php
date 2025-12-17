@extends('admin.layouts.app')

@section('title', __(@$activity->service_name . ': Slot'))

@section('content')
    <!-- Heading -->
    <div class="breadcrumbs">
        <div class="breadcrumbs-inner">
            <div class="row">
                <div class="col-sm-4">
                    <div class="page-header float-left">
                        <div class="page-title">
                            <h1>{{ __(@$activity->service_name) }}</h1>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="page-header float-right">
                        <div class="page-title">
                            <ol class="breadcrumb text-right">
                                <li><a href="{{ url('admin/home') }}">{{ __('Dashboard') }}</a></li>
                                <li><a href="{{ url('admin/activities') }}">{{ __('Activity') }}</a></li>
                                <li class="active">{{ __('Slots') }}</li>
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
                                {{ __('Slots') }}
                            </strong>
                        </div>

                        <div class="card-body">
                           <form
    action="{{ url('admin/activities/' . request('activityId') . '/slots' . (@$slot ? '/' . @$slot->id : '')) }}"
    method="POST" id="form" enctype="multipart/form-data"
    novalidate="novalidate" autocomplete="off">
    @csrf

    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="form-group">
                <label for="slot_start" class="control-label">
                    {{ __('Slot Start Timing') }}
                    <span style="color:red;">*</span>
                </label>
                <input type="time" name="slot_start" placeholder="Slot Start Time"
                    value="{{ old('slot_start', @$slot ? date('H:i', strtotime($slot->slot_start)) : '') }}"
                    id="slot_start"
                    class="form-control {{ $errors->has('slot_start') ? 'is-invalid' : '' }}"
                    autocomplete="off" autofocus />

                @if ($errors->has('slot_start'))
                    <label class="error">{{ $errors->first('slot_start') }}</label>
                @endif
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="slot_end" class="control-label">
                    {{ __('Slot End Timing') }}
                    <span style="color:red;">*</span>
                </label>
                <input type="time" name="slot_end" placeholder="Slot End Time"
                    value="{{ old('slot_end', @$slot ? date('H:i', strtotime($slot->slot_end)) : '') }}"
                    id="slot_end"
                    class="form-control {{ $errors->has('slot_end') ? 'is-invalid' : '' }}"
                    autocomplete="off" />

                @if ($errors->has('slot_end'))
                    <label class="error">{{ $errors->first('slot_end') }}</label>
                @endif
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="duration" class="control-label">
                    {{ __('Slot Duration in mins') }}
                    <span style="color:red;">*</span>
                </label>
                <input type="number" name="duration" placeholder="Duration"
                    value="{{ old('duration', @$slot->duration ?? '') }}"
                    id="duration"
                    class="form-control {{ $errors->has('duration') ? 'is-invalid' : '' }}"
                    autocomplete="off" />

                @if ($errors->has('duration'))
                    <label class="error">{{ $errors->first('duration') }}</label>
                @endif
            </div>
        </div>
    </div>

    
    <div class="row align-items-center justify-content-center mt-3">
        <div class="align-self-center col-md-2">
            <button type="submit" name="submit" id="submit"
                class="btn btn-block btn-info my-1">
                <i class="fa fa-floppy-o fa-lg"></i>&nbsp;
                <span>{{ @$slot ? __('Update') : __('Add') }}</span>
            </button>
        </div>

        <div class="align-self-center col-md-2">
            <a href="{{ url('admin/activities/' . request('activityId') . '/slots') }}"
                id="reset" class="btn btn-block btn-outline-info my-1">
                <i class="fa fa-refresh fa-lg"></i>&nbsp;
                <span>{{ __('Reset') }}</span>
            </a>
        </div>
    </div>
</form>

<hr class="my-3">
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
                                        class="btn btn-block btn-info my-1">
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
                                        class="btn btn-block btn-outline-info my-1">
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
        $(document).ready(function() {
            var datatable = $('#dataTable').DataTable({
                responsive: true,
                lengthMenu: [
                    [10, 50, 100, -1],
                    [10, 50, 100, 'All']
                ],
                pageLength: 10,
                order: [[0, 'desc']], // Updated from aaSorting
                columnDefs: [
                    {
                        targets: [0, 3], // column index
                        orderable: false,
                        searchable: false,
                    },
                    {
                        targets: [0], // column index
                        visible: true,
                    }
                ],
                dom: '<"row"<"col-md-3"l><"col-md-4"B><"col-md-5"f>>' +
                    '<"row"<"col-md-12"tr>>' +
                    '<"row"<"col-md-5"i><"col-md-7"p>>',
                buttons: [
                    {
                        extend: 'csv',
                        text: 'CSV',
                        filename: 'activity_slots',
                        className: 'btn btn-xs btn-dark py-1',
                        exportOptions: {
                            columns: ':visible:not(:last-child)'
                        }
                    },
                    {
                        extend: 'excel',
                        text: 'Excel',
                        filename: 'activity_slots',
                        className: 'btn btn-xs btn-dark py-1',
                        exportOptions: {
                            columns: ':visible:not(:last-child)'
                        }
                    },
                    {
                        extend: 'pdf',
                        text: 'PDF',
                        filename: 'activity_slots',
                        className: 'btn btn-xs btn-dark py-1',
                        exportOptions: {
                            columns: ':visible:not(:last-child)'
                        }
                    }
                ],
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/English.json' // Optional: Use appropriate language
                }
            });
        });
    </script>
@endsection

