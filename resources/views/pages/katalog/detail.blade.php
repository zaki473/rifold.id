<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk — {{ $product->name }}</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body { font-family: 'Poppins', sans-serif; }

        /* Style untuk Size Aktif */
        .size-active {
            background-color: #000 !important;
            color: #fff !important;
            border-color: #000 !important;
        }

        /* Hilangkan Scrollbar default */
        .scrollbar-hide::-webkit-scrollbar { display: none; }
        .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }

        /* Transisi halus */
        .thumb-item { transition: all 0.2s ease-in-out; }
    </style>
</head>

<body class="bg-white text-gray-800">

    @include('components.navbar')

    <main class="w-full pt-28 pb-24">
        <div class="container mx-auto px-4 md:px-6 max-w-6xl">

            {{-- HITUNG RATING --}}
            @php
                $avgRating = $product->reviews->avg('rating'); 
                $totalReviews = $product->reviews->count();    
                $roundedRating = round($avgRating, 1);         
            @endphp

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16">
                
                {{-- ========================================== --}}
                {{-- KIRI: GAMBAR (LAYOUT DIPERBAIKI) --}}
                {{-- ========================================== --}}
                <div class="flex flex-col gap-6">
                    <!-- Main Image -->
                    <div class="relative w-full aspect-[4/5] bg-gray-50 rounded-2xl overflow-hidden shadow-sm border border-gray-100 group">
                        @if(is_array($product->images) && count($product->images) > 0)
                            <img id="mainImage" src="{{ asset('storage/' . $product->images[0]) }}"
                                class="w-full h-full object-cover object-top transition-transform duration-500">
                        @else
                            <img id="mainImage" src="https://via.placeholder.com/400" class="w-full h-full object-cover">
                        @endif
                        
                        <!-- Navigasi Gambar Utama (Hanya muncul saat hover) -->
                        <button id="prevBtn" class="absolute top-1/2 left-4 -translate-y-1/2 bg-white/80 backdrop-blur-sm text-black w-10 h-10 rounded-full flex items-center justify-center shadow-md opacity-0 group-hover:opacity-100 transition-all hover:bg-black hover:text-white"><i class="fa-solid fa-chevron-left"></i></button>
                        <button id="nextBtn" class="absolute top-1/2 right-4 -translate-y-1/2 bg-white/80 backdrop-blur-sm text-black w-10 h-10 rounded-full flex items-center justify-center shadow-md opacity-0 group-hover:opacity-100 transition-all hover:bg-black hover:text-white"><i class="fa-solid fa-chevron-right"></i></button>
                    </div>

                    <!-- THUMBNAIL CAROUSEL (LAYOUT BARU) -->
                    <!-- Kita beri padding kiri-kanan (px-10) untuk tempat tombol panah -->
                    <div class="relative w-full"> 
                        
                        <!-- Tombol Scroll Kiri (Absolute di pojok kiri) -->
                        <button id="scrollThumbLeft" class="absolute left-0 top-1/2 -translate-y-1/2 z-10 w-8 h-8 bg-white border border-gray-200 rounded-full shadow-sm flex items-center justify-center text-gray-600 hover:text-black hover:bg-gray-50 transition">
                            <i class="fa-solid fa-chevron-left text-xs"></i>
                        </button>

                        <!-- Container Thumbnail -->
                        <!-- px-12 memberikan ruang agar gambar pertama & terakhir tidak tertutup tombol -->
                        <div id="thumbContainer" class="flex gap-4 overflow-x-auto scrollbar-hide scroll-smooth px-12 py-1">
                            @if(is_array($product->images))
                                @foreach($product->images as $index => $img)
                                    @if(is_string($img))
                                        <div class="relative w-24 aspect-[4/5] flex-shrink-0 cursor-pointer border-2 border-transparent hover:border-gray-400 rounded-lg overflow-hidden thumb-item {{ $index === 0 ? 'border-black' : '' }}"
                                            data-url="{{ asset('storage/' . $img) }}" onclick="changeMainImage(this.dataset.url, this)">
                                            <img src="{{ asset('storage/' . $img) }}" class="w-full h-full object-cover object-top">
                                        </div>
                                    @endif
                                @endforeach
                            @endif
                        </div>

                        <!-- Tombol Scroll Kanan (Absolute di pojok kanan) -->
                        <button id="scrollThumbRight" class="absolute right-0 top-1/2 -translate-y-1/2 z-10 w-8 h-8 bg-white border border-gray-200 rounded-full shadow-sm flex items-center justify-center text-gray-600 hover:text-black hover:bg-gray-50 transition">
                            <i class="fa-solid fa-chevron-right text-xs"></i>
                        </button>
                    </div>
                </div>

                {{-- KANAN: BAGIAN INFORMASI --}}
                <div class="flex flex-col justify-center">
                    <div class="mb-6">
                        <span class="inline-block px-3 py-1 bg-gray-100 text-gray-500 rounded-md text-xs font-semibold tracking-widest uppercase mb-3">{{ $product->category }}</span>
                        <h1 class="text-3xl md:text-4xl font-bold text-gray-900 leading-tight mb-2">{{ $product->name }}</h1>

                        {{-- RATING --}}
                        <div class="flex items-center gap-2 mb-4">
                            <div class="flex text-yellow-400 text-sm">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= round($avgRating)) <i class="fa-solid fa-star"></i>
                                    @else <i class="fa-regular fa-star text-gray-300"></i> @endif
                                @endfor
                            </div>
                            <a href="#reviews" class="text-sm text-gray-500 hover:text-black underline decoration-1 underline-offset-2">
                                {{ $roundedRating }} ({{ $totalReviews }} Reviews)
                            </a>
                        </div>

                        <p class="text-2xl font-semibold text-gray-900">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                    </div>

                    <p class="text-gray-500 leading-relaxed mb-8 text-sm md:text-base">{{ $product->description }}</p>

                    {{-- COLOR --}}
                    <div class="mb-6">
                        <p class="text-sm font-medium text-gray-900 mb-2 uppercase tracking-wide">Color</p>
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full ring-2 ring-offset-2 ring-gray-200 shadow-sm"
                                style="{{ 'background-color: ' . ($product->color ?? '#000000') }}"></div>
                            <span class="text-sm text-gray-500 uppercase">{{ $product->color ?? 'No Color' }}</span>
                        </div>
                    </div>

                    {{-- SIZE --}}
                    <div class="mb-8">
                        <div class="flex justify-between items-end mb-2">
                            <p class="text-sm font-medium text-gray-900 uppercase tracking-wide">Size</p>
                        </div>
                        <div class="flex flex-wrap gap-3">
                            @if($product->size)
                                @foreach(explode(',', $product->size) as $s)
                                    <button type="button" data-size="{{ trim($s) }}"
                                        class="size-btn min-w-[3.5rem] h-12 border border-gray-200 rounded-lg text-sm font-medium text-gray-700 hover:border-black transition-all focus:outline-none bg-white">{{ trim($s) }}</button>
                                @endforeach
                            @else
                                <span class="text-xs text-gray-500">All Size</span>
                            @endif
                        </div>
                    </div>

                    {{-- BUTTONS --}}
                    <div class="flex flex-col sm:flex-row gap-4">
                        <div class="flex items-center border border-gray-300 rounded-lg h-12 w-fit sm:w-auto">
                            <button id="decreaseQty" class="px-4 text-gray-500 hover:text-black transition">-</button>
                            <input id="quantity" type="number" min="1" value="1" class="w-12 text-center text-gray-900 font-medium focus:outline-none h-full">
                            <button id="increaseQty" class="px-4 text-gray-500 hover:text-black transition">+</button>
                        </div>
                        <button id="addToCartBtn" class="flex-1 bg-black text-white h-12 rounded-lg font-semibold hover:bg-gray-800 transition active:scale-[0.99] shadow-lg">ADD TO CART</button>
                    </div>
                </div>
            </div>

            {{-- PRODUCT DETAILS TAB (DESCRIPTION) --}}
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
                            Customer Reviews <span class="bg-black text-white text-xs px-2 py-0.5 rounded-full">{{ $totalReviews }}</span>
                        </h3>
                        <div class="flex items-center gap-2 mt-1">
                            <div class="flex text-yellow-400 text-sm">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= round($avgRating)) <i class="fa-solid fa-star"></i>
                                    @else <i class="fa-regular fa-star text-gray-300"></i> @endif
                                @endfor
                            </div>
                            <p class="text-sm text-gray-500 font-medium">{{ $roundedRating }} out of 5</p>
                        </div>
                    </div>

                    <a href="{{ route('reviews.create', ['id' => $product->id]) }}" class="inline-flex items-center justify-center px-6 py-2 border border-gray-300 rounded-full text-sm font-semibold text-gray-700 hover:border-black hover:text-black transition">
                        Write a Review
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @forelse($product->reviews as $review)
                        <div class="bg-gray-50 p-6 rounded-xl">
                            <div class="flex items-start justify-between mb-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-gray-300 flex items-center justify-center text-gray-600 font-bold uppercase">
                                        {{ substr($review->user->name ?? 'A', 0, 2) }}
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-gray-900">{{ $review->user->name ?? 'Anonymous' }}</p>
                                        <p class="text-xs text-gray-500">{{ $review->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                                <div class="text-yellow-400 text-xs">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $review->rating) <i class="fa-solid fa-star"></i>
                                        @else <i class="fa-regular fa-star text-gray-300"></i> @endif
                                    @endfor
                                </div>
                            </div>
                            <p class="text-sm text-gray-600 leading-relaxed">{{ $review->comment }}</p>
                        </div>
                    @empty
                        <p class="text-gray-500 col-span-2 text-center py-4">Belum ada review. Jadilah yang pertama mereview produk ini!</p>
                    @endforelse
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
                                <img src="{{ asset($item['img']) }}" class="w-full h-full object-cover object-top transition-transform duration-700 group-hover:scale-105">
                            </div>
                            <div class="text-center md:text-left">
                                <h3 class="font-medium text-gray-900 text-base mb-1 group-hover:underline decoration-1 underline-offset-4 line-clamp-1">{{ $item['title'] }}</h3>
                                <p class="text-gray-500 text-sm font-semibold">Rp{{ $item['price'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </main>

    {{-- MODAL POPUP CART --}}
    {{-- MODAL POPUP CART (ELEGANT SIMPLE) --}}
<div id="cartPopup" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
    
    <!-- Backdrop (Blur & Dark) -->
    <div class="absolute inset-0 bg-gray-900/40 backdrop-blur-sm transition-opacity" onclick="closeCartPopup()"></div>

    <!-- Modal Box -->
    <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-sm p-6 transform transition-all scale-100">
        
        <!-- Tombol Close (X) di pojok -->
        <button onclick="closeCartPopup()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 transition">
            <i class="fa-solid fa-xmark text-lg"></i>
        </button>

        <!-- Icon Checkmark -->
        <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-green-50 mb-5">
            <svg class="h-8 w-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
            </svg>
        </div>

        <!-- Text Content -->
        <div class="text-center">
            <h3 class="text-lg font-bold text-gray-900">Added to Cart!</h3>
            <p class="text-sm text-gray-500 mt-1 mb-6">Produk berhasil masuk ke keranjang belanjaanmu.</p>
        </div>

        <!-- Action Buttons -->
        <div class="space-y-3">
            <a href="{{ route('cart') }}" 
               class="block w-full rounded-xl bg-black px-4 py-3.5 text-sm font-semibold text-white shadow-sm hover:bg-gray-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black text-center transition">
               Lihat Keranjang
            </a>
            <button onclick="closeCartPopup()" 
               class="block w-full rounded-xl bg-white px-4 py-3.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 text-center transition">
               Lanjut Belanja
            </button>
        </div>
    </div>
</div>

    {{-- DATA SERVER & SCRIPT --}}
    @php
        $dataGambar = [];
        if (isset($product->images) && is_array($product->images)) {
            foreach ($product->images as $img) {
                if (is_string($img))
                    $dataGambar[] = asset('storage/' . $img);
            }
        }
    @endphp
    <input type="hidden" id="data-gambar-server" value='@json($dataGambar)'>

    <script>
        const rawData = document.getElementById('data-gambar-server').value;
        const images = JSON.parse(rawData);
        let current = 0;
        const mainImage = document.getElementById('mainImage');

        function changeMainImage(src, element) {
            if (mainImage) {
                mainImage.style.opacity = 0;
                setTimeout(() => { mainImage.src = src; mainImage.style.opacity = 1; }, 100);
            }
            if(element) {
                document.querySelectorAll('.thumb-item').forEach(el => {
                    el.classList.remove('border-black');
                    el.classList.add('border-transparent');
                });
                element.classList.remove('border-transparent');
                element.classList.add('border-black');
            }
        }

        function updateImage() { if (images.length > 0) changeMainImage(images[current]); }

        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');
        if (prevBtn) prevBtn.onclick = () => { if (images.length > 0) { current = (current - 1 + images.length) % images.length; updateImage(); } };
        if (nextBtn) nextBtn.onclick = () => { if (images.length > 0) { current = (current + 1) % images.length; updateImage(); } };

        // Scroll Thumbnail
        const thumbContainer = document.getElementById('thumbContainer');
        const scrollLeft = document.getElementById('scrollThumbLeft');
        const scrollRight = document.getElementById('scrollThumbRight');

        if(thumbContainer && scrollLeft && scrollRight) {
            scrollLeft.onclick = () => { thumbContainer.scrollBy({ left: -100, behavior: 'smooth' }); };
            scrollRight.onclick = () => { thumbContainer.scrollBy({ left: 100, behavior: 'smooth' }); };
        }

        // Size & Cart
        let selectedSize = null;
        const sizeBtns = document.querySelectorAll('.size-btn');
        sizeBtns.forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                sizeBtns.forEach(b => { b.classList.remove('size-active'); b.classList.add('bg-white', 'text-gray-700'); });
                btn.classList.remove('bg-white', 'text-gray-700');
                btn.classList.add('size-active');
                selectedSize = btn.dataset.size;
            });
        });

        const qty = document.getElementById('quantity');
        const inc = document.getElementById('increaseQty');
        const dec = document.getElementById('decreaseQty');
        if (qty && inc && dec) {
            inc.onclick = () => qty.value++;
            dec.onclick = () => qty.value = Math.max(1, qty.value - 1);
        }

       // --- 5. LOGIC POPUP CART ---
    const popup = document.getElementById('cartPopup');
    
    // Fungsi Buka Popup
    document.getElementById('addToCartBtn').onclick = () => {
        // Cek Size Dulu (Wajib)
        const hasSizes = document.querySelectorAll('.size-btn').length > 0;
        if (hasSizes && !selectedSize) {
            alert("Harap pilih ukuran (Size) terlebih dahulu!");
            return;
        }
        
        // Tampilkan Popup
        popup.classList.remove('hidden');
    };

    // Fungsi Tutup Popup
    function closeCartPopup() {
        popup.classList.add('hidden');
    }

    // Klik tombol close yang disediakan di variable
    const closeBtn = document.getElementById('closePopup'); 
    if(closeBtn) closeBtn.onclick = closeCartPopup; // Jaga-jaga kalau ada ID lama
    </script>

</body>
</html>