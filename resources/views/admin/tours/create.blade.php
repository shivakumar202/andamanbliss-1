@extends('admin.layouts.app')

@section('title', __('Tour'))

@section('content')
    <!-- Heading -->
    <div class="breadcrumbs">
        <div class="breadcrumbs-inner">
            <div class="row">
                <div class="col-sm-4">
                    <div class="page-header float-left">
                        <div class="page-title">
                            <h1>{{ __('Tour') }}</h1>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="page-header float-right">
                        <div class="page-title">
                            <ol class="breadcrumb text-right">
                                <li><a href="{{ url('admin/home') }}">{{ __('Dashboard') }}</a></li>
                                <li><a href="{{ url('admin/tours') }}">{{ __('Tour') }}</a></li>
                                @if (@$tour)
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
                        @if (@$tour) action="{{ url('admin/tours/' . @$tour->id) }}" @else
          action="{{ url('admin/tours') }}" @endif
                        method="POST" id="form" class="card" enctype="multipart/form-data" novalidate="novalidate"
                        autocomplete="off">
                        @csrf
                        @if (@$tour)
                            @method('PUT')
                        @endif
                        <div class="card-header">
                            <strong class="card-title">
                                @if (@$tour)
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
                                        <label for="package_name" class="control-label">
                                            {{ __('Package Name') }}
                                            <span style="color:red;">*</span>
                                        </label>
                                        <input type="text" name="package_name" placeholder="{{ __('Package Name') }}"
                                            value="{{ old('package_name', @$tour->package_name) }}" id="package_name"
                                            class="form-control {{ $errors->has('package_name') ? 'is-invalid' : '' }}"
                                            autocomplete="off" required autofocus />
                                        @if ($errors->has('package_name'))
                                            <label class="error">{{ $errors->first('package_name') }}</label>
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
                                            <option value="">{{ __('Select Category') }}</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}" @selected(old('category_id', optional($tour)->category_id) == $category->id)>
                                                    {{ ucwords($category->name) }} - {{ $category->rating }} Star
                                                </option>
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
                                        </label>
                                        <input type="hidden" name="featured" value="0">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" name="featured" value="1" id="featured"
                                                class="custom-control-input {{ $errors->has('featured') ? 'is-invalid' : '' }}"
                                                @checked(old('featured', @$tour->featured) == 1) />
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
                                        </label>
                                        <input type="hidden" name="best_seller" value="0">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" name="best_seller" value="1" id="best_seller"
                                                class="custom-control-input {{ $errors->has('best_seller') ? 'is-invalid' : '' }}"
                                                @checked(old('best_seller', @$tour->best_seller) == 1) />
                                            <label class="custom-control-label"
                                                for="best_seller">{{ __('Yes') }}</label>
                                        </div>
                                        @if ($errors->has('best_seller'))
                                            <label class="error">{{ $errors->first('best_seller') }}</label>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group d-flex flex-wrap">
                                        <div class="col-12 px-0">
                                            <label for="url">URL <span style="color:red;">*</span></label>
                                            <input type="text" name="url" id="url" min="1"
                                                value="{{ old('nights', @$tour->url) }}" placeholder="page url"
                                                class="form-control" required>
                                        </div> 

                                    </div>
                                </div>
                                
                                 
                                <div class="col-6">
                                    <div class="form-group d-flex flex-wrap">
                                        <div class="col-6 px-0">
                                            <label for="nights">Nights <span style="color:red;">*</span></label>
                                            <input type="number" name="nights" id="nights" min="1"
                                                value="{{ old('nights', @$tour->nights) }}" placeholder="no. of nights"
                                                class="form-control" required>
                                        </div>
                                        <div class="col-6 ">
                                            <label for="days">Days</label>
                                            <input type="number" name="days" id="days"
                                                value="{{ old('days', @$tour->days) }}" class="form-control"
                                                placeholder="no. of days" readonly>
                                        </div>
                                    </div>
                                </div>
                                     <div class="col-md-6">
    @php
        $selectedIslands = old('islands_covered', $tour->islands_covered ?? []);
        $selectedIslands = is_string($selectedIslands) ? json_decode($selectedIslands, true) : $selectedIslands;
    @endphp

    <div class="form-group">
        <label for="islands_covered" class="control-label">
            {{ __('Islands Covered') }} <span style="color:red;">*</span>
        </label>
        <select 
            id="islands_covered" 
            name="islands_covered[]" 
            class="form-control" 
            multiple
        >
            <option value="Port Blair" {{ in_array('Port Blair', $selectedIslands) ? 'selected' : '' }}>Port Blair</option>
            <option value="Havelock Islands" {{ in_array('Havelock Islands', $selectedIslands) ? 'selected' : '' }}>Havelock Islands</option>
            <option value="Neil Island" {{ in_array('Neil Island', $selectedIslands) ? 'selected' : '' }}>Neil Island</option>
        </select>
        @if ($errors->has('islands_covered'))
            <label class="error">{{ $errors->first('islands_covered') }}</label>
        @endif
    </div>
</div>


                                <div class="col-12">

                                    <div class="form-group">
                                        <label for="sub_category" class="control-label">
                                            {{ __('Sub Categories') }} <span style="color:red;">*</span>
                                        </label>
                                         @php
                                                $selectedSubCategories = isset($tour)
                                                    ? explode(',', $tour->sub_category_id ?? '')
                                                    : [];
                                            @endphp
                                        <select id="sub_category" name="sub_category[]" multiple class="form-control">
                                           
                                            @foreach ($subCategory as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ in_array($category->id, $selectedSubCategories) ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach

                                        </select>

                                        @if ($errors->has('sub_category'))
                                            <label class="error">{{ $errors->first('sub_category') }}</label>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="page_heading" class="control-label">{{ __('Page Title') }}</label>
                                        <input type="text" name="page_heading" placeholder="{{ __('Page Title') }}"
                                            value="{{ old('page_heading', @$tour->page_heading) }}" id="title"
                                            class="form-control {{ $errors->has('page_heading') ? 'is-invalid' : '' }}"
                                            autocomplete="off" autofocus />
                                        @if ($errors->has('page_heading'))
                                            <label class="error">{{ $errors->first('page_heading') }}</label>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="cta_title" class="control-label">{{ __('CTA Title') }}</label>
                                        <input type="text" name="cta_title" placeholder="{{ __('CTA Title') }}"
                                            value="{{ old('cta_title', @$tour->cta_title) }}" id="title"
                                            class="form-control {{ $errors->has('cta_title') ? 'is-invalid' : '' }}"
                                            autocomplete="off" autofocus />
                                        @if ($errors->has('cta_title'))
                                            <label class="error">{{ $errors->first('cta_title') }}</label>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="cta_description" class="control-label">{{ __('CTA Description') }}</label>
                                        <textarea type="text" name="cta_description" placeholder="{{ __('CTA Description') }}"
                                            value="{{ old('cta_description', @$tour->cta_description) }}" id="title"
                                            class="form-control {{ $errors->has('cta_description') ? 'is-invalid' : '' }}"
                                            autocomplete="off" autofocus >{{ old('cta_description', @$tour->cta_description) }}</textarea>
                                        @if ($errors->has('cta_description'))
                                            <label class="error">{{ $errors->first('cta_description') }}</label>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="description" class="control-label">
                                            {{ __('Package Description') }}
                                            <span style="color:red;"></span>
                                        </label>
                                        <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description"
                                            id="description" placeholder="{{ __('Description') }}" cols="30" autocomplete="off" autofocus
                                            rows="5">{{ old('description', @$tour->description) }}</textarea>
                                        @if ($errors->has('description'))
                                            <label class="error">{{ $errors->first('description') }}</label>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="reviews" class="control-label">
                                            {{ __('Total Reviews') }}
                                            <span style="color:red;">*</span>
                                        </label>
                                        <input type="number" min="1" name="reviews"
                                            placeholder="{{ __('Total Reviews') }}"
                                            value="{{ old('reviews', @$tour->reviews) }}" id="reviews"
                                            class="form-control {{ $errors->has('reviews') ? 'is-invalid' : '' }}"
                                            autocomplete="off" autofocus />
                                        @if ($errors->has('reviews'))
                                            <label class="error">{{ $errors->first('reviews') }}</label>
                                        @endif
                                    </div>
                                </div>



                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="status" class="control-label">
                                            {{ __('Status') }}
                                            <span style="color:red;">*</span>
                                        </label>
                                        <select name="status" id="status"
                                            class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}">
                                            <option value="">{{ __('Select') }}</option>
                                            <option value="1" @selected(old('status', @$tour->status) == '1')>{{ ucwords('active') }}
                                            </option>
                                            <option value="0" @selected(old('status', @$tour->status) == '0')>
                                                {{ ucwords('In
                                                                                                                                                                                                              active') }}
                                            </option>
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
                                        class="btn btn-block btn-success my-1">
                                        <i class="fa fa-floppy-o fa-lg"></i>&nbsp;
                                        <span>{{ __('Save') }}</span>
                                    </button>
                                </div>

                                <div class="align-self-center col-md-2">
                                    <button type="reset" name="reset" id="reset"
                                        class="btn btn-block btn-outline-danger my-1">
                                        <i class="fa fa-refresh fa-lg"></i>&nbsp;
                                        <span>{{ __('Reset') }}</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form><!-- .card -->
                    @if($tour)

                    @include('admin.tours.navigation');
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-bs4.min.css" rel="stylesheet">
@endsection
@section('script')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-bs4.min.js"></script>

<script>
$(document).ready(function() {
    const $select = $('#islands_covered');
    let selectedOrder = Array.from(new Set($select.val() || []));

    $select.select2({
        placeholder: "select islands covered",
        allowClear: true,
        closeOnSelect: false
    });

    reorderSelectOptions();

    $select.on('select2:select', function(e) {
        const id = e.params.data.id;
        if (!selectedOrder.includes(id)) selectedOrder.push(id);
        reorderSelectOptions();
    });

    $select.on('select2:unselect', function(e) {
        const id = e.params.data.id;
        selectedOrder = selectedOrder.filter(val => val !== id);
        reorderSelectOptions();
    });

    function reorderSelectOptions() {
        selectedOrder = Array.from(new Set(selectedOrder));
        const allOptions = [...$select.find('option')];
        const orderedSelected = selectedOrder.map(id => allOptions.find(opt => opt.value == id)).filter(Boolean);
        const unselected = allOptions.filter(opt => !selectedOrder.includes(opt.value));
        $select.empty();
        orderedSelected.forEach(opt => $select.append(opt));
        unselected.forEach(opt => $select.append(opt));
        $select.val(selectedOrder).trigger('change.select2');
    }

    $('#sub_category').select2({
        placeholder: "select subcategories",
        allowClear: true,
        closeOnSelect: false
    });

    $('#description').summernote({
        placeholder: 'hello senior content writer, write package description here... 😁',
        tabsize: 2,
        height: 200,
        toolbar: [
            ['style', ['style']], ['font', ['bold', 'italic', 'underline', 'clear']],
            ['fontname', ['fontname']], ['fontsize', ['fontsize']], ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']], ['height', ['height']],
            ['insert', ['picture', 'link', 'video', 'table', 'hr']],
            ['view', ['fullscreen', 'codeview', 'help']]
        ]
    });

    $('form').on('submit', function() {
        $('input[name="islands_covered[]"]').remove();
        selectedOrder = Array.from(new Set(selectedOrder)); 
        selectedOrder.forEach(function(value) {
            $('<input>').attr({ type: 'hidden', name: 'islands_cover[]', value: value }).appendTo('form');
        });
        let content = $('#description').summernote('code');
        $('<input>').attr({ type: 'hidden', name: 'content', value: content }).appendTo('form');
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const nightsInput = document.getElementById('nights');
    const daysInput = document.getElementById('days');

    nightsInput.addEventListener('input', function() {
        const nights = parseInt(this.value);
        daysInput.value = !isNaN(nights) && nights > 0 ? nights + 1 : '';
    });

    const packageInput = document.getElementById('package_name');
    const categorySelect = document.getElementById('category_id');
    const urlInput = document.getElementById('url');

    const generateSlug = () => {
        const packageName = packageInput.value.trim();
        const categoryText = categorySelect.options[categorySelect.selectedIndex]?.text.split('-')[0].trim() || '';
        if (!packageName || !categoryText) return;
        const slugify = text => text.toLowerCase().replace(/[^a-z0-9\s]/g, '').replace(/\s+/g, '-').replace(/-+/g, '-').replace(/^-|-$/g, '');
        urlInput.value = `andaman-${slugify(categoryText)}-tour-${slugify(packageName)}`;
    };

    packageInput.addEventListener('input', generateSlug);
    categorySelect.addEventListener('change', generateSlug);
});
</script>
@endsection
