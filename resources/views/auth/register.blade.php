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
                    <i class="fa-solid fa-user-plus text-white text-lg"></i>
                </div>

                <h1 class="text-2xl font-bold text-slate-900 tracking-tight">
                    Create account
                </h1>

                <p class="mt-1 text-sm text-slate-500">
                    Join us to manage your dashboard
                </p>
            </div>

            <!-- Form -->
            <div class="px-8 pb-8">
                <form method="POST" action="{{ route('register') }}" class="space-y-5">
                    @csrf

                    <!-- Name -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">
                            Full name
                        </label>
                        <input type="text" name="name" value="{{ old('name') }}" required autofocus
                            class="w-full px-4 py-2.5 rounded-lg bg-slate-50 border border-slate-300
                                   focus:border-blue-600 focus:ring-4 focus:ring-blue-600/10
                                   transition text-sm"
                            placeholder="John Doe">
                        <x-input-error :messages="$errors->get('name')" class="mt-1 text-xs" />
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">
                            Email address
                        </label>
                        <input type="email" name="email" value="{{ old('email') }}" required
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

                    <!-- Confirm Password -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">
                            Confirm password
                        </label>
                        <input type="password" name="password_confirmation" required
                            class="w-full px-4 py-2.5 rounded-lg bg-slate-50 border border-slate-300
                                   focus:border-blue-600 focus:ring-4 focus:ring-blue-600/10
                                   transition text-sm"
                            placeholder="••••••••">
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 text-xs" />
                    </div>

                    <!-- Submit -->
                    <button
                        class="w-full py-2.5 rounded-lg font-semibold text-white
                               bg-gradient-to-r from-blue-600 to-indigo-600
                               hover:from-blue-700 hover:to-indigo-700
                               shadow-md hover:shadow-lg
                               active:scale-[0.98] transition">
                        Create account
                    </button>

                    <!-- Login -->
                    <p class="text-center text-sm text-slate-500 mt-4">
                        Already have an account?
                        <a href="{{ route('login') }}"
                            class="font-semibold text-blue-600 hover:underline">
                            Sign in
                        </a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</x-auth-layout>
