<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Thank You - Tour Booking Confirmation</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f7f9fb;
            font-family: "Poppins", sans-serif;
        }

        .thankyou-container {
            max-width: 720px;
            margin: 80px auto;
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            padding: 40px 30px;
            text-align: center;
        }

        .success-icon {
            width: 100px;
            height: 100px;
            background: #28a745;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            color: white;
            font-size: 48px;
        }

        .thankyou-container h2 {
            color: #333;
            font-weight: 600;
        }

        .thankyou-container p {
            color: #666;
            font-size: 16px;
        }

        .info-note {
            background: #e8f7f4;
            border-left: 5px solid #0d6efd;
            padding: 15px;
            border-radius: 8px;
            text-align: left;
            margin-top: 25px;
            font-size: 15px;
            color: #0a4b63;
        }

        .booking-summary {
            background: #f1f6f9;
            border-radius: 12px;
            padding: 20px;
            text-align: left;
            margin-top: 30px;
        }

        .booking-summary h5 {
            color: #005f7a;
            font-weight: 600;
            margin-bottom: 15px;
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
        }

        .summary-item span {
            color: #555;
        }

        .btn-custom {
            border-radius: 30px;
            padding: 10px 28px;
            font-weight: 500;
        }

        .btn-home {
            background-color: #005f7a;
            color: white;
        }

        .btn-home:hover {
            background-color: #00485b;
        }

        .btn-booking {
            border: 1px solid #005f7a;
            color: #005f7a;
            background: white;
        }

        .btn-booking:hover {
            background: #eaf5f8;
        }
    </style>
</head>

<body>

    <div class="thankyou-container">
        <div class="success-icon">
            <i class="bi bi-check-lg"></i>
        </div>
        <h2>Thank You for Your Booking!</h2>
        <p>Your tour has been successfully booked. A confirmation email has been sent to <strong>{{$data['payment']['email']}}</strong>.</p>

        <div class="info-note mt-3">
            <p>
                <strong>Note:</strong> Confirmation tickets will be sent within <strong>10–15 minutes</strong>.
                The payment voucher has been sent to your registered email.
                For any further doubts or assistance, please <a href="/contact" class="text-decoration-none text-primary fw-semibold">contact our support team</a>.
            </p>
        </div>

        <div class="booking-summary">
            <h5>Booking Summary</h5>
            <div class="summary-item"><span>Booking ID:</span> <span>#AB-{{$data['payment']['booking_id']}}</span></div>
            <div class="summary-item"><span>Tour Package:</span> <span>{{$data['itinerary']['tour']['package_name'] .', '. $data['itinerary']['category'].', '. $data['itinerary']['tour']['tourCategory']['name']}}</span></div>
            <div class="summary-item"><span>Travel Dates:</span> <span>{{\Carbon\carbon::parse($data['itinerary']['start_date'])->format('d')}} - {{\Carbon\carbon::parse($data['end_date'])->format('d-M-Y')}}</span></div>
            <div class="summary-item"><span>Travelers:</span> <span>{{$data['guest']['adults'] . ' Adults ,'. $data['guest']['childrens'] .' Children (s)' }}</span></div>
            <div class="summary-item"><span>Total Paid:</span> <span>₹{{number_format($data['payment']['amount'],2)}}</span></div>
        </div>


    </div>

    <!-- Bootstrap 5 JS + Icons -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

</body>

</html>