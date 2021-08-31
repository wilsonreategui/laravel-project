<?php

use App\Http\Controllers\BuyerController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\InvoiceDetailController;
use App\Http\Controllers\ProductController;
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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


Route::middleware(['auth:sanctum', 'verified'])->group( function(){
    
    Route::resource('/products', ProductController::class);
    Route::resource('/buyers', BuyerController::class);
    Route::resource('/invoices', InvoiceController::class);
    Route::resource('/invoices_detail', InvoiceDetailController::class);

    Route::post('/invoices/{invoice}/complete', [InvoiceController::class, 'completeSend'])->name('invoices.complete');
    Route::get('/invoices/invoices_detail/{invoice}', [InvoiceDetailController::class, 'create'])->name('invoices.detail');
});
