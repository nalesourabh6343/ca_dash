@extends('layouts.client.master')
@section('title', 'My Services')

@section('content')
    <div class="container mx-auto max-w-4xl">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-slate-800 dark:text-white">My Services</h1>
            <p class="text-slate-500 dark:text-slate-400">Select the services you are interested in.</p>
        </div>

        @if(session('msg'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg border border-green-200">
                {{ session('msg') }}
            </div>
        @endif

        <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 p-6">
            <form action="{{ route('client.services.update') }}" method="POST">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @forelse($services as $service)
                        <label class="relative flex items-start p-4 rounded-lg border border-slate-200 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-700/50 cursor-pointer transition">
                            <div class="flex items-center h-5">
                                <input type="checkbox" name="services[]" value="{{ $service->service_id }}"
                                    {{ in_array($service->service_id, $selectedServices) ? 'checked' : '' }}
                                    class="w-4 h-4 text-blue-600 border-slate-300 rounded focus:ring-blue-500 dark:bg-slate-900 dark:border-slate-600">
                            </div>
                            <div class="ml-3 text-sm">
                                <span class="font-medium text-slate-900 dark:text-white">{{ $service->name }}</span>
                                @if($service->fee)
                                    <span class="block text-slate-500 dark:text-slate-400 text-xs mt-0.5">${{ number_format($service->fee, 2) }}</span>
                                @else
                                    <span class="block text-emerald-600 text-xs mt-0.5">Free</span>
                                @endif
                                @if($service->description)
                                    <p class="text-slate-400 dark:text-slate-500 text-xs mt-1">{{ Str::limit($service->description, 50) }}</p>
                                @endif
                            </div>
                        </label>
                    @empty
                        <div class="col-span-full text-center py-12 text-slate-500">
                            <i class="fa-solid fa-briefcase text-3xl mb-3 opacity-50"></i>
                            <p>No services available yet.</p>
                        </div>
                    @endforelse
                </div>

                <div class="flex justify-end pt-6 mt-6 border-t border-slate-100 dark:border-slate-700">
                    <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-medium">
                        Update Services
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
