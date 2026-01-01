<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-slate-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>

            <span class="inline-flex items-center px-3 py-1 text-sm font-medium rounded-full
                       bg-green-100 text-green-700">
                ● Active
            </span>
        </div>
    </x-slot>

    <div class="py-10 bg-slate-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Welcome Card -->
            <div class="bg-white shadow-sm rounded-xl border border-slate-200">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-slate-900">
                        Welcome back 👋
                    </h3>
                    <p class="mt-1 text-sm text-slate-600">
                        You’re successfully logged in. Here’s a quick overview of your account.
                    </p>
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

                <!-- Card -->
                <div class="bg-white rounded-xl border border-slate-200 shadow-sm">
                    <div class="p-6">
                        <p class="text-sm text-slate-500">Total Clients</p>
                        <h4 class="mt-2 text-3xl font-bold text-slate-900">128</h4>
                    </div>
                </div>

                <!-- Card -->
                <div class="bg-white rounded-xl border border-slate-200 shadow-sm">
                    <div class="p-6">
                        <p class="text-sm text-slate-500">Active Projects</p>
                        <h4 class="mt-2 text-3xl font-bold text-slate-900">24</h4>
                    </div>
                </div>

                <!-- Card -->
                <div class="bg-white rounded-xl border border-slate-200 shadow-sm">
                    <div class="p-6">
                        <p class="text-sm text-slate-500">Pending Tasks</p>
                        <h4 class="mt-2 text-3xl font-bold text-slate-900">7</h4>
                    </div>
                </div>

            </div>

            <!-- Activity Card -->
            <div class="bg-white shadow-sm rounded-xl border border-slate-200">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-slate-900">
                        Recent Activity
                    </h3>
                    <ul class="mt-4 space-y-3 text-sm text-slate-600">
                        <li>✔ Client profile updated</li>
                        <li>✔ New project added</li>
                        <li>✔ Invoice generated</li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>