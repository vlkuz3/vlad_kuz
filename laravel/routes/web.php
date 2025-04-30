<?php

use App\Http\Controllers\CarCategoryController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', [TestController::class, 'test']);

Route::get('/product/all', [ProductController::class, 'index'])->name('product.index');
Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
Route::post('/product', [ProductController::class, 'store'])->name('product.store');
Route::get('/product/{product}/edit', [ProductController::class, 'edit'])->name('product.edit');
Route::put('/product/{product}', [ProductController::class, 'update'])->name('product.update');
Route::delete('/product/{product}', [ProductController::class, 'destroy'])->name('product.destroy');

Route::get('/car/all', [CarController::class, 'index'])->name('cars.index');
Route::get('/car/create', [CarController::class, 'create'])->name('cars.create');
Route::post('/car', [CarController::class, 'store'])->name('car.store');
Route::get('/car/{car}/edit', [CarController::class, 'edit'])->name('car.edit');
Route::put('/car/{car}', [CarController::class, 'update'])->name('car.update');
Route::delete('/car/{car}', [CarController::class, 'destroy'])->name('car.destroy');

Route::get('/customer/all', [CustomerController::class, 'index'])->name('customers.index');
Route::get('/customer/create', [CustomerController::class, 'create'])->name('customers.create');
Route::post('/customer', [CustomerController::class, 'store'])->name('customers.store');
Route::get('/customer/{customer}/edit', [CustomerController::class, 'edit'])->name('customers.edit');
Route::put('/customer/{customer}', [CustomerController::class, 'update'])->name('customers.update');
Route::delete('/customer/{customer}', [CustomerController::class, 'destroy'])->name('customers.destroy');

Route::delete('/rental/{rental}', [RentalController::class, 'destroy'])->name('rentals.destroy');
Route::get('/rental/all', [RentalController::class, 'index'])->name('rentals.index');
Route::get('/rental/create', [RentalController::class, 'create'])->name('rentals.create');
Route::post('/rental', [RentalController::class, 'store'])->name('rentals.store');
Route::get('/rental/{rental}/edit', [RentalController::class, 'edit'])->name('rentals.edit');
Route::put('/rental/{rental}', [RentalController::class, 'update'])->name('rentals.update');
Route::delete('/rental/{rental}', [RentalController::class, 'destroy'])->name('rentals.destroy');

Route::get('/payment/all', [PaymentController::class, 'index'])->name('payments.index');
Route::get('/payment/create', [PaymentController::class, 'create'])->name('payments.create');
Route::post('/payment', [PaymentController::class, 'store'])->name('payments.store');
Route::get('/payment/{payment}/edit', [PaymentController::class, 'edit'])->name('payments.edit');
Route::put('/payment/{payment}', [PaymentController::class, 'update'])->name('payments.update');
Route::delete('/payment/{payment}', [PaymentController::class, 'destroy'])->name('payments.destroy');

Route::get('/category/all', [CarCategoryController::class, 'index'])->name('categories.index');
Route::get('/category/create', [CarCategoryController::class, 'create'])->name('categories.create');
Route::post('/category', [CarCategoryController::class, 'store'])->name('categories.store');
Route::get('/category/{category}/edit', [CarCategoryController::class, 'edit'])->name('categories.edit');
Route::put('/category/{category}', [CarCategoryController::class, 'update'])->name('categories.update');
Route::delete('/category/{category}', [CarCategoryController::class, 'destroy'])->name('categories.destroy');