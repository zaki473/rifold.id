<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <title>Rifold - Checkout</title>
    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">

    @include('components.navbar')

    <div class="container mx-auto px-4 md:px-6 py-12 max-w-6xl">
        <!-- Back Button -->
        <div class="mb-6">
            <a href="{{ url('/katalog') }}" class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-black transition-colors duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali ke Katalog
            </a>
        </div>

        <!-- Progress Steps -->
        <div class="flex justify-center mb-12">
            <div class="flex items-center text-sm font-medium">
                <div class="flex items-center text-black">
                    <span class="flex items-center justify-center w-6 h-6 bg-black text-white rounded-full text-xs mr-2">1</span>
                    <span>Information</span>
                </div>
                <div class="w-12 h-px bg-gray-300 mx-4"></div>
                <div class="flex items-center text-gray-400">
                    <span class="flex items-center justify-center w-6 h-6 border border-gray-300 rounded-full text-xs mr-2">2</span>
                    <span>Shipping</span>
                </div>
                <div class="w-12 h-px bg-gray-300 mx-4"></div>
                <div class="flex items-center text-gray-400">
                    <span class="flex items-center justify-center w-6 h-6 border border-gray-300 rounded-full text-xs mr-2">3</span>
                    <span>Payments</span>
                </div>
            </div>
        </div>

        <!-- Layout -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">
            <!-- Left: Form -->
            <div class="lg:col-span-7">
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
                    <h2 class="text-2xl font-bold mb-6 text-gray-900">Contact Information</h2>
                    <form action="{{ route('checkout.shipping') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 gap-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap</label>
                                <input type="text" name="nama" class="w-full bg-gray-100 border border-transparent text-gray-500 rounded-lg px-4 py-3 focus:outline-none cursor-not-allowed" placeholder="Nama Kamu" value="{{ old('nama') }}" readonly>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                                    <input type="email" name="email" class="w-full bg-gray-100 border border-transparent text-gray-500 rounded-lg px-4 py-3 focus:outline-none cursor-not-allowed" placeholder="email@gmail.com" value="{{ old('email') }}" readonly>
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nomor Telepon</label>
                                    <input type="text" name="telepon" class="w-full bg-gray-100 border border-transparent text-gray-500 rounded-lg px-4 py-3 focus:outline-none cursor-not-allowed" placeholder="08123456789" value="{{ old('telepon') }}" readonly>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Alamat Lengkap <span class="text-red-500">*</span></label>
                                <textarea name="alamat" class="w-full bg-white border border-gray-300 rounded-lg px-4 py-3 text-gray-900 focus:outline-none focus:ring-2 focus:ring-black focus:border-transparent transition shadow-sm placeholder-gray-400" rows="4" placeholder="Nama jalan, Nomor rumah, RT/RW, Kecamatan, Kota">{{ old('alamat') }}</textarea>
                            </div>
                        </div>
                        <div class="mt-8">
                            <button type="submit" class="w-full bg-black text-white font-bold text-lg py-4 rounded-xl hover:bg-gray-800 transition transform active:scale-[0.99] shadow-lg">Lanjut ke Pengiriman</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Right: Summary -->
            <div class="lg:col-span-5 h-fit">
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
                    <h2 class="text-xl font-bold mb-6 text-gray-900">Ringkasan Pesanan</h2>
                    <div class="space-y-6 mb-6">
                        <div class="flex items-start justify-between">
                            <div class="flex items-center gap-4">
                                <div class="w-14 h-14 bg-gray-100 rounded-lg flex-shrink-0"></div>
                                <div><p class="font-medium text-gray-900">City Loop Long Sleeve</p><p class="text-sm text-gray-500">Qty: 1</p></div>
                            </div>
                            <span class="font-semibold text-gray-900">Rp 149.900</span>
                        </div>
                    </div>
                    <div class="border-t border-gray-100 my-6"></div>
                    <div class="space-y-3 text-sm text-gray-600">
                        <div class="flex items-center justify-between"><span>Subtotal</span><span>Rp 149.900</span></div>
                        <div class="flex items-center justify-between"><span>Ongkos Kirim</span><span>Rp 20.000</span></div>
                    </div>
                    <div class="border-t border-dashed border-gray-300 my-6"></div>
                    <div class="flex items-center justify-between">
                        <div><span class="text-lg font-bold text-gray-900">Total</span><p class="text-xs text-gray-500">Termasuk pajak</p></div>
                        <span class="text-2xl font-bold text-black">Rp 169.900</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('components.footer')
</body>
</html>