<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => 'guest'], function () {
    Route::get('login', 'Auth\LoginController@getLogin')->name('get.login');
    Route::post('login', 'Auth\LoginController@postLogin')->name('post.login');
    Route::get('forgot-password', 'Auth\ForgotPasswordController@getForgotPassword')->name('get.forgot-password');
    Route::post('forgot-password', 'Auth\ForgotPasswordController@postForgotPassword')->name('post.forgot-password');
    Route::get('reset-password/{token}', 'Auth\ResetPasswordController@getResetPassword')->name('get.reset-password');
    Route::post('reset-password', 'Auth\ResetPasswordController@postResetPassword')->name('post.reset-password');
});

Route::post('logout', 'Auth\LoginController@logout')->name('logout');


Route::group(['prefix' => 'administration', 'as' => 'administration.', 'middleware' => 'auth'], function () {
    Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
        Route::resource('', 'UserController')->parameters(['' => 'id']);
    });
    Route::group(['prefix' => 'role', 'as' => 'role.'], function () {
        Route::resource('', 'RoleController')->parameters(['' => 'id']);
    });
    Route::group(['prefix' => 'permission', 'as' => 'permission.'], function () {
        Route::resource('', 'PermissionController')->parameters(['' => 'id']);
        Route::post('sync', 'PermissionController@syncPermissionFromConfigFiles')->name('sync');
    });
});
