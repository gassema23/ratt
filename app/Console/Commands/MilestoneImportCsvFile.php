<?php

namespace App\Console\Commands;

use App\Models\BiriMilestone;
use SplFileInfo;
use Carbon\Carbon;
use Illuminate\Console\Command;

class MilestoneImportCsvFile extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'csv:import-PS44B';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import PS44B csv file daily';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $files = glob(public_path() . '/BIRI/PS44B/*.csv');
        usort($files, function ($a, $b) {
            return filemtime($b) - filemtime($a);
        });
        if(count($files) <= 0){
            return $this->error('No CSV file detect in '.public_path() . '/BIRI/PS44B/');
         }
        $latestFile = $files[0];
        $fileInfo = new SplFileInfo($latestFile);
        $filename = $fileInfo->getFilename();
        $path = $fileInfo->getPath();
        $handle = fopen($latestFile, "r");
        if ($handle !== FALSE) {
            for ($i = 0; $i < 12; $i++) {
                fgets($handle);
            }
            $this->line('Start importing data. Please wait...');
            while (($data = fgetcsv($handle, 10000, ",")) !== FALSE) {
                $task = new BiriMilestone;
                $task->project = $data[0];
                $task->title = $data[1];
                $task->planner_ntwk = $data[2];
                $task->designer_ntwk = $data[3];
                $task->designer_mgr_ntwk = $data[4];
                $task->network = $data[5];
                $task->sap_header = $data[6];
                $task->priority = $data[7];
                $task->system_status = $data[8];
                $task->user_status = $data[9];
                $task->sheduled_finish = !strtotime($data[10]) ? null : Carbon::createFromFormat('Y-m-d', $data[10]);
                $task->wbs_element = $data[11];
                $task->technology = $data[12];
                $task->ntwk_type = $data[13];
                $task->cpr_ntwk = $data[14];
                $task->crtd_status = !strtotime($data[15]) ? null : Carbon::createFromFormat('Y-m-d', $data[15]);
                $task->rfa_status = !strtotime($data[16]) ? null : Carbon::createFromFormat('Y-m-d', $data[16]);
                $task->app1_status = !strtotime($data[17]) ? null : Carbon::createFromFormat('Y-m-d', $data[17]);
                $task->app2_mist = !strtotime($data[18]) ? null : Carbon::createFromFormat('Y-m-d', $data[18]);
                $task->app2_status = !strtotime($data[19]) ? null : Carbon::createFromFormat('Y-m-d', $data[19]);
                $task->dapp_mist = !strtotime($data[20]) ? null : Carbon::createFromFormat('Y-m-d', $data[20]);
                $task->dapp_status = !strtotime($data[21]) ? null : Carbon::createFromFormat('Y-m-d', $data[21]);
                $task->nrtb_mist = !strtotime($data[22]) ? null : Carbon::createFromFormat('Y-m-d', $data[22]);
                $task->rtb_status = !strtotime($data[23]) ? null : Carbon::createFromFormat('Y-m-d', $data[23]);
                $task->fcom_mist = !strtotime($data[24]) ? null : Carbon::createFromFormat('Y-m-d', $data[24]);
                $task->fcom_status = !strtotime($data[25]) ? null : Carbon::createFromFormat('Y-m-d', $data[25]);
                $task->cprd_mist = !strtotime($data[26]) ? null : Carbon::createFromFormat('Y-m-d', $data[26]);
                $task->nisr_mist = !strtotime($data[27]) ? null : Carbon::createFromFormat('Y-m-d', $data[27]);
                $task->nis2_mist = !strtotime($data[28]) ? null : Carbon::createFromFormat('Y-m-d', $data[28]);
                $task->rfs_status = !strtotime($data[29]) ? null : Carbon::createFromFormat('Y-m-d', $data[29]);
                $task->ncom_mist = !strtotime($data[30]) ? null : Carbon::createFromFormat('Y-m-d', $data[30]);
                $task->teco_status = !strtotime($data[31]) ? null : Carbon::createFromFormat('Y-m-d', $data[31]);
                $task->crtd_fmo_status = !strtotime($data[32]) ? null : Carbon::createFromFormat('Y-m-d', $data[32]);
                $task->rfa_fmo_status = !strtotime($data[33]) ? null : Carbon::createFromFormat('Y-m-d', $data[33]);
                $task->rjt_fmo_status = !strtotime($data[34]) ? null : Carbon::createFromFormat('Y-m-d', $data[34]);
                $task->appd_fmo_status = !strtotime($data[35]) ? null : Carbon::createFromFormat('Y-m-d', $data[35]);
                $task->dcom_fmo_status = !strtotime($data[36]) ? null : Carbon::createFromFormat('Y-m-d', $data[36]);
                $task->dapp_fmo_mist = !strtotime($data[37]) ? null : Carbon::createFromFormat('Y-m-d', $data[37]);
                $task->dapp_fmo_status = !strtotime($data[38]) ? null : Carbon::createFromFormat('Y-m-d', $data[38]);
                $task->rgh_fmo_status = !strtotime($data[39]) ? null : Carbon::createFromFormat('Y-m-d', $data[39]);
                $task->nrtb_fmo_mist = !strtotime($data[40]) ? null : Carbon::createFromFormat('Y-m-d', $data[40]);
                $task->rtb_fmo_status = !strtotime($data[41]) ? null : Carbon::createFromFormat('Y-m-d', $data[41]);
                $task->fcom_fmo_mist = !strtotime($data[42]) ? null : Carbon::createFromFormat('Y-m-d', $data[42]);
                $task->fcom_fmo_status = !strtotime($data[43]) ? null : Carbon::createFromFormat('Y-m-d', $data[43]);
                $task->cprd_fmo_mist = !strtotime($data[44]) ? null : Carbon::createFromFormat('Y-m-d', $data[44]);
                $task->nisr_fmo_mist = !strtotime($data[45]) ? null : Carbon::createFromFormat('Y-m-d', $data[45]);
                $task->rfs_fmo_status = !strtotime($data[46]) ? null : Carbon::createFromFormat('Y-m-d', $data[46]);
                $task->clos_fmo_status = !strtotime($data[47]) ? null : Carbon::createFromFormat('Y-m-d', $data[47]);
                $task->counter = $data[48];
                $task->save();
            }
            fclose($handle);
            $archiveFolder = public_path() . '/BIRI/PS44B/Archives';
            $newPath = $archiveFolder . '/' . Carbon::parse(now())->timestamp . '_Archives_' . $filename;
            $this->line('File has been move to ' . $newPath);
            rename($latestFile, $newPath);
        }
        return $this->info('The command was successful!');
    }
}
