<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <title>Rifold - Payment</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-800">

    @include('components.navbar')

    <div class="container mx-auto px-4 md:px-6 py-12 max-w-6xl">

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">

            <!-- PAYMENT METHOD -->
            <div class="lg:col-span-7">
                <div class="mb-6">
                    <a href="javascript:history.back()"
                        class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-black transition-colors duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Ubah Pengiriman
                    </a>
                </div>
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100">


                    <h2 class="text-2xl font-bold mb-6 text-gray-900">Metode Pembayaran</h2>

                    <form action="{{ route('checkout.confirmation') }}" method="POST" class="space-y-6">
                        @csrf

                        <div class="space-y-4">
                            <!-- Bank -->
                            <label
                                class="flex items-center justify-between p-5 border rounded-xl cursor-pointer hover:bg-gray-50">
                                <div class="flex items-center gap-4">
                                    <div
                                        class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 font-bold">
                                        BANK</div>
                                    <div>
                                        <p class="font-bold">Transfer Bank</p>
                                        <p class="text-sm text-gray-500">BCA, BNI, Mandiri</p>
                                    </div>
                                </div>
                                <input type="radio" name="payment" value="bank" class="w-5 h-5 text-black" required>
                            </label>

                            <!-- QRIS -->
                            <label
                                class="flex items-center justify-between p-5 border rounded-xl cursor-pointer hover:bg-gray-50">
                                <div class="flex items-center gap-4">
                                    <div
                                        class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center text-green-600 font-bold">
                                        QR</div>
                                    <p class="font-bold">QRIS</p>
                                </div>
                                <input type="radio" name="payment" value="ewallet" class="w-5 h-5 text-black">
                            </label>

                            <!-- COD -->
                            <label
                                class="flex items-center justify-between p-5 border rounded-xl cursor-pointer hover:bg-gray-50">
                                <div class="flex items-center gap-4">
                                    <div
                                        class="w-10 h-10 bg-yellow-100 rounded-full flex items-center justify-center text-yellow-600 font-bold">
                                        COD</div>
                                    <p class="font-bold">Bayar di Tempat</p>
                                </div>
                                <input type="radio" name="payment" value="cod" class="w-5 h-5 text-black">
                            </label>
                        </div>

                        <button type="submit"
                            class="w-full bg-black text-white font-bold py-4 rounded-xl hover:bg-gray-800">
                            Lanjut ke Pembayaran
                        </button>
                    </form>
                </div>
            </div>

            <!-- ORDER SUMMARY -->
            <div class="lg:col-span-5">
                <div class="bg-white p-8 rounded-2xl shadow-sm border">

                    <h2 class="text-xl font-bold mb-6">Ringkasan Pesanan</h2>

                    <div class="space-y-4 mb-6">
                        {{-- Kita ambil dari $order->items karena data sudah masuk ke tabel order --}}
                        @foreach ($order->items as $item)
                            <div class="flex justify-between items-center py-2 border-b border-gray-50 last:border-0">
                                <div>
                                    {{-- Pastikan relasi product ada --}}
                                    <p class="font-semibold text-gray-900">{{ $item->product->name ?? 'Produk dihapus' }}
                                    </p>
                                    <p class="text-xs text-gray-500">Qty: {{ $item->quantity }}</p>
                                </div>
                                <p class="font-semibold text-gray-900">
                                    {{-- Di tabel order_items kita simpan harga di kolom 'price' --}}
                                    Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                                </p>
                            </div>
                        @endforeach
                    </div>

                    @php
                        $shipping = session('checkout.ongkir', 0);
                        $total = $subtotal + $shipping;
                    @endphp

                    <div class="border-t pt-4 space-y-2 text-lg font-bold">
                        <div class="flex justify-between">
                            <span>Subtotal</span>
                            <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                        </div>

                        <div class="flex justify-between">
                            <span>Pengiriman</span>
                            <span>Rp {{ number_format($shipping, 0, ',', '.') }}</span>
                        </div>

                        <div class="flex justify-between border-t pt-2">
                            <span>Total</span>
                            <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                    </div>


                </div>
            </div>

        </div>
    </div>

    @include('components.footer')
</body>

</html>