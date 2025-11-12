@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 py-10">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">

        {{-- Left: Product Images --}}
        <div>
            <div class="relative border border-gray-200 rounded-md">
                <img src="{{ asset('images/cityloop_main.jpg') }}" alt="City Loop Long Sleeve" class="w-full rounded-md">
                <button class="absolute left-3 top-1/2 transform -translate-y-1/2 bg-black text-white px-2 py-1 rounded-full hover:bg-gray-700">&#10094;</button>
                <button class="absolute right-3 top-1/2 transform -translate-y-1/2 bg-black text-white px-2 py-1 rounded-full hover:bg-gray-700">&#10095;</button>
            </div>
            <div class="flex gap-2 mt-3">
                <img src="{{ asset('images/cityloop_thumb1.jpg') }}" class="w-1/4 border rounded-md cursor-pointer hover:opacity-80" alt="Thumbnail 1">
                <img src="{{ asset('images/cityloop_thumb2.jpg') }}" class="w-1/4 border rounded-md cursor-pointer hover:opacity-80" alt="Thumbnail 2">
                <img src="{{ asset('images/cityloop_thumb3.jpg') }}" class="w-1/4 border rounded-md cursor-pointer hover:opacity-80" alt="Thumbnail 3">
                <img src="{{ asset('images/cityloop_thumb4.jpg') }}" class="w-1/4 border rounded-md cursor-pointer hover:opacity-80" alt="Thumbnail 4">
            </div>
        </div>

        {{-- Right: Product Info --}}
        <div>
            <span class="text-sm bg-gray-100 px-3 py-1 rounded-full">Flannel Shirt</span>
            <h1 class="text-3xl font-bold mt-3">CITY LOOP LONG SLEEVE</h1>
            <p class="text-gray-500 mt-1">RIFOLD City Loop Long Sleeve Flannel Shirt Green Plaid Casual Unisex</p>
            <p class="text-2xl font-semibold mt-4">Rp149.900</p>

            {{-- Color --}}
            <div class="mt-5">
                <p class="font-semibold mb-1">Color</p>
                <div class="flex items-center gap-3">
                    <div class="w-6 h-6 bg-[#A3C5B5] rounded-full border"></div>
                </div>
            </div>

            {{-- Size --}}
            <div class="mt-5">
                <p class="font-semibold mb-2">Size</p>
                <div class="flex gap-2">
                    <button class="border border-black px-4 py-1 rounded-md hover:bg-black hover:text-white">S</button>
                    <button class="border border-black px-4 py-1 rounded-md hover:bg-black hover:text-white">M</button>
                    <button class="border border-black px-4 py-1 rounded-md hover:bg-black hover:text-white">L</button>
                    <button class="border border-black px-4 py-1 rounded-md hover:bg-black hover:text-white">XL</button>
                </div>
                <a href="#" class="text-sm text-gray-500 underline mt-1 inline-block">Size guide</a>
            </div>

            {{-- Action Buttons --}}
            <div class="mt-6 flex gap-3">
                <form action="{{ route('checkout') }}" method="GET" class="flex-1">
                    <button type="submit" class="w-full bg-black text-white py-3 font-semibold rounded-md hover:bg-gray-800">
                        ADD TO CART
                    </button>
                </form>
                <button class="border border-gray-300 rounded-md w-12 flex justify-center items-center hover:bg-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 8.25c0-2.071-1.679-3.75-3.75-3.75S13.5 6.179 13.5 8.25c0 
                               2.071 1.679 3.75 3.75 3.75S21 10.321 21 8.25zM3 
                               8.25c0-2.071-1.679-3.75-3.75-3.75S10.5 6.179 10.5 
                               8.25c0 2.071 1.679 3.75-3.75 3.75S3 10.321 
                               3 8.25zm0 0v10.5c0 .621.504 1.125 1.125 
                               1.125h15.75A1.125 1.125 0 0021 18.75V8.25"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Tabs --}}
    <div class="mt-10 border-b flex gap-8 text-lg font-semibold">
        <button class="border-b-2 border-black pb-2">DETAILS</button>
        <button class="text-gray-400 hover:text-black">REVIEWS</button>
    </div>

    {{-- Details --}}
    <div class="mt-6 text-gray-700 leading-relaxed">
        <p><strong>RIFOLD City Loop Long Sleeve Flannel Shirt Green Plaid Casual Unisex</strong></p>
        <p>Tampil santai, kalem, dan tetap stylish dengan City Loop flannel lengan panjang berwarna green plaid yang cocok untuk kamu yang suka eksplor kota tanpa ribet.</p>

        <p class="mt-3 font-semibold">Detail Produk Premium:</p>
        <ul class="list-disc ml-6">
            <li>Warna: Green Plaid</li>
            <li>Bahan: Flannel Cotton Premium</li>
            <li>Gramas: ±180–190 GSM — ringan dan hangat</li>
            <li>Potongan: Regular Fit — Lengan Panjang</li>
            <li>Jahitan: Presisi dan tahan lama</li>
        </ul>

        <p class="mt-3 font-semibold">Karakteristik Kain:</p>
        <ul class="list-disc ml-6">
            <li>Lembut dan hangat, ideal untuk cuaca sejuk</li>
            <li>Adem dan menyerap keringat</li>
            <li>Mudah dipadukan dengan jeans, khaki, atau rok kasual</li>
            <li>Cocok untuk pria maupun wanita</li>
        </ul>
    </div>

    {{-- You Might Also Like --}}
    <div class="mt-16">
        <h2 class="text-center text-3xl font-bold mb-8">YOU MIGHT ALSO LIKE</h2>
        <div class="grid grid-cols-2 md:grid-cols-3 gap-6 text-center">
            <div>
                <img src="{{ asset('images/coze_jacket.jpg') }}" alt="Coze Jacket" class="rounded-md">
                <p class="font-semibold mt-2">COZE JACKET CLASSY BLACK</p>
                <p>Rp149.900</p>
            </div>
            <div>
                <img src="{{ asset('images/cityloop_main.jpg') }}" alt="City Loop Long Sleeve" class="rounded-md">
                <p class="font-semibold mt-2">CITY LOOP LONG SLEEVE</p>
                <p>Rp149.900</p>
            </div>
            <div>
                <img src="{{ asset('images/weekend_walk.jpg') }}" alt="Weekend Walk" class="rounded-md">
                <p class="font-semibold mt-2">WEEKEND WALK LONG SLEEVE</p>
                <p>Rp149.900</p>
            </div>
        </div>
    </div>
</div>

{{-- Footer --}}
<footer class="bg-[#3E3C34] text-white mt-20">
    <div class="grid md:grid-cols-3 gap-6 px-8 py-10">
        <div>
            <h1 class="text-4xl font-extrabold leading-tight">FOR THE STORIES<br>AHEAD</h1>
        </div>
        <div>
            <h3 class="font-semibold mb-2">Company</h3>
            <p>About</p>
            <p>Address</p>
        </div>
        <div>
            <h3 class="font-semibold mb-2">Contact</h3>
            <p>WhatsApp</p>
            <p>rifold@gmail.com</p>
            <h3 class="font-semibold mt-3 mb-2">Follow us</h3>
            <p>Instagram</p>
            <p>TikTok</p>
            <p>Facebook</p>
        </div>
    </div>
    <div class="text-center border-t border-white py-4 font-bold text-xl">RIFOLD</div>
</footer>
@endsection
