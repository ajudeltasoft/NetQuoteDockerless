<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
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
}
