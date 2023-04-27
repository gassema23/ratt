<div>
    <x-app-modal>
        <form wire:submit.prevent="save">
            <x-slot name="title">
                @lang('Update :name', ['name' => $networkTask->task->name])
            </x-slot>
            <x-slot name="content">
                <x-errors class="my-2" />
                <div class="my-2 grid grid-cols-3 gap-4">
                    <x-input type="date" wire:model.defer="networkTask.due_date" :label="trans('Due date')" />
                    <x-native-select :placeholder="trans('Make a selection')" :options="config('biri.App_priority.' . App::getLocale())" wire:model.defer="networkTask.priority"
                        option-value="id" option-label="name" :label="trans('Priority')" />
                    <x-select wire:model.defer="status" :options="config('biri.App_statuses.' . App::getLocale())" option-value="id" autocomplete="off"
                        option-label="name" :placeholder="trans('Make a selection')" :label="trans('Status')" />
                </div>
                <div class="my-2">
                    <x-textarea wire:model.defer="reason" :label="trans('Reason')" />
                </div>
            </x-slot>
            <x-slot name="action">
                <x-button type="button" wire:click.prevent="delete" squared negative spinner="delete" :label="trans('Delete')" />
                <x-button type="button" wire:click.prevent="save" squared positive spinner="save" :label="trans('Save')" />
            </x-slot>
        </form>
    </x-app-modal>
</div>
