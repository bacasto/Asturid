<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
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

Route::get('/','App\Http\Controllers\ProductController@index')->name('dashboard');
Route::get('/producto/{id}','App\Http\Controllers\ProductController@showProduct')->name('show.product');

Route::get('/producto/categoria/{id}','App\Http\Controllers\ProductController@showProductCategory')->name('show.product.category');
Route::post('products_search','App\Http\Controllers\ProductController@searchProducts')->name('search.products');


Route::group(['middleware'=>'auth'],function(){
    Route::get('/productos','App\Http\Controllers\AdminController@showProductsAdmin')->name('show.products.admin');
    Route::get('/usuarios','App\Http\Controllers\AdminController@showUsersAdmin')->name('show.users.admin');
    Route::post('/addproduct','App\Http\Controllers\ProductController@store')->name('add.producto');
    Route::get('/removeproduct/{id}','App\Http\Controllers\ProductController@destroy')->name('destroy.producto');
});



require __DIR__.'/auth.php';