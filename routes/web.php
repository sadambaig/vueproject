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

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix'=>'admin','middleware'=>'auth'],function(){
	Route::get('/dashboard','TestController@index')->name('dashboard');
	Route::post('/add-category','CategoryController@add_cat')->name('add-catrgory');
	Route::get('/get-category','CategoryController@get_cat')->name('get-category');
	Route::get('/category-delete/{id}','CategoryController@delete_cat')->name('category-delete');
	Route::get('/category-edit/{id}',"CategoryController@show")->name('category-edit');
	Route::post('category-update','CategoryController@update')->name('category-update');
	Route::post('/add-products','ProductController@add_new')->name('add-products');
	Route::get('/get-products','ProductController@get_products')->name('get-products');
	Route::get('/delete-product/{id}','ProductController@delete_product')->name('delete-product');
	
});

