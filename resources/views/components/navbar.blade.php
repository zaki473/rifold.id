<!-- Navbar -->
<nav class="bg-white backdrop-blur-md shadow-sm sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">

            <!-- Logo (Selalu di Kiri) -->
            <div class="flex-shrink-0">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('images/logo.png') }}" alt="logo" width="160" />
                </a>
            </div>

            <!-- Menu Desktop (Tengah) -->
            <div class="hidden md:flex justify-center flex-grow">
                <div class="flex items-baseline space-x-8">
                    <a href="{{ route('home') }}"
                        class="text-gray-700 hover:text-black text-sm font-medium transition-colors duration-300 relative group">
                        <span>Home</span>
                        <span
                            class="absolute bottom-0 left-0 w-full h-0.5 bg-black transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 ease-out"></span>
                    </a>
                    <a href="{{ route('about') }}"
                        class="text-gray-700 hover:text-black text-sm font-medium transition-colors duration-300 relative group">
                        <span>About</span>
                        <span
                            class="absolute bottom-0 left-0 w-full h-0.5 bg-black transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 ease-out"></span>
                    </a>
                    <a href="{{ route('katalog') }}"
                        class="text-gray-700 hover:text-black text-sm font-medium transition-colors duration-300 relative group">
                        <span>Katalog</span>
                        <span
                            class="absolute bottom-0 left-0 w-full h-0.5 bg-black transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 ease-out"></span>
                    </a>
                    <a href="{{ route('mixandmatch.frontend') }}"
                        class="text-gray-700 hover:text-black text-sm font-medium transition-colors duration-300 relative group">
                        <span>Mix and Match</span>
                        <span
                            class="absolute bottom-0 left-0 w-full h-0.5 bg-black transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 ease-out"></span>
                    </a>
                </div>
            </div>

            <!-- Ikon Kanan (Search, Cart, Profile) & Tombol Menu Mobile -->
            <div class="flex items-center space-x-4">

                <!-- Search Bar Desktop -->
                <div class="hidden md:block relative">
                    <input type="text" placeholder="Search product.."
                        class="bg-gray-100 rounded-full py-2 pl-10 pr-4 w-56 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:bg-white transition-all duration-300 ease-in-out">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                        </svg>
                    </div>
                </div>

                <!-- Ikon Search Mobile -->
                <button id="search-toggle-mobile"
                    class="md:hidden p-2 rounded-full hover:bg-gray-200 transition-colors">
                    <svg class="w-6 h-6 text-gray-700" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                    </svg>
                </button>

                @auth
                <!-- Cart (Hanya muncul jika login) -->
                <a href="{{ route('cart') }}" class="relative group p-2">
                    <svg class="w-6 h-6 text-gray-700 group-hover:text-black transition-colors duration-300"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c.51 0 .962-.343 1.087-.835l1.823-6.831a.75.75 0 00-.678-.915H5.617m-1.386-2.25L5.617 5.25m0 0L6 7.5h12l-1.823-6.75H5.617zM6 18.75a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                    </svg>
                </a>
                @endauth

                <!-- START: Logic Profile / Login Button (Desktop) -->
                <div class="hidden sm:block">
                    @auth
                        <!-- KONDISI: SUDAH LOGIN -->
                        <a href="{{ route('profile.index') }}" class="flex items-center justify-center p-1 focus:outline-none group" title="My Profile">
                            @if(Auth::user()->profile_photo_path)
                                <!-- Opsi 1: Jika ada foto profil -->
                                <img src="{{ asset('storage/' . Auth::user()->profile_photo_path) }}"
                                     alt="{{ Auth::user()->name }}"
                                     class="w-8 h-8 rounded-full object-cover border border-gray-300 group-hover:border-black transition-all duration-300">
                            @else
                                <!-- Opsi 2: Jika tidak ada foto (Tampilkan Inisial) -->
                                <div class="w-8 h-8 rounded-full bg-gray-100 border border-gray-300 flex items-center justify-center text-sm font-bold text-gray-700 group-hover:bg-black group-hover:text-white transition-all duration-300">
                                    {{-- Ambil huruf pertama dari nama user --}}
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>
                            @endif
                        </a>
                    @else
                        <!-- KONDISI: BELUM LOGIN (GUEST) -->
                        <a href="{{ route('loginpage') }}" class="relative group p-2 block" title="Login">
                            <svg class="w-7 h-7 text-gray-700 group-hover:text-black transition-colors duration-300"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </a>
                    @endauth
                </div>
                <!-- END: Logic Profile / Login Button -->

                <!-- Tombol Hamburger (hanya tampil di mobile) -->
                <div class="md:hidden">
                    <button id="mobile-menu-button" type="button"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-700 hover:text-black hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-gray-500"
                        aria-controls="mobile-menu" aria-expanded="false">
                        <span class="sr-only">Open main menu</span>
                        <!-- Ikon hamburger -->
                        <svg id="icon-open" class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                        <!-- Ikon close (X) -->
                        <svg id="icon-close" class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Search Bar Mobile -->
    <div id="mobile-search" class="hidden md:hidden px-4 pb-4">
        <div class="relative">
            <input type="text" placeholder="Cari produk..."
                class="bg-gray-100 rounded-full py-2 pl-10 pr-4 w-full focus:outline-none focus:ring-2 focus:ring-gray-400 focus:bg-white transition-all duration-300 ease-in-out">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="w-5 h-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                </svg>
            </div>
        </div>
    </div>

    <!-- Menu Mobile -->
    <div class="md:hidden hidden" id="mobile-menu">
        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3 border-t border-gray-200">
            <a href="{{ route('home') }}"
                class="text-gray-700 hover:bg-gray-200 hover:text-black block px-3 py-2 rounded-md text-base font-medium">Home</a>
            <a href="{{ route('about') }}"
                class="text-gray-700 hover:bg-gray-200 hover:text-black block px-3 py-2 rounded-md text-base font-medium">About</a>
            <a href="{{ route('katalog') }}"
                class="text-gray-700 hover:bg-gray-200 hover:text-black block px-3 py-2 rounded-md text-base font-medium">Katalog</a>
            <a href="{{ route('mixandmatch.frontend') }}"
                class="text-gray-700 hover:bg-gray-200 hover:text-black block px-3 py-2 rounded-md text-base font-medium">Mix
                and Match</a>

            <!-- Logic Mobile: Login vs User Profile -->
            @auth
                <div class="border-t border-gray-200 mt-2 pt-2">
                    <div class="px-3 py-2 flex items-center">
                        @if(Auth::user()->profile_photo_path)
                             <img src="{{ asset('storage/' . Auth::user()->profile_photo_path) }}" alt="" class="h-8 w-8 rounded-full object-cover mr-2">
                        @else
                             <div class="h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center text-xs font-bold mr-2 text-gray-700">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                             </div>
                        @endif
                        <span class="font-medium text-gray-800">Hi, {{ Auth::user()->name }}</span>
                    </div>
                    <a href="{{ route('profile.edit') }}" class="text-gray-700 hover:bg-gray-200 hover:text-black block px-3 py-2 rounded-md text-base font-medium">My Profile</a>

                    <!-- Form Logout -->
                    <form method="POST" action="{{ route('logout') }}" class="block">
                        @csrf
                        <button type="submit" class="w-full text-left text-red-600 hover:bg-red-50 block px-3 py-2 rounded-md text-base font-medium">
                            Logout
                        </button>
                    </form>
                </div>
            @else
                <a href="{{ route('loginpage') }}"
                    class="text-gray-700 hover:bg-gray-200 hover:text-black block px-3 py-2 rounded-md text-base font-medium border-t border-gray-200 mt-2">
                    Login / Register
                </a>
            @endauth
        </div>
    </div>
</nav>

<!-- JavaScript -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        const iconOpen = document.getElementById('icon-open');
        const iconClose = document.getElementById('icon-close');

        const searchToggleMobile = document.getElementById('search-toggle-mobile');
        const mobileSearch = document.getElementById('mobile-search');

        // Fungsi untuk toggle menu mobile
        mobileMenuButton.addEventListener('click', () => {
            const isExpanded = mobileMenuButton.getAttribute('aria-expanded') === 'true';
            mobileMenuButton.setAttribute('aria-expanded', !isExpanded);
            mobileMenu.classList.toggle('hidden');
            iconOpen.classList.toggle('hidden');
            iconClose.classList.toggle('hidden');
        });

        // Fungsi untuk toggle search bar mobile
        searchToggleMobile.addEventListener('click', () => {
            mobileSearch.classList.toggle('hidden');
        });
    });
</script>
