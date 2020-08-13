<?php

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/products/information/', function(){
    return Product::with('brand','categories')->get();
});

Route::post('/products/details', function(){
    return Product::with('comments','brand','categories')->get();
});

Route::post('/categories', function(){
    return Category::get();
});

Route::post('/brands', function(){
    return Brand::get();
});