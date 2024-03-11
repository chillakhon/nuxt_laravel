<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::post('/logout', function (Request $request) {
         $request->user()->tokens()->delete();
        return response()->json(['message' => 'Tokens revoked']);
    });
    Route::post('/createProduct', [\App\Http\Controllers\Api\ProductController::class, 'store']);
    Route::get('/products', [\App\Http\Controllers\Api\ProductController::class, 'index']);

    Route::get('/products/{product}', [\App\Http\Controllers\Api\ProductController::class,'show']);
    Route::post('/update/{product}', [\App\Http\Controllers\Api\ProductController::class, 'update']);
    Route::delete('/products/{product}', [\App\Http\Controllers\Api\ProductController::class, 'destroy']);


//    Route::get('/my-orders', function (Request $request) {
//        $user = $request->user();
//    });
});

//Route::post('/login', [\App\Http\Controllers\TestController::class, 'test']);
Route::get('/all_products', [\App\Http\Controllers\Api\ProductController::class, 'products_all']);


Route::post('/register', [RegisteredUserController::class, 'store']);

Route::post('/login', [AuthenticatedSessionController::class, 'store']);




//Route::get('/user', [\App\Http\Controllers\Api\UserController::class, 'getUser'])
//    ->name('user');


