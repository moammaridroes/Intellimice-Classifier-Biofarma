<?php

namespace App\Http\Controllers;

use App\Models\Sensor2;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Sensor2Controller extends Controller
{
    public function index()
    {
        $sensors = Sensor2::all();
        return response()->json($sensors, 200);
    }

    public function store(Request $request)
{
    date_default_timezone_set('Asia/Jakarta');
    $now = Carbon::now()->toDateTimeString();

    // Mengambil data dari body JSON
    $params = [
        'jenis_kelamin' => $request->input('jenis_kelamin'), // Sesuaikan dengan key JSON
        'timestamp' => $now,
    ];

    try {
        DB::table('data_jenis_kelamin')->insert($params);
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
        $sensor = Sensor2::find($id);

        if (!$sensor) {
            return response()->json(['message' => 'Sensor2 not found'], 404);
        }

        return response()->json($sensor, 200);
    }

    public function update(Request $request, $id)
    {
        $sensor = Sensor2::find($id);

        if (!$sensor) {
            return response()->json(['message' => 'Sensor2 not found'], 404);
        }

        $validatedData = $request->validate([
            'jenis_kelamin' => 'sometimes|required|string|max:255',
            'timestamp' => 'sometimes|required|date',
        ]);

        $sensor->update($validatedData);

        return response()->json([
            'message' => 'Sensor2 updated successfully!',
            'sensor' => $sensor
        ], 200);
    }

    public function destroy($id)
    {
        $sensor = Sensor2::find($id);

        if (!$sensor) {
            return response()->json(['message' => 'Sensor2 not found'], 404);
        }

        $sensor->delete();

        return response()->json(['message' => 'Sensor2 deleted successfully!'], 204);
    }
}
