@extends('layouts.admin.master')
@section('title', 'Edit Service')

@section('content')
    <div class="container mx-auto max-w-4xl">
        <div class="flex items-center gap-4 mb-6">
            <a href="{{ route('admin.service.index') }}"
                class="p-2 rounded-full hover:bg-slate-100 dark:hover:bg-slate-700 transition">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
            <h1 class="text-2xl font-bold text-slate-800 dark:text-white">Edit Service</h1>
        </div>

        <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 p-6">
            <form action="{{ route('admin.service.update', $service->service_id) }}" method="POST" class="space-y-6">
                @csrf

                <!-- Name -->
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Service Name <span
                            class="text-red-500">*</span></label>
                    <input type="text" name="name" value="{{ old('name', $service->name) }}" required
                        class="w-full rounded-lg border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-800 dark:text-slate-200 focus:ring-blue-500 focus:border-blue-500">
                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Fee -->
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Fee (Optional)</label>
                    <div class="relative">
                        <span class="absolute left-3 top-2 text-slate-500">$</span>
                        <input type="number" step="0.01" name="fee" value="{{ old('fee', $service->fee) }}"
                            class="w-full pl-8 rounded-lg border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-800 dark:text-slate-200 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    @error('fee') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Description -->
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Description</label>
                    <textarea name="description" rows="4"
                        class="w-full rounded-lg border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-800 dark:text-slate-200 focus:ring-blue-500 focus:border-blue-500">{{ old('description', $service->description) }}</textarea>
                    @error('description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="flex justify-end pt-4 border-t border-slate-100 dark:border-slate-700">
                    <button type="submit"
                        class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition font-medium">
                        Update Service
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection