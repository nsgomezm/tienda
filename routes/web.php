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

use App\Models\Product;

Auth::routes(['reset' => false]);

Route::view('/', 'login');
Route::view('/login', 'login');

Route::post('/login', 'AuthController@login')->name('login');
Route::post('/registerUser', 'UserController@register')->name('register');

Route::view('/home', 'products')->name('products');


Route::group(['middleware' => 'auth'], function () {
    Route::view('/dashboard', 'dashboard');
    
    Route::get('/product/form/{id?}',function($id = -1){
        return view('product-form', compact('id'));
    });
    
    Route::post('/product/information/{id}', function($id){
        return Product::find($id);
    });
    
    Route::get('/logout', 'AuthController@logout')->name('logout');
});
// Route::get('/test', function(){
//     // $products = Product::with('categories')->get();
//     return view('products', compact('products'));
// });

Route::post('/products', function(){
    return Product::with('brand','categories')->get();
});
Route::get('/products', function(){
    return Product::with('brand','categories')->get();
});