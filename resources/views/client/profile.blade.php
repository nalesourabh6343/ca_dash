@extends('layouts.client.master')
@section('title', 'Profile Settings')

@section('content')
    <div class="container mx-auto max-w-7xl">
        <!-- Page Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-slate-800 dark:text-white">Profile Settings</h1>
            <p class="text-slate-500 dark:text-slate-400 mt-2">Manage your account information and password.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column: User Card -->
            <div class="lg:col-span-1 space-y-8">

                <!-- User Card -->
                <div
                    class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700 p-6 text-center relative overflow-hidden">
                    <div class="w-full h-24 bg-gradient-to-r from-blue-500 to-indigo-600 absolute top-0 left-0"></div>

                    <div class="relative z-10 mt-12">
                        <div class="w-24 h-24 bg-white dark:bg-slate-800 rounded-full mx-auto p-1 shadow-lg">
                            <div
                                class="w-full h-full bg-slate-200 dark:bg-slate-700 rounded-full flex items-center justify-center text-2xl font-bold text-slate-600 dark:text-slate-300">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                        </div>
                        <h2 class="text-xl font-bold text-slate-800 dark:text-white mt-4">{{ Auth::user()->name }}</h2>
                        <p class="text-slate-500 dark:text-slate-400">{{ Auth::user()->email }}</p>

                        <div class="mt-6 flex justify-center gap-3">
                            <span
                                class="px-3 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400">
                                Client
                            </span>
                        </div>
                    </div>
                </div>

                <!-- About Us Section (Maybe irrelevant for Client, but keeping per request) -->
                <!-- <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700 p-6">
                            <h3 class="text-lg font-bold text-slate-800 dark:text-white mb-4 flex items-center gap-2">
                                <i class="fa-solid fa-circle-info text-blue-500"></i> About Us Content
                            </h3>
                            <p class="text-slate-500 dark:text-slate-400 text-sm mb-4">
                                Update the "About Us" information displayed on the website.
                            </p>
                            <form action="#" method="POST"> 
                                @csrf
                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Company Description</label>
                                        <textarea rows="4" class="w-full rounded-lg border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-800 dark:text-slate-200 focus:border-blue-500 focus:ring-blue-500" placeholder="Enter company description here..."></textarea>
                                    </div>
                                    <button type="button" class="w-full px-4 py-2 bg-slate-800 dark:bg-slate-700 text-white rounded-lg hover:bg-slate-700 dark:hover:bg-slate-600 transition">
                                        Save Information
                                    </button>
                                </div>
                            </form>
                        </div> -->
            </div>

            <!-- Right Column: Profile & Password Forms -->
            <div class="lg:col-span-2 space-y-8">

                <!-- Profile Information -->
                <div
                    class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700 p-6">
                    <h3 class="text-lg font-bold text-slate-800 dark:text-white mb-6 flex items-center gap-2">
                        <i class="fa-solid fa-user-pen text-indigo-500"></i> Profile Information
                    </h3>

                    <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
                        @csrf
                        @method('patch')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="name"
                                    class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Name</label>
                                <input id="name" name="name" type="text" value="{{ old('name', Auth::user()->name) }}"
                                    required autofocus autocomplete="name"
                                    class="w-full rounded-lg border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-800 dark:text-slate-200 focus:border-indigo-500 focus:ring-indigo-500">
                                @if($errors->get('name'))
                                    <p class="mt-2 text-sm text-red-600">{{ $errors->get('name')[0] }}</p>
                                @endif
                            </div>

                            <div>
                                <label for="email"
                                    class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Email</label>
                                <input id="email" name="email" type="email" value="{{ old('email', Auth::user()->email) }}"
                                    required autocomplete="username"
                                    class="w-full rounded-lg border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-800 dark:text-slate-200 focus:border-indigo-500 focus:ring-indigo-500">
                                @if($errors->get('email'))
                                    <p class="mt-2 text-sm text-red-600">{{ $errors->get('email')[0] }}</p>
                                @endif
                            </div>
                        </div>

                        <div class="flex items-center gap-4">
                            <button type="submit"
                                class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition font-medium">
                                Save Changes
                            </button>
                            @if (session('status') === 'profile-updated')
                                <p x-data="{ show: true }" x-show="show" x-transition
                                    x-init="setTimeout(() => show = false, 2000)"
                                    class="text-sm text-green-600 dark:text-green-400">
                                    Saved.
                                </p>
                            @endif
                        </div>
                    </form>
                </div>

                <!-- Update Password -->
                <div
                    class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700 p-6">
                    <h3 class="text-lg font-bold text-slate-800 dark:text-white mb-6 flex items-center gap-2">
                        <i class="fa-solid fa-lock text-emerald-500"></i> Update Password
                    </h3>

                    <form method="post" action="{{ route('password.update') }}" class="space-y-6"
                        x-data="{ showCurrent: false, showNew: false, showConfirm: false }">
                        @csrf
                        @method('put')

                        <div>
                            <label for="current_password"
                                class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Current
                                Password</label>
                            <div class="relative">
                                <input id="current_password" name="current_password"
                                    :type="showCurrent ? 'text' : 'password'" autocomplete="current-password"
                                    class="w-full rounded-lg border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-800 dark:text-slate-200 focus:border-emerald-500 focus:ring-emerald-500 pr-10">
                                <button type="button" @click="showCurrent = !showCurrent"
                                    class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-slate-600">
                                    <i class="fa-solid" :class="showCurrent ? 'fa-eye-slash' : 'fa-eye'"></i>
                                </button>
                            </div>
                            @if($errors->updatePassword->get('current_password'))
                                <p class="mt-2 text-sm text-red-600">{{ $errors->updatePassword->get('current_password')[0] }}
                                </p>
                            @endif
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="password"
                                    class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">New
                                    Password</label>
                                <div class="relative">
                                    <input id="password" name="password" :type="showNew ? 'text' : 'password'"
                                        autocomplete="new-password"
                                        class="w-full rounded-lg border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-800 dark:text-slate-200 focus:border-emerald-500 focus:ring-emerald-500 pr-10">
                                    <button type="button" @click="showNew = !showNew"
                                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-slate-600">
                                        <i class="fa-solid" :class="showNew ? 'fa-eye-slash' : 'fa-eye'"></i>
                                    </button>
                                </div>
                                @if($errors->updatePassword->get('password'))
                                    <p class="mt-2 text-sm text-red-600">{{ $errors->updatePassword->get('password')[0] }}</p>
                                @endif
                            </div>

                            <div>
                                <label for="password_confirmation"
                                    class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Confirm
                                    Password</label>
                                <div class="relative">
                                    <input id="password_confirmation" name="password_confirmation"
                                        :type="showConfirm ? 'text' : 'password'" autocomplete="new-password"
                                        class="w-full rounded-lg border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-800 dark:text-slate-200 focus:border-emerald-500 focus:ring-emerald-500 pr-10">
                                    <button type="button" @click="showConfirm = !showConfirm"
                                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-slate-600">
                                        <i class="fa-solid" :class="showConfirm ? 'fa-eye-slash' : 'fa-eye'"></i>
                                    </button>
                                </div>
                                @if($errors->updatePassword->get('password_confirmation'))
                                    <p class="mt-2 text-sm text-red-600">
                                        {{ $errors->updatePassword->get('password_confirmation')[0] }}
                                    </p>
                                @endif
                            </div>
                        </div>

                        <div class="flex items-center gap-4">
                            <button type="submit"
                                class="px-6 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition font-medium">
                                Update Password
                            </button>
                            @if (session('status') === 'password-updated')
                                <p x-data="{ show: true }" x-show="show" x-transition
                                    x-init="setTimeout(() => show = false, 2000)"
                                    class="text-sm text-green-600 dark:text-green-400">
                                    Saved.
                                </p>
                            @endif
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection