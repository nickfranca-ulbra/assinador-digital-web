<?php

use App\Http\Controllers\AssinaturaController;
use App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Http\Controllers\LogVerificacaoController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', fn() => redirect()->route('register'));


Route::get('/login', [Auth::class, 'showLoginForm'])->name('login');
Route::post('/login', [Auth::class, 'login'])->name('login.store');
Route::post('/logout', [Auth::class, 'logout'])->name('logout');
// Cadastro
Route::get('/register', [UserController::class, 'user'])->name('register');
Route::post('/register', [UserController::class, 'store'])->name('register.store');

Route::middleware(['auth'])->group(function () {
    // Assinar
    Route::get('/sign', [AssinaturaController::class, 'assinatura'])->name('sign');
    Route::post('/sign', [AssinaturaController::class, 'store'])->name('sign.store');
});

// Verificar
Route::get('/verify', [LogVerificacaoController::class, 'log_verificacao'])->name('verify');
Route::post('/verify', [LogVerificacaoController::class, 'log_verificacao'])->name('verify.check');
