<?php

namespace App\Http\Controllers;

use App\Models\AcitivityBooking;
use Illuminate\Http\Request;

class upSaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('upsale.index');
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
    public function show(AcitivityBooking $acitivityBooking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AcitivityBooking $acitivityBooking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AcitivityBooking $acitivityBooking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AcitivityBooking $acitivityBooking)
    {
        //
    }
}
