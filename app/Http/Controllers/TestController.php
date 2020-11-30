<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Test;
use SimpleXMLElement;

use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Carbon;
class TestController extends Controller
{
    //

    public function getAllContacts(){
        
       $contacts = Test::getAllContacts();  
       return response()->json($contacts);        
    }

    public function getAllContacts2(){
        
        $contacts = Test::getAllContacts3();  
        return response()->json($contacts);        
     }

   public function generateXML()
    {
      $path= public_path();
      //echo storage_path();
      //echo public_path();
      //$mytime = Carbon\Carbon::now();
      //echo $mytime->toDateTimeString();
    // $file_name=$mytime->toDateTimeString();
      
      $page = Test::getAllContacts();
      //$xml=response()->view('sitemap_xml', ['page' => $page])->header('Content-Type', 'text/xml');
      $xml=view('sitemap_xml', ['page' => $page]);
     // $xml=response()->view('sitemap_xml')->header('Content-Type', 'text/xml');

      $time=time();
    //  File::put(storage_path('/app/xml/'.$fileName),$data);
      Storage::put('xml/Order'.$time.'.xml', $xml);
      $file= Storage::url('xml/Order'.$time.'.xml');
      echo $file;
      echo'<br/>';
      echo $storagePath  = Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix();
      echo'<br/>'; 
      echo $storagePath."/xml/Order".$time.".xml";
     // return response::download(file_put_contents($path, $xml));
    //  return $xml;
    
    }

    public function generateXML2()
    {
      echo "hai";
      $writer = new XMLWriter();     
    //  $x = new SimpleXMLElement('');
      
    }
}
