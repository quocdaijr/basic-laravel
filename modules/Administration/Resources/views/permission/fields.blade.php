<x-field::text name="name" :oldValue="$permission->name ?? null" :options="['type'=>'text']"/>
<x-field::text name="title" :oldValue="$permission->title ?? null" :options="['type'=>'text']"/>
<x-field::select name="group_id"
                :oldValue="$permission->group_id ?? null"
                :options="['selectOptions' => $groupPermission->pluck('title', 'id')->toArray()]"
/>
