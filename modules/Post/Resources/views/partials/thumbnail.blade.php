<x-field::upload name="thumbnail" :oldValue="$post->thumbnail['id'] ?? null"
                 :options="['id'=>'thumbnail', 'url' => $post->thumbnail['url'] ?? '']"/>
