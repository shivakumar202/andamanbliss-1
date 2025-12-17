@extends('admin.layouts.app')

@section('title', __('Tour Package Pricing'))

@section('content')
    <!-- Heading -->
    <div class="breadcrumbs">
        <div class="breadcrumbs-inner">
            <div class="row">
                <div class="col-sm-4">
                    <div class="page-header float-left">
                        <div class="page-title">
                            <h1>{{ __('Package Pricing') }}</h1>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="page-header float-right">
                        <div class="page-title">
                            <ol class="breadcrumb text-right">
                                <li><a href="{{ url('admin/home') }}">{{ __('Dashboard') }}</a></li>
                                <li><a href="{{ url('admin/tours') }}">{{ __('Package') }}</a></li>
                                <li><a href="{{ url('admin/tours/' . $tour->id) }}">{{ __('Details') }}</a></li>
                                <li class="active">{{ __('Pricing') }}</li>
                            </ol>
                        </div>
                    </div>
                </div>

                <div class="col-sm-2">
                    <a href="{{ url('admin/tours/' . $tour->id) }}" class="btn btn-info float-right my-2 mx-3">
                        <i class="fa fa-undo fa-lg"></i>&nbsp;
                        {{ __('Back') }}
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="content">
        <div class="animated fadeIn">

            @include('admin.layouts.alert')

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">{{ __('Tour Package Pricing') }}</strong>
                        </div>

                        <div class="card-body">
                            <form action="{{ url('admin/tours/' . $tour->id . '/pricing') }}" method="POST">
                                @csrf
                                <div class="row justify-content-center">
                                    <div class="col-12 mb-3">
                                        <h4>{{ $tour->package_name }}</h4>
                                        <p><strong>Category:</strong> {{ $tour->tourCategory->name ?? '-' }}</p>
                                    </div>

                                    @foreach ($tour->subCategories->sortBy('rating') as $sub)
                                        <div class="col-md-4">
                                            <div class="card mb-3 p-3">
                                                <h5 class="mb-2">{{ $sub->name }}</h5>

                                                <input type="hidden" name="sub_category[]" value="{{ $sub->id }}">

                                                <div class="form-group">
                                                    <label for="markup_{{ $sub->id }}">Markup (%)</label>
                                                    <input type="number" step="0.01" name="markup[{{ $sub->id }}]"
                                                        id="markup_{{ $sub->id }}"
                                                        value="{{ $sub->pivot->markup ?? 0 }}" class="form-control"
                                                        placeholder="Enter markup %">
                                                </div>

                                                <div class="form-group">
                                                    <label for="discount_{{ $sub->id }}">Discount (%)</label>
                                                    <input type="number" step="0.01"
                                                        name="discount[{{ $sub->id }}]"
                                                        id="discount_{{ $sub->id }}"
                                                        value="{{ $sub->pivot->discount ?? 0 }}" class="form-control"
                                                        placeholder="Enter discount %">
                                                </div>

                                                <div class="form-group">
                                                    <label for="discount_above_{{ $sub->id }}">Discount Above
                                                        (₹)</label>
                                                    <input type="number" step="0.01"
                                                        name="discount_above[{{ $sub->id }}]"
                                                        id="discount_above_{{ $sub->id }}"
                                                        value="{{ $sub->pivot->discount_above ?? '' }}"
                                                        class="form-control" placeholder="Optional">
                                                </div>

                                                <div class="form-group">
                                                    <label for="starts_from_{{ $sub->id }}">Starts From (₹)</label>
                                                    <input type="number" step="0.01"
                                                        name="starts_from[{{ $sub->id }}]"
                                                        id="starts_from_{{ $sub->id }}"
                                                        value="{{ $sub->pivot->starts_from ?? '' }}" class="form-control"
                                                        placeholder="Optional">
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="row justify-content-center">
                                    <div class="col-md-2">
                                        <button type="submit" class="btn btn-block btn-info my-1">
                                            <i class="fa fa-floppy-o fa-lg"></i>&nbsp; {{ __('Save') }}
                                        </button>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="reset" class="btn btn-block btn-outline-info my-1">
                                            <i class="fa fa-refresh fa-lg"></i>&nbsp; {{ __('Reset') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <hr>
@include('admin.tours.navigation');

                            <hr>

                            <table class="table table-striped table-hover w-100">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>{{ __('Subcategory') }}</th>
                                        <th>{{ __('Markup') }}</th>
                                        <th>{{ __('Discount') }}</th>
                                        <th>{{ __('Discount Above') }}</th>
                                        <th>{{ __('Starts From') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tour->subCategories as $sub)
                                        <tr>
                                            <td>{{ $sub->name }}</td>
                                            <td>{{ $sub->pivot->markup ?? 0 }}</td>
                                            <td>{{ $sub->pivot->discount ?? 0 }}</td>
                                            <td>{{ $sub->pivot->discount_above ?? '-' }}</td>
                                            <td>{{ $sub->pivot->starts_from ?? '-' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('css')
    <style type="text/css">
        /* Optional custom CSS */
    </style>
@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            // Optional JS
        });
    </script>
@endsection
