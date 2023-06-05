<div>
    <x-app-modal>
        <x-slot name="title">
            @lang('Alarm system')
        </x-slot>
        <x-slot name="content">
            <div class="md:grid md:grid-cols-2 hover:bg-slate-50 md:space-y-0 space-y-1 p-4 border-b">
                <p class="text-slate-600 font-medium">@lang('Network element')</p>
                <p>{{$alarm->network_element}}</p>
            </div>
            <div class="md:grid md:grid-cols-2 hover:bg-slate-50 md:space-y-0 space-y-1 p-4 border-b">
                <p class="text-slate-600 font-medium">@lang('Site clli')</p>
                <p>{{$alarm->site->clli}}</p>
            </div>
            <div class="md:grid md:grid-cols-2 hover:bg-slate-50 md:space-y-0 space-y-1 p-4 border-b">
                <p class="text-slate-600 font-medium">@lang('Localization number')</p>
                <p>{{$alarm->location_number}}</p>
            </div>
            <div class="md:grid md:grid-cols-2 hover:bg-slate-50 md:space-y-0 space-y-1 p-4 border-b">
                <p class="text-slate-600 font-medium">@lang('System type')</p>
                <p>{{$alarm->systemType->label}}</p>
            </div>
            <div class="md:grid md:grid-cols-2 hover:bg-slate-50 md:space-y-0 space-y-1 p-4 border-b">
                <p class="text-slate-600 font-medium">@lang('IPv4 address')</p>
                <p>{{$alarm->ipv4}}</p>
            </div>
            <div class="md:grid md:grid-cols-2 hover:bg-slate-50 md:space-y-0 space-y-1 p-4 border-b">
                <p class="text-slate-600 font-medium">@lang('Description')</p>
                <p>{{$alarm->description}}</p>
            </div>
        </x-slot>
    </x-app-modal>
</div>
