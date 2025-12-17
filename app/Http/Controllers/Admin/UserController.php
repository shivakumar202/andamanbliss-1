<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Visit;
use App\Models\Visitors;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::orderBy('id', 'ASC')->get();
        return view('admin.users.index')->with(compact('users'));
    }


    public function visitors()
    {
        $visitors = Visitors::orderBy('created_at', 'DESC')->paginate(10);
        return view('admin.visitors.index', compact('visitors'));
    }

    public function heatmap()
    {
        $visits = Visit::whereNot('country', 'Andaman and Nicobar')->whereNotNull('lat')->whereNotNull('long')->get(['lat', 'long', 'duration', 'country']);
        $visitors = Visit::all();
        $visitorsCount = $visitors->unique('ip')->count();
        $maxVisits = Visit::select('url', DB::raw('COUNT(*) as total'))->groupBy('url')->orderByDesc('total')->get();
        $maxTimeSpent = Visit::select('url', DB::raw('SUM(duration) as total_duration'))->groupBy('url')->orderByDesc('total_duration')->get();
        $oldIps = Visit::where('created_at', '<', now()->startOfDay())->pluck('ip')->unique();
        $newVisits = Visit::where('created_at', '>=', now()->startOfDay())->whereNotIn('ip',$oldIps)->distinct('ip')->count();
  
        $liveVisitors = $visitors->where('created_at', '>=', now()->subMinutes(5))->unique('ip')->count();
        $data = [
            'visitorsCount' => $visitorsCount,
            'maxVisits' => $maxVisits,
            'maxTimeSpent' => $maxTimeSpent,
            'newVisits' => $newVisits,
            'liveVisitors' => $liveVisitors,
        ];
        return view('admin.visitors.heat-map', compact('visits', 'data'));
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
        $user = User::findOrFail($id);

        $user->delete();
        return back()->with('success', __("User deleted successfully"));
    }
}
