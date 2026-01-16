<x-auth-layout>
    <div class="h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 to-slate-100 px-4">
        <div class="relative w-full max-w-sm bg-white/90 backdrop-blur rounded-2xl border border-slate-200 shadow-xl">
            <div class="h-1 w-full bg-blue-600 rounded-t-2xl"></div>
            <div class="px-8 pt-8 pb-6 text-center">
                <div class="mx-auto mb-4 w-12 h-12 rounded-xl bg-blue-600 flex items-center justify-center shadow-lg">
                    <i class="fa-solid fa-user-tag text-white text-lg"></i>
                </div>
                <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Client Login</h1>
                <p class="mt-1 text-sm text-blue-600 font-medium">Access your Client Portal</p>
            </div>

            <div class="px-8 pb-8">
                <x-auth-session-status class="mb-4" :status="session('status')" />
                <form method="POST" action="{{ route('login.client') }}" class="space-y-5">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Email address</label>
                        <input type="email" name="email" value="{{ old('email') }}" required autofocus
                            class="w-full px-4 py-2.5 rounded-lg bg-slate-50 border border-slate-300 focus:border-blue-600 focus:ring-4 focus:ring-blue-600/10 transition text-sm"
                            placeholder="client@company.com">
                        <x-input-error :messages="$errors->get('email')" class="mt-1 text-xs" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Password</label>
                        <input type="password" name="password" required
                            class="w-full px-4 py-2.5 rounded-lg bg-slate-50 border border-slate-300 focus:border-blue-600 focus:ring-4 focus:ring-blue-600/10 transition text-sm"
                            placeholder="••••••••">
                        <x-input-error :messages="$errors->get('password')" class="mt-1 text-xs" />
                    </div>
                    <button
                        class="w-full py-2.5 rounded-lg font-semibold text-white bg-blue-600 hover:bg-blue-700 shadow-md active:scale-[0.98] transition">
                        Sign in as Client
                    </button>
                    <p class="text-center text-sm text-slate-500 mt-4">
                        Don't have an account? <a href="{{ route('register.client') }}"
                            class="font-semibold text-blue-600 hover:underline">Register here</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</x-auth-layout>