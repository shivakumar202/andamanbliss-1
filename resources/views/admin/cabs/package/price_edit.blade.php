@extends('admin.layouts.app')

@section('title', __('Edit Cab Pricing'))

@section('content')
<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row">
            <div class="col-sm-6">
                <h1>{{ __('Edit Cab Pricing') }}</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('admin.cab-package.pricing') }}" class="btn btn-info">
                    <i class="fa fa-arrow-left"></i> {{ __('Back') }}
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
                <form action="{{ route('admin.cab-package.pricing.update', ['id' => $pricing->id]) }}" method="POST" class="card">
                    @csrf
                    @method('PUT')

                    <div class="card-header">
                        <strong>{{ __('Edit Pricing') }}</strong>
                    </div>

                    <div class="card-body row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{ __('Name') }}</label>
                                <input type="text" name="name" value="{{ old('name', $pricing->name) }}" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{ __('Location') }}</label>
                                <input type="text" name="location" value="{{ old('location', $pricing->location) }}" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{ __('Base Price') }}</label>
                                <input type="number" name="base_price" value="{{ old('base_price', $pricing->base_price) }}" class="form-control" step="0.01" min="0" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{ __('Price Type') }}</label>
                                <select name="price_type" class="form-control" required>
                                    <option value="per_person" @selected($pricing->price_type == 'per_person')>Per Person</option>
                                    <option value="per_cab" @selected($pricing->price_type == 'per_cab')>Per Cab</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{ __('Seat Type') }}</label>
                                <input type="text" name="seat_type" value="{{ old('seat_type', $pricing->seat_type) }}" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{ __('Distance Covered (KM)') }}</label>
                                <input type="number" name="distance_covered" value="{{ old('distance_covered', $pricing->distance_covered) }}" class="form-control" step="0.01" min="0">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{ __('Extra Fare') }}</label>
                                <input type="number" name="extra_fare" value="{{ old('extra_fare', $pricing->extra_fare) }}" class="form-control" step="0.01" min="0">
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
                                <button type="reset" name="reset" id="reset" class="btn btn-block btn-outline-info my-1">
                                    <i class="fa fa-refresh fa-lg"></i>&nbsp;
                                    <span>{{ __('Reset') }}</span>
                                </button>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
