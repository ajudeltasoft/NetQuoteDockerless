<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class Test extends Model
{
    use HasFactory;
    //protected $table = 'address';
    public static function getAllContacts()
    {
        //Example for join query
        $contacts = DB::table('users')
        ->join('contacts', 'users.id', '=', 'contacts.user_id')        
        ->select('users.*', 'contacts.mobile')
        ->get();       
        return response()->json($contacts);
       
    }

    public static function getAllContacts2()
    {
        //Example for direct query
        $contacts = DB::select('select * from contacts');     
        return response()->json($contacts);
      // var_dump($contacts);
 
    }


    public static function getAllContacts3()
    {
        //Example for direct query with where condition- here where id=1;      

        $someVariable = 1;
        //$contacts = DB::select( DB::raw("SELECT * FROM contacts WHERE id = 2"));
        $contacts = DB::select( DB::raw("SELECT * FROM contacts WHERE id = :somevariable"), array(
        'somevariable' => $someVariable,
        ));
        return response()->json($contacts);  
    }
}
