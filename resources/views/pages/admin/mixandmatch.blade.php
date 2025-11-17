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
                <h2 class="text-2xl font-semibold mb-4">Mix And Match</h2>
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-xl font-semibold mb-4">Mix And Match list</h3>
                    <div class="mb-4">
                        <input type="text" placeholder="Search........" class="w-full p-2 border border-gray-300 rounded-md">
                    </div>
                    <table class="w-full">
                        <thead>
                            <tr class="border-b">
                                <th class="text-left p-3">Mix And Match</th>
                                <th class="text-left p-3">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Contoh Baris Produk 1 --}}
                            <tr class="border-b hover:bg-gray-50">
                                <td class="p-3 flex items-center">
                                    <img src="{{ asset('images/katalog/coze jacket classy black.png') }}" alt="Product Image" class="w-10 h-10 rounded-md mr-4 object-contain">
                                    <span>COZE JACKET CLASSY BLACK</span>
                                </td>
                                <td class="p-3">
                                    <button class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition-colors">Edit</button>
                                    <button class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 transition-colors">Delete</button>
                                </td>
                            </tr>
                            {{-- Contoh Baris Produk 2 --}}
                            <tr class="border-b hover:bg-gray-50">
                                <td class="p-3 flex items-center">
                                    <img src="{{ asset('images/katalog/coze jacket classy black.png') }}" alt="Product Image" class="w-10 h-10 rounded-md mr-4 object-contain">
                                    <span>CITY LOOP LONG SLEEVE</span>
                                </td>
                                <td class="p-3">
                                    <button class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition-colors">Edit</button>
                                    <button class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 transition-colors">Delete</button>
                                </td>
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
