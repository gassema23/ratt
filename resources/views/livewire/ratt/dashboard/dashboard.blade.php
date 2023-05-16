<div>
    <div class="flex flex-col lg:flex-row w-full space-y-4 lg:space-y-0 lg:space-x-4">
        <div class="w-full lg:w-3/5 space-y-4 flex flex-col">
            <div>
                <div class="font-medium text-2xl text-slate-800 mb-2">@lang('Project')</div>
                <x-card>
                    <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-6 gap-4">
                        <div
                            class="xl:col-span-1 rounded bg-orange-100 p-4 items-center justify-center align-middle text-center flex w-full flex-col">
                            <div class="mb-3">
                                <x-icon name="academic-cap" class="w-10 h-10 p-1 bg-white rounded-full text-orange-500" />
                            </div>
                            <div class="mb-2 font-sm text-slate-600">
                                {{ trans_choice('Project|Projects', $project_count) }}
                            </div>
                            <div class="text-xl font-medium">
                                {{ $project_count }}
                            </div>
                        </div>
                        <div
                            class="col-span-1 xl:col-span-1 rounded bg-green-100 p-4 items-center justify-center align-middle text-center flex w-full flex-col">
                            <div class="mb-3">
                                <x-icon name="globe" class="w-10 h-10 p-1 bg-white rounded-full text-green-500" />
                            </div>
                            <div class="mb-2 font-sm text-slate-600">
                                {{ trans_choice('Network|Networks', $network_count) }}
                            </div>
                            <div class="text-xl font-medium">
                                {{ $network_count }}
                            </div>
                        </div>
                        <div
                            class="xl:col-span-1 rounded bg-sky-100 p-4 items-center justify-center align-middle text-center flex w-full flex-col">
                            <div class="mb-3">
                                <x-icon name="menu-alt-1" class="w-10 h-10 p-1 bg-white rounded-full text-sky-500" />
                            </div>
                            <div class="mb-2 font-sm text-slate-600">
                                {{ trans_choice('Task|Tasks', $task_count) }}
                            </div>
                            <div class="text-xl font-medium">
                                {{ $task_count }}
                            </div>
                        </div>
                        <div
                            class="xl:col-span-1 rounded bg-pink-100 p-4 items-center justify-center align-middle text-center flex w-full flex-col">
                            <div class="mb-3">
                                <x-icon name="chart-pie" class="w-10 h-10 p-1 bg-white rounded-full text-pink-500" />
                            </div>
                            <div class="mb-2 font-sm text-slate-600">
                                @lang('Completed')
                            </div>
                            <div class="text-xl font-medium">
                                {{ $task_complete_count }}
                            </div>
                        </div>
                        <div
                            class=" h-40 col-span-2 rounded bg-slate-100 p-4 items-center justify-center align-middle text-center flex w-full flex-col">
                            <canvas id="myChart"></canvas>
                        </div>
                    </div>
                    @push('scripts')
                        <script>
                            const ctx = document.getElementById('myChart');
                            const data = {
                                labels: [
                                    '@lang('Complete')',
                                    '@lang('Left')'
                                ],
                                datasets: [{
                                    data: [{{ $task_complete_count }}, {{ $progress }}],
                                    backgroundColor: [
                                        'rgb(54, 162, 235)',
                                        'rgb(54, 162, 235,0.4)'
                                    ],
                                }]
                            };
                            new Chart(ctx, {
                                type: 'doughnut',
                                data: data,
                            });
                        </script>
                    @endpush
                </x-card>
            </div>
            @livewire('ratt.dashboard.todo')
        </div>
        <div class="w-full lg:w-2/5 space-y-4 flex flex-col">
            @livewire('ratt.dashboard.calendar')
        </div>
    </div>
</div>
