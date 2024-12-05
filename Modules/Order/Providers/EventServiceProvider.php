<?php

namespace Modules\Order\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        \Modules\Order\Events\OrderSendmail::class => [
            \Modules\Order\Listeners\OrderActionSendMail::class
        ],
    ];

    public function boot()
    {
        parent::boot();
    }
}