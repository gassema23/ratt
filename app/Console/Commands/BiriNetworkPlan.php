<?php

namespace App\Console\Commands;

use SplFileInfo;
use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Models\BiriNetworkPlan as ModelBiriNetworkPlan;

class BiriNetworkPlan extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'csv:import-PS50';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import PS50 csv file daily';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $files = glob(public_path() . '/BIRI/PS50/*.csv');
        usort($files, function ($a, $b) {
            return filemtime($b) - filemtime($a);
        });
        if (count($files) <= 0) {
            return $this->error('No CSV file detect in ' . public_path() . '/BIRI/PS50/');
        }
        $latestFile = $files[0];
        $fileInfo = new SplFileInfo($latestFile);
        $filename = $fileInfo->getFilename();
        $path = $fileInfo->getPath();
        $handle = fopen($latestFile, "r");
        if ($handle !== FALSE) {
            for ($i = 0; $i < 16; $i++) {
                fgets($handle);
            }
            $this->line('Start importing data. Please wait...');
            while (($data = fgetcsv($handle, 10000, ",")) !== FALSE) {
                $task = new ModelBiriNetworkPlan;
                $task->project = $data[1];
                $task->network = $data[2];
                $task->network_name = $data[3];
                $task->network_activity = $data[4];
                $task->work_center = $data[5];
                $task->wc_name = $data[6];
                $task->plan = $data[8];
                $task->actual = $data[9];
                $task->save();
            }
            fclose($handle);
            $archiveFolder = public_path() . '/BIRI/PS50/Archives';
            $newPath = $archiveFolder . '/' . Carbon::parse(now())->timestamp . '_Archives_' . $filename;
            $this->line('File has been move to ' . $newPath);
            rename($latestFile, $newPath);
        }
        return $this->info('The command was successful!');
    }
}
