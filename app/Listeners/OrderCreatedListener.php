<?php

namespace App\Listeners;

use App\Events\OrderCreatedEvent;
use App\Events\OrderUpdatedEvent;
use App\Jobs\SendDiscordWebhookMessageJob;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class OrderCreatedListener
{
    public function handle(OrderCreatedEvent $event)
    {
        $order   = $event->order;

        SendDiscordWebhookMessageJob::dispatch(
            config('snackbar.new'),
            "{$order->user->name} heeft een nieuwe bestelling geplaatst met nr. {$order->id}".PHP_EOL.route('login')
        );

        SendDiscordWebhookMessageJob::dispatch(
            config('snackbar.status'),
            "<@{$order->user->discord_id}> je bestelling met nr. {$order->id} is in goede orde ontvangen"
        );
    }
}
