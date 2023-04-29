<div>
    <div class="divide-y divide-slate-200">
        <h2 class="font-medium pb-2 text-slate-600">@lang('Checklist')</h2>
        <div>
            <ul class="flex flex-col divide-y divide-slate-200 text-sm">
                @forelse ($checklists as $checklist)
                    <li class="inline-flex items-center py-1.5 font-medium text-slate-400">
                        @if ($checklist->status <= 0)
                            <div class="flex justify-between w-full items-center align-middle">
                                <div>
                                    @can('checklist-delete')
                                        <x-button squared xs negative flat icon="x"
                                            wire:click.prevent="delete({{ $checklist->id }})" />
                                    @endcan
                                    <x-button squared xs teal flat icon="check"
                                        wire:click.prevent="check({{ $checklist->id }})"
                                        :wire:key="'checklist-'.$checklist->id" />
                                    {{ $checklist->name }}
                                </div>
                                <div class="font-normal text-xs">
                                    @lang('Created on :date', ['date' => $checklist->updated_at])
                                </div>
                            </div>
                        @else
                            <div class="flex justify-between w-full items-center align-middle">
                                <div>
                                    <x-badge squared teal :label="trans('Complete')" />
                                    {{ $checklist->name }}
                                </div>
                                <div class="ml-4 font-normal text-xs">
                                    @lang('Completed on :date', ['date' => $checklist->updated_at])
                                </div>
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
                    <div class="mb-2 grid grid-cols-1">
                        <x-input :label="trans('Title')" :placeholder="'Checklist title'" wire:model.defer="newChecklistState.name">
                            <x-slot name="append">
                                <div class="absolute inset-y-0 right-0 flex items-center p-0.5">
                                    <x-button class="h-full rounded-r-md" icon="check" positive flat squared
                                        wire:click="postChecklist" spinner />
                                </div>
                            </x-slot>
                        </x-input>
                    </div>
                </form>
            </div>
        @endcan
    </div>
</div>
