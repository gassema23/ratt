<div>
    <x-app-modal>
        <form wire:submit.prevent="save">
            <x-slot name="title">
                {{ trans('Update :name', ['name' => $scenario->name]) }}
            </x-slot>
            <x-slot name="content">
                <x-errors class="my-2 " />
                <div class="my-2 grid grid-cols-2 gap-4">
                    <x-input wire:model.defer="scenario.name.en" :label="trans('Scenario name [EN]')" :hint="trans('Field required')" />
                    <x-input wire:model.defer="scenario.name.fr" :label="trans('Scenario name [FR]')" />
                </div>
                <div class="my-2 grid grid-cols-3 gap-4">
                    @foreach ($teams as $team)
                        <div>
                            <div class="font-medium mb-2">{{ $team->name }}</div>
                            @foreach ($team->tasks as $task)
                                <x-checkbox id="{{ $task->id }}" :label="$task->name"
                                    wire:model.defer="task_id.{{ $task->id }}" value="{{ $task->id }}" />
                            @endforeach
                        </div>
                    @endforeach
                </div>
                <div class="grid grid-cols-1 gap-2 my-2">
                    <x-textarea wire:model.defer="scenario.description.en" :label="__('Description [EN]')" />
                    <x-textarea wire:model.defer="scenario.description.fr" :label="__('Description [FR]')" />
                </div>
            </x-slot>
            <x-slot name="action">
                <x-button type="button" wire:click.prevent="save" squared positive spinner="save" :label="trans('Save')" />
            </x-slot>
        </form>
    </x-app-modal>
</div>
