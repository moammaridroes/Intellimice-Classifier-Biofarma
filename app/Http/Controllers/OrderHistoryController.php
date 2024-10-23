<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Carbon\Carbon;

class OrderHistoryController extends Controller
{
    // Menampilkan halaman Order History
    // Menampilkan halaman Order History
    public function index()
    {
        // Menampilkan view untuk tabel order history
        $orders = Order::all();
        return view('order_history_table', compact('orders'));
    }

    // Mengambil data order untuk DataTables
    public function getData(Request $request)
{
    $orders = Order::select([
        'id', 
        'fullname', 
        'phone_number', 
        'email', 
        'item_name', 
        'agency_name', 
        'operator_name',
        'weight', 
        'male_quantity', 
        'female_quantity', 
        'total_price',
        'is_paid',
        'created_at', 
        'updated_at'
    ]);

    return DataTables::of($orders)
        ->addIndexColumn() // Menambahkan nomor urut pada setiap baris
        ->editColumn('created_at', function($order) {
            // Format dengan Carbon dan zona waktu Indonesia
            return Carbon::parse($order->created_at)->timezone('Asia/Jakarta')->format('d-m-Y'); // Tanggal dan jam
        })
        ->editColumn('updated_at', function($order) {
            return Carbon::parse($order->updated_at)->timezone('Asia/Jakarta')->format('d-m-Y '); // Tanggal dan jam
        })
        ->editColumn('weight', function($order) {
            $weightMap = [
                'less_than_8' => '<8g',
                'between_8_and_14' => '8-14g',
                'between_14_and_18' => '14-18g',
                'greater_equal_18' => '>18g'
            ];
            return $weightMap[$order->weight] ?? $order->weight;
        })
        ->make(true);
}
    // Fungsi untuk menampilkan detail order
    public function details($id)
    {
        $order = Order::find($id);

        if (!$order) {
            return response()->json(['error' => 'Order not found'], 404);
        }

        // Pemetaan nilai weight
        $weightMap = [
            'less_than_8' => '<8g',
            'between_8_and_14' => '8-14g',
            'between_14_and_18' => '14-18g',
            'greater_equal_18' => '>18g'
        ];

        // Gunakan pemetaan jika tersedia
        $order->weight = $weightMap[$order->weight] ?? $order->weight;

        return response()->json($order);
    }

    // Fungsi untuk menghapus order
    public function delete($id)
    {
        $order = Order::find($id);

        if (!$order) {
            return response()->json(['error' => 'Order not found'], 404);
        }

        $order->delete();

        return response()->json(['success' => true]);
    }
}
