<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartsController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CategoriesController;
use Illuminate\Support\Facades\Auth;

Auth::routes(['verify'=>true]);

Route::get('/', 'App\Http\Controllers\HomeController@index')->name('welcome');
Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home')->middleware('verified');
Route::get('/user', 'App\Http\Controllers\UserController@index')->name('user')->middleware('verified');

// for profiles--------------
Route::group(['prefix'=>'dashboard'], function() { 
Route::get('/myprofile', 'App\Http\Controllers\ProfileController@index')->name('dash.myprofile');
Route::put('/editMyProfile', 'App\Http\Controllers\ProfileController@profileEdit')->name('dash.profileEdit');
Route::put('/editpictureProfile', 'App\Http\Controllers\ProfileController@pictureEdit')->name('dash.pictureEdit');
});

// for Client---------------
Route::group(['middleware' => ['auth', 'role:user'],'prefix'=>'user'], function() { 
    Route::get('/myorders', 'App\Http\Controllers\UserController@myorders')->name('myorders');
    Route::get('/paymentmethod', 'App\Http\Controllers\UserController@paymentmethod')->name('paymentmethod');
    Route::resource('/cart', CartsController::class);
    Route::resource('/order', OrderController::class);
});
Route::get('/byCategory','App\Http\Controllers\ProductsController@byCategory')->name('user.product.show');


// For admin--------------
Route::group(['middleware' => ['auth', 'role:admin'],'prefix'=>'dashboard'], function() { 
    Route::get('/', 'App\Http\Controllers\AdminController@index')->name('admin')->middleware('verified');
    Route::get('/products', 'App\Http\Controllers\AdminController@products')->name('dashboard.products');
    Route::get('/orders', 'App\Http\Controllers\AdminController@orders')->name('dashboard.orders');
    Route::get('/customers', 'App\Http\Controllers\AdminController@customers')->name('dashboard.Customers');
    Route::get('/product/byCategory', 'App\Http\Controllers\ProductsController@byCategory')->name('product.byCategory');
    Route::get('/product/filter', [ProductsController::class,'filter'])->name('product.filter');
    Route::resource('/product',ProductsController::class);
    Route::resource('/category',App\Http\Controllers\CategoriesController::class);
});