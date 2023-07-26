<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('favicon/site.webmanifest') }}">
    <title>{{ settings()->get('title_' . App::getLocale()) }}</title>
    <!-- Scripts -->
    @livewireScripts
    @wireUiScripts
    <!-- Vite compile -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- CSS -->
    @livewireStyles
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.0/dist/trix.css">
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js"></script>

</head>

<body class="font-sans antialiased bg-slate-50 text-slate-600 soft-scrollbar overflow-y-auto">
    <div class='pageloading z-30'></div>
    @if (settings()->get('notifications')['active'])
        <x-notifications position="{{ settings()->get('notifications')['position'] }}" />
    @endif
    <x-dialog z-index="z-50" blur="md" align="center" />
    @livewire('livewire-ui-modal')
    @include('layouts.partials.navigations.main')
    {{-- Go to top btn --}}
    <button x-data="topBtn" @click="scrolltoTop" id="topButton"
        class="fixed z-10 hidden p-2 bg-slate-800 rounded-full shadow-md bottom-24 right-10 bg-opacity-60 hover:bg-opacity-100 text-slate-400 transition ease-in-out duration-500">
        <x-icon name="chevron-up" class="w-5 h-5" />
    </button>
