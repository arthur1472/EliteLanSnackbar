<?php

namespace App\Providers;

use App\Events\OrderStatusChanged;
use App\Events\OrderUpdatedEvent;
use App\Listeners\OrderAdminNoteUpdateListener;
use App\Listeners\OrderStatusUpdateListener;
use App\Listeners\SendOrderStatusMessageListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
//        OrderStatusChanged::class => [
//            SendOrderStatusMessageListener::class,
//        ],
        OrderUpdatedEvent::class => [
            OrderStatusUpdateListener::class,
            OrderAdminNoteUpdateListener::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
