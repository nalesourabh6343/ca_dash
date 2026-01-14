@extends('layouts.admin.master')
@section('title', 'Trashed Staffs')

@section('content')
    <div class="container mx-auto max-w-7xl">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-slate-800 dark:text-white">Trashed Staffs</h1>
            <a href="{{ route('admin.staffs.index') }}" class="px-4 py-2 bg-slate-600 text-white rounded-lg hover:bg-slate-700 transition">
                <i class="fa-solid fa-arrow-left mr-2"></i> Back to Staffs
            </a>
        </div>

        @if(session('msg'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg border border-green-200">
                {{ session('msg') }}
            </div>
        @endif

        <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm overflow-hidden border border-slate-200 dark:border-slate-700">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-slate-600 dark:text-slate-400">
                    <thead class="bg-slate-50 dark:bg-slate-900/50 text-slate-900 dark:text-slate-200 font-semibold uppercase tracking-wider">
                        <tr>
                            <th class="px-6 py-4">ID</th>
                            <th class="px-6 py-4">Image</th>
                            <th class="px-6 py-4">Name</th>
                            <th class="px-6 py-4">Email</th>
                            <th class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                        @forelse($staffs as $staff)
                            <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/50 transition">
                                <td class="px-6 py-4">#{{ $staff->staff_id }}</td>
                                <td class="px-6 py-4">
                                    @if($staff->image)
                                        <img src="{{ Storage::url($staff->image) }}" alt="Staff Image" class="w-10 h-10 rounded-full object-cover">
                                    @else
                                        <div class="w-10 h-10 rounded-full bg-slate-200 dark:bg-slate-700 flex items-center justify-center text-slate-500">
                                            <i class="fa-solid fa-user-tie"></i>
                                        </div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 font-medium text-slate-900 dark:text-white">
                                    {{ $staff->name }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $staff->email }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end space-x-3">
                                        <a href="{{ route('admin.staffs.restore', $staff->staff_id) }}" class="text-green-600 hover:text-green-800" title="Restore">
                                            <i class="fa-solid fa-rotate-left"></i> Restore
                                        </a>
                                        <div class="h-4 w-px bg-slate-300 dark:bg-slate-600 mx-2"></div>
                                        <a href="{{ route('admin.staffs.force-delete', $staff->staff_id) }}" class="text-red-100 hover:text-red-300 px-2 py-1 rounded bg-red-600 text-white" title="Delete Permanently" onclick="return confirm('Are you sure?')">
                                            <i class="fa-solid fa-circle-xmark"></i> Delete
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-slate-500">
                                    <i class="fa-solid fa-trash-can text-3xl mb-3 opacity-50"></i>
                                    <p>No trashed staffs found.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection