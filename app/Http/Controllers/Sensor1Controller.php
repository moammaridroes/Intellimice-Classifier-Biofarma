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

        // Mengambil data dari body JSON
        $params = [
            'kesehatan_status' => $request->input('status_kesehatan'), // Sesuaikan dengan key JSON
            'timestamp' => $now,
        ];
        $paramsBerat = [
            'berat' => $request->input('berat'), // Sesuaikan dengan key JSON
            'timestamp' => $now,
        ];
        $paramsJeniskelamin = [
            'jenis_kelamin' => $request->input('jenis_kelamin'), // Sesuaikan dengan key JSON
            'timestamp' => $now,
        ];
        

        try {
            DB::table('data_kesehatan')->insert($params);
            DB::table('data_load_cell')->insert($paramsBerat);
            DB::table('data_jenis_kelamin')->insert($paramsJeniskelamin);

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
