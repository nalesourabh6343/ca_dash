<x-auth-layout>
    <div class="h-screen flex items-center justify-center bg-gradient-to-br from-slate-100 to-slate-200 px-4">

        <div
            class="relative w-full max-w-sm bg-white/90 backdrop-blur rounded-2xl border border-slate-200 shadow-[0_20px_40px_rgba(0,0,0,0.08)]">

            <!-- Accent line -->
            <div class="h-1 w-full bg-gradient-to-r from-blue-600 to-indigo-600 rounded-t-2xl"></div>

            <!-- Header -->
            <div class="px-8 pt-8 pb-6 text-center">
                <div
                    class="mx-auto mb-4 w-12 h-12 rounded-xl bg-gradient-to-tr from-blue-600 to-indigo-500 flex items-center justify-center shadow-md">
                    <i class="fa-solid fa-user-shield text-white text-lg"></i>
                </div>

                <h1 class="text-2xl font-bold text-slate-900 tracking-tight">
                    Welcome back
                </h1>

                <p class="mt-1 text-sm text-slate-500">
                    Sign in to your dashboard
                </p>
            </div>

            <!-- Form -->
            <div class="px-8 pb-8">
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    <!-- Email -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">
                            Email address
                        </label>
                        <input type="email" name="email" required autofocus
                            class="w-full px-4 py-2.5 rounded-lg bg-slate-50 border border-slate-300
                                   focus:border-blue-600 focus:ring-4 focus:ring-blue-600/10
                                   transition text-sm"
                            placeholder="you@company.com">
                        <x-input-error :messages="$errors->get('email')" class="mt-1 text-xs" />
                    </div>

                    <!-- Password -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">
                            Password
                        </label>
                        <input type="password" name="password" required
                            class="w-full px-4 py-2.5 rounded-lg bg-slate-50 border border-slate-300
                                   focus:border-blue-600 focus:ring-4 focus:ring-blue-600/10
                                   transition text-sm"
                            placeholder="••••••••">
                        <x-input-error :messages="$errors->get('password')" class="mt-1 text-xs" />
                    </div>

                    <!-- Remember -->
                    <div class="flex items-center justify-between">
                        <label class="flex items-center gap-2 text-sm text-slate-600">
                            <input type="checkbox" name="remember"
                                class="h-4 w-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                            Remember me
                        </label>

                        <a href="{{ route('password.request') }}"
                            class="text-sm font-medium text-blue-600 hover:text-blue-700">
                            Forgot?
                        </a>
                    </div>

                    <!-- Submit -->
                    <button
                        class="w-full py-2.5 rounded-lg font-semibold text-white
                               bg-gradient-to-r from-blue-600 to-indigo-600
                               hover:from-blue-700 hover:to-indigo-700
                               shadow-md hover:shadow-lg
                               active:scale-[0.98] transition">
                        Sign in
                    </button>

                    <!-- Register -->
                    <p class="text-center text-sm text-slate-500 mt-4">
                        Don’t have an account?
                        <a href="{{ route('register') }}"
                            class="font-semibold text-blue-600 hover:underline">
                            Sign up
                        </a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</x-auth-layout>
