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
              @if (@$car)
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
        @if (@$car)
        action="{{ url('admin/cars/' . @$car->id) }}"
        @else
        action="{{ url('admin/cars') }}"
        @endif
        method="POST" id="form" class="card" enctype="multipart/form-data" novalidate="novalidate" autocomplete="off">
          @csrf
          @if (@$car)
            @method('PUT')
          @endif
          <div class="card-header">
            <strong class="card-title">
            @if (@$car)
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
                  @if (@$car)
                  src="{{ @$car->photo->file }}"
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
                  <input type="text" name="name" placeholder="{{ __('Name') }}" value="{{ old('name', @$car->name) }}" id="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" autocomplete="off" autofocus />
                  @if ($errors->has('name'))
                  <label class="error">{{ $errors->first('name') }}</label>
                  @endif
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="reg_no" class="control-label">
                    {{ __('Reg. Number') }}
                    <span style="color:red;">*</span>
                  </label>
                  <input type="text" name="reg_no" placeholder="{{ __('Reg. Number') }}" value="{{ old('reg_no', @$car->reg_no) }}" id="reg_no" class="form-control {{ $errors->has('reg_no') ? 'is-invalid' : '' }}" autocomplete="off" />
                  @if ($errors->has('reg_no'))
                  <label class="error">{{ $errors->first('reg_no') }}</label>
                  @endif
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="reg_date" class="control-label">
                    {{ __('Reg. Date') }}
                    <span style="color:red;">*</span>
                  </label>
                  <input type="date" pattern="\d{4}-\d{2}-\d{2}" max="{{ date('Y-m-d') }}" name="reg_date" placeholder="{{ __('yyyy-mm-dd') }}" value="{{ old('reg_date', !empty(@$car->reg_date) ? date('Y-m-d', strtotime(@$car->reg_date)) : '') }}" id="reg_date" class="form-control {{ $errors->has('reg_date') ? 'is-invalid' : '' }}" autocomplete="off" />
                  @if ($errors->has('reg_date'))
                  <label class="error">{{ $errors->first('reg_date') }}</label>
                  @endif
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="fuel" class="control-label">
                    {{ __('Fuel Type') }}
                    <span style="color:red;">*</span>
                  </label>
                  <div class="clearfix">
                    <div class="btn-group btn-group-toggle d-flex" data-toggle="buttons">
                      <label class="btn btn-outline-info @if (old('fuel', @$car->fuel) == 'electric') active @endif">
                        <input type="radio" name="fuel" value="electric" id="electric" autocomplete="off" @checked(old('fuel', @$car->fuel) == 'electric') />
                        {{ __('Electric') }}
                      </label>
                      <label class="btn btn-outline-info @if (old('fuel', @$car->fuel) == 'petrol') active @endif">
                        <input type="radio" name="fuel" value="petrol" id="petrol" autocomplete="off" @checked(old('fuel', @$car->fuel) == 'petrol') />
                        {{ __('Petrol') }}
                      </label>
                      <label class="btn btn-outline-info @if (old('fuel', @$car->fuel) == 'diesel') active @endif">
                        <input type="radio" name="fuel" value="diesel" id="diesel" autocomplete="off" @checked(old('fuel', @$car->fuel) == 'diesel') />
                        {{ __('Diesel') }}
                      </label>
                    </div>
                  </div>
                  @if ($errors->has('fuel'))
                  <label class="error">{{ $errors->first('fuel') }}</label>
                  @endif
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="cc" class="control-label">
                    {{ __('Engine CC') }}
                    <span style="color:red;">*</span>
                  </label>
                  <input type="number" min="1" step="1" name="cc" placeholder="{{ __('Engine CC') }}" value="{{ old('cc', @$car->cc) }}" id="cc" class="form-control {{ $errors->has('cc') ? 'is-invalid' : '' }}" autocomplete="off" />
                  @if ($errors->has('cc'))
                  <label class="error">{{ $errors->first('cc') }}</label>
                  @endif
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="seat" class="control-label">
                    {{ __('Seat') }}
                    <span style="color:red;">*</span>
                  </label>
                  <input type="number" min="1" step="1" name="seat" placeholder="{{ __('Seat') }}" value="{{ old('seat', @$car->seat) }}" id="seat" class="form-control {{ $errors->has('seat') ? 'is-invalid' : '' }}" autocomplete="off" />
                  @if ($errors->has('seat'))
                  <label class="error">{{ $errors->first('seat') }}</label>
                  @endif
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="ac" class="control-label">
                    {{ __('AC Type') }}
                    <span style="color:red;"></span>
                  </label>
                  <div class="custom-control custom-switch">
                    <input type="checkbox" name="ac" value="yes" id="ac" class="custom-control-input {{ $errors->has('ac') ? 'is-invalid' : '' }}" @checked(old('ac', @$car->ac) == 'yes') />
                    <label class="custom-control-label" for="ac">{{ __('Air Condition') }}</label>
                  </div>
                  @if ($errors->has('ac'))
                  <label class="error">{{ $errors->first('ac') }}</label>
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