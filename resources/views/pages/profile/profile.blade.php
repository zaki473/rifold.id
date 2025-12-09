<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <title>Rifold - Profile</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</head>

<body class="bg-white text-gray-900 antialiased">

    {{-- NAVBAR --}}
    @include('components.navbar')

    {{--
       CATATAN: Saya menghapus blok @php $user = ... @endphp dummy data
       agar data asli dari Controller yang dipakai.
    --}}

    <div class="max-w-7xl mx-auto px-6 md:px-12 py-16 md:py-24">

        <!-- HEADER -->
        <div class="flex flex-col md:flex-row justify-between items-end border-b border-gray-200 pb-8 mb-12">
            <div>
                <h1 class="text-4xl md:text-5xl font-light tracking-tight text-gray-900 mb-2">
                    Hello, <span class="font-bold">{{ explode(' ', $user->name)[0] }}</span>.
                </h1>
                <p class="text-gray-500 text-sm md:text-base">Welcome to your personal dashboard.</p>
            </div>

            <form action="{{ route('logout') }}" method="POST" class="mt-4 md:mt-0">
                @csrf
                <button type="submit"
                    class="text-sm font-medium text-red-500 hover:text-red-700 transition border-b border-transparent hover:border-red-700 pb-0.5">
                    Sign Out
                </button>
            </form>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-20 items-start">

            <!-- SIDEBAR -->
            <div class="lg:col-span-4 lg:sticky lg:top-32 space-y-10">

                <!-- Photo Section (DIPERBAIKI) -->
                <div
                    class="group relative w-full aspect-square max-w-[280px] lg:max-w-full rounded-2xl overflow-hidden bg-gray-100 mx-auto lg:mx-0 shadow-sm border border-gray-100">

                    {{-- Logika Tampilan Foto --}}
                    @if ($user->profile_photo_path)
                        <img src="{{ asset('storage/' . $user->profile_photo_path) }}" alt="{{ $user->name }}"
                            class="w-full h-full object-cover object-top transition duration-700 group-hover:scale-105">
                    @else
                        {{-- Fallback jika user belum upload foto --}}
                        <img src="{{ asset('images/clean-outfit.png') }}" alt="Default Profile"
                            class="w-full h-full object-cover transition duration-700 group-hover:scale-105">
                    @endif

                    <!-- Tombol Edit Foto (Link ke halaman Edit) -->
                    <a href="{{ route('profile.edit') }}"
                        class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition duration-300 flex items-center justify-center cursor-pointer">
                        <span
                            class="bg-white text-black px-4 py-2 rounded-full text-xs font-bold uppercase tracking-widest shadow-lg hover:bg-gray-100">
                            Edit Photo
                        </span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <nav class="hidden lg:flex flex-col space-y-4">
                    <a href="#profile" class="text-xl font-medium text-black pl-4 border-l-2 border-black">Profile
                        Details</a>
                    <a href="#orders"
                        class="text-xl font-medium text-gray-400 hover:text-black pl-4 border-l-2 border-transparent hover:border-gray-300 transition-colors">Order
                        History</a>
                </nav>
            </div>

            <!-- MAIN CONTENT -->
            <div class="lg:col-span-8 space-y-16">

                <!-- SECTION 1: PROFILE DETAILS -->
                <section id="profile" class="scroll-mt-32">
                    <div class="flex justify-between items-end mb-8">
                        <h2 class="text-2xl font-bold tracking-tight">Account Details</h2>
                        <a href="{{ route('profile.edit') }}"
                            class="text-sm font-semibold underline decoration-1 underline-offset-4 hover:text-gray-500 transition">Edit
                            Info</a>
                    </div>

                    @if (session('success'))
                        <div class="bg-green-50 text-green-800 px-4 py-3 rounded-lg mb-6 text-sm">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-10">
                        <div class="group">
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Full
                                Name</label>
                            <div class="text-lg font-medium border-b border-gray-200 pb-2">{{ $user->name }}</div>
                        </div>

                        <div class="group">
                            <label
                                class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Email</label>
                            <div class="text-lg font-medium border-b border-gray-200 pb-2">{{ $user->email }}</div>
                        </div>

                        <div class="group">
                            <label
                                class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Phone</label>
                            <div class="text-lg font-medium border-b border-gray-200 pb-2">{{ $user->phone ?? '-' }}
                            </div>
                        </div>

                        <div class="group">
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Member
                                Since</label>
                            <div class="text-lg font-medium border-b border-gray-200 pb-2">
                                {{ \Carbon\Carbon::parse($user->created_at)->format('F, Y') }}
                            </div>
                        </div>

                        <div class="md:col-span-2 group">
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Default
                                Address</label>
                            <div class="text-lg font-medium border-b border-gray-200 pb-2">{{ $user->address ?? '-' }}
                            </div>
                        </div>
                    </div>
                </section>

                <!-- SECTION 2: ORDER HISTORY -->
                <section id="orders" class="scroll-mt-32 pt-8 border-t border-gray-100">
    <h2 class="text-2xl font-bold tracking-tight mb-8">Recent Orders</h2>

    @if ($orders->isNotEmpty())
        <div class="space-y-6">
            @foreach ($orders as $order)
                @php
                    $firstItem = $order->items->first();
                    $product   = $firstItem?->product;
                @endphp

                <div class="group flex flex-col sm:flex-row gap-6 p-4 rounded-xl hover:bg-gray-50 transition-colors duration-300">
                    <!-- ✅ Order Number + Produk -->
                    <div class="flex-1">
                        <p class="text-xs text-gray-500 mb-1">
                            Order: <span class="font-semibold">{{ $order->order_number }}</span>
                        </p>

                        <p class="font-medium text-gray-900">
                            {{ $product->name ?? 'Product' }}
                        </p>

                        <p class="text-sm text-gray-500 mt-1">
                            {{ $order->created_at->format('d M Y') }}
                        </p>
                    </div>

                    <!-- ✅ Harga + Status -->
                    <div class="flex flex-col justify-between items-end">
                        <span class="text-sm font-semibold text-gray-900">
                            Rp {{ number_format($order->total_price, 0, ',', '.') }}
                        </span>

                        <span class="px-3 py-1 mt-2 rounded-full text-xs font-bold uppercase tracking-wide
@if ($order->status == 'pending') bg-yellow-200 text-yellow-800
@elseif ($order->status == 'paid') bg-blue-200 text-blue-800
@elseif ($order->status == 'processed') bg-indigo-200 text-indigo-800
@elseif ($order->status == 'shipped') bg-purple-200 text-purple-800
@elseif ($order->status == 'delivered') bg-green-200 text-green-800
@elseif ($order->status == 'cancelled') bg-red-200 text-red-800
@endif">
    {{ ucfirst($order->status) }}
</span>
    
                    </div>

                </div>
            @endforeach
        </div>
    @else
        <div class="py-12 text-center bg-gray-50 rounded-xl">
            <p class="text-gray-500 mb-4">You haven't placed any orders yet.</p>
            <a href="{{ route('katalog') }}"
               class="inline-block bg-black text-white px-8 py-3 rounded-full text-sm font-bold uppercase tracking-wide hover:bg-gray-800 transition">
                Start Shopping
            </a>
        </div>
    @endif
</section>



            </div>
        </div>
    </div>

    @include('components.footer')
</body>

</html>
