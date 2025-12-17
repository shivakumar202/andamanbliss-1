@extends('admin.layouts.app')

@section('title', __('Bike'))

@section('content')
<!-- Heading -->
<div class="breadcrumbs">
  <div class="breadcrumbs-inner">
    <div class="row">
      <div class="col-sm-4">
        <div class="page-header float-left">
          <div class="page-title">
            <h1>{{ __('Bike') }}</h1>
          </div>
        </div>
      </div>

      <div class="col-sm-6">
        <div class="page-header float-right">
          <div class="page-title">
            <ol class="breadcrumb text-right">
              <li><a href="{{ url('admin/home') }}">{{ __('Dashboard') }}</a></li>
              <li><a href="{{ url('admin/bikes') }}">{{ __('Bike') }}</a></li>
              @if (@$bike)
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
        <form name="form" @if (@$bike) action="{{ url('admin/bikes/' . @$bike->id) }}" @else
          action="{{ url('admin/bikes') }}" @endif method="POST" id="form" class="card" enctype="multipart/form-data"
          novalidate="novalidate" autocomplete="off">
          @csrf
          @if (@$bike)
          @method('PUT')
          @endif
          <div class="card-header">
            <strong class="card-title">
              @if (@$bike)
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
                    {{ __('Name') }}
                    <span style="color:red;">*</span>
                  </label>
                  <input type="text" name="name" placeholder="{{ __('Name') }}" value="{{ old('name', @$bike->name) }}"
                    id="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" autocomplete="off"
                    required autofocus />
                  @if ($errors->has('name'))
                  <label class="error">{{ $errors->first('name') }}</label>
                  @endif
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="category_id" class="control-label">
                    {{ __('Category') }}
                    <span style="color:red;">*</span>
                  </label>
                  <select name="category_id" id="category_id" required
                    class="form-control {{ $errors->has('category_id') ? 'is-invalid' : '' }}">
                    <option value="">{{ __('Select') }}</option>
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected(old('category_id', @$bike->category_id) ==
                      $category->id)>{{ ucwords($category->name) }}</option>
                    @endforeach
                  </select>
                  @if ($errors->has('category_id'))
                  <label class="error">{{ $errors->first('category_id') }}</label>
                  @endif
                </div>
              </div>

              <div class="col-md-2">
                <div class="form-group">
                  <label for="featured" class="control-label">
                    {{ __('Featured') }}
                    <span style="color:red;"></span>
                  </label>
                  <div class="custom-control custom-switch">
                    <input type="checkbox" name="featured" value="1" id="featured" class="custom-control-input {{ $errors->has('featured') ? 'is-invalid' : '' }}" @checked(old('featured', @$bike->featured) == 1) />
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
                    <span style="color:red;"></span>
                  </label>
                  <div class="custom-control custom-switch">
                    <input type="checkbox" name="best_seller" value="1" id="best_seller" class="custom-control-input {{ $errors->has('best_seller') ? 'is-invalid' : '' }}" @checked(old('best_seller', @$bike->best_seller) == 1) />
                    <label class="custom-control-label" for="best_seller">{{ __('Yes') }}</label>
                  </div>
                  @if ($errors->has('best_seller'))
                  <label class="error">{{ $errors->first('best_seller') }}</label>
                  @endif
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label for="add_ons" class="control-label">
                    {{ __('Addons') }}
                    <span style="color:red;">*</span>
                  </label>
                  <select name="add_ons[]" id="mySelect2" class="form-control {{ $errors->has('add_ons') ? 'is-invalid' : '' }}" multiple>
                    @foreach ($addons as $addon)
                        <option value="{{ $addon->id }}" @if(in_array($addon->id, $selectedAddons)) selected @endif>
                            {{ $addon->name }}
                        </option>
                    @endforeach
                </select> 
                  @if ($errors->has('add_ons'))
                  <label class="error">{{ $errors->first('add_ons') }}</label>
                  @endif
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="adult_rate" class="control-label">
                    {{ __('Adult Rate') }}
                    <span style="color:red;">*</span>
                  </label>
                  <input type="number" step="0.01" min="0" max="999999.99" name="adult_rate" placeholder="{{ __('Adult Rate') }}" value="{{ old('adult_rate', @$bike->adult_rate) }}" id="adult_rate" class="form-control {{ $errors->has('adult_rate') ? 'is-invalid' : '' }}" required autocomplete="off" autofocus />
                  @if ($errors->has('adult_rate'))
                  <label class="error">{{ $errors->first('adult_rate') }}</label>
                  @endif
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="adult_price" class="control-label">
                    {{ __('Adult Price') }}
                    <span style="color:red;">*</span>
                  </label>
                  <input type="number" step="0.01" min="0" max="999999.99" name="adult_price" placeholder="{{ __('Adult Price') }}" value="{{ old('adult_price', @$bike->adult_price) }}" id="adult_price" class="form-control {{ $errors->has('adult_price') ? 'is-invalid' : '' }}" required autocomplete="off" autofocus />
                  @if ($errors->has('adult_price'))
                  <label class="error">{{ $errors->first('adult_price') }}</label>
                  @endif
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="adult_fees" class="control-label">
                    {{ __('Adult Fees') }}
                    <span style="color:red;">*</span>
                  </label>
                  <input type="number" step="0.01" min="0" max="999999.99" name="adult_fees" placeholder="{{ __('Adult Fees') }}" value="{{ old('adult_fees', @$bike->adult_fees) }}" id="adult_fees" class="form-control {{ $errors->has('adult_fees') ? 'is-invalid' : '' }}" required autocomplete="off" autofocus />
                  @if ($errors->has('adult_fees'))
                  <label class="error">{{ $errors->first('adult_fees') }}</label>
                  @endif
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="ratings" class="control-label">
                    {{ __('Ratings') }}
                    <span style="color:red;">*</span>
                  </label>
                  <input type="number" min="1" max="5" name="ratings" placeholder="{{ __('Ratings') }}" value="{{ old('ratings', @$bike->ratings) }}" id="ratings" class="form-control {{ $errors->has('ratings') ? 'is-invalid' : '' }}" autocomplete="off" autofocus />
                  @if ($errors->has('ratings'))
                  <label class="error">{{ $errors->first('ratings') }}</label>
                  @endif
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="reviews_count" class="control-label">
                    {{ __('Total Reviews') }}
                    <span style="color:red;">*</span>
                  </label>
                  <input type="number" min="1" name="reviews_count" placeholder="{{ __('Total Reviews') }}"
                    value="{{ old('reviews_count', @$bike->reviews_count) }}" id="reviews_count"
                    class="form-control {{ $errors->has('reviews_count') ? 'is-invalid' : '' }}" autocomplete="off" autofocus />
                  @if ($errors->has('reviews_count'))
                  <label class="error">{{ $errors->first('reviews_count') }}</label>
                  @endif
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="status" class="control-label">
                    {{ __('Status') }}
                    <span style="color:red;">*</span>
                  </label>
                  <select name="status" id="status" class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}">
                    <option value="">{{ __('Select') }}</option>
                    <option value="active" @selected(old('status', @$bike->status) == 'active')>{{ ucwords('active') }}</option>
                    <option value="inactive" @selected(old('status', @$bike->status) == 'inactive')>{{ ucwords('In active') }}</option>
                  </select>
                  @if ($errors->has('status'))
                  <label class="error">{{ $errors->first('status') }}</label>
                  @endif
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label for="address" class="control-label">
                    {{ __('Address') }}
                    <span style="color:red;">*</span>
                  </label>
                  <input type="text" name="address" placeholder="{{ __('Address') }}" value="{{ old('address', @$bike->address) }}" id="address" class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" required autocomplete="off" autofocus />
                  @if ($errors->has('address'))
                  <label class="error">{{ $errors->first('address') }}</label>
                  @endif
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label for="gmap" class="control-label">
                    {{ __('Google Map Short Link') }}
                    <span style="color:red;"></span>
                  </label>
                  <input type="text" name="gmap" placeholder="{{ __('Google Map Short Link') }}" value="{{ old('gmap', @$bike->gmap) }}" id="gmap" class="form-control {{ $errors->has('gmap') ? 'is-invalid' : '' }}" required autocomplete="off" autofocus />
                  @if ($errors->has('gmap'))
                  <label class="error">{{ $errors->first('gmap') }}</label>
                  @endif
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <label for="description" class="control-label">
                    {{ __('Description') }}
                    <span style="color:red;"></span>
                  </label>
                  <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description" placeholder="{{ __('Description') }}" cols="30" autocomplete="off" autofocus rows="5">{{ old('description', @$bike->description) }}</textarea>
                  @if ($errors->has('description'))
                  <label class="error">{{ $errors->first('description') }}</label>
                  @endif
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <label for="meta_title" class="control-label">
                    {{ __('Meta Title') }}
                    <span style="color:red;"></span>
                  </label>
                  <input type="text" name="meta_title" placeholder="{{ __('Meta Title') }}" value="{{ old('meta_title', @$bike->meta_title) }}" id="meta_title" class="form-control {{ $errors->has('meta_title') ? 'is-invalid' : '' }}" autocomplete="off" autofocus />
                  @if ($errors->has('meta_title'))
                  <label class="error">{{ $errors->first('meta_title') }}</label>
                  @endif
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <label for="meta_keywords" class="control-label">
                    {{ __('Meta Keywords') }}
                    <span style="color:red;"></span>
                  </label>
                  <textarea class="form-control {{ $errors->has('meta_keywords') ? 'is-invalid' : '' }}" name="meta_keywords" id="meta_keywords" placeholder="{{ __('Meta Keywords') }}" cols="30" autocomplete="off" autofocus rows="5">{{ old('meta_keywords', @$bike->meta_keywords) }}</textarea>
                  @if ($errors->has('meta_keywords'))
                  <label class="error">{{ $errors->first('meta_keywords') }}</label>
                  @endif
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <label for="meta_description" class="control-label">
                    {{ __('Meta Description') }}
                    <span style="color:red;"></span>
                  </label>
                  <textarea class="form-control {{ $errors->has('meta_description') ? 'is-invalid' : '' }}" name="meta_description" id="meta_description" placeholder="{{ __('Meta Description') }}" cols="30" autocomplete="off" autofocus rows="5">{{ old('meta_description', @$bike->meta_description) }}</textarea>
                  @if ($errors->has('meta_description'))
                  <label class="error">{{ $errors->first('meta_description') }}</label>
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
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<script type="text/javascript">
  $(document).ready(function() {
    $('#mySelect2').select2({
    placeholder: "Select Addons",
    allowClear: true
});

  });
</script>
@endsection