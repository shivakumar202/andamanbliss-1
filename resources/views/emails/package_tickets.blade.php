<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="UTF-8">
    <title>Andaman Bliss - Confirmation</title>
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
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .email-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .email-header h1 {
            margin: 0;
            color: #1d72b8;
        }

        .email-body {
            line-height: 1.6;
            font-size: 16px;
            color: #333;
        }

        .email-footer {
            text-align: center;
            color: #555;
            font-size: 14px;
            margin-top: 30px;
        }
    </style>

</head>

<body>
    <div class="email-container">
        <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%">
            <tr>
                <td align="center" style="padding:24px 12px;">
                    <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="680"
                        style="width:680px;max-width:680px;background:#ffffff;border:1px solid #e6edf3;border-radius:8px;overflow:hidden;">
                        <tr>
                            <td style="padding:16px 20px;background:#dcf1e7;border-bottom:1px solid #cfe7db;">
                                <table role="presentation" width="100%" cellpadding="0" cellspacing="0"
                                    border="0">
                                    <tr>
                                        <td valign="middle">
                                            <table role="presentation" cellpadding="0" cellspacing="0" border="0"
                                                style="border-collapse:separate;">
                                                <tr>
                                                    <td>
                                                        <img src="{{ asset('images/logo2.png') }}"
                                                            alt="Andaman Bliss Logo"
                                                            style="height: 75px; width: 75px; border: none; margin-top:10px;">
                                                    </td>
                                                    <td style="width:6px;">&nbsp;</td>
                                                    
                                                </tr>
                                            </table>
                                        </td>
                                        <td valign="middle" align="right"
                                            style="vertical-align:middle;text-align:right;color:#1f2d3d;font-family:Arial, Helvetica, sans-serif;font-size:16px;font-weight:700;">
                                            Package Voucher</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                       
                        <tr>
                            <td style="padding:20px 22px 6px 22px;background:#dcf1e7;">
                                <div
                                    style="font-family:Arial, Helvetica, sans-serif;font-size:16px;line-height:22px;color:#0f172a;font-weight:700;margin:0 0 4px;">
                                    Hi <strong>{{ $guestName }}</strong>,</div>
                                <div
                                    style="font-family:Arial, Helvetica, sans-serif;font-size:14px;line-height:20px;color:#495867;margin:0;">
                                    Thanks for booking our package. Your booking is confirmed — see full package details
                                    below.</div>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding:10px 22px 18px 22px;background:#dcf1e7;border-bottom:1px solid #cfe7db;">
                                <table role="presentation" cellpadding="0" cellspacing="0" border="0"
                                    width="100%">
                                    <tr>
                                        <td style="padding:14px 16px;">
                                            <div
                                                style="font-family:Arial, Helvetica, sans-serif;font-size:20px;line-height:26px;color:#0f172a;font-weight:800;margin:0;">
                                                Andaman {{ $tour->tourCategory->name . ' ' . $tour->package_name }}
                                                Package</div>
                                            <div
                                                style="font-family:Arial, Helvetica, sans-serif;font-size:13px;line-height:20px;color:#25364a;margin:6px 0 10px;">
                                               • Trip Start - {{ \Carbon\Carbon::parse($itinerary->start_date)->format('d M y') }} - Trip End - {{ \Carbon\Carbon::parse($endDate)->format('d M y') }}</div>
                                               <div
                                                style="font-family:Arial, Helvetica, sans-serif;font-size:13px;line-height:20px;color:#25364a;margin:6px 0 10px;">
                                               • {{ $totalRooms }} Rooms • {{ $totalAdults }} Adults • {{ $totalChildren }} Children</div>
                                            <div
                                                style="font-family:Arial, Helvetica, sans-serif;font-size:16px;line-height:16px;color:#0f172a;font-weight:800;margin:0;">
                                                Booking ID: {{ $packageId }}</div>
                                            <div
                                                style="font-family:Arial, Helvetica, sans-serif;font-size:12px;line-height:18px;color:#5b6b7a;margin:0;">
                                                (Booked on
                                                {{ \Carbon\Carbon::parse($itinerary->created_at)->format('d M, y') }})
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding:10px 22px 6px 22px;background:#ffffff;">
                                <table role="presentation" width="100%" cellpadding="0" cellspacing="0"
                                    border="0">
                                    <tr>
                                        <td style="width:4px;background:#0ea75a;border-radius:2px;">&nbsp;</td>
                                        <td style="width:10px;">&nbsp;</td>
                                        <td
                                            style="font-family:Arial, Helvetica, sans-serif;font-size:12px;letter-spacing:1px;color:#263645;font-weight:800;text-transform:uppercase;padding:8px 0;border-bottom:1px solid #e6edf3;">
                                            Accommodations</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        @foreach ($hotelBookings as $hotelBooking)
                            <tr>
                                <td style="padding:10px 22px;background:#ffffff;">
                                    <table role="presentation" cellpadding="0" cellspacing="0" border="0"
                                        width="100%" style="width:100%;border:1px solid #e6edf3;border-radius:8px;">
                                        <tr>
                                            <td style="padding:12px 14px;">
                                                <table role="presentation" width="100%" cellpadding="0"
                                                    cellspacing="0" border="0">
                                                    <tr>
                                                        <td valign="top" style="vertical-align:top;">
                                                            <div
                                                                style="font-family:Arial, Helvetica, sans-serif;font-size:14px;color:#0f172a;font-weight:700;">
                                                                {{ $hotelBooking['hotel']['hotel_name'] ?? 'N/A' }}
                                                            </div>
                                                            <div
                                                                style="font-family:Arial, Helvetica, sans-serif;font-size:13px;color:#6b7c8c;margin:6px 0;">
                                                                {{ $hotelBooking['room_name'] ?? 'N/A' }}
                                                            </div>
                                                            <div
                                                                style="font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#455568;">
                                                                Check-in:
                                                                {{ \Carbon\Carbon::parse($hotelBooking['check_in'])->format('d M y') }}
                                                                •
                                                                Check-out:
                                                                {{ \Carbon\Carbon::parse($hotelBooking['check_out'])->format('d M y') }}
                                                            </div>
                                                            <div
                                                                style="font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#5b6b7a;margin-top:4px;">
                                                                Nights: {{ $hotelBooking['nights'] }} • Rooms:
                                                                {{ $hotelBooking['rooms'] }}
                                                            </div>

                                                        </td>
                                                        <td valign="top" align="right"
                                                            style="vertical-align:top;text-align:right;width:140px;">
                                                            <img src="{{ $hotelBooking['hotel']['hotel_image'] ?? '' }}"
                                                                alt="Hotel" width="120"
                                                                style="display:block;border-radius:6px;border:1px solid #e6edf3;">
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        @endforeach


                        <tr>
                            <td style="padding:12px 22px 4px 22px;background:#ffffff;">
                                <table role="presentation" cellpadding="0" cellspacing="0" border="0"
                                    width="100%">
                                    <tr>
                                        <td style="width:4px;background:#0ea75a;border-radius:2px;">&nbsp;</td>
                                        <td style="width:10px;">&nbsp;</td>
                                        <td
                                            style="font-family:Arial, Helvetica, sans-serif;font-size:12px;letter-spacing:1px;color:#263645;font-weight:800;text-transform:uppercase;padding:8px 0;border-bottom:1px solid #e6edf3;">
                                            Activities & Transfers</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        @if (isset($activities) && $activities->count())
                            @foreach ($activities as $act)
                                <tr>
                                    <td style="padding:10px 22px;background:#ffffff;">
                                        <table role="presentation" cellpadding="0" cellspacing="0" border="0"
                                            width="100%"
                                            style="width:100%;border:1px solid #e6edf3;border-radius:8px;">
                                            <tr>
                                                <td style="padding:12px 14px;">
                                                    <div
                                                        style="font-family:Arial, Helvetica, sans-serif;font-size:14px;color:#0f172a;font-weight:700;">
                                                        Day {{ $act->day  }} - {{ $act->title ?? 'N/A' }}
                                                    </div>
                                                    
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            @endforeach
                        @endif



                        @foreach ($ferryBookings as $ferry)
                            <tr>
                                <td style="padding:10px 22px;background:#ffffff;">
                                    <table role="presentation" cellpadding="0" cellspacing="0" border="0"
                                        width="100%" style="width:100%;border:1px solid #e6edf3;border-radius:8px;">
                                        <tr>
                                            <td style="padding:12px 14px;">
                                                <table role="presentation" width="100%" cellpadding="0"
                                                    cellspacing="0" border="0">
                                                    <tr>
                                                        {{-- LEFT: Ferry details --}}
                                                        <td valign="top" style="vertical-align:top;">
                                                            <div
                                                                style="font-family:Arial, Helvetica, sans-serif;font-size:14px;color:#0f172a;font-weight:700;">
                                                                {{ $ferry['ferry_name'] ?? 'Ferry Service' }}
                                                            </div>
                                                            <div
                                                                style="font-family:Arial, Helvetica, sans-serif;font-size:13px;color:#6b7c8c;margin:6px 0;">
                                                                Route: {{ $ferry['from_location'] ?? 'N/A' }} →
                                                                {{ $ferry['to_location'] ?? 'N/A' }}
                                                            </div>
                                                            <div
                                                                style="font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#455568;">
                                                                Departure:
                                                                {{ \Carbon\Carbon::parse($ferry['travel_date'])->format('d M y') }}
                                                                {{ date('h:i A', strtotime($ferry['embarkation'])) }}

                                                            </div>
                                                            <div
                                                                style="font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#455568;">
                                                                Arrival:
                                                                {{ \Carbon\Carbon::parse($ferry['travel_date'])->format('d M y') }}
                                                                {{ date('h:i A', strtotime($ferry['disembarkation'])) }}
                                                            </div>

                                                            <div
                                                                style="font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#5b6b7a;margin-top:4px;">
                                                                PNR: {{ $ferry['pnr_no'] ?? 'N/A' }}
                                                            </div>
                                                        </td>

                                                        {{-- RIGHT: Ferry logo/image --}}
                                                        <td valign="top" align="right"
                                                            style="vertical-align:top;text-align:right;width:140px;">
                                                            <img src="https://andamanbliss.com/site/logos/mak-fleet.jpg"
                                                                alt="Ferry" width="120"
                                                                style="display:block;border-radius:6px;border:1px solid #e6edf3;">
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        @endforeach



                        <tr>
                            <td style="padding:12px 22px 4px 22px;background:#ffffff;">
                                <table role="presentation" cellpadding="0" cellspacing="0" border="0"
                                    width="100%">
                                    <tr>
                                        <td style="width:4px;background:#0ea75a;border-radius:2px;">&nbsp;</td>
                                        <td style="width:10px;">&nbsp;</td>
                                        <td
                                            style="font-family:Arial, Helvetica, sans-serif;font-size:12px;letter-spacing:1px;color:#263645;font-weight:800;text-transform:uppercase;padding:8px 0;border-bottom:1px solid #e6edf3;">
                                            Inclusions & Exclusions</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding:10px 22px;background:#ffffff;">
                                <table role="presentation" cellpadding="0" cellspacing="0" border="0"
                                    width="100%">
                                    <tr>
                                        <td valign="top" style="width:50%; padding-right:10px;">
                                            <div
                                                style="font-family:Arial, Helvetica, sans-serif;font-size:14px;font-weight:700;color:#0f172a;margin-bottom:4px;">
                                                Inclusions
                                            </div>
                                            <ul
                                                style="font-family:Arial, Helvetica, sans-serif;font-size:13px;line-height:20px;color:#334155;margin:0;padding-left:18px;">
                                                @foreach ($tour->inclusions->where('type', 'inclusion') as $inc)
                                                    <li>{{ $inc->description ?? '' }}</li>
                                                @endforeach
                                            </ul>
                                        </td>

                                        <td valign="top" style="width:50%; padding-left:10px;">
                                            <div
                                                style="font-family:Arial, Helvetica, sans-serif;font-size:14px;font-weight:700;color:#9b1c1c;margin-bottom:4px;">
                                                Exclusions
                                            </div>
                                            <ul
                                                style="font-family:Arial, Helvetica, sans-serif;font-size:13px;line-height:20px;color:#9b1c1c;margin:0;padding-left:18px;">
                                                @foreach ($tour->inclusions->where('type', 'exclusion') as $exc)
                                                    <li>{{ $exc->description ?? '' }}</li>
                                                @endforeach
                                            </ul>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>



                        <tr>
                            <td style="padding:12px 22px 12px 22px;background:#f4f4f4;">
                                <div
                                    style="font-family:Arial, Helvetica, sans-serif;font-size:12px;line-height:18px;color:#495867;">
                                    For any assistance, contact us at <strong>info@andamanbliss.com</strong> or call
                                    <strong>+91 8900909900 / +91 9933202248</strong>. Your booking details and package
                                    voucher are
                                    attached in this email.
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td
                                style="padding:16px 22px;background:#dcf1e7;text-align:center;color:#1d72b8;font-family:Arial, Helvetica, sans-serif;font-size:12px;">
                                &copy; {{ date('Y') }} Andaman Bliss. All rights reserved.
                            </td>
                        </tr>

                    </table>
                </td>
            </tr>
        </table>
    </div>
    <em>Adventure awaits! Your tickets are attached below—please download and get ready for an unforgettable
        journey!</em>
</body>

</html>
