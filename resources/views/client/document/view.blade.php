@extends('layouts.client.master')
@section('title', 'View Document')

@section('content')
    <div class="container mx-auto max-w-4xl">
        <div class="flex items-center gap-4 mb-6">
            <a href="{{ route('client.document.index') }}"
                class="p-2 rounded-full hover:bg-slate-100 dark:hover:bg-slate-700 transition">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
            <h1 class="text-2xl font-bold text-slate-800 dark:text-white">Document Details</h1>
        </div>

        <div
            class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 overflow-hidden">
            <div class="p-6 border-b border-slate-100 dark:border-slate-700 flex justify-between items-start">
                <div>
                    <h2 class="text-xl font-bold text-slate-900 dark:text-white">{{ $document->file_name }}</h2>
                    <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">
                        ID: #{{ $document->document_id }} | Uploaded on {{ $document->created_at->format('d M Y') }}
                    </p>
                </div>
                <div>
                    <span class="px-3 py-1 text-sm font-medium rounded-full 
                            {{ $document->status == 'approved' ? 'bg-green-100 text-green-700' : '' }}
                            {{ $document->status == 'pending' ? 'bg-amber-100 text-amber-700' : '' }}
                            {{ $document->status == 'rejected' ? 'bg-red-100 text-red-700' : '' }}
                            {{ $document->status == 'reviewed' ? 'bg-blue-100 text-blue-700' : '' }}">
                        {{ ucfirst($document->status) }}
                    </span>
                </div>
            </div>

            <div class="p-6 space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <hr class="border-slate-100 dark:border-slate-700 mb-4 md:hidden">
                        <label
                            class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Category</label>
                        <p class="text-slate-800 dark:text-slate-200 font-medium">
                            {{ $document->pk_document_categorie_id }} {{-- Ideally fetch relation name --}}
                        </p>
                    </div>
                    <div>
                        <label
                            class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Period</label>
                        <p class="text-slate-800 dark:text-slate-200 font-medium">
                            {{ \Carbon\Carbon::parse($document->period_start)->format('d M Y') }} -
                            {{ \Carbon\Carbon::parse($document->period_end)->format('d M Y') }}
                        </p>
                    </div>
                </div>

                <div>
                    <label
                        class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Description</label>
                    <div class="bg-slate-50 dark:bg-slate-900 p-4 rounded-lg text-slate-700 dark:text-slate-300">
                        {{ $document->description ?? 'No description provided.' }}
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Attached
                        File</label>
                    <div class="flex items-center gap-4 p-4 border border-slate-200 dark:border-slate-700 rounded-lg">
                        <div
                            class="w-12 h-12 bg-slate-100 dark:bg-slate-700 rounded flex items-center justify-center text-slate-500">
                            <i class="fa-solid fa-file text-xl"></i>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-slate-900 dark:text-white truncate">
                                {{ basename($document->file_path) }}
                            </p>
                        </div>
                        <a href="{{ Storage::url($document->file_path) }}" target="_blank" download
                            class="px-4 py-2 bg-slate-900 dark:bg-slate-700 text-white text-sm rounded-lg hover:bg-slate-800 dark:hover:bg-slate-600 transition">
                            <i class="fa-solid fa-download mr-1"></i> Download
                        </a>
                    </div>
                </div>
            </div>

            <div
                class="p-6 bg-slate-50 dark:bg-slate-900/50 border-t border-slate-100 dark:border-slate-700 flex justify-end gap-3">
                <a href="{{ route('client.document.edit', $document->document_id) }}"
                    class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                    Edit Document
                </a>
            </div>
        </div>
    </div>
@endsection