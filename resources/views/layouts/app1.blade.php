<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'TakeXX'))</title>

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,600,700&display=swap" rel="stylesheet" />

    {{-- App CSS & JS (Tailwind build bằng Vite) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Custom CSS cho từng page --}}
    @stack('styles')
</head>
<body class="font-inter bg-gray-50 text-gray-800 flex flex-col min-h-screen">

    {{-- Navbar chung --}}
    @include('frontend.header')

    {{-- Header (tùy từng page có thể thêm) --}}
    @hasSection('header')
        <header class="bg-white shadow py-4 mb-6">
            <div class="max-w-7xl mx-auto px-4">
                @yield('header')
            </div>
        </header>
    @endif

    {{-- Nội dung chính --}}
    <main class="flex-1">
        <div class="max-w-7xl mx-auto px-4 py-6">
            @yield('content')
        </div>
    </main>

    {{-- Footer chung --}}
    @include('frontend.footer')

    {{-- Script riêng cho từng page --}}
    @stack('scripts')
</body>
</html>
