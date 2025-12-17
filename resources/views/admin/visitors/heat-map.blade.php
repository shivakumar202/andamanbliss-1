@extends('admin.layouts.app')

@section('title', __(' Website Analytics'))

@section('css')
<style>
    #map {
        height: 500px;
        width: 100%;
    }

    .cursor-default {
        display: none !important;
    }
</style>
@endsection

@section('content')
<!-- Heading -->
<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>{{ __(' Website Analytics') }}</h1>
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="{{ url('admin/home') }}">{{ __('Dashboard') }}</a></li>
                            <li class="active">{{ __(' Website Analytics') }}</li>
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
            <div class="col-12 d-flex">

                <div class="col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="stat-widget-five">
                                <div class="stat-icon dib flat-color-1">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                </div>
                                <div class="stat-content">
                                    <div class="text-left dib">
                                        <div class="stat-text"><span class="count">{{ $data['visitorsCount'] }}</span></div>
                                        <div class="stat-heading">Total Visitors</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="stat-widget-five">
                                <div class="stat-icon dib flat-color-1">
                                    <i class="fa fa-line-chart" aria-hidden="true"></i>

                                </div>
                                <div class="stat-content">
                                    <div class="text-left dib">
                                        <div class="stat-text"><span class="count">{{ $data['newVisits'] }} </span></div>
                                        <div class="stat-heading">New Visitors Today</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="stat-widget-five">
                                <div class="stat-icon dib flat-color-1">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                </div>
                                <div class="stat-content">
                                    <div class="text-left dib">
                                        <div class="stat-text"><span class="count">{{ $data['liveVisitors'] }}</span></div> 
                                        <div class="stat-heading">Live Visitors</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">
                            {{ __('Most Visited Urls') }}
                        </strong>
                    </div>
                    <div class="card-body">

                        <livewire:visitors-table></livewire:visitors-table>

                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">
                            {{ __('Visitors Heat Map') }}
                        </strong>


                    </div>
                    <div class="card-body">
                        <div id="map"></div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div><!-- .card -->

@endsection

@section('css')
<style type="text/css">
    td {
        font-size: 10px;
    }
</style>
@endsection

@section('script')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAai7unx7nXZnFcC4tVv3AGzJVjjUr4-bg&libraries=visualization"></script>

<script>
    const visits = @json($visits);

    const map = new google.maps.Map(document.getElementById('map'), {
        zoom: 3,
        center: {
            lat: 20,
            lng: 50
        },
        mapTypeId: 'roadmap'
    });

    const heatData = visits.map(v => ({
        location: new google.maps.LatLng(v.lat, v.long),
        weight: v.duration || 1
    }));

    const heatmap = new google.maps.visualization.HeatmapLayer({
        data: heatData,
        radius: 30
    });

    heatmap.setMap(map);
</script>
@endsection