<?php

use App\Http\Controllers\AssinaturaController;
use App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Http\Controllers\LogVerificacaoController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', fn() => redirect()->route('login'));

Route::get('/login', [Auth::class, 'showLoginForm'])->name('login');
Route::post('/login', [Auth::class, 'login'])->name('login.store');
Route::get('/logout', [Auth::class, 'logout'])->name('logout');
Route::get('/register', [UserController::class, 'user'])->name('register');
Route::post('/register', [UserController::class, 'store'])->name('register.store');
Route::get('/verify', [LogVerificacaoController::class, 'log_verificacao'])->name('verify');
Route::post('/verify-id', [LogVerificacaoController::class, 'verifyById'])->name('verify.id');
Route::post('/verify-text', [LogVerificacaoController::class, 'verifyByText'])->name('verify.text');

Route::middleware(['auth'])->group(function () {
    // Assinar
    Route::get('/sign', [AssinaturaController::class, 'assinatura'])->name('sign');
    Route::post('/sign', [AssinaturaController::class, 'store'])->name('sign.store');
    Route::get('/my-signatures', [AssinaturaController::class, 'mySignatures'])->name('my.signatures');
    Route::get('/my-public-key', [UserController::class, 'downloadPublicKey'])->name('my.publickey');

});


