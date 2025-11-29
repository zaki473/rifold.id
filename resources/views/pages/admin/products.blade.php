<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rifold Dashboard Admin - Products</title>
    {{-- Tambahkan link ke file CSS Anda di sini --}}
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* Anda bisa menambahkan CSS kustom di sini jika diperlukan */
        body {
            background-color: #f4f7f6;
        }

        .active {
            background-color: #eef2f5;
            font-weight: bold;
        }
    </style>
</head>

<body class="flex bg-gray-100">

    @include('components.sidebar')
    {{-- Main Content --}}
    <main class="flex-1 ml-64">
        @include('components.header_admin')
        <div class="p-8">
            <h2 class="text-2xl font-semibold mb-4">Products</h2>
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-xl font-semibold mb-4">Products list</h3>
                <div class="mb-4">
                    <input type="text" placeholder="Search........"
                        class="w-full p-2 border border-gray-300 rounded-md">
                </div>
                <table class="w-full">
                    <thead>
                        <tr class="border-b">
                            <th class="text-left p-3">Products</th>
                            <th class="text-left p-3">Price</th>
                            <th class="text-left p-3">Stock</th>
                            <th class="text-left p-3">Detail</th>
                            <th class="text-left p-3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Mulai Looping Data Produk --}}
                        @forelse($products as $product)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="p-3 flex items-center">
                                    {{-- LOGIKA GAMBAR --}}
                                    {{-- Karena images disimpan sebagai array JSON, kita ambil gambar pertama --}}
                                    @php
                                        $firstImage = null;
                                        // Cek apakah ada gambar dan apakah bentuknya array
                                        if (is_array($product->images) && count($product->images) > 0) {
                                            $firstImage = $product->images[0];
                                        }
                                    @endphp

                                    @if ($firstImage)
                                        {{-- Tampilkan gambar dari storage --}}
                                        <img src="{{ asset('storage/' . $firstImage) }}" alt="{{ $product->name }}"
                                            class="w-10 h-10 rounded-md mr-4 object-cover border">
                                    @else
                                        {{-- Gambar Placeholder jika tidak ada gambar --}}
                                        <div
                                            class="w-10 h-10 rounded-md mr-4 bg-gray-200 flex items-center justify-center text-xs">
                                            No Img</div>
                                    @endif

                                    {{-- Nama Produk --}}
                                    <span class="font-medium">{{ $product->name }}</span>
                                </td>

                                {{-- Harga (Format Rupiah) --}}
                                <td class="p-3">Rp {{ number_format($product->price, 0, ',', '.') }}</td>

                                {{-- Stok --}}
                                <td class="p-3">{{ $product->stock }}</td>

                                {{-- Detail (Deskripsi singkat) --}}
                                <td class="p-3 text-gray-500 text-sm truncate max-w-xs">
                                    {{ Str::limit($product->description, 30) }}
                                </td>

                                {{-- Action Buttons --}}
                                <td class="p-3 flex space-x-2">
                                    {{-- Tombol Edit (Belum ada fungsi, hanya link) --}}
                                    <a href="{{ route('edit_products', $product->id) }}"
                                        class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition-colors text-sm">
                                        Edit
                                    </a>

                                    {{-- Tombol Delete (Harus pakai Form) --}}
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this product?');">
                                        @csrf
                                        @method('DELETE') {{-- PENTING: Mengubah method POST menjadi DELETE --}}

                                        <button type="submit"
                                            class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 transition-colors text-sm">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            {{-- Jika data kosong --}}
                            <tr>
                                <td colspan="5" class="text-center p-6 text-gray-500">
                                    Belum ada produk. Silakan tambah produk baru.
                                </td>
                            </tr>
                        @endforelse

                        <div class="mt-6">
                            {{ $products->links() }}
                        </div>
                    </tbody>
                </table>
                {{-- Paginasi --}}
                <div class="mt-6 flex justify-end items-center">
                    <a href="#" class="px-3 py-1 border rounded-md mx-1">&lt;</a>
                    <a href="#" class="px-3 py-1 border rounded-md mx-1 bg-gray-200">1</a>
                    <a href="#" class="px-3 py-1 border rounded-md mx-1">2</a>
                    <a href="#" class="px-3 py-1 border rounded-md mx-1">3</a>
                    <a href="#" class="px-3 py-1 border rounded-md mx-1">&gt;</a>
                </div>
            </div>
        </div>
    </main>

</body>

</html>
