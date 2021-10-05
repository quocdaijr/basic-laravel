<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::prefix('v1')->group(function () {
    Route::get('/posts', 'PostController@posts')->name('api.posts');
//    Route::get('/post/{id}', 'PostController@post')->where('id', '[0-9]+')->name('api.post');
    Route::get('/post/{slug}', 'PostController@postBySlug')->where('id', '[a-z0-9\-]+')->name('api.post_by_slug');
});
