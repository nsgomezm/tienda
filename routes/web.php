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
    // $role = Role::create(['name' => 'user']); # creación de roles

    // $user = User::find(1);
    // $user->assignRole('admin');
    // return $user;

    
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
    
    Route::post('/comment/insert/{id}/{comment}', 'CommentController@insertComment');
    
    Route::group(['prefix' => 'Admin', 'middleware' => 'role:admin'] , function(){
        Route::view('/', 'dashboard')->name('dashboard');
        
        Route::view('/brands', 'brands');
        Route::get('/Admin/brands/insert/{name}', 'BrandController@insert');
        Route::get('/Admin/brands/delete/{id}', 'BrandController@delete');
        Route::get('/Admin/brands/update/{id}/{name}', 'BrandController@update');
        
        
        Route::view('/categories', 'categories');
        Route::get('/Admin/categories/insert/{name}', 'CategoryController@insert');
        Route::get('/Admin/categories/delete/{id}', 'CategoryController@delete');
        Route::get('/Admin/categories/update/{id}/{name}', 'CategoryController@update');
            
        Route::get('/product/form/{id?}', 'ProductController@form');
        Route::get('/Admin/product/details/{id}', function($id){
            return view('product-details', compact('id'));
        });

        Route::post('/product/updateInformation/{product}', 'ProductController@updateInformation')->name('updateProduct'); 
        Route::post('/product/deleteInformation/{id}', 'ProductController@deleteInformation')->name('deleteProduct'); 
        Route::post('/product/insertInformation', 'ProductController@insertInformation')->name('insertProduct'); 
    });    
    
    // consulta
    Route::get('/logout', 'AuthController@logout')->name('logout');
    Route::post('/product/information/{id}', function($id){
        return Product::find($id);
    });
    

});