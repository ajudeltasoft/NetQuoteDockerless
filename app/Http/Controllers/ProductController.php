<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
class ProductController extends Controller
{
    //
    public function getProduct(Request $request)
    {
        //
        $keyWord =request("keyWord");
        // $product = Product::find($id);
        // return response()->json($product);

        $result = Product::where('name','LIKE','%'.$keyWord.'%')                
                ->get();
         return response()->json($result);
    }
}
