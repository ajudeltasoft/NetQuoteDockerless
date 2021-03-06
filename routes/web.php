<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\AddressController;
use App\Http\Controllers\TestController;
Route::get('address', [AddressController::class, 'getAllRecords']);
Route::get('genxml', [TestController::class, 'generateXML']);
Route::get('genxml2', [TestController::class, 'generateXML2']);
