<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Électronique'],
            ['name' => 'Vêtements'],
            ['name' => 'Maison & Jardin'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
