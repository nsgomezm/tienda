<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CategoryProduct;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function insert($name){
        $category = new Category();
        $category->name = $name;
        $category->save();
        
        return response()->json([
            true
        ]);
    }

    public function delete($id){
        $category = Category::find($id);
        $category->delete();
        return response()->json([
            true
        ]);
    }

    public function update($id, $name){
        $category = Category::find($id);
        $category->name = $name;
        $category->save();
        
        return response()->json([
            true
        ]);
    }
}
