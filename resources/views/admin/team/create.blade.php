@extends('admin.layouts.app')

@section('title', __('Team'))

@section('content')
<!-- Heading -->
<div class="breadcrumbs">
  <div class="breadcrumbs-inner">
    <div class="row">
      <div class="col-sm-4">
        <div class="page-header float-left">
          <div class="page-title">
            <h1>{{ __('Team') }}</h1>
          </div>
        </div>
      </div>

      <div class="col-sm-6">
        <div class="page-header float-right">
          <div class="page-title">
            <ol class="breadcrumb text-right">
              <li><a href="{{ url('admin/home') }}">{{ __('Dashboard') }}</a></li>
              <li><a href="{{ url('admin/teams') }}">{{ __('Team') }}</a></li>
              @if (@$team)
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
        <form name="form" @if (@$team) action="{{ url('admin/teams/' . @$team->id) }}" @else
          action="{{ url('admin/teams') }}" @endif method="POST" id="form" class="card" enctype="multipart/form-data"
          novalidate="novalidate" autocomplete="off">
          @csrf
          @if (@$team)
          @method('PUT')
          @endif
          <div class="card-header">
            <strong class="card-title">
              @if (@$team)
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
                  <img onError="this.onerror=null;this.src='{{ asset('images/default.jpg') }}'" @if (@$team)
                    src="{{ @$team->photo->file }}" @else src="{{ asset('images/default.jpg') }}" @endif
                    class="img img-fluid w-100 m-auto d-block" alt="" />
                  <div class="custom-file">
                    <input type="file" accept="image/x-png,image/jpeg" onchange="readURL(this);" name="photo"
                      class="custom-file-input {{ $errors->has('photo') ? 'is-invalid' : '' }}"
                      id="customFileLangHTML" />
                    <label class="custom-file-label" for="customFileLangHTML" data-browse="{{ __('Browse') }}">{{
                      __('Choose file...') }}</label>
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
                  <input type="text" name="name" placeholder="{{ __('Name') }}" value="{{ old('name', @$team->name) }}"
                    id="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" autocomplete="off"
                    autofocus />
                  @if ($errors->has('name'))
                  <label class="error">{{ $errors->first('name') }}</label>
                  @endif
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="dob" class="control-label">
                    {{ __('DoB') }}
                    <span style="color:red;">*</span>
                  </label>
                  <input type="date" pattern="\d{4}-\d{2}-\d{2}" min="{{ date('Y-m-d', strtotime('-60 year')) }}"
                    max="{{ date('Y-m-d', strtotime('-18 year')) }}" name="dob" placeholder="{{ __('yyyy-mm-dd') }}"
                    value="{{ old('dob', !empty(@$team->dob) ? date('Y-m-d', strtotime(@$team->dob)) : '') }}" id="dob"
                    class="form-control {{ $errors->has('dob') ? 'is-invalid' : '' }}" autocomplete="off" />
                  @if ($errors->has('dob'))
                  <label class="error">{{ $errors->first('dob') }}</label>
                  @endif
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="contact" class="control-label">
                    {{ __('Contact') }}
                    <span style="color:red;">*</span>
                  </label>
                  <input type="tel" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" name="contact"
                    placeholder="{{ __('Contact') }}" value="{{ old('contact', @$team->contact) }}" id="contact"
                    class="form-control {{ $errors->has('contact') ? 'is-invalid' : '' }}" autocomplete="off" />
                  @if ($errors->has('contact'))
                  <label class="error">{{ $errors->first('contact') }}</label>
                  @endif
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label for="email" class="control-label">
                    {{ __('Email') }}
                    <span style="color:red;">*</span>
                  </label>
                  <input type="email" name="email" placeholder="{{ __('Email') }}"
                    value="{{ old('email', @$team->email) }}" id="email"
                    class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" autocomplete="off" />
                  @if ($errors->has('email'))
                  <label class="error">{{ $errors->first('email') }}</label>
                  @endif
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="description" class="control-label">
                    {{ __('Description') }}
                    <span style="color:red;">*</span>
                  </label>
                  <textarea name="description" placeholder="{{ __('Employee Description') }}" id="description"
                    class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}"
                    autocomplete="off">{{ old('description', @$team->description) }}</textarea>
                  @if ($errors->has('description'))
                  <label class="error">{{ $errors->first('description') }}</label>
                  @endif
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="department" class="control-label">
                    {{ __('Department') }}
                    <span style="color:red;">*</span>
                  </label>

                  <select name="department" id="department"
                    class="form-control {{ $errors->has('department') ? 'is-invalid' : '' }}" autocomplete="off">
                    <option value="">Select Department</option>
                    @php
                    $departments = [
                    'Management',
                    'Sales Team',
                    'Tour Coordinator',
                    'Support',
                    'Development Team',
                    'Account',
                    'Ground Staff',
                    ];
                    @endphp
                    @foreach ($departments as $dept)
                    <option value="{{ $dept }}" {{ old('department', @$team->department) === $dept ? 'selected' : '' }}>
                      {{ $dept }}
                    </option>
                    @endforeach
                  </select>

                  @if ($errors->has('department'))
                  <label class="error">{{ $errors->first('department') }}</label>
                  @endif
                </div>

              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="role" class="control-label">
                    {{ __('Role') }}
                    <span style="color:red;">*</span>
                  </label>
                  <input type="text" name="role" placeholder="{{ __('Role') }}" value="{{ old('role', @$team->role) }}"
                    id="role" class="form-control {{ $errors->has('role') ? 'is-invalid' : '' }}" autocomplete="off" />
                  @if ($errors->has('role'))
                  <label class="error">{{ $errors->first('role') }}</label>
                  @endif
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="joining" class="control-label">
                    {{ __('Joining') }}
                    <span style="color:red;">*</span>
                  </label>
                  <input type="date" name="joining" placeholder="{{ __('Joining') }}"
                    value="{{ old('joining', @$team->joining ? date('Y-m-d', strtotime(@$team->joining)) : '') }}"
                    max="{{ date('Y-m-d') }}" id="joining"
                    class="form-control {{ $errors->has('joining') ? 'is-invalid' : '' }}" autocomplete="off" />
                  @if ($errors->has('joining'))
                  <label class="error">{{ $errors->first('joining') }}</label>
                  @endif
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="isSupport" class="control-label">
                    {{ __('Support') }}
                    <span style="color:red;">*</span>
                  </label>
                  <div class="clearfix">
                    <div class="btn-group btn-group-toggle d-flex" data-toggle="buttons">
                      <label
                        class="btn btn-outline-info @if (old('isSupport', @$team->isSupport) == '1') active @endif">
                        <input type="radio" name="isSupport" value="1" id="1" autocomplete="off"
                          @checked(old('isSupport', @$team->isSupport) == '1') />
                        {{ __('Yes') }}
                      </label>
                      <label
                        class="btn btn-outline-info @if (old('isSupport', @$team->isSupport) == '0') active @endif">
                        <input type="radio" name="isSupport" value="0" id="0" autocomplete="off"
                          @checked(old('isSupport', @$team->isSupport) == '0') />
                        {{ __('No') }}
                      </label>
                    </div>
                  </div>
                  @if ($errors->has('isSupport'))
                  <label class="error">{{ $errors->first('isSupport') }}</label>
                  @endif
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="gender" class="control-label">
                    {{ __('Gender') }}
                    <span style="color:red;">*</span>
                  </label>
                  <div class="clearfix">
                    <div class="btn-group btn-group-toggle d-flex" data-toggle="buttons">
                      <label class="btn btn-outline-info @if (old('gender', @$team->gender) == 'male') active @endif">
                        <input type="radio" name="gender" value="male" id="male" autocomplete="off"
                          @checked(old('gender', @$team->gender) == 'male') />
                        {{ __('Male') }}
                      </label>
                      <label class="btn btn-outline-info @if (old('gender', @$team->gender) == 'female') active @endif">
                        <input type="radio" name="gender" value="female" id="female" autocomplete="off"
                          @checked(old('gender', @$team->gender) == 'female') />
                        {{ __('Female') }}
                      </label>
                      <label class="btn btn-outline-info @if (old('gender', @$team->gender) == '') active @endif">
                        <input type="radio" name="gender" value="" id="others" autocomplete="off" @checked(old('gender',
                          @$team->gender) == '') />
                        {{ __('Others') }}
                      </label>
                    </div>
                  </div>
                  @if ($errors->has('gender'))
                  <label class="error">{{ $errors->first('gender') }}</label>
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
<script type="text/javascript">
  $(document).ready(function() {
    //
  });
</script>
@endsection