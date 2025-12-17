@extends('admin.layouts.app')

@section('title', __('Employee'))

@section('content')
<!-- Heading -->
<div class="breadcrumbs">
  <div class="breadcrumbs-inner">
    <div class="row">
      <div class="col-sm-4">
        <div class="page-header float-left">
          <div class="page-title">
            <h1>{{ __('Employee') }}</h1>
          </div>
        </div>
      </div>

      <div class="col-sm-6">
        <div class="page-header float-right">
          <div class="page-title">
            <ol class="breadcrumb text-right">
              <li><a href="{{ url('admin/home') }}">{{ __('Dashboard') }}</a></li>
              <li><a href="{{ url('admin/employees') }}">{{ __('Employee') }}</a></li>
              @if (@$admin)
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
        @if (@$admin)
        action="{{ url('admin/employees/' . @$admin->id) }}"
        @else
        action="{{ url('admin/employees') }}"
        @endif
        method="POST" id="form" class="card" enctype="multipart/form-data" novalidate="novalidate" autocomplete="off">
          @csrf
          @if (@$admin)
            @method('PUT')
          @endif
          <div class="card-header">
            <strong class="card-title">
            @if (@$admin)
              {{ __('Edit') }}
            @else
              {{ __('New') }}
            @endif
            </strong>
          </div>

          <div class="card-body">
            <div class="row align-items-center justify-content-center">
              <div class="align-self-center col-md-4">
                <div class="form-group">
                  <img onError="this.onerror=null;this.src='{{ asset('images/default.jpg') }}'"
                  @if (@$admin)
                  src="{{ @$admin->photo->file }}"
                  @else
                  src="{{ asset('images/default.jpg') }}"
                  @endif
                  class="img img-fluid w-100 m-auto d-block" alt="" />
                  <div class="custom-file">
                    <input type="file" accept="image/x-png,image/jpeg" onchange="readURL(this);" name="photo" class="custom-file-input {{ $errors->has('photo') ? 'is-invalid' : '' }}" id="customFileLangHTML" />
                    <label class="custom-file-label" for="customFileLangHTML" data-browse="{{ __('Browse') }}">{{ __('Choose file...') }}</label>
                  </div>
                  @if ($errors->has('photo'))
                  <label class="error">{{ $errors->first('photo') }}</label>
                  @endif
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
                  <input type="text" name="name" placeholder="{{ __('Name') }}" value="{{ old('name', @$admin->name) }}" id="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" autocomplete="off" autofocus />
                  @if ($errors->has('name'))
                  <label class="error">{{ $errors->first('name') }}</label>
                  @endif
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="surname" class="control-label">
                    {{ __('Surname') }}
                    <span style="color:red;"></span>
                  </label>
                  <input type="text" name="surname" placeholder="{{ __('Surname') }}" value="{{ old('surname', @$admin->surname) }}" id="surname" class="form-control {{ $errors->has('surname') ? 'is-invalid' : '' }}" autocomplete="off" />
                  @if ($errors->has('surname'))
                  <label class="error">{{ $errors->first('surname') }}</label>
                  @endif
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="mobile" class="control-label">
                    {{ __('Mobile') }}
                    <span style="color:red;">*</span>
                  </label>
                  <input type="tel" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" name="mobile" placeholder="{{ __('Mobile') }}" value="{{ old('mobile', @$admin->mobile) }}" id="mobile" class="form-control {{ $errors->has('mobile') ? 'is-invalid' : '' }}" autocomplete="off" />
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
                  <input type="email" name="email" placeholder="{{ __('Email') }}" value="{{ old('email', @$admin->email) }}" id="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" autocomplete="off" />
                  @if ($errors->has('email'))
                  <label class="error">{{ $errors->first('email') }}</label>
                  @endif
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="username" class="control-label">
                    {{ __('Username') }}
                    <span style="color:red;">*</span>
                  </label>
                  <input type="text" name="username" placeholder="{{ __('Username') }}" value="{{ old('username', @$admin->username) }}" id="username" class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}" autocomplete="off" />
                  @if ($errors->has('username'))
                  <label class="error">{{ $errors->first('username') }}</label>
                  @endif
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="password" class="control-label">
                    {{ __('Password') }}
                    <span style="color:red;">*</span>
                  </label>
                  <input type="text" name="password" placeholder="{{ __('Password') }}" value="{{ old('password') }}" id="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" autocomplete="off" />
                  @if ($errors->has('password'))
                  <label class="error">{{ $errors->first('password') }}</label>
                  @endif
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="dob" class="control-label">
                    {{ __('DoB') }}
                    <span style="color:red;">*</span>
                  </label>
                  <input type="date" pattern="\d{4}-\d{2}-\d{2}" min="{{ date('Y-m-d', strtotime('-60 year')) }}" max="{{ date('Y-m-d', strtotime('-18 year')) }}" name="dob" placeholder="{{ __('yyyy-mm-dd') }}" value="{{ old('dob', !empty(@$admin->dob) ? date('Y-m-d', strtotime(@$admin->dob)) : '') }}" id="dob" class="form-control {{ $errors->has('dob') ? 'is-invalid' : '' }}" autocomplete="off" />
                  @if ($errors->has('dob'))
                  <label class="error">{{ $errors->first('dob') }}</label>
                  @endif
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="sex" class="control-label">
                    {{ __('Sex') }}
                    <span style="color:red;">*</span>
                  </label>
                  <div class="clearfix">
                    <div class="btn-group btn-group-toggle d-flex" data-toggle="buttons">
                      <label class="btn btn-outline-info @if (old('sex', @$admin->sex) == 'male') active @endif">
                        <input type="radio" name="sex" value="male" id="male" autocomplete="off" @checked(old('sex', @$admin->sex) == 'male') />
                        {{ __('Male') }}
                      </label>
                      <label class="btn btn-outline-info @if (old('sex', @$admin->sex) == 'female') active @endif">
                        <input type="radio" name="sex" value="female" id="female" autocomplete="off" @checked(old('sex', @$admin->sex) == 'female') />
                        {{ __('Female') }}
                      </label>
                      <label class="btn btn-outline-info @if (old('sex', @$admin->sex) == '') active @endif">
                        <input type="radio" name="sex" value="" id="others" autocomplete="off" @checked(old('sex', @$admin->sex) == '') />
                        {{ __('Others') }}
                      </label>
                    </div>
                  </div>
                  @if ($errors->has('sex'))
                  <label class="error">{{ $errors->first('sex') }}</label>
                  @endif
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="role" class="control-label">
                    {{ __('Role') }}
                    <span style="color:red;">*</span>
                  </label>
                  <select name="role" id="role" class="form-control {{ $errors->has('role') ? 'is-invalid' : '' }}">
                    <option value="">{{ __('Select') }}</option>
                    @foreach ($roles as $key => $role)
                    <option value="{{ $role->name }}" @selected(old('role', @$admin->roles[0]->name) == $role->name)>{{ ucwords($role->name) }}</option>
                    @endforeach
                  </select>
                  @if ($errors->has('role'))
                  <label class="error">{{ $errors->first('role') }}</label>
                  @endif
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="support" class="control-label">
                    {{ __('Support') }}
                  </label>
                  <select name="support" id="support" class="form-control {{ $errors->has('support') ? 'is-invalid' : '' }}">
                    <option value="" selected disabled>{{ __('Select') }}</option>
                    <option value="1">S-1</option>
                    <option value="2">S-2</option>
                    <option value="3">S-3</option>
                    <option value="4">S-4</option>
                    <option value="5">S-5</option>
                  </select>
                  @if ($errors->has('support'))
                  <label class="error">{{ $errors->first('support') }}</label>
                  @endif
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="otpfa" class="control-label">
                    {{ __('2 Factor Authentication') }}
                    <span style="color:red;"></span>
                  </label>
                  <div class="custom-control custom-switch">
                    <input type="checkbox" name="otpfa" value="on" id="otpfa" class="custom-control-input {{ $errors->has('otpfa') ? 'is-invalid' : '' }}" @checked(old('otpfa', @$admin->otpfa) == 'on') />
                    <label class="custom-control-label" for="otpfa">{{ __('Enable OTP Login') }}</label>
                  </div>
                  {{-- <div class="form-check">
                    <input type="checkbox" name="otpfa" value="on" id="otpfa" class="form-check-input {{ $errors->has('otpfa') ? 'is-invalid' : '' }}" @checked(old('otpfa', @$admin->otpfa) == 'on') />
                    <label class="form-check-label" for="otpfa">
                      {{ __('Enable OTP Login') }}
                    </label>
                  </div> --}}
                  @if ($errors->has('otpfa'))
                  <label class="error">{{ $errors->first('otpfa') }}</label>
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