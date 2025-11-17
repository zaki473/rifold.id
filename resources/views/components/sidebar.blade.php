{{-- Sidebar --}}
<aside class="w-64 bg-gray-50 text-gray-800 h-screen p-4 flex flex-col fixed border-r border-gray-200">
    {{-- Logo and Title --}}
    <div class="mb-10 px-2">
        <h1 class="text-2xl font-bold text-gray-900 tracking-wider">RIFOLD</h1>
        <h2 class="text-sm text-gray-500">Dashboard Admin</h2>
    </div>

    {{-- Navigation --}}
    <nav class="flex-grow">
        <ul class="space-y-2">

            {{-- 1. Dropdown untuk Products --}}
            <li x-data="{ open: {{ request()->routeIs('admin', 'add_products') ? 'true' : 'false' }} }">
                <button @click="open = !open" class="w-full flex justify-between items-center p-3 rounded-lg text-gray-700 hover:bg-gray-200 transition-colors duration-200 focus:outline-none">
                    <span class="font-medium">Products</span>
                    <svg class="w-4 h-4 transform transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                <ul x-show="open" x-transition class="mt-2 space-y-2 pl-5">
                    <li>
                        <a href="{{ route('admin') }}" class="block p-2 rounded-lg text-gray-700 hover:bg-gray-200 {{ request()->routeIs('admin') ? 'active' : '' }}">
                           Product List
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('add_products') }}" class="block p-2 rounded-lg text-gray-700 hover:bg-gray-200 {{ request()->routeIs('add_products') ? 'active' : '' }}">
                           Add Product
                        </a>
                    </li>
                </ul>
            </li>

            {{-- 2. Dropdown untuk Content --}}
            <li x-data="{ open: {{ request()->routeIs('add_images', 'add_video') ? 'true' : 'false' }} }">
                <button @click="open = !open" class="w-full flex justify-between items-center p-3 rounded-lg text-gray-700 hover:bg-gray-200 transition-colors duration-200 focus:outline-none">
                    <span class="font-medium">Content Images</span>
                    <svg class="w-4 h-4 transform transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                <ul x-show="open" x-transition class="mt-2 space-y-2 pl-5">
                    <li>
                        <a href="{{ route('admin.images') }}" class="block p-2 rounded-lg text-gray-700 hover:bg-gray-200 {{ request()->routeIs('admin.images') ? 'active' : '' }}">
                           Images List
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('add_images') }}" class="block p-2 rounded-lg text-gray-700 hover:bg-gray-200 {{ request()->routeIs('add_images') ? 'active' : '' }}">
                           Add Images
                        </a>
                    </li>
                </ul>
            </li>

            {{-- 2. Dropdown untuk Home Page Content --}}
            <li x-data="{ open: {{ request()->routeIs('add_images', 'add_video') ? 'true' : 'false' }} }">
                <button @click="open = !open" class="w-full flex justify-between items-center p-3 rounded-lg text-gray-700 hover:bg-gray-200 transition-colors duration-200 focus:outline-none">
                    <span class="font-medium">Content Video</span>
                    <svg class="w-4 h-4 transform transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                <ul x-show="open" x-transition class="mt-2 space-y-2 pl-5">
                    <li>
                        <a href="{{ route('admin.video') }}" class="block p-2 rounded-lg text-gray-700 hover:bg-gray-200 {{ request()->routeIs('admin.video') ? 'active' : '' }}">
                           Video List
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('add_video') }}" class="block p-2 rounded-lg text-gray-700 hover:bg-gray-200 {{ request()->routeIs('add_video') ? 'active' : '' }}">
                           Add Video
                        </a>
                    </li>
                </ul>
            </li>

            {{-- 3. Dropdown untuk Mix and Match --}}
             <li x-data="{ open: {{ request()->routeIs('add_mixandmatch') ? 'true' : 'false' }} }">
                <button @click="open = !open" class="w-full flex justify-between items-center p-3 rounded-lg text-gray-700 hover:bg-gray-200 transition-colors duration-200 focus:outline-none">
                    <span class="font-medium">Mix and Match</span>
                    <svg class="w-4 h-4 transform transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                <ul x-show="open" x-transition class="mt-2 space-y-2 pl-5">
                    <li>
                        <a href="{{ route('add_mixandmatch') }}" class="block p-2 rounded-lg text-gray-700 hover:bg-gray-200 {{ request()->routeIs('add_mixandmatch') ? 'active' : '' }}">
                           Add Images
                        </a>
                    </li>
                    {{-- Contoh jika nanti ingin menambah --}}
                    {{-- <li>
                        <a href="#" class="block p-2 rounded-lg text-gray-700 hover:bg-gray-200">
                           View Gallery
                        </a>
                    </li> --}}
                </ul>
            </li>

            {{-- Menu tunggal lainnya --}}
            <li>
                <a href="#" class="block p-3 rounded-lg text-gray-700 hover:bg-gray-200 transition-colors duration-200">
                   Status
                </a>
            </li>
        </ul>
    </nav>
</aside>

{{-- Pastikan style ini tetap ada --}}
<style>
    .active {
        background-color: #111827; /* bg-gray-900 */
        color: #ffffff; /* text-white */
        font-weight: 600; /* font-semibold */
    }
    .active:hover {
        background-color: #111827;
    }
</style>

<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
