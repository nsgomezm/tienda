<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function form($id = null){
        $productInformation = Product::with('brand', 'categories')->find($id);
        if($productInformation == null){
            $productInformation = new Product();
        }
        return view('product-form', compact('productInformation'));
    }

    public function updateInformation(Request $Request, Product $Product){
        
        if($Request->hasFile('photo')){
            $imageName = "/img/{$Request->photo->getClientOriginalName()}";
            $Request->photo->move(public_path('img'), $imageName);
            $productInformation = request()->all();
            $productInformation['photo'] = $imageName;

            $Product->update($productInformation);

        }else{
            $Product->update($Request->all());
        }
        
        
        return response()->json([
            $Request->all()
        ]);
    }           

    public function insertInformation(Request $Request){
        $imageName = "/img/{$Request->photo->getClientOriginalName()}";
        $Request->photo->move(public_path('img'), $imageName);
        $productInformation = request()->all();
        $productInformation['photo'] = $imageName;
        
        $product = new Product($productInformation);
        $product->save();
        return response()->json([
            true
        ]);
    }

    public function deleteInformation($id){
        $product = Product::find($id)->delete();
        return response()->json([
            true
        ]);
    }

    public function getInformation($id){
        $productInformation = Product::with('comments.user','brand','categories')->find($id);
        return view('product-details', compact('productInformation'));
    }

    public function getProducts($search = null){
        if($search == null){
            $products = Product::with('brand', 'categories')->get();
        }else{
            $products = Product::with('brand', 'categories')->where('name', 'LIKE', "%$search%")->get();
        }
        
        return view('products', compact('products'));
    }
    public function getProductsBrand($search = null){
        if($search == null){
            $products = Product::with('brand', 'categories')->get();
        }else{
            $products = Product::with('brand', 'categories')->where('brand_id', '=', "$search")->get();
        }

        return view('products', compact('products'));
    }

    public function getProductsCategory($search = null){
        if($search == null){
            $products = Product::with('brand', 'categories')->get();
        }else{
            $products = Product::with('brand', 'categories')->where('category_id', '=', "$search")->get();
        }

        return view('products', compact('products'));
    }
}
