@extends('layouts.admin.master')
@section('title', 'Admin Dashboard')

@section('content')
    <div class="mb-8">
        <h1 class="text-3xl md:text-4xl font-bold text-slate-800 dark:text-white">
            Welcome to <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-600">Admin Dashboard</span>
        </h1>
        <p class="text-slate-500 dark:text-slate-400 mt-2">Here's what's happening with your business today.</p>
    </div>

    <!-- Quick Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Clients Card -->
        <div class="group bg-white dark:bg-slate-800 rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-slate-200 dark:border-slate-700 p-6 flex items-start justify-between relative overflow-hidden">
            <div class="relative z-10">
                <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Total Clients</p>
                <h3 class="text-3xl font-bold text-slate-800 dark:text-white mt-3">{{ number_format($totalClients) }}</h3>
                <a href="{{ route('admin.client.index') }}" class="text-xs font-semibold text-blue-500 mt-2 flex items-center gap-1 hover:underline">
                    View all clients <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
            <div class="p-4 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl text-white shadow-lg shadow-blue-500/30 group-hover:scale-110 transition-transform duration-300">
                <i class="fa-solid fa-users text-xl"></i>
            </div>
            <div class="absolute -bottom-4 -right-4 w-24 h-24 bg-blue-50 dark:bg-slate-700/50 rounded-full opacity-50 group-hover:scale-150 transition-transform duration-500 z-0"></div>
        </div>

        <!-- Businesses Card -->
        <div class="group bg-white dark:bg-slate-800 rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-slate-200 dark:border-slate-700 p-6 flex items-start justify-between relative overflow-hidden">
            <div class="relative z-10">
                <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Businesses</p>
                <h3 class="text-3xl font-bold text-slate-800 dark:text-white mt-3">{{ number_format($totalBusinesses) }}</h3>
                <a href="{{ route('admin.business.index') }}" class="text-xs font-semibold text-indigo-500 mt-2 flex items-center gap-1 hover:underline">
                    Manage businesses <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
            <div class="p-4 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-xl text-white shadow-lg shadow-indigo-500/30 group-hover:scale-110 transition-transform duration-300">
                <i class="fa-solid fa-building text-xl"></i>
            </div>
            <div class="absolute -bottom-4 -right-4 w-24 h-24 bg-indigo-50 dark:bg-slate-700/50 rounded-full opacity-50 group-hover:scale-150 transition-transform duration-500 z-0"></div>
        </div>

        <!-- Staff Card -->
        <div class="group bg-white dark:bg-slate-800 rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-slate-200 dark:border-slate-700 p-6 flex items-start justify-between relative overflow-hidden">
            <div class="relative z-10">
                <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Staff Members</p>
                <h3 class="text-3xl font-bold text-slate-800 dark:text-white mt-3">{{ number_format($totalStaff) }}</h3>
                <a href="{{ route('admin.staffs.index') }}" class="text-xs font-semibold text-emerald-500 mt-2 flex items-center gap-1 hover:underline">
                    View staff team <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
            <div class="p-4 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-xl text-white shadow-lg shadow-emerald-500/30 group-hover:scale-110 transition-transform duration-300">
                <i class="fa-solid fa-user-tie text-xl"></i>
            </div>
            <div class="absolute -bottom-4 -right-4 w-24 h-24 bg-emerald-50 dark:bg-slate-700/50 rounded-full opacity-50 group-hover:scale-150 transition-transform duration-500 z-0"></div>
        </div>

        <!-- Tasks Card -->
        <div class="group bg-white dark:bg-slate-800 rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-slate-200 dark:border-slate-700 p-6 flex items-start justify-between relative overflow-hidden">
            <div class="relative z-10">
                <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Total Tasks</p>
                <h3 class="text-3xl font-bold text-slate-800 dark:text-white mt-3">{{ number_format($totalTasks) }}</h3>
                <p class="text-xs font-semibold text-amber-500 mt-2 flex items-center gap-1 bg-amber-50 dark:bg-amber-900/30 w-fit px-2 py-1 rounded-full">
                    <i class="fa-solid fa-circle-exclamation"></i> {{ $pendingTasks }} Pending
                </p>
            </div>
            <div class="p-4 bg-gradient-to-br from-amber-500 to-amber-600 rounded-xl text-white shadow-lg shadow-amber-500/30 group-hover:scale-110 transition-transform duration-300">
                <i class="fa-solid fa-list-check text-xl"></i>
            </div>
            <div class="absolute -bottom-4 -right-4 w-24 h-24 bg-amber-50 dark:bg-slate-700/50 rounded-full opacity-50 group-hover:scale-150 transition-transform duration-500 z-0"></div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Recent Tasks -->
        <div class="lg:col-span-2 bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700 overflow-hidden">
            <div class="px-6 py-5 border-b border-slate-100 dark:border-slate-700 flex justify-between items-center bg-slate-50/50 dark:bg-slate-900/50">
                <h3 class="font-bold text-slate-800 dark:text-white flex items-center gap-2">
                    <i class="fa-solid fa-clock-rotate-left text-blue-500"></i>
                    Recent Tasks
                </h3>
                <a href="{{ route('admin.tasks.index') }}" class="text-xs font-medium text-blue-600 hover:text-blue-700 dark:text-blue-400 hover:underline">View All</a>
            </div>
            <div class="p-0">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <thead class="text-slate-400 uppercase text-[10px] font-bold tracking-widest border-b border-slate-100 dark:border-slate-700">
                            <tr>
                                <th class="px-6 py-3">Task Title</th>
                                <th class="px-6 py-3">Client</th>
                                <th class="px-6 py-3">Status</th>
                                <th class="px-6 py-3">Due Date</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-700">
                            @forelse($recentTasks as $task)
                                <tr class="hover:bg-slate-50 dark:hover:bg-slate-900/40 transition-colors">
                                    <td class="px-6 py-4">
                                        <p class="font-semibold text-slate-800 dark:text-slate-200 truncate max-w-[150px]">{{ $task->title }}</p>
                                        <p class="text-[10px] text-slate-400">Staff: {{ $task->staff->name ?? 'N/A' }}</p>
                                    </td>
                                    <td class="px-6 py-4 font-medium text-slate-600 dark:text-slate-400">
                                        {{ $task->client->name ?? 'N/A' }}
                                    </td>
                                    <td class="px-6 py-4">
                                        @php
                                            $statusColors = [
                                                'pending' => 'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400',
                                                'in_progress' => 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400',
                                                'completed' => 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400',
                                            ];
                                            $color = $statusColors[$task->status] ?? 'bg-slate-100 text-slate-700';
                                        @endphp
                                        <span class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider {{ $color }}">
                                            {{ str_replace('_', ' ', $task->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-slate-500 dark:text-slate-400">
                                        {{ $task->due_date ? date('M d, Y', strtotime($task->due_date)) : 'N/A' }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-10 text-center text-slate-400 italic">No recent tasks found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Recent Clients -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700 overflow-hidden">
            <div class="px-6 py-5 border-b border-slate-100 dark:border-slate-700 flex justify-between items-center bg-slate-50/50 dark:bg-slate-900/50">
                <h3 class="font-bold text-slate-800 dark:text-white flex items-center gap-2">
                    <i class="fa-solid fa-user-plus text-indigo-500"></i>
                    Recent Clients
                </h3>
            </div>
            <div class="p-4 space-y-4">
                @forelse($recentClients as $client)
                    <div class="flex items-center gap-4 p-3 rounded-xl hover:bg-slate-50 dark:hover:bg-slate-900/40 transition-colors border border-transparent hover:border-slate-100 dark:hover:border-slate-700">
                        <div class="w-10 h-10 rounded-full bg-indigo-100 dark:bg-indigo-900/30 flex items-center justify-center text-indigo-600 dark:text-indigo-400 font-bold shrink-0">
                            @if($client->image)
                                <img src="{{ Storage::url($client->image) }}" class="w-full h-full rounded-full object-cover">
                            @else
                                {{ strtoupper(substr($client->name, 0, 1)) }}
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <h4 class="font-bold text-slate-800 dark:text-slate-200 text-sm truncate">{{ $client->name }}</h4>
                            <p class="text-xs text-slate-500 dark:text-slate-400 truncate">{{ $client->email }}</p>
                        </div>
                        <a href="{{ route('admin.client.view', $client->client_id) }}" class="p-2 text-slate-400 hover:text-blue-600 transition-colors">
                            <i class="fa-solid fa-chevron-right text-xs"></i>
                        </a>
                    </div>
                @empty
                    <p class="text-center text-slate-400 italic py-10">No recent clients found.</p>
                @endforelse
                
                <a href="{{ route('admin.client.index') }}" class="block w-full text-center py-2 text-sm font-medium text-slate-500 hover:text-blue-600 transition-colors mt-2">
                    View all clients
                </a>
            </div>
        </div>
    </div>
@endsection