<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\CustomerOrder;
use App\Http\Controllers\CustomerOrderController;
use App\Models\DetailMencit;
use Carbon\Carbon;

class OrderController extends Controller
{
    // Menampilkan halaman form order
    public function store(Request $request)
    {
        $request->validate([
            'fullname' => 'required|string',
            'phone_number' => 'required|numeric',
            'email' => 'required|email',
            'item_name' => 'required|string',
            'agency_name' => 'required|string',
            'operator_name' => 'required|string',
            'weight' => 'required|string',
            'male_quantity' => 'nullable|numeric|min:0',
            'female_quantity' => 'nullable|numeric|min:0',
        ]);
    
        $malePrices = config('mice.prices.male');
        $femalePrices = config('mice.prices.female');
    
        $malePrice = $malePrices[$request->weight] ?? 0;
        $femalePrice = $femalePrices[$request->weight] ?? 0;
    
        $totalPrice = ($request->male_quantity * $malePrice) + ($request->female_quantity * $femalePrice);
        
        // Buat order baru
        $order = new Order();
        $order->fullname = $request->fullname;
        $order->phone_number = $request->phone_number;
        $order->email = $request->email;
        $order->item_name = $request->item_name;
        $order->agency_name = $request->agency_name;
        $order->operator_name = $request->operator_name;
        $order->weight = $request->weight;
        $order->male_quantity = $request->male_quantity;
        $order->female_quantity = $request->female_quantity;
        $order->total_price = $totalPrice;
        $order->is_paid = true; 
        $order->save();
        $order->created_at = Carbon::now('Asia/Jakarta');
        $order->updated_at = Carbon::now('Asia/Jakarta');
    
        // Simpan ID mencit yang dihapus
        $deletedMiceIds = [];
    
        // Kurangi stok mencit jantan
        if ($request->male_quantity > 0) {
            $query = DetailMencit::where('gender', 'Male')
                ->where('health_status', 'Healthy');
    
            // Tentukan rentang berat
            switch ($request->weight) {
                case 'category1':
                    $query->where('berat', '<', 10);
                    break;
                case 'category2':
                    $query->whereBetween('berat', [10, 22]);
                    break;
                // case 'category3':
                //     $query->whereBetween('berat', [14.01, 18]);
                //     break;
                case 'category3':
                    $query->where('berat', '>', 22);
                    break;
            }
    
            // Dapatkan mencit yang akan dihapus
            $deletedMice = $query->limit($request->male_quantity)->get();
            foreach ($deletedMice as $mencit) {
                $deletedMiceIds[] = $mencit->id; // Simpan ID mencit yang dihapus
                $mencit->delete(); // Hapus mencit
            }
        }
    
        // Kurangi stok mencit betina
        if ($request->female_quantity > 0) {
            $query = DetailMencit::where('gender', 'Female')
                ->where('health_status', 'Healthy');
    
            // Tentukan rentang berat
            switch ($request->weight) {
                case 'category1':
                    $query->where('berat', '<', 10);
                    break;
                case 'category2':
                    $query->whereBetween('berat', [10, 22]);
                    break;
                // case 'category3':
                //     $query->whereBetween('berat', [14.01, 18]);
                //     break;
                case 'category3':
                    $query->where('berat', '>', 22);
                    break;
            }
    
            // Dapatkan mencit yang akan dihapus
            $deletedMice = $query->limit($request->female_quantity)->get();
            foreach ($deletedMice as $mencit) {
                $deletedMiceIds[] = $mencit->id; // Simpan ID mencit yang dihapus
                $mencit->delete(); // Hapus mencit
            }
        }
    
        // Simpan ID mencit yang dihapus ke dalam kolom deleted_mice_ids pada order
        $order->deleted_mice_ids = json_encode($deletedMiceIds);
        if ($order->save()) {
            return response()->json(['success' => true, 'message' => 'Payment successful']);
        } else {
            return response()->json(['success' => false, 'message' => 'Failed to process payment'], 500);
        }
        
    }
    
    // Fungsi untuk menghitung stok mencit berdasarkan parameter weight.
    // Fungsi ini digunakan untuk mengupdate stok mencit di halaman order.
    // Weight dapat berupa 'less_than_8', 'between_8_and_14', 'between_14_and_18', atau 'greater_equal_18'
    // Fungsi ini akan menghitung stok mencit jantan dan betina berdasarkan parameter weight yang diberikan
    public function fetchStock(Request $request)
    {
        $weight = $request->input('weight');

        $maleStock = DetailMencit::where('gender', 'Male')
            ->where('health_status', 'Healthy')
            ->when($weight === 'category1', function ($query) {
                return $query->where('berat', '<', 10);
            })
            ->when($weight === 'category2', function ($query) {
                return $query->whereBetween('berat', [10, 22]);
            })
            // ->when($weight === 'category3', function ($query) {
            //     return $query->whereBetween('berat', [14.01, 18]);
            // })
            ->when($weight === 'category3', function ($query) {
                return $query->where('berat', '>', 22);
            })
            ->count();

        $femaleStock = DetailMencit::where('gender', 'Female')
            ->where('health_status', 'Healthy')
            ->when($weight === 'category1', function ($query) {
                return $query->where('berat', '<', 10);
            })
            ->when($weight === 'category2', function ($query) {
                return $query->whereBetween('berat', [10, 22]);
            })
            // ->when($weight === 'category3', function ($query) {
            //     return $query->whereBetween('berat', [14.01, 18]);
            // })
            ->when($weight === 'category3', function ($query) {
                return $query->where('berat', '>', 22);
            })
            ->count();

        return response()->json([
            'maleStock' => $maleStock,
            'femaleStock' => $femaleStock,
        ]);
    }

    // Mengambil data order terbaru
    public function getData()
    {
        // Mengambil data order terbaru, diurutkan dari yang paling baru pkonya
        $orders = Order::orderBy('created_at', 'desc')->get(); 
        return datatables()->of($orders)->make(true);
    }

    public function payment($id)
    {
        $order = Order::findOrFail($id);
        $order->update([
            'is_paid' => true, // Set kolom is_paid menjadi true
        ]);
        return redirect()->route('orderhistory.index')->with('success', 'Order has been paid successfully!');
    }

    public function edit($id)
    {
    $order = Order::findOrFail($id);
    return response()->json($order);
    }

    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->update($request->all());
        return response()->json(['success' => true, 'order' => $order]);
    }

    public function delete($id)
    {
        // Cari order berdasarkan ID
        $order = Order::findOrFail($id);

        // Ambil tanggal saat ini
        $today = Carbon::now('Asia/Jakarta')->format('Y-m-d');
        
        // Ambil tanggal order (hanya tanggal tanpa waktu)
        $orderDate = Carbon::parse($order->created_at)->format('Y-m-d');

        // Cek apakah tanggal order adalah hari ini
        if ($orderDate === $today) {
            // Jika tanggal order adalah hari ini, lanjutkan untuk menghapus
            if ($order && $order->deleted_mice_ids) {
                // Kembalikan stok mencit berdasarkan ID yang disimpan
                $this->restoreStock(json_decode($order->deleted_mice_ids));

                // Hapus order setelah stok dikembalikan
                $order->delete();

                return response()->json(['success' => true, 'message' => 'Order deleted and stock restored successfully']);
            }

            return response()->json(['success' => false, 'message' => 'Order not found or no mice IDs to restore.'], 404);
        } else {
            // Jika tanggal order bukan hari ini, jangan izinkan penghapusan
            return response()->json(['success' => false, 'message' => 'You can only delete orders created today.'], 403);
        }
    }


    private function restoreStock($miceIds)
    {
        if (!empty($miceIds)) {
            // Kembalikan mencit yang dihapus berdasarkan ID
            foreach ($miceIds as $id) {
                // Temukan mencit yang telah dihapus menggunakan soft delete
                $mencit = DetailMencit::withTrashed()->find($id);

                if ($mencit) {
                     // Kembalikan mencit yang dihapus
                    $mencit->restore();
                }
            }
        }
    }
}
