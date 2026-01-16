<x-auth-layout>
    <div class="h-screen flex items-center justify-center bg-gradient-to-br from-emerald-50 to-slate-100 px-4">
        <div class="relative w-full max-w-sm bg-white/90 backdrop-blur rounded-2xl border border-slate-200 shadow-xl">
            <div class="h-1 w-full bg-emerald-600 rounded-t-2xl"></div>
            <div class="px-8 pt-8 pb-6 text-center">
                <div
                    class="mx-auto mb-4 w-12 h-12 rounded-xl bg-emerald-600 flex items-center justify-center shadow-lg">
                    <i class="fa-solid fa-user-group text-white text-lg"></i>
                </div>
                <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Staff Registration</h1>
                <p class="mt-1 text-sm text-emerald-600 font-medium italic">Join the Staff Team</p>
            </div>

            <div class="px-8 pb-8">
                <form method="POST" action="{{ route('register.staff') }}" class="space-y-5">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Full Name</label>
                        <input type="text" name="name" value="{{ old('name') }}" required autofocus
                            class="w-full px-4 py-2.5 rounded-lg bg-slate-50 border border-slate-300 focus:border-emerald-600 focus:ring-4 focus:ring-emerald-600/10 transition text-sm"
                            placeholder="John Doe">
                        <x-input-error :messages="$errors->get('name')" class="mt-1 text-xs" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Email address</label>
                        <input type="email" name="email" value="{{ old('email') }}" required
                            class="w-full px-4 py-2.5 rounded-lg bg-slate-50 border border-slate-300 focus:border-emerald-600 focus:ring-4 focus:ring-emerald-600/10 transition text-sm"
                            placeholder="staff@company.com">
                        <x-input-error :messages="$errors->get('email')" class="mt-1 text-xs" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Password</label>
                        <input type="password" name="password" required
                            class="w-full px-4 py-2.5 rounded-lg bg-slate-50 border border-slate-300 focus:border-emerald-600 focus:ring-4 focus:ring-emerald-600/10 transition text-sm"
                            placeholder="••••••••">
                        <x-input-error :messages="$errors->get('password')" class="mt-1 text-xs" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Confirm Password</label>
                        <input type="password" name="password_confirmation" required
                            class="w-full px-4 py-2.5 rounded-lg bg-slate-50 border border-slate-300 focus:border-emerald-600 focus:ring-4 focus:ring-emerald-600/10 transition text-sm"
                            placeholder="••••••••">
                    </div>

                    <button
                        class="w-full py-2.5 rounded-lg font-semibold text-white bg-emerald-600 hover:bg-emerald-700 shadow-md active:scale-[0.98] transition">
                        Register as Staff
                    </button>

                    <p class="text-center text-sm text-slate-500 mt-6">
                        Already have an account? <a href="{{ route('login.staff') }}"
                            class="font-semibold text-emerald-600 hover:underline">Sign in</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</x-auth-layout>