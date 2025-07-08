<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
    ];

    // Relasi: Banyak kategori bisa dimiliki oleh banyak resep (Many-to-Many)
    public function recipes()
    {
        return $this->belongsToMany(Recipe::class, 'recipe_categories');
    }

    // Relasi: Satu kategori bisa dimiliki oleh banyak food logs
    public function foodLogs()
    {
        return $this->hasMany(FoodLog::class);
    }
}