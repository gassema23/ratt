<div>
    <x-app-modal>
        <x-slot name="title">
            {{ __(':name', ['name' => $state->name]) }}
        </x-slot>
        <x-slot name="content">
            <div class="map-responsive">
                <iframe
                    src="https://maps.google.com/maps?q={{ $state->latitude }},{{ $state->longitude }}&hl={{ app()->getLocale() }}&z=4&amp;output=embed"
                    width="600" height="350" frameborder="0" style="border:0" allowfullscreen>
                </iframe>
            </div>
        </x-slot>
    </x-app-modal>
</div>
