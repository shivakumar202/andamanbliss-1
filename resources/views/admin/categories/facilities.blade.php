@extends('admin.layouts.app')

@section('title', ucwords(@$category->name . ': Facility'))

@section('content')
    <!-- Heading -->
    <div class="breadcrumbs">
        <div class="breadcrumbs-inner">
            <div class="row">
                <div class="col-sm-4">
                    <div class="page-header float-left">
                        <div class="page-title">
                            <h1>{{ ucwords(@$category->name) }}</h1>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="page-header float-right">
                        <div class="page-title">
                            <ol class="breadcrumb text-right">
                                <li><a href="{{ url('admin/home') }}">{{ __('Dashboard') }}</a></li>
                                <li><a href="{{ url('admin/categories') }}">{{ __('Category') }}</a></li>
                                <li class="active">{{ __('Facility') }}</li>
                            </ol>
                        </div>
                    </div>
                </div>

                <div class="col-sm-2">
                    <a href="{{ url('admin/categories/' . request('categoryId')) }}"
                        class="btn btn-info float-right my-2 mx-3">
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
                                {{ __('Facility') }}
                            </strong>
                        </div>

                        <div class="card-body">
                            <form name="form"
                                @if (@$facility) action="{{ url('admin/categories/' . request('categoryId') . '/facilities/' . @$facility->id) }}"
                            @else action="{{ url('admin/categories/' . request('categoryId') . '/facilities') }}" @endif
                                method="POST" id="form" class="" enctype="multipart/form-data"
                                novalidate="novalidate" autocomplete="off">
                                @csrf
                                <div class="row justify-content-center">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="badge" class="control-label">
                                                {{ __('Badge (Common)') }}
                                            </label>
                                            <input type="text" name="title" placeholder="{{ __('Badge') }}"
                                                value="{{ $facilities[0]['title'] ?? '' }}"
                                                class="form-control rounded-0 {{ $errors->has('title') ? 'is-invalid' : '' }}" />
                                            @if ($errors->has('title'))
                                                <label class="error">{{ $errors->first('title') }}</label>
                                            @endif

                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="title" class="control-label">
                                                {{ __('Title (Common) use | For color Seperation') }}
                                            </label>
                                            <input type="text" name="sub_title" placeholder="{{ __('Title') }}"
                                                value="{{ $facilities[0]['sub_title'] ?? '' }}"
                                                class="form-control rounded-0 {{ $errors->has('sub_title') ? 'is-invalid' : '' }}" />
                                            @if ($errors->has('sub_title'))
                                                <label class="error">{{ $errors->first('sub_title') }}</label>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="title_description" class="control-label">
                                                {{ __('Title Description (Common)') }}
                                            </label>
                                            <input type="text" name="title_description"
                                                placeholder="{{ __('Title Description') }}"
                                                value="{{ $facilities[0]['bottom_title'] ?? '' }}"
                                                class="form-control rounded-0 {{ $errors->has('title_description') ? 'is-invalid' : '' }}" />
                                            @if ($errors->has('title_description'))
                                                <label class="error">{{ $errors->first('title_description') }}</label>
                                            @endif

                                        </div>
                                    </div>



                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="icon" class="control-label">
                                                {{ __('Icon') }}
                                                <span style="color:red;">*</span>
                                            </label>
                                            <input type="text" name="icon"
                                                placeholder="{{ __('<i class=" fa fa-pencil"
                                                                                            aria-hidden="true"></i>') }}"
                                                value="{{ old('icon', @$facility->icon) }}" id="icon"
                                                class="form-control {{ $errors->has('icon') ? 'is-invalid' : '' }}"
                                                autocomplete="off" autofocus />
                                            @if ($errors->has('icon'))
                                                <label class="error">{{ $errors->first('icon') }}</label>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="name" class="control-label">
                                                {{ __('Title') }}
                                                <span style="color:red;">*</span>
                                            </label>
                                            <input type="text" name="name" placeholder="{{ __('Title') }}"
                                                value="{{ old('name', @$facility->name) }}" id="name"
                                                class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                autocomplete="off" autofocus />
                                            @if ($errors->has('name'))
                                                <label class="error">{{ $errors->first('name') }}</label>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="description" class="control-label">
                                                {{ __('Description') }}
                                            </label>
                                            <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description"
                                                id="description" placeholder="{{ __('Description') }}" cols="30" rows="3" autocomplete="off">{{ old('description', @$facility->value) }}</textarea>
                                            @if ($errors->has('description'))
                                                <label class="error">{{ $errors->first('description') }}</label>
                                            @endif
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
                                        <a href="{{ url('admin/categories/' . request('categoryId') . '/facilities') }}"
                                            id="reset" class="btn btn-block btn-outline-danger my-1">
                                            <i class="fa fa-refresh fa-lg"></i>&nbsp;
                                            <span>{{ __('Reset') }}</span>
                                        </a>
                                    </div>
                                </div>
                            </form>
                            <div class="row align-items-center justify-content-center">
                                <div class="align-self-center col-md-2">
                                    <a href="{{ url('admin/categories/' . @$category->id . '/images') }}"
                                        class="btn btn-block btn-outline-info my-1">
                                        <i class="fa fa-pencil-square-o fa-lg"></i>&nbsp;
                                        <span>{{ __('Images') }}</span>
                                    </a>
                                </div>

                                <div class="align-self-center col-md-2">
                                    <a href="{{ url('admin/categories/' . @$category->id . '/facilities') }}"
                                        class="btn btn-block btn-info my-1">
                                        <i class="fa fa-pencil-square-o fa-lg"></i>&nbsp;
                                        <span>{{ __('Facilities') }}</span>
                                    </a>
                                </div>

                                <div class="align-self-center col-md-2">
                                    <a href="{{ url('admin/categories/' . @$category->id . '/faqs') }}"
                                        class="btn btn-block btn-outline-info my-1">
                                        <i class="fa fa-pencil-square-o fa-lg"></i>&nbsp;
                                        <span>{{ __('Faqs') }}</span>
                                    </a>
                                </div>
                                <div class="align-self-center col-md-2">
                                    <a href="{{ url('admin/categories/' . @$category->id . '/meta-headings') }}"
                                        class="btn btn-block btn-outline-info my-1">
                                        <i class="fa fa-pencil-square-o fa-lg"></i>&nbsp;
                                        <span>{{ __('Meta Information') }}</span>
                                    </a>
                                </div>
                                <div class="align-self-center col-md-2">
                                    <a href="{{ url('admin/categories/' . @$category->id . '/reviews') }}"
                                        class="btn btn-block btn-outline-info my-1">
                                        <i class="fa fa-pencil-square-o fa-lg"></i>&nbsp;
                                        <span>{{ __('Reviews') }}</span>
                                    </a>
                                </div>
                                 <div class="align-self-center col-md-2">
                                    <a href="{{ url('admin/categories/' . @$category->id . '/content-section') }}"
                                        class="btn btn-block btn-outline-info my-1">
                                        <i class="fa fa-pencil-square-o fa-lg"></i>&nbsp;
                                        <span>{{ __('Content Section') }}</span>
                                    </a>
                                </div>

                                <div class="align-self-center col-md-2">
                                    <a href="{{ url('admin/categories/' . @$category->id . '/edit') }}"
                                        class="btn btn-block btn-outline-info my-1">
                                        <i class="fa fa-pencil-square-o fa-lg"></i>&nbsp;
                                        <span>{{ __('Edit') }}</span>
                                    </a>
                                </div>
                            </div>
                            <hr class="my-3">
                            <table id="dataTable" class="table table-striped table-hover w-100">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>{{ __('ID') }}</th>
                                        <th>{{ __('Icon') }}</th>
                                        <th>{{ __('Title') }}</th>
                                        <th>{{ __('Description') }}</th>
                                        <th>{{ __('Action') }}</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($facilities as $key => $facility)
                                        <tr>
                                            <td>{{ @$facility->id }}</td>
                                            <td>{!! @$facility->icon !!}</td>
                                            <td>{{ ucwords(@$facility->name) }}</td>
                                            <td>{{ ucwords(@$facility->description) }}</td>
                                            <td>
                                                <a href="{{ url('admin/categories/' . request('categoryId') . '/facilities/' . @$facility->id) }}"
                                                    title="Edit" class="btn btn-xs btn-outline-info py-0 mx-1">
                                                    <i class="fa fa-pencil-square-o"></i>
                                                </a>
                                                <a onClick="if (confirm('Are you sure?')) return this.nextElementSibling.submit();"
                                                    href="javascript:;" title="Delete"
                                                    class="btn btn-xs btn-outline-danger py-0 mx-1">
                                                    <i class="fa fa-trash-o"></i>
                                                </a>
                                                <form
                                                    action="{{ url('admin/categories/' . request('categoryId') . '/facilities/' . @$facility->id) }}"
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
                        filename: 'category_facilities',
                        className: 'btn btn-xs btn-dark py-1',
                        exportOptions: {
                            columns: ':visible:not(:last-child)'
                        }
                    },
                    {
                        extend: 'excel',
                        text: 'Excel',
                        filename: 'category_facilities',
                        className: 'btn btn-xs btn-dark py-1',
                        exportOptions: {
                            columns: ':visible:not(:last-child)'
                        }
                    },
                    {
                        extend: 'pdf',
                        text: 'PDF',
                        filename: 'category_facilities',
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
