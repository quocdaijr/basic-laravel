<label class="block text-sm mb-4">
    <span class="text-gray-700 dark:text-gray-400">{{__($options['title'] ?? ucfirst($name))}}</span>
    <input type="{{$options['type'] ?? 'text'}}" name="{{$name}}" value="{{ old($name, $oldValue)}}"
           {!! !empty($options['id']) ? ('id="'. $options['id'] .'"') : '' !!}
           class="mt-1 block w-full rounded-md shadow-sm focus:ring focus:ring-opacity-50
           text-gray-700 dark:text-gray-300 dark:bg-gray-700
           @error($name) border-red-600 focus:border-red-400 focus:ring-red-200 dark:border-red-400
           @else border-indigo-300 focus:border-indigo-300 focus:ring-indigo-200 dark:border-gray-600 @enderror"
           placeholder="{{$options['placeholder'] ?? ''}}"
    />
    @error($name)
    <span class="text-xs text-red-600 dark:text-red-400">{{ $message }}</span>
    @enderror
</label>
