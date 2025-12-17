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
              <li class="active">{{ __('Details') }}</li>
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
                    {{ ucwords(@$lead->name) }}
                  </span>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="mobile" class="control-label">
                    {{ __('Mobile') }}
                    <span style="color:red;">*</span>
                  </label>
                  <span class="form-control">
                    {{ @$lead->mobile }}
                  </span>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="email" class="control-label">
                    {{ __('Email') }}
                    <span style="color:red;">*</span>
                  </label>
                  <span class="form-control">
                    {{ @$lead->email }}
                  </span>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="city" class="control-label">
                    {{ __('City') }}
                    <span style="color:red;">*</span>
                  </label>
                  <span class="form-control">
                    {{ @$lead->city }}
                  </span>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="adult" class="control-label">
                    {{ __('Adult') }}
                    <span style="color:red;">*</span>
                  </label>
                  <span class="form-control">
                    {{ @$lead->adult }}
                  </span>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="child" class="control-label">
                    {{ __('Child (> 5 Years)') }}
                    <span style="color:red;"></span>
                  </label>
                  <span class="form-control">
                    {{ @$lead->child }}
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
                    {{ ucwords(@$lead->package_type) }}
                  </span>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="hotel_type" class="control-label">
                    {{ __('Hotel Type') }}
                    <span style="color:red;">*</span>
                  </label>
                  <span class="form-control">
                    {{ ucwords(@$lead->hotel_type) }}
                  </span>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="flight_ticket" class="control-label">
                    {{ __('Flight Ticket') }}
                    <span style="color:red;">*</span>
                  </label>
                  <span class="form-control">
                    {{ @$lead->flight_ticket }}
                  </span>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="lead_source" class="control-label">
                    {{ __('Lead Source') }}
                    <span style="color:red;">*</span>
                  </label>
                  <span class="form-control">
                    {{ ucwords(@$lead->lead_source) }}
                  </span>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="travel_start" class="control-label">
                    {{ __('Travel Start') }}
                    <span style="color:red;">*</span>
                  </label>
                  <span class="form-control">
                    {{ !empty(@$lead->travel_start) ? date('Y-m-d', strtotime(@$lead->travel_start)) : '' }}
                  </span>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="travel_end" class="control-label">
                    {{ __('Travel End') }}
                    <span style="color:red;">*</span>
                  </label>
                  <span class="form-control">
                    {{ !empty(@$lead->travel_end) ? date('Y-m-d', strtotime(@$lead->travel_end)) : '' }}
                  </span>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="price_min" class="control-label">
                    {{ __('Min. Price') }}
                    <span style="color:red;"></span>
                  </label>
                  <span class="form-control">
                    {{ @$lead->price_min }}
                  </span>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="price_max" class="control-label">
                    {{ __('Max. Price') }}
                    <span style="color:red;"></span>
                  </label>
                  <span class="form-control">
                    {{ @$lead->price_max }}
                  </span>
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <label for="details" class="control-label">
                    {{ __('Details') }}
                    <span style="color:red;"></span>
                  </label>
                  <span class="form-control" style="height: auto;">
                    {!! nl2br(@$lead->details) !!}
                  </span>
                </div>
              </div>
            </div>

            <div class="row align-items-center justify-content-center">
              <div class="align-self-center col-md-2">
                <a href="{{ url('admin/leads/' . @$lead->id . '/edit') }}" class="btn btn-block btn-info my-1">
                  <i class="fa fa-pencil-square-o fa-lg"></i>&nbsp;
                  <span>{{ __('Edit') }}</span>
                </a>
              </div>

              <div class="align-self-center col-md-2">
                <button onClick="if (confirm('Are you sure?')) return this.nextElementSibling.submit();" type="button" class="btn btn-block btn-outline-info my-1">
                  <i class="fa fa-refresh fa-lg"></i>&nbsp;
                  @if (@$lead->status == 'active')
                  <span>{{ __('Inactive') }}</span>
                  @else
                  <span>{{ __('Active') }}</span>
                  @endif
                </button>
                <form action="{{ url('admin/leads/changeStatus') }}" method="POST" class="d-none">
                  @csrf
                  <input type="hidden" name="id" value="{{ @$lead->id }}" />
                  <input type="hidden" name="status" value="{{ @$lead->status == 'active' ? 'inactive' : 'active' }}" />
                </form>
              </div>
            </div>
          </div>
        </div><!-- .card -->
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