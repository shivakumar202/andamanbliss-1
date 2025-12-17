<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmed</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', Arial, sans-serif;
            background-color: #f6f6f6;
            margin: 0;
            padding: 20px;
            color: #333333;
        }

        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 25px;
            line-height: 1.5;
        }

        .logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo img {
            max-width: 150px;
            height: auto;
        }

        h1 {
            color: #007bff;
            font-weight: 600;
            font-size: 20px;
            margin-bottom: 15px;
        }

        h2 {
            font-weight: 600;
            font-size: 16px;
            margin-bottom: 10px;
        }

        p {
            font-size: 14px;
            margin: 8px 0;
        }

        .details p {
            margin: 4px 0;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        .footer {
            font-size: 12px;
            color: #777777;
            margin-top: 25px;
            text-align: center;
        }

        @media only screen and (max-width: 620px) {
            .email-container {
                padding: 15px;
            }

            h1 {
                font-size: 18px;
            }

            h2 {
                font-size: 15px;
            }

            p {
                font-size: 13px;
            }
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="logo">
            <img src="{{ asset('images/logo2.png') }}" alt="Andaman Bliss">
        </div>

        <h1>Booking Confirmed!</h1>
        <p>Dear {{ ucwords($billingDetails->name) }},</p>
        <p>We are delighted to confirm your bike rental booking with <strong>Andaman Bliss</strong>. Your payment has been successfully processed and your booking is now confirmed.</p>
        @php
        if($billingDetails->pickup_location != '')
        {
        $loc = $billingDetails->pickup_location;
        }
        else {
        $loc = $location->pick_location;
        }
        $map_loc = 'https://www.google.com/maps/search/?api=1&query='.urlencode($loc);
        @endphp
        <div class="details">
            <h2>Booking Details</h2>
            <p><strong>Pick Up Date & Time:</strong> {{ $billingDetails->pickup_date ?? '' }} {{ $billingDetails->pickup_time ?? '' }}</p>
            <p><strong>Pick Up Location:</strong> <a href="{{$map_loc}}" target="_blank" style="text-decoration: none;"><i class="fa-solid fa-location-dot" style="color:red;"></i> {{ $loc }}</a></p>
            <p><strong>Drop Off Date & Time:</strong> {{ $billingDetails->return_date ?? '' }} {{ $billingDetails->return_time ?? '' }}</p>
            <p><strong>Drop Off Location:</strong> <a href="{{$map_loc}}" target="_blank" style="text-decoration: none;"><i class="fa-solid fa-location-dot" style="color:red;"></i> {{ $loc }}</a></p>
            <p><strong>Total Amount Paid:</strong> INR ₹{{ number_format($billingDetails->payable, 2) }}</p>
        </div>

        <p>Your confirmation voucher is attached below for your reference.</p>
        <p>If you have any questions or require assistance, please contact us at <a href="mailto:info@andamanbliss.com">info@andamanbliss.com</a> or call us at +91 8900909900 / +91 9933202248.</p>

        <p>Thank you for choosing <strong>Andaman Bliss</strong>. We wish you a wonderful journey exploring the Andaman on two wheels.</p>

        <p>Warm regards,<br>
            <strong>Andaman Bliss Team</strong>
        </p>

        <div class="footer">
            &copy; 2025 Andaman Bliss. All rights reserved.
        </div>
    </div>
</body>

</html>