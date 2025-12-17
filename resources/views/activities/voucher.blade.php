<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Activity Payment Voucher</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <style>
        .voucher {
            width: 100%;
            margin: 5px auto;
            background-color: #fff;
            border-radius: 0;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border: 1px solid #e0e0e0;
        }

        .header {
            padding: 20px;
            background-color: #e6f7ff;
            text-align: center;
        }

        .header h2 {
            margin: 0;
            font-size: 24px;
            color: #005580;
        }

        .wave-container {
            width: 100%;
            height: 50px;
            overflow: hidden;
            line-height: 0;
        }

        .wave-container svg {
            display: block;
            width: 100%;
            height: 50px;
        }

        .content {
            padding: 5px;
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .info-table td {
            padding: 8px 10px;
            vertical-align: top;
        }

        .info-table td.label {
            font-weight: 600;
            width: 100px;
            color: #444;
        }

        .section-title {
            font-size: 18px;
            margin: 20px 0 10px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 5px;
            color: #005580;
        }

        .terms {
            font-size: 12px;
            color: #555;
            line-height: 1.5;
            padding: 10px;
            border-top: 1px dashed #ccc;
            margin-top: 20px;
        }

        .footer {
            text-align: center;
            font-size: 13px;
            color: #888;
            padding: 10px;
            background-color: #f9f9f9;
        }

        .qr {
            text-align: right;
            margin-top: -100px;
        }

        .qr img {
            height: 100px;
            margin-right: 20px;
        }

        .clearfix::after {
            content: "";
            display: table;
            clear: both;
        }

        .passenger-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
            margin-bottom: 20px;
        }

        .passenger-table th,
        .passenger-table td {
            border: 1px solid #ccc;
            padding: 6px 10px;
            text-align: left;
        }

        .passenger-table th {
            background-color: #f0f8ff;
        }
    </style>
</head>

<body>

    <div class="voucher">
        <div class="header">
            <h2>Activity Booking Voucher</h2>
        </div>


        <div class="content">
            <table class="info-table">
                <tr>
                    <td class="label">Activity:</td>
                    <td>{{ $activity->service_name }}</td>
                    <td class="label">Booking Id:</td>
                    @php
                        $date = \Carbon\carbon::parse($booking->start_date)->format('dm');
                    @endphp
                    <td>{{  '#' . $booking->ticket_code }}</td>

                </tr>
                <tr>
                    <td class="label">Booking Date:</td>
                    <td>{{ \Carbon\Carbon::parse($booking->created_at)->format('d M Y') }}</td>
                    <td class="label">Activity Date:</td>
                    <td>{{ \Carbon\Carbon::parse($booking->start_at)->format('d M Y') }}, Slot :
                        {{ $booking->end_at ? \Carbon\Carbon::parse($booking->end_at)->format('h:i A') : '' }}
                    </td>


                </tr>
                <tr>
                    <td class="label">Participants:</td>
                    <td>{{ $booking->adult . ' Adults,' . $booking->child . ' Child' }}</td>
                    @if ($booking->end_at)
                        <td class="label">Timing:</td>

                        <td>
                            {{ $booking->end_at ? \Carbon\Carbon::parse($booking->end_at)->format('h:i A') : '' }}
                        </td>
                    @endif
                </tr>

            </table>

            <hr>

            <p>Dear {{ ucwords($booking->name) }},</p>
            <p>Thank you for booking with Andaman Bliss. Your activity booking has been successfully confirmed, and the
                payment of INR {{ number_format($payment->amount, 2) }} has been received</p>
            <p>Please carry downloaded Activity Pass during your activity. This will serve as proof of your booking.</p>
            <p>Below are the details of your confirmed booking, including all inclusions and services.</p>
            <p>All prices indicated below are in INR</p>
                <hr>
            <div class="section-title">Billing Details</div>
            <table class="passenger-table">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Contat</th>
                </tr>
                <tr>
                    <td>1</td>
                    <td>{{ ucwords($booking->name) }}</td>
                    <td>{{ ucwords($booking->email) }}</td>
                    <td>{{ ucwords($booking->mobile) }}</td>
                </tr>
                <tr>
                    <td colspan="3">Activity Cost</td>
                    <td><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span>
                        {{ number_format($booking->price - $payment->tax, 2) }}</td>
                </tr>

                <tr>
                    <td colspan="3">Tax & Services</td>
                    <td><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span>
                        {{ number_format($payment->tax, 2) }} (inc. gst) </td>
                </tr>

                <tr>
                    <td colspan="3">Total Amount</td>
                    <td><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span>
                        {{ number_format($payment->amount, 2) }}</td>
                </tr>
            </table>
            <p>Cancellation Policy: As per terms & conditon</p>


            <div class="section-title">Important Information</div>
            <div class="terms">
                • Reporting time is 30 minutes before the activity time.<br>
                • Carry a valid government ID proof.<br>
                • Activity is subject to weather conditions.<br>
                • Cancellation charges may apply as per company policy.<br>
                • Please follow all safety instructions provided by our team.
            </div>

            <div class="qr">
                <img src="data:image/png;base64,{{ $qrCode }}" alt="QR Code" class="qrcode">
            </div>
        </div>

        <div class="footer">
            Powered by Andaman Bliss &copy; 2025
        </div>

    </div>

</body>

</html>
