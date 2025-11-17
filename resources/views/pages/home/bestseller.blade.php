<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.cdnfonts.com/css/bebas-neue" rel="stylesheet">
    <style>
        .textour {
            font-family: 'Bebas Neue', sans-serif;
            letter-spacing: 0.1em;
        }
    </style>
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Rifold - Bestsellers</title>
</head>

<body>
    @include('components.navbar')

    <section>
        <div class="header relative w-full h-64 md:h-96">
            <div class="absolute inset-0 bg-black flex items-center justify-center">
                <h1 class="textour text-white text-8xl md:text-9xl font-bold">OUR BEST SELLER</h1>
            </div>
        </div>
    </section>

    <section class="w-full">
        {{--
            - `transform -translate-y-16 md:-translate-y-20`: Menarik kartu ke atas agar menimpa header
            - `max-w-screen-xl mx-auto`: Membatasi lebar dan meletakkannya di tengah
            - `px-4 sm:px-8`: Memberi padding horizontal
        --}}
        <div class="relative max-w-screen-xl mx-auto px-4 sm:px-8 transform -translate-y-16 md:-translate-y-20">
            <div class="card bg-white p-6 md:p-10 shadow-lg">

                <!-- Header di dalam kartu -->
                <div class="flex items-center mb-6 md:mb-8">
                    <a href="{{ route('home') }}" class="text-3xl text-black font-light">&larr;</a>
                    {{-- Judul "BEST SELLER" menggunakan font Poppins yang bold --}}
                    <h2 class="text-2xl md:text-4xl font-bold text-black text-center flex-grow">BEST SELLER</h2>
                </div>

                <!-- Grid Produk -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">

                    {{-- Daftar Produk --}}
                    <a href="{{ route('produk.detail') }}" class="block">
                        <div
                            class="flex-none w-80 bg-white p-6 rounded-lg shadow-md hover:shadow-xl transition-transform hover:scale-105 cursor-pointer">

                            <img src="{{ asset('images/katalog/Cityloop long.png') }}" alt="Best Seller"
                                class="w-full h-64 object-contain rounded-md mb-4">

                            <h3 class="text-lg font-semibold mb-2">City Loop Long Sleeve</h3>
                            <p class="text-gray-600">Rp 149.900</p>
                        </div>
                    </a>


                    <a href="{{ route('produk.detail') }}" class="block">
                        <div
                            class="flex-none w-80 bg-white p-6 rounded-lg shadow-md hover:shadow-xl transition-transform hover:scale-105 cursor-pointer">

                            <img src="{{ asset('images/katalog/Cityloop long.png') }}" alt="Best Seller"
                                class="w-full h-64 object-contain rounded-md mb-4">

                            <h3 class="text-lg font-semibold mb-2">City Loop Long Sleeve</h3>
                            <p class="text-gray-600">Rp 149.900</p>
                        </div>
                    </a>

                    <a href="{{ route('produk.detail') }}" class="block">
                        <div
                            class="flex-none w-80 bg-white p-6 rounded-lg shadow-md hover:shadow-xl transition-transform hover:scale-105 cursor-pointer">

                            <img src="{{ asset('images/katalog/Cityloop long.png') }}" alt="Best Seller"
                                class="w-full h-64 object-contain rounded-md mb-4">

                            <h3 class="text-lg font-semibold mb-2">City Loop Long Sleeve</h3>
                            <p class="text-gray-600">Rp 149.900</p>
                        </div>
                    </a>

                    <a href="{{ route('produk.detail') }}" class="block">
                        <div
                            class="flex-none w-80 bg-white p-6 rounded-lg shadow-md hover:shadow-xl transition-transform hover:scale-105 cursor-pointer">

                            <img src="{{ asset('images/katalog/Cityloop long.png') }}" alt="Best Seller"
                                class="w-full h-64 object-contain rounded-md mb-4">

                            <h3 class="text-lg font-semibold mb-2">City Loop Long Sleeve</h3>
                            <p class="text-gray-600">Rp 149.900</p>
                        </div>
                    </a>
                    <a href="{{ route('produk.detail') }}" class="block">
                        <div
                            class="flex-none w-80 bg-white p-6 rounded-lg shadow-md hover:shadow-xl transition-transform hover:scale-105 cursor-pointer">

                            <img src="{{ asset('images/katalog/Cityloop long.png') }}" alt="Best Seller"
                                class="w-full h-64 object-contain rounded-md mb-4">

                            <h3 class="text-lg font-semibold mb-2">City Loop Long Sleeve</h3>
                            <p class="text-gray-600">Rp 149.900</p>
                        </div>
                    </a>


                    <a href="{{ route('produk.detail') }}" class="block">
                        <div
                            class="flex-none w-80 bg-white p-6 rounded-lg shadow-md hover:shadow-xl transition-transform hover:scale-105 cursor-pointer">

                            <img src="{{ asset('images/katalog/Cityloop long.png') }}" alt="Best Seller"
                                class="w-full h-64 object-contain rounded-md mb-4">

                            <h3 class="text-lg font-semibold mb-2">City Loop Long Sleeve</h3>
                            <p class="text-gray-600">Rp 149.900</p>
                        </div>
                    </a>

                </div>
            </div>
    </section>

</body>

@include('components.footer')

</html>
