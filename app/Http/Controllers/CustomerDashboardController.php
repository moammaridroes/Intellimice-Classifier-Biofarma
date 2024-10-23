<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerOrder;

class CustomerDashboardController extends Controller
{
    public function index()
    {
        $customerId = auth()->id();

        // Fetch order counts
        $pendingCount = CustomerOrder::where('customer_id', $customerId)->where('status', 'pending')->count();
        $approvedCount = CustomerOrder::where('customer_id', $customerId)->where('status', 'approved')->count();
        $rejectedCount = CustomerOrder::where('customer_id', $customerId)->where('status', 'rejected')->count();

        // Fetch most ordered items
        $mostOrderedItems = CustomerOrder::select('item_name')
            ->selectRaw('COUNT(*) as count')
            ->where('customer_id', $customerId) // Filter based on the logged-in customer ID
            ->groupBy('item_name')
            ->orderBy('count', 'desc')
            ->limit(10) // Limit to top 10 items
            ->get();

        // Pass all data to the view
        return view('customer.customer_home', compact('pendingCount', 'approvedCount', 'rejectedCount', 'mostOrderedItems'));
    }
}
