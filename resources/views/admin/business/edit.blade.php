@extends('layouts.admin.master')
@section('title', 'Edit Business')

@section('content')
    <div class="container mx-auto max-w-4xl">
        <div class="flex items-center gap-4 mb-6">
            <a href="{{ route('admin.business.index') }}"
                class="p-2 rounded-full hover:bg-slate-100 dark:hover:bg-slate-700 transition">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
            <h1 class="text-2xl font-bold text-slate-800 dark:text-white">Edit Business</h1>
        </div>

        <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 p-6">
            <form action="{{ route('admin.business.update', $business->business_id) }}" method="POST" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Business Name -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Business Name <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="business_name" value="{{ old('business_name', $business->business_name) }}"
                            required
                            class="w-full rounded-lg border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-800 dark:text-slate-200 focus:ring-blue-500 focus:border-blue-500">
                        @error('business_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Client Name -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Client Name <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="client_name" value="{{ old('client_name', $business->client_name) }}"
                            required
                            class="w-full rounded-lg border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-800 dark:text-slate-200 focus:ring-blue-500 focus:border-blue-500">
                        @error('client_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- GST Number -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">GST Number</label>
                        <input type="text" name="gst_number" value="{{ old('gst_number', $business->gst_number) }}"
                            class="w-full rounded-lg border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-800 dark:text-slate-200 focus:ring-blue-500 focus:border-blue-500">
                        @error('gst_number') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- PAN Number -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">PAN Number</label>
                        <input type="text" name="pan_number" value="{{ old('pan_number', $business->pan_number) }}"
                            class="w-full rounded-lg border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-800 dark:text-slate-200 focus:ring-blue-500 focus:border-blue-500">
                        @error('pan_number') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Financial Year -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Financial Year
                            <span class="text-red-500">*</span></label>
                        <input type="text" name="financial_year"
                            value="{{ old('financial_year', $business->financial_year) }}" required
                            class="w-full rounded-lg border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-800 dark:text-slate-200 focus:ring-blue-500 focus:border-blue-500">
                        @error('financial_year') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <!-- Description -->
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Description <span
                            class="text-red-500">*</span></label>
                    <textarea name="description" rows="4" required
                        class="w-full rounded-lg border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-800 dark:text-slate-200 focus:ring-blue-500 focus:border-blue-500">{{ old('description', $business->description) }}</textarea>
                    @error('description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="flex justify-end pt-4 border-t border-slate-100 dark:border-slate-700">
                    <button type="submit"
                        class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition font-medium">
                        Update Business
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection