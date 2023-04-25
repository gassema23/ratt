<div>
    <div class="text-xl font-bold mb-4">@lang('Filters')</div>
    <ul class="space-y-2">
        @foreach ($filter_lists as $filter)
            <li>
                <button wire:click="filter({{ json_encode($filter['id']) }})"
                    class="@if ($filter_name === $filter['id']) text-teal-600 bg-teal-50 @endif font-semibold flex items-center py-2 px-4 text-slate-800 hover:text-teal-600 hover:bg-teal-50 w-full justify-between transition-all duration-300 ease-in-out">
                    {{ $filter['name'] }}
                    @if (isset($filter['count']))
                        @if ($filter['count'] > 0)
                            <div class="text-right font-normal text-sm text-slate-500">
                                <div>
                                    <div class="relative flex items-center w-2 h-2">
                                        <span
                                            class="absolute inline-flex w-full h-full rounded-full opacity-75 bg-pink-500 animate-ping"></span>
                                        <span class="relative inline-flex w-2 h-2 rounded-full bg-pink-500"></span>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endif
                </button>
            </li>
        @endforeach
    </ul>
</div>
