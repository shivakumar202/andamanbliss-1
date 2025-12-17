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
          <div class="card">
            <div class="card-header">
              <strong class="card-title">
                {{ __('Image') }}
              </strong>
            </div>
  
            <div class="card-body">
              <form name="form"
              @if (@$drive)
              action="{{ url('admin/addons/' . request('addonId') . '/images/' . @$drive->id) }}"
              @else
              action="{{ url('admin/addons/' . request('addonId') . '/images') }}"
              @endif
              method="POST" id="form" class="" enctype="multipart/form-data" novalidate="novalidate" autocomplete="off">
                @csrf
  
                <div class="row align-items-center justify-content-center">
                  <div class="align-self-center col-md-4">
                    <div class="form-group">
                      <img onError="this.onerror=null;this.src='{{ asset('images/default.jpg') }}'"
                      @if (@$drive)
                      src="{{ @$drive->file }}"
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
  
                <div class="row align-items-center justify-content-center">
                  <div class="align-self-center col-md-2">
                    <button type="submit" name="submit" id="submit" class="btn btn-block btn-info my-1">
                      <i class="fa fa-floppy-o fa-lg"></i>&nbsp;
                      <span>{{ __('Save') }}</span>
                    </button>
                  </div>
  
                  <div class="align-self-center col-md-2">
                    <a href="{{ url('admin/addons/' . request('addonId') . '/images') }}" id="reset" class="btn btn-block btn-outline-info my-1">
                      <i class="fa fa-refresh fa-lg"></i>&nbsp;
                      <span>{{ __('Reset') }}</span>
                    </a>
                  </div>
                </div>
              </form>
  
           
            </div>
          </div><!-- .card -->
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