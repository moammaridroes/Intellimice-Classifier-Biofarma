<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    /**
     * Override the default login method to provide custom error messages.
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        // Check if the user exists based on the email
        $user = \App\Models\User::where('email', $request->email)->first();

        if (!$user) {
            // Return error if the account does not exist
            throw ValidationException::withMessages([
                'email' => [trans('This account is not registered in the system.')],
            ]);
        } else {
            // Return error if the password is incorrect
            throw ValidationException::withMessages([
                'password' => [trans('The password you entered is incorrect.')],
            ]);
        }
    }

    /**
     * Custom login method with validation.
     */
    public function login(Request $request)
    {
        // Validate the input
        $this->validateLogin($request);

        // Attempt to log the user in
        if ($this->attemptLogin($request)) {
            // If login is successful, redirect to intended page
            return $this->sendLoginResponse($request);
        }

        // If login attempt fails, trigger the custom error response
        return $this->sendFailedLoginResponse($request);
    }

    /**
     * Validate the login request.
     */
    protected function validateLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);
    }
    protected function redirectTo()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return route('dashboard');
        } elseif ($user->role === 'customer') {
            return route('customer.home');
        } elseif ($user->role === 'master_data') {
            return route('masterdata.home');
        }

        abort(403, 'Unauthorized action.');
    }

}
