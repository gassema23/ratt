<div>
    <x-app-modal>
        <x-slot name="title">
            @lang('Generator informations')
        </x-slot>
        <x-slot name="content">
            <div class="md:grid md:grid-cols-2 hover:bg-slate-50 md:space-y-0 space-y-1 p-4 border-b">
                <p class="text-slate-600 font-medium">@lang('Generator type')</p>
                <p>{{ $generator->label }}</p>
            </div>
            <div class="md:grid md:grid-cols-2 hover:bg-slate-50 md:space-y-0 space-y-1 p-4 border-b">
                <p class="text-slate-600 font-medium">@lang('Prerequiste')</p>
                <p>{{ $generator->prerequiste }}</p>
            </div>
            <div class="md:grid md:grid-cols-2 hover:bg-slate-50 md:space-y-0 space-y-1 p-4 border-b">
                <p class="text-slate-600 font-medium">@lang('Deployment procedure')</p>
                <p>{{ $generator->deployment_procedure }}</p>
            </div>
            <div class="md:grid md:grid-cols-2 hover:bg-slate-50 md:space-y-0 space-y-1 p-4 border-b">
                <p class="text-slate-600 font-medium">@lang('Emergency contact')</p>
                <p>{{ $generator->emergency_contact }}</p>
            </div>
            <div class="md:grid md:grid-cols-2 hover:bg-slate-50 md:space-y-0 space-y-1 p-4 border-b">
                <p class="text-slate-600 font-medium">@lang('Generator available')</p>
                <p>{{ $generator->generator_available }}</p>
            </div>
        </x-slot>
    </x-app-modal>
</div>
