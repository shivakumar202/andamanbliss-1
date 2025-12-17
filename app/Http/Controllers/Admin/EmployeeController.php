<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Constraint;
use Intervention\Image\Facades\Image;
use Spatie\Permission\Models\Role;
use App\Models\Admin;
use App\Models\Drive;

class EmployeeController extends Controller
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
        $roles = Role::whereNotIn('name', ['admin', 'user'])
            ->get();

        $admins = Admin::with('roles')
            ->when(auth()->user()->hasAnyRole(['admin']), function ($query) {
                $query->whereHas('roles', function ($q) {
                    $q->whereIn('roles.name', ['manager', 'telecaller', 'guide', 'driver']);
                });
            })
            ->when(auth()->user()->hasAnyRole(['manager']), function ($query) {
                $query->whereHas('roles', function ($q) {
                    $q->whereIn('roles.name', ['telecaller', 'guide', 'driver']);
                });
            })
            ->when(auth()->user()->hasAnyRole(['telecaller']), function ($query) {
                $query->whereHas('roles', function ($q) {
                    $q->whereIn('roles.name', ['guide', 'driver']);
                });
            })
            ->when(auth()->user()->hasAnyRole(['guide']), function ($query) {
                $query->whereHas('roles', function ($q) {
                    $q->whereIn('roles.name', ['driver']);
                });
            })
            ->when(auth()->user()->hasAnyRole(['driver']), function ($query) {
                $query->whereHas('roles', function ($q) {
                    $q->whereIn('roles.name', []);
                });
            })
            ->when(!empty($request->role), function ($query) use ($request) {
                $query->whereHas('roles', function ($q) use ($request) {
                    $q->where('roles.name', $request->role);
                });
            })
            ->when(!empty($request->dob), function ($query) use ($request) {
                $query->whereDate('dob', '>=', date('Y-m-d', strtotime($request->dob)))
                ->whereDate('dob', '<=', date('Y-m-d', strtotime($request->dob)));
            })
            ->when(!empty($request->status), function ($query) use ($request) {
                $query->where('status', $request->status);
            })
            ->get();

        return view('admin.employees.index')->with(compact('roles', 'admins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::whereNotIn('name', ['admin', 'user'])
            ->get();

        return view('admin.employees.create')->with(compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'surname' => 'sometimes|nullable|string|max:255',
            'support' => 'sometimes|string',
            'mobile' => 'required|numeric|integer|digits:10|unique:App\Models\Admin,mobile',
            'email' => 'required|email|max:255|unique:App\Models\Admin,email',
            'username' => 'required|string|alpha_dash:ascii|max:255|unique:App\Models\Admin,username',
            'password' => 'required|string|min:8',
            'otpfa' => 'sometimes|nullable|string|max:255|in:on,off',
            'dob' => 'required|date|date_format:Y-m-d|before_or_equal:' . date('Y-m-d', strtotime('-18 year')) . '|after_or_equal:' . date('Y-m-d', strtotime('-60 year')),
            'sex' => 'sometimes|nullable|string|max:255|in:,male,female',
            'role' => [
                'required', 'string', 'max:255',
                Rule::in(Role::whereNotIn('name', ['admin', 'user'])
                    ->pluck('name')
                    ->toArray()),
            ],
            'photo' => 'sometimes|nullable|file|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        if ($validator->fails()) {
            return back()
                ->withInput()
                ->withErrors($validator);
        }

        $admin = new Admin;
        $admin->name = $request->name;
        $admin->surname = $request->surname;
        $admin->mobile = $request->mobile;
        $admin->email = $request->email;
        $admin->username = $request->username;
        $admin->forceFill([
                'password' => bcrypt($request->password)
            ])
            ->setRememberToken(Str::random(60));
        $admin->otpfa = $request->otpfa ?? 'off';
        $admin->dob = $request->dob;
        $admin->sex = $request->sex;
        $admin->support = $request->support ?? '0';
        $admin->save();
        $admin->assignRole($request->role);

        if ($request->hasFile('photo')) {
            $path = 'admin_photo';
            $drive = Drive::where('table_id', $admin->id)
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
            $drive->table_id = $admin->id;
            $drive->table_type = $path;
            $drive->file_name = $fileName;
            $drive->file_type = 'image';
            $drive->save();
        }

        if ($request->has('email')) {
            $mailData['subject'] = 'New Employee.';
            $mailData['email'] = $admin->email;
            $mailData['name'] = $admin->name;
            $mailData['body'] = "Congratulations! You are new employee.";
            $mailData['url'] = url('admin/login');
            $mailData['button'] = 'Login';
            $mailData['subbody'] = "Please use the credentials to login.<br/>
                                Username: {$admin->username}<br/>
                                Password: {$request->password}";
            $mailData['info'] = 'Note: don\'t share your login credentials & keep it confedential.';

            \Mail::send('emails.template', $mailData, function ($message) use ($mailData) {
                $message->subject($mailData['subject'])
                    ->to($mailData['email'], $mailData['name'])
                    ->cc(Admin::role('admin')->first()->email);
            });
        }

        return back()
            ->with('success', __('Employee saved successfully.'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $admin = Admin::with(['roles', 'photo'])
            ->findOrFail($id);

        return view('admin.employees.show')->with(compact('admin'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $admin = Admin::with(['roles', 'photo'])
            ->findOrFail($id);

        $roles = Role::whereNotIn('name', ['admin', 'user'])
            ->get();

        return view('admin.employees.create')->with(compact('roles', 'admin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'surname' => 'sometimes|nullable|string|max:255',
            'mobile' => 'required|numeric|integer|digits:10|unique:App\Models\Admin,mobile,' . $id,
            'email' => 'required|email|max:255|unique:App\Models\Admin,email,' . $id,
            'username' => 'required|string|alpha_dash:ascii|max:255|unique:App\Models\Admin,username,' . $id,
            'password' => 'sometimes|nullable|string|min:8',
            'otpfa' => 'sometimes|nullable|string|max:255|in:on,off',
            'dob' => 'required|date|date_format:Y-m-d|before_or_equal:' . date('Y-m-d', strtotime('-18 year')) . '|after_or_equal:' . date('Y-m-d', strtotime('-60 year')),
            'sex' => 'sometimes|nullable|string|max:255|in:,male,female',
            'support' => 'sometimes|nullable|string',
            'role' => [
                'required', 'string', 'max:255',
                Rule::in(Role::whereNotIn('name', ['admin', 'user'])
                    ->pluck('name')
                    ->toArray()),
            ],
            'photo' => 'sometimes|nullable|file|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        if ($validator->fails()) {
            return back()
                ->withInput()
                ->withErrors($validator);
        }

        $admin = Admin::find($id);
        $admin->name = $request->name;
        $admin->surname = $request->surname;
        $admin->mobile = $request->mobile;
        $admin->email = $request->email;
        $admin->username = $request->username;
        if ($request->password) {
            $admin->forceFill([
                'password' => bcrypt($request->password)
            ])
                ->setRememberToken(Str::random(60));
        }
        $admin->otpfa = $request->otpfa ?? 'off';
        $admin->dob = $request->dob;
        $admin->support = $request->support ?? '0';
        $admin->sex = $request->sex;
        $admin->save();
        $admin->syncRoles($request->role);

        if ($request->hasFile('photo')) {
            $path = 'admin_photo';
            $drive = Drive::where('table_id', $admin->id)
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
            $drive->table_id = $admin->id;
            $drive->table_type = $path;
            $drive->file_name = $fileName;
            $drive->file_type = 'image';
            $drive->save();
        }

        return back()
            ->with('success', __('Employee updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $admin = Admin::findOrFail($id);

        $path = 'admin_photo';
        $drive = Drive::where('table_id', $admin->id)
            ->where('table_type', $path)
            ->where('file_type', 'image')
            ->first();
        if ($drive) {
            if (Storage::disk('public')->exists($drive->file_name)) {
                Storage::disk('public')->delete($drive->file_name);
            }
            $drive->delete();
        }

        $admin->syncRoles([]);
        $admin->delete();

        return back()
            ->with('success', __('Employee deleted successfully.'));
    }

    /**
     * ChangeStatus the specified resource from storage.
     */
    public function changeStatus(Request $request)
    {
        $statusCode = 200;

        $admin = Admin::find($request->id);
        if (!$admin) {
            if ($request->ajax()) {
                $statusCode = 404;

                return response()->json([
                    'status' => $statusCode,
                    'message' => __('Employee doesn\'t exists.'),
                    'data' => collect(),
                ], $statusCode);
            }

            return back()
                ->withError(__('Employee doesn\'t exists.'));
        }

        $admin->status = $request->status;
        $admin->save();

        if ($request->ajax()) {
            return response()->json([
                'status' => $statusCode,
                'message' => __('Employee ' . $request->status . 'd successfully.'),
                'data' => collect(),
            ], $statusCode);
        }

        return back()
            ->with('success', __('Employee ' . $request->status . 'd successfully.'));
    }

    /**
     * Resend mail the specified resource from storage.
     */
    public function resendMail(string $id)
    {
        $admin = Admin::findOrFail($id);

        $mailData['subject'] = 'Recover Employee.';
        $mailData['email'] = $admin->email;
        $mailData['name'] = $admin->name;
        $mailData['body'] = "Congratulations! You are employee.";
        $mailData['url'] = url('admin/login');
        $mailData['button'] = 'Login';
        $mailData['subbody'] = "Please use the credentials to login.<br/>
                                Username: {$admin->username}<br/>
                                Password: " . url('admin/password/reset');
        $mailData['info'] = 'Note: don\'t share your login credentials & keep it confedential.';

        \Mail::send('emails.template', $mailData, function ($message) use ($mailData) {
            $message->subject($mailData['subject'])
            ->to($mailData['email'], $mailData['name'])
            ->cc(Admin::role('admin')->first()->email);
        });

        return back()
            ->with('success', __('Resend mail successfully.'));
    }
}
