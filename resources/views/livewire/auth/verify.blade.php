<div>
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <h2 class="mt-6 text-3xl font-extrabold text-center text-slate-900 leading-9">
            @lang('Verify your email address')
        </h2>
        <p class="mt-2 text-sm text-center text-slate-500 leading-5 max-w">
            @lang('Or')
            <a href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                class="font-medium text-teal-500 hover:underline focus:outline-none focus:underline transition ease-in-out duration-150">
                @lang('sign out')
            </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        </p>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md my-4">
        @if (session('resent'))
            <div class="rounded-lg bg-positive-50 dark:bg-secondary-800 dark:border dark:border-positive-600 p-4">
                <div class="flex items-center pb-3 border-positive-200 dark:border-positive-700">
                    <svg class="w-5 h-5 text-positive-400 dark:text-positive-600 shrink-0 mr-3"
                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span class="text-sm font-semibold text-positive-800 dark:text-positive-600">
                        @lang('A fresh verification link has been sent to your email address.')
                    </span>
                </div>
            </div>
        @endif
        <div class="text-sm text-slate-700">
            <p>@lang('Before proceeding, please check your email for a verification link.')</p>
            <p class="mt-3">
                @lang('If you did not receive the email,')
                <a wire:click="resend"
                    class="text-teal-500 cursor-pointer hover:underline focus:outline-none focus:underline transition ease-in-out duration-150">
                    @lang('click here to request another')
                </a>.
            </p>
        </div>
    </div>
</div>
