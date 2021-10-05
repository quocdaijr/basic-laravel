<label class="block mb-4 text-sm">
    <span class="text-gray-700 dark:text-gray-400">{{__($options['title'] ?? ucfirst($name))}}</span>
    <select id="{{$options['id'] ?? ''}}" multiple name="{{$name . '[]'}}"
            class="block hidden w-full mt-1 rounded-md shadow-sm text-gray-700 focus:ring focus:ring-opacity-50 dark:text-gray-300 dark:bg-gray-700 @error($name) border-red-600 focus:border-red-400 focus:ring-red-200 dark:border-red-400 @else border-indigo-300 focus:border-indigo-300 focus:ring-indigo-200 dark:border-gray-600 @enderror">
        @foreach($options['selectOptions'] as $key => $value)
            <option value="{{$key}}">{{$value}}</option>
        @endforeach
    </select>
    <div x-data="multipleSelect('{{$options['id']}}')"
         x-init="initOptions({{json_encode(old($name, $oldValue))}})"
         class="w-full flex flex-col items-center h-auto mx-auto">
        <div class="inline-block relative w-full">
            <div class="flex flex-col items-center relative">
                <div x-on:click="open" class="w-full">
                    <div
                        class="my-2 p-1 flex border border-gray-200 rounded
                        @error($name) border-red-600 focus:border-red-400 focus:ring-red-200 dark:border-red-400
                        @else border-indigo-300 focus:border-indigo-300 focus:ring-indigo-200 dark:border-gray-600
                        @enderror"
                    >
                        <div class="flex flex-auto flex-wrap">
                            <template x-for="(option, index) in selected" :key="options[option].value">
                                <div
                                    class="flex justify-center items-center m-1 font-medium py-1 px-1 text-gray-700 rounded bg-gray-200 border">
                                    <div class="text-xs font-normal leading-none max-w-full flex-initial"
                                         x-model="options[option]" x-text="options[option].text"></div>
                                    <div class="flex flex-auto flex-row-reverse">
                                        <div x-on:click.stop="remove(index,option)">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="ml-1 h-3 w-3"
                                                 viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                      d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                      clip-rule="evenodd"/>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </template>
                            <div x-show="selected.length === 0" class="flex-1">
                                <input placeholder="Select a option"
                                       class="bg-transparent p-1 px-2 appearance-none outline-none h-full w-full text-gray-800"
                                       x-bind:value="selectedValues()">
                            </div>
                        </div>
                        <div
                            class="text-gray-300 w-8 py-1 pl-2 pr-1 border-l flex items-center border-gray-200 svelte-1l8159u">
                            <button type="button" x-show="isOpen() === true" x-on:click="open"
                                    class="cursor-pointer w-6 h-6 text-gray-600 outline-none focus:outline-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                     fill="currentColor">
                                    <path fill-rule="evenodd"
                                          d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                          clip-rule="evenodd"/>
                                </svg>
                            </button>
                            <button type="button" x-show="isOpen() === false" @click="close"
                                    class="cursor-pointer w-6 h-6 text-gray-600 outline-none focus:outline-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                     fill="currentColor">
                                    <path fill-rule="evenodd"
                                          d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z"
                                          clip-rule="evenodd"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="w-full px-4">
                    <div x-show.transition.origin.top="isOpen()"
                         class="absolute shadow top-100 bg-white z-40 w-full left-0 rounded max-h-select"
                         x-on:click.away="close">
                        <div class="flex flex-col w-full overflow-y-auto h-auto">
                            <template x-for="(option,index) in options" :key="option" class="overflow-auto">
                                <div
                                    class="cursor-pointer w-full text-gray-700 bg-gray-100 rounded-t border-b hover:bg-gray-200"
                                    @click="select(index,$event)">
                                    <div
                                        class="flex w-full items-center p-2 pl-2 border-transparent border-l-2 relative">
                                        <div class="w-full items-center flex justify-between">
                                            <div class="mx-2 leading-6" x-model="option" x-text="option.text"></div>
                                            <div x-show="option.selected">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                     viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                          d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                          clip-rule="evenodd"/>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @error($name)
    <span class="text-xs text-red-600 dark:text-red-400">{{ $message }}</span>
    @enderror
</label>

@push('scripts')
    <script src="{{mix('modules/core/js/forms/multiple-select.js')}}"></script>
@endpush
