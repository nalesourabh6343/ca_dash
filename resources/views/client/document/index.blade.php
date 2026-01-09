@extends('layouts.client.master')
@section('title', 'All Documents')

@section('content')
    <div class="container mx-auto max-w-7xl">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-slate-800 dark:text-white">Documents</h1>
            <a href="{{ route('client.document.create') }}"
                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                <i class="fa-solid fa-plus mr-2"></i> Add New
            </a>
        </div>

        @if(session('msg'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg border border-green-200">
                {{ session('msg') }}
            </div>
        @endif
        @if(session('error'))
            <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg border border-red-200">
                {{ session('error') }}
            </div>
        @endif

        <div
            class="bg-white dark:bg-slate-800 rounded-xl shadow-sm overflow-hidden border border-slate-200 dark:border-slate-700">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-slate-600 dark:text-slate-400">
                    <thead
                        class="bg-slate-50 dark:bg-slate-900/50 text-slate-900 dark:text-slate-200 font-semibold uppercase tracking-wider">
                        <tr>
                            <th class="px-6 py-4">ID</th>
                            <th class="px-6 py-4">Name</th>
                            <th class="px-6 py-4">Category</th>
                            <th class="px-6 py-4">Period</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                        @forelse($documents as $doc)
                            <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/50 transition">
                                <td class="px-6 py-4">#{{ $doc->document_id }}</td>
                                <td class="px-6 py-4 font-medium text-slate-900 dark:text-white">
                                    {{ $doc->file_name }}
                                    <div class="text-xs text-slate-500">{{ Str::limit($doc->description, 30) }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    {{ $doc->category->name ?? $doc->pk_document_categorie_id }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ \Carbon\Carbon::parse($doc->period_start)->format('M Y') }} -
                                    {{ \Carbon\Carbon::parse($doc->period_end)->format('M Y') }}
                                </td>
                                <td class="px-6 py-4">
                                    <span
                                        class="px-2 py-1 text-xs rounded-full 
                                                                {{ $doc->status == 'approved' ? 'bg-green-100 text-green-700' : '' }}
                                                                {{ $doc->status == 'pending' ? 'bg-amber-100 text-amber-700' : '' }}
                                                                {{ $doc->status == 'rejected' ? 'bg-red-100 text-red-700' : '' }}
                                                                {{ $doc->status == 'reviewed' ? 'bg-blue-100 text-blue-700' : '' }}">
                                        {{ ucfirst($doc->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right space-x-2">
                                    <a href="{{ route('client.document.view', $doc->document_id) }}"
                                        class="text-blue-600 hover:text-blue-800" title="View">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                    <a href="{{ route('client.document.edit', $doc->document_id) }}"
                                        class="text-indigo-600 hover:text-indigo-800" title="Edit">
                                        <i class="fa-solid fa-pen"></i>
                                    </a>
                                    <a href="{{ route('client.document.delete', $doc->document_id) }}"
                                        class="text-red-600 hover:text-red-800" title="Delete"
                                        onclick="return confirm('Are you sure?')">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center text-slate-500">
                                    <i class="fa-regular fa-folder-open text-3xl mb-3 opacity-50"></i>
                                    <p>No documents found.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection