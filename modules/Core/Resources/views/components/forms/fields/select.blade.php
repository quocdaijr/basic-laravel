<label class="block mb-4 text-sm">
    <span class="text-gray-700 dark:text-gray-400">{{__($options['title'] ?? ucfirst($name))}}</span>
    <select name="{{$name}}"
            class="block w-full mt-1 rounded-md shadow-sm focus:ring focus:ring-opacity-50 dark:text-gray-300 dark:bg-gray-700
            @error($name) border-red-600 focus:border-red-400 focus:ring-red-200 dark:border-red-400
            @else border-indigo-300 focus:border-indigo-300 focus:ring-indigo-200 dark:border-gray-600 @enderror"
    >
        @if($options['includeNullOption'] ?? true)
            <option value=""></option>
        @endif
        @foreach($options['selectOptions'] as $key => $value)
            <option value="{{$key}}" {{$key == old($name, $oldValue) ? 'selected' : ''}}>{{$value}}</option>
        @endforeach
    </select>
    @error($name)
    <span class="text-xs text-red-600 dark:text-red-400">{{ $message }}</span>
    @enderror
</label>
