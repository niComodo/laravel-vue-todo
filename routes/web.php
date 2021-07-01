<?php

use App\Http\Controllers\TodoController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/todo-list', [TodoController::class, 'index'])->name('todo');
Route::post('/todo-list', [TodoController::class, 'store'])->name('todo.store');
Route::patch('/todo-list/{id}', [TodoController::class, 'update'])->name('todo.update');
Route::delete('/todo-list/{id}', [TodoController::class, 'delete'])->name('todo.delete');
