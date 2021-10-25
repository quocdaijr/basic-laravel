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
    Route::get('/categories', 'CategoryController@categories')->name('api.categories');
    Route::get('/category/{slug}', 'CategoryController@categoryBySlug')->where('id', '[a-z0-9\-]+')->name('api.category_by_slug');
});
