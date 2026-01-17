@extends('layouts.staff.master')
@section('title', 'Client Details')

@section('content')
    <div class="container mx-auto max-w-7xl">
        <div class="flex items-center gap-4 mb-6">
            <a href="{{ route('staff.client.index') }}" class="p-2 rounded-full hover:bg-slate-100 dark:hover:bg-slate-700 transition">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
            <h1 class="text-2xl font-bold text-slate-800 dark:text-white">Client Details: {{ $client->name }}</h1>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Left Column: Basic Info & Services -->
            <div class="space-y-6">
                <!-- Basic Info Card -->
                <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 p-6">
                    <h2 class="text-lg font-semibold text-slate-800 dark:text-white mb-4 border-b border-slate-100 dark:border-slate-700 pb-2">
                        <i class="fa-regular fa-id-card mr-2 text-blue-500"></i> Basic Information
                    </h2>
                    <div class="flex flex-col items-center mb-4">
                        @if($client->image)
                            <img src="{{ Storage::url($client->image) }}" alt="Client Image" class="w-24 h-24 rounded-full object-cover shadow-sm mb-2">
                        @else
                            <div class="w-24 h-24 rounded-full bg-slate-200 dark:bg-slate-700 flex items-center justify-center text-slate-500 text-3xl mb-2">
                                <i class="fa-solid fa-user"></i>
                            </div>
                        @endif
                        <h3 class="text-xl font-bold text-slate-800 dark:text-white">{{ $client->name }}</h3>
                    </div>
                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between">
                            <span class="text-slate-500">Email:</span>
                            <span class="text-slate-900 dark:text-slate-200 font-medium">{{ $client->email }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-slate-500">Phone:</span>
                            <span class="text-slate-900 dark:text-slate-200 font-medium">{{ $client->phone }}</span>
                        </div>
                        <div>
                            <span class="block text-slate-500 mb-1">Address:</span>
                            <p class="text-slate-900 dark:text-slate-200">{{ $client->address ?? 'N/A' }}</p>
                        </div>
                         <div class="flex justify-between">
                            <span class="text-slate-500">Pincode:</span>
                            <span class="text-slate-900 dark:text-slate-200 font-medium">{{ $client->pincode ?? 'N/A' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Selected Services Card -->
                <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 p-6">
                    <h2 class="text-lg font-semibold text-slate-800 dark:text-white mb-4 border-b border-slate-100 dark:border-slate-700 pb-2">
                        <i class="fa-solid fa-list-check mr-2 text-green-500"></i> Selected Services
                    </h2>
                    <div class="flex flex-wrap gap-2">
                        @forelse($client->services as $service)
                            <span class="px-3 py-1 bg-green-50 text-green-700 text-xs font-medium rounded-full border border-green-200">
                                {{ $service->name }}
                            </span>
                        @empty
                            <p class="text-slate-500 text-sm italic">No services selected.</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Right Column: Businesses & Documents -->
            <div class="lg:col-span-2 space-y-6">
                
                <!-- Businesses -->
                <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 overflow-hidden">
                    <div class="p-6 border-b border-slate-100 dark:border-slate-700">
                        <h2 class="text-lg font-semibold text-slate-800 dark:text-white">
                            <i class="fa-solid fa-building mr-2 text-indigo-500"></i> Businesses
                        </h2>
                    </div>
                    @if($client->businesses->count() > 0)
                        <div class="divide-y divide-slate-100 dark:divide-slate-700">
                            @foreach($client->businesses as $business)
                                <div x-data="{ open: false }" class="bg-slate-50/50 dark:bg-slate-800">
                                    <button @click="open = !open" class="w-full flex items-center justify-between p-4 hover:bg-slate-50 dark:hover:bg-slate-700 transition text-left">
                                        <div>
                                            <h3 class="font-medium text-slate-900 dark:text-white">{{ $business->business_name }}</h3>
                                            <p class="text-xs text-slate-500">GST: {{ $business->gst_number ?? 'N/A' }} | PAN: {{ $business->pan_number ?? 'N/A' }}</p>
                                        </div>
                                        <i class="fa-solid fa-chevron-down text-slate-400 transition-transform" :class="open ? 'rotate-180' : ''"></i>
                                    </button>
                                    <div x-show="open" x-cloak class="p-4 pt-0 text-sm text-slate-600 dark:text-slate-400 border-t border-slate-100 dark:border-slate-700">
                                        <div class="grid grid-cols-2 gap-4 mt-4">
                                            <div>
                                                <span class="block text-xs text-slate-500">Client Name</span>
                                                {{ $business->client_name }}
                                            </div>
                                            <div>
                                                <span class="block text-xs text-slate-500">Financial Year</span>
                                                {{ $business->financial_year }}
                                            </div>
                                            <div class="col-span-2">
                                                <span class="block text-xs text-slate-500">Description</span>
                                                {{ $business->description }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="p-6 text-center text-slate-500">
                            <p>No businesses linked.</p>
                        </div>
                    @endif
                </div>

                <!-- Documents -->
                <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 overflow-hidden">
                    <div class="p-6 border-b border-slate-100 dark:border-slate-700">
                        <h2 class="text-lg font-semibold text-slate-800 dark:text-white">
                            <i class="fa-solid fa-file-lines mr-2 text-amber-500"></i> Documents
                        </h2>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm">
                            <thead class="bg-slate-50 dark:bg-slate-900/50 text-slate-700 dark:text-slate-300">
                                <tr>
                                    <th class="px-6 py-3 font-semibold">Document Name</th>
                                    <th class="px-6 py-3 font-semibold">Category</th>
                                    <th class="px-6 py-3 font-semibold">Period</th>
                                    <th class="px-6 py-3 font-semibold">Status</th>
                                    <th class="px-6 py-3 font-semibold text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 dark:divide-slate-700">
                                @forelse($client->documents as $doc)
                                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/50 transition">
                                        <td class="px-6 py-3 font-medium text-slate-900 dark:text-white">
                                            {{ $doc->file_name }}
                                        </td>
                                        <td class="px-6 py-3">
                                            <span class="bg-slate-100 text-slate-600 px-2 py-1 rounded text-xs border border-slate-200">
                                                {{ $doc->category->name ?? 'Uncategorized' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-3 text-slate-500 text-xs">
                                            {{ \Carbon\Carbon::parse($doc->period_start)->format('M Y') }} - 
                                            {{ \Carbon\Carbon::parse($doc->period_end)->format('M Y') }}
                                        </td>
                                        <td class="px-6 py-3">
                                            <form action="{{ route('staff.client.document.status', ['id' => $client->client_id, 'documentId' => $doc->document_id]) }}" method="POST">
                                                @csrf
                                                <select name="status" onchange="this.form.submit()" class="text-xs rounded-full border-0 px-3 py-1 font-medium ring-1 ring-inset focus:ring-2 focus:ring-inset sm:text-xs sm:leading-6
                                                    {{ $doc->status == 'completed' ? 'bg-green-50 text-green-700 ring-green-600/20' : '' }}
                                                    {{ $doc->status == 'pending' ? 'bg-yellow-50 text-yellow-800 ring-yellow-600/20' : '' }}
                                                    {{ $doc->status == 'in_progress' ? 'bg-blue-50 text-blue-700 ring-blue-700/10' : '' }}">
                                                    <option value="pending" {{ $doc->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                    <option value="in_progress" {{ $doc->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                                    <option value="completed" {{ $doc->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                                </select>
                                            </form>
                                        </td>
                                        <td class="px-6 py-3 text-right space-x-2">
                                            <a href="{{ asset('storage/' . $doc->file_path) }}" target="_blank" class="text-blue-600 hover:text-blue-800" title="View File">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>
                                            <a href="{{ asset('storage/' . $doc->file_path) }}" download class="text-green-600 hover:text-green-800" title="Download File">
                                                <i class="fa-solid fa-download"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-8 text-center text-slate-500">
                                            <p>No documents uploaded.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
