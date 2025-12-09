<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
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
        <a href="{{ url('/cart') }}" class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-black transition-colors duration-200">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Kembali ke Cart
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

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">

        <!-- LEFT FORM -->
        <div class="lg:col-span-7">
            <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
                <h2 class="text-2xl font-bold mb-6 text-gray-900">Contact Information</h2>

                <form action="{{ route('checkout.shipping') }}" method="POST">
                    @csrf

                    <div class="grid grid-cols-1 gap-6">

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap</label>
                            <input type="text" name="nama"
                                class="w-full bg-gray-100 border border-transparent text-gray-500 rounded-lg px-4 py-3"
                                value="{{ Auth::user()->name }}" readonly>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                                <input type="text" name="email"
                                    class="w-full bg-gray-100 border border-transparent text-gray-500 rounded-lg px-4 py-3"
                                    value="{{ Auth::user()->email }}" readonly>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Nomor Telepon</label>
                                <input type="text" name="telepon"
                                    class="w-full bg-gray-100 border border-transparent text-gray-500 rounded-lg px-4 py-3"
                                    value="{{ Auth::user()->phone ?? '-' }}" readonly>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Alamat Lengkap <span class="text-red-500">*</span>
                            </label>
                            <textarea name="alamat" rows="4"
                                class="w-full bg-white border border-gray-300 rounded-lg px-4 py-3 text-gray-900 focus:outline-none focus:ring-2 focus:ring-black"
                                placeholder="Alamat lengkap..." required></textarea>
                        </div>
                    </div>

                    <div class="mt-8">
                        <button type="submit"
                            class="w-full bg-black text-white font-bold text-lg py-4 rounded-xl hover:bg-gray-800 transition shadow-lg">
                            Lanjut ke Pengiriman
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- RIGHT SUMMARY -->
        <div class="lg:col-span-5">
            <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
                <h2 class="text-xl font-bold mb-6 text-gray-900">Ringkasan Pesanan</h2>

                <div class="space-y-4 mb-6">
                    @foreach($cartItems as $item)
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="font-semibold">{{ $item->product->name }}</p>
                                <p class="text-xs text-gray-500">
                                    Size: {{ $item->size }} | Qty: {{ $item->quantity }}
                                </p>
                            </div>
                            <p class="font-semibold">
                                Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}
                            </p>
                        </div>
                    @endforeach
                </div>

                <div class="border-t pt-4">
                    <div class="flex justify-between items-center text-lg font-bold">
                        <span>Total</span>
                        <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                    </div>
                </div>

            </div>
        </div>

    </div>

</div>

@include('components.footer')
</body>
</html>
