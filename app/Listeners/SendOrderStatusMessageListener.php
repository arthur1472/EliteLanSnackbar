<?php

namespace App\Listeners;

use App\Jobs\SendDiscordWebhookMessageJob;
use App\Order;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendOrderStatusMessageListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $orderId = $event->orderId;
        $order = Order::find($orderId);

        $userFullName = $order->user->name;
        $statusName = $order->status->name;

        $webhook = config('discord.webhooks.status_change');

        $message = "Order nr. {$order->id} van {$userFullName} staat nu op status: {$statusName}";

        SendDiscordWebhookMessageJob::dispatch($webhook, $message);

    }
}
