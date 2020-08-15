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

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;


use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
Route::get('/test', function(){

    // $role = Role::create(['name' => 'admin']); - creación de roles

    $user = User::find(1);
    $user->assignRole('admin');
    return $user;

    
});

Auth::routes(['reset' => false]);

Route::view('/', 'login');
Route::view('/login', 'login');

Route::post('/login', 'AuthController@login')->name('login');
Route::post('/registerUser', 'UserController@register')->name('register');

Route::get('/home/{search?}', 'ProductController@getProducts')->name('products');
Route::get('/home/category/{search?}', 'ProductController@getProductsCategory');
Route::get('/home/brand/{search?}', 'ProductController@getProductsBrand');
Route::get('/product/getInformation/{id}', 'ProductController@getInformation')->name('getProduct'); 

Route::group(['middleware' => 'auth'], function () {
    Route::view('/dashboard', 'dashboard')->name('dashboard');
    // Route::view('/product/form', 'product-form')->name('productForm');
    
    Route::post('/comment/insert/{id}/{comment}', 'CommentController@insertComment');
    
    Route::get('/product/form/{id?}', 'ProductController@form');
    Route::get('/product/details/{id}', function($id){
        return view('product-details', compact('id'));
    });

    Route::view('/brands', 'brands');
    Route::get('/brands/insert/{name}', 'BrandController@insert');
    Route::get('/brands/delete/{id}', 'BrandController@delete');
    Route::get('/brands/update/{id}/{name}', 'BrandController@update');

    
    Route::view('/categories', 'categories');
    Route::get('/categories/insert/{name}', 'CategoryController@insert');
    Route::get('/categories/delete/{id}', 'CategoryController@delete');
    Route::get('/categories/update/{id}/{name}', 'CategoryController@update');

    

    
    
    // consulta
    Route::post('/product/updateInformation/{product}', 'ProductController@updateInformation')->name('updateProduct'); 
    Route::post('/product/deleteInformation/{id}', 'ProductController@deleteInformation')->name('deleteProduct'); 
    Route::post('/product/insertInformation', 'ProductController@insertInformation')->name('insertProduct'); 


    Route::get('/logout', 'AuthController@logout')->name('logout');
    Route::post('/product/information/{id}', function($id){
        return Product::find($id);
    });
});