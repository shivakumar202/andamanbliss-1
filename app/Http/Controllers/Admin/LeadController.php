<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Lead;

class LeadController extends Controller
{
    protected $flightTickets;
    protected $leadSources;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->flightTickets = [
            'have', 'need'
        ];

        $this->leadSources = [
            'direct', 'ads', 'facebook', 'instagram', 'agent', 'others'
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $leads = Lead::query()
            ->when(!empty($request->travel_from), function ($query) use ($request) {
                $query->whereDate('travel_start', '>=', date('Y-m-d', strtotime($request->travel_from)));
            })
            ->when(!empty($request->travel_to), function ($query) use ($request) {
                $query->whereDate('travel_end', '<=', date('Y-m-d', strtotime($request->travel_to)));
            })
            ->when(!empty($request->lead_from), function ($query) use ($request) {
                $query->whereDate('created_at', '>=', date('Y-m-d', strtotime($request->lead_from)));
            })
            ->when(!empty($request->lead_to), function ($query) use ($request) {
                $query->whereDate('created_at', '<=', date('Y-m-d', strtotime($request->lead_to)));
            })
            ->when(!empty($request->package_type), function ($query) use ($request) {
                $query->where('package_type', $request->package_type);
            })
            ->when(!empty($request->hotel_type), function ($query) use ($request) {
                $query->where('hotel_type', $request->hotel_type);
            })
            ->when(!empty($request->flight_ticket), function ($query) use ($request) {
                $query->where('flight_ticket', $request->flight_ticket);
            })
            ->when(!empty($request->lead_source), function ($query) use ($request) {
                $query->where('lead_source', $request->lead_source);
            })
            ->when(!empty($request->status), function ($query) use ($request) {
                $query->where('status', $request->status);
            })
            ->get();

        $packageTypes = Category::where('type', 'tour')
            ->get();

        $hotelTypes = Category::where('type', 'hotel')
            ->get();

        $flightTickets = $this->flightTickets;

        $leadSources = $this->leadSources;

        return view('admin.leads.index')->with(compact('leads', 'packageTypes', 'hotelTypes', 'flightTickets', 'leadSources'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $packageTypes = Category::where('type', 'tour')
            ->get();

        $hotelTypes = Category::where('type', 'hotel')
            ->get();

        $flightTickets = $this->flightTickets;

        $leadSources = $this->leadSources;

        return view('admin.leads.create')->with(compact('packageTypes', 'hotelTypes', 'flightTickets', 'leadSources'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'mobile' => 'required|numeric|integer|digits:10',
            'email' => 'required|email|max:255',
            'package_type' => [
                'sometimes',
                'string',
                'max:255',
                Rule::in(Category::where('type', 'tour')
                    ->pluck('slug')
                    ->toArray()),
            ],
            'hotel_type' => [
                'sometimes',
                'string',
                'max:255',
                Rule::in(Category::where('type', 'hotel')
                    ->pluck('slug')
                    ->toArray()),
            ],
            'flight_ticket' => 'sometimes|string|max:255|in:have,need',
            'lead_source' => 'required|string|max:255|in:direct,ads,facebook,instagram,agent,others',
            'city' => 'sometimes|nullable|string|max:255',
            'travel_start' => 'required|date|date_format:Y-m-d|after_or_equal:' . date('Y-m-d'),
            'travel_end' => 'required|date|date_format:Y-m-d|after_or_equal:' . date('Y-m-d'),
            'adult' => 'required|numeric|integer',
            'child' => 'sometimes|nullable|numeric|integer',
            'price_min' => 'sometimes|nullable|numeric|decimal:2',
            'price_max' => 'sometimes|nullable|numeric|decimal:2',
            'details' => 'sometimes|nullable',
        ]);

        if ($validator->fails()) {
            return back()
                ->withInput()
                ->withErrors($validator);
        }

        $lead = new Lead;
        $lead->name = $request->name;
        $lead->mobile = $request->mobile;
        $lead->email = $request->email;
        $lead->package_type = $request->package_type;
        $lead->hotel_type = $request->hotel_type;
        $lead->flight_ticket = $request->flight_ticket;
        $lead->lead_source = $request->lead_source;
        $lead->city = $request->city;
        $lead->travel_start = $request->travel_start;
        $lead->travel_end = $request->travel_end;
        $lead->adult = $request->adult;
        $lead->child = $request->child;
        $lead->price_min = $request->price_min;
        $lead->price_max = $request->price_max;
        $lead->details = $request->details;
        $lead->save();

        return back()
            ->with('success', __('Lead saved successfully.'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $lead = Lead::findOrFail($id);

        return view('admin.leads.show')->with(compact('lead'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $lead = Lead::findOrFail($id);

        $packageTypes = Category::where('type', 'tour')
            ->get();

        $hotelTypes = Category::where('type', 'hotel')
            ->get();

        $flightTickets = $this->flightTickets;

        $leadSources = $this->leadSources;

        return view('admin.leads.create')->with(compact('lead', 'packageTypes', 'hotelTypes', 'flightTickets', 'leadSources'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'mobile' => 'required|numeric|integer|digits:10',
            'email' => 'required|email|max:255',
            'package_type' => [
                'sometimes',
                'string',
                'max:255',
                Rule::in(Category::where('type', 'tour')
                    ->pluck('slug')
                    ->toArray()),
            ],
            'hotel_type' => [
                'sometimes',
                'string',
                'max:255',
                Rule::in(Category::where('type', 'hotel')
                    ->pluck('slug')
                    ->toArray()),
            ],
            'flight_ticket' => 'sometimes|string|max:255|in:have,need',
            'lead_source' => 'required|string|max:255|in:direct,ads,facebook,instagram,agent,others',
            'city' => 'sometimes|nullable|string|max:255',
            'travel_start' => 'required|date|date_format:Y-m-d|after_or_equal:' . date('Y-m-d'),
            'travel_end' => 'required|date|date_format:Y-m-d|after_or_equal:' . date('Y-m-d'),
            'adult' => 'required|numeric|integer',
            'child' => 'sometimes|nullable|numeric|integer',
            'price_min' => 'sometimes|nullable|numeric|decimal:2',
            'price_max' => 'sometimes|nullable|numeric|decimal:2',
            'details' => 'sometimes|nullable',
        ]);

        if ($validator->fails()) {
            return back()
                ->withInput()
                ->withErrors($validator);
        }

        $lead = Lead::find($id);
        $lead->name = $request->name;
        $lead->mobile = $request->mobile;
        $lead->email = $request->email;
        $lead->package_type = $request->package_type;
        $lead->hotel_type = $request->hotel_type;
        $lead->flight_ticket = $request->flight_ticket;
        $lead->lead_source = $request->lead_source;
        $lead->city = $request->city;
        $lead->travel_start = $request->travel_start;
        $lead->travel_end = $request->travel_end;
        $lead->adult = $request->adult;
        $lead->child = $request->child;
        $lead->price_min = $request->price_min;
        $lead->price_max = $request->price_max;
        $lead->details = $request->details;
        $lead->save();

        return back()
            ->with('success', __('Lead updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $lead = Lead::findOrFail($id);
        $lead->delete();

        return back()
            ->with('success', __('Lead deleted successfully.'));
    }

    /**
     * ChangeStatus the specified resource from storage.
     */
    public function changeStatus(Request $request)
    {
        $statusCode = 200;

        $lead = Lead::find($request->id);
        if (!$lead) {
            if ($request->ajax()) {
                $statusCode = 404;

                return response()->json([
                    'status' => $statusCode,
                    'message' => __('Lead doesn\'t exists.'),
                    'data' => collect(),
                ], $statusCode);
            }

            return back()
                ->withError(__('Lead doesn\'t exists.'));
        }

        $lead->status = $request->status;
        $lead->save();

        if ($request->ajax()) {
            return response()->json([
                'status' => $statusCode,
                'message' => __('Lead ' . $request->status . 'd successfully.'),
                'data' => collect(),
            ], $statusCode);
        }

        return back()
            ->with('success', __('Lead ' . $request->status . 'd successfully.'));
    }
}
