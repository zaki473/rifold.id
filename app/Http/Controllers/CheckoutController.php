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
    // STEP 1 - INFORMATION
    // ===============================
    public function index()
    {
        $cartItems = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();

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
    // STEP 2 - SHIPPING
    // ===============================
    public function shipping()
{
    // Pastikan user sudah mengisi informasi sebelumnya
    if (
        !session('checkout.nama') ||
        !session('checkout.alamat') ||
        !session('checkout.telepon')
    ) {
        return redirect()->route('checkout.index')
            ->with('error', 'Silakan lengkapi data terlebih dahulu.');
    }

    $cartItems = Cart::where('user_id', Auth::id())
        ->with('product')
        ->get();

    if ($cartItems->isEmpty()) {
        return redirect()->route('cart')
            ->with('error', 'Keranjang kosong.');
    }

    $subtotal = $cartItems->sum(fn ($item) =>
        $item->product->price * $item->quantity
    );

    return view('pages.checkout.shipping', compact('cartItems', 'subtotal'));
}

// ===============================
// STEP 2 - STORE SHIPPING & CREATE ORDER
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

    if (!$nama || !$alamat || !$telepon || !$ongkir) {
        return redirect()->route('checkout.shipping.view')
            ->with('error', 'Data pengiriman belum lengkap.');
    }

    $cartItems = Cart::where('user_id', Auth::id())
        ->with('product')
        ->get();

    if ($cartItems->isEmpty()) {
        return redirect()->route('cart')->with('error', 'Keranjang kosong.');
    }

    $subtotal = $cartItems->sum(fn ($item) =>
        $item->product->price * $item->quantity
    );

    $total = $subtotal + $ongkir;

    // ✅ SIMPAN ORDER
    $order = Order::create([
        'user_id'          => Auth::id(),
        'order_number'    => 'ORD-' . strtoupper(uniqid()),
        'customer_name'   => $nama,
        'email'           => Auth::user()->email,
        'phone'           => $telepon,
        'address'         => $alamat,
        'shipping_method' => $request->pengiriman,
        'shipping_cost'   => $ongkir,
        'payment_status' => 'unpaid',
        'subtotal'        => $subtotal,
        'total_price'     => $total,
        'status'          => 'pending',
    ]);

    // ✅ simpan order id ke session untuk halaman payment
    session(['checkout.order_id' => $order->id]);

    return redirect()->route('checkout.payment');
}






    // ===============================
    // STEP 3 - PAYMENT (CREATE ORDER)
    // ===============================

    public function payment()
{
    $orderId = session('checkout.order_id');

    if (!$orderId) {
        return redirect()->route('checkout.shipping.view')
            ->with('error', 'Silakan pilih pengiriman terlebih dahulu.');
    }

    $order = Order::findOrFail($orderId);

    $cartItems = Cart::where('user_id', Auth::id())
        ->with('product')
        ->get();

    $subtotal = $order->subtotal;
    $shipping = $order->shipping_cost;
    $total    = $order->total_price;

    return view('pages.checkout.payment', compact(
        'cartItems',
        'subtotal',
        'shipping',
        'total',
        'order'
    ));
}


public function confirmation(Request $request)
{
    // Validasi input
    $request->validate([
        'payment' => 'required|in:bank,ewallet,cod',
    ]);

    // Ambil order terakhir milik user (order baru dibuat tanpa payment_method)
    $order = Order::where('user_id', Auth::id())
                  ->latest()
                  ->firstOrFail();

    // Map value radio ke enum DB
    $paymentMethod = match ($request->payment) {
        'bank'    => 'transfer',
        'ewallet' => 'qris',
        'cod'     => 'cod',
    };

    // Update order dengan payment_method
    $order->update(['payment_method' => $paymentMethod]);

    // Redirect sesuai metode pembayaran
    return match ($request->payment) {
        'bank'    => redirect()->route('payment.bank', $order->id),
        'ewallet' => redirect()->route('payment.qris', $order->id),
        'cod'     => redirect()->route('order.success', $order->id)
                        ->with('success', 'Pesanan COD berhasil dibuat! Bayar saat barang sampai.'),
    };
}



    // ===============================
    // STEP 4 - UPLOAD VIEW
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
    // STEP 5 - UPLOAD BUKTI PEMBAYARAN
    // ===============================
    public function uploadProof(Request $request)
    {
        $request->validate([
            'order_id'       => 'required|exists:order,id',
            'payment_proof' => 'required|image|mimes:jpg,jpeg,png|max:2048',
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
            'status'         => 'processing'
        ]);

        return redirect()->route('home')
            ->with('success', 'Bukti pembayaran berhasil dikirim');
    }

    public function success($id)
    {
        $order = Order::findOrFail($id);
        return view('pages.checkout.confirmation', compact('order'));
    }
}
