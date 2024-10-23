<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * Daftar event yang akan didaftarkan beserta listener-nya.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\OrderCreated' => [
            'App\Listeners\SendOrderNotification',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }
}
