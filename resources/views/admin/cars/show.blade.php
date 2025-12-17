@extends('admin.layouts.app')

@section('title', __('Car'))

@section('content')
<!-- Heading -->
<div class="breadcrumbs">
  <div class="breadcrumbs-inner">
    <div class="row">
      <div class="col-sm-4">
        <div class="page-header float-left">
          <div class="page-title">
            <h1>{{ __('Car') }}</h1>
          </div>
        </div>
      </div>

      <div class="col-sm-6">
        <div class="page-header float-right">
          <div class="page-title">
            <ol class="breadcrumb text-right">
              <li><a href="{{ url('admin/home') }}">{{ __('Dashboard') }}</a></li>
              <li><a href="{{ url('admin/cars') }}">{{ __('Car') }}</a></li>
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
            <div class="row align-items-center justify-content-center">
              <div class="align-self-center col-md-4">
                <div class="form-group">
                  <img onError="this.onerror=null;this.src='{{ asset('images/default.jpg') }}'"
                  @if (@$car)
                  src="{{ @$car->photo->file }}"
                  @else
                  src="{{ asset('images/default.jpg') }}"
                  @endif
                  class="img img-fluid w-100 m-auto d-block" alt="" />
                </div>
              </div>
            </div>

            <div class="row justify-content-center">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="name" class="control-label">
                    {{ __('Name') }}
                    <span style="color:red;">*</span>
                  </label>
                  <span class="form-control">
                    {{ ucwords(@$car->name) }}
                  </span>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="reg_no" class="control-label">
                    {{ __('Reg. Number') }}
                    <span style="color:red;"></span>
                  </label>
                  <span class="form-control">
                    {{ strtoupper(@$car->reg_no) }}
                  </span>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="reg_date" class="control-label">
                    {{ __('Reg. Date') }}
                    <span style="color:red;">*</span>
                  </label>
                  <span class="form-control">
                    {{ !empty(@$car->reg_date) ? date('Y-m-d', strtotime(@$car->reg_date)) : '' }}
                  </span>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="fuel" class="control-label">
                    {{ __('Fuel Type') }}
                    <span style="color:red;">*</span>
                  </label>
                  <div class="clearfix">
                    <div class="btn-group btn-group-toggle d-flex">
                      <label class="btn btn-outline-info @if (@$car->fuel == 'electric') active @endif">
                        {{ __('Electric') }}
                      </label>
                      <label class="btn btn-outline-info @if (@$car->fuel == 'petrol') active @endif">
                        {{ __('Petrol') }}
                      </label>
                      <label class="btn btn-outline-info @if (@$car->fuel == 'diesel') active @endif">
                        {{ __('Diesel') }}
                      </label>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="cc" class="control-label">
                    {{ __('Engine CC') }}
                    <span style="color:red;">*</span>
                  </label>
                  <span class="form-control">
                    {{ @$car->cc }}
                  </span>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="seat" class="control-label">
                    {{ __('Seat') }}
                    <span style="color:red;">*</span>
                  </label>
                  <span class="form-control">
                    {{ @$car->seat }}
                  </span>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="ac" class="control-label">
                    {{ __('AC Type') }}
                    <span style="color:red;"></span>
                  </label>
                  <div class="custom-control custom-switch">
                    <input type="checkbox" name="ac" value="yes" id="ac" class="custom-control-input" @checked(@$car->ac == 'yes') disabled />
                    <label class="custom-control-label" for="ac">{{ __('Air Condition') }}</label>
                  </div>
                </div>
              </div>
            </div>

            <div class="row align-items-center justify-content-center">
              <div class="align-self-center col-md-2">
                <a href="{{ url('admin/cars/' . @$car->id . '/edit') }}" class="btn btn-block btn-info my-1">
                  <i class="fa fa-pencil-square-o fa-lg"></i>&nbsp;
                  <span>{{ __('Edit') }}</span>
                </a>
              </div>

              <div class="align-self-center col-md-2">
                <button onClick="if (confirm('Are you sure?')) return this.nextElementSibling.submit();" type="button" class="btn btn-block btn-outline-info my-1">
                  <i class="fa fa-refresh fa-lg"></i>&nbsp;
                  @if (@$car->status == 'active')
                  <span>{{ __('Inactive') }}</span>
                  @else
                  <span>{{ __('Active') }}</span>
                  @endif
                </button>
                <form action="{{ url('admin/cars/changeStatus') }}" method="POST" class="d-none">
                  @csrf
                  <input type="hidden" name="id" value="{{ @$car->id }}" />
                  <input type="hidden" name="status" value="{{ @$car->status == 'active' ? 'inactive' : 'active' }}" />
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