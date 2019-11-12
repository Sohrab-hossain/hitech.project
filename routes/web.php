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

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin'], function (){
    Route::get('/', 'Backend\AdminController@index')->name('admin.index');

    Route::get('/category', 'Backend\CategoryController@index')->name('admin.category.index');
    Route::get('/category/create', 'Backend\CategoryController@create')->name('admin.category.create');
    Route::post('/category/store', 'Backend\CategoryController@store')->name('admin.category.store');

    Route::get('/category/edit/{id}', 'Backend\CategoryController@edit')->name('admin.category.edit');
    Route::post('/category/edit/{id}', 'Backend\CategoryController@update')->name('admin.category.update');
    Route::post('/category/delete/{id}','InstallmentController@deleteInstallment')->name('admin.category.delete');


});
