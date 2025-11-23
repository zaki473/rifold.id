<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <title>Rifold - Shipping</title>
    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">

    @include('components.navbar')

    <div class="container mx-auto px-4 md:px-6 py-12 max-w-6xl">
        <div class="mb-6">
            <a href="javascript:history.back()" class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-black transition-colors duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Ubah Informasi Kontak
            </a>
        </div>

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
            <div class="lg:col-span-7">
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
                    <h2 class="text-2xl font-bold mb-6 text-gray-900">Metode Pengiriman</h2>
                    <form action="{{ route('checkout.payment') }}" method="POST">
                        @csrf
                        <div class="space-y-4">
                            <label class="relative block cursor-pointer group">
                                <input type="radio" name="pengiriman" value="jne" class="peer sr-only" required>
                                <div class="flex items-center justify-between p-5 rounded-xl border border-gray-200 bg-white hover:border-gray-400 peer-checked:border-black peer-checked:ring-1 peer-checked:ring-black peer-checked:bg-gray-50 transition-all duration-200">
                                    <div class="flex items-center gap-4">
                                        <div class="text-sm"><p class="font-semibold text-gray-900">JNE Regular</p><p class="text-gray-500">Estimasi 2-3 hari</p></div>
                                    </div>
                                    <span class="font-bold text-gray-900">Rp 20.000</span>
                                </div>
                            </label>
                            <label class="relative block cursor-pointer group">
                                <input type="radio" name="pengiriman" value="sicepat" class="peer sr-only">
                                <div class="flex items-center justify-between p-5 rounded-xl border border-gray-200 bg-white hover:border-gray-400 peer-checked:border-black peer-checked:ring-1 peer-checked:ring-black peer-checked:bg-gray-50 transition-all duration-200">
                                    <div class="flex items-center gap-4">
                                        <div class="text-sm"><p class="font-semibold text-gray-900">SiCepat Express</p><p class="text-gray-500">Estimasi 1-2 hari</p></div>
                                    </div>
                                    <span class="font-bold text-gray-900">Rp 18.000</span>
                                </div>
                            </label>
                            <label class="relative block cursor-pointer group">
                                <input type="radio" name="pengiriman" value="gosend" class="peer sr-only">
                                <div class="flex items-center justify-between p-5 rounded-xl border border-gray-200 bg-white hover:border-gray-400 peer-checked:border-black peer-checked:ring-1 peer-checked:ring-black peer-checked:bg-gray-50 transition-all duration-200">
                                    <div class="flex items-center gap-4">
                                        <div class="text-sm"><p class="font-semibold text-gray-900">GoSend Same Day</p><p class="text-gray-500">Tiba hari ini</p></div>
                                    </div>
                                    <span class="font-bold text-gray-900">Rp 25.000</span>
                                </div>
                            </label>
                        </div>
                        <div class="mt-8">
                            <button type="submit" class="w-full bg-black text-white font-bold text-lg py-4 rounded-xl hover:bg-gray-800 transition transform active:scale-[0.99] shadow-lg">Lanjut ke Pembayaran</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="lg:col-span-5 h-fit">
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
                    <h2 class="text-xl font-bold mb-6 text-gray-900">Ringkasan Pesanan</h2>
                    <div class="flex items-start justify-between mb-6">
                        <div class="flex items-center gap-4">
                            <div class="w-14 h-14 bg-gray-100 rounded-lg flex-shrink-0"></div>
                            <div><p class="font-medium text-gray-900">City Loop Long Sleeve</p><p class="text-sm text-gray-500">Qty: 1</p></div>
                        </div>
                        <span class="font-semibold text-gray-900">Rp 149.900</span>
                    </div>
                    <div class="border-t border-gray-100 my-6"></div>
                    <div class="flex items-center justify-between text-lg font-semibold"><span class="text-gray-900">Total Sementara</span><span class="text-black">Rp 149.900</span></div>
                </div>
            </div>
        </div>
    </div>
    @include('components.footer')
</body>
</html>