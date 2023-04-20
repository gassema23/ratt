@props([
    'is_modal' => true,
])
<div class="w-full">
    @if (isset($title))
        <div class="p-4 mb-4 border-b border-slate-200 flex justify-between items-center content-center">
            <div>
                <h3 class="text-lg font-medium leading-6 text-slate-900" id="modal-title">
                    {{ $title }}
                </h3>
            </div>
            @if ($is_modal)
                <div>
                    <x-button.circle type="button" squared spinner="close" icon="x" wire:click="close" />
                </div>
            @endif
        </div>
    @endif
    @if (isset($content))
        <div class="px-4 w-full">
            {{ $content }}
        </div>
    @endif
    @if (isset($action))
        <div class="px-6 py-4 border-t border-slate-200 bg-slate-100 justify-end flex space-x-2">
            {{ $action }}
        </div>
    @endif
</div>
