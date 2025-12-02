<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'category',
        'price',
        'size',
        'stock',
        'color',
        'description',
        'images',
    ];

    protected $casts = [
        'images' => 'array',
    ];
    // Tambahkan ini di dalam class Product
public function reviews()
{
    return $this->hasMany(Review::class)->latest(); // Review terbaru di atas
}
}
