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
                                <li><a href="{{ url('admin/categories') }}">Category</a></li>
                                <li class="active">Sections</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="col-sm-2">
                    <a href="{{ url('admin/categories/' . request('categoryId')) }}"
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
                            <form method="POST"
                                @if (@$section) action="{{ url('admin/categories/' . request('categoryId') . '/content-section') }}"
                            @else
                                action="{{ url('admin/categories/' . request('categoryId') . '/content-section') }}" @endif
                                enctype="multipart/form-data" novalidate autocomplete="off">
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

                                    @php
                                        $blocks = @$section ? json_decode($section->blocks_section, true) : [];
                                        $block1 = $blocks['section_1'] ?? [];
                                        $block2 = $blocks['section_2'] ?? [];
                                    @endphp

                                    <div class="col-md-12 mt-4">
                                        <h5>Block Section 1 - Best Selling</h5>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Badge</label>
                                            <input type="text" name="blocks_section_1[badge]" class="form-control"
                                                value="{{ old('blocks_section_1.badge', $block1['badge'] ?? '') }}">
                                        </div>
                                    </div>

                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label>Heading <span>use | for partition</span></label>
                                            <input type="text" name="blocks_section_1[heading]" class="form-control"
                                                value="{{ old('blocks_section_1.heading', $block1['heading'] ?? '') }}">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea name="blocks_section_1[description]" class="form-control" rows="2">{{ old('blocks_section_1.description', $block1['description'] ?? '') }}</textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-12 mt-4">
                                        <h5>Block Section 2 - Choose Section</h5>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Badge</label>
                                            <input type="text" name="blocks_section_2[badge]" class="form-control"
                                                value="{{ old('blocks_section_2.badge', $block2['badge'] ?? '') }}">
                                        </div>
                                    </div>

                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label>Heading <span>use | for partition</span></label>
                                            <input type="text" name="blocks_section_2[heading]" class="form-control"
                                                value="{{ old('blocks_section_2.heading', $block2['heading'] ?? '') }}">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea name="blocks_section_2[description]" class="form-control" rows="2">{{ old('blocks_section_2.description', $block2['description'] ?? '') }}</textarea>
                                        </div>
                                    </div>



                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>CTA Title</label>
                                            <input type="text" name="cta_title" class="form-control"
                                                value="{{ old('cta_title', @$section->cta_title) }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>CTA Description</label>
                                            <input type="text" name="cta_desc" class="form-control"
                                                value="{{ old('cta_desc', @$section->cta_desc) }}">
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
                                        <a href="{{ url('admin/categories/' . request('categoryId') . '/content-section') }}"
                                            class="btn btn-outline-danger btn-block">
                                            <i class="fa fa-refresh fa-lg"></i> Reset
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
                                        class="btn btn-block btn-outline-info my-1">
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
                                        class="btn btn-block btn-info my-1">
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
