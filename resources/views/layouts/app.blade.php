<!DOCTYPE html>
<html lang="en" data-theme="mm-daisy">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Mimpi Maya - {{ $title ?? 'Beranda' }}</title>

        <link rel="icon" sizes="any" href="{{ asset('favicon.ico') }}" />
        <link rel="icon" type="image/webp" href="{{ asset('images/logo.webp') }}" />
        <link rel="apple-touch-icon" href="{{ asset('images/logo.png') }}" />

        @vite(['resources/css/app.css', 'resources/ts/app.ts', 'resources/ts/livewire.ts'])
        @stack('head_scripts')

        @livewireStyles
    </head>
    <body>
        <x-loading-overlay />
        <x-navbar>
            {{ $slot }}
        </x-navbar>
    </body>
</html>
