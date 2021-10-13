<div x-data="dataFileManager{{$uniqueId}}()" @keydown.escape="closeModalFileManager()" x-cloak>
    <section class="flex flex-wrap p-4 h-full items-center">
        <button type="button"
                id="{{$btnOpenModalId ?? ('btn_open_modal_file_manager' . $uniqueId)}}"
                class="bg-transparent border border-gray-500 hover:border-indigo-500 text-gray-500 hover:text-indigo-500 font-bold py-2 px-4 rounded-full"
                @click="openModalFileManager()"
                style="{{($hiddenBtnOpenModal ?? false) ? 'display:none' : ''}}"
                data-type=""
                data-preview_id=""
                data-input_id=""
        >Open File Manager
        </button>

        <div class="modal-file-manager-{{$uniqueId}} overflow-auto bg-gray-400"
             style="background-color: rgba(0,0,0,.5);"
             id="modal_file_manager_{{$uniqueId}}"
             x-show="showModal"
             :class="{ 'absolute inset-0 z-50 flex items-center justify-center': showModal }"
             aria-labelledby="modal-title" role="dialog"
        >
            <div
                class="flex flex-col h-5/6 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 w-11/12 md:w-10/12 mx-auto rounded shadow-lg py-4 text-left px-6"
                role="document"
                x-show="showModal"
                {{--                @click.away="closeModalFileManager()"--}}
                x-transition:enter="transition ease-out duration-100"
                x-transition:enter-start="opacity-0 transform scale-90"
                x-transition:enter-end="opacity-100 transform scale-100"
            >
                <div class="flex justify-between items-center pb-5">
                    <p class="text-2xl font-bold capitalize" x-text="type + ' Manager'"></p>
                    <div class="cursor-pointer z-50 -mt-2 -mr-2" @click="closeModalFileManager()">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" viewBox="0 0 20 20"
                             fill="currentColor">
                            <path fill-rule="evenodd"
                                  d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                  clip-rule="evenodd"/>
                        </svg>
                    </div>
                </div>
                <div class="flex-grow flex flex-col col-span-12 lg:col-span-9 xxl:col-span-10">
                    <div class="flex flex-col-reverse sm:flex-row items-center">
                        <div class="w-full sm:w-auto relative mr-auto mt-3 sm:mt-0">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="feather feather-search w-4 h-4 absolute my-auto inset-y-0 ml-3 left-0 z-10"
                                 fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                            <input type="text"
                                   id="txtSearchFileManager{{$uniqueId}}"
                                   class="block h-10 rounded-md shadow-sm sm:w-64 box px-10 focus:ring focus:ring-opacity-50
                                   text-gray-700 dark:text-gray-300 dark:bg-gray-700 border-indigo-300
                                   focus:border-indigo-300 focus:ring-indigo-200 dark:border-gray-600"
                                   placeholder="Search files"/>
                        </div>
                        <div class="w-full sm:w-auto relative mr-auto ml-3 mt-3 sm:mt-0">
                            <button type="button"
                                    class="h-10 min-w-full px-4 bg-transparent py-1 rounded-lg text-white bg-green-500 hover:bg-green-700"
                                    @click="searchFiles()"
                            >Search
                            </button>
                        </div>
                        <div class="flex-grow justify-end w-full sm:w-auto flex mt-3 sm:mt-0">
                            <label class="h-10 font-medium font-bold leading-5 transition-colors duration-150
                            border border-transparent bg-blue-500 hover:bg-blue-700 text-white
                            rounded-lg shadow-md mr-2 cursor-pointer">
                                <span class="px-5 leading-10">
                                    <input type="file" multiple class="hidden"
                                           @change="uploadFiles($el)"/>
                                    Upload New Files
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="flex-grow grid grid-cols-5 gap-2 mt-8" x-show="isHasFile()">
                        <div
                            class="tab-list-file col-span-4 grid grid-cols-12 sm:gap-6 p-2 rounded-md bg-gray-50 dark:bg-gray-900"
                            x-show="isHasFile()">
                            <template x-for="item in files">
                                <div class="h-44 col-span-6 max-w-sm sm:col-span-4 md:col-span-3 xl:col-span-2 rounded-lg
                                 bg-gray-100 dark:bg-gray-700 transform hover:scale-105">
                                    <label class="cursor-pointer" x-bind:title="item.title">
                                        <div class="box rounded-md pt-8 pb-5 px-5 relative">
                                            <div class="absolute left-0 top-0 mt-2 ml-2">
                                                <input class="border"
                                                       type="{{($multiple ?? false) ? 'checkbox' : 'radio'}}"
                                                       x-bind:data-value="convertJsonToString(item)"
                                                       name="fileSelected"
                                                       @click="selectFile($el, item)"
                                                >
                                            </div>
                                            <div class="w-5/6 h-32 mx-auto">
                                                <img x-bind:src="item.url" class="max-h-full max-w-full mx-auto"
                                                     x-show="item.type === 'image'">
                                                <video x-bind:src="item.url"
                                                       class="max-h-full max-w-full mx-auto"
                                                       x-show="item.type === 'video'"
                                                       controls
                                                ></video>
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                     class="h-20 w-20 mx-auto" fill="none"
                                                     viewBox="0 0 24 24" stroke="currentColor"
                                                     x-show="file.type === 'document'"
                                                >
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          stroke-width="2"
                                                          d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                                </svg>

                                            </div>
                                            <div class="block font-medium mt-4 text-center truncate"
                                                 x-text="item.name"></div>
                                            <div class="text-xs text-center" x-text="formatCapacity(item.size)"></div>
                                        </div>
                                    </label>
                                </div>
                            </template>
                        </div>
                        <div
                            class="col-span-1 p-2 flex flex-col justify-between rounded-md bg-gray-50 dark:bg-gray-900 hidden"
                            id="formUpdateFile{{$uniqueId}}"
                            x-bind:data-id="file.id || ''"
                        >
                            <div class="h-24">
                                <img x-bind:src="file.url || ''"
                                     class="file-preview image-preview max-h-24 mx-auto hidden"
                                     alt=""/>
                                <video x-bind:src="file.url || ''"
                                       class="file-preview video-preview max-h-24 mx-auto hidden" controls></video>
                                <svg xmlns="http://www.w3.org/2000/svg"
                                     class="file-preview document-preview h-20 w-20 mx-auto hidden" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor"
                                >
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          stroke-width="2"
                                          d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <label class="block justify-start text-sm mb-4">
                                <span class="text-gray-700 dark:text-gray-400">Title</span>
                                <input type="text" x-bind:value="file.title || ''"
                                       class="title-input mt-1 block w-full rounded-md shadow-sm focus:ring focus:ring-opacity-50
                                        text-gray-700 dark:text-gray-300 dark:bg-gray-700 border-indigo-300
                                         focus:border-indigo-300 focus:ring-indigo-200 dark:border-gray-600"
                                />
                            </label>
                            <label class="block justify-start text-sm mb-4">
                                <span class="text-gray-700 dark:text-gray-400">Description</span>
                                <textarea
                                    class="description-input mt-1 block w-full rounded-md shadow-sm focus:ring focus:ring-opacity-50
                                        text-gray-700 dark:text-gray-300 dark:bg-gray-700 border-indigo-300
                                         focus:border-indigo-300 focus:ring-indigo-200 dark:border-gray-600"
                                    x-text="file.description || ''"
                                ></textarea>
                            </label>
                            <div class="h-44 overflow-auto">
                                <p class="text-xs py-2"
                                ><b>ID: </b><span
                                        x-text="file.id || ''"></span></p>
                                <p class="overflow-x-auto text-xs py-2"
                                ><b>Url: </b><input class="w-full" x-bind:value="file.url || ''" disabled/></p>
                                <p class="text-xs py-2"
                                ><b>Size: </b><span
                                        x-text="formatCapacity(file.size || '')"></span></p>
                                <p class="text-xs py-2"
                                ><b>Mine Type: </b><span
                                        x-text="file.mimetype || ''"></span></p>
                                <p class="text-xs py-2"
                                ><b>Created At: </b><span
                                        x-text="file.created_at ? new Date(file.created_at).toLocaleString() : ''"></span>
                                </p>
                                <p class="text-xs py-2"
                                ><b>Updated At: </b><span
                                        x-text="file.updated_at ? new Date(file.updated_at).toLocaleString() : ''"></span>
                                </p>
                            </div>
                            <div class="flex-grow justify-center flex items-center">
                                <button type="button"
                                        class="h-10 mr-1 px-4 rounded-lg text-white bg-blue-500 hover:bg-blue-600"
                                        @click="updateFile()"
                                >Update
                                </button>
                                <button type="button"
                                        class="h-10 ml-1 px-4 rounded-lg text-white bg-red-500 hover:bg-red-600"
                                        @click="deleteFile()"
                                >Delete
                                </button>
                            </div>
                        </div>
                    </div>
                    <div x-show="!isHasFile()">Không có file</div>
                </div>
                <div class="flex justify-between pt-8">
                    <div
                        class="flex flex-col justify-start items-left">
                        <span class="text-xs xs:text-sm"
                              x-text="'Showing '
                               + (currentPage - 1) * perPage
                               + ' to ' +((currentPage - 1) * perPage + files.length)
                               + ' of ' + totalItems + ' Files'"
                        >
                        </span>
                        <div class="inline-flex mt-2 xs:mt-0">
                            <button
                                type="button"
                                @click="previousPage()"
                                :disabled="currentPage <= 1"
                                class="text-sm bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded-l">
                                Prev
                            </button>
                            <button
                                type="button"
                                @click="nextPage()"
                                :disabled="currentPage >= totalPages"
                                class="text-sm bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded-r">
                                Next
                            </button>
                        </div>
                    </div>
                    <div
                        class="flex flex-row justify-end items-end">
                        @switch($for ?? '')
                            @case('tinymce')
                            <button type="button"
                                    class="h-12 min-w-full px-4 mr-2 bg-transparent py-3 rounded-lg text-white bg-green-500 hover:bg-green-700"
                                    @click="insertToTinyMCE('{{$options['editorId'] ?? 'content'}}')"
                            >Insert To Editor
                            </button>
                            @break
                            @case('input_upload_image')
                            <button type="button"
                                    class="h-12 min-w-full px-4 bg-transparent p-3 rounded-lg mr-2 text-white bg-green-500 hover:bg-green-600"
                                    @click="insertForInputUploadImage()"
                            >Insert
                            </button>
                            @break
                        @endswitch
                        <button type="button"
                                class="h-12 min-w-full px-4 py-3 rounded-lg text-white bg-yellow-500 hover:bg-yellow-600"
                                @click="closeModalFileManager()"
                        >Close
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </section>
</div>

@push('scripts')
    <script>
        window.dataFileManager{{$uniqueId}} = function () {
            let txtSearchElement = document.getElementById('txtSearchFileManager{{$uniqueId}}');
            let formUpdateFileElement = document.getElementById('formUpdateFile{{$uniqueId}}');
            return {
                showModal: false,
                files: [],
                file: {},
                pagination: [],
                selected: [],
                type: '',
                totalItems: 0,
                totalPages: 1,
                currentPage: 1,
                perPage: 12,
                txtSearch: '',
                toggleModalFileManager() {
                    this.showModal = !this.showModal
                },
                openModalFileManager() {
                    this.showModal = true
                    this.type = document.getElementById('{{$btnOpenModalId ?? ('btn_open_modal_file_manager' . $uniqueId)}}').getAttribute('data-type')
                    this.selected = []
                    this.syncFiles()
                },
                closeModalFileManager() {
                    this.showModal = false
                },
                syncFiles() {
                    ajaxGetFiles({
                        type: this.type,
                        status: constData.status.active,
                        txt: this.txtSearch,
                        page: this.currentPage,
                        perPage: this.perPage
                    }).then(res => {
                        if (res.data) {
                            this.files = res.data.data
                            this.totalItems = res.data.totalItems || 0
                            this.totalPages = res.data.totalPages || 1
                        }
                    }).catch(err => {
                        console.log(err)
                    });
                    this.clearSelected()
                },
                uploadFiles(element) {
                    let files = element.files;
                    if (files) {
                        console.log(files)
                        Array.from(files).forEach(file => {
                            if (file) {
                                let filename = file.name || 'unknown'
                                ajaxUpload(file, '', this.type).then(res => {
                                    this.syncFiles()
                                    toastrNotification('success', 'Upload "' + filename + '" success')
                                }).catch(err => {
                                    toastrNotification('error', 'Error "' + filename + '": ' + (err.response.data.message || 'unknown'))
                                });
                            } else {
                                console.log("No file is uploaded")
                            }
                        })
                    }
                },
                updateFile() {
                    if (this.file.id) {
                        let data = {
                            title: formUpdateFileElement.querySelector('.title-input').value,
                            description: formUpdateFileElement.querySelector('.description-input').value,
                        }
                        ajaxUpdateFile(this.file.id, data).then(res => {
                            if (res.data.success) {
                                this.syncFiles()
                                toastrNotification('success', 'Update Success')
                            } else {
                                toastrNotification('error', 'Update Failed. Please retry later')
                            }
                        }).catch(err => {
                            console.log(err)
                        });
                    }
                },
                deleteFile() {
                    if (this.file.id) {
                        alertConfirm('#modal_file_manager_{{$uniqueId}}').then(confirm => {
                            if (confirm) {
                                ajaxDeleteFile(this.file.id).then(res => {
                                    if (res.data.success) {
                                        this.file = {}
                                        this.syncFiles()
                                        formUpdateFileElement.classList.add("hidden")
                                        toastrNotification('success', 'Update Success')
                                    } else {
                                        toastrNotification('error', 'Update Failed. Please retry later')
                                    }
                                }).catch(err => {
                                    console.log(err)
                                });
                            }
                            return false
                        })
                    }
                },
                nextPage() {
                    this.currentPage += 1;
                    this.syncFiles()
                },
                previousPage() {
                    this.currentPage -= 1;
                    this.syncFiles()
                },
                searchFiles() {
                    this.txtSearch = txtSearchElement.value
                    this.currentPage = 1
                    this.syncFiles()
                },
                selectFile(element, file) {
                    if (element.checked) {
                        this.file = file
                        formUpdateFileElement.querySelectorAll('.file-preview').forEach(item => item.classList.add("hidden"));
                        switch (file.type) {
                            case 'image':
                                formUpdateFileElement.querySelector('.image-preview').classList.remove("hidden")
                                break;
                            case 'video':
                                formUpdateFileElement.querySelector('.video-preview').classList.remove("hidden")
                                break;
                            default:
                                formUpdateFileElement.querySelector('.document-preview').classList.remove("hidden")
                                break;
                        }
                        formUpdateFileElement.classList.remove("hidden")
                    } else {
                        this.file = {}
                        formUpdateFileElement.classList.add("hidden")
                    }
                },
                clearSelected() {
                    let checkboxes = document.querySelectorAll('input[name=fileSelected]')
                    for (let i = 0; i < checkboxes.length; i++) {
                        checkboxes[i].checked = false
                    }
                },
                isHasFile() {
                    return this.files !== [];
                },
                setSelected() {
                    let checkboxes = document.querySelectorAll('input[name=fileSelected]:checked')
                    for (let i = 0; i < checkboxes.length; i++) {
                        this.selected.push(JSON.parse(checkboxes[i].getAttribute('data-value').replaceAll("'", "\"")))
                        checkboxes[i].checked = false
                    }
                },
                insertToTinyMCE(editorId) {
                    this.setSelected()
                    let html = ''
                    switch (this.type) {
                        case constData.resourceType.image:
                            this.selected.forEach(function (value) {
                                html += '<figure class="file-figure image-figure image" contenteditable="true">' +
                                    '<img class="image-import" src="' + value.url + '" alt="' + value.title + '" width="100%"/>' +
                                    '<figcaption>' + value.title + '</figcaption>' +
                                    '</figure>'
                            })
                            break
                        case constData.resourceType.video:
                            this.selected.forEach(function (value) {
                                html += '<figure class="file-figure video-figure" contenteditable="true">' +
                                    '<video class="video-import" id="video_' + value.id + '" controls="controls" crossorigin="anonymous"> ' +
                                    '<source src="' + value.url + '" type="' + value.mimetype + '" />' +
                                    'Your browser does not support embedded videos.' +
                                    '</video>' +
                                    '<figcaption>' + value.title + '</figcaption>' +
                                    '</figure>'
                            })
                            break
                        default:
                            this.selected.forEach(function (value) {
                                html += '<figure class="file-figure other-figure">' +
                                    '<a class="file-import" href="' + value.url + '">' + value.title + '</a>' +
                                    '<figcaption>' + value.title + '</figcaption>' +
                                    '</figure>'
                            })

                    }
                    tinymce.get(editorId).insertContent(html);
                    this.selected = [];
                    this.closeModalFileManager()
                    toastrNotification('success', 'Insert to editor is success')
                },
                insertForInputUploadImage() {
                    this.setSelected()
                    let btnOpenModal = document.getElementById('{{$btnOpenModalId ?? ('btn_open_modal_file_manager' . $uniqueId)}}')
                    let previewId = btnOpenModal.getAttribute('data-preview_id')
                    let inputId = btnOpenModal.getAttribute('data-input_id')
                    document.getElementById(previewId).setAttribute('src', this.selected[0].url || '')
                    document.getElementById(inputId).setAttribute('value', this.selected[0].id || '')

                    if (this.selected[0].url && this.selected[0].id) {
                        document.getElementsByClassName(previewId)[0].classList.remove("hidden")
                        document.getElementsByClassName(inputId)[0].classList.add("hidden")
                    } else {
                        document.getElementsByClassName(previewId)[0].classList.add("hidden")
                        document.getElementsByClassName(inputId)[0].classList.remove("hidden")
                    }
                    this.selected = [];
                    this.closeModalFileManager()
                    toastrNotification('success', 'Select file is success')
                },
            }
        }
    </script>
@endpush
