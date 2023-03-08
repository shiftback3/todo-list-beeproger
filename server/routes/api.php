<?php

use App\Http\Controllers\TodoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// TODO's ROUTE
Route::get('todos',[TodoController::class,'index'])->name('todo.index');
Route::get('todos/{id}',[TodoController::class,'show'])->name('todo.show');
Route::post('todos',[TodoController::class,'store'])->name('todo.store');
Route::post('todos/{id}',[TodoController::class,'update'])->name('todo.update');
Route::get('todos/toggle/{id}', [TodoController::class, 'toggle_status'])->name('todo.toggle_status');
Route::put('todos/img/{id}',[TodoController::class,'update_img']);
Route::delete('todos/{id}',[TodoController::class,'destroy'])->name('todo.destroy');