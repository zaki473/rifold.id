<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Clean Outfit - RIFOLD</title>

  <!-- TAILWIND FIXED -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="font-sans text-gray-900 antialiased bg-white">

  @include('components.navbar')

  <main class="max-w-screen-md mx-auto px-6 py-10 mb-32 relative">
    
    <a href="{{ url('/mixandmatch') }}" class="flex items-center text-gray-700 text-lg font-semibold hover:text-gray-900 transition mb-4">
      <span class="text-3xl mr-2">&lt;</span>
    </a>

    <h1 class="text-center text-5xl sm:text-6xl font-extrabold mb-10 tracking-tight relative z-10">
      CLEAN OUTFIT
    </h1>

    <div class="relative flex flex-col items-center">

      <!-- Background box belakang -->
      <div class="absolute left-1/2 top-[-60px] w-[90%] sm:w-[420px] h-[520px] bg-white rounded-3xl shadow-lg -translate-x-1/2 -z-20 overflow-hidden">
        <div class="absolute right-[-120px] top-[-20px] w-[480px] h-[480px] bg-[#d8d1c5] rounded-full"></div>
      </div>

      <!-- Gambar utama (clean outfit) -->
      <img src="{{ asset('images/clean-outfit.png') }}" 
           alt="Clean Outfit"
           class="rounded-2xl w-[260px] sm:w-[340px] object-contain relative sm:right-[-60px] -mt-20 z-10">

      <!-- CARD PRODUK (digeser ke kiri) -->
<div class="absolute left-1/2 top-[75%] transform -translate-x-[60%] -translate-y-1/3 
            bg-[#f9f9f9] rounded-2xl shadow-lg p-4 w-40 sm:w-44 text-center z-20 mb-4">

    <!-- Kotak gambar -->
    <div class="border-4 border-[#d4a373] rounded-xl mb-2 overflow-hidden bg-white h-[120px] 
                flex items-center justify-start pl-1">
      <img src="{{ asset('images/polo-overcool.png') }}" 
           alt="Polo Overcool"
           class="object-contain max-h-[110px] w-full">
    </div>

    <p class="text-gray-800 font-medium text-sm">polo overcool series</p>
</div>


    </div>
  </main>

  @include('components.footer')

</body>
</html>
