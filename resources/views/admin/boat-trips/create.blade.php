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
                                <li><a href="{{ url('admin/boat-trips') }}">{{ __('Boat Trip') }}</a></li>
                                @if (@$boatTrip)
                                    <li class="active">{{ __('Edit') }}</li>
                                @else
                                    <li class="active">{{ __('New') }}</li>
                                @endif
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
                    <form name="form"
                        @if (@$boatTrip) action="{{ url('admin/boat-trips/' . @$boatTrip->id) }}" @else action="{{ url('admin/boat-trips') }}" @endif
                        method="POST" id="form" class="card" enctype="multipart/form-data" novalidate="novalidate"
                        autocomplete="off">
                        @csrf
                        @if (@$boatTrip)
                            @method('PUT')
                        @endif
                        <div class="card-header">
                            <strong class="card-title">
                                @if (@$boatTrip)
                                    {{ __('Edit') }}
                                @else
                                    {{ __('New') }}
                                @endif
                            </strong>
                        </div>
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name" class="control-label">
                                            {{ __('Name') }}
                                            <span style="color:red;">*</span>
                                        </label>
                                        <input type="text" name="name" placeholder="{{ __('Name') }}"
                                            value="{{ old('name', @$boatTrip->name) }}" id="name"
                                            class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                            autocomplete="off" required autofocus />
                                        @if ($errors->has('name'))
                                            <label class="error">{{ $errors->first('name') }}</label>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="location" class="control-label">
                                            {{ __('Location') }}
                                            <span style="color:red;">*</span>
                                        </label>
                                        <select name="location" id="location" required
                                            class="form-control {{ $errors->has('location') ? 'is-invalid' : '' }}">
                                            <option value="" {{ old('location', '') == '' ? 'selected' : '' }}
                                                disabled>
                                                {{ __('Select Location') }}`
                                            </option>
                                            @foreach ($locations as $location)
                                                <option value="{{ $location }}"
                                                    {{ old('location', @$boatTrip->location) == $location ? 'selected' : '' }}>
                                                    {{ ucwords($location) }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('location'))
                                            <label class="error">{{ $errors->first('location') }}</label>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="adult_price" class="control-label">
                                            {{ __('Adult Price') }}
                                            <span style="color:red;">*</span>
                                        </label>
                                        <input type="number" step="1" min="0" max="999999.99"
                                            name="adult_price" placeholder="{{ __('Adult Price') }}"
                                            value="{{ old('adult_price', @$boatTrip->adult_price) }}" id="adult_price"
                                            class="form-control {{ $errors->has('adult_price') ? 'is-invalid' : '' }}"
                                            required autocomplete="off" autofocus />
                                        @if ($errors->has('adult_price'))
                                            <label class="error">{{ $errors->first('adult_price') }}</label>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="infant_price" class="control-label">
                                            {{ __('Infant Price') }}
                                            <span style="color:red;">*</span>
                                        </label>
                                        <input type="number" step="1" min="0" max="999999.99"
                                            name="infant_price" placeholder="{{ __('infant Price') }}"
                                            value="{{ old('infant_price', @$boatTrip->infant_price) }}" id="infant_price"
                                            class="form-control {{ $errors->has('infant_price') ? 'is-invalid' : '' }}"
                                            required autocomplete="off" autofocus />
                                        @if ($errors->has('infant_price'))
                                            <label class="error">{{ $errors->first('infant_price') }}</label>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="service_tax" class="control-label">
                                            {{ __('Services & Tax') }}
                                            <span style="color:red;">*</span>
                                        </label>
                                        <input type="number" step="0.01" min="0" max="999999.99"
                                            name="service_tax" placeholder="{{ __('Service & Tax') }}"
                                            value="{{ old('service_tax', @$boatTrip->service_tax) }}" id="service_tax"
                                            class="form-control {{ $errors->has('service_tax') ? 'is-invalid' : '' }}"
                                            required autocomplete="off" autofocus />
                                        @if ($errors->has('service_tax'))
                                            <label class="error">{{ $errors->first('service_tax') }}</label>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="start_time" class="control-label">
                                            {{ __('Start Time') }}
                                            <span style="color:red;">*</span>
                                        </label>
                                        <input type="time" name="start_time" placeholder="{{ __('Start Time') }}"
                                            value="{{ old('start_time', @$boatTrip->start_time) }}" id="start_time"
                                            class="form-control {{ $errors->has('start_time') ? 'is-invalid' : '' }}"
                                            autocomplete="off" autofocus />
                                        @if ($errors->has('start_time'))
                                            <label class="error">{{ $errors->first('start_time') }}</label>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="end_time" class="control-label">
                                            {{ __('Closing Time') }}
                                            <span style="color:red;">*</span>
                                        </label>
                                        <input type="time" name="end_time" placeholder="{{ __('Closing Time') }}"
                                            value="{{ old('end_time', @$boatTrip->end_time) }}" id="end_time"
                                            class="form-control {{ $errors->has('end_time') ? 'is-invalid' : '' }}"
                                            autocomplete="off" autofocus />
                                        @if ($errors->has('end_time'))
                                            <label class="error">{{ $errors->first('end_time') }}</label>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="slot_interval" class="control-label">
                                            {{ __('Slot Interval') }}
                                            <span style="color:red;">*</span>
                                        </label><span style="font-size: 12px">(min:1 , max:60) In Minutes</span>
                                        <input type="number" min="1" max="60" name="slot_interval"
                                            placeholder="{{ __('Slot Interval') }}"
                                            value="{{ old('slot_interval', @$boatTrip->slot_interval) }}"
                                            id="slot_interval"
                                            class="form-control {{ $errors->has('slot_interval') ? 'is-invalid' : '' }}"
                                            autocomplete="off" autofocus />
                                        @if ($errors->has('slot_interval'))
                                            <label class="error">{{ $errors->first('slot_interval') }}</label>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="status" class="control-label">
                                            {{ __('Status') }}
                                            <span style="color:red;">*</span>
                                        </label>
                                        <select name="status" id="status"
                                            class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}">
                                            <option value="">{{ __('Select') }}</option>
                                            <option value="1" @selected(old('status', @$boatTrip->status) == '1')>{{ ucwords('active') }}
                                            </option>
                                            <option value="0" @selected(old('status', @$boatTrip->status) == '0')>
                                                {{ ucwords('In active') }}</option>
                                        </select>
                                        @if ($errors->has('status'))
                                            <label class="error">{{ $errors->first('status') }}</label>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row align-items-center justify-content-center">
                                <div class="align-self-center col-md-2">
                                    <button type="submit" name="submit" id="submit"
                                        class="btn btn-block btn-info my-1">
                                        <i class="fa fa-floppy-o fa-lg"></i>&nbsp;
                                        <span>{{ __('Save') }}</span>
                                    </button>
                                </div>

                                <div class="align-self-center col-md-2">
                                    <button type="reset" name="reset" id="reset"
                                        class="btn btn-block btn-outline-info my-1">
                                        <i class="fa fa-refresh fa-lg"></i>&nbsp;
                                        <span>{{ __('Reset') }}</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form><!-- .card -->
                    @if (isset($locationId))
                        <hr>
                        @include('admin.boat-trips.navigations')
                    @else
                    <p>waka </p>
                    @endif
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
    <script></script>
@endsection
