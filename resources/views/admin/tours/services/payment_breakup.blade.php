@extends('admin.layouts.app')

@section('title', __('Payment Breakups'))

@section('content')
<!-- Heading -->
<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Payment Breakup</h1>
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="{{ url('admin/home') }}">{{ __('Dashboard') }}</a></li>
                            <li class="active">{{ __('payment Breakup') }}</li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="col-sm-2">
                <a href="{{ url('admin/tours/' . request('tourId')) }}" class="btn btn-info float-right my-2 mx-3">
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
                            {{ __('Payment Breakup') }} <span class="text-danger" style="font-size:12px;">(This same payment breakdown is applicable across all packages.)</span>
                        </strong>
                    </div>
                    <div class="card-body">
                        <form name="form" @if (@$payments) action="{{ url('admin/tours/package/payment-breakup/' . @$payment->id) }}"
                            @else action="{{ url('admin/tours/package/payment-breakup') }}" @endif method="POST" id="form"
                            class="" enctype="multipart/form-data" novalidate="novalidate" autocomplete="off">
                            @csrf
                            <div class="row justify-content-center">
                               
                                <div class="col-md-6">
                                    <label for="answer" class="control-label">
                                        {{ __('Days Before Arrival') }}
                                        <span style="color:red;">*</span>
                                    </label>
                                    <div class="input-group">
                                        <input type="number" min="1" name="days" placeholder="{{ __('Arrival days before') }}" id="percentage"
                                        value="{{ old('days', @$payment->days) }}"    
                                        class="form-control {{ $errors->has('days') ? 'is-invalid' : '' }}" required autocomplete="off"
                                            autofocus />                                       
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">days</span>
                                        </div>
                                        
                                    </div>
                                     @if ($errors->has('days'))
                                        <label class="error">{{ $errors->first('days') }}</label>
                                        @endif
                                </div>
                                <div class="col-md-6">
                                    <label for="answer" class="control-label">
                                        {{ __('Payment Percentage') }}
                                        <span style="color:red;">*</span>
                                    </label>
                                    <div class="input-group">
                                        <input type="number" min="0" name="percentage" placeholder="{{ __('Payment Percentage') }}" id="percentage"
                                        value="{{ old('percent', @$payment->percent) }}"    
                                        class="form-control {{ $errors->has('percentage') ? 'is-invalid' : '' }}" required autocomplete="off"
                                            autofocus />                                       
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">%</span>
                                        </div>
                                        
                                    </div>
                                     @if ($errors->has('percentage'))
                                        <label class="error">{{ $errors->first('percentage') }}</label>
                                        @endif
                                </div>
                            </div>
                            <div class="row align-items-center justify-content-center">
                                <div class="align-self-center col-md-2">
                                    <button type="submit"  id="submit" class="btn btn-block btn-success my-1">
                                        <i class="fa fa-floppy-o fa-lg"></i>&nbsp;
                                        <span>{{ __('Save') }}</span>
                                    </button>
                                </div>
                                <div class="align-self-center col-md-2">
                                    <a href="{{ url('admin/tours/package/payment-breakup') }}" id="reset"
                                        class="btn btn-block btn-outline-danger my-1">
                                        <i class="fa fa-refresh fa-lg"></i>&nbsp;
                                        <span>{{ __('Reset') }}</span>
                                    </a>
                                </div>
                            </div>
                        </form>
                        <hr class="my-2">
                        <table id="dataTable" class="table table-striped table-hover w-100">
                            <thead class="thead-dark">
                                <tr>
                                    <th>{{ __('ID') }}</th>
                                    <th>{{ __('Days Before') }}</th>
                                    <th>{{ __('payment Percentage') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($payments as $key => $payment)
                                <tr>
                                    <td>{{ @$payment->id }}</td>
                                    <td>{{ @$payment->days == 0 ? 'Default Payment Percenteage' : @$payment->days }}</td>
                                    <td>{{ $payment->percent }}%</td>
                                    <td>
                                        <a href="{{ url('admin/tours/package/payment-breakup/' . @$payment->id) }}" title="Edit"
                                            class="btn btn-xs btn-outline-info py-0 mx-1">
                                            <i class="fa fa-pencil-square-o"></i>
                                        </a>
                                        <a onClick="if (confirm('Are you sure?')) return this.nextElementSibling.submit();"
                                            href="javascript:;" title="Delete" class="btn btn-xs btn-outline-danger py-0 mx-1">
                                            <i class="fa fa-trash-o"></i>
                                        </a>
                                        <form action="{{ url('admin/tours/package/payment-breakup/' . @$payment->id) }}" method="POST"
                                            class="d-none">
                                            @method('DELETE')
                                            @csrf
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
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
    var datatable;

    $(document).ready(function() {
        
        datatable = $('#dataTable').DataTable({
            responsive: true,
            lengthMenu: [
                [10, 50, 100, -1],
                [10, 50, 100, 'All']
            ],
            pageLength: 10,
            aaSorting: [0, 'DESC'],
            columnDefs: [{
                    targets: [0, 2], // column index
                    orderable: false,
                },
                {
                    targets: [0, 2], // column index
                    searchable: false,
                },
                {
                    targets: [0], // column index
                    visible: false,
                }
            ],
            // dom: 'lBfrtip',
            dom: '<"row"<"col-sm-3"l><"col-sm-4"B><"col-sm-5"f>>' +
                '<"row"<"col-sm-12"tr>>' +
                '<"row"<"col-sm-5"i><"col-sm-7"p>>',
            buttons: [{
                    extend: 'csv',
                    text: 'CSV',
                    filename: 'tour_payments',
                    className: 'btn btn-xs btn-dark py-1',
                    exportOptions: {
                        columns: ':visible:not(:last-child)'
                    }
                },
                {
                    extend: 'excel',
                    text: 'Excel',
                    filename: 'tour_payments',
                    className: 'btn btn-xs btn-dark py-1',
                    exportOptions: {
                        columns: ':visible:not(:last-child)'
                    }
                },
                {
                    extend: 'pdf',
                    text: 'PDF',
                    filename: 'tour_payments',
                    className: 'btn btn-xs btn-dark py-1',
                    exportOptions: {
                        columns: ':visible:not(:last-child)'
                    }
                }
            ]
        });
    });
</script>
@endsection