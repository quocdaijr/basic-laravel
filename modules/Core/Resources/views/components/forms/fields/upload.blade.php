<div class="block text-sm mb-4 {{$options['class'] ?? ''}}">
    <span class="text-gray-700 dark:text-gray-400">{{__($options['title'] ?? ucfirst($name))}}</span>
    <div x-data="uploadAndPreviewImage{{$uniqueId}}()"
         class="flex flex-col items-center my-2"
    >
        <label class="{{$name . '_input'}}
            w-full flex flex-col items-center px-4 py-4 text-blue-500 rounded-lg shadow-lg tracking-wide
            uppercase border border-blue cursor-pointer hover:bg-blue-500 hover:text-gray-100 dark:text-blue-200
            dark:border-gray-600 dark:hover:text-gray-100"
               :class="{ 'hidden': isHasFile }"
        >
            <svg class="w-8 h-8" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path
                    d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z"/>
            </svg>
            <span class="mt-2 text-base leading-normal">Select a file</span>
            <input class="hidden" type="button" @click="selectFile()">
            <input type='hidden' id="{{$name . '_input'}}" name="{{$name}}" value="{{old($name, $oldValue)}}"/>
        </label>
        <div class="{{$name . '_preview'}} relative"
             :class="{ 'hidden': !isHasFile }"
        >
            <img src="{{!empty(old($name, $oldValue)) ? ($options['url'] ?? '') : ''}}"
                 id="{{$name . '_preview'}}"
                 class="rounded pr-4 pt-4"
                 alt=""
            />
            <div class="absolute top-1 right-1 w-6 h-6 text-center bg-red-700 rounded-full cursor-pointer"
                 @click="clearFile()">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                          d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                          clip-rule="evenodd"/>
                </svg>
            </div>
        </div>
    </div>
    <span id="{{$name}}_err" class="hidden text-xs text-red-600 dark:text-red-400"></span>
    @error($name)
    <span class="text-xs text-red-600 dark:text-red-400">{{ $message }}</span>
    @enderror
</div>

<x-modal::file-manager
    :for="'input_upload_image'"
    :btnOpenModalId="'btn_modal_file_manager_for_upload_and_preview_' . $uniqueId" :hiddenBtnOpenModal="true"
    :options="[]"
/>

@push('scripts')
    <script>
        window.uploadAndPreviewImage{{$uniqueId}} = function () {
            let btnModal = document.getElementById('btn_modal_file_manager_for_upload_and_preview_' + '{{$uniqueId}}')
            let previewTxt = '{{$name . '_preview'}}';
            let inputTxt = '{{$name . '_input'}}';
            let previewId = document.getElementById(previewTxt)
            let inputId = document.getElementById(inputTxt)
            return {
                isHasFile: false,
                init() {
                    this.validateFileExits()
                },
                selectFile() {
                    if (document.body.contains(btnModal)) {
                        btnModal.setAttribute('data-type', 'image')
                        btnModal.setAttribute('data-preview_id', previewTxt)
                        btnModal.setAttribute('data-input_id', inputTxt)
                        btnModal.click()
                    } else {
                        console.error("Not found file manager dialog")
                    }
                },
                validateFileExits() {
                    let url = previewId.getAttribute('src');
                    let id = inputId.getAttribute('value');
                    this.isHasFile = url !== '' && id !== '';
                },
                clearFile() {
                    inputId.setAttribute('value', '')
                    previewId.setAttribute('src', '')
                    this.isHasFile = false
                    document.getElementsByClassName(previewTxt)[0].classList.add("hidden")
                    document.getElementsByClassName(inputTxt)[0].classList.remove("hidden")
                }
            };
        }
    </script>
@endpush
