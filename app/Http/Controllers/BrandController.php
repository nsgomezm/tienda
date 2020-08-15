<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function insert($name){
        $brand = new Brand();
        $brand->name = $name;
        $brand->save();
        
        return response()->json([
            $name
        ]);
    }

    public function delete($id){
        $brand = Brand::find($id);
        $brand->delete();
        return response()->json([
            true
        ]);
    }

    public function update($id, $name){
        $brand = Brand::find($id);
        $brand->name = $name;
        $brand->save();
        
        return response()->json([
            true
        ]);
    }
}
