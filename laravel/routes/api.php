<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::middleware('api')->group(function () {
    Route::get('/ping', function () {
        return response()->json(['message' => 'API is working!']);
    });
});

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::middleware(['auth:api'])->group(function () {
    Route::get('/product/all', [ProductController::class, 'index'])->middleware('role:admin,manager,client')->name('product.index');
    Route::get('/product/create', [ProductController::class, 'create'])->middleware('role:manager,admin')->name('product.create');
    Route::post('/product', [ProductController::class, 'store'])->middleware('role:manager,admin')->name('product.store');
    Route::get('/product/{product}/edit', [ProductController::class, 'edit'])->middleware('role:manager,admin')->name('product.edit');
    Route::put('/product/{product}', [ProductController::class, 'update'])->middleware('role:manager,admin')->name('product.update');
    Route::delete('/product/{product}', [ProductController::class, 'destroy'])->middleware('role:admin')->name('product.destroy');

    Route::post('/logout', [AuthController::class, 'logout']);
});