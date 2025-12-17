@extends('admin.layouts.app')

@section('title', __('Activity'))

@section('content')
    <!-- Heading -->
    <div class="breadcrumbs">
        <div class="breadcrumbs-inner">
            <div class="row">
                <div class="col-sm-4">
                    <div class="page-header float-left">
                        <div class="page-title">
                            <h1>{{ __('Activity') }}</h1>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="page-header float-right">
                        <div class="page-title">
                            <ol class="breadcrumb text-right">
                                <li><a href="{{ url('admin/home') }}">{{ __('Dashboard') }}</a></li>
                                <li><a href="{{ url('admin/activities') }}">{{ __('Activity') }}</a></li>
                                <li class="active">{{ __('Details') }}</li>
                            </ol>
                        </div>
                    </div>
                </div>

                <div class="col-sm-2">
                    <a href="{{ url('admin/activities') }}" class="btn btn-info float-right my-2 mx-3">
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

                                <!-- Name -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">{{ __('Name') }} <span
                                                style="color:red;">*</span></label>
                                        <span class="form-control">{{ ucwords(@$activity->service_name) }}</span>
                                    </div>
                                </div>

                                <!-- Category -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">{{ __('Category') }} <span
                                                style="color:red;">*</span></label>
                                        <span class="form-control">{{ ucwords(@$activity->category->name) }}</span>
                                    </div>
                                </div>

                                <!-- Featured -->
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="control-label">{{ __('Featured') }}</label>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="featured"
                                                @checked(@$activity->featured) disabled>
                                            <label class="custom-control-label" for="featured">{{ __('Yes') }}</label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Best Seller -->
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="control-label">{{ __('Best Seller') }}</label>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="best_seller"
                                                @checked(@$activity->best_seller) disabled>
                                            <label class="custom-control-label"
                                                for="best_seller">{{ __('Yes') }}</label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Slug -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">{{ __('Slug') }}</label>
                                        <span class="form-control">{{ @$activity->slug }}</span>
                                    </div>
                                </div>

                                <!-- URL -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">{{ __('Dynamic Page Url') }}</label>
                                        <span class="form-control">{{ @$activity->url }}</span>
                                    </div>
                                </div>

                                <!-- Heading Title -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">{{ __('Heading Title') }} <span
                                                style="color:red;">*</span></label>
                                        <span class="form-control">{{ @$activity->title }}</span>
                                    </div>
                                </div>

                                <!-- Description -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">{{ __('Description') }} <span
                                                style="color:red;">*</span></label>
                                        <p>{!! nl2br(@$activity->description) !!}</p>
                                    </div>
                                </div>

                                <!-- Addons -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">{{ __('Addons') }} <span
                                                style="color:red;">*</span></label>
                                        <div class="form-control" style="height:auto">
                                            @php
                                                $addonIds = explode(',', @$activity->addons);
                                            @endphp

                                            @foreach ($addons as $addon)
                                                @if (in_array($addon->id, $addonIds))
                                                    <span class="badge badge-primary mr-1">{{ $addon->name }}</span>
                                                @endif
                                            @endforeach

                                        </div>
                                    </div>
                                </div>

                                <!-- Adult Cost -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">{{ __('Adult Cost (Starting From)') }} <span
                                                style="color:red;">*</span></label>
                                        <span class="form-control">{{ number_format(@$activity->adult_cost, 2) }}</span>
                                    </div>
                                </div>

                                <!-- Child Cost -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">{{ __('Child Cost') }} <span
                                                style="color:red;">*</span></label>
                                        <span class="form-control">{{ number_format(@$activity->child_cost, 2) }}</span>
                                    </div>
                                </div>

                                <!-- Discount -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">{{ __('Discount in (%)') }} <span
                                                style="color:red;">*</span></label>
                                        <span class="form-control">{{ @$activity->discount }}%</span>
                                    </div>
                                </div>

                                <!-- Duration -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">{{ __('Duration') }} <span
                                                style="color:red;">*</span></label>
                                        <span class="form-control">{{ @$activity->duration }}</span>
                                    </div>
                                </div>

                                <!-- Ratings -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">{{ __('Ratings') }} <span
                                                style="color:red;">*</span></label>
                                        <span class="form-control">{{ @$activity->rating }}</span>
                                    </div>
                                </div>

                                <!-- Location -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">{{ __('Location') }} <span
                                                style="color:red;">*</span></label>
                                        <span class="form-control">{{ @$activity->location }}</span>
                                    </div>
                                </div>

                                <!-- Medical Verification -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">{{ __('Has Medical Verification') }} <span
                                                style="color:red;">*</span></label>
                                        <span
                                            class="form-control">{{ @$activity->has_medical_verification ? 'Yes' : 'No' }}</span>
                                    </div>
                                </div>

                                <!-- Status -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">{{ __('Status') }} <span
                                                style="color:red;">*</span></label>
                                        <span class="form-control">{{ @$activity->status ? 'Active' : 'Inactive' }}</span>
                                    </div>
                                </div>

                            </div>

                            <div class="row align-items-center justify-content-center">
                                <div class="align-self-center col-md-2">
                                    <a href="{{ url('admin/activities/' . @$activity->id . '/images') }}"
                                        class="btn btn-block btn-outline-info my-1">
                                        <i class="fa fa-pencil-square-o fa-lg"></i>&nbsp;
                                        <span>{{ __('Images') }}</span>
                                    </a>
                                </div>

                                <div class="align-self-center col-md-2">
                                    <a href="{{ url('admin/activities/' . @$activity->id . '/facilities') }}"
                                        class="btn btn-block btn-outline-info my-1">
                                        <i class="fa fa-pencil-square-o fa-lg"></i>&nbsp;
                                        <span>{{ __('Facilities') }}</span>
                                    </a>
                                </div>

                                <div class="align-self-center col-md-2">
                                    <a href="{{ url('admin/activities/' . @$activity->id . '/highlights') }}"
                                        class="btn btn-block btn-outline-info my-1">
                                        <i class="fa fa-pencil-square-o fa-lg"></i>&nbsp;
                                        <span>{{ __('Highlights') }}</span>
                                    </a>
                                </div>

                                <div class="align-self-center col-md-2">
                                    <a href="{{ url('admin/activities/' . @$activity->id . '/slots') }}"
                                        class="btn btn-block btn-outline-info my-1">
                                        <i class="fa fa-clock-o fa-lg"></i>&nbsp;
                                        <span>{{ __('Timing Slots') }}</span>
                                    </a>
                                </div>

                                <div class="align-self-center col-md-2">
                                    <a href="{{ url('admin/activities/' . @$activity->id . '/faqs') }}"
                                        class="btn btn-block btn-outline-info my-1">
                                        <i class="fa fa-pencil-square-o fa-lg"></i>&nbsp;
                                        <span>{{ __('Faqs') }}</span>
                                    </a>
                                </div>

                                <div class="align-self-center col-md-2">
                                    <a href="{{ url('admin/activities/' . @$activity->id . '/reviews') }}"
                                        class="btn btn-block btn-outline-info my-1">
                                        <i class="fa fa-pencil-square-o fa-lg"></i>&nbsp;
                                        <span>{{ __('Reviews') }}</span>
                                    </a>
                                </div>
                                 <div class="align-self-center col-md-2">
                                    <a href="{{ url('admin/activities/' . @$activity->id . '/info-blocks') }}"
                                        class="btn btn-block btn-outline-info my-1">
                                        <i class="fa fa-info fa-lg"></i>&nbsp;
                                        <span>{{ __('Info Blocks') }}</span>
                                    </a>
                                </div>
                                 <div class="align-self-center col-md-2">
                                    <a href="{{ url('admin/activities/' . @$activity->id . '/meta-headings') }}"
                                        class="btn btn-block btn-outline-info my-1">
                                        <i class="fa fa-google fa-lg"></i>&nbsp;
                                        <span>{{ __('Meta Headings') }}</span>
                                    </a>
                                </div>
                                 <div class="align-self-center col-md-2">
                                    <a href="{{ url('admin/activities/' . @$activity->id . '/content-blocks') }}"
                                        class="btn btn-block btn-outline-info my-1">
                                        <i class="fa fa-windows fa-lg"></i>&nbsp;
                                        <span>{{ __('Content Block') }}</span>
                                    </a>
                                </div>
                                <div class="align-self-center col-md-2">
                                    <a href="{{ url('admin/activities/' . @$activity->id . '/day-schedules') }}"
                                        class="btn btn-block btn-outline-info my-1">
                                        <i class="fa fa-calendar fa-lg"></i>&nbsp;
                                        <span>{{ __('Day Schedule') }}</span>
                                    </a>
                                </div>
                                <div class="align-self-center col-md-2">
                                    <a href="{{ url('admin/activities/' . @$activity->id . '/overview') }}"
                                        class="btn btn-block btn-outline-info my-1">
                                        <i class="fa fa-book fa-lg"></i>&nbsp;
                                        <span>{{ __('Overview') }}</span>
                                    </a>
                                </div>
                                <div class="align-self-center col-md-2">
                                    <a href="{{ url('admin/activities/' . @$activity->id . '/edit') }}"
                                        class="btn btn-block btn-info my-1">
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
