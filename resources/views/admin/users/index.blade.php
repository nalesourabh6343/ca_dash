@extends('layouts.admin.master')
@section('title', 'Registered Users')

@section('content')
    <div class="container mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-slate-800 dark:text-white">Registered Users Monitoring</h1>
        </div>

        @if(session('msg'))
            <div class="mb-4 p-4 bg-blue-100 text-blue-700 rounded-lg border border-blue-200">
                {{ session('msg') }}
            </div>
        @endif

        <div
            class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-slate-50 dark:bg-slate-900/50 border-b border-slate-200 dark:border-slate-700">
                        <tr>
                            <th class="px-6 py-4 text-sm font-bold text-slate-500 uppercase tracking-wider">User Details
                            </th>
                            <th class="px-6 py-4 text-sm font-bold text-slate-500 uppercase tracking-wider">Role</th>
                            <th class="px-6 py-4 text-sm font-bold text-slate-500 uppercase tracking-wider">Credentials</th>
                            <th class="px-6 py-4 text-sm font-bold text-slate-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-sm font-bold text-slate-500 uppercase tracking-wider">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                        @forelse($users as $user)
                            <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="font-bold text-slate-800 dark:text-white">{{ $user->name }}</div>
                                    <div class="text-xs text-slate-500">{{ $user->email }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <span
                                        class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider {{ $user->type == 'staff' ? 'bg-indigo-100 text-indigo-700' : 'bg-blue-100 text-blue-700' }}">
                                        {{ $user->type }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm font-mono bg-slate-100 dark:bg-slate-900 px-2 py-1 rounded select-all cursor-copy"
                                        title="Click to copy">
                                        {{ $user->plain_password ?? '********' }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    @php
                                        $statusColors = [
                                            'active' => 'bg-green-100 text-green-700',
                                            'pending' => 'bg-amber-100 text-amber-700',
                                            'inactive' => 'bg-red-100 text-red-700',
                                        ];
                                    @endphp
                                    <span
                                        class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider {{ $statusColors[$user->status] ?? 'bg-slate-100 text-slate-700' }}">
                                        {{ $user->status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <form action="{{ route('admin.users.updateStatus', $user->id) }}" method="POST"
                                            class="flex gap-1">
                                            @csrf
                                            <select name="status" onchange="this.form.submit()"
                                                class="text-xs rounded border-slate-200 dark:border-slate-700 dark:bg-slate-900 py-1">
                                                <option value="pending" {{ $user->status == 'pending' ? 'selected' : '' }}>Pending
                                                </option>
                                                <option value="active" {{ $user->status == 'active' ? 'selected' : '' }}>Activate
                                                </option>
                                                <option value="inactive" {{ $user->status == 'inactive' ? 'selected' : '' }}>
                                                    Suspend</option>
                                            </select>
                                        </form>
                                        <a href="{{ route('admin.users.delete', $user->id) }}"
                                            onclick="return confirm('Remove this user?')"
                                            class="text-red-500 hover:text-red-700 transition">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-slate-500 italic">No registered users found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection