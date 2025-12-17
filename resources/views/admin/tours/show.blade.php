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
                                <li class="active">{{ __('Details') }}</li>
                            </ol>
                        </div>
                    </div>
                </div>

                <div class="col-sm-2">
                    <a href="{{ url('admin/tours') }}" class="btn btn-info float-right my-2 mx-3">
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
                            <div class="row">
                                <div class="col-md-4">
                                    <p><strong>Package Name:</strong> {{ $tour->package_name }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><strong>Category:</strong> {{ $tour->category->name ?? '' }} -
                                        {{ $tour->category->rating ?? '' }} Star</p>
                                </div>
                                <div class="col-md-2">
                                    <p><strong>Featured:</strong> {{ $tour->featured ? 'Yes' : 'No' }}</p>
                                </div>
                                <div class="col-md-2">
                                    <p><strong>Best Seller:</strong> {{ $tour->best_seller ? 'Yes' : 'No' }}</p>
                                </div>

                                <div class="col-12">
                                    <p><strong>URL:</strong> {{ $tour->url }}</p>
                                </div>

                                <div class="col-6">
                                    <p><strong>Nights:</strong> {{ $tour->nights }}</p>
                                </div>
                                <div class="col-6">
                                    <p><strong>Days:</strong> {{ $tour->days }}</p>
                                </div>

                                <div class="col-md-6">
    <p><strong>Islands Covered:</strong>
        @php
            $ids = is_string($tour->islands_covered) ? explode(',', $tour->islands_covered) : (array) $tour->islands_covered;
            $names = $locations->whereIn('id', $ids)->pluck('location_name')->toArray();
        @endphp
        {{ $names ? implode(', ', $names) : 'N/A' }}
    </p>
</div>


                                <div class="col-6">
                                    <p><strong>Price Start From:</strong> ₹{{ number_format($tour->package_cost) }}</p>
                                </div>
                                <div class="col-6">
                                    <p><strong>Discount (%):</strong> {{ $tour->discount }}%</p>
                                </div>

                                <div class="col-12">
                                    <p><strong>Sub Categories:</strong>
                                        @php
                                            $ids = explode(',', $tour->sub_category_id);
                                            $names = $subCategory->whereIn('id', $ids)->pluck('name')->toArray();
                                        @endphp
                                        {{ implode(', ', $names) }}
                                    </p>
                                </div>

                                <div class="col-md-12">
                                    <p><strong>Page Title:</strong> {{ $tour->page_heading }}</p>
                                </div>

                                <div class="col-md-12">
                                    <p><strong>CTA Title:</strong> {{ $tour->cta_title }}</p>
                                </div>
                                <div class="col-md-12">
                                    <p><strong>CTA Description:</strong> {{ $tour->cta_description }}</p>
                                </div>

                                <div class="col-md-12">
                                    <p><strong>Package Description:</strong><br> {!! Str::words($tour->description, 100) !!}</p>
                                </div>

                                <div class="col-md-6">
                                    <p><strong>Total Reviews:</strong> {{ $tour->reviews }}</p>
                                </div>

                                <div class="col-md-6">
                                    <p><strong>Status:</strong> {{ $tour->status ? 'Active' : 'Inactive' }}</p>
                                </div>
                            </div>


                            @include('admin.tours.navigation');
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
