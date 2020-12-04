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
        $productHinge='';
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
            $productInfo['hinge']=$r->hinge;
            $productHinge=$r->hinge;
         //   $productInfo['image']=$storagePath.'/images/catalog/'.$r->ImageName.'.png';
            $productInfo['image']=asset('images/catalog/'.$r->ImageName.'.png');

        }

        $data['productInfo']=$productInfo;

       /** Get product details */    
       $productModification=array();
       $productModification2=array();
       $productMod = DB::table('modifications as m')
       ->leftjoin('mtx_modprices as mp', 'm.id', '=', 'mp.modid')
       ->join('mtx_productmodifications as pm', 'pm.modid', '=', 'm.id')
       ->Select('m.id','m.name','m.description','m.modification_amtpercent','mp.price')->where('pm.prodid','=',$productId)->get();

       foreach($productMod as $r){
            $Mod['id']=$r->id;
            $Mod['name']=$r->name;
            $Mod['description']=$r->description;
            
            $price_info ='';
            $price =$r->price;
            $modification_amtpercent =$r->modification_amtpercent;
        
            if($modification_amtpercent =='')
            {               
                $price_info = 'No Charge';
            }
            else if(trim($modification_amtpercent ) == 'A') // We're dealing with a leveled value
            {
                $price_info = '+$' . number_format(round($price, 2), 2);
            }
            else // "P"... we're calculating a percentage.
            {
                $price_info = '+' . $price . '% of Item Price';
            }
            $Mod['price']=$price_info;
            $productModification[]=$Mod;

       }
      $data['productModification']=$productModification;

      //get hinges
      //$productHinge
      $hingeInfo = DB::table('luhinges as h')       
       ->Select('h.id','h.name')
       ->where('h.code','=',$productHinge)->get();

       $data['hinges']=$hingeInfo;
        return response()->json($data);


    }
}
