<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Menampilkan Keranjang
    public function index()
    {
       
    // Ambil data keranjang milik user yang sedang login
    $cartItems = Cart::with('product')->where('user_id', Auth::id())->get();
    
    // Hitung Total
    $totalPrice = 0;
    foreach($cartItems as $item) {
        $totalPrice += $item->product->price * $item->quantity;
    }

    // Kirim variabel $cartItems dan $totalPrice ke View
    return view('pages.checkout.cart', compact('cartItems', 'totalPrice'));
    }

    // Menambah Barang ke Keranjang
    public function store(Request $request)
    {
        if(!Auth::check()) {
            return redirect()->route('login');
        }

        $request->validate([
            'product_id' => 'required',
            'size' => 'required',
            'quantity' => 'required|integer|min:1'
        ]);

        // Cek apakah barang dengan size yang sama sudah ada di cart?
        $existingCart = Cart::where('user_id', Auth::id())
                            ->where('product_id', $request->product_id)
                            ->where('size', $request->size)
                            ->first();

        if($existingCart) {
            // Kalau ada, update jumlahnya saja
            $existingCart->increment('quantity', $request->quantity);
        } else {
            // Kalau belum, buat baru
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $request->product_id,
                'size' => $request->size,
                'quantity' => $request->quantity
            ]);
        }

        // Redirect balik dengan pesan sukses (agar popup muncul)
        return redirect()->back()->with('success_add_to_cart', true);
    }

    // Update Jumlah (Tombol +/- di Cart)
    public function update(Request $request, $id)
    {
        $cart = Cart::where('user_id', Auth::id())->findOrFail($id);
        
        if($request->type === 'increase') {
            $cart->increment('quantity');
        } elseif($request->type === 'decrease' && $cart->quantity > 1) {
            $cart->decrement('quantity');
        }

        return redirect()->back();
    }

    // Hapus Barang
    public function destroy($id)
    {
        $cart = Cart::where('user_id', Auth::id())->findOrFail($id);
        $cart->delete();

        return redirect()->back()->with('success', 'Item removed');
    }
}