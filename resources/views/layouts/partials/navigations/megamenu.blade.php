<header class="relative w-full p-4 flex items-center justify-between bg-white shadow z-30">
    <a href="/" class="flex hover:grayscale transition-all duration-500 ease-in-out">
        <span class="self-center">
            <img src="{{ asset('images/Telus-Logo.png') }}" alt="" class="h-8 hidden lg:inline-block">
            <img src="{{ asset('images/Telus-Emblem.png') }}" alt="" class="h-8 lg:hidden inline-block">
        </span>
    </a>
    <nav>
        <ul class="flex items-center justify-center font-semibold">
            {{-- ratt --}}
            <li class=" group px-3 py-2">
                <button
                    class="group-hover:text-teal-500 cursor-default @if (Route::is('admin.ratt.*')) text-teal-500 @endif">@lang('RATT')</button>
                <div
                    class="absolute top-8 left-0 transition shadow group-hover:translate-y-5 translate-y-0 opacity-0 invisible group-hover:opacity-100 group-hover:visible duration-500 ease-in-out group-hover:transform z-50 w-full transform">
                    <div class="relative top-6 p-6 bg-white shadow w-full lg:px-10">
                        <div
                            class="w-10 h-10 bg-white transform rotate-45 absolute top-0 z-0 translate-x-0 transition-transform group-hover:translate-x-[12rem] duration-500 ease-in-out rounded-sm">
                        </div>
                        <div class="relative z-10">
                            <div class="grid grid-cols-4 gap-6">
                                <div>
                                    <p class="uppercase tracking-wider text-slate-500 font-medium text-[13px]">
                                        @lang('Projects')
                                    </p>
                                    <ul class="mt-3 text-[15px]">
                                        <li>
                                            <a href="{{ route('admin.ratt.dashboard') }}"
                                                class="block p-2 -mx-2 rounded-lg hover:bg-teal-50 transition ease-in-out duration-300 text-slate-800 font-semibold hover:text-teal-600 @if (route::is('admin.ratt.dashboard')) bg-teal-50 text-teal-600 @endif">
                                                @lang('Dashboard')
                                                <p class="text-xs text-slate-500 font-normal">
                                                    @lang('Monitor Progress and Stay on Track')
                                                </p>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('admin.ratt.projects.index') }}"
                                                class="block p-2 -mx-2 rounded-lg hover:bg-teal-50 transition ease-in-out duration-300 text-slate-800 font-semibold hover:text-teal-600  @if (route::is('admin.ratt.projects.*')) text-teal-600 bg-teal-50 @endif">
                                                @lang('Projects')
                                                <p class="text-xs text-slate-500 font-normal">
                                                    @lang('The role of communication in successful engineering project management')
                                                </p>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div>
                                    <p class="uppercase tracking-wider text-slate-500 font-medium text-[13px]">
                                        @lang('Settings')
                                    </p>
                                    <ul class="mt-3 text-[15px]">
                                        <li>
                                            <a href="{{ route('admin.ratt.scenarios.index') }}"
                                                class="block p-2 -mx-2 rounded-lg hover:bg-teal-50 transition ease-in-out duration-300 text-slate-800 font-semibold hover:text-teal-600 @if (route::is('admin.ratt.scenarios.*')) bg-teal-50 text-teal-600 @endif">
                                                @lang('Scenarios')
                                                <p class="text-xs text-slate-500 font-normal">
                                                    @lang('Creating realistic project scenarios for accurate resource planning')
                                                </p>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('admin.ratt.tasks.index') }}"
                                                class="block p-2 -mx-2 rounded-lg hover:bg-teal-50 transition ease-in-out duration-300 text-slate-800 font-semibold hover:text-teal-600  @if (route::is('admin.ratt.tasks.*')) bg-teal-50 text-teal-600 @endif">
                                                @lang('Tasks')
                                                <p class="text-xs text-slate-500 font-normal">
                                                    @lang('Creating clear and concise project tasks for better team performance')
                                                </p>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            @if (auth()->user()->hasRole('Super-Admin'))
                {{-- beat --}}
                <li class=" group px-3 py-2">
                    <button
                        class="group-hover:text-teal-500 cursor-default  @if (Route::is('admin.beat.*')) text-teal-500 @endif">@lang('BEAT')</button>
                    <div
                        class="absolute top-8 left-0 transition shadow group-hover:translate-y-5 translate-y-0 opacity-0 invisible group-hover:opacity-100 group-hover:visible duration-500 ease-in-out group-hover:transform z-50 w-full transform">
                        <div class="relative top-6 p-6 bg-white shadow w-full lg:px-10">
                            <div
                                class="w-10 h-10 bg-white transform rotate-45 absolute top-0 z-0 translate-x-0 transition-transform group-hover:translate-x-[12rem] duration-500 ease-in-out rounded-sm">
                            </div>
                            <div class="relative z-10">
                                <div class="grid grid-cols-4 gap-6">
                                    <div>
                                        <p class="uppercase tracking-wider text-slate-500 font-medium text-[13px]">
                                            @lang('ZZAAZZ')
                                        </p>
                                        <ul class="mt-3 text-[15px]">
                                            <li>
                                                <a href="{{ route('admin.ratt.dashboard') }}"
                                                    class="block p-2 -mx-2 rounded-lg hover:bg-teal-50 transition ease-in-out duration-300 text-slate-800 font-semibold hover:text-teal-600">
                                                    @lang('Dashboard')
                                                    <p class="text-xs text-slate-500 font-normal">@lang('Organize your staff: view and modify team details.')</p>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            @endif
            {{-- documentations --}}
            @if (auth()->user()->hasRole('Super-Admin'))
                <li class=" group px-3 py-2">
                    <button
                        class="group-hover:text-teal-500 cursor-default @if (Route::is('admin.documentations.*')) text-teal-500 @endif">
                        @lang('Documentations')
                    </button>
                    <div
                        class="absolute top-8 left-0 transition shadow group-hover:translate-y-5 translate-y-0 opacity-0 invisible group-hover:opacity-100 group-hover:visible duration-500 ease-in-out group-hover:transform z-50 w-full transform">
                        <div class="relative top-6 p-6 bg-white shadow w-full lg:px-10">
                            <div
                                class="w-10 h-10 bg-white transform rotate-45 absolute top-0 z-0 translate-x-0 transition-transform group-hover:translate-x-[12rem] duration-500 ease-in-out rounded-sm">
                            </div>
                            <div class="relative z-10">
                                <div class="grid grid-cols-4 gap-6">
                                    <div>
                                        <p class="uppercase tracking-wider text-slate-500 font-medium text-[13px]">
                                            @lang('Documentations')
                                        </p>
                                        <ul class="mt-3 text-[15px]">
                                            <li>
                                                <a href="{{ route('admin.documentations.index') }}"
                                                    class="block p-2 -mx-2 rounded-lg hover:bg-teal-50 transition ease-in-out duration-300 text-slate-800 font-semibold hover:text-teal-600  @if (route::is('admin.documentations.index')) text-teal-600 bg-teal-50 @endif">
                                                    @lang('Documentations')
                                                    <p class="text-xs text-slate-500 font-normal">
                                                        @lang('Settings are the configuration options and preferences.')
                                                    </p>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div>
                                        <p class="uppercase tracking-wider text-slate-500 font-medium text-[13px]">
                                            @lang('Settings')
                                        </p>
                                        <ul class="mt-3 text-[15px]">
                                            <li>
                                                <a href="{{ route('admin.documentations.categories.index') }}"
                                                    class="block p-2 -mx-2 rounded-lg hover:bg-teal-50 transition ease-in-out duration-300 text-slate-800 font-semibold hover:text-teal-600  @if (route::is('admin.documentations.categories.*')) text-teal-600 bg-teal-50 @endif">
                                                    @lang('Categories')
                                                    <p class="text-xs text-slate-500 font-normal">
                                                        @lang('Settings are the configuration options and preferences.')
                                                    </p>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            @endif
            {{-- settings --}}
            <li class=" group px-3 py-2">
                <button
                    class="group-hover:text-teal-500 cursor-default  @if (!Route::is('admin.ratt.*') && !Route::is('admin.beat.*') && !Route::is('admin.documentations.*')) text-teal-500 @endif">@lang('Settings')</button>
                <div
                    class="absolute top-8 left-0 transition shadow group-hover:translate-y-5 translate-y-0 opacity-0 invisible group-hover:opacity-100 group-hover:visible duration-500 ease-in-out group-hover:transform z-50 w-full transform">
                    <div class="relative top-6 p-6 bg-white shadow w-full lg:px-10">
                        <div
                            class="w-10 h-10 bg-white transform rotate-45 absolute top-0 z-0 translate-x-0 transition-transform group-hover:translate-x-[12rem] duration-500 ease-in-out rounded-sm">
                        </div>
                        <div class="relative z-10">
                            <div class="grid grid-cols-4 gap-6">
                                <div>
                                    <p class="uppercase tracking-wider text-slate-500 font-medium text-[13px]">
                                        @lang('Geographies')
                                    </p>
                                    <ul class="mt-3 text-[15px]">
                                        <li>
                                            <a href="{{ route('admin.geographics.countries.index') }}"
                                                class="block p-2 -mx-2 rounded-lg hover:bg-teal-50 transition ease-in-out duration-300 text-slate-800 font-semibold hover:text-teal-600 @if (route::is('*.geographics.countries.*')) text-teal-600 bg-teal-50 @endif">
                                                @lang('Countries')
                                                <p class="text-xs text-slate-500 font-normal">
                                                    @lang('Countries list lets you easily gather informations of geography.')
                                                </p>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('admin.geographics.states.index') }}"
                                                class="block p-2 -mx-2 rounded-lg hover:bg-teal-50 transition ease-in-out duration-300 text-slate-800 font-semibold hover:text-teal-600 @if (route::is('*.geographics.states.*')) text-teal-600 bg-teal-50 @endif">
                                                @lang('States')
                                                <p class="text-xs text-slate-500 font-normal">@lang('States list lets you easily gather informations of geography.')</p>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('admin.geographics.regions.index') }}"
                                                class="block p-2 -mx-2 rounded-lg hover:bg-teal-50 transition ease-in-out duration-300 text-slate-800 font-semibold hover:text-teal-600 @if (route::is('*.geographics.regions.*')) text-teal-600 bg-teal-50 @endif">
                                                @lang('Regions')
                                                <p class="text-xs text-slate-500 font-normal">@lang('Regions list lets you easily gather informations of geography.')</p>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('admin.geographics.cities.index') }}"
                                                class="block p-2 -mx-2 rounded-lg hover:bg-teal-50 transition ease-in-out duration-300 text-slate-800 font-semibold hover:text-teal-600 @if (route::is('*.geographics.cities.*')) text-teal-600 bg-teal-50 @endif">
                                                @lang('Cities')
                                                <p class="text-xs text-slate-500 font-normal">@lang('Cities list lets you easily gather informations of geography.')</p>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('admin.geographics.sites.index') }}"
                                                class="block p-2 -mx-2 rounded-lg hover:bg-teal-50 transition ease-in-out duration-300 text-slate-800 font-semibold hover:text-teal-600 @if (route::is('*.geographics.sites.*')) text-teal-600 bg-teal-50 @endif">
                                                @lang('Sites')
                                                <p class="text-xs text-slate-500 font-normal">@lang('Sites list lets you easily gather informations of geography.')</p>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div>
                                    <p class="uppercase tracking-wider text-slate-500 font-medium text-[13px]">
                                        @lang('Employees')
                                    </p>
                                    <ul class="mt-3 text-[15px]">
                                        <li>
                                            <a href="{{ route('admin.settings.users.index') }}"
                                                class="block p-2 -mx-2 rounded-lg hover:bg-teal-50 transition ease-in-out duration-300 text-slate-800 font-semibold hover:text-teal-600 @if (route::is('admin.settings.users.*')) text-teal-600 bg-teal-50 @endif">
                                                @lang('Employees')
                                                <p class="text-xs text-slate-500 font-normal">@lang('Your workforce at a glance: access and control employee details.')</p>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('admin.settings.teams.index') }}"
                                                class="block p-2 -mx-2 rounded-lg hover:bg-teal-50 transition ease-in-out duration-300 text-slate-800 font-semibold hover:text-teal-600  @if (route::is('admin.settings.teams.*')) text-teal-600 bg-teal-50 @endif">
                                                @lang('Teams')
                                                <p class="text-xs text-slate-500 font-normal">@lang('Organize your staff: view and modify team details.')</p>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div>
                                    <p class="uppercase tracking-wider text-slate-500 font-medium text-[13px]">
                                        @lang('Securities')
                                    </p>
                                    <ul class="mt-3 text-[15px]">
                                        <li>
                                            <a href="{{ route('admin.settings.roles.index') }}"
                                                class="block p-2 -mx-2 rounded-lg hover:bg-teal-50 transition ease-in-out duration-300 text-slate-800 font-semibold hover:text-teal-600 @if (route::is('admin.settings.roles.*')) text-teal-600 bg-teal-50 @endif">
                                                @lang('Roles')
                                                <p class="text-xs text-slate-500 font-normal">@lang('User roles are used to manage and control access.')</p>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('admin.settings.permissions.index') }}"
                                                class="block p-2 -mx-2 rounded-lg hover:bg-teal-50 transition ease-in-out duration-300 text-slate-800 font-semibold hover:text-teal-600 @if (route::is('admin.settings.permissions.*')) text-teal-600 bg-teal-50 @endif">
                                                @lang('Permissions')
                                                <p class="text-xs text-slate-500 font-normal">@lang('Permissions are the specific actions or operations that a user is allowed to perform.')</p>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div>
                                    <p class="uppercase tracking-wider text-slate-500 font-medium text-[13px]">
                                        @lang('Settings')
                                    </p>
                                    <ul class="mt-3 text-[15px]">
                                        <li>
                                            <a href="{{ route('admin.settings.settings.index') }}"
                                                class="block p-2 -mx-2 rounded-lg hover:bg-teal-50 transition ease-in-out duration-300 text-slate-800 font-semibold hover:text-teal-600  @if (route::is('admin.settings.settings.*')) text-teal-600 bg-teal-50 @endif">
                                                @lang('Settings')
                                                <p class="text-xs text-slate-500 font-normal">@lang('Settings are the configuration options and preferences.')</p>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#"
                                                class="block p-2 -mx-2 rounded-lg hover:bg-teal-50 transition ease-in-out duration-300 text-slate-800 font-semibold hover:text-teal-600  @if (route::is('admin.settings.settings.*')) text-teal-600 bg-teal-50 @endif">
                                                @lang('Geographics types')
                                                <p class="text-xs text-slate-500 font-normal">@lang('Settings are the configuration options and preferences.')</p>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#"
                                                class="block p-2 -mx-2 rounded-lg hover:bg-teal-50 transition ease-in-out duration-300 text-slate-800 font-semibold hover:text-teal-600  @if (route::is('admin.settings.settings.*')) text-teal-600 bg-teal-50 @endif">
                                                @lang('Sites types')
                                                <p class="text-xs text-slate-500 font-normal">@lang('Settings are the configuration options and preferences.')</p>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('admin.documentations.categories.index') }}"
                                                class="block p-2 -mx-2 rounded-lg hover:bg-teal-50 transition ease-in-out duration-300 text-slate-800 font-semibold hover:text-teal-600  @if (route::is('admin.documentations.categories.*')) text-teal-600 bg-teal-50 @endif">
                                                @lang('Documentations categories')
                                                <p class="text-xs text-slate-500 font-normal">@lang('Settings are the configuration options and preferences.')</p>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </nav>
    <nav>
        <div class="pt-1 flex flex-row space-x-4 items-center align-middle">
            <div>
                @livewire('notifications.show')
            </div>
            <div>
                <x-dropdown>
                    <x-slot name="trigger" class="relative">
                        <x-icon name="globe-alt" class="w-6 h-6" />
                    </x-slot>
                    @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                        <x-dropdown.item
                            href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"
                            :label="ucFirst($properties['native'])" hreflang="{{ $localeCode }}" />
                    @endforeach
                    @can('translations-manage')
                        <x-dropdown.item href="/admin/translations" :label="__('Translation manager')" />
                    @endcan
                </x-dropdown>
            </div>
            <div>
                <!-- Profile -->
                <x-dropdown width="w-64">
                    <x-slot name="trigger">
                        <x-avatar src="{{ auth()->user()->gravatar }}" sm />
                    </x-slot>
                    <x-dropdown.item href="{{ route('admin.settings.users.show', auth()->user()->id) }}">
                        <div class="grid grid-cols-4 gap-2 w-full" role="none">
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
