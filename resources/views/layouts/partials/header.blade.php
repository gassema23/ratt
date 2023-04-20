<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        {{ settings()->get('title_' . App::getLocale()) }}
    </title>
    <!-- Scripts -->
    @livewireScripts
    @wireUiScripts
    @powerGridScripts
    <!-- Vite compile -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- CSS -->
    @livewireStyles
    @powerGridStyles
</head>

<body class="font-sans antialiased bg-slate-50 text-slate-600  soft-scrollbar overflow-y-auto">
    <div class='pageloading z-30'></div>
    @if (settings()->get('notifications')['active'])
        <x-notifications position="{{ settings()->get('notifications')['position'] }}" />
    @endif
    <x-dialog z-index="z-50" blur="md" align="center" />
    @livewire('livewire-ui-modal')
    @include('layouts.partials.navigations.megamenu')
