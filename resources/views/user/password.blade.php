@extends('layouts.app')
@section('title', 'Change Password')

@section('content')
<section id="dashboard_main_arae" class="section_padding">
  <div class="container">
    <div class="row mt-5">
      @include('layouts.profile')

      <div class="col-lg-9">
        <div class="dashboard_common_table">
          <h3>Change Password</h3>
          <div class="profile_update_form">
            <form action="{{ url('password/change') }}" method="POST" id="profile_form_area">
              @csrf
              <div class="row">
                <div class="offset-md-3 col-lg-6">
                  <div class="form-group">
                    <label for="current_password">{{ __('Current Password') }}</label>
                    <input type="password" name="current_password" placeholder="{{ __('Current Password') }}" value="" id="current_password" class="form-control {{ $errors->has('current_password') ? 'is-invalid' : '' }}" autocomplete="off" autofocus />
                    @if ($errors->has('current_password'))
                    <label class="error">{{ $errors->first('current_password') }}</label>
                    @endif
                  </div>
                </div>
                <div class="offset-md-3 col-lg-6">
                  <div class="form-group">
                    <label for="password">{{ __('Password') }}</label>
                    <input type="password" name="password" placeholder="{{ __('Password') }}" value="" id="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" autocomplete="off" />
                    @if ($errors->has('password'))
                    <label class="error">{{ $errors->first('password') }}</label>
                    @endif
                  </div>
                </div>
                <div class="offset-md-3 col-lg-6">
                  <div class="form-group">
                    <label for="password_confirmation">{{ __('Confirm Password') }}</label>
                    <input type="password" name="password_confirmation" placeholder="{{ __('Confirm Password') }}" value="" id="password_confirmation" class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}" autocomplete="off" />
                    @if ($errors->has('password_confirmation'))
                    <label class="error">{{ $errors->first('password_confirmation') }}</label>
                    @endif
                  </div>
                </div>
                <div class="common_form_submit">
                  <button type="submit" name="submit" id="submit" class="btn btn-block btn-info my-1">
                    <i class="fa fa-floppy-o fa-lg"></i>&nbsp;
                    <span>{{ __('Save') }}</span>
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

@section('css')
<style type="text/css">
  /* page styles */
</style>
@endsection

@section('script')
<script type="text/javascript">
  $(document).ready(function() {
    // page scripts
  });
</script>
@endsection