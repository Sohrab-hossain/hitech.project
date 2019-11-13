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

    Route::group(['prefix' => 'category'],function (){
        Route::get('/', 'Backend\CategoryController@index')->name('admin.category.index');
        Route::get('/create', 'Backend\CategoryController@create')->name('admin.category.create');
        Route::post('/store', 'Backend\CategoryController@store')->name('admin.category.store');

        Route::get('/edit/{id}', 'Backend\CategoryController@edit')->name('admin.category.edit');
        Route::post('/edit/{id}', 'Backend\CategoryController@update')->name('admin.category.update');
        Route::delete('/delete/{id}','Backend\CategoryController@destroy')->name('admin.category.delete');
    });

    Route::group(['prefix' => 'brand'],function (){
        Route::get('/', 'Backend\BrandController@index')->name('admin.brand.index');
        Route::get('/create', 'Backend\BrandController@create')->name('admin.brand.create');
        Route::post('/store', 'Backend\BrandController@store')->name('admin.brand.store');

        Route::get('/edit/{id}', 'Backend\BrandController@edit')->name('admin.brand.edit');
        Route::post('/edit/{id}', 'Backend\BrandController@update')->name('admin.brand.update');
        Route::delete('/delete/{id}','Backend\BrandController@destroy')->name('admin.brand.delete');
    });




});
