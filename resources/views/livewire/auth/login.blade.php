<div>
    <form wire:submit.prevent="save" wire:keydown.enter="save">
        <x-auth-session-status class="mb-4" :status="session('status')" />
        <h1 class="text-3xl text-slate-800 font-bold my-4">@lang('Welcome back!')</h1>
        <x-errors class="my-2" />
        <x-flash-messages class="my-2" />
        <!-- Email Address -->
        <div class="my-2">
            <x-input :label="trans('Email address')" wire:model.defer="email" :value="old('email')" suffix="@telus.com" />
        </div>
        <!-- Password -->
        <div class="my-2">
            <x-inputs.password :label="trans('Password')" wire:model.defer="password" />
        </div>
        <!-- Password -->
        <div class="flex items-center my-2">
            <input id="remember" type="checkbox" value=""
                class="w-4 h-4 text-teal-600 bg-slate-100 border-slate-300 rounded focus:ring-teal-500 focus:ring-2">
            <label for="remember" class="ml-2 text-sm font-medium text-slate-900">@lang('Remember me')</label>
        </div>
        <div
            class="flex flex-col space-y-4 xl:flex-row xl:items-center xl:justify-between py-4 my-4 border-b border-slate-200">
            @if (Route::has('password.request'))
                <a class="text-teal-600 hover:underline text-sm" href="{{ route('password.request') }}">
                    @lang('Forgot your password?')
                </a>
            @endif
            <x-button squared slate spinner="save" :label="trans('Sign in')" wire:click="save" />
        </div>
        <!-- Remember Me -->
        <div class="block my-2 text-sm text-slate-600">
            @lang('You do not have an account ? Please contact your manager.')
        </div>
    </form>
</div>
