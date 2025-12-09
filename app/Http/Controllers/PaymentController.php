<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;


class PaymentController extends Controller
{
    public function bank($orderId)
{
    $order = Order::where('id', $orderId)
                  ->where('user_id', Auth::id())
                  ->firstOrFail();

    $total = $order->total_price;

    return view('pages.checkout.payment_bank', compact('order', 'total'));
}

public function qris($orderId)
{
    $order = Order::where('id', $orderId)
                  ->where('user_id', Auth::id())
                  ->firstOrFail();

    $total = $order->total_price;

    return view('pages.checkout.payment_qris', compact('order', 'total'));
}


    public function upload(Request $request)
    {
        $request->validate([
            'payment_proof' => 'required|image|max:2048',
            'order_id' => 'required'
        ]);

        $filename = $request->file('payment_proof')->store('payment_proofs', 'public');

        $order = Order::findOrFail($request->order_id);
        $order->payment_proof = $filename;
        $order->payment_status = 'paid';
        $order->save();

        return redirect()->route('payment.upload.view', ['orderId' => $order->id])->with('success', 'Bukti pembayaran berhasil dikirim.');
    }

    public function uploadView($orderId)
{
    $order = Order::findOrFail($orderId);

    return view('pages.checkout.confirmation', [
        'order' => $order,
        'total' => $order->total_price
    ]);
}

public function uploadProof(Request $request)
{
    $request->validate([
        'order_id' => 'required',
        'proof_image' => 'required|image|mimes:jpg,jpeg,png|max:2048'
    ]);

    $path = $request->file('proof_image')->store('payment_proofs', 'public');

    Order::where('id', $request->order_id)
        ->update([
            'payment_proof' => $path,
            'payment_status' => 'paid'
        ]);

    return redirect()->route('home')->with('success', 'Bukti pembayaran berhasil dikirim.');
}

}
