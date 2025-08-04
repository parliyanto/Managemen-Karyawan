<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;
use App\Console\Commands\ResetEmployeeStatus;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        ResetEmployeeStatus::class,
    ];

    protected function schedule(Schedule $schedule): void
    {
        Log::info('[🧪 DEBUG] schedule() method dipanggil Laravel');

        $schedule->call(function () {
            Log::info('[🕒 Kernel] Scheduler tick: ' . now());
        })->everyMinute();

        $schedule->command('employee:reset-status')
            ->everyMinute()
            ->before(fn() => Log::info('🚀 [Kernel] Menjalankan command employee:reset-status'))
            ->after(fn() => Log::info('✅ [Kernel] Selesai menjalankan employee:reset-status'));
    }

    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');
        require base_path('routes/console.php');
    }
}
