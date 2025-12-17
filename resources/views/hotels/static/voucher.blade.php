<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Hotel Voucher</title>
    <style>
        .voucher {
            background: #fff;
            margin: auto;
            padding: 10px;
            border: 1px solid #ccc;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        td,
        th {
            padding: 8px 10px;
            vertical-align: top;
        }

        .section-title {
            font-size: 18px;
            font-weight: bold;
            margin-top: 20px;
            padding-bottom: 5px;
            border-bottom: 2px solid #333;
        }

        .text-right {
            text-align: right;
        }

        .text-bold {
            font-weight: bold;
        }

        .highlight {
            background-color: #e6f7ff;
        }

        .info-note {
            font-size: 13px;
            color: #444;
        }

        .bordered td {
            border: 1px solid #ddd;
        }
    </style>
</head>

<body>
    <div class="voucher">
        <table>
            <tr>
                <td><img src="site/img/logo.png" alt="Logo" width="100"></td>
                <td class="text-right">
                    <strong>Booking Voucher</strong><br>
                    Booking ID: {{$bookingDetail['BookingId']}}<br>
                    INVOICE: {{$bookingDetail['InvoiceNumber'] ?? ''}}<br>
                    Booked on: {{ \Carbon\Carbon::parse($bookingDetail->created_at)->format('d F Y , H:i A') }}
                </td>
            </tr>
        </table>

        <div class="section-title">Hotel Information</div>
        <table>
            <tr>
                <td><strong>Hotel:</strong>
                    {{ ucwords($bookingDetail['hotel']['hotel_name'] . ' , ' . $bookingDetail['hotel']['city_name']) }}
                </td>
            </tr>
            <tr>
                <td>
                    {{ ucwords($bookingDetail['hotel']['address']) }}<br>
                    Phone : {{ $bookingDetail['hotel']['phone_number'] }}<br>
                </td>
            </tr>
        </table>

        <div class="section-title">Guest & Stay Details</div>
        <table class="bordered">
            @php
    $groupedGuests = collect($bookingDetail->passengerDetails)->groupBy('group');
@endphp

@foreach ($groupedGuests as $room => $guests)
    @php
        $primaryGuest = $guests->first();
        $adultCount = $guests->where('age', 0)->count();
        $childCount = $guests->where('age', '>', 0)->count();
    @endphp
    <tr>
        <td><strong>{{ ucfirst($room) }} - Guest:</strong><br>{{ $primaryGuest->prefix }} {{ $primaryGuest->name }}</td>
        <td><strong>Contact:</strong><br>{{ $bookingDetail->paymentDetails[0]->email ?? '' }}<br>{{ $bookingDetail->paymentDetails[0]->phone ?? '' }}</td>
        <td><strong>Guests:</strong><br>{{ $guests->count() }} ({{ $adultCount }} Adult{{ $adultCount > 1 ? 's' : '' }}{{ $childCount ? ' & ' . $childCount . ' Child' . ($childCount > 1 ? 'ren' : '') : '' }})</td>
    </tr>
@endforeach


            <tr>
                <td><strong>Check-in:</strong><br>{{ \Carbon\Carbon::parse($bookingDetail['check_in'])->format('D, d M Y') }}<br>After
                    03:00 PM</td>
                <td><strong>Check-out:</strong><br>{{ \Carbon\Carbon::parse($bookingDetail['check_out'])->format('D, d M Y') }}<br>Before
                    12:00 PM</td>
                <td><strong>Stay:</strong><br>{{ $bookingDetail['nights'] }} Night<br>{{ $bookingDetail['rooms'] }}
                    Rooms</td>
            </tr>
        </table>

        <div class="section-title">Room & Inclusions</div>
        <table class="bordered">

            <tr>
                <td><strong>Room Type:</strong><br>Deluxe Room X {{ $bookingDetail['rooms'] }}</td>
                <td><strong>Inclusion:</strong><br>{{ $bookingDetail['inclusion'] }}</td>
                @php
                    $guests = collect($bookingDetail['passengerDetail']);
                    $adults = $guests->where('age', 0);
                    $children = $guests->where('age', '>', 0);
                    $childDetails = $children->map(fn($c) => $c['age'] . ' yr')->implode(', ');
                @endphp

                <td>
                    <strong>Occupancy:</strong><br>
                    {{ $adults->count() }} Adult{{ $adults->count() > 1 ? 's' : '' }}
                    @if ($children->count())
                        & {{ $children->count() }} Child{{ $children->count() > 1 ? 'ren' : '' }}
                        ({{ $childDetails }})
                    @endif
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <strong>Aminities:</strong><br>
                    {{ $bookingDetail['amenities'] }}
                </td>
            </tr>
        </table>

        <div class="section-title">Payment Summary</div>
        <table class="bordered">
            <tr>
                <td><strong>Amount Paid:</strong></td>
                <td class="text-right"><strong>INR {{ $bookingDetail['paymentDetails'][0]['amount'] }}</strong></td>
            </tr>
            <tr>
                <td>Paid Mode:</td>
                <td class="text-right">Online</td>
            </tr>
        </table>

        <div class="section-title">GST Information</div>
        <table class="bordered">
            <tr>
                <td><strong>Customer Name:</strong> Andaman Bliss</td>
                <td><strong>GSTIN:</strong> 35DLKPK4730B1ZD</td>
            </tr>
            <tr>
                <td colspan="2">
                    <strong>Company Address:</strong><br>
                    1ST FLOOR, NEAR GANESH MANDIR, DAIRYFARM, PORTBLAIR,<br>
                    South Andaman, Andaman and Nicobar Islands, 744104
                </td>
            </tr>
            <tr>
                <td colspan="2"><em>Inform property at check-in for GST invoice.</em></td>
            </tr>
        </table>

        <div class="section-title">Important Information</div>
        <table>
            <tr>
                <td class="info-note">
                    • This booking is non-refundable.<br>
                    • Complimentary Breakfast included.<br>
                    • Valid ID proofs accepted: DL, Govt. ID, Passport.<br>
                    • Local IDs not allowed.<br>
                </td>
            </tr>
        </table>

        <table>
            <tr>
                <td class="info-note">
                    📞 For support: 0124-4628747, 0124-5045105<br>
                </td>
                <td class="text-right info-note">
                    Thank you for booking with Andaman Bliss
                </td>
            </tr>
        </table>
    </div>
    <script>
    // Replace the previous page in history with the current one
    history.replaceState(null, '', location.href);

    // Listen for back/forward navigation
    window.addEventListener('popstate', function () {
        window.location.href = '/hotels';
    });

    // Prevent back navigation on Android devices (especially Chrome)
    window.onload = function () {
        setTimeout(function () {
            history.pushState(null, '', location.href);
        }, 0);
    };

    // For extra safety on mobile browsers, detect swipe back gesture or accidental nav
    window.addEventListener('pageshow', function (event) {
        if (event.persisted) {
            window.location.href = '/hotels';
        }
    });

    // Optional: Intercept backspace key (non-input fields)
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Backspace' && !['INPUT', 'TEXTAREA'].includes(document.activeElement.tagName)) {
            e.preventDefault();
            window.location.href = '/hotels';
        }
    });
</script>

</body>

</html>
