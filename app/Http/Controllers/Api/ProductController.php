<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(): \Illuminate\Http\JsonResponse
    {
        // Vérifier si l'utilisateur est admin (bien que le middleware admin devrait déjà gérer cela)
        if (!auth()->user()->isAdmin()) {
            return response()->json([
                'message' => 'Accès non autorisé.'
            ], 403);
        }

        $products = Product::with('category')->get();

        return response()->json([
            'products' => $products
        ]);
    }

    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        // Vérifier si l'utilisateur est admin (bien que le middleware admin devrait déjà gérer cela)
        if (!auth()->user()->isAdmin()) {
            return response()->json([
                'message' => 'Accès non autorisé.'
            ], 403);
        }

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
        ]);

        $product = Product::create($validatedData);

        return response()->json([
            'message' => 'Produit créé avec succès',
            'product' => $product
        ], 201);
    }
}
