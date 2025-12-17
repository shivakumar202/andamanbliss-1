@extends('admin.layouts.app')

@section('title', __('Tag Manager'))

@section('content')
<!-- Heading -->
<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Tag Manager</h1>
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
                            {{ __('Tags') }}
                        </strong>
                    </div>

                    <div class="card-body">
                        <form name="form" @if (@$tag) action="{{ route('admin.tag-manager.update' , [@$tag->id]) }}"
                            @else action="{{ url('admin/tag-manager') }}" @endif method="POST" id="form"
                            class="" enctype="multipart/form-data" novalidate="novalidate" autocom plete="off">
                            @csrf


                            @if (@$tag)
                            @method('PUT')
                            @endif
                            <div class="row justify-content-center">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="tag" class="control-label">
                                            {{ __('Tag Name') }}
                                            <span style="color:red;">*</span>
                                        </label>
                                        <input type="text" name="tag" placeholder="{{ __('Tag Name') }}"
                                            value="{{ old('tag', @$tag->tag) }}" id="tag"
                                            class="form-control {{ $errors->has('tag') ? 'is-invalid' : '' }}" autocomplete="off"
                                            autofocus />
                                        @if ($errors->has('tag'))
                                        <label class="error">{{ $errors->first('tag') }}</label>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="link" class="control-label">
                                            {{ __('Redirect Link') }}
                                            <span style="color:red;">*</span>
                                        </label>
                                        <textarea name="link" placeholder="{{ __('Redirect Link') }}" id="link"
                                            class="form-control {{ $errors->has('link') ? 'is-invalid' : '' }}" required autocomplete="off"
                                            autofocus>{!! old('link', @$tag->link) !!}</textarea>
                                        @if ($errors->has('link'))
                                        <label class="error">{{ $errors->first('link') }}</label>
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
                                    <a href="{{ url('admin/tag-manager') }}" id="reset"
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
                                    <th>{{ __('Tag') }}</th>
                                    <th>{{ __('Redirect Link') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($tags as $key => $tag)
                                <tr>
                                    <td>{{ @$tag->id }}</td>
                                    <td>{{ ucwords(@$tag->tag) }}</td>
                                    <td>{!! $tag->link !!}</td>
                                    <td>
                                        <a href="{{ route('admin.tag-manager.edit' , [@$tag->id]) }}" title="Edit"
                                            class="btn btn-xs btn-outline-info py-0 mx-1">
                                            <i class="fa fa-pencil-square-o"></i>
                                        </a>
                                        <a onClick="if (confirm('Are you sure?')) return this.nextElementSibling.submit();"
                                            href="javascript:;" title="Delete" class="btn btn-xs btn-outline-danger py-0 mx-1">
                                            <i class="fa fa-trash-o"></i>
                                        </a>
                                        <form action="{{ route('admin.tag-manager.destroy', [@$tag->id]) }}" method="post"
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