<?php

namespace App\Http\Controllers;

use App\Models\DetailMencit;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MasterManageController extends Controller
{
    public function showMencitStock()
    {
        // Data untuk mencit sakit
        $miceSickCount = DetailMencit::where('health_status', 'Sick')->count();

        // Ambil kategori berat dari konfigurasi
        $weightCategories = config('mice.categories');

        $maleHealthyCounts = [];
        $femaleHealthyCounts = [];

        // Loop berdasarkan kategori berat dari konfigurasi
        foreach ($weightCategories as $key => $label) {
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
        return view('masterdata.masterManage', compact(
            'miceSickCount', 
            'maleHealthyCounts', 
            'femaleHealthyCounts', 
            'weightCategories'
        ));
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

    public function storeCategory(Request $request)
    {
        $request->validate([
            'key' => [
                'required',
                'string',
                'regex:/^(<\d+|>\d+|\d+-\d+)$/', // Validate range format
            ],
            'description' => 'required|string|max:255',
        ]);

        $configPath = config_path('mice.php');

        if (!file_exists($configPath)) {
            return redirect()->back()->withErrors(['config' => 'Configuration file not found.']);
        }

        $config = include($configPath);

        $newKey = $request->input('key');
        $description = $request->input('description');

        // Validate range uniqueness and non-overlap
        foreach ($config['categories'] as $existingKey => $existingDesc) {
            if ($this->rangesOverlap($newKey, $existingKey)) {
                return redirect()->back()->withErrors([
                    'key' => "The range '{$newKey}' overlaps with an existing category '{$existingKey}'."
                ]);
            }
        }

        // Add new category
        $config['categories'][$newKey] = $description;

        // Add default prices for the new category
        $config['prices']['male'][$newKey] = 0;
        $config['prices']['female'][$newKey] = 0;

        // Sort categories to maintain logical order
        $this->sortCategories($config['categories']);
        $this->sortCategories($config['prices']['male']);
        $this->sortCategories($config['prices']['female']);

        // Save the updated configuration
        file_put_contents($configPath, '<?php return ' . var_export($config, true) . ';');

        return redirect()->back()->with('success', 'Category added successfully.');
    }

    public function updateCategoryKey(Request $request, $oldKey)
    {
        $request->validate([
            'new_key' => [
                'required',
                'string',
                'regex:/^(<\d+|>\d+|\d+-\d+)$/', // Validasi format range
            ],
            'description' => 'required|string|max:255',
        ]);

        $configPath = config_path('mice.php');
        $config = include($configPath);

        $newKey = $request->input('new_key');
        $description = $request->input('description');

        // Jika kategori lama tidak ditemukan
        if (!isset($config['categories'][$oldKey])) {
            return redirect()->back()->withErrors(['error' => 'Category not found.']);
        }

        // Jika key kategori tidak berubah, hanya update deskripsinya
        if ($oldKey === $newKey) {
            $config['categories'][$oldKey] = $description;
        } else {
            // Cek apakah key baru sudah ada
            if (isset($config['categories'][$newKey])) {
                return redirect()->back()->withErrors(['error' => 'The new key already exists.']);
            }

            // Validasi untuk memastikan tidak ada tabrakan dengan key lain
            foreach ($config['categories'] as $existingKey => $existingDesc) {
                if ($existingKey !== $oldKey && $this->rangesOverlap($newKey, $existingKey)) {
                    return redirect()->back()->withErrors([
                        'new_key' => "The range '{$newKey}' overlaps with an existing category '{$existingKey}'."
                    ]);
                }
            }

            // Update key kategori
            unset($config['categories'][$oldKey]);
            $config['categories'][$newKey] = $description;

            // Pindahkan harga ke key baru
            $config['prices']['male'][$newKey] = $config['prices']['male'][$oldKey] ?? 0;
            $config['prices']['female'][$newKey] = $config['prices']['female'][$oldKey] ?? 0;

            unset($config['prices']['male'][$oldKey]);
            unset($config['prices']['female'][$oldKey]);
        }

        // Urutkan kategori
        $this->sortCategories($config['categories']);
        $this->sortCategories($config['prices']['male']);
        $this->sortCategories($config['prices']['female']);

        // Simpan konfigurasi yang diperbarui
        file_put_contents($configPath, '<?php return ' . var_export($config, true) . ';');

        return redirect()->back()->with('success', 'Category updated successfully.');
    }


    private function rangesOverlap(string $newKey, string $existingKey): bool
    {
        [$newStart, $newEnd] = $this->parseRange($newKey);
        [$existingStart, $existingEnd] = $this->parseRange($existingKey);
    
        // Untuk rentang '>X'
        if ($newStart !== null && $newEnd === null) {
            // Pastikan tidak bertabrakan dengan rentang yang sudah ada
            return $existingEnd === null && $newStart <= $existingStart;
        }
    
        // Untuk rentang '<X'
        if ($newStart === null && $newEnd !== null) {
            // Pastikan tidak bertabrakan dengan rentang yang sudah ada
            return $existingStart === null && $newEnd >= $existingEnd;
        }
    
        // Untuk rentang 'X-Y'
        if ($newStart !== null && $newEnd !== null) {
            // Cek tumpang tindih untuk rentang 'X-Y'
            if ($existingStart !== null && $existingEnd !== null) {
                return !($newEnd < $existingStart || $newStart > $existingEnd);
            }
    
            // Untuk rentang '>X'
            if ($existingStart !== null && $existingEnd === null) {
                return $newEnd > $existingStart;
            }
    
            // Untuk rentang '<X'
            if ($existingStart === null && $existingEnd !== null) {
                return $newStart < $existingEnd;
            }
        }
    
        return false;
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
    



    private function sortCategories(array &$categories)
    {
        uksort($categories, function ($a, $b) {
            [$aStart, $aEnd] = $this->parseRange($a);
            [$bStart, $bEnd] = $this->parseRange($b);

            if ($aStart === null && $bStart !== null) return -1;
            if ($bStart === null && $aStart !== null) return 1;

            if ($aEnd === null && $bEnd !== null) return 1;
            if ($bEnd === null && $aEnd !== null) return -1;

            return $aStart <=> $bStart;
        });
    }





    public function destroyCategory($key)
    {
        $configPath = config_path('mice.php');
        $config = include($configPath);

        if (!isset($config['categories'][$key])) {
            return redirect()->back()->withErrors(['error' => 'Category not found.']);
        }

        // Hapus kategori
        unset($config['categories'][$key]);

        // Hapus harga terkait kategori
        unset($config['prices']['male'][$key]);
        unset($config['prices']['female'][$key]);

        // Simpan kembali ke file konfigurasi
        file_put_contents($configPath, '<?php return ' . var_export($config, true) . ';');

        return redirect()->back()->with('success', 'Category and prices deleted successfully.');
    }



}



