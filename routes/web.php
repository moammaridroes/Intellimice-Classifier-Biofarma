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
use App\Http\Controllers\CustomerOrderController;

Route::get('/', function () {
    return redirect('/login');
});

Route::middleware(['auth'])->group(function () {
    // Semua route yang membutuhkan autentikasi dapat ditaruh di sini tp ni ga kepake si.
});

Route::middleware(['auth', \App\Http\Middleware\CheckRole::class . ':admin'])->group(function () {
    // Route khusus admin
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/dashboard', [DashboardController::class, 'showData'])->name('dashboard');
    Route::get('/dashboard', function () {
        return view('forms.dashboard_home');
    })->name('dashboard');
    Route::get('dashboard-data', [OrderController::class, 'dashboardData'])->name('dashboard.data');

    Route::get('/orderform', function () {
        return view('forms.order-form');
    });

    Route::post('home', [OrderController::class, 'store']);

    Route::get('/notification', [CustomerOrderController::class, 'notificationAdmin'])->name('admin.notification');

    // Route untuk menyetujui pesanan
    Route::post('/admin/customer-orders/{id}/approve', [CustomerOrderController::class, 'approve'])->name('admin.customer-orders.approve');
    // Route untuk menolak pesanan
    Route::post('/admin/customer-orders/{id}/reject', [CustomerOrderController::class, 'reject'])->name('admin.customer-orders.reject');

    Route::get('/stok', [DetailMencitController::class, 'showData']);
    // Route::get('data-table', [DetailMencitController::class, 'showData'])->name('detailmencit.data');
    // Route::get('data', [DetailMencitController::class, 'getData'])->name('detailmencit.data');
    Route::get('data-table', [DetailMencitController::class, 'showData'])->name('data.table');
    Route::get('detailmencit/data', [DetailMencitController::class, 'getData'])->name('detailmencit.data');

    Route::get('orderhistory', [OrderHistoryController::class, 'index'])->name('orderhistory.index');
    Route::get('orderhistory/data', [OrderHistoryController::class, 'getData'])->name('orderhistory.getData');
    Route::get('orderhistory/edit/{id}', [OrderController::class, 'edit']);
    Route::put('orderhistory/update/{id}', [OrderController::class, 'update']);
    Route::delete('orderhistory/delete/{id}', [OrderController::class, 'delete']);

    Route::get('/online-history', [CustomerOrderController::class, 'showOnlineHistory'])->name('onlinehistory.index');
    Route::get('/online-history/data', [CustomerOrderController::class, 'getOnlineHistoryData'])->name('onlinehistory.getData');

    Route::get('/datatable', function () {
        return view('tables.data-table');
    });

    Route::get('/admin/customer-orders', [CustomerOrderController::class, 'index'])->name('admin.customer-orders.index');

    Route::post('/admin/customer-orders/{id}/approve', [CustomerOrderController::class, 'approve'])->name('admin.customer-orders.approve');

    Route::get('/invoice/{id}', [OrderController::class, 'showInvoice'])->name('invoice.show');
    Route::post('/submit-order', [OrderController::class, 'store'])->name('order.store');
    Route::post('/order/payment/{id}', [OrderController::class, 'payment'])->name('order.payment');

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

Route::middleware(['auth', \App\Http\Middleware\CheckRole::class . ':customer'])->group(function () {
    // Route khusus customer
    Route::get('/customer/home', [CustomerDashboardController::class, 'index'])->name('customer.home');
    Route::get('/customer/home', function () {
        return view('customer.customer_home');
    })->name('customer.home');

    Route::post('/customer/orders', [CustomerOrderController::class, 'store'])->name('customer.orders.store');

    Route::post('submit-order-customer', [OrderController::class, 'store']);
    Route::get('/customer/orderform', function () {
        return view('customer.customer_order-form');
    });
    Route::post('/customer/order/submit', [CustomerOrderController::class, 'store'])->name('customer.order.submit');

    Route::get('/customer/notification', [CustomerOrderController::class, 'showCustomerNotifications'])->name('customer.notification');

    Route::get('/customer/history', [CustomerOrderController::class, 'showCustomerHistory'])->name('customer.history');
    Route::get('/customer/history/data', [CustomerOrderController::class, 'getCustomerHistoryData'])->name('customer.history.getData');
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
