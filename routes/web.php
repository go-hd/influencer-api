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
});

Auth::routes();

Route::get(
    '/home',
    'HomeController@index'
)->name('home');

Route::resource(
    'instagram_account',
    'InstagramAccountController'
)->only(['create', 'store', 'edit', 'update', 'destroy']);

Route::post(
    '/instagram_account/{instagram_account}/update_media',
    'InstagramAccountController@updateMedia'
)->name('instagram_account.update_media');

Route::resource(
    'medium',
    'MediumController'
)->only(['update']);

// Route::get('media/{user}/{label}', 'MediumController@index');
