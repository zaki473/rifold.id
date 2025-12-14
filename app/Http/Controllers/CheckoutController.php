<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CheckoutController extends Controller
{
    // ===============================
    // STEP 1 - INFORMATION (Logic Pilih Item)
    // ===============================
    public function index(Request $request)
    {
        $user = Auth::user();

        // 1. Tangkap ID item dari URL (dikirim oleh Javascript di cart.blade.php)
        // URL contoh: /checkout?items=1,5,8
        if ($request->has('items')) {
            $selectedIds = explode(',', $request->items);
            session(['checkout.cart_ids' => $selectedIds]); // Simpan ke session
        }

        // 2. Ambil ID dari session
        $selectedIds = session('checkout.cart_ids', []);

        if (empty($selectedIds)) {
            return redirect()->route('cart')->with('error', 'Tidak ada item yang dipilih.');
        }

        // 3. Ambil data cart BERDASARKAN ID YANG DIPILIH SAJA
        $cartItems = Cart::with('product')
            ->where('user_id', $user->id)
            ->whereIn('id', $selectedIds) // <--- FILTER PENTING
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart')->with('error', 'Item tidak ditemukan.');
        }

        $subtotal = 0;
        foreach ($cartItems as $item) {
            $subtotal += $item->product->price * $item->quantity;
        }

        return view('pages.checkout.checkout', compact('cartItems', 'subtotal'));
    }

    public function saveInformation(Request $request)
    {
        $request->validate([
            'nama'    => 'required',
            'alamat'  => 'required',
            'telepon' => 'required'
        ]);

        session([
            'checkout.nama'    => $request->nama,
            'checkout.alamat'  => $request->alamat,
            'checkout.telepon' => $request->telepon,
        ]);

        return redirect()->route('checkout.shipping.view');
    }

    // ===============================
    // STEP 2 - SHIPPING VIEW
    // ===============================
    public function shipping()
    {
        if (
            !session('checkout.nama') ||
            !session('checkout.alamat') ||
            !session('checkout.telepon')
        ) {
            return redirect()->route('checkout.index')
                ->with('error', 'Silakan lengkapi data terlebih dahulu.');
        }

        // Ambil ID dari session
        $selectedIds = session('checkout.cart_ids', []);

        // Filter Cart berdasarkan ID yang dipilih
        $cartItems = Cart::where('user_id', Auth::id())
            ->whereIn('id', $selectedIds) // <--- FILTER PENTING
            ->with('product')
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart')
                ->with('error', 'Keranjang kosong atau sesi habis.');
        }

        $subtotal = $cartItems->sum(fn ($item) =>
            $item->product->price * $item->quantity
        );

        return view('pages.checkout.shipping', compact('cartItems', 'subtotal'));
    }

    // ===============================
    // STEP 2 - STORE SHIPPING & CREATE ORDER (LOGIC UTAMA)
    // ===============================
    public function storeShipping(Request $request)
    {
        $request->validate([
            'pengiriman'    => 'required',
            'shipping_cost' => 'required|numeric'
        ]);

        $nama     = session('checkout.nama');
        $alamat   = session('checkout.alamat');
        $telepon  = session('checkout.telepon');
        $ongkir   = $request->shipping_cost;
        session(['checkout.ongkir' => $ongkir]);

        // Ambil ID dari session
        $selectedIds = session('checkout.cart_ids', []);

        if (!$nama || !$alamat || !$telepon || !$ongkir) {
            return redirect()->route('checkout.shipping.view')
                ->with('error', 'Data pengiriman belum lengkap.');
        }

        // Filter Cart berdasarkan ID yang dipilih
        $cartItems = Cart::where('user_id', Auth::id())
            ->whereIn('id', $selectedIds) // <--- FILTER PENTING
            ->with('product')
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart')->with('error', 'Keranjang kosong.');
        }

        $subtotal = $cartItems->sum(fn ($item) =>
            $item->product->price * $item->quantity
        );

        $total = $subtotal + $ongkir;

        // ✅ 1. SIMPAN ORDER UTAMA
        $order = Order::create([
            'user_id'         => Auth::id(),
            'order_number'    => 'ORD-' . strtoupper(uniqid()),
            'customer_name'   => $nama,
            'email'           => Auth::user()->email,
            'phone'           => $telepon,
            'address'         => $alamat,
            'shipping_method' => $request->pengiriman,
            'shipping_cost'   => $ongkir,
            'payment_status'  => 'unpaid',
            'subtotal'        => $subtotal,
            'total_price'     => $total,
            'status'          => 'pending',
        ]);

        // ✅ 2. PINDAHKAN ITEM DARI CART KE ORDER_ITEMS
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $item->product_id,
                'quantity'   => $item->quantity,
                'price'      => $item->product->price,
            ]);
        }

        // ✅ 3. HAPUS KERANJANG (HANYA ITEM YANG DIPILIH/DIBELI)
        Cart::where('user_id', Auth::id())
            ->whereIn('id', $selectedIds) // <--- HAPUS YANG DICENTANG SAJA
            ->delete();

        // ✅ 4. BERSIHKAN SESSION ID CART (Karena sudah jadi order)
        session()->forget('checkout.cart_ids');

        // ✅ 5. SIMPAN ORDER ID KE SESSION
        session(['checkout.order_id' => $order->id]);

        return redirect()->route('checkout.payment');
    }

    // ===============================
    // STEP 3 - PAYMENT VIEW
    // ===============================
    public function payment()
    {
        $orderId = session('checkout.order_id');

        if (!$orderId) {
            return redirect()->route('checkout.shipping.view')
                ->with('error', 'Silakan pilih pengiriman terlebih dahulu.');
        }

        $order = Order::with('items.product')->findOrFail($orderId);

        // Ambil items dari order yang sudah disimpan (Database Order)
        $orderItems = $order->items; 

        $subtotal = $order->subtotal;
        $shipping = $order->shipping_cost;
        $total    = $order->total_price;

        return view('pages.checkout.payment', compact(
            'orderItems',
            'subtotal',
            'shipping',
            'total',
            'order'
        ));
    }

    // ===============================
    // CONFIRMATION (PILIH METODE BAYAR)
    // ===============================
    public function confirmation(Request $request)
    {
        $request->validate([
            'payment' => 'required|in:bank,ewallet,cod',
        ]);

        $orderId = session('checkout.order_id');
        
        $order = Order::where('user_id', Auth::id())
                      ->where('id', $orderId)
                      ->firstOrFail();

        $paymentMethod = match ($request->payment) {
            'bank'    => 'transfer',
            'ewallet' => 'qris',
            'cod'     => 'cod',
        };

        $order->update(['payment_method' => $paymentMethod]);

        // Hapus session checkout agar bersih
        session()->forget(['checkout.nama', 'checkout.alamat', 'checkout.telepon', 'checkout.ongkir', 'checkout.order_id']);

        return match ($request->payment) {
            'bank'    => redirect()->route('payment.bank', $order->id),
            'ewallet' => redirect()->route('payment.qris', $order->id),
            'cod'     => redirect()->route('order.success', $order->id)
                            ->with('success', 'Pesanan COD berhasil dibuat! Bayar saat barang sampai.'),
        };
    }

    // ===============================
    // STEP 4 - UPLOAD BUKTI VIEW
    // ===============================
    public function uploadView($orderId)
    {
        $order = Order::findOrFail($orderId);

        return view('pages.checkout.confirmation', [
            'order' => $order,
            'total' => $order->total_price
        ]);
    }

    // ===============================
    // STEP 5 - PROSES UPLOAD BUKTI
    // ===============================
    public function uploadProof(Request $request)
    {
        $request->validate([
            'order_id'       => 'required|exists:order,id',
            'payment_proof'  => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $order = Order::findOrFail($request->order_id);

        $fileName = time() . '.' . $request->payment_proof->extension();
        $path = $request->payment_proof->storeAs(
            'payment_proofs',
            $fileName,
            'public'
        );

        $order->update([
            'payment_proof'  => $path,
            'payment_status' => 'paid',
            'status'         => 'processed'
        ]);

        return redirect()->route('home')
            ->with('success', 'Bukti pembayaran berhasil dikirim');
    }

    public function success($id)
    {
        $order = Order::with('items.product')->findOrFail($id);
        return view('pages.checkout.confirmation', compact('order'));
    }
}