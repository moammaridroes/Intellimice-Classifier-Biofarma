<?php


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DetailMencitController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderHistoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\CustomerDashboardController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;


Route::get('/', function () {
    return redirect('/login');
});


Route::middleware(['auth'])->group(function () {   
});

Route::middleware(['auth', \App\Http\Middleware\CheckRole::class . ':admin'])->group(function () {
    // Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    // Route Admin
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/dashboard', [DashboardController::class, 'showData'])->name('dashboard');
    Route::get('/dashboard', function () {
        return view('forms.dashboard_home');
    })->name('dashboard');
    
    Route::get('/orderform', function () {
        return view('forms.order-form');
    });
    
    // Route::post('submit-order', [OrderController::class, 'store']);
    Route::post('/submit-order', [OrderController::class, 'store']);
    Route::post('home', [OrderController::class, 'store']);

    Route::post('notification', [OrderController::class, 'store']);
    Route::get('/notification', [DashboardController::class, 'showData'])->name('notification');
    Route::get('/notification', function () {
        return view('notification');
    })->name('notification');

    Route::get('/stok', [DetailMencitController::class, 'showData']);
    Route::get('data-table', [DetailMencitController::class, 'showData'])->name('detailmencit.data');
    Route::get('data', [DetailMencitController::class, 'getData'])->name('detailmencit.data');
    
    // Route::get('orderhistory', [OrderHistoryController::class, 'index'])->name('orderhistory');
    Route::get('orderhistory', [OrderHistoryController::class, 'index'])->name('orderhistory.index');
    Route::get('orderhistory/data', [OrderHistoryController::class, 'getData'])->name('orderhistory.getData');

    Route::get('/datatable', function () {
        return view('tables.data-table');
    });

    Route::get('/invoice/{id}', [OrderController::class, 'showInvoice'])->name('invoice.show');
    Route::post('/order/payment/{id}', [OrderController::class, 'payment'])->name('order.payment');


    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

// Route::middleware(['auth', \App\Http\Middleware\CheckRole::class . ':customer'])->group(function () {
//     Route::get('/home', [DashboardController::class, 'showData'])->name('customer.home'); 
//     Route::get('/home', function () {
//         return view('customer.customer_home'); 
//     })->name('customer.home');
// });

Route::middleware(['auth', \App\Http\Middleware\CheckRole::class . ':customer'])->group(function () {
    Route::get('/customer/home', [CustomerDashboardController::class, 'index'])->name('customer.home');
    Route::get('/customer/home', function () {
        return view('customer.customer_home');
    })->name('customer.home');

    Route::post('submit-order-customer', [OrderController::class, 'store']);
    Route::get('/customer/orderform', function () {
        return view('customer.customer_order-form');
    });

});

Route::get('/db-check', function () {
    try {
        DB::connection()->getPdo();
        return "Connected successfully to the database.";
    } catch (\Exception $e) {
        return "Could not connect to the database. Please check your configuration. Error: " . $e->getMessage();
    }
});

Route::get('/home', [HomeController::class, 'index'])->name('home');
Auth::routes();


