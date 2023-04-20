<div>
    <form wire:submit.prevent="resetPassword">
        <h1 class="text-3xl text-slate-800 font-bold my-4">@lang('Reset password')</h1>
        <x-errors class="my-2" />
        <x-flash-messages class="my-2" />
        <!-- Email Address -->
        <div class="my-2">
            <x-input :label="trans('Email address')" wire:model.lazy="email" />
        </div>
        <!-- Password -->
        <div class="my-2">
            <x-inputs.password :label="trans('Password')" wire:model.lazy="password" />
        </div>
        <!-- Password -->
        <div class="my-2">
            <x-inputs.password :label="trans('Confirm Password')" wire:model.lazy="passwordConfirmation" />
        </div>
        <div class="flex items-center justify-between py-4 my-4 border-b border-slate-200">

            <x-button squared slate spinner type="submit" :label="trans('Reset password')" />
        </div>
    </form>
</div>
