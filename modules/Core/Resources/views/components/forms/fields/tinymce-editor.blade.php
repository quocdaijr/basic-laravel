<label class="block text-sm mb-4">
    <span class="text-gray-700 dark:text-gray-400">{{__($options['title'] ?? ucfirst($name))}}</span>
    <textarea name="{{$name}}" id="{{$options['id'] ?? $name}}"
              class="mt-1 min-h-full block w-full rounded-md shadow-sm focus:ring focus:ring-opacity-50 dark:text-gray-300 dark:bg-gray-700
                @error($name) border-red-600 focus:border-red-400 focus:ring-red-200 dark:border-red-400
                @else border-indigo-300 focus:border-indigo-300 focus:ring-indigo-200 dark:border-gray-600 @enderror
                  ">{{ old($name, $oldValue) }}</textarea>
    @error($name)
    <span class="text-xs text-red-600 dark:text-red-400">{{ $message }}</span>
    @enderror
</label>
<x-modal::file-manager :for="'tinymce'" :multiple="true"
                       :btnOpenModalId="'btn_modal_file_manager_for_editor'" :hiddenBtnOpenModal="true"
                       :options="[
                            'editorId' => ($options['id'] ?? $name)
                       ]"
/>
@push('scripts')
    <script src="{{mix('node_modules/tinymce/tinymce.js')}}"></script>
    <script>
        tinymce.init({
            selector: '#{{$name}}',
            min_height: 300,
            autosave_ask_before_unload: false,
            powerpaste_allow_local_images: true,
            plugins: [
                'code autoresize advlist anchor autolink codesample fullscreen help image imagetools',
                ' lists link media noneditable preview',
                ' searchreplace table template visualblocks wordcount'
            ],
            templates: [],
            toolbar:
                'code insertfile undo redo | bold italic | forecolor backcolor | template codesample ' +
                '| alignleft aligncenter alignright alignjustify | bullist numlist | link insertImage',
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }',
            codesample_global_prismjs: true,
            content_css: '{{ mix('node_modules/prismjs/themes/prism-tomorrow.css') }}',
            image_reuse_filename: true,
            images_upload_handler: function (blobInfo, success, failure, progress) {
                let filename;
                if (!('File' in window && blobInfo.blob() instanceof File) && blobInfo.uri())
                    filename = blobInfo.uri().replace(/^.*[\\\/]/, '')
                if (!filename)
                    filename = blobInfo.filename()

                ajaxUpload(blobInfo.blob(), filename, 'image').then(res => {
                    console.log(res.data)
                    if (res.data) {
                        success(res.data.url)
                    }
                }).catch(err => {
                    console.log(err)
                });
            },
            image_caption: true,
            convert_urls: false,
            setup: function (editor) {
                editor.ui.registry.addButton('insertImage', {
                    icon: 'image',
                    onAction: function () {
                        if (document.body.contains(document.getElementById('btn_modal_file_manager_for_editor'))) {
                            document.getElementById('btn_modal_file_manager_for_editor').setAttribute('data-type', 'image')
                            document.getElementById('btn_modal_file_manager_for_editor').click()
                        } else {
                            console.error("Not found file manager dialog")
                        }
                    }
                })
            }
        });
    </script>
@endpush
