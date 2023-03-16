<?php

use App\Http\Controllers\CodigocompuController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ValidarCodigo;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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
})->middleware(['auth', 'verified', 'verificar'])->name('dashboard');

Route::get('/VerificarCodigo', function () {
  return view('ingresarcodigo');
})->name('VerificarCodigo');

Route::post('/codigoweb', [CodigocompuController::class, 'GenCoCompu'])->name('codigoweb');

Route::get('/codigo', [ValidarCodigo::class, 'SignedRoute'])->name('codigo');





Route::middleware('auth','verificar')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
