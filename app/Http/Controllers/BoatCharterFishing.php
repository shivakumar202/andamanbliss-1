<?php

namespace App\Http\Controllers;

use App\Models\BoatPackage;
use Illuminate\Http\Request;

class BoatCharterFishing extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function gameFishing()
    {
        $gamefishing = BoatPackage::with('seasonalPrices', 'boatImages')->where('package_type', 'Game Fishing')->where('status', 1)->get();
        $testimonials = [
            [
                'name' => 'Rahul Sharma',
                'location' => 'Delhi, India',
                'avatar' => 'https://randomuser.me/api/portraits/men/32.jpg',
                'text' => 'The private boat charter was the highlight of our Andaman trip!',
            ],
            [
                'name' => 'Priya Patel',
                'location' => 'Mumbai, India',
                'avatar' => 'https://randomuser.me/api/portraits/women/44.jpg',
                'text' => 'The sunset cruise was magical and unforgettable!',
            ],
        ];
        return view('boat-activity.game-fishing.index', compact('gamefishing', 'testimonials'));
    }

    public function boatCharter()
    {
        $boatCharter = BoatPackage::with('seasonalPrices', 'boatImages', 'inclusions')->whereIn('package_type', ['Boat Charter', 'Sunset Tours'])->where('status', 1)->get();
        $fishingDurations = ['8 - 10', '4 - 5'];
        $fishing = collect();

        foreach ($fishingDurations as $duration) {
            $package = BoatPackage::with('seasonalPrices')
                ->where('package_type', 'Game Fishing')
                ->where('duration', 'LIKE', "%$duration%")
                ->where('status', 1)->orderBy('base_price', 'asc')
                ->first();

            if ($package) {
                $fishing->push($package);
            }
        }
        $testimonials = [
            [
                'name' => 'Rahul Sharma',
                'location' => 'Delhi, India',
                'avatar' => 'https://randomuser.me/api/portraits/men/32.jpg',
                'text' => 'The private boat charter was the highlight of our Andaman trip!',
            ],
            [
                'name' => 'Priya Patel',
                'location' => 'Mumbai, India',
                'avatar' => 'https://randomuser.me/api/portraits/women/44.jpg',
                'text' => 'The sunset cruise was magical and unforgettable!',
            ],
        ];
        return view('boat-activity.boat-charter.index', compact('boatCharter', 'fishing', 'testimonials'));
    }


    public function getItinerary($id)
    {
        $package = BoatPackage::with('boatItineraries', 'inclusions', 'fishesFounds')->find($id);

        if (!$package) {
            return response()->json(['error' => 'Package not found'], 404);
        }

    

        $itineraries = $package->boatItineraries->map(function ($item) use ($package) {
            return [
                'title' => $item->title,
                'day' => $item->day,
                'activity_description' => $package->description,
                
                'description' => $item->description,
                'boat_package_name' => $package->name,
                'fishes_found' => $package->fishesFounds->map(function ($fish) {
                    return [
                        'name' => $fish->name,
                        'image' => $fish->image,
                        
                        'description' => $fish->description,
                    ];
                })->toArray(),
                'inclusions' => $package->inclusions->where('type', 'inclusion')->pluck('description')->toArray(),
                'exclusions' => $package->inclusions->where('type', 'exclusion')->pluck('description')->toArray(),
            ];
        });

        return response()->json($itineraries);
    }


    public function GameFishEnquiry(Request $request)
    {
        $request->validate([
            'fishingPackage' => 'required|string',
            'fishingDate' => 'required|date',
            'anglerCount' => 'required|string',
            'fishingLocation' => 'nullable|string',
            'phoneNumber' => 'required|string',
            'emailAddress' => 'required|email',
        ]);

        if (!$request->has('website') || !empty($request->website)) {
            return back()->with('error', 'Spam detected. Submission blocked.');
        }


        $mailData['subject'] = 'Game Fishing Package Enquiry';
        $mailData['email'] = env('MAIL_FROM_ADDRESS', 'info@andamanbliss.com');
        $mailData['name'] = env('MAIL_FROM_NAME', 'AndamanBliss');
        $mailData['body'] = "";

        $mailData['body'] .= "<strong>Game Fishing Package:</strong> {$request->fishingPackage}<br/>";
        $mailData['body'] .= "<strong>Date:</strong> {$request->fishingDate}<br/>";
        $mailData['body'] .= "<strong>Anglers:</strong> {$request->anglerCount}<br/>";
        if ($request->filled('fishingLocation')) {
            $mailData['body'] .= "<strong>Preferred Location::</strong> {$request->fishingLocation}<br/>";
        }

        $mailData['body'] .= "<strong>Phone:</strong> {$request->phoneNumber}<br/>";
        $mailData['body'] .= "<strong>Email:</strong> {$request->emailAddress}<br/>";



        if ($request->filled('customer_name')) {
            $mailData['body'] .= "<strong>Customer Name:</strong> {$request->customer_name}<br/>";
        }
        if ($request->filled('fishing_duration')) {
            $mailData['body'] .= "<strong>Fishing Duration:</strong> {$request->fishing_duration}<br/>";
        }
        if ($request->filled('special_requests')) {
            $mailData['body'] .= "<strong>Special Requests:</strong> {$request->special_requests}<br/>";
        }

        $mailData['info'] = 'Note: Don\'t share your login credentials. Keep them confidential.';

        \Mail::send('emails.template', $mailData, function ($message) use ($mailData) {
            $message->subject($mailData['subject'])
                ->to('info@andamanbliss.com')
                ->cc('amitmandal@andamanbliss.com');
        });

        return back()->with('success', __('Enquiry form submitted successfully!'));
    }


    public function BoatChaterEnquiry(Request $request)
    {
        $validated = $request->validate([
            'fullName' => 'required|string|max:255',
            'emailAddress' => 'required|email|max:255',
            'phoneNumber' => 'required|string|max:20',
            'preferredDate' => 'required|date|after_or_equal:today',
            'charterType' => 'nullable|string|max:255',
            'guestCount' => 'required|string|max:50',
            'tripDuration' => 'nullable|string|max:50',
            'specialRequests' => 'nullable|string|max:1000',
            'termsChecks' => 'accepted',
        ]);
        if (!$request->has('website') || !empty($request->website)) {
            return back()->with('error', 'Spam detected. Submission blocked.');
        }

        // Map charterType to user-friendly name


        $mailData['subject'] = 'Boat Charter Enquiry';
        $mailData['email'] = env('MAIL_FROM_ADDRESS', 'info@andamanbliss.com');
        $mailData['name'] = env('MAIL_FROM_NAME', 'AndamanBliss');
        $mailData['body'] = "";

        $mailData['body'] .= "<strong>Boat Charter Type:</strong> {$validated['charterType']}<br/>";
        $mailData['body'] .= "<strong>Preferred Date:</strong> {$validated['preferredDate']}<br/>";
        $mailData['body'] .= "<strong>Number of Guests:</strong> {$validated['guestCount']}<br/>";



        if ($request->filled('tripDuration')) {
            $mailData['body'] .= "<strong>Trip Duration:</strong> {$validated['tripDuration']}<br/>";
        }



        $mailData['body'] .= "<strong>Phone:</strong> {$validated['phoneNumber']}<br/>";
        $mailData['body'] .= "<strong>Email:</strong> {$validated['emailAddress']}<br/>";
        $mailData['body'] .= "<strong>Customer Name:</strong> {$validated['fullName']}<br/>";
        if (!empty($validated['specialRequests'])) {
            $mailData['body'] .= "<strong>Special Requests:</strong> {$validated['specialRequests']}<br/>";
        }
        $mailData['info'] = 'Note: Don\'t share your login credentials. Keep them confidential.';

        try {
            \Mail::send('emails.template', $mailData, function ($message) use ($mailData) {
                $message->subject($mailData['subject'])
                    ->to('info@andamanbliss.com')
                    ->cc('amitmandal@andamanbliss.com');
            });
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to send enquiry. Please try again later.');
        }

        return back()->with('success', __('Enquiry form submitted successfully!'));
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
