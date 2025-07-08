<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'item_name',
        'portion',
        'calories_per_portion',
        'total_calories',
        'log_date',
    ];

    // Relasi: FoodLog dimiliki oleh satu user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi: FoodLog bisa memiliki satu kategori
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}