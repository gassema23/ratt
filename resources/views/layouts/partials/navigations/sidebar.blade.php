<input type="checkbox" id="menu-open" class="hidden" />
<aside id="sidebar"
    class="z-10 min-h-screen pt-5 bg-slate-800 text-slate-400 md:w-64 w-2/3 space-y-6 px-0 absolute inset-y-0 left-0 transform md:relative md:translate-x-0 transition duration-300 ease-in-out md:flex md:flex-col md:justify-between overflow-y-auto">
    <div class="flex flex-col space-y-6">
        <nav>
            <ul>
                {{-- Dashboard --}}
                <li>
                    <a href="/"
                        class="flex items-center space-x-2 py-2 px-4 transition duration-300 hover:bg-slate-700">
                        <x-icon name="chart-pie" class="w-4" />
                        <span>@lang('Dashboard')</span>
                    </a>
                </li>
                {{-- BEAT --}}
                <li class="group" x-data="{ open: false }" x-on:click.outside="open = false">
                    <a href="#"
                        class="flex items-center py-2 px-4 transition duration-300 group-hover:bg-slate-700 justify-between w-full"
                        x-on:click="open = !open">
                        <div class="flex space-x-2">
                            <x-icon name="office-building" class="w-4" />
                            <span>@lang('BEAT')</span>
                        </div>
                        <span class="text-end" :class="{ 'rotated': open }">
                            <x-icon name="chevron-right" class="h-3" />
                        </span>
                    </a>
                    <ul x-show="open" x-collapse class="bg-slate-700">
                        <li>
                            <a href="#"
                                class="flex items-center py-2 px-4 transition duration-300 hover:bg-slate-600 pl-10">
                                Settings
                            </a>
                        </li>
                        <li>
                            <a href="#"
                                class="flex items-center py-2 px-4 transition duration-300 hover:bg-slate-600 pl-10">
                                Log Out
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- RATT --}}
                <li class="group" x-data="{ open: false }" x-on:click.outside="open = false">
                    <a href="#"
                        class="flex items-center py-2 px-4 transition duration-300 group-hover:bg-slate-700 justify-between w-full @if (Route::is('admin.ratt.*')) bg-slate-700 @endif"
                        x-on:click="open = !open">
                        <div class="flex space-x-2 items-center align-middle">
                            <img src="{{ asset('favicon/favicon-32x32.png') }}" alt="" class="h-4">
                            <span>@lang('RATT')</span>
                        </div>
                        <span class="text-end" :class="{ 'rotated': open }">
                            <x-icon name="chevron-right" class="h-3" />
                        </span>
                    </a>
                    <ul x-show="open" x-collapse class="bg-slate-700">
                        <li>
                            <a href="{{ route('admin.ratt.dashboard') }}"
                                class="flex items-center py-2 px-4 transition duration-300 hover:bg-slate-600 pl-10 @if (Route::is('admin.ratt.dashboard')) bg-slate-600 @endif">
                                @lang('Dashboard')
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.ratt.projects.index') }}"
                                class="flex items-center py-2 px-4 transition duration-300 hover:bg-slate-600 pl-10 @if (Route::is('admin.ratt.projects.*')) bg-slate-600 @endif">
                                @lang('Projects')
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.ratt.scenarios.index') }}"
                                class="flex items-center py-2 px-4 transition duration-300 hover:bg-slate-600 pl-10  @if (Route::is('admin.ratt.scenarios.*')) bg-slate-600 @endif">
                                @lang('Scenarios')
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.ratt.tasks.index') }}"
                                class="flex items-center py-2 px-4 transition duration-300 hover:bg-slate-600 pl-10 @if (Route::is('admin.ratt.tasks.*')) bg-slate-600 @endif">
                                @lang('Tasks')
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- Documentations --}}
                <li class="group" x-data="{ open: false }" x-on:click.outside="open = false">
                    <a href="#"
                        class="flex items-center py-2 px-4 transition duration-300 group-hover:bg-slate-700 justify-between w-full @if (Route::is('admin.documentations.*')) bg-slate-700 @endif"
                        x-on:click="open = !open">
                        <div class="flex space-x-2">
                            <x-icon name="clipboard-list" class="w-4" />
                            <span>@lang('Documentations')</span>
                        </div>
                        <span class="text-end" :class="{ 'rotated': open }">
                            <x-icon name="chevron-right" class="h-3" />
                        </span>
                    </a>
                    <ul x-show="open" x-collapse class="bg-slate-700">
                        <li>
                            <a href="{{ route('admin.documentations.index') }}"
                                class="flex items-center py-2 px-4 transition duration-300 hover:bg-slate-600 pl-10 @if (Route::is('admin.documentations.index')) bg-slate-600 @endif">
                                @lang('Documentations')
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.documentations.categories.index') }}"
                                class="flex items-center py-2 px-4 transition duration-300 hover:bg-slate-600 pl-10 @if (Route::is('admin.documentations.categories.*')) bg-slate-600 @endif">
                                @lang('Categories')
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- Geographies --}}
                <li class="group" x-data="{ open: false }" x-on:click.outside="open = false">
                    <a href="#"
                        class="flex items-center py-2 px-4 transition duration-300 group-hover:bg-slate-700 justify-between w-full @if (Route::is('admin.geographics.*')) bg-slate-700 @endif"
                        x-on:click="open = !open">
                        <div class="flex space-x-2">
                            <x-icon name="map" class="w-4" />
                            <span>@lang('Geographies')</span>
                        </div>
                        <span class="text-end" :class="{ 'rotated': open }">
                            <x-icon name="chevron-right" class="h-3" />
                        </span>
                    </a>
                    <ul x-show="open" x-collapse class="bg-slate-700">
                        <li>
                            <a href="{{ route('admin.geographics.countries.index') }}"
                                class="flex items-center py-2 px-4 transition duration-300 hover:bg-slate-600 pl-10 @if (Route::is('admin.geographics.countries.index')) bg-slate-600 @endif">
                                @lang('Countries')
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.geographics.states.index') }}"
                                class="flex items-center py-2 px-4 transition duration-300 hover:bg-slate-600 pl-10 @if (Route::is('admin.geographics.states.index')) bg-slate-600 @endif">
                                @lang('States')
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.geographics.regions.index') }}"
                                class="flex items-center py-2 px-4 transition duration-300 hover:bg-slate-600 pl-10 @if (Route::is('admin.geographics.regions.index')) bg-slate-600 @endif">
                                @lang('Regions')
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.geographics.cities.index') }}"
                                class="flex items-center py-2 px-4 transition duration-300 hover:bg-slate-600 pl-10 @if (Route::is('admin.geographics.cities.index')) bg-slate-600 @endif">
                                @lang('Cities')
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.geographics.states.index') }}"
                                class="flex items-center py-2 px-4 transition duration-300 hover:bg-slate-600 pl-10 @if (Route::is('admin.geographics.states.index')) bg-slate-600 @endif">
                                @lang('Sites')
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.geographics.geographics.types.index') }}"
                                class="flex items-center py-2 px-4 transition duration-300 hover:bg-slate-600 pl-10 @if (Route::is('admin.geographics.geographics.types.index')) bg-slate-600 @endif">
                                @lang('Geographics types')
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.geographics.sites.types.index') }}"
                                class="flex items-center py-2 px-4 transition duration-300 hover:bg-slate-600 pl-10 @if (Route::is('admin.geographics.sites.types.index')) bg-slate-600 @endif">
                                @lang('Sites types')
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- Employees --}}
                <li class="group" x-data="{ open: false }" x-on:click.outside="open = false">
                    <a href="#"
                        class="flex items-center py-2 px-4 transition duration-300 group-hover:bg-slate-700 justify-between w-full @if (Route::is('admin.settings.users.*') || Route::is('admin.settings.teams.*')) bg-slate-700 @endif"
                        x-on:click="open = !open">
                        <div class="flex space-x-2">
                            <x-icon name="users" class="w-4" />
                            <span>@lang('Employees')</span>
                        </div>
                        <span class="text-end" :class="{ 'rotated': open }">
                            <x-icon name="chevron-right" class="h-3" />
                        </span>
                    </a>
                    <ul x-show="open" x-collapse class="bg-slate-700">
                        <li>
                            <a href="{{ route('admin.settings.users.index') }}"
                                class="flex items-center py-2 px-4 transition duration-300 hover:bg-slate-600 pl-10  @if (Route::is('admin.settings.users.*')) bg-slate-600 @endif">
                                @lang('Employees')
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.settings.teams.index') }}"
                                class="flex items-center py-2 px-4 transition duration-300 hover:bg-slate-600 pl-10  @if (Route::is('admin.settings.teams.*')) bg-slate-600 @endif">
                                @lang('Teams')
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- Settings --}}
                <li class="group" x-data="{ open: false }" x-on:click.outside="open = false">
                    <a href="#"
                        class="flex items-center py-2 px-4 transition duration-300 group-hover:bg-slate-700 justify-between w-full @if (Route::is('admin.settings.roles.*') ||
                                Route::is('admin.settings.permissions.*') ||
                                Route::is('admin.settings.settings.*')) bg-slate-700 @endif"
                        x-on:click="open = !open">
                        <div class="flex space-x-2">
                            <x-icon name="cog" class="w-4" />
                            <span>@lang('Settings')</span>
                        </div>
                        <span class="text-end" :class="{ 'rotated': open }">
                            <x-icon name="chevron-right" class="h-3" />
                        </span>
                    </a>
                    <ul x-show="open" x-collapse class="bg-slate-700">
                        <li>
                            <a href="{{ route('admin.settings.settings.index') }}"
                                class="flex items-center py-2 px-4 transition duration-300 hover:bg-slate-600 pl-10  @if (Route::is('admin.settings.settings.*')) bg-slate-600 @endif">
                                @lang('Settings')
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.settings.roles.index') }}"
                                class="flex items-center py-2 px-4 transition duration-300 hover:bg-slate-600 pl-10  @if (Route::is('admin.settings.roles.*')) bg-slate-600 @endif">
                                @lang('Roles')
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.settings.permissions.index') }}"
                                class="flex items-center py-2 px-4 transition duration-300 hover:bg-slate-600 pl-10  @if (Route::is('admin.settings.permissions.*')) bg-slate-600 @endif">
                                @lang('Permissions')
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</aside>
