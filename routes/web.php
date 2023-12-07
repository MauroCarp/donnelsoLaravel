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
Route::get('/health', [App\Http\Controllers\HealthController::class, 'index'])->name('sanidad')->middleware('auth');

Route::get('/sales', [App\Http\Controllers\SaleController::class, 'sales'])->name('ventas')->middleware('auth');
Route::get('/preSales', [App\Http\Controllers\SaleController::class, 'preSales'])->name('preVentas')->middleware('auth');


Route::post('/inseminations/getFemales', [App\Http\Controllers\InseminationController::class, 'getFemales'])->name('inseminaciones.hembras')->middleware('auth');
Route::resource('/inseminations', 'App\Http\Controllers\InseminationController')->middleware('auth');


Route::post('/services/changeState', [App\Http\Controllers\ServiceController::class, 'changeState'])->name('servicios.cambiarEstado')->middleware('auth');
Route::post('/services/reproductiveMales', [App\Http\Controllers\ServiceController::class, 'reproductiveMales'])->name('servicios.machosReproductores')->middleware('auth');

Route::resource('/services', 'App\Http\Controllers\ServiceController')->middleware('auth');
Route::resource('/events', 'App\Http\Controllers\EventController')->middleware('auth');
Route::resource('/purchases', 'App\Http\Controllers\PurchaseController')->middleware('auth');
Route::resource('/births', 'App\Http\Controllers\BirthController')->middleware('auth');


