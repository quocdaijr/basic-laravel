@extends('core::layouts.common')

@section('master')
    <main class="h-full pb-16 overflow-y-auto">
        <div class="container flex flex-col items-center px-6 mx-auto">
            <svg class="w-12 h-12 mt-8 mb-2 text-purple-200" fill="currentColor" viewBox="0 0 20 20">
                <path
                    fill-rule="evenodd" clip-rule="evenodd"
                    d="M13.477 14.89A6 6 0 015.11 6.524l8.367 8.368zm1.414-1.414L6.524 5.11a6 6 0 018.367 8.367zM18 10a8 8 0 11-16 0 8 8 0 0116 0z"
                ></path>
            </svg>
            <h1 class="text-6xl font-semibold text-red-700 dark:text-red-400">
                {{$statusCode}}
            </h1>
            <h3 class="text-2xl font-semibold text-gray-700 dark:text-gray-200 my-3"> {{$msg}}</h3>
            <p class="text-gray-700 dark:text-gray-300">
                Please check the address or
                <a class="text-purple-600 hover:underline dark:text-purple-300" href="{{ url()->previous() }}">go back</a>.
            </p>
        </div>
    </main>
@endsection
