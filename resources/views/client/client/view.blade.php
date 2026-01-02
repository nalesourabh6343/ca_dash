@extends('layouts.client.master')
@section('title', 'View Client')

@section('content')
    <div class="container mx-auto max-w-4xl">
        <div class="flex items-center gap-4 mb-6">
            <a href="{{ route('client.client.index') }}"
                class="p-2 rounded-full hover:bg-slate-100 dark:hover:bg-slate-700 transition">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
            <h1 class="text-2xl font-bold text-slate-800 dark:text-white">Client Details</h1>
        </div>

        <div
            class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 overflow-hidden">
            <div
                class="p-6 border-b border-slate-100 dark:border-slate-700 flex flex-col md:flex-row gap-6 items-center md:items-start">
                @if($client->image)
                    <img src="{{ Storage::url($client->image) }}" alt="Client Image"
                        class="w-24 h-24 rounded-full object-cover shadow-sm">
                @else
                    <div
                        class="w-24 h-24 rounded-full bg-slate-200 dark:bg-slate-700 flex items-center justify-center text-slate-500 text-3xl">
                        <i class="fa-solid fa-user"></i>
                    </div>
                @endif

                <div class="flex-1 text-center md:text-left">
                    <h2 class="text-2xl font-bold text-slate-900 dark:text-white">{{ $client->name }}</h2>
                    <p class="text-slate-500 dark:text-slate-400 mt-1">
                        <i class="fa-solid fa-envelope w-4"></i> {{ $client->email }}
                    </p>
                    <p class="text-slate-500 dark:text-slate-400 mt-1">
                        <i class="fa-solid fa-phone w-4"></i> {{ $client->phone }}
                    </p>
                </div>
            </div>

            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label
                            class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Address</label>
                        <div class="bg-slate-50 dark:bg-slate-900 p-4 rounded-lg">
                            <p class="text-slate-800 dark:text-slate-200 whitespace-pre-line">
                                {{ $client->address ?? 'N/A' }}</p>
                        </div>
                    </div>
                    <div>
                        <label
                            class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Pincode</label>
                        <div class="bg-slate-50 dark:bg-slate-900 p-4 rounded-lg">
                            <p class="text-slate-800 dark:text-slate-200">{{ $client->pincode ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div
                class="p-6 bg-slate-50 dark:bg-slate-900/50 border-t border-slate-100 dark:border-slate-700 flex justify-end gap-3">
                <a href="{{ route('client.client.edit', $client->client_id) }}"
                    class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                    Edit Client
                </a>
            </div>
        </div>
    </div>
@endsection