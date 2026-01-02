@extends('layouts.client.master')
@section('title', 'Edit Document')

@section('content')
    <div class="container mx-auto max-w-4xl">
        <div class="flex items-center gap-4 mb-6">
            <a href="{{ route('client.document.index') }}"
                class="p-2 rounded-full hover:bg-slate-100 dark:hover:bg-slate-700 transition">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
            <h1 class="text-2xl font-bold text-slate-800 dark:text-white">Edit Document</h1>
        </div>

        <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 p-6">
            <form action="{{ route('client.document.update', $document->document_id) }}" method="POST"
                enctype="multipart/form-data" class="space-y-6">
                @csrf
                {{-- No PUT/PATCH method directive because controller uses POST for update route definition based on user
                sample --}}
                {{-- Wait, standard Laravel uses PUT/PATCH. The sample Route::post ... update. So I will use POST as defined
                in route. --}}

                <!-- Name & Category -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Document Name <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="file_name" value="{{ old('file_name', $document->file_name) }}" required
                            class="w-full rounded-lg border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-800 dark:text-slate-200 focus:ring-blue-500 focus:border-blue-500">
                        @error('file_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Category <span
                                class="text-red-500">*</span></label>
                        <select name="pk_document_categorie_id" required
                            class="w-full rounded-lg border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-800 dark:text-slate-200 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Select Category</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->document_categorie_id }}" {{ old('pk_document_categorie_id', $document->pk_document_categorie_id) == $cat->document_categorie_id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('pk_document_categorie_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <!-- Date Range -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Start Period <span
                                class="text-red-500">*</span></label>
                        <input type="date" name="period_start" value="{{ old('period_start', $document->period_start) }}"
                            required
                            class="w-full rounded-lg border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-800 dark:text-slate-200 focus:ring-blue-500 focus:border-blue-500">
                        @error('period_start') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">End Period <span
                                class="text-red-500">*</span></label>
                        <input type="date" name="period_end" value="{{ old('period_end', $document->period_end) }}" required
                            class="w-full rounded-lg border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-800 dark:text-slate-200 focus:ring-blue-500 focus:border-blue-500">
                        @error('period_end') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <!-- Description -->
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Description</label>
                    <textarea name="description" rows="3"
                        class="w-full rounded-lg border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-800 dark:text-slate-200 focus:ring-blue-500 focus:border-blue-500">{{ old('description', $document->description) }}</textarea>
                    @error('description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- File Upload -->
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Replace File
                        (Optional)</label>
                    @if($document->file_path)
                        <div class="mb-2 text-sm text-blue-500">
                            <a href="{{ Storage::url($document->file_path) }}" target="_blank" class="hover:underline">
                                <i class="fa-solid fa-paperclip"></i> Current File
                            </a>
                        </div>
                    @endif
                    <input type="file" name="file_path"
                        class="w-full rounded-lg border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-800 dark:text-slate-200 p-2 focus:ring-blue-500 focus:border-blue-500">
                    <p class="text-xs text-slate-500 mt-1">Leave empty to keep current file.</p>
                    @error('file_path') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="flex justify-end pt-4 border-t border-slate-100 dark:border-slate-700">
                    <button type="submit"
                        class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition font-medium">
                        Update Document
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection