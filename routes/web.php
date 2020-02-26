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
/*Route::patch('/update_ing/{id}', 'IngredientController@updateIng')->name('update_ing');

Route::get('/edit_ing/{id}', 'IngredientController@editIngredients')->name('edit_ing');
*/
Route::get('/download_merch_code/{id}', 'MerchandiseController@getMerchDownload')->name('download_merch_code');

Route::get('/delete_merch/{id}', 'MerchandiseController@deleteMerch')->name('delete_merch');

Route::patch('/update_merch/{id}', 'MerchandiseController@updateMerch')->name('update_merch');

Route::get('/edit_merch/{id}', 'MerchandiseController@editMerch')->name('edit_merch');

Route::post('/merchandise', 'MerchandiseController@merchandise')->name('merchandise');

Route::get('/insert_merch', 'MerchandiseController@insertMerchandise')->name('insert_merch');

Route::patch('/update_product/{id}', 'ProductController@updateProduct')->name('update_product');

Route::post('/product', 'ProductController@product')->name('product');

Route::get('/logout', 'UserController@getLogout')->name('logout')->middleware('auth');

Route::get('/pdf', 'PdfController@index')->name('pdf');

Route::get('/company/{city}/{dir}/{slug}', 'IndexController@getProductByUser')->name('company');

Route::get('/download_code/{id}', 'ProductController@getDownload')->name('download_code');

Route::get('/delete_product/{id}', 'ProductController@deleteProduct')->name('delete_product');

Route::get('/product/{id}', 'ProductController@editProduct')->name('product_by_id');

Route::get('/insert_product', 'ProductController@insertProduct')->name('insert_product');

Route::get('/dashboard', 'DashboardController@dashboard')->name('dashboard');



Route::post('/signup', 'UserController@postSignup')->name('signup');

Route::post('/signin', 'UserController@postSignin')->name('signin');

Route::get('/signup', 'IndexController@signup')->name('signup');

Route::get('/signin', 'IndexController@signin')->name('signin');

Route::get('/', function () {
    return view('welcome');
});
