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

Route::get('auth/{provider}', [
    'as' => 'provider.redirect',
    'uses' => 'Auth\LoginController@redirectToProvider'
]);

Route::get('auth/{provider}/callback', [
    'as' => 'provider.handle',
    'uses' => 'Auth\LoginController@handleProviderCallback'
]);

Route::get('users/activation/{id}/{token}', [
    'as' => 'users.activation',
    'uses' => 'Auth\RegisterController@userActivation'
]);

Route::get('/home', 'HomeController@index');
