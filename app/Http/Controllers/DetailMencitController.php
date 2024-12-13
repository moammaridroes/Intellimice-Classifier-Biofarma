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

    
    // public function streamUpdates()
    // {
    //     header('Content-Type: text/event-stream');
    //     header('Cache-Control: no-cache');
    //     header('Connection: keep-alive');

    //     while (true) {
    //         $data = DetailMencit::orderBy('created_at', 'desc')->limit(10)->get();
    //         echo "data: " . json_encode($data) . "\n\n";
    //         ob_flush();
    //         flush();
    //         sleep(5); // Kirim data setiap 5 detik
    //     }
    // }


    public function showData()
    {
        $dataMencit = DetailMencit::all();

        // Hitung jumlah mencit yang 'Sick'
        $miceSickCount = DetailMencit::where('health_status', 'Sick')->count();

        // Male Healthy with weight conditions
        $maleHealthyCounts = [
            'category1' => DetailMencit::where('gender', 'Male')->where('health_status', 'Healthy')->where('berat', '<', 10)->count(),//3-10,12-20,20-40
            'category2' => DetailMencit::where('gender', 'Male')->where('health_status', 'Healthy')->whereBetween('berat', [10, 22])->count(),
            'category3' => DetailMencit::where('gender', 'Male')->where('health_status', 'Healthy')->where('berat', '>', 22)->count(),
            // 'category4' => DetailMencit::where('gender', 'Male')->where('health_status', 'Healthy')->where('berat', '>', 18)->count(),
        ];

        // Female Healthy with weight conditions
        $femaleHealthyCounts = [
            'category1' => DetailMencit::where('gender', 'Female')->where('health_status', 'Healthy')->where('berat', '<', 10)->count(),
            'category2' => DetailMencit::where('gender', 'Female')->where('health_status', 'Healthy')->whereBetween('berat', [10, 22])->count(),
            'category3' => DetailMencit::where('gender', 'Female')->where('health_status', 'Healthy')->where('berat','>', 22)->count(),
            // 'category4' => DetailMencit::where('gender', 'Female')->where('health_status', 'Healthy')->where('berat', '>', 18)->count(),
        ];

        return view('tables.data-table', compact(
            'miceSickCount',
            'maleHealthyCounts',
            'femaleHealthyCounts',
            'dataMencit'
        ));
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
            DetailMencit::truncate(); // Menghapus semua data
            return response()->json(['success' => true, 'message' => 'All records deleted successfully.']);
        } catch (\Exception $e) {
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
        $miceSickCount = DetailMencit::where('health_status', 'Sick')->count();

        $maleHealthyCounts = [
            'category1' => DetailMencit::where('gender', 'Male')->where('health_status', 'Healthy')->where('berat', '<', 10)->count(),
            'category2' => DetailMencit::where('gender', 'Male')->where('health_status', 'Healthy')->whereBetween('berat', [10, 22])->count(),
            // 'category3' => DetailMencit::where('gender', 'Male')->where('health_status', 'Healthy')->whereBetween('berat', [14.01, 18])->count(),
            'category3' => DetailMencit::where('gender', 'Male')->where('health_status', 'Healthy')->where('berat', '>', 22)->count(),
        ];

        $femaleHealthyCounts = [
            'category1' => DetailMencit::where('gender', 'Female')->where('health_status', 'Healthy')->where('berat', '<', 10)->count(),
            'category2' => DetailMencit::where('gender', 'Female')->where('health_status', 'Healthy')->whereBetween('berat', [10, 22])->count(),
            // 'category3' => DetailMencit::where('gender', 'Female')->where('health_status', 'Healthy')->whereBetween('berat', [14.01, 18])->count(),
            'category3' => DetailMencit::where('gender', 'Female')->where('health_status', 'Healthy')->where('berat', '>', 22)->count(),
        ];

        return response()->json([
            'miceSickCount' => $miceSickCount,
            'maleHealthyCounts' => $maleHealthyCounts,
            'femaleHealthyCounts' => $femaleHealthyCounts,
        ]);
    }
}
