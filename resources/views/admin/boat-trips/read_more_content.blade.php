@extends('admin.layouts.app')

@section('title', ucwords(@$category->name . ': Sections'))

@section('content')
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
                                <li><a href="{{ url('admin/home') }}">Dashboard</a></li>
                                <li><a href="{{ url('admin/boat-trips') }}">Boat Trips</a></li>
                                <li class="active">Sections</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="col-sm-2">
                    <a href="{{ url('admin/boat-trips/' . request('tripId')) }}"
                        class="btn btn-info float-right my-2 mx-3">
                        <i class="fa fa-undo fa-lg"></i> Back
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
                            <strong class="card-title">Category Section</strong>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ url('admin/boat-trips/' . request('tripId') . '/read-more-content') }}" enctype="multipart/form-data" novalidate autocomplete="off">
                                @csrf

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Read More Title <span class="text-danger">*</span></label>
                                            <input type="text" name="title" class="form-control"
                                                value="{{ old('title', @$section->title) }}" placeholder="Read more title">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Visible Content (read more)</label>
                                            <textarea type="text" name="display_block" class="form-control"
                                                value="{{ old('display_block', @$section->display_block) }}" placeholder="visible content">{{ old('display_block', @$section->display_block) }}</textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="modal_title">Modal Title</label>
                                            <input type="text" name="modal_title" id="modal_title"
                                                placeholder="Modal Title"
                                                value="{{ old('display_block', @$section->modal_title) }}"
                                                class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Modal Content</label>
                                            <textarea id="summernote" name="modal_content"
                                                class="form-control {{ $errors->has('modal_content') ? 'is-invalid' : '' }}">{{ old('content', @$section->modal_content) }}</textarea>

                                        </div>
                                    </div>
                               
                                    



                                </div>

                                <div class="row justify-content-center mt-4">
                                    <div class="col-md-2">
                                        <button type="submit" class="btn btn-success btn-block">
                                            <i class="fa fa-floppy-o fa-lg"></i> Save
                                        </button>
                                    </div>
                                    <div class="col-md-2">
                                        <a href="{{ url('admin/boat-trips/' . request('tripId') . '/read-more-content') }}"
                                            class="btn btn-outline-danger btn-block">
                                            <i class="fa fa-refresh fa-lg"></i> Reset
                                        </a>
                                    </div>
                                </div>
                            </form>
                            <hr>
                           @include('admin.boat-trips.navigations')

                        </div>
                    </div><!-- .card -->
                </div>
            </div>
        </div>
    </div>
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
        $(document).ready(function() {
            $('#summernote').summernote({
                placeholder: 'Hello Senior Content Writer, write your content here... 😁',
                tabsize: 2,
                height: 200,
                fontNames: ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New', 'Merriweather',
                    'Roboto', 'Lato', 'Oswald', 'Open Sans', 'Times New Roman'
                ],
                fontNamesIgnoreCheck: ['Merriweather', 'Roboto', 'Lato', 'Oswald', 'Open Sans'],
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
                    ['insert', ['link', 'table', 'hr']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ],
                styleTags: ['p', 'blockquote', 'pre', 'h1', 'h2', 'h3'],
                callbacks: {
                    onImageUpload: function(files) {
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
                                success: function(response) {
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
                                error: function(xhr) {
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
            $('form').on('submit', function() {
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
