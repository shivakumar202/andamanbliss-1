<?php

namespace App\Http\Controllers;

use App\Services\SealinkService;
use Illuminate\Http\Request;

class SealinkController extends Controller
{
    protected $sealinkService;

    public function __construct(SealinkService $sealinkService)
    {
        $this->sealinkService = $sealinkService;
    }

    public function index()
    {
        return view('ferry.index');
    }

    public function searchTrips(Request $request)
    {

        // $request->validate([
        //     'date' => 'required|date',
        //     'from' => 'required|string',
        //     'to' => 'required|string',
        // ]);

        try {
            $trips = $this->sealinkService->getTripData(
                '2-9-2025',
                'Port Blair',
                $request->to
            );
            return response()->json($trips);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function bookSeats(Request $request)
    {
        $data = $request->all();

        try {
            $bookingResponse = $this->sealinkService->bookSeats($data);
            return response()->json($bookingResponse);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
