<?php

use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;
use Illuminate\Support\Facades\Auth;

Auth::routes(['verify'=>true, 'register'=>false]);

Route::get('/', 'App\Http\Controllers\HomeController@index')->name('welcome');
Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home')->middleware('verified');
Route::get('/user', 'App\Http\Controllers\UserController@index')->name('user')->middleware('verified');

// for language
Route::get('/lang/{lang}', 'App\Http\Controllers\LanguageController@switchLang')->name('lang.switch');

// for profiles--------------
Route::group(['prefix'=>'dashboard'], function() { 
Route::get('/myprofile', 'App\Http\Controllers\ProfileController@index')->name('dash.myprofile');
Route::put('/editMyProfile', 'App\Http\Controllers\ProfileController@profileEdit')->name('dash.profileEdit');
Route::put('/editpictureProfile', 'App\Http\Controllers\ProfileController@pictureEdit')->name('dash.pictureEdit');
});

// For admin--------------
Route::group(['middleware' => ['auth', 'role:admin'],'prefix'=>'dashboard'], function() { 
    Route::get('/', 'App\Http\Controllers\AdminController@index')->name('admin')->middleware('verified');
    Route::get('/products', 'App\Http\Controllers\AdminController@products')->name('dashboard.products');
    Route::post('/order/{id}/update-status', [OrderController::class, 'updateStatus'])->name('order.updateStatus');
    Route::get('/orders', 'App\Http\Controllers\AdminController@orders')->name('dashboard.orders');
    Route::get('/customers', 'App\Http\Controllers\AdminController@customers')->name('dashboard.Customers');
    Route::get('/contact-messages', 'App\Http\Controllers\AdminController@contactMessages')->name('dashboard.contactMessages');
    Route::post('/contact-messages/{id}/toggle-status', 'App\Http\Controllers\AdminController@toggleContactStatus')->name('admin.contactMessages.toggleStatus');
    Route::get('/sliders', 'App\Http\Controllers\AdminController@sliders')->name('dashboard.sliders');
    Route::post('/sliders', 'App\Http\Controllers\AdminController@storeSlider')->name('admin.sliders.store');
    Route::delete('/sliders/{id}', 'App\Http\Controllers\AdminController@deleteSlider')->name('admin.sliders.delete');
    Route::get('/user-stats', 'App\Http\Controllers\AdminController@userStats')->name('admin.userStats');
    Route::get('/users-report', 'App\Http\Controllers\AdminController@usersReport')->name('admin.usersReport');
    Route::get('/product/filter', [ProductsController::class,'filter'])->name('product.filter');
    Route::resource('/product',ProductsController::class);
    Route::resource('/category',App\Http\Controllers\CategoriesController::class);
});

// Health check endpoint for external cron jobs and Render health checks
Route::get('/healthz', function () {
    try {
        \Illuminate\Support\Facades\DB::connection()->getPdo();
        $dbStatus = 'connected';
    } catch (\Throwable $e) {
        $dbStatus = 'disconnected';
    }

    return response()->json([
        'status' => 'ok',
        'database' => $dbStatus,
        'timestamp' => now()->toIso8601String(),
    ]);
})->name('healthz');

// Fallback asset route for product images to guarantee no 404s
Route::get('/assets/images/products/{filename}', function ($filename) {
    $path = public_path('assets/images/products/' . $filename);
    if (file_exists($path)) {
        return response()->file($path);
    }
    $rootPath = base_path('assets/images/products/' . $filename);
    if (file_exists($rootPath)) {
        return response()->file($rootPath);
    }
    $default = public_path('assets/images/products/default_product.jpg');
    if (file_exists($default)) {
        return response()->file($default);
    }
    abort(404);
})->where('filename', '.*');

// Fallback asset route for category icons to prevent 404s
Route::get('/assets/images/categories/{filename}', function ($filename) {
    $path = public_path('assets/images/categories/' . $filename);
    if (file_exists($path)) {
        return response()->file($path);
    }
    $default = public_path('assets/images/categories/1783098856.svg');
    if (file_exists($default)) {
        return response()->file($default);
    }
    abort(404);
})->where('filename', '.*');

Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});