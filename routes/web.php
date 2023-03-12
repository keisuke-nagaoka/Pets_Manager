<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\PetsController;
use App\Http\Controllers\ManagementsController;

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
    return view('dashboard');
});
//Route::get('/', [ManagementsController::class, 'index']);

Route::get('/dashboard', function () {
    return view('dashboard');
});
//Route::get('/dashboard', [ManagementsController::class, 'index'])->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::group(['middleware' => ['auth']], function () {
    Route::group(['prefix' => 'users/{id}'], function() {
        Route::get('pets', [PetsController::class, 'index'])->name('pets.index');
        Route::post('create', [PetsController::class, 'store'])->name('pets.store');
        Route::delete('destroy', [PetsController::class, 'destroy'])->name('pets.destroy');
    });
    
    Route::group(['prefix' => 'pets/{id}'], function () {
        Route::get('managements', [ManagementsController::class, 'managements'])->name('managements.managements');
        Route::get('create', [ManagementsController::class, 'create'])->name('managements.create');
        Route::post('create', [ManagementsController::class, 'store'])->name('managements.store');
    });
    
    Route::resource('users', UsersController::class);
    Route::resource('pets', PetsController::class, [ 'only' => ['create', 'show', 'edit', 'update']]);
    Route::resource('managements', ManagementsController::class, ['only' => ['show', 'edit', 'update', 'destroy']]);
});