<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Service;
use App\Models\Addon;
use App\Models\Booking;
use App\Services\MakruzzApiService;

class CruiseController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $makruzzService;

    public function __construct(MakruzzApiService $makruzzService)
    {
        $this->makruzzService = $makruzzService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $cruises = Service::with('category')
            ->where('type', 'cruise')
            ->whereHas('category', function ($query) use ($request) {
                $query->when(!empty($request->categories), function ($q) use ($request) {
                        $q->whereIn('slug', $request->categories);
                    })
                    ->when(!empty($request->category), function ($q) use ($request) {
                        $q->where('slug', $request->category);
                    });
            })
            ->when(!empty($request->ratings), function ($query) use ($request) {
                $query->whereIn('ratings', $request->ratings);
            })
            ->when($request->featured == 1, function ($query) use ($request) {
                $query->where('featured', 1);
            })
            ->when($request->best_seller == 1, function ($query) use ($request) {
                $query->where('best_seller', 1);
            })
            ->when(!empty($request->status), function ($query) use ($request) {
                $query->where('status', $request->status);
            })
            ->when(!empty($request->min_price), function ($query) use ($request) {
                $query->where('adult_price', '>=', $request->min_price);
            })
            ->when(!empty($request->max_price), function ($query) use ($request) {
                $query->where('adult_price', '<=', $request->max_price);
            })
            ->when(!empty($request->keyword), function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    $q->where('name', 'like', "%{$request->keyword}%")
                        ->orWhere('description', 'like', "%{$request->keyword}%");
                });
            })
            ->get();

        $categories = Category::where('type', 'cruise')->get();

        return view('cruises.index')->with(compact('cruises', 'categories'));
    }


    public function dev(Request $request)
    {
        
            return view('cruises.show');    
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
    public function show(string $slug)
    {
        return view('cruises.show');
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

    public function static(string $slug, string $subslug = null)
    {
        $cruise = Service::with(['cruisePhotos', 'category', 'facilities', 'policies', 'faqs', 'reviews'])
            ->whereHas('category', function ($query) use ($slug) {
                $query->where('type', 'cruise')
                    ->where('slug', $slug);
            })
            ->where('type', 'cruise')
            ->firstWhere('slug', $subslug);
        if ($subslug && !$cruise) {
            abort(404, 'Page not found.');
        }

        $addons = Addon::where('type', 'cruise')->get();

        $cruises = Service::with(['cruisePhotos'])
            ->whereHas('category', function ($query) use ($slug) {
                $query->where('type', 'cruise')
                    ->where('slug', $slug);
            })
            ->where('type', 'cruise')
            // ->whereNot('slug', $subslug)
            ->inRandomOrder()
            ->take(10)
            ->get();

        return view('cruises.static.index')
            ->with(compact('cruise', 'addons', 'cruises'));
    }

    public function booking(Request $request)
    {
        $statusCode = 404;
        if ($request->ajax()) {
            $latestBooking = Booking::max('booking_id') ?? 0;
            $formattedBookingId = str_pad($latestBooking + 1, 20, '0', STR_PAD_LEFT);

            $service = Service::find($request->id);

            $booking = new Booking;
            $booking->booking_id = $formattedBookingId;
            $booking->table_id = $request->id;
            $booking->table_type = 'services';
            $booking->type = 'cruise';
            $booking->room_id = null;
            $booking->food_choice = null;
            $booking->user_id = auth()->user()->id ?? null;
            $booking->name = $request->name;
            $booking->surname = null;
            $booking->mobile = $request->mobile;
            $booking->email = $request->email;
            $booking->address = null;
            $booking->rate = $rate = $service?->adult_price ?? 0.00;
            $booking->quantity = $quantity = $request->adultCount;
            $booking->price = $rate * $quantity;
            $booking->adult = $request->adultCount;
            $booking->child = $request->childCount;
            $booking->start_at = date('Y-m-d', strtotime($request->start_at));
            $booking->end_at = null;
            $booking->location = $request->location;
            $booking->destination = $request->destination;
            $booking->note = null;
            $booking->status = 'active';
            $booking->save();

            if (!empty($request->addons)) {
                foreach ($request->addons as $key => $value) {
                    $addon = Addon::find($value);

                    $booking = new Booking;
                    $booking->booking_id = $formattedBookingId;
                    $booking->table_id = $value;
                    $booking->table_type = 'addons';
                    $booking->type = 'cruise';
                    $booking->room_id = null;
                    $booking->food_choice = null;
                    $booking->user_id = auth()->user()->id ?? null;
                    $booking->name = $request->name;
                    $booking->surname = null;
                    $booking->mobile = $request->mobile;
                    $booking->email = $request->email;
                    $booking->address = null;
                    $booking->rate = $rate = $addon->price ?? 0.00;
                    $booking->quantity = $quantity = 1;
                    $booking->price = $rate * $quantity;
                    $booking->adult = 0;
                    $booking->child = 0;
                    $booking->start_at = date('Y-m-d', strtotime($request->start_at));
                    $booking->end_at = null;
                    $booking->location = $request->location;
                    $booking->destination = $request->destination;
                    $booking->note = null;
                    $booking->status = 'active';
                    $booking->save();
                }
            }

            $statusCode = 200;
            return response()->json([
                'status' => $statusCode,
                'message' => __('Booking enquiry form submitted successfully!'),
                'data' => Booking::where('booking_id', $formattedBookingId)->get(),
            ], $statusCode);
        }
    }
}
