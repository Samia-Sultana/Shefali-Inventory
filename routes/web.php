<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /* supplier CRUD */
    Route::get('/supplier',[SupplierController::class,'index'])->middleware('auth')->name('viewSupplierPage');
    Route::post('/supplier',[SupplierController::class,'store'])->middleware('auth')->name('addSupplier');
    Route::post('/update/supplier',[SupplierController::class,'update'])->middleware('auth')->name('updateSupplier');
    Route::post('/delete/supplier',[SupplierController::class,'destroy'])->middleware('auth')->name('deleteSupplier');
    /* supplier CRUD end */

    /* product CRUD */
    Route::get('/product',[ProductController::class,'index'])->middleware('auth')->name('viewProductPage');
    Route::post('/add/product',[ProductController::class,'store'])->middleware('auth')->name('addProduct');
    Route::post('/update/product',[ProductController::class,'update'])->middleware('auth')->name('updateProduct');
    Route::post('/delete/product',[ProductController::class,'destroy'])->middleware('auth')->name('deleteProduct');
    /* product CRUD end */


    /* purchase CRUD */
    Route::get('/purchase',[PurchaseController::class,'index'])->middleware('auth')->name('viewPurchasePage');
    Route::post('/add/purchase',[PurchaseController::class,'store'])->middleware('auth')->name('addPurchase');
    Route::post('/update/purchase',[PurchaseController::class,'update'])->middleware('auth')->name('updatePurchase');
    Route::post('/delete/purchase',[PurchaseController::class,'destroy'])->middleware('auth')->name('deletePurchase');
    /* purchase CRUD end */

    /* orders CRUD */
    Route::get('/order',[OrderController::class,'index'])->middleware('auth')->name('viewOrderPage');
    Route::post('/add/order',[OrderController::class,'store'])->middleware('auth')->name('addOrder');
    Route::post('/update/order',[OrderController::class,'update'])->middleware('auth')->name('updateOrder');
    Route::post('/delete/order',[OrderController::class,'destroy'])->middleware('auth')->name('deleteOrder');
    /* orders CRUD end */


    /* generate Stock report */

    /* generate sale report */
});

require __DIR__.'/auth.php';
