<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Andaman Bliss Boarding Pass</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <style>
      body {
        background-color: #e8f6ff;
        font-family: "Segoe UI", sans-serif;
      }

      .ticket {
        max-width: 800px;
        margin: 2rem auto;
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2); /* stronger shadow */
        overflow: visible; /* allow shadow to render */
        display: flex;
        flex-wrap: nowrap;
      }

      .ticket-left {
        width: 60%;
        padding: 1.2rem 1.5rem;
        background-color: white;
        border-right: 2px dashed #ccc;

        background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 500 150' preserveAspectRatio='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M0,100 C150,180 350,20 500,100 L500,150 L0,150 Z' fill='%23e0f7ff'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-size: 100% 150px;
        background-position: bottom;
      }

      .ticket-right {
        width: 40%;
        position: relative;
        color: white;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        align-items: center;
        text-align: center;
        padding: 1rem;
        background-image: url("https://images.unsplash.com/photo-1507525428034-b723cf961d3e");
        background-size: cover;
        background-position: center;
        overflow: hidden;
      }

      .ticket-right::before {
        content: "";
        position: absolute;
        inset: 0;
        background: rgba(0, 178, 255, 0.9);
        z-index: 1;
      }

      /* 🌊 BUBBLE CIRCLES ON RIGHT SIDE */
      .bubble {
        position: absolute;
        border-radius: 50%;
        background-color: rgba(255, 255, 255, 0.2);
        z-index: 0;
        animation: float 6s ease-in-out infinite;
      }

      .bubble1 {
        width: 40px;
        height: 40px;
        top: 15%;
        right: 20%;
      }

      .bubble2 {
        width: 20px;
        height: 20px;
        bottom: 20%;
        left: 15%;
      }

      .bubble3 {
        width: 30px;
        height: 30px;
        bottom: 5%;
        right: 10%;
      }

      @keyframes float {
        0% {
          transform: translateY(0);
        }
        50% {
          transform: translateY(-10px);
        }
        100% {
          transform: translateY(0);
        }
      }

      .ticket-right > * {
        z-index: 2;
      }

      .logo {
        max-height: 40px;
        margin-bottom: 0.5rem;
      }

      .title {
        font-size: 1.2rem;
        font-weight: 700;
        color: #ff6f00;
        margin-bottom: 1rem;
        text-transform: uppercase;
      }

      .info-label {
        font-weight: 600;
        font-size: 0.8rem;
        color: #666;
        margin-bottom: 2px;
        text-transform: uppercase;
      }

      .info-value {
        font-size: 1rem;
        font-weight: 700;
        margin-bottom: 0.75rem;
        color: #000;
      }

      .seat-box {
        font-size: 1rem;
        font-weight: 800;
        background: white;
        color: #00b2ff;
        padding: 0.3rem 1.2rem;
        border-radius: 8px;
        letter-spacing: 1px;
        white-space: nowrap;
      }

      .barcode {
        margin-top: 1.5rem;
      }

      .barcode img {
        height: 50px;
        background: white;
        padding: 4px;
        border-radius: 8px;
      }

      .ticket-right small {
        font-weight: 500;
        font-size: 0.75rem;
        opacity: 0.85;
      }

      .btn-print {
        display: block;
        margin: 30px auto 0;
      }

      @media print {
        body {
          background: white !important;
          -webkit-print-color-adjust: exact !important;
          print-color-adjust: exact !important;
          padding: 20px;
        }

        .ticket {
          box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2) !important;
          border: none !important;
          border-radius: 8px !important;
          overflow: visible !important;
          page-break-inside: avoid !important;
        }

        .ticket-left,
        .ticket-right {
          background-color: white !important;
          background-image: none !important;
        }

        .ticket-right::before {
          background: #00b2ff !important;
        }

        .bubble {
          background-color: rgba(255, 255, 255, 0.2) !important;
        }

        .btn-print {
          display: none !important;
        }
      }
    </style>
  </head>

  <body>
    <div class="ticket">
      <!-- Left Section -->
      <div class="ticket-left">
        <div class="d-flex gap-5 align-items-center mb-3">
          <img
          src="https://andamanbliss.com/site/img/logo.png"
          alt="Andaman Bliss Logo"
          class="logo"
        />
        <div class="title">Activity Pass</div>
</div>
        <div class="row">
          <div class="col-6">
            <div class="info-label">Booking ID</div>
            @php
              $date = \Carbon\carbon::parse($booking->start_date)->format('dm');
            @endphp
            <div class="info-value">{{ '#'.$booking->ticket_code }}</div>
          </div>
          <div class="col-6">
            <div class="info-label">Customer</div>
            <div class="info-value text-uppercase">{{ucwords($booking->name)}}</div>
          </div>
          <div class="col-6">
            <div class="info-label">Activity</div>
            <div class="info-value">{{$activity->service_name}}</div>
          </div>
          <div class="col-6">
            <div class="info-label">Location</div>
            <div class="info-value">{{ $booking->location }}</div>
          </div>
          <div class="col-4">
            <div class="info-label">Activity Date</div>
            <div class="info-value">{{\Carbon\Carbon::parse($booking->start_at)->format('d M Y')}}</div>
          </div>
          <div class="col-4">
            <div class="info-label">Time</div>
<div class="info-value">
    {{ $booking->end_at ? \Carbon\Carbon::parse($booking->end_at)->format('h:i A') : '----' }}
</div>

          </div>
          <div class="col-4">
            <div class="info-label">Participants</div>
            <div class="info-value">{{ $booking->adult . ' Adult,' . $booking->child . ' Child' }}</div>
          </div>
        </div>
      </div>

      <!-- Right Section with background and bubbles -->
      <div class="ticket-right">
        <!-- Bubbles -->
        <div class="bubble bubble1"></div>
        <div class="bubble bubble2"></div>
        <div class="bubble bubble3"></div>

        <div>
          <div class="text-uppercase fw-bold small">Customer Info</div>
          <!-- <div class="seat-box">{{Str::words($activity->service_name, 10)}}</div> -->
           <div class="d-flex  justify-content-center align-items-center">
                <div class="seat-box">{{ucwords($booking->name)}} | {{ '#'.$booking->ticket_code}}</div>

           </div>
          <div class="small mt-2">Adventure Zone</div>
        </div>

       <div class="barcode" style="text-align: center; margin-top: 20px;">
    <div style="display: inline-block; height: 150px; width: 150px;">
        {!! QrCode::size(150)->generate(route('activity.payment.voucher', ['book_id' => $booking->ticket_code])) !!}
    </div>
    <p style="font-size: 14px; margin-top: 10px;">Scan this QR code at the activity counter</p>
</div>

        <small class="mt-3">🌍andamanbliss.com</small>
      </div>
    </div>

    <button class="btn btn-primary btn-print" onclick="window.print()">
      Print Pass
    </button>
    <script>
         document.addEventListener('gesturestart', function (e) {
        e.preventDefault();
    });

    document.addEventListener('touchstart', function preventZoom(e) {
        if (e.touches.length > 1) {
            e.preventDefault();
        }
    }, { passive: false });

    document.addEventListener('touchmove', function (e) {
        if (e.scale !== 1) {
            e.preventDefault();
        }
    }, { passive: false });
    </script>
  </body>
</html>
