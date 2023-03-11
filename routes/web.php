<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

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

Route::get('/', [ProductController::class,'index'])->name('index');
Route::post('/checkout/{id}', [ProductController::class,'checkOut'])->name('checkout');
Route::get('/success', [ProductController::class,'success'])->name('success');
Route::get('/cancel', [ProductController::class,'cancel'])->name('cancel');
