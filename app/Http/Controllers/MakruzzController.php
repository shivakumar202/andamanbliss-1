<?php

namespace App\Http\Controllers;

use App\Services\MakruzzApiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class MakruzzController extends Controller
{
    protected $makruzzService;

    public function __construct(MakruzzApiService $makruzzService)
    {
        $this->makruzzService = $makruzzService;
    }

    public function login()
    {
        
        $response = $this->makruzzService->login();
        
        $data = $response->getData(true);
    
        if (isset($data['details']['code']) && $data['details']['code'] == 200) {
            session(['makruzz_token' => $data['details']['data']['token']]);

            return redirect()->route('cruises')->with('msg', $data['details']['msg']);
        }
    
        return response()->json($data);
    }
        

    public function getSectors()
    {
        $this->login();
        $data = response()->json($this->makruzzService->getSectors());
    }

    public function searchSchedule(Request $request)
    {
        $data = [
            'trip_type' => $request->trip_type,
            'from_location' => $request->from_location,
            'to_location' => $request->to_location,
            'no_of_passenger' => $request->adult + $request->child,
            'travel_date' => $request->travel_date,
        ];
        $result = $this->makruzzService->searchSchedule(
           $data
        );
        return response()->json($result);
    }

    public function returnScheduleSearch(Request $request)
    {
        $result = $this->makruzzService->returnScheduleSearch(
            $request->from_location,
            $request->to_location,
            $request->travel_date,
            $request->return_travel_date,
            $request->no_of_passenger
        );
        return response()->json($result);
    }

    public function savePassenger(Request $request)
    {
        $result = $this->makruzzService->savePassenger(
            $request->schedule_id,
            $request->travel_date,
            $request->class_id,
            $request->passenger_data
        );
        return response()->json($result);
    }

    public function confirmBooking(Request $request)
    {
        $result = $this->makruzzService->confirmBooking($request->booking_id);
        return response()->json($result);
    }
}
