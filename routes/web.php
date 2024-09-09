<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DetailMencitController; // Assuming you have a model for the table


Route::get('/', [DetailMencitController::class, 'showData']);
Route::get('/orderform', function () {
    return view('forms.order-form');
});
Route::get('/history', [DetailMencitController::class, 'showData']);
Route::get('/orderhistory', function () {
        return view('forms.order_history_table');
});

Route::get('/db-check', function () {
    try {
        DB::connection()->getPdo();
        return "Connected successfully to the database.";
    } catch (\Exception $e) {
        return "Could not connect to the database. Please check your configuration. Error: " . $e->getMessage();
    }
});

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });
