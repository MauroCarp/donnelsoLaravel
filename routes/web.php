<?php

use App\Http\Controllers\HomeController;
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

Route::get('/inicio', 'HomeController@index')->name('inicio')->middleware('auth');
Route::get('/purchases', 'PurchasesController@index')->name('compras')->middleware('auth');
Route::get('/inseminations', 'InseminationsController@index')->name('inseminaciones')->middleware('auth');
Route::get('/births', 'BirthsController@index')->name('partos')->middleware('auth');
Route::get('/services', 'ServicesController@index')->name('servicios')->middleware('auth');
Route::get('/health', 'HealthController@index')->name('sanidad')->middleware('auth');
Route::get('/deads', 'DeadsController@index')->name('muertes')->middleware('auth');
Route::get('/preSales', 'SalesController@preSale')->name('pre-ventas')->middleware('auth');
Route::get('/sales', 'SalesController@sale')->name('ventas')->middleware('auth');
Route::get('/costs', 'SalesController@costs')->name('costos')->middleware('auth');