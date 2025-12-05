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
        'mix_and_match_id',
    ];

    protected $casts = [
        'images' => 'array',
    ];

    public function mix()
{
    return $this->belongsTo(MixAndMatch::class, 'mix_and_match_id');
}
    // Tambahkan ini di dalam class Product
public function reviews()
{
    return $this->hasMany(Review::class)->latest(); // Review terbaru di atas
}
public function mixAndMatch()
{
    return $this->belongsTo(MixAndMatch::class);
}

}
