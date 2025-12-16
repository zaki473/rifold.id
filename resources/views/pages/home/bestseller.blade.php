<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.cdnfonts.com/css/bebas-neue" rel="stylesheet">
    <style>
        .textour { font-family: 'Bebas Neue', sans-serif; letter-spacing: 0.1em; }
    </style>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <title>Rifold - Best Sellers</title>
</head>

<body class="bg-gray-50 text-gray-900">
    @include('components.navbar')

    {{-- HEADER SECTION --}}
    <section>
        <div class="header relative w-full h-64 md:h-96">
            <div class="absolute inset-0 bg-black flex items-center justify-center">
                <h1 class="textour text-white text-7xl md:text-9xl font-bold tracking-widest text-center px-4">
                    OUR BEST SELLERS
                </h1>
            </div>
        </div>
    </section>

    {{-- CONTENT SECTION --}}
    <section class="w-full pb-20">
        <div class="relative max-w-screen-xl mx-auto px-4 sm:px-8 transform -translate-y-12 md:-translate-y-20">
            <div class="card bg-white p-6 md:p-10 shadow-2xl rounded-xl border border-gray-100">

                <!-- Header Navigasi -->
                <div class="flex items-center justify-between mb-8 md:mb-12 border-b border-gray-100 pb-4">
                    <a href="{{ route('home') }}" class="text-2xl text-gray-400 hover:text-black transition duration-300">
                        <i class="fa-solid fa-arrow-left"></i>
                    </a>
                    <h2 class="text-2xl md:text-3xl font-bold text-black text-center uppercase tracking-wide">
                        Top Favorites
                    </h2>
                    <div class="w-8"></div>
                </div>

                <!-- Grid Produk (Konsisten 3 Kolom) -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

                    @foreach($bestSellers as $index => $product)
                        <a href="{{ route('detail', $product->id) }}" class="block group h-full">
                            <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-2 h-full flex flex-col relative">
                                
                                {{-- 
                                    LOGIKA BADGE:
                                    Hanya muncul jika produk memiliki data 'total_sold' (berarti Best Seller asli) 
                                --}}
                                @if(isset($product->total_sold))
                                    <div class="absolute top-4 left-4 z-10 bg-black text-white text-xs font-bold px-2 py-1 rounded shadow-md">
                                        #{{ $index + 1 }}
                                    </div>
                                @endif

                                {{-- Image Wrapper --}}
                                <div class="w-full aspect-[4/5] bg-gray-100 rounded-lg overflow-hidden mb-4 relative">
                                    @if(isset($product->images) && is_array($product->images) && count($product->images) > 0)
                                        <img src="{{ asset('storage/' . $product->images[0]) }}" 
                                             alt="{{ $product->name }}"
                                             class="w-full h-full object-cover object-top transition duration-700 group-hover:scale-105">
                                    @else
                                        <img src="https://via.placeholder.com/300x400?text=No+Image" 
                                             class="w-full h-full object-cover">
                                    @endif
                                </div>

                                {{-- Product Info --}}
                                <div class="mt-auto text-center">
                                    <h3 class="text-lg font-bold text-gray-900 mb-1 group-hover:text-gray-600 transition line-clamp-1">
                                        {{ $product->name }}
                                    </h3>
                                    <p class="text-gray-500 font-medium mb-2">
                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                    </p>
                                    
                                    {{-- Label Terjual (Hanya untuk Real Best Seller) --}}
                                    @if(isset($product->total_sold))
                                        <span class="inline-block bg-gray-100 text-gray-600 text-[10px] px-2 py-1 rounded-full font-bold uppercase tracking-wide">
                                            {{ $product->total_sold }} Sold
                                        </span>
                                    @else
                                        {{-- Spacer kosong agar tinggi kartu tetap sama --}}
                                        <div class="h-6"></div> 
                                    @endif
                                </div>
                            </div>
                        </a>
                    @endforeach

                </div>
            </div>
        </div>
    </section>

    @include('components.footer')
</body>
</html>