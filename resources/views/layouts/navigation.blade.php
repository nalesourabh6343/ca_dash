<nav x-data="{ open: false }"
     class="bg-white/80 backdrop-blur border-b border-slate-200 sticky top-0 z-50">

    <!-- Primary Navigation -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            <!-- Left -->
            <div class="flex items-center gap-10">

                <!-- Logo -->
                <a href="{{ route('dashboard') }}"
                   class="flex items-center gap-2">
                    <x-application-logo
                        class="h-9 w-auto fill-current text-blue-600" />
                    <span class="font-semibold text-slate-900 hidden sm:block">
                        {{ config('app.name') }}
                    </span>
                </a>

                <!-- Desktop Links -->
                <div class="hidden sm:flex items-center gap-6">
                    <x-nav-link
                        :href="route('dashboard')"
                        :active="request()->routeIs('dashboard')"
                        class="text-sm font-medium">
                        Dashboard
                    </x-nav-link>
                </div>
            </div>

            <!-- Right -->
            <div class="hidden sm:flex sm:items-center gap-4">

                <!-- User Dropdown -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="flex items-center gap-2 px-3 py-2 rounded-lg
                                   text-sm font-medium text-slate-700
                                   hover:bg-slate-100 transition">
                            <span>{{ Auth::user()->name }}</span>

                            <svg class="h-4 w-4 text-slate-500"
                                 xmlns="http://www.w3.org/2000/svg"
                                 viewBox="0 0 20 20"
                                 fill="currentColor">
                                <path fill-rule="evenodd"
                                      d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.25a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z"
                                      clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            Profile
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link
                                :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                Log out
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Mobile Hamburger -->
            <div class="flex items-center sm:hidden">
                <button
                    @click="open = !open"
                    class="p-2 rounded-lg text-slate-600 hover:bg-slate-100 transition">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor"
                         viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open }"
                              stroke-linecap="round" stroke-linejoin="round"
                              stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open }"
                              stroke-linecap="round" stroke-linejoin="round"
                              stroke-width="2"
                              d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div x-show="open" x-transition
         class="sm:hidden border-t border-slate-200 bg-white">

        <div class="px-4 pt-4 pb-3 space-y-2">
            <x-responsive-nav-link
                :href="route('dashboard')"
                :active="request()->routeIs('dashboard')">
                Dashboard
            </x-responsive-nav-link>
        </div>

        <div class="border-t border-slate-200 px-4 py-4">
            <div class="text-sm font-medium text-slate-800">
                {{ Auth::user()->name }}
            </div>
            <div class="text-xs text-slate-500">
                {{ Auth::user()->email }}
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    Profile
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link
                        :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        Log out
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
