<div>
    <div class="divide-y divide-slate-200">
        <div class="p-4">
            <h2 class="text-lg font-medium text-slate-900">@lang('Checklist')</h2>
        </div>
        <div class="p-4">
            <ul class="flex flex-col divide-y divide-slate-200 text-sm">
                @forelse ($checklists as $checklist)
                    <li class="inline-flex items-center px-1 py-1.5 font-medium text-slate-400">
                        @if ($checklist->status <= 0)
                            <div class="flex justify-between w-full items-center align-middle">
                                <div>
                                    @can('checklist-delete')
                                        <x-button squared sm negative flat icon="x"
                                            wire:click.prevent="delete({{ $checklist->id }})" />
                                    @endcan
                                    <x-button squared sm teal flat icon="check"
                                        wire:click.prevent="check({{ $checklist->id }})"
                                        :wire:key="'checklist-'.$checklist->id" />
                                    {{ $checklist->name }}
                                </div>
                                <div class="ml-4 font-normal text-xs">@lang('Created on :date', ['date' => $checklist->updated_at])</div>
                            </div>
                        @else
                            <div class="flex justify-between w-full items-center align-middle">
                                <div>
                                    <x-badge squared teal :label="trans('Complete')" />
                                    {{ $checklist->name }}
                                </div>
                                <div class="ml-4 font-normal text-xs">@lang('Completed on :date', ['date' => $checklist->updated_at])</div>
                            </div>
                        @endif
                    </li>
                @empty
                    <li class="inline-flex items-center gap-x-2 py-1.5 font-medium text-slate-400">
                        @lang('No checklist yet.')
                    </li>
                @endforelse
            </ul>
            {{ $checklists->links() }}
        </div>
        @can('checklist-create')
            <div class="p-4 w-full bg-slate-50 ">
                <form wire:submit.prevent="postChecklist">
                    <div class="my-2 grid grid-cols-2 gap-4">
                        <x-input wire:model.defer="newChecklistState.name.en" :label="trans('Title [EN]')" class="w-full" />
                        <x-input wire:model.defer="newChecklistState.name.fr" :label="trans('Title [FR]')" class="w-full" />
                    </div>
                    <div class="grid p-4 justify-items-end">
                        <x-button xs squared positive wire:click="postChecklist" :label="trans('Save')" spinner />
                    </div>
                </form>
            </div>
        @endcan
    </div>
</div>
