<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ClienteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PedidosController;

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
});


// Rota para listar os clientes da confecção
Route::middleware('auth')->group(function () {
    Route::get('/clientes', [ClienteController::class, 'index'])->name('clientes.index');
    Route::get('/clientes/create', [ClienteController::class, 'create'])->name('clientes.create');
    Route::post('/clientes', [ClienteController::class, 'store'])->name('clientes.store');
    Route::get('/clientes/{id}/edit', [ClienteController::class, 'edit'])->name('clientes.edit');
    Route::put('/clientes/{id}', [ClienteController::class, 'update'])->name('clientes.update');
    Route::delete('/clientes/{id}', [ClienteController::class, 'destroy'])->name('clientes.destroy');
    
});

// Rota para listar os pedidos da confecção
Route::middleware('auth')->group(function () {
    Route::get('/pedidos', [PedidosController::class, 'index'])->name('pedidos.index');
    Route::get('/pedidos/create', [PedidosController::class, 'create'])->name('pedidos.create');
    Route::post('/pedidos', [PedidosController::class, 'store'])->name('pedidos.store');
    Route::get('/pedidos/{id}/edit', [PedidosController::class, 'edit'])->name('pedidos.edit');
    Route::put('/pedidos/{id}', [PedidosController::class, 'update'])->name('pedidos.update');
    Route::delete('/pedidos/{id}', [PedidosController::class, 'destroy'])->name('pedidos.destroy');
    
});




require __DIR__.'/auth.php';
