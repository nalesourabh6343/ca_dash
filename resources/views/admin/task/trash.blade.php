@extends('layouts.admin.master')
@section('title', 'Trashed Tasks')

@section('content')
    <div class="container mx-auto max-w-7xl">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-slate-800 dark:text-white">Trashed Tasks</h1>
            <a href="{{ route('admin.tasks.index') }}"
                class="px-4 py-2 bg-slate-600 text-white rounded-lg hover:bg-slate-700 transition">
                <i class="fa-solid fa-arrow-left mr-2"></i> Back to Tasks
            </a>
        </div>

        @if(session('msg'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg border border-green-200">
                {{ session('msg') }}
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
                            <th class="px-6 py-4">Task Title</th>
                            <th class="px-6 py-4">Client</th>
                            <th class="px-6 py-4">Staff</th>
                            <th class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                        @forelse($tasks as $task)
                            <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/50 transition">
                                <td class="px-6 py-4">#{{ $task->id }}</td>
                                <td class="px-6 py-4 font-medium text-slate-900 dark:text-white">
                                    {{ $task->title }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $task->client->name ?? 'N/A' }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $task->staff->name ?? 'N/A' }}
                                </td>
                                <td class="px-6 py-4 text-right space-x-2">
                                    <a href="{{ route('admin.tasks.restore', $task->id) }}"
                                        class="text-green-600 hover:text-green-800" title="Restore">
                                        <i class="fa-solid fa-rotate-left"></i>
                                    </a>
                                    <a href="{{ route('admin.tasks.force-delete', $task->id) }}"
                                        class="text-red-600 hover:text-red-800" title="Delete Permanently"
                                        onclick="return confirm('This action cannot be undone. Are you sure?')">
                                        <i class="fa-solid fa-circle-xmark"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-slate-500">
                                    <i class="fa-solid fa-trash-can text-3xl mb-3 opacity-50"></i>
                                    <p>No trashed tasks.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection