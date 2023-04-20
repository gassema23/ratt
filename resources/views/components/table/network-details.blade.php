<div class="py-2 px-4 bg-white flex justify-between w-full">
    <div class="flex-1 divide-y divide-slate-200">
        <div class="md:grid md:grid-cols-2 md:space-y-0 space-y-1 p-4">
            <div class="text-gray-600 font-medium">
                @lang('Network')
            </div>
            <div>
                {{ $row->name }}
            </div>
        </div>
        <div class="md:grid md:grid-cols-2 md:space-y-0 space-y-1 p-4">
            <div class="text-gray-600 font-medium">
                @lang('Location')
            </div>
            <div>
                {{ $row->site->name }} <span class="text-xs text-slate-500">({{ $row->site->clli }})</span>,
                {{ $row->site->city->name . ', ' . $row->site->city->area->name . ', ' . $row->site->city->area->state->name . ', ' . $row->site->city->area->state->country->name }}
            </div>
        </div>
        <div class="md:grid md:grid-cols-2 md:space-y-0 space-y-1 p-4 ">
            <div class="text-gray-600 font-medium">
                @lang('Project manager')
            </div>
            <div>
                <p>
                    {{ $row->project->prime->name }}
                </p>
                <p>
                    <a href="mailto:{{ $row->project->prime->email }}"
                        class="text-teal-500 hover:underline">{{ $row->project->prime->email }}</a>
                </p>
            </div>
        </div>
        <div class="md:grid md:grid-cols-2 md:space-y-0 space-y-1 p-4 ">
            <div class="text-gray-600 font-medium">
                @lang('Planner')
            </div>
            <div>
                <p>
                    {{ $row->project->planner->name }}
                </p>
                <p>
                    <a href="mailto:{{ $row->project->planner->email }}"
                        class="text-teal-500 hover:underline">{{ $row->project->planner->email }}</a>
                </p>
            </div>
        </div>
        <div class="md:grid md:grid-cols-2 md:space-y-0 space-y-1 p-4">
            <div class="text-gray-600 font-medium">
                @lang('Description')
            </div>
            <div>
                {{ $row->description }}
            </div>
        </div>
    </div>
    <div class="">
        <x-button icon="x" negative squared xs wire:click.prevent="toggleDetail('{{ $id }}')" />
    </div>
</div>
