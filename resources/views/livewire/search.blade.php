<div>
    <x-card>
        <x-input :label="trans('Search')" :placeholder="trans('Search for project, etc...')">
            <x-slot name="append">
                <div class="absolute inset-y-0 right-0 flex items-center p-0.5">
                    <x-button class="h-full rounded-r-md" icon="search" slate flat squared />
                </div>
            </x-slot>
        </x-input>
        <div class="my-4 border-t-2 border-x-slate-200 py-4">
            <div class="font-medium text-xl">@lang('Search results')</div>
        </div>
    </x-card>
</div>
