<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Middleware\CheckRole;

class AdminDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(CheckRole::class . ':admin');
    }

    // public function index()
    // {
    //     return view('dashboard');
    // }
}
