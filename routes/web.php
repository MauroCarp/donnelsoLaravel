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


Auth::routes();

// Route::get('/offline',function(){
//     return view('layouts/vendor/laravelpwa/offline');
// });

Route::get('/', [App\Http\Controllers\HomeController::class, 'inicio'])->name('inicio')->middleware('auth');
Route::get('/costs', [App\Http\Controllers\SaleController::class, 'costs'])->name('costos')->middleware('auth');
Route::get('/inicio', [App\Http\Controllers\HomeController::class, 'inicio'])->name('inicio')->middleware('auth');
Route::post('/deaths/getAnimals', [App\Http\Controllers\DeadController::class, 'getAnimals'])->name('getAnimals')->middleware('auth');
Route::resource('/deaths', 'App\Http\Controllers\DeadController')->middleware('auth');

Route::post('/inseminations/getFemales', [App\Http\Controllers\InseminationController::class, 'getFemales'])->name('inseminaciones.hembras')->middleware('auth');
Route::resource('/inseminations', 'App\Http\Controllers\InseminationController')->middleware('auth');


Route::post('/services/changeState', [App\Http\Controllers\ServiceController::class, 'changeState'])->name('servicios.cambiarEstado')->middleware('auth');
Route::post('/services/reproductiveMales', [App\Http\Controllers\ServiceController::class, 'reproductiveMales'])->name('servicios.machosReproductores')->middleware('auth');
Route::post('/services/sentToService', [App\Http\Controllers\ServiceController::class, 'sentToService'])->name('servicios.enviarAServicio')->middleware('auth');

Route::resource('/services', 'App\Http\Controllers\ServiceController')->middleware('auth');
Route::resource('/events', 'App\Http\Controllers\EventController')->middleware('auth');
Route::resource('/purchases', 'App\Http\Controllers\PurchaseController')->middleware('auth');
Route::post('/births/updateBirth', [App\Http\Controllers\BirthController::class, 'updateBirth'])->middleware('auth');
Route::resource('/births', 'App\Http\Controllers\BirthController')->middleware('auth');
Route::resource('/health', 'App\Http\Controllers\HealthController')->middleware('auth');

Route::post('/sales/getDetails', [App\Http\Controllers\SaleController::class, 'getDetails'])->middleware('auth');
Route::post('/sales/finalize', [App\Http\Controllers\SaleController::class, 'finalize'])->middleware('auth');
Route::resource('/sales', 'App\Http\Controllers\SaleController')->middleware('auth');
Route::post('/costs/getCosts', [App\Http\Controllers\CostController::class, 'getCosts'])->middleware('auth');
Route::resource('/costs', 'App\Http\Controllers\CostController')->middleware('auth');

Route::post('/animals/import', [App\Http\Controllers\AnimalController::class, 'import'])->middleware('auth');
Route::resource('/animals', 'App\Http\Controllers\AnimalController')->middleware('auth');
Route::resource('/bills', 'App\Http\Controllers\BillController')->middleware('auth');


