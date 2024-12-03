<?php

namespace App\Http\Controllers;

use App\Models\Sensor1; // data_kesehatan
use App\Models\Sensor2; // data_jenis_kelamin
use App\Models\Sensor3; // data_load_cell
use App\Models\DetailMencit;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DetailMencitController extends Controller
{
    public function syncData()
{
    // Ambil semua data dari data_kesehatan yang belum pernah disinkronkan
    $dataKesehatan = DB::table('data_kesehatan')
        ->whereNull('synced_at')
        ->get();

    foreach ($dataKesehatan as $kesehatan) {
        // Tentukan nilai health_status
        $healthStatus = $kesehatan->kesehatan_status ?? 'N/A';

        // Default values for gender and weight
        $gender = 'N/A';
        $weight = 0;

        // Jika health_status bukan 'sick', ambil data asli dari data_jenis_kelamin dan data_load_cell
        if ($healthStatus !== 'sick') {
            $jenisKelamin = DB::table('data_jenis_kelamin')->where('id', $kesehatan->id)->first();
            $berat = DB::table('data_load_cell')->where('id', $kesehatan->id)->first();

            // Tetapkan data asli jika tersedia
            $gender = $jenisKelamin->jenis_kelamin ?? 'N/A';
            $weight = $berat->berat ?? 0;
        }

        // Pastikan data default di tabel data_jenis_kelamin
        DB::table('data_jenis_kelamin')->updateOrInsert(
            ['id' => $kesehatan->id],
            [
                'jenis_kelamin' => $gender,
                'timestamp' => $kesehatan->timestamp
            ]
        );

        // Pastikan data default di tabel data_load_cell
        DB::table('data_load_cell')->updateOrInsert(
            ['id' => $kesehatan->id],
            [
                'berat' => $weight,
                'timestamp' => $kesehatan->timestamp
            ]
        );

        // Masukkan data ke dalam tabel detail_mencit
        DetailMencit::updateOrCreate(
            ['id' => $kesehatan->id],
            [
                'berat' => $weight,
                'gender' => $gender,
                'health_status' => $healthStatus,
                'created_at' => $kesehatan->timestamp,
                'updated_at' => now()
            ]
        );

        // Tandai data pada data_kesehatan sebagai sudah disinkronkan
        DB::table('data_kesehatan')
            ->where('id', $kesehatan->id)
            ->update(['synced_at' => Carbon::now()]);
    }

    return response()->json(['message' => 'Data berhasil disinkronkan ke tabel detail_mencit, data_jenis_kelamin, dan data_load_cell']);
}



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
                ->orderByDesc('created_at'); // Mengurutkan data dari data terbaru
            
            return DataTables::of($data)
                ->addIndexColumn() // Auto indexing
                ->editColumn('created_at', function ($row) {
                    return $row->created_at->format('d/m/Y'); // Format tanggal
                })
                ->editColumn('health_status', function ($row) {
                    return $row->health_status == 'Healthy' 
                        ? '<span class="badge bg-success">Healthy</span>' 
                        : '<span class="badge bg-danger">Sick</span>';
                })
                ->rawColumns(['health_status']) // Agar HTML badge dapat dirender
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
