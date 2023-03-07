<?php

namespace App\Listeners;

use App\Events\OrderUpdatedEvent;
use App\Jobs\SendDiscordWebhookMessageJob;
use App\Jobs\SendWhatsappWebhookMessageJob;

class OrderStatusUpdateListener
{
    public function handle(OrderUpdatedEvent $event)
    {
        $order   = $event->order;
        $changes = $order->getChanges();
        $user    = $order->user;

        if (isset($changes['status_id'])) {
            SendDiscordWebhookMessageJob::dispatch(
                config('snackbar.status'),
                "<@{$user->discord_id}> je bestelling met nr. {$order->id} heeft nu de status: {$order->status->name}"
            );

            if ($user->shouldSendWhatsappMessage()) {
                SendWhatsappWebhookMessageJob::dispatch($user, "Je bestelling met nr. {$order->id} heeft nu de status: {$order->status->name}");
            }
        }
    }
}
