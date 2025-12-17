<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Team;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Constraint;
use Intervention\Image\Facades\Image;
use App\Models\Drive;
class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teams = Team::with('photo')->orderBy('id', 'ASC')->get();
        return view('admin.team.index')->with(compact('teams'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.team.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|string',
            'contact' => 'required|numeric|digits_between:10,15',
            'gender' => 'required|string|in:male,female,other',
            'dob' => 'required|date',
            'role' => 'required|string',
            'joining' => 'required|date',
            'isSupport' => 'required|string|in:1,0',
            'description' => 'sometimes|nullable|string',
            'department' => 'required|string',
            'photo' => 'sometimes|nullable|file|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        if ($validator->fails()) {
            return back()
                ->withInput()
                ->withErrors($validator);
        }

        $team = new Team();
        $team->name = $request->name;
        $team->email = $request->email;
        $team->contact = $request->contact;
        $team->dob = $request->dob;
        $team->role = $request->role;
        $team->isSupport = $request->isSupport;
        $team->gender = $request->gender;
        $team->description = $request->description;
        $team->department = $request->department;
        $team->joining = $request->joining;
        $team->save();

        if ($request->hasFile('photo')) {
            $path = 'team_photo';
            $drive = Drive::where('table_id', $team->id)
                ->where('table_type', $path)
                ->where('file_type', 'image')
                ->first();
            if ($drive) {
                if (Storage::disk('public')->exists($drive->file_name)) {
                    Storage::disk('public')->delete($drive->file_name);
                }
                $drive->delete();
            }

            if (!Storage::disk('public')->exists($path)) {
                Storage::makeDirectory($path, 0777, true, true);
            }

            $file = $request->file('photo');
            $realPath = $file->getRealPath();
            $extension = $file->getClientOriginalExtension();
            $fileName = 'photo-' . date('Ymd-His') . '-' . abs(crc32(uniqid())) . '.' . $extension;
            $fullPath = $path . '/' . $fileName;
            if (Storage::disk('public')->exists($fullPath)) {
                Storage::disk('public')->delete($fullPath);
            }

            $resize_width = 385;
            $resize_height = 385;
            $image = Image::make($realPath)
                ->resize($resize_width, $resize_height, function (Constraint $constraint) {
                    $constraint->aspectRatio(); // auto height
                    $constraint->upsize(); // prevent possible upsizing
                })
                ->encode($extension); // encode image format
            Storage::disk('public')->put($fullPath, $image, 'public');

            $drive = new Drive;
            $drive->table_id = $team->id;
            $drive->table_type = $path;
            $drive->file_name = $fileName;
            $drive->file_type = 'image';
            $drive->save();
        }
        return back()->with('success', __('Team created successfully.'));
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
        $team = Team::with('photo')->findOrFail($id);
        return view('admin.team.create')->with(compact('team'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
       $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|string',
            'contact' => 'required|numeric|digits_between:10,15',
            'gender' => 'required|string|in:male,female,other',
            'dob' => 'required|date',
            'role' => 'required|string',
            'joining' => 'required|date',
            'isSupport' => 'required|string|in:1,0',
            'description' => 'sometimes|nullable|string',
            'department' => 'required|string',
            'photo' => 'sometimes|nullable|file|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        if ($validator->fails()) {
            return back()
                ->withInput()
                ->withErrors($validator);
        }


        $team = Team::findOrFail($id);
        $team->name = $request->name;
        $team->email = $request->email;
        $team->contact = $request->contact;
        $team->dob = $request->dob;
        $team->role = $request->role;
        $team->isSupport = $request->isSupport;
        $team->description = $request->description;
        $team->department = $request->department;
        $team->gender = $request->gender;
        $team->joining = $request->joining;
        $team->save();

        if ($request->hasFile('photo')) {
            $path = 'team_photo';
            $drive = Drive::where('table_id', $team->id)
                ->where('table_type', $path)
                ->where('file_type', 'image')
                ->first();
            if ($drive) {
                if (Storage::disk('public')->exists($drive->file_name)) {
                    Storage::disk('public')->delete($drive->file_name);
                }
                $drive->delete();
            }

            if (!Storage::disk('public')->exists($path)) {
                Storage::makeDirectory($path, 0777, true, true);
            }

            $file = $request->file('photo');
            $realPath = $file->getRealPath();
            $extension = $file->getClientOriginalExtension();
            $fileName = 'photo-' . date('Ymd-His') . '-' . abs(crc32(uniqid())) . '.' . $extension;
            $fullPath = $path . '/' . $fileName;
            if (Storage::disk('public')->exists($fullPath)) {
                Storage::disk('public')->delete($fullPath);
            }

            $resize_width = 385;
            $resize_height = 385;
            $image = Image::make($realPath)
                ->resize($resize_width, $resize_height, function (Constraint $constraint) {
                    $constraint->aspectRatio(); // auto height
                    $constraint->upsize(); // prevent possible upsizing
                })
                ->encode($extension); // encode image format
            Storage::disk('public')->put($fullPath, $image, 'public');

            $drive = new Drive;
            $drive->table_id = $team->id;
            $drive->table_type = $path;
            $drive->file_name = $fileName;
            $drive->file_type = 'image';
            $drive->save();
        }

        return redirect()->route('admin.teams.index')->with('success', 'Team updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $team = Team::findOrFail($id);

        $path = 'team_photo';
        $drive = Drive::where('table_id', $team->id)
            ->where('table_type', $path)
            ->first();
        if ($drive) {
            if (Storage::disk('public')->exists($drive->file_name)) {
                Storage::disk('public')->delete($drive->file_name);
            }
            $drive->delete();
        }
        $team->delete();
        return back()->with('success', __('Team deleted successfully.'));
    }
}
