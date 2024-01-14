<?php

use App\Http\Controllers\ProductController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

/*
 task Routes
*/
Route::get('/', [\App\Http\Controllers\Web\TaskController::class, 'index'])->name('tasks');
Route::name('task')->group(function () {
    Route::post('/task/store', [\App\Http\Controllers\Web\TaskController::class, 'store'])->name('.store');
    Route::PATCH('/task/update/{id}', [\App\Http\Controllers\Web\TaskController::class, 'update'])->name('.update');
    Route::delete('/task/delete/{id}', [\App\Http\Controllers\Web\TaskController::class, 'destroy'])->name('.delete');
});
