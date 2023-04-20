    <div class=" col-span-full">
        <x-card class="flex items-center flex-col text-center">
            <img src="{{ asset('background/Tiny.jpg') }}" alt="" class="max-h-80">
            <div class="font-bold">@lang('No :name found ?', ['name' => $name])</div>
            <div class="text-slate-500">
                @lang('Try to add more :name', ['name' => $name])
            </div>
        </x-card>
    </div>
