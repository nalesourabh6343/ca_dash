@extends('layouts.admin.master')
@section('title', 'Staff Details')

@section('content')
    <div class="container mx-auto max-w-5xl">
        <div class="flex items-center gap-4 mb-6">
            <a href="{{ route('admin.staffs.index') }}"
                class="p-2 rounded-full hover:bg-slate-100 dark:hover:bg-slate-700 transition">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
            <h1 class="text-2xl font-bold text-slate-800 dark:text-white">Staff Profile</h1>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Left Column: Profile Card -->
            <div class="lg:col-span-1 space-y-6">
                <div
                    class="bg-white dark:bg-slate-800 rounded-2xl p-6 shadow-sm border border-slate-200 dark:border-slate-700 text-center">
                    <div class="relative w-32 h-32 mx-auto mb-4">
                        @if($staff->image)
                            <img src="{{ Storage::url($staff->image) }}"
                                class="w-full h-full rounded-full object-cover border-4 border-slate-50 dark:border-slate-700 font-bold shadow-md">
                        @else
                            <div
                                class="w-full h-full rounded-full bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 flex items-center justify-center text-4xl font-bold">
                                {{ strtoupper(substr($staff->name, 0, 1)) }}
                            </div>
                        @endif
                    </div>
                    <h2 class="text-xl font-bold text-slate-900 dark:text-white mb-1">{{ $staff->name }}</h2>
                    <p class="text-slate-500 dark:text-slate-400 text-sm mb-4">Staff Member</p>

                    <div class="flex flex-col gap-2">
                        <a href="{{ route('admin.staffs.edit', $staff->staff_id) }}"
                            class="w-full py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                            <i class="fa-solid fa-pen-to-square mr-1"></i> Edit Profile
                        </a>
                    </div>
                </div>

                <div
                    class="bg-white dark:bg-slate-800 rounded-2xl p-6 shadow-sm border border-slate-200 dark:border-slate-700">
                    <h3 class="font-bold text-slate-900 dark:text-white mb-4">Contact Info</h3>
                    <div class="space-y-4">
                        <div class="flex items-center gap-3">
                            <i class="fa-solid fa-envelope text-slate-400 w-5"></i>
                            <div>
                                <p class="text-xs text-slate-500 uppercase tracking-wider">Email</p>
                                <p class="text-sm dark:text-slate-300">{{ $staff->email }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <i class="fa-solid fa-phone text-slate-400 w-5"></i>
                            <div>
                                <p class="text-xs text-slate-500 uppercase tracking-wider">Phone</p>
                                <p class="text-sm dark:text-slate-300">{{ $staff->phone }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Account Details -->
            <div class="lg:col-span-2 space-y-6">
                <div
                    class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700 overflow-hidden">
                    <div
                        class="px-6 py-4 border-b border-slate-100 dark:border-slate-700 flex justify-between items-center">
                        <h3 class="font-bold text-slate-900 dark:text-white">Additional Details</h3>
                    </div>
                    <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <p class="text-xs text-slate-500 uppercase tracking-wider mb-1">Pincode</p>
                            <p class="font-medium dark:text-slate-300">{{ $staff->pincode ?? 'Not provided' }}</p>
                        </div>
                        <div class="md:col-span-2">
                            <p class="text-xs text-slate-500 uppercase tracking-wider mb-1">Address</p>
                            <p class="font-medium dark:text-slate-300 text-sm leading-relaxed">
                                {{ $staff->address ?? 'Not provided' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-slate-500 uppercase tracking-wider mb-1">Member Since</p>
                            <p class="font-medium dark:text-slate-300">{{ $staff->created_at->format('M d, Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection