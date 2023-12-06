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


// Route::get('/inseminations', [App\Http\Controllers\InseminationController::class, 'index'])->name('inseminaciones.index')->middleware('auth');
// Route::post('/inseminations', [App\Http\Controllers\InseminationController::class, 'store'])->name('inseminaciones.store')->middleware('auth');
// Route::post('/inseminations/{id}', [App\Http\Controllers\InseminationController::class, 'delete'])->name('inseminaciones.delete')->middleware('auth');
Route::post('/inseminations/getFemales', [App\Http\Controllers\InseminationController::class, 'getFemales'])->name('inseminaciones.hembras')->middleware('auth');
Route::resource('/inseminations', 'App\Http\Controllers\InseminationController');


Route::post('/services/changeState', [App\Http\Controllers\ServiceController::class, 'changeState'])->name('servicios.cambiarEstado')->middleware('auth');
Route::post('/services/reproductiveMales', [App\Http\Controllers\ServiceController::class, 'reproductiveMales'])->name('servicios.machosReproductores')->middleware('auth');

Route::resource('/services', 'App\Http\Controllers\ServiceController');
Route::resource('/events', 'App\Http\Controllers\EventController');
Route::resource('/purchases', 'App\Http\Controllers\PurchaseController');

