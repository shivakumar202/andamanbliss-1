<?php

namespace App\Http\Controllers;

use App\Models\FerryBookings;
use App\Models\RazorpayTransactions;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use NumberToWords\NumberToWords;
use setasign\Fpdi\Fpdi;

use SimpleSoftwareIO\QrCode\Facades\QrCode;

class FerryTickets extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function bookings($token)
    {
        $b_no = $token;
        $details = FerryBookings::with('passengerDetails')
            ->where('bookno', $b_no)
            ->orWhere('pnr_no', $b_no)
            ->get();

        return view('tickets.bookings', [
            'details' => $details,
        ]);
    }

    public function index($token)
    {
        $b_no = $token;
        $payPurpose = RazorpayTransactions::where('booking_id', $b_no)->value('purpose') ?? 'Ferry Booking';
        switch ($payPurpose) {
            case 'Activity Booking':
                return $this->getActivityTicker($b_no);
            case 'Ferry Booking':
                return $this->getFerryTickets($b_no);

            default:
                return response()->json(['error' => $payPurpose], 400);
        }
    }


    public function getActivityTicker($b_no)
    {
        return view('activities.ticket');
    }

    public function getFerryTickets($b_no)
    {

        $details = FerryBookings::with(['passengerDetails'])
            ->where(function ($query) use ($b_no) {
                $query->orwhere('bookno', $b_no)
                    ->orWhere('pnr_no', $b_no);
            })
            ->whereIn('booking_status', ['1', '2'])
            ->get();

        if ($details->isEmpty()) {
            abort(404, 'No bookings found');
        }

        $pdf = new Fpdi();
        $tempFiles = [];

        foreach ($details as $booking) {
            if (in_array($booking->ferry, ['Green Ocean 1', 'Green Ocean 2', 'Makruzz', 'Makruzz Gold', 'Makruzz Pearl']) && !empty($booking->base_code)) {
                $tempFile = tempnam(sys_get_temp_dir(), 'pdf_');
                file_put_contents($tempFile, base64_decode($booking->base_code));
                $tempFiles[] = $tempFile;

                $pageCount = $pdf->setSourceFile($tempFile);
                for ($i = 1; $i <= $pageCount; $i++) {
                    $tplIdx = $pdf->importPage($i);
                    $pdf->AddPage();
                    $pdf->useTemplate($tplIdx);
                }
            } else {
                $numberToWords = new NumberToWords();
                $numberTransformer = $numberToWords->getNumberTransformer('en');
                $totalCostInWords = $numberTransformer->toWords($booking->totalCost);

                $tripData = [
                    'booking' => $booking,
                    'qrcode' => base64_encode(QrCode::generate(route('ferry-ticket', [$booking->pnr_no]))),
                    'totalcost' => $totalCostInWords,
                ];

                $domPdf = Pdf::loadView('tickets.ticket', ['details' => [$tripData]]);
                $tempFile = tempnam(sys_get_temp_dir(), 'pdf_');
                file_put_contents($tempFile, $domPdf->output());
                $tempFiles[] = $tempFile;

                $pageCount = $pdf->setSourceFile($tempFile);
                for ($i = 1; $i <= $pageCount; $i++) {
                    $tplIdx = $pdf->importPage($i);
                    $pdf->AddPage();
                    $pdf->useTemplate($tplIdx);
                }
            }
        }

        $outputFile = tempnam(sys_get_temp_dir(), 'final_pdf');
        $pdf->Output($outputFile, 'F');

        foreach ($tempFiles as $file) {
            @unlink($file);
        }

        return response()->file($outputFile, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="all_tickets.pdf"',
        ]);
    }
}
