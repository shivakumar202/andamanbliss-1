@extends('admin.layouts.app')

@section('title', __(@$tour->package_name . ': Meta Information'))

@section('content')
    <div class="breadcrumbs">
        <div class="breadcrumbs-inner">
            <div class="row">
                <div class="col-sm-4">
                    <div class="page-header float-left">
                        <div class="page-title">
                            <h1>{{ ucwords(@$tour->package_name) }}</h1>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="page-header float-right">
                        <div class="page-title">
                            <ol class="breadcrumb text-right">
                                <li><a href="{{ url('admin/home') }}">{{ __('Dashboard') }}</a></li>
                                <li><a href="{{ url('admin/tours') }}">{{ __('Category') }}</a></li>
                                <li class="active">{{ __('Meta Information') }}</li>
                            </ol>
                        </div>
                    </div>
                </div>

                <div class="col-sm-2">
                    <a href="{{ url('admin/tours/' . request('tourId')) }}"
                        class="btn btn-info float-right my-2 mx-3">
                        <i class="fa fa-undo fa-lg"></i>&nbsp;
                        {{ __('Back') }}
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="animated fadeIn">

            @include('admin.layouts.alert')

            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">
                                {{ __('Meta Information') }}
                            </strong>
                        </div>

                        <div class="card-body">
                            <form action="{{ url('admin/tours/' . request('tourId') . '/meta-headings') }}"
                                method="POST" id="metaForm" enctype="multipart/form-data" novalidate autocomplete="off">
                                @csrf

                                <div class="row">
                                    <div class="col-md-12 form-group">
                                        <label for="meta_title">{{ __('Meta Title') }} <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="meta_title" id="meta_title"
                                            class="form-control {{ $errors->has('meta_title') ? 'is-invalid' : '' }}"
                                            value="{{ old('meta_title', @$meta->meta_title) }}" autocomplete="off" />
                                        @if ($errors->has('meta_title'))
                                            <label class="error">{{ $errors->first('meta_title') }}</label>
                                        @endif
                                    </div>

                                    <div class="col-md-12 form-group">
                                        <label for="meta_keywords">{{ __('Meta Keywords') }} <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="meta_keywords" id="meta_keywords"
                                            class="form-control {{ $errors->has('meta_keywords') ? 'is-invalid' : '' }}"
                                            value="{{ old('meta_keywords', @$meta->meta_keywords) }}" autocomplete="off" />
                                        @if ($errors->has('meta_keywords'))
                                            <label class="error">{{ $errors->first('meta_keywords') }}</label>
                                        @endif
                                    </div>

                                    <div class="col-md-12 form-group">
                                        <label for="meta_schema">{{ __('Meta Schema (JSON-LD)') }}</label>
                                        <textarea name="meta_schema" id="meta_schema"
                                            class="form-control {{ $errors->has('meta_schema') ? 'is-invalid' : '' }}" rows="5"
                                            placeholder='{{ __('Paste JSON-LD schema here') }}'>{{ old('meta_schema', @$meta->meta_schema) }}</textarea>
                                        @if ($errors->has('meta_schema'))
                                            <label class="error">{{ $errors->first('meta_schema') }}</label>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="meta_description">{{ __('Meta Description') }} <span
                                            class="text-danger">*</span></label>
                                    <textarea name="meta_description" id="meta_description"
                                        class="form-control {{ $errors->has('meta_description') ? 'is-invalid' : '' }}" rows="3" required>{{ old('meta_description', @$meta->meta_description) }}</textarea>
                                    @if ($errors->has('meta_description'))
                                        <label class="error">{{ $errors->first('meta_description') }}</label>
                                    @endif
                                </div>

                                <hr>

                                <div class="form-group">
                                    <label for="og_title">{{ __('Facebook Title') }}</label>
                                    <input type="text" name="og_title" id="og_title"
                                        class="form-control {{ $errors->has('og_title') ? 'is-invalid' : '' }}"
                                        value="{{ old('og_title', @$meta->og_title) }}" autocomplete="off" />
                                    @if ($errors->has('og_title'))
                                        <label class="error">{{ $errors->first('og_title') }}</label>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="og_description">{{ __('Facebook Description') }}</label>
                                    <textarea name="og_description" id="og_description"
                                        class="form-control {{ $errors->has('og_description') ? 'is-invalid' : '' }}" rows="3">{{ old('og_description', @$meta->og_description) }}</textarea>
                                    @if ($errors->has('og_description'))
                                        <label class="error">{{ $errors->first('og_description') }}</label>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="og_image">{{ __('Facebook Image') }}</label>
                                    <input type="text" name="og_image" id="og_image"
                                        class="form-control {{ $errors->has('og_image') ? 'is-invalid' : '' }}"
                                        value="{{ old('og_image', @$meta->og_image) }}" autocomplete="off" />
                                    @if ($errors->has('og_image'))
                                        <label class="error">{{ $errors->first('og_image') }}</label>
                                    @endif

                                </div>

                                <hr>

                                <div class="form-group">
                                    <label for="twitter_card">{{ __('Twitter Card Type') }}</label>
                                    <select name="twitter_card" id="twitter_card"
                                        class="form-control {{ $errors->has('twitter_card') ? 'is-invalid' : '' }}">
                                        <option value="summary"
                                            {{ old('twitter_card', @$meta->twitter_card) == 'summary' ? 'selected' : '' }}>
                                            {{ __('Summary') }}</option>
                                        <option value="summary_large_image"
                                            {{ old('twitter_card', @$meta->twitter_card) == 'summary_large_image' ? 'selected' : '' }}>
                                            {{ __('Summary Large Image') }}
                                        </option>
                                        <option value="app"
                                            {{ old('twitter_card', @$meta->twitter_card) == 'app' ? 'selected' : '' }}>
                                            {{ __('App') }}</option>
                                        <option value="player"
                                            {{ old('twitter_card', @$meta->twitter_card) == 'player' ? 'selected' : '' }}>
                                            {{ __('Player') }}</option>
                                    </select>
                                    @if ($errors->has('twitter_card'))
                                        <label class="error">{{ $errors->first('twitter_card') }}</label>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="twitter_title">{{ __('Twitter Title') }}</label>
                                    <input type="text" name="twitter_title" id="twitter_title"
                                        class="form-control {{ $errors->has('twitter_title') ? 'is-invalid' : '' }}"
                                        value="{{ old('twitter_title', @$meta->twitter_title) }}" autocomplete="off" />
                                    @if ($errors->has('twitter_title'))
                                        <label class="error">{{ $errors->first('twitter_title') }}</label>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="twitter_desc">{{ __('Twitter Description') }}</label>
                                    <textarea name="twitter_desc" id="twitter_desc"
                                        class="form-control {{ $errors->has('twitter_desc') ? 'is-invalid' : '' }}" rows="3">{{ old('twitter_desc', @$meta->twitter_desc) }}</textarea>
                                    @if ($errors->has('twitter_desc'))
                                        <label class="error">{{ $errors->first('twitter_desc') }}</label>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="twitter_image">{{ __('Twitter Image') }}</label>
                                    <input type="text" name="twitter_image" id="twitter_image"
                                        class="form-control {{ $errors->has('twitter_image') ? 'is-invalid' : '' }}"
                                        value="{{ old('twitter_image', @$meta->twitter_image) }}" autocomplete="off" />
                                    @if ($errors->has('twitter_image'))
                                        <label class="error">{{ $errors->first('twitter_image') }}</label>
                                    @endif

                                </div>

                                <div class="row justify-content-center">
                                    <div class="col-md-2">
                                        <button type="submit" class="btn btn-success btn-block my-2">
                                            <i class="fa fa-floppy-o"></i> {{ __('Save') }}
                                        </button>
                                    </div>

                                    <div class="col-md-2">
                                        <a href="{{ url('admin/tours/' . request('tourId')) }}"
                                            class="btn btn-outline-danger btn-block my-2">
                                            <i class="fa fa-times"></i> {{ __('Cancel') }}
                                        </a>
                                    </div>
                                </div>

                           @include('admin.tours.navigation');
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('css')
    <style>
        label.error {
            color: red;
            font-weight: 500;
        }

        img.img-thumbnail {
            border-radius: 5px;
        }
    </style>
@endsection

@section('script')
    <script>
        // If you want to add any custom JS, e.g., image preview, validation, etc.
    </script>
@endsection
