@extends('admin.layouts.app')

@section('title', __('Boat Trip Locations'))

@section('content')
    <!-- Heading -->
    <div class="breadcrumbs">
        <div class="breadcrumbs-inner">
            <div class="row">
                <div class="col-sm-4">
                    <div class="page-header float-left">
                        <div class="page-title">
                            <h1>Boat Trip Locations</h1>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="page-header float-right">
                        <div class="page-title">
                            <ol class="breadcrumb text-right">
                                <li><a href="{{ url('admin/home') }}">{{ __('Dashboard') }}</a></li>
                                <li><a href="{{ url('admin/boat-locations') }}">{{ __('Boat Trip Locations') }}</a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>

                <div class="col-sm-2">
                    <a href="{{ url('admin/boat-locations') }}" class="btn btn-info float-right my-2 mx-3">
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
                                {{ __('Boat Trip Location') }}
                            </strong>
                        </div>

                        <div class="card-body">
                            <form name="form"
                                @if (@$location) action="{{ url('admin/boat-locations/' . @$location->id) }}"
            @else
            action="{{ url('admin/boat-locations') }}" @endif
                                method="POST" id="form" class="" enctype="multipart/form-data"
                                novalidate="novalidate" autocomplete="off">
                                @csrf

                                <div class="row justify-content-center">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="name" class="control-label">
                                                {{ __('Location Name') }}
                                                <span style="color:red;">*</span>
                                            </label>
                                            <input type="text" name="name" placeholder="{{ __('Name') }}"
                                                value="{{ old('name', @$location->name) }}" id="name"
                                                class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                autocomplete="off" required autofocus />
                                            @if ($errors->has('name'))
                                                <label class="error">{{ $errors->first('name') }}</label>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="page_url" class="control-label">
                                                {{ __('Page URL') }}
                                                <span style="color:red;">*</span>
                                            </label>
                                            <span style="font-size: 10px">andamanabliss.com/boat-trips/..</span>
                                            <input type="text" name="page_url" placeholder="{{ __('Page Url') }}"
                                                value="{{ old('page_url', @$location->page_url) }}" id="url"
                                                class="form-control {{ $errors->has('page_url') ? 'is-invalid' : '' }}"
                                                autocomplete="off" required autofocus />
                                            @if ($errors->has('page_url'))
                                                <label class="error">{{ $errors->first('page_url') }}</label>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="status" class="control-label">
                                                {{ __('Status') }}
                                                <span style="color:red;">*</span>
                                            </label>
                                            <select name="status" id="status"
                                                class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}">
                                                <option value="">{{ __('Select') }}</option>
                                                <option value="1" @selected(old('status', @$location->status) == '1')>{{ ucwords('active') }}
                                                </option>
                                                <option value="0" @selected(old('status', @$location->status) == '0')>
                                                    {{ ucwords('In active') }}</option>
                                            </select>
                                            @if ($errors->has('status'))
                                                <label class="error">{{ $errors->first('status') }}</label>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="page_title" class="control-label">
                                                {{ __('Page Title') }}
                                                <span style="color:red;">*</span>
                                            </label>
                                            <input type="text" name="page_title" placeholder="{{ __('Page Title') }}"
                                                value="{{ old('page_title', @$location->page_title) }}" id="page_title"
                                                class="form-control {{ $errors->has('page_title') ? 'is-invalid' : '' }}"
                                                autocomplete="off" required autofocus />
                                            @if ($errors->has('page_title'))
                                                <label class="error">{{ $errors->first('page_title') }}</label>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="page_desc" class="control-label">
                                                {{ __('Page Description') }}
                                                <span style="color:red;">*</span>
                                            </label>
                                            <input type="text" name="page_desc" placeholder="{{ __('Page Description') }}"
                                                value="{{ old('page_desc', @$location->page_desc) }}" id="page_desc"
                                                class="form-control {{ $errors->has('page_desc') ? 'is-invalid' : '' }}"
                                                autocomplete="off" required autofocus />
                                            @if ($errors->has('page_desc'))
                                                <label class="error">{{ $errors->first('page_desc') }}</label>
                                            @endif
                                        </div>
                                    </div>

                                      
                                </div>

                                <div class="row align-items-center justify-content-center">
                                    <div class="align-self-center col-md-2">
                                        <button type="submit" name="submit" id="submit"
                                            class="btn btn-block btn-info my-1">
                                            <i class="fa fa-floppy-o fa-lg"></i>&nbsp;
                                            <span>{{ __('Save') }}</span>
                                        </button>
                                    </div>

                                    <div class="align-self-center col-md-2">
                                        <a href="{{ url('admin/boat-locations') }}"
                                            id="reset" class="btn btn-block btn-outline-info my-1">
                                            <i class="fa fa-refresh fa-lg"></i>&nbsp;
                                            <span>{{ __('Reset') }}</span>
                                        </a>
                                    </div>
                                </div>
                            </form>
                            @if(isset($locationId))
                            <hr>
                            @include('admin.boat-trips.navigations')
                            @endif
                            <hr>
                            <table id="dataTable" class="table table-striped table-hover w-100">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>{{ __('ID') }}</th>
                                        <th>{{ __('Location Name') }}</th>
                                        <th>{{ __('Page Url') }}</th>
                                        <th>{{ __('Action') }}</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($locations as $key => $location)
                                        <tr>
                                            <td>{{ @$location->id }}</td>
                                            <td>{{ ucwords(@$location->name) }}</td>
                                            <td>{{ ucwords(@$location->page_url) }}</td>
                                            <td>
                                                <a href="{{ url('admin/boat-trips/location/' . Str::slug(@$location->name)) }}"
                                                    title="Trips" class="btn btn-xs btn-outline-primary py-0 mx-1">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <a href="{{ url('admin/boat-locations/' . @$location->id) }}"
                                                    title="Edit" class="btn btn-xs btn-outline-info py-0 mx-1">
                                                    <i class="fa fa-pencil-square-o"></i>
                                                </a>
                                                <a onClick="if (confirm('Are you sure?')) return this.nextElementSibling.submit();"
                                                    href="javascript:;" title="Delete"
                                                    class="btn btn-xs btn-outline-danger py-0 mx-1">
                                                    <i class="fa fa-trash-o"></i>
                                                </a>
                                                <form
                                                    action="{{ url('admin/boat-locations/' . @$location->id) }}"
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
    <script>
          $('#name').on('input', function() {
                let name = $(this).val();
                let slug = name
                    .toLowerCase()
                    .trim()
                    .replace(/[\s\W-]+/g, '-') // Replace spaces & non-word chars with hyphens
                    .replace(/^-+|-+$/g, ''); // Trim leading/trailing hyphens
                $('#slug').val(slug);
                $('#url').val(slug);
            });
    </script>
@endsection
