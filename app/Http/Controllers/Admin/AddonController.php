<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use App\Models\Addon;
use Intervention\Image\Constraint;
use Intervention\Image\Facades\Image;
use App\Models\Drive;
use Illuminate\Support\Facades\Storage;

class AddonController extends Controller
{
    protected $types;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->types = [
            'tour', 'hotel', 'activity', 'cruise', 'cab', 'bike'
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $addons = Addon::query()
            ->when(!empty($request->type), function ($query) use ($request) {
                $query->where('type', $request->type);
            })
            ->get();

        $types = $this->types;

        return view('admin.addons.index')->with(compact('addons', 'types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = $this->types;

        return view('admin.addons.create')->with(compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('addons', 'name')
                    ->where('name', $request->name)
                    ->where('type', $request->type),
            ],
            'type' => 'required|string|max:255|in:tour,hotel,activity,cruise,cab,bike',
            'rate' => 'required|numeric|decimal:2',
            'price' => 'required|numeric|decimal:2',
            'duration' => 'required|string',
            'fees' => 'required|numeric|decimal:2',
        ]);

        if ($validator->fails()) {
            return back()
                ->withInput()
                ->withErrors($validator);
        }

        $addon = new Addon;
        $addon->name = $request->name;
        $addon->type = $request->type;
        $addon->duration = $request->duration;
        $addon->rate = $request->rate;
        $addon->price = $request->price;
        $addon->fees = $request->fees;
        $addon->save();

        return back()
            ->with('success', __('Addon saved successfully.'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $addon = Addon::findOrFail($id);

        return view('admin.addons.show')->with(compact('addon'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $addon = Addon::findOrFail($id);
        $types = $this->types;
        return view('admin.addons.create')->with(compact('addon', 'types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('addons', 'name')
                    ->where('name', $request->name)
                    ->where('type', $request->type)
                    ->ignore($id),
            ],
            'type' => 'required|string|max:255|in:tour,hotel,activity,cruise,cab,bike',
            'rate' => 'required|numeric|decimal:2',
            'price' => 'required|numeric|decimal:2',
            'duration' => 'required|string',
            'fees' => 'required|numeric|decimal:2',
        ]);

        if ($validator->fails()) {
            return back()
                ->withInput()
                ->withErrors($validator);
        }

        $addon = Addon::find($id);
        $addon->name = $request->name;
        $addon->type = $request->type;
        $addon->type = $request->type;
        $addon->duration = $request->duration;
        $addon->price = $request->price;
        $addon->fees = $request->fees;
        $addon->save();

        return back()
            ->with('success', __('Addon updated successfully.'));
    }

    public function images(Request $request, $addonId, $id = null)
    {
        $path = 'addon_photo';
    
        if ($request->isMethod('post')) {
            $rules = [
                'photo' => 'required|file|image|mimes:jpeg,jpg,png|max:2048',
            ];
    
            $validator = Validator::make($request->all(), $rules);
    
            if ($validator->fails()) {
                return back()->withInput()->withErrors($validator);
            }
    
            if ($request->hasFile('photo')) {
                $drive = Drive::where('table_id', $addonId)
                    ->where('table_type', $path)
                    ->where('file_type', 'image')
                    ->first();
    
                $previousFileName = $drive ? $drive->file_name : null;
    
                // Ensure the directory exists
                if (!Storage::disk('public')->exists($path)) {
                    Storage::disk('public')->makeDirectory($path, 0777, true, true);
                }
    
                $file = $request->file('photo');
                $extension = $file->getClientOriginalExtension();
                $fileName = 'photo-' . date('Ymd-His') . '-' . abs(crc32(uniqid())) . '.' . $extension;
                $fullPath = $path . '/' . $fileName;
    
                // Resize and save image to storage/app/public
                $resize_width = 720;
                $resize_height = 480;
                $image = Image::make($file->getRealPath())
                    ->resize($resize_width, $resize_height, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    })
                    ->encode($extension);
    
                Storage::disk('public')->put($fullPath, $image);
    
                // Copy to public directory for direct access
                $publicPath = public_path('storage/' . $fullPath);
                if (!file_exists(dirname($publicPath))) {
                    mkdir(dirname($publicPath), 0777, true);
                }
                copy(storage_path('app/public/' . $fullPath), $publicPath);
    
                // Delete previous file if exists
                if ($drive) {
                    $previousFilePath1 = public_path('storage/' . $path . '/' . $previousFileName);
                    $previousFilePath2 = storage_path('app/public/' . $path . '/' . $previousFileName);
    
                    if (file_exists($previousFilePath1)) {
                        unlink($previousFilePath1);
                    }
                    if (file_exists($previousFilePath2)) {
                        unlink($previousFilePath2);
                    }
    
                    $drive->file_name = $fileName;
                    $drive->save();
                } else {
                    $drive = new Drive;
                    $drive->table_id = $addonId;
                    $drive->table_type = $path;
                    $drive->file_name = $fileName;
                    $drive->file_type = 'image';
                    $drive->save();
                }
            }
    
            return redirect('admin/addons/' . $addonId . '/images')
                ->with('success', __('Addon image updated successfully'));
        }
    
        $addon = Addon::findOrFail($addonId);
    
        $drive = Drive::where('table_id', $addonId)
            ->where('table_type', $path)
            ->where('file_type', 'image')
            ->first();
    
        return view('admin.addons.images', compact('addon', 'drive'));
    }
    


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $addon = Addon::findOrFail($id);
        $addon->delete();

        return back()
            ->with('success', __('Addon deleted successfully.'));
    }
}