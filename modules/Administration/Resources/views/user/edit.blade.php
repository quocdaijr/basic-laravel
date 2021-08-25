@extends('administration::layouts.master')

@section('title', 'Update User')
@section('breadcrumbs')
    @if (Breadcrumbs::exists(Route::currentRouteName()))
        {!! Breadcrumbs::render(Route::currentRouteName(), $user ?? null ) !!}
    @endif
@endsection

@section('content')
    {!! Form::open(['route' => ['administration.user.edit', $user->id], 'method' => 'put']) !!}
    <div class="w-full container mx-auto grid">
        <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
            <label class="block text-sm mb-4">
                <span class="text-gray-700 dark:text-gray-400">
                {{__('Username')}}
                </span>
                <input type="text" name="username" id="username" value="{{ old('username', $user->username) }}"
                       class="mt-1 block w-full rounded-md shadow-sm focus:ring focus:ring-opacity-50 dark:text-gray-300 dark:bg-gray-700 @error('username') border-red-600 focus:border-red-400 focus:ring-red-200 dark:border-red-400 @else border-indigo-300 focus:border-indigo-300 focus:ring-indigo-200 dark:border-gray-600 @enderror"/>
                @error('username')
                <span class="text-xs text-red-600 dark:text-red-400">{{ $message }}</span>
                @enderror
            </label>
            <label class="block text-sm mb-4">
                <span class="text-gray-700 dark:text-gray-400">
                {{__('Email')}}
                </span>
                <input type="email" name="email" value="{{ old('email', $user->email) }}"
                       class="mt-1 block w-full rounded-md shadow-sm focus:ring focus:ring-opacity-50 dark:text-gray-300 dark:bg-gray-700 @error('email') border-red-600 focus:border-red-400 focus:ring-red-200 dark:border-red-400 @else border-indigo-300 focus:border-indigo-300 focus:ring-indigo-200 dark:border-gray-600 @enderror"/>
                @error('email')
                <span class="text-xs text-red-600 dark:text-red-400">{{ $message }}</span>
                @enderror
            </label>
            <label class="block text-sm mb-4">
                <span class="text-gray-700 dark:text-gray-400">
                {{__('Phone')}}
                </span>
                <input type="text" name="phone" value="{{ old('phone', $user->phone) }}"
                       class="mt-1 block w-full rounded-md shadow-sm focus:ring focus:ring-opacity-50 dark:text-gray-300 dark:bg-gray-700 @error('phone') border-red-600 focus:border-red-400 focus:ring-red-200 dark:border-red-400 @else border-indigo-300 focus:border-indigo-300 focus:ring-indigo-200 dark:border-gray-600 @enderror"/>
                @error('phone')
                <span class="text-xs text-red-600 dark:text-red-400">{{ $message }}</span>
                @enderror
            </label>
            <label class="block text-sm mb-4">
                <span class="text-gray-700 dark:text-gray-400">
                {{__('Password')}}
                </span>
                <input type="password" name="password" value="{{ old('password') }}"
                       class="mt-1 block w-full rounded-md shadow-sm focus:ring focus:ring-opacity-50 dark:text-gray-300 dark:bg-gray-700 @error('password') border-red-600 focus:border-red-400 focus:ring-red-200 dark:border-red-400 @else border-indigo-300 focus:border-indigo-300 focus:ring-indigo-200 dark:border-gray-600 @enderror"/>
                @error('password')
                <span class="text-xs text-red-600 dark:text-red-400">{{ $message }}</span>
                @enderror
            </label>
            <label class="block mb-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                  {{__('Status')}}
                </span>
                <select name="status"
                        class="block w-full mt-1 rounded-md shadow-sm focus:ring focus:ring-opacity-50 dark:text-gray-300 dark:bg-gray-700 @error('status') border-red-600 focus:border-red-400 focus:ring-red-200 dark:border-red-400 @else border-indigo-300 focus:border-indigo-300 focus:ring-indigo-200 dark:border-gray-600 @enderror">
                    {!! \Modules\Core\Constants\CoreConstant::htmlOptionStatuses(old('status', $user->status)) !!}
                </select>
                @error('status')
                <span class="text-xs text-red-600 dark:text-red-400">{{ $message }}</span>
                @enderror
            </label>
            <div class="mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                  {{__('Roles')}}
                </span>
                <div class="mt-2 ml-6">
                    @forelse ($roles as $role)
                        <label class="inline-flex items-center text-gray-600 dark:text-gray-400 w-full lg:w-5/12">
                            <input type="checkbox" name="roles[]" value="{{$role->id}}" title="{{$role->name}}"
                                   {{ in_array($role->id, (array)old('roles', $userHasRoles)) ? 'checked' : '' }}
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
                                   {{ in_array($permission->id, (array)old('permissions', $userHasPermission)) ? 'checked' : '' }}
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
            <div class="mt-4 text-sm">
                <button type="submit"
                        class="w-28 px-5 py-3 font-medium font-bold leading-5 text-white transition-colors duration-150 bg-green-500 border border-transparent rounded-lg hover:bg-green-700">
                    Update
                </button>
            </div>

        </div>
    </div>
    {!! Form::close() !!}
@stop
