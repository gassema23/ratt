  <div>
      <div class="flex justify-end w-full px-4 py-2 -mb-px" wire:loading>
          <svg class="animate-spin w-4 h-4 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
              <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
              </circle>
              <path class="opacity-75" fill="currentColor"
                  d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
              </path>
          </svg>
      </div>
      <div wire:loading.remove>
          <div class="grid grid-cols-1 lg:grid-cols-6 gap-4">
              <div class="col-span-4">
                  <div class="prose prose-slate max-w-none">
                      {!! $network->description ?? '' !!}
                  </div>
                  @can('comments-view')
                      <div class="my-4">
                          <livewire:comments.comments :model="$network" />
                      </div>
                  @endcan
              </div>
              <div class="col-span-2 order-first lg:order-last">
                  <div class="mb-4">
                      <div class="font-bold">@lang('Informations')</div>
                      <ul class="flex flex-col divide-y divide-slate-200 text-xs">
                          <li class="inline-flex items-center gap-x-2 py-1.5 px-2 font-medium text-slate-500">
                              <span class="font-medium">@lang('Network number:')</span>
                              {{ $network->network_no  }}
                          </li>
                          <li class="inline-flex items-center gap-x-2 py-1.5 px-2 font-medium text-slate-500">
                              <span class="font-medium">@lang('Network element:')</span>
                              {{ $network->network_element_lists }}
                          </li>
                          <li class="inline-flex items-center gap-x-2 py-1.5 px-2 font-medium text-slate-500">
                              <span class="font-medium">@lang('City:')</span>
                              {{ $network->site->city->name }} / {{ $network->site->name }} /
                              {{ $network->site->clli }}
                          </li>
                          @if ($network->scenario)
                              <li class="inline-flex items-center gap-x-2 py-1.5 px-2 font-medium text-slate-500">
                                  <span class="font-medium">@lang('Scenario:')</span>
                                  {{ $network->scenario->name }}
                              </li>
                          @endif
                      </ul>
                  </div>
                  <div class="my-4">
                      <div class="font-bold">@lang('Due to')</div>
                      <ul class="flex flex-col divide-y divide-slate-200 text-xs">
                          <li class="inline-flex items-center gap-x-2 py-1.5 px-2 font-medium text-slate-500">
                              {{ $network->ended_at->toFormattedDateString() }}
                          </li>
                      </ul>
                  </div>
                  @can('attachments-view')
                      <div class="my-4">
                          <div class="font-bold flex justify-between items-center align-middle">
                              @lang('Attachments')
                              @can('attachments-create')
                                  <x-button :label="trans('Add files')" flat slate squared xs
                                      onclick="Livewire.emit('openModal', 'ratt.networks.attach-files', {{ json_encode(['model_id' => $network->id, 'model' => App\Models\Network::class]) }})" />
                              @endcan
                          </div>
                          <div>
                              <livewire:ratt.networks.attachments :model="$network" />
                          </div>
                      </div>
                  @endcan
                  <div class="my-4">
                      <div class="font-bold"> @lang('Actions')</div>
                  </div>
              </div>
          </div>
      </div>
  </div>
