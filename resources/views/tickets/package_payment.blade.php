<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Tour Payment Confirmation Voucher</title>
  <style>
    body{font-family:Arial,Helvetica,sans-serif;font-size:14px;color:#222;background:#fff;margin:0;padding:0px}
    .wrapper{max-width:800px;margin:0 auto;border:1px solid #ccc;padding:20px}
    .header{width:100%;overflow:hidden;margin-bottom:20px}
    .logo{width:auto;height:20px ;text-align:center;left;margin-left: 15px;}
    
    .logo img{width:auto;height:100px ;text-align:right;float: left; margin-left: 15px; }
    
    .meta .sub{color:#666;font-size:13px}
    .meta{text-align:right;font-size:13px; color: black;}
    .meta .id{font-weight:bold;color:#0d6efd}

    .divider{clear:both;height:1px;background:#eee;margin:15px 0}

    .section{margin-bottom:20px}
    .section h3{margin:0 0 8px 0;font-size:15px;border-bottom:1px solid #eee;padding-bottom:4px}

    table{width:100%;border-collapse:collapse;margin-top:8px}
    th,td{padding:6px;border:1px solid #ddd;font-size:13px;text-align:left}
    th{background:#f9f9f9}

    .payment-summary{margin-top:10px}
    .payment-summary td{padding:6px}
    .total{font-size:16px;font-weight:bold;color:#0d6efd}

    .stamp{margin-top:15px;border:1px dashed #aaa;padding:10px;text-align:center;font-weight:bold;color:green}

    .notes{font-size:12px;color:#555;margin-top:15px}
    .footer{margin-top:20px;font-size:12px;color:#666;border-top:1px solid #eee;padding-top:8px;text-align:right}
  </style>
</head>
<body>
  <div class="wrapper">
    <div class="header">
      <div class="logo">
        <img src="https://andamanbliss.com/site/img/logo.png" alt="andaman bliss">
      </div>
 
      <div class="meta">
        <div class="id">PNR: AB-{{$itinerary[0]->search_hash}}</div>
        <div>Booking Date: {{\Carbon\carbon::parse($payment->created_at)->format('d M Y h:i A')}}</div>
        <div>Payment Status: <span style="color:green">{{$pricing->paying_percent < 100 ? 'Partially Paid' : 'Full Paid'}}</span></div>
        <div class="sub">Confirmation of payment</div>
      </div>
    </div>

    <div class="divider"></div>

    <div class="section">
      <h3>Tour Details</h3>
      <table>
        <tr><th>Package</th><td>{{ $itinerary[0]->tour->package_name . ', ' . $itinerary[0]->category . ', ' . $itinerary[0]->tour->tourCategory->name  }}</td></tr>
        <tr><th>Travel Dates</th><td>{{ \Carbon\carbon::parse($itinerary[0]->start_date)->format('d M y') }} — {{ \Carbon\Carbon::parse($itinerary[count($itinerary) - 1]->start_date)->format('d M y') }}</td></tr>
        <tr><th>No of Pax</th><td>Adult (s): {{ array_sum(array_column(json_decode($itinerary[0]->guest, true),'Adults')) }}, Children (s): {{array_sum(array_column(json_decode($itinerary[0]->guest, true),'Children'))}}</td></tr>
      </table>
    </div>

    <div class="section">
      <h3>Traveller(s)</h3>
      <table>
        <thead><tr><th>Name</th><th>Age</th><th>Gender</th><th>Category</th></tr></thead>
        <tbody>
          @foreach ($passengers as $pax)
            <tr><td>{{$pax->prefix }} {{ $pax->name . ' ' . $pax->m_name . ' ' . $pax->last_name }}</td><td>{{$pax->age}}</td><td>{{$pax->gender}}</td><td>{{ $pax->age > 2 ? 'Adult' : 'Infant' }}</td></tr>
          @endforeach
         
        </tbody>
      </table>
    </div>

    <div class="section">
      <h3>Payment & Summary</h3>
      <table class="payment-summary">
        <tr><td>Base Price</td><td><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span> {{ number_format($pricing->total_with_markup,2)}}</td></tr>
        @if($pricing->discount > 0)
        <tr><td>Discount</td><td>- <span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span> {{number_format($pricing->total_with_markup - $pricing->total_with_discount,2)}}</td></tr>
        @endif
        <tr><td>Taxes & Fees</td><td><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span> {{ number_format($pricing->gst_amount,2)}}</td></tr>
         @if($pricing->paying_percent < 100)
        <tr><td><strong>Advance Paid ({{ $pricing->paying_percent }}%)</strong></td><td><strong><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span> {{ number_format($pricing->grand_total/2,2)}}</strong></td></tr>
        <tr><td><strong>Balance Due on Arrival ({{100-$pricing->paying_percent}}%)</strong></td><td><strong><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span> {{ number_format($pricing->grand_total/2,2)}}</strong></td></tr>
        @else
        <tr><td><strong>Total Paid</strong></td><td><strong><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span> {{ number_format($pricing->payable_amt,2)}}</strong></td></tr>

        @endif
        <tr><td class="total">Total Package Cost</td><td class="total"><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span> {{ number_format($pricing->grand_total,2)}}</td></tr>
      </table>
      @if($pricing->paying_percent < 100)
      <div class="stamp">CONFIRMED — Balance {{$pricing->paying_percent}}% payable on arrival is compulsory</div>
      @endif
    </div>

    <div class="notes">
      <strong>Important:</strong> Please carry a government-issued photo ID for each guest at the time of check-in. Cancellation policy applies as per your package T&Cs. For any changes contact <a href="tel:+91 8900909900">+91 8900909900</a> or <a href="mailto:info@andamanbliss.com">info@andamanbliss.com</a> </div>
    <div class="footer">
      Andaman Bliss • GST: 35ABDCA2206K1ZZ — Printed on {{now()->format('d m y h:i A')}}
    </div>
  </div>

</body>
</html>