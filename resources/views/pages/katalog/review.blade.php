<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Write a Review - {{ $product->name }}</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body { font-family: 'Poppins', sans-serif; }
        .star-icon { transition: color 0.2s ease-in-out, transform 0.1s; cursor: pointer; }
        .star-icon:hover { transform: scale(1.1); }
        .star-icon.active { color: #FACC15; }
        .star-icon.inactive { color: #E5E7EB; }
    </style>
</head>

<body class="bg-gray-50 text-gray-900 antialiased">

    @include('components.navbar')

    <div class="max-w-3xl mx-auto px-6 pt-32 pb-24">

        <!-- Header & Back Button -->
        <div class="mb-8">
            {{-- Tombol Back kembali ke Detail Produk --}}
            <a href="{{ route('detail', $product->id) }}" class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-black transition mb-4">
                <i class="fa-solid fa-arrow-left mr-2"></i> Back to Product
            </a>
            <h1 class="text-3xl font-bold tracking-tight">Write a Review</h1>
            <p class="text-gray-500 mt-1">Share your experience to help others make better choices.</p>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            
            <!-- Product Summary (DINAMIS) -->
            <div class="p-6 bg-gray-50 border-b border-gray-100 flex items-center gap-4">
                <div class="w-16 h-20 bg-white rounded-lg overflow-hidden border border-gray-200 flex-shrink-0">
                    {{-- Gambar Produk dari Database --}}
                    @if(isset($product->images) && is_array($product->images) && count($product->images) > 0)
                        <img src="{{ asset('storage/' . $product->images[0]) }}" class="w-full h-full object-cover">
                    @else
                        <img src="https://via.placeholder.com/150" class="w-full h-full object-cover">
                    @endif
                </div>
                <div>
                    {{-- Nama & Kategori Produk --}}
                    <h2 class="font-bold text-gray-900 text-lg">{{ $product->name }}</h2>
                    <p class="text-sm text-gray-500">{{ $product->category }} &bull; Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                </div>
            </div>

            <!-- Review Form -->
            <div class="p-6 md:p-8">
                <form action="{{ route('reviews.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    
                    <!-- 1. Star Rating -->
                    <div class="mb-8 text-center md:text-left">
                        <label class="block text-sm font-bold uppercase tracking-wider text-gray-500 mb-3">Overall Rating</label>
                        <div class="flex items-center gap-2 justify-center md:justify-start" id="star-container">
                            <i class="fa-solid fa-star text-3xl star-icon inactive" data-value="1"></i>
                            <i class="fa-solid fa-star text-3xl star-icon inactive" data-value="2"></i>
                            <i class="fa-solid fa-star text-3xl star-icon inactive" data-value="3"></i>
                            <i class="fa-solid fa-star text-3xl star-icon inactive" data-value="4"></i>
                            <i class="fa-solid fa-star text-3xl star-icon inactive" data-value="5"></i>
                        </div>
                        <input type="hidden" name="rating" id="rating-input" value="0" required>
                        <p class="text-sm text-gray-400 mt-2 font-medium" id="rating-text">Click stars to rate</p>
                    </div>

                    <!-- 2. Review Body (Comment) -->
                    {{-- Note: Saya sesuaikan name="comment" agar cocok dengan controller sebelumnya --}}
                    <div class="mb-6">
                        <label for="body" class="block text-sm font-bold text-gray-900 mb-2">Your Review</label>
                        <textarea name="comment" id="body" rows="5" placeholder="Tell us what you like or dislike about this product..." required
                            class="w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-3 focus:bg-white focus:border-black focus:ring-1 focus:ring-black transition outline-none placeholder-gray-400 resize-none font-medium"></textarea>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex items-center justify-end gap-6 border-t border-gray-100 pt-6">
                        <a href="{{ route('detail', $product->id) }}" class="text-sm font-bold text-gray-500 hover:text-black transition">Cancel</a>
                        <button type="submit" class="bg-black text-white px-8 py-3 rounded-lg font-bold text-sm uppercase tracking-wider hover:bg-gray-800 transition transform active:scale-[0.98] shadow-lg">
                            Submit Review
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    @include('components.footer')

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const stars = document.querySelectorAll('.star-icon');
            const ratingInput = document.getElementById('rating-input');
            const ratingText = document.getElementById('rating-text');
            const ratingLabels = ["Poor", "Fair", "Good", "Very Good", "Excellent"];
            let currentRating = 0;

            function highlightStars(count) {
                stars.forEach(star => {
                    const value = parseInt(star.getAttribute('data-value'));
                    if (value <= count) {
                        star.classList.remove('inactive', 'text-gray-200');
                        star.classList.add('active', 'text-yellow-400');
                    } else {
                        star.classList.remove('active', 'text-yellow-400');
                        star.classList.add('inactive', 'text-gray-200');
                    }
                });
            }

            stars.forEach(star => {
                star.addEventListener('mouseover', () => {
                    const value = parseInt(star.getAttribute('data-value'));
                    highlightStars(value);
                    ratingText.textContent = ratingLabels[value - 1];
                    ratingText.classList.add('text-yellow-600', 'font-bold');
                });

                star.addEventListener('mouseleave', () => {
                    highlightStars(currentRating);
                    if(currentRating === 0) {
                        ratingText.textContent = "Click stars to rate";
                        ratingText.classList.remove('text-yellow-600', 'font-bold');
                    } else {
                        ratingText.textContent = ratingLabels[currentRating - 1];
                    }
                });

                star.addEventListener('click', () => {
                    currentRating = parseInt(star.getAttribute('data-value'));
                    ratingInput.value = currentRating;
                    highlightStars(currentRating);
                });
            });
        });
    </script>
</body>
</html>