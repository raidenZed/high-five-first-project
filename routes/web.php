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
//            ->middleware("can:index users")
            Route::get('/index' , 'Admin\UserController@index')->name("user.index")->middleware("permission:view_users");
            Route::post('/add' , 'Admin\UserController@add')->name("user.store")->middleware("permission:add_users");
            Route::get('/edit' , 'Admin\UserController@edit')->name('fetch.user.by.id.data')->middleware("permission:edit_users");
            Route::post('/update/{id}' , 'Admin\UserController@update')->name("user.update")->middleware("permission:edit_users");
            Route::get('/delete' , 'Admin\UserController@delete')->name("delete.user.by.id.data")->middleware("permission:delete_users");
            Route::get('/Permissions' , 'Admin\UserController@getPermissions')->name("get.user.permissions")->middleware("permission:privileges_users");
            Route::post('/Permissions/change' , 'Admin\UserController@changePermissions')->name("change.user.permissions")->middleware("permission:privileges_users");

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

