<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use DB;
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

    public function getProductDetail(Request $request)
    {
        //
        $productId =request("productId");        

        //$result = Product::where('name','=',$productId)->get();

        
           $storagePath  = Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix();
       
            //  return response()->json($result);
            // $img='apg21';
            // $image=$storagePath.'/images/catalog/'.$img.'.png';
           
        /** Get product details */    
         $product = DB::table('products')
         ->join('productimages', 'products.name', '=', 'productimages.SKU')
         ->Select('products.*','productimages.ImageName')->where('products.id','=',$productId)->get();

# Add fake column you want by this command
//$product = $product->addSelect(DB::raw("'test' as image"))->get();
        $data= array();
        $productInfo=array();
        foreach($product as $r){
            $productInfo['id']=$r->id;
            $productInfo['code']=$r->code;
            $productInfo['name']=$r->name;
            $productInfo['width']=$r->width;
            $productInfo['height']=$r->height;
            $productInfo['depth']=$r->depth;

            $productInfo['minwidth']=$r->minwidth;
            $productInfo['minheight']=$r->minheight;
            $productInfo['mindepth']=$r->mindepth;

            $productInfo['mxwidth']=$r->mxwidth;
            $productInfo['mxheight']=$r->mxheight;
            $productInfo['mxdepth']=$r->mxdepth;
            $productInfo['image']=$storagePath.'/images/catalog/'.$r->ImageName.'.png';

        }

        $data['productInfo']=$productInfo;

       /** Get product details */    
       $productModification=array();
       $productMod = DB::table('modifications as m')
       ->leftjoin('mtx_modprices as mp', 'm.id', '=', 'mp.modid')
       ->join('mtx_productmodifications as pm', 'pm.modid', '=', 'm.id')
       ->Select('m.id','m.name','m.description','mp.price')->where('pm.prodid','=',$productId)->get();

      $data['productModification']=$productMod;

        return response()->json($data);


    }
}
