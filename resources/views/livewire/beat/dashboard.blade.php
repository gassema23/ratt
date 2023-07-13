<div>
    <div class="flex flex-col md:flex-row w-full space-y-4 md:space-y-0 md:space-x-4">
        <div class="w-full xl:w-1/4 space-y-4 flex flex-col text-center">
            <x-card>
                <h2 class="">@lang('Quick add')</h2>
                <div class="font-semibold text-xl text-slate-800">@lang('Create new alarm point system')</div>
                <div class="font-semibold text-4xl flex justify-center">
                    <img class="object-cover w-full" src="{{ asset('background/5017941.jpg') }}" alt="">
                </div>
                <div class="flex space-x-4 mt-4 justify-center">
                    <x-button squared :label="trans('Start')" />
                    <x-button slate squared :label="trans('Quick guide')" />
                </div>
            </x-card>
        </div>
        <div class="w-full xl:w-1/4 space-y-4 flex flex-col">
            <x-card>
                <div class="flex justify-between">
                    <div>
                        <h2 class="font-semibold text-xl text-slate-800">@lang('Top Alarms Categories')</h2>
                        <div class="font-semibold text-sm text-slate-500">@lang('500 Alarms points')</div>
                    </div>
                    <div>
                        <x-button squared xs :label="trans('View All')" />
                    </div>
                </div>
                <div class="mt-4">
                    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                    <script type="text/javascript" defer>
                        google.charts.load('current', {
                            packages: ['corechart', 'bar']
                        });
                        google.charts.setOnLoadCallback(drawMaterial);

                        function drawMaterial() {
                            var data = google.visualization.arrayToDataTable([
                                ['Element', 'Density', {
                                    role: 'style'
                                }],
                                ['Copper', 8.94, '#b87333'], // RGB value
                                ['Silver', 10.49, '#EEE'], // English color name
                                ['Gold', 19.30, 'gold'],
                                ['Platinum', 21.45, 'color: #e5e4e2'], // CSS-style declaration
                            ]);

                            var materialOptions = {
                                bars: 'horizontal',
                                animation: {
                                    easing: 'in',
                                    duration: '500ms'
                                }
                            };

                            var materialChart = new google.charts.Bar(document.getElementById('chart_div'));
                            materialChart.draw(data, materialOptions);
                        }
                    </script>
                    <div id="chart_div" class="min-h-full flex"></div>
                </div>
            </x-card>
        </div>
        <div class="w-full xl:w-1/4 space-y-4 flex flex-col">
            <x-card>
                <h2 class="">@lang('History')</h2>
                <div class="flex justify-between">
                    <div>
                        <h2 class="font-semibold text-xl text-slate-800">@lang('Recent alarm')</h2>
                    </div>
                    <div>
                        <x-button squared xs :label="trans('View All')" />
                    </div>
                </div>
                <div class="flex space-x-4 mt-4 flex-col">
                    <div class="flex justify-between">
                        <div class="flex space-x-4 align-middle items-center w-2/3">
                            <div class="w-1/12 bg-teal-500 p-1.5 align-middle rounded-full text-teal-50">
                                <x-icon name="shield-check" class="w-full" />
                            </div>
                            <div>
                                <h3 class="uppercase font-semibold">@lang('AFSHPQXQD00')</h3>
                                <p class="font-semibold text-slate-800">@lang('10 Actives alarm point')</p>
                            </div>
                        </div>
                        <div>
                            <x-badge squared warning :label="trans('In process')" />
                        </div>
                    </div>
                    <div class="relative px-4 mt-4">
                        <div class="absolute h-full border border-dashed border-opacity-20 border-slate-800"></div>

                        <!-- start::Timeline item -->
                        <div class="flex items-center w-full my-6 -ml-1.5">
                            <div class="w-1/12 z-10">
                                <div class="w-3.5 h-3.5 bg-teal-500 rounded-full"></div>
                            </div>
                            <div class="w-11/12">
                                <p class="text-sm">Profile informations changed.</p>
                                <p class="text-xs text-slate-500">3 min ago</p>
                            </div>
                        </div>
                        <!-- end::Timeline item -->
                        <!-- start::Timeline item -->
                        <div class="flex items-center w-full my-6 -ml-1.5">
                            <div class="w-1/12 z-10">
                                <div class="w-3.5 h-3.5 bg-emerald-500 rounded-full"></div>
                            </div>
                            <div class="w-11/12">
                                <p class="text-sm">
                                    Connected with <a href="#" class="text-emerald-500 font-bold">Colby
                                        Covington</a>.</p>
                                <p class="text-xs text-slate-500">15 min ago</p>
                            </div>
                        </div>
                        <!-- end::Timeline item -->
                    </div>
                </div>
            </x-card>
        </div>
    </div>
</div>
