<?php

namespace App\Http\Livewire\Biri\Assignments;

use App\Models\User;
use App\Traits\HasModal;
use App\Models\BiriEquipment;
use App\Models\BiriTechnology;
use App\Models\BiriIsqMasterData;
use App\Models\BiriCategoryActivity;
use LivewireUI\Modal\ModalComponent;
use App\Http\Requests\BiriAssignmentRequest;
use App\Models\BiriAssignment;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Assign extends ModalComponent
{
    use HasModal, AuthorizesRequests;

    public $emits = [
        'refresh'
    ];

    public BiriIsqMasterData $isq;
    public $desn,
        $tech_biri,
        $technologies,
        $activities,
        $equipments,
        $desn_user_id,
        $desn_req,
        $tech_user_id,
        $fich_eng_req,
        $fox_order,
        $priority,
        $technology_id,
        $equipment_id,
        $activity_id;

    public function mount(BiriIsqMasterData $isq)
    {
        $this->isq = $isq;
        $this->desn = User::where('desn', 1)->select('id', 'name')->get();
        $this->tech_biri = User::where('tech_biri', 1)->orderBy('name')->select('id', 'name')->get();
        $this->technologies = BiriTechnology::orderBy('label')->select('id', 'label')->get();
        $this->activities = BiriCategoryActivity::orderBy('label')->select('id', 'label')->get();
        $this->equipments = BiriEquipment::orderBy('label')->select('id', 'label')->get();
    }

    protected function rules()
    {
        return (new BiriAssignmentRequest())->rules();
    }

    public function save()
    {
        $this->authorize('biri-category-activities-update');
        $this->validate();
        $assign = BiriAssignment::create([
            'desn_user_id' => $this->desn_user_id,
            'tech_user_id' => $this->tech_user_id,
            'network_no' => $this->isq->network_no,
            'fox_order' => $this->fox_order ?? '',
            'priority' => $this->priority,
            'technology_id' => $this->technology_id,
            'equipment_id' => $this->equipment_id,
            'activity_id' => $this->activity_id,
            'equipment_id' => $this->desn_req,
            'equipment_id' => $this->fich_eng_req,
        ]);
        $this->saved();
    }

    public function render()
    {
        return view('livewire.biri.assignments.assign');
    }
}
