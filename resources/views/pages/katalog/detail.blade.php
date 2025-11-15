<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Detail Produk — Polo Tonepop Cactus Green</title>

    <!-- TAILWIND WAJIB (AGAR TIDAK BERANTAKAN) -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        @keyframes fade {
            from { opacity: 0; transform: scale(.95); }
            to   { opacity: 1; transform: scale(1); }
        }
        .animate-fade { animation: fade .25s ease-out; }
    </style>
</head>

<body class="bg-white">

{{-- NAVBAR --}}
@include('components.navbar')

<main class="w-full pt-28 pb-20 bg-white">

    <div class="container mx-auto px-6">

        {{-- GRID WRAPPER --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-14">

            {{-- LEFT IMAGE SECTION --}}
            <div>
                <div class="relative border rounded-xl shadow overflow-hidden bg-gray-50">
                    <img id="mainImage"
                        src="{{ asset('images/detail/polo tonepop cactus detail.webp') }}"
                        class="w-full object-cover rounded-xl transition-all duration-300">

                    {{-- ARROWS --}}
                    <button id="prevBtn"
                        class="absolute top-1/2 left-3 -translate-y-1/2 bg-black/70 text-white px-2 py-1 rounded-full text-lg">
                        &#10094;
                    </button>

                    <button id="nextBtn"
                        class="absolute top-1/2 right-3 -translate-y-1/2 bg-black/70 text-white px-2 py-1 rounded-full text-lg">
                        &#10095;
                    </button>
                </div>

                {{-- THUMBNAILS --}}
                <div class="flex gap-3 mt-4">
                    @foreach([
                        'images/cactus green.png',
                        'images/detail/polo tonepop cactus detail.webp',
                        'images/detail/polo tonepop cactus detail1.webp',
                        'images/detail/polo tonepop cactus detail 2.webp'
                    ] as $thumb)
                        <img src="{{ asset($thumb) }}"
                            class="thumb w-1/4 aspect-square object-cover rounded-lg border shadow-sm cursor-pointer hover:opacity-80 transition">
                    @endforeach
                </div>
            </div>

            {{-- PRODUCT INFORMATION --}}
            <div class="space-y-6">

                <span class="px-4 py-1 bg-gray-100 rounded-full text-sm tracking-wide">
                    Polo Shirt
                </span>

                <h1 class="text-4xl font-extrabold leading-tight">
                    Polo Tonepop Cactus Green
                </h1>

                <p class="text-gray-600 leading-relaxed">
                    RIFOLD Polo TonePop Cactus Green – Twotone Polo Shirt Oversized Cactus Green Kasual Pria
                </p>

                <p class="text-3xl font-extrabold">Rp110.000</p>

                {{-- COLOR --}}
                <div>
                    <p class="font-semibold mb-1">Color</p>
                    <div class="w-8 h-8 rounded-full border bg-[#A3C5B5] shadow"></div>
                </div>

                {{-- SIZE --}}
                <div>
                    <p class="font-semibold mb-2">Size</p>
                    <div class="flex gap-2">
                        @foreach (['S','M','L','XL'] as $size)
                        <button data-size="{{ $size }}"
                            class="size-btn border border-gray-700 px-5 py-2 rounded-md hover:bg-black hover:text-white transition">
                            {{ $size }}
                        </button>
                        @endforeach
                    </div>
                    <span class="text-sm underline text-gray-500 mt-1 block cursor-pointer">Size guide</span>
                </div>

                {{-- QUANTITY --}}
                <div>
                    <p class="font-semibold mb-2">Quantity</p>
                    <div class="flex items-center gap-3">
                        <button id="decreaseQty" class="border px-3 py-1 rounded-md hover:bg-gray-100">-</button>
                        <input id="quantity" type="number" min="1" value="1"
                               class="border w-16 text-center rounded-md py-1">
                        <button id="increaseQty" class="border px-3 py-1 rounded-md hover:bg-gray-100">+</button>
                    </div>
                </div>

                {{-- BUTTONS --}}
                <div class="flex gap-4 pt-2">
                    <button id="addToCartBtn"
                        class="w-full bg-black text-white py-3 rounded-md font-semibold hover:bg-gray-800 transition">
                        ADD TO CART
                    </button>

                    <a href="{{ route('checkout') }}"
                        class="border rounded-md w-12 flex justify-center items-center hover:bg-gray-100 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.2 6.3A1 1 0 007 21h10a1 1 0 001-.9L20 13M7 13H5.4" />
                        </svg>
                    </a>
                </div>

            </div>
        </div>

        {{-- TAB SECTION --}}
        <div class="mt-16 border-b flex gap-10 text-lg font-semibold">
            <button class="border-b-2 border-black pb-2">DETAILS</button>
            <button class="text-gray-400 hover:text-black">REVIEWS</button>
        </div>

        {{-- PRODUCT DETAILS --}}
        <div class="mt-8 text-gray-700 leading-relaxed space-y-4">
            <p><strong>RIFOLD Polo TonePop Cactus Green – Twotone Polo Shirt Oversized Cactus Green Kasual Pria</strong></p>

            <p>
                Segarkan tampilanmu dengan warna Cactus Green – hijau lembut yang tidak mencolok tapi tetap standout.
                Desain two-tone dengan kombinasi kerah dan lengan broken white membuat kesan elegan dan versatile.
            </p>

            <div>
                <p class="font-semibold">Detail Produk Premium:</p>
                <ul class="list-disc ml-6 space-y-1">
                    <li>Warna: Cactus Green</li>
                    <li>Kombinasi: Kerah & lengan broken white</li>
                    <li>Bahan: 100% Premium Cotton Combed 24s</li>
                    <li>Gramasi: 185 GSM — ringan & breathable</li>
                    <li>SoftShield Technology — lebih lembut, tahan cuci</li>
                    <li>Jahitan rapi & potongan oversized modern</li>
                </ul>
            </div>

            <div>
                <p class="font-semibold">Karakteristik Kain:</p>
                <ul class="list-disc ml-6 space-y-1">
                    <li>Adem dan nyaman dipakai seharian</li>
                    <li>Halus dan menyerap keringat</li>
                    <li>Finishing matte yang clean dan elegan</li>
                </ul>
            </div>

            <div>
                <p class="font-semibold">Size Chart:</p>
                <ul class="list-disc ml-6 space-y-1">
                    <li>M: LD 53 cm, PB 66 cm, PL 40 cm</li>
                    <li>L: LD 57 cm, PB 69 cm, PL 42 cm</li>
                    <li>XL: LD 61 cm, PB 72 cm, PL 44 cm</li>
                </ul>
            </div>
        </div>

        {{-- YOU MIGHT ALSO LIKE --}}
        <div class="mt-24">
            <h2 class="text-center text-3xl font-bold mb-10">YOU MIGHT ALSO LIKE</h2>

            <div class="grid grid-cols-2 md:grid-cols-3 gap-8">
                @php
                    $recommendations = [
                        ['img' => 'images/katalog/coze jacket classy black.png', 'title' => 'COZE JACKET CLASSY BLACK'],
                        ['img' => 'images/katalog/Cityloop long.png', 'title' => 'CITY LOOP LONG SLEEVE'],
                        ['img' => 'images/katalog/Weekend walk.png', 'title' => 'WEEKEND WALK LONG SLEEVE'],
                    ];
                @endphp

                @foreach ($recommendations as $item)
                <div class="text-center hover:scale-105 transition cursor-pointer">
                    <img src="{{ asset($item['img']) }}"
                        class="rounded-lg shadow-md w-full object-cover">
                    <p class="font-semibold mt-3">{{ strtoupper($item['title']) }}</p>
                    <p>Rp149.900</p>
                </div>
                @endforeach
            </div>
        </div>

    </div>
</main>

{{-- FOOTER --}}
@include('components.footer')

{{-- POPUP --}}
<div id="cartPopup"
    class="hidden fixed inset-0 bg-black/40 flex justify-center items-center z-50">
    <div class="bg-white p-7 rounded-lg text-center shadow-xl animate-fade max-w-sm">
        <h2 class="text-2xl font-semibold text-green-700 mb-2">Added to Cart</h2>
        <p class="text-gray-600 mb-5">
            Polo Tonepop Cactus Green berhasil ditambahkan ke keranjangmu!
        </p>

        <div class="flex gap-3 justify-center">
            <a href="{{ route('checkout') }}"
                class="bg-black text-white px-4 py-2 rounded-md hover:bg-gray-800 transition">
                Checkout
            </a>

            <button id="closePopup"
                class="bg-gray-200 px-4 py-2 rounded-md hover:bg-gray-300 transition">
                Lanjut Belanja
            </button>
        </div>
    </div>
</div>

{{-- SCRIPTS --}}
<script>
    const images = [
        "{{ asset('images/cactus green.png') }}",
        "{{ asset('images/detail/polo tonepop cactus detail.webp') }}",
        "{{ asset('images/detail/polo tonepop cactus detail1.webp') }}",
        "{{ asset('images/detail/polo tonepop cactus detail 2.webp') }}"
    ];

    let current = 0;
    const mainImage = document.getElementById('mainImage');

    document.getElementById('prevBtn').onclick = () => {
        current = (current - 1 + images.length) % images.length;
        mainImage.src = images[current];
    };

    document.getElementById('nextBtn').onclick = () => {
        current = (current + 1) % images.length;
        mainImage.src = images[current];
    };

    document.querySelectorAll('.thumb').forEach((el, i) => {
        el.addEventListener('click', () => {
            current = i;
            mainImage.src = images[current];
        });
    });

    // SIZE SELECT
    document.querySelectorAll('.size-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            document.querySelectorAll('.size-btn')
                    .forEach(b => b.classList.remove('bg-black','text-white'));
            btn.classList.add('bg-black','text-white');
        });
    });

    // QUANTITY
    const qty = document.getElementById('quantity');
    document.getElementById('increaseQty').onclick = () => qty.value++;
    document.getElementById('decreaseQty').onclick = () => qty.value = Math.max(1, qty.value - 1);

    // POPUP
    const popup = document.getElementById('cartPopup');
    document.getElementById('addToCartBtn').onclick = () => {
        if (!document.querySelector('.size-btn.bg-black')) 
            return alert("Pilih ukuran dulu!");
        popup.classList.remove('hidden');
    };
    document.getElementById('closePopup').onclick = () => popup.classList.add('hidden');
</script>

</body>
</html>
