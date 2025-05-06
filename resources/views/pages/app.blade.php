<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        {{-- <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" /> --}}
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <link rel="stylesheet" href="{{ mix('css/app.css') }}">
            <script src="{{ mix('js/app.js') }}" defer></script>
        @endif
    </head>
    <body class="antialiased bg-white">
        @include('components.navbar')
        @include('sections.hero')
        @include('sections.layanan')
        @include('sections.tentang')
        @include('sections.kategori')
        @include('sections.kategori')
        @include('sections.kategori')
        @include('sections.kontak')
        @include('sections.faq')
        @include('components.detailProduk')
        @include('components.cart')
        @include('auth.login')
        @include('auth.register')
        @include('components.detailPembayaran')

        <x-footer></x-footer>
    </body>
</html>
