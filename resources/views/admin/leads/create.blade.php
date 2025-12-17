@extends('admin.layouts.app')

@section('title', __('Lead'))

@section('content')
<!-- Heading -->
<div class="breadcrumbs">
  <div class="breadcrumbs-inner">
    <div class="row">
      <div class="col-sm-4">
        <div class="page-header float-left">
          <div class="page-title">
            <h1>{{ __('Lead') }}</h1>
          </div>
        </div>
      </div>

      <div class="col-sm-6">
        <div class="page-header float-right">
          <div class="page-title">
            <ol class="breadcrumb text-right">
              <li><a href="{{ url('admin/home') }}">{{ __('Dashboard') }}</a></li>
              <li><a href="{{ url('admin/leads') }}">{{ __('Lead') }}</a></li>
              @if (@$lead)
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
        @if (@$lead)
        action="{{ url('admin/leads/' . @$lead->id) }}"
        @else
        action="{{ url('admin/leads') }}"
        @endif
        method="POST" id="form" class="card" enctype="multipart/form-data" novalidate="novalidate" autocomplete="off">
          @csrf
          @if (@$lead)
            @method('PUT')
          @endif
          <div class="card-header">
            <strong class="card-title">
            @if (@$lead)
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
                  <input type="text" name="name" placeholder="{{ __('Name') }}" value="{{ old('name', @$lead->name) }}" id="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" autocomplete="off" autofocus />
                  @if ($errors->has('name'))
                  <label class="error">{{ $errors->first('name') }}</label>
                  @endif
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="mobile" class="control-label">
                    {{ __('Mobile') }}
                    <span style="color:red;">*</span>
                  </label>
                  <input type="tel" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" name="mobile" placeholder="{{ __('Mobile') }}" value="{{ old('mobile', @$lead->mobile) }}" id="mobile" class="form-control {{ $errors->has('mobile') ? 'is-invalid' : '' }}" autocomplete="off" />
                  @if ($errors->has('mobile'))
                  <label class="error">{{ $errors->first('mobile') }}</label>
                  @endif
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="email" class="control-label">
                    {{ __('Email') }}
                    <span style="color:red;">*</span>
                  </label>
                  <input type="email" name="email" placeholder="{{ __('Email') }}" value="{{ old('email', @$lead->email) }}" id="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" autocomplete="off" />
                  @if ($errors->has('email'))
                  <label class="error">{{ $errors->first('email') }}</label>
                  @endif
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="city" class="control-label">
                    {{ __('City') }}
                    <span style="color:red;"></span>
                  </label>
                  <input type="text" name="city" placeholder="{{ __('City') }}" value="{{ old('city', @$lead->city) }}" id="city" class="form-control {{ $errors->has('city') ? 'is-invalid' : '' }}" autocomplete="off" />
                  @if ($errors->has('city'))
                  <label class="error">{{ $errors->first('city') }}</label>
                  @endif
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="adult" class="control-label">
                    {{ __('Adult') }}
                    <span style="color:red;">*</span>
                  </label>
                  <input type="number" min="1" step="1" name="adult" placeholder="{{ __('Adult') }}" value="{{ old('adult', @$lead->adult ?? 1) }}" id="adult" class="form-control {{ $errors->has('adult') ? 'is-invalid' : '' }}" autocomplete="off" />
                  @if ($errors->has('adult'))
                  <label class="error">{{ $errors->first('adult') }}</label>
                  @endif
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="child" class="control-label">
                    {{ __('Child (> 5 Years)') }}
                    <span style="color:red;"></span>
                  </label>
                  <input type="number" min="0" step="1" name="child" placeholder="{{ __('Child (> 5 Years)') }}" value="{{ old('child', @$lead->child ?? 0) }}" id="child" class="form-control {{ $errors->has('child') ? 'is-invalid' : '' }}" autocomplete="off" />
                  @if ($errors->has('child'))
                  <label class="error">{{ $errors->first('child') }}</label>
                  @endif
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="package_type" class="control-label">
                    {{ __('Package Type') }}
                    <span style="color:red;">*</span>
                  </label>
                  <select name="package_type" id="package_type" class="form-control {{ $errors->has('package_type') ? 'is-invalid' : '' }}">
                    <option value="">{{ __('Select') }}</option>
                    @foreach ($packageTypes as $packageType)
                    <option value="{{ $packageType->slug }}" @selected(old('package_type', @$lead->package_type) == $packageType->slug)>{{ ucwords($packageType->name) }}</option>
                    @endforeach
                  </select>
                  @if ($errors->has('package_type'))
                  <label class="error">{{ $errors->first('package_type') }}</label>
                  @endif
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="hotel_type" class="control-label">
                    {{ __('Hotel Type') }}
                    <span style="color:red;">*</span>
                  </label>
                  <select name="hotel_type" id="hotel_type" class="form-control {{ $errors->has('hotel_type') ? 'is-invalid' : '' }}">
                    <option value="">{{ __('Select') }}</option>
                    @foreach ($hotelTypes as $hotelType)
                    <option value="{{ $hotelType->slug }}" @selected(old('hotel_type', @$lead->hotel_type) == $hotelType->slug)>{{ ucwords($hotelType->name) }}</option>
                    @endforeach
                  </select>
                  @if ($errors->has('hotel_type'))
                  <label class="error">{{ $errors->first('hotel_type') }}</label>
                  @endif
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="flight_ticket" class="control-label">
                    {{ __('Flight Ticket') }}
                    <span style="color:red;">*</span>
                  </label>
                  <select name="flight_ticket" id="flight_ticket" class="form-control {{ $errors->has('flight_ticket') ? 'is-invalid' : '' }}">
                    <option value="">{{ __('Select') }}</option>
                    @foreach ($flightTickets as $flightTicket)
                    <option value="{{ $flightTicket }}" @selected(old('flight_ticket', @$lead->flight_ticket) == $flightTicket)>{{ ucwords($flightTicket) }}</option>
                    @endforeach
                  </select>
                  @if ($errors->has('flight_ticket'))
                  <label class="error">{{ $errors->first('flight_ticket') }}</label>
                  @endif
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="lead_source" class="control-label">
                    {{ __('Lead Source') }}
                    <span style="color:red;">*</span>
                  </label>
                  <select name="lead_source" id="lead_source" class="form-control {{ $errors->has('lead_source') ? 'is-invalid' : '' }}">
                    <option value="">{{ __('Select') }}</option>
                    @foreach ($leadSources as $leadSource)
                    <option value="{{ $leadSource }}" @selected(old('lead_source', @$lead->lead_source) == $leadSource)>{{ ucwords($leadSource) }}</option>
                    @endforeach
                  </select>
                  @if ($errors->has('lead_source'))
                  <label class="error">{{ $errors->first('lead_source') }}</label>
                  @endif
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="travel_start" class="control-label">
                    {{ __('Travel Start') }}
                    <span style="color:red;">*</span>
                  </label>
                  <input type="date" pattern="\d{4}-\d{2}-\d{2}" min="{{ date('Y-m-d') }}" name="travel_start" placeholder="{{ __('yyyy-mm-dd') }}" value="{{ old('travel_start', !empty(@$lead->travel_start) ? date('Y-m-d', strtotime(@$lead->travel_start)) : '') }}" id="travel_start" class="form-control {{ $errors->has('travel_start') ? 'is-invalid' : '' }}" autocomplete="off" />
                  @if ($errors->has('travel_start'))
                  <label class="error">{{ $errors->first('travel_start') }}</label>
                  @endif
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="travel_end" class="control-label">
                    {{ __('Travel End') }}
                    <span style="color:red;">*</span>
                  </label>
                  <input type="date" pattern="\d{4}-\d{2}-\d{2}" min="{{ date('Y-m-d') }}" name="travel_end" placeholder="{{ __('yyyy-mm-dd') }}" value="{{ old('travel_end', !empty(@$lead->travel_end) ? date('Y-m-d', strtotime(@$lead->travel_end)) : '') }}" id="travel_end" class="form-control {{ $errors->has('travel_end') ? 'is-invalid' : '' }}" autocomplete="off" />
                  @if ($errors->has('travel_end'))
                  <label class="error">{{ $errors->first('travel_end') }}</label>
                  @endif
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="price_min" class="control-label">
                    {{ __('Min. Price') }}
                    <span style="color:red;"></span>
                  </label>
                  <input type="number" step="0.01" min="0" max="999999.99" name="price_min" placeholder="{{ __('Min. Price') }}" value="{{ old('price_min', @$lead->price_min) }}" id="price_min" class="form-control {{ $errors->has('price_min') ? 'is-invalid' : '' }}" required autocomplete="off" autofocus />
                  @if ($errors->has('price_min'))
                  <label class="error">{{ $errors->first('price_min') }}</label>
                  @endif
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="price_max" class="control-label">
                    {{ __('Max. Price') }}
                    <span style="color:red;"></span>
                  </label>
                  <input type="number" step="0.01" min="0" max="999999.99" name="price_max" placeholder="{{ __('Max. Price') }}" value="{{ old('price_max', @$lead->price_max) }}" id="price_max" class="form-control {{ $errors->has('price_max') ? 'is-invalid' : '' }}" required autocomplete="off" autofocus />
                  @if ($errors->has('price_max'))
                  <label class="error">{{ $errors->first('price_max') }}</label>
                  @endif
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <label for="details" class="control-label">
                    {{ __('Details') }}
                    <span style="color:red;"></span>
                  </label>
                  <textarea name="details" placeholder="{{ __('Details') }}" id="details" class="form-control {{ $errors->has('details') ? 'is-invalid' : '' }}" autocomplete="off">{!! old('details', strip_tags(@$lead->details)) !!}</textarea>
                  @if ($errors->has('details'))
                  <label class="error">{{ $errors->first('details') }}</label>
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
                <button type="reset" name="reset" id="reset" class="btn btn-block btn-outline-info my-1">
                  <i class="fa fa-refresh fa-lg"></i>&nbsp;
                  <span>{{ __('Reset') }}</span>
                </button>
              </div>
            </div>
          </div>
        </form><!-- .card -->
      </div><!--/.col-->
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
    //
  });
</script>
@endsection