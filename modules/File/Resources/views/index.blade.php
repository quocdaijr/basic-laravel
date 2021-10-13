@extends('post::layouts.master')

@section('title', 'File')


@section('content')
    <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800" x-data="fileIndex()">
        <div class="w-full overflow-hidden rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">
                <div class="flex justify-between">
                    <label
                        class="flex items-center justify-between w-26 mb-4 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150
                        bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 dark:text-gray-200 cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 float-left" viewBox="0 0 20 20"
                             fill="currentColor">
                            <path fill-rule="evenodd"
                                  d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z"
                                  clip-rule="evenodd"/>
                        </svg>
                        <span class="float-right ml-2 font-bold">Upload</span>
                        <input type="file" multiple class="hidden" @change="uploadFiles($el)"/>
                    </label>
                    <button
                        class="flex items-center justify-between w-46 mb-4 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150
                        bg-red-600 border border-transparent rounded-lg active:bg-red-600 hover:bg-red-700 dark:text-gray-200"
                        @click="deleteFiles()"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 float-left" viewBox="0 0 20 20"
                             fill="currentColor">
                            <path fill-rule="evenodd"
                                  d="M10 18a8 8 0 100-16 8 8 0 000 16zM7 9a1 1 0 000 2h6a1 1 0 100-2H7z"
                                  clip-rule="evenodd"/>
                        </svg>
                        <span class="float-right ml-2 font-bold">Delete Selected</span>
                    </button>
                </div>
                <form class="flex justify-start items-center" id="formSearchFile">
                    <div class="ml-3 mt-3 sm:mt-0">
                        <label class="block mb-4 text-sm">
                            <span class="text-gray-700 dark:text-gray-400">Text Search</span>
                            <input type="text"
                                   name="txtSearch"
                                   class="block w-full mt-1 rounded-md shadow-sm focus:ring focus:ring-opacity-50
                                        dark:text-gray-300 dark:bg-gray-700 border-indigo-300 focus:border-indigo-300
                                        focus:ring-indigo-200 dark:border-gray-600"
                                   placeholder="Search files"/>
                        </label>
                    </div>
                    <div class="ml-3 mt-3 sm:mt-0">
                        <x-field::select name="status" :oldValue="\Modules\Core\Constants\CoreConstant::STATUS_ACTIVE"
                                         :options="['selectOptions' => \Modules\Core\Constants\CoreConstant::statuses()]"/>
                    </div>

                    <div class="ml-3 mt-3 sm:mt-0">
                        <x-field::select name="type"
                                         :options="['selectOptions' => \Modules\File\Constants\FileConstant::typeFiles()]"/>
                    </div>

                    <div class="ml-3 mt-3 sm:mt-0">
                        <button type="button"
                                class="h-10 min-w-full px-4 bg-transparent py-1 rounded-lg text-white bg-green-500 hover:bg-green-700"
                                @click="searchFiles()"
                        >Search
                        </button>
                    </div>
                </form>
                <div
                    class="w-full grid grid-cols-12 sm:gap-6 p-2 rounded-md bg-gray-50 dark:bg-gray-900">
                    <template x-for="item in files">
                        <div class="col-span-6 max-w-sm sm:col-span-4 md:col-span-3 xl:col-span-2 rounded-lg
                                 bg-gray-100 dark:bg-gray-700 transform hover:scale-105">
                            <label class="cursor-pointer" x-bind:title="item.name">
                                <div class="box rounded-md pt-8 pb-5 px-5 relative">
                                    <template x-if="item.status !== constData.status.deleted">
                                        <div class="absolute left-0 top-0 mt-2 ml-2">
                                            <input class="border"
                                                   type="checkbox"
                                                   x-bind:data-id="item.id"
                                                   name="fileSelected"
                                            >
                                        </div>
                                    </template>
                                    <div class="w-5/6 h-32 mx-auto">
                                        <template
                                            x-if="item.type === constData.resourceType.image && item.status !== constData.status.deleted">
                                            <img x-bind:src="item.url" class="max-h-full max-w-full mx-auto">
                                        </template>
                                        <template
                                            x-if="item.type === constData.resourceType.image && item.status === constData.status.deleted">
                                            <img src="{{getUrlNoImage()}}" class="max-h-full max-w-full mx-auto">
                                        </template>
                                        <template
                                            x-if="item.type === constData.resourceType.video && item.status !== constData.status.deleted">
                                            <video x-bind:src="item.url" class="max-h-full max-w-full mx-auto"
                                                   controls></video>
                                        </template>
                                        <template
                                            x-if="item.type === constData.resourceType.video && item.status === constData.status.deleted">
                                            <img src="{{getUrlNoImage()}}" class="max-h-full max-w-full mx-auto">
                                        </template>
                                        <template
                                            x-if="![constData.resourceType.image, constData.resourceType.video].includes(item.type)">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 class="h-20 w-20 mx-auto" fill="none"
                                                 viewBox="0 0 24 24" stroke="currentColor"
                                            >
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      stroke-width="2"
                                                      d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                            </svg>
                                        </template>
                                    </div>
                                    <div class="block font-medium mt-4 text-center truncate" x-text="item.name"></div>
                                    <div class="text-xs text-center py-2" x-text="formatCapacity(item.size)"></div>
                                    <div class="text-xs text-center py-2" x-html="getHtmlStatus(item.status)"></div>
                                    <template x-if="item.status !== constData.status.deleted">
                                        <div class="flex-grow justify-center flex items-center mt-2">
                                            <button type="button"
                                                    class="h-10 mr-1 px-4 rounded-lg text-white bg-blue-500 hover:bg-blue-600"
                                                    @click="openModal(item)"
                                            >Update
                                            </button>
                                            <button type="button"
                                                    class="h-10 ml-1 px-4 rounded-lg text-white bg-red-500 hover:bg-red-600"
                                                    @click="deleteFile(item.id)"
                                            >Delete
                                            </button>
                                        </div>
                                    </template>
                                </div>
                            </label>
                        </div>
                    </template>
                </div>
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
                <div class="modal-file-update overflow-auto bg-gray-400" style="background-color: rgba(0,0,0,.5);"
                     id="modal_file_update"
                     x-show="showModal"
                     :class="{ 'absolute inset-0 z-50 flex items-center justify-center': showModal }"
                     aria-labelledby="modal-title" role="dialog"
                >
                    <div
                        class="flex flex-col w-1/3 h-5/6 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 mx-auto rounded shadow-lg py-4 text-left px-6"
                        role="document"
                        x-show="showModal"
                        x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="opacity-0 transform scale-90"
                        x-transition:enter-end="opacity-100 transform scale-100"
                    >
                        <template x-if="Object.keys(file).length !== 0">
                            <div>
                                <div class="flex justify-between items-center pb-5">
                                    <p class="text-2xl font-bold capitalize truncate"
                                       x-text="'Update ' + (file.name || 'noname')"></p>
                                    <div class="cursor-pointer z-50 -mt-2 -mr-2" @click="closeModal()">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" viewBox="0 0 20 20"
                                             fill="currentColor">
                                            <path fill-rule="evenodd"
                                                  d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                  clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                </div>
                                <form
                                    class="p-2 flex flex-col justify-between rounded-md bg-gray-50 dark:bg-gray-900"
                                    id="formUpdateFile"
                                >
                                    <div class="h-28">
                                        <img x-bind:src="file.url || ''"
                                             x-show="file.type === constData.resourceType.image"
                                             class="file-preview image-preview max-h-28 mx-auto"
                                             alt=""/>
                                        <video x-bind:src="file.url || ''"
                                               x-show="file.type === constData.resourceType.video"
                                               class="file-preview video-preview max-h-28 mx-auto" controls></video>
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             class="file-preview document-preview max-h-28 mx-auto" fill="none"
                                             viewBox="0 0 24 24" stroke="currentColor"
                                             x-show="![constData.resourceType.image, constData.resourceType.video].includes(file.type)"
                                        >
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  stroke-width="2"
                                                  d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                    </div>
                                    <label class="block justify-start text-sm mb-4">
                                        <span class="text-gray-700 dark:text-gray-400">Name</span>
                                        <input type="text" x-bind:value="file.name || ''" name="name"
                                               class="title-input mt-1 block w-full rounded-md shadow-sm focus:ring focus:ring-opacity-50
                                                    text-gray-700 dark:text-gray-300 dark:bg-gray-700 border-indigo-300
                                                     focus:border-indigo-300 focus:ring-indigo-200 dark:border-gray-600"
                                        />
                                    </label>
                                    <label class="block justify-start text-sm mb-4">
                                        <span class="text-gray-700 dark:text-gray-400">Title</span>
                                        <input type="text" x-bind:value="file.title || ''" name="title"
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
                                            name="description"
                                            x-text="file.description || ''"
                                        ></textarea>
                                    </label>
                                    <div class="flex-grow overflow-auto">
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
                                    <div class="justify-center flex items-center">
                                        <button type="button"
                                                class="h-10 mr-1 px-4 rounded-lg text-white bg-blue-500 hover:bg-blue-600"
                                                @click="updateFile(file.id || '')"
                                        >Update
                                        </button>
                                        <button type="button"
                                                class="h-10 ml-1 px-4 rounded-lg text-white bg-yellow-500 hover:bg-yellow-600"
                                                @click="closeModal()"
                                        >Cancel
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('scripts')
    <script>
        window.fileIndex = function () {
            return {
                showModal: false,
                file: {},
                files: [],
                pagination: [],
                selected: [],
                totalItems: 0,
                totalPages: 1,
                currentPage: 1,
                perPage: 12,
                type: '',
                status: constData.status.active,
                txtSearch: '',
                init() {
                    this.syncFiles()
                },
                toggleModal() {
                    this.showModal = !this.showModal
                },
                openModal(fileData) {
                    this.file = fileData
                    this.showModal = true
                },
                closeModal() {
                    this.showModal = false
                },
                clearSelected() {
                    let checkboxes = document.querySelectorAll('input[name=fileSelected]')
                    for (let i = 0; i < checkboxes.length; i++) {
                        checkboxes[i].checked = false
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
                    let formData = new FormData(document.getElementById('formSearchFile'))
                    formData.forEach((value, key) => {
                        switch (key) {
                            case 'type':
                                this.type = value;
                                break;
                            case 'status':
                                this.status = value;
                                break;
                            case 'txtSearch':
                                this.txtSearch = value;
                                break;
                        }
                    })
                    this.currentPage = 1
                    this.syncFiles()
                },
                syncFiles() {
                    ajaxGetFiles({
                        type: this.type,
                        status: this.status,
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
                    this.file = {}
                    this.clearSelected()
                },
                uploadFiles(element) {
                    let files = element.files;
                    if (files) {
                        console.log(files)
                        Array.from(files).forEach(file => {
                            if (file) {
                                let filename = file.name || 'unknown'
                                ajaxUpload(file).then(res => {
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
                updateFile(id) {
                    if (id) {
                        let formData = new FormData(document.getElementById('formUpdateFile'))
                        const data = {}
                        formData.forEach((value, key) => (data[key] = value))
                        ajaxUpdateFile(id, data).then(res => {
                            if (res.data.success) {
                                this.syncFiles()
                                this.closeModal()
                                toastrNotification('success', 'Update Success')
                            } else {
                                toastrNotification('error', 'Update Failed. Please retry later')
                            }
                        }).catch(err => {
                            console.log(err)
                        });
                    } else {
                        toastrNotification('error', 'ID not found')
                    }
                },
                deleteFile(id) {
                    if (id) {
                        alertConfirm().then(confirm => {
                            if (confirm) {
                                ajaxDeleteFile(id).then(res => {
                                    if (res.data.success) {
                                        this.syncFiles()
                                        this.closeModal()
                                        toastrNotification('success', 'Delete Success')
                                    } else {
                                        toastrNotification('error', 'Delete Failed. Please retry later')
                                    }
                                }).catch(err => {
                                    console.log(err)
                                });
                            }
                            return false
                        })
                    } else {
                        toastrNotification('error', 'ID not found')
                    }
                },
                deleteFiles() {
                    alertConfirm().then(confirm => {
                        if (confirm) {
                            let checkboxes = document.querySelectorAll('input[name=fileSelected]:checked')
                            let ids = []
                            for (let i = 0; i < checkboxes.length; i++) {
                                ids.push(checkboxes[i].getAttribute('data-id'))
                                checkboxes[i].checked = false
                            }
                            if (ids.length > 0) {
                                ids.forEach((id) => {
                                    ajaxDeleteFile(id).then(res => {
                                        if (res.data.success) {
                                            this.syncFiles()
                                            this.closeModal()
                                            toastrNotification('success', 'Delete Success')
                                        } else {
                                            toastrNotification('error', 'Delete Failed. Please retry later')
                                        }
                                    }).catch(err => {
                                        console.log(err)
                                    });
                                })
                            } else {
                                toastrNotification('error', 'No file selected')
                            }

                        }
                        return false
                    })
                },
            }
        }
    </script>
@endpush
