<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;

class OrderHistoryController extends Controller
{
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
                return $order->created_at->format('d-m-Y'); // Format tanggal untuk kolom 'created_at'
            })
            ->editColumn('updated_at', function($order) {
                return $order->updated_at->format('d-m-Y'); // Format tanggal untuk kolom 'updated_at'
            })
            ->make(true); // Mengembalikan data dalam format JSON untuk DataTables
    }
}
