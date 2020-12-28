<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
//Route::post('/articles/All', [ArticlesController::class, 'getAllRecords']);
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
   // Route::post('login', 'AuthController@login');
   Route::post('login', [AuthController::class, 'login']);
   //Route::post('login', [ 'as' => 'login', 'uses' => 'AuthController@login']);
   // Route::post('register', 'AuthController@register');
    Route::post('register', [AuthController::class, 'register']);
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    //Route::get('user-profile', 'AuthController@userProfile');
    Route::post('user-profile', [AuthController::class, 'userProfile']);
});

use App\Http\Controllers\AddressController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductOverrideController;
//use App\Http\Controllers\ProductOverTest;
use App\Http\Controllers\ModificationController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\SectionController;

Route::post('address', [AddressController::class, 'getAllRecords']);
Route::post('save_order', [OrderController::class, 'store']);
Route::post('list_order', [OrderController::class, 'getAllOrders']);
Route::post('order_detail', [OrderController::class, 'orderDetail']);

Route::post('contacts', [TestController::class, 'getAllContacts']);
Route::post('contacts2', [TestController::class, 'getAllContacts2']);

Route::get('genxml', [TestController::class, 'generateXML']);
Route::post('getProduct', [ProductController::class, 'getProduct']);
Route::post('getProductDetail', [ProductController::class, 'getProductDetail']);
Route::post('allCompanies', [OrderController::class, 'getAllCompanies']);
Route::post('companyInfo', [OrderController::class, 'getCompanyInfo']);
Route::post('getModOverrideInfo', [OrderController::class, 'getModOverrideInfo']);
Route::post('checkOverride', [OrderController::class, 'checkOverride']);
Route::post('addItem', [OrderController::class, 'addItem']);

Route::post('getProductOverRide', [ProductOverrideController::class, 'getProductOverRide']);
Route::post('getAllModifications', [ModificationController::class, 'getAllModifications']);
Route::post('getAllDivisions', [DivisionController::class, 'getAllDivisions']);
Route::post('getAllSections', [SectionController::class, 'getAllSections']);
