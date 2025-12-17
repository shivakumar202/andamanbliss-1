@extends('admin.layouts.app')

@section('title', __('Tag Manager Pages'))

@section('content')
<!-- Heading -->
<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Tag Pages Manager</h1>
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="{{ url('admin/home') }}">{{ __('Dashboard') }}</a></li>
                            <li><a href="{{ url('admin/tag-manager') }}">{{ __('Tags') }}</a></li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="col-sm-2">
                <a href="" class="btn btn-info float-right my-2 mx-3">
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
                            {{ __('Tags Pages') }}
                        </strong>
                    </div>

                    <div class="card-body">
                        <form name="form" @if (@$page) action="{{ route('admin.tag-manager.pages.update' , [@$page->id]) }}"
                            @else action="{{ url('admin/tag-manager/pages') }}" @endif method="POST" id="form"
                            class="" enctype="multipart/form-data" novalidate="novalidate" autocom plete="off">
                            @csrf
                            @if (@$page)
                            @method('PUT')
                            @endif
                            <div class="row justify-content-center">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="title" class="control-label">
                                            {{ __('Page Title') }}
                                            <span style="color:red;">*</span>
                                        </label>
                                        <input type="text" name="title" placeholder="{{ __('Page Title') }}"
                                            value="{{ old('title', @$page->title) }}" id="title"
                                            class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" autocomplete="off"
                                            autofocus />
                                        @if ($errors->has('title'))
                                        <label class="error">{{ $errors->first('title') }}</label>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="page_url" class="control-label">
                                            {{ __('Page Link') }}
                                            <span style="color:red;">*</span>
                                            <span class="text-muted" style="font-size: smaller;">https://andamanbliss.com/*</span>
                                        </label>
                                        <input name="page_url" placeholder="{{ __('Page Link') }}" id="page_url"
                                            class="form-control {{ $errors->has('page_url') ? 'is-invalid' : '' }}" value="{!! old('page_url', @$page->page_url) !!}" required autocomplete="off"
                                            autofocus />
                                        @if ($errors->has('page_url'))
                                        <label class="error">{{ $errors->first('page_url') }}</label>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row align-items-center justify-content-center">
                                <div class="align-self-center col-md-2">
                                    <button type="submit" name="submit" id="submit" class="btn btn-block btn-success my-1">
                                        <i class="fa fa-floppy-o fa-lg"></i>&nbsp;
                                        <span>{{ __('Save') }}</span>
                                    </button>
                                </div>

                                <div class="align-self-center col-md-2">
                                    <a href="{{ url('admin/tag-manager/pages') }}" id="reset"
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
                                    <th>{{ __('Page Title') }}</th>
                                    <th>{{ __('Page Url') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($pages as $key => $page)
                                <tr>
                                    <td>{{ @$page->id }}</td>
                                    <td>{{ ucwords(@$page->title) }}</td>
                                    <td>{!! $page->page_url !!}</td>
                                    <td>
                                        <a href="{{ route('admin.tag-manager.pages.tags',['id' => @$page->id]) }}" title="Page Tags" class="btn btn-xs btn-outline-success py-0 mx-1">
                                            <i class="fa fa-tag"></i> Page Tags
                                        </a>
                                        <a href="{{ route('admin.tag-manager.pages.edit' , [@$page->id]) }}" title="Edit"
                                            class="btn btn-xs btn-outline-info py-0 mx-1">
                                            <i class="fa fa-pencil-square-o"></i>
                                        </a>
                                        <a onClick="if (confirm('Are you sure?')) return this.nextElementSibling.submit();"
                                            href="javascript:;" title="Delete" class="btn btn-xs btn-outline-danger py-0 mx-1">
                                            <i class="fa fa-trash-o"></i>
                                        </a>
                                        <form action="{{ route('admin.tag-manager.pages.destroy', [@$page->id]) }}" method="post"
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
    td{
        border: 1px solid #e2e2e2ff;
    }
    td:hover{
        border: 1px solid #ffff;
    }
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
                    targets: [0, 3], // column index
                    orderable: false,
                },
                {
                    targets: [0, 3], // column index
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
                    filename: 'tour_tags',
                    className: 'btn btn-xs btn-dark py-1',
                    exportOptions: {
                        columns: ':visible:not(:last-child)'
                    }
                },
                {
                    extend: 'excel',
                    text: 'Excel',
                    filename: 'tour_tags',
                    className: 'btn btn-xs btn-dark py-1',
                    exportOptions: {
                        columns: ':visible:not(:last-child)'
                    }
                },
                {
                    extend: 'pdf',
                    text: 'PDF',
                    filename: 'tour_tags',
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