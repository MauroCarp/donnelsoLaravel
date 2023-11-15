<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', function() {    return view('home'); })->name('home')->middleware('auth');
Route::post('/home/uploadStudents', 'App\Http\Controllers\StudentsController@excelImport')->name('students.upload');
Route::post('/home/uploadPagos', 'App\Http\Controllers\StudentsController@importarPagos')->name('students.uploadPagos');

Route::get('/home/validateData', 'App\Http\Controllers\StudentsController@validateData')->name('students.validateData');
Route::post('/home/update', 'App\Http\Controllers\StudentsController@update')->name('students.update');


