<div>
    <x-app-modal>
        <x-slot name="title">
            @lang('Alarm catalog')
        </x-slot>
        <x-slot name="content">
            <div class="md:grid md:grid-cols-2 hover:bg-slate-50 md:space-y-0 space-y-1 p-4 border-b">
                <p class="text-slate-600 font-medium">@lang('Alarm type')</p>
                <p>{{ $alarm->type->label }}</p>
            </div>
            <div class="md:grid md:grid-cols-2 hover:bg-slate-50 md:space-y-0 space-y-1 p-4 border-b">
                <p class="text-slate-600 font-medium">@lang('Model')</p>
                <p>{{ $alarm->model }}</p>
            </div>
            <div class="md:grid md:grid-cols-2 hover:bg-slate-50 md:space-y-0 space-y-1 p-4 border-b">
                <p class="text-slate-600 font-medium">@lang('Item number')</p>
                <p>{{ $alarm->item_number }}</p>
            </div>
            <div class="md:grid md:grid-cols-2 hover:bg-slate-50 md:space-y-0 space-y-1 p-4 border-b">
                <p class="text-slate-600 font-medium">@lang('Informations')</p>
                <p>{{ $alarm->description }}</p>
            </div>
            <div class="md:grid md:grid-cols-2 hover:bg-slate-50 md:space-y-0 space-y-1 p-4 border-b">
                <p class="text-slate-600 font-medium">@lang('Severity')</p>
                <p>{{ $alarm->severity->label }}</p>
            </div>
            <div class="md:grid md:grid-cols-2 hover:bg-slate-50 md:space-y-0 space-y-1 p-4 border-b">
                <p class="text-slate-600 font-medium">@lang('CTL')</p>
                <p>{{ $alarm->ctl }}</p>
            </div>
            <div class="md:grid md:grid-cols-2 hover:bg-slate-50 md:space-y-0 space-y-1 p-4 border-b">
                <p class="text-slate-600 font-medium">@lang('Verb 1')</p>
                <p>{{ $alarm->verb1 }}</p>
            </div>
            <div class="md:grid md:grid-cols-2 hover:bg-slate-50 md:space-y-0 space-y-1 p-4 border-b">
                <p class="text-slate-600 font-medium">@lang('Verb 2')</p>
                <p>{{ $alarm->verb2 }}</p>
            </div>
            <div class="md:grid md:grid-cols-2 hover:bg-slate-50 md:space-y-0 space-y-1 p-4 border-b">
                <p class="text-slate-600 font-medium">@lang('I/O terminal')</p>
                <p>{{ $alarm->io_terminal }}</p>
            </div>
            <div class="md:grid md:grid-cols-2 hover:bg-slate-50 md:space-y-0 space-y-1 p-4 border-b">
                <p class="text-slate-600 font-medium">@lang('Document code')</p>
                <p>{{ $alarm->document_code }}</p>
            </div>
        </x-slot>
    </x-app-modal>
</div>
