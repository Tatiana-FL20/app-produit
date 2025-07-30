<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ExportController extends Controller
{
    public function exportProductsCSV(): \Symfony\Component\HttpFoundation\StreamedResponse
    {
        // Récupération des produits avec leurs catégories
        $products = Product::with('category')->get();

        // Nom du fichier
        $filename = 'produits-' . date('Y-m-d-His') . '.csv';

        // En-têtes pour le fichier CSV
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0'
        ];

        // Création du callback pour générer le contenu CSV
        $callback = function() use ($products) {
            $file = fopen('php://output', 'w');

            // En-têtes CSV (première ligne)
            fputcsv($file, [
                'ID',
                'Nom',
                'Slug',
                'Description',
                'Prix',
                'Stock',
                'Catégorie'
            ]);

            // Lignes de données
            foreach ($products as $product) {
                fputcsv($file, [
                    $product->id,
                    $product->name,
                    $product->slug,
                    $product->description,
                    $product->price,
                    $product->stock_quantity,
                    $product->category->name
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
