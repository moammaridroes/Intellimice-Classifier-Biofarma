<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\CustomerOrder;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('dashboard');
    }

    // Mengambil data untuk dashboard hari ini
    public function dashboardData()
    {
        $today = Carbon::today()->format('Y-m-d');

        // Periksa jumlah order offline hari ini
        $offlineOrdersToday = Order::whereDate('created_at', $today)->count();

        // Periksa jumlah order online hari ini
        $onlineOrdersToday = CustomerOrder::whereDate('created_at', $today)->where('is_paid', 1)->count();

        // Periksa total pendapatan hari ini
        $totalRevenueToday = Order::whereDate('created_at', $today)->sum('total_price') + CustomerOrder::whereDate('created_at', $today)->where('is_paid', 1)->sum('total_price');

        // Jumlah male dan female terjual hari ini
        $totalMaleSoldToday = Order::whereDate('created_at', $today)->sum('male_quantity') + CustomerOrder::whereDate('created_at', $today)->where('is_paid', 1)->sum('male_quantity');
        $totalFemaleSoldToday = Order::whereDate('created_at', $today)->sum('female_quantity') + CustomerOrder::whereDate('created_at', $today)->where('is_paid', 1)->sum('female_quantity');

        return response()->json([
            'onlineOrdersToday' => $onlineOrdersToday,
            'offlineOrdersToday' => $offlineOrdersToday,
            'totalRevenueToday' => $totalRevenueToday,
            'totalMaleSoldToday' => $totalMaleSoldToday ?? 0,
            'totalFemaleSoldToday' => $totalFemaleSoldToday ?? 0,
        ]);
    }

    // Mengambil data rekap bulanan dari kedua tabel
    public function getMonthlyRecapData(Request $request)
    {
        // Data bulanan dari tabel Order
        $orderRecap = Order::selectRaw('MONTH(created_at) as month, COUNT(*) as total_orders, SUM(total_price) as total_revenue, SUM(male_quantity) as total_male_sold, SUM(female_quantity) as total_female_sold')
            ->groupByRaw('MONTH(created_at)');

        // Data bulanan dari tabel CustomerOrder yang sudah di-approve
        $customerOrderRecap = CustomerOrder::selectRaw('MONTH(created_at) as month, COUNT(*) as total_orders, SUM(total_price) as total_revenue, SUM(male_quantity) as total_male_sold, SUM(female_quantity) as total_female_sold')
            ->where('is_paid', 1)
            ->groupByRaw('MONTH(created_at)');

        // Gabungkan data dari kedua tabel menggunakan unionAll
        $mergedRecap = $orderRecap->unionAll($customerOrderRecap)->get();

        // Kelompokkan data berdasarkan bulan dan lakukan agregasi
        $finalRecap = $mergedRecap->groupBy('month')->map(function ($group) {
            return [
                'month' => $group->first()->month,
                'total_orders' => $group->sum('total_orders'),
                'total_revenue' => $group->sum('total_revenue'),
                'total_male_sold' => $group->sum('total_male_sold'),
                'total_female_sold' => $group->sum('total_female_sold'),
            ];
        })->values();

        // Ubah data untuk ditampilkan di DataTables
        return DataTables::of($finalRecap)
            ->editColumn('total_revenue', function ($recap) {
                return 'Rp ' . number_format($recap['total_revenue'], 0, ',', '.');
            })
            ->editColumn('month', function ($recap) {
                return \Carbon\Carbon::create()->month($recap['month'])->format('F');
            })
            ->make(true);
    }
}
