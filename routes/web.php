<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StockController;

Route::get('/', function () {
    return view('dashboard');
});


/**
 * Role Base Route[Feature]
 *  1. Admin
 *  2. Manager
 *  3. Employee
 * 
 */



/**
 *  Stock Management
 *     
 * 
 */
Route::prefix('stocks')->group(function(){

    Route::get('/', [StockController::class, 'index'])->name('stocks.index');
    Route::get('/create', [StockController::class, 'create'])->name('stocks.create');
    Route::post('/store', [StockController::class, 'store'])->name('stocks.store');
    Route::get('/show/{id}', [StockController::class, 'show'])->name('stocks.show');
    Route::get('/edit/{id}', [StockController::class, 'edit'])->name('stocks.edit');
    Route::post('/update/{id}', [StockController::class, 'update'])->name('stocks.update');
    Route::post('/delete/{id}', [StockController::class, 'destroy'])->name('stocks.destroy');   

});