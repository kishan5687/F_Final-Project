
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SaleController;
use App\Http\Middleware\EnsureLoggedIn;

// Authentication
Route::get('/login', [AuthController::class, 'login']);
Route::post('/loginProcess', [AuthController::class, 'loginProcess']);
Route::get('/logout', [AuthController::class, 'logout']);

// Protected pages
Route::middleware([EnsureLoggedIn::class])->group(function () {

    // Dashboard
    Route::get('/', [DashboardController::class, 'index']);

    // Products
    Route::get('/products', [ProductController::class, 'index']);
    Route::get('/products/create', [ProductController::class, 'create']);
    Route::post('/products/store', [ProductController::class, 'store']);
    Route::get('/products/edit/{id}', [ProductController::class, 'edit']);
    Route::post('/products/update/{id}', [ProductController::class, 'update']);
    Route::get('/products/delete/{id}', [ProductController::class, 'delete']);

    // Customers
    Route::get('/customers', [CustomerController::class, 'index']);
    Route::get('/customers/create', [CustomerController::class, 'create']);
    Route::post('/customers/store', [CustomerController::class, 'store']);
    Route::get('/customers/edit/{id}', [CustomerController::class, 'edit']);
    Route::post('/customers/update/{id}', [CustomerController::class, 'update']);
    Route::get('/customers/delete/{id}', [CustomerController::class, 'delete']);

    // Users
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/users/create', [UserController::class, 'create']);
    Route::post('/users/store', [UserController::class, 'store']);
    Route::get('/users/edit/{id}', [UserController::class, 'edit']);
    Route::post('/users/update/{id}', [UserController::class, 'update']);
    Route::get('/users/delete/{id}', [UserController::class, 'delete']);

    // Sales
    Route::get('/sales/record', [SaleController::class, 'record']);
    Route::post('/sales/store', [SaleController::class, 'store']);
    Route::get('/sales/history', [SaleController::class, 'history']);

});
