<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/dashboard', 'HomeController@index')->name('home');
Route::post('/dashboard/create', 'HomeController@create')->name('create');
Route::post('/dashboard/delete', 'HomeController@delete')->name('delete');
Route::get('/dashboard/{id}/list_items', 'ItemsController@index')->name('list_items');
Route::post('/items/create', 'ItemsController@create');
Route::post('/item/delete', 'ItemsController@delete');
Route::get('/dashboard/{dashboard_id}/item/{item_id}/edit', 'ItemsController@show');
Route::post('/item/edit', 'ItemsController@edit');
