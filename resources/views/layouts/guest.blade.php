<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ settings()->get('title_' . App::getLocale()) }}</title>
    <!-- Scripts -->
    @livewireScripts
    @wireUiScripts
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="font-sans text-gray-800 antialiased">
    <main class=" min-h-screen max-h-screen bg-white">
        <div class="flex">
            <div class="w-full lg:w-2/5 flex align-middle justify-center min-h-screen max-h-screen content-center items-center">
                <div class="w-1/2">
                    {{ $slot }}
                </div>
            </div>
            <div class="hidden lg:flex w-full lg:w-3/5 justify-around items-center relative bg-fixed bg-center bg-cover bg-no-repeat"
        style="background-image:linear-gradient(to left, rgba(15, 23, 42, 0.91), rgba(15, 23, 42, 0.83)), url({{ asset('background/copyrightfeature-1000x600.jpg') }})">
            </div>
        </div>
    </main>
</body>
</html>
