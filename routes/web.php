<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SalesInventoryController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', [SalesInventoryController::class, 'index'])->name('log');
Route::get('/home', [SalesInventoryController::class, 'home'])->name('home');
Route::get('/inventory', [SalesInventoryController::class, 'inventory'])->name('inventory');
Route::get('/products', [SalesInventoryController::class, 'products'])->name('products.index');
Route::get('/orders', [SalesInventoryController::class, 'orders'])->name('orders');
Route::get('/reports', [SalesInventoryController::class, 'reports'])->name('reports');
Route::get('/sales', [SalesInventoryController::class, 'sales'])->name('sales');
Route::get('/receipt', [SalesInventoryController::class, 'receipt'])->name('receipt');
Route::post('/login', [Controller::class, 'login'])->name('login'); 

Route::get('/products/create', [SalesInventoryController::class, 'createProduct'])->name('products.create');
Route::post('/products', [SalesInventoryController::class, 'storeProduct'])->name('products.store');
Route::get('/products/{product}/edit', [SalesInventoryController::class, 'editProduct'])->name('products.edit');
Route::put('/products/{product}', [SalesInventoryController::class, 'updateProduct'])->name('products.update');
Route::delete('/products/{product}', [SalesInventoryController::class, 'deleteProduct'])->name('products.destroy');


Route::post('/sales/store', [SalesInventoryController::class, 'store'])->name('sales.store');
Route::delete('/reports/delete/{id}', [SalesInventoryController::class, 'deleteReport'])->name('reports.delete');
Route::delete('/reports/delete/{id}', [\App\Http\Controllers\SalesInventoryController::class, 'deleteReport'])->name('reports.delete');


Route::get('/accounts', [SalesInventoryController::class, 'account'])->name('accounts.index');
Route::get('/accounts/create', [SalesInventoryController::class, 'createAccount'])->name('accounts.create');
Route::post('/accounts', [SalesInventoryController::class, 'storeAccount'])->name('accounts.store');
Route::get('/accounts/{accounts}/edit', [SalesInventoryController::class, 'editAccount'])->name('accounts.edit');
Route::put('/accounts/{account}', [SalesInventoryController::class, 'updateAccount'])->name('accounts.update');
Route::delete('/accounts/{account}', [SalesInventoryController::class, 'deleteAccount'])->name('accounts.destroy');

