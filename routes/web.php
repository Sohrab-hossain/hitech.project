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
    Route::group(['prefix' => 'sub_category'],function (){
        Route::get('/', 'Backend\Sub_categoryCntrller@index')->name('admin.sub_category.index');
        Route::get('/create', 'Backend\Sub_categoryCntrller@create')->name('admin.sub_category.create');
        Route::post('/store', 'Backend\Sub_categoryCntrller@store')->name('admin.sub_category.store');

        Route::get('/edit/{id}', 'Backend\Sub_categoryCntrller@edit')->name('admin.sub_category.edit');
        Route::post('/edit/{id}', 'Backend\Sub_categoryCntrller@update')->name('admin.sub_category.update');
        Route::delete('/delete/{id}','Backend\Sub_categoryCntrller@destroy')->name('admin.sub_category.delete');
    });

    Route::group(['prefix' => 'brand'],function (){
        Route::get('/', 'Backend\BrandController@index')->name('admin.brand.index');
        Route::get('/create', 'Backend\BrandController@create')->name('admin.brand.create');
        Route::post('/store', 'Backend\BrandController@store')->name('admin.brand.store');

        Route::get('/edit/{id}', 'Backend\BrandController@edit')->name('admin.brand.edit');
        Route::post('/edit/{id}', 'Backend\BrandController@update')->name('admin.brand.update');
        Route::delete('/delete/{id}','Backend\BrandController@destroy')->name('admin.brand.delete');
    });
    Route::group(['prefix' => 'product'],function (){
        Route::get('/', 'Backend\ProductController@index')->name('admin.product.index');
        Route::get('/create', 'Backend\ProductController@create')->name('admin.product.create');
        Route::post('/store', 'Backend\ProductController@store')->name('admin.product.store');

        Route::get('/show/{id}', 'Backend\ProductController@edit')->name('admin.product.show');
        Route::get('/edit/{id}', 'Backend\ProductController@edit')->name('admin.product.edit');
        Route::post('/edit/{id}', 'Backend\ProductController@update')->name('admin.product.update');
        Route::delete('/delete/{id}','Backend\ProductController@destroy')->name('admin.product.delete');
    });




});
