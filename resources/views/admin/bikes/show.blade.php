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
              <li class="active">{{ __('Details') }}</li>
            </ol>
          </div>
        </div>
      </div>

      <div class="col-sm-2">
        <a href="{{ url('admin/bikes') }}" class="btn btn-info float-right my-2 mx-3">
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
            <div class="row justify-content-center">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="name" class="control-label">
                    {{ __('Name') }}
                    <span style="color:red;">*</span>
                  </label>
                  <span class="form-control">
                    {{ ucwords(@$bike->name) }}
                  </span>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="category_id" class="control-label">
                    {{ __('Category') }}
                    <span style="color:red;">*</span>
                  </label>
                  <span class="form-control">
                    {{ ucwords(@$bike->category->name) }}
                  </span>
                </div>
              </div>

              <div class="col-md-2">
                <div class="form-group">
                  <label for="featured" class="control-label">
                    {{ __('Featured') }}
                    <span style="color:red;"></span>
                  </label>
                  <div class="custom-control custom-switch">
                    <input type="checkbox" name="featured" value="1" id="featured" class="custom-control-input" @checked(@$bike->featured == 1) disabled />
                    <label class="custom-control-label" for="featured">{{ __('Yes') }}</label>
                  </div>
                </div>
              </div>

              <div class="col-md-2">
                <div class="form-group">
                  <label for="best_seller" class="control-label">
                    {{ __('Best Seller') }}
                    <span style="color:red;"></span>
                  </label>
                  <div class="custom-control custom-switch">
                    <input type="checkbox" name="best_seller" value="1" id="best_seller" class="custom-control-input" @checked(@$bike->best_seller == 1) disabled />
                    <label class="custom-control-label" for="best_seller">{{ __('Yes') }}</label>
                  </div>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="adult_rate" class="control-label">
                    {{ __('Adult Rate') }}
                    <span style="color:red;">*</span>
                  </label>
                  <span class="form-control">
                    {{ number_format(@$bike->adult_rate, 2) }}
                  </span>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="adult_price" class="control-label">
                    {{ __('Adult Price') }}
                    <span style="color:red;">*</span>
                  </label>
                  <span class="form-control">
                    {{ number_format(@$bike->adult_price, 2) }}
                  </span>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="adult_fees" class="control-label">
                    {{ __('Adult Fees') }}
                    <span style="color:red;">*</span>
                  </label>
                  <span class="form-control">
                    {{ number_format(@$bike->adult_fees, 2) }}
                  </span>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="ratings" class="control-label">
                    {{ __('Ratings') }}
                    <span style="color:red;">*</span>
                  </label>
                  <span class="form-control">
                    {{ @$bike->ratings }}
                  </span>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="reviews_count" class="control-label">
                    {{ __('Total Reviews') }}
                    <span style="color:red;">*</span>
                  </label>
                  <span class="form-control">
                    {{ @$bike->reviews_count }}
                  </span>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="status" class="control-label">
                    {{ __('Status') }}
                    <span style="color:red;">*</span>
                  </label>
                  <span class="form-control">
                    {{ ucwords(@$bike->status) }}
                  </span>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label for="address" class="control-label">
                    {{ __('Address') }}
                    <span style="color:red;">*</span>
                  </label>
                  <span class="form-control">
                    {{ ucwords(@$bike->address) }}
                  </span>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label for="gmap" class="control-label">
                    {{ __('Google Map Short Link') }}
                    <span style="color:red;"></span>
                  </label>
                  <span class="form-control">
                    {{ ucwords(@$bike->gmap) }}
                  </span>
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <label for="description" class="control-label">
                    {{ __('Description') }}
                    <span style="color:red;"></span>
                  </label>
                  <p class="">
                    {!! nl2br(@$bike->description) !!}
                  </p>
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <label for="meta_title" class="control-label">
                    {{ __('Meta Title') }}
                    <span style="color:red;"></span>
                  </label>
                  <span class="form-control">
                    {{ ucwords(@$bike->meta_title) }}
                  </span>
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <label for="meta_keywords" class="control-label">
                    {{ __('Meta Keywords') }}
                    <span style="color:red;"></span>
                  </label>
                  <p class="">
                    {!! nl2br(@$bike->meta_keywords) !!}
                  </p>
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <label for="meta_description" class="control-label">
                    {{ __('Meta Description') }}
                    <span style="color:red;"></span>
                  </label>
                  <p class="">
                    {!! nl2br(@$bike->meta_description) !!}
                  </p>
                </div>
              </div>
            </div>

            <div class="row align-items-center justify-content-center">
              <div class="align-self-center col-md-2">
                <a href="{{ url('admin/bikes/' . @$bike->id . '/pricing') }}" class="btn btn-block btn-outline-info my-1">
                  <i class="fa fa-pencil-square-o fa-lg"></i>&nbsp;
                  <span>{{ __('Pricing ') }}</span>
                </a>
              </div>
              <div class="align-self-center col-md-2">
                <a href="{{ url('admin/bikes/' . @$bike->id . '/images') }}" class="btn btn-block btn-outline-info my-1">
                  <i class="fa fa-pencil-square-o fa-lg"></i>&nbsp;
                  <span>{{ __('Images') }}</span>
                </a>
              </div>

              <div class="align-self-center col-md-2">
                <a href="{{ url('admin/bikes/' . @$bike->id . '/facilities') }}" class="btn btn-block btn-outline-info my-1">
                  <i class="fa fa-pencil-square-o fa-lg"></i>&nbsp;
                  <span>{{ __('Facilities') }}</span>
                </a>
              </div>

              <div class="align-self-center col-md-2">
                <a href="{{ url('admin/bikes/' . @$bike->id . '/policies') }}" class="btn btn-block btn-outline-info my-1">
                  <i class="fa fa-pencil-square-o fa-lg"></i>&nbsp;
                  <span>{{ __('Policies') }}</span>
                </a>
              </div>

              <div class="align-self-center col-md-2">
                <a href="{{ url('admin/bikes/' . @$bike->id . '/faqs') }}" class="btn btn-block btn-outline-info my-1">
                  <i class="fa fa-pencil-square-o fa-lg"></i>&nbsp;
                  <span>{{ __('Faqs') }}</span>
                </a>
              </div>

              <div class="align-self-center col-md-2">
                <a href="{{ url('admin/bikes/' . @$bike->id . '/reviews') }}" class="btn btn-block btn-outline-info my-1">
                  <i class="fa fa-pencil-square-o fa-lg"></i>&nbsp;
                  <span>{{ __('Reviews') }}</span>
                </a>
              </div>

              <div class="align-self-center col-md-2">
                <a href="{{ url('admin/bikes/' . @$bike->id . '/edit') }}" class="btn btn-block btn-info my-1">
                  <i class="fa fa-pencil-square-o fa-lg"></i>&nbsp;
                  <span>{{ __('Edit') }}</span>
                </a>
              </div>
            </div>
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