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
        
        /* Custom Scrollbar sidebar */
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
        <div class="absolute inset-0 bg-black/10"></div> <!-- Overlay tipis biar elegan -->
    </div>
  </section>

  <!-- KONTEN UTAMA -->
  <main class="max-w-[1293px] mx-auto px-4 sm:px-6 lg:px-8 py-12 flex flex-col md:flex-row gap-8 lg:gap-12">

    <!-- SIDEBAR FILTER (Sticky) -->
    <aside class="w-full md:w-[250px] flex-shrink-0 bg-white rounded-xl border border-gray-100 p-6 h-fit md:sticky md:top-24 shadow-sm z-10">
      
      <!-- Filter Group 1 -->
      <div class="mb-8 border-b border-gray-100 pb-6">
          <h2 class="text-xs font-bold text-gray-900 uppercase tracking-widest mb-4">Product Type</h2>
          <ul class="space-y-3 text-sm text-gray-600">
            <li class="flex items-center group">
                <input type="checkbox" class="filter-category accent-black w-4 h-4 cursor-pointer rounded" value="all" checked> 
                <span class="ml-3 group-hover:text-black transition-colors cursor-pointer">All Products</span>
            </li>
            <li class="flex items-center group">
                <input type="checkbox" class="filter-category accent-black w-4 h-4 cursor-pointer rounded" value="flannel"> 
                <span class="ml-3 group-hover:text-black transition-colors cursor-pointer">Flannel Shirts</span>
            </li>
            <li class="flex items-center group">
                <input type="checkbox" class="filter-category accent-black w-4 h-4 cursor-pointer rounded" value="jacket"> 
                <span class="ml-3 group-hover:text-black transition-colors cursor-pointer">Jackets</span>
            </li>
            <li class="flex items-center group">
                <input type="checkbox" class="filter-category accent-black w-4 h-4 cursor-pointer rounded" value="polo"> 
                <span class="ml-3 group-hover:text-black transition-colors cursor-pointer">Polo Shirts</span>
            </li>
            <li class="flex items-center group">
                <input type="checkbox" class="filter-category accent-black w-4 h-4 cursor-pointer rounded" value="tshirt"> 
                <span class="ml-3 group-hover:text-black transition-colors cursor-pointer">T-Shirts</span>
            </li>
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

    <!-- PRODUK GRID -->
    <section class="flex-1">
      <div class="grid grid-cols-2 md:grid-cols-3 gap-x-6 gap-y-10">

        <!-- 
           PANDUAN CARD STYLE:
           1. aspect-[4/5]: Rasio standar fashion (tidak terlalu tinggi, tidak kotak).
           2. object-top: KUNCI AGAR KEPALA TIDAK KEPOTONG.
           3. bg-gray-100: Warna latar belakang card biar menyatu sama foto produk.
        -->

        <!-- Produk 1 -->
        <a href="{{ route('detail', 1) }}" class="product-card group block cursor-pointer"
           data-category="polo" data-price="110000" data-size="oversized" data-style="casual">
            <!-- Image Wrapper -->
            <div class="relative w-full aspect-[4/5] rounded-xl overflow-hidden bg-gray-100 mb-4">
                <img src="{{ asset('images/cactus green.png') }}" alt="Polo Cactus Green"
                     class="w-full h-full object-cover object-top transition-transform duration-700 group-hover:scale-105">
                
                <!-- Tombol Add to Cart (Muncul saat hover) - Opsional biar keren -->
                <div class="absolute bottom-4 right-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300 translate-y-2 group-hover:translate-y-0">
                    <button class="bg-white p-3 rounded-full shadow-lg hover:bg-black hover:text-white transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" /></svg>
                    </button>
                </div>
            </div>
            <!-- Info Produk -->
            <div>
                <h3 class="text-[15px] font-medium text-gray-900 mb-1 group-hover:underline decoration-1 underline-offset-4">Polo Tonepop Cactus Green</h3>
                <p class="text-sm text-gray-500 font-semibold">Rp 110.000</p>
            </div>
        </a>

        <!-- Produk 2 -->
        <div class="product-card group block cursor-pointer"
             data-category="overcool" data-price="130000" data-size="boxy" data-style="">
            <div class="relative w-full aspect-[4/5] rounded-xl overflow-hidden bg-gray-100 mb-4">
                <img src="{{ asset('images/katalog/overcool midnight black.png') }}" alt="Overcool Black"
                     class="w-full h-full object-cover object-top transition-transform duration-700 group-hover:scale-105">
            </div>
            <div>
                <h3 class="text-[15px] font-medium text-gray-900 mb-1 group-hover:underline decoration-1 underline-offset-4">Overcool Midnight Black</h3>
                <p class="text-sm text-gray-500 font-semibold">Rp 130.000</p>
            </div>
        </div>

        <!-- Produk 3 -->
        <div class="product-card group block cursor-pointer"
             data-category="overcool" data-price="130000" data-size="boxy" data-style="">
            <div class="relative w-full aspect-[4/5] rounded-xl overflow-hidden bg-gray-100 mb-4">
                <img src="{{ asset('images/katalog/overcool eclipse blue.png') }}" alt="Overcool Blue"
                     class="w-full h-full object-cover object-top transition-transform duration-700 group-hover:scale-105">
            </div>
            <div>
                <h3 class="text-[15px] font-medium text-gray-900 mb-1 group-hover:underline decoration-1 underline-offset-4">Overcool Eclipse Blue</h3>
                <p class="text-sm text-gray-500 font-semibold">Rp 130.000</p>
            </div>
        </div>

        <!-- Produk 4 -->
        <div class="product-card group block cursor-pointer"
             data-category="jacket" data-price="149900" data-size="" data-style="">
            <div class="relative w-full aspect-[4/5] rounded-xl overflow-hidden bg-gray-100 mb-4">
                <img src="{{ asset('images/katalog/coze jacket classy black.png') }}" alt="Coze Jacket"
                     class="w-full h-full object-cover object-top transition-transform duration-700 group-hover:scale-105">
            </div>
            <div>
                <h3 class="text-[15px] font-medium text-gray-900 mb-1 group-hover:underline decoration-1 underline-offset-4">Coze Jacket Classy Black</h3>
                <p class="text-sm text-gray-500 font-semibold">Rp 149.900</p>
            </div>
        </div>

        <!-- Produk 5 -->
        <div class="product-card group block cursor-pointer"
             data-category="flannel" data-price="149900" data-size="regular" data-style="casual">
            <div class="relative w-full aspect-[4/5] rounded-xl overflow-hidden bg-gray-100 mb-4">
                <img src="{{ asset('images/katalog/Cityloop long.png') }}" alt="City Loop"
                     class="w-full h-full object-cover object-top transition-transform duration-700 group-hover:scale-105">
            </div>
            <div>
                <h3 class="text-[15px] font-medium text-gray-900 mb-1 group-hover:underline decoration-1 underline-offset-4">City Loop Long Sleeve</h3>
                <p class="text-sm text-gray-500 font-semibold">Rp 149.900</p>
            </div>
        </div>

        <!-- Produk 6 -->
        <div class="product-card group block cursor-pointer"
             data-category="flannel" data-price="149900" data-size="regular" data-style="casual">
            <div class="relative w-full aspect-[4/5] rounded-xl overflow-hidden bg-gray-100 mb-4">
                <img src="{{ asset('images/katalog/Weekend walk.png') }}" alt="Weekend Walk"
                     class="w-full h-full object-cover object-top transition-transform duration-700 group-hover:scale-105">
            </div>
            <div>
                <h3 class="text-[15px] font-medium text-gray-900 mb-1 group-hover:underline decoration-1 underline-offset-4">Weekend Walk Long Sleeve</h3>
                <p class="text-sm text-gray-500 font-semibold">Rp 149.900</p>
            </div>
        </div>

        <!-- Produk 7 -->
        <div class="product-card group block cursor-pointer"
             data-category="polo" data-price="130000" data-size="oversized" data-style="casual">
            <div class="relative w-full aspect-[4/5] rounded-xl overflow-hidden bg-gray-100 mb-4">
                <img src="{{ asset('images/katalog/polo tonepop brown earth.png') }}" alt="Polo Brown Earth"
                     class="w-full h-full object-cover object-top transition-transform duration-700 group-hover:scale-105">
            </div>
            <div>
                <h3 class="text-[15px] font-medium text-gray-900 mb-1 group-hover:underline decoration-1 underline-offset-4">Polo Tonepop Brown Earth</h3>
                <p class="text-sm text-gray-500 font-semibold">Rp 130.000</p>
            </div>
        </div>

        <!-- Produk 8 -->
        <div class="product-card group block cursor-pointer"
             data-category="polo" data-price="149900" data-size="oversized" data-style="casual">
            <div class="relative w-full aspect-[4/5] rounded-xl overflow-hidden bg-gray-100 mb-4">
                <img src="{{ asset('images/katalog/polo tonepop mocca mist.png') }}" alt="Polo Mocca"
                     class="w-full h-full object-cover object-top transition-transform duration-700 group-hover:scale-105">
            </div>
            <div>
                <h3 class="text-[15px] font-medium text-gray-900 mb-1 group-hover:underline decoration-1 underline-offset-4">Polo Tonepop Mocca Mist</h3>
                <p class="text-sm text-gray-500 font-semibold">Rp 149.900</p>
            </div>
        </div>

        <!-- Produk 9 -->
        <div class="product-card group block cursor-pointer"
             data-category="polo" data-price="110000" data-size="oversized" data-style="casual">
            <div class="relative w-full aspect-[4/5] rounded-xl overflow-hidden bg-gray-100 mb-4">
                <img src="{{ asset('images/katalog/polo tonepop navy waves.png') }}" alt="Polo Navy Waves"
                     class="w-full h-full object-cover object-top transition-transform duration-700 group-hover:scale-105">
            </div>
            <div>
                <h3 class="text-[15px] font-medium text-gray-900 mb-1 group-hover:underline decoration-1 underline-offset-4">Polo Tonepop Navy Waves</h3>
                <p class="text-sm text-gray-500 font-semibold">Rp 110.000</p>
            </div>
        </div>

        <!-- Produk 10 -->
        <div class="product-card group block cursor-pointer"
             data-category="tshirt" data-price="99900" data-size="regular" data-style="">
            <div class="relative w-full aspect-[4/5] rounded-xl overflow-hidden bg-gray-100 mb-4">
                <img src="{{ asset('images/katalog/t-shirt eclipse blue.png') }}" alt="T-shirt Blue"
                     class="w-full h-full object-cover object-top transition-transform duration-700 group-hover:scale-105">
            </div>
            <div>
                <h3 class="text-[15px] font-medium text-gray-900 mb-1 group-hover:underline decoration-1 underline-offset-4">T-shirt Eclipse Blue</h3>
                <p class="text-sm text-gray-500 font-semibold">Rp 99.900</p>
            </div>
        </div>

        <!-- Produk 11 -->
        <div class="product-card group block cursor-pointer"
             data-category="tshirt" data-price="99900" data-size="regular" data-style="">
            <div class="relative w-full aspect-[4/5] rounded-xl overflow-hidden bg-gray-100 mb-4">
                <img src="{{ asset('images/katalog/t-shirt mocca mist.png') }}" alt="T-shirt Mocca"
                     class="w-full h-full object-cover object-top transition-transform duration-700 group-hover:scale-105">
            </div>
            <div>
                <h3 class="text-[15px] font-medium text-gray-900 mb-1 group-hover:underline decoration-1 underline-offset-4">T-Shirt Mocca Mist</h3>
                <p class="text-sm text-gray-500 font-semibold">Rp 99.900</p>
            </div>
        </div>

        <!-- Produk 12 -->
        <div class="product-card group block cursor-pointer"
             data-category="tshirt" data-price="99900" data-size="regular" data-style="">
            <div class="relative w-full aspect-[4/5] rounded-xl overflow-hidden bg-gray-100 mb-4">
                <img src="{{ asset('images/katalog/t-shirt midnight black.png') }}" alt="T-shirt Black"
                     class="w-full h-full object-cover object-top transition-transform duration-700 group-hover:scale-105">
            </div>
            <div>
                <h3 class="text-[15px] font-medium text-gray-900 mb-1 group-hover:underline decoration-1 underline-offset-4">T-shirt Midnight Black</h3>
                <p class="text-sm text-gray-500 font-semibold">Rp 99.900</p>
            </div>
        </div>

        <!-- Produk 13 -->
        <div class="product-card group block cursor-pointer"
             data-category="flannel" data-price="149900" data-size="regular" data-style="casual">
            <div class="relative w-full aspect-[4/5] rounded-xl overflow-hidden bg-gray-100 mb-4">
                <img src="{{ asset('images/katalog/hangout hours.png') }}" alt="Hangout Hours"
                     class="w-full h-full object-cover object-top transition-transform duration-700 group-hover:scale-105">
            </div>
            <div>
                <h3 class="text-[15px] font-medium text-gray-900 mb-1 group-hover:underline decoration-1 underline-offset-4">Hangout Hours Long Sleeve</h3>
                <p class="text-sm text-gray-500 font-semibold">Rp 149.900</p>
            </div>
        </div>

      </div>
    </section>

  </main>

  @include('components.footer')

  <!-- SCRIPT FILTER SAMA SEPERTI SEBELUMNYA -->
  <script>
    document.addEventListener("DOMContentLoaded", () => {
      const categoryChecks = document.querySelectorAll(".filter-category");
      const priceChecks = document.querySelectorAll(".filter-price");
      const sizeChecks = document.querySelectorAll(".filter-size");
      const styleChecks = document.querySelectorAll(".filter-style");
      const products = document.querySelectorAll(".product-card");

      function applyFilters() {
        const allCheck = document.querySelector('.filter-category[value="all"]');
        const activeCategories = Array.from(categoryChecks)
          .filter(cb => cb.checked && cb.value !== "all")
          .map(cb => cb.value);
        const activePrices = Array.from(priceChecks)
          .filter(cb => cb.checked)
          .map(cb => cb.value);
        const activeSizes = Array.from(sizeChecks)
          .filter(cb => cb.checked)
          .map(cb => cb.value);
        const activeStyles = Array.from(styleChecks)
          .filter(cb => cb.checked)
          .map(cb => cb.value);

        if (allCheck.checked) {
          categoryChecks.forEach(cb => {
            if (cb.value !== "all") cb.checked = false;
          });
        } else {
          allCheck.checked = false;
        }

        products.forEach(product => {
          const category = product.dataset.category;
          const price = parseInt(product.dataset.price);
          const size = product.dataset.size;
          const style = product.dataset.style;

          const matchCategory = allCheck.checked || activeCategories.length === 0 || activeCategories.includes(category);
          const matchSize = activeSizes.length === 0 || activeSizes.includes(size);
          const matchStyle = activeStyles.length === 0 || activeStyles.includes(style);

          let matchPrice = activePrices.length === 0;
          if (activePrices.includes("low") && price < 100000) matchPrice = true;
          if (activePrices.includes("mid") && price >= 100000 && price <= 130000) matchPrice = true;
          if (activePrices.includes("high") && price > 130000) matchPrice = true;

          if (category === "polo" && size !== "oversized") product.style.display = "none";
          else if (category === "flannel" && size !== "regular") product.style.display = "none";
          else if (category === "overcool" && size !== "boxy") product.style.display = "none";
          else if (matchCategory && matchPrice && matchSize && matchStyle) product.style.display = "block";
          else product.style.display = "none";
        });
      }

      [...categoryChecks, ...priceChecks, ...sizeChecks, ...styleChecks]
        .forEach(cb => cb.addEventListener("change", applyFilters));

      applyFilters();
    });
  </script>
</body>
</html>