@extends('post::layouts.master')

@section('title', $post->name)
@section('content')
    <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
        <div>
            <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
                <p class="text-gray-600">
                    Name
                </p>
                <p>
                    {{$post->name}}
                </p>
            </div>
            <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
                <p class="text-gray-600">
                    Url
                </p>
                <p>
                    <a href="{{env('APP_FE_URL') . DIRECTORY_SEPARATOR . $post->slug}}">{{env('APP_FE_URL') . DIRECTORY_SEPARATOR . $post->slug}}</a>
                </p>
            </div>
            <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
                <p class="text-gray-600">
                    Slug
                </p>
                <p>
                    {{$post->slug}}
                </p>
            </div>
            <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
                <p class="text-gray-600">
                    Published At
                </p>
                <p>
                    {{$post->published_at}}
                </p>
            </div>
            <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
                <p class="text-gray-600">
                    Description
                </p>
                <p>
                    {{$post->description}}
                </p>
            </div>
            <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
                <p class="text-gray-600">
                    Categories
                </p>
                <div class="w-full">
                    @foreach($post->categories ?? [] as $category)
                        <span>{{$category->name}}</span>,
                    @endforeach

                </div>
            </div>
        </div>
        <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
            <p class="text-gray-600">
                Categories
            </p>
            <div class="w-full">
                @foreach($post->tags ?? [] as $tag)
                    <span>{{$tag->name}}</span>,
                @endforeach

            </div>
        </div>
        <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
            <p class="text-gray-600">
                Content
            </p>
            <div class="w-full">
                {!! $post->content ?? '' !!}
            </div>
        </div>
    </div>
    </div>
@stop
