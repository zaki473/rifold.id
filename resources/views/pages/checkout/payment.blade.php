<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <title>Rifold - Payment</title>
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
                Kembali ke Pengiriman
            </a>
        </div>

        <div class="flex justify-center mb-12">
            <div class="flex items-center text-sm font-medium">
                <div class="flex items-center text-black opacity-60">
                    <span class="flex items-center justify-center w-6 h-6 bg-gray-200 text-gray-600 rounded-full text-xs mr-2">✓</span>
                    <span>Information</span>
                </div>
                <div class="w-12 h-px bg-black opacity-20 mx-4"></div>
                <div class="flex items-center text-black opacity-60">
                    <span class="flex items-center justify-center w-6 h-6 bg-gray-200 text-gray-600 rounded-full text-xs mr-2">✓</span>
                    <span>Shipping</span>
                </div>
                <div class="w-12 h-px bg-black mx-4"></div>
                <div class="flex items-center text-black">
                    <span class="flex items-center justify-center w-6 h-6 bg-black text-white rounded-full text-xs mr-2">3</span>
                    <span>Payment</span>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">
            <div class="lg:col-span-7">
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
                    <h2 class="text-2xl font-bold mb-6 text-gray-900">Metode Pembayaran</h2>
                    <form action="{{ route('checkout.confirmation') }}" method="POST">
                        @csrf
                        <div class="space-y-4">
                            <label class="relative block cursor-pointer group">
                                <input type="radio" name="payment" value="bank" class="peer sr-only" required>
                                <div class="flex items-center justify-between p-5 rounded-xl border border-gray-200 bg-white hover:border-gray-400 peer-checked:border-black peer-checked:ring-1 peer-checked:ring-black peer-checked:bg-gray-50 transition-all duration-200">
                                    <div class="flex items-center gap-4">
                                        <div class="w-10 h-10 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center">
                                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                                        </div>
                                        <div><p class="font-semibold text-gray-900">Transfer Bank</p><p class="text-xs text-gray-500">BCA, Mandiri, BNI</p></div>
                                    </div>
                                    <div class="w-5 h-5 border border-gray-300 rounded-full peer-checked:bg-black peer-checked:border-black flex items-center justify-center"><div class="w-2 h-2 bg-white rounded-full hidden peer-checked:block"></div></div>
                                </div>
                            </label>
                            <label class="relative block cursor-pointer group">
                                <input type="radio" name="payment" value="ewallet" class="peer sr-only">
                                <div class="flex items-center justify-between p-5 rounded-xl border border-gray-200 bg-white hover:border-gray-400 peer-checked:border-black peer-checked:ring-1 peer-checked:ring-black peer-checked:bg-gray-50 transition-all duration-200">
                                    <div class="flex items-center gap-4">
                                        <div class="w-10 h-10 rounded-full bg-green-50 text-green-600 flex items-center justify-center">
                                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                                        </div>
                                        <div><p class="font-semibold text-gray-900">Qris</p></div>
                                    </div>
                                    <div class="w-5 h-5 border border-gray-300 rounded-full peer-checked:bg-black peer-checked:border-black flex items-center justify-center"><div class="w-2 h-2 bg-white rounded-full hidden peer-checked:block"></div></div>
                                </div>
                            </label>
                             <label class="relative block cursor-pointer group">
                                <input type="radio" name="payment" value="cod" class="peer sr-only">
                                <div class="flex items-center justify-between p-5 rounded-xl border border-gray-200 bg-white hover:border-gray-400 peer-checked:border-black peer-checked:ring-1 peer-checked:ring-black peer-checked:bg-gray-50 transition-all duration-200">
                                    <div class="flex items-center gap-4">
                                        <div class="w-10 h-10 rounded-full bg-yellow-50 text-yellow-600 flex items-center justify-center">
                                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                                        </div>
                                        <div><p class="font-semibold text-gray-900">COD</p><p class="text-xs text-gray-500">Bayar di Tempat</p></div>
                                    </div>
                                    <div class="w-5 h-5 border border-gray-300 rounded-full peer-checked:bg-black peer-checked:border-black flex items-center justify-center"><div class="w-2 h-2 bg-white rounded-full hidden peer-checked:block"></div></div>
                                </div>
                            </label>
                        </div>
                        <div class="mt-8">
                            <button type="submit" class="w-full bg-black text-white font-bold text-lg py-4 rounded-xl hover:bg-gray-800 transition transform active:scale-[0.99] shadow-lg flex items-center justify-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                Konfirmasi Pembayaran
                            </button>
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
