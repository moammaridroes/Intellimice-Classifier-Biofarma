<?php

namespace App\Http\Controllers;

use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use App\Models\CustomerOrder;
use App\Models\DetailMencit;
use Carbon\Carbon;
use App\Models\User;
use Kreait\Firebase\Database;
use App\Events\OrderCreated;
use Illuminate\Support\Facades\Log;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\ServiceAccount;
use App\Notifications\OrderCreatedNotification;
use Google\Client as GoogleClient;


class CustomerOrderController extends Controller
{
    // Method untuk menyimpan pesanan dari customer
    public function store(Request $request)
{
    // Validasi data
    $validated = $request->validate([
        'fullname' => 'required|string|max:255',
        'phone_number' => 'required|string|max:20',
        'email' => 'required|email|max:255',
        'agency_name' => 'required|string|max:255',
        'item_name' => 'required|string|max:255',
        'pick_up_date' => 'required|date',
        'weight' => 'required|string|max:255',
        'male_quantity' => 'nullable|numeric|min:0',
        'female_quantity' => 'nullable|numeric|min:0',
        'notes' => 'nullable|string|max:500',
    ]);

    // Pemetaan dan hitung total harga
    $weightMap = [
        'category1' => '<10g',
        'category2' => '10-22g',
        'category3' => '>22g'
        // 'category4' => '>18g'
    ];
    
    $malePrices = config('mice.prices.male');
    $femalePrices = config('mice.prices.female');

    $malePrice = $malePrices[$request->weight] ?? 0;
    $femalePrice = $femalePrices[$request->weight] ?? 0;

    $totalPrice = ($request->male_quantity * $malePrice) + ($request->female_quantity * $femalePrice);


    // Simpan order ke database
    $order = CustomerOrder::create([
        'customer_id' => auth()->id(),
        'fullname' => $validated['fullname'],
        'phone_number' => $validated['phone_number'],
        'email' => $validated['email'],
        'item_name' => $validated['item_name'],
        'agency_name' => $validated['agency_name'],
        'pick_up_date' => $validated['pick_up_date'],
        'weight' => $weightMap[$validated['weight']],
        'male_quantity' => $validated['male_quantity'] ?? 0,
        'female_quantity' => $validated['female_quantity'] ?? 0,
        'total_price' => $totalPrice,
        'notes' => $validated['notes'] ?? '',
        'status' => 'pending',
        'is_paid' => false,
    ]);

    event(new OrderCreated($order));

    // Redirect back with success message
    return redirect()->back()->with('success', 'Order has been placed and saved successfully!');
    }

    // Method untuk menampilkan pesanan ke admin
    public function index()
    {
        $orders = CustomerOrder::where('status', 'pending')->get();
        return view('admin.orders.index', compact('orders'));
        
    }

    // Method untuk notifikasi admin
    public function notificationAdmin()
    {
        // Ambil semua pesanan yang statusnya masih pending
        $orders = CustomerOrder::where('status', 'pending')->get();
        
        // Hitung jumlah pesanan pending
        $unreadNotificationsCount = $orders->count();

        return view('notification', compact('orders', 'unreadNotificationsCount'));
    }


    // Method untuk menyetujui pesanan
    public function approve($id)
    {
        $order = CustomerOrder::find($id);
        if ($order) {
            $order->status = 'approved';
            $order->approved_by = auth()->id();
            $order->save();

            return redirect()->route('admin.notification')->with('success', 'Order has been approved successfully!');
        }

        return redirect()->back()->with('error', 'Order not found.');
    }

    // Method untuk menolak pesanan
    public function reject($id)
    {
        $order = CustomerOrder::find($id);
        if ($order) {
            $order->status = 'rejected';
            $order->save();

            return redirect()->back()->with('success', 'Order has been rejected successfully!');
        }

        return redirect()->back()->with('error', 'Order not found.');
    }

    // Method untuk menampilkan history online yang telah disetujui
    public function showOnlineHistory()
    {
        return view('online_history');
    }

    // Method untuk mengambil data order online yang telah disetujui
    // dan jika pickupdate melebihi 2 hari maka akan hilang dan tidak tampil
    public function getOnlineHistoryData(Request $request)
    {
        $orders = CustomerOrder::where('status', 'approved')
        ->where(function ($query) {
            $query->where('is_paid', true)
                ->orWhere(function ($subQuery) {
                    $subQuery->where('is_paid', false)
                        ->where('pick_up_date', '>=', now()->subDays(2)->toDateString());
                });
        })
            ->select([
                'id',
                'fullname',
                'phone_number',
                'email',
                'item_name',
                'agency_name',
                'pick_up_date',
                'weight',
                'male_quantity',
                'female_quantity',
                'total_price',
                'is_paid',
                'created_at',
                'updated_at'
            ])
            ->orderBy('updated_at', 'desc');

        return DataTables::of($orders)
            ->addIndexColumn()
            ->editColumn('pick_up_date', function ($order) {
                return Carbon::parse($order->pick_up_date)->format('d-m-Y');
            })
            ->editColumn('total_price', function ($order) {
                return 'Rp ' . number_format($order->total_price, 2, ',', '.');
            })
            ->editColumn('is_paid', function ($order) {
                return $order->is_paid ? 'Paid' : 'Unpaid';
            })
            ->make(true);
    }

    // Method untuk menampilkan notifikasi customer
    public function showCustomerNotifications()
    {
        $orders = CustomerOrder::where('customer_id', auth()->id())->get();
        return view('customer.customer_notification', compact('orders'));
    } 

    // Method untuk menampilkan history customer
    public function showCustomerHistory()
    {
        return view('customer.customer_history_table');
    }

    // Method untuk mengambil data history customer
    public function getCustomerHistoryData(Request $request)
    {
        $orders = CustomerOrder::where('customer_id', auth()->id())
            ->select([
                'id',
                'fullname',
                'phone_number',
                'email',
                'item_name',
                'pick_up_date',
                'weight',
                'male_quantity',
                'female_quantity',
                'total_price',
                'is_paid',
                'status',
                'notes'
            ])
            
            ->orderBy('created_at', 'desc');

        return DataTables::of($orders)
            ->addIndexColumn()
            ->editColumn('pick_up_date', function ($order) {
                return Carbon::parse($order->pick_up_date)->format('d-m-Y');
            })
            ->editColumn('total_price', function ($order) {
                return 'Rp ' . number_format($order->total_price, 2, ',', '.');
            })
            ->editColumn('is_paid', function ($order) {
                return $order->is_paid ? 'Paid' : 'Unpaid';
            })
            ->make(true);
    }

    // Menandai pesanan sebagai telah dibayar
    public function markAsPaid($id)
    {
        $order = CustomerOrder::find($id);
        if ($order) {
            // Pastikan pesanan belum dibayar sebelumnya
            if (!$order->is_paid) {
                // Validasi stok mencit terlebih dahulu
                $isStockAvailable = $this->checkStockAvailability(
                    $order->male_quantity, 
                    $order->female_quantity, 
                    $order->weight
                );

                if (!$isStockAvailable) {
                    return response()->json([
                        'success' => false, 
                        'message' => 'Insufficient stock to mark the order as paid.'
                    ], 400);
                }

                // Jika stok tersedia, lanjutkan dengan perubahan status
                $order->is_paid = true;
                $order->save();

                // Kurangi stok mencit berdasarkan pesanan
                $this->reduceStock($order->male_quantity, $order->female_quantity, $order->weight);

                return response()->json([
                    'success' => true, 
                    'message' => 'Order marked as paid and stock updated.'
                ]);
            } 
        }

        return response()->json(['success' => false, 'message' => 'Order not found.'], 404);
    }

    private function checkStockAvailability($maleQuantity, $femaleQuantity, $weightCategory)
    {
        $weightMap = [
            '<10g' => 'category1',
            '10-22g' => 'category2',
            '>22g' => 'category3',
            // '>18g' => 'category4',
        ];

        if (!isset($weightMap[$weightCategory])) {
            return false; // Jika kategori berat tidak valid
        }

        $weightConditions = [];
        switch ($weightMap[$weightCategory]) {
            case 'category1':
                $weightConditions = ['<', 10];
                break;
            case 'category2':
                $weightConditions = ['between', [10, 22]];
                break;
            // case 'category3':
            //     $weightConditions = ['between', [14.01, 18]];
            //     break;
            case 'category3':
                $weightConditions = ['>', 22];
                break;
        }

        $maleStock = $this->getStockCount('Male', $weightConditions);
        $femaleStock = $this->getStockCount('Female', $weightConditions);

        return $maleStock >= $maleQuantity && $femaleStock >= $femaleQuantity;
    }

    private function getStockCount($gender, $weightConditions)
    {
        $query = DetailMencit::where('gender', $gender)
            ->where('health_status', 'Healthy');

        if ($weightConditions[0] === 'between') {
            $query->whereBetween('berat', $weightConditions[1]);
        } else {
            $query->where('berat', $weightConditions[0], $weightConditions[1]);
        }

        return $query->count();
    }

    private function reduceStock($maleQuantity, $femaleQuantity, $weightCategory)
    {
        // Pemetaan kategori berat dari format tampilan ke value blade asli
        $weightMap = [
            '<10g' => 'category1',
            '19-22g' => 'category2',
            '>22g' => 'category3',
            // '>18g' => 'category4',
        ];

        // Cek apakah kategori berat valid
        if (!isset($weightMap[$weightCategory])) {
            return; // Jika kategori berat tidak valid, hentikan eksekusi
        }

        // Tentukan kondisi berdasarkan kategori berat yang dipilih
        $weightConditions = [];
        switch ($weightMap[$weightCategory]) {
            case 'category1':
                $weightConditions = ['<', 10];
                break;
            case 'category2':
                $weightConditions = ['between', [10, 22]];
                break;
            // case 'category3':
            //     $weightConditions = ['between', [14.01, 18]];
            //     break;
            case 'category3':
                $weightConditions = ['>', 22];
                break;
            default:
                return; // Jika kategori berat tidak valid, hentikan eksekusi
        }

        // Kurangi stok mencit pria
        $this->updateStock('Male', $maleQuantity, $weightConditions);

        // Kurangi stok mencit wanita
        $this->updateStock('Female', $femaleQuantity, $weightConditions);
    }


    // Method untuk mengurangi stok mencit berdasarkan gender dan kondisi berat yang dipesan
    // Stok mencit yang dihapus berdasarkan kategori berat yang dipilih
    private function updateStock($gender, $quantity, $weightConditions)
    {
        // Ambil mencit sehat berdasarkan gender dan kondisi berat
        $mencitQuery = DetailMencit::where('gender', $gender)
            ->where('health_status', 'Healthy');

        // Tambahkan kondisi berat
        if ($weightConditions[0] == 'between') {
            $mencitQuery->whereBetween('berat', $weightConditions[1]);
        } else {
            $mencitQuery->where('berat', $weightConditions[0], $weightConditions[1]);
        }

        // Ambil mencit sebanyak jumlah yang dipesan
        $mencitToDelete = $mencitQuery->take($quantity)->get();

        // Hapus mencit dari stok
        foreach ($mencitToDelete as $mencit) {
            $mencit->delete();
        }
    }
    // Menandai pesanan sebagai belum dibayar
// public function markAsUnpaid($id)
// {
//     $order = CustomerOrder::find($id);
//     if ($order) {
//         // Pastikan pesanan sudah dibayar sebelumnya
//         if ($order->is_paid) {
//             // Update status pembayaran menjadi unpaid
//             $order->is_paid = false;
//             $order->save();

//             // Kembalikan stok mencit berdasarkan pesanan
//             $this->restoreStock($order->male_quantity, $order->female_quantity, $order->weight);

//             return response()->json(['success' => true, 'message' => 'Order marked as unpaid and stock restored.']);
//         } else {
//             return response()->json(['success' => false, 'message' => 'Order is already unpaid.']);
//         }
//     }

//     return response()->json(['success' => false, 'message' => 'Order not found.'], 404);
// }

// // Method untuk mengembalikan stok mencit yang sudah di-reduce
// private function restoreStock($maleQuantity, $femaleQuantity, $weightCategory)
// {
//     // Tentukan kondisi berdasarkan kategori berat yang dipilih
//     $weightConditions = [];
//     switch ($weightCategory) {
//         case 'less_than_8':
//             $weightConditions = ['<', 8];
//             break;
//         case 'between_8_and_14':
//             $weightConditions = ['between', [8, 14]];
//             break;
//         case 'between_14_and_18':
//             $weightConditions = ['between', [14.01, 18]];
//             break;
//         case 'greater_equal_18':
//             $weightConditions = ['>', 18];
//             break;
//         default:
//             return; // Jika kategori berat tidak valid, hentikan eksekusi
//     }

//     // Kembalikan stok mencit jantan
//     $this->addStock('Male', $maleQuantity, $weightConditions);

//     // Kembalikan stok mencit betina
//     $this->addStock('Female', $femaleQuantity, $weightConditions);
// }

// // Method untuk menambahkan stok mencit
// private function addStock($gender, $quantity, $weightConditions)
// {
//     // Lakukan pengembalian stok mencit dengan menambah kembali jumlah mencit
//     for ($i = 0; $i < $quantity; $i++) {
//         // Tambahkan mencit baru ke stok
//         $newMencit = new DetailMencit();
//         $newMencit->gender = $gender;
//         $newMencit->health_status = 'Healthy';

//         // Tentukan berat sesuai kategori
//         switch ($weightConditions[0]) {
//             case '<':
//                 $newMencit->berat = rand(1, 7); // Misalkan mencit yang kurang dari 8g
//                 break;
//             case 'between':
//                 $newMencit->berat = rand($weightConditions[1][0], $weightConditions[1][1]); // Berat di antara batas
//                 break;
//             case '>':
//                 $newMencit->berat = rand(19, 25); // Misalkan mencit lebih dari 18g
//                 break;
//         }

//         // Simpan mencit baru ke database
//         $newMencit->save();
//     }
// }
    // function untuk print
    public function details($id)
    {
        $order = CustomerOrder::find($id);

        if (!$order) {
            return response()->json(['error' => 'Order not found'], 404);
        }

        $weightMap = [
            'category1' => '<10g',
            'category2' => '10-22g',
            'category3' => '>22g',
            // 'category4' => '>18g',
        ];

        $order->weight = $weightMap[$order->weight] ?? $order->weight;

        return response()->json($order);
    }

    // Method untuk menampilkan form order customer
    public function create()
    {
        return view('customer.order-form');
    }
}
