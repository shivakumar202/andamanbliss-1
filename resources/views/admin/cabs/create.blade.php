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
                            <li><a href="{{ url('admin/home') }}">{{ __('Dashboard') }}</a></li>
                            <li><a href="{{ url('admin/cabs') }}">{{ __('Cab') }}</a></li>
                            @if (@$cab)
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
                    @if (@$cab) action="{{ url('admin/cabs/' . @$cab->id) }}" @else
                    action="{{ url('admin/cabs') }}" @endif
                    method="POST" id="form" class="card" enctype="multipart/form-data" novalidate="novalidate"
                    autocomplete="off">
                    @csrf
                    @if (@$cab)
                    @method('PUT')
                    @endif
                    <div class="card-header">
                        <strong class="card-title">
                            @if (@$cab)
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
                                        value="{{ old('name', @$cab->name) }}" id="name"
                                        class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                        autocomplete="off" required autofocus />
                                    @if ($errors->has('name'))
                                    <label class="error">{{ $errors->first('name') }}</label>
                                    @endif
                                </div>
                            </div>


                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="category" class="control-label">
                                        {{ __('Category') }}
                                        <span style="color:red;">*</span>
                                    </label>
                                    <select name="category" class="form-control" id="category">
                                        <option value="">Select cab category</option>
                                        <option value="Hatchback" @selected(old('category', @$cab->category) == 'Hatchback')>Hatchback</option>
                                        <option value="Sedan" @selected(old('category', @$cab->category) == 'Sedan')>Sedan</option>
                                        <option value="SUV" @selected(old('category', @$cab->category) == 'SUV')>SUV</option>
                                        <option value="Muv" @selected(old('category', @$cab->category) == 'Muv')>MUV</option>
                                        <option value="Luxury" @selected(old('category', @$cab->category) == 'Luxury')>Luxury</option>
                                        <option value="Tempo Traveller" @selected(old('category', @$cab->category) == 'Tempo Traveller')>Tempo Traveller</option>
                                        <option value="Mini Bus" @selected(old('category', @$cab->category) == 'Mini Bus')>Mini Bus</option>
                                    </select>
                                    @if ($errors->has('category'))
                                    <label class="error">{{ $errors->first('category') }}</label>
                                    @endif
                                </div>
                            </div>



                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="featured" class="control-label">
                                        {{ __('Featured') }}
                                        <span style="color:red;"></span>
                                    </label>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" name="featured" value="1" id="featured"
                                            class="custom-control-input {{ $errors->has('featured') ? 'is-invalid' : '' }}"
                                            @checked(old('featured', @$cab->featured) == 1) />
                                        <label class="custom-control-label" for="featured">{{ __('Yes') }}</label>
                                    </div>
                                    @if ($errors->has('featured'))
                                    <label class="error">{{ $errors->first('featured') }}</label>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="best_seller" class="control-label">
                                        {{ __('Best Seller') }}
                                        <span style="color:red;"></span>
                                    </label>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" name="best_seller" value="1" id="best_seller"
                                            class="custom-control-input {{ $errors->has('best_seller') ? 'is-invalid' : '' }}"
                                            @checked(old('best_seller', @$cab->best_seller) == 1) />
                                        <label class="custom-control-label"
                                            for="best_seller">{{ __('Yes') }}</label>
                                    </div>
                                    @if ($errors->has('best_seller'))
                                    <label class="error">{{ $errors->first('best_seller') }}</label>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="sitting_capacity" class="control-label">
                                        {{ __('Sitting Capacity') }}
                                        <span style="color:red;">*</span>
                                    </label>
                                    <select name="sitting_capacity"
                                        placeholder="{{ __('Seater') }}"
                                        value="{{ old('sitting_capacity', @$cab->sitting_capacity) }}"
                                        id="sitting_capacity"
                                        class="form-control {{ $errors->has('sitting_capacity') ? 'is-invalid' : '' }}"
                                        required>
                                        <option value="" selected disabled>Select</option>
                                        <option value="4" @selected(old('sitting_capacity', @$cab->sitting_capacity) == '4')>4 seater</option>
                                        <option value="6" @selected(old('sitting_capacity', @$cab->sitting_capacity) == '6')>6 seater</option>
                                        <option value="8" @selected(old('sitting_capacity', @$cab->sitting_capacity) == '8')>8 seater</option>
                                        <option value="17" @selected(old('sitting_capacity', @$cab->sitting_capacity) == '17')>17 seater</option>
                                        <option value="26" @selected(old('sitting_capacity', @$cab->sitting_capacity) == '26')>26 seater</option>
                                    </select>
                                    @if ($errors->has('sitting_capacity'))
                                    <label class="error">{{ $errors->first('sitting_capacity') }}</label>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="luggage" class="control-label">
                                        {{ __('Luggage') }}
                                        <span style="color:red;">*</span>
                                    </label>
                                    <input type="text" name="luggage" placeholder="{{ __('Luggage') }}"
                                        value="{{ old('luggage', default: @$cab->luggage) }}" id="luggage"
                                        class="form-control {{ $errors->has('luggage') ? 'is-invalid' : '' }}">
                                    @if ($errors->has('luggage'))
                                    <label class="error">{{ $errors->first('luggage') }}</label>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="start_price" class="control-label">
                                        {{ __('Start Price') }}
                                        <span style="color:red;">*</span>
                                    </label>
                                    <input type="number" step="0.01" min="0" max="999999.99"
                                        name="start_price" placeholder="{{ __('Start Price') }}"
                                        value="{{ old('start_price', @$cab->start_price) }}" id="start_price"
                                        class="form-control {{ $errors->has('start_price') ? 'is-invalid' : '' }}"
                                        required autocomplete="off" autofocus />
                                    @if ($errors->has('start_price'))
                                    <label class="error">{{ $errors->first('start_price') }}</label>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="fuel_type" class="control-label">
                                        {{ __('Fuel Type') }}
                                        <span style="color:red;">*</span>
                                    </label>
                                    <select name="fuel_type" id="fuel_type"
                                        class="form-control {{ $errors->has('fuel_type') ? 'is-invalid' : '' }}">
                                        <option value="" selected disabled>{{ __('Select Fuel') }}</option>
                                        <option value="petrol" @selected(old('fuel_type', @$cab->fuel_type) == 'petrol')>Petrol</option>
                                        <option value="diesel" @selected(old('fuel_type', @$cab->fuel_type) == 'diesel')>Diesel</option>
                                        <option value="ev" @selected(old('fuel_type', @$cab->fuel_type) == 'ev')>electric</option>
                                        <option value="hybrid" @selected(old('fuel_type', @$cab->fuel_type) == 'hybrid')>Hybrid</option>
                                        <option value="cng" @selected(old('fuel_type', @$cab->fuel_type) == 'cng')>Cng</option>
                                    </select>
                                    @if ($errors->has('fuel_type'))
                                    <label class="error">{{ $errors->first('fuel_type') }}</label>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="address" class="control-label">
                                        {{ __('Available Locations') }}
                                        <span style="color:red;">*</span>
                                    </label>
                                    <select name="service_locations[]" id="service_locations" class="form-control" multiple>
                                        <option value="Port Blair"
                                            @selected(in_array('Port Blair', old('service_locations', @$cab->service_locations ?? [])))>
                                            Port Blair
                                        </option>
                                        <option value="Havelock Island"
                                            @selected(in_array('Havelock Island', old('service_locations', @$cab->service_locations ?? [])))>
                                            Havelock Island
                                        </option>
                                        <option value="Neil Island"
                                            @selected(in_array('Neil Island', old('service_locations', @$cab->service_locations ?? [])))>
                                            Neil Island
                                        </option>
                                    </select>

                                    @if ($errors->has('address'))
                                    <label class="error">{{ $errors->first('address') }}</label>
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
                                        <option value="1" @selected(old('status', @$cab->status) == '1')>{{ ucwords('active') }}
                                        </option>
                                        <option value="0" @selected(old('status', @$cab->status) == '0')>
                                            {{ ucwords('In active') }}
                                        </option>
                                    </select>
                                    @if ($errors->has('status'))
                                    <label class="error">{{ $errors->first('status') }}</label>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="description" class="control-label">
                                        {{ __('Description') }}
                                        <span style="color:red;"></span>
                                    </label>
                                    <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description"
                                        id="description" placeholder="{{ __('Description') }}" cols="30" autocomplete="off" autofocus
                                        rows="5">{{ old('description', @$cab->description) }}</textarea>
                                    @if ($errors->has('description'))
                                    <label class="error">{{ $errors->first('description') }}</label>
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
        $('#service_locations').select2({
            placeholder: "Select Cab Service Locations",
            allowClear: true
        })
    });
</script>
@endsection