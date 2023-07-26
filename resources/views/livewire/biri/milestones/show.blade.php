<div>
    <x-app-modal>
        <x-slot name="title">
            {{ $milestone->network_header_tech }}
        </x-slot>
        <x-slot name="content">
            <div class="text-xl font-bold text-slate-800 uppercase my-4 border-y py-2 border-slate-200">
                @lang('Informations')
            </div>
            <div class="grid lg:grid-cols-2 gap-4">
                <div class="md:grid md:grid-cols-2 md:space-y-0 space-y-1 p-2">
                    <p class="text-slate-600 font-bold">@lang('Project no.')</p>
                    <p>{{ $milestone->project_no }}</p>
                </div>
                <div class="md:grid md:grid-cols-2 md:space-y-0 space-y-1 p-2">
                    <p class="text-slate-600 font-bold">@lang('WBS Element')</p>
                    <p>{{ $milestone->wbs_element }}</p>
                </div>
                <div class="md:grid md:grid-cols-2 md:space-y-0 space-y-1 p-2">
                    <p class="text-slate-600 font-bold">@lang('Network')</p>
                    <p>#{{ $milestone->network_no }}</p>
                </div>
                <div class="md:grid md:grid-cols-2 md:space-y-0 space-y-1 p-2">
                    <p class="text-slate-600 font-bold">@lang('SAP header')</p>
                    <p>{{ $milestone->network_header }}</p>
                </div>
                <div class="md:grid md:grid-cols-2 md:space-y-0 space-y-1 p-2">
                    <p class="text-slate-600 font-bold">@lang('SAP header tech')</p>
                    <p>{{ $milestone->network_header_tech }}</p>
                </div>
                <div class="md:grid md:grid-cols-2 md:space-y-0 space-y-1 p-2">
                    <p class="text-slate-600 font-bold">@lang('Scheduled finish')</p>
                    <p>{{ $milestone->schedule_end->format('Y-m-d') }}</p>
                </div>
                <div class="md:grid md:grid-cols-2 md:space-y-0 space-y-1 p-2">
                    <p class="text-slate-600 font-bold">@lang('Text')</p>
                    <p>{{ $milestone->label }}</p>
                </div>
                <div class="md:grid md:grid-cols-2 md:space-y-0 space-y-1 p-2">
                    <p class="text-slate-600 font-bold">@lang('Ntwk Type')</p>
                    <p>{{ $milestone->ntwk_type }}</p>
                </div>
                <div class="md:grid md:grid-cols-2 md:space-y-0 space-y-1 p-2">
                    <p class="text-slate-600 font-bold">@lang('Priority')</p>
                    <p>{{ $milestone->priority }}</p>
                </div>
            </div>
            <div class="text-xl font-bold text-slate-800 uppercase my-4 border-y py-2 border-slate-200">
                @lang('Assign to')
            </div>
            <div class="grid lg:grid-cols-3 gap-4">
                <div class="md:grid md:grid-cols-2 md:space-y-0 space-y-1 p-2">
                    <p class="text-slate-600 font-bold">@lang('Planner-NTWK')</p>
                    <p>{{ $milestone->planner_ntwk }}</p>
                </div>
                <div class="md:grid md:grid-cols-2 md:space-y-0 space-y-1 p-2">
                    <p class="text-slate-600 font-bold">@lang('Designer-NTWK')</p>
                    <p>{{ $milestone->designer_ntwk }}</p>
                </div>
                <div class="md:grid md:grid-cols-2 md:space-y-0 space-y-1 p-2">
                    <p class="text-slate-600 font-bold">@lang('DesignMgr-NTWK')</p>
                    <p>{{ $milestone->designerMgr_ntwk }}</p>
                </div>
            </div>
            <div class="text-xl font-bold text-slate-800 uppercase my-4 border-y py-2 border-slate-200">
                @lang('Status')
            </div>
            <div class="grid lg:grid-cols-2 gap-4">
                <div class="md:grid md:grid-cols-2 md:space-y-0 space-y-1 p-2">
                    <p class="text-slate-600 font-bold">@lang('Active System Status')</p>
                    <p>{{ $milestone->active_sys_status }}</p>
                </div>
                <div class="md:grid md:grid-cols-2 md:space-y-0 space-y-1 p-2">
                    <p class="text-slate-600 font-bold">@lang('Active User Status')</p>
                    <p>{{ $milestone->active_user_status }}</p>
                </div>
            </div>
            <div class="text-xl font-bold text-slate-800 uppercase my-4 border-y py-2 border-slate-200">
                @lang('Milestone date')
            </div>
            <div class="grid lg:grid-cols-4 gap-4">
                <div class="md:grid md:grid-cols-2 md:space-y-0 space-y-1 p-2">
                    <p class="text-slate-600 font-bold">@lang('CPR NTWK')</p>
                    <p>{{ $milestone->cpr_ntwk }}</p>
                </div>
                <div class="md:grid md:grid-cols-2 md:space-y-0 space-y-1 p-2">
                    <p class="text-slate-600 font-bold">@lang('CRTD Status')</p>
                    <p>{{ $milestone->crtd_status->format('Y-m-d') }}</p>
                </div>
                <div class="md:grid md:grid-cols-2 md:space-y-0 space-y-1 p-2">
                    <p class="text-slate-600 font-bold">@lang('RFA Status')</p>
                    <p>{{ $milestone->rfa_status->format('Y-m-d') }}</p>
                </div>
                <div class="md:grid md:grid-cols-2 md:space-y-0 space-y-1 p-2">
                    <p class="text-slate-600 font-bold">@lang('APP1 Status')</p>
                    <p>{{ $milestone->app1_status->format('Y-m-d') }}</p>
                </div>
                <div class="md:grid md:grid-cols-2 md:space-y-0 space-y-1 p-2">
                    <p class="text-slate-600 font-bold">@lang('APP2 Mlst')</p>
                    <p>{{ $milestone->app2_status->format('Y-m-d') }}</p>
                </div>
                <div class="md:grid md:grid-cols-2 md:space-y-0 space-y-1 p-2">
                    <p class="text-slate-600 font-bold">@lang('APP2 Status')</p>
                    <p>{{ $milestone->app2_status->format('Y-m-d') }}</p>
                </div>
                <div class="md:grid md:grid-cols-2 md:space-y-0 space-y-1 p-2">
                    <p class="text-slate-600 font-bold">@lang('DAPP Mlst')</p>
                    <p>{{ $milestone->dapp_mist->format('Y-m-d') }}</p>
                </div>
                <div class="md:grid md:grid-cols-2 md:space-y-0 space-y-1 p-2">
                    <p class="text-slate-600 font-bold">@lang('DAPP Status')</p>
                    <p>{{ $milestone->dapp_status->format('Y-m-d') }}</p>
                </div>
                <div class="md:grid md:grid-cols-2 md:space-y-0 space-y-1 p-2">
                    <p class="text-slate-600 font-bold">@lang('NRTB Mlst')</p>
                    <p>{{ $milestone->nrtb_mist->format('Y-m-d') }}</p>
                </div>
                <div class="md:grid md:grid-cols-2 md:space-y-0 space-y-1 p-2">
                    <p class="text-slate-600 font-bold">@lang('RTB Status')</p>
                    <p>{{ $milestone->rtb_status->format('Y-m-d') }}</p>
                </div>
                <div class="md:grid md:grid-cols-2 md:space-y-0 space-y-1 p-2">
                    <p class="text-slate-600 font-bold">@lang('FCOM Mlst')</p>
                    <p>{{ $milestone->fcom_mist->format('Y-m-d') }}</p>
                </div>
                <div class="md:grid md:grid-cols-2 md:space-y-0 space-y-1 p-2">
                    <p class="text-slate-600 font-bold">@lang('FCOM Status')</p>
                    <p>{{ $milestone->fcom_status->format('Y-m-d') }}</p>
                </div>
                <div class="md:grid md:grid-cols-2 md:space-y-0 space-y-1 p-2">
                    <p class="text-slate-600 font-bold">@lang('CPRD Mlst')</p>
                    <p>{{ $milestone->cprd_mist->format('Y-m-d') }}</p>
                </div>
                <div class="md:grid md:grid-cols-2 md:space-y-0 space-y-1 p-2">
                    <p class="text-slate-600 font-bold">@lang('NISR Mlst')</p>
                    <p>{{ $milestone->nisr_mist->format('Y-m-d') }}</p>
                </div>
                <div class="md:grid md:grid-cols-2 md:space-y-0 space-y-1 p-2">
                    <p class="text-slate-600 font-bold">@lang('NIS2 Mlst')</p>
                    <p>{{ $milestone->nis2_mist->format('Y-m-d') }}</p>
                </div>
                <div class="md:grid md:grid-cols-2 md:space-y-0 space-y-1 p-2">
                    <p class="text-slate-600 font-bold">@lang('RFS Status')</p>
                    <p>{{ $milestone->rfs_status->format('Y-m-d') }}</p>
                </div>
                <div class="md:grid md:grid-cols-2 md:space-y-0 space-y-1 p-2">
                    <p class="text-slate-600 font-bold">@lang('NCOM Mlst')</p>
                    <p>{{ $milestone->ncom_mist->format('Y-m-d') }}</p>
                </div>
                <div class="md:grid md:grid-cols-2 md:space-y-0 space-y-1 p-2">
                    <p class="text-slate-600 font-bold">@lang('TECO Status')</p>
                    <p>{{ $milestone->telco_status->format('Y-m-d') }}</p>
                </div>
                <div class="md:grid md:grid-cols-2 md:space-y-0 space-y-1 p-2">
                    <p class="text-slate-600 font-bold">@lang('CRTD-FMO Status')</p>
                    <p>{{ $milestone->crtd_fmo_status->format('Y-m-d') }}</p>
                </div>
                <div class="md:grid md:grid-cols-2 md:space-y-0 space-y-1 p-2">
                    <p class="text-slate-600 font-bold">@lang('RFA FMO Status')</p>
                    <p>{{ $milestone->rfa_fmo_status->format('Y-m-d') }}</p>
                </div>
                <div class="md:grid md:grid-cols-2 md:space-y-0 space-y-1 p-2">
                    <p class="text-slate-600 font-bold">@lang('RJT FMO status')</p>
                    <p>{{ $milestone->rjt_fmo_status->format('Y-m-d') }}</p>
                </div>
                <div class="md:grid md:grid-cols-2 md:space-y-0 space-y-1 p-2">
                    <p class="text-slate-600 font-bold">@lang('APPD FMO Status')</p>
                    <p>{{ $milestone->appd_fmo_status->format('Y-m-d') }}</p>
                </div>
                <div class="md:grid md:grid-cols-2 md:space-y-0 space-y-1 p-2">
                    <p class="text-slate-600 font-bold">@lang('DCOM FMO Status')</p>
                    <p>{{ $milestone->dcom_fmo_status->format('Y-m-d') }}</p>
                </div>
                <div class="md:grid md:grid-cols-2 md:space-y-0 space-y-1 p-2">
                    <p class="text-slate-600 font-bold">@lang('DAPP- FMO Mlst')</p>
                    <p>{{ $milestone->dapp_fmo_mist->format('Y-m-d') }}</p>
                </div>
                <div class="md:grid md:grid-cols-2 md:space-y-0 space-y-1 p-2">
                    <p class="text-slate-600 font-bold">@lang('DAPP FMO Status')</p>
                    <p>{{ $milestone->dapp_fmo_status->format('Y-m-d') }}</p>
                </div>
                <div class="md:grid md:grid-cols-2 md:space-y-0 space-y-1 p-2">
                    <p class="text-slate-600 font-bold">@lang('RGH FMO Status')</p>
                    <p>{{ $milestone->rgh_fmo_status->format('Y-m-d') }}</p>
                </div>
                <div class="md:grid md:grid-cols-2 md:space-y-0 space-y-1 p-2">
                    <p class="text-slate-600 font-bold">@lang('NRTB- FMO Mlst')</p>
                    <p>{{ $milestone->nrtb_fmo_mist->format('Y-m-d') }}</p>
                </div>
                <div class="md:grid md:grid-cols-2 md:space-y-0 space-y-1 p-2">
                    <p class="text-slate-600 font-bold">@lang('RTB FMO Status')</p>
                    <p>{{ $milestone->rtb_fmo_status->format('Y-m-d') }}</p>
                </div>
                <div class="md:grid md:grid-cols-2 md:space-y-0 space-y-1 p-2">
                    <p class="text-slate-600 font-bold">@lang('FCOM- FMO Mlst')</p>
                    <p>{{ $milestone->fcom_fmo_mist->format('Y-m-d') }}</p>
                </div>
                <div class="md:grid md:grid-cols-2 md:space-y-0 space-y-1 p-2">
                    <p class="text-slate-600 font-bold">@lang('FCOM FMO Status')</p>
                    <p>{{ $milestone->fcom_fmo_status->format('Y-m-d') }}</p>
                </div>
                <div class="md:grid md:grid-cols-2 md:space-y-0 space-y-1 p-2">
                    <p class="text-slate-600 font-bold">@lang('CPRD- FMO Mlst')</p>
                    <p>{{ $milestone->cprd_fmo_mist->format('Y-m-d') }}</p>
                </div>
                <div class="md:grid md:grid-cols-2 md:space-y-0 space-y-1 p-2">
                    <p class="text-slate-600 font-bold">@lang('NISR- FMO Mlst')</p>
                    <p>{{ $milestone->nisr_fmo_mist->format('Y-m-d') }}</p>
                </div>
                <div class="md:grid md:grid-cols-2 md:space-y-0 space-y-1 p-2">
                    <p class="text-slate-600 font-bold">@lang('RFS FMO Status')</p>
                    <p>{{ $milestone->rfs_fmo_status->format('Y-m-d') }}</p>
                </div>
                <div class="md:grid md:grid-cols-2 md:space-y-0 space-y-1 p-2">
                    <p class="text-slate-600 font-bold">@lang('CLOS FMO Status')</p>
                    <p>{{ $milestone->clos_fmo_status->format('Y-m-d') }}</p>
                </div>
                <div class="md:grid md:grid-cols-2 md:space-y-0 space-y-1 p-2">
                    <p class="text-slate-600 font-bold">@lang('Counter')</p>
                    <p>{{ $milestone->counter }}</p>
                </div>
            </div>
        </x-slot>
    </x-app-modal>
</div>
