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
    return view('layout.default');
});

Route::group(['prefix' => 'laravel-crud'], function () {
    Route::get('/', 'CrudController@index')->name('crud');
    Route::get('/search', 'CrudController@index')->name('crud');
    Route::get( '/create', 'CrudController@create')->name('create');
    Route::post('create', 'CrudController@store')->name('store');
    Route::get('edit/{id}', 'CrudController@edit')->name('edit');
    Route::post('update/{id}', 'CrudController@update')->name('update');
    Route::delete('delete/{id}', 'CrudController@destroy');
});
