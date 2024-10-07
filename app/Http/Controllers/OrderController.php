<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\CustomerOrder;
use App\Http\Controllers\CustomerOrderController;
use App\Models\DetailMencit;
// use Carbon\Carbon

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

    // Calculate total price
    $malePrice = 4000;
    $femalePrice = 5000;
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
    $order->is_paid = true; // Default value
    $order->save();

    // Kurangi stok dari DetailMencit
    if ($request->male_quantity > 0) {
        $query = DetailMencit::where('gender', 'Male')
            ->where('health_status', 'Healthy');
        
        // Mapping dari opsi weight ke rentang numerik
        switch ($request->weight) {
            case 'less_than_8':
                $query->where('berat', '<', 8);
                break;
            case 'between_8_and_14':
                $query->whereBetween('berat', [8, 14]);
                break;
            case 'between_14_and_18':
                $query->whereBetween('berat', [14, 18]);
                break;
            case 'greater_equal_18':
                $query->where('berat', '>=', 18);
                break;
        }
    
        $deletedMale = $query->limit($request->male_quantity)->delete();
        
        if ($deletedMale == 0) {
            return response()->json(['success' => false, 'message' => 'Male stock not available'], 400);
        }
    }
    
    if ($request->female_quantity > 0) {
        $query = DetailMencit::where('gender', 'Female')
            ->where('health_status', 'Healthy');
        
        // Mapping dari opsi weight ke rentang numerik
        switch ($request->weight) {
            case 'less_than_8':
                $query->where('berat', '<', 8);
                break;
            case 'between_8_and_14':
                $query->whereBetween('berat', [8, 14]);
                break;
            case 'between_14_and_18':
                $query->whereBetween('berat', [14, 18]);
                break;
            case 'greater_equal_18':
                $query->where('berat', '>=', 18);
                break;
        }
    
        $deletedFemale = $query->limit($request->female_quantity)->delete();
        
        if ($deletedFemale == 0) {
            return response()->json(['success' => false, 'message' => 'Female stock not available'], 400);
        }
    }
}


    public function fetchStock(Request $request)
    {
        $weight = $request->input('weight');

        $maleStock = DetailMencit::where('gender', 'Male')
            ->where('health_status', 'Healthy')
            ->when($weight === 'less_than_8', function ($query) {
                return $query->where('berat', '<', 8);
            })
            ->when($weight === 'between_8_and_14', function ($query) {
                return $query->whereBetween('berat', [8, 14]);
            })
            ->when($weight === 'between_14_and_18', function ($query) {
                return $query->whereBetween('berat', [14, 18]);
            })
            ->when($weight === 'greater_equal_18', function ($query) {
                return $query->where('berat', '>=', 18);
            })
            ->count();

        $femaleStock = DetailMencit::where('gender', 'Female')
            ->where('health_status', 'Healthy')
            ->when($weight === 'less_than_8', function ($query) {
                return $query->where('berat', '<', 8);
            })
            ->when($weight === 'between_8_and_14', function ($query) {
                return $query->whereBetween('berat', [8, 14]);
            })
            ->when($weight === 'between_14_and_18', function ($query) {
                return $query->whereBetween('berat', [14, 18]);
            })
            ->when($weight === 'greater_equal_18', function ($query) {
                return $query->where('berat', '>=', 18);
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

    // public function showInvoice($id)
    // {
    //     $order = Order::findOrFail($id);
    //     return view('invoice', compact('order'));
    // }

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
    $order = Order::findOrFail($id);
    if ($order) {
        $order->delete(); // Hapus data dari database
        return response()->json(['success' => true]);
    }
    return response()->json(['success' => false, 'message' => 'Order not found.'], 404);
}



}
