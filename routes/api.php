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
Route::post('address', [AddressController::class, 'getAllRecords']);