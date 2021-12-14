@extends('post::layouts.master')

@section('title', 'Post')


@section('content')
    <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
        <div class="w-full overflow-hidden rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">
                <a href="{{route('post.create')}}"
                   class="flex items-center justify-between w-28 mb-4 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple dark:text-gray-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 float-left" viewBox="0 0 20 20"
                         fill="currentColor">
                        <path fill-rule="evenodd"
                              d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z"
                              clip-rule="evenodd"/>
                    </svg>
                    <span class="float-right font-bold">Create</span>
                </a>
                @if(isset($posts))
                    <table class="w-full whitespace-no-wrap">
                        <thead>
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
                        >
                            <th class="px-4 py-3">#</th>
                            <th class="px-4 py-3">ID</th>
                            <th class="px-4 py-3">Name</th>
                            <th class="px-4 py-3">Slug</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3">Date</th>
                            <th class="px-4 py-3" style="min-width: 150px">Action</th>
                        </tr>
                        </thead>
                        <tbody
                            class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800"
                        >
                        @php
                            $n = 1 + ((request()->get('page', 1) - 1) * \Modules\Core\Constants\CoreConstant::PER_PAGE_DEFAULT);
                        @endphp
                        @foreach($posts as $post)
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td class="px-4 py-3">
                                    <div class="flex items-center text-sm">
                                        {{$n++}}
                                    </div>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center text-sm">
                                        {{$post->id}}
                                    </div>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex text-sm">
                                        <span>{{$post->name}}</span>
                                        <a href="{{env('APP_FE_URL') . DIRECTORY_SEPARATOR . $post->slug}}"
                                            target="_blank" class="ml-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                 viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                            </svg>
                                        </a>
                                    </div>
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    <div class="flex items-center text-sm">
                                        {{$post->slug}}
                                    </div>
                                </td>
                                <td class="px-4 py-3 text-xs">
                                    {!! Modules\Post\Constants\PostConstant::getHtmlStatus($post->status) !!}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    <div class="flex items-center text-sm">
                                        {{$post->published_at}}
                                    </div>
                                </td>
                                <td class="flex flex-wrap">
                                    <a href="{{route('post.show', $post->id)}}"
                                       class="flex items-center justify-between my-2 mx-1 px-2 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-full active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple dark:text-gray-300"
                                       aria-label="View">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                             fill="currentColor">
                                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                            <path fill-rule="evenodd"
                                                  d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                                  clip-rule="evenodd"/>
                                        </svg>
                                    </a>
                                    <a href="{{route('post.edit', $post->id)}}"
                                       class="flex items-center justify-between my-2 mx-1 px-2 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-full active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple dark:text-gray-300"
                                       aria-label="Edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                             fill="currentColor">
                                            <path
                                                d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>
                                        </svg>
                                    </a>
                                    {!! Form::open(['method' => 'DELETE', 'route' => ['post.destroy', $post->id], 'id' => 'form_delete_' . $post->id]) !!}
                                    <button
                                        class="flex items-center justify-between my-2 mx-1 px-2 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-full active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple dark:text-gray-300"
                                        onclick="alertFormSubmitConfirm('form_delete_{{$post->id}}', 'Are you sure to delete this!')"
                                        type="button"
                                        aria-label="Delete">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                             fill="currentColor">
                                            <path fill-rule="evenodd"
                                                  d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                  clip-rule="evenodd"/>
                                        </svg>
                                    </button>
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $posts->links() }}
                @endif
            </div>
        </div>
    </div>
@endsection
