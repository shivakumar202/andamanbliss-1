<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RazorpayTransactions;
use App\Models\TempItinerary;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Display a listing of the resource.
     */
   public function index(Request $request)
{
    $users = User::count();

    $query = RazorpayTransactions::whereNotNull('payment_id');

    if ($request->filled('daterange')) {

        [$from, $to] = explode(' - ', $request->daterange);

        $fromDate = Carbon::parse($from)->startOfDay(); // 2025-12-28 00:00:00
        $toDate   = Carbon::parse($to)->endOfDay();     // 2025-12-28 23:59:59

        $query->whereBetween('created_at', [$fromDate, $toDate]);

    }

    $bookings = $query->count();
    $revenue  = $query->sum('amount');

    return view('admin.home', compact('users', 'bookings', 'revenue'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
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
