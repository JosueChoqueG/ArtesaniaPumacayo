<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

// ─────────────────────────────────────
// RUTA DE INICIO
// ─────────────────────────────────────
Route::get('/', function () {
    return view('welcome');
});

// ─────────────────────────────────────
// CARRITO DE COMPRAS (Público)
// ─────────────────────────────────────
Route::prefix('cart')->name('cart.')->group(function () {
    Route::get('/', [App\Http\Controllers\CartController::class, 'index'])->name('index');
    Route::post('/', [App\Http\Controllers\CartController::class, 'store'])->name('store');
    Route::put('/{product}', [App\Http\Controllers\CartController::class, 'update'])->name('update');
    Route::delete('/{product}', [App\Http\Controllers\CartController::class, 'destroy'])->name('destroy');
    Route::post('/clear', [App\Http\Controllers\CartController::class, 'clear'])->name('clear');
    Route::get('/checkout', [App\Http\Controllers\CartController::class, 'checkout'])->name('checkout');
    Route::post('/checkout', [App\Http\Controllers\CartController::class, 'processCheckout'])->name('checkout.process');
});

// ─────────────────────────────────────
// CATÁLOGO PÚBLICO
// ─────────────────────────────────────
Route::get('/catalogo', [App\Http\Controllers\CatalogController::class, 'index'])->name('catalog');
Route::get('/producto/{product:slug}', [App\Http\Controllers\CatalogController::class, 'show'])->name('product.show');

// ─────────────────────────────────────
// RUTAS DE AUTENTICACIÓN (auth.php)
// ─────────────────────────────────────
require __DIR__.'/auth.php';

// ─────────────────────────────────────
// RUTAS PROTEGIDAS (AUTH)
// ─────────────────────────────────────
Route::middleware(['auth'])->group(function () {
    
    // Dashboard (Redirección por defecto tras login)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Perfil de Usuario
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ─────────────────────────────────────
    // RUTAS DE ADMINISTRACIÓN
    // ─────────────────────────────────────
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        // Dashboard Admin
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        // Productos
        Route::resource('products', ProductController::class);
        
        // Usuarios
        Route::post('users/{user}/role', [UserController::class, 'updateRole'])->name('users.role');
        Route::post('users/{user}/toggle', [UserController::class, 'toggleStatus'])->name('users.toggle');
        Route::resource('users', UserController::class);
    });
});