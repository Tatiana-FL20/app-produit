<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'iPhone 12 Noir',
                'description' => 'Smartphone Apple avec écran 6.1 pouces, 128GB de stockage.',
                'price' => 799.99,
                'stock_quantity' => 50,
                'category_id' => 1,
            ],
            [
                'name' => 'T-shirt Bleu',
                'description' => 'T-shirt en coton 100%, taille M.',
                'price' => 19.99,
                'stock_quantity' => 100,
                'category_id' => 2,
            ],
            [
                'name' => 'Lampe de Bureau LED',
                'description' => 'Lampe de bureau avec contrôle de luminosité et port USB.',
                'price' => 45.50,
                'stock_quantity' => 30,
                'category_id' => 3,
            ],
            [
                'name' => 'Écouteurs Bluetooth',
                'description' => 'Écouteurs sans fil avec réduction de bruit active.',
                'price' => 129.99,
                'stock_quantity' => 75,
                'category_id' => 1,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
