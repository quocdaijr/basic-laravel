<x-field::text name="username" :oldValue="$user->username ?? null" :options="['type'=>'text']"/>
<x-field::text name="email" :oldValue="$user->email ?? null" :options="['type'=>'email']"/>
<x-field::text name="phone" :oldValue="$user->phone ?? null" :options="['type'=>'text']"/>
<x-field::text name="password" :oldValue="null" :options="['type'=>'password']"/>
<x-field::select name="status" :oldValue="$user->status ?? null"
                 :options="['selectOptions' => \Modules\Core\Constants\CoreConstant::statuses()]"/>

<div class="mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                  {{__('Roles')}}
                </span>
    <div class="mt-2 ml-6">
        @forelse ($roles as $role)
            <label class="inline-flex items-center text-gray-600 dark:text-gray-400 w-full lg:w-5/12">
                <input type="checkbox" name="roles[]" value="{{$role->id}}" title="{{$role->name}}"
                       {{ in_array($role->id, (array)old('roles', $userHasRoles ?? null)) ? 'checked' : '' }}
                       class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                <span
                    class="ml-2">{{$role->title}}</span>
            </label>
        @empty
            {{__('No Roles')}}
        @endforelse
    </div>
    @error('roles.*')
    <span class="text-xs text-red-600 dark:text-red-400">{{ $message }}</span>
    @enderror
</div>
<div class="mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                  {{__('Permissions')}}
                </span>
    <div class="mt-2 ml-6">
        @forelse ($permissions as $permission)
            <label class="inline-flex items-center text-gray-600 dark:text-gray-400 w-full lg:w-5/12">
                <input type="checkbox" name="permissions[]" value="{{$permission->id}}"
                       title="{{$permission->name}}"
                       {{ in_array($permission->id, (array)old('permissions', $userHasPermission ?? null)) ? 'checked' : '' }}
                       class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                <span class="ml-2">{{$permission->title}}</span>
            </label>
        @empty
            {{__('No Permission')}}
        @endforelse
    </div>
    @error('permissions.*')
    <span class="text-xs text-red-600 dark:text-red-400">{{ $message }}</span>
    @enderror
</div>
