<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja - Rifold</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-800 pb-24 md:pb-10">

    @include('components.navbar')

    <div class="container mx-auto px-4 md:px-6 py-10 max-w-6xl pt-28">

        <!-- Header -->
        <div class="flex justify-between items-end mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Keranjang Saya</h1>
                <p class="text-gray-500 text-sm mt-1">{{ $cartItems->count() }} item di keranjangmu</p>
            </div>
            <a href="{{ route('checkout.index') }}"
                class="hidden md:flex items-center text-sm font-medium text-gray-600 hover:text-black transition">
                Lanjutkan Belanja
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M14 5l7 7m0 0l-7 7m7-7H3" />
                </svg>
            </a>
        </div>

        @if ($cartItems->count() > 0)
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">

                <!-- KOLOM UTAMA (DAFTAR PRODUK) -->
                <div class="lg:col-span-2 space-y-6">

                    <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 flex items-center">
                        <input type="checkbox" id="selectAll"
                            class="w-5 h-5 accent-black cursor-pointer rounded border-gray-300">
                        <label for="selectAll"
                            class="ml-3 text-sm font-medium text-gray-700 cursor-pointer select-none">Pilih Semua
                            Produk</label>
                    </div>

                    <!-- LIST ITEM LOOPING -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">

                        @foreach ($cartItems as $item)
                            <div
                                class="p-4 md:p-6 border-b border-gray-100 flex gap-4 md:gap-6 items-center last:border-0">
                                <!-- Checkbox -->
                                <input type="checkbox"
                                    class="item-check w-5 h-5 accent-black cursor-pointer rounded border-gray-300 flex-shrink-0"
                                    data-price="{{ $item->product->price * $item->quantity }}">


                                <!-- Image -->
                                <div
                                    class="w-20 h-24 md:w-24 md:h-28 bg-gray-100 rounded-lg overflow-hidden flex-shrink-0">
                                    @if (isset($item->product->images) && count($item->product->images) > 0)
                                        <img src="{{ asset('storage/' . $item->product->images[0]) }}"
                                            class="w-full h-full object-cover">
                                    @else
                                        <img src="https://via.placeholder.com/100" class="w-full h-full object-cover">
                                    @endif
                                </div>

                                <!-- Details -->
                                <div class="flex-1 min-w-0">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h3 class="text-base font-semibold text-gray-900 line-clamp-1">
                                                {{ $item->product->name }}</h3>
                                            <p class="text-xs md:text-sm text-gray-500 mt-1">
                                                Warna: {{ $item->product->color ?? '-' }} | Size: {{ $item->size }}
                                            </p>
                                        </div>

                                        <!-- Remove Button -->
                                        <form action="{{ route('cart.destroy', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-gray-400 hover:text-red-500 transition">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>

                                    <div class="flex justify-between items-end mt-4">
                                        <div class="font-bold text-gray-900">
                                            Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}
                                        </div>

                                        <!-- Quantity Control -->
                                        <div class="flex items-center border border-gray-300 rounded-lg h-8 md:h-9">
                                            {{-- Tombol Kurang --}}
                                            <form action="{{ route('cart.update', $item->id) }}" method="POST">
                                                @csrf @method('PATCH')
                                                <input type="hidden" name="type" value="decrease">
                                                <button type="submit"
                                                    class="px-2 md:px-3 text-gray-500 hover:text-black hover:bg-gray-50 h-full rounded-l-lg transition">-</button>
                                            </form>

                                            <input type="number" value="{{ $item->quantity }}"
                                                class="w-10 md:w-12 text-center text-sm font-medium border-none focus:ring-0 p-0 text-gray-900"
                                                readonly>

                                            {{-- Tombol Tambah --}}
                                            <form action="{{ route('cart.update', $item->id) }}" method="POST">
                                                @csrf @method('PATCH')
                                                <input type="hidden" name="type" value="increase">
                                                <button type="submit"
                                                    class="px-2 md:px-3 text-gray-500 hover:text-black hover:bg-gray-50 h-full rounded-r-lg transition">+</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>

                <!-- KOLOM SAMPING (RINGKASAN) -->
                <div class="lg:col-span-1 hidden lg:block">
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 sticky top-24">
                        <h3 class="text-lg font-bold text-gray-900 mb-6">Ringkasan Pesanan</h3>

                        <div class="space-y-3 text-sm text-gray-600 mb-6">
                            <div class="flex justify-between">
                                <span>Subtotal ({{ $cartItems->sum('quantity') }} item)</span>
                                <span id="subtotalText" class="font-medium text-gray-900">Rp 0</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Estimasi Pengiriman</span>
                                <span class="text-gray-400 italic">Hitung di checkout</span>
                            </div>
                        </div>

                        <div class="border-t border-dashed border-gray-300 pt-4 mb-6">
                            <div class="flex justify-between items-center">
                                <span class="text-base font-bold text-gray-900">Total Belanja</span>
                                <span id="totalText" class="text-xl font-bold text-black">Rp 0</span>
                            </div>
                        </div>

                        <a href="{{ route('checkout.index') }}" id="checkoutBtn"
                            class="block w-full bg-black text-white text-center font-bold py-3.5 rounded-xl hover:bg-gray-800 transition transform active:scale-[0.99] shadow-lg opacity-50 pointer-events-none">
                            Lanjut ke Pembayaran
                        </a>

                    </div>
                </div>

            </div>
        @else
            {{-- TAMPILAN JIKA CART KOSONG --}}
            <div class="text-center py-20 bg-white rounded-xl border border-dashed border-gray-200">
                <div
                    class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4 text-gray-400 text-2xl">
                    <i class="fa-solid fa-cart-shopping"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-900">Keranjang kamu kosong</h3>
                <p class="text-gray-500 mb-6">Yuk, isi dengan barang-barang impianmu!</p>
                <a href="{{ route('katalog') }}"
                    class="inline-block bg-black text-white px-6 py-2.5 rounded-lg font-medium hover:bg-gray-800 transition">
                    Mulai Belanja
                </a>
            </div>
        @endif

    </div>

    <!-- MOBILE STICKY FOOTER -->
    <div
        class="fixed bottom-0 left-0 w-full bg-white border-t border-gray-200 p-4 lg:hidden z-50 shadow-[0_-4px_6px_-1px_rgba(0,0,0,0.05)]">
        <div class="flex items-center justify-between max-w-6xl mx-auto">
            <div class="flex flex-col">
                <span class="text-sm text-gray-500">Total Harga</span>
                <span id="mobileTotalText" class="text-lg font-bold text-black">Rp 0</span>
            </div>
            @if ($cartItems->count() > 0)
                <a href="{{ route('checkout.index') }}" id="mobileCheckoutBtn"
                    class="bg-black text-white font-bold py-3 px-8 rounded-lg hover:bg-gray-800 transition text-sm opacity-50 pointer-events-none">
                    Checkout
                </a>
            @endif
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkboxes = document.querySelectorAll('.item-check');
            const selectAll = document.getElementById('selectAll');

            const subtotalText = document.getElementById('subtotalText');
            const totalText = document.getElementById('totalText');
            const mobileTotalText = document.getElementById('mobileTotalText');

            const checkoutBtn = document.getElementById('checkoutBtn');
            const mobileCheckoutBtn = document.getElementById('mobileCheckoutBtn');

            function formatRupiah(number) {
                return 'Rp ' + number.toLocaleString('id-ID');
            }

            function updateTotal() {
                let total = 0;
                let checkedCount = 0;

                checkboxes.forEach(cb => {
                    if (cb.checked) {
                        total += parseInt(cb.dataset.price);
                        checkedCount++;
                    }
                });

                subtotalText.innerText = formatRupiah(total);
                totalText.innerText = formatRupiah(total);
                mobileTotalText.innerText = formatRupiah(total);

                // ✅ AKTIF / NONAKTIF TOMBOL CHECKOUT
                if (checkedCount > 0) {
                    checkoutBtn.classList.remove('opacity-50', 'pointer-events-none');
                    mobileCheckoutBtn.classList.remove('opacity-50', 'pointer-events-none');
                } else {
                    checkoutBtn.classList.add('opacity-50', 'pointer-events-none');
                    mobileCheckoutBtn.classList.add('opacity-50', 'pointer-events-none');
                }
            }

            // Checkbox per item
            checkboxes.forEach(cb => {
                cb.addEventListener('change', function() {
                    selectAll.checked = [...checkboxes].every(c => c.checked);
                    updateTotal();
                });
            });

            // Checkbox pilih semua
            selectAll.addEventListener('change', function() {
                checkboxes.forEach(cb => {
                    cb.checked = selectAll.checked;
                });
                updateTotal();
            });

            // ✅ VALIDASI SAAT KLIK TOMBOL (DOUBLE SAFETY)
            checkoutBtn.addEventListener('click', function(e) {
                const anyChecked = [...checkboxes].some(cb => cb.checked);
                if (!anyChecked) {
                    e.preventDefault();
                    alert('Silakan pilih minimal 1 produk untuk melanjutkan pembayaran.');
                }
            });

            mobileCheckoutBtn.addEventListener('click', function(e) {
                const anyChecked = [...checkboxes].some(cb => cb.checked);
                if (!anyChecked) {
                    e.preventDefault();
                    alert('Silakan pilih minimal 1 produk untuk melanjutkan pembayaran.');
                }
            });

            updateTotal(); // init saat load
        });
    </script>



</body>

</html>
