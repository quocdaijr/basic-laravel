<label class="block text-sm mb-4">
    <span class="text-gray-700 dark:text-gray-400">{{__($options['title'] ?? ucfirst($name))}}</span>
    <div class="flatpickr flex items-center w-full text-gray-600 mt-1" id="flatpickr_{{$options['id']}}">
        <input type="text" name="{{$name}}" value="{{ old($name, $oldValue)}}"
               id="{{$options['id']}}"
               class="flex-grow h-10 block shadow-sm rounded-l-md text-gray-600 focus:ring focus:ring-opacity-50 dark:text-gray-300 dark:bg-gray-700
            @error($name) border-red-600 focus:border-red-400 focus:ring-red-200 dark:border-red-400
            @else border-indigo-300 focus:border-indigo-300 focus:ring-indigo-200 dark:border-gray-600
            @enderror"
               placeholder="{{$options['placeholder'] ?? ''}}"
               data-input
        />
        <a class="flex flex-col h-10 w-10 block border shadow-sm text-gray-600 focus:ring focus:ring-opacity-50 dark:text-gray-300 dark:bg-gray-700
            @error($name) border-red-600 focus:border-red-400 focus:ring-red-200 dark:border-red-400
            @else border-indigo-300 focus:border-indigo-300 focus:ring-indigo-200 dark:border-gray-600
            @enderror"
           title="toggle" data-toggle>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mx-auto my-auto" fill="none" viewBox="0 0 24 24"
                 stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </a>

        <a class="flex flex-col h-10 w-10 block border rounded-r-md shadow-sm text-gray-600 focus:ring focus:ring-opacity-50 dark:text-gray-300 dark:bg-gray-700
            @error($name) border-red-600 focus:border-red-400 focus:ring-red-200 dark:border-red-400
            @else border-indigo-300 focus:border-indigo-300 focus:ring-indigo-200 dark:border-gray-600
            @enderror"
           title="clear" data-clear>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mx-auto my-auto" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                      d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                      clip-rule="evenodd"/>
            </svg>
        </a>
    </div>
    @error($name)
    <span class="text-xs text-red-600 dark:text-red-400">{{ $message }}</span>
    @enderror
</label>

@push('stylesheets')
    <link rel="stylesheet" href="{{ mix('modules/core/css/flatpickr.css') }}">
@endpush

@push("scripts")
    <script src="{{mix('modules/core/js/flatpickr.js')}}"></script>
    <script>
        let published_time_picker = flatpickr("#flatpickr_{{$options['id']}}", {
            enableTime: true,
            time_24hr: true,
            wrap: true,
        });
    </script>
@endpush
