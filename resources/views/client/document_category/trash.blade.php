@extends('layouts.client.master')
@section('title', 'Trashed Categories')

@section('content')
    <div class="container mx-auto max-w-7xl">
        <div class="flex justify-between items-center mb-6">
            <div class="flex items-center gap-4">
                <a href="{{ route('client.category.index') }}"
                    class="p-2 rounded-full hover:bg-slate-100 dark:hover:bg-slate-700 transition">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
                <h1 class="text-2xl font-bold text-slate-800 dark:text-white">Trashed Categories</h1>
            </div>
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
                            <th class="px-6 py-4">Deleted At</th>
                            <th class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                        @forelse($categories as $cat)
                            <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/50 transition">
                                <td class="px-6 py-4">#{{ $cat->document_categorie_id }}</td>
                                <td class="px-6 py-4 font-medium text-slate-900 dark:text-white">
                                    {{ $cat->name }}
                                </td>
                                <td class="px-6 py-4 text-red-500">
                                    {{ $cat->deleted_at->diffForHumans() }}
                                </td>
                                <td class="px-6 py-4 text-right space-x-2">
                                    <a href="{{ route('client.category.restore', $cat->document_categorie_id) }}"
                                        class="text-emerald-600 hover:text-emerald-800" title="Restore">
                                        <i class="fa-solid fa-rotate-left"></i> Restore
                                    </a>
                                    <a href="{{ route('client.category.forceDelete', $cat->document_categorie_id) }}"
                                        class="text-red-600 hover:text-red-800" title="Permanently Delete"
                                        onclick="return confirm('Are you sure? This cannot be undone.')">
                                        <i class="fa-solid fa-ban"></i> Delete
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center text-slate-500">
                                    <i class="fa-regular fa-trash-can text-3xl mb-3 opacity-50"></i>
                                    <p>Trash is empty.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection