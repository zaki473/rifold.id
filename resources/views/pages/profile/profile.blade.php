<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <title>Rifold - Profile</title>
    <style>
        body { font-family: 'Poppins', sans-serif; }
        /* Hide scrollbar for clean look in overflow areas */
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>

<body class="bg-white text-gray-900 antialiased">

    {{-- NAVBAR --}}
    @include('components.navbar')

    @php
        // Dummy Data
        $user = Auth::user() ?? (object)[
            'name' => 'Felisitas Griselda',
            'email' => 'grisel@email.com',
            'phone' => '085859440829',
            'created_at' => now()->subMonths(3),
            'address' => 'Jl. Mawar Melati No. 12, Jakarta Selatan'
        ];

        if (!isset($orders) || $orders === null) {
            $orders = collect([
                (object)[
                    'id' => 1,
                    'product_image' => 'images/katalog/polo tonepop navy waves.png',
                    'product_name' => 'Polo Tonepop Navy Waves',
                    'total_price' => 110000,
                    'created_at' => now()->subDays(8),
                    'status' => 'Processing'
                ],
                (object)[
                    'id' => 2,
                    'product_image' => 'images/katalog/Cityloop long.png',
                    'product_name' => 'City Loop Long Sleeve',
                    'total_price' => 149900,
                    'created_at' => now()->subDays(20),
                    'status' => 'Shipped'
                ],
            ]);
        }
    @endphp

    <div class="max-w-7xl mx-auto px-6 md:px-12 py-16 md:py-24">
        
        <!-- HEADER: Minimalist Greeting -->
        <div class="flex flex-col md:flex-row justify-between items-end border-b border-gray-200 pb-8 mb-12">
            <div>
                <h1 class="text-4xl md:text-5xl font-light tracking-tight text-gray-900 mb-2">
                    Hello, <span class="font-bold">{{ explode(' ', $user->name)[0] }}</span>.
                </h1>
                <p class="text-gray-500 text-sm md:text-base">Welcome to your personal dashboard.</p>
            </div>
            
            <form action="{{ route('logout') }}" method="POST" class="mt-4 md:mt-0">
                @csrf
                <button type="submit" class="text-sm font-medium text-red-500 hover:text-red-700 transition border-b border-transparent hover:border-red-700 pb-0.5">
                    Sign Out
                </button>
            </form>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-20 items-start">

            <!-- SIDEBAR: Profile Picture & Quick Nav -->
            <div class="lg:col-span-4 lg:sticky lg:top-32 space-y-10">
                
                <!-- Photo Section -->
                <div class="group relative w-full aspect-square max-w-[280px] lg:max-w-full rounded-2xl overflow-hidden bg-gray-100 mx-auto lg:mx-0">
                    <img src="{{ asset('images/clean-outfit.png') }}" alt="Profile" class="w-full h-full object-cover transition duration-700 group-hover:scale-105">
                    
                    <!-- Edit Photo Overlay -->
                    <div class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition duration-300 flex items-center justify-center cursor-pointer">
                        <span class="bg-white text-black px-4 py-2 rounded-full text-xs font-bold uppercase tracking-widest shadow-lg">Change Photo</span>
                    </div>
                </div>

                <!-- Navigation Links (Simple Text) -->
                <nav class="hidden lg:flex flex-col space-y-4">
                    <a href="#profile" class="text-xl font-medium text-black pl-4 border-l-2 border-black">Profile Details</a>
                    <a href="#orders" class="text-xl font-medium text-gray-400 hover:text-black pl-4 border-l-2 border-transparent hover:border-gray-300 transition-colors">Order History</a>
                </nav>
            </div>

            <!-- MAIN CONTENT -->
            <div class="lg:col-span-8 space-y-16">

                <!-- SECTION 1: PROFILE DETAILS -->
                <section id="profile" class="scroll-mt-32">
                    <div class="flex justify-between items-end mb-8">
                        <h2 class="text-2xl font-bold tracking-tight">Account Details</h2>
                        <a href="{{ route('profile.edit') }}" class="text-sm font-semibold underline decoration-1 underline-offset-4 hover:text-gray-500 transition">Edit Info</a>
                    </div>

                    <!-- Layout Grid Data -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-10">
                        <!-- Field Group -->
                        <div class="group">
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Full Name</label>
                            <div class="text-lg font-medium border-b border-gray-200 pb-2 group-hover:border-black transition-colors">
                                {{ $user->name }}
                            </div>
                        </div>

                        <div class="group">
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Email</label>
                            <div class="text-lg font-medium border-b border-gray-200 pb-2 group-hover:border-black transition-colors">
                                {{ $user->email }}
                            </div>
                        </div>

                        <div class="group">
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Phone</label>
                            <div class="text-lg font-medium border-b border-gray-200 pb-2 group-hover:border-black transition-colors">
                                {{ $user->phone }}
                            </div>
                        </div>

                         <div class="group">
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Member Since</label>
                            <div class="text-lg font-medium border-b border-gray-200 pb-2 group-hover:border-black transition-colors">
                                {{ \Carbon\Carbon::parse($user->created_at)->format('F, Y') }}
                            </div>
                        </div>

                        <div class="md:col-span-2 group">
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Default Address</label>
                            <div class="text-lg font-medium border-b border-gray-200 pb-2 group-hover:border-black transition-colors">
                                {{ $user->address }}
                            </div>
                        </div>
                    </div>
                </section>

                <!-- SECTION 2: ORDER HISTORY (Minimalist List) -->
                <section id="orders" class="scroll-mt-32 pt-8 border-t border-gray-100">
                    <h2 class="text-2xl font-bold tracking-tight mb-8">Recent Orders</h2>

                    @if($orders->isNotEmpty())
                        <div class="space-y-6">
                            @foreach($orders as $order)
                            <!-- Order Item -->
                            <div class="group flex flex-col sm:flex-row gap-6 p-4 rounded-xl hover:bg-gray-50 transition-colors duration-300">
                                <!-- Image -->
                                <div class="w-24 h-28 flex-shrink-0 bg-gray-200 rounded-lg overflow-hidden">
                                    <img src="{{ asset($order->product_image) }}" class="w-full h-full object-cover object-top" alt="Product">
                                </div>

                                <!-- Details -->
                                <div class="flex-1 flex flex-col justify-center">
                                    <div class="flex justify-between items-start mb-1">
                                        <h3 class="font-semibold text-lg text-gray-900">{{ $order->product_name }}</h3>
                                        <span class="text-sm font-medium text-gray-900">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                                    </div>
                                    
                                    <p class="text-sm text-gray-500 mb-4">
                                        Placed on {{ \Carbon\Carbon::parse($order->created_at)->format('d M Y') }}
                                    </p>

                                    <div class="flex justify-between items-center">
                                        <!-- Minimalist Badge -->
                                        @php
                                            $bgClass = match(strtolower($order->status)) {
                                                'processing' => 'bg-orange-100 text-orange-700',
                                                'shipped' => 'bg-blue-100 text-blue-700',
                                                'delivered' => 'bg-green-100 text-green-700',
                                                default => 'bg-gray-200 text-gray-700'
                                            };
                                        @endphp
                                        <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wide {{ $bgClass }}">
                                            {{ $order->status }}
                                        </span>

                                        <a href="#" class="text-sm font-semibold underline decoration-1 underline-offset-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                            Details
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <!-- Empty State -->
                        <div class="py-12 text-center bg-gray-50 rounded-xl">
                            <p class="text-gray-500 mb-4">You haven't placed any orders yet.</p>
                            <a href="{{ route('katalog') }}" class="inline-block bg-black text-white px-8 py-3 rounded-full text-sm font-bold uppercase tracking-wide hover:bg-gray-800 transition">
                                Start Shopping
                            </a>
                        </div>
                    @endif
                </section>

            </div>
        </div>
    </div>

    {{-- FOOTER --}}
    @include('components.footer')

</body>
</html>