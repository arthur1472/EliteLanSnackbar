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
            $mentionOrName = "<@{$user->discord_id}>";

            if (! $user->discord_mention) {
                $mentionOrName = $user->name;
            }

            SendDiscordWebhookMessageJob::dispatch(
                config('snackbar.status'),
                "{$mentionOrName} je bestelling met nr. {$order->id} heeft nu de status: {$order->status->name}"
            );

            if ($user->shouldSendWhatsappMessage()) {
                SendWhatsappWebhookMessageJob::dispatch($user, "Je bestelling met nr. {$order->id} heeft nu de status: {$order->status->name}");
            }
        }
    }
}
