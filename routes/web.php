<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CategoriesController;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('layouts.dashboard');
// });

Auth::routes(['verify'=>true]);

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home')->middleware('verified');
Route::get('/user', 'App\Http\Controllers\UserController@index')->name('user')->middleware('verified');
Route::get('/dashboard', 'App\Http\Controllers\AdminController@index')->name('admin')->middleware('verified');

Route::get('/dashboard/myprofile', 'App\Http\Controllers\ProfileController@index')->name('dash.myprofile');
Route::put('/dashboard/editMyProfile', 'App\Http\Controllers\ProfileController@profileEdit')->name('dash.profileEdit');
Route::put('/dashboard/editpictureProfile', 'App\Http\Controllers\ProfileController@pictureEdit')->name('dash.pictureEdit');


// for users
Route::group(['middleware' => ['auth', 'role:user']], function() { 
    // Route::get('/user/myprofile', 'App\Http\Controllers\UserController@myprofile')->name('user.myprofile');
});

// for admin
Route::group(['middleware' => ['auth', 'role:admin'],'prefix'=>'dashboard'], function() { 
    Route::get('/products', 'App\Http\Controllers\AdminController@products')->name('dashboard.products');
    Route::get('/orders', 'App\Http\Controllers\AdminController@orders')->name('dashboard.orders');
    Route::get('/customers', 'App\Http\Controllers\AdminController@customers')->name('dashboard.Customers');
    Route::get('/product/byCategory', 'App\Http\Controllers\ProductsController@byCategory')->name('product.byCategory');
    Route::get('/product/filter', [ProductsController::class,'filter'])->name('product.filter');
    Route::resource('/product',ProductsController::class);
    Route::resource('/category',App\Http\Controllers\CategoriesController::class);
});



