<div>
    <x-app-modal>
        <x-slot name="title">
            {{ __('View :name on map', ['name' => $site->name]) }}
        </x-slot>
        <x-slot name="content">
            <div class="map-responsive">
                <iframe
                    src="https://maps.google.com/maps?q={{ $site->latitude }},{{ $site->longitude }}&hl={{ app()->getLocale() }}&z=6&amp;output=embed"
                    width="600" height="350" frameborder="0" style="border:0" allowfullscreen>
                </iframe>
            </div>
        </x-slot>
    </x-app-modal>
</div>
