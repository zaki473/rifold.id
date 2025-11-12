<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Rifold - Checkout</title>
</head>

<body class="bg-gray-100">

    <!-- NAVBAR -->
    @include('components.navbar')

    <!-- CHECKOUT CONTAINER -->
    <div class="container mx-auto px-6 py-12">
        <!-- Progress Steps -->
        <div class="flex justify-center mb-10 text-sm font-medium text-gray-500">
            <div class="flex items-center">
                <span class="text-black">Information</span>
                <span class="mx-4">/</span>
                <span>Shipping</span>
                <span class="mx-4">/</span>
                <span>Payments</span>
            </div>
        </div>

        <!-- Checkout Layout -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
            <!-- Left Side: Form -->
            <div class="bg-white p-6 rounded-xl shadow-md">
                <h2 class="text-lg font-semibold mb-4">Contact Information</h2>

                <!-- PERBAIKAN: action ke route checkout.shipping dan tambahkan CSRF -->
                <form action="{{ route('checkout.shipping') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-1">Nama Lengkap</label>
                        <input type="text" name="nama" class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-black" placeholder="Nama Kamu" value="{{ old('nama') }}">
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-1">Email</label>
                        <input type="email" name="email" class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-black" placeholder="email@gmail.com" value="{{ old('email') }}">
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-1">Nomor Telepon</label>
                        <input type="text" name="telepon" class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-black" placeholder="08123456789" value="{{ old('telepon') }}">
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-1">Alamat Lengkap</label>
                        <textarea name="alamat" class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-black" rows="3" placeholder="Nama jalan, RT/RW, kecamatan, kota">{{ old('alamat') }}</textarea>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium mb-1">Metode Pengiriman</label>
                        <select name="pengiriman" class="w-full border border-gray-300 rounded-lg p-2">
                            <option value="jne" {{ old('pengiriman') == 'jne' ? 'selected' : '' }}>JNE (Rp 20.000)</option>
                            <option value="sicepat" {{ old('pengiriman') == 'sicepat' ? 'selected' : '' }}>SiCepat (Rp 18.000)</option>
                            <option value="gosend" {{ old('pengiriman') == 'gosend' ? 'selected' : '' }}>GoSend (Rp 25.000)</option>
                        </select>
                    </div>

                    <button type="submit" class="bg-black text-white w-full py-3 rounded-lg hover:bg-gray-800 transition">Lanjut ke Pengiriman</button>
                </form>
            </div>

            <!-- Right Side: Order Summary -->
            <div class="bg-white p-6 rounded-xl shadow-md h-fit">
                <h2 class="text-lg font-semibold mb-4">Ringkasan Pesanan</h2>

                <div class="space-y-4 mb-4">
                    <div class="flex items-center justify-between">
                        <span>City Loop Long Sleeve</span>
                        <span>Rp 149.900</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span>Ongkos Kirim</span>
                        <span>Rp 20.000</span>
                    </div>
                </div>

                <div class="border-t pt-4 flex justify-between text-lg font-semibold">
                    <span>Total</span>
                    <span>Rp 169.900</span>
                </div>
            </div>
        </div>
    </div>

    <!-- FOOTER -->
    @include('components.footer')

</body>
</html>
