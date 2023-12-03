<?php

namespace App\Console;

use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Epush\Core\Message\App\Contract\MessageServiceContract;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        
        $filePath = storage_path('logs/scheduler.log');
        if (!File::exists($filePath)) {
            File::put($filePath, '');
        }

        $schedule->call(function () use ($filePath) {
            app(MessageServiceContract::class)->sendScheduledMessages();
            $output = "[".Carbon::now()->toDateTimeString()."] local.INFO: Scheduler Executed Successfully";
            File::append($filePath, $output . PHP_EOL);
        })
        ->everyMinute()
        ->name('send_message')
        ->withoutOverlapping()
        ->onFailure(function () use ($filePath) {
            $error = "[".Carbon::now()->toDateTimeString()."] local.ERROR: Scheduler Exception Error";
            File::append($filePath, $error . PHP_EOL);
        });
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
