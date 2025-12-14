<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    // --- CEK DATABASE KAMU ---
    // Jika nama tabel di database 'order_item' (tunggal), AKTIFKAN baris ini:
    // protected $table = 'order_item'; 
    
    // Jika nama tabelnya 'order_items' (jamak), biarkan default (komentar/hapus baris di atas).

    protected $fillable = [
    'order_id', 
    'product_id', 
    'quantity', // Pastikan namanya 'quantity', bukan 'qty'
    'price', 
    'subtotal'
];

    // Relasi ke Product (WAJIB ADA)
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    // Relasi ke Order
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}