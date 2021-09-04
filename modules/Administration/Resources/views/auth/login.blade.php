@extends('administration::layouts.auth')

@section('content')
    <div class="flex items-center min-h-screen p-6 bg-gray-50 dark:bg-gray-900">
        <div class="flex-1 h-full max-w-4xl mx-auto overflow-hidden bg-white rounded-lg shadow-xl dark:bg-gray-800">
            <div class="flex flex-col overflow-y-auto md:flex-row">
                <div class="h-32 md:h-auto md:w-1/2">
                    <img
                        aria-hidden="true"
                        class="object-cover w-full h-full dark:hidden"
                        src="{{mix('modules/administration/images/login-office.jpeg')}}"
                        alt="Office"
                    />
                    <img
                        aria-hidden="true"
                        class="hidden object-cover w-full h-full dark:block"
                        src="{{mix('modules/administration/images/login-office-dark.jpeg')}}"
                        alt="Office"
                    />
                </div>
                <div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
                    <div class="w-full">
                        <h1 class="mb-4 text-xl font-semibold text-gray-700 dark:text-gray-200">
                            Login
                        </h1>
                        {!! Form::open(['route' => 'post.login', 'method' => 'POST']) !!}
                        <x-field::text name="username" :oldValue="null" :options="['type'=>'text']"/>
                        <x-field::text name="password" :oldValue="null" :options="['type'=>'password']"/>
                        <div class="flex mt-6 text-sm">
                            <label class="flex items-center dark:text-gray-400">
                                <input type="checkbox"
                                       class="text-purple-600 rounded-md border-indigo-300 focus:ring focus:ring-opacity-50 focus:border-indigo-300 focus:ring-indigo-200 dark:border-gray-600 dark:text-gray-300 dark:bg-gray-700">
                                <span class="ml-2">Remember me?</span>
                            </label>
                        </div>
                        <div class="my-4 text-sm text-center">
                            <button type="submit"
                                    class="block w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                            >
                                Log in
                            </button>
                        </div>
                        {!! Form::close() !!}
                        <p class="mt-4">
                            <a
                                class="text-sm font-medium text-purple-600 dark:text-purple-400 hover:underline"
                                href="{{route('get.forgot-password')}}"
                            >
                                Forgot your password?
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
