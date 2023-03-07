<?php

namespace App\Jobs;

use App\Models\PhoneVerification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class DeleteExpiredPhoneVerificationCodesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    {
        $phoneVerifications = PhoneVerification::expired()->get();
        foreach ($phoneVerifications as $phoneVerification) {
            $phoneVerification->delete();
        }
    }
}
