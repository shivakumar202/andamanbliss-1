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
                  @if (@$admin)
                  src="{{ @$admin->photo->file }}"
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
                    {{ ucwords(@$admin->name) }}
                  </span>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="surname" class="control-label">
                    {{ __('Surname') }}
                    <span style="color:red;"></span>
                  </label>
                  <span class="form-control">
                    {{ ucwords(@$admin->surname) }}
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
                    {{ @$admin->mobile }}
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
                    {{ @$admin->email }}
                  </span>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="username" class="control-label">
                    {{ __('Username') }}
                    <span style="color:red;">*</span>
                  </label>
                  <span class="form-control">
                    {{ @$admin->username }}
                  </span>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="password" class="control-label">
                    {{ __('Password') }}
                    <span style="color:red;">*</span>
                  </label>
                  <span class="form-control">
                    ********
                  </span>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="dob" class="control-label">
                    {{ __('DoB') }}
                    <span style="color:red;">*</span>
                  </label>
                  <span class="form-control">
                    {{ !empty(@$admin->dob) ? date('Y-m-d', strtotime(@$admin->dob)) : '' }}
                  </span>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="sex" class="control-label">
                    {{ __('Sex') }}
                    <span style="color:red;">*</span>
                  </label>
                  <div class="clearfix">
                    <div class="btn-group btn-group-toggle d-flex">
                      <label class="btn btn-outline-info @if (@$admin->sex == 'male') active @endif">
                        {{ __('Male') }}
                      </label>
                      <label class="btn btn-outline-info @if (@$admin->sex == 'female') active @endif">
                        {{ __('Female') }}
                      </label>
                      <label class="btn btn-outline-info @if (@$admin->sex == '') active @endif">
                        {{ __('Others') }}
                      </label>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="role" class="control-label">
                    {{ __('Role') }}
                    <span style="color:red;">*</span>
                  </label>
                  <span class="form-control">
                    {{ ucwords(@$admin->roles->pluck('name')->implode(',')) }}
                  </span>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="otpfa" class="control-label">
                    {{ __('2 Factor Authentication') }}
                    <span style="color:red;"></span>
                  </label>
                  <div class="custom-control custom-switch">
                    <input type="checkbox" name="otpfa" value="on" id="otpfa" class="custom-control-input" @checked(@$admin->otpfa == 'on') disabled />
                    <label class="custom-control-label" for="otpfa">{{ __('Enable OTP Login') }}</label>
                  </div>
                </div>
              </div>
            </div>

            <div class="row align-items-center justify-content-center">
              <div class="align-self-center col-md-2">
                <a href="{{ url('admin/employees/' . @$admin->id . '/edit') }}" class="btn btn-block btn-info my-1">
                  <i class="fa fa-pencil-square-o fa-lg"></i>&nbsp;
                  <span>{{ __('Edit') }}</span>
                </a>
              </div>

              <div class="align-self-center col-md-2">
                <button onClick="if (confirm('Are you sure?')) return this.nextElementSibling.submit();" type="button" class="btn btn-block btn-outline-info my-1">
                  <i class="fa fa-refresh fa-lg"></i>&nbsp;
                  @if (@$admin->status == 'active')
                  <span>{{ __('Inactive') }}</span>
                  @else
                  <span>{{ __('Active') }}</span>
                  @endif
                </button>
                <form action="{{ url('admin/employees/changeStatus') }}" method="POST" class="d-none">
                  @csrf
                  <input type="hidden" name="id" value="{{ @$admin->id }}" />
                  <input type="hidden" name="status" value="{{ @$admin->status == 'active' ? 'inactive' : 'active' }}" />
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