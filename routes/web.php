<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SprintController;
use App\Http\Controllers\ProjectController;
use App\Models\Category;

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

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/users', [UserController::class, 'index'])->name('user.index');
Route::get('/tasks', [SprintController::class, 'index'])->name('task.index');
Route::get('/projects', [ProjectController::class, 'index'])->name('project.index');

Route::post('sprint/sortabledatatable', [SprintController::class, 'updatePosition'])->name('links_update');
Route::post('sprint/getCategories', [SprintController::class, 'getCategories'])->name('getCategories');

Route::post('sprint/newtask', [SprintController::class, 'store'])->name('new_task');
Route::post('sprint/newCategory', [CategoryController::class, 'store'])->name('new_category');