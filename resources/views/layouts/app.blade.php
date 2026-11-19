<!doctype html>
<html lang="en">
<head>
    {{-- Use the guide's title on every page. --}}
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kaon Ta! Davao – Senajon's Food Guide</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-stone-100 text-stone-900 antialiased">
    {{-- Keep navigation and flash messages in the same place across the guide. --}}
    @include('partials.nav')
    <main class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        @include('partials.flash')
        @yield('content')
    </main>
</body>
</html>
