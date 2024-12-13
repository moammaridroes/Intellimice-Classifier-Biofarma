<?php

namespace App\Http\Controllers;

use App\Models\DetailMencit;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MasterManageController extends Controller
{
    public function showMencitStock()
    {
        // Data untuk card
        $miceSickCount = DetailMencit::where('health_status', 'Sick')->count();

        $maleHealthyCounts = [
            'category1' => DetailMencit::where('gender', 'Male')->where('health_status', 'Healthy')->where('berat', '<', 10)->count(),
            'category2' => DetailMencit::where('gender', 'Male')->where('health_status', 'Healthy')->whereBetween('berat', [10, 22])->count(),
            'category3' => DetailMencit::where('gender', 'Male')->where('health_status', 'Healthy')->where('berat', '>', 22)->count(),
        ];

        $femaleHealthyCounts = [
            'category1' => DetailMencit::where('gender', 'Female')->where('health_status', 'Healthy')->where('berat', '<', 10)->count(),
            'category2' => DetailMencit::where('gender', 'Female')->where('health_status', 'Healthy')->whereBetween('berat', [10, 22])->count(),
            'category3' => DetailMencit::where('gender', 'Female')->where('health_status', 'Healthy')->where('berat', '>', 22)->count(),
        ];

        // Return ke view
        return view('masterdata.masterManage', compact('miceSickCount', 'maleHealthyCounts', 'femaleHealthyCounts'));
    }
    public function updatePrice(Request $request)
    {
        $request->validate([
            'prices' => 'required|array', // Validasi bahwa `prices` adalah array
            'prices.*.*' => 'required|numeric|min:0', // Validasi bahwa harga adalah angka positif
        ]);

        // Ambil data konfigurasi mice.php
        $configPath = config_path('mice.php');
        $config = include($configPath);

        // Update harga di file konfigurasi
        foreach ($request->input('prices') as $gender => $categories) {
            foreach ($categories as $category => $price) {
                if (isset($config['prices'][$gender][$category])) {
                    $config['prices'][$gender][$category] = $price;
                }
            }
        }
        

        // Simpan kembali ke file mice.php
        file_put_contents($configPath, '<?php return ' . var_export($config, true) . ';');

        return redirect()->back()->with('success', 'Harga berhasil diperbarui.');
    }

    


    // Simpan harga baru ke database (implementasi sesuai dengan tabel Anda)
    // Contoh:
//     DB::table('kategori_harga')->updateOrInsert(
//         ['gender' => 'Male', 'category' => '1'],
//         ['price' => $request->maleCategory1]
//     );
//     DB::table('kategori_harga')->updateOrInsert(
//         ['gender' => 'Male', 'category' => '2'],
//         ['price' => $request->maleCategory2]
//     );
//     DB::table('kategori_harga')->updateOrInsert(
//         ['gender' => 'Male', 'category' => '3'],
//         ['price' => $request->maleCategory3]
//     );
//     DB::table('kategori_harga')->updateOrInsert(
//         ['gender' => 'Female', 'category' => '1'],
//         ['price' => $request->femaleCategory1]
//     );
//     DB::table('kategori_harga')->updateOrInsert(
//         ['gender' => 'Female', 'category' => '2'],
//         ['price' => $request->femaleCategory2]
//     );
//     DB::table('kategori_harga')->updateOrInsert(
//         ['gender' => 'Female', 'category' => '3'],
//         ['price' => $request->femaleCategory3]   
//     );

//     return redirect()->back()->with('success', 'Harga kategori berhasil diperbarui.');
}



