@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
<!-- Heading -->
<div class="breadcrumbs">
  <div class="breadcrumbs-inner">
    <div class="row m-0">
      <div class="col-sm-4">
        <div class="page-header float-left">
          <div class="page-title">
            <h1>Dashboard</h1>
          </div>
        </div>
      </div>

      <div class="col-sm-6">
        <div class="page-header float-right">
          <div class="page-title">
            <ol class="breadcrumb text-right">
              <li><a href="{{ url('admin/home') }}">{{ __('Dashboard') }}</a></li>
              <li class="active">Home</li>
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

<div class="float-right card-body">
    <form action="{{ route('admin.home') }}" method="get" id="filterform">
     <input
    type="text"
    name="daterange"
    class="form-control"
    value="{{ request('daterange') ?? now()->format('Y-m-d').' - '.now()->format('Y-m-d') }}"
/>

    </form>
</div>


<!-- Content -->
<div class="content">
  <!-- Animated -->
  <div class="animated fadeIn">

    @include('admin.layouts.alert')



    <!-- Widgets  -->
    <div class="row">

      <div class="col-lg-3 col-md-6">
        <div class="card">
          <div class="card-body">
            <div class="stat-widget-five">
              <div class="stat-icon dib flat-color-1">
                <i class="pe-7s-cash"></i>
              </div>
              <div class="stat-content">
                <div class="text-left dib">
                  <div class="stat-text">₹<span class="count">{{ $revenue }}</span></div>
                  <div class="stat-heading">Revenue</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6">
        <div class="card">
          <div class="card-body">
            <div class="stat-widget-five">
              <div class="stat-icon dib flat-color-2">
                <i class="pe-7s-cart"></i>
              </div>
              <div class="stat-content">
                <div class="text-left dib">
                  <div class="stat-text"><span class="count">3435</span></div>
                  <div class="stat-heading">Leads</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-6">
        <div class="card">
          <div class="card-body">
            <div class="stat-widget-five">
              <div class="stat-icon dib flat-color-3">
                <i class="pe-7s-browser"></i>
              </div>
              <div class="stat-content">
                <div class="text-left dib">
                  <div class="stat-text"><span class="count">{{ $bookings }}</span></div>
                  <div class="stat-heading">Bookings</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-6">
        <div class="card">
          <div class="card-body">
            <div class="stat-widget-five">
              <div class="stat-icon dib flat-color-4">
                <i class="pe-7s-users"></i>
              </div>
              <div class="stat-content">
                <div class="text-left dib">
                  <div class="stat-text"><span class="count">{{ $users }}</span></div>
                  <div class="stat-heading">Clients</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6">
        <div class="card">
          <div class="card-body">
            <div class="stat-widget-five">
              <div class="stat-icon dib flat-color-4">
                <i class="pe-7s-users"></i>
              </div>
              <div class="stat-content">
                <div class="text-left dib">
                  <div class="stat-text"><span class="count"><livewire:visitor-count /></span></div>
                  <div class="stat-heading">Visitors</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- /Widgets -->

    <!-- Widgets -->
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body" style="min-height:385px;">

          </div>
        </div>
      </div><!--/.col-->
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
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<script>
$(function () {

    const $input = $('input[name="daterange"]');

    $input.daterangepicker({
        opens: 'left',
        autoApply: true,
        locale: {
            format: 'YYYY-MM-DD'
        }
    });

    $input.on('apply.daterangepicker', function (ev, picker) {
        $(this).val(
            picker.startDate.format('YYYY-MM-DD') +
            ' - ' +
            picker.endDate.format('YYYY-MM-DD')
        );

        document.getElementById('filterform').submit();
    });

});
</script>


@endsection