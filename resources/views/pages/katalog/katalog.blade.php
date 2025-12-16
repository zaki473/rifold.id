<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <title>Rifold - Katalog</title>
    <style>
        body { font-family: 'Poppins', sans-serif; }
        aside::-webkit-scrollbar { width: 4px; }
        aside::-webkit-scrollbar-thumb { background-color: #e5e7eb; border-radius: 4px; }
    </style>
</head>

<body class="bg-gray-50 text-gray-800">

  <!-- NAVBAR -->
  @include('components.navbar')

  <!-- BANNER -->
  <section class="max-w-[1293px] mx-auto px-4 sm:px-6 lg:px-8 mt-8">
    <div class="relative w-full h-[250px] md:h-[350px] lg:h-[450px] rounded-2xl overflow-hidden shadow-sm">
        <img src="{{ asset('images/banner katalog.png') }}" alt="Banner Katalog" class="w-full h-full object-cover hover:scale-105 transition-transform duration-700" />
        <div class="absolute inset-0 bg-black/10"></div>
    </div>
  </section>

  <!-- KONTEN UTAMA -->
  <main class="max-w-[1293px] mx-auto px-4 sm:px-6 lg:px-8 py-12 flex flex-col md:flex-row gap-8 lg:gap-12">

    <!-- SIDEBAR FILTER -->
    <aside class="w-full md:w-[250px] flex-shrink-0 bg-white rounded-xl border border-gray-100 p-6 h-fit md:sticky md:top-24 shadow-sm z-10">
      
      <!-- Filter Group 1 -->
      <div class="mb-8 border-b border-gray-100 pb-6">
          <h2 class="text-xs font-bold text-gray-900 uppercase tracking-widest mb-4">Product Type</h2>
          <ul class="space-y-3 text-sm text-gray-600">
            <li class="flex items-center group">
                <input type="checkbox" class="filter-category accent-black w-4 h-4 cursor-pointer rounded" value="all" checked> 
                <span class="ml-3 group-hover:text-black transition-colors cursor-pointer">All Products</span>
            </li>
            <li class="flex items-center group"><input type="checkbox" class="filter-category accent-black w-4 h-4 cursor-pointer rounded" value="flannel"> <span class="ml-3 group-hover:text-black transition-colors cursor-pointer">Flannel Shirts</span></li>
            <li class="flex items-center group"><input type="checkbox" class="filter-category accent-black w-4 h-4 cursor-pointer rounded" value="jacket"> <span class="ml-3 group-hover:text-black transition-colors cursor-pointer">Jackets</span></li>
            <li class="flex items-center group"><input type="checkbox" class="filter-category accent-black w-4 h-4 cursor-pointer rounded" value="polo"> <span class="ml-3 group-hover:text-black transition-colors cursor-pointer">Polo Shirts</span></li>
            <li class="flex items-center group"><input type="checkbox" class="filter-category accent-black w-4 h-4 cursor-pointer rounded" value="tshirt"> <span class="ml-3 group-hover:text-black transition-colors cursor-pointer">T-Shirts</span></li>
          </ul>
      </div>

      <!-- Filter Group 2 -->
      <div class="mb-8 border-b border-gray-100 pb-6">
          <h2 class="text-xs font-bold text-gray-900 uppercase tracking-widest mb-4">Fit & Style</h2>
          <ul class="space-y-3 text-sm text-gray-600">
            <li class="flex items-center group"><input type="checkbox" class="filter-size accent-black w-4 h-4 cursor-pointer" value="oversized"> <span class="ml-3 group-hover:text-black">Oversized Fit</span></li>
            <li class="flex items-center group"><input type="checkbox" class="filter-size accent-black w-4 h-4 cursor-pointer" value="regular"> <span class="ml-3 group-hover:text-black">Regular Fit</span></li>
            <li class="flex items-center group"><input type="checkbox" class="filter-size accent-black w-4 h-4 cursor-pointer" value="boxy"> <span class="ml-3 group-hover:text-black">Boxy Fit</span></li>
            <li class="flex items-center group"><input type="checkbox" class="filter-style accent-black w-4 h-4 cursor-pointer" value="casual"> <span class="ml-3 group-hover:text-black">Casual Wear</span></li>
          </ul>
      </div>

      <!-- Filter Group 3 -->
      <div>
          <h2 class="text-xs font-bold text-gray-900 uppercase tracking-widest mb-4">Price</h2>
          <ul class="space-y-3 text-sm text-gray-600">
            <li class="flex items-center group"><input type="checkbox" class="filter-price accent-black w-4 h-4 cursor-pointer" value="low" /> <span class="ml-3 group-hover:text-black">&lt; Rp100k</span></li>
            <li class="flex items-center group"><input type="checkbox" class="filter-price accent-black w-4 h-4 cursor-pointer" value="mid" /> <span class="ml-3 group-hover:text-black">Rp100k – Rp130k</span></li>
            <li class="flex items-center group"><input type="checkbox" class="filter-price accent-black w-4 h-4 cursor-pointer" value="high" /> <span class="ml-3 group-hover:text-black">&gt; Rp130k</span></li>
          </ul>
      </div>
    </aside>

    <!-- AREA PRODUK -->
    <section class="flex-1">
        
        {{-- 1. PESAN HASIL PENCARIAN (Muncul cuma kalau user search) --}}
        @if(request('search'))
            <div class="mb-6 bg-white border border-gray-200 p-4 rounded-lg flex justify-between items-center shadow-sm">
                <p class="text-gray-600 text-sm">
                    Hasil pencarian untuk: <span class="font-bold text-black">"{{ request('search') }}"</span>
                    <span class="ml-1 text-gray-400">({{ $products->count() }} produk ditemukan)</span>
                </p>
                <a href="{{ route('katalog') }}" class="text-sm text-red-500 hover:text-red-700 font-medium hover:underline">
                    Reset Filter
                </a>
            </div>
        @endif

        {{-- 2. GRID PRODUK --}}
        <div class="grid grid-cols-2 md:grid-cols-3 gap-x-6 gap-y-10">

            {{-- 3. LOOPING DATA --}}
            @forelse($products as $product)
                <a href="{{ route('detail', $product->id) }}" 
                   class="product-card group block cursor-pointer"
                   data-category="{{ strtolower($product->category) }}" 
                   data-price="{{ $product->price }}" 
                   data-size="{{ strtolower($product->size) }}" 
                   data-style="{{ strtolower($product->description) }}"> 
                    
                    <!-- Image Wrapper -->
                    <div class="relative w-full aspect-[4/5] rounded-xl overflow-hidden bg-gray-100 mb-4">
                        @if(!empty($product->images) && isset($product->images[0]))
                            <img src="{{ asset('storage/' . $product->images[0]) }}" 
                                 alt="{{ $product->name }}"
                                 class="w-full h-full object-cover object-top transition-transform duration-700 group-hover:scale-105">
                        @else
                            <img src="https://via.placeholder.com/300x400?text=No+Image" class="w-full h-full object-cover">
                        @endif
                        
                        <!-- Hover Button -->
                        <div class="absolute bottom-4 right-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300 translate-y-2 group-hover:translate-y-0">
                            <button class="bg-white p-3 rounded-full shadow-lg hover:bg-black hover:text-white transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" /></svg>
                            </button>
                        </div>
                    </div>

                    <!-- Info Produk -->
                    <div>
                        <h3 class="text-[15px] font-medium text-gray-900 mb-1 group-hover:underline decoration-1 underline-offset-4">
                            {{ $product->name }}
                        </h3>
                        <p class="text-sm text-gray-500 font-semibold">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </p>
                    </div>
                </a>
            
            {{-- 4. JIKA TIDAK ADA PRODUK (HASIL SEARCH 0) --}}
            @empty
                <div class="col-span-full text-center py-20">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 mb-4">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900">Produk tidak ditemukan</h3>
                    <p class="text-gray-500 mt-1 text-sm">Coba kata kunci lain atau periksa ejaanmu.</p>
                    @if(request('search'))
                        <a href="{{ route('katalog') }}" class="inline-block mt-4 px-6 py-2 bg-black text-white text-sm rounded-lg hover:bg-gray-800 transition">Lihat Semua Produk</a>
                    @endif
                </div>
            @endforelse

        </div>
    </section>

  </main>

  @include('components.footer')

  <!-- SCRIPT FILTER (FIXED & IMPROVED) -->
<script>
document.addEventListener("DOMContentLoaded", () => {
    // Ambil semua elemen filter
    const categoryChecks = document.querySelectorAll(".filter-category");
    const priceChecks = document.querySelectorAll(".filter-price");
    const sizeChecks = document.querySelectorAll(".filter-size");
    const styleChecks = document.querySelectorAll(".filter-style");
    const products = document.querySelectorAll(".product-card");

    function applyFilters() {
        // 1. Cek Kategori
        const allCheck = document.querySelector('.filter-category[value="all"]');
        let activeCategories = Array.from(categoryChecks)
            .filter(cb => cb.checked && cb.value !== "all")
            .map(cb => cb.value.toLowerCase());

        // Logika checkbox "All Products"
        if (this === allCheck && allCheck.checked) {
            // Jika klik "All", matikan yang lain
            categoryChecks.forEach(cb => { if (cb.value !== "all") cb.checked = false; });
            activeCategories = [];
        } else if (this !== allCheck && this.classList && this.classList.contains('filter-category')) {
            // Jika klik kategori lain, matikan "All"
            allCheck.checked = false;
        }
        
        // Jika tidak ada kategori spesifik yang dipilih, anggap semua aktif (atau kembali ke All)
        if (activeCategories.length === 0 && !allCheck.checked) {
            allCheck.checked = true;
        }

        // 2. Ambil Filter Lainnya
        const activePrices = Array.from(priceChecks).filter(cb => cb.checked).map(cb => cb.value);
        const activeSizes = Array.from(sizeChecks).filter(cb => cb.checked).map(cb => cb.value.toLowerCase());
        const activeStyles = Array.from(styleChecks).filter(cb => cb.checked).map(cb => cb.value.toLowerCase());

        // 3. Loop Semua Produk
        products.forEach(product => {
            // Ambil data dari atribut HTML produk (pastikan di blade sudah strtolower)
            const prodCategory = (product.dataset.category || '').toLowerCase();
            const prodPrice = parseInt(product.dataset.price || 0);
            const prodSize = (product.dataset.size || '').toLowerCase(); // string "s,m,l"
            const prodStyle = (product.dataset.style || '').toLowerCase();

            // -- LOGIKA PENCOCOKAN --

            // A. Kategori (Gunakan includes agar lebih fleksibel)
            // Misal: Filter "flannel" akan cocok dengan produk kategori "flannel shirts"
            const isCategoryMatch = allCheck.checked || 
                                    activeCategories.length === 0 || 
                                    activeCategories.some(filter => prodCategory.includes(filter));

            // B. Harga
            let isPriceMatch = activePrices.length === 0;
            if (!isPriceMatch) {
                if (activePrices.includes("low") && prodPrice < 100000) isPriceMatch = true;
                if (activePrices.includes("mid") && prodPrice >= 100000 && prodPrice <= 130000) isPriceMatch = true;
                if (activePrices.includes("high") && prodPrice > 130000) isPriceMatch = true;
            }

            // C. Size (Cek apakah string size produk mengandung filter size)
            // Misal: Produk size "s,m,l" akan cocok jika filter "m" dipilih
            const isSizeMatch = activeSizes.length === 0 || 
                                activeSizes.some(filter => prodSize.includes(filter));

            // D. Style
            const isStyleMatch = activeStyles.length === 0 || 
                                 activeStyles.some(filter => prodStyle.includes(filter));

            // -- TAMPILKAN / SEMBUNYIKAN --
            if (isCategoryMatch && isPriceMatch && isSizeMatch && isStyleMatch) {
                product.style.display = "block";
            } else {
                product.style.display = "none";
            }
        });
    }

    // Pasang Event Listener ke semua checkbox
    const allFilters = [...categoryChecks, ...priceChecks, ...sizeChecks, ...styleChecks];
    allFilters.forEach(cb => cb.addEventListener("change", applyFilters));

    // Jalankan sekali saat load
    applyFilters();
});
</script>
</body>
</html>