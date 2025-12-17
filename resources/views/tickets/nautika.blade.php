<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nautika Ticket</title>
    <style>
        body {
            font-family: "Lato", Arial, Helvetica, sans-serif;
            -webkit-text-size-adjust: none;
            text-size-adjust: none;
            margin: 0;
            padding: 0;
        }

        /* Header Section */
        .nheaders {
            text-align: center;
            align-content: center;
            margin-bottom: 10px;
            padding-bottom: 0;
        }

        .nheaders {
            position: relative;
            height: 100px;
            padding: 10px;
        }

        .nheaders img.logo {
            position: absolute;
            left: 20;
            top: 20;
            width: auto;
            height: 100%;
        }

        .nheaders img.ferrylogo {
            position: absolute;
            left: 50%;
            top: 45;
            transform: translateX(-50%);
            width: auto;
            height: 50%;
        }


        .nheaders img.qrcode {
            width: 10%;
            top: 30;
            right: 50;
            height: auto;
            position: relative;
            float: right;
        }

        .summary-head {
            margin-top: 6px;
            width: 100%;
            text-align: center;
            font-size: 14px;
            margin-left: 1%;
            color: rgb(37, 37, 37);
        }

        .summary-head * {
            margin: 0;
            padding: 0;
        }

        /* Trip Summary */
        .tripsum {
            text-align: center;
            border: 2px solid #48cae4;
            padding: 10px;
            margin-top: 10px;
            margin-bottom: -10px;
            color: rgb(37, 37, 37);
        }

        .tripsum h4 {
            margin: 5px 0;
        }

        .tripsum span {
            font-weight: bold;
        }

        /* Tables */
        .tables table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .tables table th,
        .tables table td {
            padding: 8px;
            text-align: left;
            font-size: 12px;
            border: 1px solid #48cae4;
        }

        .tables table th {
            color: white;
        }

        /* Passenger Table */
        .pax table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .pax table th,
        .pax table td {
            padding: 8px;
            text-align: left;
            font-size: 12px;
            border: 1px solid #48cae4;
        }

        .pax table th {
            color: rgb(0, 0, 0);
        }

        .pax table .table-header {}

        .table-footer {
            text-align: right;
            font-weight: bold;
        }

        .bold {
            font-weight: bold;
        }

        /* Responsive Design */
        .ad-sec {
            width: 100%;
            text-align: center;
        }

        .ad-sec p {
            margin: 0;
            padding: 0;
            font-weight: bolder;
        }

        .adv {
            height: auto;
            width: 100%;
        }

        .rec {
            height: 6.8%;
            width: auto;
        }

        .terms-heading,
        .cancellation-heading {
            color: #000000;
            margin: 0;
            padding: 0;
        }

        /* Terms and Cancellation Container */
        .terms-container,
        .cancellation-container {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .terms-list li,
        .cancellation-list li {
            margin-bottom: 10px;
            font-size: 14px;
            list-style: armenian;
        }

        /* Link Styles */
        .terms-link,
        .contact-link {
            color: #0059ff;
            text-decoration: none;
        }

        .terms-link:hover,
        .contact-link:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <section class="nheaders">
        <img src="data:image/png;base64,{{ $trip['qrcode'] }}" alt="QR Code" class="qrcode">
        <img src="site/img/logo.png" alt="Andaman Bliss" class="logo">
        <img src="site/img/nautika.png" alt="Andaman Bliss" class="ferrylogo">
    </section>

    <section class="summary-head">
        <h4>Nautika Reserved E- Ticket</h4>
        <h4>GSTIN: 35AAYCS7239Q1Z3</h4>
    </section>
    <!-- Trip Summary -->
    <div class="tripsum">
        <h4>{{ $trip['booking']->from_location }} <img src="{{ public_path('site/img/right-arrow.png') }}"
                style="height:12px; padding:4px;" alt="To" class="logo">
            {{ $trip['booking']->to_location }}</h4>
        <h4>Departure: {{ $trip['booking']->travel_date->format('d-m-Y') }},
            <span>{{ $trip['booking']->disembarkation->format('h:i A')}} </span>
        </h4>
    </div>

    <!-- Trip Details Table -->
    <section class="trip-section">
        <div class="tables">
            <table>
                <tbody>
                    <tr>
                        <td>PNR</td>
                        <td class="bold">{{ $trip['booking']->pnr_no }}</td>
                        <td>Booking TS</td>
                        <td>{{ $trip['booking']->created_at->format('d-m-Y, H:i') }}</td>
                    </tr>
                    <tr>
                        <td>Vessel</td>
                        <td>NAUTIKA</td>
                        <td>Boarding</td>
                        <td>{{ $trip['booking']->from_location }} Jetty</td>
                    </tr>
                    <tr>
                        <td>Phone</td>
                        <td>9933202248</td>
                        <td class="bold">Endorsement</td>
                        <td>ANDAMAN BLISS</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

    <!-- Passenger Details Table -->
    <section class="pax">
        <table>
            <thead>
                <tr class="table-header">
                    <th>Sl No.</th>
                    <th>Passenger</th>
                    <th>Seat</th>
                    <th>BaseFare</th>
                    <th>PMB</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @php
                $adults = $trip['booking']->passengerDetails->where('group', 'Adult');
                $infants = $trip['booking']->passengerDetails->where('group', 'Infant');
                @endphp

                @foreach ($adults as $pax)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ strtoupper($pax->name) }}</td>
                    <td>{{ $pax->class . '-' . $pax->seat_no }}</td>
                    <td><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span>{{
                        number_format($trip['booking']->baseFare, 2) }}</td>
                    <td><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span>{{ number_format($pax->group
                        == 'Adult' ? 50 : 0, 2) }}</td>
                    <td><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span>{{
                        number_format($trip['booking']->baseFare + 50, 2) }}</td>
                </tr>
                @endforeach

                @foreach ($infants as $pax)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ strtoupper($pax->name) }}</td>
                    <td>{{ $pax->class == 'P' ? 'LUXURY' : 'ROYAL' . '-' . $pax->seat_no }}</td>
                    <td><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span>{{
                        number_format($trip['booking']->infantFare, 2) }}</td>
                    <td><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span>{{ $pax->group == 'Infant' ?
                        0.00 : 50.00 }}</td>
                    <td><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span>{{
                        number_format($trip['booking']->infantFare, 2) }}</td>
                </tr>
                @endforeach

                <tr class="table-footer">
                    <td colspan="4">Rs. {{ ucwords($trip['totalcost']) }} only.</td>
                    <td class="bold">Total</td>
                    <td><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span>{{
                        number_format($trip['booking']->totalCost, 2) }}</td>
                </tr>
            </tbody>
        </table>
    </section>

    <h5>Please read the cancellation policy and terms of service</h5>

    <section class="temsnc" style="margin-top:20px;">
        <h4 class="terms-heading">Terms of Service</h4>
        <div class="terms-container">
            <ul class="terms-list">
                <li>Passengers should report at least <span class="bold">45 mins</span> prior to departure. Boarding
                    closes 20 mins before departure.</li>
                <li>Every individual passenger will be checked for a valid <span class="bold">Photo ID</span> proof
                    while entering the Port Area.</li>
                <li>Validity of ticket pertains to subject sailing only. Once the ferry departs, the ticket will be
                    invalidated.</li>
                <li>Ticket is non-transferable/non-re-routable. Rescheduling is strictly subject to availability.
                    Additional charges are applicable.</li>
                <li>Passengers are responsible for their valuables and personal belongings. Management is not
                    responsible for any such consequences, theft, loss, or damage of personal belongings.</li>
            </ul>
            <p>For more information, visit <a href="https://andaman.gonautika.com/terms-of-service" target="_blank"
                    class="terms-link">https://gonautika.com/terms-of-service</a></p>
        </div>

        <!-- Cancellation Policy Section -->
        <h4 class="cancellation-heading">Cancellation Policy and Charges</h4>
        <div class="cancellation-container">
            <ul class="cancellation-list">
                <li>Greater than 48HRS <span class="bold">Rs.100</span> per pax (Infants below 1 year will have no
                    charges)</li>
                <li>Greater than <span class="bold">24HRS</span> and less than <span class="bold">48 hrs: 50%</span> of
                    the base fare collected will be refunded.</li>
                <li>Less than <span class="bold">24HRS</span> to departure: No refund will be processed.</li>
                <li>Any refund amount will be credited to the same account used for booking.</li>
            </ul>
        </div>
    </section>


</body>

</html>