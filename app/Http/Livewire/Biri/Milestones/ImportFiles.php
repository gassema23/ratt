<?php

namespace App\Http\Livewire\Biri\Milestones;

use App\Traits\HasModal;
use App\Models\BiriMilestone;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ImportFiles extends ModalComponent
{
    use HasModal, AuthorizesRequests, WithFileUploads;

    public $csv_file;
    public $imported = false;

    public function rules()
    {
        return [
            'csv_file' => [
                'required',
                'file',
                'mimes:csv',
            ]
        ];
    }

    public function save()
    {
        $this->validate();
        $path = $this->csv_file->getRealPath();
        $data = array_map('str_getcsv', file($path));
        array_shift($data);
        foreach ($data as $k => $v) {
            BiriMilestone::firstOrCreate([
                'project_no' => $v[0] ?? '',
                'network_header' => $v[1] ?? '',
                'planner_ntwk' => $v[2] ?? '',
                'designer_ntwk' => $v[3] ?? '',
                'designerMgr_ntwk' => $v[4] ?? '',
                'network_no' => $v[5] ?? '',
                'network_header_tech' => $v[6] ?? '',
                'priority' => $v[7] ?? '',
                'active_sys_status' => $v[8] ?? '',
                'active_user_status' => $v[9] ?? '',
                'schedule_end' => $v[10] ?? '',
                'wbs_element' => $v[11] ?? '',
                'label' => $v[12] ?? '',
                'ntwk_type' => $v[13] ?? '',
                'cpr_ntwk' => $v[14] ?? '',
                'crtd_status' => $v[15] ?? '',
                'rfa_status' => $v[16] ?? '',
                'app1_status' => $v[17] ?? '',
                'app2_mist' => $v[18] ?? '',
                'app2_status' => $v[19] ?? '',
                'dapp_mist' => $v[20] ?? '',
                'dapp_status' => $v[21] ?? '',
                'nrtb_mist' => $v[22] ?? '',
                'rtb_status' => $v[23] ?? '',
                'fcom_mist' => $v[24] ?? '',
                'fcom_status' => $v[25] ?? '',
                'cprd_mist' => $v[26] ?? '',
                'nisr_mist' => $v[27] ?? '',
                'nis2_mist' => $v[28] ?? '',
                'rfs_status' => $v[29] ?? '',
                'ncom_mist' => $v[30] ?? '',
                'telco_status' => $v[31] ?? '',
                'crtd_fmo_status' => $v[32] ?? '',
                'rfa_fmo_status' => $v[33] ?? '',
                'rjt_fmo_status' => $v[34] ?? '',
                'appd_fmo_status' => $v[35] ?? '',
                'dcom_fmo_status' => $v[36] ?? '',
                'dapp_fmo_mist' => $v[37] ?? '',
                'dapp_fmo_status' => $v[38] ?? '',
                'rgh_fmo_status' => $v[39] ?? '',
                'nrtb_fmo_mist' => $v[40] ?? '',
                'rtb_fmo_status' => $v[41] ?? '',
                'fcom_fmo_mist' => $v[42] ?? '',
                'fcom_fmo_status' => $v[43] ?? '',
                'cprd_fmo_mist' => $v[44] ?? '',
                'nisr_fmo_mist' => $v[45] ?? '',
                'rfs_fmo_status' => $v[46] ?? '',
                'clos_fmo_status' => $v[47] ?? '',
                'counter' => $v[48] ?? '',
            ]);
        }
    }

    public function render()
    {
        return view('livewire.biri.milestones.import-files');
    }
}
