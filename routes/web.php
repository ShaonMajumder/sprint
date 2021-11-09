<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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
Route::get('/links', [App\Http\Controllers\LinkController::class, 'index'])->name('links');
//Route::get('demos/sortabledatatable','DemoController@showDatatable');
Route::post('links/sortabledatatable', [App\Http\Controllers\LinkController::class, 'updateItems'])->name('links_update');


//Route::get('/', 'ItemController@itemView');
Route::post('/update-items', [App\Http\Controllers\UserController::class, 'updateItems'])->name('update.items');

