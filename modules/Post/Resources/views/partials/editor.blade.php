{{--<x-field::ck-editor name="content" :oldValue="$post->content ?? null" :options="['id'=>'content']"/>--}}
<x-field::tiny-editor name="content" :oldValue="$post->content ?? null" :options="['id'=>'content']"/>

<x-modal::file-manager :forEditor="'tinymce'"
                       :multiple="true"
                       :options="['editorId' => 'content']"
/>
