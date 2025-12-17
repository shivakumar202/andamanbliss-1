<?php

namespace App\Http\Controllers;

use App\Models\FerryBookings;
use App\Models\RazorpayTransactions;
use App\Services\MakruzzApiService;
use App\Services\SealinkService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FerryOperations extends Controller
{
    protected $sealinkService;
    protected $makruzzApiService;

    public function __construct(SealinkService $sealinkService, MakruzzApiService $makruzzApiService)
    {
        $this->makruzzApiService = $makruzzApiService;
        $this->sealinkService = $sealinkService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
      
            return view('cruises.index');
    
    }
    
    public function bookings($token)
    {
        $b_no = decrypt($token);
        $details = FerryBookings::with('passengerDetails')
        ->where('bookno', $b_no)
        ->orWhere('pnr_no', $b_no)
        ->get();

        return view('tickets.bookings', [
            'details' => $details,]);       
    }

    public function layouts()
    {
       return view('cruises.greenocean.g1.premium');
    }
    
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
