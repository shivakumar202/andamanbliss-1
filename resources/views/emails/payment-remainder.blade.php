<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Complete Your Booking - Andaman Bliss</title>
</head>
<body style="font-family: Poppins, sans-serif;">

  <div style="max-width:100%;">

    <h3>Dear {{ $guest_name }},</h3>

    <p>We noticed you were about to confirm your <strong>{{ $package_name }}</strong> but didn’t complete the payment. Your selected hotel, cabs and ferries are reserved for the next 20 minutes.</p>

    <p>Please complete your booking using the link below before the reservation expires:</p>

    <p><a href="{{ $booking_link }}" style="color:#fff; background:#ff4f23; padding:10px 20px; text-decoration:none; border-radius:5px;">Complete Your Booking Here</a></p>

    <p>For more queries, feel free to reach us anytime at +91 8900909900 / +91 9933202248 or info@andamanbliss.com.</p>

    <p>Warm regards,<br>
    Andaman Bliss Team</p>

  </div>

</body>
</html>
