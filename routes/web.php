<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded b   y the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/','HomeController@Index');
Route::get('/products/{slug}','ProductController@Product');
Route::get('/categories/{slug}','CategoryController@Category');
Route::get('/shop/{slug}','SellerController@Seller');
Route::get('/user/me','UserController@Profile');
Route::get('/search','FilterController@Search')->name('filter');
Route::get('/cart','CartController@Cart');