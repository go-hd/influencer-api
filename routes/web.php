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

Route::get(
    '/home',
    'HomeController@index'
)->name('home');

Route::get(
    '/user/edit',
    'UserController@edit'
)->name('user.edit')->middleware('auth');

Route::put(
    '/user',
    'UserController@update'
)->name('user.update')->middleware('auth');

Route::delete(
    '/user',
    'UserController@destroy'
)->name('user.destroy')->middleware('auth');

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
