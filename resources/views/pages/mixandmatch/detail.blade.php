<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $mix->name }} - RIFOLD</title>

    <!-- TAILWIND CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- FONT POPPINS -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #FAFAFA; /* Sedikit abu agar card putih lebih pop-up */
        }
        /* Custom Scrollbar */
        .custom-scroll::-webkit-scrollbar { width: 4px; }
        .custom-scroll::-webkit-scrollbar-track { background: transparent; }
        .custom-scroll::-webkit-scrollbar-thumb { background: #e5e7eb; border-radius: 10px; }
        .custom-scroll::-webkit-scrollbar-thumb:hover { background: #d1d5db; }
    </style>
</head>

<body class="text-gray-900 antialiased">

    @include('components.navbar')

    @php
        $images = json_decode($mix->images_path);
        $mainImage = $images[0] ?? null;
    @endphp

    <main class="w-full min-h-screen pt-24 pb-20 px-4 flex justify-center">

        <div class="max-w-6xl w-full">

            <!-- HEADER / BACK BUTTON -->
            <div class="mb-8 flex items-center justify-between">
                <a href="{{ route('mixandmatch.frontend') }}" class="group flex items-center text-gray-500 hover:text-black transition-colors duration-300">
                    <div class="w-10 h-10 rounded-full border border-gray-200 flex items-center justify-center group-hover:border-black transition-colors mr-3 bg-white">
                        <i class="fa-solid fa-arrow-left text-sm"></i>
                    </div>
                    <span class="font-medium text-sm tracking-wide">Back to Collection</span>
                </a>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">

                <!-- BAGIAN KIRI: MODEL IMAGE (Sticky agar tetap terlihat saat scroll produk) -->
                <div class="lg:col-span-5 relative flex flex-col items-center lg:sticky lg:top-24">

                    <!-- Background Circle -->
                    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2
                        w-[320px] h-[320px] md:w-[420px] md:h-[420px]
                        bg-[#E5E5E5] rounded-full -z-10 opacity-70">
                    </div>

                    <!-- Model Image -->
                    @if ($mainImage)
                        <img src="{{ asset('storage/' . $mainImage) }}" alt="{{ $mix->name }}"
                            class="relative z-10 w-[280px] md:w-[350px] object-contain drop-shadow-2xl hover:scale-[1.01] transition-transform duration-500 rounded-lg">
                    @endif

                    <!-- Mobile Title (Hidden on Desktop) -->
                    <div class="text-center mt-6 lg:hidden">
                        <h1 class="text-3xl font-extrabold tracking-tight text-gray-900">{{ $mix->name }}</h1>
                    </div>
                </div>

                <!-- BAGIAN KANAN: PRODUCT LIST (Style Card Kecil) -->
                <div class="lg:col-span-7">

                    <!-- Desktop Title -->
                    <div class="hidden lg:block mb-8 pl-2">
                        <span class="text-xs font-bold tracking-[0.2em] text-gray-400 uppercase mb-1 block">Shop The Look</span>
                        <h1 class="text-5xl font-extrabold tracking-tight text-gray-900">{{ $mix->name }}</h1>
                        <p class="text-gray-500 text-sm mt-3 max-w-md">Klik produk di bawah untuk melihat detail atau mengedit pesanan Anda.</p>
                    </div>

                    <!-- GRID PRODUK -->
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        @foreach ($mix->products as $product)

                            <!-- PRODUCT CARD (Design updated to match your snippet) -->
                            <a href="{{ route('product.show', $product->id) }}"
                               class="group block bg-white p-2 rounded-xl border border-gray-100 shadow-[0_4px_20px_-10px_rgba(0,0,0,0.1)] hover:-translate-y-1 hover:shadow-xl transition-all duration-300 relative">

                                <!-- Badge 'View' (Optional) -->
                                <div class="absolute top-2 right-2 z-10 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <div class="bg-black text-white text-[9px] font-bold px-2 py-1 rounded-full">View</div>
                                </div>

                                <!-- Image Wrapper -->
                                <div class="relative w-full aspect-square bg-gray-50 rounded-lg overflow-hidden border border-gray-50">
                                    <img src="{{ asset('storage/' . $product->images[0]) }}"
                                         alt="{{ $product->name }}"
                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                </div>

                                <!-- Info Wrapper (Sama persis style-nya) -->
                                <div class="text-left px-1 mt-3 mb-1">
                                    <!-- Nama Produk -->
                                    <h3 class="text-gray-900 font-bold text-xs leading-tight mb-1 group-hover:text-blue-600 transition-colors line-clamp-1">
                                        {{ $product->name }}
                                    </h3>

                                    <!-- Harga -->
                                    <div class="flex items-center justify-between">
                                        <p class="text-gray-500 text-[10px] font-medium">
                                            Rp {{ number_format($product->price) }}
                                        </p>

                                        <!-- Arrow Icon -->
                                        <i class="fa-solid fa-arrow-right text-[10px] text-gray-300 group-hover:text-black transition-colors"></i>
                                    </div>
                                </div>
                            </a>

                        @endforeach
                    </div>

                </div>

            </div>

        </div>
    </main>

    @include('components.footer')

</body>
</html>
