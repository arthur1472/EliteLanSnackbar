<?php

namespace App\Listeners;

use App\Events\OrderUpdatedEvent;
use App\Jobs\SendDiscordWebhookMessageJob;

class OrderStatusUpdateListener
{
    public function handle(OrderUpdatedEvent $event)
    {
        $order = $event->order;
        $changes = $order->getChanges();

        if (isset($changes['status_id'])) {
            SendDiscordWebhookMessageJob::dispatch(
                config('snackbar.status'),
                "<@{$order->user->discord_id}> je bestelling met nr. {$order->id} heeft nu de status: {$order->status->name}"
            );
        }
    }
}
