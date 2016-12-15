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

Route::get('/', ['uses' => 'HomeController@index']);

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


Route::group(['middleware' => 'auth'], function() {
    Route::resource('users', 'UserController', ['only' => [
        'edit', 'update'
    ]]);
});


Route::group(['prefix' => 'user', 'namespace' => 'User', 'middleware' => 'auth'], function() {
    Route::resource('shop', 'ShopController');
});

Route::get('/home', 'HomeController@index');

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'as' => 'admin.', 'middleware' => ['auth', 'admin']], function() {

    Route::resource('category', 'CategoryController');

    Route::resource('users', 'UserController');
});
