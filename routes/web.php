<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TasksController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //lists routes
    Route::get('/tasks',[TasksController::class, 'index'])->name('Tasks.index');
    Route::get('/tasks/create', [TasksController::class,'store'])->name('Tasks.create');
    Route::post('tasks/create', [TasksController::class , 'store'])->name('Tasks.store');
    Route::get('/lists/show/{list:id}', [TasksController::class, 'show'])->name('lists.show');
    Route::get('/lists/edit/{list:id}', [TasksController::class, 'edit'])->name('lists.edit');
    Route::patch('/lists/update/{list:id}', [TasksController::class, 'update'])->name('lists.update');
    Route::delete('/lists/delete/{list:id}', [TasksController::class, 'destroy'])->name('lists.destroy');
});

require __DIR__.'/auth.php';
