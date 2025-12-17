@extends('admin.layouts.app')

@section('title', __('Addon'))

@section('content')
<!-- Heading -->
<div class="breadcrumbs">
  <div class="breadcrumbs-inner">
    <div class="row">
      <div class="col-sm-4">
        <div class="page-header float-left">
          <div class="page-title">
            <h1>{{ __('Addon') }}</h1>
          </div>
        </div>
      </div>

      <div class="col-sm-6">
        <div class="page-header float-right">
          <div class="page-title">
            <ol class="breadcrumb text-right">
              <li><a href="{{ url('admin/home') }}">{{ __('Dashboard') }}</a></li>
              <li><a href="{{ url('admin/addons') }}">{{ __('Addon') }}</a></li>
              @if (@$addon)
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
        @if (@$addon)
        action="{{ url('admin/addons/' . @$addon->id) }}"
        @else
        action="{{ url('admin/addons') }}"
        @endif
        method="POST" id="form" class="card" enctype="multipart/form-data" novalidate="novalidate" autocomplete="off">
          @csrf
          @if (@$addon)
            @method('PUT')
          @endif
          <div class="card-header">
            <strong class="card-title">
            @if (@$addon)
              {{ __('Edit') }}
            @else
              {{ __('New') }}
            @endif
            </strong>
          </div>

          <div class="card-body">
            <div class="row justify-content-center">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="name" class="control-label">
                    {{ __('Name') }}
                    <span style="color:red;">*</span>
                  </label>
                  <input type="text" name="name" placeholder="{{ __('Name') }}" value="{{ old('name', @$addon->name) }}" id="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" autocomplete="off" autofocus />
                  @if ($errors->has('name'))
                  <label class="error">{{ $errors->first('name') }}</label>
                  @endif
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label for="type" class="control-label">
                    {{ __('Type') }}
                    <span style="color:red;">*</span>
                  </label>
                  <select name="type" id="type" class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}">
                    <option value="">{{ __('Select') }}</option>
                    @foreach ($types as $type)
                    <option value="{{ $type }}" @selected(old('type', @$addon->type) == $type)>{{ ucwords($type) }}</option>
                    @endforeach
                  </select>
                  @if ($errors->has('type'))
                  <label class="error">{{ $errors->first('type') }}</label>
                  @endif
                </div>
              </div>
<div class="col-md-12">
                <div class="form-group">
                  <label for="duration" class="control-label">
                    {{ __('Duration') }}
                    <span style="color:red;">*</span>
                  </label>
                  <select name="duration" id="duration" class="form-control {{ $errors->has('duration') ? 'is-invalid' : '' }}">
    <option value="nos" @selected(old('duration', @$addon->duration) == 'nos')>{{ __('Nos.') }}</option>
    <option value="day" @selected(old('duration', @$addon->duration) == 'day')>{{ __('Day') }}</option>
    <option value="hour" @selected(old('duration', @$addon->duration) == 'hour')>{{ __('Hour') }}</option>
</select>

                  @if ($errors->has('duration'))
                  <label class="error">{{ $errors->first('duration') }}</label>
                  @endif
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="rate" class="control-label">
                    {{ __('Rate') }}
                    <span style="color:red;">*</span>
                  </label>
                  <input type="number" step="0.01" min="0" max="999999.99" name="rate" placeholder="{{ __('Rate') }}" value="{{ old('rate', @$addon->rate) }}" id="rate" class="form-control {{ $errors->has('rate') ? 'is-invalid' : '' }}" required autocomplete="off" autofocus />
                  @if ($errors->has('rate'))
                  <label class="error">{{ $errors->first('rate') }}</label>
                  @endif
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="price" class="control-label">
                    {{ __('Price') }}
                    <span style="color:red;">*</span>
                  </label>
                  <input type="number" step="0.01" min="0" max="999999.99" name="price" placeholder="{{ __('Price') }}" value="{{ old('price', @$addon->price) }}" id="price" class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" required autocomplete="off" autofocus />
                  @if ($errors->has('price'))
                  <label class="error">{{ $errors->first('price') }}</label>
                  @endif
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="fees" class="control-label">
                    {{ __('Fees') }}
                    <span style="color:red;">*</span>
                  </label>
                  <input type="number" step="0.01" min="0" max="999999.99" name="fees" placeholder="{{ __('Fees') }}" value="{{ old('fees', @$addon->fees) }}" id="fees" class="form-control {{ $errors->has('fees') ? 'is-invalid' : '' }}" required autocomplete="off" autofocus />
                  @if ($errors->has('fees'))
                  <label class="error">{{ $errors->first('fees') }}</label>
                  @endif
                </div>
              </div>
            </div>

            <div class="row align-items-center justify-content-center">
              <div class="align-self-center col-md-2">
                <a href="{{ url('admin/addons/' . @$addon->id . '/images') }}" class="btn btn-block btn-outline-info my-1">
                  <i class="fa fa-pencil-square-o fa-lg"></i>&nbsp;
                  <span>{{ __('Images') }}</span>
                </a>
              </div>
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