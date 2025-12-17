@extends('admin.layouts.app')

@section('title', __('Tour Package Booking'))

@section('content')
    <!-- Heading -->
    <div class="breadcrumbs">
        <div class="breadcrumbs-inner">
            <div class="row">
                <div class="col-sm-4">
                    <div class="page-header float-left">
                        <div class="page-title">
                            <h1>{{ __('Tour Package Booking') }}</h1>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="page-header float-right">
                        <div class="page-title">
                            <ol class="breadcrumb text-right">
                                <li><a href="{{ url('admin/home') }}">{{ __('Dashboard') }}</a></li>
                                <li><a href="{{ route('admin.bookings.tour-package') }}">{{ __('Bookings') }}</a></li>
                                <li class="active">{{ __('Tour Booking') }}</li>
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
            <div class="row mb-3">
                <div class="col-md-3 col-sm-6 mb-2">
                    <div class="card text-white bg-primary">
                        <div class="card-body">
                            <h6>Total Cost</h6>
                            <h4>₹{{ number_format($data['pricing']['grand_total'], 2) }}</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mb-2">
                    <div class="card text-white bg-success">
                        <div class="card-body">
                            <h6><i class="fa fa-credit-card-alt" aria-hidden="true"></i> Guest Paid</h6>
                            <h4>₹{{ number_format($data['payments'][0]['status'] == 'completed' ? array_sum(array_column($data['payments'], 'amount')) : 0, 2) }}
                            </h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mb-2">
                    <div class="card text-white bg-info">
                        <div class="card-body">
                            <h6><i class="fa fa-building-o" aria-hidden="true"></i> Hotel Payment</h6>
                            <h4>
                                ₹{{ number_format(array_sum(array_map(function ($item) {
        return $item['hotelbookings']['total_cost'] ?? 0; }, $data['itinerary'])), 2) }}
                            </h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mb-2">
                    <div class="card text-white bg-info">
                        <div class="card-body">
                            <h6><i class="fa fa-ship" aria-hidden="true"></i> Ferrry Payment</h6>
                            <h4>
                              @php
                                    $ferries = $data['itinerary'][0]['ferries'];
                                    $ferrytotalCost = array_sum(array_map(fn($ferry) => 
                                        ($ferry['Adult'] ?? 0) * ($ferry['totalCost'] ?? 0) + 
                                        ($ferry['Adult'] ?? 0) * ($ferry['Psf'] ?? 0)
                                    , $ferries));
                                @endphp

                                ₹{{ number_format($ferrytotalCost, 2) }}


                            </h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mb-2">
                    <div class="card text-white bg-info">
                        <div class="card-body">
                            <h6><i class="fa fa-car" aria-hidden="true"></i> Cab Cost</h6>
                            <h4>

                                ₹{{ number_format(array_sum(array_map(fn($item) => $item['service_total'] ?? 0, $data['itinerary'])), 2) }}


                            </h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mb-2">
                    <div class="card text-white bg-info">
                        <div class="card-body">
                            <h6><i class="fa fa-id-card-o" aria-hidden="true"></i> Activity Tickets</h6>
                            <h4>

                                ₹{{ number_format(array_sum(array_map(fn($item) => $item['activity_total'] ?? 0, $data['itinerary'])), 2) }}


                            </h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mb-2">
                    <div class="card text-white bg-danger">
                        <div class="card-body">
                            <h6>Balance Payment</h6>
                            @php
                                $total = $data['pricing']['grand_total'];
                                $balance = $data['pricing']['grand_total'] - array_sum(array_column($data['payments'], 'amount'));
                            @endphp
                            <h4>₹{{ number_format($data['payments'][0]['status'] == 'completed' ? $balance : $total, 2) }}
                            </h4>
                        </div>
                    </div>
                </div>
            </div>

            @php
                $accommodation = collect($data['tour']['tour_itinerary'])->pluck('accommodation')->filter()->values();

                $nights = [];
                $count = 1;
                for ($i = 1; $i < $accommodation->count(); $i++) {
                    if ($accommodation[$i] === $accommodation[$i - 1]) {
                        $count++;
                    } else {
                        $nights[] = ['nights' => $count, 'accommodation' => $accommodation[$i - 1]];
                        $count = 1;
                    }
                }
                $nights[] = ['nights' => $count, 'accommodation' => $accommodation->last()];
            @endphp


            <div class="card mb-3">
                <div class="card-header">Package Information</div>
                <div class="card-body">
                    <div class="d-flex">
                    <div class="col-lg-8 col-12">
                    <p><strong>Package:</strong>
                        {{ $data['tour']['package_name'] . ', ' . $data['category'] . ', ' . $data['tour']['tour_category']['name'] }}
                        Tour Package</p>
                    <p><strong>Duration:</strong>
                        @foreach ($nights as $night)
                            • {{ $night['nights'] }}N {{ $night['accommodation'] }}
                        @endforeach
                    </p>
                    <p><strong>Booked By:</strong> {{ ucwords($data['payments'][0]['name']) }}</p>
                    <p><strong>Contact :</strong> {{ $data['payments'][0]['phone'] }}</p>
                    <p><strong>Email :</strong> <a href="mailto:{{ $data['payments'][0]['email']}}">{{ ucwords($data['payments'][0]['email']) }}</a></p>
                    <p><strong>Status:</strong>
                        {{ $data['payments'][0]['status'] == 'completed' ? 'Confirmed' : 'Pending' }}</p>
                        </div>
                        <div class="col-lg-4 col-12 text-right">
                             <a href="{{ route('travel-itinerary', ['trip_code' => $data['itinerary'][0]['search_hash']]) }}"
                                    id="download-itinerary" class="btn btn-outline-primary btn-sm">
                                    <i class="fa fa-download me-2"></i>Download Itinerary
                                </a>
                        </div>
                        </div>  
                </div>
            </div>

            <div id="accordion">
                <div class="card">
                    <div class="card-header" id="headingGuests">
                        <h5 class="mb-0">
                            <button class="btn btn-link text-white" data-toggle="collapse" data-target="#collapseGuests"
                                aria-expanded="true" aria-controls="collapseGuests">Guest Details</button>
                        </h5>
                    </div>
                    <div id="collapseGuests" class="collapse show" aria-labelledby="headingGuests" data-parent="#accordion">
                        <div class="card-body">
                            <table class="table table-sm table-bordered mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Age</th>
                                        <th>Category</th>
                                        <th>Gender</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data['guest_detail'] as $pax)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $pax->prefix . ' ' . ucfirst($pax->name) . ' ' . $pax->m_name . ' ' . $pax->l_name }}
                                            </td>
                                            <td>{{ $pax->age }}</td>
                                            <td>{{ $pax->age > 1 ? 'Adult' : 'Infant' }}</td>
                                            <td>{{ ucfirst($pax->gender) }}</td>

                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header" id="headingPricing">
                        <h5 class="mb-0">
                            <button class="btn btn-link text-white collapsed" data-toggle="collapse"
                                data-target="#collapsePricing" aria-expanded="false" aria-controls="collapsePricing">Service
                                Costs & Pricing Breakup</button>
                        </h5>
                    </div>
                    <div id="collapsePricing" class="collapse" aria-labelledby="headingPricing" data-parent="#accordion">
                        <div class="card-body">
                            <table class="table table-sm table-bordered mb-3">
                                <tbody>
                                    <tr>
                                        <th>Cab Cost</th>
                                        <td>₹{{ number_format(array_sum(array_map(fn($item) => $item['service_total'] ?? 0, $data['itinerary'])), 2) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Activity Ticekt</th>
                                        <td>₹{{ number_format(array_sum(array_map(fn($item) => $item['activity_total'] ?? 0, $data['itinerary'])), 2) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Ferry Cost</th>
                                    
                               

                                        <td>₹{{ number_format($ferrytotalCost, 2) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Hotel Cost</th>
                                        <td>₹{{ number_format(array_sum(array_map(function ($item) {
        return $item['hotelbookings']['total_cost'] ?? 0; }, $data['itinerary'])), 2) }}


                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="table table-sm table-bordered">
                                <tbody>
                                    <tr>
                                        <th>Base Price</th>
                                        <td>₹{{ $data['pricing']['base_total'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>Margin</th>
                                        <td>{{ number_format($data['pricing']['markup']) }}%</td>
                                    </tr>
                                    <tr>
                                        <th>Discount</th>
                                        <td>₹{{ number_format($data['pricing']['total_with_markup'] - $data['pricing']['total_with_discount'],2) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Taxes</th>
                                        <td>₹{{ number_format($data['pricing']['gst_amount'],2) }}</td>
                                    </tr>

                                    <tr>
                                        <th>Total Cost</th>
                                        <td><strong>₹{{ number_format($data['pricing']['grand_total'],2) }}</strong></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header" id="headingPayments">
                        <h5 class="mb-0">
                            <button class="btn btn-link text-white collapsed" data-toggle="collapse"
                                data-target="#collapsePayments" aria-expanded="false"
                                aria-controls="collapsePayments">Payments</button>
                        </h5>
                    </div>
                    <div id="collapsePayments" class="collapse" aria-labelledby="headingPayments" data-parent="#accordion">
                        <div class="card-body">
                            <table class="table table-sm table-bordered mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Date</th>
                                        <th>Amount</th>
                                        <th>Order Id</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data['payments'] as $pay)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ \Carbon\Carbon::parse($pay['updated_at'])->format('d-m-y, H:i A') }}
                                            </td>
                                            <td>₹{{ number_format($pay['amount'], 2) }}</td>
                                            <td>{{ $pay['order_id'] }}</td>
                                            <td>{{ $pay['status'] == 'completed' ? 'Completed' : 'Cancelled' }}</td>
                                        </tr>
                                    @endforeach


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header" id="headingTickets">
                        <h5 class="mb-0">
                            <button class="btn btn-link text-white collapsed" data-toggle="collapse"
                                data-target="#collapseTickets" aria-expanded="false" aria-controls="collapseTickets">Tickets
                            </button>
                        </h5>
                    </div>
                    <div id="collapseTickets" class="collapse" aria-labelledby="headingTickets" data-parent="#accordion">
                        <div class="card-body">
                            @foreach ($data['itinerary'] as $iti)
                                <div class="card mb-2 border-primary">
                                    <div class="card-header bg-primary text-white">Day {{ $loop->index + 1 }} -
                                        {{ \Carbon\Carbon::parse($iti['start_date'])->format('d-m-Y') }}
                                    </div>
                                    <div class="card-body">

                                        {{-- Hotel Card --}}
                                        <div class="row mb-2">
                                            @if($iti['hotelbookings'] !== null)
                                                <div class="col-md-6">
                                                    <div class="card border-info shadow-sm">
                                                        <div class="card-body">
                                                            <h4 class="card-title py-0 my-0">
                                                                {{ $iti['accomodation']['hotel_name'] }}</h4>
                                                            <h6 class="card-title py-0 my-0">{{ $iti['room_name'] }}</h6>
                                                            <p class="py-0 mb-0">Check-in:
                                                                {{ \Carbon\Carbon::parse($iti['start_date'])->format('d-m-Y') }}
                                                                | Check-out:
                                                                {{ \Carbon\Carbon::parse($iti['start_date'])->addDay()->format('d-m-Y') }}
                                                            </p>
                                                            <p class="py-0 mb-0">Rooms: {{ $iti['hotelbookings']['rooms']}}
                                                            </p>
                                                            <a href="{{ route('hotel.package.voucher', ['book_id' => $iti['hotelbookings']['id']]) }} " target="_blank"
                                                                class="ticket-btn btn btn-sm btn-info downloads downloads {{ $data['payments'][0]['status'] == 'completed' ? 'active' : '' }}">Download
                                                                Voucher</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif

                                            {{-- Ferries Card(s) --}}
                                            @if (!empty($iti['ferries'][$loop->index]))
                                                @php
                                                    $ferry = $iti['ferries'][$loop->index];
                                                @endphp
                                                <div class="col-md-6">
                                                    <div class="card border-success shadow-sm">
                                                        <div class="card-body">
                                                            <h6 class="card-title pb-0 mb-0">{{ $ferry['ferry'] ?? '' }}
                                                                ({{ $ferry['class'] ?? '' }})
                                                            </h6>
                                                            <p class="pb-0 mb-0">From: {{ $ferry['from_location'] ?? '' }} | To:
                                                                {{ $ferry['to_location'] ?? '' }}
                                                            </p>
                                                            <p class="pb-0 mb-0">Travel Date:
                                                                {{ isset($ferry['travel_date']) ? \Carbon\Carbon::parse($ferry['travel_date'])->format('d-m-Y') : '' }}
                                                                {{ \Carbon\Carbon::parse($ferry['embarkation'])->format('H:i A') }}
                                                                -
                                                                {{ \Carbon\carbon::parse($ferry['disembarkation'])->format('H:i A') }}
                                                            </p>
                                                            <a href="{{ route('ferry-ticket', ['token' => $ferry['pnr_no'] ?? 'not book']) }}"
   target="_blank"
   class="btn btn-sm btn-success downloads {{ $data['payments'][0]['status'] == 'completed' ? 'active' : '' }}">
   Download Ferry Ticket
</a>

                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- /.content -->
@endsection

@section('css')
    <style>
        .card-header {
            background-color: #17a2b8;
            color: white;
            font-weight: 600;
        }

        .ticket-btn {
            background-color: #28a745;
            color: #fff;
            border: none;
            padding: 4px 8px;
            font-size: 13px;
            border-radius: 4px;
            text-decoration: none;
        }

        .card-header h5 {
            margin: 0;
        }

        @media (max-width: 576px) {
            .card-body .row>div {
                margin-bottom: 10px;
            }
        }
      .downloads {
    opacity: 0.6;
    pointer-events: none;
    cursor: not-allowed;
}

.downloads.active {
    opacity: 1;
    pointer-events: auto;
    cursor: pointer;
}

    </style>
@endsection

@section('script')
    <script type="text/javascript"></script>
@endsection