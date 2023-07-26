<div>
    <x-app-modal>
        <x-slot name="title">
            {{ $isq->network_header }}
        </x-slot>
        <x-slot name="content">
            <div class="md:grid md:grid-cols-2 hover:bg-slate-50 md:space-y-0 space-y-1 p-4 border-b">
                <p class="text-slate-600 font-bold">@lang('Network no.')</p>
                <p>{{ $isq->network_no }}</p>
            </div>
            <div class="md:grid md:grid-cols-2 hover:bg-slate-50 md:space-y-0 space-y-1 p-4 border-b">
                <p class="text-slate-600 font-bold">@lang('SAP header')</p>
                <p>{{ $isq->network_header }}</p>
            </div>
            <div class="md:grid md:grid-cols-2 hover:bg-slate-50 md:space-y-0 space-y-1 p-4 border-b">
                <p class="text-slate-600 font-bold">@lang('Order type')</p>
                <p>{{ $isq->order_type }}</p>
            </div>
            <div class="md:grid md:grid-cols-2 hover:bg-slate-50 md:space-y-0 space-y-1 p-4 border-b">
                <p class="text-slate-600 font-bold">@lang('Division')</p>
                <p>{{ $isq->division }}</p>
            </div>
            <div class="md:grid md:grid-cols-2 hover:bg-slate-50 md:space-y-0 space-y-1 p-4 border-b">
                <p class="text-slate-600 font-bold">@lang('Project no.')</p>
                <p>{{ $isq->project_no }}</p>
            </div>
            <div class="md:grid md:grid-cols-2 hover:bg-slate-50 md:space-y-0 space-y-1 p-4 border-b">
                <p class="text-slate-600 font-bold">@lang('Created date')</p>
                <p>{{ $isq->created_date->format('Y-m-d') }}</p>
            </div>
            <div class="md:grid md:grid-cols-2 hover:bg-slate-50 md:space-y-0 space-y-1 p-4 border-b">
                <p class="text-slate-600 font-bold">@lang('Order start date')</p>
                <p>{{ $isq->order_start->format('Y-m-d') }}</p>
            </div>
            <div class="md:grid md:grid-cols-2 hover:bg-slate-50 md:space-y-0 space-y-1 p-4 border-b">
                <p class="text-slate-600 font-bold">@lang('Order end date')</p>
                <p>{{ $isq->order_end->format('Y-m-d') }}</p>
            </div>
            <div class="md:grid md:grid-cols-2 hover:bg-slate-50 md:space-y-0 space-y-1 p-4 border-b">
                <p class="text-slate-600 font-bold">@lang('status system')</p>
                <p>{{ $isq->status_sys }}</p>
            </div>
            <div class="md:grid md:grid-cols-2 hover:bg-slate-50 md:space-y-0 space-y-1 p-4 border-b">
                <p class="text-slate-600 font-bold">@lang('status user')</p>
                <p>{{ $isq->status_util }}</p>
            </div>
            <div class="md:grid md:grid-cols-2 hover:bg-slate-50 md:space-y-0 space-y-1 p-4 border-b">
                <p class="text-slate-600 font-bold">@lang('Updated date')</p>
                <p>{{ $isq->updated_date->format('Y-m-d') }}</p>
            </div>
            <div class="md:grid md:grid-cols-2 hover:bg-slate-50 md:space-y-0 space-y-1 p-4 border-b">
                <p class="text-slate-600 font-bold">@lang('Budget manager')</p>
                <p>{{ $isq->responsible }}</p>
            </div>
            <div class="md:grid md:grid-cols-2 hover:bg-slate-50 md:space-y-0 space-y-1 p-4 border-b">
                <p class="text-slate-600 font-bold">@lang('Planner')</p>
                <p>{{ $isq->planner }}</p>
            </div>
            <div class="md:grid md:grid-cols-2 hover:bg-slate-50 md:space-y-0 space-y-1 p-4 border-b">
                <p class="text-slate-600 font-bold">@lang('Dir. Planning')</p>
                <p>{{ $isq->sr_planner }}</p>
            </div>
            <div class="md:grid md:grid-cols-2 hover:bg-slate-50 md:space-y-0 space-y-1 p-4 border-b">
                <p class="text-slate-600 font-bold">@lang('Count')</p>
                <p>{{ $isq->count }}</p>
            </div>
            <div class="md:grid md:grid-cols-2 hover:bg-slate-50 md:space-y-0 space-y-1 p-4 border-b">
                <p class="text-slate-600 font-bold">@lang('Version date')</p>
                <p>{{ $isq->version_date->format('Y-m-d') }}</p>
            </div>
        </x-slot>
    </x-app-modal>
</div>
