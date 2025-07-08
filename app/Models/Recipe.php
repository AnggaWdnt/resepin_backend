<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'cooking_time',
        'servings',
        'status',
        'image_url',
    ];

    // Relasi: Resep dimiliki oleh satu user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi: Resep memiliki banyak bahan
    public function ingredients()
    {
        return $this->hasMany(Ingredient::class);
    }

    // Relasi: Resep memiliki banyak langkah-langkah
    public function steps()
    {
        return $this->hasMany(Step::class);
    }

    // Relasi: Resep bisa memiliki banyak kategori (Many-to-Many)
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'recipe_categories');
    }
}