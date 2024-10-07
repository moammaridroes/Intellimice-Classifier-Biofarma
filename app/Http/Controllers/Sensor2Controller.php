<?php

namespace App\Http\Controllers;

use App\Models\Sensor2;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Sensor2Controller extends Controller
{
    /**
     * Display a listing of the Sensor1 resources.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $sensors = Sensor2::all();
        return response()->json($sensors, 200);
    }

    /**
     * Store a newly created Sensor1 resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        $now = Carbon::now()->toDateTimeString();
        // Validate the incoming request data
        $params = [
            'jenis_kelamin' => $request-> jenis_kelamin,
            'timestamp' => $request -> $now
            // Add other fields and validation rules as necessary
        ];

        try{
            DB::table('data_jenis_kelamin')->insert($params);
            return response()->json([
                'code' => 200,
                'message' => "success",
                'data' => $params
            ]);
        } catch (\Throwable $th){
            return response()->json([
                'code' => 400,
                'message' => "failed",
                "data" => $th->errorInfo
            ],400);
        }
    }

    /**
     * Display the specified Sensor1 resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $sensor = Sensor2::find($id);

        if (!$sensor) {
            return response()->json(['message' => 'Sensor2 not found'], 404);
        }

        return response()->json($sensor, 200);
    }

    /**
     * Update the specified Sensor1 resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $sensor = Sensor2::find($id);

        if (!$sensor) {
            return response()->json(['message' => 'Sensor2 not found'], 404);
        }

        // Validate the incoming request data
        $validatedData = $request->validate([
            'jenis_kelamin'   => 'sometimes|required|string|max:255',
            'timestamp' => 'sometimes|required|date',
            // Add other fields and validation rules as necessary
        ]);

        // Update the sensor with validated data
        $sensor->update($validatedData);

        return response()->json([
            'message' => 'Sensor2 updated successfully!',
            'sensor' => $sensor
        ], 200);
    }

    /**
     * Remove the specified Sensor1 resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
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