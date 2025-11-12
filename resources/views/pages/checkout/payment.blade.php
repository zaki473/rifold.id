<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Rifold - Payment</title>
</head>

<body class="bg-gray-100">

    @include('components.navbar')

    <div class="container mx-auto px-6 py-12">
        <!-- Progress Steps -->
        <div class="flex justify-center mb-10 text-sm font-medium text-gray-500">
            <div class="flex items-center">
                <span>Information</span>
                <span class="mx-4">/</span>
                <span>Shipping</span>
                <span class="mx-4 text-black">/</span>
                <span class="text-black">Payment</span>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
            <!-- Payment Form -->
            <div class="bg-white p-6 rounded-xl shadow-md">
                <h2 class="text-lg font-semibold mb-4">Metode Pembayaran</h2>

                <form action="{{ route('checkout.confirmation') }}" method="POST">
                    @csrf

                    <div class="space-y-4">
                        <label class="flex items-center justify-between border p-3 rounded-lg cursor-pointer">
                            <span>Transfer Bank (BCA, Mandiri, BNI)</span>
                            <input type="radio" name="payment" value="bank" class="ml-3">
                        </label>

                        <label class="flex items-center justify-between border p-3 rounded-lg cursor-pointer">
                            <span>E-Wallet (OVO, DANA, GoPay)</span>
                            <input type="radio" name="payment" value="ewallet" class="ml-3">
                        </label>

                        <label class="flex items-center justify-between border p-3 rounded-lg cursor-pointer">
                            <span>COD (Bayar di Tempat)</span>
                            <input type="radio" name="payment" value="cod" class="ml-3">
                        </label>
                    </div>

                    <button type="submit" class="bg-black text-white w-full py-3 rounded-lg mt-6 hover:bg-gray-800 transition">
                        Konfirmasi Pembayaran
                    </button>
                </form>
            </div>

            <!-- Order Summary -->
            <div class="bg-white p-6 rounded-xl shadow-md h-fit">
                <h2 class="text-lg font-semibold mb-4">Ringkasan Pesanan</h2>

                <div class="flex justify-between mb-2">
                    <span>City Loop Long Sleeve</span>
                    <span>Rp 149.900</span>
                </div>

                <div class="flex justify-between mb-2">
                    <span>Ongkos Kirim</span>
                    <span>Rp 20.000</span>
                </div>

                <div class="border-t pt-4 flex justify-between text-lg font-semibold">
                    <span>Total</span>
                    <span>Rp 169.900</span>
                </div>
            </div>
        </div>
    </div>

    @include('components.footer')

</body>
</html>
