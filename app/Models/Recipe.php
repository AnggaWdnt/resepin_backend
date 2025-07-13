<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;

    protected $table = 'recipes';

    protected $fillable = [
        'judul',
        'deskripsi',
        'bahan',
        'langkah_langkah',
        'user_id',
    ];

    protected $casts = [
        'bahan' => 'array',
        'langkah_langkah' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
