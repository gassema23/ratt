<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{

    protected $commands = [
        \App\Console\Commands\MySqlDump::class,
        \App\Console\Commands\IsqImportCsvFile::class,
        \App\Console\Commands\MilestoneImportCsvFile::class,
        \App\Console\Commands\BiriNetworkPlan::class,
    ];
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        $schedule->command('backup:clean')->daily()->at('01:00');
        $schedule->command('backup:run')->daily()->at('01:30');

        $schedule->command('csv:import-ISQ003')
            ->daily()
            ->at('01:30')
            ->runInBackground()
            ->evenInMaintenanceMode()
            ->emailOutputTo('mathieu.gasse2@telus.com')
            ->emailOutputOnFailure('mathieu.gasse2@telus.com');

        $schedule->command('csv:import-PS44B')
            ->daily()
            ->at('01:30')
            ->runInBackground()
            ->evenInMaintenanceMode()
            ->emailOutputTo('mathieu.gasse2@telus.com')
            ->emailOutputOnFailure('mathieu.gasse2@telus.com');

        $schedule->command('csv:import-PS50')
            ->daily()
            ->at('01:30')
            ->runInBackground()
            ->evenInMaintenanceMode()
            ->emailOutputTo('mathieu.gasse2@telus.com')
            ->emailOutputOnFailure('mathieu.gasse2@telus.com');
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');
        require base_path('routes/console.php');
    }
}
