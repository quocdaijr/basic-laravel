@extends('post::layouts.master')
@section('title', 'Create Post')

@section('content')
    {!! Form::open(['route' => ['post.create'], 'method' => 'post', 'onkeypress' => 'return event.keyCode != 13;']) !!}
    <div class="w-full container mx-auto grid">
        <div class="grid gap-6 mb-8 grid-cols-4">
            <div class="min-w-0 col-span-3 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                @include('post::partials.header')
                @include('post::partials.editor')
            </div>
            <div class="min-w-0 p-4 text-white bg-white rounded-lg shadow-xs dark:bg-gray-800">
                @include('post::partials.categories')
                @include('post::partials.tags')
                @include('post::partials.thumbnail')
                @include('post::partials.published-time')
                @include('post::partials.action')
            </div>
        </div>
    </div>
    {!! Form::close() !!}
@endsection
