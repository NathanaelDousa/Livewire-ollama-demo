<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Vite CSS --}}
    @vite('resources/css/app.css')

    {{-- Livewire Styles --}}
    @livewireStyles

    <title>{{ $title ?? 'Page Title' }}</title>
</head>
<body class="bg-gray-100 text-gray-900 min-h-screen antialiased">
    <div class="container mx-auto py-10">
        {{ $slot }}
    </div>

    {{-- Vite JS --}}
    @vite('resources/js/app.js')

    {{-- Livewire Scripts --}}
    @livewireScripts
</body>
</html>
