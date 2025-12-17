@extends('admin.layouts.app')

@section('title', __('Manage Seasonal Prices'))

@section('content')
<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>{{ __('Manage Seasonal Prices') }}</h1>
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
                            <li class="active">{{ __('Manage Seasonal Prices') }}</li>
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
                <form id="seasonal-price-form"
                    action="{{ route('admin.boat-charter.seasonal-prices.store', $package->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="boat_package_id" value="{{ $package->id }}">
                    <input type="hidden" name="price_id" id="price_id">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="season">Season <span class="text-danger">*</span></label>
                                <select name="season" id="season" class="form-control" required>
                                    <option value="">{{ __('Select Season') }}</option>
                                    <option value="off_season" @selected(old('season')=='off_season' )>{{ __('Off
                                        Season') }}</option>
                                    <option value="peak_season" @selected(old('season')=='peak_season' )>{{ __('Peak
                                        Season') }}</option>
                                    <option value="festive" @selected(old('season')=='festive' )>{{ __('Festive Season')
                                        }}</option>
                                </select>
                                @error('season')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="price">Price (INR) <span class="text-danger">*</span></label>
                                <input type="number" name="price" id="price" class="form-control" min="0" step="0.01"
                                    required value="{{ old('price') }}">
                                @error('price')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="start_date">Start Date <span class="text-danger">*</span></label>
                                <input type="date" name="start_date" id="start_date" class="form-control" required
                                    value="{{ old('start_date') }}">
                                @error('start_date')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="end_date">End Date <span class="text-danger">*</span></label>
                                <input type="date" name="end_date" id="end_date" class="form-control" required
                                    value="{{ old('end_date') }}">
                                @error('end_date')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12 text-center">
                            <div class="form-group">
                                <button type="submit" id="submit-btn" class="btn btn-success">Add Seasonal
                                    Price</button>
                                <button type="button" id="cancel-btn" class="btn btn-secondary d-none">Cancel</button>
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
                        <strong class="card-title">{{ __('Seasonal Prices') }}</strong>
                    </div>
                    <div class="card-body">
                        <table id="seasonal-prices-table" class="table table-striped table-hover w-100">
                            <thead class="thead-dark">
                                <tr>
                                    <th>{{ __('ID') }}</th>
                                    <th>{{ __('Season') }}</th>
                                    <th>{{ __('Price (INR)') }}</th>
                                    <th>{{ __('Start Date') }}</th>
                                    <th>{{ __('End Date') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($seasonalPrices as $price)
                                <tr data-id="{{ $price->id }}" data-season="{{ $price->season }}"
                                    data-price="{{ $price->price }}"
                                    data-start-date="{{ $price->start_date->format('Y-m-d') }}"
                                    data-end-date="{{ $price->end_date->format('Y-m-d') }}">
                                    <td>{{ $price->id }}</td>
                                    <td>{{ ucwords(str_replace('_', ' ', $price->season)) }}</td>
                                    <td>₹{{ number_format($price->price, 2) }}</td>
                                    <td>{{ $price->start_date->format('Y-m-d') }}</td>
                                    <td>{{ $price->end_date->format('Y-m-d') }}</td>
                                    <td>
                                        <button class="btn btn-xs btn-outline-info py-0 mx-1 edit-price" title="Edit">
                                            <i class="fa fa-pencil-square-o"></i>
                                        </button>
                                        <a onClick="if (confirm('Are you sure?')) return this.nextElementSibling.submit();"
                                            href="javascript:;" title="Delete"
                                            class="btn btn-xs btn-outline-danger py-0 mx-1">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                        <form
                                            action="{{ route('admin.boat-charter.seasonal-prices.destroy', [$package->id, $price->id]) }}"
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
                                    class="btn btn-block btn-info my-1">
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
    .form-control {
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
        const form = $('#seasonal-price-form');
        const submitBtn = $('#submit-btn');
        const cancelBtn = $('#cancel-btn');
        const priceIdInput = $('#price_id');
        const storeUrl = "{{ route('admin.boat-charter.seasonal-prices.store', $package->id) }}";

        $('#seasonal-prices-table').DataTable({
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
                    filename: 'seasonal-prices',
                    className: 'btn btn-xs btn-dark py-1',
                    exportOptions: {
                        columns: ':visible:not(:last-child)'
                    }
                },
                {
                    extend: 'excel',
                    text: 'Excel',
                    filename: 'seasonal-prices',
                    className: 'btn btn-xs btn-dark py-1',
                    exportOptions: {
                        columns: ':visible:not(:last-child)'
                    }
                },
                {
                    extend: 'pdf',
                    text: 'PDF',
                    filename: 'seasonal-prices',
                    className: 'btn btn-xs btn-dark py-1',
                    exportOptions: {
                        columns: ':visible:not(:last-child)'
                    }
                }
            ]
        });

        $('.edit-price').on('click', function() {
            const row = $(this).closest('tr');
            const priceId = row.data('id');
            const season = row.data('season');
            const price = row.data('price');
            const startDate = row.data('start-date');
            const endDate = row.data('end-date');

            $('#season').val(season);
            $('#price').val(price);
            $('#start_date').val(startDate);
            $('#end_date').val(endDate);
            priceIdInput.val(priceId);

            form.attr('action', "{{ url('admin/boat-charter/' . $package->id . '/seasonal-prices') }}/" + priceId);
            form.find('input[name="_method"]').remove().end().append('<input type="hidden" name="_method" value="PUT">');
            submitBtn.text('Update Seasonal Price').removeClass('btn-success').addClass('btn-primary');
            cancelBtn.removeClass('d-none');
        });

        cancelBtn.on('click', function() {
            form.attr('action', storeUrl);
            form.find('input[name="_method"]').remove();
            submitBtn.text('Add Seasonal Price').removeClass('btn-primary').addClass('btn-success');
            cancelBtn.addClass('d-none');
            priceIdInput.val('');
            $('#season').val('');
            $('#price').val('');
            $('#start_date').val('');
            $('#end_date').val('');
        });

        form.on('submit', function(event) {
            console.log('Form submission attempted');
            if (!form[0].checkValidity()) {
                event.preventDefault();
                console.log('Form validation failed');
            }
        });
    });
</script>
@endpush
@endsection