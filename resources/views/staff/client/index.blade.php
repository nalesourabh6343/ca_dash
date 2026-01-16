@extends('layouts.staff.master')
@section('title', 'My Assigned Clients')

@section('content')
    <div class="container mx-auto max-w-7xl">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-slate-800 dark:text-white">My Assigned Clients</h1>
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
                        @forelse($clients as $client)
                            <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/50 transition">
                                <td class="px-6 py-4">#{{ $client->client_id }}</td>
                                <td class="px-6 py-4">
                                    @if($client->image)
                                        <img src="{{ Storage::url($client->image) }}" alt="Client Image" class="w-10 h-10 rounded-full object-cover">
                                    @else
                                        <div class="w-10 h-10 rounded-full bg-slate-200 dark:bg-slate-700 flex items-center justify-center text-slate-500">
                                            <i class="fa-solid fa-user"></i>
                                        </div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 font-medium text-slate-900 dark:text-white">
                                    {{ $client->name }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $client->email }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $client->phone }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end space-x-3">
                                        <a href="{{ route('staff.client.view', $client->client_id) }}" class="text-blue-600 hover:text-blue-800 font-medium flex items-center" title="View Details">
                                            View Details <i class="fa-solid fa-arrow-right ml-1"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center text-slate-500">
                                    <i class="fa-solid fa-users text-3xl mb-3 opacity-50"></i>
                                    <p>No assigned clients found.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
