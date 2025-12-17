<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

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
        if (Auth::guard('web')->check()) {
            return redirect('home');
        }

        return redirect()->route('login');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {

        return view('auth.login');
    }

    public function login(Request $request)
    {
        try {
            if (!empty($request->website)) {
                Log::warning('Spam detected', ['ip' => $request->ip(), 'time' => now()]);
                return back()->with('error', 'Spam detected. Submission blocked.');
            }

            $request->validate([
                'username' => 'required',
                'password' => 'required'
            ]);

            $field = 'username';
            if (is_numeric($request->username)) {
                $field = 'mobile';
            } elseif (filter_var($request->username, FILTER_VALIDATE_EMAIL)) {
                $field = 'email';
            }

            $request->merge([
                $field => $request->username,
                'status' => 'active'
            ]);

            $credentials = $request->only($field, 'password', 'status');
            $remember = $request->boolean('remember');

            if (Auth::guard('web')->attempt($credentials, $remember)) {
                $user = Auth::guard('web')->user();
                Log::info('Login successful', [
                    'user_id' => $user->id,
                    'username' => $user->username ?? null,
                    'email' => $user->email ?? null,
                    'ip' => $request->ip(),
                    'time' => now()
                ]);
                return $this->redirectTo();
            }

            Log::warning('Invalid credentials', [
                'username' => $request->username,
                'ip' => $request->ip(),
                'time' => now()
            ]);

            return redirect()->route('login')->withErrors(['username' => __('Invalid credentials.')]);
        } catch (\Throwable $e) {
            Log::error('Login error', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'ip' => $request->ip(),
                'time' => now()
            ]);

            return redirect()->route('login')->withErrors([
                'username' => __('An unexpected error occurred. Please try again.')
            ]);
        }
    }


    public function ajxlogin(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'username' => 'required|string',
                'password' => 'required|string',

            ]);

            if ($validator->fails()) {
                return back()->withInput()->withErrors($validator);
            }

            $field = 'username';
            if (is_numeric($request->username)) {
                $field = 'mobile';
            } elseif (filter_var($request->username, FILTER_VALIDATE_EMAIL)) {
                $field = 'email';
            }

            $credentials = [
                $field => $request->username,
                'password' => $request->password,
                'status' => 'active'
            ];

            if (Auth::guard('web')->attempt($credentials, $request->boolean('remember'))) {
                $user = Auth::guard('web')->user();
                Log::info('AJAX Login successful', [
                    'user_id' => $user->id,
                    'username' => $user->username ?? null,
                    'email' => $user->email ?? null,
                    'ip' => $request->ip(),
                    'time' => now()
                ]);

                return back()->with('success', __('Login Success!'));

            }

            Log::warning('AJAX Invalid credentials', [
                'username' => $request->username,
                'ip' => $request->ip(),
                'time' => now()
            ]);

            return back()->with('error', __('Invalid Credentials'));
        } catch (\Throwable $e) {
            Log::error('AJAX Login error', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'ip' => $request->ip(),
                'time' => now()
            ]);

            return back()->with('error', __('Unexpected Error'));
        }
    }




    public function generateOtp($id)
    {
        try {
            $user = User::findOrFail($id);

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
        return view('auth.otp');
    }

    public function otpLogin(Request $request)
    {
        $this->validate($request, [
            'otp' => 'required',
        ]);

        if (session('otp') == $request->otp) {
            session()->forget(['otp']);

            Auth::guard('web')->loginUsingId(base64_decode($request->id), true);

            \Cookie::queue('web', base64_decode($request->id), 1 * 24 * 60); // minutes

            return $this->redirectTo();
        }

        return back()
            ->withErrors(['otp' => __('Your security code is incorrect, verify and try again.')]);
    }
    public function logout()
    {
        Auth::guard('web')->logout();
        session()->invalidate();
        session()->regenerateToken();

        return redirect('/');
    }
}
