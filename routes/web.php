<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SprintController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('users');
Route::get('/tasks', [App\Http\Controllers\SprintController::class, 'index'])->name('sprint');


Route::post('sprint/sortabledatatable', [App\Http\Controllers\SprintController::class, 'updateItems'])->name('links_update');
//Route::post('sprint/categoryUpdate', [App\Http\Controllers\SprintController::class, 'updateCategory'])->name('links_update2');
Route::get('sprint/populate', [App\Http\Controllers\SprintController::class, 'populateRow'])->name('links_update3');




