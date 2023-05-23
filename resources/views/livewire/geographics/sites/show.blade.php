<div>
    <x-app-modal>
        <x-slot name="title">
            {{ $site->name }}
            <span class="text-sm text-slate-500 font-normal uppercase"> / {{ $site->clli }}</span>
        </x-slot>
        <x-slot name="content">
            <div class="md:grid md:grid-cols-2 hover:bg-slate-50 md:space-y-0 space-y-1 p-4 border-b">
                <p class="text-slate-600 font-medium">@lang('Address')</p>
                <p>
                    {{ $site->city->name }},
                    {{ $site->city->region->state->name }},
                    {{ $site->city->region->state->country->name }}<br>
                    {{ $site->address }}<br>
                    <a wire:click='$emit("openModal", "geographics.sites.maps", {{ json_encode([$site->id]) }})'
                        :key="time().$site - > id" id="maprecord-{{ $site->id }}" href="#"
                        class="text-teal-500 hover:underline">@lang('View on map')</a>
                </p>
            </div>
            <div class="md:grid md:grid-cols-2 hover:bg-slate-50 md:space-y-0 space-y-1 p-4 border-b">
                <p class="text-slate-600 font-medium">@lang('Building type')</p>
                <p>{{ $site->type->parent->name.', ' ?? '' }} {{ $site->type->name }}</p>
            </div>
            <div class="md:grid md:grid-cols-2 hover:bg-slate-50 md:space-y-0 space-y-1 p-4 border-b">
                <p class="text-slate-600 font-medium">@lang('Manager')</p>
                <p>{{ $site->manager }}</p>
            </div>
            <div class="md:grid md:grid-cols-2 hover:bg-slate-50 md:space-y-0 space-y-1 p-4 border-b">
                <p class="text-slate-600 font-medium">@lang('Plant')</p>
                <p>{{ $site->plant }}</p>
            </div>
            <div class="md:grid md:grid-cols-2 hover:bg-slate-50 md:space-y-0 space-y-1 p-4 border-b">
                <p class="text-slate-600 font-medium">@lang('Phone number')</p>
                <p>{{ $site->phone_line }}</p>
            </div>
            <div class="md:grid md:grid-cols-2 hover:bg-slate-50 md:space-y-0 space-y-1 p-4 border-b">
                <p class="text-slate-600 font-medium">@lang('Emergency phone number')</p>
                <p>{{ $site->emergency_line }}</p>
            </div>
            <div class="md:grid md:grid-cols-2 hover:bg-slate-50 md:space-y-0 space-y-1 p-4 border-b">
                <p class="text-slate-600 font-medium">@lang('Contact and site access')</p>
                <p>{{ $site->contact_and_site_access }}</p>
            </div>
            <div class="md:grid md:grid-cols-2 hover:bg-slate-50 md:space-y-0 space-y-1 p-4 border-b">
                <p class="text-slate-600 font-medium">@lang('Other site information')</p>
                <p>{{ $site->other_site_information }}</p>
            </div>
        </x-slot>
    </x-app-modal>
</div>
