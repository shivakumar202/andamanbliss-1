<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Bike Rental Voucher</title>
    <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            margin: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        th,
        td {
            border: 1px solid #8a8888ff;
            padding: 6px 8px;
            text-align: left;
            vertical-align: top;
        }

        th {
            font-weight: bold;
        }

        .section-title {
            font-weight: bold;
            font-size: 14px;
            margin-top: 20px;
            margin-bottom: 5px;
        }

        .header-table,
        .header-table td {
            border: none;
            padding: 0;
            margin: 0;
        }

        .header-logo img {
            width: 120px;
            height: auto;
        }

        .header-info {
            text-align: right;
        }

        .text-success {
            color: green;
            font-weight: bold;
        }

        .text-warning {
            color: #fc8f00;
            font-weight: bold;
        }

        .footer {
            margin-top: 20px;
            font-weight: bold;
            text-align: right;
        }

        .title-note {
            font-size: 10px;
            color: red;
        }
    </style>
</head>

<body>

    <!-- Header -->
    <table class="header-table">
        <tr>
            <td class="header-logo">
                <img src="{{ asset('site/img/logo.png') }}" alt="Andaman Bliss™ Logo">
            </td>
            <td class="header-info">
                <p><strong>BOOKING ID:</strong> {{ '#AB-'.str_pad($billingDetails->id,6,'0',STR_PAD_LEFT) }}</p>
                <p><strong>Booking Date:</strong> {{ \Carbon\Carbon::parse($billingDetails->created_at)->format('d M Y h:i A') }}</p>
                <p><strong>Payment Status:</strong>
                    <span class="{{ ($billingDetails->total_fare - $billingDetails->payment->amount) == 0 ? 'text-success' : 'text-warning' }}">
                        {{ ($billingDetails->total_fare - $billingDetails->payment->amount) == 0 ? 'Fully Paid' : 'Partially Paid' }}
                    </span>
                </p>
            </td>
        </tr>
    </table>

    <!-- Customer Details -->
    <div class="section-title">Customer Details</div>
  <table style="border-collapse: collapse; width: 100%;">
    <tr>
        <th>Name</th>
        <td>{{ $billingDetails->name ?? '-' }}</td>
        <th>Contact</th>
        <td>{{ $billingDetails->contact ?? '-' }}</td>
    </tr>
    <tr>
        <th>Email</th>
        <td colspan="3">{{ $billingDetails->email ?? '-' }}</td>
    </tr>
</table>


    <!-- Booking Details -->
    <div class="section-title">Booking Details</div>
    <table>
        <tr>
            @if($cab->name)
            <th>Vehicle</th>
            <td>{{ $cab->name }}</td>
            <th>Location</th>
            <td>{{$billingDetails->from_location}}</td>
            @endif
            @if($billingDetails->cabPackages->cabPricing->name ?? null)
            <th>Package ID</th>
            <td>{{ $billingDetails->cabPackages->cabPricing->name }}</td>
            @endif
        </tr>
        
        <tr>
            @if($billingDetails->cab_quantity)
            <th>Vehicle Nos.</th>
            <td>{{ $billingDetails->cab_quantity }}</td>
            @endif
            @if($billingDetails->status)
            <th>Booking Status</th>
            <td>{{ ucfirst($billingDetails->status) }}</td>
            @endif
        </tr>
    </table>

    <!-- Travel Details -->
    @if($billingDetails->pickup_location || $billingDetails->pickup_date || $billingDetails->pickup_time || $billingDetails->return_date || $billingDetails->return_time || !empty($billingDetails->cabPackages->from_location))
    <div class="section-title">Travel Details <span class="title-note">(Kindly ensure you drop off your bike at the original pickup location.)</span></div>
    <table>
        <tr>
            @if($billingDetails->pickup)
            <th>Pickup Type</th>
            <td>{{ $billingDetails->pickup }}</td>
            @endif
            @if($billingDetails->pickup_location || ($locations ?? false))
            @php
                if($billingDetails->pickup_location != '')
                    {
                    $loc =  $billingDetails->pickup_location;
                    }
                else {
                    $loc = $locations->pick_location;
                }
                $map_loc = 'https://www.google.com/maps/search/?api=1&query='.urlencode($loc);
            @endphp
            <th>Pickup Location</th>
            <td><a href="{{$map_loc}}" target="_blank" style="text-decoration: none;"><i class="fa-solid fa-location-dot" style="color:red;"></i> {{ $loc }}</a></td>
            @endif

        </tr>
        @if($billingDetails->pickup_date || $billingDetails->pickup_time)
        <tr>
            <th>Pickup Date & Time</th>
            <td colspan="3">{{ $billingDetails->pickup_date ?? '' }} {{ $billingDetails->pickup_time ?? '' }}</td>
        </tr>
        @endif
        @if($billingDetails->return_date || $billingDetails->return_time)
        <tr>
            <th>Return Date & Time</th>
            <td colspan="3">{{ $billingDetails->return_date ?? '' }} {{ $billingDetails->return_time ?? '' }}</td>
        </tr>
        @endif

    </table>
    @endif

    <!-- Payment Details -->
    @if($billingDetails->total_fare || $billingDetails->payable)
    <div class="section-title">Payment Details</div>
    <table>
        <tr>
            @if($billingDetails->total_fare)
            <th>Total Fare</th>
            <td>₹{{ number_format($billingDetails->total_fare, 2) }}</td>
            @endif
            @if($billingDetails->payable)
            <th>Total Paid</th>
            <td>₹{{ number_format($billingDetails->payable, 2) }}</td>
            @endif
        </tr>
        @if($billingDetails->total_fare && $billingDetails->payable)
        <tr>
            <th>Total Balance</th>
            <td colspan="3">₹{{ number_format($billingDetails->total_fare - $billingDetails->payable, 2) }}</td>
        </tr>
        @endif
    </table>
    @endif

    <p class="title-note">A security deposit of ₹2000 will be collected at the time of bike pickup and returned after the ride.</p>

    <div class="footer">
        Total Payable (Pay on arrival): ₹{{ number_format(($billingDetails->total_fare - $billingDetails->payable) ?? 0, 2) }}
    </div>

</body>

</html>