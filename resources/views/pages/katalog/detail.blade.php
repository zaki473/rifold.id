<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk — {{ $product->name }}</title>

    <!-- TAILWIND CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- FONT POPPINS -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body { font-family: 'Poppins', sans-serif; }
        @keyframes fade {
            from { opacity: 0; transform: scale(.95); }
            to   { opacity: 1; transform: scale(1); }
        }
        .animate-fade { animation: fade .25s ease-out; }
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
                    @if(is_array($product->images) && count($product->images) > 0)
                        <img id="mainImage"
                            src="{{ asset('storage/' . $product->images[0]) }}"
                            class="w-full h-full object-cover object-top transition-transform duration-500">
                    @else
                        <img id="mainImage" src="https://via.placeholder.com/400" class="w-full h-full object-cover">
                    @endif

                    <button id="prevBtn"
                        class="absolute top-1/2 left-4 -translate-y-1/2 bg-white/90 text-black hover:bg-black hover:text-white w-10 h-10 rounded-full flex items-center justify-center shadow-md transition-all opacity-0 group-hover:opacity-100">
                        <i class="fa-solid fa-chevron-left"></i>
                    </button>

                    <button id="nextBtn"
                        class="absolute top-1/2 right-4 -translate-y-1/2 bg-white/90 text-black hover:bg-black hover:text-white w-10 h-10 rounded-full flex items-center justify-center shadow-md transition-all opacity-0 group-hover:opacity-100">
                        <i class="fa-solid fa-chevron-right"></i>
                    </button>
                </div>

                {{-- THUMBNAILS LOOP --}}
                <div class="grid grid-cols-4 gap-4 mt-4">
                    @if(is_array($product->images))
                        @foreach($product->images as $index => $img)
                            @if(is_string($img))
                                <div class="relative aspect-square cursor-pointer overflow-hidden rounded-lg border border-transparent hover:border-black transition-all group thumb-container" 
                                     onclick="changeMainImage('{{ asset('storage/' . $img) }}')">
                                    <img src="{{ asset('storage/' . $img) }}" class="thumb w-full h-full object-cover hover:scale-110 transition-transform duration-500">
                                </div>
                            @endif
                        @endforeach
                    @endif
                </div>
            </div>

            {{-- RIGHT: PRODUCT INFORMATION --}}
            <div class="flex flex-col justify-center">
                <div class="mb-6">
                    <span class="inline-block px-3 py-1 bg-gray-100 text-gray-500 rounded-md text-xs font-semibold tracking-widest uppercase mb-3">
                        {{ $product->category }}
                    </span>
                    <h1 class="text-3xl md:text-4xl font-bold text-gray-900 leading-tight mb-2">
                        {{ $product->name }}
                    </h1>
                    <div class="flex items-center gap-2 mb-4">
                        <div class="flex text-yellow-400 text-sm">
                            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star-half-stroke"></i>
                        </div>
                        <a href="#reviews" class="text-sm text-gray-500 hover:text-black underline decoration-1 underline-offset-2">
                            4.8 (25 Reviews)
                        </a>
                    </div>
                    <p class="text-2xl font-semibold text-gray-900">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </p>
                </div>

                <p class="text-gray-500 leading-relaxed mb-8 text-sm md:text-base">
                    {{ $product->description }}
                </p>

                <div class="mb-6">
                    <p class="text-sm font-medium text-gray-900 mb-2 uppercase tracking-wide">Selected Color</p>
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 rounded-full bg-gray-200 ring-2 ring-offset-2 ring-gray-300"></div>
                        <span class="text-sm text-gray-600">{{ $product->color }}</span>
                    </div>
                </div>

                <div class="mb-8">
                    <div class="flex justify-between items-end mb-2">
                        <p class="text-sm font-medium text-gray-900 uppercase tracking-wide">Size</p>
                        <span class="text-xs text-gray-500 underline cursor-pointer hover:text-black">Size Guide</span>
                    </div>
                    <div class="flex flex-wrap gap-3">
                        @if($product->size)
                            @foreach(explode(',', $product->size) as $s)
                                <button data-size="{{ trim($s) }}"
                                    class="size-btn min-w-[3.5rem] h-12 border border-gray-200 rounded-lg text-sm font-medium hover:border-black hover:text-white transition-all focus:outline-none">
                                    {{ trim($s) }}
                                </button>
                            @endforeach
                        @else
                             <span class="text-xs text-gray-500">All Size</span>
                        @endif
                    </div>
                </div>

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
                </div>
            </div>
        </div>

        <div class="mt-20 border-t border-gray-100 pt-10">
            <h3 class="text-lg font-bold text-gray-900 mb-6 uppercase tracking-wider">Product Details</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10 text-gray-600 leading-relaxed text-sm md:text-base">
                <div class="space-y-4">
                    <p>{{ $product->description }}</p>
                    <ul class="list-none space-y-2">
                        <li class="flex items-start"><span class="mr-2 text-black">•</span> 100% Premium Material</li>
                        <li class="flex items-start"><span class="mr-2 text-black">•</span> Comfortable & Breathable</li>
                    </ul>
                </div>
                <div class="bg-gray-50 p-6 rounded-xl">
                    <p class="font-semibold text-gray-900 mb-3">Size Chart (cm)</p>
                    <div class="grid grid-cols-3 gap-4 text-sm">
                        <div><span class="block font-bold text-black">M</span> LD 53, PB 66</div>
                        <div><span class="block font-bold text-black">L</span> LD 57, PB 69</div>
                        <div><span class="block font-bold text-black">XL</span> LD 61, PB 72</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- CUSTOMER REVIEWS --}}
        <div id="reviews" class="mt-20 border-t border-gray-100 pt-10 scroll-mt-24">
            <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
                <div>
                    <h3 class="text-lg font-bold text-gray-900 uppercase tracking-wider flex items-center gap-3">
                        Customer Reviews
                        <span class="bg-black text-white text-xs px-2 py-0.5 rounded-full">25</span>
                    </h3>
                    <div class="flex items-center gap-2 mt-1">
                        <div class="flex text-yellow-400 text-sm">
                            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star-half-stroke"></i>
                        </div>
                        <p class="text-sm text-gray-500 font-medium">4.8 out of 5</p>
                    </div>
                </div>
                <a href="{{ route('reviews.create', ['id' => $product->id]) }}" 
                   class="inline-flex items-center justify-center px-6 py-2 border border-gray-300 rounded-full text-sm font-semibold text-gray-700 hover:border-black hover:text-black transition">
                    Write a Review
                </a>
            </div>
            <!-- Review items placeholder -->
            <p class="text-gray-500 text-sm">Reviews will appear here.</p>
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
            <a href="{{ route('cart') }}"
                class="w-full bg-black text-white py-3 rounded-lg font-medium hover:bg-gray-800 transition block">
                Lihat Keranjang
            </a>
            <button id="closePopup"
                class="w-full bg-white border border-gray-200 text-gray-700 py-3 rounded-lg font-medium hover:bg-gray-50 transition">
                Lanjut Belanja
            </button>
        </div>
    </div>
</div>

{{-- SCRIPT: KITA PROSES DATA DI SINI DULU BIAR JS BERSIH --}}
@php
    $dataGambar = [];
    if(isset($product->images) && is_array($product->images)) {
        foreach($product->images as $img) {
            if(is_string($img)) {
                $dataGambar[] = asset('storage/' . $img);
            }
        }
    }
@endphp

{{-- ============================================================ --}}
{{-- 1. SIAPKAN DATA DI PHP (Di luar Script, jadi aman) --}}
{{-- ============================================================ --}}
@php
    $dataGambar = [];
    if(isset($product->images) && is_array($product->images)) {
        foreach($product->images as $img) {
            if(is_string($img)) {
                $dataGambar[] = asset('storage/' . $img);
            }
        }
    }
@endphp

{{-- ============================================================ --}}
{{-- 2. SIMPAN DATA DI ELEMENT HTML TERSEMBUNYI (Hidden Input) --}}
{{-- ============================================================ --}}
{{-- 
    Trik ini bikin VS Code gak bingung. 
    Data PHP disimpan sebagai text biasa di HTML. 
    Perhatikan tanda petik satu (') di value.
--}}
<input type="hidden" id="data-gambar-server" value='@json($dataGambar)'>


{{-- ============================================================ --}}
{{-- 3. JAVASCRIPT (MURNI JS, TIDAK ADA PHP DI SINI) --}}
{{-- ============================================================ --}}
<script>
    // Ambil data dari Hidden Input di atas
    const rawData = document.getElementById('data-gambar-server').value;
    
    // Ubah Text menjadi Array Javascript yang beneran
    const images = JSON.parse(rawData);

    // --- SISA KODE SAMA PERSIS, TAPI DIJAMIN GAK ERROR ---
    
    let current = 0;
    const mainImage = document.getElementById('mainImage');

    function changeMainImage(src) {
        if(mainImage) mainImage.src = src;
    }
    
    function updateImage() {
        if(images.length > 0 && mainImage) {
            mainImage.style.opacity = 0;
            setTimeout(() => {
                mainImage.src = images[current];
                mainImage.style.opacity = 1;
            }, 150);
        }
    }

    const prevBtn = document.getElementById('prevBtn');
    if(prevBtn) {
        prevBtn.onclick = () => {
            if(images.length > 0) {
                current = (current - 1 + images.length) % images.length;
                updateImage();
            }
        };
    }

    const nextBtn = document.getElementById('nextBtn');
    if(nextBtn) {
        nextBtn.onclick = () => {
             if(images.length > 0) {
                current = (current + 1) % images.length;
                updateImage();
            }
        };
    }

    const thumbs = document.querySelectorAll('.thumb-container');
    thumbs.forEach((el, i) => {
        el.addEventListener('click', () => {
            current = i;
            thumbs.forEach(t => t.classList.remove('border-black'));
            el.classList.add('border-black');
        });
    });

    let selectedSize = null;
    document.querySelectorAll('.size-btn').forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault(); 
            document.querySelectorAll('.size-btn').forEach(b => {
                b.classList.remove('bg-black','text-white','border-black');
                b.classList.add('border-gray-200');
            });
            btn.classList.remove('border-gray-200');
            btn.classList.add('bg-black','text-white','border-black');
            selectedSize = btn.dataset.size;
        });
    });

    const qty = document.getElementById('quantity');
    const incBtn = document.getElementById('increaseQty');
    const decBtn = document.getElementById('decreaseQty');

    if(qty && incBtn && decBtn) {
        incBtn.onclick = () => qty.value++;
        decBtn.onclick = () => qty.value = Math.max(1, qty.value - 1);
    }

    const popup = document.getElementById('cartPopup');
    const addBtn = document.getElementById('addToCartBtn');
    const closeBtn = document.getElementById('closePopup');

    if(addBtn && popup) {
        addBtn.onclick = () => {
            const hasSize = document.querySelectorAll('.size-btn').length > 0;
            if (hasSize && !selectedSize) {
                alert("Harap pilih ukuran (Size) terlebih dahulu!");
                return;
            }
            popup.classList.remove('hidden');
        };
    }
    
    if(closeBtn && popup) {
        closeBtn.onclick = () => popup.classList.add('hidden');
    }

    if(popup) {
        popup.onclick = (e) => {
            if(e.target === popup) popup.classList.add('hidden');
        }
    }
</script>