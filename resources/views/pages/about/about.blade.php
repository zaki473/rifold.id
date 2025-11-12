<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">
    <title>Rifold tes</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body class="bg-[#FBF7F4] text-[#333333]">

    @include('components.navbar')

    <header class="max-w-7xl mx-auto px-4 py-20 sm:py-24 lg:py-32 text-center">
        <h1 class="text-5xl md:text-8xl lg:text-9xl font-extrabold tracking-tighter leading-tight">
            FOR <br> THE <br> STORIES <br> AHEAD
        </h1>
        <p class="mt-6 max-w-2xl mx-auto text-lg text-gray-600">
            Menemani setiap langkah dalam perjalanan hidup Anda dengan pakaian yang hangat, personal, dan penuh makna.
        </p>
        <div class="mt-10">
            <a href="{{ route('katalog') }}"
                class="bg-black text-white px-8 py-3 rounded-full font-semibold hover:bg-gray-800 transition-colors duration-300">
                Jelajahi Koleksi
            </a>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-4 py-16 sm:px-6 lg:px-8 space-y-24">

        <section class="grid grid-cols-1 md:grid-cols-2 gap-12 md:gap-16 items-center">
            <div class="order-2 md:order-1">
                <img src="{{ asset('images/poloovercool.png') }}" alt="Polo Overcool"
                    class="w-full h-auto rounded-lg shadow-lg">
            </div>
            <div class="order-1 md:order-2">
                <h2 class="text-4xl md:text-5xl font-bold leading-tight">
                    Lahir dari sebuah mimpi di kota kecil.
                </h2>
                <p class="mt-6 text-lg text-gray-600 leading-relaxed">
                    Rifold lahir di kota kecil pada 2019 dengan semangat besar. Berawal dari obrolan sederhana antar
                    sahabat yang percaya bahwa pakaian bukan sekadar kain, tetapi medium untuk menyimpan cerita, Rifold
                    tumbuh menjadi brand yang menghadirkan makna di setiap detailnya.
                </p>
            </div>
        </section>

        <section class="grid grid-cols-1 md:grid-cols-2 gap-12 md:gap-16 items-center">
            <div>
                <h2 class="text-4xl md:text-5xl font-bold leading-tight">
                    Hangat, Personal, dan Penuh Jiwa.
                </h2>
                <p class="mt-6 text-lg text-gray-600 leading-relaxed">
                    Di setiap prosesnya—mulai dari pemilihan kain, rancangan desain, hingga detail produksi—Rifold
                    berpegang pada nilai-nilai tersebut. Kami ingin setiap pakaian yang kami buat bukan hanya dipakai,
                    tetapi juga menjadi bagian dari perjalanan hidup pemakainya.
                    <br><br>
                    Tagline kami, “For The Stories Ahead”, adalah pengingat bahwa setiap orang sedang menulis kisahnya
                    masing-masing. Dan Rifold hadir untuk menemani perjalanan itu—entah di momen sederhana sehari-hari,
                    atau di langkah besar yang mengubah hidup
                </p>
            </div>
            <div class="flex justify-center">
                <img src="{{ asset('images/about2.png') }}" alt="Proses Desain"
                    class="w-full h-auto rounded-lg shadow-lg">
            </div>
        </section>

        <section class="grid grid-cols-1 md:grid-cols-2 gap-12 md:gap-16 items-center">
            <div class="order-2 md:order-1">
                <img src="{{ asset('images/about3.png') }}" alt="Komunitas Rifold"
                    class="w-full h-auto rounded-lg shadow-lg">
            </div>
            <div class="order-1 md:order-2">
                <h2 class="text-4xl md:text-5xl font-bold leading-tight">
                    Cerita Terbaik Masih Menunggu.
                </h2>
                <p class="mt-6 text-lg text-gray-600 leading-relaxed">
                    Dari kota kecil, kami belajar arti kedekatan. Dari setiap produk, kami berusaha menghadirkan
                    ketenangan. Dan dari setiap pelanggan, kami percaya: cerita terbaik masih menunggu di depan sana.
                    <br><br>
                    <strong>Rifold — For The Stories Ahead.</strong>
                </p>
            </div>
        </section>

    </main>

    @include('components.footer')

</body>

</html>
