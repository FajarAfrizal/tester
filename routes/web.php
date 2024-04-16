<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\UserController;
use App\Models\Purchase;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('isLogin')->group(function() {
    route::get('/product', [ProductController::class, 'index'])->name('pageProduct');
    route::post('/product/add', [ProductController::class, 'store'])->name('addProduct');
    route::put('/product/update/{id}', [ProductController::class, 'update'])->name('updateProduct');
    route::put('/product/updateStock/{id}', [ProductController::class, 'updateStock'])->name('updateStockProduct');
    route::delete('/product/delete/{id}', [ProductController::class, 'destroy'])->name('deleteProduct');

    route::get('/user', [UserController::class, 'index'])->name('pageUser');
    route::post('/user/add', [UserController::class, 'store'])->name('addUser');
    route::put('/user/update/{id}', [UserController::class, 'update'])->name('updateUser');
    route::delete('/user/delete/{id}', [UserController::class, 'destroy'])->name('deleteUser');

    route::get('/purchase', [PurchaseController::class, 'index'])->name('pagePurchase');
    route::post('/purchase/add', [PurchaseController::class, 'store'])->name('addPurchase');
    route::delete('/purchase/delete/{id}', [PurchaseController::class, 'destroy'])->name('deletePurchase');

    route::get('/logout', [UserController::class, 'logout'])->name('logout');
});

route::middleware('isGuest')->group(function(){
    route::get('/login', [UserController::class, 'login'])->name('login');
    route::post('/auth/login', [UserController::class, 'authLogin'])->name('authLogin');
});

