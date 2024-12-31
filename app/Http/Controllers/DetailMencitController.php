<?php

namespace App\Http\Controllers;

use App\Models\Sensor1; // data_kesehatan
use App\Models\Sensor2; // data_jenis_kelamin
use App\Models\Sensor3; // data_load_cell
use App\Models\DetailMencit;
use App\Events\MencitDataUpdated;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class DetailMencitController extends Controller
{
    public function index()
    {
        $dataMencit = DetailMencit::all();
        return response()->json($dataMencit, 200);
    }

    public function store(Request $request)
    {
        $categories = $this->getWeightCategories();
        $berat = $request->input('berat');

        $isInCategory = false;
        foreach ($categories as $key => $description) {
            [$start, $end] = $this->parseRange($key);

            if (($start === null || $berat >= $start) && ($end === null || $berat <= $end)) {
                $isInCategory = true;
                break;
            }
        }

        if (!$isInCategory) {
            return response()->json([
                'code' => 400,
                'message' => 'Weight does not fit any defined category.',
            ], 400);
        }

        Log::info('Request input:', $request->all());

        date_default_timezone_set('Asia/Jakarta');
        $now = Carbon::now()->toDateTimeString();

        // Mengambil data dari body JSON
        $params = [
            'berat' => $request->input('berat'), // Sesuaikan dengan key JSON
            'gender' => $request->input('jenis_kelamin'), // Sesuaikan dengan key JSON
            'health_status' => $request->input('status_kesehatan'), // Sesuaikan dengan key JSON
            'created_at' => $now,
            'updated_at' => $now,
        ];
        Log::info('Data to insert:', $params);
        // Simpan data ke database
        // $detailMencit = DetailMencit::create($params);

        // // Broadcast data baru ke Pusher
        // broadcast(new MencitDataUpdated($detailMencit))->toOthers();

        try {
            // Menyimpan data ke tabel detail_mencit
            DB::table('detail_mencit')->insert($params);

            return response()->json([
                'code' => 200,
                'message' => "success",
                'data' => $params,
            ]);
        } catch (\Throwable $th) {
            Log::error('Error in store function:', ['error' => $e->getMessage()]);
            return response()->json([
                'code' => 400,
                'message' => "failed",
                'data' => $th->errorInfo,
            ], 400);
        }
    }

    private function getWeightCategories()
    {
        $configPath = config_path('mice.php');
        if (!file_exists($configPath)) {
            throw new \Exception("Configuration file not found.");
        }
        $config = include($configPath);

        return $config['categories'] ?? [];
    }


    public function showData()
    {
        // Ambil kategori berat dari konfigurasi
        $categories = $this->getWeightCategories(); 
        $dataMencit = DetailMencit::all();

        $miceSickCount = DetailMencit::where('health_status', 'Sick')->count();
        $maleHealthyCounts = [];
        $femaleHealthyCounts = [];

        // Loop berdasarkan kategori berat dari konfigurasi
        foreach ($categories as $key => $description) {
            $maleHealthyCounts[$key] = DetailMencit::where('gender', 'Male')
                ->where('health_status', 'Healthy')
                ->when(
                    str_starts_with($key, '<'),
                    fn($query) => $query->where('berat', '<', intval(substr($key, 1)))
                )
                ->when(
                    str_starts_with($key, '>'),
                    fn($query) => $query->where('berat', '>', intval(substr($key, 1)))
                )
                ->when(
                    strpos($key, '-') !== false,
                    fn($query) => $query->whereBetween(
                        'berat',
                        array_map('intval', explode('-', $key))
                    )
                )
                ->count();

            $femaleHealthyCounts[$key] = DetailMencit::where('gender', 'Female')
                ->where('health_status', 'Healthy')
                ->when(
                    str_starts_with($key, '<'),
                    fn($query) => $query->where('berat', '<', intval(substr($key, 1)))
                )
                ->when(
                    str_starts_with($key, '>'),
                    fn($query) => $query->where('berat', '>', intval(substr($key, 1)))
                )
                ->when(
                    strpos($key, '-') !== false,
                    fn($query) => $query->whereBetween(
                        'berat',
                        array_map('intval', explode('-', $key))
                    )
                )
                ->count();
        }

        // Return data ke view
        return view('tables.data-table', compact(
            'miceSickCount',
            'maleHealthyCounts',
            'femaleHealthyCounts',
            'categories',
            'dataMencit'
        ));
    }

    
    private function parseRange(string $key): array
    {
        if (str_starts_with($key, '<')) {
            return [null, (int)substr($key, 1)];
        } elseif (str_starts_with($key, '>')) {
            return [(int)substr($key, 1), null];
        } elseif (strpos($key, '-') !== false) {
            [$start, $end] = explode('-', $key);
            return [(int)$start, (int)$end];
        }
    
        return [null, null];
    }

    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $data = DetailMencit::select(['id', 'created_at', 'berat', 'gender', 'health_status'])
                ->orderByDesc('created_at');
    
            return DataTables::of($data)
                ->addIndexColumn() // Gunakan addIndexColumn()
                ->addColumn('DT_RowIndex', function($row) {
                    return $row->id; // Secara eksplisit tambahkan kolom DT_RowIndex
                })
                ->editColumn('created_at', function ($row) {
                    return $row->created_at->format('d/m/Y');
                })
                ->editColumn('health_status', function ($row) {
                    return $row->health_status == 'Healthy' 
                        ? '<span class="badge bg-success">Healthy</span>' 
                        : '<span class="badge bg-danger">Sick</span>';
                })
                ->rawColumns(['health_status']) // Agar badge dapat dirender sebagai HTML
                ->make(true);
        }
    }



    public function deleteAll()
    {
        try {
            DetailMencit::query()->delete(); // Hapus semua data secara aman
            return response()->json(['success' => true, 'message' => 'All records deleted successfully.']);
        } catch (\Exception $e) {
            \Log::error('Failed to delete all records: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Failed to delete all records.']);
        }
    }

    public function delete($id)
    {
        $detailMencit = DetailMencit::find($id);
        if ($detailMencit) {
            $detailMencit->delete();
            return response()->json(['success' => 'Record deleted successfully.']);
        }
        return response()->json(['error' => 'Record not found.'], 404);
    }

    public function updateStockCounts()
    {
        $categories = $this->getWeightCategories();

        $miceSickCount = DetailMencit::where('health_status', 'Sick')->count();

        $maleHealthyCounts = [];
        $femaleHealthyCounts = [];

        foreach ($categories as $key => $description) {
            [$start, $end] = $this->parseRange($key);

            $maleHealthyCounts[$key] = DetailMencit::where('gender', 'Male')
            ->where('health_status', 'Healthy')
            ->when(
                str_starts_with($key, '<'),
                fn($query) => $query->where('berat', '<', intval(substr($key, 1))) // <10 (strictly less)
            )
            ->when(
                str_starts_with($key, '>'),
                fn($query) => $query->where('berat', '>', intval(substr($key, 1))) // >22 (strictly greater)
            )
            ->when(
                strpos($key, '-') !== false,
                function ($query) use ($key) {
                    [$start, $end] = array_map('intval', explode('-', $key));
                    return $query->where('berat', '>', $start) // Start eksklusif (strictly greater)
                                 ->where('berat', '<=', $end); // End inklusif (less or equal)
                }
            )
            ->count();
        
        $femaleHealthyCounts[$key] = DetailMencit::where('gender', 'Female')
            ->where('health_status', 'Healthy')
            ->when(
                str_starts_with($key, '<'),
                fn($query) => $query->where('berat', '<', intval(substr($key, 1))) // <10 (strictly less)
            )
            ->when(
                str_starts_with($key, '>'),
                fn($query) => $query->where('berat', '>', intval(substr($key, 1))) // >22 (strictly greater)
            )
            ->when(
                strpos($key, '-') !== false,
                function ($query) use ($key) {
                    [$start, $end] = array_map('intval', explode('-', $key));
                    return $query->where('berat', '>', $start) // Start eksklusif (strictly greater)
                                 ->where('berat', '<=', $end); // End inklusif (less or equal)
                }
            )
            ->count();
        
        }

        return response()->json([
            'miceSickCount' => $miceSickCount,
            'maleHealthyCounts' => $maleHealthyCounts,
            'femaleHealthyCounts' => $femaleHealthyCounts,
        ]);
    }
}
