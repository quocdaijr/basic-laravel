<x-field::text name="name" :oldValue="$tag->name ?? null" :options="['id'=>'name']"/>
<x-field::text name="slug" :oldValue="$tag->slug ?? null" :options="['id'=>'slug']"/>
<x-field::select
    name="status"
    :oldValue="$tag->status ?? null"
    :options="['selectOptions' => \Modules\Core\Constants\CoreConstant::statuses()]"
/>

<label class="block text-sm mb-4">
    <span class="text-gray-700 dark:text-gray-400">{{__('Description')}}</span>
    <textarea type="text" name="description"
              class="block w-full mt-1 rounded-md shadow-sm focus:ring focus:ring-opacity-50 dark:text-gray-300 dark:bg-gray-700 @error('description') border-red-600 focus:border-red-400 focus:ring-red-200 dark:border-red-400 @else border-indigo-300 focus:border-indigo-300 focus:ring-indigo-200 dark:border-gray-600 @enderror">{{ old('description', $tag->description ?? null) }}</textarea>
    @error('description')
    <span class="text-xs text-red-600 dark:text-red-400">{{ $message }}</span>
    @enderror
</label>
