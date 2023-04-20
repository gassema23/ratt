<?php

namespace App\Traits;

use WireUi\Traits\Actions;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

trait HasDelete
{
    use Actions, AuthorizesRequests;
    public function confirm($id)
    {
        $this->dialog()->confirm([
            'title'       => trans('Are you sure?'),
            'description' => trans('Are you sure you want to deactivate this item? This action cannot be undone.'),
            'icon'        => 'error',
            'accept'      => [
                'label'  => trans('Yes, delete it'),
                'method' => 'destroy',
                'params' => $id
            ],
            'close' => [
                'label'  => trans('Cancel'),
            ],
        ]);
    }


    public function destroy($id)
    {
        $delete = $this->model::findOrFail($id);
        $this->notification()->send([
            'title' => trans('Success'),
            'description' => trans('Data deactivate successfully!'),
            'icon' => 'success'
        ]);
        $delete->delete();
        $this->emitSelf($this->emits);
    }
}
