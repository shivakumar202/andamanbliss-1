@extends('admin.layouts.app')

@section('title', __('Boat Charter & Game Fishing Packages'))
@section('content')
<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>{{ __('Boat Charter & Game Fishing Packages') }}</h1>
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
                            @if (@$cab)
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
                <form id="boat-charter-form" action="{{ route('admin.boat-charter.store') }}" method="POST"
                    enctype="multipart/form-data" novalidate>
                    @csrf
                    @if (@$cab)
                    @method('PUT')
                    <input type="hidden" name="id" value="{{ @$cab->id }}">
                    @endif
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name">Package Name <span class="text-danger">*</span></label>
                                <input type="text" name="name"
                                    placeholder="eg, Half Day Game Fishing Trip to Off Chidiyatapu & Rutland"
                                    class="form-control" required value="{{ old('name', @$cab->name) }}">
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="days">Days <span class="text-danger">*</span></label>
                                <input type="number" name="days" class="form-control" min="1" required
                                    value="{{ old('days', @$cab->days) }}">
                                @error('days')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="duration">Duration (e.g., 6AM to 6PM, Full Day) <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="duration" class="form-control" required
                                    value="{{ old('duration', @$cab->duration) }}">
                                @error('duration')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="package_type">Package Type <span class="text-danger">*</span></label>
                                <select name="package_type" class="form-control" required>
                                    <option value="">Select</option>
                                    <option value="Game Fishing" {{ old('package_type', @$cab->package_type) == 'Game Fishing' ?
                                        'selected' : '' }}>Game Fishing</option>
                                    <option value="Boat Charter" {{ old('package_type', @$cab->package_type) == 'Boat Charter' ?
                                        'selected' : '' }}>Boat Charter</option>
                                        <option value="Sunset Tours" {{ old('package_type', @$cab->package_type) == 'Sunset Tours' ?
                                        'selected' : '' }}>Sunset Tours</option>
                                </select>

                                
                                @error('package_type')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="pax">Max Pax <span class="text-danger">*</span></label>
                                <input type="number" name="pax" min="1" class="form-control" required
                                    value="{{ old('pax', @$cab->pax) }}">
                                @error('pax')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="boat_type">Boat Type <span class="text-danger">*</span></label>
                                <input type="text" name="boat_type" class="form-control" placeholder="Bay Boats"
                                    required value="{{ old('boat_type', @$cab->boat_type) }}">
                                @error('boat_type')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="places_covered">Places Covered <span class="text-danger">*</span></label>
                                <input name="places_covered" class="form-control"
                                    value="{{ old('places_covered', @$cab->places_covered) }}"
                                    placeholder="ex: Rutland, Cinque, Brothers, Passage Island" required>
                                @error('places_covered')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="description">Description <span class="text-danger">*</span></label>
                                <textarea id="description" name="description"
                                    class="form-control">{{ old('description', @$cab->description) }}</textarea>
                                <span id="description-error" class="text-danger" style="display: none;">Description is
                                    required.</span>
                                @error('description')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="base_price">Base Price (INR) <span class="text-danger">*</span></label>
                                <input type="number" name="base_price" min="0" class="form-control" required
                                    value="{{ old('base_price', @$cab->base_price) }}">
                                @error('base_price')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="discount">Discount (%)</label>
                                <input type="number" name="discount" min="0" max="100" class="form-control"
                                    value="{{ old('discount', @$cab->discount) }}">
                                @error('discount')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="permit_charges">Permit Charges</label>
                                <select name="permit_charges" id="permit_charges" class="form-control">
                                    <option value="">Select Permit Type</option>
                                    <option value="1" {{ old('permit_charges', @$cab->permit_charges) == '1' ?
                                        'selected' : '' }}>Applicable</option>
                                    <option value="0" {{ old('permit_charges', @$cab->permit_charges) == '0' ?
                                        'selected' : '' }}>Non-Applicable</option>
                                </select>
                                @error('permit_charges')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="local_permit">Local Permit Charges (INR)</label>
                                <input type="number" name="local_permit" min="0" class="form-control"
                                    value="{{ old('local_permit', @$cab->local_permit) }}">
                                @error('local_permit')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="non_local_permit">Non-Local Permit Charges (INR)</label>
                                <input type="number" name="non_local_permit" min="0" class="form-control"
                                    value="{{ old('non_local_permit', @$cab->non_local_permit) }}">
                                @error('non_local_permit')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="featured">Featured?</label>
                                <select name="featured" class="form-control">
                                    <option value="0" {{ old('featured', @$cab->featured) == '0' ? 'selected' : '' }}>No
                                    </option>
                                    <option value="1" {{ old('featured', @$cab->featured) == '1' ? 'selected' : ''
                                        }}>Yes</option>
                                </select>
                                @error('featured')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" class="form-control">
                                    <option value="">Select Status</option>
                                    <option value="1" {{ old('status', @$cab->status) == '1' ? 'selected' : '' }}>Active
                                    </option>
                                    <option value="0" {{ old('status', @$cab->status) == '0' ? 'selected' : ''
                                        }}>Inactive</option>
                                </select>
                                @error('status')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">Save Package</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto&display=swap">
<style>
    .ck-editor__editable {
        min-height: 300px;
        font-family: Roboto, Arial, sans-serif;
        font-size: 16px;
        color: #333333;
        background-color: #F5F5F5;
    }

    .ck-toolbar {
        background-color: #f8f9fa;
        border-bottom: 1px solid #dee2e6;
    }
</style>
@endpush
@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        let editorInstance;
        try {
            ClassicEditor
                .create(document.querySelector('#description'), {
                    toolbar: [
                        'heading', '|',
                        'fontFamily', 'fontSize', 'fontColor', 'fontBackgroundColor', '|',
                        'bold', 'italic', 'underline', 'alignment', '|',
                        'bulletedList', 'numberedList', 'blockQuote', 'insertTable', '|',
                        'link', 'imageUpload', 'mediaEmbed', '|',
                        'undo', 'redo'
                    ],
                    fontFamily: {
                        options: [
                            'default',
                            'Arial, Helvetica, sans-serif',
                            'Georgia, serif',
                            'Times New Roman, Times, serif',
                            'Verdana, Geneva, sans-serif'
                        ],
                        supportAllValues: true
                    },
                    fontSize: {
                        options: [10, 12, 14, 'default', 18, 24, 30],
                        supportAllValues: true
                    },
                    fontColor: {
                        colors: [
                            { color: 'hsl(0, 0%, 0%)', label: 'Black' },
                            { color: 'hsl(0, 0%, 30%)', label: 'Dim grey' },
                            { color: 'hsl(0, 0%, 60%)', label: 'Grey' },
                            { color: 'hsl(0, 0%, 90%)', label: 'Light grey' },
                            { color: 'hsl(0, 0%, 100%)', label: 'White', hasBorder: true }
                        ]
                    },
                    fontBackgroundColor: {
                        colors: [
                            { color: 'hsl(0, 75%, 60%)', label: 'Red' },
                            { color: 'hsl(30, 75%, 60%)', label: 'Orange' },
                            { color: 'hsl(60, 75%, 60%)', label: 'Yellow' },
                            { color: 'hsl(90, 75%, 60%)', label: 'Light green' },
                            { color: 'hsl(120, 75%, 60%)', label: 'Green' }
                        ]
                    },
                    image: {
                        toolbar: ['imageTextAlternative', 'imageStyle:full', 'imageStyle:side']
                    },
                    simpleUpload: {
                        uploadUrl: '/upload',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        }
                    }
                })
                .then(editor => {
                    console.log('CKEditor initialized successfully');
                    editorInstance = editor;
                })
                .catch(error => {
                    console.error('CKEditor Error:', error);
                });

            const form = document.getElementById('boat-charter-form');
            form.addEventListener('submit', function (event) {
                event.preventDefault(); // Prevent default submission
                console.log('Form submission attempted');

                // Sync CKEditor data
                if (editorInstance) {
                    const descriptionField = document.querySelector('#description');
                    descriptionField.value = editorInstance.getData().trim();
                }

                // Custom validation for description
                const description = document.querySelector('#description').value;
                const descriptionError = document.querySelector('#description-error');
                if (!description) {
                    descriptionError.style.display = 'block';
                    form.classList.add('was-validated');
                    return;
                } else {
                    descriptionError.style.display = 'none';
                }

                // Check other form fields
                if (!form.checkValidity()) {
                    event.stopPropagation();
                    console.log('Form validation failed');
                    form.classList.add('was-validated');
                    return;
                }

                // If all validations pass, submit the form
                form.submit();
            });

            // CSRF token for AJAX requests
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        } catch (e) {
            console.error('Script Error:', e);
        }
    });
</script>
@endpush
@endsection