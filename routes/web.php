<?php

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

Route::get('/', [App\Http\Controllers\IndexController::class, 'index'])->name('index');
Route::post('/submit_register',[App\Http\Controllers\IndexController::class, 'submit_register'])->name('submit_register');
Route::get('/get_services',[App\Http\Controllers\IndexController::class, 'getServices']);



Auth::routes();

Route::get('/admin', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/delete_registrant', [App\Http\Controllers\HomeController::class, 'deleteRegistrants'])->name('delete_registrant');


Route::get('/ibadah', [App\Http\Controllers\HomeController::class, 'ibadah'])->name('ibadah');
Route::post('/submit_service', [App\Http\Controllers\HomeController::class, 'submit_service'])->name('submit_service');
Route::post('/edit_service', [App\Http\Controllers\HomeController::class, 'edit_service'])->name('edit_service');
Route::get('/delete_service/{id}', [App\Http\Controllers\HomeController::class, 'delete_service'])->name('delete_service');


Route::get('/admins', [App\Http\Controllers\HomeController::class, 'admins'])->name('admins');
Route::post('/submit_admins', [App\Http\Controllers\HomeController::class, 'submit_admins'])->name('submit_admins');
Route::post('/edit_admins', [App\Http\Controllers\HomeController::class, 'edit_admins'])->name('edit_admins');
Route::get('/delete_admins/{id}', [App\Http\Controllers\HomeController::class, 'delete_admins'])->name('delete_admins');


