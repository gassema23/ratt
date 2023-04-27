<div class="py-2 px-4 bg-white flex justify-between w-full">
    <div class="flex-1  ">
        @foreach ($row->tasks as $task)
            <div class="md:grid md:grid-cols-2 md:space-y-0 space-y-1 p-4">
                <div class="divide-y divide-slate-200">
                    <div class="text-slate-600 font-medium pb-2">
                        @lang('Task')
                    </div>
                    <div class="pt-2">
                        {{ $task->name }}
                    </div>
                </div>
                <div class="divide-y divide-slate-200">
                    <div class="text-slate-600 font-medium  pb-2">
                        @lang('Team')
                    </div>
                    <div class="pt-2">
                        {{ $task->team->name }}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="">
        <x-button icon="x" negative squared xs wire:click.prevent="toggleDetail('{{ $id }}')" />
    </div>
</div>
