<x-mail::message>
# {{ $team->name }}

{{ $user->name }} @lang('Invite you to join his team.')

<x-mail::button :url="route('register', ['token'=>$invite->accept_token])">
@lang('Register now')
</x-mail::button>

@lang('Thanks,')<br>
{{ settings()->get('title_' . App::getLocale()) }}
</x-mail::message>
