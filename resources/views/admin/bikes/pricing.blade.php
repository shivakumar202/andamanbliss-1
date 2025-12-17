@extends('admin.layouts.app')

@section('title', __('Bike'))

@section('content')
    <!-- Heading -->
    <div class="breadcrumbs">
        <div class="breadcrumbs-inner">
            <div class="row">
                <div class="col-sm-4">
                    <div class="page-header float-left">
                        <div class="page-title">
                            <h1>{{ __('Bike') }}</h1>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="page-header float-right">
                        <div class="page-title">
                            <ol class="breadcrumb text-right">
                                <li><a href="{{ url('admin/home') }}">{{ __('Dashboard') }}</a></li>
                                <li><a href="{{ url('admin/bikes') }}">{{ __('Bike') }}</a></li>
                                <li><a href="{{ url('admin/bikes/' . $bike->id) }}">{{ __('Details') }}</a></li>
                                <li class="active">{{ __('Pricing') }}</li>
                            </ol>
                        </div>
                    </div>
                </div>

                <div class="col-sm-2">
                    <a href="{{ url('admin/bikes') }}" class="btn btn-info float-right my-2 mx-3">
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
                                {{ __('Bike Pricing') }}
                            </strong>
                        </div>

                        <div class="card-body">
                            <form name="form"
                                @if (@$bike) action="{{ url('admin/bikes/' . request('bikeId') . '/pricing/' . @$bike->id) }}"
                          @else
                          action="{{ url('admin/bikes/' . request('bikeId') . '/pricing') }}" @endif
                                method="POST" id="form" class="" enctype="multipart/form-data"
                                novalidate="novalidate" autocomplete="off">
                                @csrf
                                <div class="row justify-content-center">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name" class="control-label">
                                                {{ __('Name') }}
                                                <span style="color:red;">*</span>
                                            </label>
                                            <span class="form-control">
                                                {{ ucwords(@$bike->name) }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="Location" class="control-label">
                                                {{ __('Location') }}
                                                <span style="color:red;">*</span>
                                            </label>
                                            <select name="location" id="location" class="form-control">
                                                <option value="" selected>Select Location</option>
                                                @php
                                                    $locations = explode('|', $bike->address);
                                                @endphp
                                                @foreach ($locations as $location)
                                                    <option value="{{ __(@$location) }}">{{ __(@$location) }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('location'))
                                                <label class="error">{{ $errors->first('location') }}</label>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="rate" class="control-label">
                                                {{ __('Rate') }}
                                                <span style="color:red;">*</span>
                                            </label>
                                            <input type="number" name="rate" class="form-control" id="rate"
                                                placeholder="0.00">
                                            @if ($errors->has('rate'))
                                                <label class="error">{{ $errors->first('rate') }}</label>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="price" class="control-label">
                                                {{ __('Price') }}
                                                <span style="color:red;">*</span>
                                            </label>
                                            <input type="number" name="price" id="price" placeholder="0.00"
                                                class="form-control">
                                            @if ($errors->has('price'))
                                                <label class="error">{{ $errors->first('price') }}</label>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="fees" class="control-label">
                                                {{ __('Fees') }}
                                                <span style="color:red;">*</span>
                                            </label>
                                            <input type="number" name="fees" id="fees" placeholder="0.00"
                                                class="form-control">
                                            @if ($errors->has('fees'))
                                                <label class="error">{{ $errors->first('fees') }}</label>
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
                                        <button type="reset" name="reset" id="reset"
                                            class="btn btn-block btn-outline-info my-1">
                                            <i class="fa fa-refresh fa-lg"></i>&nbsp;
                                            <span>{{ __('Reset') }}</span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <table id="dataTable" class="table table-striped table-hover w-100">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>{{ __('ID') }}</th>
                                        <th>{{ __('Location') }}</th>
                                        <th>{{ __('Rate') }}</th>
                                        <th>{{ __('Price') }}</th>
                                        <th>{{ __('Fees') }}</th>
                                        <th>{{ __('Action') }}</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($pricing as $key => $price)
                                        <tr>
                                            <td>{{ @$price->id }}</td>
                                            <td>
                                                {{ @$price->location }}
                                            </td>
                                            <td>{{ @$price->rate }}</td>
                                            <td>{{ @$price->price }}</td>
                                            <td>{{ @$price->fees }}</td>
                                            <td>

                                                <a onClick="if (confirm('Are you sure?')) return this.nextElementSibling.submit();"
                                                    href="javascript:;" title="Delete"
                                                    class="btn btn-xs btn-outline-danger py-0 mx-1">
                                                    <i class="fa fa-trash-o"></i>
                                                </a>
                                                <form
                                                    action="{{ url('admin/bikes/' . request('bikeId') . '/pricing/' . @$price->id) }}"
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
        $(document).ready(function() {
            //
        });
    </script>
@endsection
