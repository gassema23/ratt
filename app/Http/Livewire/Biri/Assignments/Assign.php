<?php

namespace App\Http\Livewire\Biri\Assignments;

use App\Models\User;
use App\Traits\HasModal;
use App\Models\BiriEquipment;
use App\Models\BiriAssignment;
use App\Models\BiriTechnology;
use App\Models\BiriIsqMasterData;
use App\Models\BiriCategoryActivity;
use LivewireUI\Modal\ModalComponent;
use App\Http\Requests\BiriAssignmentRequest;
use App\Models\BiriActivity;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Pestopancake\LaravelBackpackNotifications\Notifications\DatabaseNotification;

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
        $category_activities,
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
        $category_activity_id,
        $activity_id;

    public function mount(BiriIsqMasterData $isq)
    {
        $this->isq = $isq;
        $this->desn = User::where('desn', 1)->select('id', 'name')->get();
        $this->tech_biri = User::where('tech_biri', 1)->orderBy('name')->select('id', 'name')->get();
        $this->technologies = BiriActivity::has('technology')->groupBy('technology_id')->get();
    }

    public function updatedTechnologyId($value)
    {
        $this->reset(['activity_id', 'category_activity_id', 'activities', 'category_activities', 'equipment_id', 'equipments']);
        $this->equipments = BiriActivity::has('equipment')
            ->where('technology_id', $value)
            ->groupBy('equipment_id')
            ->get();
    }

    public function updatedEquipmentId($value)
    {
        $this->reset(['activity_id', 'category_activity_id', 'activities', 'category_activities']);
        $this->category_activities = BiriActivity::has('category')
            ->where('technology_id', $this->technology_id)
            ->where('equipment_id', $value)
            ->groupBy('category_id')
            ->get();
    }

    public function updatedCategoryActivityId($value)
    {
        $this->activities = BiriActivity::orderBy('description')
            ->select('id', 'description')
            ->where('category_id', $value)
            ->where('equipment_id', $this->equipment_id)
            ->where('technology_id', $this->technology_id)
            ->get();
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
            'activity_id' => $this->activity_id,
            'desn_req' => $this->desn_req,
            'fich_eng_req' => $this->fich_eng_req,
        ]);

        $assign->desnTech->notify(new DatabaseNotification(
            $type = 'info',
            $message = trans('New assignation from ') . auth()->user()->name,
            $messageLong =  trans(' view complete details of network [:number]', ['number' => $this->isq->network_no]),
            $created_by = auth()->user(),
            //$href = '/admin/ratt/networks/show/' . $network->id,
            //$hrefText = trans('View')
        ));

        $assign->tech->notify(new DatabaseNotification(
            $type = 'info',
            $message = trans('New assignation from ') . auth()->user()->name,
            $messageLong =  trans(' view complete details of network [:number]', ['number' => $this->isq->network_no]),
            $created_by = auth()->user(),
            //$href = '/admin/ratt/networks/show/' . $network->id,
            //$hrefText = trans('View')
        ));

        $this->saved();
    }

    public function render()
    {
        return view('livewire.biri.assignments.assign');
    }
}
