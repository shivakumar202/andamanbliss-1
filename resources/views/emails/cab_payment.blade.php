<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payment Successful - Cab Booking Confirmed</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 30px auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }
        .email-header {
            background-color: #ffffff;
            text-align: center;
            padding: 20px;
            border-bottom: 1px solid #e0e0e0;
        }
        .email-header img {
            max-width: 150px;
        }
        .email-body {
            padding: 30px 25px;
            color: #333333;
            line-height: 1.6;
        }
        .email-body h2 {
            font-size: 20px;
            color: #333333;
            margin-bottom: 15px;
        }
        .email-body p {
            margin-bottom: 15px;
            font-size: 14px;
        }
        .highlight {
            font-weight: bold;
            color: #000;
        }
        .cta-button {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 25px;
            background-color: #007bff;
            color: #ffffff !important;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            font-size: 14px;
        }
        .email-footer {
            background-color: #f1f1f1;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #555555;
        }
        .email-footer a {
            color: #007bff;
            text-decoration: none;
        }
        @media(max-width: 600px) {
            .email-container {
                width: 100% !important;
                margin: 10px auto;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <img src="{{ asset('images/logo2.png') }}" alt="Andaman Bliss Logo">
        </div>
        <div class="email-body">
            <h2>Payment Successful!</h2>
            <p>Dear <span class="highlight">{{ $billingDetails->payment->name }}</span>,</p>
            <p>We are happy to inform you that your payment of <span class="highlight">INR {{ number_format($billingDetails->payment->amount,2) }}</span> has been successfully received for your cab booking with Andaman Bliss.</p>
            <p>Your reservation is now confirmed. You will receive your official confirmation voucher with booking details shortly.</p>
            <p>If you have any questions, contact our support team at <a href="mailto:info@andamanbliss.com">info@andamanbliss.com</a> or call +91 8900909900 / +91 9933202248.</p>
            <p>Thank you for choosing Andaman Bliss. We wish you a smooth and joyful ride exploring the beautiful Andaman.</p>
        </div>
        <div class="email-footer">
            &copy; 2025 Andaman Bliss. All rights reserved.
        </div>
    </div>
</body>
</html>
