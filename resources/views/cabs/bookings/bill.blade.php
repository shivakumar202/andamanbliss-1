<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Cab Booking Voucher</title>
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
        <td>{{ $billingDetails->name ?? '-' }}</td>
        <th>Contact</th>
        <td>{{ $billingDetails->phone ?? '-' }}</td>
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
            <th>Vehicle</th>
            <td>{{ $billingDetails->cab }}</td>         
            <th>Trip Type</th>      
            <td>{{ $billingDetails->trip_type }}</td>
        </tr>

              <tr>
               <th>Trip</th>
            <td colspan="3">{{$billingDetails->pickup_location}} <strong>To</strong> {{$billingDetails->drop_location}}</td>
        </tr>
        
       
    </table>

    <!-- Travel Details -->
    <div class="section-title">Travel Details <span class="title-note">(Kindly ensure you drop off will be the pickup location.)</span></div>
    <table>
        <tr>
            
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
            

        </tr>
        <tr>
            @php
                if($billingDetails->drop_location != '')
                    {
                    $dloc =  $billingDetails->drop_location;
                    }
                else {
                    $dloc = $locations->drop_location;
                }
                $drop_loc = 'https://www.google.com/maps/search/?api=1&query='.urlencode($dloc);
            @endphp
             <th>Drop Location</th>
            <td><a href="{{$drop_loc}}" target="_blank" style="text-decoration: none;"><i class="fa-solid fa-location-dot" style="color:red;"></i> {{ $dloc }}</a></td>
        </tr>
        <tr>
            <th>Pickup Date & Time</th>
            <td colspan="3">{{ $billingDetails->pickup_date ?? '' }} {{ $billingDetails->pickup_time ?? '' }}</td>
        </tr>
      
    </table>

    <!-- Payment Details -->
    <div class="section-title">Payment Details</div>
    <table>
        <tr>
            <th>Total Fare</th>
            <td>₹{{ number_format($billingDetails->total_amt, 2) }}</td>
            <th>Total Paid</th>
            <td>₹{{ number_format($billingDetails->paid, 2) }}</td>
        </tr>
        <tr>
            <th>Total Balance</th>
            <td colspan="3">₹{{ number_format($billingDetails->total_amt - $billingDetails->paid, 2) }}</td>
        </tr>
    </table>
   
    <p class="title-note">Please Be on Time...</p>

    <div class="footer">
        Total Payable (Pay on arrival): ₹{{ number_format(($billingDetails->total_amt - $billingDetails->paid) ?? 0, 2) }}
    </div>

</body>

</html>