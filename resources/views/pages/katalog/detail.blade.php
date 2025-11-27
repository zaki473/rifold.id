<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Detail Produk — Polo Tonepop Cactus Green</title>

    <!-- TAILWIND CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- FONT POPPINS -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- FONT AWESOME (Untuk Bintang) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body { font-family: 'Poppins', sans-serif; }
        
        /* Animasi Pop-up */
        @keyframes fade {
            from { opacity: 0; transform: scale(.95); }
            to   { opacity: 1; transform: scale(1); }
        }
        .animate-fade { animation: fade .25s ease-out; }

        /* Hide number input arrows */
        input[type=number]::-webkit-inner-spin-button, 
        input[type=number]::-webkit-outer-spin-button { 
            -webkit-appearance: none; margin: 0; 
        }
    </style>
</head>

<body class="bg-white text-gray-800">

{{-- NAVBAR --}}
@include('components.navbar')

<main class="w-full pt-28 pb-24">

    <div class="container mx-auto px-4 md:px-6 max-w-6xl">

        {{-- GRID WRAPPER --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16">

            {{-- LEFT: IMAGE SECTION --}}
            <div>
                <!-- Main Image Wrapper -->
                <div class="relative w-full aspect-[4/5] bg-gray-100 rounded-xl overflow-hidden shadow-sm group">
                    <img id="mainImage"
                        src="{{ asset('images/detail/polo tonepop cactus detail.webp') }}"
                        class="w-full h-full object-cover object-top transition-transform duration-500">

                    {{-- Navigation Arrows --}}
                    <button id="prevBtn"
                        class="absolute top-1/2 left-4 -translate-y-1/2 bg-white/90 text-black hover:bg-black hover:text-white w-10 h-10 rounded-full flex items-center justify-center shadow-md transition-all opacity-0 group-hover:opacity-100">
                        <i class="fa-solid fa-chevron-left"></i>
                    </button>

                    <button id="nextBtn"
                        class="absolute top-1/2 right-4 -translate-y-1/2 bg-white/90 text-black hover:bg-black hover:text-white w-10 h-10 rounded-full flex items-center justify-center shadow-md transition-all opacity-0 group-hover:opacity-100">
                        <i class="fa-solid fa-chevron-right"></i>
                    </button>
                </div>

                {{-- THUMBNAILS --}}
                <div class="grid grid-cols-4 gap-4 mt-4">
                    @foreach([
                        'images/detail/polo tonepop cactus detail.webp',
                        'images/detail/polo tonepop cactus detail1.webp',
                        'images/detail/polo tonepop cactus detail 2.webp',
                        'images/detail/polo tonepop cactus detail 3.webp',
                    ] as $index => $thumb)
                        <div class="relative aspect-square cursor-pointer overflow-hidden rounded-lg border border-transparent hover:border-black transition-all group thumb-container" onclick="setActiveThumb()">
                            <img src="{{ asset($thumb) }}" class="thumb w-full h-full object-cover hover:scale-110 transition-transform duration-500">
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- RIGHT: PRODUCT INFORMATION --}}
            <div class="flex flex-col justify-center">

                <div class="mb-6">
                    <span class="inline-block px-3 py-1 bg-gray-100 text-gray-500 rounded-md text-xs font-semibold tracking-widest uppercase mb-3">
                        Polo Shirt
                    </span>
                    <h1 class="text-3xl md:text-4xl font-bold text-gray-900 leading-tight mb-2">
                        Polo Tonepop Cactus Green
                    </h1>

                    <!-- Rating Summary Kecil di Header -->
                    <div class="flex items-center gap-2 mb-4">
                        <div class="flex text-yellow-400 text-sm">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star-half-stroke"></i>
                        </div>
                        <a href="#reviews" class="text-sm text-gray-500 hover:text-black underline decoration-1 underline-offset-2">
                            4.8 (25 Reviews)
                        </a>
                    </div>

                    <p class="text-2xl font-semibold text-gray-900">Rp110.000</p>
                </div>

                <p class="text-gray-500 leading-relaxed mb-8 text-sm md:text-base">
                    RIFOLD Polo TonePop Cactus Green – Twotone Polo Shirt Oversized dengan bahan premium yang nyaman untuk gaya kasual harianmu.
                </p>

                {{-- COLOR --}}
                <div class="mb-6">
                    <p class="text-sm font-medium text-gray-900 mb-2 uppercase tracking-wide">Selected Color</p>
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 rounded-full bg-[#A3C5B5] ring-2 ring-offset-2 ring-gray-300"></div>
                        <span class="text-sm text-gray-600">Cactus Green</span>
                    </div>
                </div>

                {{-- SIZE --}}
                <div class="mb-8">
                    <div class="flex justify-between items-end mb-2">
                        <p class="text-sm font-medium text-gray-900 uppercase tracking-wide">Size</p>
                        <span class="text-xs text-gray-500 underline cursor-pointer hover:text-black">Size Guide</span>
                    </div>
                    <div class="flex flex-wrap gap-3">
                        @foreach (['S','M','L','XL'] as $size)
                        <button data-size="{{ $size }}"
                            class="size-btn min-w-[3.5rem] h-12 border border-gray-200 rounded-lg text-sm font-medium hover:border-black hover:text-black transition-all focus:outline-none">
                            {{ $size }}
                        </button>
                        @endforeach
                    </div>
                </div>

                {{-- QUANTITY & BUTTONS --}}
                <div class="flex flex-col sm:flex-row gap-4">
                    <div class="flex items-center border border-gray-300 rounded-lg h-12 w-fit sm:w-auto">
                        <button id="decreaseQty" class="px-4 text-gray-500 hover:text-black transition">-</button>
                        <input id="quantity" type="number" min="1" value="1" class="w-12 text-center text-gray-900 font-medium focus:outline-none h-full">
                        <button id="increaseQty" class="px-4 text-gray-500 hover:text-black transition">+</button>
                    </div>

                    <button id="addToCartBtn"
                        class="flex-1 bg-black text-white h-12 rounded-lg font-semibold hover:bg-gray-800 transition active:scale-[0.99] shadow-lg">
                        ADD TO CART
                    </button>

                    <button class="h-12 w-12 border border-gray-300 rounded-lg flex items-center justify-center hover:bg-gray-50 text-gray-600 transition">
                         <i class="fa-regular fa-heart text-lg"></i>
                    </button>
                </div>
            </div>
        </div>

        {{-- TAB SECTION (Details) --}}
        <div class="mt-20 border-t border-gray-100 pt-10">
            <h3 class="text-lg font-bold text-gray-900 mb-6 uppercase tracking-wider">Product Details</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10 text-gray-600 leading-relaxed text-sm md:text-base">
                <div class="space-y-4">
                    <p>
                        <strong>RIFOLD Polo TonePop Cactus Green.</strong> Segarkan tampilanmu dengan warna Cactus Green – hijau lembut yang tidak mencolok tapi tetap standout. Desain two-tone dengan kombinasi kerah dan lengan broken white membuat kesan elegan dan versatile.
                    </p>
                    <ul class="list-none space-y-2">
                        <li class="flex items-start"><span class="mr-2 text-black">•</span> 100% Premium Cotton Combed 24s</li>
                        <li class="flex items-start"><span class="mr-2 text-black">•</span> Gramasi 185 GSM (Ringan & Breathable)</li>
                        <li class="flex items-start"><span class="mr-2 text-black">•</span> SoftShield Technology (Lembut & Tahan Cuci)</li>
                        <li class="flex items-start"><span class="mr-2 text-black">•</span> Potongan Oversized Modern</li>
                    </ul>
                </div>
                <div class="bg-gray-50 p-6 rounded-xl">
                    <p class="font-semibold text-gray-900 mb-3">Size Chart (cm)</p>
                    <div class="grid grid-cols-3 gap-4 text-sm">
                        <div>
                            <span class="block font-bold text-black">M</span>
                            LD 53, PB 66, PL 40
                        </div>
                        <div>
                            <span class="block font-bold text-black">L</span>
                            LD 57, PB 69, PL 42
                        </div>
                        <div>
                            <span class="block font-bold text-black">XL</span>
                            LD 61, PB 72, PL 44
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- CUSTOMER REVIEWS SECTION --}}
        <div id="reviews" class="mt-20 border-t border-gray-100 pt-10 scroll-mt-24">
            
            <!-- Header Section Reviews -->
            <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
                <div>
                    <h3 class="text-lg font-bold text-gray-900 uppercase tracking-wider flex items-center gap-3">
                        Customer Reviews
                        <span class="bg-black text-white text-xs px-2 py-0.5 rounded-full">25</span>
                    </h3>
                    <div class="flex items-center gap-2 mt-1">
                        <div class="flex text-yellow-400 text-sm">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star-half-stroke"></i>
                        </div>
                        <p class="text-sm text-gray-500 font-medium">4.8 out of 5</p>
                    </div>
                </div>
                
                <!-- [PERBAIKAN] Route ke Halaman Tulis Review -->
                {{-- Menggunakan route('reviews.create', ['id' => $id]) --}}
                <a href="{{ route('reviews.create', ['id' => $id ?? 1]) }}" 
                   class="inline-flex items-center justify-center px-6 py-2 border border-gray-300 rounded-full text-sm font-semibold text-gray-700 hover:border-black hover:text-black transition">
                    Write a Review
                </a>
            </div>

            <!-- Review Cards Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <!-- Review Item 1 -->
                <div class="bg-gray-50 p-6 rounded-xl">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex items-center gap-3">
                            <!-- Avatar Placeholder -->
                            <div class="w-10 h-10 rounded-full bg-gray-300 flex items-center justify-center text-gray-600 font-bold">
                                JD
                            </div>
                            <div>
                                <p class="text-sm font-bold text-gray-900">John Doe</p>
                                <p class="text-xs text-gray-500">2 days ago</p>
                            </div>
                        </div>
                        <!-- Stars -->
                        <div class="text-yellow-400 text-xs">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                        </div>
                    </div>
                    <h4 class="font-semibold text-gray-900 text-sm mb-2">Sangat nyaman dipakai!</h4>
                    <p class="text-sm text-gray-600 leading-relaxed">
                        Bahannya beneran adem dan potongannya pas banget buat yang suka gaya oversized. Pengiriman juga cepet. Worth it banget!
                    </p>
                </div>

                <!-- Review Item 2 -->
                <div class="bg-gray-50 p-6 rounded-xl">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-gray-300 flex items-center justify-center text-gray-600 font-bold">
                                AS
                            </div>
                            <div>
                                <p class="text-sm font-bold text-gray-900">Amanda S.</p>
                                <p class="text-xs text-gray-500">1 week ago</p>
                            </div>
                        </div>
                        <div class="text-yellow-400 text-xs">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-regular fa-star"></i>
                        </div>
                    </div>
                    <h4 class="font-semibold text-gray-900 text-sm mb-2">Bagus, tapi warna agak beda</h4>
                    <p class="text-sm text-gray-600 leading-relaxed">
                        Kualitas kain oke banget, tebal tapi ga panas. Cuma warnanya sedikit lebih terang dari foto, tapi tetep keren sih.
                    </p>
                </div>

            </div>

            <!-- View All Reviews Button -->
            <div class="mt-8 text-center">
                <a href="#" class="inline-block text-sm font-semibold text-black border-b border-black pb-0.5 hover:text-gray-600 hover:border-gray-600 transition">
                    View All 25 Reviews
                </a>
            </div>
        </div>

        {{-- YOU MIGHT ALSO LIKE --}}
        <div class="mt-24">
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-2xl font-bold text-gray-900">You Might Also Like</h2>
                <a href="{{ route('katalog') }}" class="text-sm font-medium text-gray-500 hover:text-black underline">View All</a>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-6 lg:gap-8">
                @php
                    $recommendations = [
                        ['img' => 'images/katalog/coze jacket classy black.png', 'title' => 'Coze Jacket Classy Black', 'price' => '149.900'],
                        ['img' => 'images/katalog/Cityloop long.png', 'title' => 'City Loop Long Sleeve', 'price' => '149.900'],
                        ['img' => 'images/katalog/Weekend walk.png', 'title' => 'Weekend Walk Long Sleeve', 'price' => '149.900'],
                    ];
                @endphp

                @foreach ($recommendations as $item)
                <div class="group cursor-pointer">
                    <div class="relative w-full aspect-[4/5] bg-gray-100 rounded-xl overflow-hidden mb-4">
                        <img src="{{ asset($item['img']) }}"
                             class="w-full h-full object-cover object-top transition-transform duration-700 group-hover:scale-105">
                    </div>
                    <div class="text-center md:text-left">
                        <h3 class="font-medium text-gray-900 text-base mb-1 group-hover:underline decoration-1 underline-offset-4 line-clamp-1">
                            {{ $item['title'] }}
                        </h3>
                        <p class="text-gray-500 text-sm font-semibold">Rp{{ $item['price'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

    </div>
</main>

{{-- FOOTER --}}
@include('components.footer')

{{-- POPUP NOTIFICATION --}}
<div id="cartPopup"
    class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm flex justify-center items-center z-50 transition-all">
    <div class="bg-white p-8 rounded-2xl text-center shadow-2xl animate-fade max-w-sm w-full mx-4">
        <div class="w-16 h-16 bg-green-100 text-green-600 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
        </div>
        <h2 class="text-xl font-bold text-gray-900 mb-2">Berhasil Ditambahkan</h2>
        <p class="text-gray-500 text-sm mb-6">
            Produk telah masuk ke keranjang belanjaanmu.
        </p>

        <div class="flex flex-col gap-3">
            <a href="{{ route('checkout') }}"
                class="w-full bg-black text-white py-3 rounded-lg font-medium hover:bg-gray-800 transition">
                Checkout Sekarang
            </a>
            <button id="closePopup"
                class="w-full bg-white border border-gray-200 text-gray-700 py-3 rounded-lg font-medium hover:bg-gray-50 transition">
                Lanjut Belanja
            </button>
        </div>
    </div>
</div>

{{-- SCRIPTS --}}
<script>
    const images = [
        "{{ asset('images/detail/polo tonepop cactus detail.webp') }}",
        "{{ asset('images/detail/polo tonepop cactus detail1.webp') }}",
        "{{ asset('images/detail/polo tonepop cactus detail 2.webp') }}",
        "{{ asset('images/detail/polo tonepop cactus detail 3.webp') }}"
    ];

    let current = 0;
    const mainImage = document.getElementById('mainImage');

    function updateImage() {
        mainImage.style.opacity = 0;
        setTimeout(() => {
            mainImage.src = images[current];
            mainImage.style.opacity = 1;
        }, 150);
    }

    document.getElementById('prevBtn').onclick = () => {
        current = (current - 1 + images.length) % images.length;
        updateImage();
    };

    document.getElementById('nextBtn').onclick = () => {
        current = (current + 1) % images.length;
        updateImage();
    };

    const thumbs = document.querySelectorAll('.thumb-container');
    thumbs.forEach((el, i) => {
        el.addEventListener('click', () => {
            current = i;
            updateImage();
            thumbs.forEach(t => t.classList.remove('border-black'));
            el.classList.add('border-black');
        });
    });

    let selectedSize = null;
    document.querySelectorAll('.size-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            document.querySelectorAll('.size-btn')
                    .forEach(b => {
                        b.classList.remove('bg-black','text-white','border-black');
                        b.classList.add('border-gray-200');
                    });
            btn.classList.remove('border-gray-200');
            btn.classList.add('bg-black','text-white','border-black');
            selectedSize = btn.dataset.size;
        });
    });

    const qty = document.getElementById('quantity');
    document.getElementById('increaseQty').onclick = () => qty.value++;
    document.getElementById('decreaseQty').onclick = () => qty.value = Math.max(1, qty.value - 1);

    const popup = document.getElementById('cartPopup');
    document.getElementById('addToCartBtn').onclick = () => {
        if (!selectedSize) {
            alert("Harap pilih ukuran terlebih dahulu!");
            return;
        }
        popup.classList.remove('hidden');
    };
    
    document.getElementById('closePopup').onclick = () => popup.classList.add('hidden');
    popup.onclick = (e) => {
        if(e.target === popup) popup.classList.add('hidden');
    }
</script>

</body>
</html>