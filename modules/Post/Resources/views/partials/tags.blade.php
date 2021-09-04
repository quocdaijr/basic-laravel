<x-field::tag
    name="tags"
    :oldValue="isset($post) ? $post->tags->pluck('name')->toArray() : []"
    :options="
    [
        'id'=>'tags'
    ]
"/>
