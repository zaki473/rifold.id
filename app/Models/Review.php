<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'product_id', 'rating', 'comment'];

    // Relasi ke User (biar ketahuan nama yang review)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}