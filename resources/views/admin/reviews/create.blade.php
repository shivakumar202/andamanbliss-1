@extends('admin.layouts.app')

@section('title', $review ? __('Edit Review') : __('Add Review'))

@section('content')
<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>{{ $review ? __('Edit Review') : __('Add Review') }}</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="{{ url('admin/home') }}">{{ __('Dashboard') }}</a></li>
                            <li><a href="{{ url('admin/reviews') }}">{{ __('Reviews') }}</a></li>
                            <li class="active">{{ $review ? __('Edit Review') : __('Add Review') }}</li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="col-sm-2">
                <a href="javascript:history.back();" class="btn btn-info float-right my-2 mx-3">
                    <i class="fa fa-undo fa-lg"></i>&nbsp;{{ __('Back') }}
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
                <form action="{{ $review ? route('admin.reviews.update', $review->id) : route('admin.reviews.store') }}" method="POST" enctype="multipart/form-data" class="card" autocomplete="off">
                    @csrf
                    @if($review)
                        @method('PUT')
                    @endif
                    <div class="card-header">
                        <strong class="card-title">{{ $review ? __('Edit Review') : __('Add Review') }}</strong>
                    </div>
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{ __('Upload Image/Video') }} <span style="color:red;">*</span></label>
                                    <input type="file" name="media" accept="image/png,image/jpeg,image/jpg,image/webp,image/avif,image/gif,video/mp4,video/webm,video/ogg,video/avi,video/mov" onchange="validateFile(this);" class="form-control-file {{ $errors->has('media') ? 'is-invalid' : '' }}">
                                    @if ($errors->has('media'))
                                        <label class="error">{{ $errors->first('media') }}</label>
                                    @endif
                                </div>

                                @if(isset($review) && $review->reviewPhotos->count())
                                    @foreach($review->reviewPhotos as $photo)
                                        @php $ext = pathinfo($photo->file_name, PATHINFO_EXTENSION); @endphp
                                        <div style="margin: 5px;">
                                            @if(in_array($ext, ['jpg','jpeg','png','gif','webp','avif']))
                                                <img src="{{ asset('storage/page-review/'.$photo->file_name) }}" width="80px">
                                            @else
                                                <video width="120" controls>
                                                    <source src="{{ asset('storage/page-review/'.$photo->file_name) }}" type="video/{{ $ext }}">
                                                </video>
                                            @endif
                                        </div>
                                    @endforeach
                                @endif
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{ __('Reviewer Name') }} <span style="color:red;">*</span></label>
                                    <input type="text" name="name" value="{{ old('name', $review->name ?? '') }}" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" placeholder="{{ __('Name') }}">
                                    @if ($errors->has('name'))
                                        <label class="error">{{ $errors->first('name') }}</label>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{ __('Review Date') }} <span style="color:red;">*</span></label>
                                    <input type="date" name="review_date" value="{{ old('review_date', $review->review_date ?? '') }}" max="{{ date('Y-m-d') }}" class="form-control {{ $errors->has('review_date') ? 'is-invalid' : '' }}">
                                    @if ($errors->has('review_date'))
                                        <label class="error">{{ $errors->first('review_date') }}</label>
                                    @endif
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <input type="text" class="form-control {{ $errors->has('review_link') ? 'is-invalid' : '' }}" name="review_link" id="review_link" placeholder="Review Video Link ">
                                </div>
                                @if($errors->has('review_link'))
                                    <label for="review_link" class="error">{{ $errors->first('review_link') }}</label>
                                @endif
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <textarea name="address" class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" placeholder="Reviewer address" rows="1">{{ old('address', $review->address ?? '') }}</textarea>
                                    @if ($errors->has('address'))
                                        <label class="error">{{ $errors->first('address') }}</label>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{ __('Rating') }} <span style="color:red;">*</span></label>
                                    <select name="rating" class="form-control {{ $errors->has('rating') ? 'is-invalid' : '' }}">
                                        <option value="">{{ __('Select Rating') }}</option>
                                        @for ($i = 5; $i >= 1; $i--)
                                            <option value="{{ $i }}" {{ old('rating', $review->rating ?? '') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                        @endfor
                                    </select>
                                    @if ($errors->has('rating'))
                                        <label class="error">{{ $errors->first('rating') }}</label>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{ __('Page Category') }} <span style="color:red;">*</span></label>
                                    <select name="category" class="form-control {{ $errors->has('category') ? 'is-invalid' : '' }}">
                                        <option value="home-page-postcards" {{ old('category', $review->table_type ?? '') == 'home-page-postcards' ? 'selected' : '' }}>Home Page Post Cards</option>
                                    </select>
                                    @if ($errors->has('category'))
                                        <label class="error">{{ $errors->first('category') }}</label>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{ __('Active Status') }} <span style="color:red;">*</span></label>
                                    <select name="status" class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}">
                                        <option value="1" {{ old('status', $review->status ?? '') == '1' ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ old('status', $review->status ?? '') == '0' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                    @if ($errors->has('status'))
                                        <label class="error">{{ $errors->first('status') }}</label>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>{{ __('Review Content') }} <span style="color:red;">*</span></label>
                                    <textarea name="review" class="form-control {{ $errors->has('review') ? 'is-invalid' : '' }}" rows="4" placeholder="{{ __('Write review...') }}">{{ old('review', $review->review ?? '') }}</textarea>
                                    @if ($errors->has('review'))
                                        <label class="error">{{ $errors->first('review') }}</label>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-center mt-4">
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-info btn-block">
                                    <i class="fa fa-floppy-o fa-lg"></i> {{ __('Save') }}
                                </button>
                            </div>
                            <div class="col-md-2">
                                <button type="reset" class="btn btn-outline-info btn-block">
                                    <i class="fa fa-refresh fa-lg"></i> {{ __('Reset') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    function validateFile(input) {
        const file = input.files[0];
        if (file && file.size > 1024 * 20000) {
            alert("File size must be 1MB or less.");
            input.value = '';
        }
    }
</script>
@endsection
