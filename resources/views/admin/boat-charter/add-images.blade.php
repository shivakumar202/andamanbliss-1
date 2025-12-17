@extends('admin.layouts.app')

@section('title', __('Manage Images'))

@section('content')
<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>{{ __('Manage Images') }}</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="{{ url('admin/home') }}">{{ __('Dashboard') }}</a></li>
                            <li><a href="{{ url('admin/boat-charter') }}">{{ __('Boat Charter & Game Fishing Packages')
                                    }}</a></li>
                            <li class="active">{{ __('Images') }}</li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="col-sm-2">
                <a href="{{ url('admin/boat-charter/' . $package->id) }}" class="btn btn-info float-right my-2 mx-3">
                    <i class="fa fa-undo fa-lg"></i> 
                    {{ __('Back') }}
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
                <form id="image-form"
                    action="{{ $editItem ? route('admin.boat-charter.images.update', [$package->id, $editItem->id]) : route('admin.boat-charter.images.store', $package->id) }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    @if($editItem)
                    @method('PUT')
                    <input type="hidden" name="image_id" id="image_id" value="{{ $editItem->id }}">
                    @endif
                    <input type="hidden" name="boat_package_id" value="{{ $package->id }}">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="image">Image <span class="text-danger">*</span></label>
                                <input type="file" name="image" id="image" class="form-control-file" {{ $editItem ? ''
                                    : 'required' }}>
                                @if($editItem && $editItem->image && file_exists(public_path('storage/' .
                                $editItem->image)))
                                <img src="{{ url('storage/'.$editItem->image) }}" id="image-preview" alt="Preview"
                                    style="width: 100px; height: 100px; object-fit: cover; margin-top: 10px;">
                                @else
                                <img src="{{ asset('images/no-image.jpg') }}" id="image-preview" alt="No Image"
                                    style="width: 100px; height: 100px; object-fit: cover; margin-top: 10px;">
                                @endif
                                @error('image')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12 text-center">
                            <div class="form-group">
                                <button type="submit" id="submit-btn"
                                    class="btn {{ $editItem ? 'btn-primary' : 'btn-success' }}">{{ $editItem ? 'Update
                                    Image' : 'Add Image' }}</button>
                                @if($editItem)
                                <button type="button" id="cancel-btn" class="btn btn-secondary">Cancel</button>
                                @else
                                <button type="button" id="cancel-btn" class="btn btn-secondary d-none">Cancel</button>
                                @endif
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">{{ __('Images') }}</strong>
                    </div>
                    <div class="card-body">
                        <table id="image-table" class="table table-striped table-hover w-100">
                            <thead class="thead-dark">
                                <tr>
                                    <th>{{ __('ID') }}</th>
                                    <th>{{ __('Preview') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($images as $item)
                                <tr data-id="{{ $item->id }}"
                                    data-image="{{ $item->file_name ? url('storage/' . $item->file_name) : asset('images/no-image.jpg') }}">
                                    <td>{{ $item->id }}</td>
                                    <td>
                                        <img src="{{ $item->file_name ? asset('storage/' . $item->file_name) : asset('images/no-image.jpg') }}"
                                            alt="Image" style="width: 50px; height: 50px; object-fit: cover;">
                                    </td>
                                    <td>
                                        <button class="btn btn-xs btn-outline-info py-0 mx-1 edit-item" title="Edit">
                                            <i class="fa fa-pencil-square-o"></i>
                                        </button>
                                        <a onClick="if (confirm('Are you sure?')) return this.nextElementSibling.submit();"
                                            href="javascript:;" title="Delete"
                                            class="btn btn-xs btn-outline-danger py-0 mx-1">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                        <form
                                            action="{{ route('admin.boat-charter.images.destroy', [$package->id, $item->id]) }}"
                                            method="POST" class="d-none">
                                            @method('DELETE')
                                            @csrf
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <hr>
                        <div class="row align-items-center justify-content-center">
                            <div class="align-self-center col-md-2">
                                <a href="{{ url('admin/boat-charter/' . @$package->id . '/boat-itineraries/create') }}"
                                    class="btn btn-block btn-outline-info my-1">
                                    <i class="fa fa-calendar-check-o fa-lg"></i> 
                                    <span>{{ __('Day/Trip Itinerary') }}</span>
                                </a>
                            </div>
                            <div class="align-self-center col-md-2">
                                <a href="{{ url('admin/boat-charter/' . @$package->id . '/fishes-found') }}"
                                    class="btn btn-block btn-outline-info my-1">
                                    <i class="fa fa-binoculars fa-lg"></i> 
                                    <span>{{ __('Fishes Found') }}</span>
                                </a>
                            </div>
                            <div class="align-self-center col-md-2">
                                <a href="{{ url('admin/boat-charter/' . @$package->id . '/inclusion-exclusions') }}"
                                    class="btn btn-block btn-outline-info my-1">
                                    <i class="fa fa-list fa-lg"></i> 
                                    <span>{{ __('Inclusions') }}</span>
                                </a>
                            </div>
                            <div class="align-self-center col-md-2">
                                <a href="{{ url('admin/boat-charter/' . @$package->id . '/images') }}"
                                    class="btn btn-block btn-info my-1">
                                    <i class="fa fa-image fa-lg"></i> 
                                    <span>{{ __('Images') }}</span>
                                </a>
                            </div>
                            <div class="align-self-center col-md-2">
                                <a href="{{ url('admin/boat-charter/' . @$package->id . '/seasonal-prices') }}"
                                    class="btn btn-block btn-outline-info my-1">
                                    <i class="fa fa-dollar-sign fa-lg"></i> 
                                    <span>{{ __('Seasonal Prices') }}</span>
                                </a>
                            </div>
                            <div class="align-self-center col-md-2">
                                <a href="{{ url('admin/boat-charter/' . @$package->id . '/edit') }}"
                                    class="btn btn-block btn-outline-info my-1">
                                    <i class="fa fa-pencil-square-o fa-lg"></i> 
                                    <span>{{ __('Edit') }}</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        const form = $('#image-form');
        const submitBtn = $('#submit-btn');
        const cancelBtn = $('#cancel-btn');
        const imageIdInput = $('#image_id');
        const storeUrl = "{{ route('admin.boat-charter.images.store', $package->id) }}";
        const updateUrlTemplate = "{{ route('admin.boat-charter.images.update', [$package->id, '__image_id__']) }}";
        const imageInput = $('#image');
        const imagePreview = $('#image-preview');

        $('#image-table').DataTable({
            responsive: true,
            lengthMenu: [[10, 50, 100, -1], [10, 50, 100, 'All']],
            pageLength: 10,
            aaSorting: [0, 'DESC'],
            columnDefs: [
                {
                    targets: [0, 2],
                    orderable: false,
                    searchable: false
                },
                {
                    targets: [0],
                    visible: false
                }
            ]
        });

        $('.edit-item').on('click', function() {
            const row = $(this).closest('tr');
            const imageId = row.data('id');
            const image = row.data('image');

            imagePreview.attr('src', image);
            imageIdInput.val(imageId);

            const updateUrl = updateUrlTemplate.replace('__image_id__', imageId);
            form.attr('action', updateUrl);

            if (!form.find('input[name="_method"]').length) {
                form.append('<input type="hidden" name="_method" value="PUT">');
            } else {
                form.find('input[name="_method"]').val('PUT');
            }

            submitBtn.text('Update Image').removeClass('btn-success').addClass('btn-primary');
            cancelBtn.removeClass('d-none');
        });

        cancelBtn.on('click', function() {
            form.attr('action', storeUrl);
            form.find('input[name="_method"]').remove();
            submitBtn.text('Add Image').removeClass('btn-primary').addClass('btn-success');
            cancelBtn.addClass('d-none');
            imageIdInput.val('');
            imageInput.val('');
            imagePreview.attr('src', "{{ asset('images/no-image.jpg') }}");
        });

        imageInput.on('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.attr('src', e.target.result);
                };
                reader.readAsDataURL(file);
            } else {
                imagePreview.attr('src', "{{ asset('images/no-image.jpg') }}");
            }
        });

        form.on('submit', function(event) {
            const file = imageInput[0].files[0];
            const isEditing = !!imageIdInput.val();
            if (!file && !isEditing) {
                event.preventDefault();
                alert('Please select an image.');
            }
        });
    });
</script>
@endpush


@endsection