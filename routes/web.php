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

Route::get('/costs', [App\Http\Controllers\SaleController::class, 'costs'])->name('costos')->middleware('auth');
Route::get('/inicio', [App\Http\Controllers\HomeController::class, 'inicio'])->name('inicio')->middleware('auth');
Route::get('/deads', [App\Http\Controllers\DeadController::class, 'index'])->name('muertes')->middleware('auth');
Route::get('/births', [App\Http\Controllers\BirthController::class, 'index'])->name('partos')->middleware('auth');
Route::get('/health', [App\Http\Controllers\HealthController::class, 'index'])->name('sanidad')->middleware('auth');

Route::get('/sales', [App\Http\Controllers\SaleController::class, 'sales'])->name('ventas')->middleware('auth');
Route::get('/preSales', [App\Http\Controllers\SaleController::class, 'preSales'])->name('preVentas')->middleware('auth');

Route::get('/purchases', [App\Http\Controllers\PurchaseController::class, 'index'])->name('compras')->middleware('auth');
Route::get('/services', [App\Http\Controllers\ServiceController::class, 'index'])->name('servicios')->middleware('auth');
Route::get('/inseminations', [App\Http\Controllers\InseminationController::class, 'index'])->name('inseminaciones')->middleware('auth');

Route::get('/events/show', [App\Http\Controllers\EventController::class, 'show'])->name('eventos.mostrar')->middleware('auth');

Route::resource('/events', 'App\Http\Controllers\EventController');

