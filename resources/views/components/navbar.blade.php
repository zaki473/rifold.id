<nav class="bg-white/80 backdrop-blur-md shadow-sm sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex flex-col items-center">

        <!-- Logo di atas -->
        <div class="mb-2">
            <a href="{{ route('home') }}">
                <img src="{{ asset('images/logo.png') }}" alt="logo" width="186" height="42" />
            </a>
        </div>

        <!-- Row menu + button -->
        <div class="flex items-center w-full">

            <!-- Space kosong kiri (agar menu bisa center) -->
            <div class="flex-1"></div>

            <!-- MENU (selalu di tengah) -->
            <div class="flex-1 flex justify-center">
                <div class="flex space-x-6">
                    <a href="{{ route('home') }}"
                        class="text-gray-700 hover:text-black transition-colors duration-300">Home</a>
                    <a href="{{ route('about') }}"
                        class="text-gray-700 hover:text-black transition-colors duration-300">About</a>
                    <a href="{{ route('katalog') }}"
                        class="text-gray-700 hover:text-black transition-colors duration-300">Katalog</a>
                    <a href="{{ route('mixandmatch') }}"
                        class="text-gray-700 hover:text-black transition-colors duration-300">Mix and Match</a>
                </div>
            </div>

            <!-- CART + LOGIN -->
            <div class="flex items-center space-x-4 flex-1 justify-end -mt-10">

                <!-- Cart -->
                <a href="{{ route('katalog') }}" class="relative">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor"
                        class="w-6 h-6 text-gray-700 hover:text-black transition-colors duration-300">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 2.25l1.5 1.5m0 0L6 12h12l2.25-6.75H6.75m-3-1.5H21m-10.5
                            15a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zm9 0a1.5 1.5 0
                            11-3 0 1.5 1.5 0 013 0z" />
                    </svg>
                </a>

                <!-- Login -->
                <a href="{{ route('admin') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor"
                        class="w-7 h-7 text-gray-700 hover:text-black transition-colors duration-300">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6.75a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.5
                            20.25a8.25 8.25 0 1115 0v.75H4.5v-.75z" />
                    </svg>
                </a>
            </div>
        </div>

    </div>
</nav>
