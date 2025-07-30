<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'stock_quantity',
        'category_id'
    ];

    // Générateur de slug automatique avec vérification d'unicité
    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($product) {
            if (!$product->slug) {
                $product->slug = Str::slug($product->name);

                // Vérifier si le slug existe déjà
                $count = 0;
                $originalSlug = $product->slug;
                while (static::whereSlug($product->slug)->exists()) {
                    $count++;
                    // Si c'est au-delà d'une première itération, ajouter un nombre aléatoire
                    if ($count > 1) {
                        $randomNumber = rand(100, 999);
                        $product->slug = $originalSlug . '-' . $randomNumber;
                    } else {
                        $product->slug = $originalSlug . '-' . $count;
                    }
                }
            }
        });
    }

    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
