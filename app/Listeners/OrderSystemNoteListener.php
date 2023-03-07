<?php

namespace App\Listeners;

use App\Events\OrderUpdatedEvent;
use App\Jobs\SendDiscordWebhookMessageJob;
use App\Jobs\SendWhatsappWebhookMessageJob;

class OrderSystemNoteListener
{
    public function handle(OrderUpdatedEvent $event)
    {
        $order   = $event->order;
        $changes = $order->getChanges();
        $user    = $order->user;

        if (isset($changes['system_note'])) {
            SendDiscordWebhookMessageJob::dispatch(
                config('snackbar.note'),
                "<@{$user->discord_id}> er is een notitie op bestelling nr. {$order->id} toegevoegd met: {$order->system_note}"
            );

            if ($user->shouldSendWhatsappMessage()) {
                SendWhatsappWebhookMessageJob::dispatch($user, "Er is een notitie op bestelling nr. {$order->id} toegevoegd met: {$order->system_note}");
            }
        }
    }
}
