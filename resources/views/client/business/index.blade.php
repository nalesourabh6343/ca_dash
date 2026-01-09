@extends('layouts.client.master')
@section('title', 'My Businesses')

@section('content')
    <div class="container mx-auto max-w-7xl">
        <div class="mb-6 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-slate-800 dark:text-white">My Businesses</h1>
                <p class="text-slate-500 dark:text-slate-400">Manage and view your linked business entities.</p>
            </div>
            <!-- Optional: Add 'Add Business' button if clients are allowed to add businesses -->
        </div>

        @if(session('msg'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg border border-green-200">
                {{ session('msg') }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
            @forelse($businesses as $business)
                <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 overflow-hidden hover:shadow-md transition">
                    <div class="p-6 border-b border-slate-100 dark:border-slate-700 flex justify-between items-start">
                        <div>
                            <h3 class="text-lg font-semibold text-slate-900 dark:text-white">{{ $business->business_name }}</h3>
                            <span class="inline-block px-2 py-1 mt-2 text-xs font-medium bg-blue-50 text-blue-700 rounded border border-blue-100">
                                {{ $business->financial_year }}
                            </span>
                        </div>
                        <div class="bg-indigo-50 dark:bg-indigo-900/30 p-2 rounded-lg text-indigo-600 dark:text-indigo-400">
                            <i class="fa-solid fa-building text-xl"></i>
                        </div>
                    </div>
                    
                    <div class="p-6 space-y-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <span class="block text-xs text-slate-500 uppercase tracking-wider">GST Number</span>
                                <span class="font-medium text-slate-700 dark:text-slate-300">{{ $business->gst_number ?? 'N/A' }}</span>
                            </div>
                            <div>
                                <span class="block text-xs text-slate-500 uppercase tracking-wider">PAN Number</span>
                                <span class="font-medium text-slate-700 dark:text-slate-300">{{ $business->pan_number ?? 'N/A' }}</span>
                            </div>
                        </div>

                        <div>
                            <span class="block text-xs text-slate-500 uppercase tracking-wider">Client Name</span>
                            <span class="font-medium text-slate-700 dark:text-slate-300">{{ $business->client_name ?? 'N/A' }}</span>
                        </div>

                        @if($business->description)
                            <div class="pt-2 border-t border-slate-100 dark:border-slate-700">
                                <span class="block text-xs text-slate-500 uppercase tracking-wider mb-1">Description</span>
                                <p class="text-sm text-slate-600 dark:text-slate-400">{{ Str::limit($business->description, 100) }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            @empty
                <div class="col-span-full bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 p-12 text-center">
                    <div class="w-16 h-16 bg-slate-100 dark:bg-slate-700 rounded-full flex items-center justify-center mx-auto mb-4 text-slate-400">
                        <i class="fa-solid fa-building text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-medium text-slate-900 dark:text-white mb-1">No Businesses Found</h3>
                    <p class="text-slate-500 dark:text-slate-400">You don't have any businesses linked to your account yet.</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection
