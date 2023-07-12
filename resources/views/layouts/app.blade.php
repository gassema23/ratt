@include('layouts.partials.header')
<div class="relative min-h-full md:flex" data-dev-hint="container">
    @include('layouts.partials.navigations.sidebar')
    <main id="content" class="flex-1">
        <div class="w-full mx-auto p-6 lg:px-8  h-full min-h-screen justify-between">
            <div class="min-h-screen">
                @include('cookie-consent::index')
                <div>
                    @if (isset($title))
                        <div class="grid md:flex md:justify-between md:align-middle md:items-center">
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
                            @if (!empty($action))
                                <div class="mr-1 my-4">
                                    @if (isset($action['permission']))
                                        @can($action['permission'])
                                            @if (isset($action['id']))
                                                <x-button teal squared :label="$action['name']" icon="{{ $action['icon'] }}"
                                                    onclick="Livewire.emit('openModal', '{{ $action['route'] }}', {{ json_encode([$action['id']]) }})" />
                                            @else
                                                <x-button teal squared :label="$action['name']" icon="{{ $action['icon'] }}"
                                                    onclick="Livewire.emit('openModal', '{{ $action['route'] }}')" />
                                            @endif
                                        @endcan
                                    @else
                                        @if (isset($action['id']))
                                            <x-button teal squared :label="$action['name']" icon="{{ $action['icon'] }}"
                                                onclick="Livewire.emit('openModal', '{{ $action['route'] }}', {{ json_encode([$action['id']]) }})" />
                                        @else
                                            <x-button teal squared :label="$action['name']" icon="{{ $action['icon'] }}"
                                                onclick="Livewire.emit('openModal', '{{ $action['route'] }}')" />
                                        @endif
                                    @endif
                                </div>
                            @endif
                        </div>
                        @if (isset($description))
                            <div class="prose prose-slate max-w-none my-4">
                                {!! $description !!}
                            </div>
                        @endif
                    @endif
                </div>
                <!-- Your content -->
                <div class=" my-4">
                    <div class="grid grid-cols-1 lg:grid-cols-6 gap-4">
                        @if (isset($sidebar))
                            <div class="col-span-1">
                                {{ $sidebar }}
                            </div>
                        @endif
                        <div
                            class="@if (!isset($sidebar)) col-span-full @else col-span-1 lg:col-span-5 @endif">
                            {{ $slot }}
                        </div>
                    </div>
                </div>
            </div>
            @include('layouts.partials.content-footer')
            <!-- /End content -->
        </div>
    </main>
</div>
@include('layouts.partials.footer')
