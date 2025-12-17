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
                            <div class="row justify-content-center">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Name <span style="color:red;">*</span></label>
                                        <span class="form-control">{{ ucwords(@$category->name) }}</span>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="control-label">Type <span style="color:red;">*</span></label>
                                        <span class="form-control">{{ ucwords(@$category->type) }}</span>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="control-label">Rating <span style="color:red;">*</span></label>
                                        @php
                                            $rating = collect($ratings)->firstWhere('value', $category->rating);
                                        @endphp
                                        <span class="form-control">
                                            {{ $rating ? ucwords($rating['name']) . ' (' . $rating['value'] . ' Star)' : 'N/A' }}
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="control-label">Featured</label>
                                        <span class="form-control">
                                            {{ @$category->featured == 1 ? 'Yes' : 'No' }}
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="control-label">Best Seller</label>
                                        <span class="form-control">
                                            {{ @$category->best_seller == 1 ? 'Yes' : 'No' }}
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Title</label>
                                        <span class="form-control">{{ @$category->title }}</span>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Description</label>
                                        <div class="form-control" style="min-height: 100px; white-space: pre-line;">
                                            {{ @$category->description }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row align-items-center justify-content-center">
                                <div class="align-self-center col-md-2">
                                    <a href="{{ url('admin/categories/' . @$category->id . '/images') }}"
                                        class="btn btn-block btn-outline-info my-1">
                                        <i class="fa fa-pencil-square-o fa-lg"></i>&nbsp;
                                        <span>{{ __('Images') }}</span>
                                    </a>
                                </div>

                                <div class="align-self-center col-md-2">
                                    <a href="{{ url('admin/categories/' . @$category->id . '/facilities') }}"
                                        class="btn btn-block btn-outline-info my-1">
                                        <i class="fa fa-pencil-square-o fa-lg"></i>&nbsp;
                                        <span>{{ __('Facilities') }}</span>
                                    </a>
                                </div>

                                <div class="align-self-center col-md-2">
                                    <a href="{{ url('admin/categories/' . @$category->id . '/faqs') }}"
                                        class="btn btn-block btn-outline-info my-1">
                                        <i class="fa fa-pencil-square-o fa-lg"></i>&nbsp;
                                        <span>{{ __('Faqs') }}</span>
                                    </a>
                                </div>
                                <div class="align-self-center col-md-2">
                                    <a href="{{ url('admin/categories/' . @$category->id . '/meta-headings') }}"
                                        class="btn btn-block btn-outline-info my-1">
                                        <i class="fa fa-pencil-square-o fa-lg"></i>&nbsp;
                                        <span>{{ __('Meta Information') }}</span>
                                    </a>
                                </div>
                                <div class="align-self-center col-md-2">
                                    <a href="{{ url('admin/categories/' . @$category->id . '/reviews') }}"
                                        class="btn btn-block btn-outline-info my-1">
                                        <i class="fa fa-pencil-square-o fa-lg"></i>&nbsp;
                                        <span>{{ __('Reviews') }}</span>
                                    </a>
                                </div>
                                <div class="align-self-center col-md-2">
                                    <a href="{{ url('admin/categories/' . @$category->id . '/content-section') }}"
                                        class="btn btn-block btn-outline-info my-1">
                                        <i class="fa fa-pencil-square-o fa-lg"></i>&nbsp;
                                        <span>{{ __('Content Section') }}</span>
                                    </a>
                                </div>
                                <div class="align-self-center col-md-2">
                                    <a href="{{ url('admin/categories/' . @$category->id . '/edit') }}"
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
