<label class="block text-sm mb-4">
    <span class="text-gray-700 dark:text-gray-400">{{__('Content')}}</span>
    <textarea type="text" name="content" id="content"
              class="mt-1 min-h-full block w-full rounded-md shadow-sm focus:ring focus:ring-opacity-50 dark:text-gray-300 dark:bg-gray-700 @error('content') border-red-600 focus:border-red-400 focus:ring-red-200 dark:border-red-400 @else border-indigo-300 focus:border-indigo-300 focus:ring-indigo-200 dark:border-gray-600 @enderror">{{ old('description') }}</textarea>
    @error('content')
    <span class="text-xs text-red-600 dark:text-red-400">{{ $message }}</span>
    @enderror
</label>
@push('scripts')
{{--    <script src="https://ckeditor.com/apps/ckfinder/3.5.0/ckfinder.js"></script>--}}
    <script src="{{mix('modules/post/js/post.js')}}"></script>
    <script>
        ClassicEditor.create(document.querySelector('#content'), {
            toolbar: [
                'ckfinder',
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
                uploadUrl: '/ckfinder/connector?command=FileUpload&type=Images&responseType=json',
                // browseUrl: 'http://basic.laravel.local/laravel-filemanager?type=Images',

                // // Define the CKFinder configuration (if necessary).
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
