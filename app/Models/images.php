<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class images extends Model
{
    protected $table = 'images_thumbnail';

    protected $fillable = [
        'name',
        'images_path',
    ];
}
