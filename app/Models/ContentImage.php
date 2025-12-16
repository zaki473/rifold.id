<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContentImage extends Model
{
    // Karena nama tabel 'content_images' (jamak) dan model 'ContentImage' (tunggal),
    // Laravel otomatis tahu. Tidak perlu protected $table.

    protected $fillable = [
        'name',
        'image_path',
    ];
}