<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Clean Outfit - RIFOLD</title>

  <!-- Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="font-sans text-gray-900 antialiased bg-white">

  @include('components.navbar')

  <!-- Main Content -->
  <main class="max-w-screen-md mx-auto px-6 py-10 mb-32 relative">
    <!-- Tombol kembali -->
    <a href="{{ url('/mixandmatch') }}" class="text-gray-600 text-sm mb-4 inline-block hover:underline">&lt; Back</a>
    
    <!-- Judul -->
    <h1 class="text-center text-6xl font-extrabold mb-10 tracking-tight relative z-10">
      CLEAN OUTFIT
    </h1>

    <div class="relative flex flex-col items-center">

      <!-- Kotak putih dengan lingkaran di dalamnya -->
      <div class="absolute left-1/2 top-[-60px] w-[600px] h-[600px] bg-white rounded-3xl shadow-lg -translate-x-1/2 -z-20 overflow-hidden">
        <!-- Lingkaran penuh di kanan (agak ke kanan tapi tetap di dalam kotak) -->
        <div class="absolute right-[-150px] top-[-20px] w-[520px] h-[520px] bg-[#d8d1c5] rounded-full"></div>
      </div>

      <!-- Gambar utama -->
      <img src="{{ asset('images/clean-outfit.png') }}" 
          alt="Clean Outfit" 
          class="rounded-2xl w-[360px] object-contain relative right-[-100px] -mt-28 z-10">

      <!-- Kartu produk -->
      <div class="absolute left-1/2 top-[75%] transform -translate-x-1/2 -translate-y-1/3 bg-[#f9f9f9] rounded-2xl shadow-lg p-4 w-48 text-center z-20 mb-4">
        <div class="border-4 border-[#d4a373] rounded-xl mb-3 overflow-hidden">
          <img src="{{ asset('images/polo-overcool.png') }}"
              alt="Polo Overcool"
              class="w-full h-auto object-cover">
        </div>
        <p class="text-gray-800 font-medium">polo overcool series</p>
      </div>
    </div>
  </main>

  @include('components.footer')

</body>
</html>
