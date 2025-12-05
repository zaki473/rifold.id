<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Factories\HasFactory;

class MixAndMatch extends Model
{
    use HasFactory;
    protected $table = 'mix_and_matches';

    protected $fillable = [
        'name',
        'images_path',
    ];

    public function products()
{
    return $this->hasMany(Product::class);
}

}
