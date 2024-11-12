<?php

namespace App\Http\Controllers;

use App\Models\Sensor1;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Sensor1Controller extends Controller
{
    public function index()
    {
        $sensors = Sensor1::all();
        return response()->json($sensors, 200);
    }

    public function store(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        $now = Carbon::now()->toDateTimeString();

        // Validate the incoming request data
        $params = [
            'kesehatan_status' => $request->kesehatan_status,
            'timestamp' => $now
        ];

        try {
            DB::table('data_kesehatan')->insert($params);
            return response()->json([
                'code' => 200,
                'message' => "success",
                'data' => $params
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'code' => 400,
                'message' => "failed",
                "data" => $th->errorInfo
            ], 400);
        }
    }

    public function show($id)
    {
        $sensor = Sensor1::find($id);

        if (!$sensor) {
            return response()->json(['message' => 'Sensor1 not found'], 404);
        }

        return response()->json($sensor, 200);
    }

    public function update(Request $request, $id)
    {
        $sensor = Sensor1::find($id);

        if (!$sensor) {
            return response()->json(['message' => 'Sensor1 not found'], 404);
        }

        $validatedData = $request->validate([
            'kesehatan_status'   => 'sometimes|required|string|max:255',
            'timestamp' => 'sometimes|required|date',
        ]);

        $sensor->update($validatedData);

        return response()->json([
            'message' => 'Sensor1 updated successfully!',
            'sensor' => $sensor
        ], 200);
    }

    public function destroy($id)
    {
        $sensor = Sensor1::find($id);

        if (!$sensor) {
            return response()->json(['message' => 'Sensor1 not found'], 404);
        }

        $sensor->delete();

        return response()->json(['message' => 'Sensor1 deleted successfully!'], 204);
    }
}
