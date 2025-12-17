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
                                    <li class="active">{{ __('Overview') }}</li>
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
                    <div class="card py-3 px-2">
                        <form name="form" action="{{ url('admin/activities/' . $activity->id . '/overview') }}"
                            method="POST" id="form" class="from-control" enctype="multipart/form-data" novalidate
                            autocomplete="off">
                            @csrf
                            @method('PUT')

                            <div class="card-header">
                                <strong class="card-title">{{ __('Overview Content') }}</strong>
                            </div>

                            <div class="card-body">
                                <textarea id="summernote" name="content"
                                    class="form-control {{ $errors->has('content') ? 'is-invalid' : '' }}">{{ old('content', $activity->overview) }}</textarea>
                                @error('content')
                                    <label class="error text-danger">{{ $message }}</label>
                                @enderror

                                <div class="row align-items-center justify-content-center mt-3">
                                    <div class="align-self-center col-md-2">
                                        <button type="submit" name="submit" id="submit" class="btn btn-block btn-info my-1">
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
                        </form>
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
                                    class="btn btn-block btn-info my-1">
                                    <i class="fa fa-book fa-lg"></i>&nbsp;
                                    <span>{{ __('Overview') }}</span>
                                </a>
                            </div>
                            <div class="align-self-center col-md-2">
                                <a href="{{ url('admin/activities/' . @$activity->id . '/edit') }}"
                                    class="btn btn-block btn-outline-info my-1">
                                    <i class="fa fa-pencil-square-o fa-lg"></i>&nbsp;
                                    <span>{{ __('Edit') }}</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- .card -->
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
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
        </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
        </script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-bs4.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#summernote').summernote({
                placeholder: 'Hello Senior Content Writer, write your content here... 😁',
                tabsize: 2,
                height: 500,
                fontNames: [
                    'Arial', 'Arial Black', 'Comic Sans MS', 'Courier New', 'Merriweather',
                    'Roboto', 'Lato', 'Oswald', 'Open Sans', 'Times New Roman',
                    'Poppins', 'Raleway', 'Montserrat', 'Nunito', 'Playfair Display',
                    'Source Sans Pro', 'Helvetica'
                ],
                fontNamesIgnoreCheck: [
                    'Merriweather', 'Roboto', 'Lato', 'Oswald', 'Open Sans',
                    'Poppins', 'Raleway', 'Montserrat', 'Nunito', 'Playfair Display',
                    'Source Sans Pro', 'Helvetica'
                ],

                fontSizes: ['8', '9', '10', '11', '12', '14', '16', '18', '20', '24', '28', '32', '36',
                    '48', '64'
                ],
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['fontname', ['fontname']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['insert', ['picture', 'link', 'video', 'table', 'hr']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ],
                styleTags: ['p', 'blockquote', 'pre', 'h1', 'h2', 'h3'],
                callbacks: {
                    onImageUpload: function (files) {
                        for (let i = 0; i < files.length; i++) {
                            // Prompt for alt text
                            let altText = prompt('Enter alt text for the image:', '');
                            if (altText === null) {
                                // User cancelled the prompt, skip this image
                                continue;
                            }

                            let formData = new FormData();
                            formData.append('image', files[i]);
                            formData.append('alt', altText);

                            $.ajax({
                                url: '{{ route('admin.blogs.upload-image') }}',
                                method: 'POST',
                                data: formData,
                                contentType: false,
                                processData: false,
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                success: function (response) {
                                    if (response.success) {
                                        const img = $('<img>').attr({
                                            src: response.url,
                                            alt: altText
                                        }).css({
                                            width: '795px',
                                            height: '530px'
                                        });
                                        $('#summernote').summernote('insertNode', img[0]);
                                    } else {
                                        alert('Image upload failed: ' + (response.error ||
                                            'Unknown error'));
                                    }
                                },
                                error: function (xhr) {
                                    console.error('Image upload failed:', xhr.status, xhr
                                        .responseText);
                                    alert('Image upload failed: ' + (xhr.responseJSON
                                        ?.error || 'Unknown error'));
                                }
                            });
                        }
                    }
                }
            });

            // Capture Summernote content on form submit
            $('form').on('submit', function () {
                let content = $('#summernote').summernote('code');
                $('<input>').attr({
                    type: 'hidden',
                    name: 'content',
                    value: content
                }).appendTo('form');
            });
        });
    </script>
@endsection