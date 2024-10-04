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
        // Validasi data
        $validated = $request->validate([
            'fullname' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'agency_name' => 'required|string|max:255',
            'item_name' => 'required|string|max:255',
            'pick_up_date' => 'required|date',
            'weight' => 'required|numeric|min:1',
            'male_quantity' => 'nullable|numeric|min:0',
            'female_quantity' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string|max:500',
        ]);

        // Hitung total harga
        $totalPrice = ($request->male_quantity * 4000) + ($request->female_quantity * 5000);

        // Simpan data ke dalam model CustomerOrder
        $order = new CustomerOrder();
        $order->customer_id = auth()->id();
        $order->fullname = $validated['fullname'];
        $order->phone_number = $validated['phone_number'];
        $order->email = $validated['email'];
        $order->item_name = $validated['item_name'];
        $order->agency_name = $validated['agency_name'];
        $order->pick_up_date = $validated['pick_up_date'];
        $order->weight = $validated['weight'];
        $order->male_quantity = $validated['male_quantity'] ?? 0;
        $order->female_quantity = $validated['female_quantity'] ?? 0;
        $order->total_price = $totalPrice;
        $order->notes = $validated['notes'] ?? '';
        $order->status = 'pending';
        $order->is_paid = false;

        // Simpan data ke database
        $order->save();

        return redirect()->back()->with('success', 'Order has been placed successfully!');
    }

    // public function payment($id)
    // {
    //     $order = CustomerOrder::findOrFail($id);
    //     $order->update([
    //         'is_paid' => true, // Set kolom is_paid menjadi true
    //     ]);
    //     return redirect()->route('customer.history')->with('success', 'Order has been paid successfully!');
    // }

    // Method untuk menampilkan pesanan ke admin
    public function index()
    {
        $orders = CustomerOrder::where('status', 'pending')->get();
        return view('admin.orders.index', compact('orders'));
    }

    // Method untuk notifikasi admin
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

    // Method untuk menampilkan history online yang telah disetujui
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

    // Method untuk melakukan pembayaran
    // public function payment(Request $request, $id)
    // {
    //     $order = CustomerOrder::find($id);
    //     if ($order) {
    //         $order->is_paid = true;
    //         $order->save();

    //         return response()->json(['success' => true, 'message' => 'Payment successful']);
    //     }

    //     return response()->json(['success' => false, 'message' => 'Order not found'], 404);
    // }

    // Method untuk melakukan pembayaran
    // public function payment(Request $request, $id)
    // {
    //     $order = CustomerOrder::find($id);
    //     if ($order) {
    //         $order->is_paid = false; // Tandai sebagai blm dibayar
    //         $order->save(); // Simpan perubahan

    //         return response()->json(['success' => true, 'message' => 'Payment successful']);
    //     }

    //     return response()->json(['success' => false, 'message' => 'Order not found'], 404);
    // }
    


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
            $order->is_paid = true;
            $order->save();

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Order not found.'], 404);
    }

    // Menandai pesanan sebagai belum dibayar
    public function markAsUnpaid($id)
    {
        $order = CustomerOrder::find($id);
        if ($order) {
            $order->is_paid = false;
            $order->save();

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Order not found.'], 404);
    }

    // Method untuk menampilkan form order customer
    public function create()
    {
        return view('customer.order-form');
    }
}
