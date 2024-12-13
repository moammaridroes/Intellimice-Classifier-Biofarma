<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Model User
use App\Models\Order; // Model Order
use App\Models\CustomerOrder; // Model CustomerOrder

class MasterDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // pastikan user terautentikasi
    }

    public function index()
    {
        // Ambil data dari model yang relevan
        $userCount = User::count(); // Jumlah user
        $totalEarnings = Order::where('is_paid', 1)->sum('total_price') + CustomerOrder::where('is_paid', 1)->sum('total_price'); // Total pendapatan dari order offline dan online yang sudah dibayar
        $totalOrders = Order::count() + CustomerOrder::count(); // Jumlah order offline dan online
        
        // Ambil data jumlah orders berdasarkan jenis kelamin
        $offlineMaleOrders = Order::where('male_quantity', '>', 0)->sum('male_quantity');
        $offlineFemaleOrders = Order::where('female_quantity', '>', 0)->sum('female_quantity');
        $onlineMaleOrders = CustomerOrder::where('male_quantity', '>', 0)->sum('male_quantity');
        $onlineFemaleOrders = CustomerOrder::where('female_quantity', '>', 0)->sum('female_quantity');
        $mencitOrders = $offlineMaleOrders + $offlineFemaleOrders + $onlineMaleOrders + $onlineFemaleOrders;

        // Kirim data ke view
        return view('masterdata.masterDashboard', compact('userCount', 'totalEarnings', 'totalOrders', 'mencitOrders'));
    }
} // sementara g kepake
