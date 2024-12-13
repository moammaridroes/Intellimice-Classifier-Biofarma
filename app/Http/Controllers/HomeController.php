<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
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
        $user = Auth::user();
        // \Log::info('Redirecting user with role: ' . $user->role);

        if ($user->role === 'admin') {
            return redirect()->route('dashboard');
        } elseif ($user->role === 'customer') {
            return redirect()->route('customer.home');
        } elseif ($user->role === 'master_data') {
            return redirect()->route('masterdata.home');
        }

        abort(403, 'Unauthorized action.');
    }

    // public function handle($request, Closure $next, $guard = null)
    // {
    //     if (Auth::guard($guard)->check()) {
    //         $user = Auth::user();

    //         // Redirect berdasarkan role pengguna
    //         if ($user->role === 'admin') {
    //             return redirect()->route('dashboard');
    //         } elseif ($user->role === 'customer') {
    //             return redirect()->route('customer.home');
    //         } elseif ($user->role === 'master_data') {
    //             return redirect()->route('masterdata.home');
    //         }
    //     }

    //     return $next($request);
    // }


    public function redirectIfAuthenticated()
    {
        $user = Auth::user();

        if ($user) {
            return $this->index(); // Panggil fungsi index untuk redirect berdasarkan role
        }

        return redirect()->route('login'); // Jika belum login, kembali ke halaman login
    }
}
