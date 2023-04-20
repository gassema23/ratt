@include('layouts.partials.header')
<div class="flex pt-4 overflow-hidden">
    <div id="main-content" class="relative w-full flex flex-col min-h-screen ">
        <main class="w-full mx-auto px-6 lg:px-8 my-5 flex-grow">
            @include('cookie-consent::index')
            <div>
                @if (isset($title))
                    <div class="grid md:flex md:justify-between md:align-middle md:items-center mb-7">
                        <div class="my-4">
                            <div class="font-bold lg:text-3xl text-5xl">
                                {{ $title }}
                            </div>
                            @if (isset($subtitle))
                                <div class="text-slate-600 text-sm">
                                    {{ ucfirst(strtolower($subtitle)) }}
                                </div>
                            @endif
                        </div>
                        <div class="mr-1 my-4">
                            @if (!empty($action))
                                @if (isset($action['permission']))
                                    @can($action['permission'])
                                        <x-button teal squared :label="$action['name']" icon="{{ $action['icon'] }}"
                                            onclick="Livewire.emit('openModal', '{{ $action['route'] }}')" />
                                    @endcan
                                @else
                                    <x-button teal squared :label="$action['name']" icon="{{ $action['icon'] }}"
                                        onclick="Livewire.emit('openModal', '{{ $action['route'] }}')" />
                                @endif
                            @endif
                        </div>
                    </div>
                @endif
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-6 gap-4">
                @if (isset($sidebar))
                    <div class="col-span-1">
                        {{ $sidebar }}
                    </div>
                @endif
                <div class="@if (!isset($sidebar)) col-span-full @else col-span-1 lg:col-span-5  @endif">
                    {{ $slot }}
                </div>
            </div>
        </main>
        @include('layouts.partials.content-footer')
    </div>
</div>
@include('layouts.partials.footer')
