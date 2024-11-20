<?php

namespace App\Http\Controllers;

use App\Models\Sensor3;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Sensor3Controller extends Controller
{
    public function index()
    {
        $sensors = Sensor3::all();
        return response()->json($sensors, 200);
    }

    public function store(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        $now = Carbon::now()->toDateTimeString();

        // Mengambil data dari body JSON
        $params = [
            'berat' => $request->input('berat'), // Sesuaikan dengan key JSON
            'timestamp' => $now,
        ];

        // $paramsKesehatan = [
        //     'kesehatan_status' => 'healthy',
        // ];

        try {
            DB::table('data_load_cell')->insert($params);
            // DB::table('data_kesehatan')->insert($paramsKesehatan);
            return response()->json([
                'code' => 200,
                'message' => "success",
                'data' => $params,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'code' => 400,
                'message' => "failed",
                "data" => $th->errorInfo,
            ], 400);
        }
    }


    public function show($id)
    {
        $sensor = Sensor3::find($id);

        if (!$sensor) {
            return response()->json(['message' => 'Sensor3 not found'], 404);
        }

        return response()->json($sensor, 200);
    }

    public function update(Request $request, $id)
    {
        $sensor = Sensor3::find($id);

        if (!$sensor) {
            return response()->json(['message' => 'Sensor3 not found'], 404);
        }

        $validatedData = $request->validate([
            'berat' => 'sometimes|required|string|max:255',
            'timestamp' => 'sometimes|required|date',
        ]);

        $sensor->update($validatedData);

        return response()->json([
            'message' => 'Sensor3 updated successfully!',
            'sensor' => $sensor
        ], 200);
    }

    public function destroy($id)
    {
        $sensor = Sensor3::find($id);

        if (!$sensor) {
            return response()->json(['message' => 'Sensor3 not found'], 404);
        }

        $sensor->delete();

        return response()->json(['message' => 'Sensor3 deleted successfully!'], 204);
    }
}
