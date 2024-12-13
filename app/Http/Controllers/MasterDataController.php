<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Model User
use App\Models\Order; // Model Order
use App\Models\CustomerOrder; // Model CustomerOrder
use App\Models\DetailMencit; // Model CustomerOrder
use App\Http\Middleware\CheckRole; // Middleware untuk cek role

class MasterDataController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth')->except('index');
    //     $this->middleware(CheckRole::class . ':master_data')->except('index');
    // }
    

    public function index($year = null)
    {
        // Set default tahun jika tidak diberikan
        $year = $year ?? date('Y');

        // Data untuk kartu dashboard
        $userCount = User::count();
        $totalEarnings = Order::where('is_paid', 1)->sum('total_price') + 
                        CustomerOrder::where('is_paid', 1)->sum('total_price');
        $totalOrders = Order::where('is_paid', 1)->count() + 
                    CustomerOrder::where('is_paid', 1)->count();
        $mencitOrders = Order::where('is_paid', 1)->sum('male_quantity') + 
                        Order::where('is_paid', 1)->sum('female_quantity') +
                        CustomerOrder::where('is_paid', 1)->sum('male_quantity') +
                        CustomerOrder::where('is_paid', 1)->sum('female_quantity');

        // Data untuk grafik penjualan
        $salesData = $this->getSalesDataByYear($year);

        // Data tahun
        $years = range(date('Y') - 5, date('Y')); // 5 tahun terakhir
        $currentYear = $year;

        // Jika permintaan melalui AJAX, kirimkan data sebagai JSON
        if (request()->ajax()) {
            return response()->json([
                'salesData' => $salesData
            ]);
        }

        // Render view jika bukan permintaan AJAX
        return view('masterdata.masterDashboard', compact(
            'userCount', 
            'totalEarnings', 
            'totalOrders', 
            'mencitOrders', 
            'salesData', 
            'years', 
            'currentYear'
        ));
    }

    private function getSalesDataByYear($year)
    {
        $months = [];
        $sales = [];

        for ($month = 1; $month <= 12; $month++) {
            $months[] = date('F', mktime(0, 0, 0, $month, 10));
            $monthlySales = Order::whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->where('is_paid', 1)
                ->sum('total_price') +
                CustomerOrder::whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->where('is_paid', 1)
                ->sum('total_price');
            $sales[] = $monthlySales;
        }

        return compact('months', 'sales');
    }

}
