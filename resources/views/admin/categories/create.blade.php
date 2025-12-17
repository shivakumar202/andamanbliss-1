@extends('admin.layouts.app')

@section('title', __('Category'))

@section('content')
<!-- Heading -->
<div class="breadcrumbs">
  <div class="breadcrumbs-inner">
    <div class="row">
      <div class="col-sm-4">
        <div class="page-header float-left">
          <div class="page-title">
            <h1>{{ __('Category') }}</h1>
          </div>
        </div>
      </div>

      <div class="col-sm-6">
        <div class="page-header float-right">
          <div class="page-title">
            <ol class="breadcrumb text-right">
              <li><a href="{{ url('admin/home') }}">{{ __('Dashboard') }}</a></li>
              <li><a href="{{ url('admin/categories') }}">{{ __('Category') }}</a></li>
              @if (@$category)
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
        <form name="form" @if (@$category) action="{{ url('admin/categories/' . @$category->id) }}" @else
          action="{{ url('admin/categories') }}" @endif method="POST" id="form" class="card"
          enctype="multipart/form-data" novalidate="novalidate" autocomplete="off">
          @csrf
          @if (@$category)
          @method('PUT')
          @endif
          <div class="card-header">
            <strong class="card-title">
              @if (@$category)
              {{ __('Edit') }}
              @else
              {{ __('New') }}
              @endif
            </strong>
          </div>

          <div class="card-body">
            <div class="row justify-content-center">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="name" class="control-label">
                    {{ __('Name') }} <span style="color:red;">*</span>
                  </label>
                  <input type="text" name="name" placeholder="{{ __('Name') }}"
                    value="{{ old('name', @$category->name) }}" id="name"
                    class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" autocomplete="off" autofocus />
                  @if ($errors->has('name'))
                  <label class="error">{{ $errors->first('name') }}</label>
                  @endif
                </div>
              </div>

              <div class="col-md-2">
                <div class="form-group">
                  <label for="type" class="control-label">
                    {{ __('Type') }} <span style="color:red;">*</span>
                  </label>
                  <select name="type" id="type" class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}">
                    <option value="">{{ __('Select') }}</option>
                    @foreach ($types as $type)
                    <option value="{{ $type }}" @selected(old('type', @$category->type) == $type)>{{ ucwords($type) }}
                    </option>
                    @endforeach
                  </select>
                  @if ($errors->has('type'))
                  <label class="error">{{ $errors->first('type') }}</label>
                  @endif
                </div>
              </div>

              <div class="col-md-2">
                <div class="form-group">
                  <label for="rating" class="control-label">
                    {{ __('Rating') }} <span style="color:red;">*</span>
                  </label>
                  <select name="rating" id="rating"
                    class="form-control {{ $errors->has('rating') ? 'is-invalid' : '' }}">
                    <option value="">{{ __('Select') }}</option>
                    @foreach ($ratings as $rating)
                    <option value="{{ $rating['value'] }}" @selected(old('rating', @$category->rating) ==
                      $rating['value'])>
                      {{ ucwords($rating['name']) . ' - ' . $rating['value'] }} Star
                    </option>
                    @endforeach
                  </select>
                  @if ($errors->has('rating'))
                  <label class="error">{{ $errors->first('rating') }}</label>
                  @endif
                </div>
              </div>

              <div class="col-md-2">
                <div class="form-group">
                  <label for="featured" class="control-label">
                    {{ __('Featured') }}
                  </label>
                  <input type="hidden" name="featured" value="0">
                  <div class="custom-control custom-switch">
                    <input type="checkbox" name="featured" value="1" id="featured"
                      class="custom-control-input {{ $errors->has('featured') ? 'is-invalid' : '' }}"
                      @checked(old('featured', @$category->featured) == 1) />
                    <label class="custom-control-label" for="featured">{{ __('Yes') }}</label>
                  </div>
                  @if ($errors->has('featured'))
                  <label class="error">{{ $errors->first('featured') }}</label>
                  @endif
                </div>
              </div>

              <div class="col-md-2">
                <div class="form-group">
                  <label for="best_seller" class="control-label">
                    {{ __('Best Seller') }}
                  </label>
                  <input type="hidden" name="best_seller" value="0">
                  <div class="custom-control custom-switch">
                    <input type="checkbox" name="best_seller" value="1" id="best_seller"
                      class="custom-control-input {{ $errors->has('best_seller') ? 'is-invalid' : '' }}"
                      @checked(old('best_seller', @$category->best_seller) == 1) />
                    <label class="custom-control-label" for="best_seller">{{ __('Yes') }}</label>
                  </div>
                  @if ($errors->has('best_seller'))
                  <label class="error">{{ $errors->first('best_seller') }}</label>
                  @endif
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <label for="title" class="control-label">{{ __('Title') }}</label>
                  <input type="text" name="title" placeholder="{{ __('Title') }}"
                    value="{{ old('title', @$category->title) }}" id="title"
                    class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" autocomplete="off" />
                  @if ($errors->has('title'))
                  <label class="error">{{ $errors->first('title') }}</label>
                  @endif
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <label for="description" class="control-label">
                    {{ __('Description') }}
                  </label>
                  <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}"
                    name="description" id="description" placeholder="{{ __('Description') }}" cols="30" rows="5"
                    autocomplete="off">{{ old('description', @$category->description) }}</textarea>
                  @if ($errors->has('description'))
                  <label class="error">{{ $errors->first('description') }}</label>
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