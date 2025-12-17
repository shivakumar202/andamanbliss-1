@extends('admin.layouts.app')

@section('title', __('Manage Boat Itineraries'))

@section('content')
<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>{{ __('Manage Boat Itineraries') }}</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="{{ url('admin/home') }}">{{ __('Dashboard') }}</a></li>
                            <li><a href="{{ url('admin/boat-charter') }}">{{ __('Boat Charter & Game Fishing Packages') }}</a></li>
                            <li class="active">{{ __('Boat Itineraries') }}</li>
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
                @php
                    $editItinerary = request()->query('edit') ? $boatItineraries->where('id', request()->query('edit'))->first() : null;
                    $itinerariesByDay = $boatItineraries->keyBy('day');
                    $isUpdate = $boatItineraries->isNotEmpty();
                @endphp
                <form id="boat-itineraries-form" action="{{ $isUpdate ? route('admin.boat-charter.boat-itineraries.update', [$package->id, $boatItineraries->first()->id ?? 0]) : route('admin.boat-charter.boat-itineraries.store', $package->id) }}" method="POST">
                    @csrf
                    @if($isUpdate)
                        @method('PUT')
                    @endif
                    <input type="hidden" name="boat_package_id" value="{{ $package->id }}">
                    @for ($day = 1; $day <= $package->days; $day++)
                        @php
                            $itinerary = $editItinerary && $editItinerary->day == $day ? $editItinerary : ($itinerariesByDay[$day] ?? null);
                        @endphp
                        <div class="row">
                            <div class="col-md-12">
                                <h4>Day {{ $day }}</h4>
                            </div>
                            <input type="hidden" name="itineraries[{{ $day }}][day]" value="{{ $day }}">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title_day_{{ $day }}">Title <span class="text-danger">*</span></label>
                                    <input type="text" name="itineraries[{{ $day }}][title]" id="title_day_{{ $day }}" class="form-control" required value="{{ old('itineraries.' . $day . '.title', $itinerary->title ?? '') }}">
                                    @error('itineraries.' . $day . '.title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="description_day_{{ $day }}">Description</label>
                                    <textarea name="itineraries[{{ $day }}][description]" id="description_day_{{ $day }}" class="form-control" rows="6">{{ old('itineraries.' . $day . '.description', $itinerary->description ?? '') }}</textarea>
                                    @error('itineraries.' . $day . '.description')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12 text-center">
                                <div class="form-group">
                                    <button type="button" class="btn btn-primary update-day d-none" data-day="{{ $day }}" data-itinerary-id="{{ $itinerary->id ?? '' }}">Update Day {{ $day }}</button>
                                    <button type="button" class="btn btn-secondary cancel-day d-none" data-day="{{ $day }}">Cancel</button>
                                </div>
                            </div>
                        </div>
                        @if($day < $package->days)
                            <hr>
                        @endif
                    @endfor
                    @if(! $editItinerary)
                        <div class="col-md-12 text-center">
                            <div class="form-group">
                                <button type="submit" id="submit-btn" class="btn {{ $isUpdate ? 'btn-primary' : 'btn-success' }}">{{ $isUpdate ? 'Update All' : 'Add All' }}</button>
                            </div>
                        </div>
                    @endif
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">{{ __('Boat Itineraries') }}</strong>
                    </div>
                    <div class="card-body">
                        <table id="boat-itineraries-table" class="table table-striped table-hover w-100">
                            <thead class="thead-dark">
                                <tr>
                                    <th>{{ __('ID') }}</th>
                                    <th>{{ __('Day') }}</th>
                                    <th>{{ __('Title') }}</th>
                                    <th>{{ __('Description') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($boatItineraries as $itinerary)
                                <tr data-id="{{ $itinerary->id }}" data-day="{{ $itinerary->day }}" data-title="{{ $itinerary->title }}" data-description="{{ $itinerary->description ?? '' }}">
                                    <td>{{ $itinerary->id }}</td>
                                    <td>{{ $itinerary->day }}</td>
                                    <td>{{ $itinerary->title }}</td>
                                    <td>{{ Str::limit($itinerary->description ?? 'N/A', 50) }}</td>
                                    <td>
                                        <button class="btn btn-xs btn-outline-info py-0 mx-1 edit-itinerary" title="Edit">
                                            <i class="fa fa-pencil-square-o"></i>
                                        </button>
                                        <a onClick="if (confirm('Are you sure?')) return this.nextElementSibling.submit();" href="javascript:;" title="Delete" class="btn btn-xs btn-outline-danger py-0 mx-1">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                        <form action="{{ route('admin.boat-charter.boat-itineraries.destroy', [$package->id, $itinerary->id]) }}" method="POST" class="d-none">
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
                                    class="btn btn-block btn-info my-1">
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
@endsection
@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto&display=swap">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css">

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
        const form = $('#boat-itineraries-form');
        const submitBtn = $('#submit-btn');
        const storeUrl = "{{ route('admin.boat-charter.boat-itineraries.store', $package->id) }}";

        $('#boat-itineraries-table').DataTable({
            responsive: true,
            lengthMenu: [[10, 50, 100, -1], [10, 50, 100, 'All']],
            pageLength: 10,
            aaSorting: [0, 'DESC'],
            columnDefs: [
                {
                    targets: [0, 4],
                    orderable: false,
                },
                {
                    targets: [0, 4],
                    searchable: false,
                },
                {
                    targets: [0],
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
                    filename: 'boat-itineraries',
                    className: 'btn btn-xs btn-dark py-1',
                    exportOptions: {
                        columns: ':visible:not(:last-child)'
                    }
                },
                {
                    extend: 'excel',
                    text: 'Excel',
                    filename: 'boat-itineraries',
                    className: 'btn btn-xs btn-dark py-1',
                    exportOptions: {
                        columns: ':visible:not(:last-child)'
                    }
                },
                {
                    extend: 'pdf',
                    text: 'PDF',
                    filename: 'boat-itineraries',
                    className: 'btn btn-xs btn-dark py-1',
                    exportOptions: {
                        columns: ':visible:not(:last-child)'
                    }
                }
            ]
        });

        form.on('submit', function(event) {
            console.log('Bulk form submission attempted');
            let valid = true;
            @for ($day = 1; $day <= $package->days; $day++)
                const titleDay{{ $day }} = $('#title_day_{{ $day }}').val().trim();
                if (!titleDay{{ $day }}) {
                    valid = false;
                    console.log('Bulk form validation failed for Day {{ $day }}: Title is empty');
                    alert('Please enter a Title for Day {{ $day }}.');
                }
            @endfor
            if (!valid) {
                event.preventDefault();
            }
        });

        $('.update-day').on('click', function() {
            const day = $(this).data('day');
            const itineraryId = $(this).data('itinerary-id');
            const title = $('#title_day_' + day).val().trim();
            const description = $('#description_day_' + day).val();
            const boatPackageId = $('input[name="boat_package_id"]').val();

            if (!title) {
                console.log('Single form validation failed for Day ' + day + ': Title is empty');
                alert('Please enter a Title for Day ' + day + '.');
                return;
            }

            const url = itineraryId ? "{{ url('admin/boat-charter/' . $package->id . '/boat-itineraries') }}/" + itineraryId : storeUrl;
            const method = itineraryId ? 'PUT' : 'POST';

            const data = {
                boat_package_id: boatPackageId,
                itineraries: {
                    [day]: {
                        day: day,
                        title: title,
                        description: description
                    }
                },
                _method: method === 'PUT' ? 'PUT' : undefined,
                _token: "{{ csrf_token() }}"
            };

            $.ajax({
                url: url,
                method: 'POST',
                data: data,
                success: function(response) {
                    window.location.href = "{{ route('admin.boat-charter.boat-itineraries.create', $package->id) }}";
                },
                error: function(xhr) {
                    console.log('Single form submission failed for Day ' + day + ': ' + xhr.responseText);
                    alert('Error updating Day ' + day + '. Please try again.');
                }
            });
        });

        $('.cancel-day').on('click', function() {
            const day = $(this).data('day');
            $('#title_day_' + day).val('');
            $('#description_day_' + day).val('');
            $(this).addClass('d-none');
            $('.update-day[data-day="' + day + '"]').addClass('d-none');
            submitBtn.removeClass('d-none');
        });

        $('.edit-itinerary').on('click', function() {
            const row = $(this).closest('tr');
            const day = row.data('day');
            const title = row.data('title');
            const description = row.data('description');
            const itineraryId = row.data('id');

            $('#title_day_' + day).val(title);
            $('#description_day_' + day).val(description);
            $('.update-day[data-day="' + day + '"]').removeClass('d-none').attr('data-itinerary-id', itineraryId);
            $('.cancel-day[data-day="' + day + '"]').removeClass('d-none');
            @for ($otherDay = 1; $otherDay <= $package->days; $otherDay++)
                if ({{ $otherDay }} !== day) {
                    $('.update-day[data-day="{{ $otherDay }}"]').addClass('d-none');
                    $('.cancel-day[data-day="{{ $otherDay }}"]').addClass('d-none');
                }
            @endfor

            form.attr('action', "{{ url('admin/boat-charter/' . $package->id . '/boat-itineraries') }}/" + itineraryId);
            form.find('input[name="_method"]').remove().end().append('<input type="hidden" name="_method" value="PUT">');
            submitBtn.addClass('d-none');
        });

        @if($editItinerary)
            $('.update-day[data-day="{{ $editItinerary->day }}"]').removeClass('d-none');
            $('.cancel-day[data-day="{{ $editItinerary->day }}"]').removeClass('d-none');
            submitBtn.addClass('d-none');
        @endif
    });
</script>
@endpush
