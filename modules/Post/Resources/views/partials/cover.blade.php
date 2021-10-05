<x-field::upload name="cover" :oldValue="$post->cover['id'] ?? null"
                 :options="['id'=>'cover', 'url' => $post->cover['url'] ?? '']"/>
