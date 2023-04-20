<div class="flex w-full align-middle justify-center my-4 ">
    @if ($paginator->hasPages())
        <div class="flex w-full">
            @lang('Showing <b class="mx-1"> :number </b> to <b class="mx-1"> :page </b> of <b class="mx-1"> :total </b> results', [
                'number' => $paginator->firstItem(),
                'page' => $paginator->lastItem(),
                'total' => $paginator->total(),
            ])
        </div>
        @php(isset($this->numberOfPaginatorsRendered[$paginator->getPageName()]) ? $this->numberOfPaginatorsRendered[$paginator->getPageName()]++ : ($this->numberOfPaginatorsRendered[$paginator->getPageName()] = 1))
        <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-between">
            <div class="flex justify-between flex-1 sm:hidden">
                <span>
                    @if (!$paginator->onFirstPage())
                        <x-button squared sm white label="{!! __('pagination.previous') !!}"
                            onclick="previousPage('{{ $paginator->getPageName() }}')" wire:loading.attr="disabled"
                            dusk="previousPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}.before" />
                    @endif
                </span>

                <span>
                    @if ($paginator->hasMorePages())
                        <x-button squared sm white label="{!! __('pagination.next') !!}"
                            wire:click="nextPage('{{ $paginator->getPageName() }}')" wire:loading.attr="disabled"
                            dusk="nextPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}.before" />
                    @endif
                </span>
            </div>

            <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                <div>
                    <span class="relative z-0 inline-flex gap-1">
                        <span>
                            {{-- Previous Page Link --}}
                            @if (!$paginator->onFirstPage())
                                <x-button sm squared white icon="chevron-left"
                                    wire:click="previousPage('{{ $paginator->getPageName() }}')"
                                    dusk="previousPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}.after"
                                    rel="prev" />
                            @endif
                        </span>

                        {{-- Pagination Elements --}}
                        @foreach ($elements as $element)
                            {{-- "Three Dots" Separator --}}
                            @if (is_string($element))
                                <span aria-disabled="true">
                                    <x-button sm squared white :label="$element" disabled />
                                </span>
                            @endif

                            {{-- Array Of Links --}}
                            @if (is_array($element))
                                @foreach ($element as $page => $url)
                                    <span
                                        wire:key="paginator-{{ $paginator->getPageName() }}-{{ $this->numberOfPaginatorsRendered[$paginator->getPageName()] }}-page{{ $page }}">
                                        @if ($page == $paginator->currentPage())
                                            <span aria-current="page">
                                                <x-button sm squared teal :label="$page" disabled />
                                            </span>
                                        @else
                                            <x-button sm squared white :label="$page"
                                                wire:click="gotoPage({{ $page }}, '{{ $paginator->getPageName() }}')" />
                                        @endif
                                    </span>
                                @endforeach
                            @endif
                        @endforeach

                        <span>
                            {{-- Next Page Link --}}
                            @if ($paginator->hasMorePages())
                                <x-button sm squared white icon="chevron-right"
                                    wire:click="nextPage('{{ $paginator->getPageName() }}')"
                                    dusk="nextPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}.after"
                                    rel="next" />
                            @endif
                        </span>
                    </span>
                </div>
            </div>
        </nav>
    @endif
</div>
