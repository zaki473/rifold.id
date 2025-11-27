<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Write a Review - Rifold</title>
    
    <!-- TAILWIND CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- FONT POPPINS -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body { font-family: 'Poppins', sans-serif; }
        
        /* Star Animation */
        .star-icon { transition: color 0.2s ease-in-out, transform 0.1s; cursor: pointer; }
        .star-icon:hover { transform: scale(1.1); }
        .star-icon.active { color: #FACC15; /* Yellow-400 */ }
        .star-icon.inactive { color: #E5E7EB; /* Gray-200 */ }
    </style>
</head>

<body class="bg-gray-50 text-gray-900 antialiased">

    <!-- NAVBAR -->
    @include('components.navbar')

    <div class="max-w-3xl mx-auto px-6 pt-32 pb-24">

        <!-- Header & Back Button -->
        <div class="mb-8">
            <a href="javascript:history.back()" class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-black transition mb-4">
                <i class="fa-solid fa-arrow-left mr-2"></i> Back to Product
            </a>
            <h1 class="text-3xl font-bold tracking-tight">Write a Review</h1>
            <p class="text-gray-500 mt-1">Share your experience to help others make better choices.</p>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            
            <!-- Product Summary (Context) -->
            <div class="p-6 bg-gray-50 border-b border-gray-100 flex items-center gap-4">
                <div class="w-16 h-20 bg-white rounded-lg overflow-hidden border border-gray-200 flex-shrink-0">
                    <!-- Ganti dengan gambar produk dinamis nanti -->
                    <img src="{{ asset('images/detail/polo tonepop cactus detail.webp') }}" 
                         class="w-full h-full object-cover" alt="Product Image">
                </div>
                <div>
                    <h2 class="font-bold text-gray-900 text-lg">Polo Tonepop Cactus Green</h2>
                    <p class="text-sm text-gray-500">Size: L &bull; Color: Cactus Green</p>
                </div>
            </div>

            <!-- Review Form -->
            <div class="p-6 md:p-8">
                <form action="{{ route('reviews.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <!-- Hidden Input ID Produk (Dinamis dari Route) -->
                    <input type="hidden" name="product_id" value="{{ $id ?? 1 }}"> 
                    
                    <!-- 1. Star Rating Input -->
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

                    <!-- 2. Review Title -->
                    <div class="mb-6">
                        <label for="title" class="block text-sm font-bold text-gray-900 mb-2">Review Headline</label>
                        <input type="text" name="title" id="title" placeholder="e.g. Sangat nyaman dan bahannya adem!" required
                            class="w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-3 focus:bg-white focus:border-black focus:ring-1 focus:ring-black transition outline-none placeholder-gray-400 font-medium">
                    </div>

                    <!-- 3. Review Body -->
                    <div class="mb-6">
                        <label for="body" class="block text-sm font-bold text-gray-900 mb-2">Your Review</label>
                        <textarea name="body" id="body" rows="5" placeholder="Tell us what you like or dislike about this product..." required
                            class="w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-3 focus:bg-white focus:border-black focus:ring-1 focus:ring-black transition outline-none placeholder-gray-400 resize-none font-medium"></textarea>
                        <p class="text-xs text-gray-400 mt-2 text-right">Min. 20 characters</p>
                    </div>

                    <!-- 4. Photo Upload -->
                    <div class="mb-8">
                        <label class="block text-sm font-bold text-gray-900 mb-2">Add Photos (Optional)</label>
                        <div class="flex items-center justify-center w-full">
                            <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition group">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6" id="upload-placeholder">
                                    <svg class="w-8 h-8 mb-3 text-gray-400 group-hover:text-gray-600 transition" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                    </svg>
                                    <p class="text-sm text-gray-500"><span class="font-semibold text-black">Click to upload</span> or drag and drop</p>
                                    <p class="text-xs text-gray-500 mt-1">PNG, JPG (MAX. 5MB)</p>
                                </div>
                                <!-- Tempat preview nama file -->
                                <div id="file-preview" class="hidden flex-col items-center">
                                    <i class="fa-regular fa-image text-3xl text-gray-700 mb-2"></i>
                                    <p class="text-sm text-gray-900 font-bold" id="filename">image.jpg</p>
                                    <p class="text-xs text-green-600 font-medium">Ready to upload</p>
                                </div>
                                <input id="dropzone-file" type="file" name="photos[]" class="hidden" multiple accept="image/*" />
                            </label>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex items-center justify-end gap-6 border-t border-gray-100 pt-6">
                        <a href="javascript:history.back()" class="text-sm font-bold text-gray-500 hover:text-black transition">Cancel</a>
                        <button type="submit" class="bg-black text-white px-8 py-3 rounded-lg font-bold text-sm uppercase tracking-wider hover:bg-gray-800 transition transform active:scale-[0.98] shadow-lg">
                            Submit Review
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    @include('components.footer')

    <!-- JAVASCRIPT LOGIC -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // --- STAR RATING LOGIC ---
            const stars = document.querySelectorAll('.star-icon');
            const ratingInput = document.getElementById('rating-input');
            const ratingText = document.getElementById('rating-text');
            const ratingLabels = ["Poor", "Fair", "Good", "Very Good", "Excellent"];
            
            let currentRating = 0;

            stars.forEach(star => {
                // Hover Effect
                star.addEventListener('mouseover', () => {
                    const value = parseInt(star.getAttribute('data-value'));
                    highlightStars(value);
                    ratingText.textContent = ratingLabels[value - 1];
                    ratingText.classList.add('text-yellow-600', 'font-bold');
                });

                // Mouse Leave (Reset to clicked value)
                star.addEventListener('mouseleave', () => {
                    highlightStars(currentRating);
                    if(currentRating === 0) {
                        ratingText.textContent = "Click stars to rate";
                        ratingText.classList.remove('text-yellow-600', 'font-bold');
                    } else {
                        ratingText.textContent = ratingLabels[currentRating - 1];
                    }
                });

                // Click Effect
                star.addEventListener('click', () => {
                    currentRating = parseInt(star.getAttribute('data-value'));
                    ratingInput.value = currentRating;
                    highlightStars(currentRating);
                    
                    // Animasi klik kecil
                    star.style.transform = "scale(1.3)";
                    setTimeout(() => star.style.transform = "scale(1)", 150);
                });
            });

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

            // --- FILE UPLOAD PREVIEW LOGIC ---
            const fileInput = document.getElementById('dropzone-file');
            const uploadPlaceholder = document.getElementById('upload-placeholder');
            const filePreview = document.getElementById('file-preview');
            const filenameDisplay = document.getElementById('filename');

            fileInput.addEventListener('change', function() {
                if (this.files && this.files.length > 0) {
                    const count = this.files.length;
                    uploadPlaceholder.classList.add('hidden');
                    filePreview.classList.remove('hidden');
                    filePreview.classList.add('flex');
                    
                    if(count === 1) {
                        filenameDisplay.textContent = this.files[0].name;
                    } else {
                        filenameDisplay.textContent = `${count} files selected`;
                    }
                }
            });
        });
    </script>
</body>
</html>