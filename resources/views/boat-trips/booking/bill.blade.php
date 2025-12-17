<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Boat Trip Booking Voucher</title>
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
                    <span class="{{ ($billingDetails->total_amt - $billingDetails->payment->amount) == 0 ? 'text-success' : 'text-warning' }}">
                        {{ ($billingDetails->total_amt - $billingDetails->payment->amount) == 0 ? 'Fully Paid' : 'Partially Paid' }}
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
            <td>{{ $billingDetails->payment->name ?? '-' }}</td>
            <th>Contact</th>
            <td>{{ $billingDetails->payment->phone ?? '-' }}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td colspan="3">{{ $billingDetails->payment->email ?? '-' }}</td>
        </tr>
    </table>


    <!-- Booking Details -->
    <div class="section-title">Booking Details</div>
    <table>
        <tr>
            <th>Trip</th>
            <td>{{ $billingDetails->trip_name }}</td>
            <th>Trip Date & Time </th>
            <td>{{ \Carbon\carbon::parse($billingDetails->trip_date)->format('d-M-y') .' - Slot '. \Carbon\carbon::parse($billingDetails->slot_time)->format('H:i A') }}</td>
        </tr>

    </table>

   <!-- Travel Details -->
<div class="section-title">
    Travel Details <span class="title-note">(Kindly ensure you carry a valid ID.)</span>
</div>
<table>
    <thead>
        <tr>
            <th>Sl.</th>
            <th>Name</th>
            <th>Age</th>
            <th>Gender</th>
        </tr>
    </thead>
    <tbody>
        @foreach($billingDetails->pax as $pax)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $pax->prefix .'. '. $pax->name .' '. $pax->m_name .' '. $pax->last_name }}</td>
            <td>{{ $pax->age }} {{ $pax->age <= 3 ? '(Infant)' : '' }}</td>
            <td>{{ $pax->gender }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

    <!-- Payment Details -->
    <div class="section-title">Payment Details</div>
    <table>
        <tr>
            <th>Total Fare</th>
            <td style="text-align: right;">₹{{ number_format($billingDetails->base_cost, 2) }}</td>
        </tr>
        <tr>
            <th>Tax & Service</th>
            <td style="text-align: right;">₹{{ number_format($billingDetails->tax,2) }}</td>
        </tr>
        <tr>
            <th>Total Amount</th>
            <td style="text-align: right;">₹{{ number_format($billingDetails->total_amt, 2) }}</td>
        </tr>       
    </table>

</body>

</html>