<x-field::multiple-select
    name="categories"
    :oldValue="isset($post) ? $post->categories->pluck('id')->toArray() : []"
    :options="
    [
        'id'=>'categories',
        'selectOptions' => $categories->pluck('name', 'id')->toArray()
    ]
"/>
