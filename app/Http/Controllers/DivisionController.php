<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Division;
use DB;
class DivisionController extends Controller
{
    public function getAllDivisions(Request $request){
        
        $modification_id = request("modification_id");
        //$contacts = DB::select( DB::raw("SELECT * FROM contacts WHERE id = 2"));
        $modification = DB::select( DB::raw("SELECT id, name, description,
        (
            SELECT COUNT(p.id)
            FROM products p
            WHERE p.id = d.id
        ) AS Products,
        (
            SELECT COUNT(p.id)
            FROM products p
                INNER JOIN mtx_productmodifications l on l.id = p.id
            WHERE l.id = '$modification_id'
            AND p.id = d.id
        ) AS Associations
        FROM divisions d
        ORDER BY name"
        ));
        return response()->json($modification);      
     }

}
