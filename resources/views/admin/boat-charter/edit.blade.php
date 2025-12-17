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
                            <li class="active">{{ __('Edit') }}</li>
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
                <form id="boat-charter-form" action="{{ route('admin.boat-charter.update', ['id' => $package->id]) }}"
                    method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name">Package Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" required
                                    value="{{ $package->name ?? 'Half Day Game Fishing Trip to Off Chidiyatapu & Rutland' }}">
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="days">Days <span class="text-danger">*</span></label>
                                <input type="number" name="days" class="form-control" min="1" required
                                    value="{{ $package->days ?? 1 }}">
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
                                    value="{{ $package->duration ?? '6AM to 11AM' }}">
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
                                    <option value="Game Fishing" {{ $package->package_type == 'Game Fishing' ?
                                        'selected' : ''
                                        }}>Game Fishing</option>
                                    <option value="Boat Charter" {{ $package->package_type == 'Boat Charter' ?
                                        'selected' : ''
                                        }}>Boat Charter</option>
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
                                    value="{{ $package->pax ?? 4 }}">
                                @error('pax')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="boat_type">Boat Type <span class="text-danger">*</span></label>
                                <input type="text" name="boat_type" class="form-control" placeholder="Bay Boats"
                                    required value="{{ $package->boat_type ?? 'Sport Fishing Boat' }}">
                                @error('boat_type')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="places_covered">Places Covered <span class="text-danger">*</span></label>
                                <input name="places_covered" class="form-control"
                                    value="{{ $package->places_covered ?? 'Chidiyatapu, Rutland' }}"
                                    placeholder="ex: Rutland, Cinque, Brothers, Passage Island" required>
                                @error('places_covered')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="description">Description <span class="text-danger">*</span></label>
                                <textarea id="description" name="description" class="form-control"
                                    required>{{ $package->description ?? 'Experience an action-packed half-day game fishing adventure off Chidiyatapu and Rutland in the Andaman and Nicobar Islands. This 4-5 hour trip (e.g., 6 AM to 11 AM) is tailored for fishing enthusiasts, targeting species like trevally, barracuda, and tuna in the rich waters of the Andaman Sea. Depart from Chidiyatapu, renowned for its marine biodiversity, and venture to Rutland’s deep-sea fishing grounds. The package includes a fully equipped fishing boat (up to 4 pax), top-grade fishing gear, bait, and an expert guide. Non-local permit charges apply.' }}</textarea>
                                @error('description')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="base_price">Base Price (INR) <span class="text-danger">*</span></label>
                                <input type="number" name="base_price" min="0" class="form-control" required
                                    value="{{ $package->base_price ?? 18000 }}">
                                @error('base_price')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="discount">Discount (%)</label>
                                <input type="number" name="discount" min="0" class="form-control"
                                    value="{{ $package->discount ?? 0 }}">
                                @error('discount')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="permit_charges">Permit Charges</label>
                                <select name="permit_charges" id="permit_charges" class="form-control">
                                    <option value="1" {{ $package->permit_charges == '1' ? 'selected' : '' }}>Applicable
                                    </option>
                                    <option value="0" {{ $package->permit_charges == '0' ? 'selected' : ''
                                        }}>Non-Applicable</option>
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
                                    value="{{ $package->local_permit ?? 0 }}">
                                @error('local_permit')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="non_local_permit">Non-Local Permit Charges (INR)</label>
                                <input type="number" name="non_local_permit" min="0" class="form-control"
                                    value="{{ $package->non_local_permit ?? 500 }}">
                                @error('non_local_permit')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="featured">Featured?</label>
                                <select name="featured" class="form-control">
                                    <option value="0" {{ $package->featured == '0' ? 'selected' : '' }}>No</option>
                                    <option value="1" {{ $package->featured == '1' ? 'selected' : '' }}>Yes</option>
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
                                    <option value="1" {{ $package->status == '1' ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ $package->status == '0' ? 'selected' : '' }}>Inactive</option>
                                </select>
                                @error('status')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">Update Package</button>
                            </div>
                        </div>
                    </div>
                </form>
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
                            class="btn btn-block btn-outline-info my-1">
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
                            class="btn btn-block btn-info my-1">
                            <i class="fa fa-pencil-square-o fa-lg"></i> 
                            <span>{{ __('Edit') }}</span>
                        </a>
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
                        uploadUrl: '/upload'
                    }
                })
                .then(editor => {
                    console.log('CKEditor initialized successfully');
                })
                .catch(error => {
                    console.error('CKEditor Error:', error);
                });

            const form = document.getElementById('boat-charter-form');
            form.addEventListener('submit', function (event) {
                console.log('Form submission attempted');
                if (!form.checkValidity()) {
                    event.preventDefault();
                    console.log('Form validation failed');
                }
            });
        } catch (e) {
            console.error('Script Error:', e);
        }
    });
</script>
@endpush
@endsection