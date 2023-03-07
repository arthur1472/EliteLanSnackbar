<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class SendWhatsappWebhookMessageJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public readonly User   $user,
        public readonly string $message
    )
    {
    }

    public function handle()
    {
        if (! $this->user->phone_number) {
            return;
        }

        $whatsappAuthenticationKey = config('services.whatsapp.authentication_key');

        $request = Http::withHeaders([
            'Authorization' => "Bearer {$whatsappAuthenticationKey}",
            'Accept'        => 'application/json',
        ])->post(config('services.whatsapp.url'), [
            'number'  => $this->user->phone_number,
            'message' => $this->message,
            'name'    => $this->user->name,
        ]);
    }


}
