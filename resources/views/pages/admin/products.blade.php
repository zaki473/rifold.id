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
                    <input type="text" placeholder="Search........" class="w-full p-2 border border-gray-300 rounded-md">
                </div>
                <table class="w-full">
                    <thead>
                        <tr class="border-b">
                            <th class="text-left p-3">Products</th>
                            <th class="text-left p-3">Price</th>
                            <th class="text-left p-3">Stock</th>
                            <th class="text-left p-3">Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Contoh Baris Produk 1 --}}
                        <tr class="border-b hover:bg-gray-50">
                            <td class="p-3 flex items-center">
                                <img src="https://via.placeholder.com/40" alt="Product Image" class="w-10 h-10 rounded-md mr-4">
                                <span>COZE JACKET CLASSY BLACK</span>
                            </td>
                            <td class="p-3">Rp 149.900</td>
                            <td class="p-3">100</td>
                            <td class="p-3 font-bold">...</td>
                        </tr>
                        {{-- Contoh Baris Produk 2 --}}
                        <tr class="border-b hover:bg-gray-50">
                            <td class="p-3 flex items-center">
                                <img src="https://via.placeholder.com/40" alt="Product Image" class="w-10 h-10 rounded-md mr-4">
                                <span>CITY LOOP LONG SLEEVE</span>
                            </td>
                            <td class="p-3">Rp 149.000</td>
                            <td class="p-3">100</td>
                            <td class="p-3 font-bold">...</td>
                        </tr>
                        {{-- Contoh Baris Produk 3 --}}
                        <tr class="border-b hover:bg-gray-50">
                            <td class="p-3 flex items-center">
                                <img src="https://via.placeholder.com/40" alt="Product Image" class="w-10 h-10 rounded-md mr-4">
                                <span>OVERCOOL MIDNIGHT BLACK</span>
                            </td>
                            <td class="p-3">Rp 130.000</td>
                            <td class="p-3">100</td>
                            <td class="p-3 font-bold">...</td>
                        </tr>
                         {{-- Contoh Baris Produk 4 --}}
                        <tr class="hover:bg-gray-50">
                            <td class="p-3 flex items-center">
                                <img src="https://via.placeholder.com/40" alt="Product Image" class="w-10 h-10 rounded-md mr-4">
                                <span>TONEPOP NAVY WAVES</span>
                            </td>
                            <td class="p-3">Rp 110.000</td>
                            <td class="p-3">100</td>
                            <td class="p-3 font-bold">...</td>
                        </tr>
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
