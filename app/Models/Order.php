<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    // --- AKTIFKAN BARIS INI LAGI ---
    // Karena tabel di databasemu bernama 'order' (tunggal), bukan 'orders'.
    protected $table = 'order'; 

    protected $fillable = [
        'user_id',
        'order_number',
        'customer_name',
        'email',
        'phone',
        'address',
        'shipping_method',
        'shipping_cost',
        'payment_method',
        'payment_proof',
        'payment_status',
        'subtotal',
        'total_price',
        'status'
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}