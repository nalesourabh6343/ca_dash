@extends('layouts.staff.master')
@section('title', 'My Tasks')

@section('content')
    <div class="container mx-auto max-w-7xl">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-slate-800 dark:text-white">My Tasks</h1>
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
                            <th class="px-6 py-4">Title</th>
                            <th class="px-6 py-4">Client / Business</th>
                            <th class="px-6 py-4">Due Date</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4 text-right">Update Status</th>
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
                                    <div class="font-medium text-slate-900 dark:text-white">{{ $task->client->name ?? 'N/A' }}
                                    </div>
                                    <div class="text-xs text-slate-500">{{ $task->business->business_name ?? 'No Business' }}
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    {{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('d M, Y') : 'No Date' }}
                                </td>
                                <td class="px-6 py-4">
                                    @php
                                        $statusClasses = [
                                            'pending' => 'bg-amber-100 text-amber-700 border-amber-200',
                                            'in_progress' => 'bg-blue-100 text-blue-700 border-blue-200',
                                            'completed' => 'bg-green-100 text-green-700 border-green-200',
                                        ];
                                        $class = $statusClasses[$task->status] ?? 'bg-slate-100 text-slate-700 border-slate-200';
                                    @endphp
                                    <span class="px-2.5 py-0.5 rounded-full text-xs font-medium border {{ $class }} uppercase">
                                        {{ str_replace('_', ' ', $task->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <form action="{{ route('staff.tasks.updateStatus', $task->id) }}" method="POST"
                                        class="inline-block">
                                        @csrf
                                        <select name="status" onchange="this.form.submit()"
                                            class="text-xs rounded-lg border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 focus:ring-blue-500 focus:border-blue-500 p-1">
                                            <option value="pending" {{ $task->status == 'pending' ? 'selected' : '' }}>Pending
                                            </option>
                                            <option value="in_progress" {{ $task->status == 'in_progress' ? 'selected' : '' }}>In
                                                Progress</option>
                                            <option value="completed" {{ $task->status == 'completed' ? 'selected' : '' }}>
                                                Completed</option>
                                        </select>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center text-slate-500">
                                    <i class="fa-solid fa-list-check text-3xl mb-3 opacity-50"></i>
                                    <p>No tasks assigned.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection