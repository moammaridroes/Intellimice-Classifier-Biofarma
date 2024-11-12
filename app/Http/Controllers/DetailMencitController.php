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

            if ($healthStatus === 'Sick') {
                // Jika status kesehatan adalah 'Sick', gender dan berat langsung diisi sebagai 'N/A'
                $gender = 'N/A';
                $weight = 0;

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
            } else {
                // Jika status kesehatan bukan 'Sick', ambil data dari data_jenis_kelamin dan data_load_cell
                $jenisKelamin = DB::table('data_jenis_kelamin')->where('id', $kesehatan->id)->first();
                $berat = DB::table('data_load_cell')->where('id', $kesehatan->id)->first();

                // Tentukan nilai gender dan berat
                $gender = $jenisKelamin->jenis_kelamin ?? 'N/A';
                $weight = $berat->berat ?? 0;
            }

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

        return response()->json(['message' => 'Data berhasil disinkronkan ke tabel detail_mencit']);
    }

    public function showData()
    {
        $dataMencit = DetailMencit::all();

        // Hitung jumlah mencit yang 'Sick'
        $miceSickCount = DetailMencit::where('health_status', 'Sick')->count();

        // Male Healthy with weight conditions
        $maleHealthyCounts = [
            'less_than_8' => DetailMencit::where('gender', 'Male')->where('health_status', 'Healthy')->where('berat', '<', 8)->count(),
            'between_8_and_14' => DetailMencit::where('gender', 'Male')->where('health_status', 'Healthy')->whereBetween('berat', [8, 14])->count(),
            'between_14_and_18' => DetailMencit::where('gender', 'Male')->where('health_status', 'Healthy')->whereBetween('berat', [14.01, 18])->count(),
            'greater_equal_18' => DetailMencit::where('gender', 'Male')->where('health_status', 'Healthy')->where('berat', '>', 18)->count(),
        ];

        // Female Healthy with weight conditions
        $femaleHealthyCounts = [
            'less_than_8' => DetailMencit::where('gender', 'Female')->where('health_status', 'Healthy')->where('berat', '<', 8)->count(),
            'between_8_and_14' => DetailMencit::where('gender', 'Female')->where('health_status', 'Healthy')->whereBetween('berat', [8, 14])->count(),
            'between_14_and_18' => DetailMencit::where('gender', 'Female')->where('health_status', 'Healthy')->whereBetween('berat', [14.01, 18])->count(),
            'greater_equal_18' => DetailMencit::where('gender', 'Female')->where('health_status', 'Healthy')->where('berat', '>', 18)->count(),
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
            'less_than_8' => DetailMencit::where('gender', 'Male')->where('health_status', 'Healthy')->where('berat', '<', 8)->count(),
            'between_8_and_14' => DetailMencit::where('gender', 'Male')->where('health_status', 'Healthy')->whereBetween('berat', [8, 14])->count(),
            'between_14_and_18' => DetailMencit::where('gender', 'Male')->where('health_status', 'Healthy')->whereBetween('berat', [14.01, 18])->count(),
            'greater_equal_18' => DetailMencit::where('gender', 'Male')->where('health_status', 'Healthy')->where('berat', '>', 18)->count(),
        ];

        $femaleHealthyCounts = [
            'less_than_8' => DetailMencit::where('gender', 'Female')->where('health_status', 'Healthy')->where('berat', '<', 8)->count(),
            'between_8_and_14' => DetailMencit::where('gender', 'Female')->where('health_status', 'Healthy')->whereBetween('berat', [8, 14])->count(),
            'between_14_and_18' => DetailMencit::where('gender', 'Female')->where('health_status', 'Healthy')->whereBetween('berat', [14.01, 18])->count(),
            'greater_equal_18' => DetailMencit::where('gender', 'Female')->where('health_status', 'Healthy')->where('berat', '>', 18)->count(),
        ];

        return response()->json([
            'miceSickCount' => $miceSickCount,
            'maleHealthyCounts' => $maleHealthyCounts,
            'femaleHealthyCounts' => $femaleHealthyCounts,
        ]);
    }
}
