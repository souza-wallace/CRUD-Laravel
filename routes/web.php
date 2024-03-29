<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\HomeController;

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

// Route::get('/clients', [ClientController::class, 'index'])->name('clients.index');
// Route::get('/clients/create', [ClientController::class, 'create'])->name('clients.create');
// Route::post('/clients', [ClientController::class, 'store'])->name('clients.store');
// Route::get('/clients/{client}', [ClientController::class, 'show'])->name('clients.show');
// Route::post('/clients/{client}/edit', [ClientController::class, 'edit'])->name('clients.edit');
// Route::put('/clients/{client}', [ClientController::class, 'update'])->name('clients.update');
// Route::delete('/clients/{client}', [ClientController::class, 'destroy'])->name('clients.destroy');
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::resource('/clients', ClientController::class);


