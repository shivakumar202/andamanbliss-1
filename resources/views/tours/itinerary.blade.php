<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Andaman Honeymoon Itinerary</title>
    <style>
        @page {
            margin: 170px 40px 70px 40px;
            /* top = header height (150px) + ~20px gap
       bottom = footer height (30px) + ~40px gap */
        }

        @font-face {
    font-family: 'Poppins';
    src: url('{{ asset('fonts/Poppins/Poppins-Regular.ttf') }}') format('truetype');
    font-weight: normal;
}
@font-face {
    font-family: 'Poppins';
    src: url('{{ asset('fonts/Poppins/Poppins-Bold.ttf') }}') format('truetype');
    font-weight: bold;
}
@font-face {
    font-family: 'Poppins';
    src: url('{{ asset('fonts/Poppins/Poppins-Italic.ttf') }}') format('truetype');
    font-style: italic;
}



        body {
            font-family: 'Poppins', sans-serif !important;
            margin: 0;
            font-size: 12px;
            padding: 0;
        }
        ol > li{
            font-size: 8px;
        }
        .watermark {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 250px;
            opacity: 0.1;
            z-index: -1;
            text-align: center;
        }

        .watermark img {
            width: 100%;
        }

        header {
            position: fixed;
            top: -170px;
            /* same as top margin */
            left: 0;
            right: 0;
            height: 150px;
            text-align: center;
        }


        footer {
            position: fixed;
            bottom: -70px;
            /* same as bottom margin */
            left: 0;
            right: 0;
            height: 30px;
            text-align: center;
        }

        footer .pagenum:before {
            content: counter(page);
        }

        .cover {
            text-align: center;
            padding: 2px 2px;
            color: #ff5e00ff;

        }

        .cover h2 {
            font-family: 'Poppins', sans-serif !important;
        }

        .day {
            margin: 15px 0;
        }

        .day h4 {
            color: #00aedeff;
            font-weight: 600;
            margin-bottom: 5px;
            font-size: 14px;
        }

        .day img {
            width: 100%;
            margin-bottom: 6px;
        }

        ul {
            margin-left: 15px;
        }

        .accommodation,
        .ferry {
            background: #7dc8fbc7;
            color: #005f7a;
            padding: 6px 8px;
            margin: 6px 0;
            font-size: 13px;
            border-radius: 5px;
        }

        .accommodation .title,
        .ferry .title {
            margin: 0;
            padding: 0;
            font-weight: 700;
            font-size: 16px;
            color: #005f7a;
            font-family: 'Poppins', sans-serif !important;

        }

        .day-desc {
            color: #6f6e6dff;
            font-size: 12px;
        }

        .trip-card {
            padding: 8px 12px;
            margin: 12px auto;
            border-radius: 5px;
            font-family: 'Poppins', sans-serif !important;
            font-size: 12px;
            line-height: 1.4;
            background: #f7d0aaff;
        }


        .trip-info p,
        .trip-cost p {
            margin: 2px 0;
        }

        .trip-info span,
        .trip-cost span {
            font-weight: bold;
            color: #333;
        }

        .trip-cost .total {
            margin-top: 3px;
            padding-top: 3px;
            font-size: 13px;
            font-weight: bold;
            color: #000;
        }

        .day,
        .accommodation,
        .ferry,
        .trip-card {
            page-break-inside: avoid;
            page-break-before: auto;
            page-break-after: auto;
        }

        table,
        tr,
        td {
            page-break-inside: avoid;
        }
        ol > li {
            font-size: 12px;
        }


        .card {
  background:#fff;
  border-radius:10px;
  border:1px solid #dbe3f0;
  margin-bottom:15px;
  overflow:hidden;
  box-shadow:0 2px 6px rgba(0,0,0,0.08);
}

.card-header {
  background:#0077b6;
  color:#fff;
  font-size:14px;
  font-weight:bold;
  padding-left:3px;
}

.card-table { width:100%; border-collapse:collapse; }
.card-table td { vertical-align:middle; padding-right:5px; }

.img-cell { width:120px; margin-right:10px ; vertical-align: middle; }
.img-placeholder {
  display:block;
  width:100%;
  height:5rem;
  border-radius:6px;
  object-fit:cover;
}

.details { font-size:12px; color:#333; }
.details .title { font-weight:700; font-size:13px; color:#0077b6; margin-bottom:2px; }
.details .line { margin-bottom:1px; font-weight: bold; font-family: 'Poppins', sans-serif !important; }
.details .location {
    font-size: 10px;
}


    </style>
</head>

<body>
    <div class="watermark">
        <img src="{{ asset('site/img/logo.png') }}" style="width:100%;">
    </div>
    <header>
        <img src="{{ asset('site/img/header.jpg') }}" style="width:100%; height:150px; object-fit:cover;">
    </header>
    <footer>
        <div style="width:100%; margin:0; font-family: 'Poppins', sans-serif !important; font-size:12px;">
            <table style="width:100%; border-collapse:collapse;">
                <tr>
                    <td style="border-top:1px solid #1B9AAA; width:100%;padding:0px">&nbsp;</td>
                    <td style="background:#F26522; color:#fff; padding:3px 10px; white-space:nowrap;">
                        www.andamanbliss.com
                    </td>
                </tr>
            </table>
        </div>
    </footer>
    <div class="cover">
        <h2 style="">{{ $itinerary[0]->tour->tourCategory->name }} Tour Package – {{ $itinerary[0]->tour->package_name }}</h2>
    </div>
    @php
        $roomGuests = json_decode($itinerary[0]->guest, true) ?? [];
        $wh = $itinerary[0]->wh;
        $totalAdults = 0;
        $totalChildren = 0;
        $totalRooms = count($roomGuests);
        foreach ($roomGuests as $room) {
            $totalAdults += (int) ($room['Adults'] ?? 0);
            $totalChildren += (int) ($room['Children'] ?? 0);
        }
  
$accommodations = $itinerary[0]->tour->TourItinerary->pluck('accommodation')->filter()->values();
$result = [];
$count = 1;

for ($i = 1; $i < $accommodations->count(); $i++) {
    if ($accommodations[$i] === $accommodations[$i - 1]) {
        $count++;
    } else {
        $result[] = ['nights' => $count, 'accommodation' => $accommodations[$i - 1]];
        $count = 1;
    }
}
$result[] = ['nights' => $count, 'accommodation' => $accommodations->last()];
@endphp
    <table class="trip-card" width="100%" cellspacing="0" cellpadding="0">
        <tr>
            <td class="trip-info" valign="top" width="65%">
                 <p><span>Package:</span>
                    {{ $itinerary[0]->tour->package_name . ', ' .$itinerary[0]->category . ', ' . $itinerary[0]->tour->tourCategory->name }}</p>
                  <p><span>Duration:</span> 
                    @foreach($result as $r)
    • {{ $r['nights'] }}N {{ $r['accommodation'] }} 
@endforeach
                </p>
               
                <p><span>Start Date:</span> {{ \Carbon\carbon::parse($itinerary[0]->start_date)->format('d M y') }}</p>
                <p><span>End Date:</span>
                    {{ \Carbon\Carbon::parse($itinerary[count($itinerary) - 1]->start_date)->format('d M y') }}</p>
              
            </td>
            <td class="trip-cost" valign="top" align="right" width="35%">
                <p><span>Pax:</span><span>{{ $totalAdults }} Adults , {{ $totalChildren }} Child</span></p>
                <p><span>Package Cost:</span> <span
                        style="font-family: DejaVu Sans; sans-serif;">&#8377;</span>{{ number_format($pricing->total_with_markup ?? 0, 2) }}
                </p>
                @if($pricing->total_with_markup != $pricing->total_with_discount)
                 <p><span>Discount</span> <span
                        style="font-family: DejaVu Sans; sans-serif;">&#8377;</span>{{ number_format($pricing->total_with_markup - $pricing->total_with_discount ?? 0, 2) }}
                </p>
                @endif

                <p><span>Tax & Services:</span> <span
                        style="font-family: DejaVu Sans; sans-serif;">&#8377;</span>{{ number_format($pricing->gst_amount, 2) }}
                </p>
                <p class="total"><span>Total:</span> <span
                        style="font-family: DejaVu Sans; sans-serif;">&#8377;</span>{{ number_format($pricing->grand_total, 2) }}
                </p>
            </td>
        </tr>
    </table>
    @foreach ($itinerary as $iti)
        @php
            $dayItinerary = $iti->tour->TourItinerary->get($loop->index);
            $ferries = json_decode($iti->ferry, true);
        @endphp
        <div class="day">
            <h3>Day {{ $loop->iteration }}: {{ $dayItinerary->title ?? 'N/A' }} - {{ \Carbon\carbon::parse($iti->start_date)->format('d M y') }}
            </h3>
            <p class="day-desc">{!! $dayItinerary->description ?? 'N/A' !!}</p>
            
@if (!empty($ferries) && is_array($ferries))
<div class="card">
  <div class="card-header">Transfer</div>
  <table class="card-table" role="presentation">
    @foreach ($ferries as $ferry)
      @php
        $ferryDetails = !empty($ferry['ferry']) ? json_decode($ferry['ferry'], true) : null;
        $ferryLogo = $ferryDetails['image'] ?? null;
        $ferryName = $ferry['name'] ?? ($ferryDetails['ferry_name'] ?? 'N/A');
        $from = $ferry['from'] ?? ($ferryDetails['from'] ?? 'N/A');
        $time =
            $ferry['time'] ??
            'Departure: ' .
                ($ferryDetails['departure'] ?? 'N/A') .
                ' | Arrival: ' .
                ($ferryDetails['arraival'] ?? 'N/A');
        $class =
            $ferry['classInfo'] ?? ($ferryDetails['selected_class']['class_name'] ?? 'N/A');
      @endphp
      <tr>
        <td class="img-cell">
          @if ($ferryLogo)
            <img class="img-placeholder"
                 src="{{ $ferryLogo }}"
                 alt="{{ $ferryName }}">
          @endif
        </td>
        <td class="details">
          <div class="title">{{ $ferryName }}</div>
          <div class="line"><strong>From:</strong> {{ $from }}</div>
          <div class="line">{{ $time }}</div>
          <div class="line"><strong>Class:</strong> {{ $class }}</div>
        </td>
      </tr>
    @endforeach
  </table>
</div>
@endif
           @if ( $wh == '1' &&
    (!empty($iti->accomodation) && !empty($iti->accomodation['hotel_name'])) ||
    (!empty($iti->room_name) && $iti->room_name !== 'null' )  
)
<div class="card" style="display: {{ $wh == 1 ? 'block' : 'none' }};">
  <div class="card-header">Accommodation</div>
  <table class="card-table" role="presentation">
    <tr>
      <td class="img-cell">
        @if (!empty($iti->accomodation['hotel_image']))
          <img class="img-placeholder"
               src="{{ $iti->accomodation['hotel_image'] }}"
               alt="{{ $iti->accomodation['hotel_name'] ?? '' }}">
        @endif
      </td>
      <td class="details">
        <div class="title">{{ $iti->accomodation['hotel_name'] ?? '' }}</div>
        @if (!empty($iti->room_name) && $iti->room_name !== 'null')
          <div class="line" style="font-family: 'Poppins', sans-serif !important;">{{ trim($iti->room_name, "\"'") }}</div>
        @endif
        <div class="location">Location: {{$iti->accomodation['address']}} </div>
      </td>
    </tr>
  </table>
</div>
@endif



           
            
        </div>
    @endforeach
    <div class="inclusions" style="margin:20px 0; background:#e6f9f1; padding:10px 12px; border-radius:6px; font-size:13px;">
    <h4 style="color:#007b5e; margin:0 0 8px 0;">Inclusions:</h4>
    <ul style="margin:0; padding-left:18px; color:#333;">
        @foreach ($itinerary[0]->tour->inclusions->where('type', 'inclusion') as $inclusion)
            <li>{!! $inclusion->icon !!} {{ $inclusion->description }}</li>
        @endforeach
    </ul>
</div>

<div class="exclusions" style="margin:20px 0; background:#fdeaea; padding:10px 12px; border-radius:6px; font-size:13px;">
    <h4 style="color:#c0392b; margin:0 0 8px 0;">Exclusions:</h4>
    <ul style="margin:0; padding-left:18px; color:#333;">
        @foreach ($itinerary[0]->tour->inclusions->where('type', 'exclusion') as $exclusion)
            <li>{!! $exclusion->icon !!} {{ $exclusion->description }}</li>
        @endforeach
    </ul>
</div>


                            <h3>Terms & Conditions</h3>
<ol>
    <li>The standard check in time at the hotel is 11:00 PM and the check out time is 08:00 AM. Request for early check in or late check out depends entirely on the hotel policy and room availability.</li>
    <li>A maximum group of 3 adults are allowed in one room. The third occupant will be provided with a mattress bed as per hotel policy.</li>
    <li>The itinerary that is provided is fixed and it will not be modified further. Vehicles will be arranged as per the itinerary and will not remain available for any personal or unlimited use.</li>
    <li>If a paid activity cannot be conducted due to unforeseen reasons, then the refund will be processed within 30 days.</li>
    <li>Complimentary inclusion that is free of charge will not be eligible for any refund if unavailable.</li>
    <li>The package cost does not include monument, entry fees, parking charges or guide charges.</li>
    <li>Expenses of personal use like laundry, telephone calls, room services, alcoholic drinks, minibar usage and tips are not included.</li>
    <li>Costs related to ticket deviation, rescheduling or trip extensions are also excluded.</li>
    <li>Flight tickets are not included in the package. Guests are required to book and arrange their own flights to and from the Andaman islands.</li>
    <li>Ferries operating in the Andaman island are highly dependent on weather and operational conditions. Delays or cancellations due to weather are beyond our control.</li>
    <li>If a passenger has booked a specific ferry but it becomes non operational due to some unforeseen reason, the passenger will either be provided with a rescheduled booking or an alternative ferry service of similar standard, subject to availability.</li>
    <li>Prices are dynamic and can be changed without prior notice. Ferry tickets and hotel rooms are always subject to real time availability.</li>
    <li>Pricing of the booking is calculated based on the accurate age of travelers, providing incorrect details may result in penalties at the time of travel.</li>
    <li>If the preferred hotel is not available, then similar category accommodation will be arranged.</li>
    <li>Some hotels may collect a refundable security deposit during check in, as per their internal policy.</li>
    <li>In case your package needs to be cancelled due to any natural calamity, bad weather conditions or government restrictions, Andaman Bliss ensures the maximum possible refund subject to the agreement with the trade partner/vendor.</li>
    <li>Andaman Bliss has the right to revise or adjust itineraries due to reasons like weather conditions, local restrictions or operational challenges. Alternative options will be arranged wherever possible. Claims for refund or compensation will not be entertained.</li>
    <li>Our packages do not include mandatory festive or gala dinner charges (e.g., Christmas, New Year or other occasion) in the hotels. Guests will be informed in advance wherever possible, however such charges are payable directly at the hotel.</li>
    <li>All the water sports activities are subject to safety and weather conditions. Such activities may be cancelled without prior notice. Complimentary activities cannot be refunded.</li>
    <li>All legal disputes shall be subject under the jurisdiction of the court in Port Blair, Andaman & Nicobar Islands.</li>
    <li>Andaman Bliss has the rights to modify these Terms & Conditions at any time without prior notification.</li>
    <li>Foreign nationals are required to obtain a Restricted Area Permit upon arrival at the airport from the immigration authorities.</li>
    <li>Andaman Bliss has the rights to cancel any services like cabs, ferry bookings, tour packages or activity arrangements at any time due to operational, safety or unforeseen circumstances.</li>
    <li>In case, the cancellation of any services or packages are done from our side, guests will receive a full refund within 7 working days.</li>
</ol>

<h3>Amendment & Cancellation Policy</h3>
<ol>
    <li>Cancellations made 24 hrs before the departure date - <span
                        style="font-family: DejaVu Sans; sans-serif;">&#8377;</span>7000 will be charged as cancellation charges.</li>
    <li>Cancellation made after 24 hrs no refund.</li>
                                        </ol>


<!-- CTA Block -->
<div style="background:#00a8e8; padding:15px; border-radius:8px; text-align:center; color:#fff; font-size:18px; font-weight:bold;">
  <table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" style="width:100%; max-width:600px;">
    <tr>
      <td align="left" style="color:#fff; font-size:18px; font-weight:bold; padding-right:10px; vertical-align:middle; line-height:10px;" >
        To Confirm This Package, Click Here
      </td>

      <td align="right" style="vertical-align:middle; line-height:10px;">
        <a href="{{ route('tour.static', [
                                            'slug' => $itinerary[0]->tour->tourCategory->slug,
                                            'category' => Str::slug($itinerary[0]->category),
                                            'subslug' => $itinerary[0]->tour->slug
                                        ]) }}" 
           style="display:inline-block; background:#ff6600; color:#fff; padding:8px 18px; border-radius:6px; font-size:16px; font-weight:bold; text-decoration:none;">
          Book Now
        </a>
      </td>
    </tr>
  </table>
</div>


<!-- Contact Info -->
<div style="text-align:center; margin:15px 0;">
       <button style="display:inline-block; border:none; background:#007bff; color:#fff; padding:8px 18px; border-radius:4px; font-weight:bold; text-decoration:none;">
        Need help? Contact us
    </button>
    
    <div style="margin-top:10px; background:#f9f9f9; padding:12px; border-radius:6px; font-size:14px;">
        <b>Email ID:</b> info@andamanbliss.com 
        <span style="margin:0 5px;">|</span> 
        <b>Contact No:</b> +91 8900909900 / +91 9933202248

    </div>
</div>


</body>

</html>
