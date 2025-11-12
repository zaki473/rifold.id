<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rifold Dashboard Admin - Add Products</title>
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
        .file-upload-box {
            border: 2px dashed #d1d5db;
        }
    </style>
</head>
<body class="flex bg-gray-100">
    @include('components.sidebar')

    {{-- Main Content --}}
    <main class="flex-1 ml-64">
        @include('components.header_admin')
        <div class="p-8">
            <h2 class="text-2xl font-semibold mb-4">Add Products</h2>
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-xl font-semibold mb-4 border-b pb-4">Add products</h3>

                {{-- Form Start --}}
                <form action="{{-- URL untuk menyimpan produk --}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                        {{-- Product Name --}}
                        <div>
                            <label for="product_name" class="block text-sm font-medium text-gray-700">Products Name</label>
                            <input type="text" name="product_name" id="product_name" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                        {{-- Category --}}
                        <div>
                            <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
                            <input type="text" name="category" id="category" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                        {{-- Price --}}
                        <div>
                            <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                            <div class="mt-1 flex rounded-md shadow-sm">
                                <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500">Rp</span>
                                <input type="number" name="price" id="price" class="flex-1 block w-full rounded-none rounded-r-md border border-gray-300 py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                        </div>
                        {{-- Size --}}
                        <div>
                            <label for="size" class="block text-sm font-medium text-gray-700">Size</label>
                            <input type="text" name="size" id="size" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                        {{-- Stock --}}
                        <div>
                            <label for="stock" class="block text-sm font-medium text-gray-700">Stock</label>
                            <input type="number" name="stock" id="stock" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                        {{-- Color --}}
                        <div>
                            <label for="color" class="block text-sm font-medium text-gray-700">Color</label>
                            <input type="text" name="color" id="color" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                    </div>

                    {{-- Description --}}
                    <div class="mt-6">
                        <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea id="description" name="description" rows="4" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"></textarea>
                    </div>

                    {{-- Products Images --}}
                    <div class="mt-6">
                        <label class="block text-sm font-medium text-gray-700">Products Images</label>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm text-gray-600">
                                    <label for="file-upload" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                        <span>Click to upload</span>
                                        <input id="file-upload" name="images[]" type="file" class="sr-only" multiple>
                                    </label>
                                    <p class="pl-1">or drag and drop</p>
                                </div>
                                <p class="text-xs text-gray-500">PNG, JPEG and JPG.</p>
                            </div>
                        </div>
                    </div>

                    {{-- Submit Button --}}
                    <div class="mt-8 flex justify-end">
                        <button type="submit" class="bg-gray-200 text-gray-700 font-semibold py-2 px-6 rounded-md hover:bg-gray-300">
                            Publish Product
                        </button>
                    </div>
                </form>
                {{-- Form End --}}

            </div>
        </div>
    </main>

</body>
</html>
