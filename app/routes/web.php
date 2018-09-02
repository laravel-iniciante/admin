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


Route::get('/home', 'HomeController@index');

Auth::routes();

Route::group([ 'prefix' => 'dashboard', 'namespace' => 'Dashboard'], function(){
    Route::get('/', 'DashboardController@index')->name('dashboard');
    Route::resource('user', 'UserController');
    Route::resource('product', 'ProductController');
    Route::resource('permission', 'PermissionController');
    Route::resource('category', 'CategoryController');
    Route::resource('role', 'RoleController');
});
