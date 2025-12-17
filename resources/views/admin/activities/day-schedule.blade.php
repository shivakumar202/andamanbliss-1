@extends('admin.layouts.app')

@section('title', __(@$activity->name . ': Day Schedule'))

@section('content')
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
                                <li class="active">{{ __('Day Schedule') }}</li>
                            </ol>
                        </div>
                    </div>
                </div>

                <div class="col-sm-2">
                    <a href="{{ url('admin/activities/' . $activity->id) }}" class="btn btn-info float-right my-2 mx-3">
                        <i class="fa fa-undo fa-lg"></i>&nbsp;
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
                            <strong class="card-title">{{ __('Day Schedule') }}</strong>
                        </div>

                        <div class="card-body">
                            <form
                                action="{{ url('admin/activities/' . $activity->id . '/day-schedules' . ($daySchedule ? '/' . $daySchedule->id : '')) }}"
                                method="POST" enctype="multipart/form-data" novalidate autocomplete="off">
                                @csrf

                                <div class="row justify-content-center">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="heading"
                                                class="control-label">{{ __('Heading (common)') }}</label>
                                            <input type="text" name="heading" placeholder="{{ __('Heading') }}"
                                                value="{{ isset($daySchedules[0]['heading']) ? $daySchedules[0]['heading'] : '' }}"
                                                id="heading"
                                                class="form-control rounded-0 {{ $errors->has('heading') ? 'is-invalid' : '' }}" />

                                            @if ($errors->has('heading'))
                                                <label class="error">{{ $errors->first('heading') }}</label>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="time_slot">{{ __('Time Slot') }} <span
                                                    style="color:red;">*</span></label>
                                            <input type="text" name="time_slot" id="time_slot"
                                                placeholder="e.g. 08:00 AM - 09:00 AM"
                                                value="{{ old('time_slot', @$daySchedule->time_slot) }}"
                                                class="form-control rounded-0 {{ $errors->has('time_slot') ? 'is-invalid' : '' }}" />
                                            @if ($errors->has('time_slot'))
                                                <label class="error">{{ $errors->first('time_slot') }}</label>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="title">{{ __('Title') }} <span
                                                    style="color:red;">*</span></label>
                                            <input type="text" name="title" id="title" placeholder="Title"
                                                value="{{ old('title', @$daySchedule->title) }}"
                                                class="form-control rounded-0 {{ $errors->has('title') ? 'is-invalid' : '' }}" />
                                            @if ($errors->has('title'))
                                                <label class="error">{{ $errors->first('title') }}</label>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="description">{{ __('Description') }} <span
                                                    style="color:red;">*</span></label>
                                            <textarea name="description" id="description" rows="3"
                                                class="form-control rounded-0 {{ $errors->has('description') ? 'is-invalid' : '' }}">{{ old('description', @$daySchedule->description) }}</textarea>
                                            @if ($errors->has('description'))
                                                <label class="error">{{ $errors->first('description') }}</label>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row justify-content-center">
                                    <div class="col-md-2">
                                        <button type="submit" class="btn btn-block btn-success">
                                            <i class="fa fa-floppy-o fa-lg"></i>&nbsp;{{ __('Save') }}
                                        </button>
                                    </div>
                                    <div class="col-md-2">
                                        <a href="{{ url()->current() }}" class="btn btn-block btn-outline-danger">
                                            <i class="fa fa-refresh fa-lg"></i>&nbsp;{{ __('Reset') }}
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
                                    class="btn btn-block btn-info my-1">
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
                                        <th>{{ __('Time Slot') }}</th>
                                        <th>{{ __('Title') }}</th>
                                        <th>{{ __('Description') }}</th>
                                        <th>{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($daySchedules as $schedule)
                                        <tr>
                                            <td>{{ $schedule->id }}</td>
                                            <td>{{ $schedule->time_slot }}</td>
                                            <td>{{ $schedule->title }}</td>
                                            <td>{{ $schedule->description }}</td>
                                            <td>
                                                <a href="{{ url('admin/activities/' . $activity->id . '/day-schedules/' . $schedule->id) }}"
                                                    class="btn btn-xs btn-outline-info"><i
                                                        class="fa fa-pencil-square-o"></i></a>

                                                <a href="javascript:;"
                                                    onclick="if(confirm('Are you sure?')) { this.nextElementSibling.submit(); }"
                                                    class="btn btn-xs btn-outline-danger"><i class="fa fa-trash-o"></i></a>

                                                <form
                                                    action="{{ url('admin/activities/' . $activity->id . '/day-schedules/' . $schedule->id) }}"
                                                    method="POST" class="d-none">
                                                    @csrf
                                                    @method('DELETE')
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

@section('script')
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                responsive: true,
                pageLength: 10,
                aaSorting: [
                    [0, 'desc']
                ],
                columnDefs: [{
                        targets: [0],
                        visible: false,
                        searchable: false
                    },
                    {
                        targets: [4],
                        orderable: false,
                        searchable: false
                    }
                ]
            });
        });
    </script>
@endsection
