<?php

use App\Http\Controllers\Api\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartsController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RateController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/info',function (Request $request) {
    return response()->json([
        'status' => 'success',
        'message' => 'HelloWorld',
    ]);
});

Route::get('/', 'App\Http\Controllers\Api\HomeController@index')->name('landingPage');
Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home')->middleware('auth:sanctum');
Route::get('/user', 'App\Http\Controllers\UserController@index')->name('user')->middleware('auth:sanctum');

// Auth Routes
Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function () {
    
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
    Route::get('/user', [AuthController::class, 'user'])->middleware('auth:sanctum');
    Route::put('/user/  ', [AuthController::class, 'update'])->middleware('auth:sanctum');
});

// for Client---------------
Route::group([
    'middleware' => 'api',
    'prefix'=>'user'
], function() { 
    Route::post('/cart/markItRead', [CartsController::class, 'markItRead'])->middleware('auth:sanctum');
    Route::resource('/cart', CartsController::class)->middleware('auth:sanctum');
    Route::resource('/order', OrderController::class)->middleware('auth:sanctum');
    Route::resource('/rate', RateController::class)->middleware('auth:sanctum');
});

Route::get('/byCategory',action: 'App\Http\Controllers\Api\ProductController@byCategory')->name('user.product.show');
Route::get('/categories',[App\Http\Controllers\CategoriesController::class, 'index']);