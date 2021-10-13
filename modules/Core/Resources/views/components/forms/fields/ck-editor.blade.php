<label class="block text-sm mb-4">
    <span class="text-gray-700 dark:text-gray-400">{{__($options['title'] ?? ucfirst($name))}}</span>
    <textarea name="{{$name}}"  {!! !empty($options['id']) ? ('id="'. $options['id'] .'"') : '' !!}
              class="mt-1 min-h-full block w-full rounded-md shadow-sm focus:ring focus:ring-opacity-50 dark:text-gray-300 dark:bg-gray-700
                @error($name) border-red-600 focus:border-red-400 focus:ring-red-200 dark:border-red-400
                @else border-indigo-300 focus:border-indigo-300 focus:ring-indigo-200 dark:border-gray-600 @enderror
                  ">{{ old($name, $oldValue) }}</textarea>
    @error($name)
    <span class="text-xs text-red-600 dark:text-red-400">{{ $message }}</span>
    @enderror
</label>
@push('scripts')
    <script src="{{mix('assets/modules/core/js/ck-editor.js')}}"></script>
    <script>
        ClassicEditor.create(document.querySelector('#{{$name}}'), {
            // plugins: [SimpleUploadAdapter],
            toolbar: [
                // 'ckfinder',
                'heading',
                '|',
                'bold',
                'italic',
                'link',
                'bulletedList',
                'numberedList',
                '|',
                'indent',
                'outdent',
                '|',
                'imageUpload',
                'blockQuote',
                'insertTable',
                'mediaEmbed',
                'undo',
                'redo'
            ],
            image: {
                toolbar: [
                    // 'imageStyle:full',
                    'imageStyle:side',
                    '|',
                    'imageTextAlternative'
                ]
            },
            table: {
                contentToolbar: [
                    'tableColumn',
                    'tableRow',
                    'mergeTableCells'
                ]
            },

            ckfinder: {
                // Upload the images to the server using the CKFinder QuickUpload command.
                uploadUrl: '/file/create?layout=ckeditor',
                options: {
                    resourceType: 'Images'
                },
            }
        })
            .then(editor => {
                console.log(editor);
            })
            .catch(error => {
                console.log(error);
            });
    </script>
@endpush
