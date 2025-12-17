@extends('admin.layouts.app')

@section('title', __('Manage Fishes Found'))

@section('content')
<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>{{ __('Manage Fishes Found') }}</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="{{ url('admin/home') }}">{{ __('Dashboard') }}</a></li>
                            <li><a href="{{ url('admin/boat-charter') }}">{{ __('Boat Charter & Game Fishing Packages') }}</a></li>
                            <li class="active">{{ __('Fishes Found') }}</li>
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
                <form id="fishes-found-form" action="{{ $editFish ? route('admin.boat-charter.fishes-found.update', [$package->id, $editFish->id]) : route('admin.boat-charter.fishes-found.store', $package->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if($editFish)
                        @method('PUT')
                        <input type="hidden" name="fish_id" id="fish_id" value="{{ $editFish->id }}">
                    @endif
                    <input type="hidden" name="boat_package_id" value="{{ $package->id }}">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" id="name" class="form-control" required value="{{ old('name', $editFish->name ?? '') }}">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="scientific_name">Scientific Name</label>
                                <input type="text" name="scientific_name" id="scientific_name" class="form-control" value="{{ old('scientific_name', $editFish->scientific_name ?? '') }}">
                                @error('scientific_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="image">Image</label>
                                <input type="file" name="image" id="image" class="form-control-file">
                                @if($editFish && $editFish->image)
                                    <img src="{{ asset('storage/' . $editFish->image) }}" id="image-preview" alt="Preview" style="width: 100px; height: 100px; object-fit: cover; margin-top: 10px;">
                                @else
                                    <img src="{{ asset('images/no-image.jpg') }}" id="image-preview" alt="No Image" style="width: 100px; height: 100px; object-fit: cover; margin-top: 10px;">
                                @endif
                                @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" class="form-control" rows="4">{{ old('description', $editFish->description ?? '') }}</textarea>
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12 text-center">
                            <div class="form-group">
                                <button type="submit" id="submit-btn" class="btn {{ $editFish ? 'btn-primary' : 'btn-success' }}">{{ $editFish ? 'Update Fish Found' : 'Add Fish Found' }}</button>
                                @if($editFish)
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
                        <strong class="card-title">{{ __('Fishes Found') }}</strong>
                    </div>
                    <div class="card-body">
                        <table id="fishes-found-table" class="table table-striped table-hover w-100">
                            <thead class="thead-dark">
                                <tr>
                                    <th>{{ __('ID') }}</th>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Scientific Name') }}</th>
                                    <th>{{ __('Image') }}</th>
                                    <th>{{ __('Description') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($fishesFound as $fish)
                                <tr data-id="{{ $fish->id }}" data-name="{{ $fish->name }}" data-scientific_name="{{ $fish->scientific_name ?? '' }}" data-image="{{ $fish->image ? asset('storage/' . $fish->image) : asset('images/no-image.jpg') }}" data-description="{{ $fish->description ?? '' }}">
                                    <td>{{ $fish->id }}</td>
                                    <td>{{ $fish->name }}</td>
                                    <td>{{ $fish->scientific_name ?? 'N/A' }}</td>
                                    <td>
                                        <img src="{{ $fish->image ? asset('storage/' . $fish->image) : asset('images/no-image.jpg') }}" alt="{{ $fish->name }}" style="width: 50px; height: 50px; object-fit: cover;">
                                    </td>
                                    <td>{{ Str::limit($fish->description ?? 'N/A', 50) }}</td>
                                    <td>
                                        <button class="btn btn-xs btn-outline-info py-0 mx-1 edit-fish" title="Edit">
                                            <i class="fa fa-pencil-square-o"></i>
                                        </button>
                                        <a onClick="if (confirm('Are you sure?')) return this.nextElementSibling.submit();" href="javascript:;" title="Delete" class="btn btn-xs btn-outline-danger py-0 mx-1">
                                            <i class="fa fa-trash-o"></i>
                                        </a>
                                        <form action="{{ route('admin.boat-charter.fishes-found.destroy', [$package->id, $fish->id]) }}" method="POST" class="d-none">
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
                                    <span>{{ __('Day/Trip Ititnerary') }}</span>
                                </a>
                            </div>
                            <div class="align-self-center col-md-2">
                                <a href="{{ url('admin/boat-charter/' . @$package->id . '/fishes-found') }}"
                                    class="btn btn-block btn-info my-1">
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
                                <a href="{{ url('admin/boat-charter/' . @$package->id . '/images') }}" class="btn btn-block btn-outline-info my-1">
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
@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto&display=swap">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css">
<style>
.form-control, .form-control-file {
    font-family: Roboto, Arial, sans-serif;
    font-size: 16px;
    color: #333333;
    background-color: #F5F5F5;
}
</style>
@endpush
@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script>
    $(document).ready(function() {
        const form = $('#fishes-found-form');
        const submitBtn = $('#submit-btn');
        const cancelBtn = $('#cancel-btn');
        const fishIdInput = $('#fish_id');
        const storeUrl = "{{ route('admin.boat-charter.fishes-found.store', $package->id) }}";
        const imageInput = $('#image');
        const imagePreview = $('#image-preview');

        $('#fishes-found-table').DataTable({
            responsive: true,
            lengthMenu: [[10, 50, 100, -1], [10, 50, 100, 'All']],
            pageLength: 10,
            aaSorting: [0, 'DESC'],
            columnDefs: [
                {
                    targets: [0, 5], // ID and Action columns
                    orderable: false,
                },
                {
                    targets: [0, 5], // ID and Action columns
                    searchable: false,
                },
                {
                    targets: [0], // ID column
                    visible: false,
                }
            ],
            dom: '<"row"<"col-sm-3"l><"col-sm-4"B><"col-sm-5"f>>' +
                 '<"row"<"col-sm-12"tr>>' +
                 '<"row"<"col-sm-5"i><"col-sm-7"p>>',
            buttons: [
                {
                    extend: 'csv',
                    text: 'CSV',
                    filename: 'fishes-found',
                    className: 'btn btn-xs btn-dark py-1',
                    exportOptions: {
                        columns: ':visible:not(:last-child)'
                    }
                },
                {
                    extend: 'excel',
                    text: 'Excel',
                    filename: 'fishes-found',
                    className: 'btn btn-xs btn-dark py-1',
                    exportOptions: {
                        columns: ':visible:not(:last-child)'
                    }
                },
                {
                    extend: 'pdf',
                    text: 'PDF',
                    filename: 'fishes-found',
                    className: 'btn btn-xs btn-dark py-1',
                    exportOptions: {
                        columns: ':visible:not(:last-child)'
                    }
                }
            ]
        });

        $('.edit-fish').on('click', function() {
            const row = $(this).closest('tr');
            const fishId = row.data('id');
            const name = row.data('name');
            const scientificName = row.data('scientific_name');
            const image = row.data('image');
            const description = row.data('description');

            $('#name').val(name);
            $('#scientific_name').val(scientificName);
            imagePreview.attr('src', image);
            $('#description').val(description);
            fishIdInput.val(fishId);

            form.attr('action', "{{ url('admin/boat-charter/' . $package->id . '/fishes-found') }}/" + fishId);
            form.find('input[name="_method"]').remove().end().append('<input type="hidden" name="_method" value="PUT">');
            submitBtn.text('Update Fish Found').removeClass('btn-success').addClass('btn-primary');
            cancelBtn.removeClass('d-none');
        });

        cancelBtn.on('click', function() {
            form.attr('action', storeUrl);
            form.find('input[name="_method"]').remove();
            submitBtn.text('Add Fish Found').removeClass('btn-primary').addClass('btn-success');
            cancelBtn.addClass('d-none');
            fishIdInput.val('');
            $('#name').val('');
            $('#scientific_name').val('');
            imageInput.val('');
            imagePreview.attr('src', "{{ asset('images/no-image.jpg') }}");
            $('#description').val('');
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
            console.log('Form submission attempted');
            const name = $('#name').val().trim();
            if (!name) {
                event.preventDefault();
                console.log('Form validation failed: Name is empty');
                alert('Please enter a Name.');
            }
        });
    });
</script>
@endpush
@endsection