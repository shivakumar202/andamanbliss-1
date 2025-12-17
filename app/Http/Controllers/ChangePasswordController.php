<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ChangePasswordController extends Controller
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
     * Show the form for creating a new resource.
     */
    public function showChangeForm()
    {
        return view('user.password');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function change(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed|different:current_password',
            'password_confirmation' => 'required|min:8',
        ]);

        if ($validator->fails()) {
            return back()
                ->withInput()
                ->withErrors($validator);
        }

        $user = User::find(Auth::id());
        if (!Hash::check($request->current_password, $user->password)) {
            return back()
                ->withInput()
                ->withErrors(['current_password' => __('Current password is incorrect.')]);
        }

        $user->forceFill([
                'password' => Hash::make($request->password)
            ])
            ->setRememberToken(Str::random(60));
        $user->save();

        return back()
            ->with('success', __('Password changed successfully.'));
    }
}
