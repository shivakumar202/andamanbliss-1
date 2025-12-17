@extends('admin.layouts.app')

@section('title', 'Cab Pricing')

@section('content')
<div class="content">
    <div class="animated fadeIn">

        {{-- Filter Form --}}
        <div class="card">
            <div class="card-header"><strong>Filter</strong></div>
            <div class="card-body">
                <form method="GET" action="{{ url('admin/cab/packages/pricing') }}" autocomplete="off">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>Location</label>
                            <select name="location" class="form-control">
                                <option value="">All</option>
                                @foreach($pricings->pluck('location')->unique() as $loc)
                                <option value="{{ $loc }}" {{ request('location') == $loc ? 'selected' : '' }}>
                                    {{ ucfirst($loc) }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Seat Type</label>
                            <select name="seat_type" class="form-control">
                                <option value="">All</option>
                                @foreach($pricings->pluck('seat_type')->unique() as $seat)
                                <option value="{{ $seat }}" {{ request('seat_type') == $seat ? 'selected' : '' }}>
                                    {{ ucfirst($seat) }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4 align-self-end">
                            <button type="submit" class="btn btn-info">
                                <i class="fa fa-filter"></i> Filter
                            </button>
                            <a href="{{ url('admin/cab/packages/pricing') }}" class="btn btn-outline-secondary">
                                <i class="fa fa-refresh"></i> Reset
                            </a>
                        </div>
                    </div>
                </form>
            </div>
            @include('admin.layouts.alert')
        </div>

        {{-- Table --}}
        <div class="card">
           <div class="card-header">
                <strong class="card-title">Upload Pricing</strong>
                <button class="btn btn-success float-right my-2 mx-3" data-toggle="modal" data-target="#uploadModal">
                    <i class="fa fa-upload"></i>&nbsp;{{ __('Upload') }}
                </button>
            </div>

            <div class="card-body">
                <table id="dataTable" class="table table-striped table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Location</th>
                            <th>Category</th>
                            <th>Base Price</th>
                            <th>Price Type</th>
                            <th>Seat Type</th>
                            <th>Distance Covered</th>
                            <th>Extra Fare</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pricings as $pricing)
                        @if((!request('location') || request('location') == $pricing->location) &&
                        (!request('seat_type') || request('seat_type') == $pricing->seat_type))
                        <tr>
                            <td>{{ $pricing->id }}</td>
                            <td>{{ $pricing->name }}</td>
                            <td>{{ $pricing->location }}</td>
                            <td>{{$pricing->category}}</td>
                            <td>{{ $pricing->base_price }}</td>
                            <td>{{ $pricing->price_type }}</td>
                            <td>{{ $pricing->seat_type }}</td>
                            <td>{{ $pricing->distance_covered }}</td>
                            <td>{{ $pricing->extra_fare }}</td>
                            <td>
                                <a href="{{ url('admin/cab/packages/pricing/' . $pricing->id . '/edit') }}" class="btn btn-sm btn-outline-info">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <form action="{{ url('admin/cab/packages/pricing/' . $pricing->id) }}" method="POST" style="display:inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this pricing?')">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    <div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="POST" action="{{ route('admin.cabs.pricing', ['cabId' => 'null']) }}" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadModalLabel">Upload CSV</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="file">Select File (.csv)</label>
                        <input type="file" name="file" class="form-control" required accept=".csv,.xlsx">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </div>
            </div>
        </form>
    </div>
</div>
</div>
@endsection

@section('script')
<script>
   
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
                    targets: [0, 8], // column index
                    orderable: false,
                },
                {
                    targets: [0, 8], // column index
                    searchable: false,
                },
                {
                    targets: [0], // column index
                    visible: false,
                }
            ],
            dom: '<"row"<"col-sm-3"l><"col-sm-4"B><"col-sm-5"f>>' +
                '<"row"<"col-sm-12"tr>>' +
                '<"row"<"col-sm-5"i><"col-sm-7"p>>',
            buttons: [{
                    extend: 'csv',
                    text: 'CSV',
                    filename: 'cab_packages',
                    className: 'btn btn-xs btn-dark py-1',
                
                },
                {
                    extend: 'excel',
                    text: 'Excel',
                    filename: 'cab_packages',
                    className: 'btn btn-xs btn-dark py-1',
                    exportOptions: {
                        columns: ':visible:not(:last-child)'
                    }
                },
                {
                    extend: 'pdf',
                    text: 'PDF',
                    filename: 'cab_packages',
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