<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Customer;
use DB;
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

}
