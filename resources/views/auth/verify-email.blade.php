<x-guest-layout>
    <div class="mb-4 text-sm text-slate-600">
        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
    </div>
    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-teal-600">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
    @endif
    <div class="mt-4 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <div>
                <x-button type="submit" squared slate :label="trans('Resend Verification Email')"/>
            </div>
        </form>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <x-button type="submit" squared slate :label="trans('Log Out')"/>
        </form>
    </div>
</x-guest-layout>
