<?php

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
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

Route::get('/products/details', function(){
    // Datatables::of(User::all())->make(true)
    return DataTables::of( Product::with('comments','brand','categories') )->addColumn('action', function(){
        return '<a href="#" class="btn btn-secondary"><i class="fas fa-info"></i> </a>
        <a href="#" class="btn btn-primary"><i class="fas fa-share"></i> </a>
        <a href="#" class="btn btn-danger" v-on:click="confirmDelete(product)"><i class="fas fa-trash"></i> </a>';
    })->make(true);
    // return Product::with('comments','brand','categories')->get();
});

Route::post('/categories', function(){
    return Category::has('products')->get();
    // return Category::all();
});

Route::post('/brands', function(){
    return Brand::has('products')->get();
    // return Brand::all();
});

Route::post('/categoriesController', function(){
    return Category::with('products')->get();
    // return view('categories', compact('categories'));
});

Route::post('/brandsController', function(){
    return Brand::with('products')->get();
});