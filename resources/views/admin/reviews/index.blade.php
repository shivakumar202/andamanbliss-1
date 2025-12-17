@extends('admin.layouts.app')

@section('title', __('Reviews'))

@section('content')
<!-- Heading -->
<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>{{ __('Reviews') }}</h1>
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="{{ url('admin/home') }}">{{ __('Dashboard') }}</a></li>
                            <li class="active">{{ __('Reviews') }}</li>
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
    <div class="animated fadeIn">
        @include('admin.layouts.alert')

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <strong class="card-title">
                            {{ __('Review List') }}
                        </strong>
                        <button role="button" onclick="fetchGoogleRev()" id="fetchGoogleRev" class="btn btn-primary text-white btn-sm">
                            Fresh Google Reviews <i class="fa fa-refresh" id="btnIcon"></i>
                        </button>
                    </div>
                    <div class="card-body">
                        <form name="form" action="{{ url('admin/reviews') }}" method="GET" id="form" class=""
                            enctype="multipart/form-data" novalidate="novalidate" autocomplete="off">
                            <div class="row justify-content-center">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="category" class="control-label">
                                            {{ __('Category') }}
                                        </label>
                                        <select name="category" id="category" class="form-control">
                                            <option value="">{{ __('Select') }}</option>

                                            @foreach ($categories as $category)
                                            <option value="{{ $category }}" @selected(request('category')==$category)>
                                                {{ ucwords(str_replace('_', ' ', $category)) }}
                                            </option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>




                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="status" class="control-label">
                                            {{ __('Status') }}
                                        </label>
                                        <select name="status" id="status" class="form-control">
                                            <option value="">{{ __('Select') }}</option>
                                            <option value="1" @selected(request('status')=='1' )>{{ __('Active') }}</option>
                                            <option value="0" @selected(request('status')=='0' )>{{ __('Inactive') }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row align-items-center justify-content-center">
                                <div class="align-self-center col-md-2">
                                    <button type="submit" id="submit" class="btn btn-block btn-info my-1">
                                        <i class="fa fa-search fa-lg"></i>&nbsp;
                                        <span>{{ __('Search') }}</span>
                                    </button>
                                </div>

                                <div class="align-self-center col-md-2">
                                    <a href="{{ url('admin/reviews') }}" class="btn btn-block btn-outline-info my-1">
                                        <i class="fa fa-refresh fa-lg"></i>&nbsp;
                                        <span>{{ __('Reset') }}</span>
                                    </a>
                                </div>
                            </div>
                        </form>
                        <table id="dataTable" class="table table-striped table-hover w-100">
                            <thead class="thead-dark">
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Rating') }}</th>
                                    <th>{{ __('Date') }}</th>
                                    <th>{{ __('Page') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Media') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($reviews as $review)
                                @php
                                $review->table_type ?? 'Google Review';
                                @endphp
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $review->name ?? $review->reviewer_name }}</td>
                                    <td>{{ $review->rating }}</td>
                                    <td>{{ $review->review_date }}</td>
                                    <td>{{ $review->table_type  }}</td>
                                    <td>{{ $review->status == 1 ? 'Active' : 'Google' ?? 'Google' }}</td>
                                    <td>
                                        @if($review->reviewer_profile_photo_url)
                                        <img src="{{ $review->reviewer_profile_photo_url }}" alt="Media" width="60px" style="margin: 5px;">

                                        @else
                                        @foreach($review->reviewPhotos as $photo)
                                        @if($photo->file_name )
                                        @php
                                        $ext = pathinfo($photo->file_name, PATHINFO_EXTENSION);
                                        @endphp

                                        @if(in_array($ext, ['jpg', 'jpeg', 'png', 'webp', 'avif', 'gif']))
                                        <img src="{{ $review->reviewPhotos[0]->file }}" alt="Media" width="60px" style="margin: 5px;">
                                        @else
                                        <video width="100" controls style="margin: 5px;">
                                            <source src="{{ $review->reviewPhotos[0]->file }}" type="video/{{ $ext }}">
                                            {{ __('Your browser does not support the video tag.') }}
                                        </video>
                                        @endif
                                        @endif
                                        @endforeach
                                        @endif
                                    </td>



                                    <td>
                                        @if($review->table_type != null)
                                        <a href="{{ url('admin/reviews/' . $review->id . '/edit') }}" class="btn btn-xs btn-outline-info mx-1">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <form id="delete-form-{{ $review->id }}" action="{{ url('admin/reviews/' . $review->id) }}" method="POST" class="d-none">
                                            @csrf
                                            @method('DELETE')
                                        </form>

                                        <button type="button" class="btn btn-xs btn-outline-danger mx-1" onclick="if(confirm('Are you sure?')) { document.getElementById('delete-form-{{ $review->id }}').submit(); }">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                        @else
                                        <p>Delete Is Not available fr google reviews</p>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable({
            responsive: true,
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, 'All']
            ],
            pageLength: 10,
            order: [
                [0, 'desc']
            ],
        });
    });

    function fetchGoogleRev() {
        let btn = document.getElementById('fetchGoogleRev'); // correct way
        let icon = document.getElementById('btnIcon');

        btn.disabled = true;
        icon.classList.remove('fa-refresh');
        icon.classList.add('fa-spinner', 'fa-spin');

        $.ajax({
            url: "{{ route('google.reviews.store') }}",
            method: "POST",
            data: {
                _token: "{{ csrf_token() }}"
            },
            success: function(response) {
                if (response.status === 200) {
                    Swal.fire('success', response.message, 'success');

                    btn.disabled = false;
                    icon.classList.remove('fa-spinner', 'fa-spin');
                    icon.classList.add('fa-refresh');
                    location.reload();
                } else {
                    Swal.fire('Error!', response.message, 'error');

                }
            },
            error: function(xhr, status, error) {
                Swal.fire('Error!', error, 'error');
                // Re-enable button and revert icon even on error
                btn.disabled = false;
                icon.classList.remove('fa-spinner', 'fa-spin');
                icon.classList.add('fa-refresh');
            }
        });
    }
</script>
@endsection