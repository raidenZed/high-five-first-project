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


Route::prefix('Dashboard')->group(function () {


    Route::group(['middleware' => ['authed']] , function () {
        Route::get('/', function () {
            return view('Admin.welcome');
        });
        Route::prefix('Users')->group(function () {
            Route::get('/show' , 'Admin\UserController@index')->name("user.index");
            Route::post('/store' , 'Admin\UserController@store')->name("user.store");
            Route::get('/fetchById' , 'Admin\UserController@fetchById')->name('fetch.user.by.id.data');
            Route::post('/update/{id}' , 'Admin\UserController@update')->name("user.update");
            Route::get('/delete' , 'Admin\UserController@delete')->name("delete.user.by.id.data");

        });
        Route::get('/logout' , 'Auth\LoginController@logout')->name('logout');


    });








});

//Auth::routes();

Route::get('/addRole', 'Admin\UserController@addRole');
Route::get('/addPermission', 'Admin\UserController@addPermission');
Route::get('/givePermissionTo', 'Admin\UserController@givePermissionTo');
Route::get('/assignRole', 'Admin\UserController@assignRole');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/login', 'Auth\LoginController@showLoginForm');
Route::post('/attempt/login', 'Auth\LoginController@login')->name('auth.login');
Route::post('/register', 'Auth\LoginController@register')->name('auth.register');

