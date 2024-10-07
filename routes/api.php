<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

use App\Http\Controllers\Sensor1Controller;
use App\Http\Controllers\Sensor2Controller;
use App\Http\Controllers\Sensor3Controller;

Route::apiResource('sensor1', Sensor1Controller::class);  // Kesehatan
Route::apiResource('sensor2', Sensor2Controller::class);  // Jenis Kelamin
Route::apiResource('sensor3', Sensor3Controller::class);  // Berat
