<div>
    <x-card>
        <div class="flex justify-end my-4">
            <x-csv-button
                class="outline-none inline-flex justify-center items-center group transition-all ease-in duration-150 focus:ring-2 focus:ring-offset-2 hover:shadow-sm disabled:opacity-80 disabled:cursor-not-allowed gap-x-2 text-sm px-4 py-2     border text-slate-500 hover:bg-slate-100 ring-slate-200
            dark:ring-slate-600 dark:border-slate-500 dark:hover:bg-slate-700
            dark:ring-offset-slate-800 dark:text-slate-400">
                @lang('Import file')
            </x-csv-button>
        </div>
        @livewire('biri.isq.table')
    </x-card>
    <div class="z-50 mt-40">
        <livewire:csv-importer
            :model="App\Models\BiriIsqMasterData::class"
            :columns-to-map="[
                'network_no',
                'network_header',
                'order_type',
                'division',
                'project_no',
                'created_date',
                'order_start',
                'order_end',
                'status_sys',
                'status_util',
                'updated_date',
                'responsible',
                'planner',
                'sr_planner',
                'count',
                'version_date',
            ]" :required-columns="['network_no', 'project_no']" :column-labels="[
                'network_no' => trans('Network no.'),
                'network_header' => trans('SAP header'),
                'order_type' => trans('Order type'),
                'division' => trans('Division'),
                'project_no' => trans('Project no.'),
                'created_date' => trans('Created date'),
                'order_start' => trans('Order start date'),
                'order_end' => trans('Order end date'),
                'status_sys' => trans('Status system'),
                'status_util' => trans('Status util.'),
                'updated_date' => trans('Updated date'),
                'responsible' => trans('Responsible'),
                'planner' => trans('Planner'),
                'sr_planner' => trans('Dir. Planner'),
                'count' => trans('Count'),
                'version_date' => trans('Version date'),
            ]"
        />
    </div>
</div>
