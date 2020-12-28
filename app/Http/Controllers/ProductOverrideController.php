<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductOverride;
use DB;
class ProductOverrideController extends Controller
{
    //
   public function getProductOverRide(Request $request)
    {
        $productId =request("productId");
        $result = DB::table('prodoverride')       
        ->Select('*')
        ->where('prodid','=',$productId)->get();
        //return response()->json($result);

        $data=array();
        $temp=array();
        if(count($result)){
            $data['status']=true;
            $data['message']='Success';
            foreach($result as $row){
                //print_r($row);
                $temp['label']=$row->uiname;
                $temp['type']=$row->uitype;
                if($row->uitype=='number'){
                    $temp['input']=array();                    
                }
                else if ($row->uitype=='choice'){
                    
                    $KEYS   = explode(':', $row->uikey);
                    $VALUES = explode(':', $row->uivalue);
                    $select=array();

                    for ($i = 0; $i < sizeof($KEYS); $i++){
                        $select['key']=$KEYS[$i];
                        $select['value']=$VALUES[$i];
                        $temp['input'][$i]=$select;
                        //unset($select);
                    }
                                       
                }
                $modInfo[]=$temp;
               
            }
            $data['result']=$modInfo;
        }
        else{
            $data['status']=false;
            $data['message']='No options available for this modification';
            $data['result']=array();
        }
        return response()->json($data);  
    }
}
