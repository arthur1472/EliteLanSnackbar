<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendDiscordWebhookMessageJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public string $webhook, public string $message)
    {
    }

    public function handle()
    {
        $options = [
            'username' => 'SnackBarBot',
        ];
        $this->postToDiscord($this->message, $this->webhook, $options);
    }

    private function postToDiscord($message, $webhook, $options = [])
    {
        $data = [
            'content' => $message,
        ];

        $curl = curl_init($webhook);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');

        if (isset($options['username'])) {
            $data['username'] = $options['username'];
        }

        if (isset($options['avatar_url'])) {
            $data['avatar_url'] = $options['avatar_url'];
        }

        $data = json_encode($data);

        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Content-Length: '.strlen($data), ]
        );

        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        return curl_exec($curl);
    }
}
