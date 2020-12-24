<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Customer;
use App\Models\OrderModification;
use App\Models\Modoverride;
use DB;
use Config;
class OrderController extends Controller
{
    //

    public function store(Request $request)
    {
        //
        
        $order = new Order();
        $order->customer= request("customer");
        $order->company= request("company");
        $order->funds= request("funds");
        $order->po= request("po");
        $order->orderType= request("orderType");
        $order->jobName= request("jobName");
        $order->extraCharge= request("extraCharge");
        $order->notes= request("notes");
        $order->selectAddress= request("selectAddress");
        $order->shippingStreet= request("shippingStreet");
        $order->shippingCity= request("shippingCity");
        $order->shippingState= request("shippingState");
        $order->shippingCountry= request("shippingCountry");
        $order->shippingZipcode= request("shippingZipcode");
        $order->shippingPhone= request("shippingPhone");
        $order->via= request("via");
        $order->checkboxAddress= request("checkboxAddress");
        $order->name= request("name");
        $order->finalStreet= request("finalStreet");
        $order->finalCity= request("finalCity");
        $order->finalState= request("finalState");
        $order->finalCountry= request("finalCountry");
        $order->finalZipcode= request("finalZipcode");
        $order->finalPhone= request("finalPhone");
        
        $order->save();
       
        return response()->json([
            'message' => 'Order created successfully ',
            'user' => $order
        ], 201);
        //return redirect("/articles");
    }

    public function getAllOrders()
    {
        //
        $order = Order::latest()->get();       
        return response()->json($order);
       
    }

    public function orderDetail(Request $request)
    {
        //
        $id =request("id");
        $order = Order::find($id);
        return response()->json($order);
    }

    public function getAllCompanies(){
        
        $contacts = Customer::all(); 
        return response()->json($contacts);        
     }

     public function getCompanyInfo(Request $request){
        
        $data=array();
        $companyId =request("companyId"); 
        
        /**Get company address */
        $address = DB::table('shipto as s')        
        ->join('customers as c', 'c.idcust', '=', 's.idcust')
        ->Select('s.id','c.namecust', 's.idcust', 's.namelocn', 's.textstre1', 's.namecity',
        's.ref_stateid', 's.codestte', 's.codectry', 's.codepstl', 's.textphon1',
         's.ref_shipvia', 's.shipvia')->where('c.id','=',$companyId)->get();

        $data['addressInfo'] = $address;

        /**Get Designers */
        $carriers = DB::table('lucarriers as cr')     
        ->Select('cr.id','cr.carriername', 'cr.city', 'cr.state', 'cr.country')->get();
        $data['carrierInfo'] = $carriers;

        /**Get Payment Terms */
        $paymentTerms = DB::table('lupayterms as pt')     
        ->Select('pt.*')->get();
        $data['paymentTerms'] = $paymentTerms;

         /**Get Payment Terms */
         $catalogues = DB::table('catalogues as cl')     
         ->Select('cl.*')->get();
         $data['catalogues'] = $catalogues;
       
        return response()->json($data);        
     }

     public function getModOverrideInfo(Request $request){
        $data=array();
        $modInfo=array();
        $temp=array();
        $modId =request("modId"); 
        $modoverride = DB::table('modoverrides as mo')     
         ->Select('mo.*')->where('mo.modid','=',$modId)->get();

        if(count($modoverride)){
            $data['status']=true;
            $data['message']='Success';
            $c=1;
            foreach($modoverride as $row){
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
                    // echo'---------------------------';
                    // echo'<pre>';
                    // print_r($temp['input']);
                    // if($c==2)
                    // die;
                   
                }
                $modInfo[]=$temp;
                $c++;
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

     public function checkOverride(Request $request){
        
        //return response()->json($request); 
// $str="select";
// echo $str.replace(/[^0-9]/g, "");
// die
        $products = $request->post('nm');
        $arr= json_decode($products);
        //print_r($arr);
        foreach($arr as $row){
                print_r($row);
        }
        ///$hing=Config::get('constants.options.RightHinge');
        //$hing=constants('constants.hinges.RightHinge');
        
        

     }

     public function addItem(Request $request){
        $data=array();
        $itemId = $request->post('product_id');
        $itemInfo = DB::table('products as p')     
         ->Select('p.*')->where('p.id','=',$itemId)->get();

         if(count($itemInfo)){
            $data['message']='';
            $LeftHinge=Config::get('constants.options.LeftHinge');
            $RightHinge=Config::get('constants.options.RightHinge');
            $DRLhinge=Config::get('constants.options.DRLhinge');
            $DRRhinge=Config::get('constants.options.DRRhinge');
            /*old syytem ref 232->5,235->8,233->6,236->9 */
            $product_name = $request->post('product_name');
            $order_item_hinging = $request->post('order_item_hinging');

            if(true === in_array($order_item_hinging , array($LeftHinge, $DRLhinge)))
			{
				$product_name = $product_name  . 'L';
			}
			else if(true === in_array($order_item_hinging , array($RightHinge, $DRRhinge)))
			{
				$product_name = $product_name  . 'R';
			}
			else
			{
				$product_name = $product_name ;
            }
            

			
            /*  insert into orde nqcabinets_orders__items*/
            
			
            $item = new OrderItem();
            $item->specgroup_id= request("specgroup_id");
            $item->order_item_sequence= 1;
            $item->order_item_quantity= request("order_item_quantity");
            $item->product_id= request("product_id");
            $item->product_name= $product_name;
            $item->order_item_width= request("order_item_width");
            $item->order_item_height= request("order_item_height");
            $item->order_item_depth= request("order_item_depth");
            $item->hinge_id= request("order_item_hinging");
            $item->order_item_extra_charge= request("order_item_extra_charge");
            $item->order_item_note= request("order_item_note");
            $item->engineering_note= trim(request("engineering_note"));
            $item->no_charge= request("no_charge") ;
            $item->save();
            $order_item_id=$item->id;
            $data['id']=$order_item_id;
            /** AddProductModifications*/
            //Delete existing modification from
            $deletedRows = OrderModification::where('order_item_id', $order_item_id)->delete();
            //Insert into ordermodifications
            $modOverrides = $request->post('modOverrides');
            $arrMO= json_decode($modOverrides);
            
            foreach($arrMO as $row){
                //print_r($row[0]->modId);
                //print_r($row->modId);
                $modid=$row->modId;
                $orId=$row->orId;
                $selOrId=$row->selOrId;
                
                $result = Modoverride::where('id','=',$orId)                
                ->get();
                //print_r($result->count());
                $modification_qty=0;
                $psivar_psivar='';
                $no_charge=0;
                if($result->count()>0){
                    //
                    //print_r($result); die;
                    foreach ($result as $r1) {
                       $psivar_psivar= $r1->pcode[0];
                      if($psivar_psivar=='Q'){
                        $modification_qty=$selOrId;
                      }
                      else{
                        $modification_qty=0;
                      }
                    }
                }
                //run insert query
                $mod = new OrderModification();
                $mod->order_item_id= $order_item_id ;
                $mod->modification_id= $modid ;
                $mod->order_modification_quantity= $modification_qty ;
                $mod->no_charge= $no_charge;
                $mod->order_modification_note= "" ;
                $mod->order_modification_overrides= $orId ;
                $mod->order_modification_overrides_selected= $selOrId ;
                $mod->save();

               
            }
         
         }
         else{
            $data['message']='Invalid Item';
         }

         return response()->json($data);  
     }

}
