<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Constraint;
use Intervention\Image\Facades\Image;
use App\Models\Car;
use App\Models\Drive;

class CarController extends Controller
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
        $cars = Car::query()
            ->when(!empty($request->from_date), function ($query) use ($request) {
                $query->whereDate('reg_date', '>=', date('Y-m-d', strtotime($request->from_date)));
            })
            ->when(!empty($request->to_date), function ($query) use ($request) {
                $query->whereDate('reg_date', '<=', date('Y-m-d', strtotime($request->to_date)));
            })
            ->when(!empty($request->status), function ($query) use ($request) {
                $query->where('status', $request->status);
            })
            ->get();

        return view('admin.cars.index')->with(compact('cars'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.cars.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'reg_no' => 'required|string|alpha_num:ascii|max:255|unique:App\Models\Car,reg_no',
            'reg_date' => 'required|date|date_format:Y-m-d|before_or_equal:' . date('Y-m-d'),
            'fuel' => 'required|string|max:255|in:electric,petrol,diesel',
            'cc' => 'required|numeric|integer',
            'seat' => 'required|numeric|integer',
            'ac' => 'sometimes|nullable|string|max:255|in:yes,no',
            'photo' => 'sometimes|nullable|file|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        if ($validator->fails()) {
            return back()
                ->withInput()
                ->withErrors($validator);
        }

        $car = new Car;
        $car->name = $request->name;
        $car->reg_no = $request->reg_no;
        $car->reg_date = $request->reg_date;
        $car->fuel = $request->fuel;
        $car->cc = $request->cc;
        $car->seat = $request->seat;
        $car->ac = $request->ac ?? 'no';
        $car->save();

        if ($request->hasFile('photo')) {
            $path = 'car_photo';
            $drive = Drive::where('table_id', $car->id)
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
            $drive->table_id = $car->id;
            $drive->table_type = $path;
            $drive->file_name = $fileName;
            $drive->file_type = 'image';
            $drive->save();
        }

        return back()
            ->with('success', __('Car saved successfully.'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $car = Car::with(['photo'])
            ->findOrFail($id);

        return view('admin.cars.show')->with(compact('car'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $car = Car::with(['photo'])
            ->findOrFail($id);

        return view('admin.cars.create')->with(compact('car'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'reg_no' => 'required|string|alpha_num:ascii|max:255|unique:App\Models\Car,reg_no,' . $id,
            'reg_date' => 'required|date|date_format:Y-m-d|before_or_equal:' . date('Y-m-d'),
            'fuel' => 'required|string|max:255|in:electric,petrol,diesel',
            'cc' => 'required|numeric|integer',
            'seat' => 'required|numeric|integer',
            'ac' => 'required|string|max:255|in:yes,no',
            'photo' => 'sometimes|nullable|file|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        if ($validator->fails()) {
            return back()
                ->withInput()
                ->withErrors($validator);
        }

        $car = Car::find($id);
        $car->name = $request->name;
        $car->reg_no = $request->reg_no;
        $car->reg_date = $request->reg_date;
        $car->fuel = $request->fuel;
        $car->cc = $request->cc;
        $car->seat = $request->seat;
        $car->ac = $request->ac ?? 'no';
        $car->save();

        if ($request->hasFile('photo')) {
            $path = 'car_photo';
            $drive = Drive::where('table_id', $car->id)
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
            $drive->table_id = $car->id;
            $drive->table_type = $path;
            $drive->file_name = $fileName;
            $drive->file_type = 'image';
            $drive->save();
        }

        return back()
            ->with('success', __('Car updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $car = Car::findOrFail($id);

        $path = 'car_photo';
        $drive = Drive::where('table_id', $car->id)
            ->where('table_type', $path)
            ->where('file_type', 'image')
            ->first();
        if ($drive) {
            if (Storage::disk('public')->exists($drive->file_name)) {
                Storage::disk('public')->delete($drive->file_name);
            }
            $drive->delete();
        }

        $car->delete();

        return back()
            ->with('success', __('Car deleted successfully.'));
    }

    /**
     * ChangeStatus the specified resource from storage.
     */
    public function changeStatus(Request $request)
    {
        $statusCode = 200;

        $car = Car::find($request->id);
        if (!$car) {
            if ($request->ajax()) {
                $statusCode = 404;

                return response()->json([
                    'status' => $statusCode,
                    'message' => __('Car doesn\'t exists.'),
                    'data' => collect(),
                ], $statusCode);
            }

            return back()
                ->withError(__('Car doesn\'t exists.'));
        }

        $car->status = $request->status;
        $car->save();

        if ($request->ajax()) {
            return response()->json([
                'status' => $statusCode,
                'message' => __('Car ' . $request->status . 'd successfully.'),
                'data' => collect(),
            ], $statusCode);
        }

        return back()
            ->with('success', __('Car ' . $request->status . 'd successfully.'));
    }
}
