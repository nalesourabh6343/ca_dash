<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Client Dashboard') | {{ config('app.name') }}</title>

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Outfit', sans-serif;
        }

        [x-cloak] {
            display: none !important;
        }

        /* Hide Google Translate Toolbar */
        .goog-te-banner-frame.skiptranslate {
            display: none !important;
        }

        body {
            top: 0px !important;
        }

        #goog-gt-tt {
            display: none !important;
        }

        .goog-text-highlight {
            background-color: transparent !important;
            box-shadow: none !important;
        }
    </style>
</head>

<body x-data="{
        sidebarOpen:false,
        darkMode: localStorage.getItem('darkMode') === 'true'
    }" x-init="$watch('darkMode', v => {
                localStorage.setItem('darkMode', v);
                document.documentElement.classList.toggle('dark', v);
            });
            if(darkMode) document.documentElement.classList.add('dark');"
    class="bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-slate-100 antialiased">

    <div class="flex h-screen overflow-hidden">

        <!-- SIDEBAR -->
        <aside class="fixed inset-y-0 left-0 z-50 w-64 bg-slate-900 text-white
               transform transition-transform duration-300 -translate-x-full
               lg:static lg:translate-x-0" :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">

            <!-- Logo -->
            <div class="h-16 flex items-center justify-center border-b border-slate-800 bg-slate-950">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center">
                        <i class="fa-solid fa-cloud text-white text-sm"></i>
                    </div>
                    <span class="text-xl font-bold">CA Dash</span>
                </div>
            </div>

            <!-- Menu -->
            <nav class="px-4 py-6 space-y-2 text-base font-semibold">
                <a href="{{ route('client.dashboard') }}" @click="sidebarOpen=false" class="flex items-center gap-3 px-4 py-3 rounded-xl
               {{ request()->routeIs('client.dashboard')
    ? 'bg-blue-600 text-white'
    : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    <i class="fa-solid fa-gauge w-5"></i> Dashboard
                </a>

                <!-- Documents Menu -->
                <a href="{{ route('client.services.index') }}" 
                    class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('client.services.index') ? 'bg-slate-800 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    <i class="fa-solid fa-list-check w-5"></i> My Services
                </a>

                <div x-data="{ open: {{ request()->routeIs('client.document.*') ? 'true' : 'false' }} }">
                    <button @click="open = !open"
                        class="w-full flex items-center justify-between px-4 py-3 rounded-xl transition-colors duration-200
                        {{ request()->routeIs('client.document.*') ? 'text-white bg-slate-800' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                        <div class="flex items-center gap-3">
                            <i class="fa-solid fa-folder-open w-5"></i>
                            <span>Documents</span>
                        </div>
                        <i class="fa-solid fa-chevron-down text-xs transition-transform duration-200"
                            :class="open ? 'rotate-180' : ''"></i>
                    </button>

                    <div x-show="open" x-cloak class="pl-12 pr-2 py-2 space-y-1">
                        <a href="{{ route('client.document.index') }}"
                            class="block py-2 text-sm hover:text-white {{ request()->routeIs('client.document.index') ? 'text-blue-400' : 'text-slate-400' }}">
                            All Documents
                        </a>
                        <a href="{{ route('client.document.create') }}"
                            class="block py-2 text-sm hover:text-white {{ request()->routeIs('client.document.create') ? 'text-blue-400' : 'text-slate-400' }}">
                            Add New
                        </a>
                        <a href="{{ route('client.document.trash') }}"
                            class="block py-2 text-sm hover:text-white {{ request()->routeIs('client.document.trash') ? 'text-blue-400' : 'text-slate-400' }}">
                            Trash
                        </a>
                    </div>
                </div>

                <!-- Document Categories Menu -->
                <div x-data="{ open: {{ request()->routeIs('client.category.*') ? 'true' : 'false' }} }">
                    <button @click="open = !open"
                        class="w-full flex items-center justify-between px-4 py-3 rounded-xl transition-colors duration-200
                        {{ request()->routeIs('client.category.*') ? 'text-white bg-slate-800' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                        <div class="flex items-center gap-3">
                            <i class="fa-solid fa-tags w-5"></i>
                            <span>Categories</span>
                        </div>
                        <i class="fa-solid fa-chevron-down text-xs transition-transform duration-200"
                            :class="open ? 'rotate-180' : ''"></i>
                    </button>

                    <div x-show="open" x-cloak class="pl-12 pr-2 py-2 space-y-1">
                        <a href="{{ route('client.category.index') }}"
                            class="block py-2 text-sm hover:text-white {{ request()->routeIs('client.category.index') ? 'text-blue-400' : 'text-slate-400' }}">
                            All Categories
                        </a>
                        <a href="{{ route('client.category.create') }}"
                            class="block py-2 text-sm hover:text-white {{ request()->routeIs('client.category.create') ? 'text-blue-400' : 'text-slate-400' }}">
                            Add New
                        </a>
                        <a href="{{ route('client.category.trash') }}"
                            class="block py-2 text-sm hover:text-white {{ request()->routeIs('client.category.trash') ? 'text-blue-400' : 'text-slate-400' }}">
                            Trash
                        </a>
                    </div>
                </div>

                <!-- Clients Menu -->
                <div x-data="{ open: {{ request()->routeIs('client.client.*') ? 'true' : 'false' }} }">
                    <button @click="open = !open"
                        class="w-full flex items-center justify-between px-4 py-3 rounded-xl transition-colors duration-200
                        {{ request()->routeIs('client.client.*') ? 'text-white bg-slate-800' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                        <div class="flex items-center gap-3">
                            <i class="fa-solid fa-users w-5"></i>
                            <span>Clients</span>
                        </div>
                        <i class="fa-solid fa-chevron-down text-xs transition-transform duration-200"
                            :class="open ? 'rotate-180' : ''"></i>
                    </button>

                    <div x-show="open" x-cloak class="pl-12 pr-2 py-2 space-y-1">
                        <a href="{{ route('client.client.index') }}"
                            class="block py-2 text-sm hover:text-white {{ request()->routeIs('client.client.index') ? 'text-blue-400' : 'text-slate-400' }}">
                            All Clients
                        </a>
                        <a href="{{ route('client.client.create') }}"
                            class="block py-2 text-sm hover:text-white {{ request()->routeIs('client.client.create') ? 'text-blue-400' : 'text-slate-400' }}">
                            Add New
                        </a>
                        <a href="{{ route('client.client.trash') }}"
                            class="block py-2 text-sm hover:text-white {{ request()->routeIs('client.client.trash') ? 'text-blue-400' : 'text-slate-400' }}">
                            Trash
                        </a>
                    </div>
                </div>

                <a href="#" @click="sidebarOpen=false"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-300 hover:bg-slate-800 hover:text-white">
                    <i class="fa-solid fa-file-invoice-dollar w-5"></i> Invoices
                </a>

                <a href="#" @click="sidebarOpen=false"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-300 hover:bg-slate-800 hover:text-white">
                    <i class="fa-solid fa-chart-pie w-5"></i> Reports
                </a>
            </nav>

            <!-- Sidebar User -->
            <div class="p-4 border-t border-slate-800 bg-slate-950">
                <p class="text-base font-semibold truncate">{{ Auth::user()->name }}</p>
                <p class="text-sm text-slate-400 truncate">{{ Auth::user()->email }}</p>
            </div>
        </aside>

        <!-- OVERLAY (Mobile) -->
        <div x-show="sidebarOpen" x-cloak @click="sidebarOpen=false" class="fixed inset-0 bg-black/50 z-40 lg:hidden">
        </div>

        <!-- MAIN -->
        <div class="flex-1 flex flex-col min-w-0">

            <!-- HEADER -->
            <header class="sticky top-0 z-30 bg-white/80 dark:bg-slate-900/80
                   backdrop-blur border-b border-slate-200 dark:border-slate-800">
                <div class="flex items-center justify-between h-16 px-6">

                    <!-- Left -->
                    <div class="flex items-center gap-4">
                        <button @click="sidebarOpen=!sidebarOpen"
                            class="p-2 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800 lg:hidden">
                            <i class="fa-solid fa-bars text-lg"></i>
                        </button>

                        <h2 class="text-xl font-bold">
                            @yield('title', 'Dashboard')
                        </h2>
                    </div>

                    <!-- Right -->
                    <div class="flex items-center gap-5 text-base font-medium">

                        <!-- Time -->
                        <div x-data="{ time:'' }" x-init="setInterval(()=>time=new Date().toLocaleString(),1000)"
                            class="hidden md:block text-slate-600 dark:text-slate-400">
                            <span x-text="time"></span>
                        </div>

                        <!-- Dark Mode -->
                        <button @click="darkMode=!darkMode"
                            class="p-2 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800">
                            <i class="fa-solid" :class="darkMode ? 'fa-sun' : 'fa-moon'"></i>
                        </button>

                        <!-- Language Switcher -->
                        <!-- Copied from admin master -->
                        <div x-data="{ open:false }" class="relative">
                            <button @click="open=!open"
                                class="p-2 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800 flex items-center gap-2">
                                <i class="fa-solid fa-language text-lg"></i>
                                <span id="current-lang-label" class="text-sm font-semibold uppercase">EN</span>
                            </button>

                            <div x-show="open" x-cloak @click.away="open=false" class="absolute right-0 mt-3 w-40 z-50
                                        bg-white dark:bg-slate-800
                                        rounded-xl shadow-xl border dark:border-slate-700">
                                <ul class="py-2 text-sm text-slate-700 dark:text-slate-200">
                                    <li>
                                        <button onclick="changeLanguage('en')"
                                            class="w-full text-left px-4 py-2 hover:bg-slate-100 dark:hover:bg-slate-700">
                                            English
                                        </button>
                                    </li>
                                    <li>
                                        <button onclick="changeLanguage('hi')"
                                            class="w-full text-left px-4 py-2 hover:bg-slate-100 dark:hover:bg-slate-700">
                                            Hindi (हिंदी)
                                        </button>
                                    </li>
                                    <li>
                                        <button onclick="changeLanguage('mr')"
                                            class="w-full text-left px-4 py-2 hover:bg-slate-100 dark:hover:bg-slate-700">
                                            Marathi (मराठी)
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!-- Notifications -->
                        <div x-data="{ open:false }" class="relative">
                            <button @click="open=!open"
                                class="p-2 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800 relative">
                                <i class="fa-regular fa-bell"></i>
                                <span class="absolute top-2 right-2 w-2 h-2 bg-red-500 rounded-full"></span>
                            </button>

                            <div x-show="open" x-cloak @click.away="open=false" class="absolute right-0 mt-3 w-56 md:w-80 max-w-[calc(100vw-3rem)] z-50
                                    bg-white dark:bg-slate-800
                                    rounded-xl shadow-xl border dark:border-slate-700">
                                <div class="px-4 py-3 font-semibold border-b dark:border-slate-700">
                                    Notifications
                                </div>
                                <ul class="divide-y dark:divide-slate-700">
                                    <li class="px-4 py-3 hover:bg-slate-50 dark:hover:bg-slate-700">
                                        New invoice received
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!-- Profile -->
                        <div x-data="{ open:false }" class="relative">
                            <button @click="open=!open" class="flex items-center gap-2">
                                <div
                                    class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center text-white">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>
                                <span class="hidden md:block font-semibold">{{ Auth::user()->name }}</span>
                                <i class="fa-solid fa-chevron-down text-sm"></i>
                            </button>

                            <div x-show="open" x-cloak @click.away="open=false" class="absolute right-0 mt-3 w-56 max-w-[calc(100vw-3rem)] z-50
                                    bg-white dark:bg-slate-800
                                    rounded-xl shadow-xl border dark:border-slate-700">

                                <div class="px-4 py-3 border-b dark:border-slate-700">
                                    <p class="font-semibold">{{ Auth::user()->name }}</p>
                                    <p class="text-sm text-slate-500">{{ Auth::user()->email }}</p>
                                </div>

                                <a href="{{ route('client.profile.edit') }}"
                                    class="block px-4 py-3 text-base hover:bg-slate-50 dark:hover:bg-slate-700">
                                    Profile
                                </a>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="w-full text-left px-4 py-3 text-base text-red-600 hover:bg-red-50">
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </header>

            <!-- CONTENT -->
            <main class="flex-1 overflow-y-auto p-6 text-base font-medium">
                @yield('content')
            </main>

            <!-- FOOTER -->
            <footer class="border-t border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900">
                <div class="px-6 py-4 text-base font-medium text-slate-500 flex justify-between">
                    <span>© {{ date('Y') }} CA Dash</span>
                    <span>Client Panel</span>
                </div>
            </footer>

        </div>
    </div>

    <!-- Google Translate Script -->
    <div id="google_translate_element" style="display:none;"></div>

    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                pageLanguage: 'en',
                includedLanguages: 'en,hi,mr',
                autoDisplay: false
            }, 'google_translate_element');
        }
    </script>
    <script type="text/javascript"
        src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

    <script>
        function changeLanguage(lang) {
            var date = new Date();
            date.setTime(date.getTime() + (30 * 24 * 60 * 60 * 1000)); // 30 days
            var expires = "; expires=" + date.toUTCString();

            // Set the googtrans cookie for domain and path
            document.cookie = "googtrans=/en/" + lang + expires + "; path=/";
            document.cookie = "googtrans=/en/" + lang + expires + "; path=/; domain=" + window.location.hostname;

            // Reload to apply translation
            window.location.reload();
        }

        // Optional: Update current language display on load
        document.addEventListener('DOMContentLoaded', function () {
            var match = document.cookie.match(new RegExp('(^| )googtrans=([^;]+)'));
            if (match) {
                var lang = match[2].split('/')[2];
                var label = document.getElementById('current-lang-label');
                if (label) label.innerText = lang.toUpperCase();
            }
        });
    </script>
</body>

</html>