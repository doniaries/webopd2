<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="{{ $metaDescription ?? 'WebOPD - Portal Resmi Organisasi Perangkat Daerah' }}">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <title>{{ $title ?? 'WebOPD - Portal Resmi' }}</title>
    </head>
    <body class="min-h-screen flex flex-col bg-gray-50">
        <x-header />
        
        <main class="flex-grow">
            {{ $slot }}
        </main>
        
        <x-footer />
    </body>
</html>
