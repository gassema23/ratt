<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-4">
    @can('projects-viewAny', 'scenarios-viewAny', 'tasks-viewAny')
        <x-card>
            <div class="flex flex-col justify-between h-full">
                <div class="mb-4 flex justify-between">
                    <div>
                        <h4 class="font-bold text-xl uppercase text-slate-800">
                            @lang('RATT')
                        </h4>
                        <p class="">
                            @lang('Reliability assessment tracking tool')
                        </p>
                        <p class="text-xs text-slate-500">
                            @lang('Description here...')
                        </p>
                    </div>
                    <div>
                        <div class="p-1 w-8 h-8 align-middle rounded-full bg-slate-900 shadow-sm">
                            <img src="{{ asset('favicon/favicon-32x32.png') }}" alt="" class="w-full">
                        </div>
                    </div>
                </div>
                <div class="flex justify-end">
                    <x-button squared xs :label="trans('Go to dashboard')" href="{{ route('admin.ratt.dashboard') }}" />
                </div>
            </div>
        </x-card>
    @endcan
    @if (config('app.env') != 'production' &&
            auth()->user()->hasRole('Super-Admin'))
        <x-card>
            <div class="flex flex-col justify-between h-full">
                <div class="mb-4 flex justify-between">
                    <div>
                        <h4 class="font-bold text-xl uppercase text-slate-800">
                            @lang('BEAT')
                        </h4>
                        <p class="">
                            @lang('TELUS Location and Alarms Database')
                        </p>
                        <p class="text-xs text-slate-500">
                            @lang('Allows you to view and edit information about TELUS alarms')
                        </p>
                    </div>
                    <div>
                        <div class="p-1 w-8 h-8 align-middle rounded-full bg-green-500 text-slate-50 shadow-sm">
                            <x-icon name="office-building" class="w-full" />
                        </div>
                    </div>
                </div>
                <div class="flex justify-end">
                    <x-button squared xs :label="trans('Go to dashboard')" href="{{ route('admin.beat.dashboard') }}" />
                </div>
            </div>
        </x-card>
    @endif
    @can('documentations-viewAny', 'categories-viewAny')
        <x-card>
            <div class="flex flex-col justify-between h-full">
                <div class="mb-4 flex justify-between">
                    <div>
                        <h4 class="font-bold text-xl uppercase text-slate-800">
                            @lang('Documentations')
                        </h4>
                        <p class="">
                        </p>
                        <p class="text-xs text-slate-500">
                            @lang('Documentations list for BIRI team\'s')
                        </p>
                    </div>
                    <div>
                        <div class="p-1 w-8 h-8 align-middle rounded-full bg-cyan-500 text-slate-50 shadow-sm">
                            <x-icon name="clipboard-list" class="w-full" />
                        </div>
                    </div>
                </div>
                <div class="flex justify-end">
                    <x-button squared xs :label="trans('Go to documentation')" heref="{{ route('admin.documentations.index') }}" />
                </div>
            </div>
        </x-card>
    @endcan
</div>
