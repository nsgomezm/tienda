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
        $product = new Product($Request->all());
        $Product->update($product->toArray());
        
        return response()->json([
            'product_information' => $Request->all()
        ]);
    }           

    public function insertInformation(Request $Request){
        // $product = new Product($Request->all());
        // $product->save();
        return $Request->all();

        return response()->json([
        ]);
    }

    public function deleteInformation(Request $Request){
        // return $Request->all();
        return response()->json([
            $Request->all()
        ]);
    }
}
