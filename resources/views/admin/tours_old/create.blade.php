@extends('admin.layouts.app')

@section('title', __('Tour'))

@section('content')
<!-- Heading -->
<div class="breadcrumbs">
  <div class="breadcrumbs-inner">
    <div class="row">
      <div class="col-sm-4">
        <div class="page-header float-left">
          <div class="page-title">
            <h1>{{ __('Tour') }}</h1>
          </div>
        </div>
      </div>

      <div class="col-sm-6">
        <div class="page-header float-right">
          <div class="page-title">
            <ol class="breadcrumb text-right">
              <li><a href="{{ url('admin/home') }}">{{ __('Dashboard') }}</a></li>
              <li><a href="{{ url('admin/tours') }}">{{ __('Tour') }}</a></li>
              @if (@$tour)
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
        <form name="form" @if (@$tour) action="{{ url('admin/tours/' . @$tour->id) }}" @else
          action="{{ url('admin/tours') }}" @endif method="POST" id="form" class="card" enctype="multipart/form-data"
          novalidate="novalidate" autocomplete="off">
          @csrf
          @if (@$tour)
          @method('PUT')
          @endif
          <div class="card-header">
            <strong class="card-title">
              @if (@$tour)
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
                  <input type="text" name="name" placeholder="{{ __('Name') }}" value="{{ old('name', @$tour->name) }}"
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
                    <option value="{{ $category->id }}" @selected(old('category_id', @$tour->category_id) ==
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
                    <input type="checkbox" name="featured" value="1" id="featured"
                      class="custom-control-input {{ $errors->has('featured') ? 'is-invalid' : '' }}"
                      @checked(old('featured', @$tour->featured) == 1) />
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
                    <input type="checkbox" name="best_seller" value="1" id="best_seller"
                      class="custom-control-input {{ $errors->has('best_seller') ? 'is-invalid' : '' }}"
                      @checked(old('best_seller', @$tour->best_seller) == 1) />
                    <label class="custom-control-label" for="best_seller">{{ __('Yes') }}</label>
                  </div>
                  @if ($errors->has('best_seller'))
                  <label class="error">{{ $errors->first('best_seller') }}</label>
                  @endif
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <label for="title" class="control-label">{{ __('Heading Title')}}</label>
                  <input type="text" name="title" placeholder="{{ __('Title') }}"
                    value="{{ old('title', @$tour->title) }}" id="title"
                    class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" autocomplete="off" autofocus />
                  @if ($errors->has('title'))
                  <label class="error">{{ $errors->first('title') }}</label>
                  @endif
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="adult_rate" class="control-label">
                    {{ __('Base Price') }}
                    <span style="color:red;">*</span>
                  </label>
                  <input type="number" step="0.01" min="0" max="999999.99" name="adult_rate"
                    placeholder="{{ __('Base Price') }}" value="{{ old('adult_rate', @$tour->adult_rate) }}"
                    id="adult_rate" class="form-control {{ $errors->has('adult_rate') ? 'is-invalid' : '' }}" required
                    autocomplete="off" autofocus />
                  @if ($errors->has('adult_rate'))
                  <label class="error">{{ $errors->first('adult_rate') }}</label>
                  @endif
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="adult_price" class="control-label">
                    {{ __('Selling Price') }}
                    <span style="color:red;">*</span>
                  </label>
                  <input type="number" step="0.01" min="0" max="999999.99" name="adult_price"
                    placeholder="{{ __('Selling Price') }}" value="{{ old('adult_price', @$tour->adult_price) }}"
                    id="adult_price" class="form-control {{ $errors->has('adult_price') ? 'is-invalid' : '' }}" required
                    autocomplete="off" autofocus />
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
                  <input type="number" step="0.01" min="0" max="999999.99" name="adult_fees"
                    placeholder="{{ __('Adult Fees') }}" value="{{ old('adult_fees', @$tour->adult_fees) }}"
                    id="adult_fees" class="form-control {{ $errors->has('adult_fees') ? 'is-invalid' : '' }}" required
                    autocomplete="off" autofocus />
                  @if ($errors->has('adult_fees'))
                  <label class="error">{{ $errors->first('adult_fees') }}</label>
                  @endif
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="child_rate" class="control-label">
                    {{ __('Child Rate') }}
                    <span style="color:red;">*</span>
                  </label>
                  <input type="number" step="0.01" min="0" max="999999.99" name="child_rate"
                    placeholder="{{ __('Child Rate') }}" value="{{ old('child_rate', @$tour->child_rate) }}"
                    id="child_rate" class="form-control {{ $errors->has('child_rate') ? 'is-invalid' : '' }}" required
                    autocomplete="off" autofocus />
                  @if ($errors->has('child_rate'))
                  <label class="error">{{ $errors->first('child_rate') }}</label>
                  @endif
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="child_price" class="control-label">
                    {{ __('Child Price') }}
                    <span style="color:red;">*</span>
                  </label>
                  <input type="number" step="0.01" min="0" max="999999.99" name="child_price"
                    placeholder="{{ __('Child Price') }}" value="{{ old('child_price', @$tour->child_price) }}"
                    id="child_price" class="form-control {{ $errors->has('child_price') ? 'is-invalid' : '' }}" required
                    autocomplete="off" autofocus />
                  @if ($errors->has('child_price'))
                  <label class="error">{{ $errors->first('child_price') }}</label>
                  @endif
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="child_fees" class="control-label">
                    {{ __('Child Fees') }}
                    <span style="color:red;">*</span>
                  </label>
                  <input type="number" step="0.01" min="0" max="999999.99" name="child_fees"
                    placeholder="{{ __('Child Fees') }}" value="{{ old('child_fees', @$tour->child_fees) }}"
                    id="child_fees" class="form-control {{ $errors->has('child_fees') ? 'is-invalid' : '' }}" required
                    autocomplete="off" autofocus />
                  @if ($errors->has('child_fees'))
                  <label class="error">{{ $errors->first('child_fees') }}</label>
                  @endif
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="add_ons" class="control-label">
                    {{ __('Addons') }}
                    <span style="color:red;">*</span>
                  </label>
                  <select name="add_ons[]" id="mySelect2"
                    class="form-control {{ $errors->has('add_ons') ? 'is-invalid' : '' }}" multiple>
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
              <div class="col-md-6">
                <div class="form-group">
                  <label for="ratings" class="control-label">
                    {{ __('Ratings') }}
                    <span style="color:red;">*</span>
                  </label>
                  <input type="number" min="1" max="5" name="ratings" placeholder="{{ __('Ratings') }}"
                    value="{{ old('ratings', @$tour->ratings) }}" id="ratings"
                    class="form-control {{ $errors->has('ratings') ? 'is-invalid' : '' }}" autocomplete="off"
                    autofocus />
                  @if ($errors->has('ratings'))
                  <label class="error">{{ $errors->first('ratings') }}</label>
                  @endif
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label for="reviews_count" class="control-label">
                    {{ __('Total Reviews') }}
                    <span style="color:red;">*</span>
                  </label>
                  <input type="number" min="1" name="reviews_count" placeholder="{{ __('Total Reviews') }}"
                    value="{{ old('reviews_count', @$tour->reviews_count) }}" id="reviews_count"
                    class="form-control {{ $errors->has('reviews_count') ? 'is-invalid' : '' }}" autocomplete="off"
                    autofocus />
                  @if ($errors->has('reviews_count'))
                  <label class="error">{{ $errors->first('reviews_count') }}</label>
                  @endif
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label for="status" class="control-label">
                    {{ __('Status') }}
                    <span style="color:red;">*</span>
                  </label>
                  <select name="status" id="status"
                    class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}">
                    <option value="">{{ __('Select') }}</option>
                    <option value="active" @selected(old('status', @$tour->status) == 'active')>{{ ucwords('active') }}
                    </option>
                    <option value="inactive" @selected(old('status', @$tour->status) == 'inactive')>{{ ucwords('In
                      active') }}</option>
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
                  <input type="text" name="address" placeholder="{{ __('Address') }}"
                    value="{{ old('address', @$tour->address) }}" id="address"
                    class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" required autocomplete="off"
                    autofocus />
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
                  <input type="text" name="gmap" placeholder="{{ __('Google Map Short Link') }}"
                    value="{{ old('gmap', @$tour->gmap) }}" id="gmap"
                    class="form-control {{ $errors->has('gmap') ? 'is-invalid' : '' }}" required autocomplete="off"
                    autofocus />
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
                  <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}"
                    name="description" id="description" placeholder="{{ __('Description') }}" cols="30"
                    autocomplete="off" autofocus rows="5">{{ old('description', @$tour->description) }}</textarea>
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
                  <input type="text" name="meta_title" placeholder="{{ __('Meta Title') }}"
                    value="{{ old('meta_title', @$tour->meta_title) }}" id="meta_title"
                    class="form-control {{ $errors->has('meta_title') ? 'is-invalid' : '' }}" autocomplete="off"
                    autofocus />
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
                  <textarea class="form-control {{ $errors->has('meta_keywords') ? 'is-invalid' : '' }}"
                    name="meta_keywords" id="meta_keywords" placeholder="{{ __('Meta Keywords') }}" cols="30"
                    autocomplete="off" autofocus rows="5">{{ old('meta_keywords', @$tour->meta_keywords) }}</textarea>
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
                  <textarea class="form-control {{ $errors->has('meta_description') ? 'is-invalid' : '' }}"
                    name="meta_description" id="meta_description" placeholder="{{ __('Meta Description') }}" cols="30"
                    autocomplete="off" autofocus
                    rows="5">{{ old('meta_description', @$tour->meta_description) }}</textarea>
                  @if ($errors->has('meta_description'))
                  <label class="error">{{ $errors->first('meta_description') }}</label>
                  @endif
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <label for="meta_schema" class="control-label">
                    {{ __('Meta Schema') }}
                    <span style="color:red;"></span>
                  </label>
                  <textarea class="form-control {{ $errors->has('meta_schema') ? 'is-invalid' : '' }}"
                    name="meta_schema" id="meta_schema" placeholder="{{ __('Meta Schema') }}" cols="30"
                    autocomplete="off" autofocus rows="5">{{ old('meta_schema', @$tour->meta_schema) }}</textarea>
                  @if ($errors->has('meta_schema'))
                  <label class="error">{{ $errors->first('meta_schema') }}</label>
                  @endif
                </div>
              </div>
              <div class="col-12">
                <h6>Open Graph Titles</h6>
                <hr>

              </div>
               <div class="col-md-12">
                <div class="form-group">
                  <label for="og_title" class="control-label">
                    {{ __('Facebook Title') }}
                    <span style="color:red;"></span>
                  </label>
                  <input type="text" name="og_title" placeholder="{{ __('Facebook Title') }}"
                    value="{{ old('og_title', @$tour->og_title) }}" id="og_title"
                    class="form-control {{ $errors->has('og_title') ? 'is-invalid' : '' }}" autocomplete="off"
                    autofocus />
                  @if ($errors->has('og_title'))
                  <label class="error">{{ $errors->first('og_title') }}</label>
                  @endif
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <label for="og_description" class="control-label">
                    {{ __('Facebook Description') }}
                    <span style="color:red;"></span>
                  </label>
                  <textarea class="form-control {{ $errors->has('og_description') ? 'is-invalid' : '' }}"
                    name="og_description" id="og_description" placeholder="{{ __('Facebook Description') }}" 
                    autocomplete="off" autofocus
                    rows="2">{{ old('og_description', @$tour->og_description) }}</textarea>
                  @if ($errors->has('og_description'))
                  <label class="error">{{ $errors->first('og_description') }}</label>
                  @endif
                </div>
              </div>

               <div class="col-md-12">
                <div class="form-group">
                  <label for="og_type" class="control-label">
                    {{ __('Facebook Type') }}
                    <span style="color:red;"></span>
                  </label>
                  <input type="text" name="og_type" placeholder="{{ __('Facebook Type') }}"
                    value="{{ old('og_type', @$tour->og_type) }}" id="og_type"
                    class="form-control {{ $errors->has('og_type') ? 'is-invalid' : '' }}" autocomplete="off"
                    autofocus />
                  @if ($errors->has('og_type'))
                  <label class="error">{{ $errors->first('og_type') }}</label>
                  @endif
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <label for="og_image" class="control-label">
                    {{ __('Facebook Image') }}
                    <span style="color:red;"></span>
                  </label>
                  <input type="text" name="og_image" placeholder="{{ __('Facebook Open Graph image URL') }}"
                    value="{{ old('og_image', @$tour->og_image) }}" id="og_image"
                    class="form-control {{ $errors->has('og_image') ? 'is-invalid' : '' }}" autocomplete="off"
                    autofocus />
                  @if ($errors->has('og_image'))
                  <label class="error">{{ $errors->first('og_image') }}</label>
                  @endif
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <label for="twitter_card" class="control-label">
                    {{ __('Twitter Card') }}
                    <span style="color:red;"></span>
                  </label>
                  <input type="text" name="twitter_card" placeholder="{{ __('Meta Open Graph image URL') }}"
                    value="{{ old('twitter_card', @$tour->twitter_card) }}" id="twitter_card"
                    class="form-control {{ $errors->has('twitter_card') ? 'is-invalid' : '' }}" autocomplete="off"
                    autofocus />
                  @if ($errors->has('twitter_card'))
                  <label class="error">{{ $errors->first('twitter_card') }}</label>
                  @endif
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <label for="twitter_title" class="control-label">
                    {{ __('Twitter Title') }}
                    <span style="color:red;"></span>
                  </label>
                  <input type="text" name="twitter_title" placeholder="{{ __('Meta Open Graph image URL') }}"
                    value="{{ old('twitter_title', @$tour->twitter_title) }}" id="twitter_title"
                    class="form-control {{ $errors->has('twitter_title') ? 'is-invalid' : '' }}" autocomplete="off"
                    autofocus />
                  @if ($errors->has('twitter_title'))
                  <label class="error">{{ $errors->first('twitter_title') }}</label>
                  @endif
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <label for="twitter_desc" class="control-label">
                    {{ __('Meta Description') }}
                    <span style="color:red;"></span>
                  </label>
                  <textarea class="form-control {{ $errors->has('twitter_desc') ? 'is-invalid' : '' }}"
                    name="twitter_desc" id="twitter_desc" placeholder="{{ __('Meta Description') }}" 
                    autocomplete="off" autofocus
                    rows="2">{{ old('twitter_desc', @$tour->twitter_desc) }}</textarea>
                  @if ($errors->has('twitter_desc'))
                  <label class="error">{{ $errors->first('twitter_desc') }}</label>
                  @endif
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <label for="twitter_image" class="control-label">
                    {{ __('Twitter Image') }}
                    <span style="color:red;"></span>
                  </label>
                  <input type="text" name="twitter_image" placeholder="{{ __('Meta Open Graph image URL') }}"
                    value="{{ old('twitter_image', @$tour->twitter_image) }}" id="twitter_image"
                    class="form-control {{ $errors->has('twitter_image') ? 'is-invalid' : '' }}" autocomplete="off"
                    autofocus />
                  @if ($errors->has('twitter_image'))
                  <label class="error">{{ $errors->first('twitter_image') }}</label>
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