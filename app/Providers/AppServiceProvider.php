<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\CustomerOrder;
use App\Models\Order;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        View::composer('*', function ($view) {
            $unreadNotificationsCount = CustomerOrder::where('status', 'pending')->count();
            $view->with('unreadNotificationsCount', $unreadNotificationsCount);
        });
        
    }
}
