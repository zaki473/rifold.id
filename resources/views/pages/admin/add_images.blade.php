<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rifold Dashboard Admin - Add Images Home</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f7f6;
        }
    </style>
</head>
<body class="flex bg-gray-100">
    @include('components.sidebar')

    {{-- Main Content --}}
    <main class="flex-1 ml-64">
        @include('components.header_admin')
        <div class="p-8">
            <h2 class="text-2xl font-semibold mb-4">Add images</h2>

            {{-- Menampilkan Error Validasi (Jika ada) --}}
            @if ($errors->any())
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-xl font-semibold mb-4 border-b pb-4">Add images</h3>

                {{-- Form Start --}}
                {{-- PERBAIKAN 1: Tambahkan Action Route --}}
                <form action="{{ route('images.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- PERBAIKAN 2: Tambahkan Input Nama (Wajib untuk Database) --}}
                    <div class="mb-6">
                        <label for="images_name" class="block text-sm font-medium text-gray-700 mb-2">Images name</label>
                        <input type="text" name="images_name" id="images_name" placeholder="e.g. Summer Casual Outfit"
                               class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                    </div>

                    {{-- Images Upload Area --}}
                    <div class="mt-6">
                        <label class="block text-sm font-medium text-gray-700">Images (Thumbnail)</label>
                        <div class="mt-1 flex justify-center px-6 pt-10 pb-10 border-2 border-gray-300 border-dashed rounded-md hover:bg-gray-50 transition-colors relative">
                            <div class="space-y-1 text-center">
                                <div class="mx-auto h-12 w-12 text-gray-400 bg-gray-100 rounded-full flex items-center justify-center">
                                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-4-4V7a4 4 0 014-4h5l5 5v11a4 4 0 01-4 4H7z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11v6m0 0l-3-3m3 3l3-3"></path>
                                        <path d="M12 11V6.5M12 6.5L9.5 9M12 6.5L14.5 9" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" transform="rotate(180 12 8.75) scale(1, -1) translate(0, -5)"></path>
                                        <path d="M12 11V6.5M12 6.5L9.5 9M12 6.5L14.5 9" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" transform="scale(1, 1) translate(0, 5)"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1"></path>
                                    </svg>
                                </div>
                                <div class="flex text-sm text-gray-600 justify-center">
                                    <label for="file-upload" class="relative cursor-pointer bg-white rounded-md font-medium text-black hover:text-indigo-500 focus-within:outline-none">
                                        <span class="font-bold">Click to upload</span>
                                        {{-- PERBAIKAN 3: Ubah name menjadi images[] sesuai controller --}}
                                        <input id="file-upload" name="images[]" type="file" class="sr-only" multiple onchange="showFileNames(this)">
                                    </label>
                                    <p class="pl-1">or drag and drop</p>
                                </div>
                                <p class="text-xs text-gray-500">PNG, JPEG and JPG.</p>
                                {{-- Area untuk menampilkan nama file yang dipilih --}}
                                <p id="file-list" class="text-sm text-indigo-600 mt-2 font-semibold"></p>
                            </div>
                        </div>
                    </div>

                    {{-- Submit Button --}}
                    <div class="mt-8 flex justify-end">
                        <button type="submit" class="bg-gray-800 text-white font-semibold py-2 px-6 rounded-md hover:bg-gray-900 transition-colors">
                            Publish Product
                        </button>
                    </div>
                </form>
                {{-- Form End --}}

            </div>
        </div>
    </main>

    {{-- Script Sedikit untuk Menampilkan Nama File setelah dipilih --}}
    <script>
        function showFileNames(input) {
            const fileList = document.getElementById('file-list');
            if (input.files.length > 0) {
                let names = [];
                for (let i = 0; i < input.files.length; i++) {
                    names.push(input.files[i].name);
                }
                fileList.textContent = 'Selected: ' + names.join(', ');
            } else {
                fileList.textContent = '';
            }
        }
    </script>

</body>
</html>
