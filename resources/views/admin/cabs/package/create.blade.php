@extends('admin.layouts.app')

@section('title', __('Cab'))

@section('content')
<!-- Heading -->
<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>{{ __('Cab') }}</h1>
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            @if (@$cabdet)
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
                <form name="form" @if (@$cabdet) action="{{ route('admin.cab-package.update', $cabdet->id) }}" @else
                    action="{{ route('admin.cab-package.store') }}" @endif method="POST" id="form" class="card"
                    enctype="multipart/form-data" novalidate="novalidate" autocomplete="off">
                    @csrf
                    @if (@$cabdet)
                    @method('PUT')
                    @endif

                    <div class="card-header">
                        <strong class="card-title">
                            @if (@$cabdet)
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
                                        {{ __('Name') }} <span style="color:red;">*</span>
                                    </label>
                                    <select name="name" id="name"
                                        class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" required>
                                        <option value="">Select Package Name</option>
                                        @foreach($packages as $package)
                                        <option value="{{ $package->id }}" {{ old('name', @$cabdet->name) ==
                                            $package->id ? 'selected' : '' }}>
                                            {{ $package->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('name'))
                                    <label class="error">{{ $errors->first('name') }}</label>
                                    @endif
                                </div>

                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="from_location" class="control-label">
                                        {{ __('From') }}
                                    </label>
                                    <input type="text" name="from_location" id="from_location"
                                        value="{{ old('discount', @$cabdet->from_location) }}"
                                        class="form-control {{ $errors->has('from_location') ? 'is-invalid' : '' }}">
                                    @if ($errors->has('from_location'))
                                    <label class="error">{{ $errors->first('from_location') }}</label>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="to_location" class="control-label">
                                        {{ __('To') }}
                                    </label>
                                    <input type="text" name="to_location" id="to_location"
                                        class="form-control {{ $errors->has('to_location') ? 'is-invalid' : '' }}"
                                        value="{{ old('discount', @$cabdet->to_location) }}">
                                    @if ($errors->has('to_location'))
                                    <label class="error">{{ $errors->first('to_location') }}</label>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="fare_pp" class="control-label">
                                        {{ __('Fare per Person') }}
                                        <span style="color:red;">*</span>
                                    </label>
                                    <input type="number" step="0.01" min="0" name="fare_pp"
                                        placeholder="{{ __('Fare per Person') }}"
                                        value="{{ old('fare_pp', @$cabdet->fare_pp) }}" id="fare_pp"
                                        class="form-control {{ $errors->has('fare_pp') ? 'is-invalid' : '' }}"
                                        required />
                                    @if ($errors->has('fare_pp'))
                                    <label class="error">{{ $errors->first('fare_pp') }}</label>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="location" class="control-label">
                                        {{ __('Location') }}
                                        <span style="color:red;">*</span>
                                    </label>
                                    @php
                                    $selectedLocations = old('location', isset($cabdet) ? explode(',',
                                    $cabdet->location) : []);
                                    @endphp

                                    <select name="location" id="location" required
                                        class="form-control {{ $errors->has('location') ? 'is-invalid' : '' }}">
                                        <option value="Port Blair" @selected(in_array('Port Blair',
                                            $selectedLocations))>Port Blair</option>
                                        <option value="Havelock Island" @selected(in_array('Havelock Island',
                                            $selectedLocations))>Havelock Island</option>
                                        <option value="Neil Island" @selected(in_array('Neil Island',
                                            $selectedLocations))>Neil Island</option>
                                        <option value="North & Middle Andaman" @selected(in_array('North & Middle
                                            Andaman', $selectedLocations))>North & Middle Andaman</option>
                                    </select>

                                    @if ($errors->has('location'))
                                    <label class="error">{{ $errors->first('location') }}</label>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="distance_limit" class="control-label">
                                        {{ __('Distance Limit') }}
                                    </label>
                                    <input type="number" step="0.01" min="0" name="distance_limit"
                                        placeholder="{{ __('Distance Limit') }}"
                                        value="{{ old('distance_limit', @$cabdet->distance_limit) }}"
                                        id="distance_limit"
                                        class="form-control {{ $errors->has('distance_limit') ? 'is-invalid' : '' }}" />
                                    @if ($errors->has('distance_limit'))
                                    <label class="error">{{ $errors->first('distance_limit') }}</label>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="extra_fare" class="control-label">
                                        {{ __('Extra Fare') }}
                                    </label>
                                    <input type="number" step="0.01" min="0" name="extra_fare"
                                        placeholder="{{ __('Extra Fare') }}"
                                        value="{{ old('extra_fare', @$cabdet->extra_fare) }}" id="extra_fare"
                                        class="form-control {{ $errors->has('extra_fare') ? 'is-invalid' : '' }}" />
                                    @if ($errors->has('extra_fare'))
                                    <label class="error">{{ $errors->first('extra_fare') }}</label>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="cab_ids" class="control-label">
                                        {{ __('Cabs') }}
                                        <span style="color:red;">*</span>
                                    </label>
                                    @php
                                    $selectedCabIds = old('cab_ids', isset($cabdet) ? json_decode($cabdet->cab_ids,
                                    true) : []);
                                    @endphp

                                    <select name="cab_ids[]" id="cab_ids" multiple required
                                        class="form-control {{ $errors->has('cab_ids') ? 'is-invalid' : '' }}">
                                        @foreach ($cabs as $cab)
                                        <option value="{{ $cab->id }}" @selected(in_array($cab->id, $selectedCabIds))>
                                            {{ ucwords($cab->name) }}
                                        </option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('cab_ids'))
                                    <label class="error">{{ $errors->first('cab_ids') }}</label>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="package_type" class="control-label">
                                        {{ __('Package Type') }}
                                        <span style="color:red;">*</span>
                                    </label>
                                    <select name="package_type" id="package_type" required
                                        class="form-control {{ $errors->has('package_type') ? 'is-invalid' : '' }}">
                                        <option value="">Select Package Type</option>
                                        <option value="Local" @selected(old('package_type', @$cabdet->package_type) ==
                                            'Local')>{{ ucwords('Local') }}</option>
                                        <option value="OutStanding" @selected(old('package_type', @$cabdet->
                                            package_type) == 'OutStanding')>{{ ucwords('OutStanding') }}</option>
                                    </select>
                                    @if ($errors->has('package_type'))
                                    <label class="error">{{ $errors->first('package_type') }}</label>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="price_type" class="control-label">
                                        {{ __('Price Type') }}
                                        <span style="color:red;">*</span>
                                    </label>
                                    <select name="price_type" id="price_type" required
                                        class="form-control {{ $errors->has('price_type') ? 'is-invalid' : '' }}">
                                        <option value="per_cab" @selected(old('price_type', @$cabdet->price_type) ==
                                            'per_cab')>{{ ucwords('per_cab') }}</option>
                                        <option value="per_person" @selected(old('per_person', @$cabdet->price_type) ==
                                            'per_person')>{{ ucwords('per_person') }}</option>
                                    </select>
                                    @if ($errors->has('price_type'))
                                    <label class="error">{{ $errors->first('price_type') }}</label>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="discount" class="control-label">
                                        {{ __('Discount') }}
                                    </label>
                                    <input type="number" step="0.01" min="0" name="discount"
                                        placeholder="{{ __('Discount') }}"
                                        value="{{ old('discount', @$cabdet->discount) }}" id="discount"
                                        class="form-control {{ $errors->has('discount') ? 'is-invalid' : '' }}" />
                                    @if ($errors->has('discount'))
                                    <label class="error">{{ $errors->first('discount') }}</label>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="status" class="control-label">
                                        {{ __('Status') }}
                                        <span style="color:red;">*</span>
                                    </label>
                                    <select name="status" id="status" required
                                        class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}">
                                        <option value="1" @selected(old('status', @$cab->status) == '1')>{{
                                            ucwords('active') }}</option>
                                        <option value="0" @selected(old('status', @$cab->status) == '0')>{{
                                            ucwords('inactive') }}</option>
                                    </select>
                                    @if ($errors->has('status'))
                                    <label class="error">{{ $errors->first('status') }}</label>
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
                                <button type="reset" name="reset" id="reset"
                                    class="btn btn-block btn-outline-info my-1">
                                    <i class="fa fa-refresh fa-lg"></i>&nbsp;
                                    <span>{{ __('Reset') }}</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </form><!-- .card -->
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
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#cab_ids').select2({
            placeholder: "Select Cabs",
            allowClear: true
        });
    
    });
</script>

@endsection