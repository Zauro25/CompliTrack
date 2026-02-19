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

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <div class="mx-auto w-full max-w-7xl px-4 sm:px-6 lg:px-8 py-6">
                <div class="flex flex-col gap-6 lg:flex-row">
                    @auth
                        @include('layouts.app.sidebar')
                    @endauth

                    <div class="min-w-0 flex-1 space-y-6">
                        <!-- Page Heading -->
                        @isset($header)
                            <header class="bg-white dark:bg-gray-800 shadow rounded-lg">
                                <div class="py-6 px-4 sm:px-6 lg:px-8">
                                    {{ $header }}
                                </div>
                            </header>
                        @endisset

                        <!-- Page Content -->
                        <main>
                            @if (session('success'))
                                <div class="mb-4 rounded-md border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
                                    {{ session('success') }}
                                </div>
                            @endif

                            {{ $slot ?? '' }}
                            @yield('content')
                        </main>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
