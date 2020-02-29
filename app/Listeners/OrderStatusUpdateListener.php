<?php

namespace App\Listeners;

use App\Events\OrderUpdatedEvent;
use App\Jobs\SendDiscordWebhookMessageJob;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class OrderStatusUpdateListener
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
     * @param OrderUpdatedEvent $event
     * @return void
     */
    public function handle(OrderUpdatedEvent $event)
    {
        $order = $event->order;
        $changes = $order->getChanges();

        if (isset($changes['status_id'])) {
            $webhook = config('discord.webhooks.status_change');

            $message = "Order nr. {$order->id} van {$order->user->name} staat nu op status: {$order->status->name}";

            SendDiscordWebhookMessageJob::dispatch($webhook, $message);
        }
    }
}
