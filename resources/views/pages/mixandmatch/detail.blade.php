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

  <!-- SWIPER CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>

  <style>
    body { font-family: 'Poppins', sans-serif; }

    .swiper-pagination-bullet {
        width: 5px !important;
        height: 5px !important;
        border-radius: 999px !important;
        background-color: #c0c0c0 !important;
        opacity: 0.6 !important;
    }

    .swiper-pagination-bullet-active {
        background-color: #000 !important;
        opacity: 1 !important;
    }

    .swiper-button-next, .swiper-button-prev {
        width: 28px !important;
        height: 28px !important;
        background: white !important;
        border-radius: 999px !important;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1) !important;
    }

    .swiper-button-next:after,
    .swiper-button-prev:after {
        font-size: 10px !important;
        color: black !important;
        font-weight: bold !important;
    }

    .swiper-button-next, .swiper-button-prev {
        opacity: 0;
        transition: opacity .3s ease;
    }

    .group:hover .swiper-button-next,
    .group:hover .swiper-button-prev {
        opacity: 1;
    }
  </style>
</head>

<body class="bg-white text-gray-900 antialiased">

  @include('components.navbar')

  @php
      $images = json_decode($mix->images_path);
      $mainImage = $images[0] ?? null;
  @endphp

  <main class="w-full min-h-screen pt-24 pb-32 relative overflow-hidden">

    <div class="max-w-4xl mx-auto px-6 relative z-10">

        <!-- BACK BUTTON -->
        <div class="absolute left-6 top-0 md:left-0">
            <a href="{{ route('mixandmatch.frontend') }}" class="group flex items-center text-gray-500 hover:text-black transition-colors duration-300">
                <div class="w-10 h-10 rounded-full border border-gray-200 flex items-center justify-center group-hover:border-black transition-colors mr-3">
                    <i class="fa-solid fa-arrow-left text-sm"></i>
                </div>
                <span class="font-medium text-sm tracking-wide">Back</span>
            </a>
        </div>

        <!-- TITLE -->
        <div class="text-center mt-16 mb-12">
            <span class="text-xs font-bold tracking-[0.2em] text-gray-400 uppercase mb-2 block">
              Mix & Match Collection
            </span>

            <h1 class="text-4xl md:text-6xl font-extrabold tracking-tight text-gray-900">
              {{ $mix->name }}
            </h1>
        </div>

        <!-- CONTENT WRAPPER -->
        <div class="relative flex justify-center items-center mt-8">

            <!-- BACKGROUND CIRCLE -->
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2
                        w-[300px] h-[300px] md:w-[450px] md:h-[450px]
                        bg-[#F2F0EB] rounded-full -z-10"></div>

            <!-- MODEL IMAGE -->
            @if($mainImage)
              <img src="{{ asset('storage/' . $mainImage) }}"
                   alt="{{ $mix->name }}"
                   class="relative z-10 w-[280px] md:w-[380px] object-contain drop-shadow-2xl hover:scale-[1.01] transition-transform duration-500">
            @endif

            <!-- PRODUCT CARD -->
            <div
               class="absolute z-20 -bottom-10 left-1/2 -translate-x-1/2 md:-ml-28
                      bg-white p-2 rounded-xl shadow-[0_15px_40px_-10px_rgba(0,0,0,0.1)]
                      w-40 md:w-48 border border-gray-100
                      hover:-translate-y-2 hover:shadow-xl transition-all duration-300 group">

                <!-- Badge -->
                <div class="absolute -top-2 -right-2 bg-black text-white text-[9px] font-bold px-2 py-1 rounded-full">
                    Mix
                </div>

                <!-- IMAGE SLIDER -->
                <div class="relative group">
                    <div class="swiper mySwiper bg-gray-50 rounded-lg overflow-hidden border border-gray-100 aspect-square">
                        <div class="swiper-wrapper">
                            @foreach ($images as $img)
                                <div class="swiper-slide">
                                    <img src="{{ asset('storage/' . $img) }}" class="w-full h-full object-cover">
                                </div>
                            @endforeach
                        </div>
                        <div class="swiper-pagination !bottom-1"></div>
                    </div>

                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>

                <!-- Product Info -->
                <div class="text-left px-1 mt-2">
                    <h3 class="text-gray-900 font-bold text-xs leading-tight mb-0.5">
                        {{ $mix->name }}
                    </h3>
                    <p class="text-gray-500 text-[10px] font-medium">
                        Mix & Match Collection
                    </p>
                </div>

                <!-- Arrow Icon -->
                <div class="absolute bottom-2 right-2 text-gray-300 group-hover:text-black transition-colors">
                    <i class="fa-solid fa-arrow-right text-[10px]"></i>
                </div>
            </div>

        </div>

    </div>
  </main>

  @include('components.footer')

  <!-- SWIPER JS -->
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

  <script>
    var swiper = new Swiper(".mySwiper", {
        loop: true,
        speed: 500,
        spaceBetween: 0,
        effect: "slide",
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });
  </script>

</body>
</html>
