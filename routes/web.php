<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ExportController;

// Routes publiques
Route::get('/', [ProductController::class, 'index'])->name('home');
Route::get('/produits/{slug}', [ProductController::class, 'show'])->name('products.show');
Route::get('/categories/{id}', [ProductController::class, 'byCategory'])->name('products.by.category');

// Routes nécessitant une authentification
Route::middleware(['auth'])->group(function () {
    // Routes pour admin uniquement
    Route::prefix('admin')->middleware(['admin'])->group(function () {
        // Gestion des catégories
        Route::get('/categories', [CategoryController::class, 'index'])->name('admin.categories.index');
        Route::get('/categories/create', [CategoryController::class, 'create'])->name('admin.categories.create');
        Route::post('/categories', [CategoryController::class, 'store'])->name('admin.categories.store');
        Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('admin.categories.edit');
        Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('admin.categories.update');
        Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');

        // Gestion des produits
        Route::get('/produits', [ProductController::class, 'index'])->name('admin.products.index');
        Route::get('/produits/create', [ProductController::class, 'create'])->name('admin.products.create');
        Route::post('/produits', [ProductController::class, 'store'])->name('admin.products.store');
        Route::get('/produits/{product}/edit', [ProductController::class, 'edit'])->name('admin.products.edit');
        Route::put('/produits/{product}', [ProductController::class, 'update'])->name('admin.products.update');
        Route::delete('/produits/{product}', [ProductController::class, 'destroy'])->name('admin.products.destroy');

        // Export CSV (fonctionnalité bonus)
        Route::get('/produits/export-csv', [ExportController::class, 'exportProductsCSV'])->name('admin.products.export.csv');
    });
});

require __DIR__.'/auth.php';
