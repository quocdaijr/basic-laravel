@extends('category::layouts.master')

@section('title', 'Update Category')

@section('content')
    {!! Form::open(['route' => ['category.edit', $category->id], 'method' => 'put']) !!}
    <div class="w-full container mx-auto grid">
        <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
            <!-- Invalid input -->
            <label class="block text-sm mb-4">
                Name
                <input type="text" name="name" value="{{ old('name', $category->name) }}"
                       class="block w-full mt-1 rounded-md shadow-sm focus:ring focus:ring-opacity-50 dark:text-gray-300 dark:bg-gray-700 @error('name') border-red-600 focus:border-red-400 focus:ring-red-200 dark:border-red-400 @else border-indigo-300 focus:border-indigo-300 focus:ring-indigo-200 dark:border-gray-600 @enderror"/>
                @error('name')
                <span class="text-xs text-red-600 dark:text-red-400">{{ $message }}</span>
                @enderror
            </label>

            <label class="block text-sm mb-4">
                Slug
                <input type="text" name="slug" value="{{ old('slug', $category->slug) }}"
                       class="block w-full mt-1 rounded-md shadow-sm focus:ring focus:ring-opacity-50 dark:text-gray-300 dark:bg-gray-700 @error('slug') border-red-600 focus:border-red-400 focus:ring-red-200 dark:border-red-400 @else border-indigo-300 focus:border-indigo-300 focus:ring-indigo-200 dark:border-gray-600 @enderror"/>
                @error('slug')
                <span class="text-xs text-red-600 dark:text-red-400">{{ $message }}</span>
                @enderror
            </label>

            <label class="block mb-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                  Status
                </span>
                <select name="status"
                        class="block w-full mt-1 rounded-md shadow-sm focus:ring focus:ring-opacity-50 dark:text-gray-300 dark:bg-gray-700 @error('status') border-red-600 focus:border-red-400 focus:ring-red-200 dark:border-red-400 @else border-indigo-300 focus:border-indigo-300 focus:ring-indigo-200 dark:border-gray-600 @enderror">
                    {!! \Modules\Core\Constants\CoreConstant::htmlOptionStatuses(old('status', $category->status)) !!}
                </select>
                @error('status')
                <span class="text-xs text-red-600 dark:text-red-400">{{ $message }}</span>
                @enderror
            </label>

            <label class="block text-sm mb-4">
                Description
                <textarea type="text" name="description"
                          class="block w-full mt-1 rounded-md shadow-sm focus:ring focus:ring-opacity-50 dark:text-gray-300 dark:bg-gray-700 @error('description') border-red-600 focus:border-red-400 focus:ring-red-200 dark:border-red-400 @else border-indigo-300 focus:border-indigo-300 focus:ring-indigo-200 dark:border-gray-600 @enderror">{{ old('description', $category->description) }}</textarea>
                @error('description')
                <span class="text-xs text-red-600 dark:text-red-400">{{ $message }}</span>
                @enderror
            </label>

            <button type="submit"
                    class="w-28 px-5 py-3 font-medium font-bold leading-5 text-white transition-colors duration-150 bg-green-500 border border-transparent rounded-lg hover:bg-green-700">
                Update
            </button>

        </div>
    </div>
    {!! Form::close() !!}
@stop
@push('scripts')
    <script>
        document.getElementById('name').onkeyup = function (e) {
            copyToInput('name', 'slug', 'slug')
        }
    </script>
@endpush
