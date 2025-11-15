<!DOCTYPE html> 
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Rifold | Profile</title>
</head>

<body class="bg-[#FBF7F4] text-[#333333]">

    {{-- NAVBAR --}}
    @include('components.navbar')

    @php
        // ---------- Dummy user (safe fallback saat belum ada auth) ----------
        $user = Auth::user() ?? (object)[
            'name' => ' Felisitas Griselda',
            'email' => 'grisel@email.com',
            'phone' => '085859440829',
            'created_at' => now(),
            'address' => 'No address added yet.'
        ];

        // ---------- Dummy orders (fallback ketika $orders tidak dikirim dari controller) ----------
        // Jika $orders sudah tersedia dari controller, pastikan jadi collection agar loop berjalan mulus.
        if (!isset($orders) || $orders === null) {
            $orders = collect([
                (object)[
                    'id' => 1,
                    'product_image' => 'images/katalog/polo tonepop navy waves.png',
                    'product_name' => 'Polo Tonepop Navy Waves',
                    'total_price' => 110000,
                    'created_at' => now()->subDays(8),
                    'status' => 'On Process' // contoh: On Process
                ],
                (object)[
                    'id' => 2,
                    'product_image' => 'images/katalog/Cityloop long.png',
                    'product_name' => 'City Loop Long Sleeve',
                    'total_price' => 149900,
                    'created_at' => now()->subDays(20),
                    'status' => 'Delivered' // contoh: Delivered
                ],
                (object)[
                    'id' => 3,
                    'product_image' => 'images/katalog/coze jacket classy black.png',
                    'product_name' => 'Coze Jacket Classy Black',
                    'total_price' => 149900,
                    'created_at' => now()->subDays(35),
                    'status' => 'Completed' // contoh: Completed
                ],
            ]);
        } else {
            // jika $orders dikirim tapi bukan collection, ubah jadi collection
            if (!($orders instanceof \Illuminate\Support\Collection)) {
                $orders = collect($orders);
            }
        }
    @endphp

    <!-- HEADER SECTION -->
    <section class="w-full bg-black text-white py-20 text-center">
        <h1 class="text-5xl md:text-7xl font-extrabold tracking-wide">YOUR PROFILE</h1>
        <p class="text-lg md:text-2xl mt-3 font-light">manage your account and track your journey with Rifold</p>
    </section>

    <div class="max-w-6xl mx-auto px-6 py-12 space-y-16">

        <!-- PROFILE INFORMATION -->
        <div class="bg-white shadow-lg rounded-xl p-8 flex flex-col md:flex-row gap-10">

            <!-- PHOTO -->
            <div class="flex flex-col items-center md:items-start">
                <img src="{{ asset('images/clean-outfit.png') }}"
                    class="w-40 h-40 rounded-full object-cover shadow-md" alt="profile photo">
                <button class="mt-4 px-5 py-2 bg-black text-white rounded-md hover:bg-white hover:text-black border border-black transition">
                    Change Photo
                </button>
            </div>

            <!-- INFO -->
            <div class="flex-1 space-y-4">
                <h2 class="text-3xl font-bold uppercase tracking-wide">Account Information</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4">

                    <div>
                        <p class="font-semibold text-sm uppercase text-gray-600">Full Name</p>
                        <p class="text-lg">{{ $user->name }}</p>
                    </div>

                    <div>
                        <p class="font-semibold text-sm uppercase text-gray-600">Email</p>
                        <p class="text-lg">{{ $user->email }}</p>
                    </div>

                    <div>
                        <p class="font-semibold text-sm uppercase text-gray-600">Phone</p>
                        <p class="text-lg">{{ $user->phone }}</p>
                    </div>

                    <div>
                        <p class="font-semibold text-sm uppercase text-gray-600">Join Date</p>
                        <p class="text-lg">
                            {{-- created_at bisa jadi Carbon atau string --}}
                            {{ (isset($user->created_at) && method_exists($user->created_at, 'format')) ? $user->created_at->format('d M Y') : \Carbon\Carbon::parse($user->created_at)->format('d M Y') }}
                        </p>
                    </div>

                    <div class="md:col-span-2">
                        <p class="font-semibold text-sm uppercase text-gray-600">Address</p>
                        <p class="text-lg">{{ $user->address }}</p>
                    </div>

                </div>

                <div class="pt-6">
                    <a href="#" class="inline-block bg-black text-white px-6 py-3 rounded-md border border-black hover:bg-white hover:text-black transition">
                        Edit Profile
                    </a>
                </div>
            </div>
        </div>

        <!-- ORDER HISTORY -->
        <section>
            <h2 class="text-4xl font-bold mb-8 uppercase tracking-wide">Order History</h2>

            <div class="space-y-6">

                {{-- loop orders (safe karena kita sudah memastikan $orders collection) --}}
                @foreach($orders as $order)
                <div class="bg-white rounded-xl shadow-md p-6 flex flex-col md:flex-row items-start gap-6">

                    {{-- product image safe asset --}}
                    <img src="{{ asset($order->product_image) }}"
                        class="w-40 h-40 object-cover rounded-lg shadow-sm" alt="{{ $order->product_name }}">

                    <div class="flex-1 space-y-2">

                        <h3 class="text-2xl font-semibold">{{ $order->product_name }}</h3>

                        <p class="text-gray-700 text-lg">Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>

                        <p class="text-sm text-gray-500">
                            Order Date:
                            {{ (isset($order->created_at) && method_exists($order->created_at, 'format')) 
                                ? $order->created_at->format('d M Y') 
                                : \Carbon\Carbon::parse($order->created_at)->format('d M Y') }}
                        </p>

                        {{-- status badge --}}
                        @php
                            $status = strtolower($order->status ?? '');
                        @endphp
                        <span class="inline-block px-4 py-1 rounded-full text-white text-sm
                            {{ $status === 'on process' || $status === 'on process' ? 'bg-blue-600' : '' }}
                            {{ $status === 'delivered' ? 'bg-green-600' : '' }}
                            {{ $status === 'completed' ? 'bg-black' : '' }}
                            {{ (!in_array($status, ['on process','delivered','completed'])) ? 'bg-red-600' : '' }}
                        ">
                            {{ $order->status }}
                        </span>

                    </div>

                    <div class="self-end md:self-center">
                        {{-- jika route orders.detail belum ada di frontend, link ini aman (ubah nanti ke rute yang cocok) --}}
                        <a href="{{ url('/orders/'.$order->id) }}"
                           class="inline-block bg-black text-white px-5 py-2 rounded-md border border-black hover:bg-white hover:text-black transition">
                            View Detail
                        </a>
                    </div>

                </div>
                @endforeach

                {{-- jika kosong (tapi dengan dummy tidak kosong) --}}
                @if($orders->isEmpty())
                <p class="text-center text-gray-500 text-lg mt-10">You have no orders yet.</p>
                @endif

            </div>
        </section>

    </div>

    {{-- FOOTER --}}
    @include('components.footer')

</body>
</html>
