<?php

namespace App\Http\Controllers;

use App\Models\DetailMencit;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;

class DetailMencitController extends Controller
{
    public function showData()
    {
        // Get the counts based on the conditions
        $maleSickCount = DetailMencit::where('gender', 'Male')->where('health_status', 'Sick')->count();
        $femaleSickCount = DetailMencit::where('gender', 'Female')->where('health_status', 'Sick')->count();

        // Male Healthy with weight conditions
        $maleHealthyCounts = [
            'less_than_8' => DetailMencit::where('gender', 'Male')->where('health_status', 'Healthy')->where('berat', '<', 8)->count(),
            'between_8_and_14' => DetailMencit::where('gender', 'Male')->where('health_status', 'Healthy')->whereBetween('berat', [8, 14])->count(),
            'between_14_and_18' => DetailMencit::where('gender', 'Male')->where('health_status', 'Healthy')->whereBetween('berat', [14.01, 18])->count(),
            'greater_equal_18' => DetailMencit::where('gender', 'Male')->where('health_status', 'Healthy')->where('berat', '>', 18)->count(),
        ];

        // Female Healthy with weight conditions
        $femaleHealthyCounts = [
            'less_than_8' => DetailMencit::where('gender', 'Female')->where('health_status', 'Healthy')->where('berat', '<', 8)->count(),
            'between_8_and_14' => DetailMencit::where('gender', 'Female')->where('health_status', 'Healthy')->whereBetween('berat', [8, 14])->count(),
            'between_14_and_18' => DetailMencit::where('gender', 'Female')->where('health_status', 'Healthy')->whereBetween('berat', [14.01, 18])->count(),
            'greater_equal_18' => DetailMencit::where('gender', 'Female')->where('health_status', 'Healthy')->where('berat', '>', 18)->count(),
        ];

        return view('tables.data-table', compact(
            'maleSickCount', 
            'femaleSickCount', 
            'maleHealthyCounts', 
            'femaleHealthyCounts'
        ));
    }



    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $data = DetailMencit::select(['id', 'created_at', 'berat', 'gender', 'health_status'])
                ->orderByDesc('created_at'); // Mengurutkan data dari data terbaru
            
            return DataTables::of($data)
                ->addIndexColumn() // Auto indexing
                ->editColumn('created_at', function ($row) {
                    return $row->created_at->format('d/m/Y'); // Format tanggal
                })
                ->editColumn('health_status', function ($row) {
                    return $row->health_status == 'Healthy' 
                        ? '<span class="badge bg-success">Healthy</span>' 
                        : '<span class="badge bg-danger">Sick</span>';
                })
                ->rawColumns(['health_status']) // Agar HTML badge dapat dirender
                ->make(true);
        }
    }

    public function deleteAll()
    {
        try {
            // Menghapus semua data dari tabel DetailMencit
            DetailMencit::truncate(); // Menghapus semua data

            return response()->json(['success' => true, 'message' => 'All records deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to delete all records.']);
        }
    }

    public function delete($id)
    {
        $detailMencit = DetailMencit::find($id);

        if ($detailMencit) {
            $detailMencit->delete();
            return response()->json(['success' => 'Record deleted successfully.']);
        }

        return response()->json(['error' => 'Record not found.'], 404);
    }

    public function updateStockCounts()
    {
        $maleSickCount = DetailMencit::where('gender', 'Male')->where('health_status', 'Sick')->count();
        $femaleSickCount = DetailMencit::where('gender', 'Female')->where('health_status', 'Sick')->count();

        $maleHealthyCounts = [
            'less_than_8' => DetailMencit::where('gender', 'Male')->where('health_status', 'Healthy')->where('berat', '<', 8)->count(),
            'between_8_and_14' => DetailMencit::where('gender', 'Male')->where('health_status', 'Healthy')->whereBetween('berat', [8, 14])->count(),
            'between_14_and_18' => DetailMencit::where('gender', 'Male')->where('health_status', 'Healthy')->whereBetween('berat', [14.01, 18])->count(),
            'greater_equal_18' => DetailMencit::where('gender', 'Male')->where('health_status', 'Healthy')->where('berat', '>', 18)->count(),
        ];

        $femaleHealthyCounts = [
            'less_than_8' => DetailMencit::where('gender', 'Female')->where('health_status', 'Healthy')->where('berat', '<', 8)->count(),
            'between_8_and_14' => DetailMencit::where('gender', 'Female')->where('health_status', 'Healthy')->whereBetween('berat', [8, 14])->count(),
            'between_14_and_18' => DetailMencit::where('gender', 'Female')->where('health_status', 'Healthy')->whereBetween('berat', [14.01, 18])->count(),
            'greater_equal_18' => DetailMencit::where('gender', 'Female')->where('health_status', 'Healthy')->where('berat', '>', 18)->count(),
        ];

        return response()->json([
            'maleSickCount' => $maleSickCount,
            'femaleSickCount' => $femaleSickCount,
            'maleHealthyCounts' => $maleHealthyCounts,
            'femaleHealthyCounts' => $femaleHealthyCounts,
        ]);
    }


}
