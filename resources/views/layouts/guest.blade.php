<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Font Awesome (icons) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Tailwind -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased text-slate-900 bg-gradient-to-br from-slate-100 to-slate-200">

    <div class="min-h-screen flex items-center justify-center px-4">

        <div class="w-full max-w-md">

            <!-- Logo -->
            <div class="text-center mb-6">
                <a href="/" class="inline-flex items-center justify-center">
                    <x-application-logo class="w-16 h-16 fill-current text-blue-600" />
                </a>
            </div>

            <!-- Auth Card -->
            <div
                class="bg-white/90 backdrop-blur rounded-2xl shadow-[0_20px_40px_rgba(0,0,0,0.08)] border border-slate-200 overflow-hidden">

                <!-- Accent bar -->
                <div class="h-1 bg-gradient-to-r from-blue-600 to-indigo-600"></div>

                <div class="px-8 py-8">
                    {{ $slot }}
                </div>
            </div>

            <!-- Footer -->
            <p class="mt-6 text-center text-xs text-slate-500">
                © {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
            </p>

        </div>
    </div>

</body>

</html>