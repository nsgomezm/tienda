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
    Route::view('/dashboard', 'dashboard')->name('dashboard');
    // Route::view('/product/form', 'product-form')->name('productForm');
    
    Route::get('/product/form/{id?}', 'ProductController@form');
    Route::get('/product/details/{id}', function($id){
        return view('product-details', compact('id'));
    });
    
    
    // consulta
    Route::post('/product/updateInformation/{product}', 'ProductController@updateInformation')->name('updateProduct'); 
    Route::post('/product/insertInformation', 'ProductController@insertInformation')->name('insertProduct'); 
    Route::post('/product/deleteInformation/{id}', 'ProductController@deleteInformation')->name('deleteProduct'); 
    
    Route::get('/product/getInformation/{id}', 'ProductController@getInformation')->name('getProduct'); 
    
    Route::get('/logout', 'AuthController@logout')->name('logout');
    Route::post('/product/information/{id}', function($id){
        return Product::find($id);
    });
});