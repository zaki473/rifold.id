<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * HALAMAN UTAMA (HOME)
     * Menampilkan 5 produk di carousel (Campuran Best Seller + Dummy)
     */
    public function index()
    {
        // 1. Ambil Best Seller ASLI (Berdasarkan penjualan)
        $bestSellers = Product::select('products.*', DB::raw('SUM(order_items.quantity) as total_sold'))
            ->join('order_items', 'products.id', '=', 'order_items.product_id')
            ->join('order', 'order_items.order_id', '=', 'order.id')
            ->where('order.status', '!=', 'cancelled')
            ->groupBy('products.id')
            ->orderByDesc('total_sold')
            ->take(5)
            ->get();

        // 2. LOGIK DUMMY FILLER
        // Jika hasil best seller kurang dari 5 (misal cuma 2), kita isi sisanya dengan produk biasa
        if ($bestSellers->count() < 5) {
            // Ambil ID yang sudah ada di best seller biar ga dobel
            $existingIds = $bestSellers->pluck('id')->toArray();
            
            // Hitung butuh berapa lagi
            $needed = 5 - $bestSellers->count();

            // Ambil produk tambahan
            $fillers = Product::whereNotIn('id', $existingIds)
                ->inRandomOrder() // Atau latest() kalau mau yang terbaru
                ->take($needed)
                ->get();

            // Gabungkan: Best Seller ditaruh di depan, Filler di belakang
            $bestSellers = $bestSellers->merge($fillers);

            
        }

        return view('pages.home.home', compact('bestSellers'));
    }

    /**
     * HALAMAN FULL BEST SELLER (VIEW ALL)
     * Menampilkan semua produk urut penjualan terbanyak
     */
    public function bestseller()
    {
        // TARGET JUMLAH PRODUK AGAR GRID PENUH (Misal: 9 produk untuk grid 3x3)
        $targetCount = 9; 

        // 1. Ambil Real Best Seller (yang ada data penjualannya)
        $realBestSellers = Product::select('products.*', DB::raw('SUM(order_items.quantity) as total_sold'))
            ->join('order_items', 'products.id', '=', 'order_items.product_id')
            ->join('order', 'order_items.order_id', '=', 'order.id')
            ->where('order.status', '!=', 'cancelled')
            ->groupBy('products.id')
            ->orderByDesc('total_sold')
            ->get();

        // 2. Cek apakah jumlahnya kurang dari target?
        if ($realBestSellers->count() < $targetCount) {
            
            // Ambil ID yang sudah ada biar gak dobel
            $existingIds = $realBestSellers->pluck('id')->toArray();
            
            // Hitung kekurangannya
            $needed = $targetCount - $realBestSellers->count();

            // Ambil produk filler (Produk biasa/terbaru/random)
            $fillers = Product::whereNotIn('id', $existingIds)
                ->inRandomOrder() // Diacak biar variatif
                ->take($needed)
                ->get();

            // Gabungkan: Yang laku ditaruh paling depan, sisanya filler
            $bestSellers = $realBestSellers->merge($fillers);
        } else {
            // Kalau data penjualan sudah banyak, ambil sesuai target aja
            $bestSellers = $realBestSellers->take($targetCount);
        }

        return view('pages.home.bestseller', compact('bestSellers'));
    }
}