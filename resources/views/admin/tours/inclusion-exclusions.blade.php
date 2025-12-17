@extends('admin.layouts.app')

@section('title', __('Manage Inclusions & Exclusions'))

@section('content')
<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>{{ __('Manage Inclusions & Exclusions') }}</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="{{ url('admin/home') }}">{{ __('Dashboard') }}</a></li>
                            <li><a href="{{ url('admin/tours') }}">{{ __('Tour')
                                    }}</a></li>
                            <li class="active">{{ __('Inclusions & Exclusions') }}</li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="col-sm-2">
                <a href="{{ url('admin/tours/' . $tour->id) }}" class="btn btn-info float-right my-2 mx-3">
                    <i class="fa fa-undo fa-lg"></i> 
                    {{ __('Back') }}
                </a>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <div class="animated fadeIn">
        @include('admin.layouts.alert')
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">
                            {{ __('Inclusion Exclusion') }}
                        </strong>
                    </div>

                    <div class="card-body">
                        <form id="inclusion-exclusion-form" @if (@$inclusion)
                            action="{{ url('admin/tours/' . request('tourId') . '/inclusion-exclusions/' . @$inclusion->id) }}"
                            @else action="{{ url('admin/tours/' . request('tourId') . '/inclusion-exclusions') }}"
                            @endif method="POST" id="form" class="" enctype="multipart/form-data"
                            novalidate="novalidate" autocomplete="off">
                            @csrf
                            <div class="row justify-content-center">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="type">Type <span class="text-danger">*</span></label>
                                        <select name="type" id="type" class="form-control" required>
                                            <option value="">{{ __('Select Type') }}</option>
                                            <option value="inclusion" @selected(old('type', $inclusion->type ?? '') ==
                                                'inclusion')>{{ __('Inclusion') }}</option>
                                            <option value="exclusion" @selected(old('type', $inclusion->type ?? '') ==
                                                'exclusion')>{{ __('Exclusion') }}</option>
                                        </select>
                                        @error('type')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                 <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="icon">Icon <span class="text-danger">*</span></label>
                                        <input name="icon" id="icon" class="form-control" value="{{ old('icon', $inclusion->icon ?? '') }}" placeholder="fa-icons"
                                            required>
                                        @error('icon')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="description">Inclusion / Exclusion<span class="text-danger">*</span></label>
                                        <input name="description" id="description" class="form-control" value="{{ old('description', $inclusion->description ?? '') }}"
                                            required>
                                        @error('description')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                            <div class="row align-items-center justify-content-center">
                                <div class="align-self-center col-md-2">
                                    <button type="submit" name="submit" id="submit"
                                        class="btn btn-block btn-success my-1">
                                        <i class="fa fa-floppy-o fa-lg"></i>&nbsp;
                                        <span>{{ __('Save') }}</span>
                                    </button>
                                </div>

                                <div class="align-self-center col-md-2">
                                    <a href="{{ url('admin/tours/' . request('tourId') . '/inclusion-exclusions') }}"
                                        id="reset" class="btn btn-block btn-outline-danger my-1">
                                        <i class="fa fa-refresh fa-lg"></i>&nbsp;
                                        <span>{{ __('Reset') }}</span>
                                    </a>
                                </div>
                            </div>
                        </form>

                        <hr class="my-2">
                    @include('admin.tours.navigation');
                        <hr class="my-3">
                        <div class="row d-flex flex-wrap">
<div class="col-12 col-md-6">
                        <table id="dataTable" class="table table-striped table-hover w-100">

                            <thead class="bg-success">
                                <tr>
                                    <th>{{ __('ID') }}</th>
                                    <th>{{ __('Type') }}</th>
                                    <th>{{ __('Description') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($inclusions->where('type','inclusion') as $item)
                                <tr data-id="{{ $item->id }}" data-type="{{ $item->type }}"
                                    data-description="{{ $item->description }}">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ ucfirst($item->type) }}</td>
                                    <td>{{ $item->description }}</td>
                                    <td>
                                        <a href="{{ url('admin/tours/' . request('tourId') . '/inclusion-exclusions/' . @$item->id) }}"
                                            title="Edit" class="btn btn-xs btn-outline-info py-0 mx-1">
                                            <i class="fa fa-pencil-square-o"></i>
                                        </a>
                                        <a onClick="if (confirm('Are you sure?')) return this.nextElementSibling.submit();"
                                            href="javascript:;" title="Delete"
                                            class="btn btn-xs btn-outline-danger py-0 mx-1">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                        <form
                                            action="{{ url('admin/tours/' . request('tourId') . '/inclusion-exclusions/' . @$item->id) }}"
                                            method="POST" class="d-none">
                                            @method('DELETE')
                                            @csrf
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
</div>
<div class="col-12 col-md-6">
                        <table id="dataTable" class="table table-striped table-hover w-100">

                            <thead class="bg-danger">
                                <tr>
                                    <th>{{ __('ID') }}</th>
                                    <th>{{ __('Type') }}</th>
                                    <th>{{ __('Description') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($inclusions->where('type','exclusion') as $item)
                                <tr data-id="{{ $item->id }}" data-type="{{ $item->type }}"
                                    data-description="{{ $item->description }}">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ ucfirst($item->type) }}</td>
                                    <td>{{ $item->description }}</td>
                                    <td>
                                        <a href="{{ url('admin/tours/' . request('tourId') . '/inclusion-exclusions/' . @$item->id) }}"
                                            title="Edit" class="btn btn-xs btn-outline-info py-0 mx-1">
                                            <i class="fa fa-pencil-square-o"></i>
                                        </a>
                                        <a onClick="if (confirm('Are you sure?')) return this.nextElementSibling.submit();"
                                            href="javascript:;" title="Delete"
                                            class="btn btn-xs btn-outline-danger py-0 mx-1">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                        <form
                                            action="{{ url('admin/tours/' . request('tourId') . '/inclusion-exclusions/' . @$item->id) }}"
                                            method="POST" class="d-none">
                                            @method('DELETE')
                                            @csrf
                                        </form>
                                    </td>
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
    </div>
</div>
@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto&display=swap">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css">
<style>
    .form-control {
        font-family: Roboto, Arial, sans-serif;
        font-size: 16px;
        color: #333333;
        background-color: #F5F5F5;
    }
</style>
@endpush
@push('scripts')

<script>
    $(document).ready(function() {


        $('#inclusion-exclusions-table').DataTable({
            responsive: true,
            lengthMenu: [[10, 50, 100, -1], [10, 50, 100, 'All']],
            pageLength: 10,
            aaSorting: [0, 'DESC'],
            columnDefs: [
                {
                    targets: [0, 3], // ID and Action columns
                    orderable: false,
                },
                {
                    targets: [0, 3], // ID and Action columns
                    searchable: false,
                },
                {
                    targets: [0], // ID column
                    visible: false,
                }
            ],
            dom: '<"row"<"col-sm-3"l><"col-sm-4"B><"col-sm-5"f>>' +
                 '<"row"<"col-sm-12"tr>>' +
                 '<"row"<"col-sm-5"i><"col-sm-7"p>>',
            buttons: [
                {
                    extend: 'csv',
                    text: 'CSV',
                    filename: 'inclusion-exclusions',
                    className: 'btn btn-xs btn-dark py-1',
                    exportOptions: {
                        columns: ':visible:not(:last-child)'
                    }
                },
                {
                    extend: 'excel',
                    text: 'Excel',
                    filename: 'inclusion-exclusions',
                    className: 'btn btn-xs btn-dark py-1',
                    exportOptions: {
                        columns: ':visible:not(:last-child)'
                    }
                },
                {
                    extend: 'pdf',
                    text: 'PDF',
                    filename: 'inclusion-exclusions',
                    className: 'btn btn-xs btn-dark py-1',
                    exportOptions: {
                        columns: ':visible:not(:last-child)'
                    }
                }
            ]
        });

    });
</script>
@endpush
@endSection