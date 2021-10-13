<label class="block text-sm mb-4">
    <span class="text-gray-700 dark:text-gray-400">{{__($options['title'] ?? ucfirst($name))}}</span>
    <select id="{{$options['id'] ?? ''}}" multiple name="{{$name . '[]'}}"
            class="block h-auto w-full mt-1 rounded-md shadow-sm text-gray-700 focus:ring focus:ring-opacity-50 dark:text-gray-300 dark:bg-gray-700 @error($name) border-red-600 focus:border-red-400 focus:ring-red-200 dark:border-red-400 @else border-indigo-300 focus:border-indigo-300 focus:ring-indigo-200 dark:border-gray-600 @enderror">
        @if(!empty($selectOptions = old($name, $oldValue)))
            @foreach($selectOptions as $value)
                <option value="{{$value}}" selected>{{$value}}</option>
            @endforeach
        @endif
    </select>
    @error($name)
    <span class="text-xs text-red-600 dark:text-red-400">{{ $message }}</span>
    @enderror
</label>

@push('stylesheets')
    <link rel="stylesheet" href="{{ mix('assets/modules/core/css/slim-select.css') }}">
@endpush
@push('scripts')
    <script src="{{mix('assets/modules/core/js/slim-select.js')}}"></script>
    <script>
        let tag = new SlimSelect({
            select: '#{{$options['id'] ?? ''}}',
            hideSelectedOption: true,
            searchingText: 'Searching...',
            searchHighlight: true,
            addable: function (value) {
                return {
                    text: value.toLowerCase()
                }
            },
            beforeOpen: function () {
                let selectedData = this.selected()
                this.data.data = this.data.data.filter(function (e) {
                    return selectedData.includes(e.text);
                });
                this.render();
                this.data.searchValue = null
            },
            ajax: function (txtSearch, callback) {
                if (txtSearch.length < 1) {
                    callback('Need 1 characters')
                    return
                }
                axios({
                    method: 'GET',
                    url: '/tag/search',
                    params: {
                        txt: txtSearch,
                        number: 10
                    }
                }).then(res => {
                    let data = [], currentData = [], selectedData = this.data.data.map(a => a.text)
                    // if (!selectedData.includes(txtSearch)) {
                    //     data.push({text: txtSearch})
                    //     currentData.push(txtSearch)
                    // }
                    for (let i = 0; i < res.data.length; i++) {
                        let value = res.data[i]
                        if (value
                            && !selectedData.includes(value)
                            && !currentData.includes(value)
                        ) {
                            data.push({text: value})
                            currentData.push(value)
                        }
                    }
                    let unique = data.filter((v, i, a) => a.indexOf(v) === i);

                    this.config.isSearching = false;
                    if (Array.isArray(unique)) {
                        unique.unshift({text: '', placeholder: true});
                        this.setData(unique);
                        this.render();
                    } else {
                        this.render();
                    }
                    // callback(unique)
                }).catch(err => {
                    callback(false)
                });
            }
        })
    </script>
@endpush
