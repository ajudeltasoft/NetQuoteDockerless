<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Section;
use DB;
class SectionController extends Controller
{
    public function getAllSections(Request $request) {
        $modification_id = request("modification_id");
        $division_id = request("division_id");
        $section = DB::select( DB::raw("SELECT id, name, description,
        (
            SELECT COUNT(p.id)
            FROM products p
            WHERE p.id = s.id
        ) AS Products,
        (
            SELECT COUNT(p.id)
            FROM products p
                INNER JOIN mtx_productmodifications l on l.id = p.id
            WHERE l.id = '$modification_id'
            AND p.id = s.id
        ) AS Associations,
        $modification_id as 'modification_id'
        FROM sections s
        WHERE s.divid = '$division_id'
        ORDER BY name"
        ));
        //$data['section']=$section;

        return response()->json($section);      
     }
}
