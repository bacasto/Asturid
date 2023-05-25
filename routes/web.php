<?php

use App\Models\Product;
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

Route::group(['middleware' => 'auth'],function () {
    Route::get('/', 'App\Http\Controllers\ProductController@index')->name('dashboard');
    Route::get('/producto/{id}', 'App\Http\Controllers\ProductController@showProduct')->name('show.product');
});

public function showProduct($id){
    $producto = Product::find($id);
    dd($producto);
}
require __DIR__.'/auth.php';

?>