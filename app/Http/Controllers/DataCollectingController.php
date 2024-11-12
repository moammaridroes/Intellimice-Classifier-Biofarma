<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\DetailMencit;
use Carbon\Carbon;

class DataCollectingController extends Controller
{
    public function syncData()
    {
        // Ambil semua data dari tabel data_kesehatan yang belum pernah disinkronkan
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

    public function index()
    {
        // Mengambil semua data dari tabel detail_mencit
        $dataMencit = DetailMencit::all();

        // Mengirim data ke view
        return view('tables.data-table', compact('dataMencit'));
    }
}
