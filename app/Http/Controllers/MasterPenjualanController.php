<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\CustomerOrder;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Chart\Chart;
use PhpOffice\PhpSpreadsheet\Chart\DataSeries;
use PhpOffice\PhpSpreadsheet\Chart\DataSeriesValues;
use PhpOffice\PhpSpreadsheet\Chart\Layout;
use PhpOffice\PhpSpreadsheet\Chart\Legend;
use PhpOffice\PhpSpreadsheet\Chart\PlotArea;
use PhpOffice\PhpSpreadsheet\Chart\Title;
use Illuminate\Support\Facades\Response;
// use PhpOffice\PhpSpreadsheet\Spreadsheet;
// use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
// use PhpOffice\PhpSpreadsheet\Chart\Chart;
// use PhpOffice\PhpSpreadsheet\Chart\DataSeries;
// use PhpOffice\PhpSpreadsheet\Chart\PlotArea;
// use PhpOffice\PhpSpreadsheet\Chart\Title;
// use PhpOffice\PhpSpreadsheet\Chart\Legend;
// use PhpOffice\PhpSpreadsheet\Chart\DataSeriesValues;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
// use Illuminate\Support\Facades\Response;

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
    public function exportSalesReport($year)
    {
        $salesData = [];
        $onlineSales = [];
        $offlineSales = [];
        $months = [];
    
        for ($month = 1; $month <= 12; $month++) {
            $monthName = date('F', mktime(0, 0, 0, $month, 10));
    
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
            $months[] = $monthName;
    
            $salesData[] = [
                'Month' => $monthName,
                'Online Sales' => $monthlyOnlineSales,
                'Offline Sales' => $monthlyOfflineSales,
                'Total Sales' => $monthlyOnlineSales + $monthlyOfflineSales,
            ];
        }
    
        // Membuat Spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle("Sales Report $year");
    
        // Header Tabel
        $headers = ['Month', 'Online Sales', 'Offline Sales', 'Total Sales'];
        $sheet->fromArray($headers, null, 'A1');
    
        // Isi Data
        $rowNumber = 2;
        foreach ($salesData as $row) {
            $sheet->fromArray(array_values($row), null, "A$rowNumber");
            $rowNumber++;
        }
    
        // Styling Header
        $headerStyle = [
            'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '4B49AC']
            ],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
            'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]],
        ];
        $sheet->getStyle('A1:D1')->applyFromArray($headerStyle);
    
        // Styling Data
        $dataStyle = [
            'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
        ];
        $sheet->getStyle("A2:D$rowNumber")->applyFromArray($dataStyle);
    
        foreach (range('A', 'D') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }
    
        // Membuat Chart
        $dataSeriesLabels = [
            new DataSeriesValues('String', "'Sales Report $year'!\$B\$1", null, 1),
            new DataSeriesValues('String', "'Sales Report $year'!\$C\$1", null, 1),
        ];
        $xAxisTickValues = [
            new DataSeriesValues('String', "'Sales Report $year'!\$A\$2:\$A\$13", null, 12),
        ];
        $dataSeriesValues = [
            new DataSeriesValues('Number', "'Sales Report $year'!\$B\$2:\$B\$13", null, 12),
            new DataSeriesValues('Number', "'Sales Report $year'!\$C\$2:\$C\$13", null, 12),
        ];
    
        $series = new DataSeries(
            DataSeries::TYPE_BARCHART,
            DataSeries::GROUPING_CLUSTERED,
            range(0, count($dataSeriesValues) - 1),
            $dataSeriesLabels,
            $xAxisTickValues,
            $dataSeriesValues
        );
        $series->setPlotDirection(DataSeries::DIRECTION_VERTICAL);
    
        $plotArea = new PlotArea(null, [$series]);
        $legend = new Legend(Legend::POSITION_RIGHT, null, false);
        $title = new Title("Comparison of Online and Offline Sales");
    
        $chart = new Chart(
            'Sales Comparison Chart',
            $title,
            $legend,
            $plotArea
        );
        $chart->setTopLeftPosition('E2');
        $chart->setBottomRightPosition('M15');
        $sheet->addChart($chart);
    
        // Simpan dan Download File Excel
        $fileName = "sales_report_$year.xlsx";
        $writer = new Xlsx($spreadsheet);
        $writer->setIncludeCharts(true);
        $tempFile = tempnam(sys_get_temp_dir(), 'sales_report');
        $writer->save($tempFile);
    
        return Response::download($tempFile, $fileName)->deleteFileAfterSend(true);
    }
    
}
