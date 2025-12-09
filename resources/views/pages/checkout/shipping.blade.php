<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <title>Rifold - Shipping</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-800">

@include('components.navbar')

<div class="container mx-auto px-4 md:px-6 py-12 max-w-6xl">

    <div class="flex justify-center mb-12">
        <div class="flex items-center text-sm font-medium">
            <div class="flex items-center text-black opacity-60">
                <span class="flex items-center justify-center w-6 h-6 bg-gray-200 text-gray-600 rounded-full text-xs mr-2">✓</span>
                <span>Information</span>
            </div>
            <div class="w-12 h-px bg-black mx-4"></div>
            <div class="flex items-center text-black">
                <span class="flex items-center justify-center w-6 h-6 bg-black text-white rounded-full text-xs mr-2">2</span>
                <span>Shipping</span>
            </div>
            <div class="w-12 h-px bg-gray-300 mx-4"></div>
            <div class="flex items-center text-gray-400">
                <span class="flex items-center justify-center w-6 h-6 border border-gray-300 rounded-full text-xs mr-2">3</span>
                <span>Payment</span>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">

        <!-- LEFT -->
        <div class="lg:col-span-7">
            <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
                <h2 class="text-2xl font-bold mb-6 text-gray-900">Metode Pengiriman</h2>

                <form action="{{ route('checkout.shipping.store') }}" method="POST">
                    @csrf

                    <!-- ✅ TAMBAHAN WAJIB, UI TIDAK TERUBAH -->
                    <input type="hidden" name="shipping_cost" id="shippingInput">

                    <div class="space-y-4">
                        <label class="relative block cursor-pointer group">
                            <input type="radio" name="pengiriman" value="jne" data-price="20000" class="peer sr-only" required>
                            <div class="flex items-center justify-between p-5 rounded-xl border border-gray-200 bg-white hover:border-gray-400
                                peer-checked:border-black peer-checked:ring-1 peer-checked:ring-black peer-checked:bg-gray-50 transition">
                                <div class="text-sm">
                                    <p class="font-semibold text-gray-900">JNE Regular</p>
                                    <p class="text-gray-500">Estimasi 2-3 hari</p>
                                </div>
                                <span class="font-bold text-gray-900">Rp 20.000</span>
                            </div>
                        </label>

                        <label class="relative block cursor-pointer group">
                            <input type="radio" name="pengiriman" value="sicepat" data-price="18000" class="peer sr-only">
                            <div class="flex items-center justify-between p-5 rounded-xl border border-gray-200 bg-white hover:border-gray-400
                                peer-checked:border-black peer-checked:ring-1 peer-checked:ring-black peer-checked:bg-gray-50 transition">
                                <div class="text-sm">
                                    <p class="font-semibold text-gray-900">SiCepat Express</p>
                                    <p class="text-gray-500">Estimasi 1-2 hari</p>
                                </div>
                                <span class="font-bold text-gray-900">Rp 18.000</span>
                            </div>
                        </label>

                        <label class="relative block cursor-pointer group">
                            <input type="radio" name="pengiriman" value="gosend" data-price="25000" class="peer sr-only">
                            <div class="flex items-center justify-between p-5 rounded-xl border border-gray-200 bg-white hover:border-gray-400
                                peer-checked:border-black peer-checked:ring-1 peer-checked:ring-black peer-checked:bg-gray-50 transition">
                                <div class="text-sm">
                                    <p class="font-semibold text-gray-900">GoSend Same Day</p>
                                    <p class="text-gray-500">Tiba hari ini</p>
                                </div>
                                <span class="font-bold text-gray-900">Rp 25.000</span>
                            </div>
                        </label>
                    </div>

                    <div class="mt-8">
                        <button type="submit"
                            class="w-full bg-black text-white font-bold text-lg py-4 rounded-xl hover:bg-gray-800 transition transform active:scale-[0.99] shadow-lg">
                            Lanjut ke Pembayaran
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- RIGHT -->
        <div class="lg:col-span-5">
            <div class="bg-white p-8 rounded-2xl shadow-sm border">
                <h2 class="text-xl font-bold mb-6">Ringkasan Pesanan</h2>

                <div class="space-y-4 mb-6">
                    @foreach ($cartItems as $item)
                        <div class="flex justify-between">
                            <div>
                                <p class="font-semibold">{{ $item->product->name }}</p>
                                <p class="text-xs text-gray-500">
                                    Qty: {{ $item->quantity }} | Size: {{ $item->size }}
                                </p>
                            </div>
                            <p class="font-semibold">
                                Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}
                            </p>
                        </div>
                    @endforeach
                </div>

                <div class="border-t pt-4 space-y-2 text-lg font-bold">
                    <div class="flex justify-between">
                        <span>Subtotal</span>
                        <span id="subtotal" data-subtotal="{{ $subtotal }}">
                            Rp {{ number_format($subtotal, 0, ',', '.') }}
                        </span>
                    </div>

                    <div class="flex justify-between">
                        <span>Pengiriman</span>
                        <span id="shippingCost">Rp 0</span>
                    </div>

                    <div class="flex justify-between border-t pt-2">
                        <span>Total</span>
                        <span id="grandTotal">
                            Rp {{ number_format($subtotal, 0, ',', '.') }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@include('components.footer')

<script>
    const radios = document.querySelectorAll('input[name="pengiriman"]');
    const shippingEl = document.getElementById('shippingCost');
    const subtotalEl = document.getElementById('subtotal');
    const grandTotalEl = document.getElementById('grandTotal');
    const shippingInput = document.getElementById('shippingInput');

    const subtotal = parseInt(subtotalEl.dataset.subtotal);

    radios.forEach(radio => {
        radio.addEventListener('change', function() {
            const shipping = parseInt(this.dataset.price);
            const total = subtotal + shipping;

            shippingEl.innerText = "Rp " + shipping.toLocaleString('id-ID');
            grandTotalEl.innerText = "Rp " + total.toLocaleString('id-ID');

            shippingInput.value = shipping;
        });
    });
</script>

</body>
</html>
