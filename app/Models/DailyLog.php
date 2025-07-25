<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'food_id',    
        'food_name',   
        'portion',
        'kalori',
        'photo',
        'date'
    ];

    public function user()
{
    return $this->belongsTo(User::class);
}


    public function food()
    {
        return $this->belongsTo(Food::class);
    }
}
