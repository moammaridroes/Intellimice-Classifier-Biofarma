<?php

namespace App\Http\Controllers;

use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use App\Models\CustomerOrder;
use Carbon\Carbon;

class CustomerOrderController extends Controller
{
    // Method untuk menyimpan pesanan dari customer
    public function store(Request $request)
    {   
        $totalPrice = ($request->male_quantity * 4000) + ($request->female_quantity * 5000);

        $order = new CustomerOrder();
        $order->customer_id = auth()->id(); // Pastikan auth()->id() mengembalikan ID customer yang valid
        $order->fullname = $request->fullname;
        $order->phone_number = $request->phone_number;
        $order->email = $request->email;
        $order->item_name = $request->item_name;
        $order->agency_name = $request->agency_name;
        $order->pick_up_date = $request->pick_up_date;
        $order->weight = $request->weight;
        $order->male_quantity = $request->male_quantity ?? 0;
        $order->female_quantity = $request->female_quantity ?? 0;
        $order->total_price = $totalPrice;
        $order->notes = $request->notes;
        $order->status = 'pending';
        $order->is_paid = false;
        $order->save();

        return redirect()->back()->with('success', 'Order has been placed successfully!');
    }

    // Method untuk menampilkan pesanan ke admin
    public function index()
    {
        $orders = CustomerOrder::where('status', 'pending')->get();
        return view('admin.orders.index', compact('orders'));
    }
    // Method untuk menampilkan notifikasi admin
    public function notificationAdmin()
    {
        $orders = CustomerOrder::where('status', 'pending')->get();
        return view('notification', compact('orders'));
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

    // Method untuk menampilkan halaman online history
    public function showOnlineHistory()
    {
        return view('online_history');
    }

    // Method untuk mengambil data order online yang telah disetujui
    public function getOnlineHistoryData(Request $request)
{
    $orders = CustomerOrder::where('status', 'approved')
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
            ]);

        
return DataTables::of($orders)
    ->addIndexColumn()
    ->editColumn('pick_up_date', function($order) {
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

    public function markAsPaid($id)
    {
    $order = CustomerOrder::find($id);
    if ($order) {
        $order->is_paid = true;
        $order->save();

        return response()->json(['success' => true]);
    }

    return response()->json(['success' => false, 'message' => 'Order not found.'], 404);
    }

    

    // Method untuk form order customer
    public function create()
    {
        return view('customer.order-form'); 
    }
}
