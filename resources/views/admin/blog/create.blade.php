@extends('admin.layouts.app')

@section('title', isset($blog) ? __('Edit Blog') : __('Create Blog'))

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="container-fluid m-2 p-4">
    <div class="breadcrumbs px-0 my-2">
        <div class="breadcrumbs-inner">
            <div class="row">
                <div class="col-sm-4">
                    <div class="page-header float-left">
                        <div class="page-title">
                            <h1>{{ isset($blog) ? __('Edit Blog') : __('Create Blog') }}</h1>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="page-header float-right">
                        <div class="page-title">
                            <ol class="breadcrumb text-right">
                                <li><a href="{{ url('admin/home') }}">{{ __('Dashboard') }}</a></li>
                                <li><a href="{{ route('admin.blogs.index') }}">{{ __('Blogs') }}</a></li>
                                <li class="active">{{ isset($blog) ? __('Edit') : __('Create') }}</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form method="POST"
        action="{{ isset($blog) ? route('admin.blogs.update', $blog->id) : route('admin.blogs.store') }}"
        enctype="multipart/form-data">
        @csrf
        @if(isset($blog))
        @method('PUT')
        @endif

        <div class="form-group">
            <label>Blog Title <span class="text-danger">*</span></label>
            <input type="text" name="title" placeholder="Blog Title"
                class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}"
                value="{{ old('title', isset($blog) ? $blog->title : '') }}" required />
            @error('title')
            <label class="error text-danger">{{ $message }}</label>
            @enderror
        </div>

        <div class="form-group">
            <label>Blog Category <span class="text-danger">*</span></label>
            <select name="category" class="form-control {{ $errors->has('category') ? 'is-invalid' : '' }}" required>
                <option value="">Select Category</option>
                @php
                $selectedCategory = old('category', isset($blog) ? $blog->category : '');
                $options = ['Travel', 'Packages', 'General', 'Water Activities'];
                @endphp
                @foreach($options as $option)
                <option value="{{ $option }}" {{ $selectedCategory===$option ? 'selected' : '' }}>
                    {{ $option }}
                </option>
                @endforeach
            </select>

            @error('category')
            <label class="error text-danger">{{ $message }}</label>
            @enderror
        </div>

        <div class="form-group">
            <label for="featuredImage">Featured Image <span class="text-danger">*</span></label>
            <input type="file" name="featured_image"
                class="form-control {{ $errors->has('featured_image') ? 'is-invalid' : '' }}" id="featuredImage"
                accept="image/*" {{ isset($blog) ? '' : 'required' }}>
            @if(isset($blog) && $blog->drive)
            <small class="form-text text-muted">Current image: <img
                    src="{{ asset('storage/' . $blog->drive->table_type . '/' . $blog->drive->file_name) }}"
                    alt="Featured Image" style="max-width: 100px;"></small>
            @endif
            <small class="form-text text-muted">Upload a featured image for the blog post (jpg, jpeg, png, gif; max
                2MB).</small>
            @error('featured_image')
            <label class="error text-danger">{{ $message }}</label>
            @enderror
        </div>

        <div class="form-group">
            <label><strong>Blog Content:</strong></label>
            <textarea id="summernote" name="content"
                class="form-control {{ $errors->has('content') ? 'is-invalid' : '' }}">{{ old('content', isset($blog) ? $blog->content : '') }}</textarea>
            @error('content')
            <label class="error text-danger">{{ $message }}</label>
            @enderror
        </div>

        <div class="form-group d-flex">
            <div class="col-6">  
                 <label for="author">Blog Author <span class="text-danger">*</span></label>
            <input type="text" name="author" placeholder="Blog Author"
                class="form-control {{ $errors->has('author') ? 'is-invalid' : '' }}"
                value="{{ old('author', isset($blog) ? $blog->author : '') }}" id="author" autocomplete="off" autofocus
                required />
            @error('author')
            <label class="error text-danger">{{ $message }}</label>
            @enderror
        </div>
            <div class="col-6">
                   <label for="publish_date">Blog Publish date <span class="text-danger">*</span></label>
            <input type="date" name="publish_date" placeholder="Blog Publish Date"
                class="form-control {{ $errors->has('publish_date') ? 'is-invalid' : '' }}"
                value="{{ old('author', isset($blog) ? $blog->publish_date : '') }}" id="publish_date" autocomplete="off" autofocus
                required />
            @error('publish_date')
            <label class="error text-danger">{{ $message }}</label>
            @enderror
            </div>
         
        </div>

        <div class="form-group">
            <label for="blogtags">Blog Tags <span class="text-danger">*</span></label>
            <input type="text" name="tags" placeholder="Blog Tags (comma separated) eg: Tourism, Travel, Adventure"
                class="form-control {{ $errors->has('tags') ? 'is-invalid' : '' }}"
                value="{{ old('tags', isset($blog) ? $blog->tags : '') }}" id="blogtags" autocomplete="off" autofocus
                required />
            @error('tags')
            <label class="error text-danger">{{ $message }}</label>
            @enderror
        </div>

        <div class="form-group">
            <label for="meta_title" class="control-label">{{ __('Meta Title') }} <span
                    class="text-danger">*</span></label>
            <input type="text" name="meta_title" placeholder="{{ __('Meta Title') }}"
                value="{{ old('meta_title', isset($blog) ? $blog->meta_title : '') }}" id="meta_title"
                class="form-control {{ $errors->has('meta_title') ? 'is-invalid' : '' }}" autocomplete="off" autofocus
                required />
            @error('meta_title')
            <label class="error text-danger">{{ $message }}</label>
            @enderror
        </div>

        <div class="form-group">
            <label for="meta_keywords" class="control-label">{{ __('Meta Keywords') }} <span
                    class="text-danger">*</span></label>
            <textarea class="form-control {{ $errors->has('meta_keywords') ? 'is-invalid' : '' }}" name="meta_keywords"
                id="meta_keywords" placeholder="{{ __('Meta Keywords') }}" cols="30" autocomplete="off" autofocus
                rows="5">{{ old('meta_keywords', isset($blog) ? $blog->meta_keywords : '') }}</textarea>
            @error('meta_keywords')
            <label class="error text-danger">{{ $message }}</label>
            @enderror
        </div>

        <div class="form-group">
            <label for="meta_description" class="control-label">{{ __('Meta Description') }} <span
                    class="text-danger">*</span></label>
            <textarea class="form-control {{ $errors->has('meta_description') ? 'is-invalid' : '' }}"
                name="meta_description" id="meta_description" placeholder="{{ __('Meta Description') }}" cols="30"
                autocomplete="off" autofocus
                rows="5">{{ old('meta_description', isset($blog) ? $blog->meta_description : '') }}</textarea>
            @error('meta_description')
            <label class="error text-danger">{{ $message }}</label>
            @enderror
        </div>


        <div class="form-group">
            <label for="meta_script" class="control-label">{{ __('Meta Script') }} <span
                    class="text-danger">*</span></label>
            <textarea class="form-control {{ $errors->has('meta_script') ? 'is-invalid' : '' }}" name="meta_script"
                id="meta_script" placeholder="{{ __('Meta Script') }}" cols="30" autocomplete="off" autofocus
                rows="5">{{ old('meta_script', isset($blog) ? $blog->meta_script : '') }}</textarea>
            @error('meta_script')
            <label class="error text-danger">{{ $message }}</label>
            @enderror
        </div>

        <div class="form-group text-center">
            <button type="submit" class="btn btn-success btn-md w-52">
                {{ isset($blog) ? __('Update') : __('Create') }} <i class="fa fa-upload"></i>
            </button>
            <a href="{{ route('admin.blogs.index') }}" class="btn btn-secondary btn-md">Cancel</a>
        </div>
    </form>
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
            height: 500,
            fontNames: ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New', 'Merriweather', 'Roboto', 'Lato', 'Oswald', 'Open Sans', 'Times New Roman'],
            fontNamesIgnoreCheck: ['Merriweather', 'Roboto', 'Lato', 'Oswald', 'Open Sans'],
            fontSizes: ['8', '9', '10', '11', '12', '14', '16', '18', '20', '24', '28', '32', '36', '48', '64'],
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
                            url: '{{ route("admin.blogs.upload-image") }}',
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
                                    alert('Image upload failed: ' + (response.error || 'Unknown error'));
                                }
                            },
                            error: function(xhr) {
                                console.error('Image upload failed:', xhr.status, xhr.responseText);
                                alert('Image upload failed: ' + (xhr.responseJSON?.error || 'Unknown error'));
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