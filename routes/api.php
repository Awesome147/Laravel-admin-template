<?php

use Illuminate\Http\Request;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CommonController;
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


Route::post('/login', [AuthController::class,'isLogin']) ;
Route::post('/register', [AuthController::class,'getRegisterUser']) ;



//CommonController
Route::post('/subscriptions', [CommonController::class,'getSubscription']) ;
Route::post('/subscription-purchase', [CommonController::class,'getSubscriptionPurchase']) ;