<div>
    <div class="font-medium text-2xl text-slate-800 mb-2">@lang('Calendar')</div>
    <x-card>
        @push('scripts')
            <script>
                document.addEventListener('DOMContentLoaded', function() {

                    var calendarEl = document.getElementById('calendar');
                    var calendar = new FullCalendar.Calendar(calendarEl, {
                        initialView: 'dayGridMonth',
                        locale: 'en',
                        eventClick: function(info) {
                            window.$wireui.confirmDialog({
                                title: '{{ __('Are you Sure?') }}',
                                description: '{{ __('You will be redirected to the network page') }}',
                                icon: 'question',
                                accept: {
                                    label: '{{ __('Yes, go ahead!') }}',
                                    url: "/admin/networks/show/" + info.event.id
                                },
                                reject: {
                                    label: '{{ __('No, cancel') }}',
                                    method: 'cancel'
                                }
                            })
                            //window.location = "/admin/networks/show/" + info.event.id;
                        },
                        events: {!! json_encode($calendar) !!},
                        eventColor: '#14b8a6'
                    });
                    calendar.setOption('locale', '{{ App::getLocale() }}');
                    calendar.render();
                });
            </script>
        @endpush
        <div id='calendar' class="soft-scrollbar overflow-x-auto"></div>
    </x-card>
</div>
