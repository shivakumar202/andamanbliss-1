@extends('admin.layouts.app')

@section('title', __('Password'))

@section('content')
<!-- Heading -->
<div class="breadcrumbs">
  <div class="breadcrumbs-inner">
    <div class="row">
      <div class="col-sm-4">
        <div class="page-header float-left">
          <div class="page-title">
            <h1>{{ __('Password') }}</h1>
          </div>
        </div>
      </div>

      <div class="col-sm-6">
        <div class="page-header float-right">
          <div class="page-title">
            <ol class="breadcrumb text-right">
              <li><a href="{{ url('admin/home') }}">{{ __('Dashboard') }}</a></li>
              <li><a href="{{ url('admin/profile') }}">{{ __('Profile') }}</a></li>
              <li class="active">{{ __('Password') }}</li>
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
        <form name="form" action="{{ url('admin/password/change') }}" method="POST" id="form" class="card" enctype="multipart/form-data" novalidate="novalidate" autocomplete="off">
          @csrf
          <div class="card-header">
            <strong class="card-title">{{ __('Change') }}</strong>
          </div>

          <div class="card-body">
            <div class="row justify-content-center">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="current_password" class="control-label">
                    {{ __('Current Password') }}
                    <span style="color:red;">*</span>
                  </label>
                  <input type="password" name="current_password" placeholder="{{ __('Current Password') }}" value="" id="current_password" class="form-control {{ $errors->has('current_password') ? 'is-invalid' : '' }}" autocomplete="off" autofocus />
                  @if ($errors->has('current_password'))
                  <label class="error">{{ $errors->first('current_password') }}</label>
                  @endif
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="password" class="control-label">
                    {{ __('Password') }}
                    <span style="color:red;">*</span>
                  </label>
                  <input type="password" name="password" placeholder="{{ __('Password') }}" value="" id="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" autocomplete="off" />
                  @if ($errors->has('password'))
                  <label class="error">{{ $errors->first('password') }}</label>
                  @endif
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="password_confirmation" class="control-label">
                    {{ __('Confirm Password') }}
                    <span style="color:red;">*</span>
                  </label>
                  <input type="password" name="password_confirmation" placeholder="{{ __('Confirm Password') }}" value="" id="password_confirmation" class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}" autocomplete="off" />
                  @if ($errors->has('password_confirmation'))
                  <label class="error">{{ $errors->first('password_confirmation') }}</label>
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