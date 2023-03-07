<?php

namespace App\Console;

use App\Jobs\CleanOldCartLineItemsJob;
use App\Jobs\DeleteExpiredPhoneVerificationCodesJob;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->job(CleanOldCartLineItemsJob::class)->everyMinute();
        $schedule->job(DeleteExpiredPhoneVerificationCodesJob::class)->everyMinute();
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
