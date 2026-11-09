<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Loreberry | Fakta Ilmiah Manis di Setiap Loker')</title>
    <meta name="description" content="@yield('description', 'Loreberry adalah lorong loker digital berisi fakta ilmiah unik dan surat rahasia dari Orby, disesuaikan dengan peran dan usiamu.')">
    <meta name="robots" content="@yield('robots', 'index, follow')">
    <link rel="canonical" href="{{ url()->current() }}">
    <meta name="theme-color" content="#ff8fc7">
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/png">

    {{-- Open Graph & Twitter Card: dipakai saat link dibagikan --}}
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Loreberry">
    <meta property="og:locale" content="id_ID">
    <meta property="og:title" content="@yield('title', 'Loreberry | Fakta Ilmiah Manis di Setiap Loker')">
    <meta property="og:description" content="@yield('description', 'Loreberry adalah lorong loker digital berisi fakta ilmiah unik dan surat rahasia dari Orby, disesuaikan dengan peran dan usiamu.')">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ asset('og-loreberry.png') }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="Orby, guinea pig maskot Loreberry, melambai di samping tulisan Loreberry">
    <meta name="twitter:card" content="summary_large_image">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('head')

    {{-- Tanpa JS: skeleton disembunyikan, loker tampil, dialog surat tampil inline --}}
    <noscript>
        <style>
            #loker-skeleton { display: none; }
            #loker-grid { display: grid; }
            dialog[data-surat] { display: block; position: static; margin: 1rem auto; }
        </style>
    </noscript>
</head>
<body class="flex min-h-dvh flex-col">
    <a href="#konten" class="sr-only focus:not-sr-only focus:fixed focus:left-3 focus:top-3 focus:z-[100] focus:rounded-full focus:bg-berry focus:px-5 focus:py-1 focus:text-white">Lewati ke konten</a>

    @hasSection('nav')
        @yield('nav')
    @else
        <x-navbar :username="session('user.username')" />
    @endif

    @yield('content')

    <x-footer />
</body>
</html>