<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\OrderItem;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::with('items.product') // ✅ ini yang penting
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('pages.profile.profile', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',
            'shipping_method' => 'required',
            'shipping_cost' => 'required|numeric',
            'payment_method' => 'required|in:transfer,qris,cod',
            'payment_proof' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $userId = Auth::id();

        // Ambil cart user
        $carts = Cart::with('product')
            ->where('user_id', $userId)
            ->get();

        if ($carts->isEmpty()) {
            return back()->with('error', 'Keranjang masih kosong!');
        }

        // Hitung subtotal
        $subtotal = 0;
        foreach ($carts as $cart) {
            $subtotal += $cart->qty * $cart->product->price;
        }

        $total = $subtotal + $request->shipping_cost;

        // Upload bukti pembayaran (jika ada)
        $paymentProofPath = null;
        if ($request->hasFile('payment_proof')) {
            $paymentProofPath = $request->file('payment_proof')
                ->store('payments', 'public');
        }

        // ================================
        // SIMPAN KE TABEL ORDERS
        // ================================
        $order = Order::create([
            'user_id' => $userId,
            'order_number' => 'INV-' . strtoupper(Str::random(8)),
            'customer_name' => $request->customer_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'shipping_method' => $request->shipping_method,
            'shipping_cost' => $request->shipping_cost,
            'payment_method' => $request->payment_method,
            'payment_proof' => $paymentProofPath,
            'payment_status' => $request->payment_method == 'cod' ? 'unpaid' : 'paid',
            'subtotal' => $subtotal,
            'total_price' => $total,
            'status' => 'pending',
        ]);

        // ================================
        // SIMPAN KE TABEL ORDER_ITEMS
        // ================================
        foreach ($carts as $cart) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cart->product_id,
                'qty' => $cart->qty,
                'price' => $cart->product->price,
                'subtotal' => $cart->qty * $cart->product->price,
            ]);
        }

        // ================================
        // HAPUS CART SETELAH CHECKOUT
        // ================================
        Cart::where('user_id', $userId)->delete();

        return redirect()->route('orders.success', $order->id)
            ->with('success', 'Pesanan berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }




    public function saveInformation(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'email' => 'required|email',
            'telepon' => 'required',
            'alamat' => 'required',
        ]);

        // Simpan ke session
        session([
            'checkout.customer_name' => $request->nama,
            'checkout.email' => $request->email,
            'checkout.phone' => $request->telepon,
            'checkout.address' => $request->alamat,
        ]);

        // Redirect ke halaman shipping
        return redirect()->route('checkout.shipping.view');
    }

    public function adminIndex()
    {
        $orders = Order::with([
            'user',
            'items.product' => function ($query) {
            }
        ])->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('pages.admin.status_order', compact('orders'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,paid,processed,shipped,delivered,cancelled'
        ]);

        $order->update([
            'status' => $request->status,
        ]);

        return back()->with('success', 'Status pesanan berhasil diperbarui');
    }



}
