<div>
    <form wire:submit.prevent="save">
        <h1 class="text-3xl text-slate-800 font-bold my-4">@lang('Create your Account')</h1>
        <x-errors class="my-2" />
        <div class="my-2">
            <x-input :label="@trans('Name')" wire:model.defer="name"
                autofocus />
        </div>
        <div class="my-2">
            <x-input :label="trans('Employe number')" wire:model.defer="employe_id"  />
        </div>
        <div class="my-2">
            <x-input wire:model.defer="phone" :label="trans('Phone number')" />
        </div>
        <!-- Email Address -->
        <div class="my-2">
            <x-input :label="trans('Email address')" wire:model.defer="email" />
        </div>
        <!-- Password -->
        <div class="my-2 grid grid-cols-2 gap-4">
            <x-inputs.password :label="trans('Password')" wire:model.defer="password" />
            <x-inputs.password :label="trans('Confirm password')" wire:model.defer="password_confirmation" />
        </div>
        <div class="flex items-center justify-end py-4 my-4 border-b border-slate-200">
            <x-button squared slate spinner="save" :label="trans('Sign up')" wire:click="save" />
        </div>

        <!-- Remember Me -->
        <div class="block my-2 text-sm text-slate-600">
            @lang('Have an account?')
            <a class="text-teal-600 hover:underline text-sm" href="{{ route('login') }}">@lang('Sign In')</a>
        </div>
    </form>
</div>
