<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Rifold</title>
</head>

<body class="bg-[#FBF7F4] text-[#333333]">

    @include('components.navbar')

    <section class="relative w-full">
        <!-- Gambar -->
        <img src="{{ asset('images/thumbnail.png') }}" alt="thumbnail" class="w-full h-auto object-cover">

        <div class="absolute inset-0 bg-black bg-opacity-60"></div>

        <div class="absolute inset-0 flex items-center justify-center">
            <div class="flex flex-col items-center text-center space-y-4">

                <h1 class="text-white text-5xl md:text-7xl font-extrabold drop-shadow-xl">
                    FOR THE STORIES AHEAD
                </h1>

                <p class="text-white text-lg md:text-4xl font-light drop-shadow-md">
                    explore your everyday story with RIFOLD
                </p>

            </div>
        </div>

    </section>


    <section class="max-w-7xl mx-auto px-4 py-12">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-9">
            <div class="group overflow-hidden rounded-lg shadow-lg">
                <img src="{{ asset('images/kiri.png') }}" alt="Kiri"
                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-in-out">
            </div>

            <div class="group overflow-hidden rounded-lg shadow-lg">
                <img src="{{ asset('images/tengah.png') }}" alt="Tengah"
                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-in-out">
            </div>

            <div class="group overflow-hidden rounded-lg shadow-lg">
                <img src="{{ asset('images/kanan.png') }}" alt="Kanan"
                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-in-out">
            </div>
        </div>
    </section>

    <section class="about max-w-7xl mx-auto px-4 py-12 flex flex-col md:flex-row items-start justify-between gap-8">

        <div class="md:w-1/2 flex flex-col justify-between">
            <h1 class="text-4xl md:text-8xl font-extrabold leading-tight">
                FOR <br> THE <br> STORIES <br> AHEAD
            </h1>

            <h1 class="text-lg md:text-2xl mt-6 leading-relaxed">
                Dari kota kecil, kami belajar arti kedekatan.
                <br> Dari setiap produk, kami berusaha menghadirkan ketenangan.
                <br> Dan dari setiap pelanggan, kami percaya:
                cerita terbaik masih menunggu di depan sana.
                <br><br>
                Rifold — For The Stories Ahead.
            </h1>
        </div>

        <div class="group overflow-hidden rounded-lg shadow-lg">
            <img src="{{ asset('images/poloovercool.png') }}" alt="about"
                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-in-out">
        </div>

    </section>


 {{-- ========================================== --}}
    {{-- 2. BEST SELLER SECTION (HEADER RIGHT + THIN ARROW) --}}
    {{-- ========================================== --}}
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-6 lg:px-12">
            
            {{-- HEADER: JUDUL KIRI, VIEW ALL KANAN --}}
            <div class="flex flex-col md:flex-row justify-between items-end mb-10 gap-4">
                <div class="space-y-1">
                    <h2 class="text-4xl md:text-5xl font-black text-black tracking-tight uppercase">
                        RIFOLD BEST SELLERS
                    </h2>
                    <p class="text-gray-500 font-medium">Top trending products this week</p>
                </div>
                
                {{-- TOMBOL VIEW ALL (AESTHETIC THIN ARROW) --}}
                <a href="{{ route('bestseller') }}" class="group flex items-center gap-3 text-sm font-medium text-gray-900 hover:text-gray-600 transition-colors pb-1">
                    View All
                    {{-- SVG Panah Tipis Panjang --}}
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 transform group-hover:translate-x-1 transition-transform duration-300">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" />
                    </svg>
                </a>
            </div>

            {{-- CAROUSEL WRAPPER --}}
            <div class="relative group/carousel">
                
                <!-- Scroll Left Button -->
                <button id="scrollLeft" class="absolute -left-4 md:-left-6 top-1/2 -translate-y-1/2 z-20 w-12 h-12 bg-white border border-gray-100 shadow-xl rounded-full flex items-center justify-center text-gray-800 opacity-0 group-hover/carousel:opacity-100 transition-all duration-300 hover:scale-110 hover:bg-black hover:text-white disabled:opacity-0">
                    <i class="fa-solid fa-chevron-left"></i>
                </button>

                <!-- Product Container -->
                <div id="bestSellerContainer" class="flex gap-6 overflow-x-auto pb-8 scrollbar-hide scroll-smooth snap-x">
                    
                    @foreach($bestSellers as $index => $product)
                    {{-- CARD PRODUK --}}
                    <a href="{{ route('detail', $product->id) }}" class="min-w-[260px] w-[260px] snap-center group/card block cursor-pointer">
                        
                        {{-- Image Wrapper --}}
                        <div class="relative w-full aspect-[4/5] bg-gray-50 rounded-2xl overflow-hidden mb-5 border border-gray-100">
                            @if(is_array($product->images) && count($product->images) > 0)
                                <img src="{{ asset('storage/' . $product->images[0]) }}" 
                                     alt="{{ $product->name }}"
                                     class="w-full h-full object-cover object-top transition duration-700 ease-out group-hover/card:scale-105">
                            @else
                                <img src="https://via.placeholder.com/400" class="w-full h-full object-cover">
                            @endif

                            {{-- Ranking Badge --}}
                            @if(isset($product->total_sold))
                                <div class="absolute top-3 left-3 bg-[#D32F2F] text-white text-[10px] font-extrabold px-3 py-1 rounded-full shadow-sm tracking-wider">
                                    HOT #{{ $index + 1 }}
                                </div>
                            @endif
                        </div>

                        {{-- Product Info --}}
                        <div class="text-center px-2 space-y-1.5">
                            <h3 class="text-base font-bold text-gray-900 group-hover/card:underline underline-offset-4 decoration-1 line-clamp-1 transition-all">
                                {{ $product->name }}
                            </h3>
                            <div class="flex items-center justify-center gap-2">
                                <p class="text-sm font-semibold text-gray-600">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </p>
                            </div>

                            {{-- Sold Count Badge --}}
                            @if(isset($product->total_sold))
                                <span class="inline-block bg-gray-100 text-gray-500 text-[10px] font-bold px-2 py-0.5 rounded-md uppercase tracking-wide mt-1">
                                    {{ $product->total_sold }} Sold
                                </span>
                            @else
                                <div class="h-[22px]"></div>
                            @endif
                        </div>
                    </a>
                    @endforeach

                </div>

                <!-- Scroll Right Button -->
                <button id="scrollRight" class="absolute -right-4 md:-right-6 top-1/2 -translate-y-1/2 z-20 w-12 h-12 bg-white border border-gray-100 shadow-xl rounded-full flex items-center justify-center text-gray-800 opacity-0 group-hover/carousel:opacity-100 transition-all duration-300 hover:scale-110 hover:bg-black hover:text-white disabled:opacity-0">
                    <i class="fa-solid fa-chevron-right"></i>
                </button>

            </div>

        </div>
    </section>
    <!-- END BEST SELLER SECTION -->

    @include('components.footer')

</body>

</html>