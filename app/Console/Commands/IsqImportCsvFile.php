<?php

namespace App\Console\Commands;

use App\Models\BiriIsq;
use SplFileInfo;
use Carbon\Carbon;
use Illuminate\Console\Command;

class IsqImportCsvFile extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'csv:import-ISQ003';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import ISQ003 csv file daily';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $files = glob(public_path() . '/BIRI/ISQ003/*.csv');
        usort($files, function ($a, $b) {
            return filemtime($b) - filemtime($a);
        });
        if(count($files) <= 0){
            return $this->error('No CSV file detect in '.public_path() . '/BIRI/ISQ003/');
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
                $task = new BiriIsq;
                $task->network = $data[0];
                $task->sap_header = $data[1];
                $task->order_type = $data[2];
                $task->plant = $data[3];
                $task->project_definition = $data[4];
                $task->created_on = !strtotime($data[5]) ? null : Carbon::createFromFormat('Y-m-d', $data[5]) ?? '';
                $task->scheduled_start = !strtotime($data[6]) ? null : Carbon::createFromFormat('Y-m-d', $data[6]) ?? '';
                $task->scheduled_finish = !strtotime($data[7]) ? null : Carbon::createFromFormat('Y-m-d', $data[7]) ?? '';
                $task->system_status = $data[8];
                $task->user_status = $data[9];
                $task->changed_on = !strtotime($data[10]) ? null : Carbon::createFromFormat('Y-m-d', $data[10]);
                $task->planner_1 = $data[11];
                $task->planner_2 = $data[12];
                $task->planning_manager = $data[13];
                $task->counter = $data[14];
                $task->save();
            }
            fclose($handle);
            $archiveFolder = public_path() . '/BIRI/ISQ003/Archives';
            $newPath = $archiveFolder . '/' . Carbon::parse(now())->timestamp . '_Archives_' . $filename;
            $this->line('File has been move to ' . $newPath);
            rename($latestFile, $newPath);
        }
        return $this->info('The command was successful!');
    }
}
