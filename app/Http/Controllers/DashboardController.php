<?php

namespace App\Http\Controllers;

use App\Models\BoatTripBookings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Constraint;
use Intervention\Image\Facades\Image;
use App\Models\Drive;
use App\Models\User;
use App\Models\Booking;
use App\Models\CabBookings;
use App\Models\FerryBookings;
use App\Models\HotelBookings;
use App\Models\RazorpayTransactions;
use App\Models\RentalBookings;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $creds = [
            'id' => auth()->user()->id,
            'name' => auth()->user()->name,
            'phone' => auth()->user()->mobile,
            'email' => auth()->user()->email,
        ];

        //with credentials
        // $tourBookings = RazorpayTransactions::where('purpose', 'Package Booking')
        //     ->where(function ($q) use ($creds) {
        //         $q->whereHas('packageBookings', function ($q2) use ($creds) {
        //             $q2->where('user_id', $creds['id']);
        //         })
        //             ->orWhere(function ($q2) use ($creds) {
        //                 $q2->where('email', $creds['email'])
        //                     ->where('phone', $creds['phone']);
        //             });
        //     })->count();

        //with user id
        $tourBookings = RazorpayTransactions::where('purpose', 'Package Booking')
            ->where(function ($q) use ($creds) {
                $q->whereHas('packageBookings', function ($q2) use ($creds) {
                    $q2->where('user_id', $creds['id']);
                });
            })->count();

        //with credentials
        // $hotelBookings = HotelBookings::where(function ($q) use ($creds) {
        //     $q->where('user_id', $creds['id'])->orWhereHas('paymentDetails', function ($q2) use ($creds) {
        //         $q2->where('email', $creds['email'])
        //             ->where('phone', $creds['phone']);
        //     });
        // })->count();

        //with user id
        $hotelBookings = HotelBookings::where(function ($q) use ($creds) {
            $q->where('user_id', $creds['id']);
        })->count();

        // With Credentials 
        // $activityBookings = Booking::where('type', 'activity')
        //     ->where(function ($q) use ($creds) {
        //         $q->where('user_id', $creds['id'])
        //             ->orWhere(function ($q2) use ($creds) {
        //                 $q2->where('email', $creds['email'])
        //                     ->where('mobile', $creds['phone']);
        //             });
        //     })->count();

        $activityBookings = Booking::where('type', 'activity')
            ->where(function ($q) use ($creds) {
                $q->where('user_id', $creds['id']);
            })->count();

        // with credentials
        // $cruiseBookings = FerryBookings::where(function ($q) use ($creds) {
        //     $q->where('user_id', $creds['id'])->orWhere(function ($q2) use ($creds) {
        //         $q2->where('email', $creds['email'])->where('phone', $creds['phone']);
        //     });
        // })->count();

        $cruiseBookings = FerryBookings::where(function ($q) use ($creds) {
            $q->where('user_id', $creds['id']);
        })->count();

        // with credentials
        // $cabBookings = CabBookings::where(function ($q) use ($creds) {
        //     $q->where('user_id', $creds['id'])->orWhere(function ($q2) use ($creds) {
        //         $q2->where('email', $creds['email'])->whereRaw("REGEXP_REPLACE(phone, '[^0-9]', '') LIKE ?", ['%' . $creds['phone']]);
        //     });
        // })->count();
        
        $cabBookings = CabBookings::where(function ($q) use ($creds) {
            $q->where('user_id', $creds['id']);
        })->count();

        // with credentials 
        // $bikeBookings = RentalBookings::where(function ($q) use ($creds) {
        //     $q->where('user_id', $creds['id'])->orWhere(function ($q2) use ($creds) {
        //         $q2->where('email', $creds['email'])->whereRaw("REGEXP_REPLACE(contact, '[^0-9]','') LIKE ?", ['%' . $creds['phone']]);
        //     });
        // })->count();

        $bikeBookings = RentalBookings::where(function ($q) use ($creds) {
            $q->where('user_id', $creds['id']);
        })->count();

        $boatTripBookings = BoatTripBookings::where(function ($q) use ($creds) {
            $q->where('user_id', $creds['id']);
        })->count();
        
        return view('user.home')
            ->with(compact('tourBookings', 'hotelBookings', 'activityBookings', 'cruiseBookings', 'cabBookings', 'bikeBookings','boatTripBookings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function showChangeForm()
    {
        return view('user.profile');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function change(Request $request)
    {
        $id = auth()->id();
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'surname' => 'sometimes|nullable|string|max:255',
            'mobile' => 'required|numeric|integer|digits:10|unique:App\Models\User,mobile,' . $id,
            'email' => 'required|email|max:255|unique:App\Models\User,email,' . $id,
            'username' => 'required|string|alpha_dash:ascii|max:255|unique:App\Models\User,username,' . $id,
            'dob' => 'sometimes|date|date_format:Y-m-d|before_or_equal:' . date('Y-m-d', strtotime('-18 year')) . '|after_or_equal:' . date('Y-m-d', strtotime('-60 year')),
            'sex' => 'sometimes|nullable|string|max:255|in:,male,female',
            'photo' => 'sometimes|nullable|file|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        if ($validator->fails()) {
            return back()
                ->withInput()
                ->withErrors($validator);
        }

        $user = User::find($id);
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->mobile = $request->mobile;
        $user->email = $request->email;
        $user->username = $request->username;
        if ($request->dob) {
            $user->dob = $request->dob;
        }
        if ($request->sex) {
            $user->sex = $request->sex;
        }
        $user->save();

        if ($request->hasFile('photo')) {
            $path = 'user_photo';
            $drive = Drive::where('table_id', $user->id)
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
            $drive->table_id = $user->id;
            $drive->table_type = $path;
            $drive->file_name = $fileName;
            $drive->file_type = 'image';
            $drive->save();
        }

        return back()
            ->with('success', __('Profile updated successfully.'));
    }
}
