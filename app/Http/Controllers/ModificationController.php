<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Modification;
use DB;
class ModificationController extends Controller
{
    public function getAllModifications(){
        
       // $Modification = Modification::all(); 
       $Modification = DB::table('modifications')
       ->select('id','name','description')
       ->get();
        return response()->json($Modification);       
     }
}
