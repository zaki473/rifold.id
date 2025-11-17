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


    <section class="">
        <div class="max-w-7xl mx-auto px-6 py-16 text-center">
            <h2 class="text-4xl font-bold mb-12 uppercase tracking-wide">RIFOLD Best Seller</h2>

            <div class="flex space-x-6 overflow-x-auto scroll-smooth pb-4 scrollbar-hide">
                <!-- Card 1 -->
                <a href="{{ route('produk.detail', ['id' => 1]) }}" class="block">
                    <div
                        class="flex-none w-64 bg-white p-6 rounded-lg shadow-md hover:shadow-xl transition-transform hover:scale-105 cursor-pointer">

                        <img src="{{ asset('images/katalog/Cityloop long.png') }}" alt="Best Seller"
                            class="w-full h-64 object-contain rounded-md mb-4">

                        <h3 class="text-lg font-semibold mb-2">City Loop Long Sleeve</h3>
                        <p class="text-gray-600">Rp 149.900</p>
                    </div>
                </a>

                <a href="{{ route('produk.detail') }}" class="block">
                    <div
                        class="flex-none w-64 bg-white p-6 rounded-lg shadow-md hover:shadow-xl transition-transform hover:scale-105 cursor-pointer">

                        <img src="{{ asset('images/katalog/Cityloop long.png') }}" alt="Best Seller"
                            class="w-full h-64 object-contain rounded-md mb-4">

                        <h3 class="text-lg font-semibold mb-2">City Loop Long Sleeve</h3>
                        <p class="text-gray-600">Rp 149.900</p>
                    </div>
                </a>

                <a href="{{ route('produk.detail') }}" class="block">
                    <div
                        class="flex-none w-64 bg-white p-6 rounded-lg shadow-md hover:shadow-xl transition-transform hover:scale-105 cursor-pointer">

                        <img src="{{ asset('images/katalog/Cityloop long.png') }}" alt="Best Seller"
                            class="w-full h-64 object-contain rounded-md mb-4">

                        <h3 class="text-lg font-semibold mb-2">City Loop Long Sleeve</h3>
                        <p class="text-gray-600">Rp 149.900</p>
                    </div>
                </a>

                <a href="{{ route('produk.detail') }}" class="block">
                    <div
                        class="flex-none w-64 bg-white p-6 rounded-lg shadow-md hover:shadow-xl transition-transform hover:scale-105 cursor-pointer">

                        <img src="{{ asset('images/katalog/Cityloop long.png') }}" alt="Best Seller"
                            class="w-full h-64 object-contain rounded-md mb-4">

                        <h3 class="text-lg font-semibold mb-2">City Loop Long Sleeve</h3>
                        <p class="text-gray-600">Rp 149.900</p>
                    </div>
                </a>

                <a href="{{ route('produk.detail') }}" class="block">
                    <div
                        class="flex-none w-64 bg-white p-6 rounded-lg shadow-md hover:shadow-xl transition-transform hover:scale-105 cursor-pointer">

                        <img src="{{ asset('images/katalog/Cityloop long.png') }}" alt="Best Seller"
                            class="w-full h-64 object-contain rounded-md mb-4">

                        <h3 class="text-lg font-semibold mb-2">City Loop Long Sleeve</h3>
                        <p class="text-gray-600">Rp 149.900</p>
                    </div>
                </a>
            </div>

            <div class="mt-12">
                <a href="{{ route('bestseller') }}"
                    class="inline-block bg-black text-white px-8 py-3 rounded-md border border-black
        hover:bg-white hover:text-black transition-colors duration-300">
                    View All
                </a>
            </div>
        </div>
    </section>

    @include('components.footer')

</body>

</html>
