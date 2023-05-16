<header class="relative w-full px-4 py-1 flex items-center justify-between bg-white shadow z-30">
    <div class="flex">
        <label for="menu-open" id="mobile-menu-button"
            class="m-2 p-2 focus:outline-none hover:text-white hover:bg-slate-700 rounded-md cursor-pointer items-center flex transition duration-300 ease-in-out lg:hidden">
            <x-icon id="menu-open-icon" name="menu-alt-2" class="w-6" />
            <x-icon id="menu-close-icon" name="x" class="w-6" />
        </label>
        <a href="/" class="flex hover:grayscale transition-all duration-500 ease-in-out">
            <span class="self-center">
                <img src="{{ asset('images/Telus-Logo.png') }}" alt="" class="h-9 hidden lg:inline-block">
                <img src="{{ asset('images/Telus-Emblem.png') }}" alt="" class="h-9 lg:hidden inline-block">
            </span>
        </a>
    </div>
    <nav>
        <div class="flex flex-row space-x-4 items-center align-middle">
            <div>
                @livewire('notifications.show')
            </div>
            <div>
                <x-dropdown>
                    <x-slot name="trigger" class="relative">
                        <x-icon name="globe-alt" class="w-6" />
                    </x-slot>
                    @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                        @if (App::getLocale() !== $localeCode)
                            <x-dropdown.item
                                href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"
                                hreflang="{{ $localeCode }}">
                                <div class="flex space-x-2 w-full items-center align-middle">
                                    <div>
                                        <img src="{{ asset('vendor/blade-flags/language-' . $localeCode . '.svg') }}"
                                            width="24" />
                                    </div>
                                    <div>{{ ucFirst($properties['native']) }}</div>
                                </div>
                            </x-dropdown.item>
                        @endif
                    @endforeach
                </x-dropdown>
            </div>
            <div>
                <!-- Profile -->
                <x-dropdown width="w-64">
                    <x-slot name="trigger">
                        <x-avatar src="{{ auth()->user()->gravatar }}" size="w-10 h-10" />
                    </x-slot>
                    <x-dropdown.item href="{{ route('admin.settings.users.show', auth()->user()->id) }}">
                        <div class="grid grid-cols-4 gap-4 w-full" role="none">
                            <div>
                                <x-avatar src="{{ auth()->user()->gravatar }}" sm />
                            </div>
                            <div class="col-span-3">
                                <p class="text-slate-600 " role="none">
                                    {{ auth()->user()->name }}
                                </p>
                                <p class="text-sm text-slate-400 truncate " role="none">
                                    {{ auth()->user()->email }}
                                </p>
                                <p class="text-sm text-slate-400 truncate " role="none">
                                    @if (auth()->user()->currentTeam)
                                        {{ auth()->user()->currentTeam->name }}
                                    @endif
                                </p>
                            </div>
                        </div>
                    </x-dropdown.item>
                    <x-dropdown.item separator :label="trans('Sign out')"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();" />
                </x-dropdown>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </div>
        </div>
    </nav>
</header>
