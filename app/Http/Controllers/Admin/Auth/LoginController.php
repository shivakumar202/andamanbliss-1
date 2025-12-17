<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Admin;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;
    protected function redirectTo()
    {
        if (Auth::guard('admin')->check()) {
            return redirect('admin/home');
        }

        return redirect()->route('admin.login');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        // Validation
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        // Login with phone, email or username and password
        $field = 'username';
        if (is_numeric($request->username)) {
            $field = 'mobile';
        } elseif (filter_var($request->username, FILTER_VALIDATE_EMAIL)) {
            $field = 'email';
        }

        // Merge credentials and accepts for login
        $request->merge([
            $field => $request->username,
            'status' => 'active'
        ]);
        $credentials = $request->only(
            $field,
            'password',
            'status'
        );

        // Set the remember me cookie if the user check the box
        $remember = ($request->has('remember')) ? true : false;

        if (Auth::guard('admin')->attempt($credentials, $remember)) {
            $user = Auth::guard('admin')->user();
            $id = Auth::guard('admin')->id();

            // Custom rule for not OTP
            if ($user->otpfa != 'on') {
                return $this->redirectTo();
            }

            if (!\Cookie::has('admin') || \Cookie::get('admin') != $id) {
                $this->generateOtp($id);

                Auth::guard('admin')->logout();

                return redirect('admin/otp/' . base64_encode($id))
                    ->withSuccess('Verify your email for the security code.');
            }

            return $this->redirectTo();
        }

        return redirect()->route('admin.login')->withErrors(['username' => __('Invalid credentials.')]);
    }

    public function generateOtp($id)
    {
        try {
            $user = Admin::findOrFail($id);

            $otp = substr(abs(crc32(uniqid())), 0, 6);
            session(['otp' => $otp]);

            if ($user->email) {
                $mailData['subject'] = 'Login Security Code';
                $mailData['email'] = $user->email;
                $mailData['name'] = $user->name;
                $mailData['body'] = "OTP Code: {$otp}";
                $mailData['url'] = '';
                $mailData['button'] = '';
                $mailData['subbody'] = "Enter the security code to login your profile securly.";
                $mailData['info'] = 'Note: don\'t share your login credentials & keep it confedential.';

                \Mail::send('emails.template', $mailData, function ($message) use ($mailData) {
                    $message->subject($mailData['subject'])
                    ->to($mailData['email'], $mailData['name'])
                    ->cc(['amitmandal@andamanbliss.com', 'shivakumar@andamanbliss.com']);
                });
            }

            if ($user->mobile) {
                $smsData['from'] = config('app.name', 'Laravel');
                $smsData['to'] = $user->mobile;
                $smsData['message'] = 'Hi ' . $user->name . ',\nOTP Code: ' . $otp . '.\nEnter the security code to login your profile securly.';
                $smsData['dryrun'] = 'no';
                // SMS::send($smsData);
            }

            return back()
                ->withInput()
                ->withErrors(['otp' => __('An OTP has been sent.')]);
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->withErrors(['otp' => __($e->getMessage())]);
        }
    }

    public function otpGenerate(Request $request)
    {
        $this->generateOtp(base64_decode($request->id));

        return back()
            ->withInput()
            ->withSuccess('Verify your email for the security code.');
    }

    public function showOtpForm(Request $request)
    {
        return view('admin.auth.otp');
    }

    public function otpLogin(Request $request)
    {
        $this->validate($request, [
            'otp' => 'required',
        ]);

        if (session('otp') == $request->otp) {
            session()->forget(['otp']);

            Auth::guard('admin')->loginUsingId(base64_decode($request->id), true);

            \Cookie::queue('admin', base64_decode($request->id), 1 * 24 * 60); // minutes

            return $this->redirectTo();
        }

        return back()
            ->withErrors(['otp' => __('Your security code is incorrect, verify and try again.')]);
    }

    public function logout()
    {
        Auth::guard('admin')->logout();

        return redirect()->route('admin.login');
    }
}
