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

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    // Home
    Route::get(
        '/home',
        'HomeController@index'
    )->name('home');

    // Account settings
    Route::get(
        '/user/edit',
        'UserController@edit'
    )->name('user.edit');

    Route::put(
        '/user',
        'UserController@update'
    )->name('user.update');

    Route::delete(
        '/user',
        'UserController@destroy'
    )->name('user.destroy');

    // Instagram accounts
    Route::resource(
        'instagram_account',
        'InstagramAccountController'
    )->only(['create', 'store', 'edit', 'update', 'destroy']);

    Route::post(
        '/instagram_account/{instagram_account}/update_media',
        'InstagramAccountController@updateMedia'
    )->name('instagram_account.update_media');

    // Media
    Route::resource(
        'medium',
        'MediumController'
    )->only(['update']);
});
