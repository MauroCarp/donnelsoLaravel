<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', [App\Http\Controllers\HomeController::class, 'inicio'])->name('inicio')->middleware('auth');

Auth::routes();

Route::get('/costs', [App\Http\Controllers\SalesController::class, 'costs'])->name('costos')->middleware('auth');
Route::get('/inicio', [App\Http\Controllers\HomeController::class, 'inicio'])->name('inicio')->middleware('auth');
Route::get('/deads', [App\Http\Controllers\DeadsController::class, 'index'])->name('muertes')->middleware('auth');
Route::get('/births', [App\Http\Controllers\BirthsController::class, 'index'])->name('partos')->middleware('auth');
Route::get('/health', [App\Http\Controllers\HealthController::class, 'index'])->name('sanidad')->middleware('auth');

Route::get('/sales', [App\Http\Controllers\SalesController::class, 'sales'])->name('ventas')->middleware('auth');
Route::get('/preSales', [App\Http\Controllers\SalesController::class, 'preSales'])->name('preVentas')->middleware('auth');

Route::get('/purchases', [App\Http\Controllers\PurchasesController::class, 'index'])->name('compras')->middleware('auth');
Route::get('/services', [App\Http\Controllers\ServicesController::class, 'index'])->name('servicios')->middleware('auth');
Route::get('/inseminations', [App\Http\Controllers\InseminationsController::class, 'index'])->name('inseminaciones')->middleware('auth');