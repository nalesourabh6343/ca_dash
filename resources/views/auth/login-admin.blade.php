<x-auth-layout>
    <div class="h-screen flex items-center justify-center bg-gradient-to-br from-red-50 to-slate-100 px-4">
        <div class="relative w-full max-w-sm bg-white/90 backdrop-blur rounded-2xl border border-slate-200 shadow-xl">
            <div class="h-1 w-full bg-red-600 rounded-t-2xl"></div>
            <div class="px-8 pt-8 pb-6 text-center">
                <div class="mx-auto mb-4 w-12 h-12 rounded-xl bg-red-600 flex items-center justify-center shadow-lg">
                    <i class="fa-solid fa-user-shield text-white text-lg"></i>
                </div>
                <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Admin Login</h1>
                <p class="mt-1 text-sm text-red-600 font-medium">Control Panel Access</p>
            </div>

            <div class="px-8 pb-8">
                <x-auth-session-status class="mb-4" :status="session('status')" />
                <form method="POST" action="{{ route('login.admin') }}" class="space-y-5">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Email address</label>
                        <input type="email" name="email" value="{{ old('email') }}" required autofocus
                            class="w-full px-4 py-2.5 rounded-lg bg-slate-50 border border-slate-300 focus:border-red-600 focus:ring-4 focus:ring-red-600/10 transition text-sm"
                            placeholder="admin@system.com">
                        <x-input-error :messages="$errors->get('email')" class="mt-1 text-xs" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Password</label>
                        <input type="password" name="password" required
                            class="w-full px-4 py-2.5 rounded-lg bg-slate-50 border border-slate-300 focus:border-red-600 focus:ring-4 focus:ring-red-600/10 transition text-sm"
                            placeholder="••••••••">
                        <x-input-error :messages="$errors->get('password')" class="mt-1 text-xs" />
                    </div>
                    <button
                        class="w-full py-2.5 rounded-lg font-semibold text-white bg-red-600 hover:bg-red-700 shadow-md active:scale-[0.98] transition">
                        Sign in as Admin
                    </button>
                    <p class="text-center text-sm text-slate-500 mt-4">
                        New admin? <a href="{{ route('register.admin') }}"
                            class="font-semibold text-red-600 hover:underline">Register here</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</x-auth-layout>