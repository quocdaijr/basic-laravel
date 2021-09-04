@extends('tag::layouts.master')

@section('title', $tag->name)
@section('content')
<div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
    <div>
        <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
            <p class="text-gray-600">
                Name
            </p>
            <p>
                {{$tag->name}}
            </p>
        </div>
        <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
            <p class="text-gray-600">
                Slug
            </p>
            <p>
                {{$tag->slug}}
            </p>
        </div>
        <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
            <p class="text-gray-600">
                Description
            </p>
            <p>
                {{$tag->description}}
            </p>
        </div>
{{--        <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4">--}}
{{--            <p class="text-gray-600">--}}
{{--                Attachments--}}
{{--            </p>--}}
{{--            <div class="space-y-2">--}}
{{--                <div class="border-2 flex items-center p-2 rounded justify-between space-x-2">--}}
{{--                    <div class="space-x-2 truncate">--}}
{{--                        <svg xmlns="http://www.w3.org/2000/svg" class="fill-current inline text-gray-500" width="24" height="24" viewBox="0 0 24 24"><path d="M17 5v12c0 2.757-2.243 5-5 5s-5-2.243-5-5v-12c0-1.654 1.346-3 3-3s3 1.346 3 3v9c0 .551-.449 1-1 1s-1-.449-1-1v-8h-2v8c0 1.657 1.343 3 3 3s3-1.343 3-3v-9c0-2.761-2.239-5-5-5s-5 2.239-5 5v12c0 3.866 3.134 7 7 7s7-3.134 7-7v-12h-2z"/></svg>--}}
{{--                        <span>--}}
{{--                                resume_for_manager.pdf--}}
{{--                            </span>--}}
{{--                    </div>--}}
{{--                    <a href="#" class="text-purple-700 hover:underline">--}}
{{--                        Download--}}
{{--                    </a>--}}
{{--                </div>--}}

{{--                <div class="border-2 flex items-center p-2 rounded justify-between space-x-2">--}}
{{--                    <div class="space-x-2 truncate">--}}
{{--                        <svg xmlns="http://www.w3.org/2000/svg" class="fill-current inline text-gray-500" width="24" height="24" viewBox="0 0 24 24"><path d="M17 5v12c0 2.757-2.243 5-5 5s-5-2.243-5-5v-12c0-1.654 1.346-3 3-3s3 1.346 3 3v9c0 .551-.449 1-1 1s-1-.449-1-1v-8h-2v8c0 1.657 1.343 3 3 3s3-1.343 3-3v-9c0-2.761-2.239-5-5-5s-5 2.239-5 5v12c0 3.866 3.134 7 7 7s7-3.134 7-7v-12h-2z"/></svg>--}}
{{--                        <span>--}}
{{--                                resume_for_manager.pdf--}}
{{--                            </span>--}}
{{--                    </div>--}}
{{--                    <a href="#" class="text-purple-700 hover:underline">--}}
{{--                        Download--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
    </div>
</div>
@stop
