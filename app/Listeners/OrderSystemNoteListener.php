<?php

namespace App\Listeners;

use App\Events\OrderUpdatedEvent;
use App\Jobs\SendDiscordWebhookMessageJob;

class OrderSystemNoteListener
{
    public function handle(OrderUpdatedEvent $event)
    {
        $order = $event->order;
        $changes = $order->getChanges();

        if (isset($changes['system_note'])) {
            SendDiscordWebhookMessageJob::dispatch(
                config('snackbar.note'),
                "<@{$order->user->discord_id}> er is een notitie op bestelling nr. {$order->id} toegevoegd met: {$order->system_note}"
            );
        }
    }
}
