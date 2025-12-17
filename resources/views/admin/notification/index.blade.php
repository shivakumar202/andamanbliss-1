@extends('admin.layouts.app')

@section('title', __('Push Notifications'))

@section('content')
<!-- Heading -->
<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>{{ __('Push Notifications') }}</h1>
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="{{ url('admin/home') }}">{{ __('Dashboard') }}</a></li>
                            <li class="active">{{ __('Push Notifications') }}</li>
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
                            {{ __('Push Notifications') }}
                        </strong>
                    </div>

                    <div class="card-body">
                        <form name="form" action="{{ $notification ? route('admin.push-notifications.update',$notification->id) : route('admin.push-notifications.store') }}" method="POST" id="form"
                            enctype="multipart/form-data" novalidate autocomplete="off">
                            @csrf
                            @if($notification)
                            @method('PUT')
                            @endif
                            <div class="row justify-content-start">
                                {{-- Notification Type --}}
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="category" class="control-label">{{ __('Category') }}</label>
                                        <input type="text" name="category" id="category" class="form-control"
                                            value="book-notification" readonly>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="visit_url" class="control-label">{{ __('Visiting URL') }}</label>
                                        <input type="url" name="visit_url" id="visit_url" class="form-control p-1"
                                            value="{{ $notification['visit_url'] ?? '' }}" placeholder="https://andamanbliss.com/*">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="banner" class="control-label">{{ __('Banner Image') }}</label>
                                        <input type="file" name="banner" id="banner" class="form-control p-1">
                                    </div>
                                </div>
                                {{-- Title --}}
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="title" class="control-label">{{ __('Notification Title') }}</label>
                                        <input type="text" name="title" id="title" class="form-control" value="{{ $notification['title'] ?? '' }}" placeholder="Enter title">
                                    </div>
                                </div>

                                {{-- Message --}}
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="message" class="control-label">{{ __('Message Body') }}</label>
                                        <textarea name="message" id="message" class="form-control"
                                            placeholder="message content">{{ $notification['message'] ?? '' }}</textarea>
                                    </div>
                                </div>

                                {{-- Action URL --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="action_url" class="control-label">{{ __('Action URL') }}</label>
                                        <input type="text" name="action_url" id="action_url" class="form-control"
                                            value="{{ $notification['action_url'] ?? '' }}" placeholder="Redirect action URL">
                                    </div>
                                </div>

                                {{-- Status --}}
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="status" class="control-label">{{ __('Status') }}</label>
                                        <select name="status" id="status" class="form-control">
                                            <option value="" selected>Select</option>
                                            <option value="1" @selected(($notification->status ?? '') == 1)>Active</option>
                                            <option value="0" @selected(($notification->status ?? '') == 0)>Inactive</option>
                                        </select>

                                    </div>
                                </div>
                            </div>

                            {{-- Buttons --}}
                            <div class="row align-items-center justify-content-center">
                                <div class="align-self-center col-md-2">
                                    <button type="submit" id="submit" class="btn btn-block btn-success my-1">
                                        <i class="fa fa-bell"></i>&nbsp;
                                        <span>{{ $notification ? 'UPDATE NOTIFICATION' : 'ADD NEW '}}</span>
                                    </button>
                                </div>

                                <div class="align-self-center col-md-2">
                                    <a href="{{ url('admin/push-notifications') }}" class="btn btn-block btn-outline-info my-1">
                                        <i class="fa fa-refresh fa-lg"></i>&nbsp;
                                        <span>{{ __('Reset') }}</span>
                                    </a>
                                </div>
                            </div>
                        </form>

                        <hr>

                        <table id="dataTable" class="table table-striped table-hover w-100">
                            <thead class="thead-dark">
                                <tr>
                                    <th>{{ __('ID') }}</th>
                                    <th>Banner Image</th>
                                    <th>{{ __('Notification Title') }}</th>
                                    <th>{{ __('Message') }}</th>
                                    <th>{{ __('Action Url') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($notifications as $notifi)
                                <tr>
                                    <td>{{ @$notifi->id }}</td>
                                    <td>
                                        <img src="{{ @$notifi->drive->file }}" width="100" height="100" alt="">
                                    </td>
                                    <td>{{ ucwords(@$notifi->title) }}</td>
                                    <td>{{ @$notifi->message }}</td>

                                    <td>{{ @$notifi->action_url }} </td>

                                    <td>{{ @$notifi->status == '1' ? 'Active' : 'Inactive'}}</td>
                                    <td>
                                        <a href="{{ route('admin.push-notifications.edit',['push_notification' => @$notifi->id] ) }}" title="Edit"
                                            class="btn btn-xs btn-outline-info py-0 mx-1">
                                            <i class="fa fa-pencil-square-o"></i>
                                        </a>
                                        <a onClick="if (confirm('Are you sure?')) return this.nextElementSibling.submit();"
                                            href="javascript:;" title="Delete" class="btn btn-xs btn-outline-danger py-0 mx-1">
                                            <i class="fa fa-trash-o"></i>
                                        </a>
                                        <form action="{{ url('admin/push-notifications/' . $notifi->id) }}" method="POST" class="d-none">
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
                    targets: [0, 6], // column index
                    orderable: false,
                },
                {
                    targets: [0, 6], // column index
                    searchable: false,
                },
                {
                    targets: [0], // column index
                    visible: true,
                }
            ],
            // dom: 'lBfrtip',
            dom: '<"row"<"col-sm-3"l><"col-sm-4"B><"col-sm-5"f>>' +
                '<"row"<"col-sm-12"tr>>' +
                '<"row"<"col-sm-5"i><"col-sm-7"p>>',
            buttons: [{
                    extend: 'csv',
                    text: 'CSV',
                    filename: 'cabs',
                    className: 'btn btn-xs btn-dark py-1',
                    exportOptions: {
                        columns: ':visible:not(:last-child)'
                    }
                },
                {
                    extend: 'excel',
                    text: 'Excel',
                    filename: 'cabs',
                    className: 'btn btn-xs btn-dark py-1',
                    exportOptions: {
                        columns: ':visible:not(:last-child)'
                    }
                },
                {
                    extend: 'pdf',
                    text: 'PDF',
                    filename: 'cabs',
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