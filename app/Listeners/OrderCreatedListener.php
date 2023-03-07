<?php

namespace App\Listeners;

use App\Events\OrderCreatedEvent;
use App\Jobs\SendDiscordWebhookMessageJob;
use App\Jobs\SendWhatsappWebhookMessageJob;

class OrderCreatedListener
{
    public function handle(OrderCreatedEvent $event)
    {
        $order = $event->order;
        $user  = $order->user;

        SendDiscordWebhookMessageJob::dispatch(
            config('snackbar.new'),
            "{$user->name} heeft een nieuwe bestelling geplaatst met nr. {$order->id}" . PHP_EOL .
            route('admin.orders.show', ['order' => $order])
        );

        $mentionOrName = "<@{$user->discord_id}>";

        if (! $user->discord_mention) {
            $mentionOrName = $user->name;
        }

        SendDiscordWebhookMessageJob::dispatch(
            config('snackbar.status'),
            "{$mentionOrName} je bestelling met nr. {$order->id} is in goede orde ontvangen"
        );

        if ($user->shouldSendWhatsappMessage()) {
            SendWhatsappWebhookMessageJob::dispatch($user, "Je bestelling met nr. {$order->id} is in goede orde ontvangen");
        }
    }
}
