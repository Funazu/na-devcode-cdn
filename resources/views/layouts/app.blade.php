<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Masonry JS -->
    <script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js"></script>

    <style>
        .masonry-grid {
            display: flex;
            flex-wrap: wrap;
            margin-left: -1rem;
            width: auto;
        }

        .masonry-item {
            margin-left: 1rem;
            margin-bottom: 1rem;
            width: calc(33.333% - 1rem);
            /* Ganti sesuai kebutuhan */
        }

        .image-wrapper {
            position: relative;
            overflow: hidden;
        }

        .image-wrapper img {
            display: block;
            width: 100%;
            height: auto;
        }

        .image-actions {
            position: absolute;
            top: 0;
            right: 0;
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            padding: 0.5rem;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .image-actions button {
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            border: none;
            padding: 0.5rem;
            border-radius: 50%;
            cursor: pointer;
        }

        .image-actions button:hover {
            background-color: rgba(0, 0, 0, 0.7);
        }

        .image-wrapper:hover .image-actions {
            opacity: 1;
        }

        /* Style untuk teks nama gambar */
        .image-name {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(0, 0, 0, 0.7);
            color: white;
            text-align: center;
            padding: 0.5rem;
            opacity: 0;
            transition: opacity 0.3s ease;
            font-size: 0.875rem;
            /* Sesuaikan ukuran font jika perlu */
        }

        .image-wrapper:hover .image-name {
            opacity: 1;
        }
    </style>



    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>

<body class="font-sans antialiased">
    <x-banner />

    <div class="min-h-screen bg-gray-100">
        @livewire('navigation-menu')

        <!-- Page Heading -->
        @if (isset($header))
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>

    @stack('modals')

    @livewireScripts
</body>

</html>