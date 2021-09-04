<x-field::text name="name" :oldValue="$category->name ?? null" :options="['id'=>'name']"/>
<x-field::text name="slug" :oldValue="$category->slug ?? null" :options="['id'=>'slug']"/>
<x-field::select
    name="status"
    :oldValue="$category->status ?? null"
    :options="['selectOptions' => \Modules\Core\Constants\CoreConstant::statuses()]"
/>

{{--<label class="block mb-4 text-sm">--}}
{{--    <span class="text-gray-700 dark:text-gray-400">--}}
{{--      Status--}}
{{--    </span>--}}
{{--    <select name="status"--}}
{{--            class="block w-full mt-1 rounded-md shadow-sm focus:ring focus:ring-opacity-50 dark:text-gray-300 dark:bg-gray-700 @error('status') border-red-600 focus:border-red-400 focus:ring-red-200 dark:border-red-400 @else border-indigo-300 focus:border-indigo-300 focus:ring-indigo-200 dark:border-gray-600 @enderror">--}}
{{--        {!! \Modules\Core\Constants\CoreConstant::statuses() !!}--}}
{{--    </select>--}}
{{--    @error('status')--}}
{{--    <span class="text-xs text-red-600 dark:text-red-400">{{ $message }}</span>--}}
{{--    @enderror--}}
{{--</label>--}}

<label class="block text-sm mb-4">
    <span class="text-gray-700 dark:text-gray-400">{{__('Description')}}</span>
    <textarea type="text" name="description"
              class="block w-full mt-1 rounded-md shadow-sm focus:ring focus:ring-opacity-50 dark:text-gray-300 dark:bg-gray-700 @error('description') border-red-600 focus:border-red-400 focus:ring-red-200 dark:border-red-400 @else border-indigo-300 focus:border-indigo-300 focus:ring-indigo-200 dark:border-gray-600 @enderror">{{ old('description', $category->description ?? null) }}</textarea>
    @error('description')
    <span class="text-xs text-red-600 dark:text-red-400">{{ $message }}</span>
    @enderror
</label>
<x-field::upload name="thumbnail" :oldValue="$category->thumbnailDetail->id ?? null" :options="['id'=>'thumbnail', 'class' => 'w-1/2', 'url' => getUrlFile($category->thumbnailDetail->path ?? '')]"/>

