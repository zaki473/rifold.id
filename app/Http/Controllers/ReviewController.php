<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ReviewController extends Controller
{
    public function store(Request $request)
    {
        // 1. Cek apakah user sudah login
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to write a review.');
        }

        // 2. Validasi input
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:500',
        ]);

        // 3. Simpan ke database
        Review::create([
            'user_id' => Auth::id(),
            'product_id' => $request->product_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return redirect()->route('detail', $request->product_id)
            ->with('success', 'Review published successfully!');
    }

    public function create($id)
    {
        // Ambil data produk berdasarkan ID agar fotonya muncul di form review
        $product = Product::findOrFail($id);

        // Tampilkan halaman review yang baru kita buat
        return view('pages.katalog.review', compact('product'));
    }
}