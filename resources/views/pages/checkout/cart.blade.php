<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja - Rifold</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Poppins & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Poppins', sans-serif; }
        
        /* Hilangkan spinner pada input number */
        input[type=number]::-webkit-inner-spin-button, 
        input[type=number]::-webkit-outer-spin-button { 
            -webkit-appearance: none; margin: 0; 
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-800 pb-24 md:pb-10">

    @include('components.navbar')

    <div class="container mx-auto px-4 md:px-6 py-10 max-w-6xl">
        
        <!-- Header -->
        <div class="flex justify-between items-end mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Keranjang Saya</h1>
                <p class="text-gray-500 text-sm mt-1">2 item di keranjangmu</p>
            </div>
            <a href="{{ route('katalog') }}" class="hidden md:flex items-center text-sm font-medium text-gray-600 hover:text-black transition">
                Lanjutkan Belanja 
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                </svg>
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
            
            <!-- KOLOM UTAMA (DAFTAR PRODUK) -->
            <div class="lg:col-span-2 space-y-6">
                
                <!-- Select All Bar -->
                <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 flex items-center">
                    <input type="checkbox" id="selectAll" class="w-5 h-5 accent-black cursor-pointer rounded border-gray-300">
                    <label for="selectAll" class="ml-3 text-sm font-medium text-gray-700 cursor-pointer select-none">Pilih Semua Produk</label>
                </div>

                <!-- LIST ITEM -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    
                    <!-- ITEM 1 -->
                    <div class="p-4 md:p-6 border-b border-gray-100 flex gap-4 md:gap-6 items-center">
                        <!-- Checkbox -->
                        <input type="checkbox" class="item-check w-5 h-5 accent-black cursor-pointer rounded border-gray-300 flex-shrink-0">
                        
                        <!-- Image -->
                        <div class="w-20 h-24 md:w-24 md:h-28 bg-gray-100 rounded-lg overflow-hidden flex-shrink-0">
                            <img src="{{ asset('images/katalog/Weekend walk.png') }}" alt="Weekend Walk" class="w-full h-full object-cover">
                        </div>

                        <!-- Details -->
                        <div class="flex-1 min-w-0">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="text-base font-semibold text-gray-900 line-clamp-1">Weekend Walk Long Sleeve</h3>
                                    <p class="text-xs md:text-sm text-gray-500 mt-1">Warna: Hitam Klasik | Size: L</p>
                                </div>
                                <!-- Remove Button Desktop -->
                                <button class="hidden md:block text-gray-400 hover:text-red-500 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                </button>
                            </div>

                            <div class="flex justify-between items-end mt-4">
                                <div class="font-bold text-gray-900">Rp 1.250.000</div>
                                
                                <!-- Quantity Control -->
                                <div class="flex items-center border border-gray-300 rounded-lg h-8 md:h-9">
                                    <button class="px-2 md:px-3 text-gray-500 hover:text-black hover:bg-gray-50 h-full rounded-l-lg transition decrease-qty">-</button>
                                    <input type="number" value="1" min="1" class="w-10 md:w-12 text-center text-sm font-medium border-none focus:ring-0 p-0 text-gray-900 qty-input" readonly>
                                    <button class="px-2 md:px-3 text-gray-500 hover:text-black hover:bg-gray-50 h-full rounded-r-lg transition increase-qty">+</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ITEM 2 -->
                    <div class="p-4 md:p-6 flex gap-4 md:gap-6 items-center">
                        <input type="checkbox" class="item-check w-5 h-5 accent-black cursor-pointer rounded border-gray-300 flex-shrink-0">
                        
                        <div class="w-20 h-24 md:w-24 md:h-28 bg-gray-100 rounded-lg overflow-hidden flex-shrink-0">
                            <!-- Ganti gambar sesuai kebutuhan -->
                            <img src="{{ asset('images/katalog/coze jacket classy black.png') }}" alt="Coze Jacket" class="w-full h-full object-cover">
                        </div>

                        <div class="flex-1 min-w-0">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="text-base font-semibold text-gray-900 line-clamp-1">Coze Jacket Classy Black</h3>
                                    <p class="text-xs md:text-sm text-gray-500 mt-1">Warna: Hitam | Size: XL</p>
                                </div>
                                <button class="hidden md:block text-gray-400 hover:text-red-500 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                </button>
                            </div>

                            <div class="flex justify-between items-end mt-4">
                                <div class="font-bold text-gray-900">Rp 372.000</div>
                                
                                <div class="flex items-center border border-gray-300 rounded-lg h-8 md:h-9">
                                    <button class="px-2 md:px-3 text-gray-500 hover:text-black hover:bg-gray-50 h-full rounded-l-lg transition decrease-qty">-</button>
                                    <input type="number" value="1" min="1" class="w-10 md:w-12 text-center text-sm font-medium border-none focus:ring-0 p-0 text-gray-900 qty-input" readonly>
                                    <button class="px-2 md:px-3 text-gray-500 hover:text-black hover:bg-gray-50 h-full rounded-r-lg transition increase-qty">+</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- KOLOM SAMPING (RINGKASAN) - DESKTOP -->
            <div class="lg:col-span-1 hidden lg:block">
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 sticky top-24">
                    <h3 class="text-lg font-bold text-gray-900 mb-6">Ringkasan Pesanan</h3>
                    
                    <div class="space-y-3 text-sm text-gray-600 mb-6">
                        <div class="flex justify-between">
                            <span>Subtotal (2 item)</span>
                            <span class="font-medium text-gray-900">Rp 1.622.000</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Estimasi Pengiriman</span>
                            <!-- Placeholder -->
                            <span class="text-gray-400 italic">Hitung di checkout</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Diskon</span>
                            <span class="text-green-600">-Rp 0</span>
                        </div>
                    </div>

                    <div class="border-t border-dashed border-gray-300 pt-4 mb-6">
                        <div class="flex justify-between items-center">
                            <span class="text-base font-bold text-gray-900">Total Belanja</span>
                            <span class="text-xl font-bold text-black">Rp 1.622.000</span>
                        </div>
                        <p class="text-xs text-gray-400 mt-1 text-right">Termasuk PPN</p>
                    </div>

                    <a href="{{ route('checkout') }}" class="block w-full bg-black text-white text-center font-bold py-3.5 rounded-xl hover:bg-gray-800 transition transform active:scale-[0.99] shadow-lg">
                        Lanjut ke Pembayaran
                    </a>
                    
                    <!-- Security Badge -->
                    <div class="flex items-center justify-center gap-2 mt-4 text-gray-400 text-xs">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                        Transaksi Aman & Terenkripsi
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- MOBILE STICKY FOOTER (Pengganti Summary di Mobile) -->
    <div class="fixed bottom-0 left-0 w-full bg-white border-t border-gray-200 p-4 lg:hidden z-50 shadow-[0_-4px_6px_-1px_rgba(0,0,0,0.05)]">
        <div class="flex items-center justify-between max-w-6xl mx-auto">
            <div class="flex flex-col">
                <span class="text-sm text-gray-500">Total Harga</span>
                <span class="text-lg font-bold text-black">Rp 1.622.000</span>
            </div>
            <a href="{{ route('checkout') }}" class="bg-black text-white font-bold py-3 px-8 rounded-lg hover:bg-gray-800 transition text-sm">
                Checkout (2)
            </a>
        </div>
    </div>

    <!-- Script Sederhana untuk Qty & Checkbox -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Select All Logic
            const selectAll = document.getElementById('selectAll');
            const itemChecks = document.querySelectorAll('.item-check');

            if(selectAll) {
                selectAll.addEventListener('change', function() {
                    itemChecks.forEach(check => check.checked = this.checked);
                });
            }

            // Quantity Button Logic (Frontend Only)
            document.querySelectorAll('.increase-qty').forEach(btn => {
                btn.addEventListener('click', function() {
                    const input = this.previousElementSibling;
                    input.value = parseInt(input.value) + 1;
                });
            });

            document.querySelectorAll('.decrease-qty').forEach(btn => {
                btn.addEventListener('click', function() {
                    const input = this.nextElementSibling;
                    if (parseInt(input.value) > 1) {
                        input.value = parseInt(input.value) - 1;
                    }
                });
            });
        });
    </script>
</body>
</html>