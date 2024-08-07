<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartsController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductsController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/info',function (Request $request) {
    return response()->json([
        'status' => 'success',
        'message' => 'HelloWorld',
    ]);
});

Route::get('/', 'App\Http\Controllers\HomeController@index')->name('welcome');
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
    Route::get('/myorders', 'App\Http\Controllers\UserController@myorders')->name('myorders')->middleware('auth:sanctum');
    Route::get('/paymentmethod', 'App\Http\Controllers\UserController@paymentmethod')->name('paymentmethod')->middleware('auth:sanctum');
    Route::post('/cart/markItRead', [CartsController::class, 'markItRead'])->middleware('auth:sanctum');
    Route::resource('/cart', CartsController::class)->middleware('auth:sanctum');
    Route::resource('/order', OrderController::class)->middleware('auth:sanctum');
});
Route::get('/byCategory','App\Http\Controllers\ProductsController@byCategory')->name('user.product.show');

// For admin--------------
Route::group(['middleware' => ['auth:sanctum', 'sanctum.role:admin'],'prefix'=>'dashboard'], function() { 
    Route::get('/', 'App\Http\Controllers\AdminController@index')->name('admin')->middleware('verified');
    Route::get('/products', 'App\Http\Controllers\AdminController@products')->name('dashboard.products');
    Route::get('/orders', 'App\Http\Controllers\AdminController@orders')->name('dashboard.orders');
    Route::get('/customers', 'App\Http\Controllers\AdminController@customers')->name('dashboard.Customers');
    Route::get('/product/byCategory', 'App\Http\Controllers\ProductsController@byCategory')->name('product.byCategory');
    Route::get('/product/filter', [ProductsController::class,'filter'])->name('product.filter');
    Route::resource('/product',ProductsController::class);
    Route::resource('/category',App\Http\Controllers\CategoriesController::class);
});
Route::get('/categories',[App\Http\Controllers\CategoriesController::class, 'index']);