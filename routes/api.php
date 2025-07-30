<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;

// Routes publiques pour l'authentification
Route::post('/login', [AuthController::class, 'login']);

// Routes protégées par Sanctum
Route::middleware('auth:sanctum')->group(function () {
    // Déconnexion
    Route::post('/logout', [AuthController::class, 'logout']);

    // Routes API pour les produits (admin uniquement)
    Route::middleware('admin')->group(function () {
        Route::get('/admin/produits', [ProductController::class, 'index']);
        Route::post('/produits/create', [ProductController::class, 'store']);
    });
});
