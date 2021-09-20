<x-field::datetimepicker
    name="published_at"
    :oldValue="$post->published_at ?? date('Y-m-d H:i')"
    :options="['id'=>'published_time']"
/>
