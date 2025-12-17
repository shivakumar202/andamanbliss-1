@extends('admin.layouts.app')

@section('title', __('Visitors'))

@section('content')
<!-- Heading -->
<div class="breadcrumbs">
  <div class="breadcrumbs-inner">
    <div class="row">
      <div class="col-sm-4">
        <div class="page-header float-left">
          <div class="page-title">
            <h1>{{ __('Visitors') }}</h1>
          </div>
        </div>
      </div>

      <div class="col-sm-6">
        <div class="page-header float-right">
          <div class="page-title">
            <ol class="breadcrumb text-right">
              <li><a href="{{ url('admin/home') }}">{{ __('Dashboard') }}</a></li>
              <li class="active">{{ __('Visitors') }}</li>
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
              {{ __('Visitors') }} <livewire:visitor-count></livewire:visitor-count>
            </strong>
          </div>

          <div class="card-body">


            <table class="table table-striped">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>IP Address</th>
                  <th >Browser Agent</th>
                  <th>Click Url</th>
                  <th>Time</th>
                </tr>
              </thead>
              <tbody>
                @foreach($visitors as $visitor)
                <tr>
                  <td>{{ $visitor->id }}</td>
                  <td>{{ $visitor->ip_address }}</td>
                  <td style="max-width: 250px; white-space: normal; word-break: break-all;">{{ $visitor->user_agent }}</td>
                  <td>{{ $visitor->path }}</td>
                  <td>{{ $visitor->created_at }}</td>
                </tr>
                @endforeach
              </tbody>
            </table>

            <div class="mt-3 d-flex justify-content-center">
              @if ($visitors->hasPages())
              <div class="d-flex justify-content-center mt-4">
                <ul class="pagination custom-pagination mb-0">
                  {{-- Previous Page --}}
                  @if ($visitors->onFirstPage())
                  <li class="page-item disabled">
                    <span class="page-link">&laquo;</span>
                  </li>
                  @else
                  <li class="page-item">
                    <a href="{{ $visitors->previousPageUrl() }}" class="page-link" rel="prev">&laquo;</a>
                  </li>
                  @endif

                  @foreach ($visitors->links()->elements[0] ?? [] as $page => $url)
                  @if ($page == $visitors->currentPage())
                  <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                  @else
                  <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                  @endif
                  @endforeach

                  @if ($visitors->hasMorePages())
                  <li class="page-item">
                    <a href="{{ $visitors->nextPageUrl() }}" class="page-link" rel="next">&raquo;</a>
                  </li>
                  @else
                  <li class="page-item disabled">
                    <span class="page-link">&raquo;</span>
                  </li>
                  @endif
                </ul>
              </div>
              @endif
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

</script>
@endsection