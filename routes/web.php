<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DetailMencitController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderHistoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CustomerDashboardController;
use App\Http\Controllers\WeightCategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CustomerOrderController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\MasterDataController;
use App\Http\Controllers\MasterAdminController;
use App\Http\Controllers\MasterPenjualanController;
use App\Http\Controllers\MasterManageController;
use App\Http\Controllers\DataCollectingController ;
use App\Models\Order;
use App\Models\CustomerOrder;
use App\Events\OrderCreated;
use App\Http\Controllers\MasterDashboardController;
use Illuminate\Support\Facades\App;
// use Illuminate\Support\Facades\Route;

    Route::get('/', function () {
        return view('landing');  // Mengarahkan root URL ke halaman landing
    })->name('landing');
    // Route untuk login tetap disediakan agar pengguna bisa login dari halaman lain
    // Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::get('/login', [HomeController::class, 'redirectIfAuthenticated'])->middleware('guest')->name('login');
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::middleware(['auth'])->group(function () {
        // Semua route yang membutuhkan autentikasi dapat ditaruh di sini tp ni ga kepake si.
    });

Route::middleware(['auth', \App\Http\Middleware\CheckRole::class . ':admin'])->group(function () {
    
    Route::get('/admin/get-latest-orders', [CustomerOrderController::class, 'getLatestOrders']);
    Route::get('/admin/get-unread-notifications-count', [CustomerOrderController::class, 'getUnreadNotificationsCount']);

    // Route khusus admin
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/dashboard', [DashboardController::class, 'showData'])->name('dashboard');
    Route::get('/dashboard', function () {
        return view('forms.dashboard_home');
    })->name('dashboard');
    // Route::get('dashboard-data', [OrderController::class, 'dashboardData'])->name('dashboard.data');
    Route::get('/dashboard-data', [DashboardController::class, 'dashboardData'])->name('dashboard.data');
    Route::get('/monthly-recap', [DashboardController::class, 'getMonthlyRecapData'])->name('monthly.recap');
    Route::get('/monthly-recap-data', [DashboardController::class, 'getMonthlyRecapData'])->name('monthly.recap.data');

    Route::get('/orderform', function () {
        return view('forms.order-form');
    });

    Route::post('home', [OrderController::class, 'store']);

    Route::get('/notification', [CustomerOrderController::class, 'notificationAdmin'])->name('admin.notification');
    // Route::get('/admin/notification', [CustomerOrderController::class, 'getNotifications'])->name('admin.notification');
    // Route::get('/admin/getNotificationCount', [CustomerOrderController::class, 'getNotificationCount'])->name('admin.getNotificationCount');

    // Route untuk menyetujui pesanan
    Route::post('/admin/customer-orders/{id}/approve', [CustomerOrderController::class, 'approve'])->name('admin.customer-orders.approve');
    // Route untuk menolak pesanan
    Route::post('/admin/customer-orders/{id}/reject', [CustomerOrderController::class, 'reject'])->name('admin.customer-orders.reject');

    Route::get('stok', [DetailMencitController::class, 'showData'])->name('data.table');
    Route::get('detailmencit/data', [DetailMencitController::class, 'getData'])->name('detailmencit.data');
    Route::post('/sync-detail-mencit', [DetailMencitController::class, 'syncData'])->name('sync.detail-mencit');
    // Route::post('/sync-data', [DetailMencitController::class, 'syncData'])->name('sync.data');

    Route::delete('/detailmencit/delete/{id}', [DetailMencitController::class, 'delete'])->name('detailmencit.delete');
    Route::delete('/detailmencit/deleteAll', [DetailMencitController::class, 'deleteAll']);
    Route::get('detailmencit/updateStockCountss', [DetailMencitController::class, 'updateStockCounts'])->name('detailmencit.updateStockCounts');
    // Route::get('/api/detailmencit/stream', [DetailMencitController::class, 'streamUpdates']);


    Route::get('orderhistory', [OrderHistoryController::class, 'index'])->name('orderhistory.index');
    Route::get('orderhistory/data', [OrderHistoryController::class, 'getData'])->name('orderhistory.getData');

    // order offline
    Route::get('orderhistory/details/{id}', [OrderHistoryController::class, 'details'])->name('orderhistory.details');    Route::get('orderhistory/edit/{id}', [OrderController::class, 'edit']);
    Route::put('orderhistory/update/{id}', [OrderController::class, 'update']);
    Route::delete('orderhistory/delete/{id}', [OrderController::class, 'delete']);

    // order online
    Route::get('/online-history', [CustomerOrderController::class, 'showOnlineHistory'])->name('onlinehistory.index');
    Route::get('/online-history/data', [CustomerOrderController::class, 'getOnlineHistoryData'])->name('onlinehistory.getData');
    Route::post('/customer-orders/{id}/mark-as-paid', [CustomerOrderController::class, 'markAsPaid'])->name('customer-orders.markAsPaid');
    Route::post('/customer-orders/{id}/mark-as-unpaid', [CustomerOrderController::class, 'markAsUnpaid'])->name('customer-orders.markAsUnpaid');
    Route::get('/orderonline/details/{id}', [CustomerOrderController::class, 'details']);

    //testing db
    // Route::get('/data-collecting', [DataCollectingController::class, 'index'])->name('data.collecting');
    // Route::get('/detail-mencit', [DataCollectingController::class, 'index']);

    Route::post('/sync-detail-mencit', [DetailMencitController::class, 'syncData'])->name('sync.detail-mencit');
    // Route::get('/mencit-updates', [DetailMencitController::class, 'streamUpdates']);
    
    Route::get('/datatable', function () {
        return view('tables.data-table');
    });

    Route::get('/admin/customer-orders', [CustomerOrderController::class, 'index'])->name('admin.customer-orders.index');
    Route::post('/admin/customer-orders/{id}/approve', [CustomerOrderController::class, 'approve'])->name('admin.customer-orders.approve');

    // Route::get('/invoice/{id}', [OrderController::class, 'showInvoice'])->name('invoice.show');
    Route::post('/submit-order', [OrderController::class, 'store'])->name('order.store');
    Route::get('/detailmencit/updateStockCounts', [OrderController::class, 'fetchStock']);
    Route::post('/order/payment/{id}', [OrderController::class, 'payment'])->name('order.payment');

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    // Route::get('/test-log', function () {
    //     \Log::info('This is a test log entry!');
    //     return 'Log entry added';
    // });
    
});

Route::middleware(['auth', \App\Http\Middleware\CheckRole::class . ':customer'])->group(function () {
    // Route khusus customer
    Route::get('/customer/home', [CustomerDashboardController::class, 'index'])->name('customer.home');
    Route::get('/customer/home/most-ordered-items', [CustomerOrderController::class, 'mostOrderedItems'])->name('customer.mostOrderedItems');

    Route::get('locale/{lang}',[LanguageController::class,'setLocale']);
    // Route::get('/customer/home', [CustomerHomeController::class, 'index'])->name('customer.home');

    Route::post('/customer/orders', [CustomerOrderController::class, 'store'])->name('customer.orders.store');
    Route::get('/customer/orderform', function () {
        return view('customer.customer_order-form');
    });

    Route::post('/customer/order/submit', [CustomerOrderController::class, 'store'])->name('customer.order.submit');
    Route::get('/customer/notification', [CustomerOrderController::class, 'showCustomerNotifications'])->name('customer.notification');
    Route::get('/customer/history', [CustomerOrderController::class, 'showCustomerHistory'])->name('customer.history');
    Route::get('/customer/history/data', [CustomerOrderController::class, 'getCustomerHistoryData'])->name('customer.history.getData');
});

Route::middleware(['auth', \App\Http\Middleware\CheckRole::class . ':master_data'])->group(function () {
    Route::get('/masterdata/home', [MasterDataController::class, 'index'])->name('masterdata.home');
    Route::get('/masterdata/home/{year?}', [MasterDataController::class, 'index']);

    Route::get('/masterdata/manage', [MasterManageController::class, 'showMencitStock'])->name('master.stok.mencit');
    Route::post('/master/update-price', [MasterManageController::class, 'updatePrice'])->name('master.update.prices');
    Route::resource('weight', WeightCategoryController::class)->except(['show']);


    Route::get('/masterdata/admin', [MasterAdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/{id}/edit', [MasterAdminController::class, 'edit'])->name('admin.edit');
    Route::patch('/admin/{id}', [MasterAdminController::class, 'update'])->name('admin.update');
    Route::delete('/admin/delete/{id}', [MasterAdminController::class, 'destroy'])->name('admin.delete');
    Route::post('/add-admin', [MasterAdminController::class, 'store'])->name('admin.store');

    Route::get('/masterdata/penjualan', [MasterPenjualanController::class, 'index'])->name('masterdata.penjualan');
    Route::get('/masterdata/penjualan/{year}', [MasterPenjualanController::class, 'fetchData']);
    Route::get('/masterdata/export-sales/{year}', [MasterPenjualanController::class, 'exportSalesReport'])
    ->name('masterdata.export.sales');


    //PERCOBAANNN
    Route::prefix('masterdata/categories')->name('master.categories.')->group(function () {
        Route::post('/store', [MasterManageController::class, 'storeCategory'])->name('store');
        // Route::put('/update/{key}', [MasterManageController::class, 'updateCategory'])->name('update');
        Route::put('/{key}/update-key', [MasterManageController::class, 'updateCategoryKey'])->name('update-key');
        Route::delete('/destroy/{key}', [MasterManageController::class, 'destroyCategory'])->name('destroy');
    });
    

    // Route::get('masterdata/stok', [DetailMencitController::class, 'showData'])->name('masterdata.data.table');
    // Route::get('masterdata/detailmencit/data', [DetailMencitController::class, 'getData'])->name('masterdata.detailmencit.data');
    // Route::post('masterdata/sync-detail-mencit', [DetailMencitController::class, 'syncData'])->name('masterdata.sync.detail-mencit');
    // Route::post('masterdata/sync-data', [DetailMencitController::class, 'syncData'])->name('masterdata.sync.data');

    // Route::delete('masterdata/detailmencit/delete/{id}', [DetailMencitController::class, 'delete'])->name('masterdata.detailmencit.delete');
    // Route::delete('masterdata/detailmencit/deleteAll', [DetailMencitController::class, 'deleteAll']);
    // Route::get('masterdata/detailmencit/updateStockCountss', [DetailMencitController::class, 'updateStockCounts'])->name('masterdata.detailmencit.updateStockCounts');

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
