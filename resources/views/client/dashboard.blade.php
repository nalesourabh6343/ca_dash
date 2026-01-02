@extends('layouts.client.master')
@section('title')
    Client Dashboard
@endsection
@section('content')

    <div class="mb-8">
        <h1 class="text-3xl md:text-4xl font-bold text-slate-800 dark:text-white">
            Welcome to <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-600">Client
                Dashboard</span>
        </h1>
        <p class="text-slate-500 dark:text-slate-400 mt-2">Here's what's happening with your account today.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        <!-- Metric Card 1 -->
        <div
            class="group bg-white dark:bg-slate-800 rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-slate-200 dark:border-slate-700 p-6 flex items-start justify-between relative overflow-hidden">
            <div class="relative z-10">
                <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Total Invoices</p>
                <h3 class="text-3xl font-bold text-slate-800 dark:text-white mt-3">12</h3>
                <p
                    class="text-xs font-semibold text-green-500 mt-2 flex items-center gap-1 bg-green-50 dark:bg-green-900/30 w-fit px-2 py-1 rounded-full">
                    <i class="fa-solid fa-arrow-trend-up"></i> All Paid
                </p>
            </div>
            <div
                class="p-4 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl text-white shadow-lg shadow-blue-500/30 group-hover:scale-110 transition-transform duration-300">
                <i class="fa-solid fa-file-invoice-dollar text-xl"></i>
            </div>
            <!-- Decorative Circle -->
            <div
                class="absolute -bottom-4 -right-4 w-24 h-24 bg-blue-50 dark:bg-slate-700/50 rounded-full opacity-50 group-hover:scale-150 transition-transform duration-500 z-0">
            </div>
        </div>

        <!-- Metric Card 2 -->
        <div
            class="group bg-white dark:bg-slate-800 rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-slate-200 dark:border-slate-700 p-6 flex items-start justify-between relative overflow-hidden">
            <div class="relative z-10">
                <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Active Services</p>
                <h3 class="text-3xl font-bold text-slate-800 dark:text-white mt-3">3</h3>
                <p
                    class="text-xs font-semibold text-green-500 mt-2 flex items-center gap-1 bg-green-50 dark:bg-green-900/30 w-fit px-2 py-1 rounded-full">
                    <i class="fa-solid fa-check"></i> Active
                </p>
            </div>
            <div
                class="p-4 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-xl text-white shadow-lg shadow-indigo-500/30 group-hover:scale-110 transition-transform duration-300">
                <i class="fa-solid fa-briefcase text-xl"></i>
            </div>
            <!-- Decorative Circle -->
            <div
                class="absolute -bottom-4 -right-4 w-24 h-24 bg-indigo-50 dark:bg-slate-700/50 rounded-full opacity-50 group-hover:scale-150 transition-transform duration-500 z-0">
            </div>
        </div>

        <!-- Metric Card 3 -->
        <div
            class="group bg-white dark:bg-slate-800 rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-slate-200 dark:border-slate-700 p-6 flex items-start justify-between relative overflow-hidden">
            <div class="relative z-10">
                <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Pending Actions</p>
                <h3 class="text-3xl font-bold text-slate-800 dark:text-white mt-3">1</h3>
                <p
                    class="text-xs font-semibold text-amber-500 mt-2 flex items-center gap-1 bg-amber-50 dark:bg-amber-900/30 w-fit px-2 py-1 rounded-full">
                    <i class="fa-solid fa-circle-exclamation"></i> Documents
                </p>
            </div>
            <div
                class="p-4 bg-gradient-to-br from-amber-500 to-amber-600 rounded-xl text-white shadow-lg shadow-amber-500/30 group-hover:scale-110 transition-transform duration-300">
                <i class="fa-solid fa-bell text-xl"></i>
            </div>
            <!-- Decorative Circle -->
            <div
                class="absolute -bottom-4 -right-4 w-24 h-24 bg-amber-50 dark:bg-slate-700/50 rounded-full opacity-50 group-hover:scale-150 transition-transform duration-500 z-0">
            </div>
        </div>

        <!-- Metric Card 4 -->
        <div
            class="group bg-white dark:bg-slate-800 rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-slate-200 dark:border-slate-700 p-6 flex items-start justify-between relative overflow-hidden">
            <div class="relative z-10">
                <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Support Tickets</p>
                <h3 class="text-3xl font-bold text-slate-800 dark:text-white mt-3">0</h3>
                <p
                    class="text-xs font-semibold text-slate-500 dark:text-slate-400 mt-2 flex items-center gap-1 bg-slate-50 dark:bg-slate-700/30 w-fit px-2 py-1 rounded-full">
                    <i class="fa-regular fa-clock"></i> All Closed
                </p>
            </div>
            <div
                class="p-4 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-xl text-white shadow-lg shadow-emerald-500/30 group-hover:scale-110 transition-transform duration-300">
                <i class="fa-solid fa-headset text-xl"></i>
            </div>
            <!-- Decorative Circle -->
            <div
                class="absolute -bottom-4 -right-4 w-24 h-24 bg-emerald-50 dark:bg-slate-700/50 rounded-full opacity-50 group-hover:scale-150 transition-transform duration-500 z-0">
            </div>
        </div>
    </div>
@endsection