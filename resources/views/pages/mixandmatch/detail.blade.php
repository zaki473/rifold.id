<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Clean Outfit - RIFOLD</title>

  <!-- TAILWIND CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- FONT POPPINS -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <!-- FONT AWESOME -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <style>
    body { font-family: 'Poppins', sans-serif; }
  </style>
</head>
<body class="bg-white text-gray-900 antialiased">

  @include('components.navbar')

  <main class="w-full min-h-screen pt-24 pb-20 relative overflow-hidden">
    
    <div class="max-w-4xl mx-auto px-6 relative z-10">
        
        <!-- BACK BUTTON -->
        <div class="absolute left-6 top-0 md:left-0">
            <a href="{{ url('/mixandmatch') }}" class="group flex items-center text-gray-500 hover:text-black transition-colors duration-300">
                <div class="w-10 h-10 rounded-full border border-gray-200 flex items-center justify-center group-hover:border-black transition-colors mr-3">
                    <i class="fa-solid fa-arrow-left text-sm"></i>
                </div>
                <span class="font-medium text-sm tracking-wide">Back</span>
            </a>
        </div>

        <!-- TITLE -->
        <div class="text-center mt-16 mb-12">
            <span class="text-xs font-bold tracking-[0.2em] text-gray-400 uppercase mb-2 block">Mix & Match Collection</span>
            <h1 class="text-5xl md:text-6xl font-extrabold tracking-tight text-gray-900">
              CLEAN OUTFIT
            </h1>
        </div>

        <!-- CONTENT WRAPPER -->
        <div class="relative flex justify-center items-center mt-8">

            <!-- DECORATIVE BACKGROUND (Lingkaran di belakang model) -->
            <!-- Dibuat absolute center agar pas di belakang model -->
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-[300px] h-[300px] md:w-[450px] md:h-[450px] bg-[#F2F0EB] rounded-full -z-10"></div>

            <!-- MODEL IMAGE -->
            <!-- Tambahkan drop-shadow agar model terlihat "pop-up" -->
            <img src="{{ asset('images/clean-outfit.png') }}" 
                 alt="Clean Outfit Model"
                 class="relative z-10 w-[280px] md:w-[380px] object-contain drop-shadow-2xl hover:scale-[1.01] transition-transform duration-500">

            <!-- PRODUCT CARD LINK (Floating) -->
            <!-- 
                Posisi: Absolute relative terhadap wrapper.
                Link: Mengarah ke route detail (asumsi id=1 atau sesuaikan).
            -->
            <a href="{{ route('detail', 1) }}" 
               class="absolute z-20 bottom-10 -left-4 md:bottom-20 md:left-10 lg:left-24
                      bg-white p-3 rounded-2xl shadow-[0_10px_40px_-10px_rgba(0,0,0,0.15)] 
                      w-44 md:w-52 border border-gray-100
                      hover:-translate-y-2 hover:shadow-xl transition-all duration-300 group cursor-pointer">
                
                <!-- Badge 'Shop This' -->
                <div class="absolute -top-3 -right-3 bg-black text-white text-[10px] font-bold px-3 py-1 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    Shop This
                </div>

                <!-- Product Image Container -->
                <div class="bg-gray-50 rounded-xl overflow-hidden mb-3 border border-gray-100 relative aspect-square flex items-center justify-center">
                    <img src="{{ asset('images/polo-overcool.png') }}" 
                         alt="Polo Overcool"
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                </div>

                <!-- Product Info -->
                <div class="text-left px-1">
                    <h3 class="text-gray-900 font-bold text-sm leading-tight mb-1 group-hover:underline decoration-1 underline-offset-2">
                        Polo Overcool Series
                    </h3>
                    <p class="text-gray-500 text-xs font-medium">Rp 129.000</p>
                </div>

                <!-- Arrow Icon (Visual cue) -->
                <div class="absolute bottom-3 right-3 text-gray-300 group-hover:text-black transition-colors">
                    <i class="fa-solid fa-arrow-right text-xs"></i>
                </div>
            </a>

        </div>

    </div>
  </main>

  @include('components.footer')

</body>
</html>