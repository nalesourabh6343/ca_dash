@extends('layouts.admin.master')
@section('title', 'All Staffs')

@section('content')
    <div class="container mx-auto max-w-7xl">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-slate-800 dark:text-white">Staffs</h1>
            <a href="{{ route('admin.staffs.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
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

        <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm overflow-hidden border border-slate-200 dark:border-slate-700">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-slate-600 dark:text-slate-400">
                    <thead class="bg-slate-50 dark:bg-slate-900/50 text-slate-900 dark:text-slate-200 font-semibold uppercase tracking-wider">
                        <tr>
                            <th class="px-6 py-4">ID</th>
                            <th class="px-6 py-4">Image</th>
                            <th class="px-6 py-4">Name</th>
                            <th class="px-6 py-4">Email</th>
                            <th class="px-6 py-4">Phone</th>
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
                                <td class="px-6 py-4">
                                    {{ $staff->phone }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end space-x-3">
                                        <a href="{{ route('admin.staffs.view', $staff->staff_id) }}" class="text-blue-600 hover:text-blue-800 font-medium flex items-center" title="View Details">
                                            View Details <i class="fa-solid fa-arrow-right ml-1"></i>
                                        </a>
                                        <div class="h-4 w-px bg-slate-300 dark:bg-slate-600 mx-2"></div>
                                        <a href="{{ route('admin.staffs.edit', $staff->staff_id) }}" class="text-indigo-600 hover:text-indigo-800" title="Edit">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>
                                        <a href="{{ route('admin.staffs.delete', $staff->staff_id) }}" class="text-red-600 hover:text-red-800" title="Delete" onclick="return confirm('Are you sure?')">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center text-slate-500">
                                    <i class="fa-solid fa-user-tie text-3xl mb-3 opacity-50"></i>
                                    <p>No staffs found.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
