<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\CustomerOrder;

class MasterPenjualanController extends Controller
{
    public function index($year = null)
    {
        // Jika tidak ada tahun dipilih, gunakan tahun saat ini
        if (!$year) {
            $year = date('Y');
        }

        $years = range(date('Y') - 5, date('Y')); // 5 tahun terakhir
        $currentYear = $year;

        return view('masterdata.masterPenjualan', compact('years', 'currentYear'));
    }

    public function fetchData($year)
    {
        $months = [];
        $sales = [];
        $tableData = [];
        $onlineTransactions = [];
        $offlineTransactions = [];

        // Hitung total penjualan online dan offline
        $totalOnlineSales = CustomerOrder::whereYear('created_at', $year)
            ->where('is_paid', 1)
            ->sum('total_price');

        $totalOfflineSales = Order::whereYear('created_at', $year)
            ->where('is_paid', 1)
            ->sum('total_price');

        $onlineSales = [];
        $offlineSales = [];
        $totalTransactions = $totalOnlineSales + $totalOfflineSales;

        for ($month = 1; $month <= 12; $month++) {
            $monthName = date('F', mktime(0, 0, 0, $month, 10));

            // Hitung jumlah transaksi online per bulan (hitung jumlah CustomerOrder yang is_paid = 1)
            $onlineTransactionCount = CustomerOrder::whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->where('is_paid', 1)
                ->count();

            // Hitung jumlah transaksi offline per bulan (hitung jumlah Order yang is_paid = 1)
            $offlineTransactionCount = Order::whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->where('is_paid', 1)
                ->count();
                

            // Hitung total penjualan bulanan
            $monthlySales = Order::whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->where('is_paid', 1)
                ->sum('total_price') +
                CustomerOrder::whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->where('is_paid', 1)
                ->sum('total_price');

            $monthlyOnlineSales = CustomerOrder::whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->where('is_paid', 1)
                ->sum('total_price');

            $monthlyOfflineSales = Order::whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->where('is_paid', 1)
                ->sum('total_price');

            $onlineSales[] = $monthlyOnlineSales;
            $offlineSales[] = $monthlyOfflineSales;
            $onlineTransactions[] = $onlineTransactionCount;
            $offlineTransactions[] = $offlineTransactionCount;

            // Hitung jumlah tikus terjual
            $maleQuantity = Order::whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->where('is_paid', 1)
                ->sum('male_quantity') +
                CustomerOrder::whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->where('is_paid', 1)
                ->sum('male_quantity');

            $femaleQuantity = Order::whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->where('is_paid', 1)
                ->sum('female_quantity') +
                CustomerOrder::whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->where('is_paid', 1)
                ->sum('female_quantity');

            $months[] = $monthName;
            $sales[] = $monthlySales;

            $tableData[] = [
                'index' => $month,
                'month' => $monthName,
                'onlineTransactions' => $onlineTransactionCount,
                'offlineTransactions' => $offlineTransactionCount,
                'totalSales' => number_format($monthlySales, 0, ',', '.'),
                'maleSold' => $maleQuantity,
                'femaleSold' => $femaleQuantity,
                'onlineSales' => $onlineSales, // Tambahan
                'offlineSales' => $offlineSales,
            ];
        }

        return response()->json([
            'chartData' => [
                'months' => $months,
                'sales' => $sales,
                'onlineTransactions' => $onlineTransactions,
                'offlineTransactions' => $offlineTransactions,
            ],
            'tableData' => $tableData,
            'comparisonData' => [
                'onlineSales' => $totalOnlineSales,
                'offlineSales' => $totalOfflineSales,
                'onlinePercentage' => $totalTransactions > 0 ? ($totalOnlineSales / $totalTransactions) * 100 : 0, // Tambahan
                'offlinePercentage' => $totalTransactions > 0 ? ($totalOfflineSales / $totalTransactions) * 100 : 0, // Tambahan
            ],
        ]);
    }
}
