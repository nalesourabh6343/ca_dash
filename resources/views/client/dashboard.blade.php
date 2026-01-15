@extends('layouts.client.master')
@section('title', 'Client Dashboard')

@section('content')
    <div class="mb-8">
        <h1 class="text-3xl md:text-4xl font-bold text-slate-800 dark:text-white">
            Welcome back, <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-600">{{ Auth::user()->name }}</span>
        </h1>
        <p class="text-slate-500 dark:text-slate-400 mt-2">Here's a quick overview of your account activity.</p>
    </div>

    <!-- Quick Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Documents Card -->
        <div class="group bg-white dark:bg-slate-800 rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-slate-200 dark:border-slate-700 p-6 flex items-start justify-between relative overflow-hidden">
            <div class="relative z-10">
                <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Total Documents</p>
                <h3 class="text-3xl font-bold text-slate-800 dark:text-white mt-3">{{ number_format($totalDocuments) }}</h3>
                <a href="{{ route('client.document.index') }}" class="text-xs font-semibold text-blue-500 mt-2 flex items-center gap-1 hover:underline">
                    View my files <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
            <div class="p-4 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl text-white shadow-lg shadow-blue-500/30 group-hover:scale-110 transition-transform duration-300">
                <i class="fa-solid fa-folder-open text-xl"></i>
            </div>
            <div class="absolute -bottom-4 -right-4 w-24 h-24 bg-blue-50 dark:bg-slate-700/50 rounded-full opacity-50 group-hover:scale-150 transition-transform duration-500 z-0"></div>
        </div>

        <!-- Services Card -->
        <div class="group bg-white dark:bg-slate-800 rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-slate-200 dark:border-slate-700 p-6 flex items-start justify-between relative overflow-hidden">
            <div class="relative z-10">
                <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Active Services</p>
                <h3 class="text-3xl font-bold text-slate-800 dark:text-white mt-3">{{ number_format($activeServices) }}</h3>
                <a href="{{ route('client.services.index') }}" class="text-xs font-semibold text-indigo-500 mt-2 flex items-center gap-1 hover:underline">
                    Manage services <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
            <div class="p-4 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-xl text-white shadow-lg shadow-indigo-500/30 group-hover:scale-110 transition-transform duration-300">
                <i class="fa-solid fa-list-check text-xl"></i>
            </div>
            <div class="absolute -bottom-4 -right-4 w-24 h-24 bg-indigo-50 dark:bg-slate-700/50 rounded-full opacity-50 group-hover:scale-150 transition-transform duration-500 z-0"></div>
        </div>

        <!-- Business Card -->
        <div class="group bg-white dark:bg-slate-800 rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-slate-200 dark:border-slate-700 p-6 flex items-start justify-between relative overflow-hidden">
            <div class="relative z-10">
                <p class="text-sm font-medium text-slate-500 dark:text-slate-400">My Businesses</p>
                <h3 class="text-3xl font-bold text-slate-800 dark:text-white mt-3">{{ number_format($totalBusinesses) }}</h3>
                <a href="{{ route('client.business.index') }}" class="text-xs font-semibold text-emerald-500 mt-2 flex items-center gap-1 hover:underline">
                    View details <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
            <div class="p-4 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-xl text-white shadow-lg shadow-emerald-500/30 group-hover:scale-110 transition-transform duration-300">
                <i class="fa-solid fa-building text-xl"></i>
            </div>
            <div class="absolute -bottom-4 -right-4 w-24 h-24 bg-emerald-50 dark:bg-slate-700/50 rounded-full opacity-50 group-hover:scale-150 transition-transform duration-500 z-0"></div>
        </div>

        <!-- Categories Card -->
        <div class="group bg-white dark:bg-slate-800 rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-slate-200 dark:border-slate-700 p-6 flex items-start justify-between relative overflow-hidden">
            <div class="relative z-10">
                <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Doc Categories</p>
                <h3 class="text-3xl font-bold text-slate-800 dark:text-white mt-3">{{ number_format($totalCategories) }}</h3>
                <a href="{{ route('client.category.index') }}" class="text-xs font-semibold text-amber-500 mt-2 flex items-center gap-1 hover:underline">
                    View categories <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
            <div class="p-4 bg-gradient-to-br from-amber-500 to-amber-600 rounded-xl text-white shadow-lg shadow-amber-500/30 group-hover:scale-110 transition-transform duration-300">
                <i class="fa-solid fa-tags text-xl"></i>
            </div>
            <div class="absolute -bottom-4 -right-4 w-24 h-24 bg-amber-50 dark:bg-slate-700/50 rounded-full opacity-50 group-hover:scale-150 transition-transform duration-500 z-0"></div>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-8">
        <!-- Recent Documents -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700 overflow-hidden">
            <div class="px-6 py-5 border-b border-slate-100 dark:border-slate-700 flex justify-between items-center bg-slate-50/50 dark:bg-slate-900/50">
                <h3 class="font-bold text-slate-800 dark:text-white flex items-center gap-2">
                    <i class="fa-solid fa-file-shield text-blue-500"></i>
                    Recently Uploaded Documents
                </h3>
                <a href="{{ route('client.document.index') }}" class="text-xs font-medium text-blue-600 hover:text-blue-700 dark:text-blue-400 hover:underline">View All</a>
            </div>
            <div class="p-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                @forelse($recentDocuments as $doc)
                    <div class="flex items-center gap-4 p-4 rounded-xl bg-slate-50/50 dark:bg-slate-900/50 border border-slate-100 dark:border-slate-700 hover:shadow-md transition-shadow">
                        <div class="w-12 h-12 rounded-lg bg-white dark:bg-slate-800 flex items-center justify-center text-blue-600 dark:text-blue-400 shadow-sm shrink-0">
                            <i class="fa-solid fa-file-lines text-xl"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h4 class="font-bold text-slate-800 dark:text-slate-200 text-sm truncate">{{ $doc->file_name }}</h4>
                            <p class="text-[11px] text-slate-500 dark:text-slate-400">{{ $doc->category->name ?? 'Uncategorized' }} • {{ $doc->created_at->diffForHumans() }}</p>
                        </div>
                        <div class="flex items-center gap-2">
                            <a href="{{ route('client.document.view', $doc->document_id) }}" class="p-2 text-slate-400 hover:text-blue-600 transition-colors bg-white dark:bg-slate-800 rounded-lg shadow-sm border border-slate-100 dark:border-slate-700">
                                <i class="fa-solid fa-eye text-xs"></i>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-2 text-center py-10">
                        <p class="text-slate-400 italic">No documents uploaded yet.</p>
                        <a href="{{ route('client.document.create') }}" class="inline-block mt-4 text-sm font-medium text-blue-600 hover:underline text-center">Upload your first document</a>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection