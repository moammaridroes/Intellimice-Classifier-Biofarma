<?php

// app/Http/Controllers/DetailMencitController.php

namespace App\Http\Controllers;

use App\Models\DetailMencit;

class DetailMencitController extends Controller
{
    public function showData()
    {
    $data = DetailMencit::all(); // Fetch all data from the detail_mencit table
    return view('tables.data-table', compact('data'));
    }
}
