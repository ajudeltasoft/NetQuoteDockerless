<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Address;
class AddressController extends Controller
{
    //

    public function getAllRecords()
    {
        
        $address = Address::latest()->get();       
        return response()->json($address);
       
    }
}
