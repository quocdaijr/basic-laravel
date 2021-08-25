<label class="block text-sm mb-4">
    <span class="text-gray-700 dark:text-gray-400">Name</span>
    <input type="text" name="name" id="name" value="{{ old('name', $post->name ?? null) }}"
           class="mt-1 block w-full rounded-md shadow-sm focus:ring focus:ring-opacity-50 dark:text-gray-300 dark:bg-gray-700 @error('name') border-red-600 focus:border-red-400 focus:ring-red-200 dark:border-red-400 @else border-indigo-300 focus:border-indigo-300 focus:ring-indigo-200 dark:border-gray-600 @enderror"/>
    @error('name')
    <span class="text-xs text-red-600 dark:text-red-400">{{ $message }}</span>
    @enderror
</label>

<label class="block text-sm mb-4">
    <span class="text-gray-700 dark:text-gray-400">Title</span>
    <input type="text" name="title" id="title" value="{{ old('title', $post->title ?? null) }}"
           class="mt-1 block w-full rounded-md shadow-sm focus:ring focus:ring-opacity-50 dark:text-gray-300 dark:bg-gray-700 @error('title') border-red-600 focus:border-red-400 focus:ring-red-200 dark:border-red-400 @else border-indigo-300 focus:border-indigo-300 focus:ring-indigo-200 dark:border-gray-600 @enderror"/>
    @error('title')
    <span class="text-xs text-red-600 dark:text-red-400">{{ $message }}</span>
    @enderror
</label>

<label class="block text-sm mb-4">
    <span class="text-gray-700 dark:text-gray-400">Slug</span>
    <input type="text" name="slug" id="slug" value="{{ old('slug', $post->slug ?? null) }}"
           class="mt-1 block w-full rounded-md shadow-sm focus:ring focus:ring-opacity-50 dark:text-gray-300 dark:bg-gray-700 @error('slug') border-red-600 focus:border-red-400 focus:ring-red-200 dark:border-red-400 @else border-indigo-300 focus:border-indigo-300 focus:ring-indigo-200 dark:border-gray-600 @enderror"/>
    @error('slug')
    <span class="text-xs text-red-600 dark:text-red-400">{{ $message }}</span>
    @enderror
</label>
@push('scripts')
    <script>
        document.getElementById('name').onkeyup = function (e) {
            copyToInput('name', 'slug', 'slug')
            copyToInput('name', 'title', 'text')
        }
    </script>
@endpush
