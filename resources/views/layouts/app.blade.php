<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'TakeXX'))</title>

    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
   
    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    {{-- App CSS & JS --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Custom style cho toàn site (nếu cần) --}}
    @stack('styles')
</head>
<body class="font-sans bg-light">
    <div id="app" class="min-h-screen d-flex flex-column">

        {{-- Navbar chung --}}
        @include('frontend.header')

        {{-- Header (tùy page) --}}
        @hasSection('header')
            <header class="bg-white shadow-sm py-3 mb-4">
                <div class="container">
                    @yield('header')
                </div>
            </header>
        @endif

        {{-- Nội dung chính --}}
        <main class="flex-fill">
            <div class="container py-4">
                @yield('content')
            </div>
        </main>

        {{-- Footer chung --}}
        @include('frontend.footer')
    </div>

    {{-- Bootstrap JS (bắt buộc nếu dùng collapse, modal...) --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    {{-- Script riêng cho từng page --}}
    @stack('scripts')
</body>
</html>
