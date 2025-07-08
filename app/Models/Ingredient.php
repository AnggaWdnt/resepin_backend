<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    use HasFactory;

    protected $fillable = [
        'recipe_id',
        'name',
        'quantity',
        'unit',
    ];

    // Relasi: Ingredient dimiliki oleh satu resep
    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }
}