<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    // Menampilkan halaman form order
    public function create()
    {
        return view('forms.order-form');
    }

    // Menyimpan data order ke database dan menghitung total harga
    public function store(Request $request)
    {
        $request->validate([
            'fullname' => 'required|string',
            'phone_number' => 'required|numeric',
            'email' => 'required|email',
            'item_name' => 'required|string',
            'agency_name' => 'required|string',
            'operator_name' => 'required|string',
            'weight' => 'required|numeric|min:1',
            'male_quantity' => 'nullable|numeric|min:0',
            'female_quantity' => 'nullable|numeric|min:0',
        ]);

        // Calculate total price
        $malePrice = 4000;
        $femalePrice = 5000;
        $totalPrice = ($request->male_quantity * $malePrice) + ($request->female_quantity * $femalePrice);

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
        $order->is_paid = false; // Default value
        $order->save();

        return response()->json(['success' => true, 'order' => $order]);
    }

    public function showInvoice($id)
    {
        $order = Order::findOrFail($id);
        return view('invoice', compact('order'));
    }

    public function payment($id)
    {
        $order = Order::findOrFail($id);
        $order->update([
            'is_paid' => true, // Set kolom is_paid menjadi true
        ]);
        return redirect()->route('orderhistory.index')->with('success', 'Order has been paid successfully!');
    }
}
