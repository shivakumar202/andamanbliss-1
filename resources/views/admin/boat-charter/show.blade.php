@extends('admin.layouts.app')

@section('title', __('Boat Charter & Game Fishing Package'))

@section('content')
<div class="breadcrumbs">
  <div class="breadcrumbs-inner">
    <div class="row">
      <div class="col-sm-4">
        <div class="page-header float-left">
          <div class="page-title">
            <h1>{{ __('Boat Charter & Game Fishing Package') }}</h1>
          </div>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="page-header float-right">
          <div class="page-title">
            <ol class="breadcrumb text-right">
              <li><a href="{{ url('admin/home') }}">{{ __('Dashboard') }}</a></li>
              <li><a href="{{ url('admin/boat-charter') }}">{{ __('Boat Charter & Game Fishing Packages') }}</a></li>
              <li class="active">{{ __('Details') }}</li>
            </ol>
          </div>
        </div>
      </div>
      <div class="col-sm-2">
        <a href="{{ url('admin/boat-charter') }}" class="btn btn-info float-right my-2 mx-3">
          <i class="fa fa-undo fa-lg"></i> 
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
            <strong class="card-title">
              {{ __('Details') }}
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
                  <span class="form-control">
                    {{ ucwords(@$package->name) }}
                  </span>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="package_type" class="control-label">
                    {{ __('Package Type') }}
                    <span style="color:red;">*</span>
                  </label>
                  <span class="form-control">
                    {{ ucwords(str_replace('_', ' ', @$package->package_type)) }}
                  </span>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="days" class="control-label">
                    {{ __('Days') }}
                    <span style="color:red;">*</span>
                  </label>
                  <span class="form-control">
                    {{ @$package->days }}
                  </span>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="duration" class="control-label">
                    {{ __('Duration') }}
                    <span style="color:red;">*</span>
                  </label>
                  <span class="form-control">
                    {{ @$package->duration }}
                  </span>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="pax" class="control-label">
                    {{ __('Max Pax') }}
                    <span style="color:red;">*</span>
                  </label>
                  <span class="form-control">
                    {{ @$package->pax }}
                  </span>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="boat_type" class="control-label">
                    {{ __('Boat Type') }}
                    <span style="color:red;">*</span>
                  </label>
                  <span class="form-control">
                    {{ ucwords(@$package->boat_type) }}
                  </span>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="places_covered" class="control-label">
                    {{ __('Places Covered') }}
                    <span style="color:red;">*</span>
                  </label>
                  <span class="form-control">
                    {{ @$package->places_covered }}
                  </span>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="base_price" class="control-label">
                    {{ __('Base Price (INR)') }}
                    <span style="color:red;">*</span>
                  </label>
                  <span class="form-control">
                    ₹{{ number_format(@$package->base_price, 2) }}
                  </span>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="discount" class="control-label">
                    {{ __('Discount (%)') }}
                  </label>
                  <span class="form-control">
                    {{ @$package->discount ? number_format(@$package->discount, 2) . '%' : 'N/A' }}
                  </span>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="permit_charges" class="control-label">
                    {{ __('Permit Charges') }}
                  </label>
                  <span class="form-control">
                    {{ @$package->permit_charges == 1 ? 'Applicable' : 'Non-Applicable' }}
                  </span>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="local_permit" class="control-label">
                    {{ __('Local Permit Charges (INR)') }}
                  </label>
                  <span class="form-control">
                    ₹{{ number_format(@$package->local_permit, 2) }}
                  </span>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="non_local_permit" class="control-label">
                    {{ __('Non-Local Permit Charges (INR)') }}
                  </label>
                  <span class="form-control">
                    ₹{{ number_format(@$package->non_local_permit, 2) }}
                  </span>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="featured" class="control-label">
                    {{ __('Featured') }}
                  </label>
                  <div class="custom-control custom-switch">

                    <input type="checkbox" name="featured" value="1" id="featured" class="custom-control-input"
                      @checked(@$package->featured == 1) disabled />
                    <label class="custom-control-label" for="featured">{{ __('Yes') }}</label>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="status" class="control-label">
                    {{ __('Status') }}
                    <span style="color:red;">*</span>
                  </label>
                  <span class="form-control">
                    {{ ucwords(@$package->status) }}
                  </span>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label for="description" class="control-label">
                    {{ __('Description') }}
                    <span style="color:red;">*</span>
                  </label>
                  <p class="">
                    {!! nl2br(@$package->description) !!}
                  </p>
                </div>
              </div>
            </div>
            <div class="row align-items-center justify-content-center">
              <div class="align-self-center col-md-2">
                <a href="{{ url('admin/boat-charter/' . @$package->id . '/boat-itineraries/create') }}"
                  class="btn btn-block btn-outline-info my-1">
                  <i class="fa fa-calendar-check-o fa-lg"></i> 
                  <span>{{ __('Day/Trip Ititnerary') }}</span>
                </a>
              </div>
              <div class="align-self-center col-md-2">
                <a href="{{ url('admin/boat-charter/' . @$package->id . '/fishes-found') }}"
                  class="btn btn-block btn-outline-info my-1">
                  <i class="fa fa-binoculars fa-lg"></i> 
                  <span>{{ __('Fishes Found') }}</span>
                </a>
              </div>
              <div class="align-self-center col-md-2">
                <a href="{{ url('admin/boat-charter/' . @$package->id . '/inclusion-exclusions') }}"
                  class="btn btn-block btn-outline-info my-1">
                  <i class="fa fa-list fa-lg"></i> 
                  <span>{{ __('Inclusions') }}</span>
                </a>
              </div>
              <div class="align-self-center col-md-2">
                <a href="{{ url('admin/boat-charter/' . @$package->id . '/images') }}"
                  class="btn btn-block btn-outline-info my-1">
                  <i class="fa fa-image fa-lg"></i> 
                  <span>{{ __('Images') }}</span>
                </a>
              </div>
              <div class="align-self-center col-md-2">
                <a href="{{ url('admin/boat-charter/' . @$package->id . '/seasonal-prices') }}"
                  class="btn btn-block btn-outline-info my-1">
                  <i class="fa fa-dollar-sign fa-lg"></i> 
                  <span>{{ __('Seasonal Prices') }}</span>
                </a>
              </div>
              <div class="align-self-center col-md-2">
                <a href="{{ url('admin/boat-charter/' . @$package->id . '/edit') }}"
                  class="btn btn-block btn-info my-1">
                  <i class="fa fa-pencil-square-o fa-lg"></i> 
                  <span>{{ __('Edit') }}</span>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('css')
@endsection

@section('script')
<script type="text/javascript">
  $(document).ready(function() {
    //
  });
</script>
@endsection