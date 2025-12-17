@extends('admin.layouts.app')

@section('title', __('Tour Services'))

@section('content')
<!-- Heading -->
<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>{{ __('Tour Services') }}</h1>
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="{{ url('admin/home') }}">{{ __('Dashboard') }}</a></li>
                            <li class="active">{{ __('Tour Services') }}</li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="col-sm-2">
                <button class="btn btn-success float-right my-2 mx-3" data-toggle="modal" data-target="#uploadModal">
                    <i class="fa fa-upload"></i>&nbsp;{{ __('Upload') }}
                </button>
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
                    <div class="card-header">
                        <strong class="card-title">{{ __('Tour Activity Services') }}</strong>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="serviceLocationFilter" class="font-weight-bold mr-2">Filter by Service
                                Location:</label>
                            <select id="serviceLocationFilter" class="form-control d-inline-block w-auto">
                                <option value="">All</option>
                                @php
                                $locations = $activities->pluck('location')->unique();
                                @endphp
                                @foreach($locations as $location)
                                <option value="{{ $location }}">{{ $location }}</option>
                                @endforeach
                            </select>
                        </div>

                        <table id="dataTable" class="table table-striped table-hover w-100">
                            <thead class="thead-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Service Location</th>
                                    <th>Activity Name</th>
                                    <th>Age Limit</th>
                                    <th>Description</th>
                                    <th>Duration</th>
                                    <th>Slots</th>
                                    <th>Adult Cost</th>
                                    <th>Child Cost</th>
                                    <th>Infant Cost</th>                                 
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($activities as $service)
                                <tr>
                                    <td>{{ $service->id }}</td>
                                    <td>{{ $service->location }}</td>
                                    <td>{{ $service->service_name }}</td>
                                    <td>{{ $service['age-limit'] }}</td>
                                    <td>{{ $service->description }}</td>
                                    <td>{{ $service->duration }}</td>
                                    <td>{{ $service->slots }}</td>
                                    <td>{{ $service->adult_cost }}</td>
                                    <td>{{ $service->child_cost }}</td>
                                    <td>{{ $service->infant_cost }}</td>
                                 
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

<!-- Upload Modal -->
<div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="POST" action="{{ route('admin.tours.activityServices') }}" enctype="multipart/form-data">
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
                        <label for="file">Select File (.csv or .xlsx)</label>
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
@endsection

@section('script')
<script type="text/javascript">
    $(document).ready(function () {
        const table = $('#dataTable').DataTable({
            responsive: true,
            lengthMenu: [[5, 10, 50, 100, -1], [5, 10, 50, 100, 'All']],
            pageLength: 5,
            aaSorting: [0, 'DESC'],
            columnDefs: [
                { targets: [0], visible: false },
                { targets: [0, 8], orderable: false },
                { targets: [0, 8], searchable: false },
            ],
            dom: '<"row mb-2"<"col-sm-3"l><"col-sm-4"B><"col-sm-5"f>>' +
                 '<"row"<"col-sm-12"tr>>' +
                 '<"row"<"col-sm-5"i><"col-sm-7"p>>',
            buttons: [
                {
                    extend: 'csvHtml5',
                    text: '<i class="fa fa-download mr-1"></i>Download CSV',
                    filename: function () {
                        const now = new Date();
                        const pad = n => n.toString().padStart(2, '0');
                        const yyyy = now.getFullYear();
                        const mm = pad(now.getMonth() + 1);
                        const dd = pad(now.getDate());
                        const hh = pad(now.getHours());
                        const min = pad(now.getMinutes());
                        return `tour_services_${yyyy}-${mm}-${dd}_${hh}-${min}`;
                    },
                    className: 'btn btn-xs btn-info py-1',
                    exportOptions: {
                        columns: [1, 2, 3, 4, 5, 6, 7, 8, 9]
                    },
                    customize: function (csv) {
                        const customHeader = 'location,service_name,age-limit,description,duration,slots,Adult_cost,Child_cost,infant_cost\n';
                        return customHeader + csv.split('\n').slice(1).join('\n');
                    }
                }
            ]
        });

        $('#serviceLocationFilter').on('change', function () {
            const value = $(this).val();
            table.column(1).search(value).draw(); 
        });
    });
</script>
@endsection