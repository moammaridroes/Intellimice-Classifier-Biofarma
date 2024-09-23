<?php

namespace App\Http\Controllers;

use App\Models\DetailMencit;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;

class DetailMencitController extends Controller
{
    public function showData()
    {
        return view('tables.data-table');
    }

    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $data = DetailMencit::select([
                'id', 
                'created_at', 
                'berat', 
                'jenis_kelamin', 
                'health_status'
            ]);

            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('created_at', function ($row) {
                    return $row->created_at->format('d/m/Y'); // Format tanggal
                })
                ->editColumn('health_status', function ($row) {
                    return $row->health_status == 'Healthy' 
                        ? '<label class="badge badge-success">Healthy</label>' 
                        : '<label class="badge badge-danger">Sick</label>';
                })
                ->rawColumns(['health_status']) // Membuat kolom health_status menjadi HTML
                ->make(true);
        }
    }
}
