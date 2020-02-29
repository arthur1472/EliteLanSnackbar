<?php

namespace App\Listeners;

use App\Jobs\SendDiscordWebhookMessageJob;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class OrderAdminNoteUpdateListener
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
        $order = $event->order;
        $changes = $order->getChanges();

        if (isset($changes['admin_note'])) {
            $webhook = config('discord.webhooks.admin_note_change');

            $message = "Notitie op order nr. {$order->id} van {$order->user->name} is aangepast naar: {$order->admin_note}";

            SendDiscordWebhookMessageJob::dispatch($webhook, $message);
        }
    }
}
