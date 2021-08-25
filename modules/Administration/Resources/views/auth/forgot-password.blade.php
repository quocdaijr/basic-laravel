@extends('administration::layouts.auth')

@section('content')
    <div class="flex items-center min-h-screen p-6 bg-gray-50 dark:bg-gray-900">
        <div class="flex-1 h-full max-w-4xl mx-auto overflow-hidden bg-white rounded-lg shadow-xl dark:bg-gray-800">
            <div class="flex flex-col overflow-y-auto md:flex-row">
                <div class="h-32 md:h-auto md:w-1/2">
                    <img
                        aria-hidden="true"
                        class="object-cover w-full h-full dark:hidden"
                        src="{{mix('images/login-office.jpeg')}}"
                        alt="Office"
                    />
                    <img
                        aria-hidden="true"
                        class="hidden object-cover w-full h-full dark:block"
                        src="{{mix('images/login-office-dark.jpeg')}}"
                        alt="Office"
                    />
                </div>
                <div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
                    <div class="w-full">
                        <h1 class="mb-4 text-xl font-semibold text-gray-700 dark:text-gray-200">
                            Forgot password
                        </h1>
                        {!! Form::open(['route' => 'post.forgot-password', 'method' => 'POST']) !!}
                        <label class="block text-sm">
                            <span class="text-gray-700 dark:text-gray-400">Email</span>
                            <input type="text" name="email" value="{{ old('email') }}"
                                   class="mt-1 block w-full rounded-md shadow-sm focus:ring focus:ring-opacity-50 dark:text-gray-300 dark:bg-gray-700 @error('email') border-red-600 focus:border-red-400 focus:ring-red-200 dark:border-red-400 @else border-indigo-300 focus:border-indigo-300 focus:ring-indigo-200 dark:border-gray-600 @enderror"/>
                            @error('email')
                            <span class="text-xs text-red-600 dark:text-red-400">{{ $message }}</span>
                            @enderror
                        </label>

                        <!-- You should use a button here, as the anchor is only used for the example  -->
                        <button type="submit"
                                class="block w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                        >
                            Recover password
                        </button>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
