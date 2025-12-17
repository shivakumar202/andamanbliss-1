@extends('admin.layouts.app')

@section('title', __(@$category->name . ': Review'))

@section('content')
<!-- Heading -->
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
                            <li><a href="{{ url('admin/home') }}">{{ __('Dashboard') }}</a></li>
                            <li><a href="{{ url('admin/categories') }}">{{ __('Category') }}</a></li>
                            <li class="active">{{ __('Review') }}</li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="col-sm-2">
                <a href="{{ url('admin/categories/' . request('categoryId')) }}"
                    class="btn btn-info float-right my-2 mx-3">
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
                            {{ __('Review') }}
                        </strong>
                    </div>

                    <div class="card-body">
                        <form name="form" @if (@$review)
                            action="{{ url('admin/categories/' . request('categoryId') . '/reviews/' . @$category->id) }}"
                            @else action="{{ url('admin/categories/' . request('categoryId') . '/reviews') }}" @endif
                            method="POST" id="form" class="" enctype="multipart/form-data" novalidate="novalidate"
                            autocomplete="off">
                            @csrf

                            <div class="row justify-content-center">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>{{ __('Upload Image') }} <span style="color:red;">*</span></label>
                                        <input type="file" name="media"
                                            accept="image/png,image/jpeg,image/jpg,image/webp,image/avif,image/gif,video/mp4,video/webm,video/ogg,video/avi,video/mov"
                                            onchange="validateFile(this);"
                                            class="form-control-file {{ $errors->has('media') ? 'is-invalid' : '' }}">
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
                                            <source src="{{ asset('storage/page-review/'.$photo->file_name) }}"
                                                type="video/{{ $ext }}">
                                        </video>
                                        @endif
                                    </div>
                                    @endforeach
                                    @endif
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>{{ __('Reviewer Name') }} <span style="color:red;">*</span></label>
                                        <input type="text" name="name" value="{{ old('name', $review->name ?? '') }}"
                                            class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                            placeholder="{{ __('Name') }}">
                                        @if ($errors->has('name'))
                                        <label class="error">{{ $errors->first('name') }}</label>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>{{ __('Review Date') }} <span style="color:red;">*</span></label>
                                        <input type="date" name="review_date"
                                            value="{{ old('review_date', $review->review_date ?? '') }}"
                                            max="{{ date('Y-m-d') }}"
                                            class="form-control {{ $errors->has('review_date') ? 'is-invalid' : '' }}">
                                        @if ($errors->has('review_date'))
                                        <label class="error">{{ $errors->first('review_date') }}</label>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>{{ __('Reviewer Address') }} <span style="color:red;">*</span></label>

                                        <textarea name="address"
                                            class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}"
                                            placeholder="Reviewer address"
                                            rows="1">{{ old('address', $review->address ?? '') }}</textarea>
                                        @if ($errors->has('address'))
                                        <label class="error">{{ $errors->first('address') }}</label>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>{{ __('Video Link') }} </label>

                                        <input type="text"
                                            class="form-control {{ $errors->has('review_link') ? 'is-invalid' : '' }}"
                                            name="review_link" id="review_link" placeholder="Review Video Link ">
                                    </div>
                                    @if($errors->has('review_link'))
                                    <label for="review_link" class="error">{{ $errors->first('review_link') }}</label>
                                    @endif
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>{{ __('Rating') }} <span style="color:red;">*</span></label>
                                        <select name="rating"
                                            class="form-control {{ $errors->has('rating') ? 'is-invalid' : '' }}">
                                            <option value="">{{ __('Select Rating') }}</option>
                                            @for ($i = 5; $i >= 1; $i--)
                                            <option value="{{ $i }}" {{ old('rating', $review->rating ?? '') == $i ?
                                                'selected' : '' }}>{{ $i }}</option>
                                            @endfor
                                        </select>
                                        @if ($errors->has('rating'))
                                        <label class="error">{{ $errors->first('rating') }}</label>
                                        @endif
                                    </div>
                                </div>



                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>{{ __('Active Status') }} <span style="color:red;">*</span></label>
                                        <select name="status"
                                            class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}">
                                            <option value="1" {{ old('status', $review->status ?? '') == '1' ?
                                                'selected' : '' }}>Active</option>
                                            <option value="0" {{ old('status', $review->status ?? '') == '0' ?
                                                'selected' : '' }}>Inactive</option>
                                        </select>
                                        @if ($errors->has('status'))
                                        <label class="error">{{ $errors->first('status') }}</label>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>{{ __('Review Content') }} <span style="color:red;">*</span></label>
                                        <textarea name="review"
                                            class="form-control {{ $errors->has('review') ? 'is-invalid' : '' }}"
                                            rows="4"
                                            placeholder="{{ __('Write review...') }}">{{ old('review', $review->review ?? '') }}</textarea>
                                        @if ($errors->has('review'))
                                        <label class="error">{{ $errors->first('review') }}</label>
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
                                    <a href="{{ url('admin/categories/' . request('categoryId') . '/reviews') }}"
                                        id="reset" class="btn btn-block btn-outline-danger my-1">
                                        <i class="fa fa-refresh fa-lg"></i>&nbsp;
                                        <span>{{ __('Reset') }}</span>
                                    </a>
                                </div>
                            </div>

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
                                        class="btn btn-block btn-info my-1">
                                        <i class="fa fa-pencil-square-o fa-lg"></i>&nbsp;
                                        <span>{{ __('Reviews') }}</span>
                                    </a>
                                </div>
                                 <div class="align-self-center col-md-2">
                                    <a href="{{ url('admin/categories/' . @$category->id . '/content-section') }}"
                                        class="btn btn-block btn-outline-info my-1">
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

                        </form>
                        <hr class="my-3">
                        <table id="dataTable" class="table table-striped table-hover w-100">
                            <thead class="thead-dark">
                                <tr>
                                    <th>{{ __('ID') }}</th>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Address') }}</th>
                                    <th>{{ __('Review') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($reviews as $key => $review)
                                <tr>
                                    <td>{{ @$review->id }}</td>
                                    <td>{{ ucwords(@$review->name) }}</td>
                                    <td>{{ ucwords(@$review->address) }}</td>
                                    <td>{!! @$review->review !!}</td>
                                    <td>{{ @$review->status == 1 ? 'Active' : 'Inactive' }}</td>
                                    <td>
                                        <a href="{{ url('admin/categories/' . request('categoryId') . '/reviews/' . @$review->id) }}"
                                            title="Edit" class="btn btn-xs btn-outline-info py-0 mx-1">
                                            <i class="fa fa-pencil-square-o"></i>
                                        </a>
                                        <a onClick="if (confirm('Are you sure?')) return this.nextElementSibling.submit();"
                                            href="javascript:;" title="Delete"
                                            class="btn btn-xs btn-outline-danger py-0 mx-1">
                                            <i class="fa fa-trash-o"></i>
                                        </a>
                                        <form
                                            action="{{ url('admin/categories/' . request('categoryId') . '/reviews/' . @$review->id) }}"
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
    var datatable;

    $(document).ready(function() {
        datatable = $('#dataTable').DataTable({
            responsive: true,
            lengthMenu: [
                [10, 50, 100, -1],
                [10, 50, 100, 'All']
            ],
            pageLength: 10,
            aaSorting: [0, 'DESC'],
            columnDefs: [{
                    targets: [0, 4], // column index
                    orderable: false,
                },
                {
                    targets: [0, 4], // column index
                    searchable: false,
                },
                {
                    targets: [0], // column index
                    visible: false,
                }
            ],
            // dom: 'lBfrtip',
            dom: '<"row"<"col-sm-3"l><"col-sm-4"B><"col-sm-5"f>>' +
                '<"row"<"col-sm-12"tr>>' +
                '<"row"<"col-sm-5"i><"col-sm-7"p>>',
            buttons: [{
                    extend: 'csv',
                    text: 'CSV',
                    filename: 'category_reviews',
                    className: 'btn btn-xs btn-dark py-1',
                    exportOptions: {
                        columns: ':visible:not(:last-child)'
                    }
                },
                {
                    extend: 'excel',
                    text: 'Excel',
                    filename: 'category_reviews',
                    className: 'btn btn-xs btn-dark py-1',
                    exportOptions: {
                        columns: ':visible:not(:last-child)'
                    }
                },
                {
                    extend: 'pdf',
                    text: 'PDF',
                    filename: 'category_reviews',
                    className: 'btn btn-xs btn-dark py-1',
                    exportOptions: {
                        columns: ':visible:not(:last-child)'
                    }
                }
            ]
        });
    });
</script>
@endsection