<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Rifold - Katalog</title>
    <style>
        .banner {
            width: 100%;
            max-width: 1293px;
            height: 501px;
            object-fit: cover;
            margin: 0 auto;
        }

        .product-card img {
            transition: transform 0.3s ease;
        }

        .product-card:hover img {
            transform: scale(1.05);
        }
    </style>
</head>

<body class="bg-gray-100">

  <!-- NAVBAR -->
  @include('components.navbar')

  <!-- BANNER -->
  <section class="flex justify-center relative mt-4">
    <img src="{{ asset('images/banner katalog.png') }}" alt="Banner Katalog" class="banner rounded-lg shadow-md" />
  </section>

  <!-- KONTEN -->
  <main class="max-w-[1293px] mx-auto px-4 sm:px-6 lg:px-8 py-10 flex flex-col md:flex-row gap-10">

    <!-- SIDEBAR FILTER -->
    <aside class="w-full md:w-[25%] bg-white rounded-xl shadow-md p-5 h-fit">
      <h2 class="text-lg font-semibold mb-4">Product Type</h2>
      <ul class="space-y-2 text-sm">
        <li><input type="checkbox" class="filter-category" value="all" checked> All</li>
        <li><input type="checkbox" class="filter-category" value="flannel"> Flannel Shirts</li>
        <li><input type="checkbox" class="filter-category" value="jacket"> Jackets</li>
        <li><input type="checkbox" class="filter-category" value="polo"> Polo Shirts</li>
        <li><input type="checkbox" class="filter-category" value="tshirt"> T-Shirts</li>
      </ul>

      <h2 class="text-lg font-semibold mt-6 mb-4">Style</h2>
      <ul class="space-y-2 text-sm">
        <li><input type="checkbox" class="filter-size" value="oversized"> Oversized Fit</li>
        <li><input type="checkbox" class="filter-size" value="regular"> Regular Fit</li>
        <li><input type="checkbox" class="filter-size" value="boxy"> Boxy Fit</li>
        <li><input type="checkbox" class="filter-style" value="casual"> Casual Wear</li>
      </ul>

      <h2 class="text-lg font-semibold mt-6 mb-4">Price Range</h2>
      <ul class="space-y-2 text-sm">
        <li><input type="checkbox" class="filter-price" value="low" /> &lt; Rp100.000</li>
        <li><input type="checkbox" class="filter-price" value="mid" /> Rp100.000 – Rp130.000</li>
        <li><input type="checkbox" class="filter-price" value="high" /> &gt; Rp130.000</li>
      </ul>
    </aside>

    <!-- PRODUK GRID -->
    <section class="w-full md:w-[75%]">
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-8">

        <!-- Polo Tonepop (Oversized, Casual) -->
        <div class="product-card bg-white p-6 rounded-lg shadow-md"
          data-category="polo" data-price="110000" data-size="oversized" data-style="casual">
          <img src="{{ asset('images/cactus green.png') }}" alt="Polo Cactus Green"
            class="w-full h-64 object-cover rounded-md mb-4">
          <h3 class="text-lg font-semibold mb-2">Polo Tonepop Cactus Green</h3>
          <p class="text-gray-600">Rp 110.000</p>
        </div>

        <!-- Overcool (Boxy) -->
        <div class="product-card bg-white p-6 rounded-lg shadow-md"
          data-category="overcool" data-price="130000" data-size="boxy" data-style="">
          <img src="{{ asset('images/katalog/overcool midnight black.png') }}" alt="Overcool Black"
            class="w-full h-64 object-cover rounded-md mb-4">
          <h3 class="text-lg font-semibold mb-2">Overcool Midnight Black</h3>
          <p class="text-gray-600">Rp 130.000</p>
        </div>

        <!-- Overcool (Boxy) -->
        <div class="product-card bg-white p-6 rounded-lg shadow-md"
          data-category="overcool" data-price="130000" data-size="boxy" data-style="">
          <img src="{{ asset('images/katalog/overcool eclipse blue.png') }}" alt="Overcool Blue"
            class="w-full h-64 object-cover rounded-md mb-4">
          <h3 class="text-lg font-semibold mb-2">Overcool Eclipse Blue</h3>
          <p class="text-gray-600">Rp 130.000</p>
        </div>

        <!-- Jacket -->
        <div class="product-card bg-white p-6 rounded-lg shadow-md"
          data-category="jacket" data-price="149900" data-size="" data-style="">
          <img src="{{ asset('images/katalog/coze jacket classy black.png') }}" alt="Coze Jacket"
            class="w-full h-64 object-cover rounded-md mb-4">
          <h3 class="text-lg font-semibold mb-2">Coze Jacket Classy Black</h3>
          <p class="text-gray-600">Rp 149.900</p>
        </div>

        <!-- Flannel (Regular, Casual) -->
        <div class="product-card bg-white p-6 rounded-lg shadow-md"
          data-category="flannel" data-price="149900" data-size="regular" data-style="casual">
          <img src="{{ asset('images/katalog/Cityloop long.png') }}" alt="City Loop"
            class="w-full h-64 object-cover rounded-md mb-4">
          <h3 class="text-lg font-semibold mb-2">City Loop Long Sleeve</h3>
          <p class="text-gray-600">Rp 149.900</p>
        </div>

        <!-- Flannel (Regular, Casual) -->
        <div class="product-card bg-white p-6 rounded-lg shadow-md"
          data-category="flannel" data-price="149900" data-size="regular" data-style="casual">
          <img src="{{ asset('images/katalog/Weekend walk.png') }}" alt="Weekend Walk"
            class="w-full h-64 object-cover rounded-md mb-4">
          <h3 class="text-lg font-semibold mb-2">Weekend Walk Long Sleeve</h3>
          <p class="text-gray-600">Rp 149.900</p>
        </div>

        <!-- Polo Tonepop (Oversized, Casual) -->
        <div class="product-card bg-white p-6 rounded-lg shadow-md"
          data-category="polo" data-price="130000" data-size="oversized" data-style="casual">
          <img src="{{ asset('images/katalog/polo tonepop brown earth.png') }}" alt="Polo Brown Earth"
            class="w-full h-64 object-cover rounded-md mb-4">
          <h3 class="text-lg font-semibold mb-2">Polo Tonepop Brown Earth</h3>
          <p class="text-gray-600">Rp 130.000</p>
        </div>

        <!-- Polo Tonepop (Oversized, Casual) -->
        <div class="product-card bg-white p-6 rounded-lg shadow-md"
          data-category="polo" data-price="149900" data-size="oversized" data-style="casual">
          <img src="{{ asset('images/katalog/polo tonepop mocca mist.png') }}" alt="Polo Mocca"
            class="w-full h-64 object-cover rounded-md mb-4">
          <h3 class="text-lg font-semibold mb-2">Polo Tonepop Mocca Mist</h3>
          <p class="text-gray-600">Rp 149.900</p>
        </div>

        <!-- Polo Tonepop (Oversized, Casual) -->
        <div class="product-card bg-white p-6 rounded-lg shadow-md"
          data-category="polo" data-price="110000" data-size="oversized" data-style="casual">
          <img src="{{ asset('images/katalog/polo tonepop navy waves.png') }}" alt="Polo Navy Waves"
            class="w-full h-64 object-cover rounded-md mb-4">
          <h3 class="text-lg font-semibold mb-2">Polo Tonepop Navy Waves</h3>
          <p class="text-gray-600">Rp 110.000</p>
        </div>

        <!-- T-shirt (Regular) -->
        <div class="product-card bg-white p-6 rounded-lg shadow-md"
          data-category="tshirt" data-price="99900" data-size="regular" data-style="">
          <img src="{{ asset('images/katalog/t-shirt eclipse blue.png') }}" alt="T-shirt Blue"
            class="w-full h-64 object-cover rounded-md mb-4">
          <h3 class="text-lg font-semibold mb-2">T-shirt Eclipse Blue</h3>
          <p class="text-gray-600">Rp 99.900</p>
        </div>

        <!-- T-shirt (Regular) -->
        <div class="product-card bg-white p-6 rounded-lg shadow-md"
          data-category="tshirt" data-price="99900" data-size="regular" data-style="">
          <img src="{{ asset('images/katalog/t-shirt mocca mist.png') }}" alt="T-shirt Mocca"
            class="w-full h-64 object-cover rounded-md mb-4">
          <h3 class="text-lg font-semibold mb-2">T-Shirt Mocca Mist</h3>
          <p class="text-gray-600">Rp 99.900</p>
        </div>

        <!-- T-shirt (Regular) -->
        <div class="product-card bg-white p-6 rounded-lg shadow-md"
          data-category="tshirt" data-price="99900" data-size="regular" data-style="">
          <img src="{{ asset('images/katalog/t-shirt midnight black.png') }}" alt="T-shirt Black"
            class="w-full h-64 object-cover rounded-md mb-4">
          <h3 class="text-lg font-semibold mb-2">T-shirt Midnight Black</h3>
          <p class="text-gray-600">Rp 99.900</p>
        </div>

        <!-- Flannel (Regular, Casual) -->
        <div class="product-card bg-white p-6 rounded-lg shadow-md"
          data-category="flannel" data-price="149900" data-size="regular" data-style="casual">
          <img src="{{ asset('images/katalog/hangout hours.png') }}" alt="Hangout Hours"
            class="w-full h-64 object-cover rounded-md mb-4">
          <h3 class="text-lg font-semibold mb-2">Hangout Hours Long Sleeve</h3>
          <p class="text-gray-600">Rp 149.900</p>
        </div>
      </div>
    </section>
  </main>

  @include('components.footer')

  <!-- SCRIPT FILTER -->
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

        // Handle "All" logic
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

          // Apply tonepop/flannel/overcool logic
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
