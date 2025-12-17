<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="UTF-8">
    <title>Andaman Bliss</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 650px;
            margin: 30px auto;
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden;
            padding: 20px 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .email-header { text-align: center; margin-bottom: 20px; }
        .email-header h1 { margin: 0; color: #1d72b8; }
        .email-body { line-height: 1.6; font-size: 16px; color: #333; }
        .email-footer { text-align: center; color: #555; font-size: 14px; margin-top: 30px; }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h1>Andaman Bliss</h1>
                                                <img src="{{ asset('images/logo2.png') }}" class="logo" alt="{{ config('app.name', 'Laravel') }} Logo" style="box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; position: relative; max-width: 100%; border: none; height: 75px; max-height: 75px; width: 75px;">

        </div>
        <div class="email-body">
            <p>Dear <strong>{{ $guestName }}</strong>,</p>
        <p>We are happy to inform you that your payment for the <strong>{{ $packageName }}</strong>  has been successfully received.</p>
  <p>Within 10-15 minutes, you will receive your payment voucher and itinerary that you can download from the below attachment.</p>
            <p>For more queries, feel free to contact us anytime at:</p>
            <ul>
                <li>Phone: +91 8900909900 / +91 9933202248</li>
                <li>Email: <a href="mailto:info@andamanbliss.com">info@andamanbliss.com</a></li>
            </ul>

            <p>Thank you for choosing Andaman Bliss. We are extremely excited to make your Andaman holiday unforgettable.
</p>

            <p>Warm regards,<br>
            <strong>Andaman Bliss Team</strong></p>
        </div>
        <div class="email-footer">
            &copy; {{ date('Y') }} Andaman Bliss. All rights reserved.
        </div>
    </div>
</body>
</html>
