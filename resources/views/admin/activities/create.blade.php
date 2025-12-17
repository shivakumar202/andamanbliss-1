@extends('admin.layouts.app')

@section('title', __('Activity'))

@section('content')
    <!-- Heading -->
    <div class="breadcrumbs">
        <div class="breadcrumbs-inner">
            <div class="row">
                <div class="col-sm-4">
                    <div class="page-header float-left">
                        <div class="page-title">
                            <h1>{{ __('Activity') }}</h1>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="page-header float-right">
                        <div class="page-title">
                            <ol class="breadcrumb text-right">
                                <li><a href="{{ url('admin/home') }}">{{ __('Dashboard') }}</a></li>
                                <li><a href="{{ url('admin/activities') }}">{{ __('Activity') }}</a></li>
                                @if (@$activity)
                                    <li class="active">{{ __('Edit') }}</li>
                                @else
                                    <li class="active">{{ __('New') }}</li>
                                @endif
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
                    <form name="form"
                        @if (@$activity) action="{{ url('admin/activities/' . @$activity->id) }}" @else
          action="{{ url('admin/activities') }}" @endif
                        method="POST" id="form" class="card" enctype="multipart/form-data" novalidate="novalidate"
                        autocomplete="off">
                        @csrf
                        @if (@$activity)
                            @method('PUT')
                        @endif
                        <div class="card-header">
                            <strong class="card-title">
                                @if (@$activity)
                                    {{ __('Edit') }}
                                @else
                                    {{ __('New') }}
                                @endif
                            </strong>
                        </div>

                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name" class="control-label">
                                            {{ __('Name') }}
                                            <span style="color:red;">*</span>
                                        </label>
                                        <input type="text" name="name" placeholder="{{ __('Name') }}"
                                            value="{{ old('service_name', @$activity->service_name) }}" id="name"
                                            class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                            autocomplete="off" required autofocus />
                                        @if ($errors->has('name'))
                                            <label class="error">{{ $errors->first('name') }}</label>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="category_id" class="control-label">
                                            {{ __('Category') }}
                                            <span style="color:red;">*</span>
                                        </label>
                                        <select name="category_id" id="category_id" required
                                            class="form-control {{ $errors->has('category_id') ? 'is-invalid' : '' }}">
                                            <option value="">{{ __('Select') }}</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}" @selected(old('category_id', @$activity->category_id) == $category->id)>
                                                    {{ ucwords($category->name) }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('category_id'))
                                            <label class="error">{{ $errors->first('category_id') }}</label>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="featured" class="control-label">
                                            {{ __('Featured') }}
                                            <span style="color:red;"></span>
                                        </label>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" name="featured" value="1" id="featured"
                                                class="custom-control-input {{ $errors->has('featured') ? 'is-invalid' : '' }}"
                                                @checked(old('featured', @$activity->featured) == 1) />
                                            <label class="custom-control-label" for="featured">{{ __('Yes') }}</label>
                                        </div>
                                        @if ($errors->has('featured'))
                                            <label class="error">{{ $errors->first('featured') }}</label>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="best_seller" class="control-label">
                                            {{ __('Best Seller') }}
                                            <span style="color:red;"></span>
                                        </label>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" name="best_seller" value="1" id="best_seller"
                                                class="custom-control-input {{ $errors->has('best_seller') ? 'is-invalid' : '' }}"
                                                @checked(old('best_seller', @$activity->best_seller) == 1) />
                                            <label class="custom-control-label"
                                                for="best_seller">{{ __('Yes') }}</label>
                                        </div>
                                        @if ($errors->has('best_seller'))
                                            <label class="error">{{ $errors->first('best_seller') }}</label>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="slug" class="control-label">Slug</label>
                                        <input type="text" name="slug" id="slug"
                                            value="{{ old('slug', @$activity->slug) }}" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group"><label for="url" class="control-label">Dynamic Page
                                            Url</label>
                                        <input type="text" name="url"  placeholder="/page-url"
                                            value="{{ old('url', @$activity->url) }}" id="url"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="title" class="control-label">Heading Title <span
                                                style="color:red;">*</span></label>
                                        <input type="text" name="title" id="title"
                                            value="{{ old('title', @$activity->title) }}"
                                            class="form-control {{ $errors->has('title') }}" placeholder="Title">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="description" class="control-label">
                                            {{ __('Description') }}
                                            <span style="color:red;">*</span>
                                        </label>
                                        <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description"
                                            id="description" placeholder="{{ __('Description') }}" cols="30" autocomplete="off" autofocus
                                            rows="5">{{ old('description', @$activity->description) }}</textarea>
                                        @if ($errors->has('description'))
                                            <label class="error">{{ $errors->first('description') }}</label>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="video_url" class="control-label">Video URL <span
                                                style="color:red;">*</span></label>
                                        <input type="text" name="video_url" id="video_url"
                                            value="{{ old('video_url', @$activity->video_url) }}"
                                            class="form-control {{ $errors->has('video_url') }}" placeholder="Video Url (Google Drive, Youtube , Website)">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="add_ons" class="control-label">
                                            {{ __('Addons') }}
                                            <span style="color:red;">*</span>
                                        </label>
                                        <select name="add_ons[]" id="mySelect2"
                                            class="form-control {{ $errors->has('add_ons') ? 'is-invalid' : '' }}"
                                            multiple>
                                            @foreach ($addons as $addon)
                                                <option value="{{ $addon->id }}"
                                                    @if (in_array($addon->id, $selectedAddons)) selected @endif>
                                                    {{ $addon->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('add_ons'))
                                            <label class="error">{{ $errors->first('add_ons') }}</label>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="ctc_title" class="control-label">CTC Title <span
                                                style="color:red;">*</span></label>
                                        <input type="text" name="ctc_title" id="ctc_title"
                                            value="{{ old('ctc_title', @$activity->ctc_title) }}"
                                            class="form-control {{ $errors->has('ctc_title') }}" placeholder="CTC Title">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="ctc_desc" class="control-label">
                                            {{ __('CTC Description') }}
                                            <span style="color:red;">*</span>
                                        </label>
                                        <textarea class="form-control {{ $errors->has('ctc_desc') ? 'is-invalid' : '' }}" name="ctc_desc" id="ctc_desc"
                                            placeholder="{{ __('CTC Description') }}" cols="30" autocomplete="off" autofocus rows="3">{{ old('ctc_desc', @$activity->ctc_desc) }}</textarea>
                                        @if ($errors->has('ctc_desc'))
                                            <label class="error">{{ $errors->first('ctc_desc') }}</label>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="adult_cost" class="control-label">
                                            {{ __('Adult Cost (Starting From)') }}
                                            <span style="color:red;">*</span>
                                        </label>
                                        <input type="number" min="0" name="adult_cost"
                                            placeholder="{{ __('Adult Cost') }}"
                                            value="{{ old('adult_cost', @$activity->adult_cost) }}" id="adult_cost"
                                            class="form-control {{ $errors->has('adult_cost') ? 'is-invalid' : '' }}"
                                            required autocomplete="off" autofocus />
                                        @if ($errors->has('adult_cost'))
                                            <label class="error">{{ $errors->first('adult_cost') }}</label>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="child_cost" class="control-label">
                                            {{ __('Child Cost') }}
                                            <span style="color:red;">*</span>
                                        </label>
                                        <input type="number" min="0" name="child_cost"
                                            placeholder="{{ __('Child Cost') }}"
                                            value="{{ old('child_cost', @$activity->child_cost) }}" id="child_cost"
                                            class="form-control {{ $errors->has('child_cost') ? 'is-invalid' : '' }}"
                                            required autocomplete="off" autofocus />
                                        @if ($errors->has('child_cost'))
                                            <label class="error">{{ $errors->first('child_cost') }}</label>
                                        @endif
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="discount" class="control-label">
                                            {{ __('Discount in (%)') }}
                                            <span style="color:red;">*</span>
                                        </label>
                                        <input type="number" min="0" name="discount"
                                            placeholder="{{ __('Discount') }}"
                                            value="{{ old('discount', @$activity->discount) }}" id="discount"
                                            class="form-control {{ $errors->has('discount') ? 'is-invalid' : '' }}"
                                            required autocomplete="off" autofocus />
                                        @if ($errors->has('discount'))
                                            <label class="error">{{ $errors->first('discount') }}</label>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="duration" class="control-label">
                                            {{ __('Duration') }}
                                            <span style="color:red;">*</span>
                                        </label>
                                        <input type="text" name="duration"
                                            placeholder="{{ __('Activity Duration') }}"
                                            value="{{ old('duration', @$activity->duration) }}" id="duration"
                                            class="form-control {{ $errors->has('duration') ? 'is-invalid' : '' }}"
                                            required autocomplete="on" autofocus />
                                        @if ($errors->has('duration'))
                                            <label class="error">{{ $errors->first('duration') }}</label>
                                        @endif
                                    </div>
                                </div>



                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="ratings" class="control-label">
                                            {{ __('Ratings') }}
                                            <span style="color:red;">*</span>
                                        </label>
                                        <input type="number" min="1" max="5" name="ratings"
                                            placeholder="{{ __('Ratings') }}"
                                            value="{{ old('rating', @$activity->rating) }}" id="ratings"
                                            class="form-control {{ $errors->has('ratings') ? 'is-invalid' : '' }}"
                                            autocomplete="off" autofocus />
                                        @if ($errors->has('ratings'))
                                            <label class="error">{{ $errors->first('ratings') }}</label>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="location" class="control-label">
                                            {{ __('Location') }}
                                            <span style="color:red;">*</span>
                                        </label>
                                        <input type="text" name="location" placeholder="{{ __('Location') }}"
                                            value="{{ old('location', @$activity->location) }}" id="location"
                                            class="form-control {{ $errors->has('location') ? 'is-invalid' : '' }}"
                                            required autocomplete="off" autofocus />
                                        @if ($errors->has('location'))
                                            <label class="error">{{ $errors->first('location') }}</label>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="has_medical_verification" class="control-label">
                                            {{ __('Has Medical Verification') }}
                                            <span style="color:red;">*</span>
                                        </label>
                                        <select name="has_medical_verification" id="has_medical_verification"
                                            class="form-control {{ $errors->has('has_medical_verification') ? 'is-invalid' : '' }}">
                                            <option value="">{{ __('Select') }}</option>
                                            <option value="1" @selected(old('has_medical_verification', @$activity->has_medical_verification) == '1')>{{ ucwords('Yes') }}
                                            </option>
                                            <option value="0" @selected(old('has_medical_verification', @$activity->has_medical_verification) == '0')>
                                                {{ ucwords('No') }}</option>
                                        </select>
                                        @if ($errors->has('has_medical_verification'))
                                            <label class="error">{{ $errors->first('has_medical_verification') }}</label>
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
                                            <option value="1" @selected(old('status', @$activity->status) == '1')>{{ ucwords('active') }}
                                            </option>
                                            <option value="0" @selected(old('status', @$activity->status) == '0')>
                                                {{ ucwords('In active') }}</option>
                                        </select>
                                        @if ($errors->has('status'))
                                            <label class="error">{{ $errors->first('status') }}</label>
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
                        </div>
                    </form><!-- .card -->

                    @if ($activity)
                        <hr>
                        <div class="row align-items-center justify-content-center">
                            <div class="align-self-center col-md-2">
                                <a href="{{ url('admin/activities/' . @$activity->id . '/images') }}"
                                    class="btn btn-block btn-outline-info my-1">
                                    <i class="fa fa-pencil-square-o fa-lg"></i>&nbsp;
                                    <span>{{ __('Images') }}</span>
                                </a>
                            </div>

                            <div class="align-self-center col-md-2">
                                <a href="{{ url('admin/activities/' . @$activity->id . '/facilities') }}"
                                    class="btn btn-block btn-outline-info my-1">
                                    <i class="fa fa-pencil-square-o fa-lg"></i>&nbsp;
                                    <span>{{ __('Facilities') }}</span>
                                </a>
                            </div>

                            <div class="align-self-center col-md-2">
                                <a href="{{ url('admin/activities/' . @$activity->id . '/highlights') }}"
                                    class="btn btn-block btn-outline-info my-1">
                                    <i class="fa fa-pencil-square-o fa-lg"></i>&nbsp;
                                    <span>{{ __('Highlights') }}</span>
                                </a>
                            </div>

                            <div class="align-self-center col-md-2">
                                    <a href="{{ url('admin/activities/' . @$activity->id . '/slots') }}"
                                        class="btn btn-block btn-outline-info my-1">
                                        <i class="fa fa-clock-o fa-lg"></i>&nbsp;
                                        <span>{{ __('Timing Slots') }}</span>
                                    </a>
                                </div>

                            <div class="align-self-center col-md-2">
                                <a href="{{ url('admin/activities/' . @$activity->id . '/faqs') }}"
                                    class="btn btn-block btn-outline-info my-1">
                                    <i class="fa fa-pencil-square-o fa-lg"></i>&nbsp;
                                    <span>{{ __('Faqs') }}</span>
                                </a>
                            </div>

                            <div class="align-self-center col-md-2">
                                <a href="{{ url('admin/activities/' . @$activity->id . '/reviews') }}"
                                    class="btn btn-block btn-outline-info my-1">
                                    <i class="fa fa-pencil-square-o fa-lg"></i>&nbsp;
                                    <span>{{ __('Reviews') }}</span>
                                </a>
                            </div>
                            <div class="align-self-center col-md-2">
                                <a href="{{ url('admin/activities/' . @$activity->id . '/info-blocks') }}"
                                    class="btn btn-block btn-outline-info my-1">
                                    <i class="fa fa-info fa-lg"></i>&nbsp;
                                    <span>{{ __('Info Blocks') }}</span>
                                </a>
                            </div>
                            <div class="align-self-center col-md-2">
                                <a href="{{ url('admin/activities/' . @$activity->id . '/meta-headings') }}"
                                    class="btn btn-block btn-outline-info my-1">
                                    <i class="fa fa-google fa-lg"></i>&nbsp;
                                    <span>{{ __('Meta Headings') }}</span>
                                </a>
                            </div>
                            <div class="align-self-center col-md-2">
                                <a href="{{ url('admin/activities/' . @$activity->id . '/content-blocks') }}"
                                    class="btn btn-block btn-outline-info my-1">
                                    <i class="fa fa-windows fa-lg"></i>&nbsp;
                                    <span>{{ __('Content Block') }}</span>
                                </a>
                            </div>
                            <div class="align-self-center col-md-2">
                                <a href="{{ url('admin/activities/' . @$activity->id . '/day-schedules') }}"
                                    class="btn btn-block btn-outline-info my-1">
                                    <i class="fa fa-calendar fa-lg"></i>&nbsp;
                                    <span>{{ __('Day Schedule') }}</span>
                                </a>
                            </div>
                            <div class="align-self-center col-md-2">
                                <a href="{{ url('admin/activities/' . @$activity->id . '/overview') }}"
                                    class="btn btn-block btn-outline-info my-1">
                                    <i class="fa fa-book fa-lg"></i>&nbsp;
                                    <span>{{ __('Overview') }}</span>
                                </a>
                            </div>
                            <div class="align-self-center col-md-2">
                                <a href="{{ url('admin/activities/' . @$activity->id . '/edit') }}"
                                    class="btn btn-block btn-info my-1">
                                    <i class="fa fa-pencil-square-o fa-lg"></i>&nbsp;
                                    <span>{{ __('Edit') }}</span>
                                </a>
                            </div>
                        </div>
                        <hr>
                    @endif
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
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            height: 50px;
            margin-top: -15px;
        }

        .select2-container--default .select2-selection--single {
            height: 50px;
            padding: 5%;
        }
    </style>
@endsection

@section('script')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#mySelect2').select2({
                placeholder: "Select Addons",
                allowClear: true
            });

            $('#category_id').select2({
                placeholder: "Select Category",
                allowClear: true
            })

            // Auto-generate slug from name
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
        });
    </script>
@endsection
