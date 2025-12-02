<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk — {{ $product->name }}</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .size-active {
            background-color: #000 !important;
            color: #fff !important;
            border-color: #000 !important;
        }

        /* Styling untuk Bintang Rating di Form */
        .rate {
            float: left;
            height: 46px;
            padding: 0 10px;
        }

        .rate:not(:checked)>input {
            position: absolute;
            top: -9999px;
        }

        .rate:not(:checked)>label {
            float: right;
            width: 1em;
            overflow: hidden;
            white-space: nowrap;
            cursor: pointer;
            font-size: 30px;
            color: #ccc;
        }

        .rate:not(:checked)>label:before {
            content: '★ ';
        }

        .rate>input:checked~label {
            color: #ffc700;
        }

        .rate:not(:checked)>label:hover,
        .rate:not(:checked)>label:hover~label {
            color: #deb217;
        }
    </style>
</head>

<body class="bg-white text-gray-800">

    @include('components.navbar')

    <main class="w-full pt-28 pb-24">
        <div class="container mx-auto px-4 md:px-6 max-w-6xl">

            {{-- HITUNG RATING RATA-RATA --}}
            @php
                $avgRating = $product->reviews->avg('rating'); // Hitung rata-rata
                $totalReviews = $product->reviews->count();    // Hitung jumlah review
                $roundedRating = round($avgRating, 1);         // Bulatkan 1 desimal
            @endphp

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16">
                {{-- BAGIAN GAMBAR --}}
                <div>
                    <div class="relative w-full aspect-[4/5] bg-gray-100 rounded-xl overflow-hidden shadow-sm group">
                        @if(is_array($product->images) && count($product->images) > 0)
                            <img id="mainImage" src="{{ asset('storage/' . $product->images[0]) }}"
                                class="w-full h-full object-cover object-top transition-transform duration-500">
                        @else
                            <img id="mainImage" src="https://via.placeholder.com/400" class="w-full h-full object-cover">
                        @endif
                        <button id="prevBtn"
                            class="absolute top-1/2 left-4 -translate-y-1/2 bg-white/90 text-black hover:bg-black hover:text-white w-10 h-10 rounded-full flex items-center justify-center shadow-md transition-all opacity-0 group-hover:opacity-100"><i
                                class="fa-solid fa-chevron-left"></i></button>
                        <button id="nextBtn"
                            class="absolute top-1/2 right-4 -translate-y-1/2 bg-white/90 text-black hover:bg-black hover:text-white w-10 h-10 rounded-full flex items-center justify-center shadow-md transition-all opacity-0 group-hover:opacity-100"><i
                                class="fa-solid fa-chevron-right"></i></button>
                    </div>
                    <div class="grid grid-cols-4 gap-4 mt-4">
                        @if(is_array($product->images))
                            @foreach($product->images as $img)
                                @if(is_string($img))
                                    <div class="relative aspect-square cursor-pointer overflow-hidden rounded-lg border border-transparent hover:border-black transition-all group thumb-container"
                                        data-url="{{ asset('storage/' . $img) }}" onclick="changeMainImage(this.dataset.url)">
                                        <img src="{{ asset('storage/' . $img) }}"
                                            class="thumb w-full h-full object-cover hover:scale-110 transition-transform duration-500">
                                    </div>
                                @endif
                            @endforeach
                        @endif
                    </div>
                </div>

                {{-- BAGIAN INFORMASI --}}
                <div class="flex flex-col justify-center">
                    <div class="mb-6">
                        <span
                            class="inline-block px-3 py-1 bg-gray-100 text-gray-500 rounded-md text-xs font-semibold tracking-widest uppercase mb-3">{{ $product->category }}</span>
                        <h1 class="text-3xl md:text-4xl font-bold text-gray-900 leading-tight mb-2">{{ $product->name }}
                        </h1>

                        {{-- RATING HEADER --}}
                        <div class="flex items-center gap-2 mb-4">
                            <div class="flex text-yellow-400 text-sm">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= round($avgRating))
                                        <i class="fa-solid fa-star"></i>
                                    @else
                                        <i class="fa-regular fa-star text-gray-300"></i>
                                    @endif
                                @endfor
                            </div>
                            <a href="#reviews"
                                class="text-sm text-gray-500 hover:text-black underline decoration-1 underline-offset-2">
                                {{ $roundedRating }} ({{ $totalReviews }} Reviews)
                            </a>
                        </div>

                        <p class="text-2xl font-semibold text-gray-900">Rp
                            {{ number_format($product->price, 0, ',', '.') }}</p>
                    </div>

                    <p class="text-gray-500 leading-relaxed mb-8 text-sm md:text-base">{{ $product->description }}</p>

                    <div class="mb-6">
                        <p class="text-sm font-medium text-gray-900 mb-2 uppercase tracking-wide">Color</p>
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full ring-2 ring-offset-2 ring-gray-200 shadow-sm"
                                style="{{ 'background-color: ' . ($product->color ?? '#000000') }}"></div>
                            <span class="text-sm text-gray-500 uppercase">{{ $product->color ?? 'No Color' }}</span>
                        </div>
                    </div>

                    <div class="mb-8">
                        <div class="flex justify-between items-end mb-2">
                            <p class="text-sm font-medium text-gray-900 uppercase tracking-wide">Size</p>
                        </div>
                        <div class="flex flex-wrap gap-3">
                            @if($product->size)
                                @foreach(explode(',', $product->size) as $s)
                                    <button type="button" data-size="{{ trim($s) }}"
                                        class="size-btn min-w-[3.5rem] h-12 border border-gray-200 rounded-lg text-sm font-medium text-gray-700 hover:border-black transition-all focus:outline-none bg-white">{{ trim($s) }}</button>
                                @endforeach
                            @else
                                <span class="text-xs text-gray-500">All Size</span>
                            @endif
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-4">
                        <div class="flex items-center border border-gray-300 rounded-lg h-12 w-fit sm:w-auto">
                            <button id="decreaseQty" class="px-4 text-gray-500 hover:text-black transition">-</button>
                            <input id="quantity" type="number" min="1" value="1"
                                class="w-12 text-center text-gray-900 font-medium focus:outline-none h-full">
                            <button id="increaseQty" class="px-4 text-gray-500 hover:text-black transition">+</button>
                        </div>
                        <button id="addToCartBtn"
                            class="flex-1 bg-black text-white h-12 rounded-lg font-semibold hover:bg-gray-800 transition active:scale-[0.99] shadow-lg">ADD
                            TO CART</button>
                    </div>
                </div>
            </div>

            {{-- PRODUCT DETAILS TAB --}}
            <div class="mt-20 border-t border-gray-100 pt-10">
                <h3 class="text-lg font-bold text-gray-900 mb-6 uppercase tracking-wider">Product Details</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-10 text-gray-600 leading-relaxed text-sm md:text-base">
                    <div class="space-y-4">
                        <p>{{ $product->description }}</p>
                        <ul class="list-none space-y-2">
                            <li class="flex items-start"><span class="mr-2 text-black">•</span> 100% Premium Material
                            </li>
                            <li class="flex items-start"><span class="mr-2 text-black">•</span> Comfortable & Breathable
                            </li>
                        </ul>
                    </div>
                    <div class="bg-gray-50 p-6 rounded-xl">
                        <p class="font-semibold text-gray-900 mb-3">Size Chart (cm)</p>
                        <div class="grid grid-cols-3 gap-4 text-sm">
                            <div><span class="block font-bold text-black">M</span> LD 53, PB 66</div>
                            <div><span class="block font-bold text-black">L</span> LD 57, PB 69</div>
                            <div><span class="block font-bold text-black">XL</span> LD 61, PB 72</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- CUSTOMER REVIEWS (DINAMIS) --}}
            <div id="reviews" class="mt-20 border-t border-gray-100 pt-10 scroll-mt-24">
                <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
                    <div>
                        <h3 class="text-lg font-bold text-gray-900 uppercase tracking-wider flex items-center gap-3">
                            Customer Reviews <span
                                class="bg-black text-white text-xs px-2 py-0.5 rounded-full">{{ $totalReviews }}</span>
                        </h3>
                        <div class="flex items-center gap-2 mt-1">
                            <div class="flex text-yellow-400 text-sm">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= round($avgRating)) <i class="fa-solid fa-star"></i>
                                    @else <i class="fa-regular fa-star text-gray-300"></i> @endif
                                @endfor
                            </div>
                            <p class="text-sm text-gray-500 font-medium">{{ $roundedRating }} out of 5</p>
                        </div>
                    </div>

                    {{-- TOMBOL WRITE REVIEW (Memicu Modal) --}}
                    <a href="{{ route('reviews.create', ['id' => $product->id]) }}"
                        class="inline-flex items-center justify-center px-6 py-2 border border-gray-300 rounded-full text-sm font-semibold text-gray-700 hover:border-black hover:text-black transition">
                        Write a Review
                    </a>
                </div>

                {{-- LOOPING REVIEW DARI DATABASE --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @forelse($product->reviews as $review)
                        <div class="bg-gray-50 p-6 rounded-xl">
                            <div class="flex items-start justify-between mb-4">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-10 h-10 rounded-full bg-gray-300 flex items-center justify-center text-gray-600 font-bold uppercase">
                                        {{ substr($review->user->name ?? 'A', 0, 2) }}
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-gray-900">{{ $review->user->name ?? 'Anonymous' }}
                                        </p>
                                        <p class="text-xs text-gray-500">{{ $review->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                                <div class="text-yellow-400 text-xs">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $review->rating) <i class="fa-solid fa-star"></i>
                                        @else <i class="fa-regular fa-star text-gray-300"></i> @endif
                                    @endfor
                                </div>
                            </div>
                            <p class="text-sm text-gray-600 leading-relaxed">{{ $review->comment }}</p>
                        </div>
                    @empty
                        <p class="text-gray-500 col-span-2 text-center py-4">Belum ada review. Jadilah yang pertama mereview
                            produk ini!</p>
                    @endforelse
                </div>
            </div>

            {{-- YOU MIGHT ALSO LIKE --}}
            <div class="mt-24">
                <div class="flex items-center justify-between mb-8">
                    <h2 class="text-2xl font-bold text-gray-900">You Might Also Like</h2>
                    <a href="{{ route('katalog') }}"
                        class="text-sm font-medium text-gray-500 hover:text-black underline">View All</a>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-6 lg:gap-8">
                    @php
                        $recommendations = [
                            ['img' => 'images/katalog/coze jacket classy black.png', 'title' => 'Coze Jacket Classy Black', 'price' => '149.900'],
                            ['img' => 'images/katalog/Cityloop long.png', 'title' => 'City Loop Long Sleeve', 'price' => '149.900'],
                            ['img' => 'images/katalog/Weekend walk.png', 'title' => 'Weekend Walk Long Sleeve', 'price' => '149.900'],
                        ];
                    @endphp
                    @foreach ($recommendations as $item)
                        <div class="group cursor-pointer">
                            <div class="relative w-full aspect-[4/5] bg-gray-100 rounded-xl overflow-hidden mb-4">
                                <img src="{{ asset($item['img']) }}"
                                    class="w-full h-full object-cover object-top transition-transform duration-700 group-hover:scale-105">
                            </div>
                            <div class="text-center md:text-left">
                                <h3
                                    class="font-medium text-gray-900 text-base mb-1 group-hover:underline decoration-1 underline-offset-4 line-clamp-1">
                                    {{ $item['title'] }}</h3>
                                <p class="text-gray-500 text-sm font-semibold">Rp{{ $item['price'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </main>

    {{-- MODAL WRITE REVIEW --}}
    <div id="reviewModal"
        class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm flex justify-center items-center z-50 transition-all p-4">
        <div class="bg-white p-8 rounded-2xl w-full max-w-md shadow-2xl relative">
            <button id="closeReviewModal" class="absolute top-4 right-4 text-gray-400 hover:text-black"><i
                    class="fa-solid fa-xmark text-xl"></i></button>

            <h2 class="text-xl font-bold text-gray-900 mb-1">Write a Review</h2>
            <p class="text-sm text-gray-500 mb-6">Bagikan pengalamanmu tentang produk ini.</p>

            <form action="{{ route('reviews.store') }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">

                {{-- Star Rating Input --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Rating</label>
                    <div class="rate">
                        <input type="radio" id="star5" name="rating" value="5" />
                        <label for="star5" title="5 stars">5 stars</label>
                        <input type="radio" id="star4" name="rating" value="4" />
                        <label for="star4" title="4 stars">4 stars</label>
                        <input type="radio" id="star3" name="rating" value="3" />
                        <label for="star3" title="3 stars">3 stars</label>
                        <input type="radio" id="star2" name="rating" value="2" />
                        <label for="star2" title="2 stars">2 stars</label>
                        <input type="radio" id="star1" name="rating" value="1" />
                        <label for="star1" title="1 star">1 star</label>
                    </div>
                    <div class="clear-both"></div>
                </div>

                {{-- Comment Input --}}
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Review</label>
                    <textarea name="comment" rows="4"
                        class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-black"
                        placeholder="Produknya bagus banget..."></textarea>
                </div>

                <button type="submit"
                    class="w-full bg-black text-white py-3 rounded-lg font-bold hover:bg-gray-800 transition">Submit
                    Review</button>
            </form>
        </div>
    </div>

    {{-- POPUP CART --}}
    <div id="cartPopup"
        class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm flex justify-center items-center z-50 transition-all">
        <div class="bg-white p-8 rounded-2xl text-center shadow-2xl animate-fade max-w-sm w-full mx-4">
            <h2 class="text-xl font-bold text-gray-900 mb-2">Berhasil Ditambahkan</h2>
            <div class="flex flex-col gap-3 mt-4">
                <a href="{{ route('cart') }}" class="w-full bg-black text-white py-3 rounded-lg font-medium block">Lihat
                    Keranjang</a>
                <button id="closePopup"
                    class="w-full bg-white border border-gray-200 text-gray-700 py-3 rounded-lg font-medium">Lanjut
                    Belanja</button>
            </div>
        </div>
    </div>

    {{-- DATA SERVER & SCRIPT --}}
    @php
        $dataGambar = [];
        if (isset($product->images) && is_array($product->images)) {
            foreach ($product->images as $img) {
                if (is_string($img))
                    $dataGambar[] = asset('storage/' . $img);
            }
        }
    @endphp
    <input type="hidden" id="data-gambar-server" value='@json($dataGambar)'>

    <script>
        // 1. Gambar & Navigasi
        const rawData = document.getElementById('data-gambar-server').value;
        const images = JSON.parse(rawData);
        let current = 0;
        const mainImage = document.getElementById('mainImage');

        function changeMainImage(src) {
            if (mainImage) {
                mainImage.style.opacity = 0;
                setTimeout(() => { mainImage.src = src; mainImage.style.opacity = 1; }, 100);
            }
        }

        function updateImage() { if (images.length > 0) changeMainImage(images[current]); }

        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');
        if (prevBtn) prevBtn.onclick = () => { if (images.length > 0) { current = (current - 1 + images.length) % images.length; updateImage(); } };
        if (nextBtn) nextBtn.onclick = () => { if (images.length > 0) { current = (current + 1) % images.length; updateImage(); } };

        // 2. Logic Size
        let selectedSize = null;
        const sizeBtns = document.querySelectorAll('.size-btn');
        sizeBtns.forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                sizeBtns.forEach(b => { b.classList.remove('size-active'); b.classList.add('bg-white', 'text-gray-700'); });
                btn.classList.remove('bg-white', 'text-gray-700');
                btn.classList.add('size-active');
                selectedSize = btn.dataset.size;
            });
        });

        // 3. Logic Quantity
        const qty = document.getElementById('quantity');
        const inc = document.getElementById('increaseQty');
        const dec = document.getElementById('decreaseQty');
        if (qty && inc && dec) {
            inc.onclick = () => qty.value++;
            dec.onclick = () => qty.value = Math.max(1, qty.value - 1);
        }

        // 4. Logic Popup Cart
        const popup = document.getElementById('cartPopup');
        const addBtn = document.getElementById('addToCartBtn');
        const closeBtn = document.getElementById('closePopup');
        if (addBtn && popup) {
            addBtn.onclick = () => {
                if (sizeBtns.length > 0 && !selectedSize) {
                    alert("Harap pilih ukuran (Size) terlebih dahulu!");
                    return;
                }
                popup.classList.remove('hidden');
            };
        }
        if (closeBtn && popup) closeBtn.onclick = () => popup.classList.add('hidden');
        if (popup) popup.onclick = (e) => { if (e.target === popup) popup.classList.add('hidden'); };

        // 5. Logic Modal Review
        const reviewModal = document.getElementById('reviewModal');
        const openReviewBtn = document.getElementById('openReviewModal');
        const closeReviewBtn = document.getElementById('closeReviewModal');

        if (openReviewBtn && reviewModal) {
            openReviewBtn.onclick = () => {
                // Cek apakah user sudah login (Opsional: bisa dihandle backend redirect, tapi UX ini lebih baik)
                // @auth
                    reviewModal.classList.remove('hidden');
                // @else
                    //    window.location.href = "{{ route('login') }}";
                // @endauth
            }
        }
        if (closeReviewBtn) closeReviewBtn.onclick = () => reviewModal.classList.add('hidden');
        if (reviewModal) reviewModal.onclick = (e) => { if (e.target === reviewModal) reviewModal.classList.add('hidden'); }

    </script>

</body>

</html>